<div class="header text-center">
    <h4 class="heading" >Oceanic Logistics</h4>
    <h6 style="padding-bottom: 13px" class="sub-heading" >Creating, Forwarding And Shipping Agenct</h6>

    <h6 class="sub-heading" style="border: 1px solid;
    margin: 10px 15px;
    font-weight: bold;" 
    >DELIVERY CHALLAN</h6>
</div>

<div class="my-table" >

    <div class="box" >
        <div class="box-row" > 
            <span class="label" >Job Number:</span>
            <span style="width: 91px" class="value" >{{$model->consignment->job_number_prefix}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Date:</span>  
            <span style="width: 87px" class="value" >{{date('d-m-Y', strtotime($model->consignment->created_at))}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Your REF:</span>  
            <span style="width: 137px"  class="value" >{{$model->consignment->your_ref}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Date:</span>  
            <span style="width:91px" class="value" >{{date('d-m-Y', strtotime($model->consignment->created_at))}}</span> 
        </div>
    </div>
    <div class="box" >
      
        <div class="box-row" >
            <span class="label" >Port:</span>  
            <span style="width:91px" class="value">{{$model->consignment->port}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >EIF / FI NO:</span>  
            <span style="width:99px" class="value">{{$model->consignment->eiffino}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Import / Exporter Messers:</span>  
            <span style="width:176px" class="value">{{$model->consignment->import_exporter_messers}}</span> 
        </div>
    </div>

    <div class="box" >
     
        <div class="box-row" >
            <span class="label" >Consignee by / To:</span>  
            <span style="width:142px" class="value">{{$model->consignment->consignee_by_to}}</span> 
        </div>

        <div class="box-row" >
            <span class="label" >Invoice Value:</span>  
            <span style="width:74px" class="value">{{$model->consignment->invoice_value}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Invoice Currency:</span>  
            <span style="width:86px" class="value">{{$model->consignment->currency}}</span> 
        </div>

    </div>

    <div class="box" >

        <div class="box-row" >
            <span class="label" >Freight:</span>  
            <span style="width:86px" class="value">{{$model->consignment->freight}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Ins Rs:</span>  
            <span style="width:80px" class="value">{{$model->consignment->ins_rs}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >US $:</span>  
            <span style="width:80px" class="value">{{$model->consignment->us}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >LC no:	</span>  
            <span style="width:80px" class="value">{{$model->consignment->lc_no}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Date:	</span>  
            <span style="width:78px" class="value">{{date('d-m-Y', strtotime($model->consignment->created_at))}}</span> 
        </div>
    </div>

  

    <div class="box">
        <div class="box-row" >
            <span class="label">Vessel:</span>  
            <span style="width:71px" class="value">{{$model->consignment->vessel}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">IGM No:</span>  
            <span style="width:67px" class="value">{{$model->consignment->igmno}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Date:</span>  
            <span style="width:86px" class="value">{{date('d-m-Y', strtotime($model->consignment->created_at))}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">BL/AWB No:</span>  
            <span style="width:55px" class="value">{{$model->consignment->blawbno}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Date:</span>  
            <span style="width:81px" class="value">{{date('d-m-Y', strtotime($model->consignment->created_at))}}</span> 
        </div>
    </div>

    <div class="box">
      
        <div class="box-row" >
            <span class="label">Port of shippment:</span>  
            <span style="width:86px" class="value">{{$model->consignment->port_of_shippment}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Country Origion:</span>  
            <span style="width:120px" class="value">{{$model->consignment->country_origion}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Rate Of Exchange:</span>  
            <span style="width:92px" class="value">{{$model->consignment->rate_of_exchange}}</span> 
        </div>
    </div>

    <div class="box">
        <div class="box-row" >
            <span class="label">Master Agent:</span>  
            <span style="width:160px" class="value">{{$model->consignment->master_agent}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Due Date:</span>  
            <span style="width:90px" class="value">{{date('d-m-Y', strtotime($model->consignment->due_date))}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Net:</span>  
            <span style="width:72px" class="value">{{$model->consignment->nett}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Gross:</span>  
            <span style="width:88px" class="value">{{$model->consignment->gross}}</span> 
        </div>
    </div>
</div>

<div class="signature_box" >
<div class="" >
    <div style="border-bottom: 1px solid black" >
        <label class="form-label">Receiver Signature &amp; Stamp</label>
    </div>
    <div  style="border-bottom: 1px solid black"  > 
        <label class="form-label">Oceanic Logistics</label>
    </div>
</div>
</div>