@extends('admin.partials.layout')
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
                <h4 class="mb-0 text-white">{{ ucwords(str_ireplace("_", " ",$group))}}</h4>
                </header>
            <div class="card-body">
                <form method="post" 
                enctype="multipart/form-data" 
                action="{{URL::to('admin/settings/update/')}}" >
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="py-2">Primary Color</label>
                                <input class="form-control" type="color"
                                  value="{{$data['primary_color']}}"   
                                  name="data[primary_color]" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="py-2">Secondry Color</label>
                                <input class="form-control" type="color"
                                  value="{{$data['secondry_color']}}"   
                                  name="data[secondry_color]" />
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

    
@endsection