<div id="" class="">
    <!-- BEGIN: Aside Menu -->
    <ul class="list-unstyled menu-left">
        <li class=""><a href="{{ route('home')}}" class="menu-item"><i class="fas fa-home"></i> {{ __('main.word.Shop')}}</a></li>
        {{-- <li class="{{ Route::is('customer.index') ? 'active' : '' }}"><a href="{{ route('customer.index')}}" class="menu-item"><i class="fas fa-home"></i> หน้าเพจของฉัน</a></li> --}}
        <li class="{{ Route::is('customer.history*') ? 'active' : '' }}"><a href="{{ route('customer.history.index')}}" class="menu-item"><i class="far fa-file-alt"></i> {{ __('main.word.HISTORY ORDERS')}}</a></li>
        <li class="{{ Route::is('customer.shipped*') ? 'active' : '' }}""><a href="{{ route('customer.shipped.index')}}" class="menu-item"><i class="fas fa-signal"></i> {{ __('main.word.View Orders')}}/{{ __('main.word.Shipment')}}</a></li>
        <li class="{{ Route::is('customer.payment.index') ? 'active' : '' }}"><a href="{{ route('customer.payment.index')}}" class="menu-item"><i class="fas fa-credit-card"></i> {{ __('main.word.Payment')}}</a></li>
        <li class="{{ Route::is('customer.profile.index') ? 'active' : '' }}"><a href="{{ route('customer.profile.index')}}" class="menu-item"><i class="far fa-user"></i> {{ __('main.word.my-profile')}}</a></li>
        <li class="{{ Route::is('customer.address.index') ? 'active' : '' }}"><a href="{{ route('customer.address.index')}}" class="menu-item"><i class="fas fa-map-marker-alt"></i> {{ __('main.word.Shipping Address')}}</a></li>
        <li class="">
            <a href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="menu-item"><i class="fas fa-sign-out-alt"></i> LOG OUT </a>
            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
    <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->
