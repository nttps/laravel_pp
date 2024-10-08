<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-light ">
    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light "
        data-menu-vertical="1" data-menu-scrollable="0" data-menu-dropdown-timeout="500">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
            
            <li class="m-menu__item" aria-haspopup="true">
                <a href="{{ route('home')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Go to Website
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item" aria-haspopup="true">
                <a href="{{ route('admin.dashboard')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Dashboard
                            </span>

                        </span>
                    </span>
                </a>
            </li>
            @can('shop-tab-view')
            <li class="m-menu__section">
                <h4 class="m-menu__section-text">
                    SHOP
                </h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
            @can('catalog-view')
            <li class="m-menu__item  m-menu__item--submenu @if(request()->route()->getPrefix() == 'admin/catalogs/') m-menu__item--open @endif"
                aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-share"></i>
                    <span class="m-menu__link-text">
                        Catalogs
                    </span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        @can('product-view')
                        <li class="m-menu__item {{ Route::is('admin.catalogs.product*') ? 'm-menu__item--active' : ''}}"
                            aria-haspopup="true">
                            <a href="{{ route('admin.catalogs.product.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Products
                                </span>
                            </a>
                        </li>
                        @endcan
                        @can('catgory-view')
                        <li class="m-menu__item {{ setActive('admin/catalogs/categories') }} " aria-haspopup="true">
                            <a href="{{ route('admin.catalogs.categories.index') }}" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Categories
                                </span>
                            </a>
                        </li>
                        @endcan
                        @can('brand-view')
                        <li class="m-menu__item {{ setActive('admin/catalogs/brands') }}" aria-haspopup="true">
                            <a href="{{ route('admin.catalogs.brands.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Brands
                                </span>
                            </a>
                        </li>
                        @endcan
                        @can('tag-view')
                        <li class="m-menu__item {{ setActive('admin/catalogs/tags') }}" aria-haspopup="true">
                            <a href="{{ route('admin.catalogs.tags.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Tags
                                </span>
                            </a>
                        </li>
                        @endcan
                        @can('attribute-view')
                        <li class="m-menu__item {{ setActive('admin/catalogs/attributes') }}" aria-haspopup="true">
                            <a href="{{ route('admin.catalogs.attributes.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Attributes
                                </span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
            @endcan
            @can('order-view')
            <li class="m-menu__item {{ Route::is('admin.orders*') ? 'm-menu__item--active' : '' }}"
                aria-haspopup="true">
                <a href="{{ route('admin.orders.index')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-share"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Orders
                            </span>
                            @if($count_order->count() > 0)

                            <span class="m-menu__link-badge">
                                <span class="m-badge m-badge--danger">
                                    {{$count_order->count()}}
                                </span>
                            </span>
                            @endif
                        </span>
                    </span>

                </a>
            </li>
            @endcan
            @endcan           
            @can('general-view')
            <li class="m-menu__section">
                <h4 class="m-menu__section-text">
                    General
                </h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
            @can('general-content-view')
            <li class="m-menu__item  m-menu__item--submenu @if(request()->route()->getPrefix() == 'admin/contents') m-menu__item--open @endif"
                aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-share"></i>
                    <span class="m-menu__link-text">
                        Content
                    </span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item {{ Route::is('admin.contents.promotion*') ? 'm-menu__item--active' : '' }}"
                            aria-haspopup="true">
                            <a href="{{ route('admin.contents.promotion.index') }}" class="m-menu__link disabled">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Promotions
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item {{ Route::is('admin.contents.footer*') ? 'm-menu__item--active' : '' }} "
                            aria-haspopup="true">
                            <a href="{{ route('admin.contents.footer.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Content Link
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan
            @can('general-knowledge-view')
            <li class="m-menu__item  m-menu__item--submenu {{ Route::is('admin.article*') ? 'm-menu__item--open' : '' }}"
                aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-share"></i>
                    <span class="m-menu__link-text">
                        Knowledge
                    </span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item {{ Route::is('admin.article.categories*') ? 'm-menu__item--active' : '' }}"
                            aria-haspopup="true">
                            <a href="{{ route('admin.article.categories.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Categories
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item {{ Route::is('admin.article.index') ? 'm-menu__item--active' : '' }} {{ Route::is('admin.article.edit') ? 'm-menu__item--active' : '' }}"
                            aria-haspopup="true">
                            <a href="{{ route('admin.article.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Knowledge
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan
            @endcan
            @can('role-user-view')
            <li class="m-menu__section">
                <h4 class="m-menu__section-text">
                    Roles And Users
                </h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
            @can('user-view')
            <li class="m-menu__item {{ Route::is('admin.users*') ? 'm-menu__item--active' : '' }}" aria-haspopup="true">
                <a href="{{ route('admin.users.index')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-share"></i>
                    <span class="m-menu__link-text">
                        Users
                    </span>
                </a>
            </li>
            @endcan
            @can('role-view')
            <li class="m-menu__item {{ Route::is('admin.roles*') ? 'm-menu__item--active' : '' }}" aria-haspopup="true">
                <a href="{{ route('admin.roles.index')}}" class="m-menu__link">
                    <i class="m-menu__link-icon flaticon-share"></i>
                    <span class="m-menu__link-text">
                        Roles Admin
                    </span>
                </a>
            </li>
            @endcan
            @endcan

            @can('widget-view')
            <li class="m-menu__section">
                <h4 class="m-menu__section-text">
                    Home Page Setting
                </h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
            @can('widget-slide-view')
            <li class="m-menu__item {{ Route::is('admin.widgets.slide*') ? 'm-menu__item--active' : '' }}">
                <a href="{{ route('admin.widgets.slide.index')}}" class="m-menu__link">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-text">
                        Slides
                    </span>
                </a>
            </li>
            @endcan
            @can('widget-banner-view')
            <li class="m-menu__item {{ Route::is('admin.widgets.banner*') ? 'm-menu__item--active' : '' }}">
                <a href="{{ route('admin.widgets.banner.index')}}" class="m-menu__link">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-text">
                        Banners
                    </span>
                </a>
            </li>
            @endcan
            <li class="m-menu__item {{ Route::is('admin.widgets.seller*') ? 'm-menu__item--active' : '' }}">
                <a href="{{ route('admin.widgets.seller.index')}}" class="m-menu__link">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-text">
                        Bests Seller
                    </span>
                </a>
            </li>
            @endcan
            @can('setting-view')
            <li class="m-menu__section">
                <h4 class="m-menu__section-text">
                    Settings
                </h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
            @can('setting-general-view')
            <li class="m-menu__item {{ Route::is('admin.setting.general.index') ? 'm-menu__item--active' : ''}}">
                <a href="{{ route('admin.setting.general.index')}}" class="m-menu__link">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-text">
                        General Setting
                    </span>
                </a>
            </li>
            @endcan
            @can('setting-shop-view')
            <li class="m-menu__item {{ Route::is('admin.setting.shop*') ? 'm-menu__item--active' : ''}}">
                <a href="{{ route('admin.setting.shop.index')}} " class="m-menu__link">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-text">
                        Shop Setting
                    </span>
                </a>
            </li>
            @endcan
            @endcan
        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->