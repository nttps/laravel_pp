@extends('layouts.frontend.home')

@section('title' , ($category->meta_title) ? $category->meta_title .' | ' . getSetting('site_title') : $category->name .' | ' . getSetting('site_title'))
@section('keywords' , $category->meta_keyword)
@section('description' , $category->meta_description)

@section('custom-css')
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:type" content="product">
    <meta property="og:title" content="{{ ($category->meta_title) ? $category->meta_title .' | ' . getSetting('site_title') : $category->name .' | ' . getSetting('site_title') }}">
    <meta property="og:description" content="{{ $category->meta_description }}">
    <meta property="og:image" content="{{ \Storage::url($category->image) }}">
@stop

@section('content')
    <div class="brand-header mt-5">
        @if(empty($category->image))
            <img src="{{ asset('images/slides/slide1.png') }}" style="width:100%;" class="img-fluid" alt="">
        @else 
            <img src="{{ \Storage::url($category->image) }}" style="width:100%;" class="img-fluid" alt="">
        @endif
        
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <ul class="pp-breadcrumb">
                    <li class="pp-breadcrumb-item"><a href="{{ route('home')}}"> Home / </a>  </li>
                    @foreach ($category->parents->sortBy('parent_id') as $breadcrumb)
                        
                        <li class="pp-breadcrumb-item"><a href="{{ route('categories.show' , $breadcrumb->getUrlSlugParent()) }}"> {{ $breadcrumb->name }} / </a>  </li>
                    @endforeach
                    <li class="pp-breadcrumb-item active"> {{ $category->name }}</li>
                </ul>
            </div>
            <div class="col-9 col-md-6"> 
                <h2 class="mb-0">หมวด {{ $category->name }} </h2>
            </div>
            <div class="col-3 col-md-6 d-flex align-items-center justify-content-end">
                <ul class="nav nav-pills align-text-bottom show" style="font-size:16px;">
                    <li class="nav-item dropdown " aria-expanded="true">
                    <a class=" dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">เรียงตาม</a>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-92px, 25px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="dropdown-item" href="?sort=price_asc ">ราคา ต่ำสุด-สูงสุด</a>
                            <a class="dropdown-item" href="?sort=price_desc ">ราคา สูงสุด-ต่ำสุด</a>
                            <a class="dropdown-item" href="?sort=name_asc ">ชื่อสินค้าจาก A - Z</a>
                            <a class="dropdown-item" href="?sort=name_desc ">ชื่อสินค้าจาก Z - A</a>
                            <a class="dropdown-item" href="?sort=newest ">สินค้าใหม่ - เก่า</a>
                            <a class="dropdown-item" href="?sort=oldest ">สินค้าเก่า - ใหม่</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-12">
                <hr class="border-warning border-bottom mb-2 mt-0">
            </div>
            
        </div>
        <div class="row mb-3">
            @forelse($products as $product)
            <div class="col-md-3 col-6 mb-3 item-product">
                    <div class="product-relate-item mainHover"  style="border:1px solid #00000038;padding: 5px;position: relative;">
                        <a href="{{ route('products.show' , $product->slug ) }}">
                            <div class=" box_hover_img">
                                {!! $product->getPercentDiscount() !!}
                                
                                <img src="{{ \Storage::url($product->image) }}" class="img-hover" style="display: block;width: 100%;height: auto;" >
                            
                                <span class="box_hover tha"></span>
                            </div>
                        </a>
                        <div class="d-flex justify-content-between px-2 product-detail-top">
                            <h2 class="product-name mb-0">
                                <a href="{{ route('products.show' , $product->slug ) }}">{{ $product->getName() }}</a>
                            </h2>
                            @if(!empty($product->brands->slug))
                                <h2 class="product-brand mb-0"><a href="{{ route('brands.show' , $product->brands->slug) }}">{{ $product->brands->name }}</a></h2>
                            @endif
                        </div>
                        <div class="product-price mt-2 d-flex justify-content-between px-2">
                                {!! $product->getRealPriceAttribute() !!}
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <a href="{{ route('products.show' , $product->slug) }}" class="btn btn-warning py-1 text-white btn-pp-fixed" style="font-size:14px;">{{ __('main.word.view_product') }}</a>
                        </div>
                        <div class="product-compare pb-2" style="padding:0 15px;">
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
                <div class="col-md-12 mt-3 mb-3 text-center">
                    <h3 class="text-danger">ไม่มีสินค้าในหมวดหมู่นี้</h3>
                </div>
            @endforelse
            <div class="col-12 my-4 text-center">
                <a class="btn-loadmore loadmore LoadGood" style="display:none;" href="javaScript:void(0);"> โหลดเพิ่มเติม <i class="fas fa-plus"></i> </a>
                <div class="lds-ellipsis loading" style="display:none;"><div></div><div></div><div></div><div></div></div>
            </div>
        </div>
    </div>
  
@stop

@push('scripts')
    <script>
        $(document).ready( function() {
        
            $(".product-relate-item").hide();
            $(".product-relate-item").slice(0, 24).show();
            console.log($(".product-relate-item:hidden").length);
            if ($(".product-relate-item:hidden").length != 0) {
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
                    $(".product-relate-item:hidden").slice(0, 4).slideDown();
                    if ($(".product-relate-item:hidden").length == 0) {
                            $(".LoadGood").fadeOut('slow');
                    }
                }, 300);
            });
        });
    </script>
@endpush