 <!-- Related Product Slider -->
 <div class=" related-product grid-products">
    <header class="section-header">
        <h2 class="section-header__title text-center h2">
            <span>You may also like</span>
        </h2>
    </header>
    <div class="productPageSlider">
      @foreach ($releated_products as $rel)

        <div class="col-12 item">
            <div class="product-image">
                <a href="{{URL::to('/products')}}/{{$rel->slug}}">
                    <img class="primary blur-up lazyload" 
                    data-src="{{asset($rel->image)}}" 
                    src="{{asset($rel->image)}}" 
                    alt="image" 
                    title="product" />
                    
                    <img class="hover blur-up lazyload" 
                    data-src="{{asset($rel->hover_image)}}" 
                    src="{{asset($rel->hover_image)}}" 
                      />
                </a>
            </div>
            <div class="product-details text-center">
                <div class="product-name">
                    <a href="{{URL::to('/products')}}/{{$rel->slug}}">{{$rel->title}}</a>
                </div>
                
                <div class="product-price">
                    <span class="old-price">{{$_s['site_currency']}} {{$rel->selling_price}}</span>
                    <span class="price">{{$_s['site_currency']}} {{$rel->price}}</span>
                </div>
         
            </div>
        </div>
        @endforeach
    </div>
  </div>
  <!-- End Related Product Slider -->