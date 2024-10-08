@extends('layouts.frontend.home')

@section('title' , 'แบรนด์สินค้า | PP ELECTIRC ')
@section('keywords' , 'แบรนด์สินค้า,'.getSetting('site_keywords'))

@section('custom-css')
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:type" content="product">
    <meta property="og:title" content="แบรนด์สินค้า | PP ELECTIRC">
    <meta property="og:description" content="{{ 'แบรนด์สินค้า '.getSetting('site_description')}}">
    <meta property="og:image" content="{{ \Storage::url(getSetting('site_logo')) }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
@stop

@section('content')
    <div class="brand-header mt-5">
        <img src="{{ asset('images/slides/slide1.png') }}" width="100%" class="img-fluid" alt="">
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">{{ Breadcrumbs::render('brand') }}</div>
            <h2 class="col-12"> {{ __('main.word.brands') }} <hr class="border-warning border-bottom my-0"></h2>
        </div>

        <div class="row mb-3">
            @foreach($brands as $brand)

                <div class="col-md-3 col-6 mb-3" >
                    <div class="product-relate-item mainHover"  style="border:1px solid #d7d7d7;padding: 5px;position: relative;">
                        <div class=" box_hover_img">
                            <img src="{{ \Storage::url($brand->images) }}" class="img-hover" style="display: block;border:1px solid #d7d7d7;width: 100%;height: 100%;" >
                            <span class="box_hover tha"></span>
                        </div>
                        <div class="d-flex justify-content-between px-2 product-detail-top">
                            <h2 class="product-name mb-0">
                                <a href="{{ route('brands.show' , $brand->slug ) }}">{{ $brand->name }}</a>
                            </h2>
                        </div>
                        
                        
                    </div>
                </div>
            @endforeach
        </div>
    </div>
  
@stop

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js" type="text/javascript"></script>
@endpush