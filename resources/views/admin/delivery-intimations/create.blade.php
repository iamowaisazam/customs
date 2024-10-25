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
        <h4 class="text-themecolor">Delivery Intimation
        </h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Delivery Intimation</li>
            </ol>
        </div>
    </div>
</div>



@if(!isset($model))

<form method="get" action="{{URL::to('admin/delivery-intimations/create')}}" >
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <header class="card-header bg-info">
                    <h4 class="mb-0 text-white">Search Challan</h4>
                </header>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Job Number</label>
                                <input value="{{request()->job_number}}" name="job_number" 
                                  class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-info">Search</button>
                         </div>
                    </div>
                </div>
           </section>
        </div>
    </div>
</form>

@else
 
   <form method="post" action="{{URL::to('admin/delivery-intimations')}}" >
        @csrf
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <header class="card-header bg-info">
                    <h4 class="mb-0 text-white" >Create Delivery Intimation</h4>
                </header>
                <div class="card-body">
                    <div class="row">
                    
                        <input type="hidden" name="challan_id" value="{{$model->challan->id}}" />

                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Message</label>
                                <textarea required name="message" rows="5" class="form-control"></textarea>
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
                              <label class="form-label">Your REF</label>
                              <input readonly class="form-control" value="{{$model->your_ref}}">
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">Port</label>
                              <input readonly value="{{$model->port}}" class="form-control">
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">EIF/FI NO</label>
                              <input readonly value="{{$model->eiffino}}" class="form-control">
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">Import/Exporter Messers</label>
                              <input readonly value="{{$model->import_exporter_messers}}" class="form-control" />
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">Consignee by / To</label>
                              <input readonly value="{{$model->consignee_by_to}}" class="form-control">
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">Invoice Value</label>
                              <input readonly value="{{$model->invoice_value}}" 
                              class="form-control" />
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">Invoice Currency</label>
                              <input readonly value="{{$model->currency}}" 
                              class="form-control" />
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">Freight</label>
                              <input readonly value="{{$model->freight}}" class="form-control" />
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">Ins Rs</label>
                              <input readonly value="{{$model->ins_rs}}" 
                              class="form-control">
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">US $</label>
                              <input readonly value="{{$model->us}}" class="form-control" />
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">LC no</label>
                              <input readonly value="{{$model->lc_no}}" 
                               class="form-control" />
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">Vessel</label>
                              <input readonly value="{{$model->vessel}}" class="form-control" /> 
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">IGM No</label>
                              <input readonly value="{{$model->igmno}}" class="form-control" /> 
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">BL/AWB No</label>
                              <input readonly value="{{$model->blawbno}}"
                              class="form-control" >
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">Port Of Shippment</label>
                              <input readonly value="{{$model->port_of_shippment}}"  class="form-control"  />
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">Country Origion</label>
                              <input readonly value="{{$model->country_origion}}" 
                              class="form-control">
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">Rate Of Exchange</label>
                              <input readonly required type="number" value="{{$model->rate_of_exchange}}" 
                              class="form-control" /> 
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">Master Agent</label>
                              <input readonly required value="{{$model->master_agent}}" class="form-control" >
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">Due Date</label>
                              <input readonly required type="date" value="{{ \Carbon\Carbon::parse($model->due_date)->format('Y-m-d') }}" class="form-control" />
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">Gross</label>
                              <input readonly required type="number" value="{{$model->gross}}" class="form-control" />
                          </div>
                      </div>
      
                      <div class="col-md-3">
                          <div class="form-group">
                              <label class="form-label">Nett</label>
                              <input readonly required type="number" value="{{$model->nett}}"  class="form-control" />
                          </div>
                      </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a class="btn btn-danger" href="{{URL::to('admin/delivery-intimations/create')}}" >Cancel</a>
                           <button type="submit" class="btn btn-info">Generate Intimation</button>
                        </div>
                    </div>
                </div>
             </section>
           </div>
        </div>
    </form>
@endif
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