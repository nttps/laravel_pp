@extends('layouts.frontend.home')

@section('title' , 'CART')

@section('custom-css')
    <link rel="stylesheet" href="{{ mix('css/thankyou.css')}}" type="text/css">

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
        <div class="row  hidden-print">
            <div class="col-12">{{ Breadcrumbs::render('checkout') }}</div>
            
        </div>
        <hr class="border-warning border-bottom mt-0">
        <div class="container">
            <div class="d-print-block" id="invo-price">
                <div class="invoice overflow-auto">
                    <div>
                        <header>
                            <div class="row mb-3">
                                <div class="col-12 text-center">
                                     <h2 class="border-warning px-0 mb-0 text-success"> {{ __('main.word.Order Completed')}} </h2>
                                    <h2>{{ __('main.word.Thank you for ordering from us')}}</h2> 
                                </div>
                                <div class="col-12 text-center">
                                    <a href="{{ route('customer.history.index') }}" class="btn btn-primary">{{ __('main.word.View Orders')}}</a>
                                    @if($order->status == 'AWAIT-PAYMENT')
                                        <a href="{{ route('customer.payment.index')}}" class="btn btn-warning">{{ __('main.word.View Payments')}}</a>
                                    @endif                                    
                                    @if($order->payment_method == 'QR-CODE')
                                        <a href="#" data-toggle="modal" data-target="#viewPayment" class="btn btn-info">QR-CODE สำหรับการชำระเงิน</a>
                                    @endif
                                    @if($order->payment_method == 'BAR-CODE')
                                        <a href="{{ route('bar.view' , $order->id) }}" target="_blank" class="btn btn-info">BARCODE สำหรับการชำระเงิน</a>
                                    @endif
                                    @if($order->status != 'CANCELLED')
                                        <a href="{{ route('customer.order.cancle' , $order->id)}}" onclick="return confirm('คุณต้องการยกเลิกคำสั่งซื้อ ?');" class="btn btn-danger">{{ __('main.word.Cancle Order')}}</a>
                                    @endif
                                </div>
                            </div>
                            @if($order->payment_method == 'BANK-DEPOSIT')
                                <p class="d-block"> {{ __('checkout.Bank-deposit-warning')}}</p>
                                <div class="d-flex justify-content-start">
                                   
                                    @foreach ($banks as $bank)
                                        <div class="col">
                                            <p> <strong>{{ __('checkout.Bank')}} :</strong> {{ $bank->bank }}</p>
                                            <p> <strong>{{ __('checkout.Account Name')}} :</strong> {{ $bank->name }}</p>
                                            <p> <strong>{{ __('checkout.Bank-Number')}} :</strong> {{ $bank->number }}</p>                                    
                                        </div>
                                    @endforeach
                                </div>
                                
                            @endif
                            
                            <hr>

                          
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h3 class="text-primary">{{ __('main.word.Orders')}}</h3> 
                                </div>
                                <div class="col-12 text-center hidden-print">
                                    <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                                       
                                </div>
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
                            <div class="row">
                                <div class="table-responsive">
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
                                                @php
                                                    $slug       =   $product->slug;
                                                @endphp
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
                                                        {{ $product->getName() }}
                                                        </a>
                                                        </h3>
                                                        <span>SKU : {{ $product->sku }}</span>    
                                                    </td>
                                                    <td class="unit">{{ $product->pivot->quantity }}</td>
                                                    <td class="qty">{{ number_format($product->getPrice(),2) }} {{ __('main.word.currency')}}</td>
                                                    <td class="total">{{ number_format($product->getPrice()*$product->pivot->quantity,2) }} {{ __('main.word.currency')}}</td>
                                                </tr>
                                            @php $i++; @endphp
                                            @endforeach
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4">{{ __('main.word.Sub Total')}}</td>
                                                <td>{{ number_format($order->order_price,2) }} {{ __('main.word.currency')}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="border-top:none"></td>
                                                <td>{{ __('main.word.Shipping Price')}}</td>
                                                <td>{{ number_format($order->shipping_price,2) }} {{ __('main.word.currency')}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="border-top:none"></td>
                                                <td>{{ __('main.word.Total')}}</td>
                                                <td>{{ number_format($order->total , 2) }} {{ __('main.word.currency')}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                            
                                </div>
                                
                            </div>
                            
                        </main>
                        <footer>
                            @if($order->payment_method == 'QR-CODE')
                                <div class="alert alert-info" role="alert">
                                    <h5 class="text-center">{{ __('checkout.QRCODEPAYMENT')}}</h5>
                                    <p class="mb-0">{{ __('checkout.Click at button')}}  <a href="#" data-toggle="modal" data-target="#viewPayment" class="btn btn-info btn-sm">QR-CODE {{ __('checkout.FOR PAY')}}</a> {{ __('checkout.msgforQRCODE')}}</p>
                                </div>
                            @endif
                            @if($order->payment_method == 'BAR-CODE')
                                <div class="alert alert-info" role="alert">
                                    <h5 class="text-center">{{ __('checkout.BARCODEPAYMENT')}}</h5>
                                    <p class="mb-0">{{ __('checkout.Click at button')}} <a href="{{ route('bar.view' , $order->id) }}" target="_blank" class="btn btn-info btn-sm">BARCODE {{ __('checkout.FOR PAY')}}</a> {{ __('checkout.msgforBARCODE')}} </p>
                                </div>
                            @endif
                        </footer>
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    <div></div>
                </div>
            </div>
        </div>
    </div>
    @if($order->status != 'AWAIT-PAYMENT')
    <!-- Modal -->
    <div class="modal fade" id="viewPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="col-12 text-center">
                    <img src="{{ $order->payment->proof_payment }}" class="img-fluid" alt="" style="height: 350px">
                </div>
                
                <div class="alert alert-primary mt-5" role="alert">
                    <strong>ขั้นตอนการชำระเงิน</strong>    
                    <ol> เข้าแอพอินเตอร์เน็ตแบ้งของท่านจะของธนาคารใดก็ได้ </ol> 
                    <ol> เข้าเมนูแสกน QR-CODE จากแอพอินเตอร์เน็ตแบ้งกิ้งของท่าน </ol> 
                    <ol> ทำการแสกน QR-CODE เพื่อชำระเงิน </ol> 
                </div>
            
            </div>
        </div>
        </div>
    </div>
    @endif
@stop

@push('scripts')
    <script>
        $('#printInvoice').click(function(){

           var divToPrint=document.getElementById('invo-price');

                var newWin=window.open('','Print-Window');

                newWin.document.open();

                newWin.document.write('<html><head><link rel="stylesheet" href="{{ mix('css/app.css')}}"><link rel="stylesheet" href="{{ mix('css/styles.css')}}" type="text/css"><link rel="stylesheet" href="{{ mix('css/thankyou.css')}}" type="text/css"></head><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

                newWin.document.close();

                setTimeout(function(){newWin.close();},10);
        });
    </script>
@endpush
