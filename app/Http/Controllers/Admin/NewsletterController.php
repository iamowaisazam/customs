<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\newsletter;

class NewsletterController extends Controller
{


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Newsletter::query();
           
            $search = $request->input('search.value');
            if ($search) {
                $query->where('email', 'like', '%' . $search . '%');
            }
    
            // Count total records
            $totalRecords = $query->count();
    
            // Paginate records
            $records = $query->orderBy('id', 'desc')
            ->get();
    
            $data = [];
            $i=1;
            foreach ($records as $record) {
                $deleteUrl = route('admin.newsletter.delete', ['id' => Crypt::encryptString($record->id)]);
                $data[] = [
                    // $record->id,
                    $i,
                    $record->email,
                    $record->created_at->format('Y-m-d'),
                    '<div class="btn-group">' .
                    '<a class="btn btn-danger" href="' . $deleteUrl . '">Delete</a>' .
                    '</div>',
                ];
                $i++;
            }
    
            return response()->json([
                'draw'            => $request->input('draw'),
                'recordsTotal'    => $totalRecords,
                'recordsFiltered' => $totalRecords, // No filtering applied in this example
                'data'            => $data,
            ]);
        
        }
        return view('admin.newsletter.index');
    }
    public function delete($id)
    {

        $data = Newsletter::find(Crypt::decryptString($id));
        Newsletter::where('id',$data->id)->delete();
        
        if($data == false){
            return back()->with('warning','Record Not Found');
        }else{
            $data->delete();
            return redirect('/admin/newsletter/index')->with('success','Record Deleted Success'); 
        }

    }
    
}
