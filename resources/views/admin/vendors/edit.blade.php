@extends('admin.partials.layout')
@section('css')
<style>
    .invalid-feedback{
      display: block;
   }
</style>
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Edit Vendor
        </h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Vendors</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white" >Edit Vendor Form</h4>
            </header>
            <div class="card-body">
                <form method="post" action="{{URL::to('admin/vendors')}}/{{Crypt::encryptString($model->id)}}" >
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="font-normal">Vendor personal Info</h4>
                            <hr>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" >Vendor Service</label>
                                <input type="text" value="{{$model->vendor_service}}" name="vendor_service" class="form-control" 
                                placeholder="Vendor Service">
                                @if($errors->has('vendor_service'))
                                 <p class="text-danger" >{{ $errors->first('vendor_service') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" >Vendor Name</label>
                                <input type="text" value="{{$model->vendor_name}}" name="vendor_name" class="form-control" 
                                placeholder="Vendor Name">
                                @if($errors->has('vendor_name'))
                                 <p class="text-danger" >{{ $errors->first('vendor_name') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Vendor Contact</label>
                                <input type="text" value="{{$model->vendor_phone}}" 
                                name="vendor_phone" class="form-control" placeholder="Vendor Contact">
                                @if($errors->has('vendor_phone'))
                                 <p class="text-danger" >{{ $errors->first('vendor_phone') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" >Vendor Email</label>
                                <input type="text" value="{{$model->vendor_email}}" 
                                name="vendor_email" class="form-control" placeholder="Vendor Email">
                                @if($errors->has('vendor_email'))
                                 <p class="text-danger" >{{ $errors->first('vendor_email') }}</p>
                                @endif 
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="font-normal">Login Details</h4>
                            <hr>        
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" >Email</label>
                                <input readonly type="text" value="{{$model->user->email}}" 
                                name="email" class="form-control" placeholder="Email">
                                @if($errors->has('email'))
                                 <p class="text-danger" >{{ $errors->first('email') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" >Password</label>
                                <input type="password" name="password" value="" 
                                class="form-control" placeholder="Password">
                                <small  class="form-text text-dark">Leave It Blank For Default Password.</small>
                                @if($errors->has('password'))
                                <p class="invalid-feedback" >{{ $errors->first('password') }}</p>
                                @endif 
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                           <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
@section('js')
    
<script>
    $(document).ready(function() {
        $('input[name=vendor_email]').change(function (e) { 
            $('input[name=email]').val($(this).val());
        });
    });
</script>

@endsection