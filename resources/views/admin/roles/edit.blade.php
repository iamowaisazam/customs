@extends('admin.partials.layout')
@section('css')
    
<style>

    .error{
        color:red;
    }
</style>
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Edit Role
        </h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white" >Edit Role</h4>
            </header>
            <div class="card-body">
                <form method="post" action="{{URL::to('admin/roles/update/'.Crypt::encryptString($model->id))}}" >
                    @csrf
                    <div class="form-group">
                        <label class="form-label" >Name</label>
                        <input type="text" value="{{$model->name}}" name="name" class="form-control" 
                        placeholder="User Name">
                        @if($errors->has('name'))
                         <p class="pt-2 text-danger" >{{ $errors->first('name') }}</p>
                        @endif 
                    </div>
                                       
                    <div class="form-group row">
                        <div class="col-md-12 text-left">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                     </div>
                     
                </form>
            </div>
        </section>
    </div>
</div>
@endsection

@section('js')
    
@endsection