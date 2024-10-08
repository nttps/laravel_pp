$(document).ready(function () {

    $('.sub-menu li.main-cate').mouseenter(function () {
        var img = $(this).data("img");
        $('.img-cover-cate img').attr('src', img);

    });

    var hoverTimeout;
    $('.cart-shopping').hover(function () {
        clearTimeout(hoverTimeout);
        $('.content-cart-shopping').addClass('fadeInUpSmall').removeClass('fadeOutDownSmall').show();
    }, function () {
        hoverTimeout = setTimeout(function () {
            $('.content-cart-shopping').addClass('fadeOutDownSmall').removeClass('fadeInUpSmall').hide();
        }, 1000);
    });
    $('.cart-mb').hover(function () {
        clearTimeout(hoverTimeout);
        $('.content-cart-shopping-mb').addClass('fadeInUpSmall').removeClass('fadeOutDownSmall').show();
    }, function () {
        hoverTimeout = setTimeout(function () {
            $('.content-cart-shopping-mb').addClass('fadeOutDownSmall').removeClass('fadeInUpSmall').hide();
        }, 1000);
    });

    var toggle_open_menu = $("#toggle-open-menu");
    var toggle_close_menu = $("#toggle-close-menu");

    function openNav() {
        document.getElementById("mobileMenu").style.height = "100%";
        document.getElementById("mobileMenu").style.width = "100%";

        document.getElementById("mobileMenu").style.top = "0";
        document.getElementById("mobileMenu").style.right = "0";
        document.getElementById("mobileMenu").style.visibility = "visible";
        document.getElementById("mobileMenu").style.opacity = "1";

    }

    function closeNav() {
        document.getElementById("mobileMenu").style.height = "0%";
        document.getElementById("mobileMenu").style.width = "0%";
        document.getElementById("mobileMenu").style.top = "2%";
        document.getElementById("mobileMenu").style.right = "1%";
        document.getElementById("mobileMenu").style.visibility = "hidden";
        document.getElementById("mobileMenu").style.opacity = "0";
    }

    toggle_open_menu.on('click', function () {
        openNav();
    });
    toggle_close_menu.on('click', function () {
        closeNav();
    });


    $("#login-mb").on("click", function () {
        $(".login-mb").fadeToggle("fast");
        $(".lang-mb").css('display', 'none');
        $(".content-cart-shopping-mb").css('display', 'none');
    });


    $('#list-view').click(function (event) {
        event.preventDefault();
        $('#product .row.product').addClass('list-group');
        $(this).addClass('active');
        $('#grid-view').removeClass('active');
    });
    $('#grid-view').click(function (event) {
        event.preventDefault();
        $('#product .row.product').removeClass('list-group');
        $(this).addClass('active');
        $('#list-view').removeClass('active');
    });

});





// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('header').outerHeight();

$(window).scroll(function (event) {
    didScroll = true;
});

setInterval(function () {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();

    // Make sure they scroll more than delta
    if (Math.abs(lastScrollTop - st) <= delta)
        return;

    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight) {
        // Scroll Down
        $('.sticky').addClass('slideDown');

    } else {
        // Scroll Up
        if (st + $(window).height() < $(document).height()) {

            $('.sticky').removeClass('slideDown');

        }
    }

    if (st == 0) {
        $('.sticky').removeClass('slideDown');
    }


    lastScrollTop = st;
}
