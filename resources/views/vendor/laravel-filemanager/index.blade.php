<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Chrome, Firefox OS and Opera -->
  <meta name="theme-color" content="#75C7C3">
  <!-- Windows Phone -->
  <meta name="msapplication-navbutton-color" content="#75C7C3">
  <!-- iOS Safari -->
  <meta name="apple-mobile-web-app-status-bar-style" content="#75C7C3">

  <title>Media</title>
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
  <script>
      WebFont.load({
        google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
        active: function() {
            sessionStorage.fonts = true;
        }
      });
</script>
  <link href="{{ asset('css/backend/vendor/vendors.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/backend/default/styles.css') }}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
     
  <link rel="shortcut icon" type="image/png" href="{{ asset('vendor/laravel-filemanager/img/folder.png') }}">
  <link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/cropper.min.css') }}">
  <style>{!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/css/lfm.css')) !!}</style>
  <link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/mfb.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/dropzone.min.css') }}">
  
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.css">
</head>
<body>
    <div class="row">

        <div class="col-12 col-md-12">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">            
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <a class="navbar-brand clickable hide" id="to-previous">
                                    <i class="fa fa-arrow-left"></i>
                                    <span class="hidden-xs">{{ trans('laravel-filemanager::lfm.nav-back') }}</span>
                                </a>
                            </span>
                            <h3 class="m-portlet__head-text">
                                <div id="current_dir"></div>                            
                            </h3>
                            
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="javascript:;" class="m-portlet__nav-link m-portlet__nav-link--icon clickable" id="thumbnail-display"><i class="fa fa-th-large"></i> {{ trans('laravel-filemanager::lfm.nav-thumbnails') }}</a>
                            </li>
                            <li class="m-portlet__nav-item">
                                <a href="javascript:;" class="m-portlet__nav-link m-portlet__nav-link--icon clickable" id="list-display"><i class="fa fa-list"></i> {{ trans('laravel-filemanager::lfm.nav-list') }}</a>
                            </li>
                            <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
                                <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn-sm  btn-metal m-btn m-btn--pill">
                                    {{ trans('laravel-filemanager::lfm.nav-sort') }}
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav">
                                                    <li class="m-nav__item">
                                                        <a href="#" class="m-nav__link" id="list-sort-alphabetic">
                                                            <i class="fa fa-sort-alpha-asc"></i>
                                                            <span class="m-nav__link-text">{{ trans('laravel-filemanager::lfm.nav-sort-alphabetic') }}</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="#" class="m-nav__link" id="list-sort-time">
                                                            <i class="fa fa-sort-amount-asc"></i>
                                                            <span class="m-nav__link-text">{{ trans('laravel-filemanager::lfm.nav-sort-time') }}</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li> 
                            <li class="m-portlet__nav-item">
                                <a href="javascript:;" id="add-folder" data-mfb-label="{{ trans('laravel-filemanager::lfm.nav-new') }}" class="btn btn-outline-info">New Folder</a>
                            </li>   
                            <li class="m-portlet__nav-item">
                                <a href="javascript:;" id="upload" data-mfb-label="{{ trans('laravel-filemanager::lfm.nav-upload') }}" class="btn btn-outline-info">Upload</a>
                            </li>              
                        </ul>
                    </div>
                    
                </div>
                <div class="m-portlet__body">                
                    
                    
                    <div id="alerts"></div>
                    <div id="content"></div>
                </div>
            </div>
        </div>
    
    </div>
       
    
    
    
    
        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"  id="myModalLabel">{{ trans('laravel-filemanager::lfm.title-upload') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('unisharp.lfm.upload') }}" role='form' id='uploadForm' name='uploadForm' method='post'
                            enctype='multipart/form-data' class="dropzone">
                            <div class="form-group" id="attachment">
    
                                <div class="controls text-center">
                                    <div class="input-group" style="width: 100%">
                                        <a class="btn btn-primary" id="upload-button">{{
                                            trans('laravel-filemanager::lfm.message-choose') }}</a>
                                    </div>
                                </div>
                            </div>
                            <input type='hidden' name='working_dir' id='working_dir'>
                            <input type='hidden' name='type' id='type' value='{{ request("type") }}'>
                            <input type='hidden' name='_token' value='{{csrf_token()}}'>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{
                            trans('laravel-filemanager::lfm.btn-close') }}</button>
                    </div>
                </div>
            </div>
        </div>
    
        <div id="lfm-loader">
            <img src="{{asset('vendor/laravel-filemanager/img/loader.svg')}}">
        </div>
  <script src="{{ asset('js/backend/vendor/vendors.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/backend/default/scripts.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/backend/backend.js') }}" type="text/javascript"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <script src="{{ asset('../vendor/laravel-filemanager/js/bootbox.min.js') }}"></script>
  <script src="{{ asset('../vendor/laravel-filemanager/js/cropper.min.js') }}"></script>
  <script src="{{ asset('../vendor/laravel-filemanager/js/jquery.form.min.js') }}"></script>

  <script>
    var route_prefix = "{{ url('/') }}";
    var lfm_route = "{{ url(config('lfm.url_prefix', config('lfm.prefix'))) }}";
    var lang = {!!json_encode(trans('laravel-filemanager::lfm')) !!};
  </script>
  {{-- <script>{!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/script.js')) !!}</script>}}
  {{-- Use the line below instead of the above if you need to cache the script. --}}
  <script src="{{ asset('vendor/laravel-filemanager/js/script.js') }}"></script>
  <script>   

    Dropzone.options.uploadForm = {
      paramName: "upload[]", // The name that will be used to transfer the file
      uploadMultiple: false,
      parallelUploads: 5,
      clickable: '#upload-button',
      dictDefaultMessage: 'Or drop files here to upload',
      init: function() {
        var _this = this; // For the closure
        this.on('success', function(file, response) {
          if (response == 'OK') {
            refreshFoldersAndItems('OK');
          } else {
            this.defaultOptions.error(file, response.join('\n'));
          }
      });
      },
      acceptedFiles: "{{ lcfirst(str_singular(request('type') ?: '')) == 'image' ? implode(',', config('lfm.valid_image_mimetypes')) : implode(',', config('lfm.valid_file_mimetypes')) }}",
      maxFilesize: ({{ lcfirst(str_singular(request('type') ?: '')) == 'image' ? config('lfm.max_image_size') : config('lfm.max_file_size') }} / 1000)
    }
  </script>
</body>
</html>
