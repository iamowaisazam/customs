@extends('layouts.main_layout')
@section('content')

<?php 

?>
<style>


    /* _________________________________ */

  

    table.dataTable.nowrap th, table.dataTable.nowrap td {
         white-space: break-spaces;
    }

    @media (max-width: 767px){
        .container-fluid, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {
            overflow: scroll!important;
        }
    }

    .over-flow-content{
        height: 75px;
        overflow-y: scroll;
    }

    .bt-group {
        display: flex;
        white-space: normal;
    }
    table .bt-group i {
        font-size: 20px;
    }

    .switchery-demo{
        white-space: normal;
        text-align: center;
    }

  

    .dataTables_filter input {
        border: 1px solid;
    }

    

    .pagination{
        padding-top: 10px;
    }



   .dataTables_wrapper .dataTables_paginate {
       float: none!important;
    }

   .dataTables_paginate {
      padding-top: 33px!important;
      text-align: center!important;
   }

   .dataTables_length {
        float: left!important;
        margin-top:0px!important;
        padding-bottom: 10px!important;
    }

    .dataTables_info{
        float: right!important;
        clear: none!important;
    }
    .dataTables_paginate .current {
        color: white!important;
    }

    .current{
        background:#03a9f3!important;
        color: white!important;
    }

    .delete-confirm{
        cursor: pointer;
    }

</style>
<section class="list__section">
    <div id="main-wrapper">
        
        <div class="page-wrapper">
                <div class="container-fluid">
                    <div class="row page-titles">
                        <div class="col-md-5 align-self-center">
                            <h4 class="text-themecolor">{{$field}}</h4>
                        </div> 
                    </div>
                    @if(session('message'))
                        <div class="alert alert-success asd">{{session('message')}}</div>
                    @endif
                    <div class="row">

                        <div class="col-12">
                            <div class="card">
                                <header class="card-header bg-info">
                                    <div class="row">
                                        <div class="col-md-6 align-self-center">
                                            <h4 class="mb-0 text-white">All {{$field}} List</h4>
                                        </div>
                                        <div class="col-md-6 align-self-center text-end">
                                            <button data-bs-toggle="modal" data-bs-target="#{{$field}}" class="btn btn-success" >Add New</button>
                                        </div>
                                    </div>
                                </header>
                                <div class="card-body">
                                    <table id="config-table" class="table display table-striped border no-wrap user_datatable">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $item)
                                                <tr>
                                                    <td>{{$key}}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->email}}</td>
                                                    <td>{{$item->password}}</td>
                                                    <td>
                                                        <button 
                                                          data-bs-toggle="modal" 
                                                          data-bs-target="#edit_{{$key}}" 
                                                          class="btn btn-primary" 
                                                          type="button" >Edit</button>

                                                        <div class="modal fade" id="edit_{{$key}}" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form method="post" action="{{URL::to('masters')}}?field={{$field}}">
                                                                        @csrf
                                                                        <div class="modal-header">
                                                                        <h5 class="modal-title" id="{{$field}}Label">Create New {{$field}}</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="Name">Name</label>
                                                                                        <input required name="data[name]" class="form-control" 
                                                                                        value="{{$item->name}}" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="Email">Email</label>
                                                                                        <input required name="data[email]" class="form-control" value="{{$item->email}}" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="Password">Password</label>
                                                                                        <input required name="data[password]" class="form-control" value="{{$item->password}}" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                                        </div>
                                                                   </form>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <button class="btn btn-danger" type="button" >Delete</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</section>
@endsection

<!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="{{$field}}" tabindex="-1" aria-labelledby="{{$field}}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{URL::to('masters')}}?field={{$field}}">
                    @csrf
                    <div class="modal-header">
                    <h5 class="modal-title" id="{{$field}}Label">Create New {{$field}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Name">Name</label>
                                    <input required name="data[name]" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input required name="data[email]" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input required name="data[password]" class="form-control" value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
               </form>
            </div>
        </div>
    </div>

@section('customjs')
    @parent

    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('.user_datatable').DataTable({
              ordering : false,
              processing: true,
              searching: true,  
              fixedColumns: false,
              autoWidth: false,
              fixedHeader: false,
              scrollCollapse: false,
              scrollX: true,
              dom: 'lirtp',
              lengthMenu: [[10,25, 50, 100,200],[10,25, 50, 100,200]],
              initComplete: function () {    

              }
          });

        
    });
    </script>
@endsection