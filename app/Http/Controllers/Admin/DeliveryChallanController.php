<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Currency;
use App\Http\Controllers\Controller;
use App\Models\Challan;
use App\Models\Consignment;
use App\Models\Customer;
use App\Models\Payorder;
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

class DeliveryChallanController extends Controller
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

            $query = Challan::join('payorders','payorders.id','=','delivery_challans.payorder_id')
            ->join('consignments','consignments.id','=','payorders.consignment_id')
            ->join('customers','customers.id','=','consignments.customer_id');

            //Search
            if($request->has('status') && $request->status != ''){
                $query->where('delivery_challans.status',$request->status);
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

            if($request->has('lc') && $request->lc != ''){
                $query->where('consignments.lc',$request->lc_no);
            }

            if($request->has('sdate') && $request->sdate != ''){
                $query->where('delivery_challans.created_at','>=',$request->sdate);
            }

            if($request->has('edate') && $request->edate != ''){
                $query->where('delivery_challans.created_at','<=',$request->edate);
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
                'delivery_challans.*',
                'consignments.job_number_prefix',
                'consignments.invoice_value',
                'consignments.lc',
                'customers.customer_name',
                'customers.company_name',
            ])
            ->take($request->length)
            ->orderBy('delivery_challans.id','desc')
            ->get();

            // dd($users->toArray());

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/delivery-challans/'.Crypt::encryptString($value->id)).'">Print</a>';

                $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('admin/delivery-challans/'.Crypt::encryptString($value->id)).'">Delete</a>';
                $action .= '</div>';

                $status = $value->status ? 'checked' : '';

                array_push($data,[
                    $value->id,
                    date('d-m-Y', strtotime($value->created_at)),
                    $value->job_number_prefix,
                    $value->company_name,
                    $value->customer_name,
                    $value->invoice_value,
                    $value->lc,
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

        return view('admin.delivery-challans.index');

    }

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function store(Request $request)
    {

        if(!Auth::user()->permission('delivery-challans.create')){
            return back()->with('warning','You Dont Have Access');
        }

        $model = Payorder::find($request->payorder);
        if($model == false){  
         return back()->with('error','Record Not Found');
        }

        if(Challan::where('payorder_id',$model->id)->count() > 0){
            return back()->with('error','Already Generated');
        }

       $challan = Challan::create([
            "payorder_id" => $model->id,
            'status' => 1,
            'created_by' => Auth::user()->id,
        ]);

        return redirect('/admin/delivery-challans/'.Crypt::encryptString($challan->id))
        ->with('success','Record Created Success'); 
        
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function show(Request $request,$id)
    {
        if(!Auth::user()->permission('delivery-challans.print')){
            return back()->with('warning','You Dont Have Access');
        }

        $model = Challan::find(Crypt::decryptString($id));
        if($model == false){  
          return back()->with('error','Record Not Found');
        }

        $data = [
            'model' => $model,
        ];

        return view('admin.delivery-challans.print',$data);
    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {
        if(!Auth::user()->permission('delivery-challans.delete')){
            return back()->with('warning','You Dont Have Access');
        }

        $data = Challan::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{
            $data->delete();
            return response()->json(['message' => 'Record Not Deleted'],200);
        }

    }


}
