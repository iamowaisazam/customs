@extends('admin.layout')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">ADD NEW FILE 
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
                <h4 class="mb-0 text-white" >Add New File Form</h4>
            </header>
           
            <div class="card-body">
                <form id="fileUploadForm" action="{{ URL::to('/admin/filemanager/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="container">
                    <div class="my-2 row">
                        <div class="col-md-12">
                             <label class="form-label">Group</label>
                             <input name="group" class="form-control" 
                               value="others" placeholder="Group">
                             @if ($errors->has('group'))
                              <small class="text-danger">{{ $errors->first('group')}}</small>
                             @endif
                        </div>
                    </div>
                    <div class="my-2 row">
                        <div class="col-md-12">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="{{__('title')}}">
                                @if ($errors->has('title'))
                                <small class="text-danger">{{ $errors->first('title')}}</small>
                                @endif
                        </div>
                    </div>

                    <div class="my-2 row">
                        <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <input type="text" name="description" class="form-control" value="{{ old('description') }}" placeholder="Description">
                                @if ($errors->has('description'))
                                <small class="text-danger">{{ $errors->first('description')}}</small>
                                @endif
                        </div>
                    </div>

                    <div class="my-2 row">
                        <div class="col-md-12">
                                <label class="form-label">File</label>
                                <input type="file" multiple name="files[]" class="form-control" >
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
                            <a href="{{URL::to('admin/filemanager')}}" class="btn btn-danger">{{__('cancel')}}</a>
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
 
     document.getElementById('fileUploadForm').addEventListener('submit', function(event) {
    event.preventDefault(); 
    
    var submitButton = document.getElementById('btn-submit-files'); 
    const jsonDisplay = document.getElementById('jsonDisplay');
    
    document.getElementById('loader').style.display = 'block';
    
    submitButton.style.color = 'transparent';
    submitButton.disabled = true; 
    
    // Prepare form data
    var formData = new FormData(this);
    
    // Send AJAX request
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value 
        }
    })
    .then(response => {
        document.getElementById('loader').style.display = 'none';
        submitButton.disabled = false; 
        
        
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); 
    })
    .then(data => {
        // console.log('Success:', data);
        const successMessage = data.success;
        jsonDisplay.innerHTML = "<p class='text-success'>" + successMessage + "</p>";
        document.getElementById('fileUploadForm').reset();
         setTimeout(function() {
        jsonDisplay.innerHTML = ""; 
    }, 10000);
        
        
        
    }) .catch(error => {
        console.error('Error:', error);
        jsonDisplay.innerHTML = "<p class='text-danger'>" + error + "</p>";
    });

});
     </script>
 @endsection