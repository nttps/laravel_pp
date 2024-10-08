<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title' , getSetting('site_title'))</title>
<meta name="keywords" content="@yield('keywords' , getSetting('site_keywords'))">
<meta name="description" content="@yield('description' , getSetting('site_description'))">
<link rel="stylesheet" href="{{ mix('css/app.css')}}">
<link rel="stylesheet" href="{{ mix('css/styles.css')}}" type="text/css">
<link rel="shortcut icon" sizes="192x192" href="{{ \Storage::url(getSetting('site_fav_icon')) }}" />
<meta name="theme-color" content="#37add5">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
@yield('custom-css')