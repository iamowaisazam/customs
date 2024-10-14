@extends('theme.layout')
@section('metatags')
    <title>Shop</title>
    <meta name="description" content="{{$_s['meta_description']}}">
    <meta name="keywords" content="{{$_s['meta_keywords']}}">
@endsection
@section('css')

<style>
        .pager{
                list-style: none;
                display: flex;
                justify-content: center;
            }

            .pager li{
                margin: 0px 6px;
            }

            .pager .active span {
                color: #fb9678!important;
            }

            .pager li a{
                color:#212529;
            }

            .nice-select{
                display: inline!important;
                padding: 5px 26px!important;
            }
</style>

@endsection
@section('content')
<div id="page-content" class="template-collection">

   <!-- Bredcrumbs -->
   <div class="bredcrumbWrap bredcrumb-style2">
      <div class="container breadcrumbs">
          <a href="{{URL::to('/')}}" title="Back to the home page">Home</a>
          <span aria-hidden="true">|</span>
          <a href="{{URL::to('/shop')}}" title="Back to the home page">Shop</a>
      </div>
   </div>
  <!-- End Bredcrumbs -->
  
    <!-- Collection Banner -->
    @include('theme.shop.banner')
   <!-- End Collection Banner -->


  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar filterbar">
        <div class="closeFilter d-block d-md-block d-lg-none">
            <i class="icon an an-times"></i>
        </div>
        <div class="sidebar_tags">

            <form action="{{URL::to('/shop')}}">
                <div class="input-group mb-3">
                    <input type="text" 
                        class="form-control"
                        name="search"
                        value="{{request()->has('search') ? request()->search : ''}}" 
                        placeholder="Search Here" />
                    <button type="submit" style="background:black;color:white;" 
                    class="input-group-text">
                    <i class="icon an an-search" style="color: white"></i>
                    </button>     
                </div>
            </form>

              <!-- Categories -->
                @include('theme.shop.category')
              <!-- End Categories -->

              <!-- Collections -->
                @include('theme.shop.collection')
              <!-- End Categories -->
        </div>
    </div>
    <!-- End Sidebar -->

  <div class="col-12 col-sm-12 col-md-12 col-lg-9 main-col">
      <div class="productList">
  
        <!-- Toolbar -->
            <div class="toolbar">
                <div class="filters-toolbar-wrapper">
                    <div class="row">
                        <div class="col-6 col-md-6 col-lg-6 filters-toolbar__item collection-view-as d-flex justify-content-Start align-items-center">
                            <button type="button" class="btn-filter d-block d-md-block d-lg-none icon an an-sliders-h" data-bs-toggle="tooltip" data-bs-placement="top" title="Filters"></button>
                            Showing {{ $data->firstItem() }} - {{ $data->lastItem() }} of {{ $data->total() }}
                        </div>
                        
                        <div class="col-6 col-md-6 col-lg-6 d-flex justify-content-end align-items-center text-end">
                            <div class="filters-toolbar__item">
                            <label for="SortBy" class="d-inline">Sort By </label>

                            <select name="SortBy" id="SortBy" class="filters-toolbar__input filters-toolbar__input--sort sortby" onchange="redirectTo(this)">
                                <option @if(request()->sort == 'latest') selected @endif 
                                    value="latest">Latest</option>
                                <option @if(request()->sort == 'best_selling') selected @endif value="best_selling">Best Selling</option>
                                <option @if(request()->sort == 'ascending') selected @endif value="ascending">Alphabetically, A-Z</option>
                                <option @if(request()->sort == 'descending') selected @endif value="descending">Alphabetically, Z-A</option>
                                <option @if(request()->sort == 'low_to_high') selected @endif value="low_to_high">Price, low to high</option>
                                <option @if(request()->sort == 'high_to_low') selected @endif value="high_to_low">Price, high to low</option>
                            </select>
                        <input class="collection-header__default-sort" type="hidden" value="manual">
                            </div>
                        </div>
                        </div>
                  </div>
            </div>
        <!-- End Toolbar -->

        <div  class="grid-products grid--view-items product-three-load-more">
          <div id="shop_data" class="row">
            @foreach ($data as $item)    
      
              <div class="col-6 col-sm-6 col-md-4 col-lg-4 item">
                  <div class="product-image">
                      <a href="{{URL::to('/products')}}/{{$item->slug}}">
                          <img class="primary blur-up lazyload" 
                            data-src="{{asset($item->image)}}" 
                            src="{{asset($item->image)}}" 
                            alt="image" 
                            title="product" />

                          <img class="hover blur-up lazyload" 
                            data-src="{{asset($item->hover_image)}}" 
                            src="{{asset($item->hover_image)}}" 
                            alt="image" 
                            title="product" />
                          
                      </a>
                  </div>
                
                  <div class="product-details text-center">
                      <div class="product-name">
                          <a href="{{URL::to('/products')}}/{{$item->slug}}">{{$item->title}}</a>
                      </div>
                      <div class="product-price">
                          <span class="old-price">{{$_s['site_currency']}} {{$item->selling_price}}</span>
                          <span class="price">{{$_s['site_currency']}} {{$item->price}}</span>
                      </div>
                  </div>
                </div>
              @endforeach

              <div class="col-12 pt-5">
                <div class="paginate text-center">
                    {{ $data->links('pagination.custom') }}
                  </div>
              </div>

            </div>
          </div>
        </div>
      </div>
        
      
        </div>
       </div>
  
    </div>
  </div>

</div>
@endsection
@section('js')
<script>

function redirectTo(selectElement) {
    var selectedValue = selectElement.value;
    if(selectedValue !== "") {
        var baseUrl = "shop?sort=";
        var finalUrl = baseUrl + encodeURIComponent(selectedValue);
        window.location.href = finalUrl;
    }
}

    
// $(document).ready(function() {
//     $('.data-link').click(function(e) {
//         e.preventDefault(); 
//         var slug = $(this).data('slug');  
//         var link = $(this).data('link');  
//         $('.data-link').removeClass('active');
//         $(this).addClass('active');


//         var url = "{{ route('shop.data') }}?"+link+"=" + slug;   
        
//         $.ajax({
//             url: url,
//             method: 'GET',
//             success: function(response) {
              
//                 $('#shop_data').empty();
//                 console.log(response);
//                 if (response && response.products && response.products.length > 0) {
                
//                 response.products.forEach(function(product) {
//                     var productHtml = `
                    
//                     <div class="col-6 col-sm-6 col-md-4 col-lg-4 item" style="display: block;">
//                         <div class="product-image">
//                             <a href="products/${product.slug}">
//                                 <img class="primary blur-up lazyloaded" data-src="${product.image}" src="${product.image}" alt="${product.title}" title="${product.title}">
//                                 <img class="hover blur-up lazyloaded" data-src="${product.hover_image}" src="${product.hover_image}" alt="${product.title}" title="${product.title}">
//                             </a>
//                         </div>
//                         <div class="product-details text-center">
//                             <div class="product-name">
//                                 <a href="products/${product.slug}">${product.title}</a>
//                             </div>
//                             <div class="product-price">
//                                 <span class="old-price">${product.selling_price}</span>
//                                 <span class="price">${product.price}</span>
//                             </div>
//                         </div>
//                     </div>
                 
//                     `;
                    
                    
//                     $('#shop_data').append(productHtml);
//                 });
//             }else{
//                let Nodatafound = '<h3 class="noDataFound">No Data Found....</h3>';
//                 $('#shop_data').append(Nodatafound);
//             }
//             },
//             error: function(xhr, status, error) {
//                 console.error('AJAX Error: ' + status + error);
//             }
//         });
//     });
// });


      
    </script>


@endsection