jQuery(document).ready(function ($) {
    "use strict";

    // Mouse Custom Pointer Cursors Start
    $(window).load(function () {
        $("body").addClass("page-loaded");
    });
    // Scroll To
    $(".scroll-content").click(function () {
        $('html, body').animate({
            scrollTop: $("#content").offset().top
        }, 500);
    });

    // Popup Newsletter Start
    if( Kushak_GetCookie('Kushak_Visited') == false ){

        $(window).load(function () {
            $('.twp-modal.single-load').each(function () {
                $(this).addClass('is-visible');
            });
        });

    }

    $(window).load(function () {
        $('.twp-modal.kushak-load').each(function () {
            $(this).addClass('is-visible');
        });
    });

    $('.twp-modal-toggle').on("click", function () {
        $('.twp-modal').toggleClass('is-visible');
    });

    $('.single-load .twp-modal-toggle').on("click", function () {
        $('.twp-modal').removeClass('is-visible');
        Kushak_SetCookie('Kushak_Visited', 'true',365);
    });

    // Popup Newsletter End
    // Hide Comments
    $('.kushak-no-comment .booster-block.booster-ratings-block, .kushak-no-comment .comment-form-ratings, .kushak-no-comment .twp-star-rating').hide();
    // Rating disable
    if (kushak_custom.single_post == 1 && kushak_custom.kushak_ed_post_reaction) {
        $('.tpk-single-rating').remove();
        $('.tpk-comment-rating-label').remove();
        $('.comments-rating').remove();
        $('.tpk-star-rating').remove();
    }
    // Add Class on article
    $('.twp-archive-items.post').each(function () {
        $(this).addClass('twp-article-loded');
    });
    // Aub Menu Toggle
    $('.submenu-toggle').click(function () {
        $(this).toggleClass('button-toggle-active');
        var currentClass = $(this).attr('data-toggle-target');
        $(currentClass).toggleClass('submenu-toggle-active');
    });
    // Header Search Popup End
    $('.navbar-control-search').click(function () {
        $('.header-searchbar').toggleClass('header-searchbar-active');
        $('body').addClass('body-scroll-locked');
        $('#search-closer').focus();
    });
    $('.header-searchbar').click(function () {
        $('.header-searchbar').removeClass('header-searchbar-active');
        $('body').removeClass('body-scroll-locked');
    });
    $(".header-searchbar-inner").click(function (e) {
        e.stopPropagation(); //stops click event from reaching document
    });
    // Header Search hide
    $('#search-closer').click(function () {
        $('.header-searchbar').removeClass('header-searchbar-active');
        $('body').removeClass('body-scroll-locked');
        setTimeout(function () {
            $('.navbar-control-search').focus();
        }, 300);
    });
    // Focus on search input on search icon expand
    $('.navbar-control-search').click(function () {
        setTimeout(function () {
            $('.header-searchbar .search-field').focus();
        }, 300);
    });
    $('input, a, button').on('focus', function () {
        if ($('.header-searchbar').hasClass('header-searchbar-active')) {
            if (!$(this).parents('.header-searchbar').length) {
                $('.header-searchbar .search-field').focus();
                $('.header-searchbar-area .search-field-default').focus();
            }
        }
    });
    $('.skip-link-search-start').focus(function () {
        $('#search-closer').focus();
    });
    $('.skip-link-search-end').focus(function () {
        $('.header-searchbar-area .search-field').focus();
    });
    $('.skip-link-menu-start').focus(function () {
        if (!$("#offcanvas-menu #primary-nav-offcanvas").length == 0) {
            $("#offcanvas-menu #primary-nav-offcanvas ul li:last-child a").focus();
        }
        if (!$("#offcanvas-menu #social-nav-offcanvas").length == 0) {
            $("#offcanvas-menu #social-nav-offcanvas ul li:last-child a").focus();
        }
    });
    // Action On Esc Button For Search
    $(document).keyup(function (j) {
        $('body').removeClass('body-scroll-locked');
        if (j.key === "Escape") { // escape key maps to keycode `27`
            if ($('.header-searchbar').hasClass('header-searchbar-active')) {
                $('.header-searchbar').removeClass('header-searchbar-active');
                setTimeout(function () {
                    $('.navbar-control-search').focus();
                }, 300);
                setTimeout(function () {
                    $('.aside-search-js').focus();
                }, 300);
            }
        }
    });
    // Header Search Popup End
    // Action On Esc Button For Offcanvas
    $(document).keyup(function (j) {
        if (j.key === "Escape") { // escape key maps to keycode `27`
            if ($('#offcanvas-menu').hasClass('offcanvas-menu-active')) {
                $('.header-searchbar').removeClass('header-searchbar-active');
                $('#offcanvas-menu').removeClass('offcanvas-menu-active');
                $('.navbar-control-offcanvas').removeClass('active');
                $('body').removeClass('body-scroll-locked');
                setTimeout(function () {
                    $('.navbar-control-offcanvas').focus();
                }, 300);
            }
        }
    });
    // Toggle Menu Start
    $('.navbar-control-offcanvas').click(function () {
        $(this).addClass('active');
        $('body').addClass('body-scroll-locked');
        $('#offcanvas-menu').toggleClass('offcanvas-menu-active');
        $('.button-offcanvas-close').focus();
    });
    $('.offcanvas-close .button-offcanvas-close').click(function () {
        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');
        $('html').removeAttr('style');
        $('.navbar-control-offcanvas').focus();
    });
    $('#offcanvas-menu').click(function () {
        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');
    });
    $(".offcanvas-wraper").click(function (e) {
        e.stopPropagation(); //stops click event from reaching document
    });
    $('.skip-link-menu-end').focus(function () {
        $('.button-offcanvas-close').focus();
    });
    // Toggle Menu End
    // Data Background
    var pageSection = $(".data-bg");
    pageSection.each(function (indx) {
        var src = $(this).attr("data-background");
        if (src) {
            $(this).css("background-image", "url(" + src + ")");
        }
    });
    var rtled = false;
    if ($('body').hasClass('rtl')) {
        rtled = true;
    }
    // Carousel Block Home
    $(".mg-carousel-action").each(function () {
        $(this).slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplaySpeed: 8000,
            infinite: true,
            nextArrow: '<button type="button" class="slide-btn slide-next-icon"></button>',
            prevArrow: '<button type="button" class="slide-btn slide-prev-icon"></button>',
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });
    // Content Gallery Slide Start
    $("figure.wp-block-gallery.has-nested-images.columns-1, .wp-block-gallery.columns-1 ul.blocks-gallery-grid, .gallery-columns-1").each(function () {
        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: false,
            autoplaySpeed: 8000,
            infinite: true,
            nextArrow: '<button type="button" class="slide-btn slide-next-icon"></button>',
            prevArrow: '<button type="button" class="slide-btn slide-prev-icon"></button>',
            dots: false,
            rtl: rtled,
        });
    });
    // Content Gallery End


    $(".theme-banner-slider").each(function () {
        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: false,
            autoplaySpeed: 8000,
            infinite: true,
            prevArrow: $('.slide-banner-prev'),
            nextArrow: $('.slide-banner-next'),
            dots: false,
            rtl: rtled
        });
    });

    $(".theme-recommendation-slider").each(function () {
        $(this).slick({
            variableWidth: true,
            infinite: false,
            nextArrow: '<button type="button" class="slide-btn slide-next-icon"></button>',
            prevArrow: '<button type="button" class="slide-btn slide-prev-icon"></button>',
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        variableWidth: false,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]

        });
    });


    $('.tab-link').click( function() {
        var tabID = $(this).attr('data-tab');

        $(this).addClass('active').siblings().removeClass('active');

        $('#tab-'+tabID).addClass('active').slideDown().siblings().removeClass('active').slideUp();
        $('.kushak-skip-link-end').focus(function () {
            $('.filter-toggle-close').focus();
        });
        
        $('.kushak-skip-link-start').focus(function () {
            $('.filter-panels-wrapper ul li:last-child a').focus();
        });        
        $('.filter-toggle-close').click(function () {
            $('.tab-content').removeClass('active').slideUp();
            $('.theme-filter-toggle').focus();
        });

        $('.filter-latest-close').click(function () {
            $('.tab-content').removeClass('active').slideUp();
            $('.theme-latest-toggle').focus();
        });

        $('.kushak-skip-link-2-start').focus(function () {
            $('.theme-filter-post .column:last-child .entry-meta a').focus();
        });
        $('.kushak-skip-link-2-end').focus(function () {
            $('.filter-latest-close').focus();
        });


    });

    $('.theme-filter-toggle').click(function () {
        setTimeout(function () {
            $('.filter-toggle-close').focus();
        }, 300);
    });

    // Navigation toggle on scroll
    $(window).scroll(function () {
        if ($(window).scrollTop() > $(window).height() / 2) {
            $('body').addClass('theme-floatingbar-active');
        } else {
            $('body').removeClass('theme-floatingbar-active');
        }
    });
    // Scroll to Top on Click
    $('.to-the-top').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 700);
        return false;
    });
    // Widgets Tab
    $('.twp-nav-tabs .tab').on('click', function (event) {
        var tabid = $(this).attr('tab-data');
        $(this).closest('.tabbed-container').find('.tab').removeClass('active');
        $(this).addClass('active');
        $(this).closest('.tabbed-container').find('.tab-content .tab-pane').removeClass('active');
        $(this).closest('.tabbed-container').find('.content-' + tabid).addClass('active');
    });
});

function Kushak_SetCookie(cname, cvalue, exdays) {

    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";

}
function Kushak_GetCookie(cname) {

    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');

    for(var i = 0; i <ca.length; i++) {

        var c = ca[i];

        while (c.charAt(0) == ' ') {

            c = c.substring(1);

        }

        if (c.indexOf(name) == 0) {

            return c.substring(name.length, c.length);

        }

    }

    return "";
}