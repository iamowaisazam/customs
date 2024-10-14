@extends('admin.layout')
@section('css')


<style>
    .invalid-feedback{
      display: block;
   }

 
</style>
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">ADD YOUR SLIDER
        </h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Sliders</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white" >Create Slider</h4>
            </header>
            <div class="card-body">
                <form method="post" action="{{URL::to('admin/sliders/store')}}" >
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" >Title</label>
                                <input  type="text" value="{{old('title')}}" name="title" class="form-control " 
                                placeholder="Title">
                                @if($errors->has('title'))
                                 <p class="invalid-feedback" >{{ $errors->first('title') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-6 file_manager_parent">
                            <div class="form-group">
                                <label class="form-label" >Image</label>
                                <select class="file_manager" name="image_id"   
                               placeholder="Select an option"></select>
       
                                 @if($errors->has('image_id'))
                                 <p class="invalid-feedback" >{{ $errors->first('image_id') }}</p>
                                 @endif 
                             </div>
                        </div>

                    
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label" >Link</label>
                                <input  type="text" value="{{old('link')}}" name="link" class="form-control" 
                                placeholder="Link">
                                @if($errors->has('link'))
                                 <p class="invalid-feedback" >{{ $errors->first('link') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" >Button</label>
                                <input  type="text" value="{{old('button')}}" name="button" class="form-control " 
                                placeholder="button">
                                @if($errors->has('button'))
                                <p class="invalid-feedback" >{{ $errors->first('button') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Sort</label>
                                <input type="number"  value="{{old('sort')}}" name="sort" class="form-control" placeholder="Sort"> 
                                @if($errors->has('sort'))
                                <p class="invalid-feedback" >{{ $errors->first('sort') }}</p>
                                @endif 
                            </div>
                        </div>
        
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="form-label">Alignment</label>
                            <select class="form-control" name="alignment" >
                                <option {{old('alignment') ==  'left' ? 'selected' : ''}} value="left">left</option>
                                <option {{old('alignment') ==  'center' ? 'selected' : ''}} value="center">center</option>
                                <option {{old('alignment') ==  'right' ? 'selected' : ''}} value="right" >right</option>
                            </select>
                            @if($errors->has('alignment'))
                            <p class="invalid-feedback" >{{ $errors->first('alignment') }}</p>
                            @endif 
                            </div>
                        </div>
        
                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="form-label">Status</label>
                                <select class="form-control" name="is_enable" >
                                    <option {{old('is_enable') ==  '1' ? 'selected' : ''}} value="1">Approve</option>
                                    <option {{old('is_enable') ==  '0' ? 'selected' : ''}} value="0">Pending</option>
                                </select>
                                @if($errors->has('is_enable'))
                                <p class="invalid-feedback" >{{ $errors->first('is_enable') }}</p>
                                @endif 
                              </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" >Details</label>
                                     <textarea placeholder="Details" name="details" class="form-control" >{{old('details')}}</textarea>
                                      @if($errors->has('details'))
                                      <p class="invalid-feedback" >{{ $errors->first('details') }}</p>
                                      @endif 
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-md-12 text-left">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                 </div>
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

//     var newOption = new Option('filemanager/GirlsShortsSummer.jpeg','http://localhost:8000/filemanager/GirlsShortsSummer.jpeg', true, true);
//    $('.image_2').append(newOption).trigger('change');

</script>
    
@endsection