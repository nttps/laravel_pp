@extends('layouts.backend.master')
@section('title.page' , 'Categories')


@section('breadcrumb')
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
        <li class="m-nav__item m-nav__item--home">
            <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
            <i class="m-nav__link-icon la la-home"></i>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('admin.catalogs.categories.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Categories</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <span class="m-nav__link-text">{{ isset($category) ? 'Edit' : 'Create' }} Category</span>
        </li>
    </ul>
@stop


@section('content')
    <!--begin::Portlet-->
<div class="m-portlet animated fadeInRight">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    {{ isset($category) ? 'Edit' : 'Create' }} A Category
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
			<ul class="m-portlet__nav">
				<li class="m-portlet__nav-item">
                        <a href="{{ route('admin.catalogs.categories.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Back</a>
                </li>
			</ul>
		</div>
        
    </div>
    <!--begin::Form-->
    <form class="m-form m-form m-form--state m-form--label-align-right" action="@if(isset($category)) {{ route('admin.catalogs.categories.update' , $category->id) }} @else {{ route('admin.catalogs.categories.store') }} @endif" method="POST" enctype="multipart/form-data">
    @csrf()

    @if(isset($category))
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
                            <input type="text" name="name" class="form-control m-input" id="name" aria-describedby="emailHelp" placeholder="Enter name category" value="{{ isset($category->name) ? $category->name : '' }}" required>
                            @if ($errors->has('name'))
                                 <div class="form-control-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-3 col-sm-12">
                            Parent category
                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <select class="form-control m-select2" id="m_select2_parent" name="parent_id">
                                <option value=""></option>
                                @foreach ($parents as $parent)
                                    <option value="{{$parent->id}}" {{ ($category->parent_id == $parent->id) ? 'selected' : '' }}>{{$parent->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Slug URI
                            </label>
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <input type="text" id="slug" name="slug" class="form-control m-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter slug uri category" value="{{ isset($category->slug) ? $category->slug : '' }}" required>
                            </div>
                        </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-3 col-sm-12">
                            Image
                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <img src="{{ isset($category->image) ?  Storage::url($category->image) : '' }}" alt="" style="height:150px" class="img-fluid">
                            <input type="hidden" name="old_image" value="{{ isset($category->image) ? $category->image: '' }}">
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="customFile" {{ isset($category->image) ? '' : 'required' }}>
                                <label class="custom-file-label" for="customFile">
                                    Choose file
                                </label>
                            </div>
                            <div class="form-control-feedback">
                                Image Size 1600*500px
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
                            <input type="text" name="seo_title" class="form-control m-input" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ isset($category->seo_title) ? $category->seo_title : '' }}" placeholder="Enter Seo title">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-3 col-sm-12">
                            Seo keyword
                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <input type="text" name="seo_keywords" class="form-control m-input" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ isset($category->seo_keywords) ? $category->seo_keywords : '' }}" placeholder="Enter Seo keyword">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-3 col-sm-12">
                            Seo description
                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                        <textarea name="seo_description" class="form-control m-input" name="" id="" cols="30" rows="5">{{ isset($category->seo_description) ? $category->seo_description : '' }}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-3 col-sm-12">
                            Categories on body
                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <input data-switch="true" data-id="enable_content" name="status" class="change_show" data-size="small" type="checkbox" {{ ($category->enable_home == 1) ? 'checked' : '' }}>
                            <span class="m-form__help">On for show categories content</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-3 col-sm-12">
                            List categories
                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <input data-switch="true" data-id="enable_content" name="enable_banner" class="change_show" data-size="small" type="checkbox" {{ ($category->enable_banner == 1) ? 'checked' : '' }}>
                            <span class="m-form__help">On for show in list left banner side</span>
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
  $("#m_select2_parent").select2({
        placeholder: "Select a parent",
        allowClear: true
    });
$('#name').on('keyup' , function() {
    var text = $(this).val();
    $('#slug').val(strToThaiSlug(text));
});

$('.change_show').bootstrapSwitch();
</script>
@endpush
