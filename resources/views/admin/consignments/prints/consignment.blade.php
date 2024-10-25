

<div class="my-table" >

    <div class="box" >
        <div class="box-row" > 
            <span class="label" >Job Number:</span>
            <span style="width: 91px" class="value" >{{$model->job_number_prefix}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Date:</span>  
            <span style="width: 87px" class="value" >{{date('d-m-Y', strtotime($model->created_at))}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Your REF:</span>  
            <span style="width: 137px"  class="value" >{{$model->your_ref}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Date:</span>  
            <span style="width:91px" class="value" >{{date('d-m-Y', strtotime($model->created_at))}}</span> 
        </div>
    </div>
    <div class="box" >
      
        <div class="box-row" >
            <span class="label" >Port:</span>  
            <span style="width:91px" class="value">{{$model->port}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >EIF / FI NO:</span>  
            <span style="width:99px" class="value">{{$model->eiffino}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Import / Exporter Messers:</span>  
            <span style="width:176px" class="value">{{$model->import_exporter_messers}}</span> 
        </div>
    </div>

    <div class="box" >
     
        <div class="box-row" >
            <span class="label" >Consignee by / To:</span>  
            <span style="width:142px" class="value">{{$model->consignee_by_to}}</span> 
        </div>

        <div class="box-row" >
            <span class="label" >Invoice Value:</span>  
            <span style="width:74px" class="value">{{$model->invoice_value}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Invoice Currency:</span>  
            <span style="width:86px" class="value">{{$model->currency}}</span> 
        </div>

    </div>

    <div class="box" >

        <div class="box-row" >
            <span class="label" >Freight:</span>  
            <span style="width:86px" class="value">{{$model->freight}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Ins Rs:</span>  
            <span style="width:80px" class="value">{{$model->ins_rs}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >US $:</span>  
            <span style="width:80px" class="value">{{$model->us}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >LC no:	</span>  
            <span style="width:80px" class="value">{{$model->lc_no}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Date:	</span>  
            <span style="width:78px" class="value">{{date('d-m-Y', strtotime($model->created_at))}}</span> 
        </div>
    </div>

  

    <div class="box">
        <div class="box-row" >
            <span class="label">Vessel:</span>  
            <span style="width:71px" class="value">{{$model->vessel}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">IGM No:</span>  
            <span style="width:67px" class="value">{{$model->igmno}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Date:</span>  
            <span style="width:86px" class="value">{{date('d-m-Y', strtotime($model->created_at))}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">BL/AWB No:</span>  
            <span style="width:55px" class="value">{{$model->blawbno}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Date:</span>  
            <span style="width:81px" class="value">{{date('d-m-Y', strtotime($model->created_at))}}</span> 
        </div>
    </div>

    <div class="box">
      
        <div class="box-row" >
            <span class="label">Port of shippment:</span>  
            <span style="width:86px" class="value">{{$model->port_of_shippment}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Country Origion:</span>  
            <span style="width:120px" class="value">{{$model->country_origion}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Rate Of Exchange:</span>  
            <span style="width:92px" class="value">{{$model->rate_of_exchange}}</span> 
        </div>
    </div>

    <div class="box">
        <div class="box-row" >
            <span class="label">Master Agent:</span>  
            <span style="width:160px" class="value">{{$model->master_agent}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Due Date:</span>  
            <span style="width:90px" class="value">{{date('d-m-Y', strtotime($model->due_date))}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Net:</span>  
            <span style="width:72px" class="value">{{$model->nett}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Gross:</span>  
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