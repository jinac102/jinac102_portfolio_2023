/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function (e) {
    "use strict";
    var n = window.NAV_JS || {};

    n.mobileMenu = {
        init: function () {
            this.toggleMenu();
            this.menuMobile();
            this.menuArrow();
        },
        toggleMenu: function () {
            e('.site-header').on('click', '.toggle-menu', function (event) {
                var ethis = e('.main-navigation .menu .menu-mobile');
                if (ethis.css('display') == 'block') {
                    ethis.slideUp('300');
                    e(".site-header").removeClass('mmenu-active');
                } else {
                    ethis.slideDown('300');
                    e(".site-header").addClass('mmenu-active');
                }
                e('.ham').toggleClass('exit');
            });
            e('.site-header .main-navigation ').on('click', '.menu-mobile a i', function (event) {
                event.preventDefault();
                var ethis = e(this),
                    eparent = ethis.closest('li'),
                    esub_menu = eparent.find('> .sub-menu');
                if (esub_menu.css('display') == 'none') {
                    esub_menu.slideDown('300');
                    ethis.addClass('active');
                } else {
                    esub_menu.slideUp('300');
                    ethis.removeClass('active');
                }
                return false;
            });
        },
        menuMobile: function () {
            if (e('.main-navigation .menu > ul').length) {
                var ethis = e('.main-navigation .menu > ul'),
                    eparent = ethis.closest('.main-navigation'),
                    pointbreak = eparent.data('epointbreak'),
                    window_width = window.innerWidth;
                if (typeof pointbreak == 'undefined') {
                    pointbreak = 991;
                }
                if (pointbreak >= window_width) {
                    ethis.addClass('menu-mobile').removeClass('menu-desktop');
                    e('.main-navigation .toggle-menu').css('display', 'block');
                } else {
                    ethis.addClass('menu-desktop').removeClass('menu-mobile').css('display', '');
                    e('.main-navigation .toggle-menu').css('display', '');
                }
            }
        },
        menuArrow: function () {
            if (e('.site-header .main-navigation div.menu > ul').length) {
                e('.site-header .main-navigation div.menu > ul .sub-menu').parent('li').find('> a').append('<i class="minimal-submenu-icon">'+minimal_blog_main.arrow_down+'</i>');
            }
        }
    };
    e(document).ready(function () {
        n.mobileMenu.init();
    });
    e(window).resize(function () {
        n.mobileMenu.menuMobile();
    });
})(jQuery);

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
    var isWebkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
        isOpera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
        isIe     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

    if ( ( isWebkit || isOpera || isIe ) && document.getElementById && window.addEventListener ) {
        window.addEventListener( 'hashchange', function() {
            var id = location.hash.substring( 1 ),
                element;

            if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
                return;
            }

            element = document.getElementById( id );

            if ( element ) {
                if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
                    element.tabIndex = -1;
                }

                element.focus();
            }
        }, false );
    }
})();


/**
 * Custom js for theme
 */
(function ($) {
    
    $(window).on('load', function () {
        $("#mini-loader").fadeOut(500);
    });

    $(document).ready(function () {

        var pageSection = $(".data-bg");

        pageSection.each(function (indx) {

            if ($(this).attr("data-background")) {

                $(this).css("background-image", "url(" + $(this).data("background") + ")");

            }

        });

        $('.background-src').each(function () {

            var src = $(this).children('img').attr('src');

            if( src ){

                $(this).css('background-image', 'url(' + src + ')').children('img').hide();

            }

        });

    });

    $(document).ready(function () {
        $(".main-slider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: true,
            autoplaySpeed: 8000,
            infinite: true,
            dots: true,
            nextArrow: "<div class='navcontrol-icon slide-next'>" + minimal_blog_main.next_svg +"</div>",
            prevArrow: "<div class='navcontrol-icon slide-prev'>" + minimal_blog_main.prev_svg +"</div>",
            easing: "linear"
        });
        $("ul.wp-block-gallery.columns-1, .wp-block-gallery.columns-1 .blocks-gallery-grid, .gallery-columns-1").each(function () {
            $(this).slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                dots: true,
                nextArrow: "<div class='navcontrol-icon slide-next'>" + minimal_blog_main.next_svg +"</div>",
                prevArrow: "<div class='navcontrol-icon slide-prev'>" + minimal_blog_main.prev_svg +"</div>",
                easing: "linear"
            });
        });
        $('.gallery, .wp-block-gallery').each(function () {
            $(this).magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300,
                    opener: function (element) {
                        return element.find('img');
                    }
                }
            });
        });
    });
    $(document).ready(function () {
        $("#scroll-top").on("click", function () {
            $("html, body").animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });
    $(document).scroll(function () {
        if ($(window).scrollTop() > $(window).height() / 2) {
            $("#scroll-top").fadeIn(300);
        } else {
            $("#scroll-top").fadeOut(300);
        }
    });
})(jQuery);