<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\ApplicationType;
use App\Models\DocumentType;
use App\Models\Maddat;
use App\Models\PlaceType;
use App\Models\PropertyType;
use App\Models\ApplicationDonor;
use App\Utilities\HierarchyUtility;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\DonorRequest;
use App\Models\Filemanager;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;



class FilemanagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
      
        $files = Filemanager::where('is_enable',1);

        if($request->has('q') && $request->q != ''){
            $files = $files->where('title','like','%'.$request->q.'%')
            ->orWhere('filename','like','%'.$request->q.'%')
            ->orWhere('path','like','%'.$request->q.'%');
        }

        $files = $files->limit(10)->get();

        $data = [];
        foreach ($files as $key => $value) {
            array_push($data,[
                'id' => $value->path,
                'text' => $value->title,
                'img' => asset($value->path),
            ]);
        }

        return response()->json(['results' => $data],200);
    }

 
    public function index(Request $request)
    {
    if($request->ajax()){
    $data = [];

    $query = Filemanager::query(); 

// searching 
if ($request->search['value']) {
    $searchTerm = $request->search['value'];
    $query->where(function($query) use ($searchTerm) {
        $query->where('title', 'like', '%'.$searchTerm.'%')
              ->orWhere('description', 'like', '%'.$searchTerm.'%')
              ->orWhere('filename', 'like', '%'.$searchTerm.'%')
              ->orWhere('preview', 'like', '%'.$searchTerm.'%')
              ->orWhere('extension', 'like', '%'.$searchTerm.'%')
              ->orWhere('type', 'like', '%'.$searchTerm.'%')
              ->orwhereDate('created_at', '=', $searchTerm)
              ->orWhere('path', 'like', '%'.$searchTerm.'%');
        // Add more fields as needed
    });
}



// filters 
    // if($request->date){
    //     $query->whereDate('created_at', '=', $request->date);
    // }
    if ($request->startDate && $request->endDate) {
        $query->whereBetween('created_at', [$request->startDate, $request->endDate]);
    } elseif ($request->startDate) {
        $query->whereDate('created_at', '>=', $request->startDate);
    } elseif ($request->endDate) {
        $query->whereDate('created_at', '<=', $request->endDate);
    }
    if($request->id){
        $query->where('id', '=', $request->id);
    }
    if($request->title){
        $query->where('title', 'like', '%'.$request->title.'%');
    }
    if($request->type){
        $query->where('type', 'like', '%'.$request->type.'%');
    }
    if($request->fileName){
        $query->where('filename', 'like', '%'.$request->fileName.'%');
    }
    if($request->size){
        $query->where('size', 'like', '%'.$request->size.'%');
    }
    if($request->path){
        $query->where('path', 'like', '%'.$request->path.'%');
    }
  if($request->extension){
        $query->where('extension', 'like', '%'.$request->extension.'%');
    }
  if($request->group){
        $query->where('grouping', 'like', '%'.$request->group.'%');
    }
    $totalRecords = $query->count(); 

    $records = $query->orderBy('id', 'desc')
                     ->skip($request->start)
                     ->take($request->length)
                     ->get();

    foreach ($records as $record) {
        $action = '<div class="btn-group">';
        $action .= '<a class="btn btn-info" href="'.URL::to('admin/filemanager/edit/'.$record->id).'">Edit</a>';
        $action .= '<a class="btn btn-danger" href="'.URL::to('admin/filemanager/delete/'.$record->id).'">Delete</a>';
        $action .= '</div>';

        $images = '<img style="width:100px;height:50px" src="' . URL::to($record->path ). '">'; 
        $createdAt = $record->created_at->format('d,m,Y');
        $sizeInBytes = $record->size;
            if ($sizeInBytes >= 1048576) {
                $sizeFormatted = round($sizeInBytes / 1048576, 2) . ' MB';
            } elseif ($sizeInBytes >= 1024) {
                $sizeFormatted = round($sizeInBytes / 1024, 2) . ' KB';
            } else {
                $sizeFormatted = $sizeInBytes . ' bytes';
            }
        $data[] = [
            $action,
            $record->id,
            $record->grouping,
            $images,
            $createdAt,
            $record->title,
            $record->extension,
            // $record->type,
            $sizeFormatted? $sizeFormatted : $sizeInBytes,

            // $record->path,
        ];
    }

    return response()->json([
        "draw" => $request->draw,
        "recordsTotal" => $totalRecords, 
        "recordsFiltered" => $totalRecords, 
        'data' => $data,
    ]);
}

    $uniqueGroups = Filemanager::distinct()->pluck('grouping');

    $uniqueExtensions = Filemanager::distinct()->pluck('extension');
        return view('admin.filemanager.index',compact('uniqueGroups','uniqueExtensions'));
    } 
    
    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }
    
        return $bytes;
    }

    public function create(Request $request)
    {

        return view('admin.filemanager.create');
    }

public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'title' => ['max:255'],
        'group' => ['required', 'max:255'],
        'description' => ['max:255'],
        'files.*' => ['required', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
    ]);

    // Check if any files are uploaded
    if (count($request->files) == 0) {
        return new JsonResponse(['error' => 'File Not Found'], 400);
    }

    try {
        // Iterate through the uploaded files
        foreach ($request->files as $files) {
            foreach ($files as $myfile) {
                // Process each file
                $fileExtension = $myfile->getClientOriginalExtension();
                $fileSizeInBytes = $myfile->getSize();
                $mimeType = $myfile->getMimeType();
                $fileTitle = pathinfo($myfile->getClientOriginalName(), PATHINFO_FILENAME);
                $filename = uniqid() . '.' . $fileExtension;
                $path = 'filemanager/' . $filename;
                $upload_path = base_path('public/filemanager');
                $myfile->move($upload_path, $filename);

                // Create a new Filemanager record
                $filemanager = new Filemanager();
                $filemanager->filename = $filename;
                $filemanager->title = $request->title ?: $fileTitle;
                $filemanager->grouping = $request->group;
                $filemanager->description = $request->description ?: $fileTitle;
                $filemanager->size = $fileSizeInBytes;
                $filemanager->type = $mimeType;
                $filemanager->extension = $fileExtension;
                $filemanager->path = $path;
                // $filemanager->preview = asset($path);
                $filemanager->save();
            }
        }
        $lastRecord = Filemanager::latest()->first();
        // Return success response
        return response()->json([
    'success' => 'File Uploaded',
    'getData' => [
        'field1' => $lastRecord->id,
        'field2' => $lastRecord->title,
        // Add other fields as needed
    ]
], 200);
    } catch (\Exception $e) {
        // Return error response if an exception occurs
        return new JsonResponse(['error' => $e->getMessage()], 500);
    }
}

    public function edit($id){

        $filemanager = Filemanager::find($id);
        if($filemanager == null){
            return back();
        }

        return view('admin.filemanager.edit',compact('filemanager'));
    }


    // public function update(Request $request,$id)
    // {  

    //     $filemanager = Filemanager::find($id);
    //     if($filemanager == null){
    //         return back();
    //     }

    //      $request->validate([
    //         'title' => ['max:255'],
    //         'group' => ['required','max:255'],
    //         'description' =>['max:255'],
    //     ]);

    //     $filemanager->title = $request->title;
    //     $filemanager->grouping = $request->group;
    //     $filemanager->description = $request->description;
    //     $filemanager->save();

    //     return back()->with('success','File Uploaded');

    // }
    public function update(Request $request, $id)
    {  
        $filemanager = Filemanager::find($id);
        if (!$filemanager) {
            return back()->with('error', 'File not found');
        }
    
        $request->validate([
            'title' => ['max:255'],
            'group' => ['required', 'max:255'],
            'description' => ['max:255'],
            'files.*' => ['image', 'max:2048'], // Validate each image file
        ]);
    
        // Update the filemanager details
        $filemanager->title = $request->title;
        $filemanager->grouping = $request->group;
        $filemanager->description = $request->description;
        $filemanager->save();
    
        // Handle image upload if new images are provided
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileExtension = $file->getClientOriginalExtension();
                $fileSizeInBytes = $file->getSize();
                $mimeType = $file->getMimeType();
                $fileTitle = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);        
                $filename = uniqid().'.'.$fileExtension;
                $path = 'filemanager/'.$filename;
                $upload_path = public_path('filemanager');
                $file->move($upload_path, $filename);
    
                    $filemanager->size = $fileSizeInBytes;
                    $filemanager->type = $mimeType;
                    $filemanager->extension = $fileExtension;
                    $filemanager->path = $path;
                    // $filemanager->preview = asset($path);
                    $filemanager->save();
            }
        }
        $newData = Filemanager::find($id);
    
        return response()->json(['success' => 'File details updated' ,'data'=>$newData]);
    }

    public function delete($id)
    {
        $filemanager = Filemanager::find($id);
        if($filemanager == null){
            return back();
        }

        // dd(public_path($filemanager->path));

        if (file_exists(public_path($filemanager->path))) {
            if (unlink(public_path($filemanager->path))) {
                // echo 'File removed successfully.';

            } else {
                // echo 'Unable to remove the file.';
            }
        } 


        $filemanager->delete();
        return back()->with('success','Deleted');

    }

    
}
