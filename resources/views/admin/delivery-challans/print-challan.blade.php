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
            <span style="width:99px" class="value"></span> 
        </div>
        <div class="box-row" >
            <span class="label" >Import / Exporter Messers:</span>  
            <span style="width:176px" class="value"></span> 
        </div>
    </div>

    <div class="box" >
     
        <div class="box-row" >
            <span class="label" >Consignee by / To:</span>  
            <span style="width:142px" class="value"></span> 
        </div>

        <div class="box-row" >
            <span class="label" >Invoice Value:</span>  
            <span style="width:74px" class="value"></span> 
        </div>
        <div class="box-row" >
            <span class="label" >Invoice Currency:</span>  
            <span style="width:86px" class="value"></span> 
        </div>

    </div>

    <div class="box" >

        <div class="box-row" >
            <span class="label" >Freight:</span>  
            <span style="width:86px" class="value"></span> 
        </div>
        <div class="box-row" >
            <span class="label" >Ins Rs:</span>  
            <span style="width:80px" class="value"></span> 
        </div>
        <div class="box-row" >
            <span class="label" >US $:</span>  
            <span style="width:80px" class="value"></span> 
        </div>
        <div class="box-row" >
            <span class="label" >LC no:	</span>  
            <span style="width:80px" class="value"></span> 
        </div>
        <div class="box-row" >
            <span class="label" >Date:	</span>  
            <span style="width:78px" class="value">{{date('d-m-Y', strtotime($model->consignment->created_at))}}</span> 
        </div>
    </div>

  

    <div class="box">
        <div class="box-row" >
            <span class="label">Vessel:</span>  
            <span style="width:71px" class="value"></span> 
        </div>
        <div class="box-row" >
            <span class="label">IGM No:</span>  
            <span style="width:67px" class="value"></span> 
        </div>
        <div class="box-row" >
            <span class="label">Date:</span>  
            <span style="width:86px" class="value">{{date('d-m-Y', strtotime($model->consignment->created_at))}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">BL/AWB No:</span>  
            <span style="width:55px" class="value"></span> 
        </div>
        <div class="box-row" >
            <span class="label">Date:</span>  
            <span style="width:81px" class="value">{{date('d-m-Y', strtotime($model->consignment->created_at))}}</span> 
        </div>
    </div>

    <div class="box">
      
        <div class="box-row" >
            <span class="label">Port of shippment:</span>  
            <span style="width:86px" class="value"></span> 
        </div>
        <div class="box-row" >
            <span class="label">Country Origion:</span>  
            <span style="width:120px" class="value"></span> 
        </div>
        <div class="box-row" >
            <span class="label">Rate Of Exchange:</span>  
            <span style="width:92px" class="value"></span> 
        </div>
    </div>

    <div class="box">
   
        <div class="box-row" >
            <span class="label">Master Agent:</span>  
            <span style="width:99px" class="value"></span> 
        </div>
        <div class="box-row" >
            <span class="label">Due Date:</span>  
            <span style="width:122px" class="value">{{date('d-m-Y', strtotime($model->consignment->created_at))}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Net:</span>  
            <span style="width:81px" class="value"></span> 
        </div>
        <div class="box-row" >
            <span class="label">Gross:</span>  
            <span style="width:108px" class="value"></span> 
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