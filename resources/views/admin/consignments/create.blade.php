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
                                <input readonly value="{{$job_number}}" name="job_number" 
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
                                        <option @if(old('customer_id') == $item->id) selecred @endif value="{{$item->id}}">{{$item->company_name}}</option>
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
                                <input readonly required min="1" type="number" value="{{old('invoice_value')}}" name="invoice_value" 
                                 class="form-control" placeholder="Invoice Value">
                                @if($errors->has('invoice_value'))
                                 <p class="text-danger" >{{ $errors->first('invoice_value') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"> Total Quantity </label>
                                <input readonly required min="1" type="number" value="{{old('total_quantity')}}" name="total_quantity" 
                                 class="form-control" placeholder="Total Quantity">
                                @if($errors->has('total_quantity'))
                                 <p class="text-danger" >{{ $errors->first('total_quantity') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Select Invoice Currency</label>
                                <select class="form-control" name="currency">
                                    @foreach ($currencies as $cr)
                                    <option value="{{$cr['code']}}">{{$cr['code']}}</option>
                                @endforeach
                                </select>
                                @if($errors->has('currency'))
                                <p class="text-danger" >{{ $errors->first('currency') }}</p>
                                @endif 
                            </div>
                        </div>  
                    </div>
              </div>
        </section>
    </div>

    <div class="col-lg-12">
        @include('admin.consignments.price-section')
    </div>

       <div class="row">
            <div class="col-md-12 py-3 text-center">
                 <button type="submit" class="btn btn-info">Create Job</button>
            </div>
        </div>

      </div>
 </form>
@endsection

@section('js')

    <script>
        $(document).ready(function() {
           


       
        });
    </script>
    
@endsection