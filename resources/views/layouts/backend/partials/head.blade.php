        <meta charset="utf-8" />
		<title>
			{{ getSetting('site_title') }} | Dashboard
		</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
		<!--begin::Base Styles -->
		
		<link href="{{ asset('css/backend/vendor/vendors.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/backend/default/styles.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        
        @stack('css')
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="{{ \Storage::url(getSetting('site_fav_icon')) }}" />
