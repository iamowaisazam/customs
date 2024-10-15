<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;


class RoleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
     
        if($request->ajax()){

        
            $query = Role::query();

            $query->where('id','!=',1);

            //Search
            $search = $request->get('search')['value'];
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('roles.name','like','%'.$search.'%')
                   ->orwhere('roles.id','like','%'.$search.'%');
               });
            }

            $count = $query->get();
            $records = $query->skip($request->start)
            ->take($request->length)->orderBy('id','desc')
            ->get();

            $data = [];
            foreach ($records as $key => $value) {

                $status = $value->status ? 'checked' : '';

                

                $action = '<div class="text-end">';
                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('admin/roles/edit/'.Crypt::encryptString($value->id)).'">Edit</a>';
                $action .= '<a class="mx-1 btn btn-success" href="'.URL::to('admin/permissions/'.Crypt::encryptString($value->id)).'">Permissions</a>';
                // $action .= '<a class="mx-1 btn btn-danger" href="'.URL::to('admin/roles/delete/'.Crypt::encryptString($value->id)).'">Delete</a>';

                $action .= '</div>';

                array_push($data,[
                    $value->id,
                    $value->name,
                    "<div class='switchery-demo'><input ".$status." data-id='".Crypt::encryptString($value->id)."' type='checkbox' class=' is_status js-switch' data-color='#009efb'/>
                   </div>",
                    $action,
                 ]);

            }

            return response()->json([
                "draw" => $request->draw,
                "recordsTotal" => count($count),
                "recordsFiltered" => count($count),
                'data'=> $data,
            ]);
        }

        return view('admin.roles.index');
    }

    


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.roles.create');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name|max:255',
            'status' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Role::create([
            'name' => $request->name,
            'status' => $request->status,
            'created_at' => Carbon::now(),
            'updated_at' => NULL,
            'created_by' => Auth::user()->id,
        ]);
        
        
        return redirect('/admin/roles/index')->with('success','Record Created Success'); 
    }

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {
        $model = Role::find(Crypt::decryptString($id));
        if($model == false){  
            return back()->with('error','Record Not Found');
         }

        return view('admin.roles.edit',compact('model'));
    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {
        $id = Crypt::decryptString($id);
        $model = Role::find($id);
        if($model == false){  
           return back()->with('error','Record Not Found');
        }

        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'max:255',
                Rule::unique('roles')->ignore($id),
            ],
            'status' => 'required|in:0,1',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        $model->name = $request->name;
        $model->updated_by = Auth::user()->id;
        $model->updated_at = Carbon::now();
        $model->save();

        return redirect('admin/roles/index')->with('success','Record Updated');

    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function delete($id)
    {
        $model = Role::find(Crypt::decryptString($id));
        if($model == false){
            return back()->with('warning','Record Not Found');
        }else{

            if(User::where('role_id',$id)->frist()){
                return back()->with('warning','Can Not Delete This Roles Its Used In Users');
            }

            $model->delete();
            return redirect('/admin/roles/index')->with('success','Record Deleted Success'); 
        }

    }


    
}
