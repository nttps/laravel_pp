@extends('layouts.customer.master')

@section('title.page' , 'HISTORY')

@push('css')
    <style>
        .tr-danger {
            background-color: #ffd3d3b8;
        }
        .tr-wait-confirm {
            background-color:#d9edf7;
        }
        .tr-shipped {
            background-color:#dcffd3b8;
        }
        .action {
            min-width: 100px!important;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h5><a href="{{ route('customer.history.index')}}">{{ __('main.word.home')}}</a> > {{ __('main.word.View Orders')}}/{{ __('main.word.Shipment')}}</h5>
                <div class="table-responsive">
                    <table class="table table-customer bg-white">
                        <thead>
                            <tr>
                                <th>{{ __('main.word.Order No')}}</th>
                                <th>{{ __('main.word.Date')}}</th>
                                <th>{{ __('main.word.Payment Method')}}</th>
                                <th class="text-center">{{ __('main.word.Status')}}</th>
                                <th class="number-shipping text-center">{{ __('main.word.Delivery number')}}</th>
                                <th  class="text-center action">{{ __('main.word.Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $tr_color = '';  @endphp
                            @forelse ($orders as $order)
                                
                                @php 
                                    if($order->status == 'CANCELLED'){
                                        $tr_color = 'tr-danger';
                                    }elseif ($order->status == 'AWAIT-CONFIRM'){
                                        $tr_color = 'tr-wait-confirm';
                                    }elseif($order->status == 'AWAIT-SHIPMENT'){
                                        $tr_color = 'tr-shipped';
                                    }elseif($order->status == 'SHIPPED'){
                                        $tr_color = 'tr-shipped';
                                    }
    
                                @endphp
                                <tr class="{{ $tr_color }}">
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td class="text-center">{{ $order->status }}</td>
                                    <td class="text-center">{{ $order->shipping_number }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('customer.history.show' , $order->id) }}" class="btn btn-sm btn-primary">{{ __('main.word.view_detail')}}</a>
                                        
                                        @if($order->status == 'AWAIT-PAYMENT')
                                            <a href="{{ route('customer.order.cancle' , $order->id)}}" onclick="return confirm('คุณต้องการยกเลิกคำสั่งซื้อ ?');" class="btn btn-sm btn-danger">{{ __('main.word.Cancle Order')}}</a>
                                        @endif
                                        
                                    </td>
                                </tr> 
                            @empty 
                                <tr>
                                    <td colspan="6"> ยังไม่มีรายการ </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $orders->render() }}
                </div>
                
               
            </div>
        </div>
    </div>
@stop