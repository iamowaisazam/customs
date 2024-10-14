<div class="sidebar_widget filterBox categories filter-widget">
    <div class="widget-title"><h2>Collections</h2></div>
    <div class="widget-content">
        <ul class="sidebar_categories">
            @foreach($collections as $collection)
            <li class="level1">
                @if($col == $collection->slug)
                <a href="{{URL::to('/shop?collection=')}}{{$collection->slug}}" class="active site-nav data-link" data-link="collection" data-slug="{{ $collection->slug }}">
                    {{ $collection->title }}
                </a>
                @else
                <a href="{{URL::to('/shop?collection=')}}{{$collection->slug}}" class="site-nav data-link" data-link="collection" data-slug="{{ $collection->slug }}">
                    {{ $collection->title }}
                </a>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>