
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
            <span class="label" >IGM Date:</span>  
            <span style="width:91px" class="value" >{{\Carbon\Carbon::parse($consignment->igm_date)->format('Y-m-d') }}</span> 
        </div>

        <div class="box-row" >
            <span class="label" >Index No:</span>  
            <span style="width:91px" class="value">{{$consignment->index_no}}</span> 
        </div>
        <div class="box-row" >
            <span class="label" >LC/BT/TT No:</span>  
            <span style="width:99px" class="value">{{$consignment->lc}}</span> 
        </div>
    </div>

    <div class="box" >
        
        <div class="box-row" >
            <span class="label">Number Of Packages:</span>  
            <span style="width:93px" class="value">{{$consignment->no_of_packages}}</span> 
        </div>

        <div class="box-row" >
            <span class="label" >Item Name:</span>  
            <span style="width:176px" class="value">
                {{implode(' , ',$consignment->Items->pluck('name')->toArray())}}
            </span> 
        </div>

        <div class="box-row" >
            <span class="label">Net Weight:</span>  
            <span style="width:86px" class="value">{{$consignment->net}}</span> 
        </div>

    </div>

    <div class="box" >

        <div class="box-row">
            <span class="label">Gross Weight:</span>  
            <span style="width:49px" class="value">{{$consignment->gross}}</span> 
        </div>

        <div class="box-row" >
            <span class="label">BL No:</span>  
            <span style="width:70px" class="value">{{$consignment->blawbno}}</span> 
        </div>
        <div class="box-row" >
            <span class="label">Po No:</span>  
            <span style="width:80px" class="value">{{$consignment->po_number}}</span> 
        </div>

        <div class="box-row" >
            <span class="label" >Port:	</span>  
            <span style="width:66px" class="value">{{$consignment->port}}</span> 
        </div>

        <div class="box-row" >
            <span class="label">Country:</span>  
            <span style="width:71px" class="value">{{$consignment->country_origion}}</span> 
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