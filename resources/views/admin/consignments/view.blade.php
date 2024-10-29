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
                              <input readonly type="text" value="{{$model->job_number_prefix}}" name="job_number" class="form-control" placeholder="Job Number">
                          </div>
                      </div>
  
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="form-label">Consignee (Company Name)</label>
                              <input readonly type="text" value="{{$model->customer->company_name}}" class="form-control">
                          </div>
                      </div>
  
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="form-label"> BL/AWB No </label>
                              <input readonly value="{{$model->blawbno}}" 
                              name="blawbno" class="form-control" placeholder="BL/AWB No ">
                          </div>
                      </div>
  
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="form-label"> LC/BT/IT No </label>
                              <input readonly value="{{$model->lcbtitno}}" name="lcbtitno" 
                               class="form-control" placeholder="LC/BT/IT No">
                          </div>
                      </div>
  
                      <div class="col-md-8">
                          <div class="form-group">
                              <label class="form-label"> Description </label>
                              <input readonly value="{{$model->description}}" name="description" 
                               class="form-control" placeholder="Description">
                          </div>
                      </div>
  
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="form-label"> Invoice Value </label>
                              <input readonly value="{{$model->invoice_value}}" 
                              name="invoice_value" class="form-control" placeholder="Invoice Value">
                          </div>
                      </div>
  
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="form-label"> Invoice Quantity </label>
                              <input readonly value="{{$model->total_quantity}}" name="total_quantity" 
                               class="form-control" placeholder="Total Quantity">
                          </div>
                      </div>
  
                      <div class="col-md-4">
                          <div class="form-group">
                              <label class="form-label">Select Invoice Currency</label>
                              <input readonly value="{{$model->total_quantity}}" name="total_quantity" 
                              class="form-control" placeholder="Total Quantity">
                          </div>
                      </div>
  
                      <div class="col-12">
                        <?php 
                        if(isset($model)){
                            $data = json_decode($model->demands_received);
                        }else{
                            $data = [];
                        }
                        ?>
                        
                        <section class="consignment-price card">
                            <header style="border-bottom: 1px solid " class="py-4 card-heade">
                                <h4 class="mb-0 ">Amount Demand And Received With Date Against This Consignment</h4>
                            </header>
                            <div class="card-body">
                                <div class="rows" >
                                    @if($data)
                                    @foreach ($data as $key => $item)
                                        <div class="row">
                                            <div class="col-sm-3 nopadding">
                                                <div class="form-group">
                                                    <label for="title">Title Name</label>
                                                    <input readonly class="form-control" 
                                                    value="{{$item->title}}" >
                                                </div>
                                            </div>
                                            <div class="col-sm-2 nopadding">
                                                <div class="form-group">
                                                    <label>HS Code</label>
                                                    <input readonly class="form-control"
                                                    value="{{$item->hs_code}}" >
                                                </div>
                                            </div>
                                            <div class="col-sm-2 nopadding">
                                                <div class="form-group">
                                                    <label>Quantity</label>
                                                    <input readonly class="form-control" value="{{$item->qty}}" />
                                                </div>
                                            </div>
                                            <div class="col-sm-2 nopadding">
                                                <div class="form-group">
                                                    <label>Unit Value</label>
                                                    <input readonly class="form-control" 
                                                    value="{{$item->price}}" />
                                                </div>
                                            </div>
                                            <div class="col-sm-3 nopadding">
                                                <div class="form-group">
                                                    <label for="Date">Total</label>
                                                        <input readonly value="{{$item->total}}" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @endif
                                </div>
                             </div>
                          </section>
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
                          <input readonly value="{{$model->job_number_prefix}}"
                          class="form-control">
                      </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Your REF</label>
                        <input readonly value="{{$model->your_ref}}" name="your_ref" 
                        class="form-control" placeholder="Your REF">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label"> Machine Number </label>
                        <input readonly value="{{$model->machine_number}}" name="machine_number" 
                         class="form-control" placeholder="Machine Number">
                    </div>
                </div>  


                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Port</label>
                        <input readonly class="form-control" value="{{$model->port}}" >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">EIF/FI NO</label>
                        <input readonly value="{{$model->eiffino}}"
                        class="form-control" >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Importer / Expoter Company Name</label>
                        <input readonly value="{{$model->import_exporter_messers}}" 
                        class="form-control" >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Consignee by / To</label>
                        <input readonly value="{{$model->consignee_by_to}}" class="form-control" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Total Quantity</label>
                        <input readonly value="{{$model->total_quantity}}" 
                        class="form-control" >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Invoice Value</label>
                        <input readonly value="{{$model->invoice_value}}" 
                        class="form-control" >
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
                        <input readonly value="{{$model->freight}}" class="form-control"  />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Ins Rs</label>
                        <input readonly value="{{$model->ins_rs}}" name="ins_rs" 
                        class="form-control" >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Landing Charges</label>
                        <input readonly value="{{$model->landing_charges}}"  
                        class="form-control" >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">US $</label>
                        <input readonly value="{{$model->us}}"  
                        class="form-control" >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">LC no</label>
                        <input readonly value="{{$model->lc_no}}" class="form-control" 
                        placeholder="LC no" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">LC Date</label>
                        <input readonly type="date" value="{{ \Carbon\Carbon::parse($model->lc_date)->format('Y-m-d') }}" class="form-control"  />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Vessel</label>
                        <input readonly value="{{$model->vessel}}" name="vessel" 
                        class="form-control" placeholder="Vessel" /> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">IGM No</label>
                        <input readonly value="{{$model->igmno}}" name="igmno" 
                        class="form-control" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">IGM Date</label>
                        <input readonly type="date"  value="{{ \Carbon\Carbon::parse($model->igm_date)->format('Y-m-d') }}"  class="form-control" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">BL/AWB No</label>
                        <input readonly value="{{$model->blawbno}}" class="form-control" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">BL/AWB Date</label>
                        <input readonly type="date" 
                        value="{{ \Carbon\Carbon::parse($model->bl_awb_date)->format('Y-m-d') }}" name="bl_awb_date" class="form-control" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Port Of Shippment</label>
                        <input readonly value="{{$model->port_of_shipment}}" 
                        class="form-control" />  
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Country Origion</label>
                        <input readonly value="{{$model->country_origion}}" 
                        class="form-control" >  
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Rate Of Exchange</label>
                        <input readonly value="{{$model->rate_of_exchange}}" 
                        class="form-control" >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Master Agent</label>
                        <input readonly value="{{$model->master_agent}}"  
                        class="form-control" placeholder="Master Agent">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Arival Date</label>
                        <input readonly value="{{ \Carbon\Carbon::parse($model->due_date)->format('Y-m-d') }}" class="form-control" placeholder="Arival Date" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">No Of Packages</label>
                        <input readonly value="{{$model->no_of_packages}}" 
                        class="form-control" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Index No</label>
                        <input readonly value="{{$model->index_no}}" 
                        class="form-control" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Gross Weight</label>
                        <input readonly value="{{$model->gross}}" 
                        class="form-control" placeholder="Gross" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Net Weight</label>
                        <input readonly value="{{$model->nett}}"  
                        class="form-control" />
                    </div>
                </div>
              </div> 
          </div>
      </section>
    </div>

    
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
                               <label>Document Name</label>
                               <input readonly value="{{$item->name}}" class="form-control" />
                           </div>
                       </div>
                       <div class="col-md-6 nopadding">
                           <div class="form-group">
                              <label>Due Date</label>
                              <input value="{{$item->date}}" class="form-control" />
                           </div>
                       </div>
                   </div>
                    @endforeach
                @endif
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

    });
</script>

@endsection