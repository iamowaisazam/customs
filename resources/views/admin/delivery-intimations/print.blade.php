<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DELIVERY INTIMATION</title>

    <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet">
    <style>
      body{
        background: white;
      }
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

        .description{

        }

        .description p{
          font-weight: 400;
          font-size: 15px;
          margin: 0px;
          padding-bottom: 3px;
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

    <div class="content">

       @include('admin.delivery-intimations.print-challan')

       {{-- <div style="height: 100px" ></div>
       @include('admin.delivery-challans.print-challan') --}}

    </div>
</body>
</html>