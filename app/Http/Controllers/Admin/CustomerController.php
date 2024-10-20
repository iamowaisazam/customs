<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
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

class CustomerController extends Controller
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

            $query = Customer::query();

            //Search
            if($request->has('status') && $request->status != ''){
                $query->where('status',$request->status);
            }

            if($request->has('company_name') && $request->company_name != ''){
                $query->where('company_name',$request->company_name);
            }

            if($request->has('customer_name') && $request->customer_name != ''){
                $query->where('customer_name',$request->customer_name);
            }

            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('customer_name','like','%'.$search.'%')
                   ->orwhere('customer_email','like','%'.$search.'%')
                   ->orwhere('company_name','like','%'.$search.'%')
                   ->orwhere('customer_phone','like','%'.$search.'%');
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

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/customers/'.Crypt::encryptString($value->id)).'/edit">Edit</a>';
                
                $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('admin/customers/'.Crypt::encryptString($value->id)).'">Delete</a>';

                $action .= '</div>';

                $status = $value->status ? 'checked' : '';

                array_push($data,[
                    $value->id,
                    $value->company_name,
                    $value->customer_name,
                    $value->customer_email,
                    $value->customer_phone,
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


        return view('admin.customers.index');

    }

    


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.customers.create');
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
            "customer_name" => 'required|max:255',
            "customer_phone" => 'required|max:255',
            "customer_email" => 'required|email|max:255',
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
            'name' => $request->customer_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 3,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);

       $customer = Customer::create([
            'user_id' => $user->id,
            'company_name' => $request->company_name,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
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
        $customer = Customer::find(Crypt::decryptString($id));
        if($customer == false){  
            return back()->with('error','Record Not Found');
         }



        return view('admin.customers.edit',compact('customer'));
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
        $customer = Customer::find($id);
        if($customer == false){  
           return back()->with('error','Record Not Found');
        }

        $validator = Validator::make($request->all(), [
            "company_name" => 'required|max:255',
            "customer_name" => 'required|max:255',
            "customer_phone" => 'required|max:255',
            "customer_email" => 'required|email|max:255',
            "email" => ['required','email','max:255',Rule::unique('users')->ignore($customer->user_id)],
            "password" => 'nullable|string|min:6|max:255',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }


    
        $customer->company_name = $request->company_name;
        $customer->customer_name = $request->customer_name;
        $customer->customer_email = $request->customer_email;
        $customer->customer_phone = $request->customer_phone;
        $customer->country = $request->country;
        $customer->state = $request->state;
        $customer->city = $request->city;
        $customer->postal_code = $request->postal_code;
        $customer->street_address = $request->street_address;
        $customer->save();

        $customer->user->email = $request->email;
        if($request->password){
          $customer->user->password =  Hash::make($request->password);
        }
        $customer->user->save();

        return back()->with('success','Record Updated');

    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {

        $data = Customer::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{
            $data->delete();
            return response()->json(['message' => 'Record Not Deleted'],200);
        }

    }


    
}
