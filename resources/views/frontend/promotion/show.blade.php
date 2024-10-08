@extends('layouts.frontend.home')


@section('title' , $promotion->meta_title ?? $promotion->title )
@section('keywords' , $promotion->meta_keyword ?? $promotion->title)
@section('description' , $promotion->meta_description ?? $promotion->short_description)
@section('custom-css')

    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $promotion->meta_title ?? $promotion->title }}">
    <meta property="og:description" content="{{ $promotion->meta_description ?? $promotion->short_description }}">
    <meta property="og:image" content="{{ \Storage::url($promotion->image) }}">
    <link rel="stylesheet" href="{{ asset('css/knowledge.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/promotion.css')}}" type="text/css">
@stop


@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">{{ Breadcrumbs::render('promotion_detail' , $promotion) }}</div>
            <h2 class="col-12"> {{ $promotion->title }} <hr class="border-warning border-bottom my-0"> </h2>
        </div>
        <div class="row">
            <div class="col-12">
                {!! $promotion->body_html !!}
            </div>
        </div>
    </div>
    {{-- @include('layouts.frontend.partials.relate-product' , [ 'relateForProduct' => $relateForProduct]) --}}
@stop

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js" type="text/javascript"></script>
@endpush
