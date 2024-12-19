<?php

    $documents = $_s['documents'] ? json_decode($_s['documents']) : [];
    $header = json_decode($model->header);
    $footers = $model->footer ? json_decode($model->footer) : []; 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CONSIGNMENT</title>

    <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet">
    <style>

        @media print {
            body {
             background-color: white;
           }
        }

        body {
            width: 794px;
            margin: 10px auto;
        }

        .table_container {
            background-color: white; 
            width: 770px;
            margin: 0 auto;
            border: 2px solid #000;
        }

        .header {
            text-align: center;
            font-weight: bold;
        }

        .header h1 {
            font-weight: 600;
            margin: 0;
        }

        .sub-header {
            text-align: center;
            font-size: 14px;
            padding: 5px 0;
            font-weight: 500;

        }

        .sub-header p {
            margin: 0;
        }

        .table {
            width: 100%;
        }

        .table,
        .table th,
        .table td {
            padding: 5px;
            text-align: left;
            border: none;
            line-height: 1.0;
            text-transform: capitalize;
        }

        .right-align {
            text-align: right;
        }

        .invoice_box {
            border: 2px solid black;
            border-bottom: none;
            border-right: none;
        }

        .invoice td {
            text-align: end;
        }

        .table .total {
            display: flex;
            justify-content: space-around;
            border: 2px solid black;
            border-left: none;
        }

        .invoice .total {
            display: flex;
            justify-content: space-around;
            border: 2px solid black;
            border-right: none;
        }

        .invoice_header {
            font-weight: 500;
        }

        .table_2nd .header {
            display: flex;
            justify-content: center;
            text-align: center;
        }

        .table_2nd h4 {
            font-weight: 600;
        }

        .t_left_total {
            display: flex;
            justify-content: space-between;
        }

        .table_1st,
        .table_3rd,
        .table_2nd {
            border-top: 2px solid black;
            padding-top: 8px;
        }

        .table_3rd .t_right th {
            text-align: center;
        }

        .table_1st,
        .table_2nd,
        .table_3rd{
            break-after: auto;
            break-inside: avoid;
        }

    </style>
</head>

<body>
    <section class="table_container">

        <div class="sub-header ">
            <h1 class="header">OCEANIC LOGISTICS</h1>
            <p>CLEARING FORWORDING & SHIPPING AGENTS</p>
            <p>
                ROOM # 512, 5TH FLOOR ZOHRA SQUARE OPP. NEW MEMON MASJID, M.A JINNAH ROAD KARACHI
                I I </p>
            <P>Email Address info @ logestic.Com.pk </P>
        </div>
        <div class="table_1st ">
            <div class="row">
                <div class="col-6 col_1st">
                    <table class="table">
                        <tr>
                            <th>Job Number</th>
                            <td>{{$model->consignment->job_number_prefix}}</td>

                        </tr>
                        <tr>
                            <th>HAWB #</th>
                            <td>---</td>
                        </tr>
                        <tr>
                            <th>Customer Name</th>
                            <td>{{$model->consignment->customer->customer_name}}</td>

                        </tr>
                        <tr>
                            <th>Company name</th>
                            <td>
                                {{$model->consignment->exporter}}
                            </td>

                        </tr>
                        <tr>
                            <th></th>
                            <td></td>

                        </tr>
                        <tr>
                            <th>L/C </th>
                            <td>{{$model->consignment->lc}}</td>

                        </tr>
                        <tr>
                            <th>PO # </th>
                            <td>{{$model->consignment->po_number}}</td>

                        </tr>
                        <tr>
                            <th>Shipment #</th>
                            <td>{{$model->consignment->shipment_number}}</td>

                        </tr>
                    </table>
                </div>
                <div class="col-6 col_2nd">
                    <table class="table">
                        <tr>
                            <th>Requisition Date</th>
                            <td>{{date('d-m-Y', strtotime($model->consignment->created_at))}}</td>
                        </tr>
                        <tr>

                            <th>BL/LAWB NO</th>
                            <td>{{$model->consignment->blawbno}}</td>
                        </tr>
                        <tr>
                            <th>Containers/PKGS</th>
                            <td>{{$model->consignment->no_of_packages}}</td>
                        </tr>
                        <tr>
                            <th>Net weight</th>
                            <td>{{$model->consignment->net}} </td>
                        </tr>
                        <tr>
                            <th>IGM NO & Date</th>
                            <td>{{$model->consignment->igmno}} {{date('d-m-Y', strtotime($model->consignment->igm_date))}}</td>
                        </tr>
                        <tr>
                            <th>Vessel / Flight Name</th>
                            <td>{{$model->consignment->vessel}}</td>
                        </tr>
                        <tr>
                            <th>Made Of Shipment</th>
                            <td>{{ ucwords(str_replace("_", " ",$model->consignment->mode_of_shipment))}}</td>
                        </tr>
                        <tr>

                            <th></th>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        @foreach ($model->consignment->Items as $item)

        <?php
           $result = $item->calculate_payorder($model->consignment);
        ?>
            
        <div class="table_2nd">
            <div class="header">
                <h4 class="co_name fw-bold text-decoration-underline">{{$item->name}}</h4>
                <h4 class="co_HSCODE fw-bold text-decoration-underline"> ({{$item->hs_code}})</h4>
            </div>
            <h4 style="padding-left: 8px" class="invoice_header text-decoration-underline">Complete Duty Break up</h4>

            <div class="pay_order">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div  style="padding-left: 14px" class="col-6">
                                <table  class="table">
                                    <tr>
                                        <th>Custom Duty</th>
                                        <td>@</td>
                                    </tr>
                                    <tr>
                                        <th>Additional C.D</th>
                                        <td>@</td>
                                    </tr>
                                    <tr>
                                        <th>R.D</th>
                                        <td>@</td>
                                    </tr>
                                    <tr>
                                        <th>Sales Tax</th>
                                        <td>@</td>
                                    </tr>
                                    <tr>
                                        <th>Additional S.T</th>
                                        <td>@</td>
                                    </tr>
                                    <tr>
                                        <th>income Tax</th>
                                        <td>@</td>
                                    </tr>
                                    <tr>
                                        <th>ETO</th>
                                        <td>@</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-6">
                                <table class="table  ">
                                    <tr>
                                        <td>{{$item->custom_duty}}%</td>
                                        <td>{{number_format($result['custom_duty'],2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$item->a_custom_duty}}%</td>
                                        <td>{{number_format($result['a_custom_duty'],2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$item->rd}}%</td>
                                        <td>{{number_format($result['rd'],2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$item->saletax}}%</td>
                                        <td>{{number_format($result['saletax'],2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$item->a_saletax}}%</td>
                                        <td>{{number_format($result['a_saletax'],2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$item->it}}%</td>
                                        <td>{{number_format($result['it'],2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$item->eto}}%</td>
                                        <td>{{number_format($result['eto'],2)}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <table class="table ">
                            <tr class="total">
                                <th>Total</th>
                                <th>{{number_format($item->after_duties,2)}}</th>
                            </tr>
                        </table>
                    </div>

                    <div class="col-6 ">
                        <div class="row invoice_box m-0">
                            <div class="col-7 ">
                                <table class="table">
                                    <tr>
                                        <th>Invoice Value</th>
                                        <td>USD</td>
                                    </tr>
                                    <tr>
                                        <th>Freight (If any)</th>
                                        <td>USD</td>
                                    </tr>
                                    <tr>
                                        <th>Value</th>
                                        <td>USD</td>
                                    </tr>
                                    <tr>
                                        <th>Invoice value (ER {{$model->consignment->rate_of_exchange}})</th>
                                        <td>PKR</td>
                                    </tr>
                                    <tr>
                                        <th>Insurance</th>
                                        <td>PKR</td>
                                    </tr>
                                    <tr>
                                        <th>Landing Charges</th>
                                        <td>PKR</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-5">
                                <table class="table invoice">
                                    <tr>
                                        <td>{{number_format($item->total,2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{number_format($result['frieght_rate'],2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{number_format($result['value'],2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{number_format($result['rate_exchange'],2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{number_format($result['ins'],2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{number_format($result['landing_charges'],2)}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <table class="table invoice">
                            <tr class="total">
                                <th>Assessed Value</th>
                                <th>{{number_format($result['asset_value'],2)}}</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="table_3rd">
            <div class="row">
                <div class="col-12">
                    <div class="header">
                        <h4 class="co_name fw-bold text-decoration-underline">Additional Duties</h4>
                    </div>
                    <table class="table" style="max-width: 97%;margin: auto;margin-bottom: 17px;    margin-top: 15px;" >
                        <tr class="">
                            <td class="text-center" style="border: 1px solid" >
                                <span class="fw-bold" >Stan Duty :</span> 
                                {{number_format($model->stan_duty,2)}} PKR
                            </td>
                            <td class="text-center" style="border: 1px solid" >
                                <span class="fw-bold">PSW Fee :</span>
                                {{number_format($model->psw_fee,2)}} PKR
                            </td>
                            <td class="text-center" style="border: 1px solid" >
                                <span class="fw-bold">DRAP Fee :</span>
                                {{number_format($model->drap_fee,2)}} PKR
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="table_3rd">
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <tr class="header">
                            <th class="text-center text-decoration-underline fw-bold">Account</th>
                            <th class="text-center text-decoration-underline fw-bold">Amount</th>
                            <th class="text-center text-decoration-underline fw-bold">Pay Order in favor of</th>
                        </tr>
                        <tr>
                            <td>{{$header->title ?? ''}}</td>
                            <td class="text-center" >{{$header->amount ?? ''}}</td>
                            <td class="text-center" >{{$header->company ?? ''}}</td>
                        </tr>
                        @foreach ($footers as $item)
                            <tr>
                                <td>{{$item->title ?? ''}}</td>
                                <td class="text-center" >{{$item->amount ?? ''}}</td>
                                <td class="text-center" >{{$item->company ?? ''}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>
    <div class="p-3" >
        <p>Thanking You,<br>Regards,<br><strong>For Oceanic Logistics</strong></p>
    </div>

    

</body>
</html>