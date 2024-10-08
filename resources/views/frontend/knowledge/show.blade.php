@extends('layouts.frontend.home')


@section('title' , $article->meta_title ?? $article->name . ' | ' . getSetting('site_title'))
@section('keywords' , $article->meta_keyword ?? $article->name)
@section('description' , $article->meta_description ?? $article->short_description)

@section('custom-css')

<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:type" content="article">
<meta property="og:title" content="{{ $article->meta_title ?? $article->name }}">
<meta property="og:description" content="{{ $article->meta_description ?? $article->short_description }}">
<meta property="og:image" content="{{ \Storage::url($article->image) }}">
<link rel="stylesheet" href="{{ asset('css/knowledge.css')}}" type="text/css">
@stop


@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">{{ Breadcrumbs::render('knowledge_detail' , $article) }}</div>
        <h2 class="col-12 blog-post-title"> {{ $article->name }}
            <hr class="border-warning border-bottom my-0">
        </h2>
    </div>
    <div class="row">
        <div class="col-md-8 blog-main">

            <div class="blog-post">
                {!! $article->body_html !!}
            </div><!-- /.blog-post -->
        </div><!-- /.blog-main -->

        <aside class="col-md-4 blog-sidebar">
            <div class="p-3 mb-3 bg-light rounded">
                <h4 class="font-italic">ค้นหาบทความ</h4>
                <form action="">
                    <input type="text" class="form-control">
                </form>
            </div>

            <div class="p-3">
                <h4 class="font-italic">หมวดหมู่</h4>
                <hr>
                <ol class="list-unstyled mb-0">
                    @foreach ($categories as $category)
                        <li><a href="{{ route('knowledge.category' , $category->slug )}}">{{ $category->name }}</a></li>
                    @endforeach
                </ol>
            </div>
            <div class="p-3">
                <h4 class="font-italic">ป้ายกำกับ</h4>
                <hr>
                <ol class="list-unstyled">
                    @foreach ($tags as $tag)
                        <li><a href="{{ route('knowledge.tag' , $tag->slug )}}">{{ $tag->name }}</a></li>
                    @endforeach
                </ol>
            </div>
        </aside><!-- /.blog-sidebar -->

    </div>
</div>
@stop

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js" type="text/javascript"></script>
@endpush
