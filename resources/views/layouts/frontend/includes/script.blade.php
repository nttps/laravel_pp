<script src="{{ asset('js/app.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/js.cookie.js')}}"></script>
<script src="{{ asset('js/ppscript.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.blockUI.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/sweetalert2.all.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/modernizr.js')}}"></script>
<script src="{{ asset('js/classie.js')}}"></script>

<script>
$(document).ready(function(){
    $(".link-dropdown" ).click(function(e){
        var $this = $(".menu-dropdown-content");
        $(".menu-dropdown-content:visible").not($this).slideToggle(200); //Close submenu already opened
        $this.slideToggle(200); //Open the new submenu
        e.preventDefault();
        return false;
    });
    $(document).click(function(){
        $(".menu-dropdown-content").hide(200);
    });

    productCompare();
});


</script>
@stack('scripts')