@extends('layouts.backend.master')


@section('title.page' , 'Shop setting')
@push('css')
    <style>
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
            font-family:'Font Awesome 5 Free';
            font-weight: 900;
            content: "\f110";
            background-size: cover;
            line-height: 1;
            text-align: center;
            font-size: 2em;
            color: rgba(0,0,0,.75);
        }
    </style>
@endpush
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
                <span class="m-nav__link-text">Setting</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="" class="m-nav__link">
                <span class="m-nav__link-text">Shop setting</span>
            </a>
        </li>
    </ul>
@stop

@section('content')
    <div class="m-portlet m-portlet--tabs m-portlet--head-solid-bg m-portlet--bordered m-portlet--head-sm">
        <div class="m-portlet__head">
            <div class="m-portlet__head-tools">
                <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand m-tabs-line-danger" role="tablist">
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#m_tabs_12_1" role="tab" aria-selected="false">
                            <i class="la la-cog"></i> Setting
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_12_2" role="tab" aria-selected="false">
                            <i class="la la-briefcase"></i> Shipping Manager
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_12_3" role="tab" aria-selected="false">
                            <i class="la la-briefcase"></i> Bank Account
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">                   
            <div class="tab-content">
                <div class="tab-pane  active show" id="m_tabs_12_1" role="tabpanel">
                    <form method="POST" action="{{ route('admin.setting.shop.store')}}">   
                            @csrf                 
                        @include('backend.settings.shop.main' , ['shop_setups' => $shop_setups])
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button type="submit" class="btn btn-brand">
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="m_tabs_12_2" role="tabpanel">
                    @include('backend.settings.shop.shipping' , ['shop_setups' => $shop_setups, 'states' => $states])
                </div>
                <div class="tab-pane" id="m_tabs_12_3" role="tabpanel">
                    @include('backend.settings.shop.bank')
                </div>
            </div>      
        </div>
    </div>
@stop

@push('script')


    @toastr_render

    @stack('script-sub')
    <script type="text/javascript">
        
        $('#select_type_shipping').on( 'change' , function() {
            if($(this).val() == 'STATE'){
                $('#divOfState').show();
                $('#divOfAdvance').hide();
                $('input[name="advance_option"]').prop('checked', false);
                $('#advance_state').hide();
                $('#advance_zip').hide();
            }
            if($(this).val() == 'ADVANCED'){
                $('#divOfAdvance').show();
                $('#divOfState').hide();
                $('.radio_advance').filter('[value=state]').prop('checked', true);
                $('#advance_state').show();
                $("#select_state").trigger("change");
            }
        });
       
        $(document).ready( function() {
            $("#state_value_select" ).select2({
                placeholder: "Select state"
            });
            $("#select_state" ).select2({
                placeholder: "Select state"
            });
            

            $('.radio_advance').each(function(){
                $(this).on('change', function() {
                    if($(this).attr('id')=='Zip') {
                        $('#advance_zip').show();    
                        $('#advance_state').hide();
                    }
                    if($(this).attr('id')=='State') {
                        $('#advance_state').show();
                        $('#advance_zip').hide();    
                    }
                });
            });
            $("#ShippingZoneForm").validate({
                ignore: ':hidden',
                rules: {
                    name: "required",
                    type: {
                        required: !0
                    },
                    radio_advance:{
                        required: !0
                    },
                    advance_state_value:{
                        required: !0
                    },
                    advance_zip_value: "required",
                    state_value_select:{
                        required: !0
                    }
                },
                messages: {
                    name: "Name required",
                    type: {
                        required: "Type required"
                    },
                    advance_state_value: {
                        required: 'State required'
                    },
                    advance_zip_value: {
                        required: 'Postcodes required'
                    },
                    state_value_select:{
                        required: "State required"
                    }
                },
                invalidHandler: function (e, r) {
                    $("#ShippingZoneForm_msg").removeClass("m--hide").show()
                },
               
                submitHandler: function (form) {
                    $("#add_shipping").modal('show');
                    $("body").block({
                        message: null,
                        overlayCSS: {
                            background: "#fff",
                            opacity: .6
                        },
                        baseZ: 2000
                    });
                    var t = {
                        action: "add_shipping_zone",
                        _token: '{!! csrf_token() !!}',
                        data: $(form).serialize()
                    };
                    
                    $.ajax({
                        url:'{!! route('admin.ajaxload') !!}',
                        type: "post",
                        data: t,
                        success: function(e){
                            if(e.status == "success"){
                                var t = window.location.toString();
                                $("body").unblock(),$("#add_shipping").modal('toggle'), $(".shipping_zones").load(t + " .shipping_zones"),$('#ShippingZoneForm')[0].reset(), $('#divOfState').hide(),$('#divOfAdvance').hide(),$("#select_type_shipping ,#state_value_select , #select_state").val('').trigger('change');
                            }
                        },
                        error:function(){
                            alert("failure");
                            
                        }         
                    }); 
                }
            });

            $('#BankSubmit').on('click' , function(){
                $('#BankForm').submit();
            });
            $("#BankForm").validate({
                ignore: ':hidden',
                rules: {
                    name_bank: "required",
                    number: {
                        required: !0,
                        number: !0
                    },                   
                    bank:{
                        required: !0
                    }                   
                },
                messages: {
                    name_bank: "Name required",
                    number: {
                        required: 'Number required',
                        number: 'Number Only'
                    },
                    bank: {
                        required: 'Bank required'
                    }
                },
                invalidHandler: function (e, r) {
                    $("#BankForm_msg").removeClass("m--hide").show()
                },
               
                submitHandler: function (form) {
                    $("#add_bank").modal('show');
                    $("body").block({
                        message: null,
                        overlayCSS: {
                            background: "#fff",
                            opacity: .6
                        },
                        baseZ: 2000
                    });
                    var t = {
                        action: "add_bank",
                        _token: '{!! csrf_token() !!}',
                        data: $(form).serialize()
                    };
                    
                    $.ajax({
                        url:'{!! route('admin.ajaxload') !!}',
                        type: "post",
                        data: t,
                        success: function(e){
                            if(e.status == "success"){
                                var t = window.location.toString();
                                $("body").unblock(),$("#add_bank").modal('toggle'), $(".banks").load(t + " .banks"),$('#BankForm')[0].reset(),$("#bank").val('').trigger('change');
                            }
                        },
                        error:function(){
                            alert("failure");
                            
                        }         
                    }); 
                }
            });
        });
    </script>
@endpush
