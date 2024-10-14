@extends('admin.layout')
@section('css')
 
<link href="{{asset('admin/assets/summernote/summernote-bs4.css')}}" rel="stylesheet">
<style>
    .error{
        color:red;
    }
</style>

@endsection
@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">{{ ucwords(str_ireplace("_", " ",$group))}}</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Seo Settings</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white">Header</h4>
            </header>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{ url('/admin/settings/update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Topbar Title</label>
                                <input type="text" value="{{ $data['header']['topbar_title'] ?? 'Welcome To MSTORE' }}" class="form-control" placeholder="Topbar Title" name="topbar_title[value]">
                                <input type="hidden" name="topbar_title[type]" value="text">
                            </div>
                        </div>
                        <div class="col-md-12 text-center pt-5">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white">Homepage</h4>
            </header>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{ url('/admin/settings/update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                           
                            <div class="form-group file_manager_parent">                      
                                <label>Logo :</label>
                                <input type="hidden" name="home_page_banner[type]" value="image">
                                <select placeholder="Select an option" class="file_manager" name="home_page_banner[value]">
                                    <option id="{{ $data['homepage']['home_page_banner'] }}" value="{{ $data['homepage']['home_page_banner'] }}">{{ $data['homepage']['home_page_banner'] }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 text-center"></div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Home Page Text</label>
                                <input type="text" value="{{ $data['homepage']['home_page_text'] ?? 'MSTORE' }}" class="form-control" placeholder="Home Page Text" name="home_page_text[value]">
                                <input type="hidden" name="home_page_text[type]" value="text">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Home Page Text Color</label>
                                <input type="text" value="{{ $data['homepage']['home_page_text_color'] ?? 'white' }}" class="form-control" placeholder="Home Page Text Color" name="home_page_text_color[value]">
                                <input type="hidden" name="home_page_text_color[type]" value="text">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Home Page Details</label>
                                <input type="text" value="{{ $data['homepage']['home_page_details'] ?? 'WE ENJOY WORKING ON THE SERVICES & PRODUCTS. WE PROVIDE AS MUCH AS YOU NEED THEM. THIS HELP US IN DELIVERING YOUR GOALS EASILY. BROWSE THROUGH THE WIDE RANGE OF SERVICES WE PROVIDE.' }}" class="form-control" placeholder="Home Page Details" name="home_page_details[value]">
                                <input type="hidden" name="home_page_details[type]" value="text">
                            </div>
                        </div>

                        <div class="col-md-12 text-center pt-5">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white">Footer</h4>
            </header>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{ url('/admin/settings/update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Footer Credits</label>
                                <input type="text" value="{{ $data['footer']['footer_credits'] ?? 'Copyright: 2024 <a href=&quot;#.&quot;><span class=&quot;color_red&quot;>MSTORE</span></a>' }}" class="form-control" placeholder="Footer Credits" name="footer_credits[value]">
                                <input type="hidden" name="footer_credits[type]" value="text">
                            </div>
                        </div>

                        <div class="col-md-12 text-center pt-5">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>

    @endsection

@section('js')
<script src="{{asset('admin/js/jquery.tagsinput.js')}}"></script>
<script src="{{asset('admin/assets/summernote/summernote-bs4.min.js')}}"></script>
<script>

    jQuery(document).ready(function(){

        $('.summernote').summernote({
            height: 200,                 // set editor height

            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor

            focus: true                 // set focus to editable area after initializing summernote
        });
        $(".tagsinput").tagsInput();
    });

</script>
    
@endsection