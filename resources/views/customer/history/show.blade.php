@extends('layouts.customer.master')

@section('title.page' , 'HISTORY')
@push('css')
    <style>
       #invoice {
  padding: 30px;
}

.invoice {
  position: relative;
  background-color: #FFF;
  min-height: 680px;
  padding: 15px;
  line-height: 16px;
}

.invoice header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 1px solid #3989c6;
}

.invoice .company-details {
  text-align: right;
}

.invoice .company-details .name {
  margin-top: 0;
  margin-bottom: 0;
}

.invoice .contacts {
  margin-bottom: 20px;
}

.invoice .invoice-to {
  text-align: left;
  font-size: 16px;
  line-height: 16px;
}

.invoice .invoice-to .to {
  margin-top: 0;
  margin-bottom: 0;
}

.invoice .invoice-details {
  text-align: right;
}

.invoice .invoice-details .invoice-id {
  margin-top: 0;
  color: #3989c6;
}

.invoice main {
  padding-bottom: 50px;
}

.invoice main .thanks {
  margin-top: -100px;
  font-size: 20px;
  margin-bottom: 50px;
}

.invoice main .notices {
  padding-left: 6px;
  border-left: 6px solid #3989c6;
}

.invoice main .notices .notice {
  font-size: 16px;
}

.invoice table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

.invoice table td,
.invoice table th {
  padding: 15px;
  background: #eee;
  border-bottom: 1px solid #fff;
}

.invoice table th {
  white-space: nowrap;
  font-weight: 400;
  font-size: 16px;
}

.invoice table td h3 {
  margin: 0;
  font-weight: 400;
  color: #3989c6;
  font-size: 16px;
}

.invoice table .qty,
.invoice table .total,
.invoice table .unit {
  text-align: right;
  font-size: 16px;
}

.invoice table .no {
  color: #fff;
  font-size: 18px;
  background: #3989c6;
}

.invoice table .unit {
  background: #ddd;
}

.invoice table .total {
  background: #3989c6;
  color: #fff;
}

.invoice table tbody tr:last-child td {
  border: none;
}

.invoice table tfoot td {
  background: 0 0;
  border-bottom: none;
  white-space: nowrap;
  text-align: right;
  padding: 10px 20px;
  font-size: 16px;
  border-top: 1px solid #aaa;
}

.invoice table tfoot tr:first-child td {
  border-top: none;
}

.invoice table tfoot tr:last-child td {
  color: #3989c6;
  font-size: 18px;
  border-top: 1px solid #3989c6;
}

.invoice table tfoot tr td:first-child {
  border: none;
}
.address , .email{
  font-size:16px;
}
.invoice footer {
  width: 100%;
  text-align: center;
  color: #777;
  border-top: 1px solid #aaa;
  padding: 8px 0;
}

@media print {
  .invoice {
    font-size: 11px !important;
    overflow: hidden !important;
  }

  .invoice footer {
    position: absolute;
    bottom: 10px;
    page-break-after: always;
  }

  .invoice > div:last-child {
    page-break-before: always;
  }
}
@media (max-width: 991.98px) {
  .invoice table td,
  .invoice table th {
    padding: 5px;
  }
  .invoice table td h3 {
    font-size: 14px;
  }
  .invoice table tfoot td {
    font-size: 14px;
    padding: 5px; 
  }
  .invoice table .qty,
  .invoice table .total,
  .invoice table .unit {
    font-size: 14px;
  }
  .invoice main .thanks {
      margin-top: 0;
      font-size: 14px;
      margin-bottom: 0;
  }
  .invoice main {
      padding-bottom: 20px;
  }
}

    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h5><a href="{{ route('customer.index')}}">{{ __('main.word.home')}}</a> > <a href="{{ route('customer.history.index')}}">{{ __('main.word.HISTORY ORDERS')}}</a>  > {{ __('main.word.Order No')}} #{{$order->id}}</h>
                <div class="invoice overflow-auto">
                    <div style="">
                        <header>
                            <div class="row">
                                <div class="col">
                                    <a target="_blank" href="{{ route('home')}}">
                                        <img src="{{ asset('images/logo/logo.png') }}" data-holder-rendered="true" />
                                        </a>
                                </div>
                                <div class="col company-details">
                                    <h2 class="name">
                                        <a target="_blank" href="{{ route('home')}}">
                                        PP ELECTRIC
                                        </a>
                                    </h2>
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">INVOICE TO:</div>
                                    <h2 class="to">{{ $order->full_name }}</h2>
                                    <div class="address">{{ $order->full_address}}</div>
                                    <div class="email"><a href="mailto:{{ $order->billing_email}}">{{ $order->billing_email}}</a></div>
                                </div>
                                <div class="col invoice-details">
                                    <h1 class="invoice-id">INVOICE</h1>
                                    <div class="date">Date of Invoice: {{ $order->created_at }}</div>
                                    {{-- <div class="date">Due Date: 30/10/2018</div> --}}
                                </div>
                            </div>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">{{ __('main.word.product')}}</th>
                                        <th class="text-right">{{ __('main.word.quantity')}}</th>
                                        <th class="text-right">{{ __('main.word.price')}}</th>
                                        <th class="text-right">{{ __('main.word.Total')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($order->products as $key=>$product)
                                        @php $slug       =   $product->slug; @endphp
                                        @if($product->product_type == "option_product")
                                            @php
                                                $image      =    $product->parent->image;    
                                                $slug       =   $product->parent->slug;
                                            @endphp
                                        @endif
                                        <tr>
                                            <td class="no">{{ $i }}</td>
                                            <td class="text-left"><h3>
                                                <a target="_blank" href="{{ route('products.show' , $slug)}}">
                                                {{ $product->name }}
                                                </a>
                                                </h3> 
                                                <span style="font-size:16px;">SKU : {{ $product->sku }}</span> 
                                                
                                            </td>
                                            <td class="unit">{{ $product->pivot->quantity }}</td>
                                            <td class="qty">{{ number_format($product->price,2) }} {{ __('main.word.currency')}}</td>
                                            <td class="total">{{ number_format($product->price*$product->pivot->quantity,2) }} {{ __('main.word.currency')}}</td>
                                        </tr>
                                    @php $i++; @endphp
                                    @endforeach
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">{{ __('main.word.Sub Total')}}</td>
                                        <td>{{ number_format($order->order_price,2) }} {{ __('main.word.currency')}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">{{ __('main.word.Shipping Price')}}</td>
                                        <td>{{ number_format($order->shipping_price,2) }} {{ __('main.word.currency')}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">{{ __('main.word.Total')}}</td>
                                        <td>{{ number_format($order->total , 2) }} {{ __('main.word.currency')}}</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="thanks">{{ __('main.word.Thank you for ordering from us')}}</div>
                            
                        </main>
                        <footer>
                            Invoice was created on a computer and is valid without the signature and seal.
                        </footer>
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    <div></div>
                </div>
            </div>
        </div>
    </div>
@stop