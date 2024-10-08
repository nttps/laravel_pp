@extends('layouts.frontend.home')

@section('title' , ($product->meta_title) ? $product->meta_title .' | ' . getSetting('site_title') : $product->name .' | ' . getSetting('site_title') )
@section('keywords' , $product->meta_keyword ?? $product->name)
@section('description' , $product->meta_description ?? $product->short_description)

@section('custom-css')
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:type" content="product">
<meta property="og:title" content="{{ $product->meta_title ?? $product->name }}">
<meta property="og:description" content="{{ $product->meta_description ?? $product->short_description }}">
<meta property="og:image" content="{{ \Storage::url(imageThumbnail('thumbnail_facebook',$product->image)) }}">
<link rel="stylesheet" href="{{ asset('css/products.css')}}">
<link rel="stylesheet" href="{{ asset('css/slick.css')}}">
<link rel="stylesheet" href="{{ asset('css/slick-theme.css')}}">
<link rel="stylesheet" href="{{ asset('css/magnific-popup.css')}}">

<style>
.img-selected img {
    width: 100%;
    height: 350px;
    object-fit: contain;
}


.slick-next:before {
    content: "\F35A";
}
.slick-prev:before {
    content: "\F359";
}
.slick-prev:before, .slick-next:before {
    font-family: 'Font Awesome 5 Free';
    font-weight: 400;
    font-size: 20px;
    line-height: 1;
    color: black;
    opacity: 0.75;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.img-item:hover {
  border: 1px solid black; /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
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
    .table-variantproduct-cart{
        font-size: 15px;
        line-height: 16px;
        
    }
    .table-variantproduct-cart thead tr th , .table-variantproduct-cart tbody tr td{
        color:black;
        border: 1px solid #bebebe;
        vertical-align: middle;
    }
    .table-variantproduct-cart .sku{

        text-align: center;
    }
    .table-variantproduct-cart .space{
        
    }
    .table-variantproduct-cart .type{
        min-width: 100px;
    }
    .table-variantproduct-cart .qty-th{
        min-width: 100px;
    }
    .table-variantproduct-cart .action{
        padding: 5px;
        min-width: 150px;
        vertical-align: top;
    }
    .table-variantproduct-cart .action a{
       font-size: 12px;
    }
    .table-variantproduct-cart .action button{
       padding: 10px 15px;
       border: 0;

    }
    .table-variantproduct-cart .action .btn-cart{
        background-color: #96c13c;
        border-color: #96c13c;
        color:#fff;
        cursor: pointer;
    }
    .table-variantproduct-cart .action .btn-buy{
        background-color: #ee3124;
        border-color: #ee3124;
        color:#fff;
        cursor: pointer;
    }
    .table-variantproduct-cart .action .btn-buy:hover{
        background-color: #c6251a;
        border-color: #c6251a;
    }
    
    .table-variantproduct-cart input{
       width: 40px;
       text-align: center;
       border: none;
    }
    .table-variantproduct-cart input:focus{
        outline: 0;
        border: none;
    }
    .table-var {
        max-height: 345px;
    }

    @media screen and (max-width: 991px) {
        table tr td{
            white-space: nowrap;
        }
        .table-responsive .table {
            max-width: none;
            -webkit-overflow-scrolling: touch !important;
        }
    }
</style>
@stop

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="float-left">{{ Breadcrumbs::render('product_detail' , $product) }}</div>
            @if(!empty($product->brands->slug))
                <div class="float-right"><a href="{{ route('brands.show' , $product->brands->slug) }}">{{ __('main.word.brand')}} {{ $product->brands->name }} </a></div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-5 col-lg-4">
            <div class="img-selected border text-center">
                <a href="{{ \Storage::url($product->image) }}"><img src="{{ \Storage::url($product->image) }}" style="width:100%;" alt=""></a>
            </div>
            <div class="img-gallary gallery d-flex mt-2">
                <div class="img-item">
                    <a href="{{ \Storage::url($product->image) }}"><img src="{{ \Storage::url($product->image) }}" style="width:50px" class="img-gallary-item"
                        alt=""></a>
                </div>
                @if($images != NULL)
                    @foreach ($images as $imageG)
                        <div class="img-item">
                            <a href="{{ asset($imageG) }}">
                            <img src="{{ asset($imageG) }}" class="img-gallary-item" style="width:50px"
                                alt=""></a>
                        </div>
                    @endforeach                    
                @endif
            </div>
        </div>
        <div class="col-12 col-md-7 col-lg-8">
            <div class="product-name mb-md-3 mt-md-0 mt-3">
                <h2>{{ $product->getName() }}</h2>
            </div>
            @if($product->is_option != 0)
            
                <div class="product-description" style="">
                    <p>{!! $product->getShortDescription() !!}</p>
                </div>
                <div class="product-option">
                    @if($countVariant == 0)
                        <h5> สินค้านี้ยังไม่มีรายการข้อมูล </h5>
                    @else
                        @include('frontend.products.forms.options' , ['options' => $optionsForProduct])

                    @endif
                </div>
              
                <div class="product-full-attribute col-12 order-2 order-md-3">
                <hr class="bg-dark">

                    
                </div>
            @endif
            
          

            @if($product->is_option == 0)
                <div class="product-description" style="">
                    <p>{!! $product->getShortDescription() !!}</p>
                </div>
                @include('frontend.products.forms.single' , $product)
            @endif
        </div>

      
    </div>
    

        
    <div class="row mt-lg-4">
        <div class="col-12 product-full-description">
            <div class="title-full-description row">
                <div class="col-md-6 col-12 order-1 order-md-1 align-self-center">
                    <h2 class="my-0 product-head-description">{{ __('main.word.detail_more')}}</h2>
                </div>
                <div class="col-md-6 col-12 order-3 order-md-2">
                    <div class="float-md-right">
                        <label class="d-block py-2 my-lg py-lg-0" style="line-height: 10px;font-size:10px;margin-bottom: 10px;"> {{ __('main.word.share')}}</label>
                        <ul class="product-share-link-action">
                            <li class="facebook"><a href="javascript:void(0);" onclick="fbs_click(500,500);"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                            <li class="email"><a href="mailto:?subject=แชร์ข้อมูล{{ route('products.show', $product->slug) }}"><i class="far fa-envelope"></i> Email</a></li>
                            <li class="line"><a href="javascript:void(0);" onclick="line_click(500,500);"><i class="fab fa-line"></i> Line</a></li>
                        </ul>
                    </div>
                    <div class="clear" style="clear:both"></div>
                </div>
                <div class="col-12 order-2 order-md-3">
                    <div class="product-description" style="">
                        <p>{!! $product->getHTML() !!}</p>
                    </div>
                </div>
                    {{-- <div class="product-full-attribute col-12 order-2 order-md-3">
                        <hr class="bg-dark">
    
                        <table class="product-attribute-specs-table table-responsive">
                            <tr>
                                <th width="30%">รหัสสินค้า</th>
                                <th>{{ $product->sku}}</th>
                            </tr>
                            @foreach ($attributes_product as $attribute)
                                <tr>
                                    <td>{{ $attribute->name }}</td>
                                    <td>{!! $attribute->pivot->attribute_value !!}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div> --}}
            </div>
            {{-- <hr class="bg-dark"> --}}
        </div>
      
    </div>
</div>


@if(!$relateForProduct->isEmpty())
@include('layouts.frontend.partials.relate-product' , [ 'relateForProduct' => $relateForProduct])
@endif

@stop

@push('scripts')
    <script src="{{ asset('js/slick.min.js')}}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script>
    $('.img-gallary').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        variableWidth: true,
        prevArrow:"<i class='img-btn-left control-c prev slick-prev far fa-arrow-alt-circle-right'></i>",
        nextArrow:"<i class='img-btn-right control-c next slick-next far fa-arrow-alt-circle-left'></i>",
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    arrows: false
                }
            }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
        ]
    });

        function fbs_click(width,height){
            var leftPosition,topPosition;leftPosition=(window.screen.width/2)-((width/2)+10);
            topPosition=(window.screen.height/2)-((height/2)+50);
            var windowFeatures="status=no,height="+height+",width="+width+",resizable=yes,left="+leftPosition+",top="+topPosition+",screenX="+leftPosition+",screenY="+topPosition+",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";
            u=location.href;t=document.title;
            var url_share='{!! $product->slug !!}';
            window.open('https://www.facebook.com/sharer.php?u={{ route('products.show', $product->slug) }}','sharer',windowFeatures);
            return false;
        }
        function line_click(width,height){
            var leftPosition,topPosition;leftPosition=(window.screen.width/2)-((width/2)+10);
            topPosition=(window.screen.height/2)-((height/2)+50);
            var windowFeatures="status=no,height="+height+",width="+width+",resizable=yes,left="+leftPosition+",top="+topPosition+",screenX="+leftPosition+",screenY="+topPosition+",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";
            u=location.href;t=document.title;
            var url_share='{!! $product->slug !!}';
            window.open('https://social-plugins.line.me/lineit/share?url={{ route('products.show', $product->slug) }}','sharer',windowFeatures);
            return false;
        }

        function isInArray(value, array) {
            return array.indexOf(value) > -1;
        }
        var option_count = $('.option_value');

        
        $('.btn-to-cart').click( function() {
            var val_option = null;
            if(option_count.length > 0 ) {
                val_option = $('.option_value').val();
                for(var i = 0; i < option_count.length; i++){
                    if($(option_count[i]).val() == ''){
                        alert('check');
                        return false;
                    }
                }

            }
            
           
            var type = $(this).data('type');
            var total = 0;
            if(type == 'product'){
                var qty = $("input[name='qty']").val();
                if (isNaN(parseInt(qty))) {
                    alert('กรุณากรอกข้อมูลเป็นจำนวน หรือตัวเลข');
                    return false;
                }
                total = qty;
                var id = $(this).data('id');
            }else{
                var qty = new Array();
                var id = new Array();
                $(this).closest('table').find('input').each(function() {
                
                    qty.push(parseInt($(this).val()));
                    id.push($(this).data('id'));
                    total += parseInt($(this).val());
                });

                //console.log(id);
                
            }
            
            if(total < 1){
                alert('กรุณาใส่จำนวนสินค้าที่ต้องการซื้อ');
                return false;
            }
           
            var to = $(this).data('to')
            
            if(to == 'cart'){
                url = '{{ route('cart')}}';
                title = 'เพิ่มสินค้าลงในตะกร้า';
                text = 'สินค้าของคุณถูกบันทึกลงในตะกร้าสินค้าแล้ว';
                texthref    = 'ต้องการไปหน้าตะกร้าสินค้าของคุณหรือไม่ ?'
            }else{
                url = '{{ route('checkout')}}';
                title = 'สั่งซื้อสินค้า';
                text = 'สินค้าของคุณถูกบันทึกแล้ว';
                texthref    = 'ต้องการไปหน้าสั่งซื้อใช่หรือไม่ ?'
            }
            
            var c = {
                _token: '{!! csrf_token() !!}',
                id: id,
                qty: qty,
                type: type
            };
            
            $.post('{!! route('cart.add') !!}', c, function (t) {
        
                swal({
                    type: 'success',
                    title: title,
                    text: text,
                    showConfirmButton: false,
                    footer: '<a href="'+url+'"><strong>'+texthref+'</strong></a>'
                });
                $(".num-basket").load(t + " .number");              
            })
        });
        
        $('.option_value').each(function(){
            $(this).on( 'change' , function() {
                
                $('.product-options').block({
                    message: null,
                    overlayCSS: {
                        background: "#fff",
                        opacity: .6
                    }
                });
                if($(this).find(':selected').val() == 0){
                    $('.option-more').animate({'opacity': 0}, 100);
                    $('.product-options').unblock();
                    return false;
                
                }
                $('.option-more').animate({'opacity': 0}, 100);
                var id =        $(this).find(':selected').data('id'),
                    option_id   = $(this).find(':selected').data('option-id'),
                    a = {
                        id: id,
                        option_id : option_id,
                        _token: '{!! csrf_token() !!}',
                    } 
                $.post('{!! route('api.get.option') !!}', a, function (t) {
                    if(t.children_count == 0){                      
                        var select = $('<select />', {
                            'class' : 'option_value_last',
                            'id': 'option_value_last',
                            'name': 'option_value_last'
                        });
                        var label = jQuery('<label />',{
                            'for' : 'option_value_last',
                            'text' : t.option_sub_name
                        });
                        var optionEmpty = $('<option />', {
                                'value': '',
                                'text': 'เลือก'

                            });
                            $(select).append(optionEmpty);
                        $.each(t.data, function(i, item){
                     
                            var option = $('<option />', {
                                'value': t.data[i].value,
                                'name': 'option_value_last',
                                'data-id': t.data[i].id,
                                'data-option-id' :t.data[i].option_product_id,
                                'text':t.data[i].value

                            });
                            $(select).append(option);
                        });
                        $('.option-more').html(label.append(select)).animate({'opacity': 1}, 100);
                    }else{
                        var html = '<label for="option_value">'+t.option_sub_name+'</label>';
                        html += '<select name="option_value" class="option_value" id="option_value">';
                        $.each(t.data, function(i, item){
                            html += '<option value="'+t.data[i].value+'" data-option-id="'+t.data[i].option_product_id+'" data-id="'+t.data[i].id+'">'+t.data[i].value+'</option>';
                            
                        });   
                        html += '</select></div>';
                        $('.option-more').text(html);
                    }
                    $('.product-options').unblock();
                    
                })
            });
        });

      

        $(document).ready( function() {
            $('.img-item').hover(function() {
                $(this).addClass('img-item-active');
                var img = $(this).children('img').attr('src');
                $('.img-selected a').attr('href' , img);
                $('.img-selected img').attr('src' , img);
            },     
            function(){    
                $(this).removeClass('img-item-active');     
            });
            $('.gallery').each(function() { // the containers for all your galleries
                $(this).magnificPopup({
                    delegate: 'a', // the selector for gallery item
                    type: 'image',
                    gallery: {
                    enabled:true
                    }
                });
            });
            $('.img-selected a').magnificPopup({type:'image'});
            
            
            $(".option-more").on( 'change' , '.option_value_last' , function() {
                var id =        $(this).find(':selected').data('id'),
                    option_id   = $(this).find(':selected').data('option-id'),
                    p = {
                        value_id: id,
                        option_id : option_id,
                        _token: '{!! csrf_token() !!}',
                    } 
                $.post('{!! route('api.get.product') !!}', p, function (t) {
                    //console.log(t);
                    if(t.status == "success"){
                        $('.btn-to-cart').prop('disabled', false);
                        $('#btn-toCart').attr('data-id' , t.data.id);
                        $('.qty').prop('disabled', false);
                        $('.btn_minus').prop('disabled', false);
                        $('.btn_plus').prop('disabled', false);
                    }
                });
            });
        });
        

    </script>
@endpush
