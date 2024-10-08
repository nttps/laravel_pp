@if(Session::has('sweet_alert.alert')) 
<script>
    swal({
        text: "{!! Session::get('sweet_alert.text') !!}",
        title: "{!! Session::get('sweet_alert.title') !!}",
        timer: {!!Session::get('sweet_alert.timer') !!},
        type: "{!! Session::get('sweet_alert.icon') !!}",
        // more options
    });


</script>
@endif
