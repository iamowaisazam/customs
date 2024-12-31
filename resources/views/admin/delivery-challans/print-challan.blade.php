
<div class="header text-center">
    <h4 class="heading" >Oceanic Logistics</h4>
    <h6 style="padding-bottom: 13px" class="sub-heading" >Creating, Forwarding And Shipping Agent</h6>

    <h6 class="sub-heading" style="border: 1px solid;
    margin: 10px 15px;
    font-weight: bold;" 
    >DELIVERY CHALLAN</h6>
</div>

<div class="my-table" >

    <div class="box" >
        <div class="box-row" > 
            <span class="label" >Job No:</span>
            <span style="width: 140px" class="value" >{{$consignment->job_number_prefix}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Consignee Company Name:</span>  
            <span style="width: 317px" class="value">{{$consignment->customer->company_name}}</span> 
        </div>
        
       
        
    </div>
    <div class="box" >
        
        <div class="box-row" >
            <span class="label" >IGM No:</span>  
            <span style="width: 95px"  class="value" >{{$consignment->igmno}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Package Type:</span>  
            <span style="width: 128px"  class="value" >{{$consignment->package_type}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >LC/BT/TT No:</span>  
            <span style="width:209px" class="value">{{$consignment->lc}}</span> 
        </div>
    </div>

    <div class="box" >
        
        <div class="box-row" >
            <span class="label">Packages:</span>  
            <span style="width:93px" class="value">{{$consignment->no_of_packages}}</span> 
        </div>

        <div class="box-row" >
            <span class="label" >Item Name:</span>  
            <span style="width:468px" class="value">
                {{implode(' , ',$consignment->Items->pluck('name')->toArray())}}
            </span> 
        </div>
    </div>

    <div class="box" >
        <div class="box-row" >
            <span class="label">BL No:</span>  
            <span style="width:86px" class="value">{{$consignment->blawbno}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >Port:	</span>  
            <span style="width:168px" class="value">{{$consignment->pol}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Country:</span>  
            <span style="width:302px" class="value">{{$consignment->country_origion}}</span> 
        </div>
    </div>

    <div class="box" >
        <div class="box-row" >
            <span class="label">Net Weight:</span>  
            <span style="width:86px" class="value">{{$consignment->net}}</span> 
        </div>
        <div class="box-row">
            <span class="label">Gross Weight:</span>  
            <span style="width:90px" class="value">{{$consignment->gross}}</span> 
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
  <p class="text-center mt-4 mb-0" style="font-weight: 600;">Goods Delivered In Orignal Sealed Condition </p>
</div>