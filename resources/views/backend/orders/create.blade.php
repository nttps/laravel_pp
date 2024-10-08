@extends('layouts.backend.master')

@push('css')
    <!-- include summernote css/js -->
     <!-- include summernote css/js -->
     <link href="https://summernote.org/vendors/summernote/dist/summernote.css" rel="stylesheet">
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
    ul.categorychecklist li label input[type=checkbox]:checked:before {
        float: left;
        display: inline-block;
        vertical-align: middle;
        width: 14px;
        font: normal normal normal 14px/1 FontAwesome;
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
        line-height: 1;
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
        cursor: move;
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
        font:normal normal normal 14px/1 FontAwesome;
        content: "\f1ce";
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
            <span class="m-nav__link-text">{{ isset($data) ? 'Edit' : 'Create' }} Order</span>
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
                <div class="m-portlet__body">
                    <div class="m-form__section m-form__section--first">
                        <div class="m-form__heading">
                            <h3 class="m-form__heading-title">Customer Information</h3>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Name:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" name="name" class="form-control m-input"
                                    placeholder="PP Name" value="">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">*
                                Email:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="email" name="email" class="form-control m-input"
                                    placeholder="pp@e@gmail.com" value="">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Phone</label>
                            <div class="col-xl-9 col-lg-9">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="la la-phone"></i></span></div>
                                    <input type="text" name="phone" class="form-control m-input"
                                        placeholder="0822222222" value="">
                                </div>
                            </div>
                        </div>
                        <div class="m-form__heading">
                            <h3 class="m-form__heading-title">
                                Shipping Information
                                <i data-toggle="m-tooltip" data-width="auto" class="m-form__heading-help-icon flaticon-info"
                                    title="" data-original-title="Some help text goes here"></i>
                            </h3>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">*
                                Address Line 1:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" name="address1" class="form-control m-input"
                                    placeholder="" value="">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Address
                                Line 2:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" name="address2" class="form-control m-input"
                                    placeholder="" value="P.O. Box 942873 Sacramento, CA 94273-0001">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* City:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" name="city" class="form-control m-input"
                                    placeholder="" value="">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">*
                                State:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" name="state" class="form-control m-input"
                                    placeholder="" value="">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">*
                                Country:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" name="country" class="form-control m-input"
                                    placeholder="" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
            <div class="m-portlet m-portlet--head-sm" id="product_data_div">
                <div class="m-portlet__body">
                    <div class="m-form__section m-form__section--first">
                        <div class="m-form__heading">
                            <h3 class="m-form__heading-title">Product Items</h3>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
        <div class="col-lg-3">
            <div class="m-portlet m-portlet--head-sm">
                <div class="m-portlet__body ">
                   
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
            
        </div>

    </div>

</form>
<!--end::Form-->
@stop

@push('script')

@toastr_render
<script>

$(document).ready( function(){

});
</script>
@endpush
