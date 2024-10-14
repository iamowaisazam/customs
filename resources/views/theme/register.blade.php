@extends('theme.layout')

@php

@endphp

@section('metatags')
    <title>Register</title>
    <meta name="description" content="{{$_s['meta_description']}}">
    <meta name="keywords" content="{{$_s['meta_keywords']}}">
@endsection

@section('css')

<style>

</style>

@endsection
@section('content')

<div id="page-content">
                <!-- Page Title -->
                <div class="page section-header text-center mb-0">
                    <div class="page-title">
                        <div class="wrapper"><h1 class="page-width">Register</h1></div>
                    </div>
                </div>
                <!-- End Page Title -->
                <!-- Breadcrumbs -->
                <div class="bredcrumbWrap bredcrumbWrapPage bredcrumb-style2 text-center">
                    <div class="container breadcrumbs">
                        <a href="{{'home'}}" title="Back to the home page">Home</a><span aria-hidden="true">|</span><span class="title-bold">Register</span>
                    </div>
                </div>
                <!-- End Breadcrumbs -->

                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 box">	
                            <div class="mb-4">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                <h3>Personal Information</h3>
                                <form method="post" action="/createaccount" accept-charset="UTF-8" class="customer-form">
                                @csrf    
                                <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-10">
                                            <div class="form-group">
                                                <label for="CustomerFirstName">Full Name <span class="required">*</span></label>
                                                <input id="CustomerFirstName" type="text" name="name" placeholder="">
                                            </div>
                                        </div>

                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="CustomerEmail">Email Address <span class="required">*</span></label>
                                                <input id="CustomerEmail" type="email" name="email" placeholder="">                        	
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="mt-3">Login Information</h3>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">                                	
                                            <div class="form-group">
                                                <label for="CustomerPassword">Password <span class="required">*</span></label>
                                                <input id="CustomerPassword" type="password" name="Password" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="CustomerConfirmPassword">Confirm Password <span class="required">*</span></label>
                                                <input id="CustomerConfirmPassword" type="Password" name="password_confirmation" placeholder="">                        	
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-left col-12 col-sm-12 col-md-6 col-lg-6">
                                            <input type="submit" class="btn mb-3" value="Submit">
                                        </div>
                                        <div class="text-right col-12 col-sm-12 col-md-6 col-lg-6">
                                            <a href="{{ route('weblogin') }}"><i class="icon an an-angle-double-left me-1"></i>Back To Login</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
@endsection

@section('js')
<script>
    console.log("hello");
</script>
@endsection

