@extends('layouts.backend.master')
@section('title.page' , 'HOME PAGE SETTING > Banner')


@section('breadcrumb')
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
        <li class="m-nav__item m-nav__item--home">
            <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
            <i class="m-nav__link-icon la la-home"></i>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="" class="m-nav__link">
                <span class="m-nav__link-text">HOME PAGE SETTING</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('admin.widgets.banner.index')}}" class="m-nav__link">
                <span class="m-nav__link-text">Banner</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <span class="m-nav__link-text">Edit banner</span>
        </li>
    </ul>
@stop


@section('content')
    <!--begin::Portlet-->
<div class="m-portlet">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    {{ isset($data) ? 'Edit' : 'Create' }} A Banner
                </h3>
            </div>
        </div>
    </div>
    <!--begin::Form-->
    <form class="m-form m-form m-form--state m-form--label-align-right" action="@if(isset($data)) {{ route('admin.widgets.banner.update' , $data->id)}} @else {{ route('admin.product.datas.store') }} @endif" method="POST" enctype="multipart/form-data">
    @csrf()

    @if(isset($data))
        @method('PUT')
    @endif
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group m-form__group row {{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label class="col-form-label col-lg-3 col-sm-12">
                            URL Link
                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <input type="text" name="url_link" class="form-control m-input" id="url_link" aria-describedby="emailHelp" placeholder="Enter URL Link" value="{{ isset($data->url_link) ? $data->url_link : '' }}">
                            <span class="m-form__help">If you no set URL link you don't have link into slide</span>
                            @if ($errors->has('url_link'))
                                 <div class="form-control-feedback">
                                    {{ $errors->first('url_link') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-3 col-sm-12">
                            Image
                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <img src="{{ isset($data->image) ?  Storage::url($data->image) : '' }}" alt="" style="height:150px" class="img-fluid">
                            <input type="hidden" name="old_image" value="{{ isset($data->image) ? $data->image: '' }}">
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="customFile" {{ isset($data->image) ? '' : '' }}>
                                <label class="custom-file-label" for="customFile">
                                    Choose file
                                </label>
                                <span class="m-form__help @if ($errors->has('image'))  text-danger @endif">Size 1200*400px</span>
                                    @if ($errors->has('image'))
                                    <div class="form-control-feedback text-danger">
                                        {{ $errors->first('image') }}
                                    </div>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="offset-md-3 offset-md-3 col-lg-7 col-md-7 col-sm-12">
                                <div class="m-checkbox-inline">
                                    <label class="m-checkbox">
                                        <input type="checkbox" class="enable" name="enable" {{ ($data->enable == 1) ? 'checked': ''}}>
                                            Enable show banner
                                        <span></span>
                                    </label>
                                </div>
                                <span class="m-form__help">If you want to show banner on website to check this.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions">
                <div class="row">
                    <div class="col-lg-7 ml-lg-auto">
                        <button type="submit" class="btn btn-data">
                            Submit
                        </button>
                        <a href="{{ route('admin.widgets.banner.index')}}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--end::Form-->
</div>
<!--end::Portlet-->

@stop

@push('script')
@toastr_render

@endpush
