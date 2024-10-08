@extends('layouts.backend.master')


@section('title.page' , 'HOME PAGE SETTING > Slide')

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
            <a href="" class="m-nav__link">
                <span class="m-nav__link-text">Slide</span>
            </a>
        </li>
    </ul>
@stop

@section('content')
<div class="row">
    <div class="col-md-4 col-12">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            New Slide
                        </h3>
                    </div>
                </div>
            </div>
            <form class="m-form m-form m-form--state" action="{{ route('admin.widgets.slide.post') }}"
            method="POST" enctype="multipart/form-data">
            @csrf()
            <div class="m-portlet__body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group m-form__group row {{ $errors->has('url_link') ? ' has-danger' : '' }}">
                            <label class="col-form-label col-lg-4 col-sm-12">
                                URL Link
                            </label>
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <input type="text" name="url_link" class="form-control m-input" id="url_link"
                                    aria-describedby="emailHelp" placeholder="Enter URL Link" value="{{ isset($brand->name) ? $brand->name : '' or old('url_link') }}"
                                    >
                                <span class="m-form__help">If you no set URL link you don't have link into slide</span>
                                @if ($errors->has('url_link'))
                                <div class="form-control-feedback">
                                    {{ $errors->first('url_link') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-4 col-sm-12">
                                Image
                            </label>
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">

                                        {{ request()->old('image', 'Choose file') }}
                                    </label>
                                    <span class="m-form__help @if ($errors->has('image'))  text-danger @endif">Size 880*400px</span>
                                    @if ($errors->has('image'))
                                    <div class="form-control-feedback text-danger">
                                        {{ $errors->first('image') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="m-checkbox-inline">
                                    <label class="m-checkbox">
                                        <input type="checkbox" class="enable" name="enable">
                                            Enable show slide
                                        <span></span>
                                    </label>
                                </div>
                                <span class="m-form__help">If you want to show slide on website to check this.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot ">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-brand">
                            Submit
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <div class="col-md-8 col-12">
        <div class="m-portlet m-portlet--mobile">
          
            <div class="m-portlet__body">
                <div class="m_datatable" id="json_data"></div>
            </div>
        </div>
    </div>
</div>

@stop

@push('script')
@toastr_render
<script>

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    var DatatableRemoteAjaxDemo = {
    init: function () {
        var t;
        t = $(".m_datatable").mDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "{{ route('admin.widgets.slide.index') }}",
                        method: 'get'
                    }
                },
                pageSize: 10,
                serverPaging: !0,
                serverFiltering: !0,
                serverSorting: !0
            },
            layout: {
                scroll: !1,
                footer: !1
            },
            sortable: !0,
            pagination: !0,
            toolbar: {
                items: {
                    pagination: {
                        pageSizeSelect: [10, 20, 30, 50, 100]
                    }
                }
            },
            search: {
                input: $("#generalSearch")
            },
            columns: [{
                field: "image",
                title: "",
                attr: {
                    nowrap: "nowrap"
                },
                width: 250,
                template: function (t) {
                    return '<img src="/storage/'+t.image+'" class="img-fluid">';
                }
            },{
                field: "url_link",
                title: "URL Link",
                attr: {
                    nowrap: "nowrap"
                },
                width: 290,
                template: function (t) {
                    return t.url_link
                }
            },{
                field: "Actions",
                width: 70,
                title: "Actions",
                sortable: !1,
                overflow: "visible",
                template: function (t, e, a) {
                    return '\t\t\t\t\t\t<a href="/admin/widgets/slide/'+t.id+'/edit" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<form action="/admin/widgets/slide/'+t.id+'" method="post" style="display:inline-block">{{ method_field('delete') }}{!! csrf_field() !!}<button type="submit" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</button>\t\t\t\t\t'
                }
            }]
        })
    }
};
jQuery(document).ready(function () {
    DatatableRemoteAjaxDemo.init()
});
</script>
@endpush
