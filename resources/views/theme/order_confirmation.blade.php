@extends('theme.layout')

@section('metatags')
    <title>Order Confirmation</title>
    <meta name="description" content="{{$_s['meta_description']}}">
    <meta name="keywords" content="{{$_s['meta_keywords']}}">
@endsection
@section('css')
  
@endsection
@section('content')

<div id="page-content">

    <!-- Page Title -->
    <div class="page section-header text-center mb-0">
        <div class="page-title">
            <div class="wrapper"><h1 class="page-title">Order Confirmation</h1></div>
        </div>
    </div>
    <!-- End Page Title -->

    <div class="container checkout-success-content">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <!--<div class="checkout-success-banner mb-4 mb-lg-5">-->
                <!--    <img class="blur-up lazyload" -->
                <!--      data-src="{{asset('public/theme/assets/images/checkout-success-banner.jpg')}}" -->
                <!--      src="{{asset('public/theme/assets/images/checkout-success-banner.jpg')}}" -->
                <!--      />-->
                <!--</div>-->
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card border-0 rounded-0">
                    <div class="card-body text-center">
                        <p class="checkout-success-icon"><i class="icon an an-check-square"></i></p>
                        <h4 class="card-title">Thank you for your purchase!</h4>
                        <p class="card-text mb-1">Your order # is: <b>#{{$order->id}}</b>.</p>
                        <p class="card-text mb-1">You will receive an order confirmation email with details of your order and a link to track its progress.</p>
                        <p class="card-text mb-1">All necessary information about the delivery, we sent to your email</p>
                        <a href="{{URL::to('shop')}}" class="btn btn-primary mt-3">Continue Shopping</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="ship-info-details shipping-method-details">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="shipping-details mb-4 mb-sm-0 clearfix">
                                <h3>Customer Details</h3>
                                <p>Customer Name: {{$order->customer_name}}</p>
                                <p>Customer Email: {{$order->customer_email}}</p>
                                <p>Customer phone: {{$order->customer_phone}}</p>
                                <p>Customer Country: {{$order->country}}</p>
                                <p>Customer City: {{$order->city}}</p>
                                <p>Customer Street Address: {{$order->address}}</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="billing-details clearfix">
                                <h3>Order Details</h3>
                                <p>Order No: # {{$order->id}}</p>
                                <p>Order Tracking ID: {{$order->tracking_id}}</p>
                                <p>Order Date: {{$order->created_at}}</p>
                                <p>Order Status: {{$orderStatus->title}}</p>
                                <p>Order Payment Method: 
                                    {{$order->payment_methods ? $order->payment_methods->title : ''}}</p>
                                <p>Order Payment: {{$order->payment_status}}</p>
                                <p>Order Notes: {{$order->customer_notes}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="checkout-item-ordered">
                    <h2>Item Ordered</h2>
                    <div class="table-content table-responsive checkout-review mb-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center fw-bold"></th>
                                    <th class="text-start fw-bold">Product Name</th>
                                    <th class="text-center fw-bold">Qty</th>
                                    <th class="text-center fw-bold">Price</th>
                                    <th class="text-center fw-bold">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->children as $item)
                                <tr>
                                    <td class="pro-img text-center">
                                        <a  >
                                        <img class="primary blur-up lazyload" 
                                           data-src="{{$item->image_id}}" 
                                           src="{{$item->image_id}}"
                                           width="80" />
                                        </a>
                                    </td>

                                    <td class="pro-name text-center text-sm-start">
                                        <p style="font-weight: bold;" class="mb-1">
                                            <a >{{$item->title}} ( {{$item['sku']}} )</a>
                                        </p>
                                    </td>
                                    <td class="pro-price text-center">{{$item->quantity}}</td>
                                    <td class="pro-price text-center">PKR {{$item->price}}</td>
                                    <td class="pro-total text-center">PKR {{$item->total}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="text-right">
                                <tr>
                                    <td colspan="4" class="item total fw-bold">Subtotal:</td>
                                    <td class="last">PKR {{$order->subtotal}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="item total fw-bold">Delivery Charges:</td>
                                    <td class="last">PKR {{$order->delivery_charges}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="item total fw-bold">Grand Total:</td>
                                    <td class="last">PKR {{$order->grandtotal}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

        
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Body Content -->
@endsection
@section('js')



@endsection