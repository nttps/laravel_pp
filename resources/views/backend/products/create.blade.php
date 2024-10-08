@extends('layouts.backend.master')

@push('css')
     <!-- include summernote css/js -->
     {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet"> --}}
     <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
     <link href="{{ asset('css/backend/vendor/jquery-ui.bundle.css') }}" rel="stylesheet">
     
         <style>
             @font-face {
       font-family: 'rsubold';
       src: url('/fonts/webfonts/rsu-bold/rsu-bold-webfont.eot');
       src: url('/fonts/webfonts/rsu-bold/rsu-bold-webfont.eot?#iefix') format('embedded-opentype'),
            url('/fonts/webfonts/rsu-bold/rsu-bold-webfont.woff2') format('woff2'),
            url('/fonts/webfonts/rsu-bold/rsu-bold-webfont.woff') format('woff');
       font-weight: normal;
       font-style: normal;
     
     }
     @font-face {
       font-family: 'rsulight';
       src: url('/fonts/webfonts/rsu-light/rsu-light-webfont.eot');
       src: url('/fonts/webfonts/rsu-light/rsu-light-webfont.eot?#iefix') format('embedded-opentype'),
            url('/fonts/webfonts/rsu-light/rsu-light-webfont.woff2') format('woff2'),
            url('/fonts/webfonts/rsu-light/rsu-light-webfont.woff') format('woff');
       font-weight: normal;
       font-style: normal;
       unicode-range: U+0E00–U+0E7F;
     
     }
     @font-face {
       font-family: 'rsuregular';
       src: url('/fonts/webfonts/rsu-regular/rsu-regular-webfont.eot');
       src: url('/fonts/webfonts/rsu-regular/rsu-regular-webfont.eot?#iefix') format('embedded-opentype'),
            url('/fonts/webfonts/rsu-regular/rsu-regular-webfont.woff2') format('woff2'),
            url('/fonts/webfonts/rsu-regular/rsu-regular-webfont.woff') format('woff');
       font-weight: normal;
       font-style: normal;
       unicode-range: U+0E00–U+0E7F;
     
     }
     @font-face {
       font-family: 'rsutext-regular';
       src: url('/fonts/webfonts/rsu-text/rsu_text_regular-webfont.eot');
       src: url('/fonts/webfonts/rsu-text/rsu_text_regular-webfont.eot?#iefix') format('embedded-opentype'),
            url('/fonts/webfonts/rsu-text/rsu_text_regular-webfont.woff2') format('woff2'),
            url('/fonts/webfonts/rsu-text/rsu_text_regular-webfont.woff') format('woff');
       font-weight: normal;
       font-style: normal;
       unicode-range: U+0E00–U+0E7F;
     }
     
     @font-face {
       font-family: 'rsutext-bold';
       src: url('/fonts/webfonts/rsu-text/rsu_text_bold-webfont.eot');
       src: url('/fonts/webfonts/rsu-text/rsu_text_bold-webfont.eot?#iefix') format('embedded-opentype'),
            url('/fonts/webfonts/rsu-text/rsu_text_bold-webfont.woff2') format('woff2'),
            url('/fonts/webfonts/rsu-text/rsu_text_bold-webfont.woff') format('woff');
       font-weight: normal;
       font-style: normal;
       unicode-range: U+0E00–U+0E7F;
     }
     
     @font-face {
       font-family: 'rsutext-italic';
       src: url('/fonts/webfonts/rsu-text/rsu_text_italic-webfont-webfont.eot');
       src: url('/fonts/webfonts/rsu-text/rsu_text_italic-webfont-webfont.eot?#iefix') format('embedded-opentype'),
            url('/fonts/webfonts/rsu-text/rsu_text_italic-webfont-webfont.woff2') format('woff2'),
            url('/fonts/webfonts/rsu-text/rsu_text_italic-webfont-webfont.woff') format('woff');
       font-weight: normal;
       font-style: normal;
       unicode-range: U+0E00–U+0E7F;
     }
     </style>
    <style>
    .product_cat_all{
        min-height: 42px;
        max-height: 200px;
        overflow: auto;
        padding: 0 .9em;
        border: 1px solid #ddd;
        background-color: #fdfdfd;
    }
    ul.categorychecklist{
        list-style: none;
        padding: 0;
        margin: 10px 0 0 0;
    }
    ul.categorychecklist li {
        margin: 0;
        padding: 0;
        line-height: 15px;
        word-wrap: break-word;
        display: list-item;
        text-align: -webkit-match-parent;
    }
    ul.categorychecklist li label{
        cursor: pointer;
        font-size: 13px;
    }
    ul.categorychecklist li label input[type=checkbox]{
        border: 1px solid #b4b9be;
        background: #fff;
        color: #555;
        clear: none;
        cursor: pointer;
        display: inline-block;
        line-height: 0;
        height: 16px;
        margin: -4px 4px 0 0;
        outline: 0;
        padding: 0!important;
        text-align: center;
        vertical-align: middle;
        width: 16px;
        min-width: 16px;
        -webkit-appearance: none;
        box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
        transition: .05s border-color ease-in-out;
    }
    .thumbnail{

        height: auto;
        margin: 10px; 
        float: left;
    }
    #result {
        border: 4px dotted #cccccc;
        display: none;
        float: right;
        margin:0 auto;
        width: 100%;
    }
    ul.categorychecklist li label input[type=checkbox]:checked:before {
        float: left;
        display: inline-block;
        vertical-align: middle;
        width: 14px;
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        speak: none;
        content: "\f00c";
        margin: 0;
        color: #1e8cbe;
        -moz-osx-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        line-height: 15px;
    }
    ul.categorychecklist ul{
        margin-left: 18px;
        padding: 0;
        list-style: none;
    }

    #m_select2_productdata{
        margin-left: 10px;
    }
    .select2 {
        width:100%!important;
    }
    .m-portlet__sm{
        height: 2.5rem !important;
        /*cursor: move;*/
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
        content: "\f110";
        font-weight: 900;
        background-size: cover;
        line-height: 1;
        text-align: center;
        font-size: 2em;
        color: rgba(0,0,0,.75);
    }
    table.table_attribute {
        width: 100%;
        position: relative;
        background-color: #fdfdfd;
        padding: 1em;
    }
    table.table_attribute td{
        text-align: left;
        padding: 0 6px 1em 0;
        vertical-align: top;
        border: 0;
    }

    table.table_attribute td.attribute_name {
        width: 300px;
    }
    table.table_attribute td label{
        text-align: left;
        display: block;
        line-height: 14px;
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
@endpush
@section('title.page' , 'Product')


@section('breadcrumb')
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
        <li class="m-nav__item m-nav__item--home">
            <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
            <i class="m-nav__link-icon la la-home"></i>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('admin.catalogs.product.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Products  </span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <span class="m-nav__link-text">{{ isset($data) ? 'Edit' : 'Create' }} Product</span>
        </li>
    </ul>
@stop


@section('content')

@php 
function SelectOptions($dataArray, $selectionArray) {
    foreach ($dataArray as $key => $value) {
        echo '<option ' . (in_array($key, $selectionArray) ? 'selected="selected"' : '') . ' value="' . $key . '">' . $value . '</option>';
    }
}
@endphp
<form class="m-form m-form m-form--state m-form--label-align-right" action="@if(isset($data)){{ route('admin.catalogs.product.update' , $data->id) }}@else{{ route('admin.catalogs.product.store') }} @endif" method="POST" enctype="multipart/form-data" id="productFrom">
    @csrf()

    @if(isset($data))
        @method('PUT')
    @endif

    @php
       $is_option = isset($data->is_option) ? $data->is_option : NULL;

    @endphp
    <div class="row">
        <div class="col-lg-9">
        <!--begin::Portlet-->
            <div class="m-portlet m-portlet--head-sm">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ isset($data) ? 'Edit' : 'Create' }} A Product
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand m-tabs-line-danger" role="tablist">
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#m_tabs_12_1" role="tab" aria-selected="false">
                                THAI
                            </a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_12_2" role="tab" aria-selected="false">
                                    ENG
                            </a>
                        </li>                                
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane  active show" id="m_tabs_12_1" role="tabpanel">
                            @include('backend.products.form_thai')
                        </div>
                        <div class="tab-pane" id="m_tabs_12_2" role="tabpanel">
                            @include('backend.products.form_eng')
                        </div>
                    </div> 
                    
                </div>
            </div>
            <!--end::Portlet-->
            <div class="m-portlet m-portlet--head-sm" id="product_data_div">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                <span>Product data</span>
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools text-left">
                        <select class="form-control m-select2" id="m_select2_productdata" name="product_data">
                            <option value="singleproduct" @if($is_option == 0) selected @endif>Single product</option>
                            <option value="selectedproduct" @if($is_option == 1) selected @endif>Selected product</option>
                        </select>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div >
                        <ul class="nav nav-tabs  m-tabs-line m-tabs-line--success" role="tablist" id="tabs">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link active show first-item-tabs" data-toggle="tab" href="#m_tabs_2_1" role="tab" aria-selected="true">Price</a>
                            </li>
                            <li class="nav-item dropdown m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_2_2" role="tab" aria-selected="false">Stock</a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_2_3" role="tab" aria-selected="false">Relate product</a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#tabs_attribute" role="tab" aria-selected="false">Attributes</a>
                            </li>
                            <li class="nav-item m-tabs__item selected_product_item" @if($is_option == 0) style="display:none;" @endif>
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#tabs_option" role="tab" id="Optionproduct" aria-selected="false">Option product</a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#tabs_images" role="tab" aria-selected="false">Gallery image</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="tabs_product_all">
                            <div class="tab-pane active show first-tabs" id="m_tabs_2_1" role="tabpanel">
                                <div class="m-accordion m-accordion--default m-accordion--toggle-arrow" id="m_accordion_5" role="tablist">                      

                                <!--begin::Item-->              
                                    <div class="m-accordion__item m-accordion__item--success">
                                        <div class="m-accordion__item-head collapsed " srole="tab" id="m_accordion_5_item_1_head" data-toggle="collapse" href="#m_accordion_5_item_1_body" aria-expanded="false">
                                            <span class="m-accordion__item-icon"><i class="fa 	fa-user"></i></span>
                                            <span class="m-accordion__item-title">User Price</span>
                                                
                                            <span class="m-accordion__item-mode"></span>     
                                        </div>

                                        <div class="m-accordion__item-body collapse show" id="m_accordion_5_item_1_body" role="tabpanel" aria-labelledby="m_accordion_5_item_1_head" data-parent="#m_accordion_5" style=""> 
                                            <div class="m-accordion__item-content">
                                                <div class="row m--margin-bottom-25">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group m-form__group {{ $errors->has('price') ? ' has-danger' : '' }}">
                                                            <label for="RegularPrice">Regular price</label>
                                                            <input type="text" name="regularPrice" class="form-control form-control-sm m-input " @if($is_option == 1) disabled @endif id="RegularPrice" aria-describedby="RegularPriceHelp" placeholder="Enter regular price" value="{{ isset($data->price) ? $data->price : old('regularPrice') }}" required>
                                                            @if ($errors->has('price'))
                                                                <div class="form-control-feedback">
                                                                    {{ $errors->first('price') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group m-form__group">
                                                            <label for="SalePrice">Sale price</label>
                                                            <input type="text" name="salePrice"  class="form-control form-control-sm m-input" id="SalePrice" @if($is_option == 1) disabled @endif aria-describedby="SalePriceHelp" placeholder="Enter sale price" value="{{ isset($data->discount_price) ? $data->discount_price : old('salePrice') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Item--> 

                                    <!--begin::Item--> 
                                    <div class="m-accordion__item m-accordion__item--info">
                                        <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_5_item_2_head" data-toggle="collapse" href="#m_accordion_5_item_2_body" aria-expanded="false">
                                            <span class="m-accordion__item-icon"><i class="fa	fa-users"></i></span>
                                            <span class="m-accordion__item-title">Distibutor Price</span>
                                                
                                            <span class="m-accordion__item-mode"></span>     
                                        </div>

                                        <div class="m-accordion__item-body collapse" id="m_accordion_5_item_2_body" role="tabpanel" aria-labelledby="m_accordion_5_item_2_head" data-parent="#m_accordion_5" style=""> 
                                            <div class="m-accordion__item-content">
                                                <div class="row m--margin-bottom-25">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group m-form__group">
                                                            <label for="RegularPrice">Regular price</label>
                                                            <input type="text" name="regularPrice_Distibutor" class="form-control form-control-sm m-input " @if($is_option == 1) disabled @endif id="RegularPrice" aria-describedby="RegularPriceHelp" placeholder="Enter regular price" value="{{ isset($data->distibutor_price) ? $data->distibutor_price : old('regularPrice_Distibutor') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group m-form__group">
                                                            <label for="SalePrice">Sale price</label>
                                                            <input type="text" name="salePrice_Distibutor"  class="form-control form-control-sm m-input" id="SalePrice" @if($is_option == 1) disabled @endif aria-describedby="SalePriceHelp" placeholder="Enter sale price" value="{{ isset($data->distibutor_discount_price) ? $data->distibutor_discount_price : old('salePrice_Distibutor') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                    <!--end::Item--> 

                                    <!--begin::Item--> 
                                    <div class="m-accordion__item m-accordion__item--brand">
                                        <div class="m-accordion__item-head" role="tab" id="m_accordion_5_item_3_head" data-toggle="collapse" href="#m_accordion_5_item_3_body" aria-expanded="true">
                                            <span class="m-accordion__item-icon"><i class="fa fa-user-tie"></i></span>
                                            <span class="m-accordion__item-title">Dealer Price</span>
                                                
                                            <span class="m-accordion__item-mode"></span>     
                                        </div>

                                        <div class="m-accordion__item-body collapse" id="m_accordion_5_item_3_body" role="tabpanel" aria-labelledby="m_accordion_5_item_3_head" data-parent="#m_accordion_5" style=""> 
                                            <div class="m-accordion__item-content">
                                                <div class="row m--margin-bottom-25">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group m-form__group">
                                                            <label for="RegularPrice">Regular price</label>
                                                            <input type="text" name="regularPrice_Dealer" class="form-control form-control-sm m-input " @if($is_option == 1) disabled @endif id="RegularPrice" aria-describedby="RegularPriceHelp" placeholder="Enter regular price" value="{{ isset($data->dealer_price) ? $data->dealer_price : old('regularPrice_Dealer') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group m-form__group">
                                                            <label for="SalePrice">Sale price</label>
                                                            <input type="text" name="salePrice_Dealer"  class="form-control form-control-sm m-input" id="SalePrice" @if($is_option == 1) disabled @endif aria-describedby="SalePriceHelp" placeholder="Enter sale price" value="{{ isset($data->dealer_discount_price) ? $data->dealer_discount_price : old('salePrice_Dealer') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                       
                                    </div>
                                    <!--end::Item-->  
                                    <!--begin::Item--> 
                                    <div class="m-accordion__item m-accordion__item--shipping">
                                        <div class="m-accordion__item-head" role="tab" id="m_accordion_5_item_4_head" data-toggle="collapse" href="#m_accordion_5_item_4_body" aria-expanded="true">
                                            <span class="m-accordion__item-icon"><i class="fa flaticon-truck"></i></span>
                                            <span class="m-accordion__item-title">Shipping Price</span>
                                                
                                            <span class="m-accordion__item-mode"></span>     
                                        </div>

                                        <div class="m-accordion__item-body collapse" id="m_accordion_5_item_4_body" role="tabpanel" aria-labelledby="m_accordion_5_item_4_head" data-parent="#m_accordion_5" style=""> 
                                            <div class="m-accordion__item-content">
                                                <div class="row m--margin-bottom-25">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group m-form__group">
                                                            <label for="ShippingPrice">Shipping price</label>
                                                            <input type="text" name="shippingPrice" class="form-control form-control-sm m-input" id="ShippingPrice" @if($is_option == 1) disabled @endif aria-describedby="ShippingPriceHelp" placeholder="Enter shipping price" value="{{ isset($data->shipping_price) ? $data->shipping_price : old('shippingPrice') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                       
                                    </div>
                                    <!--end::Item-->                  
                                </div>
                                
                                
                                <div class="form-group m-form__group m--margin-top-10">
                                    <div class="m-alert m-alert--icon alert alert-warning" role="alert">
                                        <div class="m-alert__icon">
                                            <i class="la la-warning"></i>
                                        </div>
                                        <div class="m-alert__text">
                                            <strong> If your product is type Select Product this tabs will not work.</strong> 	
                                        </div>	
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="m_tabs_2_2" role="tabpanel">
                                <div class="form-group m-form__group row">
                                    <label for="SKU" class="col-form-label text-left col-lg-2 col-md-2 col-sm-12">SKU</label>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <input type="text" name="SKU" class="form-control m-input" id="SKU" aria-describedby="SKUHelp" placeholder="Enter SKU" value="{{ isset($data->sku) ? $data->sku : old('SKU') }}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row pt-0">
                                    <label for="SKU" class="col-form-label col-form-sm col-lg-2 text-left col-md-2 col-sm-12">Manage stock</label>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input type="checkbox" class="enable_stock" name="enable_stock">
                                                    Enable stock management
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setStock" style="display:none;">
                                    <div class="form-group m-form__group row">
                                        <label for="Stock" class="col-form-label col-form-sm col-lg-2 text-left col-md-2 col-sm-12">Stock quantity</label>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <input type="text" name="inventory_quantity" class="form-control m-input" id="Stock" aria-describedby="StockHelp" value="{{ isset($data->inventory_quantity) ? $data->inventory_quantity : old('inventory_quantity' , '') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group m--margin-top-10">
                                    <div class="m-alert m-alert--icon alert alert-warning" role="alert">
                                        <div class="m-alert__icon">
                                            <i class="la la-warning"></i>
                                        </div>
                                        <div class="m-alert__text">
                                            <strong> If your product is type Select Product this tabs will not work.</strong> 	
                                        </div>	
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="m_tabs_2_3" role="tabpanel">
                                <div class="form-group m-form__group row">
                                    <label class="col-form-label text-left col-lg-4 col-sm-12">Select to relate product</label>
                                    <div class="col-lg-4 col-md-9 col-sm-12">
                                        <select class="form-control " id="m_select2_relate1" name="relate_product[]" multiple="multiple">
                                            @forelse ($relateForProduct as $relate)
                                                <option value="{{ $relate->id }}" selected>{{$relate->name}}</option>
                                            @empty
                                                <option></option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs_attribute" role="tabpanel">
                                <div id="tabs_attribute_inner">
                                    <div class="form-group m-form__group row pb-0">
                                        <label class="col-form-label text-left col-lg-4 col-sm-12">Select to attribute product</label>
                                        <div class="col-lg-4 col-md-9 col-sm-12">
                                            <select class="form-control attribute_select" name="attribute_product[]">
                                                <option value="">Select Attribute...</option>
                                                @foreach ($attributes as $attribute)
                                                    <option value="{{ $attribute->id }}" {{ $attributes_product->contains($attribute) ? 'disabled' : '' }}>{{ $attribute->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class=" m--font-info">You can add a attribute at <a href="{{ route('admin.catalogs.attributes.index') }}" class="m-link m-link--state m-link--info  m--font-boldest">here</a>.</div>
                                        </div>
                                        <button class="btn btn-outline-info m-btn m-btn--custom btn-sm add-attribute">Add</button>
                                    </div>
                                    <div class="m-separator m-separator--space m-separator--dashed"></div>
                                    <div class="product_attributes ui-sortable" id="m_sortable_portlets">
                                        @forelse ($attributes_product as  $key=> $attribute_item)
                                        <?php
                                            $attr_values = explode(',' ,$attribute_item->pivot->attribute_value);
                                            $attr_base_values = explode(',' ,$attribute_item->value);
                                            //$result = array();
                                         
                                            $attr_sum = array_unique(array_merge($attr_values, $attr_base_values), SORT_REGULAR);
                               
                                            //dd($attr_base_values,$attribute_item->value,$attribute_item->pivot->attribute_value);
                                        ?>
                                        <div class="attribute m-portlet m-portlet--head-solid-bg m-portlet--head-sm taxonomy m-portlet--sortable" data-taxonomy="{{ $attribute_item->pivot->attribute_id }}" m-portlet="true" id="m_portlet_tools_{{ $attribute_item->pivot->id }}">
                                            <div class="m-portlet__head m-portlet__sm ui-sortable-handle ">
                                                <div class="m-portlet__head-caption">
                                                    <div class="m-portlet__head-title">
                                                        <h4 class="m-portlet__head-text"> {!! $attribute_item->name !!}</h4>
                                                    </div>
                                                </div>
                                                <div class="m-portlet__head-tools">
                                                    <ul class="m-portlet__nav">
                                                        <li class="m-portlet__nav-item">
                                                            <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-angle-down"></i></a>	
                                                        </li>
                                                        <li class="m-portlet__nav-item">
                                                            <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon remove_row" data-id="{{ $attribute_item->id}}"><i class="la la-close"></i></a>	
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="m-portlet__body">
                                                <table class="table_attribute">
                                                    <tr>
                                                        <td class="attribute_name"><label>Name:</label> <strong>{{ $attribute_item->name }}</strong><input type="hidden" name="name_attribute[{{ $key }}]" value="{{ $attribute_item->id }}"></td>
                                                        <td rowspan="3"><label>Value(s):</label>
                                                            <select class="attribute_value form-control m-select2" name="attribute_value[{{ $key }}][]" multiple="multiple">
                                                               
                                                                @forelse ($attr_sum as $attr_sum_value)
                                                                    <option value="{!! htmlentities($attr_sum_value) !!}" {{(in_array($attr_sum_value, $attr_values) ? 'selected' : '')}}>{!!$attr_sum_value!!}</option>                                                                @empty
                                                                @endforelse
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="m-checkbox-inline">
                                                                <label class="m-checkbox">
                                                                    <input type="checkbox" class="enable_visible" name="enable_visible[{{ $key }}]" {{ ($attribute_item->pivot->is_show) == 1 ? 'value="1" checked="checked"' : ''}} style="font-size: 14px;">
                                                                        Visible on the product page
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="m-checkbox-inline enable_option_product">
                                                                <label class="m-checkbox">
                                                                    <input type="checkbox" class="checkbox_enable_option_product" name="enable_option_product[{{ $key }}]" {{ ($attribute_item->pivot->is_option) == 1 ? 'value="1" checked="checked"' : ''}} style="font-size: 14px;">
                                                                        Use for option product
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        @empty
                                        @endforelse
                                    </div>
                                    <button type="button" class="btn btn-primary btn-sm save_attributes">Save attribute</button>
                                    <div class="col-12 text-center">
                                        <h4 id="text-attribute-disabled" class="m--font-danger"></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane selected_product_tab" id="tabs_option" role="tabpanel">
                                <div id="tabs_option_inner">
                                    @if ($countOption != 0)
                                        {{-- <div class="form-group m-form__group row pb-0">
                                            <label class="text-left col-lg-3 col-sm-12">Default Form Values: </label>
                                            <div class="col-lg-9 col-md-9 col-sm-12">
                                                @foreach ($options_product as $option_product)
                                                    <select class="attribute_select" name="attribute_product[]">
                                                        <option value="">No default {{ $option_product->name }}</option>

                                                        @php $array_optionvalue = explode(',',$option_product->pivot->attribute_value) @endphp
                                                        @foreach ($array_optionvalue as $optionvalue)
                                                            <option value="{{ $optionvalue }}">{{ $optionvalue }}</option>
                                                        @endforeach
                                                    </select>
                                                @endforeach
                                            </div>
                                        </div> --}}
                                        <div class="option_product my-3">  
                                            @foreach ($productVariant as $keyOption=> $parent)
                                            
                                                <div class="m-portlet m-portlet--head-solid-bg m-portlet--head-sm option_product_value" id="p-{{ isset($parent->id) ? str_slug($parent->id) :  'permissionHeading' }}">
                                                    <div class="m-portlet__head m-portlet__sm" id="dd-{{ isset($parent->id) ? str_slug($parent->id) :  'permissionHeading' }}head" data-toggle="collapse" aria-expanded="true" href="#dd-{{ isset($parent->id) ? str_slug($parent->id) :  'permissionHeading' }}">
                                                        <div class="m-portlet__head-caption">
                                                            <div class="m-portlet__head-title">
                                                                
                                                                <h3 class="m-portlet__head-text pr-3">
                                                                    <span>
                                                                        #{{ isset($parent->pivot->sku) ? $parent->pivot->sku : '' }}
                                                                        {{ isset($parent->parent->option->option_name) ? $parent->parent->option->option_name : '' }}
                                                                        {{ isset($parent->parent->value) ? $parent->parent->value : '' }}
                                                                        {{ isset($parent->option->option_name) ? $parent->option->option_name: '' }}
                                                                        {{ isset($parent->value) ? $parent->value: ''}}
                                                                    </span>
                                                                </h3>
                                                               
                                                            </div>
                                                        </div>
                                                        <div class="m-portlet__head-tools">
                                                            <ul class="m-portlet__nav">
                                                                <li class="m-portlet__nav-item">
                                                                    <a data-toggle="collapse" data-target="#dd-{{ isset($parent->id) ? str_slug($parent->id) :  'permissionHeading' }}" aria-expanded="false" aria-controls="dd-{{ isset($parent->id) ? str_slug($parent->id) :  'permissionHeading' }}" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-angle-down"></i></a>	
                                                                </li>
                                                                <li class="m-portlet__nav-item">
                                                                    <a href="#" m-portlet-tool="remove" data-id="{{ $parent->id}}" class="m-portlet__nav-link m-portlet__nav-link--icon remove_row"><i class="la la-close"></i></a>	
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div id="dd-{{ isset($parent->id) ? str_slug($parent->id) :  'permissionHeading' }}" class="collapse in">
                                                        <form class="saveoptionProductFrom">
                                                        <div class="m-portlet__body">
                                                            <input type="hidden" name="option_id[{{$keyOption}}]" value="{{ $parent->pivot->id}}">
                                                            <div class="form-group m-form__group row">
                                                                <label for="SKU" class="col-form-label text-left col-lg-2 col-md-2 col-sm-12">SKU</label>
                                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                                    <input type="text" name="SKU_OPTION[{{$keyOption}}]" class="form-control m-input" id="SKU" aria-describedby="SKUHelp" placeholder="Enter SKU" value="{{ isset($parent->pivot->sku) ? $parent->pivot->sku : old('SKU') }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group m-form__group row pt-0 stock-form">
                                                                <label for="SKU" class="col-form-label col-form-sm col-lg-2 text-left col-md-2 col-sm-12">Manage stock</label>
                                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                                    <div class="m-checkbox-inline">
                                                                        <label class="m-checkbox">
                                                                            <input type="checkbox" class="enable_stock_option" name="enable_stock_option[{{$keyOption}}]" {{ ($parent->pivot->enable_stock) == '0' ? '' : 'checked="checked"' }}>
                                                                                Enable stock management
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="setStockoption" style="{{ ($parent->pivot->enable_stock) == '0' ? 'display:none;' : '' }}padding-bottom:15px;">
                                                                <div class="form-group m-form__group row">
                                                                    <label for="Stock" class="col-form-label col-form-sm col-lg-2 text-left col-md-2 col-sm-12">Stock quantity</label>
                                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                                        <input type="text" name="inventory_quantity_option[{{$keyOption}}]" class="form-control m-input" id="Stock" aria-describedby="StockHelp" value="{{ isset($parent->pivot->inventory_quantity) ? $parent->pivot->inventory_quantity : old('SKU') }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                                <div class="m-accordion m-accordion--default m-accordion--toggle-arrow" id="m_accordion_{{$parent->id}}" role="tablist">                      

                                                                <!--begin::Item-->              
                                                                    <div class="m-accordion__item m-accordion__item--success">
                                                                        <div class="m-accordion__item-head collapsed " srole="tab" id="m_accordion_{{$parent->id}}_item_1_head" data-toggle="collapse" href="#m_accordion_{{$parent->id}}_item_1_body" aria-expanded="false">
                                                                            <span class="m-accordion__item-icon"><i class="fa 	fa-user"></i></span>
                                                                            <span class="m-accordion__item-title">User Price</span>
                                                                                
                                                                            <span class="m-accordion__item-mode"></span>     
                                                                        </div>

                                                                        <div class="m-accordion__item-body collapse show" id="m_accordion_{{$parent->id}}_item_1_body" role="tabpanel" aria-labelledby="m_accordion_{{$parent->id}}_item_1_head" data-parent="#m_accordion_{{$parent->id}}" style=""> 
                                                                            <div class="m-accordion__item-content">
                                                                                <div class="row m--margin-bottom-25">
                                                                                    <div class="col-md-6 col-12">
                                                                                        <div class="form-group m-form__group">
                                                                                            <label for="RegularPrice">Regular price</label>
                                                                                            <input type="text" name="regularPrice_option[{{$keyOption}}]" class="form-control form-control-sm m-input" id="RegularPrice" aria-describedby="RegularPriceHelp" placeholder="Enter regular price" value="{{ isset($parent->pivot->price) ? $parent->pivot->price : old('regularPrice') }}" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 col-12">
                                                                                        <div class="form-group m-form__group">
                                                                                            <label for="SalePrice">Sale price</label>
                                                                                            <input type="text" name="salePrice_option[{{$keyOption}}]" class="form-control form-control-sm m-input" id="SalePrice" aria-describedby="SalePriceHelp" placeholder="Enter sale price" value="{{ isset($parent->pivot ->discount_price) ? $parent->pivot->discount_price : old('salePrice') }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Item--> 

                                                                    <!--begin::Item--> 
                                                                    <div class="m-accordion__item m-accordion__item--info">
                                                                        <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_{{$parent->id}}_item_2_head" data-toggle="collapse" href="#m_accordion_{{$parent->id}}_item_2_body" aria-expanded="false">
                                                                            <span class="m-accordion__item-icon"><i class="fa	fa-users"></i></span>
                                                                            <span class="m-accordion__item-title">Distibutor Price</span>
                                                                                
                                                                            <span class="m-accordion__item-mode"></span>     
                                                                        </div>

                                                                        <div class="m-accordion__item-body collapse" id="m_accordion_{{$parent->id}}_item_2_body" role="tabpanel" aria-labelledby="m_accordion_{{$parent->id}}_item_2_head" data-parent="#m_accordion_{{$parent->id}}" style=""> 
                                                                            <div class="m-accordion__item-content">
                                                                                <div class="row m--margin-bottom-25">
                                                                                    <div class="col-md-6 col-12">
                                                                                        <div class="form-group m-form__group">
                                                                                            <label for="RegularPrice">Regular price</label>
                                                                                            <input type="text" name="regularPrice_Distibutor_option[{{$keyOption}}]" class="form-control form-control-sm m-input" id="RegularPrice" aria-describedby="RegularPriceHelp" placeholder="Enter regular price" value="{{ isset($parent->pivot->distibutor_price) ? $parent->pivot->distibutor_price : old('regularPrice_Distibutor_option') }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 col-12">
                                                                                        <div class="form-group m-form__group">
                                                                                            <label for="SalePrice">Sale price</label>
                                                                                            <input type="text" name="salePrice_Distibutor_option[{{$keyOption}}]" class="form-control form-control-sm m-input" id="SalePrice" aria-describedby="SalePriceHelp" placeholder="Enter sale price" value="{{ isset($parent->pivot ->distibutor_discount_price) ? $parent->pivot->distibutor_discount_price : old('salePrice_Distibutor_option') }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>   
                                                                    <!--end::Item--> 

                                                                    <!--begin::Item--> 
                                                                    <div class="m-accordion__item m-accordion__item--brand">
                                                                        <div class="m-accordion__item-head" role="tab" id="m_accordion_{{$parent->id}}_item_3_head" data-toggle="collapse" href="#m_accordion_{{$parent->id}}_item_3_body" aria-expanded="true">
                                                                            <span class="m-accordion__item-icon"><i class="fa fa-user-tie"></i></span>
                                                                            <span class="m-accordion__item-title">Dealer Price</span>
                                                                                
                                                                            <span class="m-accordion__item-mode"></span>     
                                                                        </div>

                                                                        <div class="m-accordion__item-body collapse" id="m_accordion_{{$parent->id}}_item_3_body" role="tabpanel" aria-labelledby="m_accordion_{{$parent->id}}_item_3_head" data-parent="#m_accordion_{{$parent->id}}" style=""> 
                                                                            <div class="m-accordion__item-content">
                                                                                <div class="row m--margin-bottom-25">
                                                                                    <div class="col-md-6 col-12">
                                                                                        <div class="form-group m-form__group">
                                                                                            <label for="RegularPrice">Regular price</label>
                                                                                            <input type="text" name="regularPrice_Dealer_option[{{$keyOption}}]" class="form-control form-control-sm m-input" id="RegularPrice" aria-describedby="RegularPriceHelp" placeholder="Enter regular price" value="{{ isset($parent->pivot->dealer_price) ? $parent->pivot->dealer_price : old('regularPrice_Dealer_option') }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 col-12">
                                                                                        <div class="form-group m-form__group">
                                                                                            <label for="SalePrice">Sale price</label>
                                                                                            <input type="text" name="salePrice_Dealer_option[{{$keyOption}}]" class="form-control form-control-sm m-input" id="SalePrice" aria-describedby="SalePriceHelp" placeholder="Enter sale price" value="{{ isset($parent->pivot ->dealer_discount_price) ? $parent->pivot->dealer_discount_price : old('salePrice_Dealer_option') }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>                       
                                                                    </div>
                                                                    <!--end::Item-->  
                                                                    <!--begin::Item--> 
                                                                    <div class="m-accordion__item m-accordion__item--shipping">
                                                                        <div class="m-accordion__item-head" role="tab" id="m_accordion_{{$parent->id}}_item_4_head" data-toggle="collapse" href="#m_accordion_{{$parent->id}}_item_4_body" aria-expanded="true">
                                                                            <span class="m-accordion__item-icon"><i class="fa flaticon-truck"></i></span>
                                                                            <span class="m-accordion__item-title">Shipping Price</span>
                                                                                
                                                                            <span class="m-accordion__item-mode"></span>     
                                                                        </div>

                                                                        <div class="m-accordion__item-body collapse" id="m_accordion_{{$parent->id}}_item_4_body" role="tabpanel" aria-labelledby="m_accordion_{{$parent->id}}_item_4_head" data-parent="#m_accordion_{{$parent->id}}" style=""> 
                                                                            <div class="m-accordion__item-content">
                                                                                <div class="row m--margin-bottom-25">
                                                                                    <div class="col-md-6 col-12">
                                                                                        <div class="form-group m-form__group">
                                                                                            <label for="ShippingPrice">Shipping price</label>
                                                                                            <input type="text" name="shippingPrice_option[{{$keyOption}}]" class="form-control form-control-sm m-input" id="shippingPrice_option" aria-describedby="shippingPrice_optionHelp" placeholder="Enter shipping price" value="{{ isset($parent->pivot->shipping_price) ? $parent->pivot->shipping_price : old('shippingPrice_option') }}" required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>                       
                                                                    </div>
                                                                    <!--end::Item-->                  
                                                                </div>
                                                            <div class="row">
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group m-form__group">
                                                                        <button type="button" class="btn btn-info btn-sm save_option_product">Save</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </form>
                                                        
                                                    </div>
                                                    
                                                </div>                                          
                                            @endforeach

                                            <div class="form-group m-form__group row pb-0">
                                                <div class="col-lg-auto col-md-auto col-sm-12">
                                                    <button type="button" class="btn btn-success add_option_product">Add option to this product</button>
                                                </div>
                                            </div>
                                            
                                        </div> 
                                        <button type="button" class="btn btn-primary btn-sm save_option_values" style="display:none;">Save options</button>
                                    @else 
                                        Before you can add a product option you need to add some product attributes on the Attributes tab.
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs_images" role="tabpanel">
                                <div class="row">
                                    <div class="col-12"> 
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#add_multi_images" class="btn btn-primary btn-sm">Add Image</a>
                                    </div>

                                    
                                    @if($images != null)
                                        @foreach($images as $image)
                                            <div class="col-3 col-md-3">
                                                <a href="javascript:void(0)" data-image="{{ $image }}" data-id="{{ $data->id }}" class="remove-images"><i class="fa fa-times" style="position:absolute;right:0;color:red;"></i></a>
                                                <img src="{{ asset($image) }}" class="img-fluid border" alt="">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
            <div class="m-portlet m-portlet--head-sm">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">SEO</h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group">
						<label for="SEOTITLE">SEO title</label>
						<input type="text" class="form-control m-input" id="SEOTITLE" name="meta_title" aria-describedby="SEOTITLEHelp" value="{{ isset($data->meta_title) ? $data->meta_title : '' }}" placeholder="Enter SEO title">
						<span class="m-form__help">If you not setting this value. The system will use product name to SEO title.</span>
                    </div>
                    <div class="form-group m-form__group">
						<label for="SEOKEYS">SEO keywords</label>
						<input type="text" class="form-control m-input" id="SEOKEYS" name="meta_keywords" aria-describedby="SEOKEYSHelp" value="{{ isset($data->meta_keyword) ? $data->meta_keyword : '' }}" placeholder="Enter SEO keywords">
                    </div>
                    <div class="form-group m-form__group">
						<label for="SEODESC">SEO description</label>
						<textarea class="form-control m-input" id="SEODESC"  name="meta_description" aria-describedby="SEODESCHelp" placeholder="Enter SEO description">{{ isset($data->meta_description) ? $data->meta_description : '' }}</textarea>
						<span class="m-form__help">If you not setting this value. The system will use product short description to SEO description.</span>
					</div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
        <div class="col-lg-3">
            <div class="m-portlet m-portlet--head-sm">
                <div class="m-portlet__body ">
                    <div class="form-group m-form__group row pb-0">
                        <label for="GoodSeller" class="col-form-label col-lg-5 col-sm-12 ">Best Seller</label>
                        <div class="col-lg-7 col-md-7 col-sm-12 text-center">
                            <input data-switch="true" data-size="small" name="is_sale" type="checkbox" id="GoodSeller" @if(!empty($data->is_sales) == 1) checked="checked" @endif>
                        </div>
                    </div>
                    <div class="form-group m-form__group row ">
                        <label for="Published" class="col-form-label col-lg-5 col-sm-12 ">Published</label>
                        <div class="col-lg-7 col-md-7 col-sm-12 text-center">
                            <input data-switch="true" data-size="small" name="is_show" type="checkbox" id="Published" @if(!empty($data->is_show) == 1) checked="checked" @endif>
                        </div>
                    </div>
                    <div class="form-group m-form__group row pb-0">
                        <label for="is_banner" class="col-form-label col-lg-5 col-sm-12 ">On right Top Banner</label>
                        <div class="col-lg-7 col-md-7 col-sm-12 text-center">
                            <input data-switch="true" data-size="small" name="is_banner" type="checkbox" id="is_banner" @if(!empty($data->is_banner) == 1) checked="checked" @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-brand productFromSubmit" id="button">
                                @isset($data) Update @else Submit @endisset
                            </button>
                            <button type="reset" class="btn btn-secondary">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet m-portlet--head-sm">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Product image
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <img id="img_show" src="{{ isset($data->image) ?  Storage::url($data->image) : '' }}" alt="" class="img-fluid img">
                    <input type="hidden" name="old_image" value="{{ isset($data->image) ? $data->image: '' }}">
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="image" {{ isset($data->image) ? '' : '' }}>
                        <label class="custom-file-label" for="customFile">
                            Choose file
                        </label>
                    </div>
                </div>
            </div>
            <div class="m-portlet m-portlet--head-sm">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Brand
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group">
                        <select class="form-control m-select2" id="m_select2_brands" name="brand">
                            <option value=""></option>
                            @foreach ($brands as $brand)
                                <option value="{{$brand->id}}" @isset($data->brand_id) @if($brand->id == $data->brand_id) selected @endif @endisset> {{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="m-portlet m-portlet--head-sm">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Categories
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="product_cat_all">
                        <ul id="product_catchecklist" class="categorychecklist">
                            @foreach($categories as $category)
                                <li class="product_cat-{{$category->id}}">
                                    <label class="selectit">
                                        <input value="{!! $category->id !!}" type="checkbox" name="productcat[]" id="in-product_cat-{{$category->id}}" {{ $categoriesForProduct->contains($category) ? 'checked' : '' }}> {{$category->name}}
                                    </label>
                                    @if($category->children->count())
                                        @include ('backend.products.category', ['categories' => $category->children , 'categoriesForProduct' => $categoriesForProduct])
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="m-portlet m-portlet--head-sm">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Tags
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group">
                        <select class="form-control m-select2" id="m_select2_tags" name="tags[]" multiple="multiple">
                            <option value=""></option>
                            @foreach ($tags as $tag)
                                <option value="{{$tag->slug}}" {{ $tagsForProduct->contains($tag) ? 'selected' : '' }}> {{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

    </div>

</form>

<div class="modal fade" id="add_multi_images" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.catalogs.product.gallery') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                <div class="modal-header m--bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add Images</h5>
                    <button type="button" class="close  text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group m-form__group">
                        <label for="images">Images</label>
                        <input type="file" class="form-control m-input" multiple name="images[]" id="images" aria-describedby="name-error"
                            aria-invalid="true">

                        <output id="result" class="row"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="ShippingZoneSubmit">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Form-->
@stop

@push('script')

<script src="{{ asset('js/backend/vendor/bootstrap-switch.js') }}" type="text/javascript"></script>
{{-- 
<script src="{{ asset('js/backend/vendor/summernote-image-attributes.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/backend/vendor/summernote-fontawesome.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/backend/vendor/summernote-video-attributes.js') }}" type="text/javascript"></script>
 --}}
<script src="{{ asset('js/backend/vendor/jquery-ui.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/backend/vendor/draggable.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.3/tinymce.min.js"></script>
@toastr_render
<script>
window.onload = function(){   
    //Check File API support
    if(window.File && window.FileList && window.FileReader)
    {
        $(document).on("change", '#images', function(event) {
            var files = event.target.files; //FileList object
            var output = document.getElementById("result");
            for(var i = 0; i< files.length; i++)
            {
                var file = files[i];
                //Only pics
                // if(!file.type.match('image'))
                if(file.type.match('image.*')){
                    if(this.files[0].size < 2097152){    
                  // continue;
                    var picReader = new FileReader();
                    picReader.addEventListener("load",function(event){
                        var picFile = event.target;
                        var div = document.createElement("div");
                        div.innerHTML = "<img class='thumbnail img-fluid col-3' src='" + picFile.result + "'" +
                                "title='preview image'/>";
                        output.insertBefore(div,null);            
                    });
                    //Read the image
                    $('#clear, #result').show();
                    picReader.readAsDataURL(file);
                    }else{
                        alert("Image Size is too big. Minimum size is 2MB.");
                        $(this).val("");
                    }
                }else{
                alert("You can only upload image file.");
                $(this).val("");
            }
            }                               
           
        });
    }
    else
    {
        console.log("Your browser does not support File API");
    }
}
$(document).on("click", '#images', function() {
        $('.thumbnail').parent().remove();
        $('result').hide();
        $(this).val("");
});



$(document).ready( function(){
    


    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var action_product = {!! isset($data) ? '1' : '0' !!};
    
    if(action_product == 0){
        $('#tabs_attribute').find('select.attribute_select , button.add-attribute , button.save_attributes').hide();
        $('#text-attribute-disabled').text('You should insert product Before use Attribute Tabs');
    }   
    
    $(document).on('click' , '.enable_stock_option', function() {
        if ($(this).prop('checked')) $(this).closest('.stock-form').next('.setStockoption').show();
                //$('.setStock').show();
        else $(this).closest('.stock-form').next('.setStockoption').hide();
    });

    $(document).on('click' , '.remove-images', function() {
        confirm("You want to delete this image ? ");
        var $containt = $(this); 
        params = {
            image:  $(this).data('image'),
            id:     $(this).data('id'),
            _token: '{{ csrf_token() }}'
        }
        $.post('{{ route('admin.catalogs.product.gallery.remove') }}', params, function (response) {
            if ( response
                && response.data
                && response.data.status
                && response.data.status == 200 ) {

                toastr.success(response.data.message);
                console.log($(this));
                $containt.parent().fadeOut(300, function() { $(this).remove(); })
            } else {
                toastr.error("Error removing image.");
            }
        });
    });

    var editor_config = {
    path_absolute: "",
    menubar: false,
    branding: false,
    selector: ".body_description",
    plugins: [
        "advlist anchor autolink codesample colorpicker contextmenu fullscreen help image imagetools",
        " lists link media noneditable preview",
        " searchreplace table template textcolor visualblocks"
    ],
    toolbar: 'undo redo | mybutton formatselect fontselect fontsizeselect forecolor | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | link | fullscreen code ',
    custom_colors: false,
    image_advtab: true,
    powerpaste_allow_local_images: true,
    content_css: [
        '//fonts.googleapis.com/css?family=Kanit:300,300i,400,400i'
    ],

    relative_urls: false,
    height: 300,
    setup: function (editor) {
        editor.addButton('mybutton', {
            text: 'เพิ่มรูปภาพ',
            icon: 'image',
            onclick: function () {
                tinyMCE.execCommand('mceImage')
            }
        });      
    },
    // without images_upload_url set, Upload tab won't show up
    images_upload_url: '{!! route('admin.catalogs.product.imagebody') !!}',
    
    // we override default upload handler to simulate successful upload
    automatic_uploads : false,

    images_upload_handler : function(blobInfo, success, failure) {
        var xhr, formData;

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '{!! route('admin.catalogs.product.imagebody') !!}');
        xhr.onload = function() {
            var json;

            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.file_path != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }

            success(json.file_path);
        };

        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        formData.append( "_token", '{!! csrf_token() !!}');


        xhr.send(formData);
    },
};
    tinymce.init(editor_config);
    
});


var product_id = {!! isset($data->id) ? $data->id : "''" !!};
$("#m_select2_productdata").select2({
    placeholder: "Select a parent",
    allowClear: false,
    minimumResultsForSearch:1/0
});

$("#short_description").keyup(function(){

    $("#short_description_count").text("Characters left: " + (250 - $(this).val().length));
    if($(this).val().length == 250){
        $("#short_description_count").css({
            'color': 'red',
            'font-weight': 'bold'
        });
    }
});
$("select#m_select2_productdata").change(function () {
     var t = $(this).val();
     "selectedproduct" !== t && $("input.checkbox_enable_option_product").prop("checked", !1)
});
$('#m_select2_brands').select2({
    placeholder: "Select a brands",
    allowClear: false,
    minimumResultsForSearch:1/0
});
$("#m_select2_tags").select2({
    placeholder: "Select tags",
    tags: true,
    // automatically creates tag when user hit space or comma:
    tokenSeparators: [",", " "],
    closeOnSelect: false
});
function formatRepoSelection (repo) {
    return repo.name || repo.text;
}
$("#m_select2_relate1").select2({
    closeOnSelect: false,
    allowClear: true,
    ajax: {
        url: "{!! route('admin.catalogs.product.relate') !!}",
        dataType: "json",
        delay: 250,
        data: function (e) {
            return {
                q: e.term
            }
        },
        processResults: function (e, t) {
            return t.page = t.page || 1, {
                results: e.items,
                pagination: {
                    more: 30 * t.page < e.total_count
                }
            }
        },
        cache: true
    },
    escapeMarkup: function (e) {
        return e;
    },
    minimumInputLength: 2,
    templateResult: function (e) {
        if (e.loading) return e.text;
        return e.name
    },
    templateSelection: formatRepoSelection,
    placeholder: 'Search for a product'
});
$(document).on('click', 'button.add-attribute', function(){
    if($("select.attribute_select").val() == ''){
        alert('You should select attribute before add');
        return false;
    }
    var t = $(".product_attributes .attribute").length,
        e = $("select.attribute_select").val(),
        i = $(this).closest("#tabs_attribute"),
        o = $(".product_attributes"),
        a = $("select#m_select2_productdata").val(),
        c = {
            _token: '{!! csrf_token() !!}',
            action: "pp_add_attribute",
            attribute_id: e,
            i: t,
        };
    return i.block({
        message: null,
        overlayCSS: {
            background: "#fff",
            opacity: .6
        }
    }),
    $.post('{!! route('admin.ajaxload') !!}', c, function (t) {
        o.append(t), $(document.body).trigger("select-value-init"),i.unblock()
    }),
    e && ($("select.attribute_select").find('option[value="' + e + '"]').attr("disabled", "disabled"), $("select.attribute_select").val("")), !1
}),
$('.product_attributes').on("click" , "input.checkbox_enable_option_product" , function() {
    if ($(this).prop('checked')){
        if("selectedproduct" !== $("select#m_select2_productdata").val()){
            alert('You should product type to "Selected product" for checked this.');
            return false;
        }
    }
}),
$(".product_attributes").on("blur", "input.name_attribute", function () {
    $(this).closest(".attribute").find("h4.m-portlet__head-text").text($(this).val())
}),
$(document.body).on("click", ".product_attributes .remove_row", function () {
    if (window.confirm('Remove this attribute?')) {
        var t = $(this).parent().parent().parent().parent().parent();
        t.is(".taxonomy") ? (t.find("select, input[type=text]").val(""), t.remove(), $("select.attribute_select").find('option[value="' + t.data("taxonomy") + '"]').removeAttr("disabled")) : (t.find("select, input[type=text]").val(""), t.remove())
    
    }
    return !1
}),
$(document).on('click', 'button.save_attributes', function(){
    $("#tabs_attribute #tabs_attribute_inner").block({
        message: null,
        overlayCSS: {
            background: "#fff",
            opacity: .6
        }
    });
    var t = {
        data_id: '{!! isset($data) ? $data->id : '' !!}',
        _token: '{!! csrf_token() !!}',
        product_type: $("#m_select2_productdata").val(),
        data: $(".product_attributes").find("input, select, textarea").serialize(),
        action: "pp_save_attributes"
    };
    $.post('{!! route('admin.ajaxload') !!}', t, function () {
        var t = window.location.toString();
        $("#tabs_attribute").load(t + " #tabs_attribute_inner", function () {
            $(document.body).trigger("select-value-init");
            $(document.body).trigger("remove_row");
            $("#tabs_option").load(t + " #tabs_option_inner");
            PortletDraggable.init();
        });
    });
});
$(document).on('click', 'button.add_option_product', function(){
    $("#tabs_option_inner").block({
        message: null,
        overlayCSS: {
            background: "#fff",
            opacity: .6
        }
    });
    var a = {
            action: "pp_add_variation",
            _token: '{!! csrf_token() !!}',
            data_id: product_id,
            loop: $(".option_product_value").length
        };
        return $.post('{!! route('admin.ajaxload') !!}', a, function (a) {
            $('.option_product').append(a);
            $("#tabs_option_inner").unblock();
            $('.save_option_values').show();
            $('button.add_option_product').attr('disabled' , 'disabled');
            //$(document.body).trigger( 'enable_stock_option' );
            //$("#tabs_option").load(a + " #tabs_option_inner");
        })
});

$(".attribute_value").select2({
        placeholder: "Select value",
        tags: true,
        // automatically creates tag when user hit space or comma:
        tokenSeparators: [",", " "],
        closeOnSelect: false
});
$(document.body).on("select-value-init", function () {
    $(".attribute_value").select2({
        placeholder: "Select value",
        tags: true,
        // automatically creates tag when user hit space or comma:
        tokenSeparators: [",", " "],
        closeOnSelect: false
    }),
    $('.attribute_value').css('width' , '100%!important')
});
$('#m_select2_productdata').on( 'change' , function() {
    if($(this).val() == 'singleproduct'){
        $('.selected_product_item').hide();
        $('.m-tabs__link').each(function () {
            if ($(this).attr("aria-selected") == "true") {
                if($(this).attr('id') != 'Optionproduct'){
                    $(this).click()
                }else{
                    $('.first-item-tabs').click()
                }
            }
        });
    }else{
        $('.selected_product_item').show();
    }
});


	
var strToThaiSlug = function (str){
  return str.replace(/\s+/g, '-')           // Replace spaces with -
      .replace('%', 'เปอร์เซนต์')         // Translate some charactor
      .replace(/[^\u0E00-\u0E7F\w\-]+/g, '') // Remove all non-word chars
      .replace(/\-\-+/g, '-')         // Replace multiple - with single -
      .replace(/^-+/, '')             // Trim - from start of text
      .replace(/-+$/, '');  
}
function readURL(input) {

    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#img_show').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}

$("#image").change(function() {
    readURL(this);
});
$('#name').on('keyup' , function() {
    var text = $(this).val();
    $('#slug').val(strToThaiSlug(text));
});

// var $postSummernot = $('#body_description , #body_description_en').summernote({
//     height: 300,                 // set editor height
//     minHeight: null,             // set minimum height of editor
//     maxHeight: null,             // set maximum height of editor=
//     fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New' , 'Kanit' ,'rsuregular' , 'rsulight'],  
//     fontNamesIgnoreCheck: ['Kanit','rsuregular' , 'rsulight'],  // set maximum height of editor=
//     toolbar: [
//         // [groupName, [list of button]]
//         ['style', ['bold', 'italic', 'underline', 'clear','fontIcon']],
//         ['font', ['strikethrough', 'superscript', 'subscript']],
//         ['fontsize', ['fontsize' , 'fontname']],
//         ['color', ['color']],
//         ['para', ['ul', 'ol', 'paragraph']],
//       //    ['para', ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull']],
//         ['height', ['height']],
//         ['insert', ['picture' , 'table' , 'video' , 'hr' ,'link']],
//         ['misc', ['undo' , 'redo' , 'fullscreen' ,'codeview']],
//     ],
//     // popover: {
//     //     picture: [
//     //         ['custom', ['imageAttributes']],
//     //         ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
//     //         ['float', ['floatLeft', 'floatRight', 'floatNone']],
//     //         ['remove', ['removeMedia']]
//     //     ],
//     // },
//     lang: 'en-US', // Change to your chosen language
//     image:{
//         icon:'<i class="note-icon-pencil"/>',
//         removeEmpty:false, // true = remove attributes | false = leave empty if present
//         disableUpload: false // true = don't display Upload Options | Display Upload Options
//     }
// });


function sendFile(files, $postSummernot) {
    var formData = new FormData();
    formData.append( "_token", '{!! csrf_token() !!}');
    formData.append("file", files);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $.ajax({
            url: "{!! route('admin.catalogs.product.imagebody') !!}",
            data:formData,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(data){
                $postSummernot.summernote('insertImage', data, function ($image) {
                    $image.attr('src', data).attr('style' , 'max-width:100%;height:auto;');
                });
            }
        });
}




$(document.body).on("click", ".option_product_value .remove_row", function () {
    if (window.confirm('Remove this attribute?')) {
        var t = $(this).parent().parent().parent().parent().parent(),
            data = {
                id : $(this).data('id'),
                action : 'remove_option',
                _token: '{!! csrf_token() !!}',
            }

        $('.save_option_values').hide();
        $.post('{!! route('admin.ajaxload') !!}', data, function (r) {
            var t = window.location.toString();
            if(r.status == "failed"){
                alert(r.message);
            }else{
                $("#tabs_option").load(t + " #tabs_option_inner");
            }
        });
        t.is(".taxonomy") ? (t.find("select, input[type=text]").val(""), t.remove()) : (t.find("select, input[type=text]").val(""), t.remove(), $('button.add_option_product').removeAttr('disabled'))

    }
    return !1
});

$(document.body).on('click' , '.option_product_value .save_option_product' , function (){
    $("#tabs_option_inner").block({
        message: null,
        overlayCSS: {
            background: "#fff",
            opacity: .6
        }
    });
    //alert($(".option_product").find('.regularPrice').val());
    var t = {
        data_id: '{!! isset($data) ? $data->id : '' !!}',
        _token: '{!! csrf_token() !!}',
        data: $(".option_product_value").find("input").serialize(),
        action: "pp_save_product_options"
    };
    $.post('{!! route('admin.ajaxload') !!}', t, function (r) {
        var t = window.location.toString();
        if(r.status == "failed"){
            alert(r.message);
        }else{
            $("#tabs_option").load(t + " #tabs_option_inner");

        }
        $("#tabs_option_inner").unblock();
        $('.enable_stock_option').trigger( 'click' );
        $(document.body).trigger("save_option_product");

    });

});

$(document).on('click', 'button.save_option_values', function(event){
    $('.addoptionProductFrom').each(function() {  // attach to all form elements on page
        if($(this).valid()){   // test for validity
            $("#tabs_option_inner").block({
                message: null,
                overlayCSS: {
                    background: "#fff",
                    opacity: .6
                }
            });
            //alert($(".option_product").find('.regularPrice').val());
            var t = {
                data_id: '{!! isset($data) ? $data->id : '' !!}',
                _token: '{!! csrf_token() !!}',
                data: $(".option_product").find("input, select, textarea").serialize(),
                action: "pp_save_options"
            };
            $.post('{!! route('admin.ajaxload') !!}', t, function (r) {
                var t = window.location.toString();
                if(r.status == "failed"){
                    alert(r.message);
                }else{
                    $("#tabs_option").load(t + " #tabs_option_inner");
                }
                $("#tabs_option_inner").unblock();
            });
        }
        
    });
    
});
var valueStock = {!! isset($data->enable_stock) ? $data->enable_stock : '0' !!};
if(valueStock != 0){
    $('.enable_stock').click();
    $('.setStock').show();
}
$('.enable_stock').on ('click' , function() {
    if ($(this).prop('checked')) $('.setStock').show();
    else $('.setStock').hide();
});


$('#productFrom').validate({
    ignore: ":hidden",
    rules: {
        inventory_quantity: "required",
    },
    messages: {
        inventory_quantity: "Stock required",
    
    },
    invalidHandler: function (e, validator) {
        if(validator.errorList.length){
            $('#tabs a[href="#' + $(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
        }
        //$("#productFrom_msg").removeClass("m--hide").show(), mUtil.scrollTop()
        
    }
    // invalidHandler: function(e, validator){
    //     if(validator.errorList.length)
    //     $('#tabs a[href="#' + $(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
    // }
});

$('.productFromSubmit').click(function(evt) {
    evt.preventDefault();
    $('#productFrom').submit()
});
</script>
@endpush
