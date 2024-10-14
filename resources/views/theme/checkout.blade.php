@extends('theme.layout')

@php
  //dd($product)
    
@endphp

@section('metatags')
    <title>Checkout</title>
    <meta name="description" content="{{$_s['meta_description']}}">
    <meta name="keywords" content="{{$_s['meta_keywords']}}">
@endsection
@section('css')
  
@endsection
@section('content')

<div id="page-content">
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper"><h1 class="page-title">Checkout Page</h1></div>
        </div>
    </div>
    
    <div class="container">
        <form class="checkout_form" method="post" action="{{URL::to('/checkout/submit')}}">
            @csrf
        <div class="row billing-fields">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3 mb-md-0">
                <div class="create-ac-content">
                    
                        <fieldset>
                            <h2 class="login-title mb-3">Billing details</h2>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="input-firstname">Fullname 
                                            <span class="text-danger required-f">*</span>
                                        </label>
                                        <input name="name" required class="form-control"  type="text" value="{{ old('name') }}"/>

                                        @if($errors->has('name'))
                                          <p class="d-block invalid-feedback" >{{ $errors->first('name') }}</p>
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="input-email">Phone
                                            <span class="text-danger required-f">*</span>
                                        </label>
                                         <input required class="form-control" name="phone" type="text" value="{{ old('phone') }}"/>
                                         @if($errors->has('phone'))
                                          <p class="d-block invalid-feedback" >{{ $errors->first('phone') }}</p>
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="input-email">E-Mail</label>
                                         <input name="email" class="form-control" type="email" value="{{ old('email') }}" >
                                         @if($errors->has('email'))
                                          <p class="d-block invalid-feedback" >{{ $errors->first('email') }}</p>
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="input-email">Country
                                            <span class="text-danger required-f">*</span>
                                        </label>
                                        <select name="country">
                                            <option value="pakistan">Pakistan</option>
                                        </select>
                                        @if($errors->has('country'))
                                          <p class="d-block invalid-feedback" >{{ $errors->first('country') }}</p>
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="input-email">City
                                            <span class="text-danger required-f">*</span>
                                        </label>
                                         <input name="city" class="form-control" value="{{ old('city') }}">
                                    </div>
                                    @if($errors->has('city'))
                                          <p class="d-block invalid-feedback" >{{ $errors->first('city') }}</p>
                                        @endif 
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="input-email">Address
                                            <span class="text-danger required-f">*</span>
                                        </label>
                                        <textarea required name="address" class="form-control" value="{{ old('address') }}"></textarea>
                                        @if($errors->has('address'))
                                          <p class="d-block invalid-feedback" >{{ $errors->first('address') }}</p>
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" >Payment Method
                                            <span class="text-danger required-f">*</span>
                                        </label>
                                        <select class="form-control" name="payment_method">
                                            @foreach ($PaymentMethods as $method)
                                               <option value="{{$method->id}}">{{$method->title}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('payment_method'))
                                          <p class="d-block invalid-feedback">
                                            {{ $errors->first('name') }}</p>
                                        @endif 
                                    </div>

                                    @foreach ($PaymentMethods as $method)
                                        <div style="display: none;" class="card payment_box 
                                        card_{{$method->id}}">
                                            <div class="card-body">
                                                <h3 class="card-title">{{$method->title}}</h3>
                                                <p class="card-text">{!!$method->message !!} </p>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                    </fieldset>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="your-order-payment">

                    <div class="row">
                        <div class="col-12">
                            <div class="your-order">
                                <h2 class="order-title mb-4">Your Order</h2>
                                <div class="table-responsive-sm order-table"> 
                                    <table class="bg-white table table-bordered table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th class="text-start">Product Name</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart['cart_items'] as $c)
                                                <tr>
                                                    <td class="text-start">
                                                        <a href="{{$c['link']}}" 
                                                        target="_blank">
                                                            {{$c['title']}} - ({{$c['sku']}})
                                                         </a>
                                                    </td>
                                                    <td>{{$cart['currency']}} {{$c['price']}}</td>
                                                    <td>{{$c['quantity']}}</td>
                                                    <td>{{$cart['currency']}} {{number_format($c['total'],2)}}
                                                      <a class="text-danger" href="{{URL::to('/cart/remove/')}}/{{$c['variation_id']}}">X</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="font-weight-600">
                                            <tr>
                                                <td colspan="3" class="text-end">Subtotal</td>
                                                <td>{{$cart['currency']}} {{$cart['subtotal']}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end">Delivery Charges</td>
                                                <td>{{$cart['currency']}} {{$cart['delivery_charges']}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end">Grand Total</td>
                                                <td>{{$cart['currency']}} {{$cart['grand_total']}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12 col-lg-12 col-xl-12 mb-0">
                            <label for="input-company"> Order Notes </label>
                            <textarea name="order_notes" class="form-control resize-both" rows="3" value="{{ old('order_notes') }}"></textarea>
                            @if($errors->has('order_notes'))
                              <p class="d-block invalid-feedback">{{ $errors->first('order_notes') }}</p>
                             @endif 
                        </div>
                    </div>
                    <hr>
                    <div class="order-button-payment">
                        <button class="btn checkout_btn" type="button" >Place order</button>
                    </div>
                </div>
            </div>
        </div>  
        </form>      
    </div>
</div>
<!-- End Body Content -->
@endsection
@section('js')

    <script>
        $(document).ready(function () {

            $('.checkout_btn').click(function (e) { 
                $('.checkout_form').submit();
            });

            $('select[name="payment_method"]').change(function (e) { 
                
               
                $('.payment_box').hide();
                let payment_method = $(this).val();
                payment_method = '.card_'+payment_method;
                $(`${payment_method}`).show();
                
            }).trigger('change');

            

           

        });

    </script>
@endsection