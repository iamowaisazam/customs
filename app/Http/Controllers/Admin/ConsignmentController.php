<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Currency;
use App\Http\Controllers\Controller;
use App\Models\Consignment;
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

class ConsignmentController extends Controller
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

            $query = Consignment::query();

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

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/consignments/'.Crypt::encryptString($value->id)).'/edit">Edit</a>';
                
                $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('admin/consignments/'.Crypt::encryptString($value->id)).'">Delete</a>';

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


        return view('admin.consignments.index');

    }

    


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create()
    {

        $data = [
            'customers' => Customer::where('status',1)->get(),
        ];

        return view('admin.consignments.create',$data);
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function store(Request $request)
    {

       

        $validator = Validator::make($request->all(), [
             "job_number" => 'required|max:255',
             "customer_id" => 'required|max:255',
             "blawbno" => 'required|max:255',
             "lcbtitno" => 'required|max:255',
             "description" => 'required|max:255',
             "invoice_value" => 'required|max:255',
             "currency" => 'required|max:255',
             "machine_number" => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

       $Consignment = Consignment::create([
            "job_number" => $request->job_number,
            "customer_id" => $request->customer_id,
            "blawbno" => $request->blawbno,
            "lcbtitno" => $request->lcbtitno,
            "description" => $request->description,
            "invoice_value" => $request->invoice_value,
            "currency" => $request->currency,
            "machine_number" => $request->machine_number,
            "job_date" => Carbon::now(),
            'status' => 1,
            'created_by' => Auth::user()->id,
        ]);

        // return back()->with('success','Record Created Success'); 

        return redirect('/admin/consignments/'.Crypt::encryptString($Consignment->id).'/edit')
        ->with('success','Record Created Success'); 
    }

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {
        $model = Consignment::find(Crypt::decryptString($id));
        if($model == false){  
            return back()->with('error','Record Not Found');
         }


         $data = [
            'customers' => Customer::where('status',1)->get(),
            'model' => $model,
            'currencies' => Currency::DATA,
        ];

        return view('admin.consignments.edit',$data);
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
        $model = Consignment::find($id);
        if($model == false){  
           return back()->with('error','Record Not Found');
        }

        // $validator = Validator::make($request->all(), [
        //     "company_name" => 'required|max:255',
        //     "customer_name" => 'required|max:255',
        //     "customer_phone" => 'required|max:255',
        //     "customer_email" => 'required|email|max:255',
        //     "email" => ['required','email','max:255',Rule::unique('users')->ignore($customer->user_id)],
        //     "password" => 'nullable|string|min:6|max:255',
        // ]);

        // if ($validator->fails()) {
        //     return back()
        //     ->withErrors($validator)
        //     ->withInput();
        // }

        // dd($request->all());

        $model->customer_id = $request->customer_id;
        $model->blawbno = $request->blawbno;
        $model->lcbtitno = $request->lcbtitno;
        $model->description = $request->description;
        $model->invoice_value = $request->invoice_value;
        $model->currency = $request->currency;
        $model->machine_number = $request->machine_number;
        $model->your_ref = $request->your_ref;
        $model->port = $request->port;
        $model->eiffino = $request->eiffino;
        $model->import_exporter_messers = $request->import_exporter_messers;
        $model->consignee_by_to = $request->consignee_by_to;
        $model->freight = $request->freight;
        $model->ins_rs = $request->ins_rs;
        $model->us = $request->us;
        $model->lc_no = $request->lc_no;
        $model->vessel = $request->vessel;
        $model->igmno = $request->igmno;
        $model->port_of_shippment = $request->port_of_shippment;
        $model->country_origion = $request->country_origion;
        $model->rate_of_exchange = $request->rate_of_exchange;
        $model->master_agent = $request->master_agent;
        $model->due_date = $request->due_date;
        $model->gross = $request->gross;
        $model->nett = $request->nett;
        $model->save();


        return back()->with('success','Record Updated');

    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {

        $data = Consignment::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{
            $data->delete();
            return response()->json(['message' => 'Record Not Deleted'],200);
        }


    }


    
}

