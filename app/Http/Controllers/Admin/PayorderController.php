<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Currency;
use App\Enums\PackageType;
use App\Enums\Unit;
use App\Http\Controllers\Controller;
use App\Models\Consignment;
use App\Models\Customer;
use App\Models\Exporter;
use App\Models\Payorder;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Utilities\ConsigmentUtility;
use App\Utilities\PayorderUtility;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Mpdf\Tag\Select;

class PayorderController extends Controller
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

            $query = Payorder::Leftjoin('consignments','consignments.id','=','payorders.consignment_id')
            ->join('customers','customers.id','=','consignments.customer_id');

            //Search
            if($request->has('status') && $request->status != ''){
                $query->where('consignments.status',$request->status);
            }

            if($request->has('job_number') && $request->job_number != ''){
                $query->where('consignments.job_number_prefix',$request->job_number);
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
                'payorders.*',
                'consignments.job_number_prefix',
                'consignments.invoice_value',
                'consignments.lc_no',
                'customers.customer_name',
                'customers.company_name',
            ])
            ->take($request->length)
            ->orderBy('payorders.id','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/payorders/'.Crypt::encryptString($value->id)).'/edit">Edit</a>';

                $action .= '<a class="mx-1 btn btn-success" href="'.URL::to('/admin/payorders/'.Crypt::encryptString($value->id)).'">Print</a>';

                $action .= '<a class="mx-1 btn btn-primary" href="'.URL::to('/admin/payorders/view/'.Crypt::encryptString($value->id)).'">View</a>';
                
                $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('admin/consignments/'.Crypt::encryptString($value->id)).'">Delete</a>';

                $action .= '</div>';

                $status = $value->status ? 'checked' : '';

                array_push($data,[
                    $value->id,
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


        $consignments = Consignment::all();


        return view('admin.payorders.index',compact('consignments'));

    }

    


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create(Request $request)
    {

        $model = Consignment::where('id',$request->consignment_id)->first();
        if($model == false){  
            return back()->with('error','Record Not Found');
        }

        if(Payorder::where('consignment_id',$request->consignment_id)->first()){
            return back()->with('error','Payorder Already Generated');
        }


        $model = Payorder::create([
            "consignment_details" => json_encode([]),
            "date" => Carbon::now(),
            "consignment_id" => $request->consignment_id,
            "items" => json_encode([]),
            "footer" => json_encode([]),
            "created_by" => User::where('status',1)->where('role_id',2)->inRandomOrder()->first()->id,
        ]);

        return redirect('admin/payorders/'.Crypt::encryptString($model->id).'/edit');

    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function store(Request $request)
    {
       
    }

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {
        
        $model = PayOrder::find(Crypt::decryptString($id));
        if($model == false){  
            return back()->with('error','Record Not Found');
         }

         $data = [
            'customers' => Customer::where('status',1)->get(),
            'model' => $model,
            'currencies' => Currency::DATA,
            'package_types' => PackageType::DATA,
            'units' => array_values(Unit::DATA),
            'exporters' => Exporter::where('status',1)->get(),
        ];

        return view('admin.payorders.edit',$data);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {

        // dd($request->all());

        $id = Crypt::decryptString($id);
        $model = Payorder::find($id);
        if($model == false){  
           return back()->with('error','Record Not Found');
        }

    
        $model->date = Carbon::now();
        $model->consignment_id = $request->consignment_id;
        $model->items = json_encode($request->items);
        $model->footer = json_encode($request->footer);
        $model->created_by = Auth::user()->id;
        $model->consignment_details = json_encode([]);
        $model->save();
    

      

        return back()->with('success','Record Updated');

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function show(Request $request,$id)
    {

        $model = Consignment::find(Crypt::decryptString($id));
        if($model == false){  
          return back()->with('error','Record Not Found');
        }

        $data = [
            'model' => $model,
        ];

        return view('admin.consignments.prints.print',$data);

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function view(Request $request,$id)
    {

        $model = Consignment::find(Crypt::decryptString($id));
        if($model == false){  
          return back()->with('error','Record Not Found');
        }

        $data = [
            'model' => $model,
        ];

        return view('admin.consignments.view',$data);

    }


    


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {

        $data = Payorder::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{
            $data->delete();
            return response()->json(['message' => 'Record Not Deleted'],200);
        }


    }


    
}

