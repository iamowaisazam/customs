@extends('admin.partials.layout')
@section('css')

<link rel="stylesheet" type="text/css"
href="{{asset('admin/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css"
href="{{asset('admin/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}">


<style>
    
    table td{
        /* border: 1px solid lightgray; */
    }

    table th{
        /* border: 1px solid lightgray; */
    }

    @media (max-width: 767px){
        .container-fluid, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {
           
            overflow: scroll!important;
        }
    }


</style>
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">User List 
            </h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- page start-->
                <div class="row">
                    <div class="col-sm-12">
                        <section class="card">
                            <header class="card-header bg-info">
                                <div class="row">
                                    <div class="col-md-6 align-self-center">
                                        <h4 class="mb-0 text-white" >All Users List</h4>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <a class="btn btn-primary" href="{{URL::to('admin/users/create')}}">Create New </a>
                                    </div>
                                </div>
                            </header>
                        <div class="card-body">    

                          {{-- <div class="table-responsive m-t-40"> --}}
                            <table id="example23" class="mydatatable display nowrap table table-hover table-striped border" cellspacing="0" width="100%">
                                    <thead>
                                        <tr class="" >
                                            <th>#</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th class="hidden-phone">Action</th>
                                        </tr>
                                     </thead>
                                    <tbody>
                             </tbody>
                        </table>
                    {{-- </div> --}}


              </div>
           </div>
          </section>
         </div>
@endsection


 @section('js')

       <!-- This is data table -->
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
            dom: 'lfrtip',
            serverSide: true,
            lengthMenu: [[10,25, 50, 100,500],[10,25, 50, 100,500]],
            ajax: {
                url: "{{URL::to('admin/users/index')}}",
                type: "GET",
                data: function ( d ) {
                
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

       
        $("#searchButton").click(e =>{ 
            application_table.search($('input[type=search]').val());
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
                    table:'users',
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



     


      });
    </script>
@endsection