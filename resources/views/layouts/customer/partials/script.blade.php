<script src="{{ asset('js/app.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/ppscript.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.blockUI.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/sweetalert2.all.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/modernizr.js')}}"></script>
<script src="{{ asset('js/classie.js')}}"></script>

<!--end::Base Scripts -->
@stack('script')

<script type="text/javascript">

    menuCate = document.getElementById( 'pp-catemenu-s1' );
    showLeftPush = document.getElementById( 'showCatemenu' );
    closeCatemenu = document.getElementById( 'closeCatemenu' );
    body = document.body;

    showLeftPush.onclick = function() {
        classie.toggle( this, 'active' );
        classie.toggle( body, 'pp-catemenu-push-toright' );
        classie.toggle( menuCate, 'pp-catemenu-open' );
        closeNav();
    };

    closeCatemenu.onclick = function() {
        classie.toggle( body, 'pp-catemenu-push-toright' );
        classie.toggle( menuCate, 'pp-catemenu-open' );
        closeNav();
    };
    setInterval(function() {
        hasWidthScreen();
    }, 250);
    if($(window).width() > 1199){
        $('#pp-catemenu-s1').removeClass('pp-catemenu-open');
        closeNav();
    }
    $( document ).ready(function() {
        
    var TextBackendNTTPS ='© ' + new Date().getFullYear() + ' - NTTPS All RIGHTS RESERVED.';   
    var onSiteNTTPS  ='© ' + new Date().getFullYear() + ' - NTTPS MyBackEnd.';         
    $('.m-footer__copyright').html(onSiteNTTPS);
    console.log(TextBackendNTTPS);
    });
</script>