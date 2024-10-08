<!--begin::Base Scripts -->
<script src="{{ asset('js/backend/vendor/vendors.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/backend/default/scripts.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/backend/backend.js') }}" type="text/javascript"></script>
@include('sweet::alert')<!--end::Base Scripts -->
@stack('script')

<script type="text/javascript">
    $( document ).ready(function() {
    var TextBackendNTTPS ='© ' + new Date().getFullYear() + ' - NTTPS All RIGHTS RESERVED.';   
    var onSiteNTTPS  ='© ' + new Date().getFullYear() + ' - NTTPS MyBackEnd.';         
    $('.m-footer__copyright').html(onSiteNTTPS);
    console.log(TextBackendNTTPS);
    });
</script>