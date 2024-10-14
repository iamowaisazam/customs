@if($collections->isNotEmpty())
    @foreach ($collections as $collection)
        <div class="product-rows section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="section-header text-center">
                            <h2 class="h2">{{ $collection->title }}</h2>
                            <p>{{ $collection->details }}</p>
                        </div>
                    </div>
                </div>

                <!-- Products -->
                <div class="grid-products grid-products-hover-btn">
                    <div class="productSlider-fullwidth">
                        @foreach ($ProductCollections->where('collection_id', $collection->id) as $ProductCollection)
                            @foreach ($collectionProducts->where('id', $ProductCollection->product_id) as $product)
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="grid-view-item style2 item">
                                        <div class="grid-view_image">
                                            
                                            <a href="{{URL::to('/products')}}/{{$product->slug}}" class="grid-view-item__link">
                                                
                                                <img class="grid-view-item__image primary blur-up lazyload" 
                                                data-src="{{asset($product->image)}}" 
                                                src="{{asset($product->image)}}"/>
                                                
                                                <img class="grid-view-item__image hover blur-up lazyload" data-src="{{asset($product->hover_image)}}" 
                                                src="{{asset($product->get_hover_image)}}"  />    
                                            </a>

                                            <div class="product-details text-center silder-collections-text">
                                                <div class="product-name">
                                                    <a href="{{URL::to('/products')}}/{{$product->slug}}">{{ $product->title }}</a>
                                                </div>
                                                <div class="product-price">
                                                    <span class="old-price">PKR {{ $product->selling_price }}</span>
                                                    <span class="price">PKR {{ $product->price }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                
                <!-- See All Button -->
                <div class="text-center">
                    <a href="/shop?collection={{$collection->slug}}" class="btn btn-primary">See All</a>
                </div>
            </div>
        </div>
    @endforeach
@endif