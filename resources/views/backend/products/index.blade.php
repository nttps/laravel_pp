@extends('layouts.backend.master')


@section('title.page' , 'Products')

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
                <span class="m-nav__link-text">Products</span>
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
                        @can('product-create')
                        <a href="{{ route('admin.catalogs.product.create') }}" class="btn btn-sm btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                            <span>
                                <i class="la la-plus"></i>
                                <span>New Product</span>
                            </span>
                        </a>
                        @endcan
                        <a href="{{ route('admin.catalogs.product.import') }}"class="btn btn-sm btn-metal m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                            <span>
                                <i class="fas fa-file-import"></i>
                                <span>Import CSV</span>
                            </span>
                        </a>
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
<script src="{{ asset('js/backend/vendor/bootstrap-switch.js') }}" type="text/javascript"></script>
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
                        url: "{{ route('admin.catalogs.product.data') }}",
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
            columnDefs : [{
                "targets": 1,
                "searchable": false
            }],
            columns: [{
                field: "image",
                title: "",
                attr: {
                    nowrap: "nowrap"
                },
                width: 50,
                template: function (t) {
                    return '<img src="/storage/'+t.image+'" class="img-fluid">';
                }
            },{
                field: "name",
                title: "Name",
                attr: {
                    nowrap: "nowrap"
                },
                width: 150,
                template: function (t) {
                    return t.name
                }
            },{
                field: "category.name",
                title: "Category",
                attr: {
                    nowrap: "nowrap"
                },
                data : "category.name",
                sortable: !1,
                searchable: !1,
                filterable: !1,
                width: 150,
                template: function (t) {
                    var values = [];
                    for(i = 0; i < t.categories.length; i++ ){
                        values.push(t.categories[i]['name']);
                    }    
                    return values.join(',');
                }
            },{
                field: "price",
                title: "Price",
                attr: {
                    nowrap: "nowrap"
                },
                width: 150,
                template: function (t) {
                    return t.price
                }
            },{
                field: "is_option",
                title: "Type Product",
                attr: {
                    nowrap: "nowrap"
                },
                width: 150,
                template: function (t) {
                    if(t.is_option == 1){
                        return 'สินค้าหลายตัวเลือก';
                    }else{
                        return 'สินค้าเดี่ยว';
                    }
                }
            },{
                field: "is_show",
                title: "Pubished",
                attr: {
                    nowrap: "nowrap"
                },
                width: 100,
                template: function (t) {
                   
                    if(t.is_show == 1){
                        return '<input data-switch="true" class="change_show" data-id="'+ t.id+'" data-size="small" type="checkbox" checked="checked" >';
                    }else{
                        return '<input data-switch="false" class="change_show" data-id="'+ t.id+'" data-size="small" type="checkbox">'
                    }
                }
            },{
                field: "created_at",
                title: "Date Added",
                attr: {
                    nowrap: "nowrap"
                },
                width: 150,
                template: function (t) {
                    return t.created_at
                }
            },{
                field: "Actions",
                width: 110,
                title: "Actions",
                sortable: !1,
                overflow: "visible",
                template: function (t, e, a) {
                    return '\t\t\t\t\t\t<a href="/admin/catalogs/product/'+t.id+'/edit" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<form action="/admin/catalogs/product/'+t.id+'" method="post" style="display:inline-block">{{ method_field('delete') }}{!! csrf_field() !!}<button type="submit" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</button>\t\t\t\t\t'
                }
            }]
        })
    }
};
$(document).ready(function () {
    DatatableRemoteAjaxDemo.init()
});
$('.m_datatable').on('m-datatable--on-layout-updated', function() {
    $('.change_show').bootstrapSwitch({
        onSwitchChange: function(e, status) {
            var t = {
                status: status,
                action: '_changeStatus',
                data : $(this).data('id')
            }
            $.post('{!! route('admin.ajaxload') !!}', t, function (r) {
                if(r.status == 'success'){
                    $(".m_datatable").mDatatable("reload");
                }else{

                }
            });
        }
    });
    
});

function changeStatus(val){
    console.log(val);
    $('.change_show').on('switch-change', function (e, data) {
        var status = data.value;
        console.log(status);
    });
}

</script>
@endpush
