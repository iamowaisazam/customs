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
                <h4 class="mb-0 text-white">Others</h4>
            </header>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{ url('/admin/settings/update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                           
                            <div class="form-group file_manager_parent">                      
                                <label>Admin Logo :</label>
                                <input type="hidden" name="admin_logo[type]" value="image">
                                <select placeholder="Select an option" class="file_manager" name="admin_logo[value]">
                                    <option id="{{ $data['others']['admin_logo'] }}" value="{{ $data['others']['admin_logo'] }}">{{ $data['others']['admin_logo'] }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 text-center"></div>
                        
                        <div class="col-md-12">
                            {{-- <div class="form-group">
                                <label>Admin Favicon :</label>
                                <input class="image form-control" type="text" value="{{ $data['others']['admin_favicon'] ?? '' }}" placeholder="Admin Favicon" name="admin_favicon[value]">
                                <input type="hidden" name="admin_favicon[type]" value="image">
                            </div> --}}
                            
                            <div class="form-group file_manager_parent">                      
                                <label>Admin Favicon :</label>
                                <input type="hidden" name="admin_favicon[type]" value="image">
                                <select placeholder="Select an option" class="file_manager" name="admin_favicon[value]">
                                    <option id="{{ $data['others']['admin_favicon'] }}" value="{{ $data['others']['admin_favicon'] }}">{{ $data['others']['admin_favicon'] }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 text-center"></div>
                        
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