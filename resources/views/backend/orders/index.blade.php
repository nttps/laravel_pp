@extends('layouts.backend.master')


@section('title.page' , 'Orders')

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
                <span class="m-nav__link-text">Orders</span>
            </a>
        </li>
    </ul>
@stop

@section('content')
<div class="row">        
    <div class="col-md-12 col-12">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-4">
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="m-form__group m-form__group--inline">
                                        <div class="m-form__label">
                                            <label>
                                                Status:
                                            </label>
                                        </div>
                                        <div class="m-form__control">
                                            <select class="form-control" id="m_form_status">
                                                <option value="">
                                                    All
                                                </option>
                                                <option value="AWAIT-PAYMENT">
                                                    AWAIT PAYMENT
                                                </option>
                                                <option value="AWAIT-CONFIRM">
                                                    AWAIT CONFIRM
                                                </option>
                                                <option value="AWAIT-SHIPMENT">
                                                    AWAIT SHIPMENT
                                                </option>
                                                <option value="SHIPPED">
                                                    SHIPPED
                                                </option>
                                                <option value="CANCELLED">
                                                    CANCELLED
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-md-none m--margin-bottom-10"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                            @can('order-create')
                            {{-- <a href="{{ route('admin.orders.create') }}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-cart-plus"></i>
                                    <span>New Order</span>
                                </span>
                            </a> --}}
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
    </div>
</div>

<div class="modal fade m-modal-purchase" id="m_modal_accept" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <form action="{{ route('admin.orders.update') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header  bg-success text-white">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Confrim Payment ? </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>You wanna to accept payment right ?</p>
               
                
                <input type="hidden" name="id" class="id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-success">Yes</button>
            </div>
            </div>
        </div>
    </form>
</div>


<div class="modal fade m-modal-purchase" id="m_modal_shipment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <form action="{{ route('admin.orders.shipping') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header  bg-success text-white">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Confrim Shipping ? </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p></p>
                <div class="m-form__section m-form__section--first">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label">Shipment Number:</label>
                        <div class="col-lg-8">
                            <input type="text" name="shipping_number" class="form-control m-input" placeholder="Shipment Number" required>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" class="id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-success">Yes</button>
            </div>
            </div>
        </div>
    </form>
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
                        url: "{{ route('admin.orders.data') }}",
                        method: 'get'
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: !0,
                serverSorting: false
            },
            layout: {
                scroll: !1,
                footer: !1
            },
            sortable: !0,
            pagination: true,
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
                field: "id",
                title: "#",
                attr: {
                    nowrap: "nowrap"
                },
                width: 50,
                template: function (t) {
                    return t.id;
                }
            },{
                field: "created_at",
                title: "Date",
                attr: {
                    nowrap: "nowrap"
                },
                width: 160,
                template: function (t) {
                    var date    = new Date(t.created_at)
                    var day = date.getDate();
                    var month = date.getMonth();
                    var year = date.getFullYear();
                    return day + '/' + month + '/' + year
                }
            },{
                field: "total",
                title: "Total ",
                textAlign: 'right',
                attr: {
                    nowrap: "nowrap"
                },
                width: 120,
                template: function (t) {
                    return t.total
                }
            },{
                field: "status",
                title: "Status",
                textAlign: 'center',
                attr: {
                    nowrap: "nowrap"
                },
                width: 190,
                template: function (t) {
                    var e = {
                        'AWAIT-PAYMENT': {
                            title: "AWAIT PAYMENT",
                            class: " m-badge--danger"
                        },
                        'AWAIT-CONFIRM': {
                            title: "AWAIT CONFIRM",
                            class: " m-badge--primary"
                        },
                        'AWAIT-SHIPMENT': {
                            title: "AWAIT SHIPMENT",
                            class: " m-badge--primary"
                        },
                        'SHIPPED': {
                            title: "SHIPPED",
                            class: " m-badge--success"
                        },
                        'CANCELLED': {
                            title: "CANCELLED",
                            class: " m-badge--info"
                        }
                    };
                    return '<span class="m-badge ' + e[t.status].class + ' m-badge--wide">' + e[t.status].title + "</span>"
                    
                }
            },{
                field: "order_create_by",
                title: "Order created by",
                textAlign: 'center',
                attr: {
                    nowrap: "nowrap"
                },
                width: 190,
                template: function (t) {
                    return t.order_create_by
                }
            },{
                field: "Actions",
                width: 150,
                title: "Actions",
                attr: {
                    class: "text-center"
                },
                textAlign: 'center',
                sortable: !1,
                overflow: "visible",
                template: function (t, e, a) {
                    if(t.status == 'AWAIT-CONFIRM')
                        return '\t\t\t\t\t\t<a href="javascript:void(0);" data-id="'+t.id+'" class="btn btn-outline-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air accept-payment" title="Accept">\t\t\t\t\t\t\t<i class="fa fa-check-circle"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<a href="/admin/orders/'+t.id+'/manage" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\t\t\t\t\t\t\t<i class="fa fa-search"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<form action="/admin/orders/'+t.id+'/delete" method="post" style="display:inline-block">{{ method_field('delete') }}{!! csrf_field() !!}<button type="submit"  class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</button>\t\t\t\t\t'
                    else if(t.status == 'AWAIT-PAYMENT')
                        return '\t\t\t\t\t\t<a href="javascript:void(0);" data-id="'+t.id+'" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air accept-payment" title="Accept">\t\t\t\t\t\t\t<i class="fa fa-check-circle"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<a href="/admin/orders/'+t.id+'/manage" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\t\t\t\t\t\t\t<i class="fa fa-search"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<form action="/admin/orders/'+t.id+'/delete" method="post" style="display:inline-block">{{ method_field('delete') }}{!! csrf_field() !!}<button type="submit" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</button>\t\t\t\t\t'
                    else if(t.status == 'AWAIT-SHIPMENT')
                        return '\t\t\t\t\t\t<a href="javascript:void(0);" data-id="'+t.id+'" class="btn btn-outline-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air accept-shipment" title="Accept">\t\t\t\t\t\t\t<i class="la la-truck"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<a href="/admin/orders/'+t.id+'/manage" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\t\t\t\t\t\t\t<i class="fa fa-search"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<form action="/admin/orders/'+t.id+'/delete" method="post" style="display:inline-block">{{ method_field('delete') }}{!! csrf_field() !!}<button type="submit" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</button>\t\t\t\t\t'
                    else if(t.status == 'SHIPPED')
                        return '\t\t\t\t\t\t<a href="javascript:void(0);" data-id="'+t.id+'" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only disabled m-btn--custom m-btn--outline-2x m-btn--pill" title="Accept">\t\t\t\t\t\t\t<i class="fa fa-check-circle"></i>\t\t\t\t\t\t<a href="/admin/orders/'+t.id+'/manage" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\t\t\t\t\t\t\t<i class="fa fa-search"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<form action="/admin/orders/'+t.id+'/delete" method="post" style="display:inline-block">{{ method_field('delete') }}{!! csrf_field() !!}<button type="submit" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</button>\t\t\t\t\t'
                    else
                        return '\t\t\t\t\t\t<a href="/admin/orders/'+t.id+'/manage" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\t\t\t\t\t\t\t<i class="fa fa-search"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<form action="/admin/orders/'+t.id+'/delete" method="post" style="display:inline-block">{{ method_field('delete') }}{!! csrf_field() !!}<button type="submit" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</button>\t\t\t\t\t'
                }
            }]
        }), $("#m_form_status").on("change", function () {
            t.search($(this).val(), "status")
        })
    }
};
jQuery(document).ready(function () {
    DatatableRemoteAjaxDemo.init();
    $(".m_form_status").selectpicker();
    
});

$(document).on('click' , '.accept-payment' , function(){
    var id = $(this).data('id');
    $('.id').val(id);
    $('#m_modal_accept').modal('show');
});

$(document).on('click' , '.accept-shipment' , function(){
    var id = $(this).data('id');
    $('.id').val(id);
    $('#m_modal_shipment').modal('show');
});
</script>
@endpush
