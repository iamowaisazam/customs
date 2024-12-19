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
use App\Models\Role;
use App\Models\Setting;
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

            $query = Consignment::join('customers','customers.id','=','consignments.customer_id');

            //Search
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
                $query->where('consignments.created_at','>=',$request->sdate);
            }

            if($request->has('edate') && $request->edate != ''){
                $query->where('consignments.created_at','<=',$request->edate);
            }
            
            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('customers.customer_name','like','%'.$search.'%')
                   ->orwhere('customers.company_name','like','%'.$search.'%')
                   ->orwhere('consignments.lc','like','%'.$search.'%')
                   ->orwhere('consignments.job_number_prefix','like','%'.$search.'%'); 
               });
            }
            
            $count = $query->count();
            $users = $query->skip($request->start)
            ->select([
                'consignments.*',
                'customers.customer_name',
                'customers.company_name',
            ])
            ->take($request->length)
            ->orderBy('consignments.id','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';

                if(Auth::user()->permission('consignments.edit')){
                  $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/consignments/'.Crypt::encryptString($value->id)).'/edit">Edit</a>';
                }

                if(Auth::user()->permission('consignments.view')){
                  $action .= '<a class="mx-1 btn btn-success" href="'.URL::to('/admin/consignments/'.Crypt::encryptString($value->id)).'">View</a>';
                }

                if(Auth::user()->permission('consignments.print')){
                  $action .= '<a class="mx-1 btn btn-primary" href="'.URL::to('/admin/consignments/print/'.Crypt::encryptString($value->id)).'">Print</a>';
                }
                
                if(Auth::user()->permission('consignments.delete')){
                     $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('admin/consignments/'.Crypt::encryptString($value->id)).'">Delete</a>';
                }

                $action .= '</div>';

                $status = $value->status ? 'checked' : '';

                array_push($data,[
                    $value->id,
                    $value->job_number_prefix,
                    $value->customer->company_name,
                    $value->customer->customer_name,
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

        return view('admin.consignments.index');
    }

  

   

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {

        if($id == 'create'){
            $model = null;

            if(!Auth::user()->permission('consignments.create')){
                return back()->with('warning','You Dont Have Access');
            }

        }else{

            if(!Auth::user()->permission('consignments.edit')){
                return back()->with('warning','You Dont Have Access');
            }

            $model = Consignment::find(Crypt::decryptString($id));
            if($model == false){  
                return back()->with('error','Record Not Found');
             }
        }

         $data = [
            'customers' => Customer::where('status',1)->get(),
            'model' => $model,
            'currencies' => Currency::DATA,
            'package_types' => PackageType::DATA,
            'units' => array_values(Unit::DATA),
            'job_number' => ConsigmentUtility::get_job_number_with_prefix(),
            'pod' => Setting::get_pod(),
            'pol' => Setting::get_pol(),
            'documents' => Setting::get_documents(),
            'vessels' => Setting::get_vessels(),
        ];

        return view('admin.consignments.edit',$data);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            "job_number" => 'required|max:255',
            "customer_id" => 'required|max:255',
            "exporter" => 'required|max:255',
            "currency" => 'required|max:255',
            "data" => 'required',
       ]);

        if ($validator->fails()) {
          return back()
            ->withErrors($validator)
            ->withInput();
        }


        if($id == 'create'){

            if(!Auth::user()->permission('consignments.create')){
                return back()->with('warning','You Dont Have Access');
            }

            $model = new Consignment();
            $model->customer_id = $request->customer_id;
            $model->job_number = ConsigmentUtility::get_job_number();
            $model->job_number_prefix = ConsigmentUtility::get_job_number_with_prefix();
            $model->save();


        }else{

            if(!Auth::user()->permission('consignments.edit')){
                return back()->with('warning','You Dont Have Access');
            }

            $id = Crypt::decryptString($id);
            $model = Consignment::find($id);
            if($model == false){  
              return back()->with('error','Record Not Found');
            }
        }

        
        $model->customer_id = $request->customer_id; 
        $model->exporter = $request->exporter;
        $model->description = $request->description;
        $model->currency = $request->currency;


        if($id != 'create'){
            
            $model->po_number        = $request->po_number;
            $model->machine_number   = $request->machine_number;
            $model->pol              = $request->pol;
            $model->pod              = $request->pod;
            $model->eiffino          = $request->eiffino;
            $model->freight          = $request->freight;
            $model->insurance_in_fc  = $request->insurance_in_fc;
            $model->insurance_in_pkr = $request->insurance_in_pkr;
            $model->lc               = $request->lc;
            $model->lc_date          = $request->lc_date;
            $model->vessel           = $request->vessel;
            $model->igmno            = $request->igmno;
            $model->igm_date         = $request->igm_date;
            $model->index_no         = $request->index_no;
            $model->blawbno          = $request->blawbno;
            $model->blawb_date       = $request->blawb_date;
            $model->country_origion  = $request->country_origion;
            $model->rate_of_exchange = $request->rate_of_exchange;
            $model->master_agent     = $request->master_agent;
            $model->freight_agent    = $request->freight_agent;
            $model->arival_date      = $request->arival_date;
            $model->package_type     = $request->package_type;
            $model->no_of_packages   = $request->no_of_packages;
            $model->shipment_number  = $request->shipment_number;
            $model->mode_of_shipment = $request->mode_of_shipment;
            $model->gross            = $request->gross ?? 0;
            $model->net              = $request->net ?? 0;
            $model->remarks          = $request->remarks;

            $model->documents = $request->documents ? json_encode($request->documents) : null;
        
       }
        
        $model->status = 1;
        $model->created_by = Auth::user()->id;
        $model->save();



        $qty = 0;
        $total = 0; 
        if(!empty($request->data)){
            $ids = array_column($request->data,'id');
            foreach($request->data as $key => $item){
                if($item['id']){
                    ConsignmentItem::where('id',$item['id'])->update([
                        'consignment_id' => $model->id,
                        'name' => $item['name'],
                        'hs_code' => $item['hs_code'],
                        'price' => $item['price'],
                        'qty' => $item['qty'],
                        'unit' => $item['unit'],
                        'total' => $item['qty'] * $item['price'],
                    ]);
                }else{
                   $new_record = ConsignmentItem::create([
                        'consignment_id' => $model->id,
                        'name' => $item['name'],
                        'hs_code' => $item['hs_code'],
                        'price' => $item['price'],
                        'qty' => $item['qty'],
                        'unit' => $item['unit'],
                        'total' => $item['qty'] * $item['price'],
                    ]);
                    array_push($ids,$new_record->id);
                }
                $qty += $item['qty'];
                $total += $item['qty'] * $item['price'];
            }
    
            ConsignmentItem::where('consignment_id',$model->id)->whereNotIn('id',$ids)->delete();
        }else{
            ConsignmentItem::where('consignment_id',$model->id)->delete();
        }

        $model->invoice_value = $total;
        $model->total_quantity = $qty;
        $model->save();


        // dd($request->all());

        return redirect()->to('admin/consignments/'.Crypt::encryptString($model->id).'/edit')
        ->with('success','Record Updated');

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function show(Request $request,$id)
    {
        if(!Auth::user()->permission('consignments.view')){
            return back()->with('warning','You Dont Have Access');
        }

        $model = Consignment::find(Crypt::decryptString($id));
        if($model == false){  
          return back()->with('error','Record Not Found');
        }

        $data = [
            'customers' => Customer::where('status',1)->get(),
            'model' => $model,
            'currencies' => Currency::DATA,
            'package_types' => PackageType::DATA,
            'units' => array_values(Unit::DATA),
            'job_number' => ConsigmentUtility::get_job_number_with_prefix(),
        ];

        return view('admin.consignments.view',$data);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function print(Request $request,$id)
    {
        if(!Auth::user()->permission('consignments.print')){
            return back()->with('warning','You Dont Have Access');
        }

        $model = Consignment::find(Crypt::decryptString($id));
        if($model == false){  
          return back()->with('error','Record Not Found');
        }

        $data = [
            'customers' => Customer::where('status',1)->get(),
            'currencies' => Currency::DATA,
            'model' => $model,
            'units' => array_values(Unit::DATA),
            'job_number' => ConsigmentUtility::get_job_number_with_prefix(),
        ];
        return view('admin.consignments.prints.print',$data);
    }


    

     


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {
        if(!Auth::user()->permission('consignments.delete')){
            return back()->with('warning','You Dont Have Access');
        }

        $data = Consignment::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{
            $data->delete();
            return response()->json(['message' => 'Record Not Deleted'],200);
        }


    }


    
}

