@extends('layouts.frontend.home')

@section('title' ,  __('main.word.knowledges') .' | ' . getSetting('site_title'))
@section('keywords' , __('main.word.knowledges') . ','.getSetting('site_keywords'))

@section('custom-css')
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="เกร็ดความรู้ | PP ELECTIRC">
    <meta property="og:description" content="{{ __('main.word.knowledges'). ' '.getSetting('site_description')}}">
    <meta property="og:image" content="{{ \Storage::url(getSetting('site_logo')) }}">
    <link rel="stylesheet" href="{{ asset('css/knowledge.css')}}" type="text/css">
@stop


@section('content')
    <div class="container mt-5 mb-5">
        
        <div class="row">
            <div class="col-12">{{ Breadcrumbs::render('knowledge') }}</div>
            <h2 class="col-12"> {{ __('main.word.knowledges')}} <hr class="border-warning border-bottom my-0"> </h2>
        </div>
        <div class="row">
            @forelse($articles as $article)
                <div class="col-md-6 col-lg-4 col-6">
                    <div class="card mb-4 shadow-sm border-0 knowledge-item">
                        <div class="knowledge-date">{{ \Carbon\Carbon::parse($article->created_at , 'Asis/Bangkok')->isoFormat('Do MMM') }}</div>
                        <div class="card-body">
                            <a href="{{ route('knowledge.show', $article->slug) }}" class="card-link"><img class="card-img-top mb-3" src="{{ \Storage::url($article->image) }}" alt="{{ $article->name }}" style="height: auto; width: 100%; display: block;"></a>
                            <h2 class="mb-0"><a href="{{ route('knowledge.show', $article->slug) }}" class="card-link">{{ $article->name }}</a> </h2>
                            <p class="card-text mb-3">{{ $article->short_description }}</p>
                            <h6 class="card-text text-center">
                                @foreach ($article->tags()->get() as $key => $tag)
                                    <a href="{{ route('knowledge.tag' , $tag->slug) }}" class="card-link ml-0">{{ $tag->name }}</a> @if(!$loop->last) , @endif
                                @endforeach
                            </h6>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
            <div class="col-12 mb-2 text-center">
                <a class="btn-loadmore loadmore loadmore-yellow" href="javaScript:void(0);" style="display:none;"> โหลดเพิ่มเติม <i class="fas fa-plus"></i> </a>
                <div class="lds-ellipsis loading" style="display:none;"><div></div><div></div><div></div><div></div></div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js" type="text/javascript"></script>

    <script>
        $(".knowledge-item").hide();
        $(".knowledge-item").slice(0, 9).show();
        if ($(".knowledge-item:hidden").length != 0) {
            $(".loadmore").show();
        }
        $(".loadmore").on('click', function (e) 
        {
            e.preventDefault();
            $(this).hide();
            $('.loading').show();
            
            setTimeout(function () { 
                $('.loadmore').show();
                $('.loading').hide();
                $(this).show();
                $(".knowledge-item:hidden").slice(0, 3).slideDown();
                if ($(".knowledge-item:hidden").length == 0) {
                    $(".loadmore").fadeOut('slow');
                }
            }, 300);
        });
    </script>
@endpush
