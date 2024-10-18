<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
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

class VendorController extends Controller
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

            $query = Vendor::query();

            //Search
            $search = $request->get('search')['value'];
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('vendor_name','like','%'.$search.'%')
                   ->orwhere('vendor_email','like','%'.$search.'%')
                   ->orwhere('vendor_phone','like','%'.$search.'%');
               });
            }
            
            $count = $query->count();       
            $users = $query->skip($request->start)
            ->take($request->length)
            ->orderBy('id','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/vendors/'.Crypt::encryptString($value->id)).'/edit">Edit</a>';
                
                $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('admin/vendors/'.Crypt::encryptString($value->id)).'">Delete</a>';

                $action .= '</div>';

                $status = $value->status ? 'checked' : '';

                array_push($data,[
                    $value->id,
                    $value->vendor_name,
                    $value->vendor_email,
                    $value->vendor_phone,
                    "<div class='switchery-demo'>
                     <input ".$status." data-id='".Crypt::encryptString($value->id)."' type='checkbox' class=' is_status js-switch' data-color='#009efb'/>
                    </div>",
                    $action,
                ]);        
            }

            return response()->json([
                "draw" => $request->draw,
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                'data'=> $data,
            ]);
        }


        return view('admin.vendors.index');

    }

    


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.vendors.create');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "company_name" => 'required|max:255',
            "vendor_name" => 'required|max:255',
            "vendor_phone" => 'required|max:255',
            "vendor_email" => 'required|email|max:255',
            "email" => 'required|email|unique:users,email|max:255',
            "password" => 'required|string|min:6|max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // dd($request->all());

        $user = User::create([
            'name' => $request->vendor_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 3,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);

       $vendor = Vendor::create([
            'user_id' => $user->id,
            'company_logo' => '',
            'company_name' => $request->company_name,
            'vendor_name' => $request->vendor_name,
            'vendor_email' => $request->vendor_email,
            'vendor_phone' => $request->vendor_phone,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'street_address' => $request->street_address,
            'status' => 1,
            'created_by' => Auth::user()->id,
        ]);

        return back()->with('success','Record Created Success'); 

        // return redirect('/admin/customers/index')->with('success','Record Created Success'); 
    }

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {
        $model = Vendor::find(Crypt::decryptString($id));
        if($model == false){  
            return back()->with('error','Record Not Found');
         }

        return view('admin.vendors.edit',compact('model'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function show(Request $request,$id)
    {

      
    }



     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {
        $id = Crypt::decryptString($id);
        $model = Vendor::find($id);
        if($model == false){  
           return back()->with('error','Record Not Found');
        }

        $validator = Validator::make($request->all(), [
            "company_name" => 'required|max:255',
            "vendor_name" => 'required|max:255',
            "vendor_phone" => 'required|max:255',
            "vendor_email" => 'required|email|max:255',
            "email" => ['required','email','max:255',Rule::unique('users')->ignore($model->user_id)],
            "password" => 'nullable|string|min:6|max:255',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }


        // $customer->company_logo = '',
        $model->company_name = $request->company_name;
        $model->vendor_name = $request->vendor_name;
        $model->vendor_email = $request->vendor_email;
        $model->vendor_phone = $request->vendor_phone;
        $model->country = $request->country;
        $model->state = $request->state;
        $model->city = $request->city;
        $model->postal_code = $request->postal_code;
        $model->street_address = $request->street_address;
        $model->save();

        $model->user->email = $request->email;
        if($request->password){
          $model->user->password =  Hash::make($request->password);
        }
        $model->user->save();

        return back()->with('success','Record Updated');

    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {

        $data = Vendor::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{
            $data->delete();
            return response()->json(['message' => 'Record Not Deleted'],200);
        }

    }


    
}
