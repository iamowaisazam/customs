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

    
    .select2-container{
      width: 100%!important;
    }

    .select2-dropdown {
      z-index: 1069!important;
    }

    .js-example-responsive{
        /* width: 100%; */
    }
</style>
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Delivery Challans</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Delivery Challans</li>
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
                            <h4 class="mb-0 text-white" >Delivery Challans List</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            @if(Auth::user()->permission('delivery-challans.create'))
                              <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">Create New </button>
                            @endif
                        </div>
                    </div>
                </header>
                <div class="card-body">    
                    @if(Auth::user()->permission('delivery-challans.list'))
                    <table id="example23" class="mydatatable display nowrap table table-hover table-striped border" cellspacing="0" width="100%">
                    <thead>
                        <tr class="">
                            <th>#</th>
                            <th>Challan Date</th>
                            <th>Job Number</th>
                            <th>Company Name</th>
                            <th>Customer Name</th>
                            <th>Invoice value </th>
                            <th>Lc / Bt / TT No</th>
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


         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="{{URL::to('admin/delivery-challans/')}}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Delivry Challan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label style="width: 100%" for="id_label_multiple">
                                <select name="payorder" class="js-example-responsive form-control" id="id_label_multiple" multiple="multiple">        
                                </select>
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
             </form>
            </div>
        </div>
@endsection

@section('js')

       <script src="{{asset('admin/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
       <script src="{{asset('admin/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
       <script src="https://www.fatwaqa.com/admin/assets/node_modules/switchery/dist/switchery.min.js"></script>

       <script>
        $(function () {

            $(".js-example-responsive").select2({
                ajax: {
                    url: "{{URL::to('/admin/dashboard/create_deliverychallan')}}",
                    dataType:'json',
                    delay: 250, 
                    processResults: function(data) {
                        return { results: data.map(function(item) {return item;})};
                    },
                    cache: true
                }
            }).on('select2:select', function (e) {
                var currentValue = e.params.data.id;
                $(this).val([currentValue]).trigger('change');
            });
          
            var application_table = $('.mydatatable').DataTable({
            processing: true,
            "searching": true,  
            fixedColumns: false,
            fixedHeader: false,
            scrollCollapse: false,
            scrollX: true,
            // scrollY: '500px',
            autoWidth: false, 
            ordering:false,
            dom: 'lirtp',
             serverSide: true,
            lengthMenu: [[10,25, 50, 100,500],[10,25, 50, 100,500]],
             ajax: {
                 url: "{{URL::to('admin/delivery-challans')}}",
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