@extends('layouts.backend.master')


@section('title.page' , 'Shipping manager')
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
            font-family: 'Font Awesome 5 Free';
            content: "\f110";
            font-weight: 900;
            background-size: cover;
            line-height: 1;
            text-align: center;
            font-size: 2em;
            color: rgba(0,0,0,.75);
        }

        .shipping-rule-item{
            border-bottom: 1px solid #c0c0c0;
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
            <a href="{{ route('admin.setting.shop.index')}}" class="m-nav__link">
                <span class="m-nav__link-text">Shop setting</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="" class="m-nav__link">
                <span class="m-nav__link-text">Shipping manager</span>
            </a>
        </li>
    </ul>
@stop

@section('content')
    <div class="m-portlet m-portlet--tabs m-portlet--head-solid-bg m-portlet--bordered m-portlet--head-sm">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    {{ $shipping_zone->name }}
                </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a data-toggle="modal" data-target="#edit_shipping" class="btn m-btn--outline-2x m-btn--square btn-outline-primary edit-zone">EDIT</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">        
            <div class="m-section__content">
                <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                    <div class="m-demo__preview">
                        @forelse($shipping_zone->rules as $rule_item)
                            <div class="row align-items-center shipping-rule-item m--padding-top-30 m--padding-bottom-30">
                                <div class="col-3">                                        
                                    {{ $rule_item->name }}
                                </div>
                                <div class="col-3">
                                    {{ $rule_item->method }}
                                </div>
                                
                                <div class="ml-auto">
                                    <a href="" class="btn m-btn--square btn-primary" data-toggle="modal" data-target="#edit_shipping_rules">Config</a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center">
                                <a href=""  data-toggle="modal" data-target="#add_shipping_rules" class="btn m-btn--outline-2x m-btn--square  btn-outline-primary">ADD SHIPPING RULES</a>
                            </div>  
                        @endforelse
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="add_shipping_rules" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header m--bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Add shipping rules</h5>
                <button type="button" class="close  text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('admin.ajaxload') }}" method="POST">
                @csrf
                <input type="hidden" name="action" value="add_shipping_rule">
                <input type="hidden" name="zone_id" value="{{ $shipping_zone->id }}">
            <div class="modal-body">
                <div class="form-group m-form__group">
                    <label for="exampleInputEmail1">Display name</label>
                    <input type="text" class="form-control m-input" name="name" id="name" aria-describedby="name-error"
                        aria-invalid="true" placeholder="Display name" required>
                </div>
                <div class="form-group m-form__group">
                    <label for="exampleInputEmail1">Charge shipping</label>
                    <select class="custom-select form-control select_type_rule" name="type" aria-describedby="option-error" aria-invalid="true" required>
                        <option value="">Select charge ...</option>
                        <option value="free-shipping">Free Shipping</option>
                        <option value="shipping-order">Shipping By Order</option>
                        <option value="shipping-choice">Shipping By choice</option>
                    </select>
                </div>
                <div class="free-shipping" style="display:none;">
                    <div class="form-group m-form__group">
                        <div class="m-checkbox-list">
                            <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                <input type="checkbox" class="limit_free_shipping" name="limit_free_shipping" value="yes"> Limit to order over
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control m-input" name="price" id="price" aria-describedby="name-error"
                            aria-invalid="true" placeholder="Price" disabled required>
                    </div>
                    <div class="form-group m-form__group">
                        <div class="m-checkbox-list">
                            <label class="m-checkbox m-checkbox--air m-checkbox--state-brand m-checkbox--disabled label_fixed_cost">
                                <input type="checkbox" disabled="disabled" class="fixed_cost" name="fixed_cost"> Make products with a Fixed Shipping Cost ineligible for Free Shipping
                                <span></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="shipping-choice" style="display:none;">
                    <h5>Ranges</h5>
                    <div class="form-group m-form__group row form-ranges" id="form-ranges_1">
                        <div class="col-lg-4">
                            <label for="name_choice">Name:</label>
                            <div class="input-group m-input-group m-input-group--square">
                                <input type="text" id="name_choice" class="form-control m-input from" name="name_choice[]" placeholder="Standard , Fast Shipping" required>
                               
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label for="days_choice">Days:</label>
                            <div class="input-group m-input-group m-input-group--square">
                                <input type="text" id="days_choice" class="form-control m-input upto" name="days_choice[]" placeholder="1 - 2 Days" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label for="price_choice">Price:</label>
                            <div class="input-group m-input-group m-input-group--square">
                                    <div class="input-group-prepend"><span class="input-group-text">฿</span></div>
                                <input type="text" class="form-control m-input" id="price_choice" name="price_choice[]" placeholder="1000" required>
                            </div>
                        </div>
                        <div class="col-lg-2 align-self-end action_choice">
                            <button type="button" class="btn btn-outline-success add_ranges_weight">+</button>
                
                        </div>
                    </div>
                </div>
                <div class="shipping-order" style="display:none;">
                    <h5>Ranges</h5>
                    <div class="form-group m-form__group row form-order-ranges" id="form-order-ranges_1">
                        <div class="col-lg-3">
                            <label for="from">From:</label>
                            <div class="input-group m-input-group m-input-group--square">
                                <input type="text" id="from" class="form-control m-input from" name="from_order[]" placeholder="0.00" required>
                                <div class="input-group-append"><span class="input-group-text" id="basic-addon1">฿</span></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label for="upto">Upto:</label>
                            <div class="input-group m-input-group m-input-group--square">
                                <input type="text" id="upto" class="form-control m-input upto" name="upto_order[]" placeholder="200.00" required>
                                <div class="input-group-append"><span class="input-group-text" id="basic-addon1">฿</span></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label for="price_order">Price:</label>
                            <div class="input-group m-input-group m-input-group--square">
                                    <div class="input-group-prepend"><span class="input-group-text">฿</span></div>
                                <input type="text" class="form-control m-input" id="price_order" name="price_order[]" placeholder="0.00" required>
                            </div>
                        </div>
                        <div class="col-lg-3 align-self-end action_order">
                            <button type="button" class="btn btn-outline-success add_ranges_order">+</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="ShippingZoneSubmit">Submit</button>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit_shipping_rules" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        @php 
            $method = isset($shipping_zone_rules->method) ? $shipping_zone_rules->method: '';
            $name = isset($shipping_zone_rules->name) ? $shipping_zone_rules->name: '';
            $rule_id = isset($shipping_zone_rules->id) ? $shipping_zone_rules->id: '';
            $rules = isset($shipping_zone_rules->rules) ? json_decode($shipping_zone_rules->rules , true) : '';

            $rule_price = isset($rules[0]['price']) ? $rules[0]['price'] : '';
            $rule_limit_free_shipping = isset($rules[0]['limit_free_shipping']) ? $rules[0]['limit_free_shipping'] : '';
            $rule_fixed_cost = isset($rules[0]['fixed_cost']) ? $rules[0]['fixed_cost'] : '';

           
            
        @endphp
        <div class="modal-content">
            <div class="modal-header m--bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit shipping rules</h5>
                <button type="button" class="close  text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <form action="{{ route('admin.setting.shop.shipping.rules.edit' , $rule_id) }}" method="POST">
                @csrf
                @method('PUT')
            <div class="modal-body">
                    
                <div class="form-group m-form__group">
                    <label for="exampleInputEmail1">Display name</label>
                    <input type="text" class="form-control m-input" name="name" id="name" aria-describedby="name-error"
                        aria-invalid="true" placeholder="Display name" required value="{{ $name }}">
                </div>
                <div class="form-group m-form__group">
                    <label for="exampleInputEmail1">Charge shipping</label>
                    <select class="custom-select form-control select_type_rule" name="type" aria-describedby="option-error" aria-invalid="true" required>
                        <option value="">Select charge ...</option>
                        <option value="free-shipping" {{ ($method == 'free-shipping') ? 'selected' : '' }}>Free Shipping</option>
                        <option value="shipping-order" {{ ($method == 'shipping-order') ? 'selected' : '' }}>Shipping By Order</option>
                        <option value="shipping-choice" {{ ($method == 'shipping-choice') ? 'selected' : '' }}>Shipping By Choice</option>
                    </select>
                </div>
                <div class="free-shipping" {{ ($method == 'free-shipping') ? '' : 'style=display:none;' }}>
                    <div class="form-group m-form__group">
                        <div class="m-checkbox-list">
                            <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                <input type="checkbox" class="limit_free_shipping" name="limit_free_shipping" value="yes" {{ ($rule_limit_free_shipping == 'yes') ? 'checked=checked' : ''}}> Limit to order over
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control m-input price" name="price" id="price" aria-describedby="name-error"
                            aria-invalid="true" placeholder="Price" value="{{ $rule_price }}" {{ ($rule_limit_free_shipping == 'yes') ? '' : 'disabled'}}  required>
                    </div>
                    <div class="form-group m-form__group">
                        <div class="m-checkbox-list">
                            <label class="m-checkbox m-checkbox--air m-checkbox--state-brand  {{ ($rule_fixed_cost == 'on') ? '' : ''}} label_fixed_cost">
                                <input type="checkbox" class="fixed_cost" name="fixed_cost" {{ ($rule_fixed_cost == 'on') ? 'checked=checked' : ''}}> Make products with a Fixed Shipping Cost ineligible for Free Shipping
                                <span></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="shipping-choice" {{ ($method == 'shipping-choice') ? '' : 'style=display:none;' }}>
                    <h5>Ranges</h5>
                    @if(!empty($rules['name']))
                        @foreach($rules['name'] as $key=> $rule)
                        <div class="form-group m-form__group row form-ranges" id="form-ranges_1">
                            <div class="col-lg-4">
                            
                                <label for="name_choice">Name:</label>
                                <div class="input-group m-input-group m-input-group--square">
                                    <input type="text" id="name_choice" class="form-control m-input from" name="name_choice[]" value="{{ $rule }}" placeholder="Standard , Fast Shipping" required>
                                
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label for="days_choice">Days:</label>
                                <div class="input-group m-input-group m-input-group--square">
                                    <input type="text" id="days_choice" class="form-control m-input upto" name="days_choice[]" value="{{ $rules['days'][$key] }}" placeholder="1 - 2 Days" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label for="price_choice">Price:</label>
                                <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend"><span class="input-group-text">฿</span></div>
                                    <input type="text" class="form-control m-input" id="price_choice" name="price_choice[]" value="{{ $rules['price'][$key] }}" placeholder="1000" required>
                                </div>
                            </div>
                            <div class="col-lg-2 align-self-end action_choice">
                                <button type="button" class="btn btn-outline-success add_ranges_weight">+</button>
                                @if(!$loop->first)
                                    <button type="button" class="btn btn-outline-success remove_ranges_weight">-</button>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="form-group m-form__group row form-ranges" id="form-ranges_1">
                            <div class="col-lg-4">
                               
                                <label for="name_choice">Name:</label>
                                <div class="input-group m-input-group m-input-group--square">
                                    <input type="text" id="name_choice" class="form-control m-input from" name="name_choice[]" placeholder="Standard , Fast Shipping">
                                   
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label for="days_choice">Days:</label>
                                <div class="input-group m-input-group m-input-group--square">
                                    <input type="text" id="days_choice" class="form-control m-input upto" name="days_choice[]" placeholder="1 - 2 Days">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label for="price_choice">Price:</label>
                                <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend"><span class="input-group-text">฿</span></div>
                                    <input type="text" class="form-control m-input" id="price_choice" name="price_choice[]" placeholder="1000">
                                </div>
                            </div>
                            <div class="col-lg-2 align-self-end action_choice">
                                <button type="button" class="btn btn-outline-success add_ranges_weight">+</button>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="shipping-order" {{ ($method == 'shipping-order') ? '' : 'style=display:none;' }}>
                    <h5>Ranges</h5>
                    @if(!empty($rules['from_order']))
                        @foreach($rules['from_order'] as $key=> $rule)
                            <div class="form-group m-form__group row form-order-ranges" id="form-order-ranges_1">
                                <div class="col-lg-3">
                                    <label for="from">From:</label>
                                    <div class="input-group m-input-group m-input-group--square">
                                        <input type="text" id="from" class="form-control m-input from" name="from_order[]" placeholder="0.00" value="{{ $rule }}" required>
                                        <div class="input-group-append"><span class="input-group-text" id="basic-addon1">฿</span></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label for="upto">Upto:</label>
                                    <div class="input-group m-input-group m-input-group--square">
                                        <input type="text" id="upto" class="form-control m-input upto" name="upto_order[]" placeholder="200.00" value="{{ $rules['upto_order'][$key] }}" required>
                                        <div class="input-group-append"><span class="input-group-text" id="basic-addon1">฿</span></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label for="price_order">Price:</label>
                                    <div class="input-group m-input-group m-input-group--square">
                                            <div class="input-group-prepend"><span class="input-group-text">฿</span></div>
                                        <input type="text" class="form-control m-input" id="price_order" name="price_order[]" placeholder="0.00" value="{{ $rules['price_order'][$key] }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 align-self-end action_order">
                                    <button type="button" class="btn btn-outline-success add_ranges_order">+</button>
                                    @if(!$loop->first)
                                    <button type='button' class='btn btn-outline-success remove_ranges_order'>-</button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="form-group m-form__group row form-order-ranges" id="form-order-ranges_1">
                            <div class="col-lg-3">
                                <label for="from">From:</label>
                                <div class="input-group m-input-group m-input-group--square">
                                    <input type="text" id="from" class="form-control m-input from" name="from_order[]" placeholder="0.00">
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon1">฿</span></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label for="upto">Upto:</label>
                                <div class="input-group m-input-group m-input-group--square">
                                    <input type="text" id="upto" class="form-control m-input upto" name="upto_order[]" placeholder="200.00">
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon1">฿</span></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label for="price_order">Price:</label>
                                <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend"><span class="input-group-text">฿</span></div>
                                    <input type="text" class="form-control m-input" id="price_order" name="price_order[]" placeholder="0.00">
                                </div>
                            </div>
                            <div class="col-lg-3 align-self-end action_order">
                                <button type="button" class="btn btn-outline-success add_ranges_order">+</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="ShippingZoneSubmit">Submit</button>
            </div>
        </div>
        </form>
    </div>
</div>
<div class="modal fade" id="edit_shipping" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header m--bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit shipping zone</h5>
                <button type="button" class="close  text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="ShippingZoneForm" class="m-form m-form--state m-form--fit m-form--label-align-right" novalidate="novalidate" action="{{ route('admin.setting.shop.shipping.edit' , $shipping_zone->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control m-input" name="name" id="name" aria-describedby="name-error"
                            aria-invalid="true" placeholder="Name zone" value="{{ $shipping_zone->name }}">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Type</label>
                        <select class="custom-select form-control" name="type" id="select_type_shipping" aria-describedby="option-error" aria-invalid="true">
                            <option value="">Select type ...</option>
                            <option value="STATE" {{ ($shipping_zone->type == 'STATE') ? 'selected' : '' }}>Selection of states or provinces</option>
                            <option value="ADVANCED" {{ ($shipping_zone->type == 'ADVANCED') ? 'selected' : '' }}>Advanced selection</option>
                        </select>
                    </div>
                    <div id="divOfState" {{ ($shipping_zone->type == 'STATE') ? '' : 'style=display:none;' }}>
                        <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">State</label>
                            <select class="custom-select form-control" id="state_value_select" name="state_value_select" style="display: block;width:100%">
                                <option value="">Select state zone</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->name_th }}">{{ $state->name_th }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="divOfAdvance" {{ ($shipping_zone->type == 'ADVANCED') ? '' : 'style=display:none;' }} >

                        <div id="advance_state" {{ ($shipping_zone->options == 'state') ? '' : 'style=display:none;' }}>
                            <div class="form-group m-form__group">
                                <label for="exampleTextarea">State</label>
                                <select class="form-control advance_value" id="select_state" multiple="multiple" name="advance_state_value[]" style="display: block;width:100%">
                                   
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" {{ $shipping_zone_value->contains($state->id) ? 'selected' : '' }}>{{ $state->name_th }}</option>
                                    @endforeach
                                </select>
                                <a href="javascript:void(0)" class="select-all">Select all</a>
                                <a href="javascript:void(0)" class="remove-all">Remove all</a>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="ShippingZoneSubmit">Submit</button>
                </div>
        </div>
        </form>
    </div>
</div>

<div class="modal fade" id="config_shipping_by" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header m--bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Config ship by</h5>
                <button type="button" class="close  text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="ShippingZoneSubmit">Submit</button>
            </div>
        </div>
        </form>
    </div>
</div>
@stop

@push('script')
    @toastr_render
    <script type="text/javascript">
    $(document).ready( function () {
        $.validator.setDefaults({ ignore: [] });
    });
        $('.select_type_rule').on( 'change' , function() {
            if($(this).val() == ''){
                $('.free-shipping').hide();
                $('.shipping-choice').hide();
                
                $('.shipping-choice').find('input').removeAttr('required');
                $('.shipping-order').hide();
                $('.shipping-order').find('input').removeAttr('required');
            }
            if($(this).val() == 'free-shipping'){
                $('.free-shipping').show();
                $('.shipping-choice').hide();
                $('.shipping-order').hide();
                $('.shipping-choice').find('input').removeAttr('required');
                $('.shipping-order').find('input').removeAttr('required');
            }
            if($(this).val() == 'shipping-choice'){
                $('.free-shipping').hide();
                $('.shipping-choice').show();
                $('.shipping-choice').find('input').attr('required' , 'required');
                $('.shipping-order').hide();
                $('.shipping-order').find('input').removeAttr('required');
            }
            if($(this).val() == 'shipping-order'){
                $('.free-shipping').hide();
                $('.shipping-choice').hide();
                $('.shipping-choice').find('input').removeAttr('required');
                $('.shipping-order').show();
                $('.shipping-order').find('input').attr('required' , 'required');

                
            }
        });
        $('.limit_free_shipping').on('click' , function() {
            if($(this).is(':checked')){
                $('.price').removeAttr('disabled');
                $('.fixed_cost').removeAttr('disabled');
                $('.label_fixed_cost').removeClass('m-checkbox--disabled');

            }else{
                $('.price').attr('disabled' , 'disabled');
                $('.fixed_cost').attr('disabled' , 'disabled');
                $('.label_fixed_cost').addClass('m-checkbox--disabled');
            }
        });

        var template = $('#form-ranges_1').clone();

        $('#add_shipping_rules').on('click' , '.add_ranges_weight', function () {
            var rowId = $('#add_shipping_rules').find('.shipping-choice').find('.form-ranges').length + 1;
            var klon = template.clone();     
            klon.attr('id', 'form-ranges_' + rowId)
                .insertAfter($('#add_shipping_rules').find('.shipping-choice').find('.form-ranges').last())
                .find('input')
                .each(function () {
                    $(this).attr('id', $(this).attr('id').replace(/_(\d*)$/, "_"+rowId));
                })    

                $("#form-ranges_" + rowId).find('.action_choice').append("<button type='button' class='btn btn-outline-success remove_ranges_weight'>-</button>")               
        });
        $('#edit_shipping_rules').on('click' , '.add_ranges_weight', function () {
            var rowId = $('#edit_shipping_rules').find('.shipping-choice').find('.form-ranges').length + 1;
            var klon = template.clone();     
            klon.attr('id', 'form-ranges_' + rowId)
                .insertAfter($('#edit_shipping_rules').find('.shipping-choice').find('.form-ranges').last())
                .find('input')
                .each(function () {
                    $(this).attr('id', $(this).attr('id').replace(/_(\d*)$/, "_"+rowId));
                })    

                $("#form-ranges_" + rowId).find('.action_choice').append("<button type='button' class='btn btn-outline-success remove_ranges_weight'>-</button>")               
        });
        $(document).on('click' , '.remove_ranges_weight' , function() {
            $(this).closest('.form-ranges').remove();
        });

        var template2 = $('#form-order-ranges_1').clone();

        $('#add_shipping_rules').on('click' , '.add_ranges_order', function () {
            var rowId = $('#add_shipping_rules').find('.shipping-order').find('.form-order-ranges').length + 1;
            var klon = template2.clone();     
            klon.attr('id', 'form-order-ranges_' + rowId)
                .insertAfter($('#add_shipping_rules').find('.shipping-order').find('.form-order-ranges').last())
                .find('input')
                .each(function () {
                    $(this).attr('id', $(this).attr('id').replace(/_(\d*)$/, "_"+rowId));
                })    

                $("#form-order-ranges_" + rowId).find('.action_order').append("<button type='button' class='btn btn-outline-success remove_ranges_order'>-</button>")               
        });
        $('#edit_shipping_rules').on('click' , '.add_ranges_order', function () {
            var rowId = $('#edit_shipping_rules').find('.shipping-order').find('.form-order-ranges').length + 1;
            var klon = template2.clone();     
            klon.attr('id', 'form-order-ranges_' + rowId)
                .insertAfter($('#edit_shipping_rules').find('.shipping-order').find('.form-order-ranges').last())
                .find('input')
                .each(function () {
                    $(this).attr('id', $(this).attr('id').replace(/_(\d*)$/, "_"+rowId));
                })    

                $("#form-order-ranges_" + rowId).find('.action_order').append("<button type='button' class='btn btn-outline-success remove_ranges_order'>-</button>")               
        });
        $(document).on('click' , '.remove_ranges_order' , function() {
            $(this).closest('.form-order-ranges').remove();
        });


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
            }
        });
        $("#state_value_select , #select_state" ).select2({
            placeholder: "Select state"
        });

    
  
        $('#ShippingZoneForm').submit(function () {
            $("body").block({
                message: null,
                overlayCSS: {
                    background: "#fff",
                    opacity: .6
                },
                baseZ: 2000
            });
        });
    </script>



@endpush
