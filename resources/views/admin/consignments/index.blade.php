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
            <h4 class="text-themecolor">Consignment & Job Creation</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Consignment & Job Creation</li>
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
                                <select class="form-control customer" name="customer">
                                </select>
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
                                <label>Status</label>
                                <select name="status" class="form-control" >
                                    <option value="">Select Status</option>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
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
                            <h4 class="mb-0 text-white">Consignment & Job Creation List</h4>
                        </div>
                        @if(Auth::user()->permission('consignments.create'))
                            <div class="col-md-6 text-end">
                                <a class="btn btn-primary" href="{{URL::to('admin/consignments/create/edit')}}">Create New </a>
                            </div>
                        @endif
                    </div>
                </header>
                <div class="card-body"> 
                    @if(Auth::user()->permission('consignments.list'))
                        <table id="example23" class="mydatatable display nowrap table table-hover table-striped border" cellspacing="0" width="100%">
                                        <thead>
                                            <tr class="">
                                                <th>#</th>
                                                <th>Job Number</th>
                                                <th>Company Name</th>
                                                <th>Customer Name</th>
                                                <th>Invoice value</th>
                                                <th>Lc / Bt / TT No</th>
                                                <th>Created At</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                </tbody>
                            </table>
                        @endif
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
                url: "{{URL::to('admin/consignments')}}",
                type: "GET",
                data: function ( d ) {  
                    d.job_number = $('select[name=job_number]').val();
                    d.customer = $('select[name=customer]').val();
                    d.lc = $('select[name=lc]').val();

                    d.sdate = $('input[name=sdate]').val();
                    d.edate = $('input[name=edate]').val();

                    d.status = $('select[name=status]').val();
                    d.search = $('input[name=search]').val();
                }
            },
            initComplete: function () {       

            }
        });

        application_table.on( 'draw', function () {
            $('.js-switch').each(function () {
               new Switchery($(this)[0], $(this).data());
            }); 
        } );

        $(".search_btn").click(e =>{ 
            application_table.draw();
        });

        $('input[name=search]').on('keyup', function () { 
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

            var isChecked = $(this).prop('checked');
            $.ajax({
                url: "{{URL::to('/admin/status')}}",
                method:"POST",
                data: {
                    '_token': "{{ csrf_token() }}",
                    id:$(this).data('id'),
                    table:'consignments',
                    column:'status',
                    value: $(this).prop('checked') ? 1: 0,
                },
                dataType: "json",
                success: function (response) {
                    
                },
                errror:function (response) {
                    
                },
            });
        });

        
        $(".mydatatable").delegate(".delete_btn", "click", function(){
            
            var id = $(this).data('id'); 
            $.ajax({
                url:id,
                method:"delete",
                data:{
                  '_token': "{{ csrf_token() }}",
                },
                success: function (response) {
                    
                    $.toast({
                        heading: response.message,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6,
                    });
                    application_table.draw();
                },
                error:function (response) {
                    
                    $.toast({
                    heading: response?.responseJSON?.message ? response?.responseJSON?.message : 'Something Went Wrong',
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'error',
                    hideAfter: 3500,
                    stack: 6,
                    });
                },
            });


        });


      });
    </script>
@endsection