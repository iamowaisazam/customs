<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <?php  //dd($settings['email_address']); ?>
    <style>

        body{
            font-family: sans-serif;
        }

        .container{
            width: 720px;
            padding: 20px;
            margin: auto;
            /* border: 1px solid black; */
        }

        .main-title{
            font-size: 18px;
            font-family: Arial, Helvetica, sans-serif;
            margin: 5px 0px;
        }

        .main-text{
            font-size: 14px;
            font-family: sans-serif;
            margin: 10px 0px
        }



        /* ------------- Logo Details ------------------ */

        .logo_details{
            /* display:inline-block; */
            float: left;
            width:48%;
            vertical-align:top;
            /* border: 1px solid; */
        }

        .logo_details h6{
            text-align: left;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
            font-weight: 600;
            margin: 0px;
            padding: 8px 0px;
        }

        .logo_details p{
           margin: 2px;
           text-align: left;
           font-size: 14px;
        }


        /* ------------- Company Details ---------------- */
        .company_details{
            /* display: inline-block; */
            width:48%;
            float: right;
            text-align:center;
            vertical-align:top;
            /* border: 1px solid; */
        }

        .company_details h6{
            text-align: right;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
            font-weight: 600;
            margin: 0px;
            padding: 8px 0px;
        }

        .company_details p{
         margin: 0px;
         text-align: right;
         font-size: 14px;
        }


        /*---------------- Customer Details ---------------- */
        .customer_details{
            float: right;
            /* display:inline-block; */
            width:46%;
            vertical-align:top;
            
        }

        .customer_details h6{
            text-align: right;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            font-weight: 600;
            margin: 0px;
            padding: 8px 0px;
        }

        .customer_details p{
            margin: 2px 0px;
            text-align: right;
        }

        /* -------------- Order Details --------------------- */

        .order_details{
            display:inline-block;
            width:49%;
            vertical-align:top;
        }

        .order_details h6{
            text-align: left;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            font-weight: 600;
            margin: 0px;
            padding: 8px 0px;
        }

        .order_details p{
            text-align: left;
            margin: 2px 0px;
        }

        .invoice_items p{
            margin: 0px;
        }

        .invoice_items span{
            font-size: 12px;
        }
       



        .seprator{
            float: inline-end;
            width: 100%;
        }

        .label{
            width: 50px;
        }
    
        .text-center{
            text-align: center;
        }

        table thead td,  table thead th {
            border:none;
        }

        table {
            width: 100%;
            caption-side: bottom;
            border-collapse: collapse;
        }

        table td,table th {
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="logo_details">
                <div class="logo">
                    
                    <img style="width:180px;" src="{{asset($_s['logo']->path)}}" />
                </div>
                <div style="padding-top:30px" class="div">
                    <h6>Order Details:</h6>
                    <p><span>Status:</span> {{$status->title}}</p>
                    <p><span>Date:</span> {{date('Y-m-d',strtotime($data->created_at))}}</p>
                    <p><span>Payment via:</span> {{$data->payment_method}}</p>
                    <p><span>Payment:</span> {{$data->payment_status}}</p>
                    <p><span>Tracking ID:</span> {{$data->tracking_id}}</p>
                </div>
            </div>
            <div class="company_details">
                
                <div class="div">
                    <h6>Bill From:</h6>
                    <div>
                        <p>{{$settings['site_title']}}</p>
                        <p>{{$settings['phone_number']}}</p>
                        <p>{{$settings['email_address']}}</p>
                        <p>{{$settings['address']}}</p>
                    </div>
               </div>

               <div style="padding-top: 10px;" class="div">
                    <h6>Bill To:</h6>
                    <p>{{$data->customer_name}}</p>
                    <p>{{$data->customer_phone}}</p>
                    <p>{{$data->customer_email}}</p>
                    <p>{{$data->country}},{{$data->city}}</p>
                    <p>{{$data->address}}</p> 
               </div>
            </div>
        </div>

    <div style="padding-bottom: 20px" class="seprator"></div>

    <table style="width: 100%" border="1"  >
        <tbody style="padding-top: 25px" >
            <tr>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            @foreach ($data->children as $item)
                <?php 
                  $attr = json_decode($item->attr);
                ?>
                <tr class="invoice_items">
                    <td><p>{{$item->title}} - ({{$item->sku}})</p> 
                        @if($attr)
                       @foreach ($attr as $key => $att)
                        <span>{{$att->attribute_title}}:{{$att->values_title}}</span> <br>  
                       @endforeach
                       @endif
                    </td>
                    <td class="text-center" >{{number_format($item->price,2)}}</td>
                    <td class="text-center" >{{number_format($item->quantity,2)}}</td>
                    <td class="text-center" >{{number_format($item->total,2)}}</td>
                </tr>
            @endforeach
            <tr>
                <td style="border-right: none;" ></td>
                <td style="border-left: none;" ></td>
                <th class="text-center" >Subtotal</th>
                <td class="text-center" >{{number_format($data->subtotal,2)}}</td>
            </tr>
            <tr>
                <td style="border-right: none;" ></td>
                <td style="border-left: none;" ></td>
                <th class="text-center" >Delivery Charges</th>
                <td class="text-center" >{{number_format($data->delivery_charges,2)}}</td>
            </tr>
            <tr>
                <td style="border-right: none;" ></td>
                <td style="border-left: none;" ></td>
                <th class="text-center" >Grand Total</th>
                <td class="text-center" >{{number_format($data->grandtotal,2)}}</td>
            </tr>
        </tbody>
    </table>
    <div style="padding-top: 10px;" class="order-notes">
        <h6 class="main-title" >Notes:</h6>
        <p>{{$data->order_notes}}</p>
    </div>
   </div>
  </body>
</html>