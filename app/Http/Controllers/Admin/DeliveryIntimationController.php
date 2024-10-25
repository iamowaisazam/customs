<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Currency;
use App\Http\Controllers\Controller;
use App\Models\Challan;
use App\Models\Consignment;
use App\Models\Customer;
use App\Models\DeliveryIntimation;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Utilities\ConsigmentUtility;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Mpdf\Tag\Select;

class DeliveryIntimationController extends Controller
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

            $query = DeliveryIntimation::
            join('delivery_challans','delivery_challans.id','=','delivery_intimations.challan_id')
            ->join('consignments','consignments.id','=','delivery_challans.consignment_id')
            ->join('customers','customers.id','=','delivery_challans.customer_id');

            //Search
            if($request->has('status') && $request->status != ''){
                $query->where('delivery_intimations.status',$request->status);
            }

            if($request->has('job_number') && $request->job_number != ''){
                $query->where('consignments.job_number',explode('/',$request->job_number)[0]);
            }

            if($request->has('company_name') && $request->company_name != ''){
                $query->where('customers.company_name','like','%'.$request->company_name.'%');
            }

            if($request->has('customer_name') && $request->customer_name != ''){
                $query->where('customers.customer_name','like','%'.$request->customer_name.'%');
            }

            if($request->has('lc_no') && $request->lc_no != ''){
                $query->where('consignments.lc_no',$request->lc_no);
            }

            
            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('customers.customer_name','like','%'.$search.'%')
                   ->orwhere('customers.company_name','like','%'.$search.'%')
                   ->orwhere('consignments.lc_no','like','%'.$search.'%');                   
               });
            }
            
            $count = $query->count();
            
            
            $users = $query->skip($request->start)
            ->select([
                'delivery_intimations.*',
                'consignments.job_number_prefix',
                'consignments.invoice_value',
                'consignments.lc_no',
                'customers.customer_name',
                'customers.company_name',
            ])
            ->take($request->length)
            ->orderBy('delivery_intimations.id','desc')
            ->get();


            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';

                    $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/delivery-intimations/'.Crypt::encryptString($value->id)).'">View</a>';
                    
                    $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('admin/delivery-intimations/'.Crypt::encryptString($value->id)).'">Delete</a>';

                $action .= '</div>';

                $status = $value->status ? 'checked' : '';
                

                array_push($data,[
                    $value->id,
                    date('d-m-Y', strtotime($value->created_at)),
                    $value->job_number_prefix,
                    $value->company_name,
                    $value->customer_name,
                    $value->invoice_value,
                    $value->lc_no,
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

        return view('admin.delivery-intimations.index');

    }

    


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create()
    {

        if(request()->job_number != ''){

            $consignment = Consignment::where('job_number_prefix',request()->job_number)->first();

            if(!$consignment){
                return back()->with('warning','Consigment Not Found');
            }

            if(!$consignment->challan){
                return back()->with('warning','Challan Not Generated');
            }

            if($consignment->challan->intimation){
                return back()->with('warning','Intimation Already Generated');
            }


            $data = [
                'model' => $consignment,
            ];
            
            return view('admin.delivery-intimations.create',$data);
        }
      

        return view('admin.delivery-intimations.create');
       
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function store(Request $request)
    {

       $challan = DeliveryIntimation::create([
            // "consignment_id" => $request->consignment_id, 
            "challan_id" => $request->challan_id, 
            "message" => $request->message,
            'status' => 1,
            'created_by' => Auth::user()->id,
        ]);

        return redirect('/admin/delivery-intimations')->with('success','Record Created Success'); 
    }

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {
       
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function show(Request $request,$id)
    {

        $model = DeliveryIntimation::find(Crypt::decryptString($id));
        if($model == false){  
          return back()->with('error','Record Not Found');
        }

        $data = [
            'model' => $model,
        ];

        return view('admin.delivery-intimations.print',$data);
  
    }



     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {
       

    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {

        $data = DeliveryIntimation::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{
            $data->delete();
            return response()->json(['message' => 'Record Not Deleted'],200);
        }


    }


    
}

