<div class="d-flex align-items-center">
    <div class="mr-auto">
        Configure your shipping rules
    </div>
    <div>
        <div class="dropdown">
            <button type="button" class="btn m-btn--square  btn-primary" data-toggle="modal" data-target="#add_shipping"><i
                    class="fa fa-plus-square"></i> Add shipping zone</button>
        </div>
    </div>
</div>
<div class="shipping_zones">

    
    <div class="m-portlet m--margin-bottom-20 m--margin-top-20 m-portlet--info m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="flaticon-placeholder-2"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Shipping rules
                    </h3>
                </div>			
            </div>
            {{-- <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                            <a href="#"  m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="la la-angle-down"></i>
                                </a>
                    </li>
                </ul>
            </div> --}}
        </div>
        <div class="m-portlet__body">
            @foreach ($shipping_zones as $shipping_zone)
                <div class="m-section__content">
                    <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                        <div class="m-demo__preview">
                            
                            <div class="row align-items-center">
                                <div class="col-4">
                                    {{ $shipping_zone->name }}
                                </div>
                                <div class="col-4">
                                   
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('admin.setting.shop.shipping.index' , $shipping_zone->id) }}" class="btn m-btn--square  btn-outline-info btn-md">EDIT</a>
                                    <a href="javascript:void(0);" data-id="{{ $shipping_zone->id }}" data-name="{{ $shipping_zone->name }}" class="btn btn-outline-danger m-btn--square btn-md remove_rules"><i class="fas fa-times"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            @endforeach
        </div>
    </div>

    
</div>



<div class="modal fade" id="add_shipping" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header m--bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Add shipping zone</h5>
                <button type="button" class="close  text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="ShippingZoneForm" class="m-form m-form--state m-form--fit m-form--label-align-right" novalidate="novalidate" action="" method="POST">
                <div class="modal-body">
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control m-input" name="name" id="name" aria-describedby="name-error"
                            aria-invalid="true" placeholder="Name zone">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Type</label>
                        <select class="custom-select form-control" name="type" id="select_type_shipping" aria-describedby="option-error" aria-invalid="true">
                            <option value="">Select type ...</option>
                            <option value="STATE">Selection of states or provinces</option>
                            <option value="ADVANCED">Advanced selection</option>
                        </select>
                    </div>
                    <div id="divOfState" style="display:none;">
                        <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">State</label>
                            <select class="custom-select form-control" id="state_value_select" name="state_value_select" style="display: block;width:100%">
                                <option value="">Select state zone</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name_th }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="divOfAdvance" style="display:none;">                      
                        <div id="advance_state" style="display:none;">
                            <div class="form-group m-form__group">
                                <label for="exampleTextarea">State</label>
                                <select class="form-control advance_value" id="select_state" multiple="multiple" name="advance_state_value[]" style="display: block;width:100%">
                                   
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" >{{ $state->name_th }}</option>
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


<div class="modal fade" id="remove_shipping" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;"
    aria-hidden="true">
    
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header m--bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Remove Shipping zone</h5>
                    <button type="button" class="close  text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Remove this shipping zone ?
                    <p class="name-zone"></p>

                    <input type="hidden" class="id" name="id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger remove-shipping-zone">Yes</button>
                </div>
            </div>
        </div>
</div>
@push('script-sub')
<script>

   
    $(document).on('click' , '.remove_rules' , function() {
        var name = $(this).data('name');
        var id = $(this).data('id');
        $('#remove_shipping .name-zone').text(name);
        $('#remove_shipping .id').val(id);
        $('#remove_shipping').modal('toggle');
    });

    $(document).on('click' , '.remove-shipping-zone' , function() {
            $('#remove_shipping').modal('toggle');
            var data = {
                id: $('#remove_shipping .id').val(),
                _token: '{!! csrf_token() !!}',
            };
            $.post('{!! route('admin.setting.shop.shipping.delete') !!}', data, function (r) {
                var t = window.location.toString();
                if(r.status == "failed"){
                    alert(r.message);
                }else{
                    $(".shipping_zones").load(t + " .shipping_zones");
                }
            });
    });

    $(document).on( 'click' , '.select-all' , function() {
            $("#select_state > option").prop("selected","selected");
            $("#select_state").trigger("change");
    });
    $(document).on( 'click' , '.remove-all' , function() {
            $("#select_state > option").prop("selected" , "");
            $("#select_state").trigger("change");
    });
</script>
@endpush
