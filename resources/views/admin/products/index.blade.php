@extends('admin.layout')
@section('css')

<link rel="stylesheet" href="{{asset('admin/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('admin/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
<link href="{{asset('admin/assets/node_modules/switchery/dist/switchery.min.css')}}" />

<style>

    @media (max-width: 767px){
        .container-fluid, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {       
            overflow: scroll!important;
        }
    }

    .dataTables_filter{
        display: none!important;
    }

    .label{
        color: black !important;
        font-size: 14px;
        padding-bottom: 12px;
    }

</style>
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">ALL PRODUCTS LIST 
            </h4>

            
        

        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Products</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- page start-->
    <div class="row">

    <div class="col-sm-12">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white">Product Filters</h4>
            </header>
        <div class="card-body">    
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label">Category:</label>
                                <select name="category"  class="form-control">
                                    <option value="">Select Category</option>
                                    {!!$categoryDropdown!!}
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label">Status:</label>
                                <select name="is_enable"  class="form-control">
                                    <option value="" >Select Status</option>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label">Featured:</label>
                                <select name="is_featured"  class="form-control">
                                    <option value="" >Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="label">Search</label>
                                <input name="s" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <button id="searchButton" class="btn btn-primary" type="button" >Search</button>
                        </div>

                    </form>
                </div>
                        
                </section>
            </div>

                    <div class="col-sm-12">
                        <section class="card">
                            <header class="card-header bg-info">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-0 text-white" >All Products List</h4>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <a class="btn btn-primary" href="{{URL::to('admin/products/create')}}">Create New </a>
                                    </div>
                                </div>
                            </header>
                        <div class="card-body">    
                          <div class="table-responsive">
                            <table id="example23" class="mydatatable display nowrap table table-hover table-striped border" cellspacing="0" width="100%">
                                    <thead>
                                        <tr class="" >
                                            <th class="hidden-phone">Action</th>
                                            <th>Status </th>
                                            <th>Featured </th>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Price</th>
                                        </tr>
                                     </thead>
                                    <tbody>
                             </tbody>
                        </table>
                    </div>
                    </div>
                </div>
           </section>
        </div>
      </div>

@endsection
 @section('js')
        
       <script src="{{asset('admin/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
       <script src="{{asset('admin/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
       <script src="{{asset('admin/assets/node_modules/switchery/dist/switchery.min.js')}}"></script>
    

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
                url: "{{URL::to('admin/products/index')}}",
                type: "GET",
                data: function ( d ) {

                    d.category_id = $('select[name=category]').val();
                    d.s = $('input[name=s]').val();
                    d.is_enable = $('select[name=is_enable]').val();
                    d.is_featured = $('select[name=is_featured]').val();
       
                }
            },
            initComplete: function () {   
                $('.js-switch').each(function () {
                   new Switchery($(this)[0], $(this).data());
                 }); 
            }
        });

        application_table.on( 'draw', function () {
            $('.js-switch').each(function () {
       
               new Switchery($(this)[0], $(this).data());
            }); 
        } );


        // $('input[type=search]').unbind();
        $("#searchButton").click(e =>{ 
            application_table.search($('input[type=search]').val());
            application_table.draw();
        });

   
        $(".mydatatable").delegate(".is_enable", "change", function(){
            var isChecked = $(this).prop('checked');
            $.ajax({
                url: "{{URL::to('/admin/status')}}",
                data: {
                    id:$(this).data('id'),
                    table:'products',
                    column:'is_enable',
                    value: $(this).prop('checked') ? 1: 0,
                },
                dataType: "json",
                success: function (response) {
                    
                },
                errror:function (response) {
                    
                },
            });
            console.log(isChecked);
        });


        $(".mydatatable").delegate(".is_featured", "change", function(){
            var isChecked = $(this).prop('checked');
            $.ajax({
                url: "{{URL::to('/admin/status')}}",
                data: {
                    id:$(this).data('id'),
                    table:'products',
                    column:'is_featured',
                    value: $(this).prop('checked') ? 1: 0,
                },
                dataType: "json",
                success: function (response) {
                    
                },
                errror:function (response) {
                    
                },
            });
            console.log(isChecked);
        });




      });
    </script>
@endsection