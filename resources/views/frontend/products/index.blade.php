@extends('layouts.frontend.home')

@section('title' , 'สินค้า | PP ELECTIRC ')
@section('keywords' , 'สินค้า,'.getSetting('site_keywords'))

@section('custom-css')
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:type" content="product">
    <meta property="og:title" content="สินค้า | PP ELECTIRC">
    <meta property="og:description" content="{{ 'สินค้า '.getSetting('site_description')}}">
    <meta property="og:image" content="{{ \Storage::url(getSetting('site_logo')) }}">
    
@stop

@section('content')

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12">{{ Breadcrumbs::render('product') }}</div>
        </div>
        <div class="row">
            
            <div class="col-lg-3">
                <form action="" method="get">
                <input type="hidden" name="q" value="{{ request()->get('q') }}">
                <h2>{{ __('main.word.search') }}</h2>
                <div class="nav_side_filter">
                    <div class="cd-filter-block">
					    <h4>{{ __('main.word.for-search-categories') }}<hr class="border-primary border-bottom my-0"></h4>

                            <ul class="cd-filter-content cd-filters list">
                                @foreach($menudata as $menu)
                                    <li>
                                        <input class="filter" data-filter=".check{{ $menu->id }}" name="category[]" value="{{ $menu->slug }}" type="checkbox" id="checkbox{{ $menu->id }}" @if(request()->category) {{ (in_array($menu->slug, request()->category)) ? "checked" : '' }} @endif>
                                        <label class="checkbox-label"  for="checkbox{{ $menu->id }}">{{ $menu->name }}</label>
                                    </li>
                                @endforeach
                            </ul> <!-- cd-filter-content -->
                        </div> <!-- cd-filter-block -->
                    {{-- <div class="cd-filter-block">
                        <h4>ค้นหาตามราคา <hr class="border-primary border-bottom my-0"></h4>

                        <div class="cd-filter-content cd-filters" style="padding-left:40px;">
                            <input type="text" name="price-from" value="" placeholder="ตั้งแต่ราคา" style="padding:0.3em"> ถึง <input type="text" placeholder="ถึงราคา" name="price-to" value="" style="padding:0.3em">
                        </div>
                    </div> --}}
                    <div class="cd-filter-block">
                        <h4>{{ __('main.word.for-search-brands') }} <hr class="border-danger border-bottom my-0"></h4>
                        <ul class="cd-filter-content cd-filters list">
                            @foreach($brands as $brand)
                                <li>
                                    <input class="filter" data-filter=".check{{ $brand->id }}" name="brands[]" value="{{ $brand->slug }}" type="checkbox" id="checkbox{{ $brand->slug }}" @if(request()->brands) {{ (in_array($brand->slug, request()->brands)) ? "checked" : '' }} @endif>
                                    <label class="checkbox-label"  for="checkbox{{ $brand->slug }}">{{ $brand->name }}</label>
                                </li>
                            @endforeach
                        </ul> <!-- cd-filter-content -->
                    </div>
                    <div class="cd-action text-center mb-3">
                        <button type="submit" class="btn btn-primary"> {{ __('main.word.search') }} </button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary" > {{ __('main.word.reset') }} </a>
                    </div>

                </div>
                </form>
            </div>
           
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-9 col-md-6"> 
                        <h2 class="mb-0"> @if(app('request')->input('q') != '') {{ $products->count() }} รายการ จากการค้นหาคำว่า "{{ app('request')->input('q') }}"  @else {{ __('main.word.view_all_product') }} @endif </h2>
                    </div>
                    <div class="col-3 col-md-6 d-flex align-items-center justify-content-end">
                        <ul class="nav nav-pills align-text-bottom show" style="font-size:16px;">
                            <li class="nav-item dropdown " aria-expanded="true">
                            <a class=" dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">เรียงตาม</a>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-92px, 25px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a class="dropdown-item" href="{!! route('products.index',['q'=> request()->get('q') , 'brands'=> request()->get('brands') , 'category'=> request()->get('category') , 'sort'=>'price_asc']) !!}">ราคา ต่ำสุด-สูงสุด</a>
                                    <a class="dropdown-item" href="{!! route('products.index',['q'=> request()->get('q') , 'brands'=> request()->get('brands') , 'category'=> request()->get('category') , 'sort'=>'price_desc']) !!}">ราคา สูงสุด-ต่ำสุด</a>
                                    <a class="dropdown-item" href="{!! route('products.index',['q'=> request()->get('q') , 'brands'=> request()->get('brands') , 'category'=> request()->get('category') , 'sort'=>'name_asc']) !!}">ชื่อสินค้าจาก A - Z</a>
                                    <a class="dropdown-item" href="{!! route('products.index',['q'=> request()->get('q') ,'brands'=> request()->get('brands') , 'category'=> request()->get('category') , 'sort'=>'name_desc']) !!}">ชื่อสินค้าจาก Z - A</a>
                                    <a class="dropdown-item" href="{!! route('products.index',['q'=> request()->get('q') ,'brands'=> request()->get('brands') , 'category'=> request()->get('category') , 'sort'=>'newest']) !!}">สินค้าใหม่ - เก่า</a>
                                    <a class="dropdown-item" href="{!! route('products.index',['q'=> request()->get('q') ,'brands'=> request()->get('brands') , 'category'=> request()->get('category') , 'sort'=>'oldest']) !!}">สินค้าเก่า - ใหม่</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <hr class="border-warning border-bottom mb-2 mt-0">
                <div class="row mb-3 ">
                    @forelse($products as $product)
                        <div class="col-md-4 col-lg-3 col-6 mb-3 product-item" >
                            <div class="product-relate-item mainHover"  style="border:1px solid #00000038;padding: 5px;position: relative;">
                                <a href="{{ route('products.show' , $itemProduct->slug ) }}">
                                    <div class=" box_hover_img">
                                        {!! $product->getPercentDiscount() !!}
                                
                                        <img src="{{ \Storage::url(imageThumbnail('thumbnail',$product->image)) }}" class="img-hover" style="display: block;width: 100%;height: auto;" >
                                        
                                        <span class="box_hover tha"></span>
                                    </div>
                                </a>
                                <div class="d-flex justify-content-between px-2 product-detail-top">
                                    <h2 class="product-name mb-0">
                                        <a href="{{ route('products.show' , $product->slug ) }}">{{ $product->name }}</a>
                                    </h2>
                                    <h2 class="product-brand mb-0"><a href="{{ isset($product->brands->slug) ? route('brands.show' , $product->brands->slug): '' }}">{{ isset($product->brands->name) ? $product->brands->name :'No Brands' }}</a></h2>
                                </div>
                                <div class="product-price d-flex justify-content-between mt-2 px-2">
                                    {!! $product->getRealPriceAttribute() !!}
                                </div>
                                <div class="d-flex justify-content-center mt-2">
                                    <a href="{{ route('products.show' , $product->slug) }}" class="btn btn-warning py-1 text-white btn-pp-fixed" style="font-size:14px;">{{ __('main.word.view_product') }}</a>
                                </div>
                                <div class="product-compare pb-2 " style="padding:0 15px;">
                                    @if ($product->is_option == 1)
                                        <button onclick="location.href='{{ route('products.show' , $product->slug ) }}'" class="btn btn-danger mt-3 btn-pp-fixed" style="font-size:14px;"><i class="fas fa-shopping-cart"></i> {{ __('main.word.view_option') }}</button>
                                    @else
                                        <button data-id="{{ $product->id }}" data-type="product" class="btn btn-danger mt-3 btn-cart btn-pp-fixed" style="font-size:14px;"><i class="fas fa-shopping-cart"></i> {{ __('main.word.buy_now') }}</button>
                                    @endif
                                    <div class="text-left chk-compare">
                                        <label> 
                                            <input type="checkbox" class="btn-chk-compare" data-id="{{ $product->id }}" name="" id=""> {{ __('main.word.compare_product') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                     <div class="col-12 my-4 text-center">
                        <a class="btn-loadmore loadmore LoadGood" style="display:none;" href="javaScript:void(0);"> {{ __('main.word.load_more') }} <i class="fas fa-plus"></i> </a>
                        <div class="lds-ellipsis loading" style="display:none;"><div></div><div></div><div></div><div></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
@stop

@push('scripts')
    <script>
        $(document).ready( function() {
        
            $(".product-item").hide();
            $(".product-item").slice(0, 24).show();
            console.log($(".product-item:hidden").length);
            if ($(".product-item:hidden").length != 0) {
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
                    $(".product-item:hidden").slice(0, 4).slideDown();
                    if ($(".product-item:hidden").length == 0) {
                            $(".LoadGood").fadeOut('slow');
                    }
                }, 300);
            });
        });
    </script>
@endpush