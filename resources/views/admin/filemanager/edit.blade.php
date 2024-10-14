@extends('admin.layout')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">EDIT FILE 
        </h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Filemanager</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white"> Edit File Form</h4>
            </header>
            <div class="card-body">
                <form id="fileUploadForm" action="{{URL::to('admin/filemanager/update/'.$filemanager->id)}}" 
                  method="POST" 
                  enctype="multipart/form-data" >
                    @csrf
                <div class="container">
                    <div class="my-2 row">
                        <div class="col-md-12">
                             <label class="form-label">Group</label>
                             <input name="group" class="form-control" 
                               value="{{$filemanager->grouping}}" placeholder="Group">
                             @if ($errors->has('group'))
                              <small class="text-danger">{{ $errors->first('group')}}</small>
                             @endif
                        </div>
                    </div>
                    <div class="my-2 row">
                        <div class="col-md-12">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" 
                                value="{{$filemanager->title}}" 
                                placeholder="{{__('title')}}" />
                                @if ($errors->has('title'))
                                <small class="text-danger">{{ $errors->first('title')}}</small>
                                @endif
                        </div>
                    </div>

                    <div class="my-2 row">
                        <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <input type="text" name="description" class="form-control" 
                                value="{{$filemanager->description}}" placeholder="Description">
                                @if ($errors->has('description'))
                                <small class="text-danger">{{ $errors->first('description')}}</small>
                                @endif
                        </div>
                    </div>
                    <div class="my-2 row">
                        <div class="col-md-12">
                                <label class="form-label">File</label>
                                <input type="file" multiple name="files[]" class="form-control" >
                                @if($filemanager->path)
                           <div class="image-div-filemanager" onclick="openPopup(this)" data-path="{{ asset($filemanager->path) }}">
                                <img class="image-filemanager" src="{{ asset($filemanager->path) }}" alt="Image" />
                            </div>
                                @endif
                                @if ($errors->has('files.*'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->get('files.*') as $fileErrors)
                                                @foreach ($fileErrors as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                        </div>
                    </div>
                    <div id="jsonDisplay"></div>
                    <div class="row">
                        <div class="col-md-12 pt-3">
                            <button type="submit" id="btn-submit-files" class="btn btn-primary text-white position-relative">Submit
                                            <div id="loader" class="position-absolute top-50 start-50 translate-middle" style="display: none;">
                                                <div class="spinner-border text-light" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </div>
                                        </button>
                            <a href="{{URL::to('admin/filemanager')}}" 
                            class="btn btn-danger">{{__('cancel')}}</a>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </section>
    </div>
</div>

<div id="imagePopup" class="image-popup">
    <div class="popup-content">
        <img id="popupImage" src="" alt="Popup Image">
        <span class="close-popup" onclick="closePopup()">&times;</span>
    </div>
</div>
@endsection
@section('js')

<script>
function openPopup(element) {
    var filePath = element.getAttribute('data-path');
    document.getElementById("popupImage").src = filePath;
    document.getElementById("imagePopup").style.display = "block";
}

function closePopup() {
    document.getElementById("imagePopup").style.display = "none";
}



$(document).ready(function() {
    $('#fileUploadForm').submit(function(e) {
        e.preventDefault();
        
        
        $('#loader').show();
        
        // Serialize form data
        var formData = new FormData($(this)[0]);
        
      
        $.ajax({
            url: $(this).attr('action'), 
            type: $(this).attr('method'), 
            data: formData, // Form data
            contentType: false,
            processData: false,
            success: function(response) {
                const successMessage = response.success;
                jsonDisplay.innerHTML = "<p class='text-success'>" + successMessage + "</p>";
                $('.image-filemanager').attr('src', response.data.preview);
                $('.image-div-filemanager').attr('data-path', response.data.preview);
            
                $('#loader').hide();
                setTimeout(function() {
                    jsonDisplay.innerHTML = ""; 
                }, 5000);
            },
            error: function(xhr, status, error) {
                $('#loader').hide();
         jsonDisplay.innerHTML = "<p class='text-danger'>" + error + "</p>";
            }
        });
    });
});
</script>
@endsection