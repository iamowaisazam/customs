<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;


class ReportsController extends Controller
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
    public function clientIndex(Request $request)
    {

    
        if($request->ajax()){

            $query = Order::Query();
            if($request->name){
                $query->where('customer_name','like','%'.$request->name.'%');
            }
            if($request->email){
                $query->where('customer_email',$request->email);
            }
            if($request->phone){
                $query->where('customer_phone','like','%'.$request->phone.'%');
            }
            if($request->address){
                $query->where('address','like','%'.$request->address.'%');
            }
            if($request->orderNumber){
                $query->where('id',$request->orderNumber);
            }
            if($request->totalAmount ){
                $query->where('grandtotal', 'like', '%' . $request->totalAmount . '%');
            }
            if ($request->startDate && $request->endDate) {
                $query->whereBetween('created_at', [$request->startDate, $request->endDate]);
            }
            
            if ($request->paymentMethod) {
                $query->where('payment_method', 'like', '%' . $request->paymentMethod . '%');
            }
            if($request->orderStatus){
                $query->where('order_status',$request->orderStatus);
            }
            if($request->paymentStatus){
                $query->where('payment_status',$request->paymentStatus);
            }

            $query = $query->orderBy('id', 'desc');
            $count = $query->get();
            
            $records = $query->skip($request->start)
            ->take($request->length)
            ->get();
            
            $data = [];
            foreach ($records as $key => $value) {
                $staus=OrderStatus::where('id',$value->order_status)->first();
                $PaymentMethod=PaymentMethod::where('id',$value->payment_method)->first();
                $track = '<a class="" target="_blank" href="'.URL::to('/order-confirmaton/'.$value->tracking_id).'">'.$value->tracking_id.'</a>';


                $action = '<a class="" href="'.URL::to('admin/orders/edit/'.Crypt::encryptString($value->id)).'">#'.$value->id.'</a>';

                array_push($data,[
                    $action,
                    $value->created_at->format('Y-m-d'),
                    $value->customer_name,
                    $value->customer_email,
                    $value->customer_phone,
                    $value->address,
                    // $track,  
                    // $action,
                    $staus ? $staus->title :'',
                    $PaymentMethod ? $PaymentMethod->title :'',
                    // str_replace('_', ' ',$value->payment_method),
                    $value->payment_status,  
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
        $status = OrderStatus::all();  
        $PaymentMethod = PaymentMethod::all();     
        return view('admin.reports.clients.index',compact('category','status','PaymentMethod'));
    }

    


    public function productIndex(Request $request)
    {

        if($request->ajax()){

            $query = Order::Query();
            if($request->name){
                $query->where('customer_name','like','%'.$request->name.'%');
            }
            if($request->email){
                $query->where('customer_email',$request->email);
            }
            if($request->phone){
                $query->where('customer_phone','like','%'.$request->phone.'%');
            }
            if($request->address){
                $query->where('address','like','%'.$request->address.'%');
            }
            if($request->orderNumber){
                $query->where('id',$request->orderNumber);
            }
            if($request->totalAmount ){
                $query->where('grandtotal', 'like', '%' . $request->totalAmount . '%');
            }
            if ($request->startDate && $request->endDate) {
                $query->whereBetween('created_at', [$request->startDate, $request->endDate]);
            }
            
            if ($request->paymentMethod) {
                $query->where('payment_method', 'like', '%' . $request->paymentMethod . '%');
            }
            if($request->orderStatus){
                $query->where('order_status',$request->orderStatus);
            }
            if($request->paymentStatus){
                $query->where('payment_status',$request->paymentStatus);
            }

            $query = $query->orderBy('id', 'desc');
            $count = $query->get();
            
            $records = $query->skip($request->start)
            ->take($request->length)
            ->get();
            
            $data = [];
            foreach ($records as $key => $value) {
                $staus=OrderStatus::where('id',$value->order_status)->first();
                $track = '<a class="" target="_blank" href="'.URL::to('/order-confirmaton/'.$value->tracking_id).'">'.$value->tracking_id.'</a>';


                $action = '<a class="" href="'.URL::to('admin/reports/clients/edit/'.Crypt::encryptString($value->id)).'">#'.$value->id.'</a>';

                array_push($data,[
                    $action,
                    $value->created_at->format('Y-m-d'),
                    $value->customer_name,
                    $value->customer_email,
                    $value->customer_phone,
                    $value->address,
                    // $track,  
                    // $action,
                    $staus ? $staus->title :'',
                    str_replace('_', ' ',$value->payment_method),
                    $value->payment_status,  
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
        return view('admin.reports.product.index',compact('category'));
    }
    public function inventoryIndex(Request $request)
    {
        
        if($request->ajax()){
            $query = Order::Query();
            
            
            if($request->name){
                $query->where('customer_name','like','%'.$request->name.'%');
            }
            if($request->email){
                $query->where('customer_email',$request->email);
            }
            if($request->phone){
                $query->where('customer_phone','like','%'.$request->phone.'%');
            }
            if($request->address){
                $query->where('address','like','%'.$request->address.'%');
            }
            if($request->orderNumber){
                $query->where('id',$request->orderNumber);
            }
            if($request->totalAmount ){
                $query->where('grandtotal', 'like', '%' . $request->totalAmount . '%');
            }
            if ($request->startDate && $request->endDate) {
                $query->whereBetween('created_at', [$request->startDate, $request->endDate]);
            }
            
            if ($request->paymentMethod) {
                $query->where('payment_method', 'like', '%' . $request->paymentMethod . '%');
            }
            if($request->orderStatus){
                $query->where('order_status',$request->orderStatus);
            }
            if($request->paymentStatus){
                $query->where('payment_status',$request->paymentStatus);
            }

            $query = $query->orderBy('id', 'desc');
            $count = $query->get();
            
            $records = $query->skip($request->start)
            ->take($request->length)
            ->get();
            
            $data = [];
            foreach ($records as $key => $value) {
                $staus=OrderStatus::where('id',$value->order_status)->first();
                $track = '<a class="" target="_blank" href="'.URL::to('/order-confirmaton/'.$value->tracking_id).'">'.$value->tracking_id.'</a>';


                $action = '<a class="" href="'.URL::to('admin/reports/clients/edit/'.Crypt::encryptString($value->id)).'">#'.$value->id.'</a>';

                array_push($data,[
                    $action,
                    $value->created_at->format('Y-m-d'),
                    $value->customer_name,
                    $value->customer_email,
                    $value->customer_phone,
                    $value->address,
                    // $track,  
                    // $action,
                    $staus ? $staus->title :'',
                    str_replace('_', ' ',$value->payment_method),
                    $value->payment_status,  
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
        return view('admin.reports.inventory.index',compact('category'));
    }


}