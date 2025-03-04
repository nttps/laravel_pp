this.Element && function (t) {
    t.matches = t.matches || t.matchesSelector || t.webkitMatchesSelector || t.msMatchesSelector || function (t) {
        for (var e = this, a = (e.parentNode || e.document).querySelectorAll(t), n = -1; a[++n] && a[n] != e;);
        return !!a[n]
    }
}(Element.prototype), this.Element && function (t) {
    t.closest = t.closest || function (t) {
        for (var e = this; e.matches && !e.matches(t);) e = e.parentNode;
        return e.matches ? e : null
    }
}(Element.prototype), this.Element && function (t) {
    t.matches = t.matches || t.matchesSelector || t.webkitMatchesSelector || t.msMatchesSelector || function (t) {
        for (var e = this, a = (e.parentNode || e.document).querySelectorAll(t), n = -1; a[++n] && a[n] != e;);
        return !!a[n]
    }
}(Element.prototype),
function () {
    for (var o = 0, t = ["webkit", "moz"], e = 0; e < t.length && !window.requestAnimationFrame; ++e) window.requestAnimationFrame = window[t[e] + "RequestAnimationFrame"], window.cancelAnimationFrame = window[t[e] + "CancelAnimationFrame"] || window[t[e] + "CancelRequestAnimationFrame"];
    window.requestAnimationFrame || (window.requestAnimationFrame = function (t) {
        var e = (new Date).getTime(),
            a = Math.max(0, 16 - (e - o)),
            n = window.setTimeout(function () {
                t(e + a)
            }, a);
        return o = e + a, n
    }), window.cancelAnimationFrame || (window.cancelAnimationFrame = function (t) {
        clearTimeout(t)
    })
}(), [Element.prototype, Document.prototype, DocumentFragment.prototype].forEach(function (t) {
    t.hasOwnProperty("prepend") || Object.defineProperty(t, "prepend", {
        configurable: !0,
        enumerable: !0,
        writable: !0,
        value: function () {
            var t = Array.prototype.slice.call(arguments),
                a = document.createDocumentFragment();
            t.forEach(function (t) {
                var e = t instanceof Node;
                a.appendChild(e ? t : document.createTextNode(String(t)))
            }), this.insertBefore(a, this.firstChild)
        }
    })
}), window.mUtilElementDataStore = {}, window.mUtilElementDataStoreID = 0, window.mUtilDelegatedEventHandlers = {}, window.noZensmooth = !0;
var mUtil = function () {
var e = [],
    a = {
        sm: 544,
        md: 768,
        lg: 1024,
        xl: 1200
    },
    n = function () {
        var t = !1;
        window.addEventListener("resize", function () {
            clearTimeout(t), t = setTimeout(function () {
                ! function () {
                    for (var t = 0; t < e.length; t++) e[t].call()
                }()
            }, 250)
        })
    };
return {
    init: function (t) {
        t && t.breakpoints && (a = t.breakpoints), n()
    },
    addResizeHandler: function (t) {
        e.push(t)
    },
    runResizeHandlers: function () {
        _runResizeHandlers()
    },
    getURLParam: function (t) {
        var e, a, n = window.location.search.substring(1).split("&");
        for (e = 0; e < n.length; e++)
            if ((a = n[e].split("="))[0] == t) return unescape(a[1]);
        return null
    },
    isMobileDevice: function () {
        return this.getViewPort().width < this.getBreakpoint("lg")
    },
    isDesktopDevice: function () {
        return !mUtil.isMobileDevice()
    },
    getViewPort: function () {
        var t = window,
            e = "inner";
        return "innerWidth" in window || (e = "client", t = document.documentElement || document.body), {
            width: t[e + "Width"],
            height: t[e + "Height"]
        }
    },
    isInResponsiveRange: function (t) {
        var e = this.getViewPort().width;
        return "general" == t || ("desktop" == t && e >= this.getBreakpoint("lg") + 1 || ("tablet" == t && e >= this.getBreakpoint("md") + 1 && e < this.getBreakpoint("lg") || ("mobile" == t && e <= this.getBreakpoint("md") || ("desktop-and-tablet" == t && e >= this.getBreakpoint("md") + 1 || ("tablet-and-mobile" == t && e <= this.getBreakpoint("lg") || "minimal-desktop-and-below" == t && e <= this.getBreakpoint("xl"))))))
    },
    getUniqueID: function (t) {
        return t + Math.floor(Math.random() * (new Date).getTime())
    },
    getBreakpoint: function (t) {
        return a[t]
    },
    isset: function (t, e) {
        var a;
        if (-1 !== (e = e || "").indexOf("[")) throw new Error("Unsupported object path notation.");
        e = e.split(".");
        do {
            if (void 0 === t) return !1;
            if (a = e.shift(), !t.hasOwnProperty(a)) return !1;
            t = t[a]
        } while (e.length);
        return !0
    },
    getHighestZindex: function (t) {
        for (var e, a, n = mUtil.get(t); n && n !== document;) {
            if (("absolute" === (e = mUtil.css(n, "position")) || "relative" === e || "fixed" === e) && (a = parseInt(mUtil.css(n, "z-index")), !isNaN(a) && 0 !== a)) return a;
            n = n.parentNode
        }
        return null
    },
    hasFixedPositionedParent: function (t) {
        for (; t && t !== document;) {
            if (position = mUtil.css(t, "position"), "fixed" === position) return !0;
            t = t.parentNode
        }
        return !1
    },
    sleep: function (t) {
        for (var e = (new Date).getTime(), a = 0; a < 1e7 && !((new Date).getTime() - e > t); a++);
    },
    getRandomInt: function (t, e) {
        return Math.floor(Math.random() * (e - t + 1)) + t
    },
    isAngularVersion: function () {
        return void 0 !== window.Zone
    },
    deepExtend: function (t) {
        t = t || {};
        for (var e = 1; e < arguments.length; e++) {
            var a = arguments[e];
            if (a)
                for (var n in a) a.hasOwnProperty(n) && ("object" == typeof a[n] ? t[n] = mUtil.deepExtend(t[n], a[n]) : t[n] = a[n])
        }
        return t
    },
    extend: function (t) {
        t = t || {};
        for (var e = 1; e < arguments.length; e++)
            if (arguments[e])
                for (var a in arguments[e]) arguments[e].hasOwnProperty(a) && (t[a] = arguments[e][a]);
        return t
    },
    get: function (t) {
        var e;
        return t === document ? document : t && 1 === t.nodeType ? t : (e = document.getElementById(t)) ? e : (e = document.getElementsByTagName(t)) ? e[0] : (e = document.getElementsByClassName(t)) ? e[0] : null
    },
    hasClasses: function (t, e) {
        if (t) {
            for (var a = e.split(" "), n = 0; n < a.length; n++)
                if (0 == mUtil.hasClass(t, mUtil.trim(a[n]))) return !1;
            return !0
        }
    },
    hasClass: function (t, e) {
        if (t) return t.classList ? t.classList.contains(e) : new RegExp("\\b" + e + "\\b").test(t.className)
    },
    addClass: function (t, e) {
        if (t && void 0 !== e) {
            var a = e.split(" ");
            if (t.classList)
                for (var n = 0; n < a.length; n++) a[n] && 0 < a[n].length && t.classList.add(mUtil.trim(a[n]));
            else if (!mUtil.hasClass(t, e))
                for (n = 0; n < a.length; n++) t.className += " " + mUtil.trim(a[n])
        }
    },
    removeClass: function (t, e) {
        if (t) {
            var a = e.split(" ");
            if (t.classList)
                for (var n = 0; n < a.length; n++) t.classList.remove(mUtil.trim(a[n]));
            else if (mUtil.hasClass(t, e))
                for (n = 0; n < a.length; n++) t.className = t.className.replace(new RegExp("\\b" + mUtil.trim(a[n]) + "\\b", "g"), "")
        }
    },
    triggerCustomEvent: function (t, e, a) {
        if (window.CustomEvent) var n = new CustomEvent(e, {
            detail: a
        });
        else(n = document.createEvent("CustomEvent")).initCustomEvent(e, !0, !0, a);
        t.dispatchEvent(n)
    },
    trim: function (t) {
        return t.trim()
    },
    eventTriggered: function (t) {
        return !!t.currentTarget.dataset.triggered || !(t.currentTarget.dataset.triggered = !0)
    },
    remove: function (t) {
        t && t.parentNode && t.parentNode.removeChild(t)
    },
    find: function (t, e) {
        return t.querySelector(e)
    },
    findAll: function (t, e) {
        return t.querySelectorAll(e)
    },
    insertAfter: function (t, e) {
        return e.parentNode.insertBefore(t, e.nextSibling)
    },
    parents: function (t, e) {
        function o(t, e) {
            for (var a = 0, n = t.length; a < n; a++)
                if (t[a] == e) return !0;
            return !1
        }
        return function (t, e) {
            for (var a = document.querySelectorAll(e), n = t.parentNode; n && !o(a, n);) n = n.parentNode;
            return n
        }(t, e)
    },
    children: function (t, e, a) {
        if (t && t.childNodes) {
            for (var n = [], o = 0, i = t.childNodes.length; o < i; ++o) 1 == t.childNodes[o].nodeType && mUtil.matches(t.childNodes[o], e, a) && n.push(t.childNodes[o]);
            return n
        }
    },
    child: function (t, e, a) {
        var n = mUtil.children(t, e, a);
        return n ? n[0] : null
    },
    matches: function (t, e, a) {
        var n = Element.prototype,
            o = n.matches || n.webkitMatchesSelector || n.mozMatchesSelector || n.msMatchesSelector || function (t) {
                return -1 !== [].indexOf.call(document.querySelectorAll(t), this)
            };
        return !(!t || !t.tagName) && o.call(t, e)
    },
    data: function (a) {
        return a = mUtil.get(a), {
            set: function (t, e) {
                void 0 === a.customDataTag && (mUtilElementDataStoreID++, a.customDataTag = mUtilElementDataStoreID), void 0 === mUtilElementDataStore[a.customDataTag] && (mUtilElementDataStore[a.customDataTag] = {}), mUtilElementDataStore[a.customDataTag][t] = e
            },
            get: function (t) {
                return this.has(t) ? mUtilElementDataStore[a.customDataTag][t] : null
            },
            has: function (t) {
                return !(!mUtilElementDataStore[a.customDataTag] || !mUtilElementDataStore[a.customDataTag][t])
            },
            remove: function (t) {
                this.has(t) && delete mUtilElementDataStore[a.customDataTag][t]
            }
        }
    },
    outerWidth: function (t, e) {
        if (!0 === e) {
            var a = parseFloat(t.offsetWidth);
            return a += parseFloat(mUtil.css(t, "margin-left")) + parseFloat(mUtil.css(t, "margin-right")), parseFloat(a)
        }
        return a = parseFloat(t.offsetWidth)
    },
    offset: function (t) {
        var e = t.getBoundingClientRect();
        return {
            top: e.top + document.body.scrollTop,
            left: e.left + document.body.scrollLeft
        }
    },
    height: function (t) {
        return mUtil.css(t, "height")
    },
    visible: function (t) {
        return !(0 === t.offsetWidth && 0 === t.offsetHeight)
    },
    attr: function (t, e, a) {
        if (null != (t = mUtil.get(t))) return void 0 === a ? t.getAttribute(e) : void t.setAttribute(e, a)
    },
    hasAttr: function (t, e) {
        if (null != (t = mUtil.get(t))) return !!t.getAttribute(e)
    },
    removeAttr: function (t, e) {
        null != (t = mUtil.get(t)) && t.removeAttribute(e)
    },
    animate: function (n, o, i, l, r, s) {
        var t = {
            linear: function (t, e, a, n) {
                return a * t / n + e
            }
        };
        if ("number" == typeof n && "number" == typeof o && "number" == typeof i && "function" == typeof l) {
            "string" == typeof r && t[r] && (r = t[r]), "function" != typeof r && (r = t.linear), "function" != typeof s && (s = function () {});
            var d = window.requestAnimationFrame || function (t) {
                    window.setTimeout(t, 1e3 / 60)
                },
                c = o - n;
            l(n);
            var m = window.performance && window.performance.now ? window.performance.now() : +new Date;
            d(function t(e) {
                var a = (e || +new Date) - m;
                0 <= a && l(r(a, n, c, i)), 0 <= a && i <= a ? (l(o), s()) : d(t)
            })
        }
    },
    actualCss: function (t, e, a) {
        var n;
        if (t instanceof HTMLElement != !1) return t.getAttribute("m-hidden-" + e) && !1 !== a ? parseFloat(t.getAttribute("m-hidden-" + e)) : (t.style.cssText = "position: absolute; visibility: hidden; display: block;", "width" == e ? n = t.offsetWidth : "height" == e && (n = t.offsetHeight), t.style.cssText = "", t.setAttribute("m-hidden-" + e, n), parseFloat(n))
    },
    actualHeight: function (t, e) {
        return mUtil.actualCss(t, "height", e)
    },
    actualWidth: function (t, e) {
        return mUtil.actualCss(t, "width", e)
    },
    getScroll: function (t, e) {
        return e = "scroll" + e, t == window || t == document ? self["scrollTop" == e ? "pageYOffset" : "pageXOffset"] || browserSupportsBoxModel && document.documentElement[e] || document.body[e] : t[e]
    },
    css: function (t, e, a) {
        if (t = mUtil.get(t), void 0 !== a) t.style[e] = a;
        else {
            var n = (t.ownerDocument || document).defaultView;
            if (n && n.getComputedStyle) return e = e.replace(/([A-Z])/g, "-$1").toLowerCase(), n.getComputedStyle(t, null).getPropertyValue(e);
            if (t.currentStyle) return e = e.replace(/\-(\w)/g, function (t, e) {
                return e.toUpperCase()
            }), a = t.currentStyle[e], /^\d+(em|pt|%|ex)?$/i.test(a) ? (o = a, i = t.style.left, l = t.runtimeStyle.left, t.runtimeStyle.left = t.currentStyle.left, t.style.left = o || 0, o = t.style.pixelLeft + "px", t.style.left = i, t.runtimeStyle.left = l, o) : a
        }
        var o, i, l
    },
    slide: function (e, t, a, n, o) {
        if (!(!e || "up" == t && !1 === mUtil.visible(e) || "down" == t && !0 === mUtil.visible(e))) {
            a = a || 600;
            var i = mUtil.actualHeight(e),
                l = !1,
                r = !1;
            mUtil.css(e, "padding-top") && !0 !== mUtil.data(e).has("slide-padding-top") && mUtil.data(e).set("slide-padding-top", mUtil.css(e, "padding-top")), mUtil.css(e, "padding-bottom") && !0 !== mUtil.data(e).has("slide-padding-bottom") && mUtil.data(e).set("slide-padding-bottom", mUtil.css(e, "padding-bottom")), mUtil.data(e).has("slide-padding-top") && (l = parseInt(mUtil.data(e).get("slide-padding-top"))), mUtil.data(e).has("slide-padding-bottom") && (r = parseInt(mUtil.data(e).get("slide-padding-bottom"))), "up" == t ? (e.style.cssText = "display: block; overflow: hidden;", l && mUtil.animate(0, l, a, function (t) {
                e.style.paddingTop = l - t + "px"
            }, "linear"), r && mUtil.animate(0, r, a, function (t) {
                e.style.paddingBottom = r - t + "px"
            }, "linear"), mUtil.animate(0, i, a, function (t) {
                e.style.height = i - t + "px"
            }, "linear", function () {
                n(), e.style.height = "", e.style.display = "none"
            })) : "down" == t && (e.style.cssText = "display: block; overflow: hidden;", l && mUtil.animate(0, l, a, function (t) {
                e.style.paddingTop = t + "px"
            }, "linear", function () {
                e.style.paddingTop = ""
            }), r && mUtil.animate(0, r, a, function (t) {
                e.style.paddingBottom = t + "px"
            }, "linear", function () {
                e.style.paddingBottom = ""
            }), mUtil.animate(0, i, a, function (t) {
                e.style.height = t + "px"
            }, "linear", function () {
                n(), e.style.height = "", e.style.display = "", e.style.overflow = ""
            }))
        }
    },
    slideUp: function (t, e, a) {
        mUtil.slide(t, "up", e, a)
    },
    slideDown: function (t, e, a) {
        mUtil.slide(t, "down", e, a)
    },
    show: function (t, e) {
        t.style.display = e || "block"
    },
    hide: function (t) {
        t.style.display = "none"
    },
    addEvent: function (t, e, a, n) {
        void 0 !== (t = mUtil.get(t)) && t.addEventListener(e, a)
    },
    removeEvent: function (t, e, a) {
        (t = mUtil.get(t)).removeEventListener(e, a)
    },
    on: function (i, l, t, r) {
        if (l) {
            var e = mUtil.getUniqueID("event");
            return mUtilDelegatedEventHandlers[e] = function (t) {
                for (var e = i.querySelectorAll(l), a = t.target; a && a !== i;) {
                    for (var n = 0, o = e.length; n < o; n++) a === e[n] && r.call(a, t);
                    a = a.parentNode
                }
            }, mUtil.addEvent(i, t, mUtilDelegatedEventHandlers[e]), e
        }
    },
    off: function (t, e, a) {
        t && mUtilDelegatedEventHandlers[a] && (mUtil.removeEvent(t, e, mUtilDelegatedEventHandlers[a]), delete mUtilDelegatedEventHandlers[a])
    },
    one: function (t, e, a) {
        (t = mUtil.get(t)).addEventListener(e, function (t) {
            return t.target.removeEventListener(t.type, arguments.callee), a(t)
        })
    },
    hash: function (t) {
        var e, a = 0;
        if (0 === t.length) return a;
        for (e = 0; e < t.length; e++) a = (a << 5) - a + t.charCodeAt(e), a |= 0;
        return a
    },
    animateClass: function (t, e, a) {
        mUtil.addClass(t, "animated " + e), mUtil.one(t, "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
            mUtil.removeClass(t, "animated " + e)
        }), a && mUtil.one(t.animationEnd, a)
    },
    animateDelay: function (t, e) {
        for (var a = ["webkit-", "moz-", "ms-", "o-", ""], n = 0; n < a.length; n++) mUtil.css(t, a[n] + "animation-delay", e)
    },
    animateDuration: function (t, e) {
        for (var a = ["webkit-", "moz-", "ms-", "o-", ""], n = 0; n < a.length; n++) mUtil.css(t, a[n] + "animation-duration", e)
    },
    scrollTo: function (t, e, a) {
        a || (a = 600), zenscroll.toY(t, a)
    },
    scrollToViewport: function (t, e) {
        e || (e = 1200), zenscroll.intoView(t, e)
    },
    scrollToCenter: function (t, e) {
        e || (e = 1200), zenscroll.center(t, e)
    },
    scrollTop: function (t) {
        t || (t = 600), zenscroll.toY(0, t)
    },
    isArray: function (t) {
        return t && Array.isArray(t)
    },
    ready: function (t) {
        (document.attachEvent ? "complete" === document.readyState : "loading" !== document.readyState) ? t(): document.addEventListener("DOMContentLoaded", t)
    },
    isEmpty: function (t) {
        for (var e in t)
            if (t.hasOwnProperty(e)) return !1;
        return !0
    }
}
}();
mUtil.ready(function () {
mUtil.init()
});
var mApp = function () {
var e = {
        brand: "#716aca",
        metal: "#c4c5d6",
        light: "#ffffff",
        accent: "#00c5dc",
        primary: "#5867dd",
        success: "#34bfa3",
        info: "#36a3f7",
        warning: "#ffb822",
        danger: "#f4516c",
        focus: "#9816f4"
    },
    a = function (t) {
        var e = t.data("skin") ? "m-tooltip--skin-" + t.data("skin") : "",
            a = "auto" == t.data("width") ? "m-tooltop--auto-width" : "",
            n = t.data("trigger") ? t.data("trigger") : "hover";
        t.tooltip({
            trigger: n,
            template: '<div class="m-tooltip ' + e + " " + a + ' tooltip" role="tooltip">                <div class="arrow"></div>                <div class="tooltip-inner"></div>            </div>'
        })
    },
    t = function () {
        $('[data-toggle="m-tooltip"]').each(function () {
            a($(this))
        })
    },
    n = function (t) {
        var e = t.data("skin") ? "m-popover--skin-" + t.data("skin") : "",
            a = t.data("trigger") ? t.data("trigger") : "hover";
        t.popover({
            trigger: a,
            template: '            <div class="m-popover ' + e + ' popover" role="tooltip">                <div class="arrow"></div>                <h3 class="popover-header"></h3>                <div class="popover-body"></div>            </div>'
        })
    },
    o = function () {
        $('[data-toggle="m-popover"]').each(function () {
            n($(this))
        })
    },
    i = function (t, e) {
        t = $(t), new mPortlet(t[0], e)
    },
    l = function () {
        $('[m-portlet="true"]').each(function () {
            var t = $(this);
            !0 !== t.data("portlet-initialized") && (i(t, {}), t.data("portlet-initialized", !0))
        })
    },
    r = function () {
        $("[data-tab-target]").each(function () {
            1 != $(this).data("tabs-initialized") && ($(this).click(function (t) {
                t.preventDefault();
                var e = $(this),
                    a = e.closest('[data-tabs="true"]'),
                    n = $(a.data("tabs-contents")),
                    o = $(e.data("tab-target"));
                a.find(".m-tabs__item.m-tabs__item--active").removeClass("m-tabs__item--active"), e.addClass("m-tabs__item--active"), n.find(".m-tabs-content__item.m-tabs-content__item--active").removeClass("m-tabs-content__item--active"), o.addClass("m-tabs-content__item--active")
            }), $(this).data("tabs-initialized", !0))
        })
    };
return {
    init: function (t) {
        t && t.colors && (e = t.colors), mApp.initComponents()
    },
    initComponents: function () {
        jQuery.event.special.touchstart = {
            setup: function (t, e, a) {
                "function" == typeof this && (e.includes("noPreventDefault") ? this.addEventListener("touchstart", a, {
                    passive: !1
                }) : this.addEventListener("touchstart", a, {
                    passive: !0
                }))
            }
        }, jQuery.event.special.touchmove = {
            setup: function (t, e, a) {
                "function" == typeof this && (e.includes("noPreventDefault") ? this.addEventListener("touchmove", a, {
                    passive: !1
                }) : this.addEventListener("touchmove", a, {
                    passive: !0
                }))
            }
        }, jQuery.event.special.wheel = {
            setup: function (t, e, a) {
                "function" == typeof this && (e.includes("noPreventDefault") ? this.addEventListener("wheel", a, {
                    passive: !1
                }) : this.addEventListener("wheel", a, {
                    passive: !0
                }))
            }
        }, $('[data-scrollable="true"]').each(function () {
            var t, e, a = $(this);
            mUtil.isInResponsiveRange("tablet-and-mobile") ? (t = a.data("mobile-max-height") ? a.data("mobile-max-height") : a.data("max-height"), e = a.data("mobile-height") ? a.data("mobile-height") : a.data("height")) : (t = a.data("max-height"), e = a.data("max-height")), t && a.css("max-height", t), e && a.css("height", e), mApp.initScroller(a, {})
        }), t(), o(), $("body").on("click", "[data-close=alert]", function () {
            $(this).closest(".alert").hide()
        }), l(), $(".custom-file-input").on("change", function () {
            var t = $(this).val();
            $(this).next(".custom-file-label").addClass("selected").html(t)
        }), r()
    },
    initCustomTabs: function () {
        r()
    },
    initTooltips: function () {
        t()
    },
    initTooltip: function (t) {
        a(t)
    },
    initPopovers: function () {
        o()
    },
    initPopover: function (t) {
        n(t)
    },
    initPortlet: function (t, e) {
        i(t, e)
    },
    initPortlets: function () {
        l()
    },
    scrollTo: function (t, e) {
        el = $(t);
        var a = el && 0 < el.length ? el.offset().top : 0;
        a += e || 0, jQuery("html,body").animate({
            scrollTop: a
        }, "slow")
    },
    scrollToViewport: function (t) {
        var e = $(t).offset().top,
            a = t.height(),
            n = e - (mUtil.getViewPort().height / 2 - a / 2);
        jQuery("html,body").animate({
            scrollTop: n
        }, "slow")
    },
    scrollTop: function () {
        mApp.scrollTo()
    },
    initScroller: function (t, e, a) {
        mUtil.isMobileDevice() ? t.css("overflow", "auto") : (!0 !== a && mApp.destroyScroller(t), t.mCustomScrollbar({
            scrollInertia: 0,
            autoDraggerLength: !0,
            autoHideScrollbar: !0,
            autoExpandScrollbar: !1,
            alwaysShowScrollbar: 0,
            axis: t.data("axis") ? t.data("axis") : "y",
            mouseWheel: {
                scrollAmount: 120,
                preventDefault: !0
            },
            setHeight: e.height ? e.height : "",
            theme: "minimal-dark"
        }))
    },
    destroyScroller: function (t) {
        t.mCustomScrollbar("destroy"), t.removeClass("mCS_destroyed")
    },
    alert: function (t) {
        t = $.extend(!0, {
            container: "",
            place: "append",
            type: "success",
            message: "",
            close: !0,
            reset: !0,
            focus: !0,
            closeInSeconds: 0,
            icon: ""
        }, t);
        var e = mUtil.getUniqueID("App_alert"),
            a = '<div id="' + e + '" class="custom-alerts alert alert-' + t.type + ' fade in">' + (t.close ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>' : "") + ("" !== t.icon ? '<i class="fa-lg fa fa-' + t.icon + '"></i>  ' : "") + t.message + "</div>";
        return t.reset && $(".custom-alerts").remove(), t.container ? "append" == t.place ? $(t.container).append(a) : $(t.container).prepend(a) : 1 === $(".page-fixed-main-content").size() ? $(".page-fixed-main-content").prepend(a) : ($("body").hasClass("page-container-bg-solid") || $("body").hasClass("page-content-white")) && 0 === $(".page-head").size() ? $(".page-title").after(a) : 0 < $(".page-bar").size() ? $(".page-bar").after(a) : $(".page-breadcrumb, .breadcrumbs").after(a), t.focus && mApp.scrollTo($("#" + e)), 0 < t.closeInSeconds && setTimeout(function () {
            $("#" + e).remove()
        }, 1e3 * t.closeInSeconds), e
    },
    block: function (t, e) {
        var a, n, o, i = $(t);
        if ("spinner" == (e = $.extend(!0, {
                opacity: .03,
                overlayColor: "#000000",
                state: "brand",
                type: "loader",
                size: "lg",
                centerX: !0,
                centerY: !0,
                message: "",
                shadow: !0,
                width: "auto"
            }, e)).type ? o = '<div class="m-spinner ' + (a = e.skin ? "m-spinner--skin-" + e.skin : "") + " " + (n = e.state ? "m-spinner--" + e.state : "") + '"></div' : (a = e.skin ? "m-loader--skin-" + e.skin : "", n = e.state ? "m-loader--" + e.state : "", size = e.size ? "m-loader--" + e.size : "", o = '<div class="m-loader ' + a + " " + n + " " + size + '"></div'), e.message && 0 < e.message.length) {
            var l = "m-blockui " + (!1 === e.shadow ? "m-blockui-no-shadow" : "");
            html = '<div class="' + l + '"><span>' + e.message + "</span><span>" + o + "</span></div>";
            i = document.createElement("div");
            mUtil.get("body").prepend(i), mUtil.addClass(i, l), i.innerHTML = "<span>" + e.message + "</span><span>" + o + "</span>", e.width = mUtil.actualWidth(i) + 10, mUtil.remove(i), "body" == t && (html = '<div class="' + l + '" style="margin-left:-' + e.width / 2 + 'px;"><span>' + e.message + "</span><span>" + o + "</span></div>")
        } else html = o;
        var r = {
            message: html,
            centerY: e.centerY,
            centerX: e.centerX,
            css: {
                top: "30%",
                left: "50%",
                border: "0",
                padding: "0",
                backgroundColor: "none",
                width: e.width
            },
            overlayCSS: {
                backgroundColor: e.overlayColor,
                opacity: e.opacity,
                cursor: "wait",
                zIndex: "10"
            },
            onUnblock: function () {
                i && (i.css("position", ""), i.css("zoom", ""))
            }
        };
        "body" == t ? (r.css.top = "50%", $.blockUI(r)) : (i = $(t)).block(r)
    },
    unblock: function (t) {
        t && "body" != t ? $(t).unblock() : $.unblockUI()
    },
    blockPage: function (t) {
        return mApp.block("body", t)
    },
    unblockPage: function () {
        return mApp.unblock("body")
    },
    progress: function (t, e) {
        var a = "m-loader m-loader--" + (e && e.skin ? e.skin : "light") + " m-loader--" + (e && e.alignment ? e.alignment : "right") + " m-loader--" + (e && e.size ? "m-spinner--" + e.size : "");
        mApp.unprogress(t), $(t).addClass(a), $(t).data("progress-classes", a)
    },
    unprogress: function (t) {
        $(t).removeClass($(t).data("progress-classes"))
    },
    getColor: function (t) {
        return e[t]
    }
}
}();
$(document).ready(function () {
    mApp.init({})
}),
function (g) {
    if (void 0 === mUtil) throw new Error("mUtil is required and must be included before mDatatable.");
    g.fn.mDatatable = function (u) {
        if (0 !== g(this).length) {
            var p = this;
            p.debug = !1;
            var f = {
                isInit: !(p.API = {
                    record: null,
                    value: null,
                    params: null
                }),
                offset: 110,
                stateId: "meta",
                ajaxParams: {},
                init: function (t) {
                    var e = !1;
                    return null === t.data.source && (f.extractTable(), e = !0), f.setupBaseDOM.call(), f.setupDOM(p.table), f.spinnerCallback(!0), f.setDataSourceQuery(f.getOption("data.source.read.params.query")), g(p).on("m-datatable--on-layout-updated", f.afterRender), p.debug && f.stateRemove(f.stateId), g.each(f.getOption("extensions"), function (t, e) {
                        "function" == typeof g.fn.mDatatable[t] && new g.fn.mDatatable[t](p, e)
                    }), "remote" !== t.data.type && "local" !== t.data.type || ((!1 === t.data.saveState || !1 === t.data.saveState.cookie && !1 === t.data.saveState.webstorage) && f.stateRemove(f.stateId), "local" === t.data.type && "object" == typeof t.data.source && (p.dataSet = p.originalDataSet = f.dataMapCallback(t.data.source)), f.dataRender()), e || (f.setHeadTitle(), f.getOption("layout.footer") && f.setHeadTitle(p.tableFoot)), void 0 !== t.layout.header && !1 === t.layout.header && g(p.table).find("thead").remove(), void 0 !== t.layout.footer && !1 === t.layout.footer && g(p.table).find("tfoot").remove(), null !== t.data.type && "local" !== t.data.type || (f.setupCellField.call(), f.setupTemplateCell.call(), f.setupSubDatatable.call(), f.setupSystemColumn.call(), f.redraw()), g(window).resize(f.fullRender), g(p).height(""), g(f.getOption("search.input")).on("keyup", function (t) {
                        f.getOption("search.onEnter") && 13 !== t.which || f.search(g(this).val())
                    }), p
                },
                extractTable: function () {
                    var i = [],
                        n = g(p).find("tr:first-child th").get().map(function (t, e) {
                            var a = g(t).data("field");
                            void 0 === a && (a = g(t).text().trim());
                            var n = {
                                field: a,
                                title: a
                            };
                            for (var o in u.columns) u.columns[o].field === a && (n = g.extend(!0, {}, u.columns[o], n));
                            return i.push(n), a
                        });
                    u.columns = i;
                    var t = [],
                        e = [];
                    g(p).find("tr").each(function () {
                        g(this).find("td").length && t.push(g(this).prop("attributes"));
                        var a = {};
                        g(this).find("td").each(function (t, e) {
                            a[n[t]] = e.innerHTML.trim()
                        }), mUtil.isEmpty(a) || e.push(a)
                    }), u.data.attr.rowProps = t, u.data.source = e
                },
                layoutUpdate: function () {
                    f.setupSubDatatable.call(), f.setupSystemColumn.call(), f.setupHover.call(), void 0 === u.detail && 1 === f.getDepth() && f.lockTable.call(), f.columnHide.call(), f.resetScroll(), f.isInit || (g(p).trigger("m-datatable--on-init", {
                        table: g(p.wrap).attr("id"),
                        options: u
                    }), f.isInit = !0), g(p).trigger("m-datatable--on-layout-updated", {
                        table: g(p.wrap).attr("id")
                    })
                },
                lockTable: function () {
                    var e = {
                        lockEnabled: !1,
                        init: function () {
                            e.lockEnabled = f.lockEnabledColumns(), 0 === e.lockEnabled.left.length && 0 === e.lockEnabled.right.length || e.enable()
                        },
                        enable: function () {
                            g(p.table).find("thead,tbody,tfoot").each(function () {
                                var t = this;
                                0 === g(this).find(".m-datatable__lock").length && g(this).ready(function () {
                                    ! function (t) {
                                        if (0 < g(t).find(".m-datatable__lock").length) f.log("Locked container already exist in: ", t);
                                        else if (0 !== g(t).find(".m-datatable__row").length) {
                                            var o = g("<div/>").addClass("m-datatable__lock m-datatable__lock--left"),
                                                i = g("<div/>").addClass("m-datatable__lock m-datatable__lock--scroll"),
                                                l = g("<div/>").addClass("m-datatable__lock m-datatable__lock--right");
                                            g(t).find(".m-datatable__row").each(function () {
                                                var e = g("<tr/>").addClass("m-datatable__row").appendTo(o),
                                                    a = g("<tr/>").addClass("m-datatable__row").appendTo(i),
                                                    n = g("<tr/>").addClass("m-datatable__row").appendTo(l);
                                                g(this).find(".m-datatable__cell").each(function () {
                                                    var t = g(this).data("locked");
                                                    void 0 !== t ? (void 0 === t.left && !0 !== t || g(this).appendTo(e), void 0 !== t.right && g(this).appendTo(n)) : g(this).appendTo(a)
                                                }), g(this).remove()
                                            }), 0 < e.lockEnabled.left.length && (g(p.wrap).addClass("m-datatable--lock"), g(o).appendTo(t)), (0 < e.lockEnabled.left.length || 0 < e.lockEnabled.right.length) && g(i).appendTo(t), 0 < e.lockEnabled.right.length && (g(p.wrap).addClass("m-datatable--lock"), g(l).appendTo(t))
                                        } else f.log("No row exist in: ", t)
                                    }(t)
                                })
                            })
                        }
                    };
                    return e.init(), e
                },
                fullRender: function () {
                    f.spinnerCallback(!0), g(p.wrap).removeClass("m-datatable--loaded"), f.insertData()
                },
                lockEnabledColumns: function () {
                    var a = g(window).width(),
                        t = u.columns,
                        n = {
                            left: [],
                            right: []
                        };
                    return g.each(t, function (t, e) {
                        void 0 !== e.locked && (void 0 !== e.locked.left && mUtil.getBreakpoint(e.locked.left) <= a && n.left.push(e.locked.left), void 0 !== e.locked.right && mUtil.getBreakpoint(e.locked.right) <= a && n.right.push(e.locked.right))
                    }), n
                },
                afterRender: function (t, e) {
                    e.table == g(p.wrap).attr("id") && g(p).ready(function () {
                        f.isLocked() || (f.redraw(), f.getOption("rows.autoHide") && (f.autoHide(), g(p.table).find(".m-datatable__row").css("height", ""))), g(p.tableBody).find(".m-datatable__row").removeClass("m-datatable__row--even"), g(p.wrap).hasClass("m-datatable--subtable") ? g(p.tableBody).find(".m-datatable__row:not(.m-datatable__row-detail):even").addClass("m-datatable__row--even") : g(p.tableBody).find(".m-datatable__row:nth-child(even)").addClass("m-datatable__row--even"), f.isLocked() && f.redraw(), g(p.tableBody).css("visibility", ""), g(p.wrap).addClass("m-datatable--loaded"), f.scrollbar.call(), f.sorting.call(), f.spinnerCallback(!1)
                    })
                },
                hoverTimer: 0,
                isScrolling: !1,
                setupHover: function () {
                    g(window).scroll(function (t) {
                        clearTimeout(f.hoverTimer), f.isScrolling = !0
                    }), g(p.tableBody).find(".m-datatable__cell").off("mouseenter", "mouseleave").on("mouseenter", function () {
                        if (f.hoverTimer = setTimeout(function () {
                                f.isScrolling = !1
                            }, 200), !f.isScrolling) {
                            var t = g(this).closest(".m-datatable__row").addClass("m-datatable__row--hover"),
                                e = g(t).index() + 1;
                            g(t).closest(".m-datatable__lock").parent().find(".m-datatable__row:nth-child(" + e + ")").addClass("m-datatable__row--hover")
                        }
                    }).on("mouseleave", function () {
                        var t = g(this).closest(".m-datatable__row").removeClass("m-datatable__row--hover"),
                            e = g(t).index() + 1;
                        g(t).closest(".m-datatable__lock").parent().find(".m-datatable__row:nth-child(" + e + ")").removeClass("m-datatable__row--hover")
                    })
                },
                adjustLockContainer: function () {
                    if (!f.isLocked()) return 0;
                    var t = g(p.tableHead).width(),
                        e = g(p.tableHead).find(".m-datatable__lock--left").width(),
                        a = g(p.tableHead).find(".m-datatable__lock--right").width();
                    void 0 === e && (e = 0), void 0 === a && (a = 0);
                    var n = Math.floor(t - e - a);
                    return g(p.table).find(".m-datatable__lock--scroll").css("width", n), n
                },
                dragResize: function () {
                    var i, l, r = !1,
                        s = void 0;
                    g(p.tableHead).find(".m-datatable__cell").mousedown(function (t) {
                        s = g(this), r = !0, i = t.pageX, l = g(this).width(), g(s).addClass("m-datatable__cell--resizing")
                    }).mousemove(function (a) {
                        if (r) {
                            var n = g(s).index(),
                                t = g(p.tableBody),
                                e = g(s).closest(".m-datatable__lock");
                            if (e) {
                                var o = g(e).index();
                                t = g(p.tableBody).find(".m-datatable__lock").eq(o)
                            }
                            g(t).find(".m-datatable__row").each(function (t, e) {
                                g(e).find(".m-datatable__cell").eq(n).width(l + (a.pageX - i)).children().width(l + (a.pageX - i))
                            }), g(s).children().css("width", l + (a.pageX - i))
                        }
                    }).mouseup(function () {
                        g(s).removeClass("m-datatable__cell--resizing"), r = !1
                    }), g(document).mouseup(function () {
                        g(s).removeClass("m-datatable__cell--resizing"), r = !1
                    })
                },
                initHeight: function () {
                    if (u.layout.height && u.layout.scroll) {
                        var t = g(p.tableHead).find(".m-datatable__row").height(),
                            e = g(p.tableFoot).find(".m-datatable__row").height(),
                            a = u.layout.height;
                        0 < t && (a -= t), 0 < e && (a -= e), g(p.tableBody).css("max-height", a)
                    }
                },
                setupBaseDOM: function () {
                    p.initialDatatable = g(p).clone(), "TABLE" === g(p).prop("tagName") ? (p.table = g(p).removeClass("m-datatable").addClass("m-datatable__table"), 0 === g(p.table).parents(".m-datatable").length && (p.table.wrap(g("<div/>").addClass("m-datatable").addClass("m-datatable--" + u.layout.theme)), p.wrap = g(p.table).parent())) : (p.wrap = g(p).addClass("m-datatable").addClass("m-datatable--" + u.layout.theme), p.table = g("<table/>").addClass("m-datatable__table").appendTo(p)), void 0 !== u.layout.class && g(p.wrap).addClass(u.layout.class), g(p.table).removeClass("m-datatable--destroyed").css("display", "block"), void 0 === g(p).attr("id") && (f.setOption("data.saveState", !1), g(p.table).attr("id", mUtil.getUniqueID("m-datatable--"))), f.getOption("layout.minHeight") && g(p.table).css("min-height", f.getOption("layout.minHeight")), f.getOption("layout.height") && g(p.table).css("max-height", f.getOption("layout.height")), null === u.data.type && g(p.table).css("width", "").css("display", ""), p.tableHead = g(p.table).find("thead"), 0 === g(p.tableHead).length && (p.tableHead = g("<thead/>").prependTo(p.table)), p.tableBody = g(p.table).find("tbody"), 0 === g(p.tableBody).length && (p.tableBody = g("<tbody/>").appendTo(p.table)), void 0 !== u.layout.footer && u.layout.footer && (p.tableFoot = g(p.table).find("tfoot"), 0 === g(p.tableFoot).length && (p.tableFoot = g("<tfoot/>").appendTo(p.table)))
                },
                setupCellField: function (t) {
                    void 0 === t && (t = g(p.table).children());
                    var a = u.columns;
                    g.each(t, function (t, e) {
                        g(e).find(".m-datatable__row").each(function (t, e) {
                            g(e).find(".m-datatable__cell").each(function (t, e) {
                                void 0 !== a[t] && g(e).data(a[t])
                            })
                        })
                    })
                },
                setupTemplateCell: function (t) {
                    void 0 === t && (t = p.tableBody);
                    var r = u.columns;
                    g(t).find(".m-datatable__row").each(function (i, t) {
                        var l = g(t).data("obj") || {},
                            e = f.getOption("rows.callback");
                        "function" == typeof e && e(g(t), l, i);
                        var a = f.getOption("rows.beforeTemplate");
                        "function" == typeof a && a(g(t), l, i), void 0 === l && (l = {}, g(t).find(".m-datatable__cell").each(function (t, a) {
                            var e = g.grep(r, function (t, e) {
                                return g(a).data("field") === t.field
                            })[0];
                            void 0 !== e && (l[e.field] = g(a).text())
                        })), g(t).find(".m-datatable__cell").each(function (t, a) {
                            var e = g.grep(r, function (t, e) {
                                return g(a).data("field") === t.field
                            })[0];
                            if (void 0 !== e && void 0 !== e.template) {
                                var n = "";
                                "string" == typeof e.template && (n = f.dataPlaceholder(e.template, l)), "function" == typeof e.template && (n = e.template(l, i, p));
                                var o = document.createElement("span");
                                o.innerHTML = n, g(a).html(o), void 0 !== e.overflow && (g(o).css("overflow", e.overflow), g(o).css("position", "relative"))
                            }
                        });
                        var n = f.getOption("rows.afterTemplate");
                        "function" == typeof n && n(g(t), l, i)
                    })
                },
                setupSystemColumn: function () {
                    if (p.dataSet = p.dataSet || [], 0 !== p.dataSet.length) {
                        var i = u.columns;
                        g(p.tableBody).find(".m-datatable__row").each(function (t, e) {
                            g(e).find(".m-datatable__cell").each(function (t, a) {
                                var e = g.grep(i, function (t, e) {
                                    return g(a).data("field") === t.field
                                })[0];
                                if (void 0 !== e) {
                                    var n = g(a).text();
                                    if (void 0 !== e.selector && !1 !== e.selector) {
                                        if (0 < g(a).find('.m-checkbox [type="checkbox"]').length) return;
                                        g(a).addClass("m-datatable__cell--check");
                                        var o = g("<label/>").addClass("m-checkbox m-checkbox--single").append(g("<input/>").attr("type", "checkbox").attr("value", n).on("click", function () {
                                            g(this).is(":checked") ? f.setActive(this) : f.setInactive(this)
                                        })).append(g("<span/>"));
                                        void 0 !== e.selector.class && g(o).addClass(e.selector.class), g(a).children().html(o)
                                    }
                                    if (void 0 !== e.subtable && e.subtable) {
                                        if (0 < g(a).find(".m-datatable__toggle-subtable").length) return;
                                        g(a).children().html(g("<a/>").addClass("m-datatable__toggle-subtable").attr("href", "#").attr("data-value", n).append(g("<i/>").addClass(f.getOption("layout.icons.rowDetail.collapse"))))
                                    }
                                }
                            })
                        });
                        var t = function (t) {
                            var e = g.grep(i, function (t, e) {
                                return void 0 !== t.selector && !1 !== t.selector
                            })[0];
                            if (void 0 !== e && void 0 !== e.selector && !1 !== e.selector) {
                                var a = g(t).find('[data-field="' + e.field + '"]');
                                if (0 < g(a).find('.m-checkbox [type="checkbox"]').length) return;
                                g(a).addClass("m-datatable__cell--check");
                                var n = g("<label/>").addClass("m-checkbox m-checkbox--single m-checkbox--all").append(g("<input/>").attr("type", "checkbox").on("click", function () {
                                    g(this).is(":checked") ? f.setActiveAll(!0) : f.setActiveAll(!1)
                                })).append(g("<span/>"));
                                void 0 !== e.selector.class && g(n).addClass(e.selector.class), g(a).children().html(n)
                            }
                        };
                        u.layout.header && t(g(p.tableHead).find(".m-datatable__row").first()), u.layout.footer && t(g(p.tableFoot).find(".m-datatable__row").first())
                    }
                },
                adjustCellsWidth: function () {
                    var t = g(p.tableHead).width(),
                        e = g(p.tableHead).find(".m-datatable__row:first-child").find(".m-datatable__cell:visible").length;
                    if (0 < e) {
                        t -= 20 * e;
                        var o = Math.floor(t / e);
                        o <= f.offset && (o = f.offset), g(p.table).find(".m-datatable__row").find(".m-datatable__cell:visible").each(function (t, e) {
                            var a = o,
                                n = g(e).data("width");
                            void 0 !== n && (a = n), g(e).children().css("width", parseInt(a))
                        })
                    }
                    return p
                },
                adjustCellsHeight: function () {
                    g.each(g(p.table).children(), function (t, e) {
                        for (var a = g(e).find(".m-datatable__row").first().parent().find(".m-datatable__row").length, n = 1; n <= a; n++) {
                            var o = g(e).find(".m-datatable__row:nth-child(" + n + ")");
                            if (0 < g(o).length) {
                                var i = Math.max.apply(null, g(o).map(function () {
                                    return g(this).height()
                                }).get());
                                g(o).css("height", Math.ceil(parseInt(i)))
                            }
                        }
                    })
                },
                setupDOM: function (t) {
                    g(t).find("> thead").addClass("m-datatable__head"), g(t).find("> tbody").addClass("m-datatable__body"), g(t).find("> tfoot").addClass("m-datatable__foot"), g(t).find("tr").addClass("m-datatable__row"), g(t).find("tr > th, tr > td").addClass("m-datatable__cell"), g(t).find("tr > th, tr > td").each(function (t, e) {
                        0 === g(e).find("span").length && g(e).wrapInner(g("<span/>").css("width", f.offset))
                    })
                },
                scrollbar: function () {
                    var n = {
                        scrollable: null,
                        tableLocked: null,
                        mcsOptions: {
                            scrollInertia: 0,
                            autoDraggerLength: !0,
                            autoHideScrollbar: !0,
                            autoExpandScrollbar: !1,
                            alwaysShowScrollbar: 0,
                            mouseWheel: {
                                scrollAmount: 120,
                                preventDefault: !1
                            },
                            advanced: {
                                updateOnContentResize: !0,
                                autoExpandHorizontalScroll: !0
                            },
                            theme: "minimal-dark"
                        },
                        init: function () {
                            f.destroyScroller(n.scrollable);
                            var t = mUtil.getViewPort().width;
                            if (u.layout.scroll) {
                                g(p.wrap).addClass("m-datatable--scroll");
                                var e = g(p.tableBody).find(".m-datatable__lock--scroll");
                                0 < g(e).find(".m-datatable__row").length && 0 < g(e).length ? (n.scrollHead = g(p.tableHead).find("> .m-datatable__lock--scroll > .m-datatable__row"), n.scrollFoot = g(p.tableFoot).find("> .m-datatable__lock--scroll > .m-datatable__row"), n.tableLocked = g(p.tableBody).find(".m-datatable__lock:not(.m-datatable__lock--scroll)"), t > mUtil.getBreakpoint("lg") ? n.mCustomScrollbar(e) : n.defaultScrollbar(e)) : 0 < g(p.tableBody).find(".m-datatable__row").length && (n.scrollHead = g(p.tableHead).find("> .m-datatable__row"), n.scrollFoot = g(p.tableFoot).find("> .m-datatable__row"), t > mUtil.getBreakpoint("lg") ? n.mCustomScrollbar(p.tableBody) : n.defaultScrollbar(p.tableBody))
                            } else g(p.table).css("overflow-x", "auto")
                        },
                        defaultScrollbar: function (t) {
                            g(t).css("overflow", "auto").css("max-height", f.getOption("layout.height")).on("scroll", n.onScrolling)
                        },
                        onScrolling: function (t) {
                            var e = g(this).scrollLeft(),
                                a = g(this).scrollTop();
                            g(n.scrollHead).css("left", -e), g(n.scrollFoot).css("left", -e), g(n.tableLocked).each(function (t, e) {
                                g(e).css("top", -a)
                            })
                        },
                        mCustomScrollbar: function (t) {
                            n.scrollable = t;
                            var e = "xy";
                            null === f.getOption("layout.height") && (e = "x");
                            var a = g.extend({}, n.mcsOptions, {
                                axis: e,
                                setHeight: g(p.tableBody).height(),
                                callbacks: {
                                    whileScrolling: function () {
                                        var a = this.mcs;
                                        g(n.scrollHead).css("left", a.left), g(n.scrollFoot).css("left", a.left), g(n.tableLocked).each(function (t, e) {
                                            g(e).css("top", a.top)
                                        }), clearTimeout(f.hoverTimer), f.isScrolling = !0
                                    }
                                }
                            });
                            !0 === f.getOption("layout.smoothScroll.scrollbarShown") && g(t).attr("data-scrollbar-shown", "true"), f.mCustomScrollbar(t, a)
                        }
                    };
                    return n.init(), n
                },
                mCustomScrollbar: function (t, e) {
                    g(p.tableBody).css("overflow", ""), f.destroyScroller(g(p.table).find(".mCustomScrollbar")), g(t).mCustomScrollbar(e)
                },
                setHeadTitle: function (t) {
                    void 0 === t && (t = p.tableHead), t = g(t)[0];
                    var e = u.columns,
                        o = t.getElementsByTagName("tr")[0],
                        i = t.getElementsByTagName("td");
                    void 0 === o && (o = document.createElement("tr"), t.appendChild(o)), g.each(e, function (t, e) {
                        var a = i[t];
                        if (void 0 === a && (a = document.createElement("th"), o.appendChild(a)), void 0 !== e.title && (a.innerHTML = e.title, a.setAttribute("data-field", e.field), mUtil.addClass(a, e.class), g(a).data(e)), void 0 !== e.attr && g.each(e.attr, function (t, e) {
                                a.setAttribute(t, e)
                            }), void 0 !== e.textAlign) {
                            var n = void 0 !== p.textAlign[e.textAlign] ? p.textAlign[e.textAlign] : "";
                            mUtil.addClass(a, n)
                        }
                    }), f.setupDOM(t)
                },
                dataRender: function (t) {
                    g(p.table).siblings(".m-datatable__pager").removeClass("m-datatable--paging-loaded");
                    var n = function () {
                            p.dataSet = p.dataSet || [], f.localDataUpdate();
                            var t = f.getDataSourceParam("pagination");
                            0 === t.perpage && (t.perpage = u.data.pageSize || 10), t.total = p.dataSet.length;
                            var e = Math.max(t.perpage * (t.page - 1), 0),
                                a = Math.min(e + t.perpage, t.total);
                            return p.dataSet = g(p.dataSet).slice(e, a), t
                        },
                        e = function (t) {
                            var e = function (e, a) {
                                g(e.pager).hasClass("m-datatable--paging-loaded") || (g(e.pager).remove(), e.init(a)), g(e.pager).off().on("m-datatable--on-goto-page", function (t) {
                                    g(e.pager).remove(), e.init(a)
                                });
                                var t = Math.max(a.perpage * (a.page - 1), 0),
                                    n = Math.min(t + a.perpage, a.total);
                                f.localDataUpdate(), p.dataSet = g(p.dataSet).slice(t, n), f.insertData()
                            };
                            if (g(p.wrap).removeClass("m-datatable--error"), u.pagination)
                                if (u.data.serverPaging && "local" !== u.data.type) {
                                    var a = f.getObject("meta", t || null);
                                    null !== a ? f.paging(a) : f.paging(n(), e)
                                } else f.paging(n(), e);
                            else f.localDataUpdate();
                            f.insertData()
                        };
                    "local" === u.data.type || void 0 === u.data.source.read && null !== p.dataSet || !1 === u.data.serverSorting && "sort" === t || !1 === u.data.serverFiltering && "search" === t ? e() : f.getData().done(e)
                },
                insertData: function () {
                    p.dataSet = p.dataSet || [];
                    var s = f.getDataSourceParam(),
                        t = s.pagination,
                        e = (Math.max(t.page, 1) - 1) * t.perpage,
                        a = Math.min(t.page, t.pages) * t.perpage,
                        d = {};
                    void 0 !== u.data.attr.rowProps && u.data.attr.rowProps.length && (d = u.data.attr.rowProps.slice(e, a));
                    var c = document.createElement("tbody");
                    c.style.visibility = "hidden";
                    var m = u.columns.length;
                    if (g.each(p.dataSet, function (t, e) {
                            var a = document.createElement("tr");
                            a.setAttribute("data-row", t), g(a).data("obj", e), void 0 !== d[t] && g.each(d[t], function () {
                                a.setAttribute(this.name, this.value)
                            });
                            for (var n = 0; n < m; n += 1) {
                                var o = u.columns[n],
                                    i = [];
                                if (f.getObject("sort.field", s) === o.field && i.push("m-datatable__cell--sorted"), void 0 !== o.textAlign) {
                                    var l = void 0 !== p.textAlign[o.textAlign] ? p.textAlign[o.textAlign] : "";
                                    i.push(l)
                                }
                                void 0 !== o.class && i.push(o.class);
                                var r = document.createElement("td");
                                mUtil.addClass(r, i.join(" ")), r.setAttribute("data-field", o.field), r.innerHTML = f.getObject(o.field, e), a.appendChild(r)
                            }
                            c.appendChild(a)
                        }), 0 === p.dataSet.length) {
                        f.destroyScroller(g(p.table).find(".mCustomScrollbar"));
                        var n = document.createElement("span");
                        mUtil.addClass(n, "m-datatable--error"), n.innerHTML = f.getOption("translate.records.noRecords"), c.appendChild(n), g(p.wrap).addClass("m-datatable--error m-datatable--loaded"), f.spinnerCallback(!1)
                    }
                    g(p.tableBody).replaceWith(c), p.tableBody = c, f.setupDOM(p.table), f.setupCellField([p.tableBody]), f.setupTemplateCell(p.tableBody), f.layoutUpdate()
                },
                updateTableComponents: function () {
                    p.tableHead = g(p.table).children("thead"), p.tableBody = g(p.table).children("tbody"), p.tableFoot = g(p.table).children("tfoot")
                },
                getData: function () {
                    f.spinnerCallback(!0);
                    var t = {
                        dataType: "json",
                        method: "GET",
                        data: {},
                        timeout: f.getOption("data.source.read.timeout") || 3e4
                    };
                    if ("local" === u.data.type && (t.url = u.data.source), "remote" === u.data.type) {
                        t.url = f.getOption("data.source.read.url"), "string" != typeof t.url && (t.url = f.getOption("data.source.read")), "string" != typeof t.url && (t.url = f.getOption("data.source")), t.headers = f.getOption("data.source.read.headers"), t.method = f.getOption("data.source.read.method") || "POST";
                        var e = f.getDataSourceParam();
                        f.getOption("data.serverPaging") || delete e.pagination, f.getOption("data.serverSorting") || delete e.sort, t.data = g.extend(!0, t.data, e, f.getOption("data.source.read.params"))
                    }
                    return g.ajax(t).done(function (t, e, a) {
                        p.lastResponse = t, p.dataSet = p.originalDataSet = f.dataMapCallback(t), f.setAutoColumns(), g(p).trigger("m-datatable--on-ajax-done", [p.dataSet])
                    }).fail(function (t, e, a) {
                        f.destroyScroller(g(p.table).find(".mCustomScrollbar")), g(p).trigger("m-datatable--on-ajax-fail", [t]), g(p.tableBody).html(g("<span/>").addClass("m-datatable--error").html(f.getOption("translate.records.noRecords"))), g(p.wrap).addClass("m-datatable--error m-datatable--loaded"), f.spinnerCallback(!1)
                    }).always(function () {})
                },
                paging: function (t, e) {
                    var m = {
                        meta: null,
                        pager: null,
                        paginateEvent: null,
                        pagerLayout: {
                            pagination: null,
                            info: null
                        },
                        callback: null,
                        init: function (t) {
                            m.meta = t, m.meta.pages = Math.max(Math.ceil(m.meta.total / m.meta.perpage), 1), m.meta.page > m.meta.pages && (m.meta.page = m.meta.pages), m.paginateEvent = f.getTablePrefix(), m.pager = g(p.table).siblings(".m-datatable__pager"), g(m.pager).hasClass("m-datatable--paging-loaded") || (g(m.pager).remove(), 0 !== m.meta.pages && (f.setDataSourceParam("pagination", {
                                page: m.meta.page,
                                pages: m.meta.pages,
                                perpage: m.meta.perpage,
                                total: m.meta.total
                            }), m.callback = m.serverCallback, "function" == typeof e && (m.callback = e), m.addPaginateEvent(), m.populate(), m.meta.page = Math.max(m.meta.page || 1, m.meta.page), g(p).trigger(m.paginateEvent, m.meta), m.pagingBreakpoint.call(), g(window).resize(m.pagingBreakpoint)))
                        },
                        serverCallback: function (t, e) {
                            f.dataRender()
                        },
                        populate: function () {
                            var t = f.getOption("layout.icons.pagination"),
                                e = f.getOption("translate.toolbar.pagination.items.default");
                            m.pager = g("<div/>").addClass("m-datatable__pager m-datatable--paging-loaded clearfix");
                            var a = g("<ul/>").addClass("m-datatable__pager-nav");
                            m.pagerLayout.pagination = a, g("<li/>").append(g("<a/>").attr("title", e.first).addClass("m-datatable__pager-link m-datatable__pager-link--first").append(g("<i/>").addClass(t.first)).on("click", m.gotoMorePage).attr("data-page", 1)).appendTo(a), g("<li/>").append(g("<a/>").attr("title", e.prev).addClass("m-datatable__pager-link m-datatable__pager-link--prev").append(g("<i/>").addClass(t.prev)).on("click", m.gotoMorePage)).appendTo(a), g("<li/>").append(g("<a/>").attr("title", e.more).addClass("m-datatable__pager-link m-datatable__pager-link--more-prev").html(g("<i/>").addClass(t.more)).on("click", m.gotoMorePage)).appendTo(a), g("<li/>").append(g("<input/>").attr("type", "text").addClass("m-pager-input form-control").attr("title", e.input).on("keyup", function () {
                                g(this).attr("data-page", Math.abs(g(this).val()))
                            }).on("keypress", function (t) {
                                13 === t.which && m.gotoMorePage(t)
                            })).appendTo(a);
                            var n = f.getOption("toolbar.items.pagination.pages.desktop.pagesNumber"),
                                o = Math.ceil(m.meta.page / n) * n,
                                i = o - n;
                            o > m.meta.pages && (o = m.meta.pages);
                            for (var l = i; l < o; l++) {
                                var r = l + 1;
                                g("<li/>").append(g("<a/>").addClass("m-datatable__pager-link m-datatable__pager-link-number").text(r).attr("data-page", r).attr("title", r).on("click", m.gotoPage)).appendTo(a)
                            }
                            g("<li/>").append(g("<a/>").attr("title", e.more).addClass("m-datatable__pager-link m-datatable__pager-link--more-next").html(g("<i/>").addClass(t.more)).on("click", m.gotoMorePage)).appendTo(a), g("<li/>").append(g("<a/>").attr("title", e.next).addClass("m-datatable__pager-link m-datatable__pager-link--next").append(g("<i/>").addClass(t.next)).on("click", m.gotoMorePage)).appendTo(a), g("<li/>").append(g("<a/>").attr("title", e.last).addClass("m-datatable__pager-link m-datatable__pager-link--last").append(g("<i/>").addClass(t.last)).on("click", m.gotoMorePage).attr("data-page", m.meta.pages)).appendTo(a), f.getOption("toolbar.items.info") && (m.pagerLayout.info = g("<div/>").addClass("m-datatable__pager-info").append(g("<span/>").addClass("m-datatable__pager-detail"))), g.each(f.getOption("toolbar.layout"), function (t, e) {
                                g(m.pagerLayout[e]).appendTo(m.pager)
                            });
                            var s = g("<select/>").addClass("selectpicker m-datatable__pager-size").attr("title", f.getOption("translate.toolbar.pagination.items.default.select")).attr("data-width", "70px").val(m.meta.perpage).on("change", m.updatePerpage).prependTo(m.pagerLayout.info),
                                d = f.getOption("toolbar.items.pagination.pageSizeSelect");
                            0 == d.length && (d = [10, 20, 30, 50, 100]), g.each(d, function (t, e) {
                                var a = e; - 1 === e && (a = "All"), g("<option/>").attr("value", e).html(a).appendTo(s)
                            }), g(p).ready(function () {
                                g(".selectpicker").selectpicker().siblings(".dropdown-toggle").attr("title", f.getOption("translate.toolbar.pagination.items.default.select"))
                            }), m.paste()
                        },
                        paste: function () {
                            g.each(g.unique(f.getOption("toolbar.placement")), function (t, e) {
                                "bottom" === e && g(m.pager).clone(!0).insertAfter(p.table), "top" === e && g(m.pager).clone(!0).addClass("m-datatable__pager--top").insertBefore(p.table)
                            })
                        },
                        gotoMorePage: function (t) {
                            if (t.preventDefault(), "disabled" === g(this).attr("disabled")) return !1;
                            var e = g(this).attr("data-page");
                            return void 0 === e && (e = g(t.target).attr("data-page")), m.openPage(parseInt(e)), !1
                        },
                        gotoPage: function (t) {
                            t.preventDefault(), g(this).hasClass("m-datatable__pager-link--active") || m.openPage(parseInt(g(this).data("page")))
                        },
                        openPage: function (t) {
                            m.meta.page = parseInt(t), g(p).trigger(m.paginateEvent, m.meta), m.callback(m, m.meta), g(m.pager).trigger("m-datatable--on-goto-page", m.meta)
                        },
                        updatePerpage: function (t) {
                            t.preventDefault(), null === f.getOption("layout.height") && g("html, body").animate({
                                scrollTop: g(p).position().top
                            }), m.pager = g(p.table).siblings(".m-datatable__pager").removeClass("m-datatable--paging-loaded"), t.originalEvent && (m.meta.perpage = parseInt(g(this).val())), g(m.pager).find("select.m-datatable__pager-size").val(m.meta.perpage).attr("data-selected", m.meta.perpage), f.setDataSourceParam("pagination", {
                                page: m.meta.page,
                                pages: m.meta.pages,
                                perpage: m.meta.perpage,
                                total: m.meta.total
                            }), g(m.pager).trigger("m-datatable--on-update-perpage", m.meta), g(p).trigger(m.paginateEvent, m.meta), m.callback(m, m.meta), m.updateInfo.call()
                        },
                        addPaginateEvent: function (t) {
                            g(p).off(m.paginateEvent).on(m.paginateEvent, function (t, e) {
                                f.spinnerCallback(!0), m.pager = g(p.table).siblings(".m-datatable__pager");
                                var a = g(m.pager).find(".m-datatable__pager-nav");
                                g(a).find(".m-datatable__pager-link--active").removeClass("m-datatable__pager-link--active"), g(a).find('.m-datatable__pager-link-number[data-page="' + e.page + '"]').addClass("m-datatable__pager-link--active"), g(a).find(".m-datatable__pager-link--prev").attr("data-page", Math.max(e.page - 1, 1)), g(a).find(".m-datatable__pager-link--next").attr("data-page", Math.min(e.page + 1, e.pages)), g(m.pager).each(function () {
                                    g(this).find('.m-pager-input[type="text"]').prop("value", e.page)
                                }), g(m.pager).find(".m-datatable__pager-nav").show(), e.pages <= 1 && g(m.pager).find(".m-datatable__pager-nav").hide(), f.setDataSourceParam("pagination", {
                                    page: m.meta.page,
                                    pages: m.meta.pages,
                                    perpage: m.meta.perpage,
                                    total: m.meta.total
                                }), g(m.pager).find("select.m-datatable__pager-size").val(e.perpage).attr("data-selected", e.perpage), g(p.table).find('.m-checkbox > [type="checkbox"]').prop("checked", !1), g(p.table).find(".m-datatable__row--active").removeClass("m-datatable__row--active"), m.updateInfo.call(), m.pagingBreakpoint.call()
                            })
                        },
                        updateInfo: function () {
                            var t = Math.max(m.meta.perpage * (m.meta.page - 1) + 1, 1),
                                e = Math.min(t + m.meta.perpage - 1, m.meta.total);
                            g(m.pager).find(".m-datatable__pager-info").find(".m-datatable__pager-detail").html(f.dataPlaceholder(f.getOption("translate.toolbar.pagination.items.info"), {
                                start: t,
                                end: -1 === m.meta.perpage ? m.meta.total : e,
                                pageSize: -1 === m.meta.perpage || m.meta.perpage >= m.meta.total ? m.meta.total : m.meta.perpage,
                                total: m.meta.total
                            }))
                        },
                        pagingBreakpoint: function () {
                            var a = g(p.table).siblings(".m-datatable__pager").find(".m-datatable__pager-nav");
                            if (0 !== g(a).length) {
                                var n = f.getCurrentPage(),
                                    o = g(a).find(".m-pager-input").closest("li");
                                g(a).find("li").show(), g.each(f.getOption("toolbar.items.pagination.pages"), function (t, e) {
                                    if (mUtil.isInResponsiveRange(t)) {
                                        switch (t) {
                                            case "desktop":
                                            case "tablet":
                                                Math.ceil(n / e.pagesNumber), e.pagesNumber, e.pagesNumber;
                                                g(o).hide(), m.meta = f.getDataSourceParam("pagination"), m.paginationUpdate();
                                                break;
                                            case "mobile":
                                                g(o).show(), g(a).find(".m-datatable__pager-link--more-prev").closest("li").hide(), g(a).find(".m-datatable__pager-link--more-next").closest("li").hide(), g(a).find(".m-datatable__pager-link-number").closest("li").hide()
                                        }
                                        return !1
                                    }
                                })
                            }
                        },
                        paginationUpdate: function () {
                            var t = g(p.table).siblings(".m-datatable__pager").find(".m-datatable__pager-nav"),
                                e = g(t).find(".m-datatable__pager-link--more-prev"),
                                a = g(t).find(".m-datatable__pager-link--more-next"),
                                n = g(t).find(".m-datatable__pager-link--first"),
                                o = g(t).find(".m-datatable__pager-link--prev"),
                                i = g(t).find(".m-datatable__pager-link--next"),
                                l = g(t).find(".m-datatable__pager-link--last"),
                                r = g(t).find(".m-datatable__pager-link-number"),
                                s = Math.max(g(r).first().data("page") - 1, 1);
                            g(e).each(function (t, e) {
                                g(e).attr("data-page", s)
                            }), 1 === s ? g(e).parent().hide() : g(e).parent().show();
                            var d = Math.min(g(r).last().data("page") + 1, m.meta.pages);
                            g(a).each(function (t, e) {
                                g(a).attr("data-page", d).show()
                            }), d === m.meta.pages && d === g(r).last().data("page") ? g(a).parent().hide() : g(a).parent().show(), 1 === m.meta.page ? (g(n).attr("disabled", !0).addClass("m-datatable__pager-link--disabled"), g(o).attr("disabled", !0).addClass("m-datatable__pager-link--disabled")) : (g(n).removeAttr("disabled").removeClass("m-datatable__pager-link--disabled"), g(o).removeAttr("disabled").removeClass("m-datatable__pager-link--disabled")), m.meta.page === m.meta.pages ? (g(i).attr("disabled", !0).addClass("m-datatable__pager-link--disabled"), g(l).attr("disabled", !0).addClass("m-datatable__pager-link--disabled")) : (g(i).removeAttr("disabled").removeClass("m-datatable__pager-link--disabled"), g(l).removeAttr("disabled").removeClass("m-datatable__pager-link--disabled"));
                            var c = f.getOption("toolbar.items.pagination.navigation");
                            c.first || g(n).remove(), c.prev || g(o).remove(), c.next || g(i).remove(), c.last || g(l).remove()
                        }
                    };
                    return m.init(t), m
                },
                columnHide: function () {
                    var o = mUtil.getViewPort().width;
                    g.each(u.columns, function (t, e) {
                        if (void 0 !== e.responsive) {
                            var a = e.field,
                                n = g.grep(g(p.table).find(".m-datatable__cell"), function (t, e) {
                                    return a === g(t).data("field")
                                });
                            mUtil.getBreakpoint(e.responsive.hidden) >= o ? g(n).hide() : g(n).show(), mUtil.getBreakpoint(e.responsive.visible) <= o ? g(n).show() : g(n).hide()
                        }
                    })
                },
                setupSubDatatable: function () {
                    var l = f.getOption("detail.content");
                    if ("function" == typeof l && !(0 < g(p.table).find(".m-datatable__subtable").length)) {
                        g(p.wrap).addClass("m-datatable--subtable"), u.columns[0].subtable = !0;
                        var o = function (a) {
                                a.preventDefault();
                                var t = g(this).closest(".m-datatable__row"),
                                    e = g(t).next(".m-datatable__row-subtable");
                                0 === g(e).length && (e = g("<tr/>").addClass("m-datatable__row-subtable m-datatable__row-loading").hide().append(g("<td/>").addClass("m-datatable__subtable").attr("colspan", f.getTotalColumns())), g(t).after(e), g(t).hasClass("m-datatable__row--even") && g(e).addClass("m-datatable__row-subtable--even")), g(e).toggle();
                                var n = g(e).find(".m-datatable__subtable"),
                                    o = g(this).closest("[data-field]:first-child").find(".m-datatable__toggle-subtable").data("value"),
                                    i = g(this).find("i").removeAttr("class");
                                g(t).hasClass("m-datatable__row--subtable-expanded") ? (g(i).addClass(f.getOption("layout.icons.rowDetail.collapse")), g(t).removeClass("m-datatable__row--subtable-expanded"), g(p).trigger("m-datatable--on-collapse-subtable", [t])) : (g(i).addClass(f.getOption("layout.icons.rowDetail.expand")), g(t).addClass("m-datatable__row--subtable-expanded"), g(p).trigger("m-datatable--on-expand-subtable", [t])), 0 === g(n).find(".m-datatable").length && (g.map(p.dataSet, function (t, e) {
                                    return o === t[u.columns[0].field] && (a.data = t, !0)
                                }), a.detailCell = n, a.parentRow = t, a.subTable = n, l(a), g(n).children(".m-datatable").on("m-datatable--on-init", function (t) {
                                    g(e).removeClass("m-datatable__row-loading")
                                }), "local" === f.getOption("data.type") && g(e).removeClass("m-datatable__row-loading"))
                            },
                            i = u.columns;
                        g(p.tableBody).find(".m-datatable__row").each(function (t, e) {
                            g(e).find(".m-datatable__cell").each(function (t, a) {
                                var e = g.grep(i, function (t, e) {
                                    return g(a).data("field") === t.field
                                })[0];
                                if (void 0 !== e) {
                                    var n = g(a).text();
                                    if (void 0 !== e.subtable && e.subtable) {
                                        if (0 < g(a).find(".m-datatable__toggle-subtable").length) return;
                                        g(a).html(g("<a/>").addClass("m-datatable__toggle-subtable").attr("href", "#").attr("data-value", n).attr("title", f.getOption("detail.title")).on("click", o).append(g("<i/>").css("width", g(a).data("width")).addClass(f.getOption("layout.icons.rowDetail.collapse"))))
                                    }
                                }
                            })
                        })
                    }
                },
                dataMapCallback: function (t) {
                    var e = t;
                    return "function" == typeof f.getOption("data.source.read.map") ? f.getOption("data.source.read.map")(t) : (void 0 !== t && void 0 !== t.data && (e = t.data), e)
                },
                isSpinning: !1,
                spinnerCallback: function (t) {
                    if (t) {
                        if (!f.isSpinning) {
                            var e = f.getOption("layout.spinner");
                            !0 === e.message && (e.message = f.getOption("translate.records.processing")), f.isSpinning = !0, void 0 !== mApp && mApp.block(p, e)
                        }
                    } else f.isSpinning = !1, void 0 !== mApp && mApp.unblock(p)
                },
                sortCallback: function (t, i, e) {
                    var l = e.type || "string",
                        r = e.format || "",
                        s = e.field;
                    return g(t).sort(function (t, e) {
                        var a = t[s],
                            n = e[s];
                        switch (l) {
                            case "date":
                                if ("undefined" == typeof moment) throw new Error("Moment.js is required.");
                                var o = moment(a, r).diff(moment(n, r));
                                return "asc" === i ? 0 < o ? 1 : o < 0 ? -1 : 0 : o < 0 ? 1 : 0 < o ? -1 : 0;
                            case "number":
                                return isNaN(parseFloat(a)) && null != a && (a = Number(a.replace(/[^0-9\.-]+/g, ""))), isNaN(parseFloat(n)) && null != n && (n = Number(n.replace(/[^0-9\.-]+/g, ""))), a = parseFloat(a), n = parseFloat(n), "asc" === i ? n < a ? 1 : a < n ? -1 : 0 : a < n ? 1 : n < a ? -1 : 0;
                            case "string":
                            default:
                                return "asc" === i ? n < a ? 1 : a < n ? -1 : 0 : a < n ? 1 : n < a ? -1 : 0
                        }
                    })
                },
                log: function (t, e) {
                    void 0 === e && (e = ""), p.debug && console.log(t, e)
                },
                autoHide: function () {
                    g(p.table).find(".m-datatable__cell").show(), g(p.tableBody).each(function () {
                        for (; g(this)[0].offsetWidth < g(this)[0].scrollWidth;) g(p.table).find(".m-datatable__row").each(function (t) {
                            var e = g(this).find(".m-datatable__cell").not(":hidden").last();
                            g(e).hide()
                        }), f.adjustCellsWidth.call()
                    });
                    var t = function (t) {
                        t.preventDefault();
                        var e = g(this).closest(".m-datatable__row"),
                            a = g(e).next();
                        if (g(a).hasClass("m-datatable__row-detail")) g(this).find("i").removeClass(f.getOption("layout.icons.rowDetail.expand")).addClass(f.getOption("layout.icons.rowDetail.collapse")), g(a).remove();
                        else {
                            g(this).find("i").removeClass(f.getOption("layout.icons.rowDetail.collapse")).addClass(f.getOption("layout.icons.rowDetail.expand"));
                            var n = g(e).find(".m-datatable__cell:hidden").clone().show();
                            a = g("<tr/>").addClass("m-datatable__row-detail").insertAfter(e);
                            var o = g("<td/>").addClass("m-datatable__detail").attr("colspan", f.getTotalColumns()).appendTo(a),
                                i = g("<table/>");
                            g(n).each(function () {
                                var a = g(this).data("field"),
                                    t = g.grep(u.columns, function (t, e) {
                                        return a === t.field
                                    })[0];
                                g(i).append(g('<tr class="m-datatable__row"></tr>').append(g('<td class="m-datatable__cell"></td>').append(g("<span/>").css("width", f.offset).append(t.title))).append(this))
                            }), g(o).append(i)
                        }
                    };
                    g(p.tableBody).find(".m-datatable__row").each(function () {
                        g(this).prepend(g("<td/>").addClass("m-datatable__cell m-datatable__toggle--detail").append(g("<a/>").addClass("m-datatable__toggle-detail").attr("href", "#").on("click", t).append(g("<i/>").css("width", "21px").addClass(f.getOption("layout.icons.rowDetail.collapse"))))), 0 === g(p.tableHead).find(".m-datatable__toggle-detail").length ? (g(p.tableHead).find(".m-datatable__row").first().prepend('<th class="m-datatable__cell m-datatable__toggle-detail"><span style="width: 21px"></span></th>'), g(p.tableFoot).find(".m-datatable__row").first().prepend('<th class="m-datatable__cell m-datatable__toggle-detail"><span style="width: 21px"></span></th>')) : g(p.tableHead).find(".m-datatable__toggle-detail").find("span").css("width", "21px")
                    })
                },
                hoverColumn: function () {
                    g(p.tableBody).on("mouseenter", ".m-datatable__cell", function () {
                        var t = g(f.cell(this).nodes()).index();
                        g(f.cells().nodes()).removeClass("m-datatable__cell--hover"), g(f.column(t).nodes()).addClass("m-datatable__cell--hover")
                    })
                },
                setAutoColumns: function () {
                    f.getOption("data.autoColumns") && (g.each(p.dataSet[0], function (a, t) {
                        0 === g.grep(u.columns, function (t, e) {
                            return a === t.field
                        }).length && u.columns.push({
                            field: a,
                            title: a
                        })
                    }), g(p.tableHead).find(".m-datatable__row").remove(), f.setHeadTitle(), f.getOption("layout.footer") && (g(p.tableFoot).find(".m-datatable__row").remove(), f.setHeadTitle(p.tableFoot)))
                },
                isLocked: function () {
                    return g(p.wrap).hasClass("m-datatable--lock") || !1
                },
                replaceTableContent: function (t, e) {
                    void 0 === e && (e = p.tableBody), g(e).hasClass("mCustomScrollbar") ? g(e).find(".mCSB_container").html(t) : g(e).html(t)
                },
                getExtraSpace: function (t) {
                    return parseInt(g(t).css("paddingRight")) + parseInt(g(t).css("paddingLeft")) + (parseInt(g(t).css("marginRight")) + parseInt(g(t).css("marginLeft"))) + Math.ceil(g(t).css("border-right-width").replace("px", ""))
                },
                dataPlaceholder: function (t, e) {
                    var a = t;
                    return g.each(e, function (t, e) {
                        a = a.replace("{{" + t + "}}", e)
                    }), a
                },
                getTableId: function (t) {
                    void 0 === t && (t = "");
                    var e = g(p).attr("id");
                    return void 0 === e && (e = g(p).attr("class").split(" ")[0]), e + t
                },
                getTablePrefix: function (t) {
                    return void 0 !== t && (t = "-" + t), f.getTableId() + "-" + f.getDepth() + t
                },
                getDepth: function () {
                    for (var t = 0, e = p.table; e = g(e).parents(".m-datatable__table"), t++, 0 < g(e).length;);
                    return t
                },
                stateKeep: function (t, e) {
                    t = f.getTablePrefix(t), !1 !== f.getOption("data.saveState") && (f.getOption("data.saveState.webstorage") && localStorage && localStorage.setItem(t, JSON.stringify(e)), f.getOption("data.saveState.cookie") && Cookies.set(t, JSON.stringify(e)))
                },
                stateGet: function (t, e) {
                    if (t = f.getTablePrefix(t), !1 !== f.getOption("data.saveState")) {
                        var a = null;
                        return null != (a = f.getOption("data.saveState.webstorage") && localStorage ? localStorage.getItem(t) : Cookies.get(t)) ? JSON.parse(a) : void 0
                    }
                },
                stateUpdate: function (t, e) {
                    var a = f.stateGet(t);
                    null == a && (a = {}), f.stateKeep(t, g.extend({}, a, e))
                },
                stateRemove: function (t) {
                    t = f.getTablePrefix(t), localStorage && localStorage.removeItem(t), Cookies.remove(t)
                },
                getTotalColumns: function (t) {
                    return void 0 === t && (t = p.tableBody), g(t).find(".m-datatable__row").first().find(".m-datatable__cell").length
                },
                getOneRow: function (t, e, a) {
                    void 0 === a && (a = !0);
                    var n = g(t).find(".m-datatable__row:not(.m-datatable__row-detail):nth-child(" + e + ")");
                    return a && (n = n.find(".m-datatable__cell")), n
                },
                hasOverflowY: function (t) {
                    var e = g(t).find(".m-datatable__row"),
                        a = 0;
                    return 0 < e.length && (g(e).each(function (t, e) {
                        a += Math.floor(g(e).innerHeight())
                    }), a > g(t).innerHeight())
                },
                sortColumn: function (t, o, i) {
                    void 0 === o && (o = "asc"), void 0 === i && (i = !1);
                    var l = g(t).index(),
                        e = g(p.tableBody).find(".m-datatable__row"),
                        a = g(t).closest(".m-datatable__lock").index(); - 1 !== a && (e = g(p.tableBody).find(".m-datatable__lock:nth-child(" + (a + 1) + ")").find(".m-datatable__row"));
                    var n = g(e).parent();
                    g(e).sort(function (t, e) {
                        var a = g(t).find("td:nth-child(" + l + ")").text(),
                            n = g(e).find("td:nth-child(" + l + ")").text();
                        return i && (a = parseInt(a), n = parseInt(n)), "asc" === o ? n < a ? 1 : a < n ? -1 : 0 : a < n ? 1 : n < a ? -1 : 0
                    }).appendTo(n)
                },
                sorting: function () {
                    var i = {
                        init: function () {
                            u.sortable && (g(p.tableHead).find(".m-datatable__cell:not(.m-datatable__cell--check)").addClass("m-datatable__cell--sort").off("click").on("click", i.sortClick), i.setIcon())
                        },
                        setIcon: function () {
                            var t = f.getDataSourceParam("sort");
                            if (!g.isEmptyObject(t)) {
                                var e = g(p.tableHead).find('.m-datatable__cell[data-field="' + t.field + '"]').attr("data-sort", t.sort),
                                    a = g(e).find("span"),
                                    n = g(a).find("i"),
                                    o = f.getOption("layout.icons.sort");
                                0 < g(n).length ? g(n).removeAttr("class").addClass(o[t.sort]) : g(a).append(g("<i/>").addClass(o[t.sort]))
                            }
                        },
                        sortClick: function (t) {
                            var e = f.getDataSourceParam("sort"),
                                a = g(this).data("field"),
                                n = f.getColumnByField(a);
                            if ((void 0 === n.sortable || !1 !== n.sortable) && (g(p.tableHead).find(".m-datatable__cell > span > i").remove(), u.sortable)) {
                                f.spinnerCallback(!0);
                                var o = "desc";
                                f.getObject("field", e) === a && (o = f.getObject("sort", e)), e = {
                                    field: a,
                                    sort: o = void 0 === o || "desc" === o ? "asc" : "desc"
                                }, f.setDataSourceParam("sort", e), i.setIcon(), setTimeout(function () {
                                    f.dataRender("sort"), g(p).trigger("m-datatable--on-sort", e)
                                }, 300)
                            }
                        }
                    };
                    i.init()
                },
                localDataUpdate: function () {
                    var a = f.getDataSourceParam();
                    void 0 === p.originalDataSet && (p.originalDataSet = p.dataSet);
                    var t = f.getObject("sort.field", a),
                        e = f.getObject("sort.sort", a),
                        n = f.getColumnByField(t);
                    if (void 0 !== n && !0 !== f.getOption("data.serverSorting") ? "function" == typeof n.sortCallback ? p.dataSet = n.sortCallback(p.originalDataSet, e, n) : p.dataSet = f.sortCallback(p.originalDataSet, e, n) : p.dataSet = p.originalDataSet, "object" == typeof a.query && !f.getOption("data.serverFiltering")) {
                        a.query = a.query || {};
                        var o = function (t) {
                                for (var e in t)
                                    if (t.hasOwnProperty(e))
                                        if ("string" == typeof t[e]) {
                                            if (t[e].toLowerCase() == i || -1 !== t[e].toLowerCase().indexOf(i)) return !0
                                        } else if ("object" == typeof t[e]) return o(t[e]);
                                return !1
                            },
                            i = g(f.getOption("search.input")).val();
                        void 0 !== i && "" !== i && (i = i.toLowerCase(), p.dataSet = g.grep(p.dataSet, o), delete a.query[f.getGeneralSearchKey()]), g.each(a.query, function (t, e) {
                            "" === e && delete a.query[t]
                        }), p.dataSet = f.filterArray(p.dataSet, a.query), p.dataSet = p.dataSet.filter(function () {
                            return !0
                        })
                    }
                    return p.dataSet
                },
                filterArray: function (t, a, i) {
                    if ("object" != typeof t) return [];
                    if (void 0 === i && (i = "AND"), "object" != typeof a) return t;
                    if (i = i.toUpperCase(), -1 === g.inArray(i, ["AND", "OR", "NOT"])) return [];
                    var l = Object.keys(a).length,
                        r = [];
                    return g.each(t, function (t, e) {
                        var n = e,
                            o = 0;
                        g.each(a, function (t, e) {
                            if (e = e instanceof Array ? e : [e], n.hasOwnProperty(t)) {
                                var a = n[t].toString().toLowerCase();
                                e.forEach(function (t, e) {
                                    t.toString().toLowerCase() != a && -1 === a.indexOf(t.toString().toLowerCase()) || o++
                                })
                            }
                        }), ("AND" == i && o == l || "OR" == i && 0 < o || "NOT" == i && 0 == o) && (r[t] = e)
                    }), t = r
                },
                resetScroll: function () {
                    void 0 === u.detail && 1 === f.getDepth() && (g(p.table).find(".m-datatable__row").css("left", 0), g(p.table).find(".m-datatable__lock").css("top", 0), g(p.tableBody).scrollTop(0))
                },
                getColumnByField: function (a) {
                    var n;
                    if (void 0 !== a) return g.each(u.columns, function (t, e) {
                        if (a === e.field) return n = e, !1
                    }), n
                },
                getDefaultSortColumn: function () {
                    var a;
                    return g.each(u.columns, function (t, e) {
                        if (void 0 !== e.sortable && -1 !== g.inArray(e.sortable, ["asc", "desc"])) return !(a = {
                            sort: e.sortable,
                            field: e.field
                        })
                    }), a
                },
                getHiddenDimensions: function (t, e) {
                    var n = {
                            position: "absolute",
                            visibility: "hidden",
                            display: "block"
                        },
                        a = {
                            width: 0,
                            height: 0,
                            innerWidth: 0,
                            innerHeight: 0,
                            outerWidth: 0,
                            outerHeight: 0
                        },
                        o = g(t).parents().addBack().not(":visible");
                    e = "boolean" == typeof e && e;
                    var i = [];
                    return o.each(function () {
                        var t = {};
                        for (var e in n) t[e] = this.style[e], this.style[e] = n[e];
                        i.push(t)
                    }), a.width = g(t).width(), a.outerWidth = g(t).outerWidth(e), a.innerWidth = g(t).innerWidth(), a.height = g(t).height(), a.innerHeight = g(t).innerHeight(), a.outerHeight = g(t).outerHeight(e), o.each(function (t) {
                        var e = i[t];
                        for (var a in n) this.style[a] = e[a]
                    }), a
                },
                getGeneralSearchKey: function () {
                    var t = g(f.getOption("search.input"));
                    return g(t).prop("name") || g(t).prop("id")
                },
                getObject: function (t, e) {
                    return t.split(".").reduce(function (t, e) {
                        return null !== t && void 0 !== t[e] ? t[e] : null
                    }, e)
                },
                extendObj: function (t, e, n) {
                    var o = e.split("."),
                        i = 0;
                    return function t(e) {
                        var a = o[i++];
                        void 0 !== e[a] && null !== e[a] ? "object" != typeof e[a] && "function" != typeof e[a] && (e[a] = {}) : e[a] = {}, i === o.length ? e[a] = n : t(e[a])
                    }(t), t
                },
                timer: 0,
                redraw: function () {
                    return f.adjustCellsWidth.call(), f.isLocked() && (f.scrollbar(), f.resetScroll(), f.adjustCellsHeight.call()), f.adjustLockContainer.call(), f.initHeight.call(), p
                },
                load: function () {
                    return f.reload(), p
                },
                reload: function () {
                    return function (t, e) {
                        clearTimeout(f.timer), f.timer = setTimeout(t, e)
                    }(function () {
                        u.data.serverFiltering || f.localDataUpdate(), f.dataRender(), g(p).trigger("m-datatable--on-reloaded")
                    }, f.getOption("search.delay")), p
                },
                getRecord: function (n) {
                    return void 0 === p.tableBody && (p.tableBody = g(p.table).children("tbody")), g(p.tableBody).find(".m-datatable__cell:first-child").each(function (t, e) {
                        if (n == g(e).text()) {
                            var a = g(e).closest(".m-datatable__row").index() + 1;
                            return p.API.record = p.API.value = f.getOneRow(p.tableBody, a), p
                        }
                    }), p
                },
                getColumn: function (t) {
                    return f.setSelectedRecords(), p.API.value = g(p.API.record).find('[data-field="' + t + '"]'), p
                },
                destroy: function () {
                    g(p).parent().find(".m-datatable__pager").remove();
                    var t = g(p.initialDatatable).addClass("m-datatable--destroyed").show();
                    return g(p).replaceWith(t), g(p = t).trigger("m-datatable--on-destroy"), f.isInit = !1, t = null
                },
                sort: function (t, e) {
                    e = void 0 === e ? "asc" : e, f.spinnerCallback(!0);
                    var a = {
                        field: t,
                        sort: e
                    };
                    return f.setDataSourceParam("sort", a), setTimeout(function () {
                        f.dataRender("sort"), g(p).trigger("m-datatable--on-sort", a), g(p.tableHead).find(".m-datatable__cell > span > i").remove()
                    }, 300), p
                },
                getValue: function () {
                    return g(p.API.value).text()
                },
                setActive: function (t) {
                    "string" == typeof t && (t = g(p.tableBody).find('.m-checkbox--single > [type="checkbox"][value="' + t + '"]')), g(t).prop("checked", !0);
                    var e = g(t).closest(".m-datatable__row").addClass("m-datatable__row--active"),
                        a = g(e).index() + 1;
                    g(e).closest(".m-datatable__lock").parent().find(".m-datatable__row:nth-child(" + a + ")").addClass("m-datatable__row--active");
                    var n = [];
                    g(e).each(function (t, e) {
                        var a = g(e).find('.m-checkbox--single:not(.m-checkbox--all) > [type="checkbox"]').val();
                        void 0 !== a && n.push(a)
                    }), g(p).trigger("m-datatable--on-check", [n])
                },
                setInactive: function (t) {
                    "string" == typeof t && (t = g(p.tableBody).find('.m-checkbox--single > [type="checkbox"][value="' + t + '"]')), g(t).prop("checked", !1);
                    var e = g(t).closest(".m-datatable__row").removeClass("m-datatable__row--active"),
                        a = g(e).index() + 1;
                    g(e).closest(".m-datatable__lock").parent().find(".m-datatable__row:nth-child(" + a + ")").removeClass("m-datatable__row--active");
                    var n = [];
                    g(e).each(function (t, e) {
                        var a = g(e).find('.m-checkbox--single:not(.m-checkbox--all) > [type="checkbox"]').val();
                        void 0 !== a && n.push(a)
                    }), g(p).trigger("m-datatable--on-uncheck", [n])
                },
                setActiveAll: function (t) {
                    var e = g(p.table).find(".m-datatable__body .m-datatable__row").find('.m-datatable__cell--check .m-checkbox [type="checkbox"]');
                    t ? f.setActive(e) : f.setInactive(e)
                },
                setSelectedRecords: function () {
                    return p.API.record = g(p.tableBody).find(".m-datatable__row--active"), p
                },
                getSelectedRecords: function () {
                    return f.setSelectedRecords(), p.API.record = p.rows(".m-datatable__row--active").nodes(), p.API.record
                },
                getOption: function (t) {
                    return f.getObject(t, u)
                },
                setOption: function (t, e) {
                    u = f.extendObj(u, t, e)
                },
                search: function (n, e) {
                    void 0 !== e && (e = g.makeArray(e)), t = function () {
                        var a = f.getDataSourceQuery();
                        if (void 0 === e && void 0 !== n) {
                            var t = f.getGeneralSearchKey();
                            a[t] = n
                        }
                        "object" == typeof e && (g.each(e, function (t, e) {
                            a[e] = n
                        }), g.each(a, function (t, e) {
                            ("" === e || g.isEmptyObject(e)) && delete a[t]
                        })), f.setDataSourceQuery(a), u.data.serverFiltering || f.localDataUpdate(), f.dataRender("search")
                    }, a = f.getOption("search.delay"), clearTimeout(f.timer), f.timer = setTimeout(t, a);
                    var t, a
                },
                setDataSourceParam: function (t, e) {
                    p.API.params = g.extend({}, {
                        pagination: {
                            page: 1,
                            perpage: f.getOption("data.pageSize")
                        },
                        sort: f.getDefaultSortColumn(),
                        query: {}
                    }, p.API.params, f.stateGet(f.stateId)), p.API.params = f.extendObj(p.API.params, t, e), f.stateKeep(f.stateId, p.API.params)
                },
                getDataSourceParam: function (t) {
                    return p.API.params = g.extend({}, {
                        pagination: {
                            page: 1,
                            perpage: f.getOption("data.pageSize")
                        },
                        sort: f.getDefaultSortColumn(),
                        query: {}
                    }, p.API.params, f.stateGet(f.stateId)), "string" == typeof t ? f.getObject(t, p.API.params) : p.API.params
                },
                getDataSourceQuery: function () {
                    return f.getDataSourceParam("query") || {}
                },
                setDataSourceQuery: function (t) {
                    f.setDataSourceParam("query", t)
                },
                getCurrentPage: function () {
                    return g(p.table).siblings(".m-datatable__pager").last().find(".m-datatable__pager-nav").find(".m-datatable__pager-link.m-datatable__pager-link--active").data("page") || 1
                },
                getPageSize: function () {
                    return g(p.table).siblings(".m-datatable__pager").last().find("select.m-datatable__pager-size").val() || 10
                },
                getTotalRows: function () {
                    return p.API.params.pagination.total
                },
                getDataSet: function () {
                    return p.originalDataSet
                },
                hideColumn: function (a) {
                    g.map(u.columns, function (t) {
                        return a === t.field && (t.responsive = {
                            hidden: "xl"
                        }), t
                    });
                    var t = g.grep(g(p.table).find(".m-datatable__cell"), function (t, e) {
                        return a === g(t).data("field")
                    });
                    g(t).hide()
                },
                showColumn: function (a) {
                    g.map(u.columns, function (t) {
                        return a === t.field && delete t.responsive, t
                    });
                    var t = g.grep(g(p.table).find(".m-datatable__cell"), function (t, e) {
                        return a === g(t).data("field")
                    });
                    g(t).show()
                },
                destroyScroller: function (t) {
                    void 0 === t && (t = p.tableBody), g(t).each(function () {
                        if (g(this).hasClass("mCustomScrollbar")) try {
                            mApp.destroyScroller(g(this))
                        } catch (t) {
                            console.log(t)
                        }
                    })
                },
                nodeTr: [],
                nodeTd: [],
                nodeCols: [],
                recentNode: [],
                table: function () {
                    return p.table
                },
                row: function (t) {
                    return f.rows(t), f.nodeTr = f.recentNode = g(f.nodeTr).first(), p
                },
                rows: function (t) {
                    return f.nodeTr = f.recentNode = g(p.tableBody).find(t).filter(".m-datatable__row"), p
                },
                column: function (t) {
                    return f.nodeCols = f.recentNode = g(p.tableBody).find(".m-datatable__cell:nth-child(" + (t + 1) + ")"), p
                },
                columns: function (t) {
                    var e = p.table;
                    f.nodeTr === f.recentNode && (e = f.nodeTr);
                    var a = g(e).find('.m-datatable__cell[data-field="' + t + '"]');
                    return 0 < a.length ? f.nodeCols = f.recentNode = a : f.nodeCols = f.recentNode = g(e).find(t).filter(".m-datatable__cell"), p
                },
                cell: function (t) {
                    return f.cells(t), f.nodeTd = f.recentNode = g(f.nodeTd).first(), p
                },
                cells: function (t) {
                    var e = g(p.tableBody).find(".m-datatable__cell");
                    return void 0 !== t && (e = g(e).filter(t)), f.nodeTd = f.recentNode = e, p
                },
                remove: function () {
                    return g(f.nodeTr.length) && f.nodeTr === f.recentNode && g(f.nodeTr).remove(), f.layoutUpdate(), p
                },
                visible: function (t) {
                    if (g(f.recentNode.length)) {
                        var e = f.lockEnabledColumns();
                        if (f.recentNode === f.nodeCols) {
                            var a = f.recentNode.index();
                            if (f.isLocked()) {
                                var n = g(f.recentNode).closest(".m-datatable__lock--scroll").length;
                                n ? a += e.left.length + 1 : g(f.recentNode).closest(".m-datatable__lock--right").length && (a += e.left.length + n + 1)
                            }
                        }
                        t ? (f.recentNode === f.nodeCols && delete u.columns[a].responsive, g(f.recentNode).show()) : (f.recentNode === f.nodeCols && f.setOption("columns." + a + ".responsive", {
                            hidden: "xl"
                        }), g(f.recentNode).hide()), f.redraw()
                    }
                },
                nodes: function () {
                    return f.recentNode
                },
                dataset: function () {
                    return p
                }
            };
            if (g.each(f, function (t, e) {
                    p[t] = e
                }), void 0 !== u)
                if ("string" == typeof u) {
                    var t = u;
                    void 0 !== (p = g(this).data("mDatatable")) && (u = p.options, f[t].apply(this, Array.prototype.slice.call(arguments, 1)))
                } else p.data("mDatatable") || g(this).hasClass("m-datatable--loaded") || (p.dataSet = null, p.textAlign = {
                    left: "m-datatable__cell--left",
                    center: "m-datatable__cell--center",
                    right: "m-datatable__cell--right"
                }, u = g.extend(!0, {}, g.fn.mDatatable.defaults, u), p.options = u, f.init.apply(this, [u]), g(p.wrap).data("mDatatable", p));
            else void 0 === (p = g(this).data("mDatatable")) && g.error("mDatatable not initialized"), u = p.options;
            return p
        }
        console.log("No mDatatable element exist.")
    }, g.fn.mDatatable.defaults = {
        data: {
            type: "local",
            source: null,
            pageSize: 10,
            saveState: {
                cookie: !1,
                webstorage: !0
            },
            serverPaging: !1,
            serverFiltering: !1,
            serverSorting: !1,
            autoColumns: !1,
            attr: {
                rowProps: []
            }
        },
        layout: {
            theme: "default",
            class: "m-datatable--brand",
            scroll: !1,
            height: null,
            minHeight: 300,
            footer: !1,
            header: !0,
            smoothScroll: {
                scrollbarShown: !0
            },
            spinner: {
                overlayColor: "#000000",
                opacity: 0,
                type: "loader",
                state: "brand",
                message: !0
            },
            icons: {
                sort: {
                    asc: "la la-arrow-up",
                    desc: "la la-arrow-down"
                },
                pagination: {
                    next: "la la-angle-right",
                    prev: "la la-angle-left",
                    first: "la la-angle-double-left",
                    last: "la la-angle-double-right",
                    more: "la la-ellipsis-h"
                },
                rowDetail: {
                    expand: "fa fa-caret-down",
                    collapse: "fa fa-caret-right"
                }
            }
        },
        sortable: !0,
        resizable: !1,
        filterable: !1,
        pagination: !0,
        editable: !1,
        columns: [],
        search: {
            onEnter: !1,
            input: null,
            delay: 400
        },
        rows: {
            callback: function () {},
            beforeTemplate: function () {},
            afterTemplate: function () {},
            autoHide: !1
        },
        toolbar: {
            layout: ["pagination", "info"],
            placement: ["bottom"],
            items: {
                pagination: {
                    type: "default",
                    pages: {
                        desktop: {
                            layout: "default",
                            pagesNumber: 6
                        },
                        tablet: {
                            layout: "default",
                            pagesNumber: 3
                        },
                        mobile: {
                            layout: "compact"
                        }
                    },
                    navigation: {
                        prev: !0,
                        next: !0,
                        first: !0,
                        last: !0
                    },
                    pageSizeSelect: []
                },
                info: !0
            }
        },
        translate: {
            records: {
                processing: "Please wait...",
                noRecords: "No records found"
            },
            toolbar: {
                pagination: {
                    items: {
                        default: {
                            first: "First",
                            prev: "Previous",
                            next: "Next",
                            last: "Last",
                            more: "More pages",
                            input: "Page number",
                            select: "Select page size"
                        },
                        info: "Displaying {{start}} - {{end}} of {{total}} records"
                    }
                }
            }
        },
        extensions: {}
    }
}(jQuery);
var mDropdown = function (t, e) {
var o = this,
    n = mUtil.get(t),
    i = mUtil.get("body");
if (n) {
    var a = {
            toggle: "click",
            hoverTimeout: 300,
            skin: "light",
            height: "auto",
            maxHeight: !1,
            minHeight: !1,
            persistent: !1,
            mobileOverlay: !0
        },
        l = {
            construct: function (t) {
                return mUtil.data(n).has("dropdown") ? o = mUtil.data(n).get("dropdown") : (l.init(t), l.setup(), mUtil.data(n).set("dropdown", o)), o
            },
            init: function (t) {
                o.options = mUtil.deepExtend({}, a, t), o.events = [], o.eventHandlers = {}, o.open = !1, o.layout = {}, o.layout.close = mUtil.find(n, ".m-dropdown__close"), o.layout.toggle = mUtil.find(n, ".m-dropdown__toggle"), o.layout.arrow = mUtil.find(n, ".m-dropdown__arrow"), o.layout.wrapper = mUtil.find(n, ".m-dropdown__wrapper"), o.layout.defaultDropPos = mUtil.hasClass(n, "m-dropdown--up") ? "up" : "down", o.layout.currentDropPos = o.layout.defaultDropPos, "hover" == mUtil.attr(n, "m-dropdown-toggle") && (o.options.toggle = "hover")
            },
            setup: function () {
                o.options.placement && mUtil.addClass(n, "m-dropdown--" + o.options.placement), o.options.align && mUtil.addClass(n, "m-dropdown--align-" + o.options.align), o.options.width && mUtil.css(o.layout.wrapper, "width", o.options.width + "px"), "1" == mUtil.attr(n, "m-dropdown-persistent") && (o.options.persistent = !0), "hover" == o.options.toggle && mUtil.addEvent(n, "mouseout", l.hideMouseout), l.setZindex()
            },
            toggle: function () {
                return o.open ? l.hide() : l.show()
            },
            setContent: function (t) {
                t = mUtil.find(n, ".m-dropdown__content").innerHTML = t;
                return o
            },
            show: function () {
                if ("hover" == o.options.toggle && mUtil.hasAttr(n, "hover")) return l.clearHovered(), o;
                if (o.open) return o;
                if (o.layout.arrow && l.adjustArrowPos(), l.eventTrigger("beforeShow"), l.hideOpened(), mUtil.addClass(n, "m-dropdown--open"), mUtil.isMobileDevice() && o.options.mobileOverlay) {
                    var t = mUtil.css(n, "z-index") - 1,
                        e = mUtil.insertAfter(document.createElement("DIV"), n);
                    mUtil.addClass(e, "m-dropdown__dropoff"), mUtil.css(e, "z-index", t), mUtil.data(e).set("dropdown", n), mUtil.data(n).set("dropoff", e), mUtil.addEvent(e, "click", function (t) {
                        l.hide(), mUtil.remove(this), t.preventDefault()
                    })
                }
                return n.focus(), n.setAttribute("aria-expanded", "true"), o.open = !0, l.eventTrigger("afterShow"), o
            },
            clearHovered: function () {
                var t = mUtil.attr(n, "timeout");
                mUtil.removeAttr(n, "hover"), mUtil.removeAttr(n, "timeout"), clearTimeout(t)
            },
            hideHovered: function (t) {
                if (!0 === t) {
                    if (!1 === l.eventTrigger("beforeHide")) return;
                    l.clearHovered(), mUtil.removeClass(n, "m-dropdown--open"), o.open = !1, l.eventTrigger("afterHide")
                } else {
                    if (!0 === mUtil.hasAttr(n, "hover")) return;
                    if (!1 === l.eventTrigger("beforeHide")) return;
                    var e = setTimeout(function () {
                        mUtil.attr(n, "hover") && (l.clearHovered(), mUtil.removeClass(n, "m-dropdown--open"), o.open = !1, l.eventTrigger("afterHide"))
                    }, o.options.hoverTimeout);
                    mUtil.attr(n, "hover", "1"), mUtil.attr(n, "timeout", e)
                }
            },
            hideClicked: function () {
                !1 !== l.eventTrigger("beforeHide") && (mUtil.removeClass(n, "m-dropdown--open"), mUtil.data(n).remove("dropoff"), o.open = !1, l.eventTrigger("afterHide"))
            },
            hide: function (t) {
                return !1 === o.open || (mUtil.isDesktopDevice() && "hover" == o.options.toggle ? l.hideHovered(t) : l.hideClicked(), "down" == o.layout.defaultDropPos && "up" == o.layout.currentDropPos && (mUtil.removeClass(n, "m-dropdown--up"), o.layout.arrow.prependTo(o.layout.wrapper), o.layout.currentDropPos = "down")), o
            },
            hideMouseout: function () {
                mUtil.isDesktopDevice() && l.hide()
            },
            hideOpened: function () {
                for (var t = mUtil.findAll(i, ".m-dropdown.m-dropdown--open"), e = 0, a = t.length; e < a; e++) {
                    var n = t[e];
                    mUtil.data(n).get("dropdown").hide(!0)
                }
            },
            adjustArrowPos: function () {
                var t = mUtil.outerWidth(n),
                    e = mUtil.hasClass(o.layout.arrow, "m-dropdown__arrow--right") ? "right" : "left",
                    a = 0;
                o.layout.arrow && (mUtil.isInResponsiveRange("mobile") && mUtil.hasClass(n, "m-dropdown--mobile-full-width") ? (a = mUtil.offset(n).left + t / 2 - Math.abs(parseInt(mUtil.css(o.layout.arrow, "width")) / 2) - parseInt(mUtil.css(o.layout.wrapper, "left")), mUtil.css(o.layout.arrow, "right", "auto"), mUtil.css(o.layout.arrow, "left", a + "px"), mUtil.css(o.layout.arrow, "margin-left", "auto"), mUtil.css(o.layout.arrow, "margin-right", "auto")) : mUtil.hasClass(o.layout.arrow, "m-dropdown__arrow--adjust") && (a = t / 2 - Math.abs(parseInt(mUtil.css(o.layout.arrow, "width")) / 2), mUtil.hasClass(n, "m-dropdown--align-push") && (a += 20), "right" == e ? (mUtil.css(o.layout.arrow, "left", "auto"), mUtil.css(o.layout.arrow, "right", a + "px")) : (mUtil.css(o.layout.arrow, "right", "auto"), mUtil.css(o.layout.arrow, "left", a + "px"))))
            },
            setZindex: function () {
                var t = 101,
                    e = mUtil.getHighestZindex(n);
                t <= e && (t = e + 1), mUtil.css(o.layout.wrapper, "z-index", t)
            },
            isPersistent: function () {
                return o.options.persistent
            },
            isShown: function () {
                return o.open
            },
            eventTrigger: function (t, e) {
                for (var a = 0; a < o.events.length; a++) {
                    var n = o.events[a];
                    n.name == t && (1 == n.one ? 0 == n.fired && (o.events[a].fired = !0, n.handler.call(this, o, e)) : n.handler.call(this, o, e))
                }
            },
            addEvent: function (t, e, a) {
                o.events.push({
                    name: t,
                    handler: e,
                    one: a,
                    fired: !1
                })
            }
        };
    return o.setDefaults = function (t) {
        a = t
    }, o.show = function () {
        return l.show()
    }, o.hide = function () {
        return l.hide()
    }, o.toggle = function () {
        return l.toggle()
    }, o.isPersistent = function () {
        return l.isPersistent()
    }, o.isShown = function () {
        return l.isShown()
    }, o.setContent = function (t) {
        return l.setContent(t)
    }, o.on = function (t, e) {
        return l.addEvent(t, e)
    }, o.one = function (t, e) {
        return l.addEvent(t, e, !0)
    }, l.construct.apply(o, [e]), !0, o
}
};
mUtil.on(document, '[m-dropdown-toggle="click"] .m-dropdown__toggle', "click", function (t) {
var e = this.closest(".m-dropdown");
e && ((mUtil.data(e).has("dropdown") ? mUtil.data(e).get("dropdown") : new mDropdown(e)).toggle(), t.preventDefault())
}), mUtil.on(document, '[m-dropdown-toggle="hover"] .m-dropdown__toggle', "click", function (t) {
if (mUtil.isDesktopDevice()) "#" == mUtil.attr(this, "href") && t.preventDefault();
else if (mUtil.isMobileDevice()) {
    var e = this.closest(".m-dropdown");
    e && ((mUtil.data(e).has("dropdown") ? mUtil.data(e).get("dropdown") : new mDropdown(e)).toggle(), t.preventDefault())
}
}), mUtil.on(document, '[m-dropdown-toggle="hover"]', "mouseover", function (t) {
if (mUtil.isDesktopDevice()) {
    this && ((mUtil.data(this).has("dropdown") ? mUtil.data(this).get("dropdown") : new mDropdown(this)).show(), t.preventDefault())
}
}), document.addEventListener("click", function (t) {
var e, a = mUtil.get("body"),
    n = t.target;
if (e = a.querySelectorAll(".m-dropdown.m-dropdown--open"))
    for (var o = 0, i = e.length; o < i; o++) {
        var l = e[o];
        if (!1 === mUtil.data(l).has("dropdown")) return;
        var r = mUtil.data(l).get("dropdown"),
            s = mUtil.find(l, ".m-dropdown__toggle");
        mUtil.hasClass(l, "m-dropdown--disable-close") && (t.preventDefault(), t.stopPropagation()), s && n !== s && !1 === s.contains(n) && !1 === n.contains(s) ? !0 === r.isPersistent() ? !1 === l.contains(n) && r.hide() : r.hide() : !1 === l.contains(n) && r.hide()
    }
});
var mHeader = function (t, e) {
    var i = this,
        a = mUtil.get(t),
        l = mUtil.get("body");
    if (void 0 !== a) {
        var n = {
                classic: !1,
                offset: {
                    mobile: 150,
                    desktop: 200
                },
                minimize: {
                    mobile: !1,
                    desktop: !1
                }
            },
            o = {
                construct: function (t) {
                    return mUtil.data(a).has("header") ? i = mUtil.data(a).get("header") : (o.init(t), o.build(), mUtil.data(a).set("header", i)), i
                },
                init: function (t) {
                    i.events = [], i.options = mUtil.deepExtend({}, n, t)
                },
                build: function () {
                    var o = 0;
                    !1 === i.options.minimize.mobile && !1 === i.options.minimize.desktop || window.addEventListener("scroll", function () {
                        var t, e, a, n = 0;
                        mUtil.isInResponsiveRange("desktop") ? (n = i.options.offset.desktop, t = i.options.minimize.desktop.on, e = i.options.minimize.desktop.off) : mUtil.isInResponsiveRange("tablet-and-mobile") && (n = i.options.offset.mobile, t = i.options.minimize.mobile.on, e = i.options.minimize.mobile.off), a = window.pageYOffset, mUtil.isInResponsiveRange("tablet-and-mobile") && i.options.classic && i.options.classic.mobile || mUtil.isInResponsiveRange("desktop") && i.options.classic && i.options.classic.desktop ? n < a ? (mUtil.addClass(l, t), mUtil.removeClass(l, e)) : (mUtil.addClass(l, e), mUtil.removeClass(l, t)) : (n < a && o < a ? (mUtil.addClass(l, t), mUtil.removeClass(l, e)) : (mUtil.addClass(l, e), mUtil.removeClass(l, t)), o = a)
                    })
                },
                eventTrigger: function (t, e) {
                    for (var a = 0; a < i.events.length; a++) {
                        var n = i.events[a];
                        n.name == t && (1 == n.one ? 0 == n.fired && (i.events[a].fired = !0, n.handler.call(this, i, e)) : n.handler.call(this, i, e))
                    }
                },
                addEvent: function (t, e, a) {
                    i.events.push({
                        name: t,
                        handler: e,
                        one: a,
                        fired: !1
                    })
                }
            };
        return i.setDefaults = function (t) {
            n = t
        }, i.on = function (t, e) {
            return o.addEvent(t, e)
        }, o.construct.apply(i, [e]), !0, i
    }
},
mMenu = function (t, e) {
    var p = this,
        a = !1,
        d = mUtil.get(t),
        i = mUtil.get("body");
    if (d) {
        var n = {
                autoscroll: {
                    speed: 1200
                },
                accordion: {
                    slideSpeed: 200,
                    autoScroll: !0,
                    autoScrollSpeed: 1200,
                    expandAll: !0
                },
                dropdown: {
                    timeout: 500
                }
            },
            f = {
                construct: function (t) {
                    return mUtil.data(d).has("menu") ? p = mUtil.data(d).get("menu") : (f.init(t), f.reset(), f.build(), mUtil.data(d).set("menu", p)), p
                },
                init: function (t) {
                    p.events = [], p.eventHandlers = {}, p.options = mUtil.deepExtend({}, n, t), p.pauseDropdownHoverTime = 0, p.uid = mUtil.getUniqueID()
                },
                reload: function () {
                    f.reset(), f.build()
                },
                build: function () {
                    p.eventHandlers.event_1 = mUtil.on(d, ".m-menu__toggle", "click", f.handleSubmenuAccordion), ("dropdown" === f.getSubmenuMode() || f.isConditionalSubmenuDropdown()) && (p.eventHandlers.event_2 = mUtil.on(d, '[m-menu-submenu-toggle="hover"]', "mouseover", f.handleSubmenuDrodownHoverEnter), p.eventHandlers.event_3 = mUtil.on(d, '[m-menu-submenu-toggle="hover"]', "mouseout", f.handleSubmenuDrodownHoverExit), p.eventHandlers.event_4 = mUtil.on(d, '[m-menu-submenu-toggle="click"] > .m-menu__toggle, [m-menu-submenu-toggle="click"] > .m-menu__link .m-menu__toggle', "click", f.handleSubmenuDropdownClick), p.eventHandlers.event_5 = mUtil.on(d, '[m-menu-submenu-toggle="tab"] > .m-menu__toggle, [m-menu-submenu-toggle="tab"] > .m-menu__link .m-menu__toggle', "click", f.handleSubmenuDropdownTabClick)), p.eventHandlers.event_6 = mUtil.on(d, ".m-menu__item:not(.m-menu__item--submenu) > .m-menu__link:not(.m-menu__toggle):not(.m-menu__link--toggle-skip)", "click", f.handleLinkClick)
                },
                reset: function () {
                    mUtil.off(d, "click", p.eventHandlers.event_1), mUtil.off(d, "mouseover", p.eventHandlers.event_2), mUtil.off(d, "mouseout", p.eventHandlers.event_3), mUtil.off(d, "click", p.eventHandlers.event_4), mUtil.off(d, "click", p.eventHandlers.event_5), mUtil.off(d, "click", p.eventHandlers.event_6)
                },
                getSubmenuMode: function () {
                    return mUtil.isInResponsiveRange("desktop") ? mUtil.isset(p.options.submenu, "desktop.state.body") ? mUtil.hasClass(i, p.options.submenu.desktop.state.body) ? p.options.submenu.desktop.state.mode : p.options.submenu.desktop.default : mUtil.isset(p.options.submenu, "desktop") ? p.options.submenu.desktop : void 0 : mUtil.isInResponsiveRange("tablet") && mUtil.isset(p.options.submenu, "tablet") ? p.options.submenu.tablet : !(!mUtil.isInResponsiveRange("mobile") || !mUtil.isset(p.options.submenu, "mobile")) && p.options.submenu.mobile
                },
                isConditionalSubmenuDropdown: function () {
                    return !(!mUtil.isInResponsiveRange("desktop") || !mUtil.isset(p.options.submenu, "desktop.state.body"))
                },
                handleLinkClick: function (t) {
                    !1 === f.eventTrigger("linkClick", this) && t.preventDefault(), ("dropdown" === f.getSubmenuMode() || f.isConditionalSubmenuDropdown()) && f.handleSubmenuDropdownClose(t, this)
                },
                handleSubmenuDrodownHoverEnter: function (t) {
                    if ("accordion" !== f.getSubmenuMode() && !1 !== p.resumeDropdownHover()) {
                        var e = this;
                        "1" == e.getAttribute("data-hover") && (e.removeAttribute("data-hover"), clearTimeout(e.getAttribute("data-timeout")), e.removeAttribute("data-timeout")), f.showSubmenuDropdown(e)
                    }
                },
                handleSubmenuDrodownHoverExit: function (t) {
                    if (!1 !== p.resumeDropdownHover() && "accordion" !== f.getSubmenuMode()) {
                        var e = this,
                            a = p.options.dropdown.timeout,
                            n = setTimeout(function () {
                                "1" == e.getAttribute("data-hover") && f.hideSubmenuDropdown(e, !0)
                            }, a);
                        e.setAttribute("data-hover", "1"), e.setAttribute("data-timeout", n)
                    }
                },
                handleSubmenuDropdownClick: function (t) {
                    if ("accordion" !== f.getSubmenuMode()) {
                        var e = this.closest(".m-menu__item");
                        "accordion" != e.getAttribute("m-menu-submenu-mode") && (!1 === mUtil.hasClass(e, "m-menu__item--hover") ? (mUtil.addClass(e, "m-menu__item--open-dropdown"), f.showSubmenuDropdown(e)) : (mUtil.removeClass(e, "m-menu__item--open-dropdown"), f.hideSubmenuDropdown(e, !0)), t.preventDefault())
                    }
                },
                handleSubmenuDropdownTabClick: function (t) {
                    if ("accordion" !== f.getSubmenuMode()) {
                        var e = this.closest(".m-menu__item");
                        "accordion" != e.getAttribute("m-menu-submenu-mode") && (0 == mUtil.hasClass(e, "m-menu__item--hover") && (mUtil.addClass(e, "m-menu__item--open-dropdown"), f.showSubmenuDropdown(e)), t.preventDefault())
                    }
                },
                handleSubmenuDropdownClose: function (t, e) {
                    if ("accordion" !== f.getSubmenuMode()) {
                        var a = d.querySelectorAll(".m-menu__item.m-menu__item--submenu.m-menu__item--hover:not(.m-menu__item--tabs)");
                        if (0 < a.length && !1 === mUtil.hasClass(e, "m-menu__toggle") && 0 === e.querySelectorAll(".m-menu__toggle").length)
                            for (var n = 0, o = a.length; n < o; n++) f.hideSubmenuDropdown(a[0], !0)
                    }
                },
                handleSubmenuAccordion: function (t, e) {
                    var a, n = e || this;
                    if ("dropdown" === f.getSubmenuMode() && (a = n.closest(".m-menu__item")) && "accordion" != a.getAttribute("m-menu-submenu-mode")) t.preventDefault();
                    else {
                        var o = n.closest(".m-menu__item"),
                            i = mUtil.child(o, ".m-menu__submenu, .m-menu__inner");
                        if (!mUtil.hasClass(n.closest(".m-menu__item"), "m-menu__item--open-always") && o && i) {
                            t.preventDefault();
                            var l = p.options.accordion.slideSpeed;
                            if (!1 === mUtil.hasClass(o, "m-menu__item--open")) {
                                if (!1 === p.options.accordion.expandAll) {
                                    var r = n.closest(".m-menu__nav, .m-menu__subnav"),
                                        s = mUtil.children(r, ".m-menu__item.m-menu__item--open.m-menu__item--submenu:not(.m-menu__item--expanded):not(.m-menu__item--open-always)");
                                    if (r && s)
                                        for (var d = 0, c = s.length; d < c; d++) {
                                            var m = s[0],
                                                u = mUtil.child(m, ".m-menu__submenu");
                                            u && mUtil.slideUp(u, l, function () {
                                                mUtil.removeClass(m, "m-menu__item--open")
                                            })
                                        }
                                }
                                mUtil.slideDown(i, l, function () {
                                    f.scrollToItem(n)
                                }), mUtil.addClass(o, "m-menu__item--open")
                            } else mUtil.slideUp(i, l, function () {
                                f.scrollToItem(n)
                            }), mUtil.removeClass(o, "m-menu__item--open")
                        }
                    }
                },
                scrollToItem: function (t) {
                    mUtil.isInResponsiveRange("desktop") && p.options.accordion.autoScroll && "1" !== d.getAttribute("m-menu-scrollable") && mUtil.scrollToCenter(t, p.options.accordion.autoScrollSpeed)
                },
                hideSubmenuDropdown: function (t, e) {
                    e && (mUtil.removeClass(t, "m-menu__item--hover"), mUtil.removeClass(t, "m-menu__item--active-tab")), t.removeAttribute("data-hover"), t.getAttribute("m-menu-dropdown-toggle-class") && mUtil.removeClass(i, t.getAttribute("m-menu-dropdown-toggle-class"));
                    var a = t.getAttribute("data-timeout");
                    t.removeAttribute("data-timeout"), clearTimeout(a)
                },
                showSubmenuDropdown: function (t) {
                    var e = d.querySelectorAll(".m-menu__item--submenu.m-menu__item--hover, .m-menu__item--submenu.m-menu__item--active-tab");
                    if (e)
                        for (var a = 0, n = e.length; a < n; a++) {
                            var o = e[a];
                            t !== o && !1 === o.contains(t) && !1 === t.contains(o) && f.hideSubmenuDropdown(o, !0)
                        }
                    f.adjustSubmenuDropdownArrowPos(t), mUtil.addClass(t, "m-menu__item--hover"), t.getAttribute("m-menu-dropdown-toggle-class") && mUtil.addClass(i, t.getAttribute("m-menu-dropdown-toggle-class"))
                },
                createSubmenuDropdownClickDropoff: function (e) {
                    var t, a = (t = mUtil.child(e, ".m-menu__submenu") ? mUtil.css(t, "z-index") : 0) - 1,
                        n = document.createElement('<div class="m-menu__dropoff" style="background: transparent; position: fixed; top: 0; bottom: 0; left: 0; right: 0; z-index: ' + a + '"></div>');
                    i.appendChild(n), mUtil.addEvent(n, "click", function (t) {
                        t.stopPropagation(), t.preventDefault(), mUtil.remove(this), f.hideSubmenuDropdown(e, !0)
                    })
                },
                adjustSubmenuDropdownArrowPos: function (t) {
                    var e = mUtil.child(t, ".m-menu__submenu"),
                        a = mUtil.child(e, ".m-menu__arrow.m-menu__arrow--adjust");
                    mUtil.child(e, ".m-menu__subnav");
                    if (a) {
                        var n = 0;
                        mUtil.child(t, ".m-menu__link");
                        mUtil.hasClass(e, "m-menu__submenu--classic") || mUtil.hasClass(e, "m-menu__submenu--fixed") ? mUtil.hasClass(e, "m-menu__submenu--right") ? (n = mUtil.outerWidth(t) / 2, mUtil.hasClass(e, "m-menu__submenu--pull") && (n += Math.abs(parseFloat(mUtil.css(e, "margin-right")))), n = parseInt(mUtil.css(e, "width")) - n) : mUtil.hasClass(e, "m-menu__submenu--left") && (n = mUtil.outerWidth(t) / 2, mUtil.hasClass(e, "m-menu__submenu--pull") && (n += Math.abs(parseFloat(mUtil.css(e, "margin-left"))))) : (mUtil.hasClass(e, "m-menu__submenu--center") || mUtil.hasClass(e, "m-menu__submenu--full")) && (n = mUtil.offset(t).left - (mUtil.getViewPort().width - parseInt(mUtil.css(e, "width"))) / 2, n += mUtil.outerWidth(t) / 2), mUtil.css(a, "left", n + "px")
                    }
                },
                pauseDropdownHover: function (t) {
                    var e = new Date;
                    p.pauseDropdownHoverTime = e.getTime() + t
                },
                resumeDropdownHover: function () {
                    return (new Date).getTime() > p.pauseDropdownHoverTime
                },
                resetActiveItem: function (t) {
                    for (var e, a, n = 0, o = (e = d.querySelectorAll(".m-menu__item--active")).length; n < o; n++) {
                        var i = e[0];
                        mUtil.removeClass(i, "m-menu__item--active"), mUtil.hide(mUtil.child(i, ".m-menu__submenu"));
                        for (var l = 0, r = (a = mUtil.parents(i, ".m-menu__item--submenu")).length; l < r; l++) {
                            var s = a[n];
                            mUtil.removeClass(s, "m-menu__item--open"), mUtil.hide(mUtil.child(s, ".m-menu__submenu"))
                        }
                    }
                    if (!1 === p.options.accordion.expandAll && (e = d.querySelectorAll(".m-menu__item--open")))
                        for (n = 0, o = e.length; n < o; n++) mUtil.removeClass(a[0], "m-menu__item--open")
                },
                setActiveItem: function (t) {
                    f.resetActiveItem(), mUtil.addClass(t, "m-menu__item--active");
                    for (var e = mUtil.parents(t, ".m-menu__item--submenu"), a = 0, n = e.length; a < n; a++) mUtil.addClass(e[a], "m-menu__item--open")
                },
                getBreadcrumbs: function (t) {
                    var e, a = [],
                        n = mUtil.child(t, ".m-menu__link");
                    a.push({
                        text: e = mUtil.child(n, ".m-menu__link-text") ? e.innerHTML : "",
                        title: n.getAttribute("title"),
                        href: n.getAttribute("href")
                    });
                    for (var o = mUtil.parents(t, ".m-menu__item--submenu"), i = 0, l = o.length; i < l; i++) {
                        var r = mUtil.child(o[i], ".m-menu__link");
                        a.push({
                            text: e = mUtil.child(r, ".m-menu__link-text") ? e.innerHTML : "",
                            title: r.getAttribute("title"),
                            href: r.getAttribute("href")
                        })
                    }
                    return a.reverse()
                },
                getPageTitle: function (t) {
                    var e;
                    return mUtil.child(t, ".m-menu__link-text") ? e.innerHTML : ""
                },
                eventTrigger: function (t, e) {
                    for (var a = 0; a < p.events.length; a++) {
                        var n = p.events[a];
                        n.name == t && (1 == n.one ? 0 == n.fired && (p.events[a].fired = !0, n.handler.call(this, p, e)) : n.handler.call(this, p, e))
                    }
                },
                addEvent: function (t, e, a) {
                    p.events.push({
                        name: t,
                        handler: e,
                        one: a,
                        fired: !1
                    })
                }
            };
        return p.setDefaults = function (t) {
            n = t
        }, p.setActiveItem = function (t) {
            return f.setActiveItem(t)
        }, p.reload = function () {
            return f.reload()
        }, p.getBreadcrumbs = function (t) {
            return f.getBreadcrumbs(t)
        }, p.getPageTitle = function (t) {
            return f.getPageTitle(t)
        }, p.getSubmenuMode = function () {
            return f.getSubmenuMode()
        }, p.hideDropdown = function (t) {
            f.hideSubmenuDropdown(t, !0)
        }, p.pauseDropdownHover = function (t) {
            f.pauseDropdownHover(t)
        }, p.resumeDropdownHover = function () {
            return f.resumeDropdownHover()
        }, p.on = function (t, e) {
            return f.addEvent(t, e)
        }, p.one = function (t, e) {
            return f.addEvent(t, e, !0)
        }, f.construct.apply(p, [e]), mUtil.addResizeHandler(function () {
            a && p.reload()
        }), a = !0, p
    }
};
document.addEventListener("click", function (t) {
var e;
if (e = mUtil.get("body").querySelectorAll('.m-menu__nav .m-menu__item.m-menu__item--submenu.m-menu__item--hover:not(.m-menu__item--tabs)[m-menu-submenu-toggle="click"]'))
    for (var a = 0, n = e.length; a < n; a++) {
        var o = e[a].closest(".m-menu__nav").parentNode;
        if (o) {
            var i, l = mUtil.data(o).get("menu");
            if (!l) break;
            if (!l || "dropdown" !== l.getSubmenuMode()) break;
            if (t.target !== o && !1 === o.contains(t.target))
                if (i = o.querySelectorAll('.m-menu__item--submenu.m-menu__item--hover:not(.m-menu__item--tabs)[m-menu-submenu-toggle="click"]'))
                    for (var r = 0, s = i.length; r < s; r++) l.hideDropdown(i[r])
        }
    }
});
var mOffcanvas = function (t, e) {
    var l = this,
        a = mUtil.get(t),
        n = mUtil.get("body");
    if (a) {
        var o = {},
            i = {
                construct: function (t) {
                    return mUtil.data(a).has("offcanvas") ? l = mUtil.data(a).get("offcanvas") : (i.init(t), i.build(), mUtil.data(a).set("offcanvas", l)), l
                },
                init: function (t) {
                    l.events = [], l.options = mUtil.deepExtend({}, o, t), l.overlay, l.classBase = l.options.baseClass, l.classShown = l.classBase + "--on", l.classOverlay = l.classBase + "-overlay", l.state = mUtil.hasClass(a, l.classShown) ? "shown" : "hidden"
                },
                build: function () {
                    if (l.options.toggleBy)
                        if ("string" == typeof l.options.toggleBy) mUtil.addEvent(l.options.toggleBy, "click", i.toggle);
                        else if (l.options.toggleBy && l.options.toggleBy[0] && l.options.toggleBy[0].target)
                        for (var t in l.options.toggleBy) mUtil.addEvent(l.options.toggleBy[t].target, "click", i.toggle);
                    else l.options.toggleBy && l.options.toggleBy.target && mUtil.addEvent(l.options.toggleBy.target, "click", i.toggle);
                    var e = mUtil.get(l.options.closeBy);
                    e && mUtil.addEvent(e, "click", i.hide)
                },
                toggle: function () {
                    i.eventTrigger("toggle"), "shown" == l.state ? i.hide(this) : i.show(this)
                },
                show: function (e) {
                    "shown" != l.state && (i.eventTrigger("beforeShow"), i.togglerClass(e, "show"), mUtil.addClass(n, l.classShown), mUtil.addClass(a, l.classShown), l.state = "shown", l.options.overlay && (l.overlay = mUtil.insertAfter(document.createElement("DIV"), a), mUtil.addClass(l.overlay, l.classOverlay), mUtil.addEvent(l.overlay, "click", function (t) {
                        t.stopPropagation(), t.preventDefault(), i.hide(e)
                    })), i.eventTrigger("afterShow"))
                },
                hide: function (t) {
                    "hidden" != l.state && (i.eventTrigger("beforeHide"), i.togglerClass(t, "hide"), mUtil.removeClass(n, l.classShown), mUtil.removeClass(a, l.classShown), l.state = "hidden", l.options.overlay && l.overlay && mUtil.remove(l.overlay), i.eventTrigger("afterHide"))
                },
                togglerClass: function (t, e) {
                    var a, n = mUtil.attr(t, "id");
                    if (l.options.toggleBy && l.options.toggleBy[0] && l.options.toggleBy[0].target)
                        for (var o in l.options.toggleBy) l.options.toggleBy[o].target === n && (a = l.options.toggleBy[o]);
                    else l.options.toggleBy && l.options.toggleBy.target && (a = l.options.toggleBy);
                    if (a) {
                        var i = mUtil.get(a.target);
                        "show" === e && mUtil.addClass(i, a.state), "hide" === e && mUtil.removeClass(i, a.state)
                    }
                },
                eventTrigger: function (t, e) {
                    for (var a = 0; a < l.events.length; a++) {
                        var n = l.events[a];
                        n.name == t && (1 == n.one ? 0 == n.fired && (l.events[a].fired = !0, n.handler.call(this, l, e)) : n.handler.call(this, l, e))
                    }
                },
                addEvent: function (t, e, a) {
                    l.events.push({
                        name: t,
                        handler: e,
                        one: a,
                        fired: !1
                    })
                }
            };
        return l.setDefaults = function (t) {
            o = t
        }, l.hide = function () {
            return i.hide()
        }, l.show = function () {
            return i.show()
        }, l.on = function (t, e) {
            return i.addEvent(t, e)
        }, l.one = function (t, e) {
            return i.addEvent(t, e, !0)
        }, i.construct.apply(l, [e]), !0, l
    }
},
mPortlet = function (t, e) {
    var s = this,
        d = mUtil.get(t),
        c = mUtil.get("body");
    if (d) {
        var a = {
                bodyToggleSpeed: 400,
                tooltips: !0,
                tools: {
                    toggle: {
                        collapse: "Collapse",
                        expand: "Expand"
                    },
                    reload: "Reload",
                    remove: "Remove",
                    fullscreen: {
                        on: "Fullscreen",
                        off: "Exit Fullscreen"
                    }
                }
            },
            o = {
                construct: function (t) {
                    return mUtil.data(d).has("portlet") ? s = mUtil.data(d).get("portlet") : (o.init(t), o.build(), mUtil.data(d).set("portlet", s)), s
                },
                init: function (t) {
                    s.element = d, s.events = [], s.options = mUtil.deepExtend({}, a, t), s.head = mUtil.child(d, ".m-portlet__head"), s.foot = mUtil.child(d, ".m-portlet__foot"), mUtil.child(d, ".m-portlet__body") ? s.body = mUtil.child(d, ".m-portlet__body") : 0 !== mUtil.child(d, ".m-form").length && (s.body = mUtil.child(d, ".m-form"))
                },
                build: function () {
                    var t = mUtil.find(s.head, "[m-portlet-tool=remove]");
                    t && mUtil.addEvent(t, "click", function (t) {
                        t.preventDefault(), o.remove()
                    });
                    var e = mUtil.find(s.head, "[m-portlet-tool=reload]");
                    e && mUtil.addEvent(e, "click", function (t) {
                        t.preventDefault(), o.reload()
                    });
                    var a = mUtil.find(s.head, "[m-portlet-tool=toggle]");
                    a && mUtil.addEvent(a, "click", function (t) {
                        t.preventDefault(), o.toggle()
                    });
                    var n = mUtil.find(s.head, "[m-portlet-tool=fullscreen]");
                    n && mUtil.addEvent(n, "click", function (t) {
                        t.preventDefault(), o.fullscreen()
                    }), o.setupTooltips()
                },
                remove: function () {
                    !1 !== o.eventTrigger("beforeRemove") && (mUtil.hasClass(c, "m-portlet--fullscreen") && mUtil.hasClass(d, "m-portlet--fullscreen") && o.fullscreen("off"), o.removeTooltips(), mUtil.remove(d), o.eventTrigger("afterRemove"))
                },
                setContent: function (t) {
                    t && (s.body.innerHTML = t)
                },
                getBody: function () {
                    return s.body
                },
                getSelf: function () {
                    return d
                },
                setupTooltips: function () {
                    if (s.options.tooltips) {
                        var t = mUtil.hasClass(d, "m-portlet--collapse") || mUtil.hasClass(d, "m-portlet--collapsed"),
                            e = mUtil.hasClass(c, "m-portlet--fullscreen") && mUtil.hasClass(d, "m-portlet--fullscreen"),
                            a = mUtil.find(s.head, "[m-portlet-tool=remove]");
                        if (a) {
                            var n = e ? "bottom" : "top",
                                o = new Tooltip(a, {
                                    title: s.options.tools.remove,
                                    placement: n,
                                    offset: e ? "0,10px,0,0" : "0,5px",
                                    trigger: "hover",
                                    template: '<div class="m-tooltip m-tooltip--portlet tooltip bs-tooltip-' + n + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'
                                });
                            mUtil.data(a).set("tooltip", o)
                        }
                        var i = mUtil.find(s.head, "[m-portlet-tool=reload]");
                        if (i) {
                            n = e ? "bottom" : "top", o = new Tooltip(i, {
                                title: s.options.tools.reload,
                                placement: n,
                                offset: e ? "0,10px,0,0" : "0,5px",
                                trigger: "hover",
                                template: '<div class="m-tooltip m-tooltip--portlet tooltip bs-tooltip-' + n + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'
                            });
                            mUtil.data(i).set("tooltip", o)
                        }
                        var l = mUtil.find(s.head, "[m-portlet-tool=toggle]");
                        if (l) {
                            n = e ? "bottom" : "top", o = new Tooltip(l, {
                                title: t ? s.options.tools.toggle.expand : s.options.tools.toggle.collapse,
                                placement: n,
                                offset: e ? "0,10px,0,0" : "0,5px",
                                trigger: "hover",
                                template: '<div class="m-tooltip m-tooltip--portlet tooltip bs-tooltip-' + n + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'
                            });
                            mUtil.data(l).set("tooltip", o)
                        }
                        var r = mUtil.find(s.head, "[m-portlet-tool=fullscreen]");
                        if (r) {
                            n = e ? "bottom" : "top", o = new Tooltip(r, {
                                title: e ? s.options.tools.fullscreen.off : s.options.tools.fullscreen.on,
                                placement: n,
                                offset: e ? "0,10px,0,0" : "0,5px",
                                trigger: "hover",
                                template: '<div class="m-tooltip m-tooltip--portlet tooltip bs-tooltip-' + n + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'
                            });
                            mUtil.data(r).set("tooltip", o)
                        }
                    }
                },
                removeTooltips: function () {
                    if (s.options.tooltips) {
                        var t = mUtil.find(s.head, "[m-portlet-tool=remove]");
                        t && mUtil.data(t).has("tooltip") && mUtil.data(t).get("tooltip").dispose();
                        var e = mUtil.find(s.head, "[m-portlet-tool=reload]");
                        e && mUtil.data(e).has("tooltip") && mUtil.data(e).get("tooltip").dispose();
                        var a = mUtil.find(s.head, "[m-portlet-tool=toggle]");
                        a && mUtil.data(a).has("tooltip") && mUtil.data(a).get("tooltip").dispose();
                        var n = mUtil.find(s.head, "[m-portlet-tool=fullscreen]");
                        n && mUtil.data(n).has("tooltip") && mUtil.data(n).get("tooltip").dispose()
                    }
                },
                reload: function () {
                    o.eventTrigger("reload")
                },
                toggle: function () {
                    mUtil.hasClass(d, "m-portlet--collapse") || mUtil.hasClass(d, "m-portlet--collapsed") ? o.expand() : o.collapse()
                },
                collapse: function () {
                    if (!1 !== o.eventTrigger("beforeCollapse")) {
                        mUtil.slideUp(s.body, s.options.bodyToggleSpeed, function () {
                            o.eventTrigger("afterCollapse")
                        }), mUtil.addClass(d, "m-portlet--collapse");
                        var t = mUtil.find(s.head, "[m-portlet-tool=toggle]");
                        t && mUtil.data(t).has("tooltip") && mUtil.data(t).get("tooltip").updateTitleContent(s.options.tools.toggle.expand)
                    }
                },
                expand: function () {
                    if (!1 !== o.eventTrigger("beforeExpand")) {
                        mUtil.slideDown(s.body, s.options.bodyToggleSpeed, function () {
                            o.eventTrigger("afterExpand")
                        }), mUtil.removeClass(d, "m-portlet--collapse"), mUtil.removeClass(d, "m-portlet--collapsed");
                        var t = mUtil.find(s.head, "[m-portlet-tool=toggle]");
                        t && mUtil.data(t).has("tooltip") && mUtil.data(t).get("tooltip").updateTitleContent(s.options.tools.toggle.collapse)
                    }
                },
                fullscreen: function (t) {
                    if ("off" === t || mUtil.hasClass(c, "m-portlet--fullscreen") && mUtil.hasClass(d, "m-portlet--fullscreen")) o.eventTrigger("beforeFullscreenOff"), mUtil.removeClass(c, "m-portlet--fullscreen"), mUtil.removeClass(d, "m-portlet--fullscreen"), o.removeTooltips(), o.setupTooltips(), s.foot && (mUtil.css(s.body, "margin-bottom", ""), mUtil.css(s.foot, "margin-top", "")), o.eventTrigger("afterFullscreenOff");
                    else {
                        if (o.eventTrigger("beforeFullscreenOn"), mUtil.addClass(d, "m-portlet--fullscreen"), mUtil.addClass(c, "m-portlet--fullscreen"), o.removeTooltips(), o.setupTooltips(), s.foot) {
                            var e = parseInt(mUtil.css(s.foot, "height")),
                                a = parseInt(mUtil.css(s.foot, "height")) + parseInt(mUtil.css(s.head, "height"));
                            mUtil.css(s.body, "margin-bottom", e + "px"), mUtil.css(s.foot, "margin-top", "-" + a + "px")
                        }
                        o.eventTrigger("afterFullscreenOn")
                    }
                },
                eventTrigger: function (t) {
                    for (i = 0; i < s.events.length; i++) {
                        var e = s.events[i];
                        e.name == t && (1 == e.one ? 0 == e.fired && (s.events[i].fired = !0, e.handler.call(this, s)) : e.handler.call(this, s))
                    }
                },
                addEvent: function (t, e, a) {
                    return s.events.push({
                        name: t,
                        handler: e,
                        one: a,
                        fired: !1
                    }), s
                }
            };
        return s.setDefaults = function (t) {
            a = t
        }, s.remove = function () {
            return o.remove(html)
        }, s.reload = function () {
            return o.reload()
        }, s.setContent = function (t) {
            return o.setContent(t)
        }, s.toggle = function () {
            return o.toggle()
        }, s.collapse = function () {
            return o.collapse()
        }, s.expand = function () {
            return o.expand()
        }, s.fullscreen = function () {
            return o.fullscreen("on")
        }, s.unFullscreen = function () {
            return o.fullscreen("off")
        }, s.getBody = function () {
            return o.getBody()
        }, s.getSelf = function () {
            return o.getSelf()
        }, s.on = function (t, e) {
            return o.addEvent(t, e)
        }, s.one = function (t, e) {
            return o.addEvent(t, e, !0)
        }, o.construct.apply(s, [e]), s
    }
},
mQuicksearch = function (t, e) {
    var n = this,
        a = mUtil.get(t),
        o = mUtil.get("body");
    if (a) {
        var l = {
                mode: "default",
                minLength: 1,
                maxHeight: 300,
                requestTimeout: 200,
                inputTarget: "m_quicksearch_input",
                iconCloseTarget: "m_quicksearch_close",
                iconCancelTarget: "m_quicksearch_cancel",
                iconSearchTarget: "m_quicksearch_search",
                spinnerClass: "m-loader m-loader--skin-light m-loader--right",
                hasResultClass: "m-list-search--has-result",
                templates: {
                    error: '<div class="m-search-results m-search-results--skin-light"><span class="m-search-result__message">{{message}}</div></div>'
                }
            },
            r = {
                construct: function (t) {
                    return mUtil.data(a).has("quicksearch") ? n = mUtil.data(a).get("quicksearch") : (r.init(t), r.build(), mUtil.data(a).set("quicksearch", n)), n
                },
                init: function (t) {
                    n.element = a, n.events = [], n.options = mUtil.deepExtend({}, l, t), n.query = "", n.form = mUtil.find(a, "form"), n.input = mUtil.get(n.options.inputTarget), n.iconClose = mUtil.get(n.options.iconCloseTarget), "default" == n.options.mode && (n.iconSearch = mUtil.get(n.options.iconSearchTarget), n.iconCancel = mUtil.get(n.options.iconCancelTarget)), n.dropdown = new mDropdown(a, {
                        mobileOverlay: !1
                    }), n.cancelTimeout, n.processing = !1, n.requestTimeout = !1
                },
                build: function () {
                    mUtil.addEvent(n.input, "keyup", r.search), "default" == n.options.mode ? (mUtil.addEvent(n.input, "focus", r.showDropdown), mUtil.addEvent(n.iconCancel, "click", r.handleCancel), mUtil.addEvent(n.iconSearch, "click", function () {
                        mUtil.isInResponsiveRange("tablet-and-mobile") && (mUtil.addClass(o, "m-header-search--mobile-expanded"), n.input.focus())
                    }), mUtil.addEvent(n.iconClose, "click", function () {
                        mUtil.isInResponsiveRange("tablet-and-mobile") && (mUtil.removeClass(o, "m-header-search--mobile-expanded"), r.closeDropdown())
                    })) : "dropdown" == n.options.mode && (n.dropdown.on("afterShow", function () {
                        n.input.focus()
                    }), mUtil.addEvent(n.iconClose, "click", r.closeDropdown))
                },
                showProgress: function () {
                    return n.processing = !0, mUtil.addClass(n.form, n.options.spinnerClass), r.handleCancelIconVisibility("off"), n
                },
                hideProgress: function () {
                    return n.processing = !1, mUtil.removeClass(n.form, n.options.spinnerClass), r.handleCancelIconVisibility("on"), mUtil.addClass(a, n.options.hasResultClass), n
                },
                search: function (t) {
                    if (n.query = n.input.value, 0 === n.query.length && (r.handleCancelIconVisibility("on"), mUtil.removeClass(a, n.options.hasResultClass), mUtil.removeClass(n.form, n.options.spinnerClass)), !(n.query.length < n.options.minLength || 1 == n.processing)) return n.requestTimeout && clearTimeout(n.requestTimeout), n.requestTimeout = !1, n.requestTimeout = setTimeout(function () {
                        r.eventTrigger("search")
                    }, n.options.requestTimeout), n
                },
                handleCancelIconVisibility: function (t) {
                    "on" == t ? 0 === n.input.value.length ? (n.iconCancel && mUtil.css(n.iconCancel, "visibility", "hidden"), n.iconClose && mUtil.css(n.iconClose, "visibility", "visible")) : (clearTimeout(n.cancelTimeout), n.cancelTimeout = setTimeout(function () {
                        n.iconCancel && mUtil.css(n.iconCancel, "visibility", "visible"), n.iconClose && mUtil.css(n.iconClose, "visibility", "visible")
                    }, 500)) : (n.iconCancel && mUtil.css(n.iconCancel, "visibility", "hidden"), n.iconClose && mUtil.css(n.iconClose, "visibility", "hidden"))
                },
                handleCancel: function (t) {
                    n.input.value = "", mUtil.css(n.iconCancel, "visibility", "hidden"), mUtil.removeClass(a, n.options.hasResultClass), r.closeDropdown()
                },
                closeDropdown: function () {
                    n.dropdown.hide()
                },
                showDropdown: function (t) {
                    0 == n.dropdown.isShown() && n.input.value.length > n.options.minLength && 0 == n.processing && (console.log("show!!!"), n.dropdown.show(), t && (t.preventDefault(), t.stopPropagation()))
                },
                eventTrigger: function (t) {
                    for (i = 0; i < n.events.length; i++) {
                        var e = n.events[i];
                        e.name == t && (1 == e.one ? 0 == e.fired && (n.events[i].fired = !0, e.handler.call(this, n)) : e.handler.call(this, n))
                    }
                },
                addEvent: function (t, e, a) {
                    return n.events.push({
                        name: t,
                        handler: e,
                        one: a,
                        fired: !1
                    }), n
                }
            };
        return n.setDefaults = function (t) {
            l = t
        }, n.search = function () {
            return r.handleSearch()
        }, n.showResult = function (t) {
            return n.dropdown.setContent(t), r.showDropdown(), n
        }, n.showError = function (t) {
            var e = n.options.templates.error.replace("{{message}}", t);
            return n.dropdown.setContent(e), r.showDropdown(), n
        }, n.showProgress = function () {
            return r.showProgress()
        }, n.hideProgress = function () {
            return r.hideProgress()
        }, n.search = function () {
            return r.search()
        }, n.on = function (t, e) {
            return r.addEvent(t, e)
        }, n.one = function (t, e) {
            return r.addEvent(t, e, !0)
        }, r.construct.apply(n, [e]), n
    }
},
mScrollTop = function (t, e) {
    var o = this,
        a = mUtil.get(t),
        n = mUtil.get("body");
    if (a) {
        var i = {
                offset: 300,
                speed: 600
            },
            l = {
                construct: function (t) {
                    return mUtil.data(a).has("scrolltop") ? o = mUtil.data(a).get("scrolltop") : (l.init(t), l.build(), mUtil.data(a).set("scrolltop", o)), o
                },
                init: function (t) {
                    o.events = [], o.options = mUtil.deepExtend({}, i, t)
                },
                build: function () {
                    navigator.userAgent.match(/iPhone|iPad|iPod/i) ? (window.addEventListener("touchend", function () {
                        l.handle()
                    }), window.addEventListener("touchcancel", function () {
                        l.handle()
                    }), window.addEventListener("touchleave", function () {
                        l.handle()
                    })) : window.addEventListener("scroll", function () {
                        l.handle()
                    }), mUtil.addEvent(a, "click", l.scroll)
                },
                handle: function () {
                    window.pageYOffset > o.options.offset ? mUtil.addClass(n, "m-scroll-top--shown") : mUtil.removeClass(n, "m-scroll-top--shown")
                },
                scroll: function (t) {
                    t.preventDefault(), mUtil.scrollTop(o.options.speed)
                },
                eventTrigger: function (t, e) {
                    for (var a = 0; a < o.events.length; a++) {
                        var n = o.events[a];
                        n.name == t && (1 == n.one ? 0 == n.fired && (o.events[a].fired = !0, n.handler.call(this, o, e)) : n.handler.call(this, o, e))
                    }
                },
                addEvent: function (t, e, a) {
                    o.events.push({
                        name: t,
                        handler: e,
                        one: a,
                        fired: !1
                    })
                }
            };
        return o.setDefaults = function (t) {
            i = t
        }, o.on = function (t, e) {
            return l.addEvent(t, e)
        }, o.one = function (t, e) {
            return l.addEvent(t, e, !0)
        }, l.construct.apply(o, [e]), !0, o
    }
},
mToggle = function (t, e) {
    var n = this,
        a = mUtil.get(t);
    mUtil.get("body");
    if (a) {
        var o = {
                togglerState: "",
                targetState: ""
            },
            l = {
                construct: function (t) {
                    return mUtil.data(a).has("toggle") ? n = mUtil.data(a).get("toggle") : (l.init(t), l.build(), mUtil.data(a).set("toggle", n)), n
                },
                init: function (t) {
                    n.element = a, n.events = [], n.options = mUtil.deepExtend({}, o, t), n.target = mUtil.get(n.options.target), n.targetState = n.options.targetState, n.togglerState = n.options.togglerState, n.state = mUtil.hasClasses(n.target, n.targetState) ? "on" : "off"
                },
                build: function () {
                    mUtil.addEvent(a, "mouseup", l.toggle)
                },
                toggle: function () {
                    return "off" == n.state ? l.toggleOn() : l.toggleOff(), n
                },
                toggleOn: function () {
                    return l.eventTrigger("beforeOn"), mUtil.addClass(n.target, n.targetState), n.togglerState && mUtil.addClass(a, n.togglerState), n.state = "on", l.eventTrigger("afterOn"), l.eventTrigger("toggle"), n
                },
                toggleOff: function () {
                    return l.eventTrigger("beforeOff"), mUtil.removeClass(n.target, n.targetState), n.togglerState && mUtil.removeClass(a, n.togglerState), n.state = "off", l.eventTrigger("afterOff"), l.eventTrigger("toggle"), n
                },
                eventTrigger: function (t) {
                    for (i = 0; i < n.events.length; i++) {
                        var e = n.events[i];
                        e.name == t && (1 == e.one ? 0 == e.fired && (n.events[i].fired = !0, e.handler.call(this, n)) : e.handler.call(this, n))
                    }
                },
                addEvent: function (t, e, a) {
                    return n.events.push({
                        name: t,
                        handler: e,
                        one: a,
                        fired: !1
                    }), n
                }
            };
        return n.setDefaults = function (t) {
            o = t
        }, n.getState = function () {
            return n.state
        }, n.toggle = function () {
            return l.toggle()
        }, n.toggleOn = function () {
            return l.toggleOn()
        }, n.toggle = function () {
            return l.toggleOff()
        }, n.on = function (t, e) {
            return l.addEvent(t, e)
        }, n.one = function (t, e) {
            return l.addEvent(t, e, !0)
        }, l.construct.apply(n, [e]), n
    }
},
mWizard = function (t, e) {
    var l = this,
        o = mUtil.get(t);
    mUtil.get("body");
    if (o) {
        var a = {
                startStep: 1,
                manualStepForward: !1
            },
            r = {
                construct: function (t) {
                    return mUtil.data(o).has("wizard") ? l = mUtil.data(o).get("wizard") : (r.init(t), r.build(), mUtil.data(o).set("wizard", l)), l
                },
                init: function (t) {
                    l.element = o, l.events = [], l.options = mUtil.deepExtend({}, a, t), l.steps = mUtil.findAll(o, ".m-wizard__step"), l.progress = mUtil.find(o, ".m-wizard__progress .progress-bar"), l.btnSubmit = mUtil.find(o, '[data-wizard-action="submit"]'), l.btnNext = mUtil.find(o, '[data-wizard-action="next"]'), l.btnPrev = mUtil.find(o, '[data-wizard-action="prev"]'), l.btnLast = mUtil.find(o, '[data-wizard-action="last"]'), l.btnFirst = mUtil.find(o, '[data-wizard-action="first"]'), l.events = [], l.currentStep = 1, l.stop = !1, l.totalSteps = l.steps.length, 1 < l.options.startStep && r.goTo(l.options.startStep), r.updateUI()
                },
                build: function () {
                    mUtil.addEvent(l.btnNext, "click", function (t) {
                        t.preventDefault(), r.goNext()
                    }), mUtil.addEvent(l.btnPrev, "click", function (t) {
                        t.preventDefault(), r.goPrev()
                    }), mUtil.addEvent(l.btnFirst, "click", function (t) {
                        t.preventDefault(), r.goFirst()
                    }), mUtil.addEvent(l.btnLast, "click", function (t) {
                        t.preventDefault(), r.goLast()
                    }), mUtil.on(o, ".m-wizard__step a.m-wizard__step-number", "click", function () {
                        for (var t, e = this.closest(".m-wizard__step"), a = mUtil.parents(this, ".m-wizard__steps"), n = mUtil.findAll(a, ".m-wizard__step"), o = 0, i = n.length; o < i; o++)
                            if (e === n[o]) {
                                t = o + 1;
                                break
                            } t && (!1 === l.options.manualStepForward ? t < l.currentStep && r.goTo(t) : r.goTo(t))
                    })
                },
                goTo: function (t) {
                    if (t !== l.currentStep) {
                        var e;
                        if (e = (t = t ? parseInt(t) : r.getNextStep()) > l.currentStep ? r.eventTrigger("beforeNext") : r.eventTrigger("beforePrev"), !0 !== l.stop) return !1 !== e && (l.currentStep = t, r.updateUI(), r.eventTrigger("change")), t > l.startStep ? r.eventTrigger("afterNext") : r.eventTrigger("afterPrev"), l;
                        l.stop = !1
                    }
                },
                setStepClass: function () {
                    r.isLastStep() ? mUtil.addClass(o, "m-wizard--step-last") : mUtil.removeClass(o, "m-wizard--step-last"), r.isFirstStep() ? mUtil.addClass(o, "m-wizard--step-first") : mUtil.removeClass(o, "m-wizard--step-first"), r.isBetweenStep() ? mUtil.addClass(o, "m-wizard--step-between") : mUtil.removeClass(o, "m-wizard--step-between")
                },
                updateUI: function (t) {
                    r.updateProgress(), r.handleTarget(), r.setStepClass();
                    for (var e = 0, a = l.steps.length; e < a; e++) mUtil.removeClass(l.steps[e], "m-wizard__step--current m-wizard__step--done");
                    for (e = 1; e < l.currentStep; e++) mUtil.addClass(l.steps[e - 1], "m-wizard__step--done");
                    mUtil.addClass(l.steps[l.currentStep - 1], "m-wizard__step--current")
                },
                stop: function () {
                    l.stop = !0
                },
                start: function () {
                    l.stop = !1
                },
                isLastStep: function () {
                    return l.currentStep === l.totalSteps
                },
                isFirstStep: function () {
                    return 1 === l.currentStep
                },
                isBetweenStep: function () {
                    return !1 === r.isLastStep() && !1 === r.isFirstStep()
                },
                goNext: function () {
                    return r.goTo(r.getNextStep())
                },
                goPrev: function () {
                    return r.goTo(r.getPrevStep())
                },
                goLast: function () {
                    return r.goTo(l.totalSteps)
                },
                goFirst: function () {
                    return r.goTo(1)
                },
                updateProgress: function () {
                    if (l.progress)
                        if (mUtil.hasClass(o, "m-wizard--1")) {
                            var t = l.currentStep / l.totalSteps * 100,
                                e = mUtil.find(o, ".m-wizard__step-number"),
                                a = parseInt(mUtil.css(e, "width"));
                            mUtil.css(l.progress, "width", "calc(" + t + "% + " + a / 2 + "px)")
                        } else if (mUtil.hasClass(o, "m-wizard--2")) {
                        l.currentStep;
                        var n = (l.currentStep - 1) * (1 / (l.totalSteps - 1) * 100);
                        mUtil.isInResponsiveRange("minimal-desktop-and-below") ? mUtil.css(l.progress, "height", n + "%") : mUtil.css(l.progress, "width", n + "%")
                    } else {
                        t = l.currentStep / l.totalSteps * 100;
                        mUtil.css(l.progress, "width", t + "%")
                    }
                },
                handleTarget: function () {
                    var t = l.steps[l.currentStep - 1],
                        e = mUtil.get(mUtil.attr(t, "m-wizard-target")),
                        a = mUtil.find(o, ".m-wizard__form-step--current");
                    mUtil.removeClass(a, "m-wizard__form-step--current"), mUtil.addClass(e, "m-wizard__form-step--current")
                },
                getNextStep: function () {
                    return l.totalSteps >= l.currentStep + 1 ? l.currentStep + 1 : l.totalSteps
                },
                getPrevStep: function () {
                    return 1 <= l.currentStep - 1 ? l.currentStep - 1 : 1
                },
                eventTrigger: function (t) {
                    for (i = 0; i < l.events.length; i++) {
                        var e = l.events[i];
                        e.name == t && (1 == e.one ? 0 == e.fired && (l.events[i].fired = !0, e.handler.call(this, l)) : e.handler.call(this, l))
                    }
                },
                addEvent: function (t, e, a) {
                    return l.events.push({
                        name: t,
                        handler: e,
                        one: a,
                        fired: !1
                    }), l
                }
            };
        return l.setDefaults = function (t) {
            a = t
        }, l.goNext = function () {
            return r.goNext()
        }, l.goPrev = function () {
            return r.goPrev()
        }, l.goLast = function () {
            return r.goLast()
        }, l.stop = function () {
            return r.stop()
        }, l.start = function () {
            return r.start()
        }, l.goFirst = function () {
            return r.goFirst()
        }, l.goTo = function (t) {
            return r.goTo(t)
        }, l.getStep = function () {
            return l.currentStep
        }, l.isLastStep = function () {
            return r.isLastStep()
        }, l.isFirstStep = function () {
            return r.isFirstStep()
        }, l.on = function (t, e) {
            return r.addEvent(t, e)
        }, l.one = function (t, e) {
            return r.addEvent(t, e, !0)
        }, r.construct.apply(l, [e]), l
    }
};
$.notifyDefaults({
    template: '<div data-notify="container" class="alert alert-{0} m-alert" role="alert"><button type="button" aria-hidden="true" class="close" data-notify="dismiss"></button><span data-notify="icon"></span><span data-notify="title">{1}</span><span data-notify="message">{2}</span><div class="progress" data-notify="progressbar"><div class="progress-bar progress-bar-animated bg-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div></div><a href="{3}" target="{4}" data-notify="url"></a></div>'
}), swal.setDefaults({
    width: 400,
    padding: "2.5rem",
    buttonsStyling: !1,
    confirmButtonClass: "btn btn-success m-btn m-btn--custom",
    confirmButtonColor: null,
    cancelButtonClass: "btn btn-secondary m-btn m-btn--custom",
    cancelButtonColor: null
}), Chart.elements.Rectangle.prototype.draw = function () {
    var t, e, a, n, o, i, l, r = this._chart.ctx,
        s = this._view,
        d = s.borderWidth,
        c = this._chart.options.barRadius ? this._chart.options.barRadius : 0;
    if (s.horizontal ? (t = s.base, e = s.x, a = s.y - s.height / 2, n = s.y + s.height / 2, o = t < e ? 1 : -1, i = 1, l = s.borderSkipped || "left") : (t = s.x - s.width / 2, e = s.x + s.width / 2, o = 1, i = (a = s.y > 2 * c ? s.y - c : s.y) < (n = s.base) ? 1 : -1, l = s.borderSkipped || "bottom"), d) {
        var m = Math.min(Math.abs(t - e), Math.abs(a - n)),
            u = (d = m < d ? m : d) / 2,
            p = t + ("left" !== l ? u * o : 0),
            f = e + ("right" !== l ? -u * o : 0),
            g = a + ("top" !== l ? u * i : 0),
            h = n + ("bottom" !== l ? -u * i : 0);
        p !== f && (a = g, n = h), g !== h && (t = p, e = f)
    }
    r.beginPath(), r.fillStyle = s.backgroundColor, r.strokeStyle = s.borderColor, r.lineWidth = d;
    var b = [
            [t, n],
            [t, a],
            [e, a],
            [e, n]
        ],
        v = ["bottom", "left", "top", "right"].indexOf(l, 0);

    function _(t) {
        return b[(v + t) % 4]
    } - 1 === v && (v = 0);
    var w = _(0);
    r.moveTo(w[0], w[1]);
    for (var U = 1; U < 4; U++) {
        var C;
        w = _(U), nextCornerId = U + 1, 4 == nextCornerId && (nextCornerId = 0), nextCorner = _(nextCornerId), width = b[2][0] - b[1][0], height = b[0][1] - b[1][1], x = b[1][0], y = b[1][1], (C = c) > height / 2 && (C = height / 2), C > width / 2 && (C = width / 2), r.moveTo(x + C, y), r.lineTo(x + width - C, y), r.quadraticCurveTo(x + width, y, x + width, y + C), r.lineTo(x + width, y + height - C), r.quadraticCurveTo(x + width, y + height, x + width - C, y + height), r.lineTo(x + C, y + height), r.quadraticCurveTo(x, y + height, x, y + height - C), r.lineTo(x, y + C), r.quadraticCurveTo(x, y, x + C, y)
    }
    r.fill(), d && r.stroke()
}, $.fn.markdown.defaults.iconlibrary = "fa", $.fn.timepicker.defaults = $.extend(!0, {}, $.fn.timepicker.defaults, {
    icons: {
        up: "la la-angle-up",
        down: "la la-angle-down"
    }
}), jQuery.validator.setDefaults({
    errorElement: "div",
    errorClass: "form-control-feedback",
    focusInvalid: !1,
    ignore: "",
    errorPlacement: function (t, e) {
        var a = 0 < $(e).closest(".m-form__group-sub").length ? $(e).closest(".m-form__group-sub") : $(e).closest(".m-form__group"),
            n = a.find(".m-form__help");
        0 === a.find(".form-control-feedback").length && (0 < n.length ? n.before(t) : 0 < $(e).closest(".input-group").length ? $(e).closest(".input-group").after(t) : $(e).is(":checkbox") ? $(e).closest(".m-checkbox").find(">span").after(t) : $(e).after(t))
    },
    highlight: function (t) {
        (0 < $(t).closest(".m-form__group-sub").length ? $(t).closest(".m-form__group-sub") : $(t).closest(".m-form__group")).addClass("has-danger")
    },
    unhighlight: function (t) {
        (0 < $(t).closest(".m-form__group-sub").length ? $(t).closest(".m-form__group-sub") : $(t).closest(".m-form__group")).removeClass("has-danger")
    },
    success: function (t, e) {
        var a = 0 < $(t).closest(".m-form__group-sub").length ? $(t).closest(".m-form__group-sub") : $(t).closest(".m-form__group");
        a.removeClass("has-danger"), a.find(".form-control-feedback").remove()
    }
}), jQuery.validator.addMethod("email", function (t, e) {
    return !!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(t)
}, "Please enter a valid Email."),
function (l) {
    l.fn.mDatatable = l.fn.mDatatable || {}, l.fn.mDatatable.checkbox = function (n, o) {
        var i = {
            selectedAllRows: !1,
            selectedRows: [],
            unselectedRows: [],
            init: function () {
                i.selectorEnabled() && (o.vars.requestIds && n.setDataSourceParam(o.vars.requestIds, !0), i.selectedAllRows = n.getDataSourceParam(o.vars.selectedAllRows), l(n).on("m-datatable--on-layout-updated", function (t, e) {
                    e.table == l(n.wrap).attr("id") && n.ready(function () {
                        i.initVars(), i.initEvent(), i.initSelect()
                    })
                }))
            },
            initEvent: function () {
                l(n.tableHead).find('.m-checkbox--all > [type="checkbox"]').click(function (t) {
                    if (i.selectedRows = i.unselectedRows = [], n.stateRemove("checkbox"), l(this).is(":checked") ? i.selectedAllRows = !0 : i.selectedAllRows = !1, !o.vars.requestIds) {
                        l(this).is(":checked") && (i.selectedRows = l.makeArray(l(n.tableBody).find('.m-checkbox--single > [type="checkbox"]').map(function (t, e) {
                            return l(e).val()
                        })));
                        var e = {};
                        e.selectedRows = l.unique(i.selectedRows), n.stateKeep("checkbox", e)
                    }
                    n.setDataSourceParam(o.vars.selectedAllRows, i.selectedAllRows), l(n).trigger("m-datatable--on-click-checkbox", [l(this)])
                }), l(n.tableBody).find('.m-checkbox--single > [type="checkbox"]').click(function (t) {
                    var e = l(this).val();
                    l(this).is(":checked") ? (i.selectedRows.push(e), i.unselectedRows = i.remove(i.unselectedRows, e)) : (i.unselectedRows.push(e), i.selectedRows = i.remove(i.selectedRows, e)), !o.vars.requestIds && i.selectedRows.length < 1 && l(n.tableHead).find('.m-checkbox--all > [type="checkbox"]').prop("checked", !1);
                    var a = {};
                    a.selectedRows = l.unique(i.selectedRows), a.unselectedRows = l.unique(i.unselectedRows), n.stateKeep("checkbox", a), l(n).trigger("m-datatable--on-click-checkbox", [l(this)])
                })
            },
            initSelect: function () {
                i.selectedAllRows && o.vars.requestIds ? (n.hasClass("m-datatable--error") || l(n.tableHead).find('.m-checkbox--all > [type="checkbox"]').prop("checked", !0), n.setActiveAll(!0), i.unselectedRows.forEach(function (t) {
                    n.setInactive(t)
                })) : (i.selectedRows.forEach(function (t) {
                    n.setActive(t)
                }), !n.hasClass("m-datatable--error") && l(n.tableBody).find('.m-checkbox--single > [type="checkbox"]').not(":checked").length < 1 && l(n.tableHead).find('.m-checkbox--all > [type="checkbox"]').prop("checked", !0))
            },
            selectorEnabled: function () {
                return l.grep(n.options.columns, function (t, e) {
                    return t.selector || !1
                })[0]
            },
            initVars: function () {
                var t = n.stateGet("checkbox");
                void 0 !== t && (i.selectedRows = t.selectedRows || [], i.unselectedRows = t.unselectedRows || [])
            },
            getSelectedId: function (t) {
                if (i.initVars(), i.selectedAllRows && o.vars.requestIds) {
                    void 0 === t && (t = o.vars.rowIds);
                    var e = n.getObject(t, n.lastResponse) || [];
                    return 0 < e.length && i.unselectedRows.forEach(function (t) {
                        e = i.remove(e, parseInt(t))
                    }), e
                }
                return i.selectedRows
            },
            remove: function (t, e) {
                return t.filter(function (t) {
                    return t !== e
                })
            }
        };
        return n.checkbox = function () {
            return i
        }, "object" == typeof o && (o = l.extend(!0, {}, l.fn.mDatatable.checkbox.default, o), i.init.apply(this, [o])), n
    }, l.fn.mDatatable.checkbox.default = {
        vars: {
            selectedAllRows: "selectedAllRows",
            requestIds: "requestIds",
            rowIds: "meta.rowIds"
        }
    }
}(jQuery);
var mLayout = function () {
var n, o, a, i, l, r = function () {
    0 !== $("#m_aside_left_hide_toggle").length && (r = new mToggle("m_aside_left_hide_toggle", {
        target: "body",
        targetState: "m-aside-left--hide",
        togglerState: "m-brand__toggler--active"
    })).on("toggle", function (t) {
        n.pauseDropdownHover(800), o.pauseDropdownHover(800), Cookies.set("sidebar_hide_state", t.getState())
    })
};
return {
    init: function () {
        this.initHeader(), this.initAside()
    },
    initHeader: function () {
        var t, e, a;
        e = mUtil.get("m_header"), a = {
            offset: {},
            minimize: {}
        }, "hide" == mUtil.attr(e, "m-minimize-mobile") ? (a.minimize.mobile = {}, a.minimize.mobile.on = "m-header--hide", a.minimize.mobile.off = "m-header--show") : a.minimize.mobile = !1, "hide" == mUtil.attr(e, "m-minimize") ? (a.minimize.desktop = {}, a.minimize.desktop.on = "m-header--hide", a.minimize.desktop.off = "m-header--show") : a.minimize.desktop = !1, (t = mUtil.attr(e, "m-minimize-offset")) && (a.offset.desktop = t), (t = mUtil.attr(e, "m-minimize-mobile-offset")) && (a.offset.mobile = t), new mHeader("m_header", a), i = new mOffcanvas("m_header_menu", {
            overlay: !0,
            baseClass: "m-aside-header-menu-mobile",
            closeBy: "m_aside_header_menu_mobile_close_btn",
            toggleBy: {
                target: "m_aside_header_menu_mobile_toggle",
                state: "m-brand__toggler--active"
            }
        }), n = new mMenu("m_header_menu", {
            submenu: {
                desktop: "dropdown",
                tablet: "accordion",
                mobile: "accordion"
            },
            accordion: {
                slideSpeed: 200,
                autoScroll: !0,
                expandAll: !1
            }
        }), $("#m_aside_header_topbar_mobile_toggle").click(function () {
            $("body").toggleClass("m-topbar--on")
        }), setInterval(function () {
            $("#m_topbar_notification_icon .m-nav__link-icon").addClass("m-animate-shake"), $("#m_topbar_notification_icon .m-nav__link-badge").addClass("m-animate-blink")
        }, 3e3), setInterval(function () {
            $("#m_topbar_notification_icon .m-nav__link-icon").removeClass("m-animate-shake"), $("#m_topbar_notification_icon .m-nav__link-badge").removeClass("m-animate-blink")
        }, 6e3), 0 !== $("#m_quicksearch").length && new mQuicksearch("m_quicksearch", {
            mode: mUtil.attr("m_quicksearch", "m-quicksearch-mode"),
            minLength: 1
        }).on("search", function (e) {
            e.showProgress(), $.ajax({
                url: "https://keenthemes.com/metronic/preview/inc/api/quick_search.php",
                data: {
                    query: e.query
                },
                dataType: "html",
                success: function (t) {
                    e.hideProgress(), e.showResult(t)
                },
                error: function (t) {
                    e.hideProgress(), e.showError("Connection error. Pleae try again later.")
                }
            })
        }), new mScrollTop("m_scroll_top", {
            offset: 300,
            speed: 600
        })
    },
    initAside: function () {
        var t, e;
        t = mUtil.get("m_aside_left"), e = mUtil.hasClass(t, "m-aside-left--offcanvas-default") ? "m-aside-left--offcanvas-default" : "m-aside-left", a = new mOffcanvas("m_aside_left", {
                baseClass: e,
                overlay: !0,
                closeBy: "m_aside_left_close_btn",
                toggleBy: {
                    target: "m_aside_left_offcanvas_toggle",
                    state: "m-brand__toggler--active"
                }
            }),
            function () {
                var t = $("#m_ver_menu"),
                    e = "1" === t.data("m-menu-dropdown") ? "dropdown" : "accordion";
                if (o = new mMenu("m_ver_menu", {
                        submenu: {
                            desktop: {
                                default: e,
                                state: {
                                    body: "m-aside-left--minimize",
                                    mode: "dropdown"
                                }
                            },
                            tablet: "accordion",
                            mobile: "accordion"
                        },
                        accordion: {
                            autoScroll: !0,
                            expandAll: !1
                        }
                    }), "1" === t.attr("m-menu-scrollable")) {
                    function a(t) {
                        if (mUtil.isInResponsiveRange("tablet-and-mobile")) mApp.destroyScroller(t);
                        else {
                            var e = mUtil.getViewPort().height - parseInt(mUtil.css("m_header", "height"));
                            mApp.initScroller(t, {
                                height: e
                            })
                        }
                    }
                    a(t), mUtil.addResizeHandler(function () {
                        a(t)
                    })
                }
            }(), 0 !== $("#m_aside_left_minimize_toggle").length && (l = new mToggle("m_aside_left_minimize_toggle", {
                target: "body",
                targetState: "m-brand--minimize m-aside-left--minimize",
                togglerState: "m-brand__toggler--active"
            })).on("toggle", function (t) {
                n.pauseDropdownHover(800), o.pauseDropdownHover(800), Cookies.set("sidebar_toggle_state", t.getState())
            }), r(), this.onLeftSidebarToggle(function (t) {
                var e = $(".m-datatable");
                $(e).each(function () {
                    $(this).mDatatable("redraw")
                })
            })
    },
    getAsideMenu: function () {
        return o
    },
    onLeftSidebarToggle: function (t) {
        l && l.on("toggle", t)
    },
    closeMobileAsideMenuOffcanvas: function () {
        mUtil.isMobileDevice() && a.hide()
    },
    closeMobileHorMenuOffcanvas: function () {
        mUtil.isMobileDevice() && i.hide()
    }
}
}();
$(document).ready(function () {
!1 === mUtil.isAngularVersion() && mLayout.init()
});
var mQuickSidebar = function () {
var n = $("#m_quick_sidebar"),
    o = $("#m_quick_sidebar_tabs"),
    t = n.find(".m-quick-sidebar__content"),
    e = function () {
        ! function () {
            var e = $("#m_quick_sidebar_tabs_messenger");
            if (0 !== e.length) {
                var a = e.find(".m-messenger__messages"),
                    t = function () {
                        var t = n.outerHeight(!0) - o.outerHeight(!0) - e.find(".m-messenger__form").outerHeight(!0) - 120;
                        a.css("height", t), mApp.initScroller(a, {})
                    };
                t(), mUtil.addResizeHandler(t)
            }
        }(),
        function () {
            var e = $("#m_quick_sidebar_tabs_settings");
            if (0 !== e.length) {
                var t = function () {
                    var t = mUtil.getViewPort().height - o.outerHeight(!0) - 60;
                    e.css("height", t), mApp.initScroller(e, {})
                };
                t(), mUtil.addResizeHandler(t)
            }
        }(),
        function () {
            var e = $("#m_quick_sidebar_tabs_logs");
            if (0 !== e.length) {
                var t = function () {
                    var t = mUtil.getViewPort().height - o.outerHeight(!0) - 60;
                    e.css("height", t), mApp.initScroller(e, {})
                };
                t(), mUtil.addResizeHandler(t)
            }
        }()
    };
return {
    init: function () {
        0 !== n.length && new mOffcanvas("m_quick_sidebar", {
            overlay: !0,
            baseClass: "m-quick-sidebar",
            closeBy: "m_quick_sidebar_close",
            toggleBy: "m_quick_sidebar_toggle"
        }).one("afterShow", function () {
            mApp.block(n), setTimeout(function () {
                mApp.unblock(n), t.removeClass("m--hide"), e()
            }, 1e3)
        })
    }
}
}();
$(document).ready(function () {
mQuickSidebar.init()
});