jQuery(document).ready(function ($) {

    var ajaxurl = kushak_pagination.ajax_url;

    function kushak_is_on_screen(elem) {

        if ($(elem)[0]) {

            var tmtwindow = jQuery(window);
            var viewport_top = tmtwindow.scrollTop();
            var viewport_height = tmtwindow.height();
            var viewport_bottom = viewport_top + viewport_height;
            var tmtelem = jQuery(elem);
            var top = tmtelem.offset().top;
            var height = tmtelem.height();
            var bottom = top + height;
            return (top >= viewport_top && top < viewport_bottom) ||
                (bottom > viewport_top && bottom <= viewport_bottom) ||
                (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom);
        }
    }

    var n = window.TWP_JS || {};
    var paged = parseInt(kushak_pagination.paged) + 1;
    var maxpage = kushak_pagination.maxpage;
    var nextLink = kushak_pagination.nextLink;
    var loadmore = kushak_pagination.loadmore;
    var loading = kushak_pagination.loading;
    var nomore = kushak_pagination.nomore;
    var pagination_layout = kushak_pagination.pagination_layout;

    function kushak_load_content_ajax() {

        if ((!$('.theme-no-posts').hasClass('theme-no-posts'))) {

            $('.theme-loading-button .loading-text').text(loading);
            $('.theme-loading-status').addClass('theme-ajax-loading');
            $('.theme-loaded-content').load(nextLink + ' .article-panel-blocks', function () {
                if (paged < 10) {
                    var newlink = nextLink.substring(0, nextLink.length - 2);
                } else {

                    var newlink = nextLink.substring(0, nextLink.length - 3);
                }
                paged++;
                nextLink = newlink + paged + '/';
                if (paged > maxpage) {
                    $('.theme-loading-button').addClass('theme-no-posts');
                    $('.theme-loading-button .loading-text').text(nomore);
                } else {
                    $('.theme-loading-button .loading-text').text(loadmore);
                }

                $('.theme-loaded-content .article-panel-blocks').each(function () {
                    $(this).addClass(paged + '-twp-article-ajax after-ajax-load');
                });

                if ($('.theme-panelarea').hasClass('theme-panelarea-blocks')) {

                    if ($('.theme-panelarea-blocks').length > 0) {


                        var loadedContent = $('.theme-loaded-content').html();
                        $('.theme-loaded-content').html('');

                        var content = $(loadedContent);
                        var grid = $('.theme-panelarea-blocks');


                        var filterContainer = $('.theme-panelarea-blocks');
                        var content = $(loadedContent);
                        filterContainer.append( content );


                        // Background
                        var pageSection = $(".data-bg");
                        pageSection.each(function (indx) {
                            if ($(this).attr("data-background")) {
                                $(this).css("background-image", "url(" + $(this).data("background") + ")");
                            }
                        });

                    }

                } else {

                    $('.content-area .theme-panelarea').append(loadedContent);

                }

                $('.theme-loading-status').removeClass('theme-ajax-loading');



            });

        }
    }

    $('.theme-loading-button').click(function () {

        kushak_load_content_ajax();

    });

    if (pagination_layout == 'auto-load') {
        $(window).scroll(function () {

            if (!$('.theme-loading-status').hasClass('theme-ajax-loading') && !$('.theme-loading-button').hasClass('theme-no-posts') && maxpage > 1 && kushak_is_on_screen('.theme-loading-button')) {

                kushak_load_content_ajax();

            }

        });
    }

    $(window).scroll(function () {

        if (!$('.twp-single-infinity').hasClass('twp-single-loading') && $('.twp-single-infinity').attr('loop-count') <= 3 && kushak_is_on_screen('.twp-single-infinity')) {

            $('.twp-single-infinity').addClass('twp-single-loading');
            var loopcount = $('.twp-single-infinity').attr('loop-count');
            var postid = $('.twp-single-infinity').attr('next-post');

            var data = {
                'action': 'kushak_single_infinity',
                '_wpnonce': kushak_pagination.ajax_nonce,
                'postid': postid,
            };

            $.post(ajaxurl, data, function (response) {

                if (response) {
                    var content = response.data.content.join('');
                    var content = $(content);
                    $('.twp-single-infinity').before(content);
                    var newpostid = response.data.postid.join('');
                    $('.twp-single-infinity').attr('next-post', newpostid);

                    if ($('body').hasClass('booster-extension')) {
                        likedislike('after-load-ajax-' + postid);
                        booster_extension_post_reaction('after-load-ajax-' + postid);
                    }

                    // Content Gallery Slide Start
                    $(".after-load-ajax-"+postid+" figure.wp-block-gallery.has-nested-images.columns-1, .after-load-ajax-"+postid+" .wp-block-gallery.columns-1 ul.blocks-gallery-grid, .after-load-ajax-"+postid+"  .gallery-columns-1").each(function () {
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
                        });
                    });
                    // Content Gallery End

                    // Content Gallery popup Start
                    $('.after-load-ajax .entry-content .gallery, .widget .gallery, .after-load-ajax .wp-block-gallery').each(function () {

                        $(this).magnificPopup({
                            delegate: 'a',
                            type: 'image',
                            closeOnContentClick: false,
                            closeBtnInside: false,
                            mainClass: 'mfp-with-zoom mfp-img-mobile',
                            image: {
                                verticalFit: true,
                                titleSrc: function (item) {
                                    return item.el.attr('title');
                                }
                            },
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

                    // Content Gallery popup End

                    $('article').each(function () {
                        $(this).removeClass('after-load-ajax');
                    });

                }

                $('.twp-single-infinity').removeClass('twp-single-loading');
                loopcount++;
                $('.twp-single-infinity').attr('loop-count', loopcount);

            });

        }

    });

});