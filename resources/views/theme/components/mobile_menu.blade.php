  <!-- Mobile Menu -->
  <div class="mobile-nav-wrapper" role="navigation">
    <div class="closemobileMenu"><i class="icon an an-times-circle closemenu"></i> Close Menu</div>
    <ul id="MobileNav" class="mobile-nav">

        @if($main_menu)
            @foreach ($main_menu->children->where('parent_id',null) as $page)
            <li class="lvl1  parent megamenu">
                <a href="{{URL::to($page->link)}}">{{$page->title}} 
                    @if(count($page->children) > 0) 
                    <i class="an an-plus"></i>
                    @endif 
                </a>

                @if(count($page->children) > 0)
                <ul>
                    @foreach ($page->children as $chil_page)
                    <li><a href="{{URL::to($chil_page->link)}}" class="site-nav">{{$chil_page->title}}</a></li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        @endif
    </ul>
</div>
<!-- End Mobile Menu -->