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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/products.js":
/*!**********************************!*\
  !*** ./resources/js/products.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

function getSlideDimensions(slide) {
  if (!slide.doGetSlideDimensions) return; // make sure we don't keep requesting the image if it doesn't exist etc.

  var img = new Image();
  $(img).on("error", function (evt) {
    slide.doGetSlideDimensions = false;
  });
  $(img).on("load", function (evt) {
    slide.doGetSlideDimensions = false;
    slide.w = img.naturalWidth;
    slide.h = img.naturalHeight;
    photoSwipe.invalidateCurrItems();
    photoSwipe.updateSize(true);
  });
  img.src = slide.src;
}

var initPhotoSwipeFromDOM = function initPhotoSwipeFromDOM(gallerySelector) {
  // parse slide data (url, title, size ...) from DOM elements 
  // (children of gallerySelector)
  var parseThumbnailElements = function parseThumbnailElements(el) {
    /*  Extension to photoswipe. 
        First fetch the element clicked on. 
        It is used to set the index later */
    var entryElement = el.querySelectorAll('figure');
    var element = entryElement[0].querySelectorAll('a');
    var firstImage = element[0].getAttribute('href');
    /*  Extension to photoswipe. 
        Now overwrite variable "el" and populate it with DOM data
        from the DIV containing the thumbnails                      */

    var allElm = document.querySelectorAll(gallerySelector);
    var el = allElm[0].querySelectorAll('figure');
    var thumbElements = el,
        numNodes = thumbElements.length,
        items = [],
        figureEl,
        linkEl,
        size,
        item;

    for (var i = 0; i < numNodes; i++) {
      figureEl = thumbElements[i]; // <figure> element
      // include only element nodes 

      if (figureEl.nodeType !== 1) {
        continue;
      }

      linkEl = figureEl.children[0]; // <a> element

      size = linkEl.getAttribute('data-size').split('x'); // create slide object

      item = {
        src: linkEl.getAttribute('href'),
        w: parseInt(size[0], 10),
        h: parseInt(size[1], 10),

        /*  Extension to photoswipe. 
            Extend object ITEM with "start". Set to true when it is the 
            thumbnail clicked in the browser.
            Search the source for item.start to see how it is used  */
        start: linkEl.getAttribute('href') === firstImage ? true : false
      };

      if (figureEl.children.length > 1) {
        // <figcaption> content
        item.title = figureEl.children[1].innerHTML;
      }

      if (linkEl.children.length > 0) {
        // <img> thumbnail element, retrieving thumbnail url
        item.msrc = linkEl.children[0].getAttribute('src');
      }

      item.el = figureEl; // save link to element for getThumbBoundsFn

      items.push(item);
    }

    return items;
  }; // End parseThumbnailElements.    
  // find nearest parent element


  var closest = function closest(el, fn) {
    return el && (fn(el) ? el : closest(el.parentNode, fn));
  }; // triggers when user clicks on thumbnail


  var onThumbnailsClick = function onThumbnailsClick(e) {
    e = e || window.event;
    e.preventDefault ? e.preventDefault() : e.returnValue = false;
    var eTarget = e.target || e.srcElement; // find root element of slide

    var clickedListItem = closest(eTarget, function (el) {
      return el.tagName && el.tagName.toUpperCase() === 'FIGURE';
    });

    if (!clickedListItem) {
      return;
    } // find index of clicked item by looping through all child nodes
    // alternatively, you may define index via data- attribute


    var clickedGallery = clickedListItem.parentNode,
        childNodes = clickedListItem.parentNode.childNodes,
        numChildNodes = childNodes.length,
        nodeIndex = 0,
        index;

    for (var i = 0; i < numChildNodes; i++) {
      if (childNodes[i].nodeType !== 1) {
        continue;
      }

      if (childNodes[i] === clickedListItem) {
        index = nodeIndex;
        break;
      }

      nodeIndex++;
    }

    if (index >= 0) {
      // open PhotoSwipe if valid index found
      openPhotoSwipe(index, clickedGallery);
    }

    return false;
  }; // parse picture index and gallery index from URL (#&pid=1&gid=2)


  var photoswipeParseHash = function photoswipeParseHash() {
    var hash = window.location.hash.substring(1),
        params = {};

    if (hash.length < 5) {
      return params;
    }

    var vars = hash.split('&');

    for (var i = 0; i < vars.length; i++) {
      if (!vars[i]) {
        continue;
      }

      var pair = vars[i].split('=');

      if (pair.length < 2) {
        continue;
      }

      params[pair[0]] = pair[1];
    }

    if (params.gid) {
      params.gid = parseInt(params.gid, 10);
    }

    return params;
  };

  var openPhotoSwipe = function openPhotoSwipe(index, galleryElement, disableAnimation, fromURL) {
    var pswpElement = document.querySelectorAll('.pswp')[0],
        gallery,
        options,
        items;
    items = parseThumbnailElements(galleryElement); // define options (if needed)

    options = {
      // define gallery index (for URL)
      galleryUID: galleryElement.getAttribute('data-pswp-uid'),
      showHideOpacity: true,
      getThumbBoundsFn: function getThumbBoundsFn(index) {
        // See Options -> getThumbBoundsFn section of documentation for more info
        var thumbnail = items[index].el.getElementsByTagName('img')[0],
            // find thumbnail
        pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
            rect = thumbnail.getBoundingClientRect();
        return {
          x: rect.left,
          y: rect.top + pageYScroll,
          w: rect.width
        };
      }
    }; // PhotoSwipe opened from URL

    if (fromURL) {
      if (options.galleryPIDs) {
        // parse real index when custom PIDs are used 
        // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
        for (var j = 0; j < items.length; j++) {
          if (items[j].pid == index) {
            options.index = j;
            break;
          }
        }
      } else {
        // in URL indexes start from 1
        options.index = parseInt(index, 10) - 1;
      }
    } else {
      options.index = parseInt(index, 10);
    } // exit if index not found


    if (isNaN(options.index)) {
      return;
    }

    if (disableAnimation) {
      options.showAnimationDuration = 0;
    }
    /*  Extension to photoswipe. 
        Set index with item.start */


    for (var findInd = 0; findInd < items.length; findInd++) {
      if (items[findInd].start) {
        options.index = findInd;
        break;
      }
    } // Pass data to PhotoSwipe and initialize it


    gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.listen("gettingData", function (index, slide) {
      if (slide.doGetSlideDimensions) {
        setTimeout( // use setTimeout so that it runs in the event loop
        function () {
          getSlideDimensions(slide);
        }, 300);
      }
    });
    gallery.listen("imageLoadComplete", function (index, slide) {
      if (slide.doGetSlideDimensions) getSlideDimensions(slide);
    });
    gallery.init();
  }; // loop through all gallery elements and bind events


  var galleryElements = document.querySelectorAll(gallerySelector);

  for (var i = 0, l = galleryElements.length; i < l; i++) {
    galleryElements[i].setAttribute('data-pswp-uid', i + 1);
    galleryElements[i].onclick = onThumbnailsClick;
  } // Parse URL and open gallery if it contains #&pid=3&gid=1


  var hashData = photoswipeParseHash();

  if (hashData.pid && hashData.gid) {
    openPhotoSwipe(hashData.pid, galleryElements[hashData.gid - 1], true, true);
  }
}; // execute above function


initPhotoSwipeFromDOM('.slider-for');
var relatedProduct = $('#related-product'); //var slideImages = $('#image-product-slide');
// slideImages.owlCarousel({            
//     slideSpeed : 300,
//     paginationSpeed : 500,
//     items: 1,
//     autoPlay : 4000,
//     loop:true,
//     stagePadding: 0,
//     singleItem:true,
//     margin:0,
//     nav : true, 
//     dots : false,
//     navText : ['<i class="fas fa-arrow-left"></i>','<i class="fas fa-arrow-right"></i>'],
//     responsive:{
//     }
// });
//fix start not full width
//slideImages.trigger('refresh.owl.carousel');

relatedProduct.owlCarousel({
  nav: true,
  dots: false,
  margin: 10,
  navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
  responsive: {
    0: {
      items: 2
    },
    768: {
      items: 4
    }
  }
});
$(window).on('resize', function () {
  if (typeof timer_gear !== "undefined") {
    clearTimeout(resizeTimerInternal);
  }

  resizeTimerInternal = setTimeout(function () {
    //add functions here to fire on resize
    slickSliderWithResize();
    slickImageResize();
  }, 100);
});

function slickSliderWithResize() {
  if ($(window).width() < 992) {
    if (!$('.slider-nav').hasClass('slick-initialized')) {
      $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        settings: "unslick",
        responsive: [{
          breakpoint: 728,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            adaptiveHeight: true
          }
        }]
      });
    }
  } else {
    if ($('.slider-nav').hasClass('slick-initialized')) {
      $('.slider-nav').slick("unslick");
    }
  }
}

slickSliderWithResize();
$('.slider-for').slick({
  adaptiveHeight: true,
  responsive: [{
    breakpoint: 728,
    settings: {
      arrows: false
    }
  }]
});
var $parent = $(".slider-for");
var $green = $("");
var $images = $green.find("img");
var killit = false;

function slickImageResize() {
  $('.img-gal-item').on('click', function (e) {
    console.log('test');

    if (!killit) {
      e.stopPropagation();
      var idx = $(this).data("thumb");
      console.log(idx);
      $parent.slick("goTo", idx - 1);
    }
  });
}

slickImageResize();
$green.on("beforeChange", function () {
  killit = true;
}).on("afterChange", function () {
  killit = false;
});
$('.slider-for').on('afterChange', function (event, slick, currentSlide, nextSlide) {
  //remove all active class
  $('#image-gal .slick-slide').removeClass('slick-current'); //set active class for current slide

  $('#image-gal .slick-slide:not(.slick-cloned)').eq(currentSlide).addClass('slick-current');
});

/***/ }),

/***/ 3:
/*!****************************************!*\
  !*** multi ./resources/js/products.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\work\pricez\resources\js\products.js */"./resources/js/products.js");


/***/ })

/******/ });