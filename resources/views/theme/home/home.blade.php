@extends('theme.layout')


@section('metatags')
    <title>{{$_s['site_title']}}</title>
    <meta name="description" content="{{$_s['meta_description']}}">
    <meta name="keywords" content="{{$_s['meta_keywords']}}">
   
  
@endsection

@section('css')

<style>
   
</style>

@endsection
@section('content')

<div id="page-content">

        <!-- Home Banner slider -->
          @include('theme.home.slider')
        <!-- End Home Banner slider -->

        <!-- Categories -->
            @include('theme.home.category')
        <!-- End Categories -->

        <!-- collection -->
            @include('theme.home.collections')
        {{-- End  collection--}}
        
        <div class="section">
            <div class="hero hero--medium hero__overlay bg-size background-parallax" style="background-image: url('{{$_s['home_page_banner']}}'); background-size: cover; background-position: 50% 31px; background-repeat: no-repeat;">
                <img class="bg-img blur-up" src="{{$_s['home_page_banner']}}" alt="banner" style="display: none;">
                <div class="hero__inner">
                    <div class="container">
                        <div class="wrap-text text-large center wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
                            <p class="mega-small-title">{{$_s['site_title']}}</p>
                            <h2 class="h1 mega-title">Best Collection</h2>
                            <p class="mega-subtitle">Get Inspired By The Latest And Greatest Trend</p>
                            <a href="{{URL::to('/shop')}}" class="btn border-btn-1 btn--large">Shop Now</a>  
                        </div>
                    </div>
                </div>            
            </div>
        </div>


        <!-- Popular Products -->
        @include('theme.home.popular_products')
        <!-- End Popular Products -->



   

    

   






    <!-- Store Feature -->
    <div class="d-none store-feature style3 mt-2 mb-2">
        <div class="container">
            <div class="row">
                <div class="col-6 col-sm-6 col-md-3 col-lg-3 mb-3 mb-md-0">
                    <div class="store-info px-3 py-3 text-center">
                        <div class="icons mb-3"><i class="icon an an-truck"></i></div>
                        <div class="store-info-text">
                            <h5 class="text-dark" >Free Worldwide Shipping</h5>
                            <span class="sub-text">Free shipping on all US orders</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-3 col-lg-3 mb-3 mb-md-0">
                    <div class="store-info px-3 py-3 text-center">
                        <div class="icons mb-3"><i class="icon an an-money-bill-alt"></i></div>
                        <div class="store-info-text">
                            <h5 class="text-dark">Money Guarantee</h5>
                            <span class="sub-text">30 days money back guarantee</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-3 col-lg-3 mb-3 mb-md-0">
                    <div class="store-info px-3 py-3 text-center">
                        <div class="icons mb-3"><i class="icon an an-question-circle"></i></div>
                        <div class="store-info-text">
                            <h5 class="text-dark">Top Notch Support</h5>
                            <span class="sub-text">We support online 24/7 on day</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-3 col-lg-3 mb-3 mb-md-0">
                    <div class="store-info px-3 py-3 text-center">
                        <div class="icons mb-3"><i class="icon an an-lock"></i></div>
                        <div class="store-info-text">
                            <h5>Secure Payments</h5>
                            <span class="sub-text">All payment are Secured, trusted.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Store Feature -->




</div>
@endsection

@section('js')

<script>

    $(document).ready(function () {



    });

</script>


@endsection