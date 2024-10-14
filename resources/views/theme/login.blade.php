@extends('theme.layout')

@php
//dd($users);
@endphp

@section('metatags')
    <title>Login</title>
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
                        <div class="wrapper"><h1 class="page-width">Login</h1></div>
                    </div>
                </div>
                <!-- End Page Title -->
                <!-- Breadcrumbs -->
                <div class="bredcrumbWrap bredcrumbWrapPage bredcrumb-style2 text-center">
                    <div class="container breadcrumbs">
                        <a href="{{route('home')}}" title="Back to the home page">Home</a><span aria-hidden="true">|</span><span class="title-bold">Login</span>
                    </div>
                </div>
                <!-- End Breadcrumbs -->

                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 box">
                            <div class="mb-4">
                                <form method="post" action="/weblogin" id="CustomerRegisterForm" accept-charset="UTF-8" class="customer-form">	
                                @csrf
                                    <h3>Registered Customers</h3>
                                    <p>If you have an account with us, please log in.</p>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="CustomerEmail">Email <span class="required">*</span></label>
                                                <input type="email" name="email" placeholder="" value="{{ old('email') }}" id="CustomerEmail" autofocus="">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="CustomerPassword">Password <span class="required">*</span></label>
                                                <input type="password" value="" name="password" placeholder="" id="CustomerPassword" class="">                        	
                                                @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-left col-12 col-sm-12 col-md-12 col-lg-12">
                                            <input type="submit" class="btn mb-3" value="Sign In">
                                            <p class="mb-4">
                                                <a href="{{route('forgotpassword')}}">Forgot your password?</a> &nbsp; | &nbsp;
                                                <a href="{{ route('register') }}" id="customer_register_link">Create account</a>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
