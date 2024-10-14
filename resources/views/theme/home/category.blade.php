<div class="collection-box tle-bold section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="section-header text-center">
                    <h2 class="h2">Shop By Category</h2>
                    <p>Browse the collection of our best selling and top interesting products. <br/> You'll definitely find what you are looking for.</p>
                </div>
            </div>
        </div>
        <div class="row collection-grids">
            @foreach ($categories as $category)
                <div class="col-12 col-sm-6 col-md-4 item">
                    <div class="collection-grid-item">
                        <img class="blur-up lazyload" 
                        data-src="{{asset($category->image_id)}}" 
                        src="{{asset($category->image_id)}}" />
                        <a href="{{URL::to('/shop?category=')}}{{$category->slug}}" class="collection-grid-item__title-wrapper">
                            <div class="title-wrapper">
                                <h3 class="collection-grid-item__title fw-bold">
                                    {{$category->title}}</h3>
                                <span class="btn btn--secondary border-btn-1">Shop Now</span>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>