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
        <h4 class="text-themecolor">Consignment & Job Creation</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Consignment & Job Creation
                </li>
            </ol>
        </div>
    </div>
</div>

<form method="post" action="{{URL::to('admin/consignments')}}/{{Crypt::encryptString($model->id)}}" >
    @csrf
    @method('PUT')

    <div class="row">

        <div class="col-lg-12">
          <section class="card">
              <header class="card-header bg-info">
                    <h4 class="mb-0 text-white">Jobs With Consignment information</h4>
              </header>
              <div class="card-body">

                 <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Job Number (Auto)</label>
                            <input readonly type="text" value="{{$model->job_number}}" name="job_number" 
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
                                    <option @if($item->id == $model->customer_id) selected @endif value="{{$item->id}}">{{$item->customer_name}}</option>
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
                            <input value="{{$model->blawbno}}" 
                            name="blawbno" class="form-control" placeholder="BL/AWB No ">
                            @if($errors->has('blawbno'))
                             <p class="text-danger" >{{ $errors->first('blawbno') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label"> LC/BT/IT No </label>
                            <input value="{{$model->lcbtitno}}" name="lcbtitno" 
                             class="form-control" placeholder="LC/BT/IT No">
                            @if($errors->has('lcbtitno'))
                             <p class="text-danger" >{{ $errors->first('lcbtitno') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="form-label"> Description </label>
                            <input value="{{$model->description}}" name="description" 
                             class="form-control" placeholder="Description">
                            @if($errors->has('description'))
                             <p class="text-danger" >{{ $errors->first('description') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label"> Invoice Value </label>
                            <input value="{{$model->invoice_value}}" name="invoice_value" 
                             class="form-control" placeholder="Invoice Value">
                            @if($errors->has('invoice_value'))
                             <p class="text-danger" >{{ $errors->first('invoice_value') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Select Invoice Currency</label>
                            <select class="form-control" name="currency">
                                @foreach ($currencies as $cr)
                                <option @if($model->currency == $cr['code']) selected @endif value="{{$cr['code']}}">{{$cr['code']}}</option>
                               @endforeach
                            </select>
                            @if($errors->has('currency'))
                             <p class="text-danger" >{{ $errors->first('currency') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label"> Machine Number </label>
                            <input value="{{$model->machine_number}}" name="machine_number" 
                             class="form-control" placeholder="Machine Number">
                            @if($errors->has('machine_number'))
                             <p class="text-danger" >{{ $errors->first('machine_number') }}</p>
                            @endif 
                        </div>
                    </div>  

                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </div> 
            </div>
        </section>
    </div>


    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                  <h4 class="mb-0 text-white">Consignment information</h4>
            </header>
            <div class="card-body">

               <div class="row">

                  <div class="col-md-3">
                      <div class="form-group">
                          <label class="form-label">Job Number</label>
                          <input readonly value="{{$model->job_number}}"
                          class="form-control">
                          @if($errors->has('job_number'))
                           <p class="text-danger" >{{ $errors->first('job_number') }}</p>
                          @endif 
                      </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Your REF</label>
                        <input value="{{$model->your_ref}}" name="your_ref" 
                        class="form-control" placeholder="Your REF">
                        @if($errors->has('your_ref'))
                         <p class="text-danger" >{{ $errors->first('your_ref') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Port</label>
                        <input value="{{$model->port}}" name="port" 
                        class="form-control" placeholder="Port">
                        @if($errors->has('port'))
                         <p class="text-danger" >{{ $errors->first('port') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">EIF/FI NO</label>
                        <input value="{{$model->eiffino}}" name="eiffino" 
                        class="form-control" placeholder="EIF/FI NO">
                        @if($errors->has('eiffino'))
                         <p class="text-danger" >{{ $errors->first('eiffino') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Import/Exporter Messers</label>
                        <input value="{{$model->import_exporter_messers}}" name="import_exporter_messers" 
                        class="form-control" placeholder="Import/Exporter Messers">
                        @if($errors->has('import_exporter_messers'))
                         <p class="text-danger" >{{ $errors->first('import_exporter_messers') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Consignee by / To</label>
                        <input value="{{$model->consignee_by_to}}" name="consignee_by_to" 
                        class="form-control" placeholder="Consignee by / To">
                        @if($errors->has('consignee_by_to'))
                         <p class="text-danger" >{{ $errors->first('consignee_by_to') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Invoice Value</label>
                        <input readonly value="{{$model->invoice_value}}" 
                        class="form-control" placeholder="Invoice Value">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Invoice Currency</label>
                        <input readonly value="{{$model->currency}}" 
                        class="form-control" placeholder="Invoice Currency">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Freight</label>
                        <input value="{{$model->freight}}" name="freight" 
                        class="form-control" placeholder="Freight">
                        @if($errors->has('freight'))
                         <p class="text-danger" >{{ $errors->first('freight') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Ins Rs</label>
                        <input value="{{$model->ins_rs}}" name="ins_rs" 
                        class="form-control" placeholder="Ins Rs">
                        @if($errors->has('ins_rs'))
                         <p class="text-danger" >{{ $errors->first('ins_rs') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">US $</label>
                        <input value="{{$model->us}}" name="us" 
                        class="form-control" placeholder="US $">
                        @if($errors->has('us'))
                         <p class="text-danger" >{{ $errors->first('us') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">LC no</label>
                        <input value="{{$model->lc_no}}" name="lc_no" 
                        class="form-control" placeholder="LC no">
                        @if($errors->has('lc_no'))
                         <p class="text-danger" >{{ $errors->first('lc_no') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Vessel</label>
                        <input value="{{$model->vessel}}" name="vessel" 
                        class="form-control" placeholder="Vessel">
                        @if($errors->has('vessel'))
                         <p class="text-danger" >{{ $errors->first('vessel') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">IGM No</label>
                        <input value="{{$model->igmno}}" name="igmno" 
                        class="form-control" placeholder="IGM No">
                        @if($errors->has('igmno'))
                         <p class="text-danger" >{{ $errors->first('igmno') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">BL/AWB No</label>
                        <input readonly value="{{$model->blawbno}}"
                        class="form-control" placeholder="BL/AWB No">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Port Of Shippment</label>
                        <input value="{{$model->port_of_shippment}}" name="port_of_shippment" 
                        class="form-control" placeholder="Port Of Shippment">
                        @if($errors->has('port_of_shippment'))
                         <p class="text-danger" >{{ $errors->first('port_of_shippment') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Country Origion</label>
                        <input value="{{$model->country_origion}}" name="country_origion" 
                        class="form-control" placeholder="Country Origion">
                        @if($errors->has('country_origion'))
                         <p class="text-danger" >{{ $errors->first('country_origion') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Rate Of Exchange</label>
                        <input type="number"  value="{{$model->rate_of_exchange}}" name="rate_of_exchange" 
                        class="form-control" placeholder="Rate Of Exchange">
                        @if($errors->has('rate_of_exchange'))
                         <p class="text-danger" >{{ $errors->first('rate_of_exchange') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Master Agent</label>
                        <input  value="{{$model->master_agent}}" name="master_agent" 
                        class="form-control" placeholder="Master Agent">
                        @if($errors->has('master_agent'))
                         <p class="text-danger" >{{ $errors->first('master_agent') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Due Date</label>
                        <input type="date"  value="{{$model->due_date}}" name="due_date" 
                        class="form-control" placeholder="Due Date">
                        @if($errors->has('due_date'))
                         <p class="text-danger" >{{ $errors->first('due_date') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Gross</label>
                        <input type="number"  value="{{$model->gross}}" name="gross" 
                        class="form-control" placeholder="Gross">
                        @if($errors->has('gross'))
                         <p class="text-danger" >{{ $errors->first('gross') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Nett</label>
                        <input type="number"  value="{{$model->nett}}" name="nett" 
                        class="form-control" placeholder="Nett">
                        @if($errors->has('nett'))
                         <p class="text-danger" >{{ $errors->first('nett') }}</p>
                        @endif 
                    </div>
                </div>



                  <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-info">Submit</button>
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