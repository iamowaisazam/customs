<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\OrderStatus;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\ProductCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;
use Collator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Laravel\Ui\Presets\React;

class OrderController extends Controller
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

            $query = Order::Leftjoin('payment_methods','payment_methods.id','=','orders.payment_method')
            ->leftJoin('order_status', 'order_status.id', '=', 'orders.order_status');

            if($request->id){
                $query->where('id',$request->id);
            }

            if($request->order_status){
                $query->where('order_status.id',$request->order_status);
            }

            if($request->payment_status){
                $query->where('payment_status',$request->payment_status);
            }

            if($request->tracking_id){
                $query->where('tracking_id',$request->tracking_id);
            }

            if($request->fullname){
                $query->where('customer_name','like','%'.$request->fullname.'%');
            }

            if($request->phone){
                $query->where('customer_phone','like','%'.$request->phone.'%');
            }

            if($request->payment_status){
                $query->where('payment_status',$request->payment_status);
            }

            if($request->grand_total){
                $query->where('grand_total',$request->grand_total);
            }

            $count = $query->select([
                'orders.*',
                'payment_methods.title'
            ])->get();

            $records = $query->skip($request->start)
            ->take($request->length)->orderBy('id','desc')
            ->get();
            
            $data = [];
            foreach ($records as $key => $value) {

                $status = OrderStatus::where('id', $value->order_status)->first();
                $track = '<a class="" target="_blank" href="'.URL::to('/order-confirmaton/'.$value->tracking_id).'">'.$value->tracking_id.'</a>';
                $action = '<a class="" href="'.URL::to('admin/orders/edit/'.Crypt::encryptString($value->id)).'">#'.$value->id.'</a>';

                array_push($data,[
                    $action,
                    $status ? $status->title :'',
                    $value->payment_status,  
                    $track,  
                    $value->customer_name,
                    $value->customer_phone,
                    $value->title,
                    'PKR '.$value->grandtotal,                          
                 ]
                );
            }

            return response()->json([
                "draw" => $request->draw,
                "recordsTotal" => count($count),
                "recordsFiltered" => count($count),
                'data'=> $data,
            ]);
        }
        
        $category = Category::all();
        $orderStatus = OrderStatus::all();
        $payment_methods = PaymentMethod::where('is_enable',1)->get();    
        return view('admin.orders.index',compact('category','payment_methods','orderStatus'));
    }

    
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {
        
        $id = Crypt::decryptString($id);
        $data = Order::find($id);
        if($data == false){  
            return back()->with('error','Record Not Found');
        }
        
        $payment_methods = PaymentMethod::where('is_enable',1)->get();    
        $status = OrderStatus::all();
        // dd($status);

        return view('admin.orders.edit',compact('data','payment_methods','status'));
    }



     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {

        // dd($request->all());

        
        // $id = Crypt::decryptString($id);

        $validator = Validator::make($request->all(), [
            "customer_name" => "required",
            "customer_phone" => "required",
            // "customer_email" => "required",
            "country" => "required",
            "city" => "required",
            // "address" => "required",
            "tracking_id" => "required",
            "order_status" => "required",
            "payment_method" => "required",
            "payment_status" => "required",
            // "order_notes" => "required",
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $model = Order::find($id);
        if($model == false){  
           return back()->with('error','Record Not Found');
        }

        $model->customer_name = $request->customer_name;
        $model->customer_phone = $request->customer_phone;
        $model->customer_email = $request->customer_email;
        $model->country = $request->country;
        $model->city = $request->city;
        $model->address = $request->address;
        $model->tracking_id = $request->tracking_id;
        $model->order_status = $request->order_status;
        $model->payment_method = $request->payment_method;
        $model->payment_status = $request->payment_status;
        $model->order_notes = $request->order_notes;
        $model->customer_notes = $request->customer_notes;
        $model->save();

        return back()->with('success','Record Updated');

    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function delete($id)
    {
        $product = Product::find(Crypt::decryptString($id));

        if($product == false){
            return back()->with('warning','Record Not Found');
        }else{
            ProductCollection::where('product_id',$product->id)->delete();
            $product->delete();
            return redirect('/admin/products/index')->with('success','Record Deleted Success'); 
        }

    }

    



 

    
    
}
