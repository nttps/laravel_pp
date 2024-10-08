@extends('frontend.layouts.app')


@push('css')
@endpush
@section('body')
<header class="owl-wrapper">
    <div class="owl-carousel owl-theme" id="header-slide">
        <div class="item">
            <div class="owl-text-overlay">
                <h2 class="owl-title">Arrow</h2>
                <p class="owl-caption">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent iaculis purus vel enim suscipit, vitae volutpat ante scelerisque. Pellentesque blandit malesuada dui, sed aliquet risus molestie non.</p>
                <button class="btn btn-praiza-primary"> Shop now </button>
            </div>
            <img class="owl-img" src="{{ asset('images/slide/banner1.png')}}">
        </div>
        <div class="item">
            <div class="owl-text-overlay">
                <h2 class="owl-title">Flash</h2>
                <p class="owl-caption">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent iaculis purus vel enim suscipit, vitae volutpat ante scelerisque. Pellentesque blandit malesuada dui, sed aliquet risus molestie non.</p>
            </div>
            <img class="owl-img" src="{{ asset('images/slide/banner1.png')}}">
        </div>
        
    </div>
</header>
<main class="container">
    <section id="product">
        <div class="content-select-grid pb-3 clearfix">
            <div class="float-left d-flex align-items-center">
                <a href="javascript:;" id="grid-view" class="active"><i class="fas fa-th"></i></a>
                <a href="javascript:;" id="list-view"><i class="fas fa-list"></i></a>
                <div class="showing-total">
                    Showing 1-12 of 182 results
                </div>
            </div>
            <div class="float-right">
                <div class="select-product-type">
                    <select name="slct" id="slct">
                        <option>PRODUCT SEARCH BY</option>
                    </select>
                </div>
            </div>

        </div>
        <h2 class="title-section">BLOG</h2>
        <div class="content-section pb-0 pt-3">
           
            <div class="row product">                
                @foreach ($posts as $post)
                    <div class="col-md-4 col-lg-3 col-6 mb-4 item list-item">
                        <div class="card mb-4 shadow-sm">
                            <img src="{{ $post->image }}" class="card-img-top p-1" alt="...">
                            <div class="card-body px-1 py-2">
                                <p class="card-text">{!! $post->body_html !!}</p>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('blog.show' , $post->slug) }}" class="btn btn-praiza-sec">อ่านต่อ</a>
                                </div>
                            </div>
                        </div>
                    </div>        
                @endforeach              

            </div>
            
        </div>
        @include('frontend.components.banner')
    </section>
</main>

@endsection


@push('scripts')
<script>
$(window).on( 'load'  ,function() {

    var slideHeader = $('#header-slide');

    slideHeader.owlCarousel({
        
        slideSpeed : 300,
        paginationSpeed : 500,
        items: 1,
        autoPlay : 4000,
        loop:true,
        stagePadding: 0,
        singleItem:true,
        margin:0,
        navText : ['<img src="images/icon/left-arrow.svg" width="25px">','<img src="images/icon/right-arrow.svg" width="25px">'],
        responsive:{
            0:{
                nav : true, 
                dots : false
            },
            992:{
                nav : false,       
                dots : true                   
        
            }
        }
        
    });
});
</script>
@endpush