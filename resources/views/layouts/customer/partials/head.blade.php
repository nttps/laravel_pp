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
		<link rel="stylesheet" href="{{ mix('css/app.css')}}">
		<link rel="stylesheet" href="{{ mix('css/customer/style.css')}}">
        @stack('css')
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="{{ \Storage::url(getSetting('site_fav_icon')) }}" />
