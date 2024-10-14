@extends('admin.layout')
@section('css')
<style>



</style>
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{$model->title}}</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Variation</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- page start-->
        <div class="menues-section row">
            <div class="col-sm-12">
                <section class="card">
                     <header class="card-header bg-info">
                         <h4 class="mb-0 text-white" >Edit Page</h4>
                     </header>
                     <div class="card-body">  
                         <form method="post" action="{{URL::to('/admin/variations_items/update/'.Crypt::encryptString($model->id))}}">
                             @csrf

                                     <div class="form-group">
                                         <label class="form-label" >Title</label>
                                         <input required name="title" 
                                           class="form-control" 
                                           value="{{$model->title}}"
                                           placeholder="Title">
                                     </div>
                                                         
                                    <div class="text-center" >
                                        <button type="submit" class="btn btn-info text-white">Update</button>
                                    </div>
                             </form>
                          </div>
                       </section>
                  </div>
            </div> 
 @endsection
 @section('js')
    <script>
      let level = "{{request()->level}}";
      $(function () {


      });

      $(document).ready(function() {
            var currentUrl = window.location.href; 
            $('.perent_Product ul li a').each(function() {
                    $('.variation-link-tag').addClass('active');  
                    $(this).closest('ul').addClass('show'); 
            });
        });

    </script>
@endsection