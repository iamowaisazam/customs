<div class="header text-center">
    <h4 class="heading" >Oceanic Logistics</h4>
    <h6 style="padding-bottom: 13px" class="sub-heading" >Creating, Forwarding And Shipping Agent</h6>
    <h6 class="sub-heading" style="border: 1px solid;
    margin: 10px 15px;
    font-weight: bold;" 
    >DELIVERY INTIMATION</h6>
</div>


<div class="mb-2 pt-3 description px-3" > 
    <p>{{$consignment->customer->company_name}} | {{implode(' , ',$consignment->Items->pluck('name')->toArray())}} | {{array_sum($consignment->Items->pluck('qty')->toArray())}} | {{number_format($consignment->invoice_value)}} </p>
</div>

<div class="mb-4 pt-3 description px-3" > 
    <p>Dear {{$consignment->customer->company_name}}</p>
    <p>{{$model->description}}</p>
</div>

 <div class="px-3">
    <table class="table table-bordered" >
        <tr>
            <th>Item Name:</th>  
            <td>{{implode(' , ',$consignment->Items->pluck('name')->toArray())}}</td> 
            <th>Quantity:</th>  
            <td>{{array_sum($consignment->Items->pluck('qty')->toArray())}}</td> 
        </tr>
        <tr>
            <th>Date:</th>  
            <td>12/13/2024</td>
            <th>Expected Time Of Arrival:</th>  
            <td>{{date('d-m-Y', strtotime($consignment->arival_date))}}</td>
        </tr>
        <tr>
            <th>Location :</th>  
            <td>{{$model->location}}</td> 
            <th>PO Number:</th>
            <td>{{$consignment->po_number}}</td> 
        </tr>
        <tr>
            <th>Job Number:</th>
            <td>{{$consignment->job_number_prefix}}</td> 
        </tr>
    </table>
 </div>
