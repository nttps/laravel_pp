<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.frontend.includes.head')
</head>
<body class="pp-catemenu-push page">
    {{-- <div class="loading"><div class="load-icon"></div></div> --}}
    <div id="myNav" class="overlayMenu">
        <a href="javascript:void(0)" class="closebtn toggle-close-menu">&times;</a>
        <div class="overlay-content">
            <a href="{{ route('home') }}" class="{{ Route::is('home')  ? 'active' : '' }}">หน้าแรก</a>
            <a href="{{ route('products.index') }}" class="{{ Route::is('products.index')  ? 'active' : '' }}">สินค้าทั้งหมด</a>
            <a href="{{ route('promotion') }}" class="{{ Route::is('promotion')  ? 'active' : '' }}">โปรโมชั่น</a>
            <a href="{{ route('knowledge.index') }}" class="@if(request()->route()->getPrefix() == '/knowledge') active @endif">เกร็ดความรู้</a>
            <a href="{{ route('contact') }}" class="{{ Route::is('contact')  ? 'active' : '' }}">ติดต่อเรา</a>
        </div>
    </div>
    <nav class="pp-catemenu pp-catemenu-vertical pp-catemenu-left" id="pp-catemenu-s1">
        <a href="javascript:void(0)" id="closeCatemenu" class="closebtn">&times;</a>
        <h3>หมวดหมู่สินค้า</h3>
        <ul>
        @foreach($menudata as $menu)
            <li class="" @if($menu->children->count()) id="mitem-{{ $menu->id }}" @endif>
                <a href="{{ route('categories.show' , $menu->slug)}}" class="catemenu-item">{{ $menu->name }} </a>
                @if($menu->children->count())
                    @include ('layouts.frontend.includes.tree_menu_mo', ['entries' => $menu->children])
                @endif
            </li>    
        @endforeach
        </ul>
    </nav>
    <div class="header">
        @include('layouts.frontend.includes.header')
    </div>
    <div class="main">
        @yield('content')
    </div>
    <div class="footer">
        @include('layouts.frontend.includes.footer')
    </div>
    @include('layouts.frontend.includes.script')
</body>
</html>