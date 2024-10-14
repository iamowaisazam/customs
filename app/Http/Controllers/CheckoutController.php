<?php

namespace App\Http\Controllers;

use App\Http\Utilities\EmailUtility;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Cart;
use App\Models\Value;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\Variation;
use App\Models\VariationAttribute;
use App\Models\Slider;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Mpdf\Mpdf;


class CheckoutController extends Controller
{


    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        

    }


      /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $cart = Cart::get_cart_details();
        if(count($cart['cart_items']) == 0){
            return back()->with('error','Cart Is Empty');
        }

        $PaymentMethods = PaymentMethod::where('is_enable',1)->get();
        return view('theme.checkout',compact('cart','PaymentMethods'));
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function checkout_submit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "name" => 'required|max:255',
            "phone" => 'required|max:255',
            "email" => 'required|email',
            "country" => 'required|max:255',
            "city" => 'required|max:255',
            "address" => 'required|max:255',
            "payment_method" => 'required|integer',
            "order_notes" => 'max:500',
        ]);

        if ($validator->fails()) {
             return back()
                ->withErrors($validator)
                ->withInput();
        }

        // dd($request->all());

        $tracking_id = uniqid();
        $cart = Cart::get_cart_details();

        // DB::beginTransaction();
        // try {
            $status = OrderStatus::where('id', 1)->first();

        $order = Order::create([
                'customer_name' => $request->name,
                'customer_email'  => $request->email,
                'customer_phone'  => $request->phone,
                'country'  => $request->country,
                'city'  => $request->city,
                'customer_notes'  => $request->order_notes,
                'address'  => $request->address,
                'payment_method'  => $request->payment_method,
                'payment_status'  => 'unpaid',
                'tracking_id' => $tracking_id,
                'order_status'  => $status->id,
                'subtotal'  => $cart['subtotal'],
                'delivery_charges'  => $cart['delivery_charges'],
                'grandtotal'  => $cart['grand_total'],
                'is_enable'  => 1,
            ]);
         
     
            foreach ($cart['cart_items'] as $cart_item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'variation_id' => $cart_item['variation_id'],
                    'title' => $cart_item['title'],
                    'sku' => $cart_item['sku'],
                    'attr' => json_encode($cart_item['attributes']),
                    'image_id' => $cart_item['image'],
                    'quantity' => $cart_item['cart_qty'],
                    'price' => $cart_item['price'],
                    'total' => $cart_item['total'],
                ]);
            }

        
            // EmailUtility::send_customer_email($order->id);
            session()->put('cart',[]);
        //    DB::commit();

        // } catch (\Exception $e) {
        //     DB::rollback();
        //    return back()->with('error','Process Failed');
        // }

        return redirect('/order-confirmaton/'.$order->tracking_id);

    }


    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function order_confirmaton(Request $request,$id)
    {

        

        $order = Order::where('tracking_id',$id)->first(); 
        
        $statusId = $order->order_status;
        $orderStatus = OrderStatus::where('id',$statusId)->first(); 

        if(!$order){
          return redirect('/shop')->with('error','Record Not Found');
        }

     
        return view('theme.order_confirmation',compact('order','orderStatus'));

    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function order_tracking(Request $request)
    {

        if($request->has('tracking_id') && $request->tracking_id != ''){
            $order = Order::where('tracking_id',$request->tracking_id)->first();
            if($order == null){
                return back()->with('error','Incorrect Tracking ID');
            }else{
               return redirect('/order-confirmaton/'.$order->tracking_id);
            }
        }

        return view('theme.order_tracking');
    }
    
     /**
     * Show the application dashboard.
     */
    public function get_invoice(Request $request,$id)
    {

        $pdfContent = EmailUtility::getPdf($id);

        $name = "#".$id.'-order-irhawears.pdf';

        return Response::make($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$name.'"',
        ]);


    }

   
}