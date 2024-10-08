@extends('layouts.frontend.home')

@section('title' , 'PROMOTION')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/promotion.css')}}" type="text/css">
@stop


@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">{{ Breadcrumbs::render('promotion') }}</div>
            <h2 class="col-12"> {{ __('main.word.promotions')}} <hr class="border-warning border-bottom my-0"> </h2>
        </div>
        <div class="row">
            @forelse($promotions as $promotion)
                <div class="col-12 mt-5">
                    <a href="{{ route('promotion.show' , $promotion->slug) }}"><img src="{{ \Storage::url($promotion->image)}}" class="img-fluid" alt=""></a>
                </div>

            @empty 
                <div class="col-12 mt-5">
                    <h3> NO PROMOTION </h3>
                </div>
            @endforelse
        </div>
    </div>
    {{-- @include('layouts.frontend.partials.relate-product' , [ 'relateForProduct' => $relateForProduct]) --}}
@stop

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js" type="text/javascript"></script>
@endpush
