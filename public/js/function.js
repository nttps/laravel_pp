/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/function.js":
/*!**********************************!*\
  !*** ./resources/js/function.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

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
  $("#lang-switch-mb").on("click", function () {
    $(".lang-mb").fadeToggle("fast");
    $(".login-mb").css('display', 'none');
    $(".content-cart-shopping-mb").css('display', 'none');
  });
  $("#login-mb").on("click", function () {
    $(".login-mb").fadeToggle("fast");
    $(".lang-mb").css('display', 'none');
    $(".content-cart-shopping-mb").css('display', 'none');
  });
  $('#list-view').click(function (event) {
    event.preventDefault();
    $('#product .row').addClass('list-group');
    $(this).addClass('active');
    $('#grid-view').removeClass('active');
  });
  $('#grid-view').click(function (event) {
    event.preventDefault();
    $('#product .row').removeClass('list-group');
    $(this).addClass('active');
    $('#list-view').removeClass('active');
  });
}); // Hide Header on on scroll down

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
  var st = $(this).scrollTop(); // Make sure they scroll more than delta

  if (Math.abs(lastScrollTop - st) <= delta) return; // If they scrolled down and are past the navbar, add class .nav-up.
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

/***/ }),

/***/ 2:
/*!****************************************!*\
  !*** multi ./resources/js/function.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\work\pricez\resources\js\function.js */"./resources/js/function.js");


/***/ })

/******/ });