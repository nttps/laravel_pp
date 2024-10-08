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
            <a href="{{ route('admin.orders.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Orders</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="" class="m-nav__link">
                <span class="m-nav__link-text">#</span>
            </a>
        </li>
    </ul>
@stop

@section('content')
<div class="row">        
    <div class="col-md-6 col-12">
        <div class="m-portlet m-portlet--primary m-portlet--head-solid-bg m-portlet--bordered m-portlet--head-sm">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Order Info
                        </h3>
                    </div>
                </div>
                
            </div>
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label">Status:</label>
                        <div class="col-lg-8">
                            <input type="email" class="form-control m-input" disabled="disabled" placeholder="{{ $data->status }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label">Dated at:</label>
                        <div class="col-lg-8">
                            <input type="email" class="form-control m-input" disabled="disabled" placeholder="{{ $data->created_at }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label">Payment amount:</label>
                        <div class="col-lg-8">
                            <input type="email" class="form-control m-input" disabled="disabled" placeholder="{{ number_format($data->total,2) }}">
                        </div>
                    </div>
                </div>
                
            </div>
           
        </div>
        <div class="m-portlet m-portlet--success m-portlet--head-solid-bg m-portlet--bordered m-portlet--head-sm">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Payment Info
                        </h3>
                    </div>
                </div>
                
            </div>
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label">Payment method:</label>
                        <div class="col-lg-8">
                            <input type="email" class="form-control m-input" disabled="disabled"placeholder="{{ $data->payment_method }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label">Proof of Payment</label>
                        <div class="col-lg-8">
                            @if($data->payment)
                                <img src="{{ \Storage::url($data->payment->proof_payment) }}" class="img-fluid" alt="">
                            @endif
                        </div>
                    </div>
                    
                </div>
                
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit text-center">
                <div class="m-form__actions">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#m_modal_accept" {{ ($data->status != 'AWAIT-PAYMENT' && $data->status != 'AWAIT-CONFIRM') ? 'disabled' : ''}}>Accept Payment</button>
                </div>
            </div>
        </div>
        <div class="m-portlet m-portlet--info m-portlet--head-solid-bg m-portlet--bordered m-portlet--head-sm">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Shipment Info
                        </h3>
                    </div>
                </div>
                
            </div>
            <form action="{{ route('admin.orders.shipping') }}" method="POST">
            @csrf
                <div class="m-portlet__body">
                    <div class="m-form__section m-form__section--first">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-4 col-form-label">Shipment Number:</label>
                            <div class="col-lg-8">
                                <input type="text" name="shipping_number" required class="form-control m-input" value="{{ $data->shipping_number }}">
                            </div>
                        </div>
                        <input type="hidden" name="id" class="id" value="{{ $data->id }}">
                    </div>
                    
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit text-center">
                    <div class="m-form__actions">
                        <button type="submit" class="btn btn-info">{{ isset($data->shipping_number) ? 'Change Shipment' : 'Submit Shipment' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="m-portlet m-portlet--mobile m-portlet--head-sm">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Customer Info
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label">Full Name:</label>
                        <div class="col-lg-8">
                            <input type="email" class="form-control m-input" disabled="disabled" placeholder="{{ $data->customer->name }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label">Email</label>
                        <div class="col-lg-8">
                            <input type="email" class="form-control m-input" disabled="disabled" placeholder="{{ $data->customer->email }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label">Phone</label>
                        <div class="col-lg-8">
                            <input type="email" class="form-control m-input" disabled="disabled" placeholder="{{ $data->customer->phone }}">
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="m-portlet m-portlet--mobile m-portlet--head-sm">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Billing Info
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
					<ul class="m-portlet__nav">
						<li class="m-portlet__nav-item">
							<a href="#" class="m-portlet__nav-link btn btn-sm btn-success m-btn m-btn--pill m-btn--air">
								Copy Address
							</a>
						</li>
					</ul>
				</div>
            </div>
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label">Full Name:</label>
                        <div class="col-lg-8">
                            <input type="email" class="form-control m-input" disabled="disabled" placeholder="{{ $data->full_name }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label">Address</label>
                        <div class="col-lg-8">
                            <textarea class="form-control m-input" disabled="disabled" rows="3">{{ $data->full_address }}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label">Phone</label>
                        <div class="col-lg-8">
                            <input type="email" class="form-control m-input" disabled="disabled" placeholder="{{ $data->billing_phone }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-4 col-form-label">Email</label>
                        <div class="col-lg-8">
                            <input type="email" class="form-control m-input" disabled="disabled" placeholder="{{ $data->billing_email }}">
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="m-portlet m-portlet--mobile m-portlet--head-sm">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Product Info
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-section">
					<div class="m-section__content">
						<table class="table m-table m-table--head-separator-primary">
						  	<thead>
						    	<tr>
						      		<th class="text-center" width="50%">Product</th>
						      		<th class="text-center">Quantity</th>
						      		<th class="text-right">Price</th>
						      		<th class="text-right">Total</th>
						    	</tr>
						  	</thead>
						  	<tbody>
                                @php  $total = 0; @endphp
                                @foreach ($products as $product)
                                    @php
                                        $subtotal = $product->pivot->quantity * $product->getPrice();
                                        $total += $subtotal;

                                    @endphp
                                    <tr>
                                        <th class="text-center" scope="row">{{ $product->name }}</th>
                                        <td class="text-center">{{ $product->pivot->quantity }}</td>
                                        <td class="text-right">{{ number_format($product->getPrice(),2) }} Baht</td>
                                        <td class="text-right">{{ number_format($subtotal,2) }} Baht</td>
                                    </tr>
                                @endforeach	
                                    <tr>
                                        <td class="text-right" colspan="3"><strong>Shipping Price</strong> </td>
                                        <td class="text-right"><strong>{{ number_format($data->shipping_price,2) }} Baht</strong></td>
                                    </tr>	
                                    <tr class="m-table__row--primary">
                                        <td class="text-right" colspan="3"><strong>Total All</strong> </td>
                                        <td class="text-right"><strong>{{ number_format($total+$data->shipping_price,2) }} Baht</strong></td>
                                    </tr>
						  	</tbody>
						</table>
					</div>
				</div>
                
            </div>
        </div>
    </div>
    
</div>


<div class="modal fade  m-modal-purchase" id="m_modal_accept" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <form action="{{ route('admin.orders.update') }}" method="POST">
    @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header  bg-danger text-white">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Confrim Payment ? </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>You wanna to accept payment right ?</p>
                <input type="hidden" name="id" value="{{ $data->id }}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger">Yes</button>
            </div>
            </div>
        </div>
    </form>
</div>
@stop

@push('script')
@toastr_render
<script>
</script>
@endpush
