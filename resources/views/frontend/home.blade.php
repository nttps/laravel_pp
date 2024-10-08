@extends('layouts.frontend.home')

@section('custom-css')  
    <meta property="og:url" content="{{ route('home')}}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ getSetting('site_title') }}">
    <meta property="og:description" content="{{ getSetting('site_description') }}">
    <meta property="og:image" content="{{ \Storage::url(getSetting('site_logo')) }}">
    <link rel="stylesheet" href="{{ mix('css/home.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/flexslider.css')}}" type="text/css" media="screen">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css')}}" type="text/css" media="screen">
@stop

@section('content')
    <div id="header-slide" class="container-fluid isMobile">
        <div class="flexslider">
            <ul class="slides">
                @foreach ($slides as $slide)
                    <li>
                        @if(isset($slide->url_link))
                            <a href="{{ $slide->url_link }}">
                                <img src="{{ \Storage::url($slide->image) }}" class="img-fluid"/>
                            </a>
                        @else 
                            <img src="{{ \Storage::url($slide->image) }}" class="img-fluid"/>
                        @endif
                        
                    </li>
                @endforeach
                
            </ul>
        </div>
    </div>
    <div class="main-silde-cate" style="background-image:url('{{ asset('images/slides/slide2.png') }}');">
        <div class="inner"> 
            <div class="category-banner-ta d-flex">
                <div class="col-left">
                    <div class="menu-category-view index-category category-view">
                        <h3 class="menu-button-title"><i class="sc-hd-prefix2-icon sc-hd-prefix2-icon-category sc-hd-prefix2-icon-s"> </i>SHOP          </h3>
                        <ul class="category-list">
                            
                           
                            @foreach ($categorie_banners as $categorie_banner)
                                <li class="category-item-wrapper first-item " data-cid="44" data-cname="{{ $categorie_banner->name}}">
                                    <a class="category-item util-ellipsis" target="_blank" href="{{ route('categories.show' , $categorie_banner->slug) }}" title="{{ $categorie_banner->name}}">
                                        {{ $categorie_banner->name}}
                                    </a>
                                </li>
                            @endforeach
                            <li data-role="vmore" class="category-item-wrapper vmore">
                                <a class="category-item vmore-link" target="_blank" href="{{ route('categories.index') }}">All Categories<i class="ui2-icon ui2-icon-arrow-right"></i></a>
                                
                                    <div class="hover-fix"></div>
                                    {{-- <ul class="vmore-menu">                                        
                                        <li class="menu-item util-ellipsis">
                                            <a target="_blank" href="" title="Machinery" data-cid="43" data-goldkey="9" data-goldlog="area=all_cate1" data-spm-anchor-id="a2700.8293689.201703.10">
                                                Machinery
                                            </a>
                                        </li>
                                        <li class="menu-item util-ellipsis">
                                            <a target="_blank" href="" title="Consumer Electronics" data-cid="44" data-goldkey="9" data-goldlog="area=all_cate1" data-spm-anchor-id="a2700.8293689.201703.14">
                                                Consumer Electronics
                                            </a>
                                        </li>
                                        <li class="menu-item util-ellipsis">
                                            <a target="_blank" href="" title="Auto" data-cid="34" data-goldkey="9" data-goldlog="area=all_cate1" data-spm-anchor-id="a2700.8293689.201703.17">
                                                Auto
                                            </a>
                                            
                                                <span class="divider">/</span>
                                            
                                        
                                            <a target="_blank" href="" title="Transportation" data-cid="12" data-goldkey="9" data-goldlog="area=all_cate1" data-spm-anchor-id="a2700.8293689.201703.18">
                                                Transportation
                                            </a>
                                        </li>
                                        <li class="menu-item util-ellipsis">
                                            <a target="_blank" href="" title="Apparel" data-cid="3" data-goldkey="9" data-goldlog="area=all_cate1" data-spm-anchor-id="a2700.8293689.201703.19">
                                                Apparel
                                            </a>
                                            
                                                <span class="divider">/</span>
                                            
                                        
                                            <a target="_blank" href="" title="Textiles" data-cid="4" data-goldkey="9" data-goldlog="area=all_cate1" data-spm-anchor-id="a2700.8293689.201703.20">
                                                Textiles
                                            </a>
                                            
                                                <span class="divider">/</span>
                                            
                                        
                                            <a target="_blank" href="" title="Timepieces" data-cid="36" data-goldkey="9" data-goldlog="area=all_cate1" data-spm-anchor-id="a2700.8293689.201703.21">
                                                Timepieces
                                            </a>
                                            
                                                <span class="divider">/</span>
                                            
                                        
                                            <a target="_blank" href="" title="Accessories" data-cid="339" data-goldkey="9" data-goldlog="area=all_cate1" data-spm-anchor-id="a2700.8293689.201703.22">
                                                Accessories
                                            </a>
                                        </li>
                                    </ul> --}}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="fix-content fix-content-left">
                    <div class="fix-content fix-content-right">
                        <div id="carousel-demo-2" class="first-banner ui-switchable">
                            <span class="first-banner-prev ui-switchable-prev-btn" data-role="prev">
                                <div class="sc-hd-prefix2-icon sc-hd-prefix2-icon-left"></div>
                            </span>
                            <span class="first-banner-next ui-switchable-next-btn" data-role="next">
                                <div class="sc-hd-prefix2-icon sc-hd-prefix2-icon-right"></div>
                            </span>
                            <div class="scroller" style="position: relative;">
                                <div class="first-banner-content ui-switchable-content" data-role="content">
                                    @foreach ($slides as $slide)
                                        <a class="banner-item ui-switchable-panel" target="_blank" href="{{ $slide->url_link }}" style="float: left;">
                                            <img class="banner-image" src="{{ \Storage::url($slide->image) }}">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>               
                    <div class="col-right">
                        <div class="promotion">

                            <a target="_blank" href="" class="top-banner">
                                สินค้าคัดสรรค์พิเศษเพื่อคุณ
                                <span class="view-more">Source Now</span>
                            </a>
                            <div class="promotion-list">
                                @foreach ($products_banner as $product_banner)
                                    <a href="{{ route('products.show' , $product_banner->slug ) }}" target="_blank" class="promotion-item zoom-wrap">
                                        <div class="title">{{ $product_banner->name }}</div>
                                        <div style="max-width: 110px;line-height: 18px;font-size: 14px;">{!! $product_banner->getRealPriceBannerAttribute() !!}</div>
                                        <div class="view-more"><i class="fas fa-shopping-cart"></i> ดูรายละเอียด</div>
                                        <div class="item-banner">
                                            <img src="{{ \Storage::url($product_banner->image) }}" class="zoom-in">
                                        </div>
                                    </a>
                                @endforeach                               
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="promotion-home" class=" mb-4">
        <div class="promotion-content">
            <ul class="promotion-box">
                @foreach ($banners as $banner)
                <li class="">
                        <a href="{{ $banner->url_link }}">
                            <img src="{{ \Storage::url($banner->image) }}" class="img-fluid"/>
                        </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div style="clear"></div>
    <div class="container-fluid">
        @foreach($categories as $category)
            <div class="product-cate productCateLoad-M isMobile">
                <h2 class="title-container ">{{ $category->name}}</h2>
                <hr class="border-purple border-bottom-4 mt-0 mb-2 w-25 ml-auto  d-inline-block" style="border-color: #12225b !important;">
                <div class="product-cate-container mb-1 owl-carousel owl-theme" id="carousel{{$category->id}}">
                    {{-- <div class="product-cate-item" style="width:210px;height:100%">
                        test
                    </div> --}}
                    @forelse ($category->products()->where('is_show' , 1)->take(8)->get() as $itemProduct)
                        <div class="product-cate-item product-relate-item mainHover"  style="width:210px">
                            <a href="{{ route('products.show' , $itemProduct->slug ) }}">
                            <div class="product-image box_hover_img">
                                {!! $itemProduct->getPercentDiscount() !!}
                                
                                <img src="{{ \Storage::url($itemProduct->image) }}" class="img-hover" style="display: block;border:1px solid #d7d7d7;">
                                
                                <span class="box_hover tha"></span>
                            </div>
                            </a>
                            <h2 class="mb-0 text-center">{{ $itemProduct->getName() }}</h2>
                            <div class="product-price d-flex justify-content-between">
                                {!! $itemProduct->getRealPriceAttribute() !!}
                                <div style="clear:both;"></div>
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <a href="{{ route('products.show' , $itemProduct->slug ) }}" class="btn btn-warning text-white btn-pp-fixed" style="font-size:14px;">{{ __('main.word.view_product') }}</a>
                            </div>
                            <div class="product-compare">
                                @if ($itemProduct->is_option == 1)
                                    <a href="{{ route('products.show' , $itemProduct->slug ) }}" class="btn btn-danger mt-3 btn-pp-fixed" style="font-size:14px;"><i class="fas fa-shopping-cart"></i> {{ __('main.word.view_option') }}</a>
                                @else
                                    <button data-id="{{ $itemProduct->id }}" class="btn btn-danger mt-3 add-to-cart btn-pp-fixed" style="font-size:14px;"><i class="fas fa-shopping-cart"></i> {{ __('main.word.buy_now') }}</button>
                                @endif
                                <div class="text-left chk-compare">
                                    <label> 
                                        <input type="checkbox" class="btn-chk-compare" name="" data-id="{{ $itemProduct->id }}" id=""> {{ __('main.word.compare_product') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row d-flex justify-content-between py-3 border-bottom mb-3">
                    <div class="col-5">
                        <a href="{{ route('categories.show' , $category->slug) }}" class="btn btn-warning text-white" style="font-size:14px;">{{ __('main.word.view_all_product') }}</a>
                    </div>
                    <div class="col-7">
                        <div class="customNavigation"> <a class="btn prev">Previous</a> <a class="btn next">Next</a> </div>
                    </div>
                </div>
            </div>

            <div class="product_wrapper_container productCateLoad isDesktop">
                <div class="product_wrapper cate_brand">
                    <h2 class="title-container border-purple d-inline-block border-bottom-4 mt-5" style="border-color: #12225b !important;">{{ $category->name}}</h2>
                    <ul class="sub-cate-link mt-3">
                        @foreach ($category->products()->where('is_show' , 1)->groupBy('brand_id')->get() as $itemProduct)

                            @isset($itemProduct->brands) 
                                <li class="sub-cate-item"><a href="{{ route('brands.show' , $itemProduct->brands->slug) }}">{{ $itemProduct->brands->name }}</a></li>
                            
                            @endisset 
                        @endforeach

                    </ul>
                </div>
                
                <div class="product_wrapper cate_product">
                    <div class="products">
                        @forelse ($category->products()->where('is_show' , 1)->take(8)->get() as $itemProduct)
                            <!-- It's likely you'll need to link the card somewhere. You could add a button in the info, link the titles, or even wrap the entire card in an <a href="..."> -->
                            <div class="product-card mainHover">
                                <div class="text-center">
                                    <a href="{{ route('products.show' , $itemProduct->slug ) }}">
                                        <div class="product-image box_hover_img">
                                            {!! $itemProduct->getPercentDiscount() !!}
                                        
                                            <img src="{{ \Storage::url($itemProduct->image) }}" class="img-hover">
                                            
                                            <span class="box_hover tha"></span>
                                        </div>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <h2 class="product-name mb-0">
                                        <a href=""> {{ $itemProduct->getName() }}</a>
                                    </h2>
                                    <h3 class="product-desc py-2 mb-0">{{ str_limit($itemProduct->getShortDescription(), $limit = 100, $end = '...') }}</h3>
                                    <div class="prodict-price  d-flex justify-content-between px-2 py-2">
                                        {!! $itemProduct->getRealPriceAttribute() !!}
                                        
                                    </div>
                                </div>
                                <div class="product-btn-cart">
                                    <a href="{{ route('products.show' , $itemProduct->slug ) }}" class="btn btn-warning text-white btn-pp-fixed" style="font-size:14px;"> {{ __('main.word.view_product') }}</a>
                                </div>
                                <div class="product-compare">
                                    @if ($itemProduct->is_option == 1)
                                        <a href="{{ route('products.show' , $itemProduct->slug ) }}" class="btn btn-danger mt-3 btn-pp-fixed" style="font-size:14px;"><i class="fas fa-shopping-cart"></i> {{ __('main.word.view_option') }}</a>
                                    @else
                                        <button data-id="{{ $itemProduct->id }}" data-type="product" class="btn btn-danger mt-3 add-to-cart btn-cart btn-pp-fixed" style="font-size:14px;"><i class="fas fa-shopping-cart"></i> {{ __('main.word.buy_now') }} </button>
                                    @endif
                                    <div class="text-left chk-compare">
                                        <label> 
                                            <input type="checkbox" class="btn-chk-compare" name="" data-id="{{ $itemProduct->id }}" id=""> {{ __('main.word.compare_product') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @empty
                            
                        @endforelse
                            
                    </div>
                    <div class="text-right pt-2 pr-2"><a href="{{ route('categories.show' , $category->slug) }}" class="btn btn-red-light btn-lg btn-pp btn-pp-fixed text-white " style="font-size:14px;">ดูสินค้าเพิ่มเติม</a></div>
                </div>
            </div>
        @endforeach
        <div class="col-12 mb-2 text-center">
            <a class="btn-loadmore loadmore" id="LoadCate" href="javaScript:void(0);" style="display:none;"> {{ __('main.word.load_more') }} <i class="fas fa-plus"></i> </a>
            <div class="lds-ellipsis loading" style="display:none;"><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
    <div class="container-fluid layer-pc">
        <h2 class="title-container d-inline-block" >{{ __('main.word.best_seller') }}</h2>
        <hr class="border-orange-light border-top-4 mt-0 mb-2 w-25 ml-auto  d-inline-block">
    </div>
    <div id="product-good-seller" class="container-fluid mb-3 isMobile layer-pc">
        <div class="row">
            @foreach($products_seller as $product_seller)
                <div class="col-6 col-lg-3 col-md-4 mb-3 product-good-mo-load">
                    <div class="product-relate-item mainHover" style="border:1px solid #d7d7d7;padding: 5px;position:relative;">
                        <div class="text-center">
                            <a href="{{ route('products.show' , $itemProduct->slug ) }}">
                                <div class="product-image box_hover_img">
                                    {!! $product_seller->getPercentDiscount() !!}
                                
                                    <img src="{{ \Storage::url($product_seller->image) }}" class="img-hover img-fluid">
                                    </a>
                                    <span class="box_hover tha"></span>
                                </div>
                            </a>
                        </div>
                        <div class="d-flex justify-content-between px-2 product-detail-top">
                            <h2 class="product-name mb-0">
                                <a href=""> {{ $product_seller->getName() }}</a>
                            </h2>
                        </div>
                        <div class="product-price d-flex justify-content-between px-2">
                            {!! $product_seller->getRealPriceAttribute() !!}
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <a href="{{ route('products.show' , $product_seller->slug ) }}" class="btn btn-red-light btn-pp text-white btn-pp-fixed " style="font-size:14px;">{{ __('main.word.view_product') }}</a>
                        </div>
                        <div class="product-compare">
                            @if ($product_seller->is_option == 1)
                                <a href="{{ route('products.show' , $product_seller->slug ) }}" class="btn btn-danger mt-3 btn-pp-fixed" style="font-size:14px;" ><i class="fas fa-shopping-cart"></i> {{ __('main.word.view_option') }}</a>
                            @else
                                <button data-id="{{ $product_seller->id }}" data-type="product" class="btn btn-danger mt-3 btn-cart btn-pp-fixed" style="font-size:14px;"><i class="fas fa-shopping-cart"></i> {{ __('main.word.buy_now') }}</button>
                            @endif
                            <div class="text-left chk-compare">
                                <label> 
                                    <input type="checkbox" class="btn-chk-compare" name="" id="" data-id="{{ $product_seller->id }}"> {{ __('main.word.compare_product') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-12 mt-4 mb-2 text-center">
                <a class="btn-loadmore loadmore" id="LoadGood" href="javaScript:void(0);"> {{ __('main.word.load_more') }} <i class="fas fa-plus"></i> </a>
                <div class="lds-ellipsis loading" style="display:none;"><div></div><div></div><div></div><div></div></div>
            </div>
        </div>

    </div>
    <div id="product-good-seller" class="container-fluid mb-3 isDesktop" >
        <div class="wrapper">
            <div class="product-good-container">
                <div class="product-good-top d-flex row">
                    <div class="col-6 px-0 d-flex">
                        <div class="col-6">
                            <div class="product-good-first border" style="height:100%;max-height:1025px">
                                <a href="{{ route('products.show' , $product_left_1->slug) }}"><img src="{{ \Storage::url($seller_left_1->image) }}" style="height:100%;width:100%;display: block;" ></a>
                                <div class="product-good-detail px-5 py-5" style="position:absolute;bottom:0;">
                                    @if($product_left_1)
                                        <h5 class="mb-0" style="padding:5px;background-color:white;">{{$product_left_1->getName()}}</h5>
                                        <div class="product-price d-flex justify-content-between" style="padding:5px;background-color:white;">
                                            {!! $product_left_1->real_price !!}
                                        </div>
                                        <div class="mt-2">
                                            <a href="{{ route('products.show' , $product_left_1->slug) }}"  class="btn btn-red-light btn-pp text-white" style="font-size:14px;">{{ __('main.word.view_product') }}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-6 ">
                            <div class="product-relate-item mb-4"  style="border:1px solid #d7d7d7;padding: 5px;position:relative;">
                                <a href="{{ route('products.show' , $product_left_2->slug) }}"><img src="{{ \Storage::url($seller_left_2->image) }}" style="width:100%;object-fit: contain;display: block;border:1px solid #d7d7d7;" ></a>
                                @if($product_left_2)
                                <div class="d-flex justify-content-between px-4 product-detail-top">
                                    <h2 class="product-name mb-0"> 
                                        <a href="{{ route('products.show' , $product_left_2->slug) }}"> {{$product_left_2->getName()}}</a>
                                    </h2>
                                </div>
                                <div class="product-price d-flex justify-content-between px-4 ">
                                    {!! $product_left_2->real_price !!}
                                </div>
                                <div class="mt-2 mb-3 px-4">
                                    <a href="{{ route('products.show' , $product_left_2->slug) }}" class="btn btn-red-light btn-pp btn-pp-fixed text-white " style="font-size:14px;">{{ __('main.word.view_product') }}</a>
                                </div>
                               <div class="product-compare">
                                    @if ($product_left_2->is_option == 1)
                                        <a href="{{ route('products.show' , $product_left_2->slug ) }}" class="btn btn-danger mt-3 btn-pp-fixed" style="font-size:14px;" ><i class="fas fa-shopping-cart"></i> {{ __('main.word.view_option') }}</a>
                                    @else
                                        <button data-id="{{ $product_left_2->id }}" data-type="product" class="btn btn-danger mt-3 btn-cart btn-pp-fixed" style="font-size:14px;"><i class="fas fa-shopping-cart"></i> {{ __('main.word.buy_now') }}</button>
                                    @endif
                                    <div class="text-left chk-compare">
                                        <label> 
                                            <input type="checkbox" class="btn-chk-compare" name="" id="" data-id="{{ $product_left_2->id }}"> {{ __('main.word.compare_product') }}
                                        </label>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="product-relate-item"  style="border:1px solid #d7d7d7;padding: 5px;position:relative;">
                                <a href="{{ route('products.show' , $product_left_3->slug ) }}"><img src="{{ \Storage::url($seller_left_3->image) }}" style="width:100%;display: block;border:1px solid #d7d7d7;" ></a>
                                @if($product_left_3)
                                <div class="d-flex justify-content-between px-4 product-detail-top">
                                    <h2 class="product-name mb-0">
                                        <a href="{{ route('products.show' , $product_left_3->slug) }}"> {{$product_left_3->getName()}}</a>
                                    </h2>
                                </div>
                                <div class="product-price d-flex justify-content-between px-4">
                                    {!! $product_left_3->real_price !!}
                                </div>
                                <div class="mt-2 mb-3 px-4">
                                    <a href="{{ route('products.show' , $product_left_3->slug) }}" class="btn btn-red-light btn-pp text-white btn-pp-fixed" style="font-size:14px;">{{ __('main.word.view_product') }}</a>
                                </div>
                                <div class="product-compare">
                                    @if ($product_left_3->is_option == 1)
                                        <a href="{{ route('products.show' , $product_left_3->slug ) }}" class="btn btn-danger mt-3 btn-pp-fixed" style="font-size:14px;" ><i class="fas fa-shopping-cart"></i> {{ __('main.word.view_option') }}</a>
                                    @else
                                        <button data-id="{{ $product_left_3->id }}" data-type="product" class="btn btn-danger mt-3 btn-cart btn-pp-fixed" style="font-size:14px;"><i class="fas fa-shopping-cart"></i> {{ __('main.word.buy_now') }}</button>
                                    @endif
                                    <div class="text-left chk-compare">
                                        <label> 
                                            <input type="checkbox" class="btn-chk-compare" name="" id="" data-id="{{ $product_left_3->id }}"> {{ __('main.word.compare_product') }}
                                        </label>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6 px-0 d-flex justify-content-end">
                        <div class="col-6">
                            <div class="product-good-first border" style="height:100%">
                                <a href="{{ route('products.show' , $product_right_1->slug) }}"><img src="{{ \Storage::url($seller_right_1->image) }}" style="display: block;height:100%;width:100%;" ></a>
                                <div class="product-good-detail px-5 py-5" style="position:absolute;bottom:0;">
                                    @if($product_right_1)
                                    <h5 class="mb-0" style="padding:5px;background-color:white;"> {{$product_right_1->getName()}} </h5>
                               
                                    <div class="product-price d-flex justify-content-between" style="padding:5px;background-color:white;">
                                        {!! $product_right_1->real_price !!}
                                    </div>
                                    <div class="mt-2">
                                        <a href="javascript:void(0);" onclick="alert('Coming Soon'); return false;" class="btn btn-red-light btn-pp btn-pp-fixed text-white" style="font-size:14px;">{{ __('main.word.view_product') }}</a>
                                    </div>
                                    <div class="product-compare">
                                        <button class="btn btn-danger mx-xl-5 mt-3 btn-pp-fixed">{{ __('main.word.buy_now') }}</button>
                                        <div class="text-left chk-compare">
                                            <label> 
                                                <input type="checkbox" name="" id=""> {{ __('main.word.compare_product') }}
                                            </label>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-6">
                            <div class="product-relate-item mb-4"  style="border:1px solid #d7d7d7;padding: 5px;position:relative;">
                                <a href="{{ route('products.show' , $product_right_2->slug) }}"><img src="{{ \Storage::url($seller_right_2->image) }}" style="width:100%;object-fit: contain;display: block;border:1px solid #d7d7d7;"></a>
                                @if($product_right_2)
                                <div class="d-flex justify-content-between px-4 product-detail-top">
                                    <h2 class="product-name mb-0">     
                                        <a href="{{ route('products.show' , $product_right_2->slug) }}"> {{$product_right_2->getName()}} </a>
                                    </h2>
                                </div>
                                <div class="product-price d-flex justify-content-between px-4">
                                    {!! $product_right_2->real_price !!}
                                </div>
                                <div class="mt-2 mb-3 px-4">
                                    <a href="{{ route('products.show' , $product_right_2->slug) }}" class="btn btn-pp-fixed btn-red-light btn-pp text-white" style="font-size:14px;">{{ __('main.word.view_product') }}</a>
                                </div>
                                <div class="product-compare">
                                    @if ($product_right_2->is_option == 1)
                                        <a href="{{ route('products.show' , $product_right_2->slug ) }}" class="btn btn-danger mt-3 btn-pp-fixed" style="font-size:14px;" ><i class="fas fa-shopping-cart"></i> {{ __('main.word.view_option') }}</a>
                                    @else
                                        <button data-id="{{ $product_right_2->id }}" data-type="product" class="btn btn-danger mt-3 btn-cart btn-pp-fixed" style="font-size:14px;"><i class="fas fa-shopping-cart"></i> {{ __('main.word.buy_now') }}</button>
                                    @endif
                                    <div class="text-left chk-compare">
                                        <label> 
                                            <input type="checkbox" class="btn-chk-compare" name="" id="" data-id="{{ $product_right_2->id }}"> {{ __('main.word.compare_product') }}
                                        </label>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="product-relate-item"  style="border:1px solid #d7d7d7;padding: 5px;position:relative;">
                                <a href="{{ route('products.show' , $product_right_3->slug ) }}"><img src="{{ \Storage::url($seller_right_3->image) }}" style="width:100%;object-fit: contain;display: block;border:1px solid #d7d7d7;" ></a>
                                @if($product_right_3)
                                <div class="d-flex justify-content-between px-4 product-detail-top">
                                    <h2 class="product-name mb-0">
                                        <a href="{{ route('products.show' , $product_right_3->slug) }}"> {{$product_right_3->getName()}} </a>
                                    </h2>
                                </div>
                                <div class="product-price d-flex justify-content-between px-4">
                                    {!! $product_right_3->real_price !!}
                                </div>
                                <div class="mt-2 mb-3 px-4">
                                    <a href="{{ route('products.show' , $product_right_3->slug) }}" class="btn btn-red-light btn-pp btn-pp-fixed text-white" style="font-size:14px;">{{ __('main.word.view_product') }}</a>
                                </div>
                                <div class="product-compare">
                                    @if ($product_right_3->is_option == 1)
                                        <a href="{{ route('products.show' , $product_right_3->slug ) }}" class="btn btn-danger mt-3 btn-pp-fixed" style="font-size:14px;" ><i class="fas fa-shopping-cart"></i> {{ __('main.word.view_option') }}</a>
                                    @else
                                        <button data-id="{{ $product_right_3->id }}" data-type="product" class="btn btn-danger mt-3 btn-cart btn-pp-fixed" style="font-size:14px;"><i class="fas fa-shopping-cart"></i> {{ __('main.word.buy_now') }}</button>
                                    @endif
                                    <div class="text-left chk-compare">
                                        <label> 
                                            <input type="checkbox" class="btn-chk-compare" name="" id="" data-id="{{ $product_right_3->id }}"> {{ __('main.word.compare_product') }}
                                        </label>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-good-fifth mt-2 row">
                @foreach($products_seller as $product_seller)
                    <div class="col-2dot4 product-good-item-load mt-4">
                        <div class="product-relate-item mainHover" style="border:1px solid #d7d7d7;padding: 5px;position:relative;">
                            <div class="text-center">
                                <a href="{{ route('products.show' , $itemProduct->slug ) }}">
                                    <div class="product-image box_hover_img">
                                        {!! $product_seller->getPercentDiscount() !!}
                                    
                                        <img src="{{ \Storage::url($product_seller->image) }}" class="img-hover img-fluid">
                                    
                                        <span class="box_hover tha"></span>
                                    </div>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between px-2 product-detail-top">
                                <h2 class="product-name mb-0">
                                    <a href=""> {{ $product_seller->getName() }}</a>
                                </h2>
                            </div>
                            <div class="product-price d-flex justify-content-between px-2">
                                {!! $product_seller->real_price !!}
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <a href="{{ route('products.show' , $product_seller->slug ) }}" class="btn btn-red-light btn-pp btn-pp-fixed text-white" style="font-size:14px;">{{ __('main.word.view_product') }}</a>
                            </div>
                            <div class="product-compare">
                                @if ($product_seller->is_option == 1)
                                    <a href="{{ route('products.show' , $product_seller->slug ) }}" class="btn btn-danger mt-3 btn-pp-fixed" style="font-size:14px;"><i class="fas fa-shopping-cart"></i> {{ __('main.word.view_option') }}</a>
                                @else
                                    <button data-id="{{ $product_seller->id }}" data-type="product" class="btn btn-danger mt-3 btn-cart btn-pp-fixed" style="font-size:14px;"><i class="fas fa-shopping-cart"></i> {{ __('main.word.buy_now') }}</button>
                                @endif
                                <div class="text-left chk-compare">
                                    <label> 
                                        <input type="checkbox" class="btn-chk-compare" name="" data-id="{{ $product_seller->id }}"> {{ __('main.word.compare_product') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="product-relate-item"  style="border:1px solid #d7d7d7;padding: 5px;position:relative;">
                            <img data-src="holder.js/100px155?auto=yes&text=IMAGE" class="img-fluid img-hover" style="height: 155px;display: block;border:1px solid #d7d7d7;" >
                            <div class="d-flex justify-content-between px-2 product-detail-top">
                                <h2 class="product-name mb-0">
                                    <a href="">สายไฟ THW 1x1.5 mm2</a>
                                </h2>
                            </div>
                            <div class="product-price d-flex justify-content-between px-2">
                                <div>
                                    199.-
                                </div>
                                <div class="text-danger">
                                    150.-
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <a href="" class="btn btn-red-light btn-pp text-white px-5" style="font-size:14px;">{{ __('main.word.view_product') }}</a>
                            </div>
                            <div class="product-compare"> 
                                <button class="btn btn-danger mx-xl-5 mt-3">{{ __('main.word.buy_now') }}</button>
                                <div class="text-left chk-compare">
                                    <label> 
                                        <input type="checkbox" name="" id=""> {{ __('main.word.compare_product') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                @endforeach
                <div class="col-12 my-4 text-center">
                    <a class="btn-loadmore loadmore LoadGood" href="javaScript:void(0);"> {{ __('main.word.load_more') }} <i class="fas fa-plus"></i> </a>
                    <div class="lds-ellipsis loading" style="display:none;"><div></div><div></div><div></div><div></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid layer-pc">
            <h2 class="title-container">ค้นหาตามแบรนด์สินค้า</h2>
            <hr class="border-primary border-top-4 mt-0 mb-2 w-25 ml-auto  d-inline-block">
        </div>
    <div id="product-brands" class="container-fluid mb-4 layer-pc">
        <div class="brands-inner isDesktop">
            <ul class="brands-container">
                @foreach($brands as $brand)
                    <li class="brands-item"><a href="{{ route('brands.show' , $brand->slug) }}"><img src="{{ \Storage::url($brand->images) }}" style="display: block;border:1px solid #8f8f8f;width:150px;height:60px;" ></a></li>
                @endforeach
            </ul>
        </div>

       
        <div class="owl-carousel owl-theme isMobile" id="brands-container-owl">
            @foreach($brands as $brand)
                <div class="brands-item-mobile"><a href="{{ route('brands.show' , $brand->slug) }}"><img src="{{ \Storage::url($brand->images) }}" alt="{{ $brand->name }}"></a></div>
            @endforeach
        </div>
    </div>
    <div id="knowledge-home" class="container-fluid layer-pc">
        <h2 class="title-container">{{ __('main.word.knowledges') }}</h2>
        <hr class="border-purple border-top-4 mt-0 mb-2 w-25 ml-auto  d-inline-block">
        {{-- <div class="knowledge-container d-flex mt-3 mb-3 owl-carousel owl-theme">
            @for($i = 1; $i <=20; $i++)
                <div class="knowledge-item"><img data-src="holder.js/500x300/" class="img-fluid" alt=""></div>
            @endfor
        </div> --}}
    </div>
    <div class="container-fluid layer-pc">
        <div class="owl-carousel owl-theme knowledge-container" id="knowledge-owl">
            @foreach($articles as $article)
                <div class="knowledge-item"><a href="{{ route('knowledge.show', $article->slug) }}"><img src="{{ $article->image }}" class="img-fluid border" alt=""></a></div>
            @endforeach
        </div>
    </div>
@stop

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js" type="text/javascript"></script>
    <script defer src="{{ asset('js/jquery.flexslider.js')}}"></script>
    <script defer src="{{ asset('js/switchable.js')}}"></script>
    <script src="{{ asset('js/owl.carousel.min.js')}}" type="text/javascript"></script>
    <script>
    $(window).on('load', function() {
        $('.flexslider').flexslider({
            animation: "slide",
            start: function(slider){
                $('body').removeClass('loading');
            }
        });
    });

    $(document).ready( function (){
        $("@foreach($categories as $category)#carousel{{$category->id}} @if($loop->last) @else , @endif @endforeach").each(function() {
            $(this).owlCarousel({
                margin:10,
                autoWidth:true,
                items:4,
                nav:false,
                dots:false,
            });
        });
        var windowsize = $(window).width();
        if(windowsize >= 1198){

            cookieSice = document.cookie.replace(/(?:(?:^|.*;\s*)slice\s*\=\s*([^;]*).*$)|^.*$/, "$1");
            $(".productCateLoad").hide();
            if(cookieSice != ''){
                $(".productCateLoad").slice(0, cookieSice).show();
            }else{
                $(".productCateLoad").slice(0, 5).show();
            }
           
           
            if ($(".productCateLoad:hidden").length != 0) {
                $("#LoadCate").show();
            }
            $("#LoadCate").on('click', function (e) 
            {
                e.preventDefault();
                $(this).hide();
                $('.loading').show();
               
                
                setTimeout(function () { 
                    $("#LoadCate").show();
                    $('.loading').hide();
                    $(this).show();
                    $(".productCateLoad:hidden").slice(0, 1).fadeIn(1000);
                    var aag = $(".productCateLoad:visible").length;
                    var now = new Date();
                    var time = now.getTime();
                    var expireTime = time + 1000;
                    
                    now.setTime(expireTime);
                    document.cookie = 'slice='+aag+';expires='+now+'; path=/';
                    if ($(".productCateLoad:hidden").length == 0) {
                        $("#LoadCate").fadeOut('slow');
                    }
                    
                }, 300);
                
            });



            cookieSice1 = document.cookie.replace(/(?:(?:^|.*;\s*)slice1\s*\=\s*([^;]*).*$)|^.*$/, "$1");
            $(".product-good-item-load").hide();

            if(cookieSice1 != ''){
                $(".product-good-item-load").slice(0, cookieSice1).show();
            }else{
                $(".product-good-item-load").slice(0, 5).show();
            }


            //console.log($(".product-good-item-load:hidden").length );
            if ($(".product-good-item-load:hidden").length >= cookieSice1) {
                $(".LoadGood").hide();
            }else{
                $(".LoadGood").show();
            }
            $(".LoadGood").on('click', function (e) 
            {
                e.preventDefault();
                $(this).hide();
                $('.loading').show();
                setTimeout(function () { 
                    $('.LoadGood').show();
                    $('.loading').hide();
                    $(this).show();
                    $(".product-good-item-load:hidden").slice(0, 5).slideDown();
                    var aag1 = $(".product-good-item-load:visible").length;
                    var now = new Date();
                    var time = now.getTime();
                    var expireTime = time + 1000;
                    
                    now.setTime(expireTime);
                    document.cookie = 'slice1='+aag1+';expires='+now+'; path=/';
                    if ($(".product-good-item-load:hidden").length == 0) {
                            $(".LoadGood").fadeOut('slow');
                    }
                }, 300);
            });

        }else if(windowsize < 1198){

            cookieSice = document.cookie.replace(/(?:(?:^|.*;\s*)slice\s*\=\s*([^;]*).*$)|^.*$/, "$1");
            $(".productCateLoad-M").hide();
            if(cookieSice != ''){
                $(".productCateLoad-M").slice(0, cookieSice).show();
            }else{
                $(".productCateLoad-M").slice(0, 5).show();
            }
                      
           
            if ($(".productCateLoad-M:hidden").length != 0) {
                $("#LoadCate").show();
            }
            $("#LoadCate").on('click', function (e) 
            {
                e.preventDefault();
                $(this).hide();
                $('.loading').show();
                setTimeout(function () { 
                    $("#LoadCate").show();
                    $('.loading').hide();
                    $(this).show();
                    $(".productCateLoad-M:hidden").slice(0, 1).slideDown();
                    var aag = $(".productCateLoad-M:visible").length;
                    var now = new Date();
                    var time = now.getTime();
                    var expireTime = time + 1000;
                    
                    now.setTime(expireTime);
                    document.cookie = 'slice='+aag+';expires='+now+'; path=/';
                    if ($(".productCateLoad-M:hidden").length == 0) {
                            $("#LoadCate").fadeOut('slow');
                    }
                }, 300);
            });


          

            cookieSice1 = document.cookie.replace(/(?:(?:^|.*;\s*)slice1\s*\=\s*([^;]*).*$)|^.*$/, "$1");
            $(".product-good-mo-load").hide();
            if(cookieSice1 != ''){
                $(".product-good-mo-load").slice(0, cookieSice1).show();
            }else{
                $(".product-good-mo-load").slice(0, 6).show();
            }


            if ($(".product-good-mo-load:hidden").length >= cookieSice1) {
                $(".LoadGood").hide();
            }else{
                $(".LoadGood").show();
            }
            $("#LoadGood").on('click', function (e) 
            {
                e.preventDefault();
                $(this).hide();
                $('.loading').show();
                setTimeout(function () { 
                    $('#LoadGood').show();
                    $('.loading').hide();
                    $(this).show();
                    $(".product-good-mo-load:hidden").slice(0, 2).slideDown();
                    var aag1 = $(".product-good-mo-load:visible").length;
                    var now = new Date();
                    var time = now.getTime();
                    var expireTime = time + 1000;
                    
                    now.setTime(expireTime);
                    document.cookie = 'slice1='+aag1+';expires='+now+'; path=/';

                    if ($(".product-good-mo-load:hidden").length == 0) {
                            $("#LoadGood").fadeOut('slow');
                    }
                }, 300);
            });
        }
        // Custom Navigation Events
        $(".next").click(function(){
            $(this).closest('.product-cate').find('.owl-carousel').trigger('next.owl.carousel');
        })
        $(".prev").click(function(){
            $(this).closest('.product-cate').find('.owl-carousel').trigger('prev.owl.carousel');
        })
    });
    
   $('#brands-container-owl').owlCarousel({
        margin:10,
        autoWidth:true,
        dots:false,
        nav: true,
        navText : ['<i class="fas fa-arrow-left" aria-hidden="true"></i>','<i class="fas fa-arrow-right" aria-hidden="true"></i>']
    });
    $('#knowledge-owl').owlCarousel({
        margin:10,
        autoWidth:true,
        items:4,
        dots:false,
        nav: true,
        navText : ['<i class="fas fa-arrow-left" aria-hidden="true"></i>','<i class="fas fa-arrow-right" aria-hidden="true"></i>']
    });


$('.loadmore').click(function(){
    
});
</script>
@endpush