<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DELIVERY CHALLAN</title>

    <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet">
    <style>
        .content{
            max-width: 800px;
            margin: auto;
            border: 1px solid;
            background: white;
            padding-top: 17px;
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
        padding: 0px 5px;
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

    </style>
</head>
<body>

  <?php 
    $data = json_decode($model->demands_received);
  ?>

    <div class="content">

      <div class="header text-center">
        <h4 class="heading" >Oceanic Logistics</h4>
        <h6 style="padding-bottom: 13px" class="sub-heading" >Creating, Forwarding And Shipping Agent</h6>
    
        <h6 class="sub-heading" style="border: 1px solid;
        margin: 10px 15px;
        padding: 11px 0px;
        font-weight: bold;" 
        >Consignment & Job Creation </h6>
    </div>

       @include('admin.consignments.prints.consignment')
       {{-- <div style="height: 20px" ></div> --}}


       @if( $data)
      <div class="mt-3 px-3" >
        
        <h6 class=" text-center sub-heading" style="border: 1px solid;
        font-weight: bold;padding: 11px 0px;" >Amount Demand And Received With Date Against This Consignment
 </h6>

          <table class="mt-4 table table-bordered" >
            <thead>
              <tr>
                <th class="text-center" >Title</th>
                <th class="text-center" >Demand</th>
                <th class="text-center" >Received</th>
                <th class="text-center" >Pending</th>
                <th class="text-center" >Date</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $key => $item)
              <tr>
                  <td class="text-center" >{{$item->title}}</td>
                  <td class="text-center">{{$item->demand}}</td>
                  <td class="text-center">{{$item->received}}</td>
                  <td class="text-center">{{$item->pending}}</td>
                  <td class="text-center">{{date('d-m-Y', strtotime($item->date))}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
      @endif

      <?php $data = json_decode($model->documents); ?>
      @if( $data)
      <div class="mt-3 px-3" >
        
        <h6 class=" text-center sub-heading" style="border: 1px solid;
        font-weight: bold;padding: 11px 0px;" >Consignment Documents</h6>

          <table class="mt-4 table table-bordered" >
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
</body>
</html>