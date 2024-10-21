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
        <h4 class="text-themecolor">Consignment & Job Creation
        </h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Consignment & Job Creation</li>
            </ol>
        </div>
    </div>
</div>

<form method="post" action="{{URL::to('admin/consignments')}}" >
    @csrf

    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <header class="card-header bg-info">
                    <h4 class="mb-0 text-white" >Create Jobs With Consignment information</h4>
                </header>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Job Number (Auto)</label>
                                <input type="text" value="{{old('job_number')}}" name="job_number" 
                                class="form-control" placeholder="Job Number">
                                @if($errors->has('job_number'))
                                 <p class="text-danger" >{{ $errors->first('job_number') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Consignee (Company Name)</label>
                                <select name="customer_id" class="form-control" >
                                    <option value="">Select Consignee</option>
                                    @foreach ($customers as $item)
                                        <option value="{{$item->id}}">{{$item->customer_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('customer_id'))
                                 <p class="text-danger" >{{ $errors->first('customer_id') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"> BL/AWB No </label>
                                <input value="{{old('blawbno')}}" 
                                name="blawbno" class="form-control" placeholder="BL/AWB No ">
                                @if($errors->has('blawbno'))
                                 <p class="text-danger" >{{ $errors->first('blawbno') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"> LC/BT/IT No </label>
                                <input value="{{old('lcbtitno')}}" name="lcbtitno" 
                                 class="form-control" placeholder="LC/BT/IT No">
                                @if($errors->has('lcbtitno'))
                                 <p class="text-danger" >{{ $errors->first('lcbtitno') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label"> Description </label>
                                <input value="{{old('description')}}" name="description" 
                                 class="form-control" placeholder="Description">
                                @if($errors->has('description'))
                                 <p class="text-danger" >{{ $errors->first('description') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"> Invoice Value </label>
                                <input value="{{old('invoice_value')}}" name="invoice_value" 
                                 class="form-control" placeholder="Invoice Value">
                                @if($errors->has('invoice_value'))
                                 <p class="text-danger" >{{ $errors->first('invoice_value') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Select Invoice Currency</label>
                                <select name="currency" class="form-control currency" >
                                    <option value="dollar">US</option>
                                    <option value="dollar">US</option>
                                    <option value="dollar">US</option>
                                </select>
                                @if($errors->has('currency'))
                                 <p class="text-danger" >{{ $errors->first('currency') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"> Machine Number </label>
                                <input value="{{old('machine_number')}}" name="machine_number" 
                                 class="form-control" placeholder="Machine Number">
                                @if($errors->has('machine_number'))
                                 <p class="text-danger" >{{ $errors->first('machine_number') }}</p>
                                @endif 
                            </div>
                        </div>                 
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                           <button type="submit" class="btn btn-info">Create Job</button>
                        </div>
                    </div>
              </div>
        </section>
    </div>
</div>
</form>
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