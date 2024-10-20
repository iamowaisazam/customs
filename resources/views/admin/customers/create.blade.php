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
        <h4 class="text-themecolor">Create Customer
        </h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Customers</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white" >Create Customer Form</h4>
            </header>
            <div class="card-body">
                <form method="post" action="{{URL::to('admin/customers')}}" >
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="font-normal">Customer personal Info</h4>
                            <hr>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" >Company Name</label>
                                <input type="text" value="{{old('company_name')}}" name="company_name" class="form-control" 
                                placeholder="Company Name">
                                @if($errors->has('company_name'))
                                 <p class="text-danger" >{{ $errors->first('company_name') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" >Customer Name</label>
                                <input type="text" value="{{old('customer_name')}}" name="customer_name" class="form-control" 
                                placeholder="Customer Name">
                                @if($errors->has('customer_name'))
                                 <p class="text-danger" >{{ $errors->first('customer_name') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Customer Contact</label>
                                <input type="text" value="{{old('customer_phone')}}" 
                                name="customer_phone" class="form-control" placeholder="Customer Contact">
                                @if($errors->has('customer_phone'))
                                 <p class="text-danger" >{{ $errors->first('customer_phone') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" >Customer Email</label>
                                <input type="text" value="{{old('customer_email')}}" 
                                name="customer_email" class="form-control" placeholder="Customer Email">
                                @if($errors->has('customer_email'))
                                 <p class="text-danger" >{{ $errors->first('customer_email') }}</p>
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
                                <input readonly type="text" value="{{old('email')}}" 
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
                                <small  class="form-text text-dark">Please never share your email & password with anyone else.</small>
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
            $('input[name=customer_email]').change(function (e) { 
                $('input[name=email]').val($(this).val());
            });
        });
    </script>
    
@endsection