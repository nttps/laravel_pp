@extends('layouts.backend.master')


@section('title.page' , 'Knowledge Categories')

@section('breadcrumb')
<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
    <li class="m-nav__item m-nav__item--home">
        <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
            <i class="m-nav__link-icon la la-home"></i>
        </a>
    </li>
    <li class="m-nav__separator">-</li>
    <li class="m-nav__item">
        <a href="{{ route('admin.article.index')}}" class="m-nav__link">
            <span class="m-nav__link-text">Knowledge</span>
        </a>
    </li>
    <li class="m-nav__separator">-</li>
    <li class="m-nav__item">
        <a href="" class="m-nav__link">
            <span class="m-nav__link-text">Knowledge Categories</span>
        </a>
    </li>
</ul>
@stop

@section('content')
<div class="row animated fadeInLeft">
    <div class="col-lg-4">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Add category
                        </h3>
                    </div>
                </div>
            </div>
            <form class="m-form m-form m-form--state" action="{{ route('admin.article.categories.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf()
                <div class="m-portlet__body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group m-form__group row {{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="col-form-label col-lg-4 col-sm-12">
                                    Category name
                                </label>
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <input type="text" name="name" class="form-control m-input" id="name"
                                        aria-describedby="emailHelp" placeholder="Enter category name" value="{{ isset($brand->name) ? $brand->name : '' }}"
                                        required>
                                    @if ($errors->has('name'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-form-label col-lg-4 col-sm-12">
                                    Slug
                                </label>
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <input type="text" id="slug" name="slug" class="form-control m-input" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter category slug" value="{{ isset($brand->slug) ? $brand->slug : '' }}"
                                        required>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-form-label col-lg-4 col-sm-12">
                                    Parent category
                                </label>
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <select class="form-control m-select2" id="m_select2_parent" name="parent_id">
                                        <option value=""></option>
                                        @foreach ($categories as $category)
                                                <option value="{{$category->id}}"> {{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot ">
                    <div class="m-form__actions m-form__actions">
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
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                    <div class="row align-items-center">
                        <div class=" offset-5 col-xl-7 order-2 order-xl-1">
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-12">
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                            url: "{{ route('admin.article.categories.data') }}",
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
                    title: "Image",
                    attr: {
                        nowrap: "nowrap"
                    },
                    width: 90,
                    template: function (t) {
                        return "<img class='img-fluid' style='height:60px' src='/storage/" +
                            t.image + "'>"
                    }
                }, {
                    field: "name",
                    title: "Category name",
                    attr: {
                        nowrap: "nowrap"
                    },
                    width: 150,
                    template: function (t) {
                        console.log(t);
                        if(t.parent != null){
                            return '- ' + t.name
                        }else{
                            return t.name
                        }
                    }
                }, {
                    field: "slug",
                    title: "Category slug",
                    attr: {
                        nowrap: "nowrap"
                    },
                    width: 150,
                    template: function (t) {
                        return t.slug
                    }
                }, {
                    field: "Actions",
                    width: 100,
                    title: "Actions",
                    sortable: !1,
                    overflow: "visible",
                    template: function (t, e, a) {
                        return '\t\t\t\t\t\t<a href="/admin/article/categories/' + t.id +'/edit" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<form action="/admin/article/categories/' +t.id +'" method="post" style="display:inline-block">{{ method_field('delete') }}{!! csrf_field() !!}<button type="submit" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</button>\t\t\t\t\t'
                    }
                }]
            })
        }
    };
    jQuery(document).ready(function () {
        DatatableRemoteAjaxDemo.init()
    });

    $("#m_select2_parent").select2({
        placeholder: "Select a parent",
        allowClear: true
    });
    $('#name').on('keyup' , function() {
        var text = $(this).val();
        $('#slug').val(strToThaiSlug(text));
    });
</script>
@endpush
