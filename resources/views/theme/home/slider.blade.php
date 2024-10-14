<div class="slideshow slideshow-wrapper pb-section">
    <div class="home-slideshow slideshow--large">
    

        @foreach ($sliders as $slide)
            <div class="slide slide1 d-block">
                <div class="slideimg blur-up lazyload">
                    <a href="{{$slide->link}}">
                    <img class="blur-up lazyload" 
                    data-src="{{ asset($slide->image_id)}}" 
                    src="{{ asset($slide->image_id)}}" 
                     />
                  </a>

                    <div class=" slideshow__text-wrap slideshow__overlay">
                        <div class=" slideshow__text-content mt-0 center">
                            <div class="container">
                                <div class="wrap-caption {{$slide->alignment}}">
                                    <h2 class="h1 mega-title slideshow__title">{{$slide->title}}</h2>
                                    <span class="mega-subtitle slideshow__subtitle">{{$slide->details}}</span>
                                    <a href="{{URL::to($slide->link)}}" class="btn btn--large">{{$slide->button}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
   
   
    </div>
</div>