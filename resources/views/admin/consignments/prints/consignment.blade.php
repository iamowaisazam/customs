

<div class="my-table" >

    <div class="box" >
        <div class="box-row" > 
            <span class="label" >Job Number:</span>
            <span style="width: 91px" class="value" >{{$model->job_number_prefix}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Your REF:</span>  
            <span style="width: 137px"  class="value" >{{$model->your_ref}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Machine No:</span>  
            <span style="width: 208px"  class="value" >{{$model->machine_number}}</span> 
        </div>
    </div>
    <div class="box" >
      
        <div class="box-row" >
            <span class="label" >Port:</span>  
            <span style="width:91px" class="value">{{$model->port}}</span> 
        </div>
     

        <div class="box-row" >
            <span class="label" >Importer / Expoter Company Name:</span>  
            <span style="width:329px" class="value">{{$model->import_exporter_messers}}</span> 
        </div>
        
    </div>

    <div class="box" >

        <div class="box-row" >
            <span class="label" >EIF / FI NO:</span>  
            <span style="width:99px" class="value">{{$model->eiffino}}</span> 
        </div>

        <div class="box-row" >
            <span class="label" >Consignee by / To:</span>  
            <span style="width:142px" class="value">{{$model->consignee_by_to}}</span> 
        </div>

        
        <div class="box-row" >
            <span class="label" >Total Quantity:</span>  
            <span style="width:129px" class="value">{{$model->total_quantity}}</span> 
        </div>
    </div>

    <div class="box" >

        <div class="box-row" >
            <span class="label" >Invoice Value:</span>  
            <span style="width:129px" class="value">{{$model->invoice_value}}</span> 
        </div>

        <div class="box-row" >
            <span class="label" >Invoice Currency:</span>  
            <span style="width:54px" class="value">{{$model->currency}}</span> 
        </div>

        <div class="box-row" >
            <span class="label" >Freight:</span>  
            <span style="width:86px" class="value">{{$model->freight}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Ins Rs:</span>  
            <span style="width:52px" class="value">{{$model->ins_rs}}</span> 
        </div>
        
       
       
    </div>

    <div class="box" >

        <div class="box-row" >
            <span class="label" >Landing Charges:</span>  
            <span style="width:104px" class="value">{{$model->landing_charges}}</span> 
        </div>

        <div class="box-row" >
            <span class="label" >US $:</span>  
            <span style="width:81px" class="value">{{$model->us}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >LC no:	</span>  
            <span style="width:119px" class="value">{{$model->lc_no}}</span> 
        </div>

        <div class="box-row" >
            <span class="label" >LC Date: </span>  
            <span style="width:80px" class="value">{{date('d-m-Y', strtotime($model->lc_date))}}</span> 
        </div>
    </div>
    
    <div class="box">
        <div class="box-row" >
            <span class="label">Vessel:</span>  
            <span style="width:87px" class="value">{{$model->vessel}}</span> 
        </div>
        
        <div class="box-row" >
            <span class="label">IGM No:</span>  
            <span style="width:109px" class="value">{{$model->igmno}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">IGM Date:</span>  
            <span style="width:105px" class="value">{{date('d-m-Y', strtotime($model->igm_date))}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">BL/AWB No:</span>  
            <span style="width:93px" class="value">{{$model->blawbno}}</span> 
        </div>

        

    </div>

    <div class="box">
        <div class="box-row" >
            <span class="label">BL/AWB Date:</span>  
            <span style="width:138px" class="value">{{date('d-m-Y', strtotime($model->bl_awb_date))}}</span> 
        </div>

        <div class="box-row" >
            <span class="label">Port of shippment:</span>  
            <span style="width:86px" class="value">{{$model->port_of_shippment}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Country Origion:</span>  
            <span style="width:107px" class="value">{{$model->country_origion}}</span> 
        </div>
       
    </div>

    <div class="box">
        <div class="box-row" >
            <span class="label">Rate Of Exchange:</span>  
            <span style="width:92px" class="value">{{$model->rate_of_exchange}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Master Agent:</span>  
            <span style="width:160px" class="value">{{$model->master_agent}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Arival Date:</span>  
            <span style="width:105px" class="value">{{date('d-m-Y', strtotime($model->due_date))}}</span> 
        </div>
  
    </div>

    <div class="box">
        <div class="box-row" >
            <span class="label">No Of Packages:</span>  
            <span style="width:57px" class="value">{{$model->no_of_packages}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Index No:</span>  
            <span style="width:54px" class="value">{{$model->index_no}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Net Weight:</span>  
            <span style="width:72px" class="value">{{$model->nett}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Gross Weight:</span>  
            <span style="width:88px" class="value">{{$model->gross}}</span> 
        </div>
    </div>
</div>

{{-- <div class="signature_box" >
<div class="" >
    <div style="border-bottom: 1px solid black" >
        <label class="form-label">Receiver Signature &amp; Stamp</label>
    </div>
    <div  style="border-bottom: 1px solid black"  > 
        <label class="form-label">Oceanic Logistics</label>
    </div>
</div>
</div> --}}