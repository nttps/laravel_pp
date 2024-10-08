@extends('layouts.customer.master')

@section('title.page' , 'HISTORY')

@section('content')

@php 
    $country_data = isset($addresses->country) ? $addresses->country : '';
    $state_data = isset($addresses->state) ? $addresses->state : '';
    $city_data = isset($addresses->city) ? $addresses->city : '';
    $address_2_data = isset($addresses->address_2) ? $addresses->address_2 : '';
   

@endphp
<h5><a href="{{ route('customer.history.index')}}">{{ __('main.word.home')}}</a> > {{ __('main.word.Shipping Address')}}</h5>

    <div class="card ">
        <div class="card-header bg-white">
            <h5 class="mb-0 float-left text-dark">ข้อมูลสถานที่จัดส่งสินค้า</h5>
        </div>
        <div class="card-body bg-transparent">
            <form action="@if(!isset($addresses)) {{route('customer.address.new')}} @else  {{route('customer.address.edit' , $addresses->id )}} @endif" method="POST">
                                        
                @csrf
                @if(isset($addresses))
                    @method('PUT')
                @endif
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">ชื่อ<span class="text-danger">*</span></label>
                        <input type="text" name="firstname" class="form-control" id="inputEmail4" placeholder="กรอกชื่อของคุณ" value="{{ isset($addresses->first_name) ? $addresses->first_name : old('firstname') }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">นามสกุล<span class="text-danger">*</span></label>
                        <input type="text" name="lastname" class="form-control" id="inputPassword4"  value="{{ isset($addresses->last_name) ? $addresses->last_name : old('last_name') }}" placeholder="กรอกนามสกุลของคุณ" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Address1" class="mb-0">ที่อยู่ 1<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="address_1" id="Address1" aria-describedby="emailHelp"  value="{{ isset($addresses->address_1) ? $addresses->address_1 : old('address_1') }}" placeholder="กรอกที่อยู่ของคุณ" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">ประเทศ<span class="text-danger">*</span></label>
                        <select class="form-control" id="country" required>
                            @foreach ($countries as $country)
                                <option value="{{ $country->country_code }}" @if($country_data == $country->country_code) selected @endif>{{ $country->country_name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="country" id="courntry_val" value="{{ $country_data }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">จังหวัด<span class="text-danger">*</span></label>
                        <select class="form-control" id="state" required>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->code }}" @if($state_data == $province->name_th) selected @endif>{{ $province->name_th }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="state" id="state_val" value="{{ $state_data }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">เขต/อำเภอ<span class="text-danger">*</span></label>
                        <select class="form-control" id="city" required>
                            @foreach ($amphures as $amphure)
                                <option value="{{ $amphure->code }}" @if($city_data == $amphure->name_th) selected @endif>{{ $amphure->name_th }}</option>
                            @endforeach   
                        </select>
                        <input type="hidden" name="city" id="city_val" value="{{ $city_data }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">แขวง/ตำบล<span class="text-danger">*</span></label>
                        <select class="form-control" id="address_3" required>
                            @foreach ($districts as $district)
                                <option value="{{ $district->name_th }}" @if($address_2_data == $district->name_th) selected @endif>{{ $district->name_th }}</option>
                            @endforeach     
                        </select>
                        <input type="hidden" name="address_3" id="address_3_val" value="{{ $address_2_data }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="postcode">รหัสไปรษณีย์<span class="text-danger">*</span></label>
                        <input type="text" name="postcode" class="form-control" id="postcode" placeholder="รหัสไปรษณีย์" value="{{ isset($addresses->postcode) ? $addresses->postcode : old('postcode') }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">อีเมล</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="อีเมล" value="{{ isset($addresses->email) ? $addresses->email : old('email') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="phone">เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="เบอร์โทรศัพท์" value="{{ isset($addresses->phone) ? $addresses->phone : old('phone') }}">
                    </div>
                </div>
                <div class="form-row text-center">
                    <button type="submit" class="btn btn-primary">แก้ไขที่อยู่</button>
                </div>
            </form>
        </div>
    </div>

@stop


@push('script')
    <script>

        var getCountry = $('#country').val();
        var state_val = $('#state_val').val();
        var url = '{{ route('api.getaddress') }}';
        $('#courntry_val').val(getCountry);
        if(getCountry == 'TH'){
                var c = {
                    _token: '{!! csrf_token() !!}',
                    id: getCountry,
                    type: 'getProvince'
                };
            $.post(url, c, function (t) {
                if(t.status == 'success'){
                    var toAppend = '<option value="">เลือกจังหวัด</option>';
                    $.each(t.data,function(i,o){
                        var selected = (o.name_th === state_val) ? 'selected' :'';
                        toAppend += '<option value="'+o.id+'" data-name="'+o.name_th+'" '+selected+'>'+o.name_th+'</option>';
                    });

                    $('#state').empty().append(toAppend);
                }
                
            });
        }
        $('.open-add-address').on( 'click' , function(){
           $('.content-add-address').slideDown('fast');
           $(this).parent().hide();
        });

        $('#country').on('change' , function(){
            var   c = {
                    _token: '{!! csrf_token() !!}',
                    id: $(this).val(),
                    type: 'getProvince'
                };
            $.post(url, c, function (t) {

            });
        });
        $('#state').on('change' , function(){
            var state = $('#state').find(':selected').data('name');
            $('#state_val').val(state);
            var    c = {
                    _token: '{!! csrf_token() !!}',
                    id: $(this).val(),
                    type: 'getAmphures'
                };
            $.post(url, c, function (t) {
                if(t.status == 'success'){
                    var toAppend = '<option value="">เลือกเขต / อำเภอ</option>';
                    $.each(t.data,function(i,o){
                        toAppend += '<option value="'+o.id+'" data-name="'+o.name_th+'">'+o.name_th+'</option>';
                    });

                    $('#city').empty().append(toAppend);
                }
            });
        });
        $('#city').on('change' , function(){
            var city = $('#city').find(':selected').data('name');
            $('#city_val').val(city);
            var    c = {
                    _token: '{!! csrf_token() !!}',
                    id: $(this).val(),
                    type: 'getTumbon'
                };
            $.post(url, c, function (t) {
                if(t.status == 'success'){
                    var toAppend = '<option value="">เลือกแขวง / ตำบล</option>';
                    $.each(t.data,function(i,o){
                        toAppend += '<option value="'+o.id+'" data-name="'+o.name_th+'" data-postcode="'+o.zip_code+'">'+o.name_th+'</option>';
                    });

                    $('#address_3').empty().append(toAppend);
                }
            });
        });
        $('#address_3').on('change' , function(){
            var address_3 = $('#address_3').find(':selected').data('name');
            $('#address_3_val').val(address_3);
            var postcode = $('#address_3').find(':selected').data('postcode');
            $('#postcode').val(postcode);
        });
    </script>
@endpush