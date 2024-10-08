@extends('layouts.frontend.home')

@section('title' , 'HOME')

@section('custom-css')
    <link rel="stylesheet" href="{{ mix('css/home.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/flexslider.css')}}" type="text/css" media="screen">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css')}}" type="text/css" media="screen">
@stop

@section('content')
    <div id="header-slide" class="container-fluid ">
        <div class="flexslider">
            <ul class="slides">
                <li>
                    <img src="{{ asset('images/slides/slide1.png') }}" class="img-fluid"/>
                </li>
                <li>
                    <img src="{{ asset('images/slides/slide1.png') }}" class="img-fluid"/>
                </li>
                <li>
                    <img src="{{ asset('images/slides/slide1.png') }}" class="img-fluid"/>
                </li>
                <li>
                    <img src="{{ asset('images/slides/slide1.png') }}" class="img-fluid"/>
                </li>
            </ul>
        </div>
    </div>
    <div id="promotion-home" class=" mb-4">
        <div class="promotion-content">
            <ul class="promotion-box">
                <li class="">
                    <a href=""><img src="{{ asset('images/banner/banner-1.png') }}" class="img-fluid" alt=""></a>
                </li>
                <li class="">
                    <a href=""><img src="{{ asset('images/banner/banner-2.png') }}" class="img-fluid" alt=""></a>
                </li>
                <li class="">
                    <a href=""><img src="{{ asset('images/banner/banner-3.png') }}" class="img-fluid" alt=""></a> 
                </li>
            </ul>
        </div>
    </div>
    <div style="clear"></div>
    <div class="container-fluid isDesktop">
        <div class="product_wrapper_container">
            <div class="product_wrapper cate_brand">
                <h2 class="title-container border-purple d-inline-block border-bottom-5 mt-5">ตู้เบรคเกอร์/ตู้ไฟ</h2>
                <ul class="sub-cate-link mt-3">
                    <li class="sub-cate-item"><a href="">ABB</a></li>
                    <li class="sub-cate-item"><a href="">HACO</a></li>
                    <li class="sub-cate-item"><a href="">HITACHI</a></li>
                    <li class="sub-cate-item"><a href="">LUMOS</a></li>
                    <li class="sub-cate-item"><a href="">L&E</a></li>
                    <li class="sub-cate-item"><a href="">MITSUBISHI ELECTRIC</a></li>
                    <li class="sub-cate-item"><a href="">PANASONIC</a></li>
                    <li class="sub-cate-item"><a href="">PHILLIP</a></li>
                    <li class="sub-cate-item"><a href="">etc.</a></li>
                </ul>
            </div>
            <div class="product_wrapper main_product">
                <div class="image_main">
                    <img src="/images/bg/dummy-product-image.png" class="img-fluid">
                    <div class="btn-to-product-main" style="display:block;">
                        <button class="btn btn-pp btn-warning text-white mt-3" > ดูสินค้าทั้งหมด </button>
                    </div>
                </div>
            </div>
            <div class="product_wrapper cate_product">
                <div class="products">
                    @for($i=1;$i<=6;$i++)
                    <!-- It's likely you'll need to link the card somewhere. You could add a button in the info, link the titles, or even wrap the entire card in an <a href="..."> -->
                    <div class="product-card mainHover">
                        <div class="product-image box_hover_img">
                            <img src="{{ asset('images/dummy-product-seller2.png') }}" class="img-hover">
                            <span class="box_hover tha"></span>
                        </div>
                        <div class="product-info">
                            <h2 class="product-name mb-0">
                                <a href="">สายไฟ THW 1x1.5 mm2</a>
                            </h2>
                            <h3 class="product-desc mb-0">ใช้ฉนวนและทองแดงคุณภาพดี ทองแดงเต็มสายยาว เต็มเมตร</h3>
                            <div class="prodict-price">
                                <div class="regular_price">160.-</div>
                                <div class="sale_price text-danger">150.-</div>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                        <div class="product-btn-cart">
                            <a href="{{ route('products.show') }}" class="btn btn-warning btn-pp text-white" style="font-size:14px;">ดูรายละเอียด</a>
                        </div>
                        <div class="product-compare">
                            <button class="btn btn-danger mx-xl-5 mt-3">ซื้อทันที</button>
                            <div class="text-left chk-compare">
                                <label> 
                                    <input type="checkbox" class="btn-chk-compare" name="" id=""> เปรียบเทียบสินค้า
                                </label>
                            </div>
                        </div>
                    </div>
                    @endfor
                    <!-- more products -->
                  </div>
            </div>
        </div>
        <div class="col-12 mb-2 text-center">
            <a class="btn-loadmore loadmore" id="LoadCate" href="javaScript:void(0);" style="display:none;"> โหลดเพิ่มเติม <i class="fas fa-plus"></i> </a>
            <div class="lds-ellipsis loading" style="display:none;"><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
    <div class="container-fluid" style="padding-left: 30px;padding-right: 30px;">
        <h2 class="title-container d-inline-block" >สินค้าขายดี</h2>
        <hr class="border-orange-light border-bottom-5 mt-0 mb-2 w-25 ml-auto  d-inline-block">
    </div>
    <div id="product-good-seller" class="container-fluid mb-3 isMobile">
        <div class="row">
            @for($i = 1; $i <=12; $i++)
                <div class="col-6 col-lg-3 col-md-4 mb-3 product-good-mo-load">
                    <div class="product-relate-item"  style="border:1px solid #999999;padding: 5px;">
                        <img src="{{ asset('images/dummy-product-seller2.png') }}" class="img-fluid img-hover" style="display: block;border:1px solid #999999;" >
                        <div class="d-flex justify-content-between px-4 product-detail-top">
                            <h2 class="product-name mb-0">
                                <a href="{{ route('products.show') }}">สายไฟ THW 1x1.5 mm2</a>
                            </h2>
                        </div>
                        <div class="product-price d-flex justify-content-between px-4">
                            <div>
                                199.-
                            </div>
                            <div class="text-danger">
                                150.-
                            </div>
                        </div>
                        <div class="mt-2 mb-3 text-center">
                            <a href="{{ route('products.show') }}" class="btn btn-red-light text-white" style="font-size:14px;">ดูรายละเอียด</a>
                        </div>
                        <div class="product-compare">
                            <button class="btn btn-danger mx-xl-5 mt-3">ซื้อทันที</button>
                            <div class="text-left chk-compare">
                                <label> 
                                    <input type="checkbox" name="" id=""> เปรียบเทียบสินค้า
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
            <div class="col-12 mt-4 mb-2 text-center">
                <a class="btn-loadmore loadmore" id="LoadGood" href="javaScript:void(0);"> โหลดเพิ่มเติม <i class="fas fa-plus"></i> </a>
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
                            <div class="product-good-first border" style="height:100%">
                                <img src="{{ asset('images/dummy-product-seller.png') }}" style="height:100%;width:100%;display: block;border:1px solid #8f8f8f;" ></a>
                                <div class="product-good-detail px-5 py-5" style="position:absolute;bottom:0;">
                                    <h5 class="mb-0">สวิทซ์ไฟฟ้า</h5>
                                    <div class="product-price pl-0">
                                        199.-
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{ route('products.show') }}" class="btn btn-red-light btn-pp text-white px-5" style="font-size:14px;">ดูรายละเอียด</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-6 ">
                            <div class="product-relate-item mb-3"  style="border:1px solid #999999;padding: 5px;">
                                <img src="{{ asset('images/dummy-product-seller2.png') }}" style="width:100%;object-fit: contain;display: block;border:1px solid #999999;" >
                                <div class="d-flex justify-content-between px-4 product-detail-top">
                                    <h2 class="product-name mb-0">
                                        <a href="{{ route('products.show') }}">สายไฟ THW 1x1.5 mm2</a>
                                    </h2>
                                </div>
                                <div class="product-price d-flex justify-content-between px-4 ">
                                    <div>
                                        199.-
                                    </div>
                                    <div class="text-danger">
                                        150.-
                                    </div>
                                </div>
                                <div class="mt-2 mb-3 px-4">
                                    <a href="{{ route('products.show') }}" class="btn btn-red-light btn-pp text-white px-5" style="font-size:14px;">ดูรายละเอียด</a>
                                </div>
                                <div class="product-compare">
                                    <button class="btn btn-danger mx-xl-5 mt-3">ซื้อทันที</button>
                                    <div class="text-left chk-compare">
                                        <label> 
                                            <input type="checkbox" name="" id=""> เปรียบเทียบสินค้า
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="product-relate-item"  style="border:1px solid #999999;padding: 5px;">
                                <img src="{{ asset('images/dummy-product-seller2.png') }}" style="width:100%;display: block;border:1px solid #999999;" >
                                <div class="d-flex justify-content-between px-4 product-detail-top">
                                    <h2 class="product-name mb-0">
                                        <a href="{{ route('products.show') }}">สายไฟ THW 1x1.5 mm2</a>
                                    </h2>
                                </div>
                                <div class="product-price d-flex justify-content-between px-4">
                                    <div>
                                        199.-
                                    </div>
                                    <div class="text-danger">
                                        150.-
                                    </div>
                                </div>
                                <div class="mt-2 mb-3 px-4">
                                    <a href="{{ route('products.show') }}" class="btn btn-red-light btn-pp text-white px-5" style="font-size:14px;">ดูรายละเอียด</a>
                                </div>
                                <div class="product-compare">
                                    <button class="btn btn-danger mx-xl-5 mt-3">ซื้อทันที</button>
                                    <div class="text-left chk-compare">
                                        <label> 
                                            <input type="checkbox" name="" id=""> เปรียบเทียบสินค้า
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 px-0 d-flex justify-content-end">
                        <div class="col-6">
                            <div class="product-good-first border" style="height:100%">
                                <img src="{{ asset('images/dummy-product-seller2.png') }}" style="display: block;height:100%;width:100%;" ></a>
                                <div class="product-good-detail px-5 py-5" style="position:absolute;bottom:0;">
                                    <h5 class="mb-0">สวิทซ์ไฟฟ้า</h5>
                                    <div class="product-price pl-0">
                                        199.-
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{ route('products.show') }}" class="btn btn-red-light btn-pp text-white px-5" style="font-size:14px;">ดูรายละเอียด</a>
                                    </div>
                                    <div class="product-compare">
                                        <button class="btn btn-danger mx-xl-5 mt-3">ซื้อทันที</button>
                                        <div class="text-left chk-compare">
                                            <label> 
                                                <input type="checkbox" name="" id=""> เปรียบเทียบสินค้า
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-6">
                            <div class="product-relate-item mb-4"  style="border:1px solid #999999;padding: 5px;">
                                <img src="{{ asset('images/dummy-product-seller2.png') }}" style="width:100%;object-fit: contain;display: block;border:1px solid #999999;">
                                <div class="d-flex justify-content-between px-4 product-detail-top">
                                    <h2 class="product-name mb-0">
                                        <a href="{{ route('products.show') }}">สายไฟ THW 1x1.5 mm2</a>
                                    </h2>
                                </div>
                                <div class="product-price d-flex justify-content-between px-4">
                                    <div>
                                        199.-
                                    </div>
                                    <div class="text-danger">
                                        150.-
                                    </div>
                                </div>
                                <div class="mt-2 mb-3 px-4">
                                    <a href="{{ route('products.show') }}" class="btn btn-red-light btn-pp text-white px-5" style="font-size:14px;">ดูรายละเอียด</a>
                                </div>
                                <div class="product-compare">
                                    <button class="btn btn-danger mx-xl-5 mt-3">ซื้อทันที</button>
                                    <div class="text-left chk-compare">
                                        <label> 
                                            <input type="checkbox" name="" id=""> เปรียบเทียบสินค้า
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="product-relate-item"  style="border:1px solid #999999;padding: 5px;">
                                <img src="{{ asset('images/dummy-product-seller2.png') }}" style="width:100%;object-fit: contain;display: block;border:1px solid #999999;" >
                                <div class="d-flex justify-content-between px-4 product-detail-top">
                                    <h2 class="product-name mb-0">
                                        <a href="{{ route('products.show') }}">สายไฟ THW 1x1.5 mm2</a>
                                    </h2>
                                </div>
                                <div class="product-price d-flex justify-content-between px-4">
                                    <div>
                                        199.-
                                    </div>
                                    <div class="text-danger">
                                        150.-
                                    </div>
                                </div>
                                <div class="mt-2 mb-3 px-4">
                                    <a href="{{ route('products.show') }}" class="btn btn-red-light btn-pp text-white px-5" style="font-size:14px;">ดูรายละเอียด</a>
                                </div>
                                <div class="product-compare">
                                    <button class="btn btn-danger mx-xl-5 mt-3">ซื้อทันที</button>
                                    <div class="text-left chk-compare">
                                        <label> 
                                            <input type="checkbox" name="" id=""> เปรียบเทียบสินค้า
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-good-fifth mt-2 row">
                @for($i = 1; $i <=15; $i++)
                    <div class="col-2dot4 product-good-item-load mt-4">
                        <div class="product-relate-item"  style="border:1px solid #999999;padding: 5px;">
                            <img data-src="holder.js/100px155?auto=yes&text=IMAGE" class="img-fluid img-hover" style="height: 155px;display: block;border:1px solid #999999;" >
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
                                <a href="" class="btn btn-red-light btn-pp text-white px-5" style="font-size:14px;">ดูรายละเอียด</a>
                            </div>
                            <div class="product-compare"> 
                                <button class="btn btn-danger mx-xl-5 mt-3">ซื้อทันที</button>
                                <div class="text-left chk-compare">
                                    <label> 
                                        <input type="checkbox" name="" id=""> เปรียบเทียบสินค้า
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
                <div class="col-12 my-4 text-center">
                    <a class="btn-loadmore loadmore LoadGood" href="javaScript:void(0);"> โหลดเพิ่มเติม <i class="fas fa-plus"></i> </a>
                    <div class="lds-ellipsis loading" style="display:none;"><div></div><div></div><div></div><div></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="padding-left: 30px;padding-right: 30px;">
            <h2 class="title-container">ค้นหาตามแบรนด์สินค้า</h2>
            <hr class="border-primary border-bottom-5 mt-0 mb-2 w-25 ml-auto  d-inline-block">
        </div>
    <div id="product-brands" class="container-fluid mb-4">
        <div class="brands-inner isDesktop">
            <ul class="brands-container">
                @for($i = 1; $i <=18; $i++)
                    <li class="brands-item"><a href="{{ route('brands.show')}}"><img data-src="holder.js/150x60/" class="img-fluid" style="display: block;border:1px solid #8f8f8f;" ></a></li>
                @endfor
            </ul>
        </div>
        <div class="owl-carousel owl-theme isMobile" id="brands-container-owl">
            @for($i = 1; $i <=20; $i++)
                <div class="brands-item-mobile"><a href=""><img data-src="holder.js/455x300?auto=yes&text=IMAGE" alt=""></a></div>
            @endfor
        </div>
    </div>
    <div id="knowledge-home" class="container-fluid" style="padding-left: 30px;padding-right: 30px;">
        <h2 class="title-container">เกร็ดความรู้</h2>
        <hr class="border-purple border-bottom-5 mt-0 mb-2 w-25 ml-auto  d-inline-block">
        {{-- <div class="knowledge-container d-flex mt-3 mb-3 owl-carousel owl-theme">
            @for($i = 1; $i <=20; $i++)
                <div class="knowledge-item"><img data-src="holder.js/500x300/" class="img-fluid" alt=""></div>
            @endfor
        </div> --}}
    </div>
    <div class="container-fluid">
        <div class="owl-carousel owl-theme knowledge-container" id="knowledge-owl">
            @for($i = 1; $i <=20; $i++)
                <div class="knowledge-item"><a href=""><img data-src="holder.js/455x300?auto=yes&text=IMAGE" class="img-fluid" alt=""></a></div>
            @endfor
        </div>
    </div>
@stop

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js" type="text/javascript"></script>
    <script defer src="{{ asset('js/jquery.flexslider.js')}}"></script>
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
        $("@for($a = 1; $a <=7; $a++)#carousel{{$a}} @if($a != 7) , @else @endif @endfor").each(function() {
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
            $(".productCateLoad").hide();
            $(".productCateLoad").slice(0, 6).show();
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
                    $(".productCateLoad:hidden").slice(0, 1).slideDown();
                    if ($(".productCateLoad:hidden").length == 0) {
                            $("#LoadCate").fadeOut('slow');
                    }
                }, 300);
            });

            $(".product-good-item-load").hide();
            $(".product-good-item-load").slice(0, 5).show();
            if ($(".product-good-item-load:hidden").length != 0) {
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
                    if ($(".product-good-item-load:hidden").length == 0) {
                            $(".LoadGood").fadeOut('slow');
                    }
                }, 300);
            });

        }
        if(windowsize < 1198){

            $(".productCateLoad-M").hide();
            $(".productCateLoad-M").slice(0, 6).show();
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
                    if ($(".productCateLoad-M:hidden").length == 0) {
                            $("#LoadCate").fadeOut('slow');
                    }
                }, 300);
            });
            $(".product-good-mo-load").hide();
            $(".product-good-mo-load").slice(0, 6).show();
            if ($(".product-good-mo-load:hidden").length != 0) {
                $("#LoadGood").show();
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