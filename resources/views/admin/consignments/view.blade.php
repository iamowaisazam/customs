@extends('admin.partials.layout')
@section('css')
<style>
    .invalid-feedback{
      display: block;
   }

  
</style>
@endsection

@section('content')

<?php

$ports = $_s['ports'] ? json_decode($_s['ports']) : [];
$port_of_shipments = $_s['port_of_shipment'] ? json_decode($_s['port_of_shipment']) : [];
$documents = $_s['documents'] ? json_decode($_s['documents']) : [];

$options = '';

foreach ($documents as $value) {
    $options .= '<option value="'.$value.'">'.$value.'</option>';
}


// dd($model->Item);

?>
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
                            <input readonly type="text" @if($model) value="{{$model->job_number_prefix}}" @else value="{{$job_number}}" @endif name="job_number" 
                            class="form-control" placeholder="Job Number">
                            @if($errors->has('job_number'))
                             <p class="text-danger" >{{ $errors->first('job_number') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Consignee (Company Name)</label>
                            <select disabled name="customer_id" class="form-control" >
                                <option value="">Select Consignee</option>
                                @foreach ($customers as $item)
                                    <option @if($model && $item->id == $model->customer_id) selected @endif value="{{$item->id}}">{{$item->company_name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('customer_id'))
                             <p class="text-danger" >{{ $errors->first('customer_id') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Exporter Company Name</label>
                            <input disabled @if($model) value="{{$model->exporter}}" @endif name="exporter" 
                            class="form-control" placeholder="Exporter Company Name">
                            @if($errors->has('exporter'))
                             <p class="text-danger" >{{ $errors->first('exporter') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Select Invoice Currency</label>
                            <select disabled class="form-control" name="currency">
                                @foreach ($currencies as $cr)
                                <option @if($model && $model->currency == $cr['code']) selected @endif value="{{$cr['code']}}">{{$cr['code']}}</option>
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

    <div class="col-12">
        <section class="consignment-price card">
            <header  class="card-header d-flex justify-content-between">
                <h4 class="mb-0 text-white ">Item Details</h4>
            </header>
            <div class="card-body">
                <div class="rows" >
                    @foreach ($model->Items as $key => $item)
                    <div class="row">
                        <div class="col-sm-3 nopadding">
                            <div class="form-group">
                                <label for="title">Item Name</label><br>
                                <input readonly class="form-control" value="{{$item->name}}" />
                            </div>
                        </div>
                        <div class="col-sm-2 nopadding">
                            <div class="form-group">
                                <label for="hs_code">Hs Code</label>
                                <input readonly class="form-control"
                                value="{{$item->hs_code}}"  />
                            </div>
                        </div>
                        <div class="col-sm-2 nopadding">
                            <div class="form-group">
                                <label for="Quantity">Quantity</label>
                                <input readonly class="form-control" 
                                  value="{{$item->qty}}"  />
                            </div>
                        </div>
                          <div class="col-sm-1 nopadding">
                            <div class="form-group">
                                <label>Unit</label><br>
                                <input readonly class="form-control" value="{{$item->unit}}" />
                            </div>
                        </div>
                        <div class="col-sm-2 nopadding">
                            <div class="form-group">
                                <label>Amount</label>
                                <input readonly type="number" class="form-control" 
                                 value="{{$item->price}}" />
                            </div>
                        </div>
                        <div class="col-sm-2 nopadding">
                            <div class="form-group">
                                <label for="Date">Total</label>
                                <div class="input-group">
                                    <input readonly type="number"value="{{$item->total}}" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="price-summary">
                  <div class="row" >
                    <div class="col-md-10 text-end"><p><b>Total Quantity </b></p></div>
                    <div class="col-md-2 total_quantity"> : <span>{{$model->totalWeight()}}</span></div>
                  </div>
                  <div class="row">
                    <div class="col-md-10 text-end"><p><b>Total Value </b></p></div>
                    <div class="col-md-2 total_value"> : <span>{{$model->invoice_value}}</span></div>
                  </div>
               </div>
            </div>
          </section>
    </div>

    @if($model)
    
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                  <h4 class="mb-0 text-white">Consignment information</h4>
            </header>
            <div class="card-body">

               <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Created Date</label>
                        <input disabled  value="{{\Carbon\Carbon::parse($model->created_at)->format('Y-m-d H:i:s A') }}" class="form-control" />
                    </div>
                </div>

                  <div class="col-md-3">
                      <div class="form-group">
                          <label class="form-label">Job Number</label>
                          <input readonly value="{{$model->job_number_prefix}}"
                          class="form-control">
                      </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Consignee (Company Name)</label>
                        <input readonly value="{{$model->customer->company_name}}" 
                        class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Exporter Company Name</label>
                        <input readonly value="{{$model->exporter}}"  class="form-control">
                    </div>
                </div>

                  <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Total Quantity</label>
                        <input readonly value="{{$model->total_quantity}}" 
                        class="form-control" placeholder="Total Quantity">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Total Invoice Value</label>
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
                        <label class="form-label">PO Number</label>
                        <input disabled  value="{{$model->po_number}}" name="po_number" 
                        class="form-control" placeholder="PO Number">
                        @if($errors->has('po_number'))
                         <p class="text-danger" >{{ $errors->first('po_number') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label"> Machine Number </label>
                        <input readonly value="{{$model->machine_number}}" name="machine_number" 
                         class="form-control" placeholder="Machine Number">
                        @if($errors->has('machine_number'))
                         <p class="text-danger" >{{ $errors->first('machine_number') }}</p>
                        @endif 
                    </div>
                </div>  

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">POL</label>
                        <select disabled class="form-control" name="pol" >
                        @foreach ($ports as $port)
                            <option @if($model->pol == $port) selected @endif value="{{$port}}">{{$port}}</option>
                        @endforeach
                        </select>
                        @if($errors->has('pol'))
                         <p class="text-danger" >{{ $errors->first('pol') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">POD</label>
                        <select disabled class="form-control" name="pod" >
                          @foreach ($port_of_shipments as $shipment)
                          <option @if($model->pod == $shipment) selected @endif 
                            value="{{$shipment}}">{{$shipment}}</option>  
                          @endforeach
                        </select>
                        @if($errors->has('pod'))
                         <p class="text-danger" >{{ $errors->first('pod') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">EIF/FI NO</label>
                        <input disabled  value="{{$model->eiffino}}" name="eiffino" 
                        class="form-control" placeholder="EIF/FI NO">
                        @if($errors->has('eiffino'))
                         <p class="text-danger" >{{ $errors->first('eiffino') }}</p>
                        @endif 
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Frieght in FC</label>
                        <input disabled required type="number" value="{{$model->freight}}" 
                        name="freight" class="form-control" placeholder="Freight">
                        @if($errors->has('freight'))
                         <p class="text-danger" >{{ $errors->first('freight') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Insurance In PKR</label>
                        <input disabled required type="number" value="{{$model->insurance_in_pkr}}" name="insurance_in_pkr" 
                        class="form-control" placeholder="Insurance In PKR">
                        @if($errors->has('insurance_in_pkr'))
                         <p class="text-danger" >{{ $errors->first('insurance_in_pkr') }}</p>
                        @endif 
                    </div>
                </div>

     
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Insurance In FC</label>
                        <input disabled readonly  value="{{$model->insurance_in_fc}}" name="insurance_in_fc" 
                        class="form-control" placeholder="FC (Foreign Currency)">
                        @if($errors->has('insurance_in_fc'))
                         <p class="text-danger" >{{ $errors->first('insurance_in_fc') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Lc / Bt / TT No</label>
                        <input disabled value="{{$model->lc}}" name="lc" 
                        class="form-control" placeholder="Lc / Bt / TT No">
                        @if($errors->has('lc'))
                         <p class="text-danger" >{{ $errors->first('lc') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">LC Date</label>
                        <input disabled type="date"  value="{{ \Carbon\Carbon::parse($model->lc_date)->format('Y-m-d')}}" name="lc_date" 
                        class="form-control" placeholder="LC Date">
                        @if($errors->has('lc_date'))
                         <p class="text-danger" >{{ $errors->first('lc_date') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Vessel / Flight Name</label>
                        <input disabled  value="{{$model->vessel}}" name="vessel" 
                        class="form-control" placeholder="Vessel">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">IGM No</label>
                        <input disabled value="{{$model->igmno}}" name="igmno" 
                        class="form-control" placeholder="IGM No" />
                        @if($errors->has('igmno'))
                         <p class="text-danger" >{{ $errors->first('igmno') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">IGM Date</label>
                        <input disabled type="date"  value="{{\Carbon\Carbon::parse($model->igm_date)->format('Y-m-d') }}" name="igm_date" class="form-control" placeholder="IGM Date" />
                        @if($errors->has('igm_date'))
                         <p class="text-danger" >{{ $errors->first('igm_date') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Index No</label>
                        <input disabled  value="{{$model->index_no}}" name="index_no" 
                        class="form-control" placeholder="Index No">
                        @if($errors->has('index_no'))
                         <p class="text-danger" >{{ $errors->first('index_no') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">BL/AWB No</label>
                        <input disabled value="{{$model->blawbno}}"
                        class="form-control" name="blawbno" placeholder="BL/AWB No">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">BL/AWB Date</label>
                        <input disabled type="date" 
                        value="{{\Carbon\Carbon::parse($model->blawb_date)->format('Y-m-d') }}" name="blawb_date" 
                        class="form-control" placeholder="BL/AWB Date">
                        @if($errors->has('blawb_date'))
                         <p class="text-danger" >{{ $errors->first('blawb_date') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <?php 
                      $countries = \App\Enums\Country::DATA; 
                    ?>
                    <div class="form-group">
                        <label class="form-label">Country Origion</label>
                        <select disabled class="form-control" name="country_origion" >
                            @foreach ($countries as $country)
                             <option @if($model->country_origion == $country['name']) selected @endif value="{{$country['name']}}">{{$country['name']}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('country_origion'))
                         <p class="text-danger" >{{ $errors->first('country_origion') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Rate Of Exchange</label>
                        <input disabled type="number" value="{{$model->rate_of_exchange}}" 
                        name="rate_of_exchange" class="form-control" placeholder="Rate Of Exchange" />
                        @if($errors->has('rate_of_exchange'))
                         <p class="text-danger" >{{ $errors->first('rate_of_exchange') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Master Agent</label>
                        <input disabled value="{{$model->master_agent}}" name="master_agent" 
                        class="form-control" placeholder="Master Agent">
                        @if($errors->has('master_agent'))
                         <p class="text-danger" >{{ $errors->first('master_agent') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Freight Agent</label>
                        <input disabled   value="{{$model->freight_agent}}" name="freight_agent" 
                        class="form-control" placeholder="Freight Agent">
                        @if($errors->has('freight_agent'))
                         <p class="text-danger" >{{ $errors->first('freight_agent') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Arival Date</label>
                        <input disabled  type="date"  value="{{ \Carbon\Carbon::parse($model->arival_date)->format('Y-m-d') }}" name="due_date" 
                        class="form-control" placeholder="Arival Date">
                        @if($errors->has('arival_date'))
                         <p class="text-danger" >{{ $errors->first('arival_date') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Package Type</label>
                        <select disabled class="form-control" name="package_type" >
                            @foreach ($package_types as $p)
                                <option @if($model->package_type == $p) selected @endif 
                                 >{{$p}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('package_type'))
                         <p class="text-danger" >{{ $errors->first('package_type') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">No Of Packages</label>
                        <input disabled value="{{$model->no_of_packages}}" name="no_of_packages" 
                        class="form-control" placeholder="No of Packages">
                        @if($errors->has('no_of_packages'))
                         <p class="text-danger" >{{ $errors->first('no_of_packages') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Shipment No</label>
                        <input disabled value="{{$model->shipment_number}}" name="shipment_number" 
                        class="form-control" placeholder="Shipment No">
                        @if($errors->has('shipment_number'))
                         <p class="text-danger" >{{ $errors->first('shipment_number') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Mode Of Shipment</label>
                        <select disabled class="form-control" name="mode_of_shipment" >
                            <option @if($model->mode_of_shipment == 'by_sea') selected @endif value="by_sea">By Sea</option>
                            <option @if($model->mode_of_shipment == 'by_air') selected @endif value="by_air">By Air</option>
                        </select>
                        @if($errors->has('mode_of_shipment'))
                         <p class="text-danger" >{{ $errors->first('mode_of_shipment') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Gross Weight</label>
                        <input disabled  type="number"  value="{{$model->gross}}" name="gross" 
                        class="form-control" placeholder="Gross">
                        @if($errors->has('gross'))
                         <p class="text-danger" >{{ $errors->first('gross') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Net Weight</label>
                        <input disabled type="number" value="{{$model->net}}" name="net" 
                        class="form-control" placeholder="Net">
                        @if($errors->has('net'))
                         <p class="text-danger" >{{ $errors->first('net') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Remarks</label>
                        <textarea  readonly class="form-control" rows="5">{{$model->remarks}}</textarea>
                    </div>
                </div>

              </div> 
          </div>
      </section>
    </div>

   @if($model->net)
   <div class="col-lg-12">
    <section class="card">
        <header class="card-header bg-info">
              <h4 class="mb-0 text-white">Documents</h4>
        </header>
        <div class="card-body">

         <?php $data = json_decode($model->documents); ?>

         <div class="document_rows" >
             @if( $data)
             @foreach ($data as $key => $item)
                <div class="row">
                    <div class="col-md-6 nopadding">
                        <div class="form-group">
                            <label for="title">Document Name</label>
                            <select disabled class="form-control" name="documents[{{$key}}][name]">
                                @foreach ($documents as $document)
                                    <option @if($document == $item->name) selected @endif 
                                    value="{{$document}}">{{$document}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 nopadding">
                        <div class="form-group">
                            <label for="Date">Due Date</label>
                            <div class="input-group">
                                <input disabled  type="date" 
                                value="{{$item->date}}"
                                name="documents[{{$key}}][date]" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                 @endforeach
             @endif
            </div>
        </div>
    </section>
   </div>
   @endif

   @endif
</div>

@endsection
@section('js')
    


@endsection