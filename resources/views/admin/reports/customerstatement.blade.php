@extends('admin.partials.layout')
@section('css')

<link rel="stylesheet" type="text/css"
href="{{asset('admin/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css"
href="{{asset('admin/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}">


<style>    
    @media (max-width: 767px){
        .container-fluid, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {       
            overflow: scroll!important;
        }
    }

    .dataTables_info {
     float: right;
    }
</style>
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Customer Statement</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Customer</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <section class="card">
                <header class="card-header bg-info">
                    <h4 class="mb-0 text-white" >Search</h4>
                </header>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Job Number</label>
                                <select class="form-control jobnumber" name="job_number">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Customer</label>
                                @if(Auth::user()->role_id == 3)
                                    <select class="form-control" name="customer">
                                        <option value="{{Auth::user()->customer->id}}">
                                            {{Auth::user()->customer->customer_name}}
                                        </option>
                                    </select>
                                @else
                                <select class="form-control customer" name="customer">
                                </select>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Lc / Bt / TT No </label>
                                <select class="form-control lc" name="lc">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" class="form-control" name="sdate" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date"  class="form-control" name="edate" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Search</label>
                                <input class="form-control" name="search" />
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="button" class="search_btn btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- page start-->
    <div class="row">
        <div class="col-sm-12">
            <section class="card">
                <header class="card-header bg-info">
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <h4 class="mb-0 text-white">Customer Statement</h4>
                        </div>
                        <div class="col-md-6 text-end">
                        </div>
                    </div>
                </header>
                <div class="card-body">    
                    <table id="example23" class="mydatatable display nowrap table table-hover table-striped border" cellspacing="0" width="100%">
                    <thead>
                        <tr class="">
                            <th>#</th>
                            <th class="text-center">Job</th>
                            <th class="text-center">Customer</th>
                            <th>Po Number</th>
                            <th>BL Number</th>
                            <th class="text-center" >LC/BT/TT Number</th>
                            <th>Item Name</th>
                            <th>Quantity </th>
                            <th>Item Amount </th>
                            <th>Arrival Date</th>
                            <th>Arrived Date</th>
                            <th>Remaining Document</th>
                            <th>Remarks</th>
                        </tr>
                        </thead>
                         <tbody>

                         </tbody>
                        </table>
                    </div>
                </div>
            </section>
         </div>
@endsection

@section('js')

       <script src="{{asset('admin/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
       <script src="{{asset('admin/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
       <script src="https://www.fatwaqa.com/admin/assets/node_modules/switchery/dist/switchery.min.js"></script>

       <script>
        $(function () {
          
            var application_table = $('.mydatatable').DataTable({
            processing: true,
            "searching": true,  
            fixedColumns: false,
            fixedHeader: false,
            scrollCollapse: false,
            scrollX: true,
            // scrollY: '500px',
            autoWidth: false, 
            dom: 'lirtp',
            serverSide: true,
            lengthMenu: [[10,25, 50, 100,500],[10,25, 50, 100,500]],
            ajax: {
                url: "{{URL::to('admin/customerstatement')}}",
                type: "GET",
                data: function ( d ) {  
 
                    d.job_number = $('select[name=job_number]').val();
                    d.customer = $('select[name=customer]').val();
                    d.lc = $('select[name=lc]').val();
                    d.sdate = $('input[name=sdate]').val();
                    d.edate = $('input[name=edate]').val();
                    d.search = $('input[name=search]').val();

                 }

            },
            initComplete: function () {                
            }
        });

        application_table.on( 'draw', function () {
            
        } );

        $(".search_btn").click(e =>{ 
            application_table.draw();
        });

        $('input[name=search]').change(function (e) { 
            application_table.draw();
        });


        $(".mydatatable").delegate(".is_status", "change", function(){
            $.toast({
                heading: "Status Change Successfully",
                position: 'top-right',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3500,
                stack: 6,
            });
        });

        
   

    });
    </script>
@endsection