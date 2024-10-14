@extends('theme.layout')

@php

@endphp

@section('metatags')
    <title>{{$pageData->title}}</title>
    <meta name="description" content="{{$pageData->meta_description}}">
    <meta name="keywords" content="{{$pageData->meta_keywords}}">
@endsection
@section('css')
<style>

        p {
            font-size: 16px;
            margin-bottom: 15px;
            text-align: justify;
        }

</style>
@endsection
@section('content')

<?php 
?>
    <div id="page-content" class="template-collection">
        <div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper">
                    <h1 class="page-title">{{$pageData->title ?? ''}}</h1>
                </div>
            </div>
        </div>

        <div class="privacy-policy-content container">
            <div class="row">

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                {!! $pageData->longdetails !!}
            </div>
            </div>
        </div>
    </div>
@endsection
@section('js')



@endsection