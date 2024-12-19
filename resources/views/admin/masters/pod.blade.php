@extends('admin.partials.layout')
@section('css')
 
<link href="{{asset('admin/assets/summernote/summernote-bs4.css')}}" rel="stylesheet">
<style>
    .error{
        color:red;
    }
</style>

@endsection
@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">POD</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Masters</li>
            </ol>
        </div>
    </div>
</div>

<form method="post" enctype="multipart/form-data" action="{{URL::to('admin/masters/pod')}}" >
    @csrf

    <?php 
      $pol = isset($data['pod']) ? json_decode($data['pod']) : [];
    ?>

    <div class="row">
        <div class="col-lg-12">
            <section class="card">            
                <header class="card-header bg-info">
                <h4 class="mb-0 text-white">All POD</h4>
                </header>
                <div class="card-body">

                    <div class="text-center">
                        <button type="button" class="add btn btn-success" >+</button>
                    </div>
                     <div class="row all">
                        @foreach ($pol as $key => $item)        
                            <div class="col-md-12">
                                <label class="py-2">POD</label>
                                <div class="form-group d-flex">
                                    <input class="form-control"name="pod[{{$key}}]" value="{{$item}}" />
                                    <button type="button" class="remove btn btn-danger" >X</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center pt-5">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </section>
        </div>
    </div>
</form>    
@endsection

@section('js')

<script>
    $(document).ready(function() {


        $('.add').on('click', function() {

            let uid = Date.now() + Math.floor(Math.random() * 1000);

            let add = `
                <div class="col-md-12">
                    <label class="py-2">POD</label>
                    <div class="form-group d-flex">
                        <input class="form-control" name="pod[${uid}]" />
                        <button type="button" class="remove btn btn-danger">X</button>
                    </div>
                </div>`;

            $('.all').append(add);
        });

        // Remove a location input field
        $(document).on('click', '.remove', function() {
            $(this).closest('.col-md-12').remove();
        });


    });
</script>
    
@endsection