@extends('layouts.frontend.home')

@section('title' , 'CART')

@section('custom-css')
    <link rel="stylesheet" href="{{ mix('css/cart.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ mix('css/checkout.css')}}" type="text/css">

    <style>
        .datpayment-form {
  font-size: 15px;
  background: #fff;
  color: #333333;
  border-radius: 10px;
  border: 1px solid #ccc;
  padding: 10px;
  margin: auto; }

.dpf-title {
  text-align: center;
  font-size: 1.5em;
  font-weight: bold; }

.dpf-input-row {
  margin: 20px auto; }
  .dpf-input-row:after {
    content: "";
    display: table;
    clear: both; }
  .dpf-input-row .dpf-input-container {
    text-align: center;
    position: relative; }
    .dpf-input-row .dpf-input-container.with-icon .dpf-input {
      padding-left: 40px; }
    .dpf-input-row .dpf-input-container.dpf-row-valid .fa {
      color: #188a1e; }
    .dpf-input-row .dpf-input-container.dpf-row-valid .dpf-input {
      opacity: 1;
      border: 1px solid rgba(24, 138, 30, 0.35);
      -webkit-box-shadow: 0px 1px 0px rgba(24, 138, 30, 0.25), inset 0px 3px 6px rgba(24, 138, 30, 0.25);
              box-shadow: 0px 1px 0px rgba(24, 138, 30, 0.25), inset 0px 3px 6px rgba(24, 138, 30, 0.25); }
    .dpf-input-row .dpf-input-container.dpf-row-invalid {
      color: #ff2525; }
      .dpf-input-row .dpf-input-container.dpf-row-invalid .dpf-input {
        opacity: 1;
        color: #ff2525;
        border: 1px solid rgba(255, 37, 37);
        
        }
  .dpf-input-row .dpf-input-column {
    width: 50%;
    display: inline-block;
    float: left;
    padding: 0 10px;
    -webkit-box-sizing: border-box;
            box-sizing: border-box; }
    .dpf-input-row .dpf-input-column .dpf-input {
      margin: auto;
      width: 65%; }

.dpf-input-label {
  display: block;
  font-size: 1.2em;
  text-align: center;
  max-width: 100%;
  font-weight: bold; }

.dpf-input-icon {
  width: 20%;
  position: absolute;
  font-size: 1.5em;
  top: 8px;
  left: 20px; }

.dpf-input {
  display: block;
  font-size: 1.2em;
  width: 80%;
  margin: auto;
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px 8px 10px 8px;
  border-radius: 5px;
  border: 1px solid rgba(0, 0, 0, 0.5);
  opacity: .8; }
  .dpf-input:hover, .dpf-input:focus {
    -webkit-transition: all 0.2s;
    transition: all 0.2s;
    opacity: 1;
    -webkit-box-shadow: 0px 1px 0px rgba(255, 255, 255, 0.25), inset 0px 3px 6px rgba(0, 0, 0, 0.25);
            box-shadow: 0px 1px 0px rgba(255, 255, 255, 0.25), inset 0px 3px 6px rgba(0, 0, 0, 0.25); }

.accepted-cards-logo {
  background-image: url("data:image/png;base64,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");
  width: 200px;
  height: 40px;
  display: block;
  margin: auto; }

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
            <div class="col-12">{{ Breadcrumbs::render('checkout') }}</div>
            <div class="col-6">
                <h2 class="border-warning px-0 mb-0"> {{ __('main.word.Checkout')}} </h2>
            </div>
            <div class="col-6 text-right">
                <div class="btn-checkout">
                    <a class="btn btn-warning btn-sm text-white" href="{{ route('cart') }}">{{ __('main.word.Back')}}</a>
                </div>
            </div>
        </div>
        <hr class="border-warning border-bottom mb-4 mt-0">
        <div class="row">
            <div class="col-md-8 col-12 order-md-1 order-1">
                <div class="col-12">
                    <h5 class="text-dark px-0 mb-0"> {{ __('main.word.Shipping Address')}} </h5>
                    <div class="checkout-address">

                        @forelse ($addresses as $address)
                            <div class="default-address">
                                {{ $address->fullAddress }}
                            </div>

                        @empty
                            <div class="alert alert-danger" role="alert">คุณยังไม่ได้เพิ่มที่อยู่ในการจัดส่ง กรุณา <a href="javascript:void(0);" class="alert-link open-add-address">คลิกที่นี่</a>  เพื่อเพิ่มข้อมูลการจัดส่ง</div>
                            <div class="content-add-address card mb-3" style="display:none;">
                                <div class="card-body">
                                    <form action="{{  route('customer.address.new') }}" method="POST">
                                        
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">{{ __('main.word.Name')}}<span class="text-danger">*</span></label>
                                                <input type="text" name="firstname" class="form-control" id="inputEmail4" placeholder="กรอกชื่อของคุณ" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">{{ __('main.word.Surname')}}<span class="text-danger">*</span></label>
                                                <input type="text" name="lastname" class="form-control" id="inputPassword4" placeholder="กรอกนามสกุลของคุณ" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Address1" class="mb-0">ที่อยู่ 1<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="address_1" id="Address1" aria-describedby="emailHelp" placeholder="กรอกที่อยู่ของคุณ" required>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">ประเทศ<span class="text-danger">*</span></label>
                                                <select class="form-control" id="country" required>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->country_code }}" @if($country->country_code == 'TH') selected @endif>{{ $country->country_name }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="country" id="courntry_val" value="">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">จังหวัด<span class="text-danger">*</span></label>
                                                <select class="form-control" id="state" required></select>
                                                <input type="hidden" name="state" id="state_val" value="">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">เขต/อำเภอ<span class="text-danger">*</span></label>
                                                <select class="form-control" id="city" required></select>
                                                <input type="hidden" name="city" id="city_val" value="">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">แขวง/ตำบล<span class="text-danger">*</span></label>
                                                <select class="form-control" id="address_3" required></select>
                                                <input type="hidden" name="address_3" id="address_3_val" value="">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="postcode">รหัสไปรษณีย์<span class="text-danger">*</span></label>
                                                <input type="text" name="postcode" class="form-control" id="postcode" placeholder="รหัสไปรษณีย์" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email">{{ __('main.word.Email')}}</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="{{ __('main.word.Email')}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="phone">เบอร์โทรศัพท์</label>
                                                <input type="text" class="form-control" name="phone" id="phone" placeholder="เบอร์โทรศัพท์">
                                            </div>
                                        </div>
                                        <div class="form-row text-center">
                                            <button type="submit" class="btn btn-primary">เพิ่มที่อยู่</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                <form action="{{ route('checkout.store') }}" id="checkout-form" method="POST" class="form-cart">
                        @csrf
                <div class="col-12">
                    <hr class="border-primary border-bottom mt-2 mb-2">
                    <h5 class="text-dark px-0 mb-0"> {{ __('main.word.SHIPPING METHOD')}}</h5>
                    <div class="row">
                        <div class="col-12 contain-shipping text-center">
                            @if($shippingzone == NULL)
                                <h4> กรุณากรอกที่อยู่ </h4>
                            @else 
                                @if($shippingzone->rules()->first()->method == 'shipping-choice')

                                    <h6 class="mb-3 mt-3"><strong>- {{ $shippingzone->rules()->first()->name }}</strong></h6>
                                    @foreach($shippingrule['name'] as $key=> $rule)
                                        <label>
                                            <input type="radio" name="choice-price" value="{{ $rule }}" data-price="{{ $shippingrule['price'][$key]}}" required />
                                            <div class="box-shipping">
                                            <span>{{ $rule }}</span>
                                            </div>
                                        </label>
                                    @endforeach

                                @elseif($shippingzone->rules()->first()->method == 'shipping-order')
                                
                                    @foreach ($shippingrule['price_order'] as $key => $price)
                                        @if($shippingrule['upto_order'][$key] == '*')
                                            @if ($total_cart > $shippingrule['from_order'][$key])
                                                @php 
                                                    $shipping_price_condi = $price; 
                                                    $text_price = number_format($price ,2). __('main.word.currency');
                                                    if($price== 0){
                                                        $text_price = __('main.word.Free');
                                                    }
                                                
                                                @endphp
                                                <p style="font-size:18px;color:red;" class="mb-3 mt-3">- กรณียอดสั่งซื้อมากกว่า {{ $shippingrule['from_order'][$key] }} {{ __('main.word.currency')}} บริษัทฯ ขอสงวนสิทธิ์คิดค่าบริการจัดส่ง {{ $text_price }} ต่อยอดการสั่งซื้อ 1 บิล</p>
                                                
                                            @endif
                                        @else
                                            @if ($total_cart > $shippingrule['from_order'][$key] && $total_cart <= $shippingrule['upto_order'][$key] )
                                                @php $shipping_price_condi = $price; @endphp
                                                <p style="font-size:18px;color:red;" class="mb-3 mt-3">- กรณียอดสั่งซื้อต่ำกว่า {{ $shippingrule['upto_order'][$key]+1 }} {{ __('main.word.currency')}} บริษัทฯ ขอสงวนสิทธิ์คิดค่าบริการจัดส่ง {{ number_format($price ,2) }} {{ __('main.word.currency')}} ต่อยอดการสั่งซื้อ 1 บิล</p>
                                            @endif
                                        @endif
                                    @endforeach
                                @else 
                                    <h6 class="mb-3 mt-3"><strong>- {{ $shippingzone->rules()->first()->name }}</strong></h6>
                                @endif
                            @endif
                            
                           
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <hr class="border-primary border-bottom mt-2 mb-2">
                    <h5 class="text-dark px-0 mb-0"> {{ __('main.word.Payment')}}</h5>
                    <div class='payments'>

                        <div class='payment-method col-12 col-md-3 active' data-method="BANK-DEPOSIT">
                          บัญชีธนาคาร
                          <svg class="svg-cash" viewBox="0 0 512 512">
                            <path class="svg-cash-hand" d="M106.908,147h56.33h96.607c22.139,0,31.855-0.384,37.188-0.055c5.463,0.334,10.715,2.463,17.723,7.55 c7.719,5.749,21.205,9.042,32.086,20.779c10.906,11.666,32.221,35.637,37.277,42.137c5.01,6.46,32.637,72.549-38.697,77.367 c-71.357,4.78-125.639-8.428-137.912-8.914c-12.289-0.485-31.773-5.975-51.424-10.815c-38.977-9.601-36.828-17.492-57.422-19.182 c-20.619-1.691-29.092-3.55-29.092-3.55L79.035,147H106.908z" />
                            <path class="svg-cash-money" d="M426.537,100.903c0,0-49.463,56.124-93.143,92.677c-67.695,56.555-160.115,96.963-160.115,96.963 s36.949,80.367,46.809,121.462c53.283-30.399,150.305-93.938,189.299-124.44c35.197-27.506,95.736-99.566,95.736-99.566 L426.537,100.903z" />
                            <path class="svg-cash-money-inner" d="M297.721,266.825c0,22.905,18.574,41.479,41.48,41.479 c22.908,0,41.482-18.574,41.482-41.479c0-22.919-18.574-41.481-41.482-41.481C316.295,225.344,297.721,243.906,297.721,266.825" />
                            <path class="svg-cash-money-inner" d="M427.875,171.335c7.904,10.497,21.02,15.349,29.307,10.849 c8.346-4.563,8.65-16.735,0.715-27.284c-7.924-10.507-21.049-15.327-29.318-10.825 C420.305,148.616,419.969,160.839,427.875,171.335" />
                            <path class="svg-cash-money-inner" d="M218.041,334.839c6.117,11.018,19.02,17.316,28.619,14.096 c9.697-3.181,12.477-14.663,6.301-25.642c-6.143-11.059-19.066-17.317-28.656-14.179 C214.619,312.355,211.881,323.83,218.041,334.839" />
                            <path class="svg-cash-hand" d="M258.408,177.271c0,0,11.541,20.897,27.688,23.333c16.107,2.376,47.537,13.668,55.719,14.892 c8.143,1.148,27.1,5.382,27.1,21.029c0,8.212-5.717,34.513-27.863,34.513c-24.717,0-52.084-17.135-60.707-20.498 c-8.588-3.383-34.088-12.718-45.455-9.574c-11.262,3.09-35.111,2.374-50.895,0.941c-15.918-1.473-46.842-9.115-57.725-17.059 c0,0-18.08-9.965,20.4-28.777C185.225,177.282,242.934,162.21,258.408,177.271" />
                            <path class="svg-cash-thumb" d="M258.408,177.271c0,0,11.541,20.897,27.688,23.333 c16.107,2.376,47.537,13.668,55.719,14.892c8.143,1.148,27.1,5.382,27.1,21.029c0,8.212-5.717,34.513-27.863,34.513 c-25.951,0-52.084-17.135-60.707-20.498c-8.588-3.383-34.088-12.718-45.455-9.574c-11.262,3.09-35.111,2.374-50.895,0.941 c-15.918-1.473-46.842-9.115-57.725-17.059c0,0-18.08-9.965,20.4-28.777C185.225,177.282,242.934,162.21,258.408,177.271z" />
                            <path class="svg-cash-hand" d="M265.518,168.38l-16.447,17.848c0,0-48.854,11.748-74.717,19.733c-25.797,7.985-40.836,11.747-40.836,11.747 s-8.441,16.883-14.053,19.195c-5.65,2.386-20.699-8.41-10.391-31.398c10.391-23.032,20.254-46.032,77.559-47.435 c57.232-1.419,73.191-7.571,78.396,0.425C270.217,166.511,265.518,168.38,265.518,168.38" />
                            <path class="svg-cash-shirt-inner" d="M57.346,142c-29.242,42-29.242,135-29.242,135H90V142H57.346z" />
                            <path class="svg-cash-shirt-outer" d="M7,122v165.564c16,8.649,63,10.37,63,10.37V121.644c0,0-45,0.484-63,0" />
                          </svg>
                        </div>

                        @if(getSetting($value = 'site_payment') == 'on')
                            <div class='payment-method col-12 col-md-3' data-method="QR-CODE">
                            <span class="mb-2"> QR CODE</span> 
                                
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <g>
                            <g>
                                <rect x="51.2" y="51.2" width="51.2" height="51.2"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M358.4,0v25.6h-25.6v25.6h25.6v102.4H384v25.6h-25.6v25.6H384h25.6v-51.2h76.8v25.6H512v-25.6V0H358.4z M486.4,128H384
                                    V25.6h102.4V128z"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <rect x="409.6" y="51.2" width="51.2" height="51.2"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <rect x="51.2" y="409.6" width="51.2" height="51.2"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <rect x="358.4" y="358.4" width="25.6" height="25.6"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <rect x="230.4" y="486.4" width="25.6" height="25.6"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <rect x="256" y="384" width="25.6" height="25.6"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <rect x="256" y="435.2" width="25.6" height="25.6"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <rect x="486.4" y="307.2" width="25.6" height="25.6"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <rect y="307.2" width="25.6" height="25.6"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <rect y="179.2" width="25.6" height="25.6"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <polygon points="281.6,25.6 281.6,51.2 230.4,51.2 230.4,76.8 307.2,76.8 307.2,51.2 307.2,25.6 		"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M486.4,204.8v25.6h-51.2V256h-76.8v-25.6h-25.6V256h-51.2v25.6h76.8v25.6h-51.2h-25.6v-25.6H256v25.6h-25.6v-25.6h-25.6
                                    v25.6h-25.6v25.6h51.2v25.6H256v-25.6h51.2v25.6h-25.6V384h25.6v51.2h25.6v25.6h25.6v-25.6h76.8V384h25.6v-25.6h-25.6v-51.2H384
                                    v-25.6h51.2v25.6h25.6v-25.6h25.6V256H512v-25.6v-25.6H486.4z M409.6,332.8v76.8h-76.8v-76.8H409.6z"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <polygon points="332.8,153.6 307.2,153.6 307.2,179.2 281.6,179.2 281.6,204.8 281.6,230.4 307.2,230.4 307.2,204.8 332.8,204.8 
                                    332.8,179.2 358.4,179.2 358.4,153.6 		"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <rect x="281.6" y="486.4" width="51.2" height="25.6"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <rect x="204.8" y="25.6" width="25.6" height="25.6"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <rect x="409.6" y="204.8" width="25.6" height="25.6"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <rect x="435.2" y="179.2" width="25.6" height="25.6"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <rect x="102.4" y="307.2" width="25.6" height="25.6"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M153.6,486.4V384h25.6v-25.6v-25.6h-25.6v25.6H76.8v-25.6H51.2H25.6v25.6H0V512h153.6h51.2v-25.6H153.6z M128,486.4H25.6
                                    V384H128V486.4z"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <rect x="153.6" y="153.6" width="25.6" height="25.6"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M179.2,0h-25.6H0v153.6h25.6v25.6h25.6v-25.6h25.6v25.6h25.6v-25.6h51.2v-51.2h25.6V76.8h-25.6V25.6h25.6h25.6V0H179.2z
                                    M128,128H25.6V25.6H128V128z"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <rect x="307.2" y="76.8" width="25.6" height="25.6"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <rect x="256" width="25.6" height="25.6"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M307.2,153.6V128h-25.6v-25.6H256V128h-51.2v-25.6h-25.6V128v25.6h25.6v51.2H128v-25.6h-25.6v25.6H25.6v25.6h51.2V256H0
                                    v25.6h76.8v25.6h25.6v-25.6H128v25.6h25.6v-25.6h51.2V256h-25.6v-25.6h25.6h25.6V256H256h25.6v-25.6H256v-25.6h-25.6v-51.2H307.2z
                                    M153.6,256h-51.2v-25.6h51.2V256z"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <polygon points="230.4,409.6 230.4,384 230.4,358.4 204.8,358.4 204.8,384 179.2,384 179.2,409.6 204.8,409.6 204.8,435.2 
                                    179.2,435.2 179.2,460.8 230.4,460.8 230.4,435.2 256,435.2 256,409.6 		"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <polygon points="460.8,460.8 460.8,435.2 435.2,435.2 435.2,460.8 358.4,460.8 358.4,486.4 409.6,486.4 409.6,512 435.2,512 
                                    435.2,486.4 486.4,486.4 486.4,512 512,512 512,486.4 512,460.8 		"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <polygon points="486.4,358.4 486.4,384 460.8,384 460.8,409.6 512,409.6 512,384 512,358.4 		"/>
                            </g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        </svg>
                            </div>
                            <div class='payment-method col-12 col-md-3' data-method="BAR-CODE">
                            BAR CODE
                        
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve">
                        <g>
                            <g>
                                <g>
                                    <rect y="85" width="40.8" height="442"/>
                                    <rect x="61.2" y="85" width="27.2" height="326.4"/>
                                    <rect x="136" y="85" width="27.2" height="326.4"/>
                                    <rect x="183.6" y="85" width="40.8" height="326.4"/>
                                    <rect x="102" y="85" width="20.4" height="326.4"/>
                                    <rect x="238" y="85" width="20.4" height="326.4"/>
                                    <polygon points="376.264,85 333.2,85 333.2,411.4 376.264,411.4 388.736,411.4 414.8,411.4 414.8,85 388.736,85 			"/>
                                    <rect x="272" y="85" width="34" height="326.4"/>
                                    <rect x="523.6" y="85" width="40.8" height="326.4"/>
                                    <polygon points="478.264,85 442,85 442,411.4 478.264,411.4 485.064,411.4 503.2,411.4 503.2,85 485.064,85 			"/>
                                    <rect x="578" y="85" width="34" height="442"/>
                                </g>
                                <g>
                                    <path d="M112.152,490.491c0,23.276-8.636,36.122-23.8,36.122c-13.376,0-22.433-12.532-22.644-35.176
                                        c0-22.957,9.901-35.591,23.8-35.591C103.938,455.838,112.152,468.69,112.152,490.491z M74.977,491.538
                                        c0,17.802,5.474,27.907,13.899,27.907c9.479,0,14.008-11.057,14.008-28.54c0-16.85-4.318-27.907-13.899-27.907
                                        C80.879,462.998,74.977,472.899,74.977,491.538z"/>
                                    <path d="M141.875,465.637h-0.211l-11.9,6.419l-1.795-7.052l14.953-8.01h7.902v68.456h-8.949V465.637z"/>
                                    <path d="M176.868,525.45v-5.685l7.262-7.058c17.483-16.64,25.378-25.486,25.486-35.809c0-6.95-3.373-13.376-13.586-13.376
                                        c-6.215,0-11.376,3.155-14.538,5.794l-2.951-6.528c4.74-4.005,11.485-6.95,19.387-6.95c14.742,0,20.958,10.105,20.958,19.904
                                        c0,12.634-9.166,22.855-23.596,36.754l-5.481,5.059v0.204h30.75v7.691L176.868,525.45L176.868,525.45z"/>
                                    <path d="M234.178,514.814c2.632,1.686,8.738,4.318,15.164,4.318c11.907,0,15.592-7.575,15.484-13.267
                                        c-0.109-9.581-8.745-13.695-17.7-13.695h-5.161v-6.943h5.161c6.739,0,15.273-3.482,15.273-11.587
                                        c0-5.474-3.475-10.316-12.009-10.316c-5.481,0-10.744,2.421-13.695,4.529l-2.414-6.739c3.577-2.638,10.533-5.263,17.904-5.263
                                        c13.478,0,19.591,8.004,19.591,16.32c0,7.058-4.216,13.063-12.641,16.116v0.204c8.425,1.686,15.273,8.01,15.273,17.592
                                        c0,10.948-8.534,20.536-24.963,20.536c-7.684,0-14.423-2.414-17.796-4.631L234.178,514.814z"/>
                                    <path d="M315.717,525.45v-18.639h-31.804v-6.113l30.539-43.71h10.01v42.554h9.581v7.262h-9.581v18.639h-8.745V525.45z
                                        M315.717,499.548v-22.855c0-3.577,0.109-7.16,0.32-10.744h-0.32c-2.108,4.005-3.794,6.95-5.685,10.112l-16.748,23.276v0.211
                                        L315.717,499.548L315.717,499.548z"/>
                                    <path d="M383.044,464.794h-26.119l-2.638,17.592c1.578-0.211,3.053-0.428,5.583-0.428c5.263,0,10.533,1.163,14.742,3.686
                                        c5.372,3.053,9.792,8.949,9.792,17.592c0,13.376-10.635,23.378-25.486,23.378c-7.48,0-13.79-2.108-17.061-4.209l2.319-7.058
                                        c2.842,1.686,8.425,3.794,14.634,3.794c8.745,0,16.225-5.685,16.225-14.851c-0.109-8.847-6.004-15.157-19.693-15.157
                                        c-3.896,0-6.95,0.422-9.479,0.734l4.42-32.864h32.749v7.793H383.044z"/>
                                    <path d="M436.356,463.529c-1.89-0.109-4.318,0-6.95,0.422c-14.538,2.421-22.229,13.063-23.8,24.33h0.313
                                        c3.264-4.325,8.949-7.902,16.538-7.902c12.111,0,20.645,8.745,20.645,22.12c0,12.532-8.534,24.113-22.753,24.113
                                        c-14.64,0-24.228-11.37-24.228-29.172c0-13.478,4.848-24.113,11.587-30.852c5.685-5.583,13.267-9.058,21.91-10.112
                                        c2.734-0.422,5.052-0.524,6.732-0.524v7.575H436.356z M433.724,503.023c0-9.792-5.583-15.694-14.11-15.694
                                        c-5.583,0-10.744,3.475-13.267,8.425c-0.639,1.047-1.054,2.414-1.054,4.107c0.211,11.268,5.372,19.591,15.062,19.591
                                        C428.352,519.452,433.724,512.815,433.724,503.023z"/>
                                    <path d="M496.828,456.994v6.106l-29.804,62.349h-9.581l29.696-60.554v-0.211h-33.49v-7.691L496.828,456.994L496.828,456.994z"/>
                                    <path d="M506.654,508.076c0-8.629,5.161-14.742,13.586-18.319l-0.109-0.32c-7.582-3.577-10.853-9.479-10.853-15.375
                                        c0-10.853,9.166-18.224,21.168-18.224c13.267,0,19.904,8.323,19.904,16.85c0,5.794-2.842,12.009-11.268,16.007v0.32
                                        c8.534,3.366,13.797,9.37,13.797,17.694c0,11.9-10.214,19.904-23.276,19.904C515.284,526.606,506.654,518.078,506.654,508.076z
                                        M543.517,507.654c0-8.323-5.8-12.328-15.062-14.953c-8.01,2.319-12.328,7.582-12.328,14.11
                                        c-0.313,6.95,4.957,13.056,13.695,13.056C538.145,519.867,543.517,514.706,543.517,507.654z M518.031,473.423
                                        c0,6.848,5.161,10.533,13.056,12.641c5.896-2.006,10.424-6.215,10.424-12.43c0-5.474-3.257-11.166-11.58-11.166
                                        C522.24,462.475,518.031,467.527,518.031,473.423z"/>
                                </g>
                            </g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        </svg>
                        
                            </div>
                            <div class='payment-method col-12 col-md-3' data-method="CREDIT-CARD">
                            Credit Card
                        
                            <svg class="svg-visa" viewBox="0 0 512 512">
                                <path class="svg-visa-border" d="M482.722,103.198c13.854,0,25.126,11.271,25.126,25.126v257.9c0,13.854-11.271,25.126-25.126,25.126H30.99 c-13.854,0-25.126-11.271-25.126-25.126v-257.9c0-13.854,11.271-25.126,25.126-25.126H482.722 M482.722,98.198H30.99 c-16.638,0-30.126,13.488-30.126,30.126v257.9c0,16.639,13.488,30.126,30.126,30.126h451.732 c16.639,0,30.126-13.487,30.126-30.126v-257.9C512.848,111.686,499.36,98.198,482.722,98.198L482.722,98.198z" />
                                <polygon class="svg-visa-letter" points="190.88,321.104 212.529,194.022 247.182,194.022 225.494,321.104 190.88,321.104" />
                                <path class="svg-visa-letter" d="M351.141,197.152c-6.86-2.577-17.617-5.339-31.049-5.339c-34.226,0-58.336,17.234-58.549,41.94 c-0.193,18.256,17.21,28.451,30.351,34.527c13.489,6.231,18.023,10.204,17.966,15.767c-0.097,8.518-10.775,12.403-20.737,12.403 c-13.857,0-21.222-1.918-32.599-6.667l-4.458-2.016l-4.864,28.452c8.082,3.546,23.043,6.618,38.587,6.772 c36.417,0,60.042-17.035,60.313-43.423c0.136-14.447-9.089-25.446-29.071-34.522c-12.113-5.882-19.535-9.802-19.458-15.757 c0-5.281,6.279-10.93,19.846-10.93c11.318-0.179,19.536,2.292,25.912,4.869l3.121,1.468L351.141,197.152L351.141,197.152z" />
                                <path class="svg-visa-letter" d="M439.964,194.144h-26.766c-8.295,0-14.496,2.262-18.14,10.538l-51.438,116.47h36.378 c0,0,5.931-15.66,7.287-19.1c3.974,0,39.305,0.059,44.363,0.059c1.027,4.447,4.206,19.041,4.206,19.041h32.152L439.964,194.144 L439.964,194.144z M397.248,276.062c2.868-7.326,13.8-35.53,13.8-35.53c-0.194,0.339,2.849-7.36,4.593-12.132l2.346,10.959 c0,0,6.628,30.336,8.022,36.703H397.248L397.248,276.062z" />
                                <path class="svg-visa-letter" d="M161.828,194.114l-33.917,86.667l-3.624-17.607c-6.299-20.312-25.971-42.309-47.968-53.317l31.009,111.149 l36.649-0.048l54.538-126.844H161.828L161.828,194.114z" />
                                <path class="svg-visa-corner" d="M96.456,194.037H40.581l-0.426,2.641c43.452,10.523,72.213,35.946,84.133,66.496l-12.133-58.41 C110.062,196.716,103.976,194.318,96.456,194.037L96.456,194.037z" />
                            </svg>
                        
                            <svg class="svg-master" viewBox="0 0 512 512">
                                <path class="svg-master-border" d="M482.722,103.198c13.854,0,25.126,11.271,25.126,25.126v257.9c0,13.854-11.271,25.126-25.126,25.126H30.99 c-13.854,0-25.126-11.271-25.126-25.126v-257.9c0-13.854,11.271-25.126,25.126-25.126H482.722 M482.722,98.198H30.99 c-16.638,0-30.126,13.488-30.126,30.126v257.9c0,16.639,13.488,30.126,30.126,30.126h451.732 c16.639,0,30.126-13.487,30.126-30.126v-257.9C512.848,111.686,499.36,98.198,482.722,98.198L482.722,98.198z" />
                                <path class="svg-master-circle2" d="M257.568,355.172c22.646,20.867,53.061,33.522,86.14,33.522 c71.037,0,128.538-57.941,128.538-129.207c0-71.482-57.501-129.424-128.538-129.424c-33.079,0-63.493,12.653-86.14,33.522 c-25.972,23.752-42.401,57.943-42.401,95.902C215.167,297.45,231.597,331.642,257.568,355.172L257.568,355.172z" />
                                <path class="svg-master-circle1" d="M299.086,245.725c-0.444-4.662-1.331-9.102-2.223-13.764h-78.586 c0.888-4.662,2.217-9.103,3.549-13.543h71.266c-1.558-4.659-3.333-9.323-5.332-13.763h-60.382 c2.22-4.659,4.661-9.323,7.326-13.763h45.51c-2.887-4.662-6.215-9.325-9.769-13.542h-25.975 c3.996-4.883,8.438-9.545,13.097-13.763c-22.863-20.647-53.057-33.522-86.356-33.522c-70.817,0-128.538,57.942-128.538,129.424 c0,71.266,57.721,129.207,128.538,129.207c33.3,0,63.493-12.655,86.356-33.522l0,0l0,0c4.665-4.221,8.882-8.66,12.878-13.544 h-25.975c-3.552-4.439-6.66-8.879-9.767-13.763h45.51c2.885-4.439,5.327-8.879,7.546-13.764h-60.382 c-2.001-4.439-3.996-8.88-5.552-13.544h71.266c1.553-4.439,2.661-9.1,3.771-13.763c0.892-4.439,1.778-9.104,2.223-13.764 c0.443-4.44,0.666-8.879,0.666-13.544C299.752,254.828,299.529,250.165,299.086,245.725L299.086,245.725z" />
                                <path class="svg-master-letter" d="M342.599,229.742l-2.443,14.207 c-4.886-2.441-8.438-3.552-12.434-3.552c-10.433,0-17.76,10.212-17.76,24.644c0,9.987,4.885,15.982,13.098,15.982 c3.33,0,7.326-1.106,11.766-3.332l-2.441,14.876c-5.106,1.332-8.436,2-12.209,2c-15.096,0-24.421-10.88-24.421-28.419 c0-23.309,12.877-39.735,31.302-39.735c2.441,0,4.662,0.222,6.44,0.666l5.549,1.332 C340.822,229.076,341.264,229.298,342.599,229.742L342.599,229.742z" />
                                <path class="svg-master-letter" d="M297.755,239.509c-0.444,0-0.892,0-1.333,0 c-4.665,0-7.327,2.22-11.546,8.66l1.331-8.216h-12.651l-8.658,53.282h13.984c5.106-32.635,6.438-38.187,13.098-38.187 c0.443,0,0.443,0,0.888,0c1.332-6.436,3.108-11.1,5.33-15.318L297.755,239.509L297.755,239.509z" />
                                <path class="svg-master-letter" d="M217.387,292.566c-3.771,1.332-6.878,1.775-9.987,1.775 c-7.105,0-11.102-3.995-11.102-11.762c0-1.332,0.222-3.113,0.444-4.664l0.889-5.328l0.665-4.221l5.997-36.406h13.763l-1.557,7.992 h7.104l-1.775,13.1h-7.104l-3.771,22.198c-0.224,0.889-0.224,1.552-0.224,2.221c0,2.664,1.332,3.776,4.664,3.776 c1.551,0,2.886,0,3.774-0.444L217.387,292.566L217.387,292.566z" />
                                <path class="svg-master-letter" d="M163.887,256.824c0,6.66,3.107,11.323,10.433,14.876 c5.773,2.663,6.661,3.551,6.661,5.771c0,3.332-2.441,4.884-7.992,4.884c-4.218,0-7.992-0.664-12.432-1.995l-2,12.206l0.667,0.225 l2.443,0.444c0.887,0.219,1.998,0.444,3.774,0.444c3.108,0.443,5.771,0.443,7.548,0.443c14.652,0,21.534-5.551,21.534-17.76 c0-7.328-2.886-11.548-9.768-14.875c-5.994-2.663-6.661-3.333-6.661-5.771c0-2.888,2.443-4.221,6.883-4.221 c2.663,0,6.438,0.225,9.989,0.669l1.998-12.212c-3.552-0.666-9.101-1.111-12.209-1.111 C169.214,238.842,163.665,247.056,163.887,256.824L163.887,256.824z" />
                                <path class="svg-master-letter" d="M448.935,293.235h-13.097l0.665-5.109 c-3.773,3.996-7.77,5.772-12.875,5.772c-10.215,0-16.874-8.654-16.874-21.979c0-17.758,10.435-32.854,22.646-32.854 c5.55,0,9.546,2.442,13.319,7.328l3.108-18.652h13.766L448.935,293.235L448.935,293.235z M428.511,280.804 c6.438,0,10.879-7.554,10.879-17.982c0-6.886-2.443-10.437-7.325-10.437c-6.217,0-10.881,7.327-10.881,17.759 C421.184,277.251,423.628,280.804,428.511,280.804L428.511,280.804z" />
                                <path class="svg-master-letter" d="M260.013,292.122c-4.883,1.558-9.322,2.22-14.432,2.22 c-15.538,0-23.53-8.211-23.53-23.974c0-18.203,10.211-31.748,24.2-31.748c11.542,0,18.868,7.548,18.868,19.315 c0,3.996-0.445,7.768-1.776,13.321h-27.529c-0.222,0.662-0.222,1.106-0.222,1.55c0,6.222,4.218,9.329,12.21,9.329 c5.107,0,9.547-0.888,14.432-3.332L260.013,292.122L260.013,292.122z M252.241,260.375c0-1.107,0-1.994,0-2.663 c0-4.44-2.439-6.881-6.66-6.881c-4.439,0-7.547,3.331-8.879,9.544H252.241L252.241,260.375z" />
                                <polygon class="svg-master-letter" points="110.828,293.235 97.065,293.235 105.056,242.839 87.074,293.235 77.527,293.235 76.418,243.282 67.981,293.235 55.106,293.235 65.984,227.741 85.964,227.741 86.63,268.367 99.949,227.741 121.706,227.741 110.828,293.235 " />
                                <path class="svg-master-letter" d="M145.238,269.48c-1.332,0-1.998-0.226-3.107-0.226 c-7.771,0-11.767,2.889-11.767,8.217c0,3.332,1.776,5.328,4.884,5.328C141.021,282.8,145.017,277.472,145.238,269.48 L145.238,269.48z M155.45,293.235h-11.544l0.222-5.554c-3.552,4.44-8.215,6.441-14.652,6.441c-7.547,0-12.653-5.771-12.653-14.433 c0-13.1,8.879-20.646,24.418-20.646c1.554,0,3.554,0.224,5.773,0.443c0.444-1.775,0.444-2.438,0.444-3.327 c0-3.551-2.441-4.883-8.88-4.883c-3.996,0-8.436,0.444-11.543,1.332l-1.998,0.663l-1.332,0.224l1.998-11.988 c6.881-1.999,11.545-2.666,16.65-2.666c11.987,0,18.426,5.329,18.426,15.542c0,2.664-0.222,4.659-1.109,10.655l-3.11,18.872 l-0.444,3.327l-0.222,2.664l-0.221,1.999L155.45,293.235L155.45,293.235z" />
                                <path class="svg-master-letter" d="M365.019,269.48c-1.555,0-2.22-0.226-3.108-0.226 c-7.991,0-11.987,2.889-11.987,8.217c0,3.332,1.998,5.328,5.106,5.328C360.579,282.8,364.797,277.472,365.019,269.48 L365.019,269.48z M375.229,293.235h-11.543l0.222-5.554c-3.551,4.44-8.213,6.441-14.65,6.441c-7.548,0-12.653-5.771-12.653-14.433 c0-13.1,8.879-20.646,24.418-20.646c1.554,0,3.552,0.224,5.551,0.443c0.443-1.775,0.665-2.438,0.665-3.327 c0-3.551-2.441-4.883-8.88-4.883c-3.995,0-8.656,0.444-11.766,1.332l-1.775,0.663l-1.332,0.224l1.998-11.988 c6.882-1.999,11.543-2.666,16.648-2.666c11.988,0,18.206,5.329,18.206,15.542c0,2.664,0,4.659-1.113,10.655l-2.883,18.872 l-0.446,3.327l-0.443,2.664l-0.223,1.999V293.235L375.229,293.235z" />
                                <path class="svg-master-letter" d="M412.526,239.509c-0.444,0-0.889,0-1.332,0 c-4.662,0-7.325,2.22-11.544,8.66l1.331-8.216H388.33l-8.438,53.282h13.765c5.106-32.635,6.438-38.187,13.098-38.187 c0.444,0,0.444,0,0.889,0c1.331-6.436,3.107-11.1,5.327-15.318L412.526,239.509L412.526,239.509z" />
                            </svg>
                            </div>
                        @endif
                    
                    </div>
                    <div class="col-md-12 col-12" id="bank-deposit">
                        <div class="row">
                            <p>หากต้องการชำระเงินผ่านบัญชีธนาคาร ลูกค้าสามารถชำระเงินได้ตามช่องทางดังต่อไปนี้ </p>
                            @foreach ($banks as $bank)
                                <div class="col-md-4">
                                    <p class="mb-0"> <strong>ธนาคาร :</strong> {{ $bank->bank }}</p>
                                    <p class="mb-0"> <strong>ชื่อบัญชี :</strong> {{ $bank->name }}</p>
                                    <p class="mb-0"> <strong>เลขบัญชี :</strong> {{ $bank->number }}</p>                                    
                                </div>
                            @endforeach
                            
                        </div>
                    </div>
                    <div class="col-md-12 col-12" id="credit-card" style="display:none">
                        <div class="dpf-card-placeholder"></div>  
                        <div class="dpf-input-container">
                            <div class="dpf-input-row">
                                <label class="dpf-input-label mb-0" >Credit Card Number</label>
                                <div class="dpf-input-container with-icon">
                                    <span class="dpf-input-icon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                                    <input type="text" class="dpf-input" name="number" size="20" data-type="number" placeholder="•••• •••• •••• ••••">
                                </div>
                            </div>

                            <div class="dpf-input-row">
                                <div class="dpf-input-column">
                                    <input type="hidden" size="2" name="exp_month" class="exp_month" data-type="exp_month" placeholder="MM">
                                    <input type="hidden" size="2" name="exp_year" class="exp_year" data-type="exp_year" placeholder="YY">

                                    <label class="dpf-input-label mb-0">Expiration Date</label>
                                    <div class="dpf-input-container">
                                        <input type="text" class="dpf-input" data-type="expiry" placeholder="••/••">
                                    </div>
                                </div>
                                <div class="dpf-input-column">
                                    <label class="dpf-input-label mb-0">CVC</label>
                                    <div class="dpf-input-container">
                                        <input type="text" class="dpf-input" name="cvc" size="4" data-type="cvc" placeholder="•••">
                                    </div>
                                </div>
                            </div>

                            <div class="dpf-input-row">
                                <label class="dpf-input-label mb-0">Full Name</label>
                                <div class="dpf-input-container">
                                    <input type="text" size="4" class="dpf-input" name="name" data-type="name" placeholder="Full name">
                                </div>
                            </div>

                           
                        </div>
                    </div>
                </div>
                
                 
            </div>
            <div class="col-md-4 col-12 order-md-2 order-2">
                <div class="col-12 pt-2 pt-md-0">
                <h5 class="text-dark  px-0 mb-0"> สรุปรายการสินค้า </h5>
                
                    <input type="hidden" value="BANK-DEPOSIT" name="payment_method" class="payment_method">
                    <input type="hidden" value="{{ $total_cart }}" name="payment_price" class="payment_price">
                    
                    <table class="table cart-table">
                        <thead>
                            <tr>
                                <th class="text-center"><span class="nobr">{{ __('main.word.product')}}</span></th>
                                <th class="text-center">{{ __('main.word.quantity')}}</th>
                                <th class="text-center">{{ __('main.word.price')}}</th>
                                <th class="text-center isDesktop">{{ __('main.word.Delete')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sort as $key=>$cartCondition)
                            @php
                                $href = !isset($cartCondition->attributes->slug) ? route('products.show' ,$cartCondition->attributes->slug) : '';
                                $shipping_price += $cartCondition->attributes->shipping_price * $cartCondition->quantity;
                                
                                if($shippingzone != NULL){
                                    if($shippingzone->rules()->first()->method == 'free-shipping'){

                                        $free_rule = json_decode($shippingzone->rules()->first()->rules , true);

                                        if($free_rule[0]['limit_free_shipping'] == 'yes'){
                                            if($total_cart > $free_rule[0]['price']){
                                                if($free_rule[0]['fixed_cost'] != 'yes'){
                                                    $shipping_price = 0;
                                                }
                                            }
                                        }
                                    }
                                }
                            
                            @endphp
                                <tr>
                                    <td>
                                        <a href="{{ $href }}" title="ลบรายการสินค้าออก" class="btn-remove btn-remove2 isMobile">ลบรายการสินค้าออก</a>
                                        <h2 class="product-name">
                                            <a href="{{ $href }}">{{ $cartCondition->name }}</a>
                                        </h2>
                                        <p class="product-short-desc mb-0"></p>
                                        <div class="product-cart-sku"><strong class="label">{{ __('main.word.Sku')}}: </strong>  {{ $cartCondition->attributes->sku }}</div>
                                    </td>
                                    <td class="product-cart-quantity text-center">{{ $cartCondition->quantity }}</td>
                                    <td class="text-center" style="line-height: 15px;font-size:16px;"><span>{{ $cartCondition->getPriceSum() }}</span> <span>{{ __('main.word.currency')}}</span></td>
                                    <td class="text-center isDesktop"><a href="" title="ลบรายการสินค้าออก" class="btn-cart-remove text-danger" data-type="delete" data-id="{{ $cartCondition->id }}"><i class="fas fa-trash"></i></a></td>
                                </tr>

                            @empty 
                                <tr><td colspan="6" class="text-center">ไม่มีสินค้าในตะกร้า</td></tr>
                            @endforelse
                            
                            <tr>
                                <td colspan="" style="font-size:16px;"><strong>{{ __('main.word.Sub Total')}}</strong> : </td>
                                <td colspan="3" class="text-right text-dark">{{ number_format($total_cart,2) }} {{ __('main.word.currency')}}</td>
                                
                            </tr>
                            <tr>
                                <td colspan="" style="font-size:16px;"><strong>{{ __('main.word.Shipping Fee')}}</strong> : </td>
                                <td colspan="3" class="text-right text-dark">{{ number_format($shipping_price , 2) }} {{ __('main.word.currency')}}</td>
                            
                            </tr>
                            <tr>
                                    <td colspan="" style="font-size:16px;"><strong>{{ __('main.word.Shipping Fee')}} ( {{ __('main.word.Additional')}} ) </strong> : </td>
                                    <td colspan="3" class="text-right text-dark">+ <span class="shipping-price-choice">{{ number_format($shipping_price_condi,2) }}</span> {{ __('main.word.currency')}}</td>
                                
                                </tr>
                            <tr>
                                <td colspan="" class="text-danger" style="font-size:18px;color:red;"><strong>{{ __('main.word.Total')}}</strong> : </td>
                                <td colspan="3" class="text-right text-danger" style="font-size:18px;color:red;"><strong class="price-total">{{ number_format($total_cart+$shipping_price+$shipping_price_condi,2) }} {{ __('main.word.currency')}}</strong> </td>
                            
                            </tr>
                        </tbody>
                    </table>
                    <input type="hidden" value="{{ $shipping_price+$shipping_price_condi }}" name="shipment_price" class="shipment_price">
                    <div class="text-center"><button type="submit" id="submit" class="btn btn-primary w-50 dpf-submit"> {{ __('main.word.Checkout')}} </button></div>
                
                
                </div>
            </div>
        </div>
        </form>
        <div class="row">
               
        </div>
    </div>
@stop

@push('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="{{ asset('js/DatPayment.js') }}"></script>
    <script type="text/javascript">
        function credit(){
            var payment_form = new DatPayment({
                form_selector: '#checkout-form',
                card_container_selector: '.dpf-card-placeholder',

                number_selector: '.dpf-input[data-type="number"]',
                date_selector: '.dpf-input[data-type="expiry"]',
                cvc_selector: '.dpf-input[data-type="cvc"]',
                name_selector: '.dpf-input[data-type="name"]',

                submit_button_selector: '.dpf-submit',

                placeholders: {
                    number: '•••• •••• •••• ••••',
                    expiry: '••/••',
                    cvc: '•••',
                    name: 'FULL NAME'
                },

                validators: {
                    number: function(number){
                        return Stripe.card.validateCardNumber(number);
                    },
                    expiry: function(expiry){
                        var expiry = expiry.split(' / ');
                        return Stripe.card.validateExpiry(expiry[0]||0,expiry[1]||0);
                    },
                    cvc: function(cvc){
                        return Stripe.card.validateCVC(cvc);
                    },
                    name: function(value){
                        return value.length > 0;
                    }
                }
            });

        }
        
      
    </script>
    <script>

        var getCountry = $('#country').val();
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
                        toAppend += '<option value="'+o.id+'" data-name="'+o.name_th+'">'+o.name_th+'</option>';
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

        $(document).on('click' , '.btn-cart-remove' , function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var type = $(this).data('type');
            $('.cart-table').block({
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
                $('.cart-table').unblock();
                $(".cart-totals-table").load(t + " .cart-totals-table");
                $('.cart-table').load(t + " .cart-table", function () {
                    $(".num-basket").load(t + " .number");       
                });
                window.location.reload();
            });
        });
    </script>
    <script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
    <script>
    $(document).ready(function() {

        var shipping_price_condi = parseInt({!! $shipping_price_condi !!});
        var total = parseInt({!! $total_cart !!})+parseInt(shipping_price_condi);

        $("input[name='choice-price']").change(function(){   
            var price = $("input[name='choice-price']:checked").data('price');
            var shipping_price_all = parseInt({!! $shipping_price !!})+parseInt(price);
            var total = parseInt({!! $total_cart !!})+parseInt(shipping_price_all);


            $('.shipment_price').val(parseInt(shipping_price_all));
            $('.price-total').text(parseFloat(total).toFixed(2) + ' บาท');
            $('.shipping-price-choice').text(parseFloat(price).toFixed(2));
        });
        $('.payment-method').on('click', function() {
            var method = $(this).data('method');
            $('.payment_method').val(method);
            $('.payment-method').removeClass('active');
            $(this).toggleClass('active');
            if(method == 'CREDIT-CARD'){
                $('#credit-card').show('slideUp');
                $('#bank-deposit').hide('slideDown');
                credit();
                $('#submit').addClass('dpf-submit');
            }else if(method == 'BANK-DEPOSIT'){
                $('#bank-deposit').show('slideUp');
                $('#credit-card').hide('slideDown');
                $('#submit').removeClass('dpf-submit');
            }{
                $('#bank-deposit').hide('slideDown');
                $('#credit-card').hide('slideDown');
                $('#submit').removeClass('dpf-submit');
            }
           
      });
    });
    //# sourceURL=pen.js
    </script>
@endpush
