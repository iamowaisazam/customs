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
                <li class="breadcrumb-item active">Settings</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <section class="card">            
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white">Others</h4>
            </header>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{ url('/admin/settings/update') }}">
                    @csrf                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Site Title</label>
                                <input type="text" value="{{ $data['others']['site_title'] }}" class="form-control" placeholder="Site Title" name="site_title[value]">
                                <input type="hidden" name="site_title[type]" value="text">      
                            </div>
                        </div>      

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" value="{{ $data['others']['phone_number'] }}" class="form-control" placeholder="Phone Number" name="phone_number[value]">
                                <input type="hidden" name="phone_number[type]" value="text">
                            </div>
                        </div>      

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" value="{{ $data['others']['email_address'] }}" class="form-control" placeholder="Email Address" name="email_address[value]">
                                <input type="hidden" name="email_address[type]" value="text">
                            </div>
                        </div>      

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" value="{{ $data['others']['address'] }}" class="form-control" placeholder="Address" name="address[value]">
                                <input type="hidden" name="address[type]" value="text">
                            </div>
                        </div>      

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Domain</label>
                                <input type="text" value="{{ $data['others']['domain'] }}" class="form-control" placeholder="Domain" name="domain[value]">
                                <input type="hidden" name="domain[type]" value="text">
                            </div>
                        </div>      

                        <div class="col-md-12">
                            <input type="hidden" name="logo[type]" value="image">
                            <div class="form-group file_manager_parent">                      
                                <label>Logo :</label>
                                <select placeholder="Select an option" class="file_manager" name="logo[value]">
                                    <option id="{{ $data['others']['logo'] }}" value="{{ $data['others']['logo'] }}">{{ $data['others']['logo'] }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 text-center"></div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Menu Type</label>
                                <select name="menu_type[value]" class="form-control">
                                    <option {{ $data['others']['menu_type'] == 'left' ? 'selected' : '' }} value="left">Left</option>
                                    <option {{ $data['others']['menu_type'] == 'center' ? 'selected' : '' }} value="center">Center</option>
                                </select>
                                <input type="hidden" name="menu_type[type]" value="text">
                            </div>
                        </div>

                        <div class="col-md-6 text-center"></div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Fav Icon :</label>
                                <input class="image form-control" type="text" value="{{ $data['others']['fav_icon'] }}" placeholder="Fav Icon" name="fav_icon[value]">
                                <input type="hidden" name="fav_icon[type]" value="image">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Site Short Details</label>
                                <input type="text" value="{{ $data['others']['site_short_details'] }}" class="form-control" placeholder="Site Short Details" name="site_short_details[value]">
                                <input type="hidden" name="site_short_details[type]" value="text">
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