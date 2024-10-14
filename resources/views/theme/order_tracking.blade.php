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
            <div class="wrapper"><h1 class="page-title">Order Tracking</h1></div>
        </div>
    </div>
    <!-- End Page Title -->

    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-sm-12 col-md-6 m-auto text-center empty-page mb-5">
                <i class="icon an an-cart-arrow-down"></i>
                <h2>Search Order With Tracking ID</h2>
                <form action="{{URL::to('/order-tracking')}}" method="get">
                    <input placeholder="Order Tracking ID" required name="tracking_id" 
                       class="my-3 form-control" value="" />
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <!-- End Main Content -->
        </div>
    </div>

</div>

<!-- End Body Content -->
@endsection
@section('js')



@endsection