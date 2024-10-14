<div id="popupFormContainer">
    <div class="row">
        <button id="closePopupBtnn" type="button" class="btn-close" aria-label="Close"></button>
        <div class="col-lg-12">
            <section class="card">
                <header class="card-header bg-info">
                    <h4 class="mb-0 text-white">Add New File Form</h4>
                </header>
                <div id="jsonDisplay"></div>
                <div id="error-message" style="color: red; display: none;">All fields are required!</div>
                <div class="card-body">
                    <form id="fileUploadForm" action="{{ URL::to('/admin/filemanager/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf          
                        <div class="container">
                            <div class="my-2 row">
                                <div class="col-md-12">
                                    <label class="form-label">Group</label>
                                    <input name="group" class="form-control" value="others" placeholder="Group">
                                </div>
                            </div>
                            <div class="my-2 row">
                                <div class="col-md-12">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" value="" placeholder="Title" required>
                                </div>
                            </div>
                            <div class="my-2 row">
                                <div class="col-md-12">
                                    <label class="form-label">Description</label>
                                    <input type="text" name="description" class="form-control" value="" placeholder="Description">
                                </div>
                            </div>
                            <div class="my-2 row">
                                <div class="col-md-12">
                                    <label class="form-label">File</label>
                                    <input type="file" multiple="" name="files[]" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pt-3">
                                    <button type="submit" id="btn-submit-files" class="btn btn-primary text-white position-relative">Submit
                                        <div id="loader" class="position-absolute top-50 start-50 translate-middle" style="display: none;">
                                            <div class="spinner-border text-light" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
