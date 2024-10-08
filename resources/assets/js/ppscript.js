$('.cart-table , .add-to-cart , .table-variantproduct-cart' ).on('click', '.quantity_inc', function() {

    var input = $(this).prev("input[name='qty']");
    var $button = $(this);
    var oldValue = $(input).val();
    var id = $button.data('id');
    var type = $button.data('type');
    if (!isNaN(oldValue)) {
        var newVal = parseFloat(oldValue) + 1;
        $(input).val(newVal);
    }else{
        alert('กรุณากรอกข้อมูลเป็นจำนวน หรือตัวเลข');
    }
    if(type == 'cart'){
        updateCart(1, id , type , $('.cart-table'));
        
    }
});
$('.cart-table' ).on('change', '.quantity_update', function() {
    var oldValue = $(this).val();
    var id = $(this).data('id');
    var type = $(this).data('type');
    if (isNaN(oldValue)) {
        alert('กรุณากรอกข้อมูลเป็นจำนวน หรือตัวเลข');
        return false;        
    }
    if(type == 'update'){
        updateCart(oldValue, id , type , $('.cart-table'));
    }
});
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).on('click' , '.btn-cart' , function() {
    var type = $(this).data('type');
    var c = {
        id: $(this).data('id'),
        qty: 1,
        type: type
    };
    url = '/checkout';
    title = 'สั่งซื้อสินค้า';
    text = 'สินค้าของคุณถูกบันทึกแล้ว';
    texthref    = 'ต้องการไปหน้าสั่งซื้อใช่หรือไม่ ?';
    $.post('/cart/add', c, function (t) {
      
        swal({
            type: 'success',
            title: title,
            text: text,
            showConfirmButton: false,
            footer: '<a href="'+url+'"><strong>'+texthref+'</strong></a>'
        })
        window.setTimeout(function(){ 
            $(".num-basket").load(t + " .number");
        } ,500);
    })
});
$('.cart-table , .add-to-cart , .table-variantproduct-cart').on('click', '.quantity_dec', function(e) {
    e.preventDefault();
    

    if(typeof $(this).prev().prev("input[name='qty']").val() === 'undefined') {
        var input = $(this).next("input[name='qty']");
    }else{
        var input = $(this).prev().prev("input[name='qty']");
    }
    console.log($(this).prev().prev("input[name='qty']").val());
    var $button = $(this);
    var oldValue = $(input).val();
    var id = $button.data('id');
    var newVal = parseFloat(oldValue) - 1;
    var type = $button.data('type');
    if (!isNaN(oldValue)) {
        if (oldValue > 0) {
            var newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 0;
        }
        $(input).val(newVal);
    }else{
        alert('กรุณากรอกข้อมูลเป็นจำนวน หรือตัวเลข');
    }
    if(type == 'cart'){
        updateCart(-1, id , type, $('.cart-table'));
    }
});

$('#btn-show-search').on('click' , function() {
    if ( $('#search_mini_form #search').css('visibility') == 'hidden' )
    $('#search_mini_form #search').css('visibility','visible').css('opacity' , 1);
    else
    $('#search_mini_form #search').css('visibility','hidden').css('opacity' , 0);
    
});

productCompare = function(){
  
}



var toggle_open_menu = document.querySelector(".toggle-open-menu");
var toggle_close_menu = document.querySelector(".toggle-close-menu");

function openNav() {
    document.getElementById("myNav").style.height = "100%";
    document.getElementById("myNav").style.width = "100%";

    document.getElementById("myNav").style.top = "0";
    document.getElementById("myNav").style.right = "0";
    document.getElementById("myNav").style.visibility = "visible";
    document.getElementById("myNav").style.opacity = "1";
  
}

function closeNav() {
    document.getElementById("myNav").style.height = "0%";
    document.getElementById("myNav").style.width = "0%";
    document.getElementById("myNav").style.top = "2%";
    document.getElementById("myNav").style.right = "1%";
    document.getElementById("myNav").style.visibility = "hidden";
    document.getElementById("myNav").style.opacity = "0";
}

toggle_open_menu.addEventListener("click", openNav);
toggle_close_menu.addEventListener("click", closeNav);

$('#qty').bind('change keyup' , function(){
    var qty = $(this).val();
    if (isNaN(qty)) {
        alert('กรุณากรอกข้อมูลเป็นจำนวน หรือตัวเลข');
        $(this).val()
    }
});

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


// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('.header').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    hasWidthScreen();
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasWidthScreen(){
    if($(window).width() > 1199){
        $('#pp-catemenu-s1').removeClass('pp-catemenu-open');
        closeNav();
    }
    if($(window).width() < 1330){
        $('#search_mini_form #search').css('visibility','hidden').css('opacity' , 0);
        $('#btn-show-search').removeClass('showsearch-on-hide').addClass('showsearch-on-show');
        $('#btn-submit').hide();
    }else{
        $('#search_mini_form #search').css('visibility','visible').css('opacity' , 1);
        $('#btn-show-search').addClass('showsearch-on-hide').removeClass('showsearch-on-show');
        $('#btn-submit').show();
    }
}
function hasScrolled() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('.header').removeClass('nav-down').addClass('nav-up');
        if($('.search-autocomplete').css('display') == 'block'){
            $('.search-autocomplete').hide();
        }
        
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('.header').removeClass('nav-up').addClass('nav-down');
            if($('.search-autocomplete').css('display') == 'block'){
                $('.search-autocomplete').show();
            }
            
        }
    }

    
    lastScrollTop = st;
}

$(document).on('keyup blur focus' , '#search , #search_mobile' , function(){
    var q = $(this).val();
    var url = '/search';
    var c = {
        search: q,
    };

    if (q.length > 0) {
        $.get(url, c, function (data) {
            $('.search-autocomplete').show();
            $('.search-autocomplete').html(data);
        });
    }else{
        $('.search-autocomplete').hide();
    }
    
  
});


$(document).ready( function() {
    $('.content-compare').on('click' , function(){
        $('#compareAjax').modal('show');
    });
    var data_compare = Cookies.getJSON('data-compare');

    if(data_compare.length > 0) {

     
        // loop through and apply checks to matching sets
        $.each(data_compare, function(index, value) {
            $('input[data-id=' + value + ']').prop('checked' , true);
            
        });
        $('.content-compare').show();
        $.post('/api/ProductFromCookies', {data:data_compare}, function (t) {
            //console.log(t);
            $(".contentPop").append(t);
            
            //list.push(productID);
        });
    }
    else {
        $('.content-compare').hide();
    }
    $('#ShowSearchMobile').click( function() {
        $('.search_mobile_form').toggleClass('show');
    });

    $(".pp-catemenu ul li.has-childen").click(function (e) {
        e.stopPropagation();
        $(this).children('ul').toggleClass('show');
    });
});


    var data_compare = [];
    var list = [];

    /* function to be executed when product is selected for comparision*/

    $(document).on('click', '.btn-chk-compare', function () {
        
        var productID = $(this).attr('data-id');
       
        var data_compare = Cookies.get('data-compare');
        if (typeof data_compare !== 'undefined'){
            var data_compare = Cookies.getJSON('data-compare');
        }
        var inArray = $.inArray(productID, data_compare);
       
        if (inArray < 0) {
            
            if (data_compare.length > 2) {
                $("#WarningModal").modal('show');
                $(this).prop('checked', false);
                return;
            }
            if (data_compare.length < 3) {
                data_compare.push(productID);
                list.push(productID);
                $.post('/api/ProductToCompare', {data:productID}, function (t) {
                    $(".contentPop").append(t);
                    
                    //list.push(productID);
                });
                $('.content-compare').show();
                Cookies.set('data-compare',data_compare);
            
            }
        } else {
            data_compare.splice($.inArray(productID, data_compare), 1);
            var prod = productID.replace(" ", "");
            $('#' + prod).remove();
            Cookies.set('data-compare',data_compare);
            hideComparePanel();
        }
        if (data_compare.length > 1) {

            $(".cmprBtn").addClass("active");
            $(".cmprBtn").removeAttr('disabled');
        } else {
            $(".cmprBtn").removeClass("active");
            $(".cmprBtn").attr('disabled', '');
        }

    });
    /*function to be executed when compare button is clicked*/
    $(document).on('click', '.cmprBtn', function () {
        if ($(".cmprBtn").hasClass("active")) {
            /* this is to print the  features list statically*/
            $(".contentPop").append('<div class="w3-col s3 m3 l3 compareItemParent relPos">' + '<ul class="product">' + '<li class=" relPos compHeader"><p class="w3-display-middle">Features</p></li>' + '<li>Title</li>' + '<li>Size</li>' + '<li>Weight</li>' + '<li class="cpu">Processor</li>' + '<li>Battery</li></ul>' + '</div>');

            for (var i = 0; i < list.length; i++) {
                /* this is to add the items to popup which are selected for comparision */
                product = $('.selectProduct[data-title="' + list[i] + '"]');
                var image = $('[data-title=' + list[i] + ']').find(".productImg").attr('src');
                var title = $('[data-title=' + list[i] + ']').attr('data-id');
                /*appending to div*/
                $(".contentPop").append('<div class="w3-col s3 m3 l3 compareItemParent relPos">' + '<ul class="product">' + '<li class="compHeader"><img src="' + image + '" class="compareThumb"></li>' + '<li>' + title + '</li>' + '<li>' + $(product).data('size') + '</li>' + '<li>' + $(product).data('weight') + '<li class="cpu">' + $(product).data('processor') + '</li>' + '<li>' + $(product).data('battery') + '</ul>' + '</div>');
            }
        }
        $(".modPos").show();
    });

    /* function to close the comparision popup */
    $(document).on('click', '.closeBtn', function () {
        $(".contentPop").empty();
        $(".comparePan").empty();
        $(".comparePanle").hide();
        $(".modPos").hide();
        $(".selectProduct").removeClass("selected");
        $(".cmprBtn").attr('disabled', '');
        data_compare.length = 0;
    });

    /*function to remove item from preview panel*/
    $(document).on('click', '.selectedItemCloseBtn', function () {
        var productID = $(this).attr('data-id');
        var data_compare = Cookies.getJSON('data-compare');
        data_compare.splice($.inArray(productID, data_compare), 1);

        var prod = productID.replace(" ", "");
        $('#' + prod).remove();
        Cookies.set('data-compare',data_compare);
        $('input[data-id=' + productID + ']').prop('checked' , false);
       
        hideComparePanel();
    });

    function hideComparePanel() {
         var data_compare = Cookies.getJSON('data-compare');
        if (!data_compare.length) {
            $('.content-compare').fadeOut('fast');
            $('#compareAjax').modal('hide');
        }
    }

    	//close filter dropdown inside lateral .cd-filter 
	$('.cd-filter-block h4').on('click', function(){
		$(this).toggleClass('closed').siblings('.cd-filter-content').slideToggle(300);
    });
    

    // $(window).on('load' , function() {
    //     $(".loading").fadeOut("slow");
    // });