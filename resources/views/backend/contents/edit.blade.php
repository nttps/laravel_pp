@extends('layouts.backend.master')

@push('css')
    <!-- include summernote css/js -->
    <link href="https://summernote.org/vendors/summernote/dist/summernote.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <style>
        @font-face {
  font-family: 'rsubold';
  src: url('/fonts/webfonts/rsu-bold/rsu-bold-webfont.eot');
  src: url('/fonts/webfonts/rsu-bold/rsu-bold-webfont.eot?#iefix') format('embedded-opentype'),
       url('/fonts/webfonts/rsu-bold/rsu-bold-webfont.woff2') format('woff2'),
       url('/fonts/webfonts/rsu-bold/rsu-bold-webfont.woff') format('woff');
  font-weight: normal;
  font-style: normal;

}
@font-face {
  font-family: 'rsulight';
  src: url('/fonts/webfonts/rsu-light/rsu-light-webfont.eot');
  src: url('/fonts/webfonts/rsu-light/rsu-light-webfont.eot?#iefix') format('embedded-opentype'),
       url('/fonts/webfonts/rsu-light/rsu-light-webfont.woff2') format('woff2'),
       url('/fonts/webfonts/rsu-light/rsu-light-webfont.woff') format('woff');
  font-weight: normal;
  font-style: normal;
  unicode-range: U+0E00–U+0E7F;

}
@font-face {
  font-family: 'rsuregular';
  src: url('/fonts/webfonts/rsu-regular/rsu-regular-webfont.eot');
  src: url('/fonts/webfonts/rsu-regular/rsu-regular-webfont.eot?#iefix') format('embedded-opentype'),
       url('/fonts/webfonts/rsu-regular/rsu-regular-webfont.woff2') format('woff2'),
       url('/fonts/webfonts/rsu-regular/rsu-regular-webfont.woff') format('woff');
  font-weight: normal;
  font-style: normal;
  unicode-range: U+0E00–U+0E7F;

}
@font-face {
  font-family: 'rsutext-regular';
  src: url('/fonts/webfonts/rsu-text/rsu_text_regular-webfont.eot');
  src: url('/fonts/webfonts/rsu-text/rsu_text_regular-webfont.eot?#iefix') format('embedded-opentype'),
       url('/fonts/webfonts/rsu-text/rsu_text_regular-webfont.woff2') format('woff2'),
       url('/fonts/webfonts/rsu-text/rsu_text_regular-webfont.woff') format('woff');
  font-weight: normal;
  font-style: normal;
  unicode-range: U+0E00–U+0E7F;
}

@font-face {
  font-family: 'rsutext-bold';
  src: url('/fonts/webfonts/rsu-text/rsu_text_bold-webfont.eot');
  src: url('/fonts/webfonts/rsu-text/rsu_text_bold-webfont.eot?#iefix') format('embedded-opentype'),
       url('/fonts/webfonts/rsu-text/rsu_text_bold-webfont.woff2') format('woff2'),
       url('/fonts/webfonts/rsu-text/rsu_text_bold-webfont.woff') format('woff');
  font-weight: normal;
  font-style: normal;
  unicode-range: U+0E00–U+0E7F;
}

@font-face {
  font-family: 'rsutext-italic';
  src: url('/fonts/webfonts/rsu-text/rsu_text_italic-webfont-webfont.eot');
  src: url('/fonts/webfonts/rsu-text/rsu_text_italic-webfont-webfont.eot?#iefix') format('embedded-opentype'),
       url('/fonts/webfonts/rsu-text/rsu_text_italic-webfont-webfont.woff2') format('woff2'),
       url('/fonts/webfonts/rsu-text/rsu_text_italic-webfont-webfont.woff') format('woff');
  font-weight: normal;
  font-style: normal;
  unicode-range: U+0E00–U+0E7F;
}
    .product_cat_all{
        min-height: 42px;
        max-height: 200px;
        overflow: auto;
        padding: 0 .9em;
        border: 1px solid #ddd;
        background-color: #fdfdfd;
    }
    ul.categorychecklist{
        list-style: none;
        padding: 0;
        margin: 10px 0 0 0;
    }
    ul.categorychecklist li {
        margin: 0;
        padding: 0;
        line-height: 15px;
        word-wrap: break-word;
        display: list-item;
        text-align: -webkit-match-parent;
    }
    ul.categorychecklist li label{
        cursor: pointer;
        font-size: 13px;
    }
    ul.categorychecklist li label input[type=checkbox]{
        border: 1px solid #b4b9be;
        background: #fff;
        color: #555;
        clear: none;
        cursor: pointer;
        display: inline-block;
        line-height: 0;
        height: 16px;
        margin: -4px 4px 0 0;
        outline: 0;
        padding: 0!important;
        text-align: center;
        vertical-align: middle;
        width: 16px;
        min-width: 16px;
        -webkit-appearance: none;
        box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
        transition: .05s border-color ease-in-out;
    }
    ul.categorychecklist li label input[type=checkbox]:checked:before {
        float: left;
        display: inline-block;
        vertical-align: middle;
        width: 14px;
        font: normal normal normal 14px/1 FontAwesome;
        font-weight: 900;
        speak: none;
        content: "\f00c";
        margin: 0;
        color: #1e8cbe;
        -moz-osx-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        line-height: 1;
    }
    ul.categorychecklist ul{
        margin-left: 18px;
        padding: 0;
        list-style: none;
    }

    #m_select2_productdata{
        margin-left: 10px;
    }
    .select2 {
        width:100%!important;
    }
    .m-portlet__sm{
        height: 2.5rem !important;
        cursor: move;
    }
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
        font:normal normal normal 14px/1 FontAwesome;
        content: "\f1ce";
        background-size: cover;
        line-height: 1;
        text-align: center;
        font-size: 2em;
        color: rgba(0,0,0,.75);
    }
    table.table_attribute {
        width: 100%;
        position: relative;
        background-color: #fdfdfd;
        padding: 1em;
    }
    table.table_attribute td{
        text-align: left;
        padding: 0 6px 1em 0;
        vertical-align: top;
        border: 0;
    }

    table.table_attribute td.attribute_name {
        width: 300px;
    }
    table.table_attribute td label{
        text-align: left;
        display: block;
        line-height: 14px;
    }


    @-moz-keyframes spin {
        100%{-webkit-transform:rotate(360deg);
            transform:rotate(360deg)
        }
    }

    @-webkit-keyframes spin{
        100%{-webkit-transform:rotate(360deg);
            transform:rotate(360deg)
        }
    }
    @keyframes spin{
        100%{-webkit-transform:rotate(360deg);
            transform:rotate(360deg)
        }
    }
    </style>
@endpush
@section('title.page' , 'Content Edit')


@section('breadcrumb')
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
        <li class="m-nav__item m-nav__item--home">
            <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
            <i class="m-nav__link-icon la la-home"></i>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="/admin/contents/footer" class="m-nav__link">
                <span class="m-nav__link-text"> Footer Content Link  </span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <span class="m-nav__link-text">{{ isset($data) ? 'Edit' : 'Create' }} Content</span>
        </li>
    </ul>
@stop


@section('content')

<form class="m-form m-form m-form--state m-form--label-align-right" action="@if(isset($data)){{ route('admin.contents.update' , $data->id ) }}@else{{ route('admin.promotion.store') }} @endif" method="POST" enctype="multipart/form-data" id="productFrom">
    @csrf()

    @if(isset($data))
        @method('PUT')
    @endif

    @php
       $is_show = isset($data->is_show) ? $data->is_show : NULL;

    @endphp
    <div class="row">
        <div class="col-lg-8 col-12">
        <!--begin::Portlet-->
            <div class="m-portlet m-portlet--head-sm">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ isset($data) ? 'Edit' : 'Create' }} A Content
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="row mb-3">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group m-form__group row {{ $errors->has('title') ? ' has-danger' : '' }}">
                                <label class="col-form-label col-lg-3 col-md-3 col-sm-12">
                                    Title
                                </label>
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <input type="text" name="title" class="form-control m-input" id="title" aria-describedby="" placeholder="Enter title name" value="{{ isset($data->title) ? $data->title : old('title') }}">
                                    @if ($errors->has('title'))
                                        <div class="form-control-feedback">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group m-form__group row {{ $errors->has('slug') ? 'has-danger' : '' }}">
                                <label class="col-form-label col-lg-3 col-md-3 col-sm-12">
                                    Slug URI
                                </label>
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <input type="text" id="slug" name="slug" class="form-control m-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter product slug" value="{{ isset($data->slug) ? $data->slug : old('slug') }}">
                                    @if ($errors->has('slug'))
                                        <div class="form-control-feedback">
                                            {{ $errors->first('slug') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 mt-3">
                            <div class="form-group m-form__group">
                                <label>Body description </label>
                                <textarea id="body_description" class="summernote form-control m-input" name="body_description">{{ isset($data->body_html) ? $data->body_html : old('body_description') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
        <div class="col-lg-4 col-12">
            <div class="m-portlet m-portlet--head-sm">
                <div class="m-portlet__body">
                   <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-brand productFromSubmit" id="button">
                                @isset($data) Update @else Submit @endisset
                            </button>
                            <a href="/admin/contents/{{$data->type}}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet m-portlet--head-sm">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Header image
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <img id="img_show" src="{{ isset($data->image) ?  Storage::url($data->image) : '' }}" alt="" class="img-fluid img">
                    <input type="hidden" name="old_image" value="{{ isset($data->image) ? $data->image: '' }}">
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="image" {{ isset($data->image) ? '' : '' }}>
                        <label class="custom-file-label" for="customFile">
                            Choose file
                        </label>
                    </div>
                </div>
            </div>
            <div class="m-portlet m-portlet--head-sm">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">SEO</h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group">
						<label for="SEOTITLE">SEO title</label>
						<input type="text" class="form-control m-input" id="SEOTITLE" name="meta_title" aria-describedby="SEOTITLEHelp" value="{{ isset($data->meta_title) ? $data->meta_title : '' }}" placeholder="Enter SEO title">
						<span class="m-form__help">If you not setting this value. The system will use title name to SEO title.</span>
                    </div>
                    <div class="form-group m-form__group">
						<label for="SEOKEYS">SEO keywords</label>
						<input type="text" class="form-control m-input" id="SEOKEYS" name="meta_keywords" aria-describedby="SEOKEYSHelp" value="{{ isset($data->meta_keyword) ? $data->meta_keyword : '' }}" placeholder="Enter SEO keywords">
                    </div>
                    <div class="form-group m-form__group">
						<label for="SEODESC">SEO description</label>
						<textarea class="form-control m-input" id="SEODESC"  name="meta_description" aria-describedby="SEODESCHelp" placeholder="Enter SEO description">{{ isset($data->meta_description) ? $data->meta_description : '' }}</textarea>
					</div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>

    </div>
    <div class="m-portlet__foot m-portlet__foot--fit">
        <div class="m-form__actions m-form__actions">
            
        </div>
    </div>
</form>
<!--end::Form-->
@stop

@push('script')

<script src="{{ asset('js/backend/vendor/summernote.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/backend/vendor/summernote-fontawesome.js') }}" type="text/javascript"></script>
@toastr_render
<script>

$(document).ready( function(){
    var action_product = {!! isset($data) ? '1' : '0' !!};
    
    if(action_product == 0){
        $('#tabs_attribute').find('select.attribute_select , button.add-attribute , button.save_attributes').hide();
        $('#text-attribute-disabled').text('You should insert product to use Attribute Tabs');
    }
});
var product_id = {!! isset($data->id) ? $data->id : "''" !!};
$("#m_select2_productdata").select2({
    placeholder: "Select a parent",
    allowClear: false,
    minimumResultsForSearch:1/0
});

$("#short_description").keyup(function(){

    $("#short_description_count").text("Characters left: " + (250 - $(this).val().length));
    if($(this).val().length == 250){
        $("#short_description_count").css({
            'color': 'red',
            'font-weight': 'bold'
        });
    }
});
function formatRepoSelection (repo) {
    return repo.name || repo.text;
}
$("#m_select2_relate1").select2({
    allowClear: true,
    ajax: {
        url: "{!! route('admin.catalogs.product.relate') !!}",
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

function readURL(input) {

    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#img_show').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}

$("#image").change(function() {
    readURL(this);
});
var $postSummernot = $('#body_description').summernote({
    height: 500,                 // set editor height
    minHeight: null,             // set minimum height of editor
    maxHeight: null,
    fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New' , 'Kanit' ,'rsuregular' , 'rsulight'],  
    fontNamesIgnoreCheck: ['Kanit','rsuregular' , 'rsulight'],  // set maximum height of editor=
    toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear','fontIcon']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize' , 'fontname']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
      //    ['para', ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull']],
        ['height', ['height']],
        ['insert', ['picture' , 'table' , 'video' , 'hr' ,'link']],
        ['misc', ['undo' , 'redo' , 'fullscreen' ,'codeview']],
    ],
    callbacks: {
        onImageUpload: function(files) {
            sendFile(files[0], $postSummernot);
        }
    }

});


function sendFile(files, $postSummernot) {
    var formData = new FormData();
    formData.append( "_token", '{!! csrf_token() !!}');
    formData.append("file", files);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $.ajax({
            url: "{!! route('admin.catalogs.product.imagebody') !!}",
            data:formData,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(data){
                $postSummernot.summernote('insertImage', data, function ($image) {
                    $image.attr('src', data).attr('style' , 'max-width:100%;height:auto;');
                });
            }
        });
}

var valueStock = {!! isset($data->enable_stock) ? $data->enable_stock : '0' !!};
if(valueStock != 0){
    $('.enable_stock').click();
    $('.setStock').show();
}
$('.enable_stock').on ('click' , function() {
    if ($(this).prop('checked')) $('.setStock').show();
    else $('.setStock').hide();
});


$('#productFrom').validate({
    ignore: ".ignore",
    invalidHandler: function(e, validator){
        if(validator.errorList.length)
        console.log(validator.errorList)
        $('#tabs a[href="#' + $(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
    }
});

$('.productFromSubmit').click(function(evt) {
    evt.preventDefault();
    $('#productFrom').submit()
});
</script>
@endpush
