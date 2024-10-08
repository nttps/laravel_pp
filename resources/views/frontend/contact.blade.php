@extends('layouts.frontend.home')

@section('title' , __('main.word.contact-us') .' | ' . getSetting('site_title'))

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/contact.css')}}" type="text/css">
@stop


@section('content')
    <div class="container mt-5">
         <div class="row">
            <div class="col-12">{{ Breadcrumbs::render('contact') }}</div>
            <h2 class="col-12"> {{ __('main.word.contact-us')}} <hr class="border-warning border-bottom my-0"></h2>
            <div class="container-contact">
                <div class="row contact-top">
                    <div class="map-api col-md-6 col-xs-12">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.008576954231!2d100.47358931476394!3d13.77835620038994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDQ2JzQyLjEiTiAxMDDCsDI4JzMyLjgiRQ!5e0!3m2!1sen!2sth!4v1536955072792" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                    <div class="info-contact col-md-6 col-xs-12  d-flex align-items-center">
                        <div class="col-12 d-block">
                           {!! $content->body_html !!}
                        </div>
                    </div>
                </div>
                <div class="col-12 text-contact text-center">
                        ท่านสามารถส่ง คำแนะนำ ติชม หรือ สอบถามเกี่ยวกับสินค้า และ การบริการ ความรู้เกี่ยวกับไฟฟ้าบ้านมายัง PP Electric
                        โดยกรุณากรอกรายละเอียดลงในช่องด้านล่าง  PP Electric ให้ครบถ้วน เพื่อความสะดวกรวดเร็ว ทางเราจะติดต่อกลับไปหาท่านอย่างเร็วที่สุด
                </div>
                <div class="form-contact">
                    <form action="{{ route('contact.post') }}" method="POST" class="form-inline">
                        @csrf
                        <div class="form-group d-block w-50 pr-1">
                            <label class="d-block" for="name">*ชื่อ</label>
                            <input type="text" id="name" class="w-100" name="name" placeholder="" required>
                        </div>
                        <div class="form-group d-block w-50 pl-1">
                            <label class="d-block" for="surname">*สกุล</label>
                            <input type="text" id="surname" class="w-100" name="surname" placeholder="" required>
                        </div>
                        <div class="form-group w-100 d-block mt-2">
                            <label class="d-block" for="address">*ที่อยู่</label>
                            <input type="text" id="address" class="w-100" name="address" placeholder="" required>
                        </div>
                        <div class="form-group d-block w-50 pr-1 mt-2">
                            <label class="d-block" for="telephone">*เบอร์โทรศัพท์</label>
                            <input type="text" id="telephone" class="w-100" name="telephone" placeholder="" required>
                        </div>
                        <div class="form-group d-block w-50 pl-1 mt-2">
                            <label class="d-block" for="email">*อีเมล์</label>
                            <input type="email" id="email" class="w-100" name="email" placeholder="" required>
                        </div>
                        <div class="form-group w-100 d-block mt-2">
                            <label class="d-block" for="description">*รายละเอียด</label>
                            <textarea id="description" class="w-100" name="description" rows="6" placeholder="" required></textarea>
                        </div>
                        <div class="form-group d-block w-50 pr-1 mb-2">
                            <label class="d-block">*ติดต่อกลับโดย</label>
                            <input type="radio" name="contact_by" value="email" required>*อีเมล์ <input type="radio" name="contact_by" value="telephone">*เบอร์โทรศัพท์
                        </div>
                        <div class="form-group d-block w-100">
                            <button type="submit" class="btn btn-warning text-white w-50">กดส่งข้อความ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('layouts.frontend.partials.relate-product') --}}
@stop

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js" type="text/javascript"></script>
@endpush
