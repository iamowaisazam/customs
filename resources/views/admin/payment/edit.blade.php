@extends('admin.layout')
@section('css')
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>

<style>
    .invalid-feedback{
      display: block;
   }
   .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred {
    height: 143px;
}
</style>
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">EDIT YOUR PAYMENT METHOD
        </h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Payment</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white" >Edit Payment</h4>
            </header>
            <div class="card-body">
                <form method="post" action="{{URL::to('admin/payment/update/'.Crypt::encryptString($model->id))}}" >
                    @csrf
                    <div class="form-group">
                        <label class="form-label" >Title</label>
                        <input required type="text" value="{{$model->title}}" name="title" class="form-control title" 
                        placeholder="Title">
                        @if($errors->has('title'))
                         <p class="invalid-feedback" >{{ $errors->first('title') }}</p>
                        @endif 
                    </div>

                    <div class="form-group">
                        <label class="form-label" >Slug</label>
                        <input required type="text" value="{{$model->slug}}" name="slug" class="form-control slug"
                        placeholder="slug">
                        @if($errors->has('slug'))
                         <p class="invalid-feedback" >{{ $errors->first('slug') }}</p>
                        @endif 
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                         <textarea id="short_description" name="shortdetails" class="form-control" maxlength="500" >{{$model->message}}</textarea>
                          @if($errors->has('details'))
                          <p class="invalid-feedback" >{{ $errors->first('details') }}</p>
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

<script>
 
   $(function () {
    $(".title").keyup(function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
            $(".slug").val(Text);        
        });
    
    }); 
      ClassicEditor.create(document.querySelector('#short_description')).catch(error => {
                console.error(error);
      }); 

</script>
    
@endsection