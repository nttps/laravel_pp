@extends('layouts.backend.master')
@section('title.page' , 'Brands')


@section('breadcrumb')
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
        <li class="m-nav__item m-nav__item--home">
            <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
            <i class="m-nav__link-icon la la-home"></i>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('admin.catalogs.brands.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Brands</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <span class="m-nav__link-text">{{ isset($brand) ? 'Edit' : 'Create' }} Brand</span>
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
                    {{ isset($brand) ? 'Edit' : 'Create' }} A Brand
                </h3>
            </div>
        </div>
    </div>
    <!--begin::Form-->
    <form class="m-form m-form m-form--state m-form--label-align-right" action="@if(isset($brand)) {{ route('admin.catalogs.brands.update' , $brand->id) }} @else {{ route('admin.catalogs.brands.store') }} @endif" method="POST" enctype="multipart/form-data">
    @csrf()

    @if(isset($brand))
        @method('PUT')
    @endif
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group m-form__group row {{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label class="col-form-label col-lg-3 col-sm-12">
                            Name
                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <input type="text" name="name" class="form-control m-input" id="name" aria-describedby="emailHelp" placeholder="Enter name brand" value="{{ isset($brand->name) ?  $brand->name : old('name' , '') }}" required>
                            @if ($errors->has('name'))
                                 <div class="form-control-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-3 col-sm-12">
                            Slug URI
                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <input type="text" id="slug" name="slug" class="form-control m-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter slug uri brand" value="{{ isset($brand->slug) ? $brand->slug : old('slug' , '') }}" required>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-3 col-sm-12">
                            Image
                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12 @if ($errors->has('image')) has-danger @endif">
                            <img id="img_show" src="{{ isset($brand->images) ? Storage::url($brand->images) : '' }}" alt="" style="height:60px" class="img-fluid img">
                            <input type="hidden" name="old_image" value="{{ isset($brand->images) ? $brand->images: '' }}">
                            <div class="custom-file">
                                <input type="file" name="image" id="image" class="custom-file-input" id="customFile" {{ isset($brand->image) ? '' : '' }}>
                                <label class="custom-file-label" for="customFile">
                                    Choose file
                                </label>
                            </div>
                            <div class="form-control-feedback">
                                Image Size 150*60px
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-3 col-sm-12">
                            Seo title
                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <input type="text" name="seo_title" class="form-control m-input" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ isset($brand->seo_title) ? $brand->seo_title : old('seo_title' , '') }}" placeholder="Enter Seo title">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-3 col-sm-12">
                            Seo keyword
                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <input type="text" name="seo_keywords" class="form-control m-input" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ isset($brand->seo_keywords) ? $brand->seo_keywords : old('seo_keywords' , '') }}" placeholder="Enter Seo keyword">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-3 col-sm-12">
                            Seo description
                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                        <textarea name="seo_description" class="form-control m-input" name="" id="" cols="30" rows="5">{{ isset($brand->seo_description) ? $brand->seo_description : old('seo_description' , '') }}</textarea>
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
var strToThaiSlug = function (str){
  return str.replace(/\s+/g, '-')           // Replace spaces with -
      .replace('%', 'เปอร์เซนต์')         // Translate some charactor
      .replace(/[^\u0E00-\u0E7F\w\-]+/g, '') // Remove all non-word chars
      .replace(/\-\-+/g, '-')         // Replace multiple - with single -
      .replace(/^-+/, '')             // Trim - from start of text
      .replace(/-+$/, '');  
}
$('#name').on('keyup' , function() {
    var text = $(this).val();
    $('#slug').val(strToThaiSlug(text));
});

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
</script>
@endpush
