@extends('frontend.layouts.app')


@push('css')
<link href="{{ mix('css/blog.css') }}" rel="stylesheet">
@endpush
@section('body')
<header></header>
<main class="container pt-4">
    <div class="breadcrumb"> </div>
    <section>
        <div class="row mx-0 mb-4">
            <div class="col-12 col-lg-9 mr-auto">
                <h2 class="title-section">{{ $post->display_name }}</h2>
            </div>
            <div class="col-12 col-lg-9 border-right border-bottom">
                
                <div class="content-section pb-0 pt-3">
                    <div class="img-header">
                        <img src="{{ $post->image }}" class="img-fluid" alt="">
                    </div>
                    <div class="product-social d-flex my-4">
                        <a href="" class="btn-social url"><span>URL</span></a>
                        <a href="" class="btn-social fb"><i class="fab fa-facebook-f"></i></a>
                        <a href="" class="btn-social line"><i class="fab fa-line"></i></a>
                        <a href="" class="btn-social ig"><i class="fab fa-instagram"></i></a>
                    </div>

                    <div class="blog-content">
                        {!! $post->body_html !!}
                    </div>
                </div>
            </div> 
            <div class="col-12 col-lg-3 border-bottom">
                <form action="" class="search-mobile">
                    <div class="input-group border">
                        <input type="text" class="form-control border-0" placeholder="ค้นหา" aria-label="ค้นหา" aria-describedby="button-addon2">
                        <div class="input-group-append bg-transparent">
                            <button class="btn" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <div class="categories-blog">
                    <h4>ประเภทบทความ</h4>
                    <ul>
                        <li><a href=""></a></li>
                    </ul>
                </div>
                <div class="relate-product">
                    <h2 class="title-section mb-4 mt-3 mt-lg-0">Related Product</h2>
                    <div class="row">
                        @for ($i = 1; $i <= 3; $i++)
                        <div class="col-6 col-lg-12 mb-4 item list-item">
                                <div class="product-wrapper">
                                    <div class="product-box">
        
                                        <div class="product-img">                                    
                                            <a href="{{ route('products.view' , 'test')}}">
                                                <img class="product-icon" src="{{ asset('images/icon/ring-icon.png') }}" alt="">
                                                <img src="https://via.placeholder.com/191/ffffff/000000/?text=IMG PRODUCT" class="img-fluid" alt="" >
                                            </a>
                                        </div> 
                                        <div class="list product-tools d-flex justify-content-between">
                                            <a href="">
                                                <img class="shopping-icon" src="{{ asset('images/icon/shopping-icon.png') }}" alt="Buy">
                                            </a>
                                            <a href="">
                                                <img class="scale-icon" src="{{ asset('images/icon/scale-icon.png') }}" alt="Size">
                                            </a>      
                                        </div>  
                                    </div>  
                                    <div class="product-description list">
                                        <div class="product-title"><a href="{{ route('products.view' , 'test')}}">Steling Silver</a></div>
                                        <div class="product-description-text">Lolem</div>
                                        <div class="product-price"><a href="{{ route('products.view' , 'test')}}">50,000 B</a></div>
                                    </div>
                                    <div class="product-tools d-flex justify-content-between">
                                        <a href="">
                                            <img class="shopping-icon" src="{{ asset('images/icon/shopping-icon.png') }}" alt="Buy">
                                        </a>
                                        <a href="">
                                            <img class="scale-icon" src="{{ asset('images/icon/scale-icon.png') }}" alt="Size">
                                        </a>      
                                    </div>
                                </div>
                                <div class="product-description">
                                    <div class="product-title"><a href="{{ route('products.view' , 'test')}}">Steling Silver</a></div>
                                    <div class="product-price"><a href="{{ route('products.view' , 'test')}}">50,000 B</a></div>
                                </div>
                            </div>        
                        @endfor     
                    </div>
                </div>
            </div>
        </div>        
        
        <div class="row mb-5 order-4">
            @foreach ($post->banner_header as $banner)

                <div class="col-sm-12 col-md-6 mb-3 mb-lg-0">
                    <a href="{{ $banner['link'] }}">
                    <img src="{{ $banner['image'] }}" class="img-fluid" alt=""></a>
                </div>
            @endforeach
        </div>
    </section>
</main>

@endsection


@push('scripts')
@endpush