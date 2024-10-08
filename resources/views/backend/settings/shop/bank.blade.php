<div class="d-flex align-items-center">
    <div class="mr-auto">
        Bank Account
    </div>
    <div>
        <div class="dropdown">
            <button type="button" class="btn m-btn--square  btn-primary" data-toggle="modal" data-target="#add_bank"><i
                    class="fa fa-plus-square"></i> Add Bank</button>
        </div>
    </div>
</div>
<div class="banks">

    
    <div class="m-portlet m--margin-bottom-20 m--margin-top-20 m-portlet--info m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="flaticon-placeholder-2"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Your Bank Account
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
            @foreach ($banks as $bank)
                <div class="m-section__content">
                    <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                        <div class="m-demo__preview">                            
                            <div class="row align-items-center">
                                <div class="col-3">
                                    {{ $bank->name }}
                                </div>
                                <div class="col-3">
                                    {{ $bank->number }}
                                </div>
                                <div class="col-2">
                                    {{ $bank->bank }}
                                </div>
                                <div class="col-4 text-right">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#edit_bank" class="btn m-btn--square btn_edit_bank btn-outline-info btn-md" data-id="{{ $bank->id }}" data-name="{{ $bank->name }}" data-number="{{ $bank->number }}" data-bank="{{ $bank->bank }}">EDIT</a>
                                    <a href="javascript:void(0);" data-id="" data-name="" class="btn btn-outline-danger m-btn--square btn-md remove_rules"><i class="fas fa-times"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            @endforeach
                
        </div>
    </div>

    
</div>


<div class="modal fade" id="add_bank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header m--bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Add Your Bank Account</h5>
                <button type="button" class="close  text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="BankForm" class="m-form m-form--state m-form--fit m-form--label-align-right" novalidate="novalidate" method="POST">
                <div class="modal-body">
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control m-input" name="name_bank" id="name" aria-describedby="name-error"
                            aria-invalid="true" placeholder="ex. TEST COMPANY">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Number</label>
                        <input type="text" class="form-control m-input" name="number" id="number" aria-describedby="number-error"
                            aria-invalid="true" placeholder="ex. 100000000">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleTextarea">Bank</label>
                        <select class="form-control advance_value" id="bank" name="bank" style="display: block;width:100%">
                            <option value="กสิกรไทย" >กสิกรไทย</option>
                            <option value="ไทยพาณิชย์" >ไทยพาณิชย์</option>
                            <option value="กรุงไทย" >กรุงไทย</option>
                            <option value="กรุงเทพ" >กรุงเทพ</option>
                            <option value="กรุงศรี" >กรุงศรี</option>
                            <option value="ทหารไทย" >ทหารไทย</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="BankSubmit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="edit_bank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header m--bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit Your Bank Account</h5>
                <button type="button" class="close  text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="EditBankForm" class="m-form m-form--state m-form--fit m-form--label-align-right" novalidate="novalidate" method="POST">
                <div class="modal-body">
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control m-input" name="name_bank" id="name_bank" aria-describedby="name-error"
                            aria-invalid="true" placeholder="ex. TEST COMPANY">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Number</label>
                        <input type="text" class="form-control m-input" name="number" id="number_bank" aria-describedby="number-error"
                            aria-invalid="true" placeholder="ex. 100000000">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleTextarea">Bank</label>
                        <select class="form-control advance_value" id="editbank" name="bank" style="display: block;width:100%">
                            <option value="กสิกรไทย" >กสิกรไทย</option>
                            <option value="ไทยพาณิชย์" >ไทยพาณิชย์</option>
                            <option value="กรุงไทย" >กรุงไทย</option>
                            <option value="กรุงเทพ" >กรุงเทพ</option>
                            <option value="กรุงศรี" >กรุงศรี</option>
                            <option value="ทหารไทย" >ทหารไทย</option>
                        </select>
                    </div>
                    <input type="hidden" name="bank_id" id="bank_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="BankEditSubmit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('script-sub')

    <script>
        $(document).on('click' , '.btn_edit_bank', function() {
            var name =  $(this).data('name'),
                id = $(this).data('id'),
                number = $(this).data('number'),
                bank = $(this).data('bank');

            $('#name_bank').val(name);
            $('#editbank').val(bank);
            $('#number_bank').val(number);
            $('#bank_id').val(id);
            
        });

            $('#BankEditSubmit').on('click' , function(){
                $('#EditBankForm').submit();
            });
            $("#EditBankForm").validate({
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
                    $("#EditBankForm_msg").removeClass("m--hide").show()
                },
               
                submitHandler: function (form) {
                    $("#edit_bank").modal('show');
                    $("body").block({
                        message: null,
                        overlayCSS: {
                            background: "#fff",
                            opacity: .6
                        },
                        baseZ: 2000
                    });
                    var t = {
                        action: "edit_bank",
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
                                $("body").unblock(),$("#edit_bank").modal('toggle'), $(".banks").load(t + " .banks"),$('#EditBankForm')[0].reset(),$("#editbank").val('').trigger('change');
                            }
                        },
                        error:function(){
                            alert("failure");
                            
                        }         
                    }); 
                }
            });
    </script>

@endpush