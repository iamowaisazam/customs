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

<form method="post" enctype="multipart/form-data" action="{{URL::to('admin/settings/update/')}}" >
    @csrf

    <div class="row">

      <div class="col-lg-12">
        <section class="card">            
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white">{{ ucwords(str_ireplace("_", " ",$group))}}</h4>
                </header>
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="py-2">Name</label>
                                <input class="form-control"
                                  value="{{$data['web_name']}}"   
                                  name="data[web_name]" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="py-2">Logo</label>
                                <input class="form-control"
                                  value="{{$data['web_logo']}}"   
                                  name="data[web_logo]" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="py-2">Favicon</label>
                                <input class="form-control"
                                  value="{{$data['web_favicon']}}"   
                                  name="data[web_favicon]" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="py-2">Phone Number</label>
                                <input class="form-control"
                                  value="{{$data['phone_number']}}"   
                                  name="data[phone_number]" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="py-2">Email Address</label>
                                <input class="form-control"
                                  value="{{$data['email_address']}}"   
                                  name="data[email_address]" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="py-2">Address</label>
                                <input class="form-control"
                                  value="{{$data['address']}}"   
                                  name="data[address]" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="py-2">Domain</label>
                                <input class="form-control"
                                  value="{{$data['domain']}}"   
                                  name="data[domain]" />
                            </div>
                        </div>
                        <div class="col-md-12 text-center pt-5">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
              </div>
          </section>
        </div>

        <div class="col-lg-12">
            <section class="card">            
                <header class="card-header bg-info">
                <h4 class="mb-0 text-white">Seo Settings</h4>
                </header>
                <div class="card-body">
                <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="py-2">Meta Title</label>
                                    <input class="form-control"
                                      value="{{$data['meta_title']}}"   
                                      name="data[meta_title]" />
                                </div>
                            </div>
    
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="py-2">Meta Description</label>
                                    <input class="form-control"
                                      value="{{$data['meta_description']}}"   
                                      name="data[meta_description]" />
                                </div>
                            </div>
    
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="py-2">Meta Keywords</label>
                                    <input class="form-control"
                                      value="{{$data['meta_keywords']}}"   
                                      name="data[meta_keywords]" />
                                </div>
                            </div>
                            <div class="col-md-12 text-center pt-5">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                  </div>
              </section>
            </div>
    </div>
</form>    
@endsection

@section('js')
<script src="{{asset('admin/js/jquery.tagsinput.js')}}"></script>
<script src="{{asset('admin/assets/summernote/summernote-bs4.min.js')}}"></script>
<script>

    jQuery(document).ready(function(){
        $('.summernote').summernote({
            height: 200,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
        $(".tagsinput").tagsInput();
    });

</script>
    
@endsection