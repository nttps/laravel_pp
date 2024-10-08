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

        /* Style the Image Used to Trigger the Modal */
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}
.action {
    min-width: 100px!important;
}
#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 99999; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */

}

/* Modal Content (Image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption { 
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.closeModal {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.closeModal:hover,
.closeModal:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}

.modal-ku {
  width: 750px;
  margin: auto;
}
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h5><a href="{{ route('customer.history.index')}}">{{ __('main.word.home')}}</a> > {{ __('main.word.HISTORY ORDERS')}}</h5>
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
                                }elseif ($order->status == 'AWAIT-PAYMENT'){
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
                                <td>
                                    {{ $order->payment_method }} 
                                    <br> 
                                    
                                    
                                <td>
                                    {{ $order->status }} 
                                    @if($order->payment)
                                        <br>
                                        @if($order->payment_method != 'QR-CODE')
                                            <a href="javascript:void(0)" data-img="{{ \Storage::url($order->payment->proof_payment) }}" class="view-proof" id="">ดูหลักฐานการชำระเงิน</a> 
                                        @endif
                                    @endif
                                </td>
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
            <div class="modal-body text-center">
                <img src="" class="payment-proof img-fluid " alt="">
            </div>
        </div>
        </div>
    </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- The Close Button -->
        <span class="closeModal">&times;</span>
      
        <!-- Modal Content (The Image) -->
        <img class="modal-content img-fluid" id="img-proof">
      
        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
    </div>
@stop
@push('script')
      <script>

            $(document).on('click' , '.viewPayment' , function() {
                var img = $(this).data('img');
                $('#viewPayment .modal-body .payment-proof').attr('src' , img);
            });

            $(document).on('click' , '.view-proof' , function() {
                var img = $(this).data('img');
                $('#img-proof').attr('src' , img);
                $('#myModal').show();
            });
          
            $(document).on('click' , '.closeModal' , function() {
                var img = $(this).data('img');
                $('#img-proof').attr('src' , '');
                $('#myModal').hide();
            });
      </script>
@endpush
