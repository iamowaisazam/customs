<div class="header text-center">
    <h4 class="heading" >Oceanic Logistics</h4>
    <h6 style="padding-bottom: 13px" class="sub-heading" >Creating, Forwarding And Shipping Agent</h6>
    <h6 class="sub-heading" style="border: 1px solid;
    margin: 10px 15px;
    font-weight: bold;" 
    >DELIVERY INTIMATION</h6>
</div>

<div class="mb-4 pt-3 description px-3" > 
    <p>Dear {{$model->challan->consignment->customer->company_name}}</p>
    <p>{{$model->message}}</p>
</div>

 <div class="px-3">

<table class="table table-bordered" >
    <tr>
        <th>Job Number:</th>
        <td>{{$model->challan->consignment->job_number_prefix}}</td>
        <th>Date:</th>
        <td>{{date('d-m-Y', strtotime($model->challan->consignment->created_at))}}</td>
    </tr>
    <tr>
        <th>Your REF:</th>  
        <td>{{$model->challan->consignment->your_ref}}</td> 
        <th>Date:</th>  
        <td>{{date('d-m-Y', strtotime($model->challan->consignment->created_at))}}</td> 
    </tr>
    <tr>
        <th>Port:</th>  
        <td>{{$model->challan->consignment->port}}</td>
        <th>EIF / FI NO:</th>  
        <td>{{$model->challan->consignment->eiffino}}</td> 
    </tr>
    <tr>
        <th>Import / Exporter Messers:</th>  
        <td>{{$model->challan->consignment->import_exporter_messers}}</td> 
        <th>Consignee by / To:</th>  
        <td>{{$model->challan->consignment->consignee_by_to}}</td> 
    </tr>
    <tr>
        <th>Invoice Value:</span>  
        <td>{{$model->challan->consignment->invoice_value}}</td> 
        <th>Invoice Currency:</th>  
        <td>{{$model->challan->consignment->currency}}</td> 
    </tr>
    <tr>
        <th>Freight:</th>  
        <td>{{$model->challan->consignment->freight}}</td> 
        <th>Ins Rs:</th>  
        <td>{{$model->challan->consignment->ins_rs}}</td>
    </tr>
    <tr>
        <th>US $:</th>  
        <td>{{$model->challan->consignment->us}}</td> 
        <th>LC no:	</th>  
        <td>{{$model->challan->consignment->lc_no}}</td> 
    </tr>
    <tr>   
        <th>Date:</th>  
        <td>{{date('d-m-Y', strtotime($model->challan->consignment->created_at))}}</td> 
        <th>Vessel:</th>  
        <td>{{$model->challan->consignment->vessel}}</td> 
    </tr>
    <tr>   
        <th>IGM No:</th>  
        <td>{{$model->challan->consignment->igmno}}</td> 
        <th>Date:</th>  
        <td>{{date('d-m-Y', strtotime($model->challan->consignment->created_at))}}</td> 
    </tr> 
    <tr>  
        <th>BL/AWB No:</th>  
        <td>{{$model->challan->consignment->blawbno}}</td> 
        <th>Date:</th>  
        <td>{{date('d-m-Y', strtotime($model->challan->consignment->created_at))}}</td> 
    </tr> 
    <tr>    
        <th>Port of shippment:</th>  
        <td>{{$model->challan->consignment->port_of_shippment}}</td> 
        <th>Country Origion:</th>  
        <td>{{$model->challan->consignment->country_origion}}</td> 
    </tr> 
    <tr>     
        <th>Rate Of Exchange:</th>  
        <td>{{$model->challan->consignment->rate_of_exchange}}</td> 
        <th>Master Agent:</th>  
        <td>{{$model->challan->consignment->master_agent}}</td> 
    </tr> 
    <tr>    
        <th>Due Date:</th>  
        <td>{{date('d-m-Y', strtotime($model->challan->consignment->due_date))}}</td> 
        <th>Net:</th>  
        <td>{{$model->challan->consignment->nett}}</td> 
    </tr> 
    <tr>   
        <th>Gross:</th>  
        <td>{{$model->challan->consignment->gross}}</td> 
    </tr>

</table>
 </div>
