<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.customer.partials.head')
    </head>
    <body class="pp-catemenu-push">
            <nav class="pp-catemenu pp-catemenu-vertical pp-catemenu-left" id="pp-catemenu-s1">
                    <a href="javascript:void(0)" id="closeCatemenu" class="closebtn">&times;</a>
                    <h3>เมนู</h3>
                    <ul>
                        <li class="">
                            <a href="{{ route('home')}}" class="catemenu-item"><i class="fas fa-home"></i> หน้าร้าน</a>
                        </li>
                        {{-- <li class="{{ Route::is('customer.index') ? 'active' : '' }} "><a href="{{ route('customer.index')}}" class="catemenu-item"><i class="fas fa-home"></i> หน้าเพจของฉัน</a></li> --}}
                        <li class="{{ Route::is('customer.history*') ? 'active' : '' }}"><a href="{{ route('customer.history.index')}}" class="catemenu-item"><i class="far fa-file-alt"></i> ประวัติสั่งซื้อสินค้าของฉัน</a></li>
                        <li class="{{ Route::is('customer.shipped*') ? 'active' : '' }}"><a href="{{ route('customer.shipped.index')}}" class="catemenu-item"><i class="fas fa-signal"></i> ดูคำสั่งซื้อ/การจัดส่ง</a></li>
                        <li class="{{ Route::is('customer.payment.index') ? 'active' : '' }}"><a href="{{ route('customer.payment.index')}}" class="catemenu-item"><i class="fas fa-credit-card"></i> แจ้งชำระเงิน</a></li>
                        <li class="{{ Route::is('customer.profile.index') ? 'active' : '' }}"><a href="{{ route('customer.profile.index')}}" class="catemenu-item"><i class="far fa-user"></i> บัญชีของฉัน</a></li>
                        <li class="{{ Route::is('customer.address.index') ? 'active' : '' }}"><a href="{{ route('customer.address.index')}}" class="catemenu-item"><i class="fas fa-map-marker-alt"></i>ที่อยู่จัดส่ง</a></li>
                        <li class="">
                                <a href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="catemenu-item"><i class="fas fa-sign-out-alt"></i> LOG OUT </a>
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                    </ul>
                </nav>
		<!-- begin:: Page -->
		<div class="">
            <!-- BEGIN: Topbarhead -->
            @include('layouts.customer.partials.topbar')

            <!-- begin::Body -->
            <div class="container-fluid">
                <div class="row">
                    <div class="left-side py-md-5 px-0" style="background:#37add5;">
                        @include('layouts.customer.partials.leftbar')
                    </div>
                    <div class="right-side px-3 py-3 py-md-5" style="background:#dcdddf;min-height: 100vh;">
                        <div class="">
                            @yield('content')
                        </div>
                    </div>
                </div>
			</div>
            <!-- end:: Body -->
            <!-- begin::Footer -->
            <footer class="">
                @include('layouts.customer.partials.footer')
            </footer>
			<!-- end::Footer -->
        </div>
        <!-- end:: Page -->

        @include('layouts.customer.partials.script')
    </body>
</html>
