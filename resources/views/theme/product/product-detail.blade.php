@extends('theme.layout')

@php
    $gallery = $product->images ? explode(',',$product->images) : [];
@endphp

@section('metatags')
    <title>{{$product->title}}</title>
    <meta name="description" content="{{$product->meta_description}}">
    <meta name="keywords" content="{{$product->meta_keywords}}">
@endsection
@section('css')

<style>
    .product-info p span {
       padding-left: 0px!important;   
    }

    .loader {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        display: inline-block;
        vertical-align: middle;
        margin-right: 10px;
        border-bottom-color: transparent; 
   }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Optional: Add a label to indicate loading */
    .loading-label {
        font-family: Arial, sans-serif;
        font-size: 14px;
        color: #333;
        display: inline-block;
        vertical-align: middle;
    }
</style>
  
@endsection
@section('content')
<div id="page-content" class="template-product">

  <!-- Bredcrumbs -->
   @include('theme.product.breadcrums')
  <!-- End Bredcrumbs -->

  <div class="container">
    <div id="ProductSection-product-template" class="product-template__container prstyle2">
   
    <!-- #ProductSection product template -->
    <div class="product-single product-single-1">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="product-details-img product-single__photos bottom">
                  
                  <!-- Product Images -->
                    <div class="zoompro-wrap product-zoom-right pl-20">
                        <div class="zoompro-span">
                            @if(count($gallery) > 0)
                            <img class="blur-up lazyload zoompro" 
                             data-zoom-image="{{asset($gallery[0])}}"  
                             src="{{asset($gallery[0])}}" />
                            @endif               
                        </div>
                        <div class="product-buttons">
                            <a href="#" class="btn prlightbox" data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom Image"><i class="icon an an-expand-arrows-alt" aria-hidden="true"></i></a>
                        </div>
                    </div>

                    <div class="product-thumb product-thumb-1">
                        <div id="gallery" class="product-dec-slider-1 product-tab-left">
                       
                          @foreach ($gallery as $img) 
                            <a  data-image="{{asset($img)}}" 
                                data-zoom-image="{{asset($img)}}" 
                                class="slick-slide slick-cloned active" 
                                data-slick-index="-4" 
                                aria-hidden="true" 
                                tabindex="-1">
                                <img class="blur-up lazyload" src="{{asset($img)}}"/>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="lightboximages">
                        @foreach ($gallery as $img) 
                        <a href="{{asset($img)}}" data-size="1462x2048"></a>
                        @endforeach
                    </div>
                    <!-- End Product Images -->

                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <!-- Product Info -->
                <div class="product-single__meta">
                    <h1 class="product-single__title">{{$product->title}}</h1>
                    
                    <!-- Product Price -->
                    <div class="product-single__price product-single__price-product-template">
                        <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                            <span id="ProductPrice-product-template">
                              <span class="money">
                                @if($product->selling_price)
                                    <span class="old-price" style="font-size: 20px;">
                                        {{$_s['site_currency']}} {{$product->selling_price}}
                                    </span>
                                @endif
                                <span class="r-price" >{{$product->price}}</span>
                              </span>
                            </span>
                        </span>
                    </div>
                    <!-- End Product Price -->

                    <!-- Product Description -->
                    <div class="product-single__description rte">
                        <p class="mb-2">{{$product->short_des}}</p>
                    </div>
                    <!-- End Product Description -->

                    <!-- Product Intro -->
                    <div class="product-info">
                      <p class="product-stock">Availability: 
                        <span class="instock">In Stock</span>
                        <span class="outstock hide">Unavailable</span>
                      </p> 
                      <p class="product-sku">SKU: 
                        <span class="variant-sku">.</span>
                      </p>

                    </div>
                    <div class="product-description">
                        {!! $product->description !!}
                    </div>
                   <!-- End Product Intro -->
          
                    <!-- Form -->
                    <form method="post" 
                     action="{{URL::to('/cart/add_to_cart')}}" 
                     id="product_form_10508262282" 
                     accept-charset="UTF-8" 
                     class="product-form product-form-product-template product-form-border hidedropdown" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="product_id" value="{{Crypt::encryptString($product->id)}}" />
                        <input type="hidden" name="sku" />
                        <input type="hidden" name="price" />

                    
                          @foreach ($attributes as $key => $attribute)
                          <?php 
                            $rowKey = 0;
                           ?>
                            <div class="swatch clearfix swatch-1 option2 w-100" 
                                data-option-index="1">
                              
                                <div class="product-form__item" 
                                 data-attribute-id="{{$attribute['id']}}">
                                  <label>{{$attribute['title']}}:</label>
                                  @foreach ($values as $value)
                                  @if($value['attribute_id'] == $attribute['id'])
                                    <div data-value="{{$value['id']}}" 
                                         class="swatch-element {{$value['title']}} available">
                                         
                                         <input 
                                           class="variation_change swatchInput"
                                           @if($rowKey == 0) checked @endif 
                                           id="variation_id-{{$value['id']}}" 
                                           type="radio" 
                                           name="attr[{{$attribute['id']}}]" 
                                           value="{{$value['id']}}" />
                                            
                                         <label class="swatchLbl medium" 
                                            for="variation_id-{{$value['id']}}" 
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="{{$value['title']}}">{{$value['title']}}</label>
                                    
                                    </div>
                                    <?php 
                                      $rowKey += 1;
                                    ?>
                                    @endif
                                  @endforeach
                              </div>
                          </div>    
                          @endforeach
                                              
                        <!-- Product Action -->
                        <div class="product-action clearfix">
                            <div class="product-form__item--quantity">
                                <div class="wrapQtyBtn">
                                    <div class="qtyField">
                                        <a class="qtyBtn minus" 
                                             href="javascript:void(0);">
                                            <i class="icon an an-minus" aria-hidden="true"></i>
                                        </a>
                                        <input 
                                            type="text" 
                                            name="quantity" 
                                            value="1" 
                                            class="variation_change product-form__input qty" />
                                        <a class="qtyBtn plus" href="javascript:void(0);">
                                          <i class="icon an an-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>                                
                            <div class="product-form__item--submit">
                                <button 
                                    id="addToCartButton"
                                    name="cart-type"
                                    type="button" 
                                    value="cart"
                                    class="btn product-form__cart-submit">
                                    <span class="cart_text">Add to cart</span>
                                    <span class="loader" style="display: none;"></span>
                                </button>
                            </div>
                            <div class="payment-button" data-shopify="payment-button">
                                  
                            </div>
                        </div>
                    </form>
                    <!-- End Form -->

                    <!-- Product Feature -->
                      @include('theme.product.featuresBox')
                    <!-- End Product Feature -->

                </div>
            </div>
        </div>


            </div>
        </div>

        @include('theme.product.releated')

  </div>
</div>
@endsection
@section('js')

<script> 

   let arrays = [];
   let json  = '<?php echo json_encode($variations);?>';
   const variations = JSON.parse(json);
  
    $(".qtyBtn").on("click", function () {
           
        var qtyField = $(this).parent(".qtyField");
        var oldValue = $(qtyField).find(".qty").val();
        var newVal = 1;

            if ($(this).is(".plus")) {
                newVal = parseInt(oldValue) + 1;
            } else if (oldValue > 1) {
                newVal = parseInt(oldValue) - 1;
            }
            $(qtyField).find(".qty").val(newVal);
            $(qtyField).find(".qty").trigger('change');
    });

</script>

        <!-- Photoswipe Gallery -->
        <script src="{{asset('public/theme/assets/js/vendor/photoswipe.min.js')}}"></script>
        <script src="{{asset('public/theme/assets/js/vendor/photoswipe-ui-default.min.js')}}"></script>
        <script>
            $(function () {


                var $pswp = $('.pswp')[0],
                        image = [],
                        getItems = function () {
                            var items = [];
                            $('.lightboximages a').each(function () {
                                var $href = $(this).attr('href'),
                                        $size = $(this).data('size').split('x'),
                                        item = {
                                            src: $href,
                                            w: $size[0],
                                            h: $size[1]
                                        }
                                items.push(item);
                            });
                            return items;
                        }
                var items = getItems();

                $.each(items, function (index, value) {
                    image[index] = new Image();
                    image[index].src = value['src'];
                });
                $('.prlightbox').on('click', function (event) {
                    event.preventDefault();

                    var $index = $(".active-thumb").parent().attr('data-slick-index');
                    $index++;
                    $index = $index - 1;

                    var options = {
                        index: $index,
                        bgOpacity: 0.9,
                        showHideOpacity: true
                    }
                    var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
                    lightBox.init();
                });
            });
        </script>

        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="pswp__bg"></div>
            <div class="pswp__scroll-wrap"><div class="pswp__container"><div class="pswp__item"></div><div class="pswp__item"></div><div class="pswp__item"></div></div><div class="pswp__ui pswp__ui--hidden"><div class="pswp__top-bar"><div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="Close (Esc)"></button><button class="pswp__button pswp__button--share" title="Share"></button><button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button><button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button><div class="pswp__preloader"><div class="pswp__preloader__icn"><div class="pswp__preloader__cut"><div class="pswp__preloader__donut"></div></div></div></div></div><div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap"><div class="pswp__share-tooltip"></div></div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button><button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button><div class="pswp__caption"><div class="pswp__caption__center"></div></div></div></div>
        </div>



        <script>
            $(function(){

                $('.variation_change').change(function(e){ 
                   
                   let forms = {
                     qty:$('.qty').val(),
                     variations:[],
                   };
 
                    $('.product-form__item').each(function () {
                        let el = $(this);
                        let attribute_id =  el.attr('data-attribute-id');
                        var selectedValue = $(this).find('input[type="radio"]:checked').val();
                        forms.variations.push({
                            'attribute':attribute_id,
                            'value':selectedValue,
                         });
                    });

                    var groupedBySku = variations.reduce(function (result, obj) {
                        var key = obj.sku;
                        result[key] = result[key] || [];
                        result[key].push(obj);
                        return result;
                    }, {});

                    var findSku = false;
                    var selectedAtributes = forms.variations.map(obj =>  Number(obj.value));
                    for (const key in groupedBySku) {

                        if (groupedBySku.hasOwnProperty(key)) {
                          
                            const item = groupedBySku[key];
                            let is_found_sku = [];
                            item.forEach(element => {  
                                
                                if(selectedAtributes.includes(element.value_id)){
                                    is_found_sku.push(1);
                                }else{
                                    is_found_sku.push(0);
                                } 
                            });
                            if(is_found_sku.includes(0) == false){
                                findSku = item.pop();
                            }
                       }
                    }

                    if(findSku){

                        $('.variant-sku').text(findSku.sku);
                        $('.r-price').text("{{$_s['site_currency']}} "+findSku.price);
                        $('.instock').text('In Stock');
                        $('.instock').css('color','green');
                        $('.product-form__item--quantity').show();
                        $("[name='price']").val(findSku.price);
                        $("[name='sku']").val(findSku.variation_id);
                        $("#addToCartButton").attr('disabled',false);

                    }else{
                        
                        $('.product-form__item--quantity').hide();
                        $('.product-form__item--quantity .qty').val(0);
                        $('.instock').text('Out Of Stock');
                        $('.instock').css('color','red');
                        $('.variant-sku').text('-');
                        $('.r-price').text('-');
                        $("[name='price']").val('');
                        $("[name='sku']").val('');

                        $("#addToCartButton").attr('disabled',true);
                    }


                });

                $('.variation_change').trigger('change');


            $(".product-form__cart-submit").click(function (e) { 

               
                if( $('.product-form__input').val() == 0){
                    $.toast({
                            heading: "error",
                            text: 'Increace Quantity',
                            position:'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 3500,
                            stack: 6,
                        });

                        return false;
                }

                $('.loader').show();

                $(".product-form__cart-submit").attr('disabled','disabled');

                let variations = [];
                $('.product-form__item').each(function () {
                    var selectedValue = $(this).find('input[type="radio"]:checked').val();
                    variations.push(Number(selectedValue));
                });

                $.ajax({
                    type: "get",
                    url: site_url+"/cart/add_to_cart",
                    data: {
                        type:"add",
                        attr:variations,
                        action:"increament",    
                        sku:$('[name="sku"]').val(),
                        quantity:$('[name="quantity"]').val(),
                    },
                    dataType: "json",
                    success: function (response) {
                        $(".product-form__cart-submit").removeAttr('disabled');
                        $.toast({
                            heading: "success",
                            text: response.message,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            stack: 6,
                        });
                        $('.site-header-cart').trigger('click');
                        $('.product-form__input').val(1);
                        $('.loader').hide();

                    },
                    error:function (response) {
                        $(".product-form__cart-submit").removeAttr('disabled');
                        $.toast({
                            heading: "error",
                            text: response.message ? response.message : 'Error Found' ,
                            position:'top-right',
                            loaderBg:'#ff6849',
                            icon: 'error',
                            hideAfter: 3500,
                            stack: 6,
                        });
                        $('.loader').hide();

                    },
                    
                });
            });
            

            });
        </script>

@endsection