@extends('layouts.frontend.home')

@section('title' , 'CART')

@section('custom-css')
    <link rel="stylesheet" href="{{ mix('css/cart.css')}}" type="text/css">

    <style>
    .blockUI.blockOverlay::before {
        height: 1em;
        width: 1em;
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-left: -.5em;
        margin-top: -.5em;
        content: '';
        -webkit-animation: spin 1s ease-in-out infinite;
        animation: spin 1s ease-in-out infinite;
        font-family:'Font Awesome 5 Free';
        font-weight: 900;
        content: "\f1ce";
        background-size: cover;
        line-height: 1;
        text-align: center;
        font-size: 2em;
        color: rgba(0,0,0,.75);
    }
    @-moz-keyframes spin {
        100%{-webkit-transform:rotate(360deg);
            transform:rotate(360deg)
        }
    }

    @-webkit-keyframes spin{
        100%{-webkit-transform:rotate(360deg);
            transform:rotate(360deg)
        }
    }
    @keyframes spin{
        100%{-webkit-transform:rotate(360deg);
            transform:rotate(360deg)
        }
    }
    </style>
@stop


@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">{{ Breadcrumbs::render('cart') }}</div>
            <div class="col-6">
                <h2 class="border-warning px-0 mb-0"> {{ __('main.word.your-cart')}} </h2>
                
            </div>
            <div class="col-6 text-right">
                <div class="btn-checkout">
                    <a class="btn btn-warning btn-sm text-white" href="{{ route('products.index') }}">{{ __('main.word.Continue Shopping')}}</a>
                    @if(Cart::getTotalQuantity() > 0)
                        <a class="btn btn-primary btn-sm" href="{{ route('checkout') }}">{{ __('main.word.Checkout')}}</a>
                    @endif
                </div>
            </div>
        </div>
        <hr class="border-warning border-bottom mb-4 mt-0">
        <form action="" class="form-cart">
            <table class="table cart-table">
                <thead>
                    <tr>
                        <th class="text-center"><span class="nobr">{{ __('main.word.product')}}</span></th>
                        <th class="text-center isDesktop">{{ __('main.word.price')}}</th>
                        <th class="text-center">{{ __('main.word.quantity')}}</th>
                        <th class="text-center"> {{ __('main.word.price')}}</th>
                        <th class="text-center isDesktop">{{ __('main.word.Delete')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sort as $key=>$cartCondition)
                    @php
                        $href = !isset($cartCondition->attributes->slug) ? route('products.show' ,$cartCondition->attributes->slug) : '';
                    @endphp
                        <tr>
                            <td>
                                <a href="{{ $href }}" title="" class="product-image" style="width:100px;height:100px">
                                    <img src="{{ \Storage::url($cartCondition->attributes->image) }}" alt="">
                                </a>
                                <div class="product-cart-info">
                                    <a href="{{ $href }}" title="ลบรายการสินค้าออก" class="btn-remove btn-remove2 isMobile">ลบรายการสินค้าออก</a>
                                    <h2 class="product-name">
                                        <a href="{{ $href }}">{{ $cartCondition->name }}</a>
                                    </h2>
                                    <p class="product-short-desc mb-0"></p>
                                    <div class="product-cart-sku"><strong class="label">{{ __('main.word.Sku')}}: </strong> {{ $cartCondition->attributes->sku }}</div>
                                    <div class="product-cart-sku product-price-unit isMobile">
                                        <strong class="label"> {{ __('main.word.price')}}: </strong>
                                        <span class="cart-price">
                                            <span class="price">{{ $cartCondition->price }} {{ __('main.word.currency')}}</span>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center isDesktop"><span class="cart-price">{{ $cartCondition->price }}</span> <span class="cart-price">{{ __('main.word.currency')}}</span></td>
                            <td class="product-cart-quantity text-center">
                                <div class="qty-wrapper">
                                    <input type="text" name="qty" id="qty" maxlength="5" value="{{ $cartCondition->quantity }}" data-type="update" data-id="{{ $cartCondition->id }}" title="จำนวน" class="input-text qty quantity_update">
                                    <button type="button" title="เพิ่ม" class="btn update_qty btn_minus quantity_inc" data-type="cart" data-id="{{ $cartCondition->id }}"><i class="fas fa-chevron-up mb-0"></i></button>
                                    <button type="button" title="ลบ" class="btn update_qty btn_plus quantity_dec" data-type="cart" data-id="{{ $cartCondition->id }}"><i class="fas fa-chevron-down mb-0"></i></button>
                                </div>
                            </td>
                            <td class="text-center"><span class="cart-price">{{ $cartCondition->getPriceSum() }}</span> <span class="cart-price">{{ __('main.word.currency')}}</span></td>
                            <td class="text-center isDesktop"><a href="" title="ลบรายการสินค้าออก" class="btn-cart-remove text-danger" data-type="delete" data-id="{{ $cartCondition->id }}"><i class="fas fa-trash"></i></a></td>
                        </tr>

                    @empty 
                        <tr><td colspan="6" class="text-center">ไม่มีสินค้าในตะกร้า</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-5 offset-md-7">
                    <table class="cart-totals-table">
                        <tfoot>
                            <tr>
                                <td class="text-right" colspan="1">
                                    <strong>{{ __('main.word.Sub Total')}}</strong>
                                </td>
                                <td class="text-right">
                                    <strong><span class="price">{{ $totals. ' '.__('main.word.currency') }}</span></strong>
                                </td>
                            </tr>
                        </tfoot>
                        {{-- <tbody>
                            <tr>
                                <td class="text-right" colspan="1">
                                    <strong> มูลค่ารวม </strong>
                                </td>
                                <td class="text-right">
                                    <span class="price font-weight-bold">{{ $totals. ' '.__('main.word.currency') }}</span>
                                </td>
                            </tr>
                        </tbody> --}}
                    </table>
                    <div class="btn-checkout mt-3 text-right">
                        <a class="btn btn-warning btn-sm text-white" href="{{ route('products.index') }}">{{ __('main.word.Continue Shopping')}}</a>
                        @if(Cart::getTotalQuantity() > 0)
                            <a class="btn btn-primary btn-sm" href="{{ route('checkout') }}">{{ __('main.word.Checkout')}}</a>
                        @endif
                    </div>
                </div>
            </div>

        </form>
    </div>
@stop

@push('scripts')
    <script>
        function updateCart(val , id , type ,cart){
            $('.form-cart').block({
                message: null,
                overlayCSS: {
                    background: "#fff",
                    opacity: .6
                }
            });
            var url = "{{ route('cart.add') }}",
                c = {
                _token: '{!! csrf_token() !!}',
                id: id,
                qty: val,
                type: type
            };
            $.post(url, c, function (t) {
                var t = window.location.toString();
                $('.form-cart').unblock(),
                $(".cart-totals-table").load(t + " .cart-totals-table");
                $('.cart-table').load(t + " .cart-table", function () {
                    $('.cart-table').trigger('click');
                    $(".num-basket").load(t + " .number");
                });
            });
        }
        $('.cart-table').on('click' , '.btn-cart-remove' , function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var type = $(this).data('type');
            $('.form-cart').block({
                message: null,
                overlayCSS: {
                    background: "#fff",
                    opacity: .6
                }
            });
            var url = "{{ route('cart.add') }}",
                c = {
                _token: '{!! csrf_token() !!}',
                id: id,
                type: type
            };
            $.post(url, c, function (t) {
                var t = window.location.toString();
                $('.form-cart').unblock();
                $(".cart-totals-table").load(t + " .cart-totals-table");
                $('.cart-table').load(t + " .cart-table", function () {
                    $('.cart-table').trigger('click');
                    $(".num-basket").load(t + " .number");
                });
            });
        });
    </script>
@endpush
