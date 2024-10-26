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
                            <input readonly value="{{$model->job_number_prefix}}" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Consignee (Company Name)</label>
                            <input readonly value="{{$model->customer->company_name}}"
                            class="form-control" />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label"> BL/AWB No </label>
                            <input readonly value="{{$model->blawbno}}" class="form-control" />
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
                             class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Select Invoice Currency</label>
                            <input readonly value="{{$model->currency}}"
                             class="form-control" />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label"> Machine Number </label>
                            <input readonly value="{{$model->machine_number}}" readonly
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
                        <input readonly value="{{$model->your_ref}}" 
                        class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Port</label>
                        <input readonly value="{{$model->port}}"
                        class="form-control" >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">EIF/FI NO</label>
                        <input readonly value="{{$model->eiffino}}" 
                        class="form-control" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Import/Exporter Messers</label>
                        <input readonly value="{{$model->import_exporter_messers}}"
                        class="form-control"  />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Consignee by / To</label>
                        <input readonly value="{{$model->consignee_by_to}}" 
                        class="form-control"  />
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
                        class="form-control" >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Freight</label>
                        <input readonly value="{{$model->freight}}" 
                        class="form-control" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Ins Rs</label>
                        <input readonly value="{{$model->ins_rs}}" class="form-control" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">US $</label>
                        <input readonly value="{{$model->us}}"
                        class="form-control" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">LC no</label>
                        <input readonly value="{{$model->lc_no}}"
                        class="form-control"  />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Vessel</label>
                        <input readonly value="{{$model->vessel}}" 
                        class="form-control" >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">IGM No</label>
                        <input readonly value="{{$model->igmno}}"
                        class="form-control" >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">BL/AWB No</label>
                        <input readonly value="{{$model->blawbno}}"
                        class="form-control" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Port Of Shippment</label>
                        <input readonly value="{{$model->port_of_shippment}}" 
                        class="form-control" >
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
                        <input readonly  value="{{$model->rate_of_exchange}}" 
                        class="form-control" >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Master Agent</label>
                        <input required  value="{{$model->master_agent}}" name="master_agent" 
                        class="form-control" placeholder="Master Agent">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Due Date</label>
                        <input readonly value="{{ \Carbon\Carbon::parse($model->due_date)->format('Y-m-d') }}" class="form-control" >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Gross</label>
                        <input readonly value="{{$model->gross}}" 
                        class="form-control" >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Net</label>
                        <input readonly value="{{$model->nett}}"
                        class="form-control" />
                    </div>
                </div>
              </div> 
          </div>
      </section>
    </div>

    @if($model->nett)
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                  <h4 class="mb-0 text-white">Amount Demand And Received With Date Against This Consignment
                </h4>
            </header>
            <div class="card-body">

                <?php 
                   $data = json_decode($model->demands_received);
                ?>

                <div class="rows" >
                    @if( $data)
                    @foreach ($data as $key => $item)
                    <div class="row">
                        <div class="col-sm-3 nopadding">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input readonly class="form-control"
                                value="{{$item->title}}" >
                            </div>
                        </div>
                        <div class="col-sm-2 nopadding">
                            <div class="form-group">
                                <label for="Demand">Demands</label>
                                <input readonly class="form-control" 
                                value="{{$item->demand}}"  />
                            </div>
                        </div>
                        <div class="col-sm-2 nopadding">
                            <div class="form-group">
                                <label for="Received">Received</label>
                                <input readonly class="form-control" value="{{$item->received}}" />
                            </div>
                        </div>
                        <div class="col-sm-2 nopadding">
                            <div class="form-group">
                                <label for="Received">Pending</label>
                                <input readonly class="pending form-control" value="{{$item->pending ?? ''}}" />
                            </div>
                        </div>
                        <div class="col-sm-3 nopadding">
                            <div class="form-group">
                                <label for="Date">Date</label>
                                <input readonly value="{{$item->date}}" class="form-control" />
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



   @if($model->nett)
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
                                <input readonly class="form-control" value="{{$item->name}}" >
                            </div>
                        </div>
                        <div class="col-md-6 nopadding">
                            <div class="form-group">
                                <label for="Date">Date</label>
                                <input readonly type="date" value="{{$item->date}}" class="form-control" />
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


</div>

</form>
@endsection
@section('js')
    
<script>
    $(document).ready(function() {

    });
</script>

@endsection