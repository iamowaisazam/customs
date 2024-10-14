<div class="top-header d-block ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-10 col-sm-8 col-md-7 col-lg-4">
                <p class="phone-no float-start"><i class="icon an an-phone me-1"></i>
                    <a href="tel:+4400(111)044833">{{$_s['phone_number']}}</a></p>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 d-none d-md-none d-lg-block">
                <div class="text-center">
                    <p class="top-header_middle-text">{{$_s['topbar_title']}}</p>
                </div>
            </div>
            <div class="col-2 col-sm-4 col-md-5 col-lg-4 text-end d-none d-sm-block d-md-block d-lg-block">
                <div class="header-social">
                    <ul class="justify-content-end list--inline social-icons">
                        @if($_s['facebook_link'])
                        <li>
                            <a class="social-icons__link" 
                                href="{{$_s['facebook_link']}}" 
                                target="_blank" 
                                data-bs-toggle="tooltip" 
                                data-bs-placement="bottom" 
                                title="Facebook"><i class="icon an an-facebook"></i> 
                                <span class="icon__fallback-text">Facebook</span>
                            </a>
                        </li>
                        @endif

                        @if($_s['twitter_link'])
                        <li><a class="social-icons__link" href="{{$_s['twitter_link']}}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Twitter"><i class="icon an an-twitter"></i><span class="icon__fallback-text">Twitter</span></a></li>
                        @endif


                        @if($_s['facebook_link'])
                        <li><a class="social-icons__link" href="{{$_s['facebook_link']}}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Instagram"><i class="icon an an-instagram"></i> <span class="icon__fallback-text">Instagram</span></a></li>
                        @endif

                        @if($_s['youtube_link'])
                        <li><a class="social-icons__link" href="{{$_s['youtube_link']}}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="bottom" title="YouTube"><i class="icon icon an an-youtube"></i> <span class="icon__fallback-text">YouTube</span></a></li>
                        @endif

                    </ul>
                </div>
            </div>
            <div class="col-2 col-sm-4 col-md-5 col-lg-4 text-end d-block d-sm-none d-md-none d-lg-none">
                <!-- Mobile User Links -->
                <div class="user-menu-dropdown">
                    {{-- <a href="{{URL::to('/admin/login')}}">
                        <span class="user-menu"><i class="an an-user-alt"></i></span>
                    </a> --}}
                </div>
                <!-- End Mobile User Links -->
            </div>
        </div>
    </div>
</div>
<!-- End Top Header -->