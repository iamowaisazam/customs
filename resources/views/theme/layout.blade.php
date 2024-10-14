
<?php 
   $main_menu = $_s['menus']->where('slug','main-menu')->first();
   $footer_menu1 = $_s['menus']->where('slug','footer-menu-1')->first();
   $footer_menu2 = $_s['menus']->where('slug','footer-menu-2')->first();
?>


<!DOCTYPE html>
<html lang="en">
<head>

    @yield('metatags')

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="google-site-verification" content="kXnfg4pPGlr_-AERUwMmhGQRXOg5M1RfxyN4vMfwKHQ"/>

    
    <!-- Plugins CSS -->
       <link rel="shortcut icon" href="{{asset($_s['fav_icon'])}}">
       <link rel="stylesheet" href="{{asset('theme/assets/css/plugins.css')}}" />
       <link href="{{asset('admin/assets/node_modules/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
       <link rel="stylesheet" href="{{asset('theme/assets/css/style.css')}}" />
       <link rel="stylesheet" href="{{asset('theme/assets/css/responsive.css')}}" />
       <link href="{{asset('admin/assets/node_modules/toast-master/css/jquery.toast.css')}}" rel="stylesheet">

       <style>

         footer h4 {
            font-size: 19px!important;
            margin-bottom:17px!important;
        }

        footer ul li a{
            font-size: 15px;
        }

        img.logo-web {
            margin-left: 0px !important;
        }

        .grid__item {
            float: none!important;
            padding-left: 0px!important;
            /* padding-right: 0; */
            width: 100%!important;
        }

        .border-bottom .container-fluid{
            padding: 0 39px;
        }

        #siteNav > li > a {
            padding: 0 10px!important;
        }
       
       </style>

    @yield('css')
</head>
<body class="template-index diva home8-simple">
  
  <!-- Page Loader -->
  <div id="pre-loader">
     <img src="{{asset('theme/assets/images/loader.gif')}}" />
   </div>
  <!-- End Page Loader -->

  <!-- Page Wrapper -->
  <div class="pageWrapper">

    <!-- Search Form Drawer -->
    <div class="search">
        <div class="search__form">
            <form class="search-bar__form" action="{{URL::to('/shop')}}">
                <button class="go-btn search__button" type="submit"><i class="icon an an-search"></i></button>
                <input class="search__input" type="search" name="search" value="{{request()->has('search') ? request()->search : ''}}"  placeholder="Search entire store..." aria-label="Search" autocomplete="off" />
            </form>
            <button type="button" class="search-trigger close-btn" data-bs-toggle="tooltip" data-bs-placement="left" title="Close"><i class="icon an an-times"></i></button>
        </div>
    </div>
    <!-- End Search Form Drawer -->


    <!-- Main Header -->
    <div class="header-section clearfix animated hdr-sticky">
            <!-- Desktop Header -->
            <div class="header-7">
                @include('theme.components.topbar')
                <div class="header-wrap d-flex border-bottom">
                    <div class="container-fluid">
                        @if(isset($_s['menu_type']) && strtolower($_s['menu_type'])=='center')
                           @include('theme.components.center_menu')
                        @else
                           @include('theme.components.left_menu')
                        @endif
                    </div>
                </div>
            </div>
        <!-- End Main Header -->
       @include('theme.components.mobile_menu')
    </div>

    <!-- Body Content -->
   @yield('content')
    <!-- End Body Content -->

    <!-- Footer -->
    <footer id="footer" class="footer-4">
        <div class="site-footer">
            <div class="footer-top">
                <div class="container">
                    <!-- Footer Links -->
                    <div class="row">

                        <div class="col-md-4 footer-links">
                                <a href="{{URL::to('/')}}">
                                    <img style="width: 166px" src="{{asset($_s['logo'])}}" class="pb-3" />
                                </a>
                                <p>{{$_s['site_short_details']}}</p>
                                  
                        </div>
                        
                        <div class="col-md-8">
                            <div class="row">
                                @if($footer_menu1)
                                <div class="col-12 col-sm-12 col-md-3 col-lg-4 footer-links">
                                    <h4 class="h4">Important Link</h4>
                                    <ul>
                                        @foreach ($footer_menu1->children as $item)
                                         <li>
                                            <a target="{{$item->target}}" href="{{URL::to($item->link)}}">{{$item->title}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
        
                                @if($footer_menu2)
                                <div class="col-12 col-sm-12 col-md-3 col-lg-4 footer-links">
                                    <h4 class="h4">Help & Policies</h4>
                                    <ul>
                                        @foreach ($footer_menu2->children as $item)
                                         <li>
                                            <a target="{{$item->target}}" href="{{URL::to($item->link)}}">{{$item->title}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <div class=" col-12 col-sm-12 col-md-3 col-lg-4 newsletter">
                                    <h4 class="h4">Newsletter</h4>
                                    @include('theme.components.newsletter')
                                    @include('theme.components.social_media')
                                </div>
                            </div>
                        </div>           
                    </div>
                    <!-- End Footer Links -->
                </div>
            </div>

            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <!-- Footer Copyright -->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 copyright text-center">
                            <span>&copy; 2024 Azamsolutions</span> All Rights Reserved.
                        </div>
                        <!-- End Footer Copyright -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
  
    <!-- Scoll Top -->
    <div id="site-scroll"><i class="icon an an-angle-up"></i></div>

 
    <div class="minicart-right-drawer right modal fade" 
         id="minicart-drawer" 
         tabindex="-1" 
         aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="minicart-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="an an-times" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="left" title="Close"></i>
                    </button>
                    <h4 class="modal-title" id="myModalLabel2">Shopping Cart 
                        <strong>0</strong> items
                    </h4>
                </div>
                <div class="minicart-body">
                    <div id="drawer-minicart" class="block block-cart">
                        <ul class="mini-products-list">
                        

                        </ul>
                    </div>
                </div>
                <div class="minicart-footer minicart-action">
                    <div class="total-in">
                        <p class="label"><b>Subtotal:</b>
                            <span class="item product-price">
                                <span class="subtotal"></span>
                            </span>
                        </p>
                        <p class="label"><b>Delivery Charges:</b>
                            <span class="item product-price">
                                <span class="delivery_charges"></span>
                            </span>
                        </p>
                        <p class="label"><b>Grand Total:</b>
                            <span class="item product-price">
                                <span class="grand_totals"></span>
                            </span>
                        </p>
                    </div>
                    <div class="buttonSet d-flex flex-row align-items-center text-center">
                        <a href="{{URL::to('/cart')}}" class="btn btn-secondary w-50 me-3">View Cart</a>
                        <a href="{{URL::to('/checkout')}}" class="btn btn-secondary w-50">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Minicart Drawer -->

   

   

   

</div>
<!-- End Page Wrapper -->





        <!-- Including Javascript -->
        <script src="{{asset('theme/assets/js/plugins.js')}}"></script>
        <script src="{{asset('theme/assets/js/main.js')}}"></script>
        <script src="{{asset('admin/assets/node_modules/toast-master/js/jquery.toast.js')}}"></script>
       
        <script>

         $(document).ready(function() {

            $('.site-header-cart').click(function (e) { 
            $.ajax({
                url: site_url+"/getCart",
                success: function (response) {
                    if(response.count == 0){
                        $('.minicart-right-drawer').html(response.html);
                        $('#CartCount').text('('+response.count+')');
                    }else{
                        $('.minicart-right-drawer').html(response.html);
                        $('#CartCount').text('('+response.count+')');
                    }
                    }
                });
           }).trigger('click');

            $('#newsletter-form').submit(function(event) {
                event.preventDefault(); 
        
                var formData = $(this).serialize();
                    $.ajax({
                        type: 'POST',
                        url: '{{route('newslettertSubmit')}}', 
                        data: formData,
                        success: function(response) {
                            $('<p>Subscription successful!</p>').css('color', 'green').appendTo('#newsletter-form');
                            
                        },
                        error: function(xhr, status, error) {
                            $('<p>Subscription failed</p>').css('color', 'red').appendTo('#newsletter-form');
                        }
                    });
                });
});
        </script>
        @if(Session::get('success'))
        <script> 
            $.toast({
                    heading: "{{Session::get('success')}}",
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'success',
                    hideAfter: 3500,
                    stack: 6,
                });
        </script>
        @endif
    
        @if(Session::get('error'))
        <script> 
            $.toast({
                heading: "{{Session::get('error')}}",
                position: 'top-right',
                loaderBg: '#ff6849',
                icon: 'error',
                hideAfter: 3500,
                stack: 6,
            });
        </script>
        @endif
    


        @yield('js')


        <script>

            let site_url = "{{URL::to('')}}";
                
        </script>
   </body>
  </html>