<div class="my-table">
    <div class="box" >
        <div class="box-row" > 
            <span class="label" >Job No:</span>
            <span style="width: 100px" class="value" >{{$model->job_number_prefix}}</span> 
        </div>
        <div class="box-row" > 
            <span class="label">Consignee:</span>
            <span style="width: 164px" class="value" >{{$model->job_number_prefix}}</span> 
        </div>
        <div class="box-row" > 
            <span class="label">Exporter:</span>
            <span style="width: 217px" class="value" >{{$model->exporter}}</span> 
        </div>
    </div>

    <div class="box" >
        <div class="box-row" >
            <span class="label" >Total Quantity:</span>  
            <span style="width: 100px"  class="value" >{{$model->total_quantity}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Total Invoice Value:</span>  
            <span style="width: 100px"  class="value" >{{$model->invoice_value}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Invoice Currency:</span>  
            <span style="width: 99px"  class="value" >{{$model->currency}}</span> 
        </div>
    </div>

    <div class="box" >
        <div class="box-row" >
            <span class="label" >Po No:</span>  
            <span style="width: 100px"  class="value" >{{$model->po_number}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Machine No:</span>  
            <span style="width: 100px"  class="value" >{{$model->machine_number}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >POL:</span>  
            <span style="width: 100px"  class="value" >{{$model->pol}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >POD:</span>  
            <span style="width: 162px"  class="value" >{{$model->pod}}</span> 
        </div>
    </div>

    <div class="box" >
        <div class="box-row" >
            <span class="label">EIF/FI NO:</span>  
            <span style="width: 100px"  class="value" >{{$model->eiffino}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Frieght in FC:</span>  
            <span style="width: 100px"  class="value" >{{$model->frieght}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Insurance In PKR:</span>  
            <span style="width: 193px"  class="value" >{{$model->insurance_in_pkr}}</span> 
        </div>
    </div>

    <div class="box" >
        <div class="box-row" >
            <span class="label">Insurance In FC:</span>  
            <span style="width:100px"  class="value" >{{$model->insurance_in_fc}}</span> 
        </div>
        <div class="box-row">
            <span class="label">Lc / Bt / TT No:</span>  
            <span style="width:100px"  class="value" >{{$model->lc}}</span> 
        </div>
        <div class="box-row">
            <span class="label">Lc Date:</span>  
            <span style="width:202px" class="value">{{date('d-m-Y', strtotime($model->lc_date))}}</span> 
        </div>
    </div>

    <div class="box" >
        <div class="box-row" >
            <span class="label">Vessel / Flight Name:</span>  
            <span style="width:100px"  class="value">{{$model->vessel}}</span> 
        </div>
        <div class="box-row">
            <span class="label">IGM No:</span>  
            <span style="width:100px"  class="value">{{$model->igmno}}</span> 
        </div>
        <div class="box-row">
            <span class="label">IGM Date:</span>  
            <span style="width:200px"  class="value">{{date('d-m-Y', strtotime($model->igm_date))}}</span> 
        </div>
    </div>

    <div class="box" >
        <div class="box-row" >
            <span class="label">BL/AWB No:</span>  
            <span style="width:100px"  class="value">{{$model->blawb}}</span> 
        </div>
        <div class="box-row">
            <span class="label">BL/AWB Date:</span>  
            <span style="width:100px"  class="value">{{date('d-m-Y', strtotime($model->blawb_date))}}</span> 
        </div>
        <div class="box-row">
            <span class="label">Country Origion:</span>  
            <span style="width:176px"  class="value" >{{$model->country_origion}}</span> 
        </div>
    </div>
    <div class="box" >
        <div class="box-row" >
            <span class="label">Rate Of Exchange:</span>  
            <span style="width:81px" class="value">{{$model->rate_of_exchange}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Master Agent:</span>  
            <span style="width:155px" class="value">{{$model->master_agent}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Freight Agent:</span>  
            <span style="width:106px" class="value">{{$model->freight_agent}}</span> 
        </div>
    </div>

    <div class="box" >
        <div class="box-row" >
            <span class="label">Arival Date:</span>  
            <span style="width:81px" class="value">{{$model->arival_date}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Package Type:</span>  
            <span style="width:155px" class="value">{{$model->package_type}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">No Of Packages:</span>  
            <span style="width:133px" class="value">{{$model->no_of_packages}}</span> 
        </div>
    </div>

    <div class="box" >
        <div class="box-row" >
            <span class="label">Shipment No:</span>  
            <span style="width:81px" class="value">{{$model->shipment_number}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Mode of Shipment:</span>  
            <span style="width:155px" class="value">{{ucwords(str_replace("_", " ", $model->mode_of_shipment))}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Gross Weight:</span>  
            <span style="width:105px" class="value">{{$model->no_of_packages}}</span> 
        </div>
        
    </div>
    <div class="box" >
        <div class="box-row" >
            <span class="label">Net Weight:</span>  
            <span style="width:110px" class="value">{{$model->no_of_packages}}</span> 
        </div>
    </div>


  
    
  

  

   

</div>

