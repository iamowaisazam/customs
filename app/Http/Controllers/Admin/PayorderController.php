<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Currency;
use App\Enums\PackageType;
use App\Enums\Unit;
use App\Http\Controllers\Controller;
use App\Models\Consignment;
use App\Models\ConsignmentItem;
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

            $query = Payorder::join('consignments','consignments.id','=','payorders.consignment_id')
            ->join('customers','customers.id','=','consignments.customer_id');

            
            if($request->has('status') && $request->status != ''){
                $query->where('consignments.status',$request->status);
            }

            if($request->has('job_number') && $request->job_number != ''){
                $query->where('consignments.job_number_prefix',$request->job_number);
            }

            if($request->has('customer') && $request->customer != ''){
                $query->where('customers.id','like','%'.$request->customer.'%');
            }

            if($request->has('lc') && $request->lc != ''){
                $query->where('consignments.lc',$request->lc);
            }

            if($request->has('sdate') && $request->sdate != ''){
                $query->where('payorders.created_at','>=',$request->sdate);
            }

            if($request->has('edate') && $request->edate != ''){
                $query->where('payorders.created_at','<=',$request->edate);
            }

            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('customers.customer_name','like','%'.$search.'%')
                   ->orwhere('customers.company_name','like','%'.$search.'%')
                   ->orwhere('consignments.lc','like','%'.$search.'%');                   
               });
            }
            
            $count = $query->count();
            $users = $query->skip($request->start)
            ->select([
                'payorders.*',
                'consignments.job_number_prefix',
                'consignments.invoice_value',
                'consignments.lc',
                'customers.customer_name',
                'customers.company_name',
            ])
            ->take($request->length)
            ->orderBy('payorders.id','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';

                if(Auth::user()->permission('payorders.edit')){
                 $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/payorders/'.Crypt::encryptString($value->id)).'/edit">Edit</a>';
                }

                if(Auth::user()->permission('payorders.print')){
                $action .= '<a class="mx-1 btn btn-success" href="'.URL::to('/admin/payorders/print/'.Crypt::encryptString($value->id)).'">Print</a>';
                }

                if(Auth::user()->permission('payorders.view')){
                $action .= '<a class="mx-1 btn btn-primary" href="'.URL::to('/admin/payorders/'.Crypt::encryptString($value->id)).'">View</a>';
                }

                if(Auth::user()->permission('payorders.delete')){
                $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('admin/payorders/'.Crypt::encryptString($value->id)).'">Delete</a>';
                }

                $action .= '</div>';

                $status = $value->status ? 'checked' : '';

                array_push($data,[
                    $value->id,
                    $value->job_number_prefix,
                    $value->company_name,
                    $value->customer_name,
                    $value->invoice_value,
                    $value->lc,
                    date('d-m-Y', strtotime($value->created_at)),
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

        $data  = [];
        return view('admin.payorders.index',$data);

    }

    public function create(Request $request)
    {

        $model = Consignment::where('job_number_prefix',$request->consignment)->first();
        if($model == false){  
            return back()->with('error','Record Not Found');
        }

        if(Payorder::where('consignment_id',$model->id)->first()){
            return back()->with('error','Payorder Already Generated');
        }
        
        $model = Payorder::create([
            "consignment_details" => json_encode([]),
            "date" => Carbon::now(),
            "consignment_id" => $model->id,
            "header" => json_encode([]),
            "items" => json_encode([]),
            "footer" => json_encode([]),
            "created_by" => Auth::user()->id,
        ]);

        return redirect('admin/payorders/'.Crypt::encryptString($model->id).'/edit')->with('success','Payorder Generated Successfully');

    }



     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {
        if(!Auth::user()->permission('payorders.edit')){
            return back()->with('warning','You Dont Have Access');
        }
        
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
        if(!Auth::user()->permission('payorders.edit')){
            return back()->with('warning','You Dont Have Access');
        }

        $id = Crypt::decryptString($id);
        $model = Payorder::find($id);
        if($model == false){  
           return back()->with('error','Record Not Found');
        }

        foreach ($request->items as $value) {
            ConsignmentItem::where('id',$value['id'])->update([
                'custom_duty' => $value['custom_duty'],
                'a_custom_duty' => $value['a_custom_duty'],
                'rd' => $value['rd'],
                'it' => $value['it'],
                'saletax' => $value['saletax'],
                'a_saletax' => $value['a_saletax'],
                'eto' => $value['eto'],
                'after_duties'=> $value['after_duties']
            ]);
        }
    
        $model->date = Carbon::now();
        $model->consignment_id = $request->consignment_id;
        $model->stan_duty = $request->stan_duty;
        $model->psw_fee = $request->psw_fee;
        $model->drap_fee = $request->drap_fee;

        $model->header = json_encode($request->header ?? []);
        $model->footer = json_encode($request->footer ?? []);

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
        if(!Auth::user()->permission('payorders.view')){
            return back()->with('warning','You Dont Have Access');
        }

        $model = Payorder::find(Crypt::decryptString($id));
        if($model == false){  
          return back()->with('error','Record Not Found');
        }

        $data = [
            'customers' => Customer::where('status',1)->get(),
            'model' => $model,
            'currencies' => Currency::DATA,
            'package_types' => PackageType::DATA,
            'units' => array_values(Unit::DATA),
        ];

        return view('admin.payorders.view',$data);

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function print(Request $request,$id)
    {
        if(!Auth::user()->permission('payorders.print')){
            return back()->with('warning','You Dont Have Access');
        }

        $model = Payorder::find(Crypt::decryptString($id));
        if($model == false){  
          return back()->with('error','Record Not Found');
        }

        $data = [
            'customers' => Customer::where('status',1)->get(),
            'model' => $model,
            'currencies' => Currency::DATA,
            'package_types' => PackageType::DATA,
            'units' => array_values(Unit::DATA),
        ];

        return view('admin.payorders.print',$data);

    }


    


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {
        if(!Auth::user()->permission('payorders.delete')){
            return back()->with('warning','You Dont Have Access');
        }

        $data = Payorder::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{
            $data->delete();
            return response()->json(['message' => 'Record Not Deleted'],200);
        }

    }


    
}

