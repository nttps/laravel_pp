@extends('layouts.frontend.home')

@section('title' , 'About Shop')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/promotion.css')}}" type="text/css">
@stop


@section('content')
    <div class="container  mt-3">
        {{ $content->title }}
    </div>
    <div class="bg-primary mt-3">
        <img src="{{ \Storage::url($content->image) }}" class="img-fluid" alt="">
    </div>
    <div class="container mt-5">
        {!! $content->body_html !!}
       
    </div>
@stop

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js" type="text/javascript"></script>
@endpush
