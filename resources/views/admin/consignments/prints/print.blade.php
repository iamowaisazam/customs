<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CONSIGNMENT</title>

    <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet">
    <style>

      body{
        background: white;
      }
        .content{
            max-width: 750px;
            margin: auto;
            border: 1px solid;
            background: white;
            padding-top: 17px;
        }

        .content-area{
          max-width: 750px;
          margin: auto!important;
        }

        th:first-child,td:first-child {
         border-left: none;
        }

    /* Remove right border for the last <th> */
       th:last-child,td:last-child {
        border-right: none;
       }

  

        .heading{
            font-size: 24px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .sub-heading{
            font-size: 17px;
            font-weight: 500;
        }
        
        .my-table {
            padding: 10px 0px;
        }

      .my-table .box{
        display: flex;
        padding: 7px 0px
      }

      .my-table .box > div{
        padding: 0px 0px;
      }

      .box-row{
        display: flex;
      }

      .label{
        padding-right: 10px;
        font-weight: 500;
        display: block;
        color: black;
        font-size: 15px;
      }

      .value{
        display: block;
        border-bottom: 1px solid lightgray;
      }


      .signature_box {
        width: 770px;
        margin: auto;
        margin-bottom: 30px;
        margin-top: 14px;
      }

      .signature_box > div {
        display: flex;
        justify-content: space-between;
        width: 100%;
      }

      .signature_box > div > div {
        height: 70px;
      }

      .signature_box label {
        font-weight: 700;
        font-size: 16px;
      }

      .signature_box {
        /* width: 200px; */
      }



      .items-table th,.items-table td{
        padding-bottom: 7px;
        padding-top: 7px;
      }

      .document-table th,.document-table td{
        padding-bottom: 7px;
        padding-top: 7px;
      }

      

    </style>
</head>
<body>

  <?php 
    
  ?>

    <div class="content">
      <div class="content-area">

        <div class="header text-center">
          <h4 class="heading" >Oceanic Logistics</h4>
          <h6 style="padding-bottom: 13px" class="sub-heading" >Creating, Forwarding And Shipping Agent</h6>
          <h6 class="sub-heading" style="border: 1px solid;
          margin: 10px 0px;
          padding: 11px 0px;
          border-left: 0px;
          border-right: 0px;
          font-weight: bold;" 
          >Consignment & Job Creation </h6>
      </div>

       @include('admin.consignments.prints.consignment')
      

  
      <div class="mt-3" >  
        <h6 class="text-center sub-heading" style="
          border: 1px solid; 
          font-weight: bold;
          margin-bottom:0px;
          border-left: 0px;
          border-right: 0px;
          padding: 11px 0px;" >Amount Demand And Received With Date Against This Consignment </h6>

          <table class="items-table table table-bordered" >
            <thead>
              <tr>
                <th class="text-center" >Title</th>
                <th class="text-center" >Hs Code</th>
                <th class="text-center" >Unit</th>
                <th class="text-center" >Qty</th>
                <th class="text-center" >Price</th>
                <th class="text-center" >Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($model->Items as $key => $item)
              <tr>
                  <td class="text-center" >{{$item->name}}</td>
                  <td class="text-center">{{$item->hs_code}}</td>
                  <td class="text-center">{{$item->unit}}</td>
                  <td class="text-center">{{$item->qty}}</td>
                  <td class="text-center">{{$item->price}}</td>
                  <td class="text-center">{{$item->total}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
      



      <?php $data = json_decode($model->documents); ?>
      @if( $data)
      <div class="document-table mt-4" >
        <h6 class=" text-center sub-heading" style="border: 1px solid;
        border-left: 0px;
        border-right: 0px;
        margin-bottom:0px;
        font-weight: bold;
        padding: 11px 0px;" >Consignment Documents</h6>
            <table class=" table table-bordered" >
              <thead>
                <tr>
                  <th class="text-center" >Document</th>
                  <th class="text-center" >Date</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $key => $item)
                <tr>
                    <td class="text-center" >{{$item->name}}</td>
                    <td class="text-center">{{date('d-m-Y', strtotime($item->date))}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
         </div>
      @endif
    </div>
    </div>
</body>
</html>