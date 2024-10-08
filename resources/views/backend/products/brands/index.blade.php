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
            <a href="" class="m-nav__link">
                <span class="m-nav__link-text">Brands</span>
            </a>
        </li>
    </ul>
@stop

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
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
                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                        @can('brand-create')
                        <a href="{{ route('admin.catalogs.brands.create') }}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                            <span>
                                <i class="la la-plus"></i>
                                <span>New Brand</span>
                            </span>
                        </a>
                        @endcan
                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="m_datatable" id="json_data"></div>
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
                        url: "{{ route('admin.catalogs.brands.data') }}",
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
                field: "name",
                title: "Brand name",
                attr: {
                    nowrap: "nowrap"
                },
                width: 150,
                template: function (t) {
                    return t.name
                }
            },{
                field: "slug",
                title: "Brand slug",
                attr: {
                    nowrap: "nowrap"
                },
                width: 150,
                template: function (t) {
                    return t.slug
                }
            }, {
                field: "image",
                title: "Image",
                attr: {
                    nowrap: "nowrap"
                },
                width: 200,
                template: function (t) {
                    return "<img class='img-fluid' style='height:60px' src='/storage/" +
                            t.images + "'>"
                }
            }, {
                field: "Actions",
                width: 110,
                title: "Actions",
                sortable: !1,
                overflow: "visible",
                template: function (t, e, a) {
                    return '\t\t\t\t\t\t<a href="/admin/catalogs/brands/'+t.id+'/edit" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<form action="/admin/catalogs/brands/'+t.id+'" method="post" style="display:inline-block">{{ method_field('delete') }}{!! csrf_field() !!}<button type="submit" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</button>\t\t\t\t\t'
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
