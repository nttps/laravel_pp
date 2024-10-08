@extends('layouts.customer.master')

@section('title.page' , 'HISTORY')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h5><a href="{{ route('customer.history.index')}}">{{ __('main.word.home')}}</a> > {{ __('main.word.Payment')}} </h5>


                @if ($errors->has('fUpload'))
                    <div class="alert alert-danger">
                        {{ $errors->first('fUpload') }}
                    </div>
                @endif
                @if (\Session::has('success_message'))
                    <div class="alert alert-success">
                        {{ \Session::get('success_message') }} ตรวจสอบข้อมูลได้ที่ หน้าประวัติการสั่งซื้อสินค้าของฉัน <a href="{{ route('customer.history.index') }}" class="alert-link">คลิก</a> 
                    </div>
                @endif
                
                <div class="table-responsive">
                <table class="table table-customer bg-white">
                    <thead>
                        <tr>
                            <th class="text-center">{{ __('main.word.Order No')}}</th>
                            <th>{{ __('main.word.Date')}}</th>
                            <th>{{ __('main.word.Payment Method')}}</th>
                            <th class="text-center">{{ __('main.word.Status')}}</th>
                            <th class="text-right">{{ __('main.word.Total')}}</th>
                            <th class="text-center action">{{ __('main.word.Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td class="text-center">{{ $order->id }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td class="text-center">{{ $order->status }}</td>
                                <td  class="text-right">{{ $order->total_price }}</td>
                                <td class="text-center">
                                    <a href="{{ route('customer.history.show' , $order->id) }}" class="btn btn-sm btn-primary">{{ __('main.word.view_detail')}}</a>
                                    @if($order->status == 'AWAIT-PAYMENT')
                                        @if($order->payment_method == 'QR-CODE')
                                            <a href="javascript:void(0)" data-img="{{ $order->payment->proof_payment ?? '' }}" data-toggle="modal" data-target="#viewPayment" class="viewPayment btn btn-sm btn-info">{{ __('main.word.Payment')}}</a> 
                                        @else 
                                            <form style="display:inline-block" action="{{ route('customer.payment.update' , [$order->id])}}" id="formupload_{{ $order->id }}" method="post" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="PUT">
                                                    <a href="javascript:void(0);" onclick="$('#newfile-{{ $order->id }}').click();" class="btn btn-sm btn-info mx-2">{{ __('main.word.Payment')}}</a>
                                                <input type="file" id="newfile-{{ $order->id }}" style="display:none;" onchange="checktype($(this).val(),'{{ $order->id }}');" name="fUpload">
                                            </form>
                                        @endif
                                    @endif
                                    
                                    
                                    
                                    <a href="" class="btn btn-sm btn-danger">{{ __('main.word.Cancle Order')}}</a>
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
               

                <div class="alert alert-info mt-3">
                    ลูกค้าสามารถแจ้งชำระเงินได้โดยคลิกที่ปุ่มแจ้งชำระเงิน เพื่อแนบหลักฐาน หรือสลิป เพื่อการยืนกันการชำระเงิน
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
@stop

@push('script')
<script type="text/javascript">

        $(document).on('click' , '.viewPayment' , function() {
            var img = $(this).data('img');
            $('#viewPayment .modal-body .payment-proof').attr('src' , img);
        });

    function checktype(val,ordernum){
        var type = val.slice((Math.max(0, val.lastIndexOf(".")) || Infinity) + 1);

        console.log(type);
        var allow_type = ["jpg","png","gif","jpeg","xls","xlsx","pdf","doc","docx" ,"bmp"];

        if(allow_type.indexOf(type.toLowerCase()) !==  -1){ 
            $("#formupload_"+ordernum).submit();
        }else{
            $("input[name=fUpload]").val('');
            alert('กรุณาเลือกไฟล์ .JPG .PNG .GIF .XLS .PDF .DOC');
            // $("#alert-type").modal();
            // setTimeout(function(){
            // 	$("#alert-type").modal("hide")
            // }, 5000);
        }
    }
</script>
@endpush
