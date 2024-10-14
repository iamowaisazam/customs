@extends('theme.layout')

@php
//dd($users);
@endphp

@section('metatags')
    <title>{{$_s['site_title']}}</title>
    <meta name="description" content="{{$_s['meta_description']}}">
    <meta name="keywords" content="{{$_s['meta_keywords']}}">
@endsection

@section('css')

<style>
   .row {

    justify-content: center;
}
</style>

@endsection
@section('content')
<div id="page-content">
                <!-- Page Title -->
                <div class="page section-header text-center mb-0">
                    <div class="page-title">
                        <div class="wrapper"><h1 class="page-width">Forgot Your Password</h1></div>
                    </div>
                </div>
                <!-- End Page Title -->
                <!-- Breadcrumbs -->
                <div class="bredcrumbWrap bredcrumbWrapPage bredcrumb-style2 text-center">
                    <div class="container breadcrumbs">
                        <a href="index.html" title="Back to the home page">Home</a><span aria-hidden="true">|</span><span class="title-bold">Forgot Your Password</span>
                    </div>
                </div>
                <!-- End Breadcrumbs -->

                <div class="container">
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 box offset-md-3">
                            <div class="mb-4">
                                <form method="post" action="{{route('resetpassword')}}" accept-charset="UTF-8" class="customer-form">	
                                    <h3>Retrieve your password here</h3>
                                    <p>Please enter your email address below. You will receive a link to reset your password.</p>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="CustomerEmail">Email Address <span class="required">*</span></label>
                                                <input type="email" name="email" placeholder="" id="CustomerEmail" autofocus="">
                                                @csrf
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-left col-12 col-sm-12 col-md-12 col-lg-12">
                                            <input type="submit" class="btn mb-3" value="Submit">
                                            <p class="mb-4">
                                                <a href="{{route('weblogin')}}">« Back To Login Page</a>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End Main Content -->
                    </div>
                </div>
            </div>
@endsection
