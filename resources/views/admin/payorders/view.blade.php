@extends('admin.partials.layout')
@section('css')
<style>
    .invalid-feedback{
      display: block;
   }

   .duties_label{
    width: 117px;

   }
</style>
@endsection

@section('content')

<?php

$ports = $_s['ports'] ? json_decode($_s['ports']) : [];
$port_of_shipments = $_s['port_of_shipment'] ? json_decode($_s['port_of_shipment']) : [];
$documents = $_s['documents'] ? json_decode($_s['documents']) : [];
$consignment = $model->consignment;

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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Job Number (Auto)</label>
                            <input readonly type="text" value="{{$consignment->job_number_prefix}}" class="form-control" placeholder="Job Number" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Consignee (Company Name)</label>
                            <input readonly  value="{{$consignment->customer->customer_name}}" 
                            class="form-control" placeholder="Consignee (Company Name)" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">BL/AWB No</label>
                            <input readonly value="{{$consignment->blawbno}}"
                            class="form-control" placeholder="BL/AWB No">
                        </div>
                    </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Package Type</label>
                            <input readonly class="form-control" value="{{$consignment->package_type}}" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">No Of Packages</label>
                        <input readonly value="{{$consignment->no_of_packages}}"  class="form-control" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Vessel / Flight Name</label>
                        <input readonly  value="{{$consignment->vessel}}"  
                        class="form-control" placeholder="Vessel">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">IGM No</label>
                        <input  readonly value="{{$consignment->igmno}}" class="form-control"  />
                    </div>
                </div>
                <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">IGM Date</label>
                            <input  type="date" readonly  value="{{ \Carbon\Carbon::parse($consignment->igm_date)->format('Y-m-d') }}" class="form-control" placeholder="IGM Date">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Select Invoice Currency</label>
                            <input  readonly  value="{{$consignment->currency}}" class="form-control"  />
                        </div>
                    </div>
                </div> 
            </div>
    </section>
    </div>


    <div class="col-12 payorder_items">
       
       @foreach ($consignment->items as $key => $item)
          <?php 
              $result = $item->calculate_payorder($consignment);
              
          ?>
        <section class="card">
            <header class="card-header bg-info">
                  <h4 class="mb-0 text-white">{{$item->name}} ({{$item->hs_code}})</h4>
            </header>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">Custom Duty :</label>
                            <input readonly style="width: 150px;" value="{{$item->custom_duty}}" class="form-control"  />
                            <input style="width: 150px;" value="{{$result['custom_duty']}}" readonly class="form-control" />
                        </div>

                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">Additional C.D :</label>
                            <input readonly type="number" style="width: 150px;" value="{{$item->a_custom_duty}}" class="form-control" placeholder="Additional C.D" />
                            <input value="{{$result['a_custom_duty']}}" style="width: 150px;" readonly class="form-control" />
                        </div>

                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">R.D :</label>
                            <input readonly type="number" style="width: 150px;" value="{{$item->rd}}" class="items form-control" placeholder="R.D" />
                            <input value="{{$result['rd']}}" style="width: 150px;" readonly class=" form-control" />
                        </div>

                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">Sale Tax :</label>
                            <input readonly style="width: 150px;" value="{{$item->saletax}}" class="form-control" placeholder="Sale Tax" />
                            <input value="{{$result['saletax']}}" style="width: 150px;" readonly class="form-control" />  
                        </div>

                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">Additional S.T :</label>
                            <input readonly type="number" style="width: 150px;" value="{{$item->a_saletax}}" class="form-control" placeholder="Additional S.T" />
                            <input value="{{$result['a_saletax']}}"  style="width: 150px;" readonly class="form-control" />
                        </div>

                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">Income Tax :</label>
                            <input readonly type="number" style="width: 150px;" value="{{$item->it}}" class="form-control" placeholder="Income Tax" />
                            <input readonly value="{{$result['it']}}"  style="width: 150px;" class="form-control" />
                        </div>

                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">ETO :</label>
                            <input readonly type="number" style="width: 150px;" value="{{$item->eto}}" class="form-control" placeholder="ETO" />
                            <input value="{{$result['eto']}}" readonly style="width: 150px;"  class="form-control" />
                        </div>
                        
                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">Total :</label>
                            <input readonly style="width: 150px;" value="{{$item->after_duties}}"  class="form-control"/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Invoice Value (USD) : </label>
                            <input style="width: 150px;" value="{{$item->total}}" readonly  class="form-control" placeholder="Invoice Value" />
                        </div>

                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Freight If Any (USD) : </label>
                            <input readonly style="width: 150px;" value="{{number_format($result['frieght_rate'],2)}}" class="form-control" placeholder="Freight" />
                        </div>

                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Value :</label>
                            <input readonly style="width: 150px;" 
                            value="{{number_format($result['value'],2)}}"  class="form-control" placeholder="Value" />
                        </div>

                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Invoice Value (PKR) : </label>
                            <input readonly style="width: 150px;" value="{{number_format($result['rate_exchange'],2)}}" class="form-control" placeholder="Exchange Rate" />
                        </div>

                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Insurance (PKR) : </label>
                            <input readonly style="width: 150px;" value="{{number_format($result['ins'],2)}}"  class="form-control" />
                        </div>

                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Landing Charges 1% (PKR) : </label>
                            <input readonly style="width: 150px;" value="{{number_format($result['landing_charges'],2)}}" class="form-control" placeholder="Landing Charges" />
                        </div>

                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Assets value (PKR) : </label>
                            <input readonly style="width: 150px;" value="{{number_format($result['asset_value'],2)}}" class="form-control" placeholder="Assets value" />
                         </div>

                      </div>
                    </div>
                </div>
         </section>
       @endforeach


       <div class="accounts col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white">Additional Duties</h4>
            </header>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Stan Duty</label>
                            <input readonly type="number"  value="{{$model->stan_duty}}" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">PSW Fee</label>
                            <input readonly type="number"  value="{{$model->psw_fee}}" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">DRAP Fee</label>
                            <input readonly  type="number" value="{{$model->drap_fee}}" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
          </section>
         </div>
       </div>

        <div class="accounts col-lg-12">
            <section class="card">
                <header class="card-header bg-info">
                    <h4 class="mb-0 text-white">Accounts</h4>
                </header>
                <div class="card-body">
                    <?php 
                        $header = json_decode($model->header);
                        $footers = $model->footer ? json_decode($model->footer) : []; 
                    ?>
        
                    <div class="row">
                        <div class="col-md-5 nopadding">
                            <div class="form-group">
                                <label>Account</label>
                                <input readonly value="{{$header->title ?? ''}}"
                                class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-2 nopadding">
                                <label>Amount</label>
                                <input readonly value="{{$header->amount ?? ''}}" class="form-control" />
                        </div>
                        <div class="col-md-5 nopadding">
                            <div class="form-group">
                                <label>Pay Order In Favor OF</label>
                                    <input readonly value="{{$header->company ?? ''}}"  class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="data_rows">
                        @foreach ($footers as $key => $f)
                        <div class="row">
                                <div class="col-md-5 nopadding">
                                    <div class="form-group">
                                        <label>Account</label>
                                        <input readonly value="{{$f->title}}" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-2 nopadding">
                                        <label>Amount</label>
                                        <input readonly value="{{$f->amount}}" class="form-control" />
                                </div>
                                <div class="col-md-5 nopadding">
                                    <div class="form-group">
                                        <label>Pay Order In Favor OF</label>
                                        <div class="input-group">
                                            <input readonly value="{{$f->company}}" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
</form>


@endsection
@section('js')
    
<script>
   
</script>

@endsection