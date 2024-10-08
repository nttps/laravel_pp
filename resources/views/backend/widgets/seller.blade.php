@extends('layouts.backend.master')


@section('title.page' , 'HOME PAGE SETTING > Good Seller')



@push('css')
<style>
    .pic{
        
        opacity:0.5;
        width:100%;height:100%;
    }
    .fa-upload{
        font-size:50px;
        color: black;
    }
    .upload_image{
        cursor: pointer;
    }
    .upload_image:hover .pic{
        opacity: 1;
        cursor: pointer;
        
    }
    .upload_image:hover .fa-upload{
        color:white;
    }
    .upload_image:hover div.text-up {
        background-color: white;
        opacity: 0.5;
    }
    .btn-upload div {
        color:black;
        text-align: center;
        cursor: pointer;
    }
    .btn-upload div.text-up {
        margin-top: 5px;
        border: 1px dotted black;
        font-weight: bold;
        
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
                <span class="m-nav__link-text">HOME PAGE SETTING</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="" class="m-nav__link">
                <span class="m-nav__link-text">Good Seller</span>
            </a>
        </li>
    </ul>
@stop

@section('content')
<div class="row">

    <div class="col-md-12 col-12">
        <div class="m-portlet m-portlet--mobile">
            <form action="{{ route('admin.widgets.seller.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="m-portlet__body align-text-top">
                <div class="row d-flex justify-content-between">
                    
                    <div class="d-inline-block">
                        <div class="upload_image" style="width: 270px;height: 630px;border:1px solid  @if($errors->has('seller_left_1')) red @else black @endif;position:relative;">
                            <img src="{{ \Storage::url($seller_left_1->image)}}" class="pic" alt="">
                            <div class="btn-upload" style="position:absolute;top:50%;left:50%;transform: translate(-50%, -50%);">
                                <div><i class="fas fa-upload"></i> </div>
                                <div class="text-up">Click for upload image  @if($errors->has('seller_left_1')) <div class="text-danger">Image size : 325 x 850 px</div> @endif</div>
                            </div>   
                        </div>  
                        <input type="file" class="file-upload" name="seller_left_1" id="" style="display:none" accept="image/*">     
                        <input type="hidden" name="old_seller_left_1" value="{{$seller_left_1->image }}">    
                                
                        <div class="@if($errors->has('seller_left_1'))text-danger m--font-bold @endif">  Image size : 325 x 850 px</div> <br>
                        <select class="form-control m-input" id="m_text_left_1" name="text_left_1">
                            @if($seller_left_1->url_link)
                                <option value="{{ $product_left_1->id }}">{{ $product_left_1->name }}</option>
                            @else 
                            <option></option>
                            @endif
                        </select>     
                        
                    </div>
                   
                   
                    <div class="d-inline-block " style="width:325px;">
                        <div class="text-center upload_image" style="width:265px;height:265px;border:1px solid @if($errors->has('seller_left_2')) red @else black @endif;position:relative;" >
                            <img src="{{ \Storage::url($seller_left_2->image)}}" class="pic" style="width:100%;height:100%;" alt="">
                            <div class="btn-upload" style="position:absolute;top:50%;left:50%;transform: translate(-50%, -50%);">
                                <div><i class="fas fa-upload"></i> </div>
                                <div class="text-up">Click for upload image  @if($errors->has('seller_left_2')) <div class="text-danger">Image size : 320 x 320 px</div> @endif</div>
                            </div>
                        </div>
                        <input type="file" class="file-upload" name="seller_left_2" id="" style="display:none" accept="image/*">
                        <input type="hidden" name="old_seller_left_2" value="{{$seller_left_2->image }}">  
                       
                        <div class="col-lg-12 mb-2 mt-2">
                            <span class=" @if($errors->has('seller_left_2'))text-danger m--font-bold @endif">  Image size : 320 x 320 px</span>
                            <select class="form-control m-input" id="m_text_left_2" name="text_left_2">
                                @if($seller_left_2->url_link)
                                    <option value="{{ $product_left_2->id }}">{{ $product_left_2->name }}</option>
                                @else 
                                    <option></option>
                                @endif
                            </select>
                        </div>
                       <div class="text-center upload_image" style="width:265px;height:265px;border:1px solid @if($errors->has('seller_left_3')) red @else black @endif;position:relative;" >
                            <img src="{{ \Storage::url($seller_left_3->image)}}" class="pic" style="width:100%;height:100%;" alt="">
                            <div class="btn-upload" style="position:absolute;top:50%;left:50%;transform: translate(-50%, -50%);">
                                <div><i class="fas fa-upload"></i> </div>
                                <div class="text-up">Click for upload image  @if($errors->has('seller_left_3')) <div class="text-danger">Image size : 320 x 320 px</div> @endif</div>
                            </div>
                           
                        </div>
                        <input type="file" class="file-upload" name="seller_left_3" id="" style="display:none" accept="image/*">
                        <input type="hidden" name="old_seller_left_3" value="{{$seller_left_3->image }}">  
                       
                        <div class="col-lg-12 mb-2 mt-2">
                              <span class=" @if($errors->has('seller_left_3'))text-danger m--font-bold @endif">  Image size : 320 x 320 px</span>
                                <select class="form-control m-input" id="m_text_left_3" name="text_left_3">
                                @if($seller_left_3->url_link)
                                    <option value="{{ $product_left_3->id }}">{{ $product_left_3->name }}</option>
                                @else 
                                    <option></option>
                                @endif
                            </select>
                        </div>
                    </div>
                    
                    <div class="d-inline-block " >
                        <div class="upload_image" style="width: 270px;height: 630px;border:1px solid @if($errors->has('seller_right_1')) red @else black @endif;position:relative;">
                            <img src="{{ \Storage::url($seller_right_1->image)}}" class="pic" alt="" >
                            <div class="btn-upload" style="position:absolute;top:50%;left:50%;transform: translate(-50%, -50%);">
                                <div><i class="fas fa-upload"></i> </div>
                                <div class="text-up">Click for upload image @if($errors->has('seller_right_1')) <div class="text-danger">Image size : 325 x 850 px</div> @endif</div>
                            </div>
                        </div>
                        <input type="file" class="file-upload" name="seller_right_1" id="" style="display:none" accept="image/*">
                        <input type="hidden" name="old_seller_right_1" value="{{$seller_right_1->image }}">  
                        
                        <div class=" @if($errors->has('seller_right_1'))text-danger m--font-bold @endif" >  Image size : 325 x 850 px</div><br>
                        <select class="form-control m-input" id="m_text_right_1" name="text_right_1">
                            @if($seller_right_1->url_link)
                                <option value="{{ $product_right_1->id }}">{{ $product_right_1->name }}</option>
                            @else 
                                <option></option>
                            @endif
                        </select>
                        
                    </div>
                    
                    <div class="d-inline-block" style="width:325px;">
                        <div class="text-center upload_image" style="width:265px;height:265px;border:1px solid @if($errors->has('seller_right_2')) red @else black @endif;position:relative;" >
                            <img src="{{ \Storage::url($seller_right_2->image) }}" class="pic" style="width:100%;height:100%;" alt="">
                            <div class="btn-upload" style="position:absolute;top:50%;left:50%;transform: translate(-50%, -50%);">
                                <div><i class="fas fa-upload"></i> </div>
                                <div class="text-up">Click for upload image @if($errors->has('seller_right_2')) <div class="text-danger">Image size : 320 x 320 px</div> @endif</div>
                            </div>
                        </div>
                        <input type="file" class="file-upload" name="seller_right_2" id="" style="display:none" accept="image/*">
                        <input type="hidden" name="old_seller_right_2" value="{{$seller_right_2->image }}"> 
                        
                        <div class="col-lg-12 mb-2 mt-2">
                            <span class=" @if($errors->has('seller_right_2'))text-danger m--font-bold @endif">  Image size : 320 x 320 px</span>
                            <select class="form-control m-input" id="m_text_right_2" name="text_right_2">
                            @if($seller_right_2->url_link)
                                <option value="{{ $product_right_2->id }}">{{ $product_right_2->name }}</option>
                            @else 
                                <option></option>
                            @endif
                            </select>
                        </div>
                        <div class="text-center upload_image" style="width:265px;height:265px;border:1px solid @if($errors->has('seller_right_3')) red @else black @endif;position:relative;" >
                            <img src="{{ \Storage::url($seller_right_3->image) }}" class="pic" style="width:100%;height:100%;" alt="">
                            <div class="btn-upload" style="position:absolute;top:50%;left:50%;transform: translate(-50%, -50%);">
                                <div><i class="fas fa-upload"></i> </div>
                                <div class="text-up">Click for upload image @if($errors->has('seller_right_3')) <div class="text-danger">Image size : 320 x 320 px</div> @endif</div>
                            </div>
                        </div>
                        <input type="file" class="file-upload" name="seller_right_3" id="" style="display:none" accept="image/*">
                        <input type="hidden" name="old_seller_right_3" value="{{$seller_right_3->image }}"> 
                        
                        <div class="col-lg-12 mb-2 mt-2">
                            <span class="@if($errors->has('seller_right_3'))text-danger m--font-bold @endif">  Image size : 320 x 320 px</span>
                            <select class="form-control m-input" id="m_text_right_3" name="text_right_3">
                                @if($seller_right_3->url_link)
                                    <option value="{{ $product_right_3->id }}">{{ $product_right_3->name }}</option>
                                @else 
                                    <option></option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot ">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-brand">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
            </form>
            
        </div>
    </div>
</div>

@stop

@push('script')
@toastr_render
<script>
$(document).ready(function() {
    function formatRepoSelection (repo) {
        return repo.name || repo.text;
    }
    $("#m_text_left_1 , #m_text_left_2 , #m_text_left_3, #m_text_right_1 , #m_text_right_2 , #m_text_right_3").select2({
        closeOnSelect: false,
        allowClear: true,
        ajax: {
            url: "{!! route('admin.widgets.seller.index') !!}",
            dataType: "json",
            delay: 250,
            data: function (e) {
                return {
                    q: e.term
                }
            },
            processResults: function (e, t) {
                return t.page = t.page || 1, {
                    results: e.items,
                    pagination: {
                        more: 30 * t.page < e.total_count
                    }
                }
            },
            cache: true
        },
        escapeMarkup: function (e) {
            return e;
        },
        minimumInputLength: 2,
        templateResult: function (e) {
            if (e.loading) return e.text;
            return e.name
        },
        templateSelection: formatRepoSelection,
        placeholder: 'Search for a product'
    });
        
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(input).prev('.upload_image').find('.pic').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $(document).on('change', ".file-upload",function(){
        readURL(this);
    });

    $(document).on('click', ".upload_image", function() {
        $(this).next(".file-upload").click();
    });
});
</script>
@endpush
