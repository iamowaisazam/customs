@extends('admin.layout')
@section('css')
<link href="{{asset('admin/assets/node_modules/switchery/dist/switchery.min.css')}}" 
    rel="stylesheet" type="text/css" />

    <!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet">

<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>

    .invalid-feedback{
      display: block;
   }

   .form-group {
    margin-bottom: 10px;
   }

   .select2-container{
    width: 100%!important;
   }

   .select2-dropdown {
    z-index: 1124!important;
   }

</style>

<link href="{{asset('admin/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}" rel="stylesheet" />
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
<link href="{{asset('admin/assets/css/pages/user-card.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">ADD YOUR PRODUCT 
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


<div class="row">
    <div class="col-lg-12">
        <form id="product-from" method="post" action="" >
            @csrf
        <input type="hidden" name="id" value="{{ Crypt::encryptString($product->id) }}">
            <div class="row">
                <div class="col-md-9">
                    <section class="card">
                        <header class="card-header bg-info">
                            <h4 class="mb-0 text-white" >General Details</h4>
                        </header>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" >Title</label>
                                            <input type="text" value="{{$product->title}}" name="title" class="title form-control" 
                                            placeholder="Title">
                                            @if($errors->has('title'))
                                             <p class="invalid-feedback" >{{ $errors->first('title') }}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Slug</label>
                                            <input type="text" value="{{$product->slug}}" name="slug" class="slug form-control" 
                                            placeholder="Slug">
                                            @if($errors->has('slug'))
                                             <p class="invalid-feedback" >{{ $errors->first('slug') }}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Price</label>
                                            <input type="text" value="{{$product->price}}" name="price" class="form-control" 
                                            placeholder="Price">
                                            @if($errors->has('price'))
                                            <p class="invalid-feedback" >{{ $errors->first('price') }}</p>
                                            @endif 
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Selling Price</label>
                                            <input type="text" value="{{$product->selling_price}}" name="selling_price" class="form-control" 
                                            placeholder="Selling Price">
                                            @if($errors->has('selling_price'))
                                            <p class="invalid-feedback" >{{ $errors->first('selling_price') }}</p>
                                            @endif 
                                        </div>
                                    </div>

                             </div>
                        </div>
                    </section>


            
                 <section class="card variation_box">
                        <header class="card-header bg-info">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="mb-0 text-white">Variations</h4>
                                </div>
                                <div class="col-6">
                                    <div class="button-box text-end">
                                        <button style="background: transparent;
                                        border: none;" type="button" class="text-white menu-button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-whatever="@mdo">Add variations</button>
                                    </div>
                                </div>
                            </div>
                        </header>

                            
                        
                            <div class="card-body variations">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Sku</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Thumbnail</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="variationsTableBody">
                                            @foreach($product->variations as $key => $variation)
                                            <tr>
                                                <td>
                                                    <input type="hidden" 
                                                       name="variation[{{$key}}][id]" 
                                                       class="form-control" 
                                                       value="{{$variation->id}}" />
                                                    <input style="width: 124px;" readonly name="variation[{{$key}}][sku]" 
                                                       class="form-control" 
                                                       value="{{$variation->sku}}" />
                                                </td>
                                                <td><input required name="variation[{{$key}}][quantity]" class="form-control" 
                                                    style="width: 70px;" value="{{$variation->quantity}}" /></td>
                                                <td><input style="width: 70px;" required name="variation[{{$key}}][price]" class="form-control" 
                                                    value="{{$variation->price}}" /></td>
                                                <td>
                                                    <div style="width: 200px;" class="form-group file_manager_parent">
                                                        <select placeholder="Select an option" class="file_manager" name="variation[{{ $key }}][thumbnail]">
                                                            <option id="variation[{{ $key }}][thumbnail]" value="{{ $variation->image }}">{{ $variation->image }}</option>
                                                        </select>
                                                        @if ($errors->has("variation.$key.thumbnail"))
                                                            <p class="invalid-feedback">{{ $errors->first("variation.$key.thumbnail") }}</p>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="btn btn-danger remove-variation" data-id="{{ $variation->id }}">Remove</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="pt-3 form-group row">
                                <div class="col-md-12 text-center">
                                    <a id="variations-Submit"  class="btn btn-primary" data-productidn="{{ $product->id }}">Variations Submit</a>
                                </div>
                             </div>
                        
                    </section>

                    @include('admin.products.description')
                    @include('admin.products.gallery')
                    @include('admin.products.seo')                    

                </div>
                <div class="col-md-3">
                
                    @include('admin.products.thumbnail')
                    @include('admin.products.collections')
                    @include('admin.products.category')
                    @include('admin.products.tags')
                    @include('admin.products.details')
                </div>
            </div>
         <div class="pt-3 form-group row">
            <div class="col-md-12 text-center">
                <a type="submit" id="btnSubmit" class="btn btn-info">Submit</a>
            </div>
         </div>
       </form>
    </div>
</div>


        @include('admin.products.variationpopup')

@endsection

@section('js')



<script src="{{asset('admin/assets/node_modules/switchery/dist/switchery.min.js')}}"></script>
<script src="{{asset('admin/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}">
</script>
<script src="{{asset('admin/assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}">
</script>
<script src="{{asset('admin/assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>


<script>
     $(function () {
        

        //    $(".select2").select2();

            ClassicEditor.create(document.querySelector('#long_description')).catch(error => {
                console.error(error);
            });
           

            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function () {
                new Switchery($(this)[0], $(this).data());
            });


           

        $(".title").keyup(function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
            $(".slug").val(Text);        
        });


        
            
    });   
    




    $(document).ready(function() {


    function getVariations(productId) {
        $.ajax({
            url: '{{ route("products.getvariations", ":id") }}'.replace(':id', productId),
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    var tableBody = $('#variationsTableBody');
                    tableBody.empty(); // Clear the table body before appending new rows

                    response.variations.forEach(function(variation, key) {
                        var attributes = variation.attributes.map(function(attr) {
                            return attr.value;
                        }).join(', ');

                        var row = `
                            <tr>
                                <td>
                                    <input type="hidden" 
                                    name="variation[${key}][id]" 
                                    class="form-control" 
                                    value="${variation.id}" />
                                    <input style="width: 124px;" readonly name="variation[${key}][sku]" 
                                    class="form-control" 
                                    value="${variation.sku}" />
                                </td>
                                <td><input required name="variation[${key}][quantity]" class="form-control" 
                                    style="width: 70px;" value="${variation.quantity || ''}" /></td>
                                <td><input style="width: 70px;" required name="variation[${key}][price]" class="form-control" 
                                    value="${variation.price || ''}" /></td>
                                <td>
                                    <div style="width: 200px;" class="form-group file_manager_parent">
                                        <select placeholder="Select an option" class="file_manager" name="variation[${key}][thumbnail]">
                                            <option id="variation[${key}][thumbnail]" value="${variation.thumbnail || ''}"></option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-danger remove-variation" data-id="${variation.id}">Remove</button>
                                </td>
                            </tr>
                        `;
                        tableBody.append(row);
                    });

                    // Reinitialize Select2 for dynamically added elements
                    $('.file_manager').select2();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
                alert('Failed to retrieve variations!');
            }
        });
    }

    // Initialize Select2
    $('.select3').select2();

    // Handle variations form submission
    $('#variationsForm').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        let productId = $('.product-id').val(); // Corrected to use val() method
        var url = form.attr('action');
        var formData = form.serialize();

        $.ajax({
            url: url,
            method: 'POST', // Use POST method for form submission
            data: formData,
            success: function(response) {
                if (response.success) {
                    getVariations(productId);
                    $('#exampleModal').modal('hide').on('hidden.bs.modal', function () {
                            $(this).find('form').trigger('reset');
                            $(this).find('.modal-body').empty();
                        });
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
                alert('Form submission failed!');
            }
        });
    });

    // Handle variation removal
    $(document).on('click', '.remove-variation', function(e) {
    e.preventDefault();
    var button = $(this);
    var variationId = button.data('id');
    let productId = $('.product-id').val(); // Ensure productId is available

    if (confirm('Are you sure you want to remove this variation?')) {
        $.ajax({
            url: '{{ route("products.removevariation", ":id") }}'.replace(':id', variationId),
            type: 'POST', // Use POST for AJAX
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                _method: 'DELETE' // Spoof the DELETE method
            },
            success: function(response) {
                if (response.success) {
                    // Refresh the table data
                    getVariations(productId);
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
                alert('Error: Could not remove variation.');
            }
        });
    }
});


// Handle variation Submit

$('#variations-Submit').click(function() {
        var variations = [];
        var buttonData=$(this);

        $('#variationsTableBody tr').each(function() {
            var variation = {
                id: $(this).find('input[name*="[id]"]').val(),
                sku: $(this).find('input[name*="[sku]"]').val(),
                quantity: $(this).find('input[name*="[quantity]"]').val(),
                price: $(this).find('input[name*="[price]"]').val(),
                thumbnail: $(this).find('select[name*="[thumbnail]"]').val()
            };
            variations.push(variation);
        });

        
        var productId = buttonData.data('productidn'); 

        $.ajax({
            url: '{{ route("products.variationsupdate", ":id") }}'.replace(':id', productId),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                variations: variations
            },
            success: function(response) {
                alert('Variations updated successfully!');
                // Optionally, you can redirect or update UI here
            },
            error: function(xhr, status, error) {
                alert('An error occurred while updating variations.');
                console.error(xhr.responseText);
            }
        });
    });




    // Active highlighter
    var currentUrl = window.location.href;
    $('.perent_Product ul li a').each(function() {
        $('.product-link-tag').addClass('active');
        $(this).closest('ul').addClass('show');
    });




    // handle product from submite

    $('#btnSubmit').click(function() {
        // Inputs
        var id = $('input[name="id"]').val();
        var titleValue = $('input[name="title"]').val();
        var slugValue = $('input[name="slug"]').val();
        var priceValue = $('input[name="price"]').val();
        var selling_priceValue = $('input[name="selling_price"]').val();
        var meta_titleValue = $('input[name="meta_title"]').val();
        var meta_keywordsValue = $('input[name="meta_keywords"]').val();

        // Textareas
        var details = $('textarea[name="details"]').val();
        var description = $('textarea[name="description"]').val();

        // Single Selectors
        var imageValue = $('select[name="image"]').val();
        var hover_imageValue = $('select[name="hover_image"]').val();
        var selectedCategoryId = $('select[name="category_id"]').val();

        // Multi Selector (Collections)
        var selectedCollections = [];
        $('input[name^="collections"]:checked').each(function() {
            selectedCollections.push($(this).val());
        });

        // Multiple Images Selector
        var selectedImages = $('#gallery').val();
        console.log(id);
        
        // Ajax request
        $.ajax({
            url: '{{ route("update-Products", ":id") }}'.replace(':id', id), 
            method: 'POST',
            dataType: 'json',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                title: titleValue,
                slug: slugValue,
                price: priceValue,
                selling_price: selling_priceValue,
                meta_title: meta_titleValue,
                meta_keywords: meta_keywordsValue,
                details: details,
                description: description,
                image: imageValue,
                hover_image: hover_imageValue,
                category_id: selectedCategoryId,
                collections: selectedCollections,
                gallery: selectedImages
            },
            success: function(response) {
                alert(response.success)
            },
            error: function(xhr, status, error) {
                // console.error(status, error);
                alert(status,error)
                
            }
        });
    });
});








</script>
    
@endsection