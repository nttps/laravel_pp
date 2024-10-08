@extends('layouts.frontend.home')

@section('title' , 'KNOWLEDGE')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/knowledge.css')}}" type="text/css">
@stop


@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
        <h2 class="col-12"> KNOWLEDGE CATEGORY : {{ $CateName }}<hr class="border-warning border-bottom my-0"> </h2>
        </div>
        <div class="row">
            @forelse($articles as $article)
                <div class="col-md-6 col-lg-4">
                    <div class="card mb-4 shadow-sm border-0 knowledge-item">
                        <div class="knowledge-date">12 ก.ย.</div>
                        <div class="card-body">
                            <a href="{{ route('knowledge.show', $article->slug) }}" class="card-link"><img class="card-img-top mb-3" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1662dfcebb3%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1662dfcebb3%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.7265625%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true"></a>
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
                <div class="col-md-12 text-center">
                    <h4 class="my-5"> ไม่มีข้อมูล </h4>
                </div>

            @endforelse
            <div class="col-12 mb-2 text-center">
                <a class="btn-loadmore loadmore loadmore-yellow" href="javaScript:void(0);" style="display:none"> โหลดเพิ่มเติม <i class="fas fa-plus"></i> </a>
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
