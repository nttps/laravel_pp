@extends('layouts.frontend.home')


    <!-- TITLE TEXT -->
@section('title', 'เข้าสู่ระบบ')

@section('css')
@endsection


@section('content')
    <!-- INCLUDE CONTENT -->
    <section class="container-fluid" style="margin-bottom:70px;margin-top:50px;padding-bottom:50px;background-color:#eff0f5;">
        <div class="container login-content">
            <div class="row">
                <div class="col-md-12 text-center col-sm-12">
                    <p class="title-login ">คุณยังไม่ใส่รหัสยืนยัน OTP</p>  
                </div>  
               
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="row form-login">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('update.confirm_number') }}">
                                    {{ csrf_field() }}
                                @if(Auth::user()->phone == '')
                                    <div class="form-group">
                                        <div class="text-danger"> คุณยังไม่ได้กรอกเบอร์โทรศัพท์ กรุณากรอกเบอร์โทรศัพท์เพื่อรับรหัส OTP ในการยืนยันตัวตน</div>
                                        <label for="exampleInputEmail1">เบอร์โทรศัพท์</label>
                                        <input type="text" class="form-control{{ $errors->has('tel_number') ? ' is-invalid' : '' }}" name="tel_number" value="{{ old('tel_number') }}" required placeholder="เบอร์โทรศัพท์">
                                
                                        @if ($errors->has('tel_number') == true)
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('tel_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>   
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"></label>
                                        <button type="submit" class="btn btn-login" style="width:100%;margin-bottom:10px;">ยืนยันเบอร์โทรศัพท์</button>
                                    </div> 
                                @else 
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">เบอร์โทรศัพท์</label>
                                        <input type="text" class="form-control{{ $errors->has('tel_number') ? ' is-invalid' : '' }}" name="tel_number" value="{{ Auth::user()->phone ?? old('tel_number') }}" required placeholder="เบอร์โทรศัพท์">
                                
                                        @if ($errors->has('tel_number') == true)
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('tel_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>   
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"></label>
                                        <button type="submit" class="btn btn-login" style="width:100%;margin-bottom:10px;">ส่งรหัสผ่านอีกครั้ง</button>
                                    </div> 
                                @endif
                            </form>
                            <form method="POST" action="{{ route('confirm_number') }}">
                            {{ csrf_field() }}

                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">รหัสยืนยัน OTP</label>
                                    <input type="text" class="form-control{{ $errors->has('number_confirm') ? ' is-invalid' : '' }}" name="number_confirm" value="{{ old('number_confirm') }}" required placeholder="กรุณาระบุรหัส OTP *">
                           
                                    @if ($errors->has('number_confirm') == true)
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('number_confirm') }}</strong>
                                        </span>
                                    @endif
                                </div>   
                                <div class="form-group">
                                    <label for="exampleInputEmail1"></label>
                                    <button type="submit" class="btn btn-login" style="width:100%;margin-bottom:10px;">ยืนยันรหัส OTP</button>
                                </div>                          
                        </div>                       
                        </form>
                    </div>
                    
                </div>
                
            </div>
             
        </div>
              
           
    </section>


@endsection

@section('script')
    <!-- INCLUDE CUSTOM SCRIPT -->
    <script>
              
    </script>
@endsection

