<div class="sidebar_widget filterBox categories filter-widget">
    <div class="widget-title"><h2>Categories</h2></div>
    <div class="widget-content">
        <ul class="sidebar_categories">

            @foreach($categories as $category)
            <?php $subcats = $category->children; ?>
                
               <li class="level1 {{count($subcats) ? 'sub-level' : '' }}">
                @if($cat == $category->slug)
                <a class="data-link active" 
                    data-link="category"  data-slug="{{ $category->slug }}" href="{{URL::to('/shop?category=')}}{{$category->slug}}">
                    {{ $category->title }}
                 </a>
                 @else
                 <a class="data-link" 
                    data-link="category"  data-slug="{{ $category->slug }}" href="{{URL::to('/shop?category=')}}{{$category->slug}}">
                    {{ $category->title }}
                 </a>
                 @endif

                    @if(count($subcats))
                        {{-- <ul class="sublinks"> --}}
                        <ul class="sublinks" style="display: block;">
                            @foreach($subcats as $child)
                                <li class="level2" >
                                    @if($cat == $child->slug)
                                  <a class="active data-link" href="{{URL::to('/shop?category=')}}{{$child->slug}}" class="site-nav" data-link="category"  data-slug="{{ $child->slug }}"> {{ $child->title }} </a>
                                  @else
                                  <a class="data-link" href="{{URL::to('/shop?category=')}}{{$child->slug}}" class="site-nav" data-link="category"  data-slug="{{ $child->slug }}"> {{ $child->title }} </a>
                                  @endif  
                                  @if(count($child->children))
                                        <ul>
                                            @foreach($child->children as $subchild)
                                                <li>{{ $subchild->title }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>