@extends('theme.layout')

@php
  //dd($product)
    
@endphp

@section('metatags')
    <title>{{$category->title}}</title>
    <meta name="description" content="{{$category->meta_description}}">
    <meta name="keywords" content="{{$category->meta_keywords}}">
@endsection
@section('css')

<style>

.pager{
                list-style: none;
                display: flex;
                justify-content: center;
            }

            .pager li{
                margin: 0px 6px;
            }

            .pager .active span {
                color: #fb9678!important;
            }

            .pager li a{
                color:#212529;
            }


</style>
  
@endsection
@section('content')
<div id="page-content" class="template-collection">

    <!-- Bredcrumbs -->
    <div class="bredcrumbWrap bredcrumb-style2">
        <div class="container breadcrumbs">
            <a href="{{URL::to('/')}}">Home</a>
            <span aria-hidden="true">|</span>
            <a href="{{URL::to('/category')}}/{{$category->slug}}">Category</a>
        </div>
    </div>
    <!-- End Bredcrumbs -->

        <!-- Collection Banner -->
        <div class="collection-header">
        <div class="collection-hero">
            <div class="collection-hero__image blur-up lazyload" 
            style="background-image:url('{{asset('public/theme/assets/images/collection/women-collection-bnr.jpg')}}');"></div>
            <div class="collection-hero__title-wrapper">
                <h1 class="collection-hero__title page-width">{{$category->title}}</h1></div>
        </div>
    </div>
    <!-- End Collection Banner -->



    <div class="lookbook-1">
                    <div class="lookbook grid-masonary clearfix">
                        <div class="grid-sizer col-12 col-sm-6 col-md-6 col-lg-6 float-start"></div>
                        <div class="gutter-sizer"></div>

                        @foreach ($categories as $cat)
                            
                       
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 grid-lookbook">
                                <div class="inner position-relative overflow-hidden">
                                    <img class="blur-up lazyload" 
                                    data-src="{{asset($cat->image ? 'public/'.$cat->image->path : '')}}" 
                                    src="{{asset($cat->image ? 'public/'.$cat->image->path : '')}}" 
                                    />
                                    <div class="caption">
                                        <h2>{{$cat->title}}</h2>
                                        <a class="btn" 
                                          href="{{URL::to('/shop?category=')}}{{$cat->slug}}">
                                          Shop Now 
                                            <i class="icon an an-angle-right" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <a class="overlay" href="{{URL::to('/shop?category=')}}{{$cat->slug}}"></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
            </div>
     </div>
@endsection
@section('js')



@endsection
