<div class="product-rows section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="section-header text-center">
                    <h2 class="h2">Let’s Get Personal</h2>
                    <p>Our favorite pieces handpicked for you.</p>
                </div>
            </div>
        </div>

        <!-- Grid Product -->
        <div class="grid-products grid--view-items ">
            <div class="row">
                @foreach ($products->where("is_featured",1) as $product)
                  
                <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                    <div class="product-image">
                        <a href="{{URL::to('/products')}}/{{$product->slug}}">
                            
                            <img class="primary blur-up lazyload" 
                            data-src="{{asset($product->image)}}"
                            src="{{asset($product->image)}}" 
                             />

                            <img class="hover blur-up lazyload" 
                            data-src="{{asset($product->hover_image)}}" 
                            src="{{asset($product->hover_image)}}" />
                            
                            @if($product->is_popular)
                                <div class="product-labels">
                                    <span class="lbl pr-label3">Popular</span>
                                </div>
                            @endif
                        </a>
                    </div>
                    <!-- End Product Image -->

                    <!-- Product Details -->
                    <div class="product-details text-center">
                        <div class="product-name">
                            <a href="{{URL::to('/products')}}/{{$product->slug}}">{{$product->title}}</a>
                        </div>
                        <div class="product-price">
                            <span class="old-price">{{$_s['site_currency']}} {{$product->selling_price}}</span>
                            <span class="price">{{$_s['site_currency']}} {{$product->price}}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>