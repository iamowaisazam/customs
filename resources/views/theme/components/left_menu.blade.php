<div class="row align-items-center">

    <div class="logo col-4 col-sm-4 col-md-1 col-lg-1 align-self-center">
        <button type="button" class="d-md-none btn--link site-header__menu 
        js-mobile-nav-toggle mobile-nav--open" data-bs-toggle="tooltip" 
        data-bs-placement="bottom" 
        title="Menu">
        <i class="icon an an-times"></i>
        <i class="icon an an-bars"></i>
        </button>
        <a class=" d-md-none d-lg-inline " href="{{URL::to('/')}}">
            <img 
               class="logo-web" src="{{asset($_s['logo'])}}" width="100" />
        </a>
    </div>
    <!-- End Desktop Logo -->

     <!-- Desktop Navigation -->
     <div class="col-md-9 d-md-block d-lg-none text-center"> 
        <a href="{{URL::to('/')}}">
            <img 
               class="logo-web" src="{{asset('filemanager/'.$_s['logo'])}}" width="100" />
        </a>
     </div>
     <div class="col-12 col-lg-9 d-none d-lg-block text-center">
        <nav class="grid__item" id="AccessibleNav">
            <ul id="siteNav" class="d-flex flex-wrap site-nav medium left ms-6 hidearrow justify-content-center">
                  @if($main_menu)
                    @foreach ($main_menu->children->where('parent_id',null) as $page)
                            <li class="lvl1 parent dropdown">
                                <a href="{{URL::to($page->link)}} ">{{$page->title}} 
                                <i class="an an-angle-down"></i>
                                </a>
                            @if(count($page->children) > 0)
                                <ul class="dropdown">
                                    @foreach ($page->children as $chil_page)
                                    <li>
                                        <a href="{{URL::to($chil_page->link)}}" 
                                        class="site-nav">{{$chil_page->title}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>  
                    @endforeach
                @endif
            </ul>
        </nav>
    </div>

    <div class="col-4 col-sm-4 col-md-2 col-lg-2">
        <div class="right-action text-action d-flex-align-center justify-content-end">
            <div class="item site-header__search d-none d-md-block">
                <button type="button" class="search-trigger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Search" aria-label="Search"><i class="icon an an-search"></i></button>
            </div>          
            <div class="item site-cart">
                <a href="{{URL::to('/cart')}}" class="icon-cart site-header-cart btn-minicart text-capitalize" data-bs-toggle="modal" data-bs-target="#minicart-drawer"><i class="icon an an-shopping-bag"></i><span class="text align-middle ms-1 d-none d-md-inline-block">Cart</span><span id="CartCount" class="site-header__cart-count1 ms-1" data-cart-render="item_count">(0)</span></a>
            </div>
        </div>
    </div>
    
    <!-- End Desktop Navigation -->
</div>

