<div class="item pt-3">
                                
    <ul class="list--inline site-footer__social-icons social-icons social-colorfull">
        @if($_s['facebook_link'])
        <li><a class="social-icons__link d-inline-block" 
            href="{{$_s['facebook_link']}}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook"><i class="icon an an-facebook"></i></a></li>
        @endif
        
        @if($_s['twitter_link'])
        <li><a class="social-icons__link d-inline-block" href="{{$_s['twitter_link']}}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter"><i class="icon an an-twitter"></i> <span class="icon__fallback-text">Twitter</span></a></li>
        @endif
        
        @if($_s['instagram_link'])
        <li><a class="social-icons__link d-inline-block" 
            href="{{$_s['instagram_link']}}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Instagram"><i class="icon an an-instagram"></i> <span class="icon__fallback-text">Instagram</span></a>
        </li>
        @endif

        @if($_s['youtube_link'])
        <li><a class="social-icons__link d-inline-block" href="{{$_s['youtube_link']}}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="YouTube"><i class="icon an an-youtube"></i> <span class="icon__fallback-text">YouTube</span></a></li>
        @endif

    </ul>
</div>