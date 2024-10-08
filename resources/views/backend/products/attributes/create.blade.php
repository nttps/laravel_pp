@extends('layouts.backend.master')
@section('title.page' , 'Arttibutes')


@section('breadcrumb')
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
        <li class="m-nav__item m-nav__item--home">
            <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
            <i class="m-nav__link-icon la la-home"></i>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('admin.catalogs.attributes.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Arttibutes</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <span class="m-nav__link-text">{{ isset($attribute) ? 'Edit' : 'Create' }} Arttibute</span>
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
                    {{ isset($attribute) ? 'Edit' : 'Create' }} A Arttibute
                </h3>
            </div>
        </div>
    </div>
    <!--begin::Form-->
    <form class="m-form m-form m-form--state m-form--label-align-right" action="@if(isset($attribute)) {{ route('admin.catalogs.attributes.update' , $attribute->id) }} @else {{ route('admin.product.attributes.store') }} @endif" method="POST">
    @csrf()

    @if(isset($attribute))
        @method('PUT')
    @endif
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="form-group m-form__group row {{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label class="col-form-label col-lg-3 col-sm-12">
                            Attibute name
                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <input type="text" name="name" class="form-control m-input" id="name" aria-describedby="emailHelp" placeholder="Enter name attribute" value="{{ isset($attribute->name) ? $attribute->name : old('name') }}" required>
                            @if ($errors->has('name'))
                                <div class="form-control-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group m-form__group row {{ $errors->has('value') ? ' has-danger' : '' }}">
                        <label class="col-form-label col-lg-3 col-sm-12">
                            Value
                        </label>
                        <div class="col-lg-9 col-sm-12">
                            <textarea type="text" rows="4" name="value" class="form-control m-input" required id="value" aria-describedby="emailHelp" placeholder="Enter some text, or some attributes by , separating values.">{{ isset($attribute->value) ? $attribute->value : old('value') }}</textarea>
                            @if ($errors->has('value'))
                                <div class="form-control-feedback">
                                    {{ $errors->first('value') }}
                                </div>
                            @endif
                            <span class="m-form__help">Enter some text, or some attributes by , separating values.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions">
                <div class="row">
                    <div class="col-lg-7 ml-lg-auto">
                        <button type="submit" class="btn btn-brand">
                            Submit
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            Cancel
                        </button>
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
<script>
</script>
@endpush
