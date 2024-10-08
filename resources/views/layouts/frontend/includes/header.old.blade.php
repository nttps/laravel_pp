
<header class=" hidden-print">
    <div id="header-top">
        <div class="isDesktop d-flex align-items-center justify-content-end">
            <div id="contact-text" class="col-lg-4 col-md-5 col-sm-auto text-white">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">{{ __('main.word.contact-us')}} :
                        <a href="mailto:{{ getSetting($value = 'site_email') }}" class="text-white"><i class="far fa-envelope"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="tel:{{ getSetting($value = 'site_telephone') }}" class="text-white"><i class="fas fa-phone"></i> {{ getSetting($value = 'site_telephone') }}</li></a>
                    <li class="list-inline-item">
                        <a target="_blank" href="http://line.me/ti/p/%40{{ getSetting($value = 'social_line') }}" class="text-white"><i class="fas fa-at"></i> {{ getSetting($value = 'social_line') }}</a>
                    </li>
                </ul>
            </div>
            <div id="contact-icon" class=" col-lg-2 col-md-2 col-sm-auto col-auto text-white">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="mailto:{{ getSetting($value = 'site_email') }}" class="text-white"><i class="far fa-envelope"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="tel:{{ getSetting($value = 'site_telephone') }}" class="text-white"><i class="fas fa-phone"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a target="_blank" href="http://line.me/ti/p/%40{{ getSetting($value = 'social_line') }}" class="text-white"><i class="fas fa-at"></i></a>
                    </li>
                </ul>
            </div>
            <div id="lang-select" class="col-lg-1 col-md-2 col-sm-2 col-auto text-white">
                <a href="{{ route('switchlang' , 'th')}}" class="text-white">TH</a>/<a href="{{ route('switchlang' , 'en')}}" class="text-white">EN</a> 
            </div>
        </div>
        <div class="isMobile navTopMoblie text-right">
            <ul class="social-header">
                <li><a href="https://www.twitter.com/{{ getSetting($value = 'social_twitter') }}"><i class="fab fa-weixin"></i></a></li>
                <li><a href="https://www.instagram.com/{{ getSetting($value = 'social_instagram') }}"><i class="fab fa-instagram"></i></a></li>
                <li><a href="https://www.youtube.com/channel/{{ getSetting($value = 'social_youtube') }}"><i class="fab fa-youtube-square"></i></a></li>
                <li><a href="https://www.facebook.com/{{ getSetting($value = 'social_faceook') }}"><i class="fab fa-facebook-square"></i></a></li>
            </ul>
            <div class="barMobile">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx toggle-open-menu" href="javascript:void(0);" >
                    <span>toggle menu</span>
                </a>
            </div>
        </div>
    </div>
    <nav id="header-nav" class="">
        <div class="isDesktop navbar navbar-expand-lg navbar-light" id="header-nav-inner">
            <a class="navbar-brand mr-0" href="{{ route('home')}}"><img src="{{ \Storage::url(getSetting($value = 'site_logo')) }}" class="img-fluid" alt="logo"></a>
            <div class="categories-nav">
                <a href="" class="px-3 py-3 link-dropdown">
                    <span class="label">{{ __('main.word.categories')}}</span>
                </a>
                <ul class="menu-dropdown-content categories-content">
                    <div class="drop">
                        @foreach($menudata as $menu)
                            <li class="menu-item-has-children "><a href="{{ route('categories.show' , $menu->slug) }}" class=""> {{ $menu->name }}</a>
                                @if($menu->children->count())
                                    @include ('layouts.frontend.includes.tree_entry', ['entries' => $menu->children])
                                @endif
                            </li>
                        @endforeach
                    </div>
                </ul>
                {{-- <div class="dropdown-content categories-content">
                    <ul>
                        @for($i=1; $i<=8; $i++)
                            <li class="item dropdown-submenu">
                                <a href="">ตู้เบรคเกอร์ตู/้ไฟ</a> 
                                <ul class="dropdown-content-sub">
                                    test
                                </ul>
                            </li>
                            
                        
                    </ul>
                </div> --}}
                
            </div>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mt-2 mt-lg-0">
                    <li class="nav-item {{ Route::is('home')  ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}"> {{ __('main.word.home')}}
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('products.index')  ? 'active' : '' }}" href="{{ route('products.index') }}">เกี่ยวกับเรา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('promotion')  ? 'active' : '' }}" href="{{ route('promotion') }}">{{ __('main.word.promotions')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->route()->getPrefix() == '/knowledge') active @endif" href="{{ route('knowledge.index') }}">{{ __('main.word.knowledges')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('contact')  ? 'active' : '' }}" href="{{ route('contact') }}">{{ __('main.word.contact-us')}}</a>
                    </li>
                </ul>

            </div>
            <div class="d-flex align-items-center justify-content-end mb-0 col-lg-5">
                <div id="header-search" class="col-7 col-md-7 col-lg-7 col-xl-8">
                    <form id="search_mini_form" action="{{ route('search')}}" method="get">
                        <div class="form-search isDesktop">
                            <label for="search">ค้นหา:</label>
                            <input placeholder="{{ __('main.word.search-word')}}" id="search" type="text" name="q" value="{{ isset(request()->q) ? request()->q : '' }}"
                                class="input-text" autocomplete="off">
                            <button type="submit" title="ค้นหา" class="button" id="btn-submit"><i class="fas fa-search"></i></button>
                            <button type="button" title="ค้นหา" class="button showsearch-on-hide" id="btn-show-search"><i class="fas fa-search"></i></button>
                            <div id="search_autocomplete" class="search-autocomplete" style="display:none;">
                                
                            </div>
                        </div>
                    
                    </form>
                </div>
                <div class="col-auto text-center icon-user">
                    <a href=""><i class="far fa-user"></i></a>
                    <div>
                        @if (Auth::guest())
                            <a href="{{ route('login') }}" class="mb-0">{{ __('main.word.login')}}</a> / <a href="{{ route('register') }}">{{ __('main.word.register')}}</a>
                        @else
                            <a href="{{ route('customer.history.index') }}" class="mb-0">{{ __('main.word.my-profile')}}</a>
                        @endif
                    </div>
                </div>
                <div class="col-auto text-center icon-basket">
                    
                    <div class="num-basket"><div class="number">{{ Cart::getTotalQuantity() }}</div></div>
                    <a href="{{ route('cart') }}"><i class="fas fa-shopping-cart fa-flip-horizontal"></i>
                    <div>{{ __('main.word.your-cart')}}</div>
                
                </a>
                </div>
            </div>
        </div>
        <div class="isMobile nabBar">
           <div class="row no-gutters">
                <div class="col-2">
                    <a href="javascript:void(0);" id="showCatemenu" class="grid-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path id="grid-icon-svg" d="M 4 4 L 4 8 L 8 8 L 8 4 L 4 4 z M 10 4 L 10 8 L 14 8 L 14 4 L 10 4 z M 16 4 L 16 8 L 20 8 L 20 4 L 16 4 z M 4 10 L 4 14 L 8 14 L 8 10 L 4 10 z M 10 10 L 10 14 L 14 14 L 14 10 L 10 10 z M 16 10 L 16 14 L 20 14 L 20 10 L 16 10 z M 4 16 L 4 20 L 8 20 L 8 16 L 4 16 z M 10 16 L 10 20 L 14 20 L 14 16 L 10 16 z M 16 16 L 16 20 L 20 20 L 20 16 L 16 16 z"/>
                        </svg>
                    </a>
                </div>
                <div class="col-6" id="header-search-mobile" style="display:inline-block">
                        <form id="search_mini_form" action="{{ route('search')}}" method="get" class="search_mobile_form">
                            <div class="form-search">
                                <label for="search">ค้นหา:</label>
                                <input placeholder="{{ __('main.word.search-word')}}" id="search_mobile" type="text" name="q" value="{{ isset(request()->q) ? request()->q : '' }}"
                                    class="input-text" autocomplete="off">
                                <button type="submit" title="ค้นหา" class="button" id="btn-submit"><i class="fas fa-search"></i></button>
                
                                <div id="search_autocomplete" class="search-autocomplete" style="display:none;">
                                </div>
                            </div>
                        
                        </form>
                    </div>
                <div class="col-4 ml-auto text-right">
                    {{-- <form id="search_mini_form" action="" method="get" class="search-mobile isMoblie">
                        <div class="form-search-mobile isMobile">
                            <input placeholder="ระบุคำค้นหา เช่น โคมไฟ หลอดตะเกียบ" id="search_mobile" type="text" name="q" value=""
                                class="input-text" autocomplete="off">
                            <div id="search_autocomplete" class="search-autocomplete"></div>
                        </div>
                    
                    </form> --}}
                   
                    <ul class="navBarBot">
                        <li><a href="javascript:void(0);" id="ShowSearchMobile"><i class="fas fa-search"></i></a></li>
                        <li><a href="{{ route('customer.history.index') }}"><i class="far fa-user"></i></a></li>
                        <li><a href="{{ route('cart') }}"><i class="fas fa-shopping-cart fa-flip-horizontal"></i></a></li>
                    </ul>
                </div>
           </div>
           
        </div>
    </nav>
</header>

