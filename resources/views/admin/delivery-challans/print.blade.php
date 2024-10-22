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
        <h4 class="text-themecolor">Delivery Challans</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Delivery Challans</li>
            </ol>
        </div>
    </div>
</div>

<form method="post" action="{{URL::to('admin/delivery-challans')}}/{{Crypt::encryptString($model->id)}}" >
    @csrf
    @method('PUT')

    <div class="row">

    


    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              
                <h4 class="card-title" style="text-align: center; font-size: 30px;font-weight: 600;">Oceanic Logistics</h4>
                <h6 class="card-subtitle" style="text-align: center; font-size: 20px;font-weight: 400;">Creating, Forwarding And Shipping Agenct
                    </h6>
                    <h6 class="card-subtitle" style="text-align: center; font-size: 20px;font-weight: 600;">DELIVERY CHALLAN
                    </h6>
                    <hr>
                
                <form class="form-material m-t-40">
                    
                  <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Job Number (Auto)</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Date</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Your REF</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Port</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">EIF/FI NO</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Import/Exporter Messers</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Consignee by / To</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Invoice Vlaue</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"> Invoice Currency</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Freight</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Ins Rs</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"> US $</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">LC no</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Date</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"> Vessel</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">IGM No</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Date</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"> BL/AWB No</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"> Date</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">port of shippment</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Country Origion</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"> Rate Of Exchange</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"> Master Agent</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Due Date</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Gross</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"> Nett</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>

                  </div>
                    
                 
                  
                  
                  
                </form>
            </div>

            <div class="card-body">
               
                <form class="form-control-line m-t-40">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Receiver Signature &amp; Stamp</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="col-md-4">
                           
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Oceanic Logistics</label>
                                <input type="text" class="form-control"> 
                            </div>
                        </div>
                    </div>
                   
                </form>
            </div>
        </div>
    </div>



</div>

</form>
@endsection
@section('js')
    


@endsection