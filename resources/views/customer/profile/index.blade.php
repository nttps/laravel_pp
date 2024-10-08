@extends('layouts.customer.master')

@section('title.page' , 'HISTORY')
@push('css')
    <style>
        .table-profile th, .table-profile td{
            padding: 5px;
            border-top: 0;
        }
        .table-profile label , .table-profile p{
            margin-bottom: 0px;
        }
        .table-profile label{
            color:black;
            min-width: 90px;
            float: left;
        }
    </style>
@endpush
@section('content')
<h5><a href="{{ route('customer.history.index')}}">{{ __('main.word.home')}}</a> > ดูคำสั่งซื่้อ/การจัดส่ง</h5>
    <div class="card ">
        <div class="card-header bg-white">
            <h5 class="mb-0 float-left text-dark">ข้อมูลผู้ใช้</h5>
        </div>
        <div class="card-body bg-transparent">
            @if(Session::has('success'))
                <div class="alert alert-success text-center" role="alert">
                    <h5 class="mb-0">{{Session::get('success')}}</h5>
                </div>
            @endif
            <form action="{{ route('customer.profile.store') }}" method="POST">
                @csrf
            <div class="table-responsive">
            <table class="table table-profile">
                <tbody>
                    <tr class="first odd">
                        <td width="50%">
                            <div class="form-inline">
                                <label class="my-1 mr-2">Member Id</label>
                                <input type="text" class="form-control d-inline-block" value="{{ $user->id }}" readonly>
                            </div>
                        </td>
                        <td class="last">
                            <div class="form-inline">
                                <label class="my-1 mr-2">ชื่อ - นามสกุล</label>
                                <input type="text" class="form-control d-inline-block" name="fullname" value="{{ $user->name }}" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <div class="form-inline mb-2">
                                <label class="my-1 mr-2">อีเมล</label>
                                <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                                <p><a class="ml-1 change-pass" href="javascript:void(0);"> เปลี่ยนรหัสผ่าน</a></p>
                            </div>
                            <div class="div-pass" {{ $errors->has('password') ? 'style=display:block;' : 'style=display:none;' }} >
                                <div class="form-inline mb-2">
                                    <label class="my-1 mr-2">เปลี่ยนรหัสผ่าน</label>
                                    <input type="password" class="form-control password {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="">
                                   
                                    <p class="text-danger"> กรอกรหัสผ่านใหม่</p>
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                
                                </div>
                                <div class="form-inline">
                                    <label class="my-1 mr-2">ยืนยันรหัสผ่าน</label>
                                    <input type="password" class="form-control password {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" value="">
                                    <p class="text-danger"> กรอกรหัสผ่านยืนยัน</p>
                                    @if ($errors->has('password_confirmation'))
                                        <div class="invalid-feedback">
                                                {{ $errors->first('password_confirmation') }}
                                        </div>
                                    @endif
                                
                                </div>
                            </div>
                        </td>
                        <td class="last">
                            <div class="form-inline">
                                <label class="my-1 mr-2">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control d-inline-block" maxlength="10" name="phone" value="{{ $user->phone }}" required>
                            </div>
                        </td>
                       
                    </tr>
                    

                </tbody>
            </table>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">บันทึก</button>
            </div>
            </form>
        </div>
    </div>


@stop
@push('script')

<script>
 $('.change-pass').on('click' , function() {
     $('.div-pass').toggle();
     if($('.password').attr('required')){
        $('.password').removeAttr('required');
     }else{
        $('.password').attr('required' , true);
     }
    

 });
</script>
@endpush

