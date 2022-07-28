<?php
/**
 * Custom Functions.
 *
 * @package Kushak
 */
if (!function_exists('kushak_fonts_url')) :
    //Google Fonts URL
    function kushak_fonts_url()
    {
        $font_families = array(
            'Inter:wght@100;200;300;400;500;600;700;800;900'
        );
        $fonts_url = add_query_arg(array(
            'family' => implode('&family=', $font_families),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2');
        return esc_url_raw($fonts_url);
    }
endif;
if (!function_exists('kushak_read_more_render')):
    function kushak_read_more_render()
    { ?>
        <div class="entry-meta">
            <div class="entry-meta-link">
                <a href="<?php the_permalink(); ?>">
                    <?php esc_html_e('Read More', 'kushak'); ?>
                </a>
            </div>
        </div>
        <?php
    }
endif;
if (!function_exists('kushak_social_menu_icon')) :
    function kushak_social_menu_icon($item_output, $item, $depth, $args)
    {
        // Add Icon
        if ('kushak-social-menu' === $args->theme_location) {
            $svg = Kushak_SVG_Icons::get_theme_svg_name($item->url);
            if (empty($svg)) {
                $svg = kushak_the_theme_svg('link', $return = true);
            }
            $item_output = str_replace($args->link_after, '</span>' . $svg, $item_output);
        }
        return $item_output;
    }
endif;
add_filter('walker_nav_menu_start_el', 'kushak_social_menu_icon', 10, 4);
if (!function_exists('kushak_add_sub_toggles_to_main_menu')) :
    function kushak_add_sub_toggles_to_main_menu($args, $item, $depth)
    {
        // Add sub menu toggles to the Expanded Menu with toggles.
        if (isset($args->show_toggles) && $args->show_toggles) {
            // Wrap the menu item link contents in a div, used for positioning.
            $args->before = '<div class="submenu-wrapper">';
            $args->after = '';
            // Add a toggle to items with children.
            if (in_array('menu-item-has-children', $item->classes, true)) {
                $toggle_target_string = '.menu-item.menu-item-' . $item->ID . ' > .sub-menu';
                // Add the sub menu toggle.
                $args->after .= '<button class="toggle submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="screen-reader-text">' . __('Show sub menu', 'kushak') . '</span>' . kushak_the_theme_svg('arrow-down', $return = true) . '</button>';
            }
            // Close the wrapper.
            $args->after .= '</div><!-- .submenu-wrapper -->';
            // Add sub menu icons to the primary menu without toggles.
        } elseif ('kushak-primary-menu' === $args->theme_location) {
            if (in_array('menu-item-has-children', $item->classes, true)) {
                $args->after = '<span class="icon">' . kushak_the_theme_svg('arrow-down', true) . '</span>';
            } else {
                $args->after = '';
            }
        }
        return $args;
    }
endif;
add_filter('nav_menu_item_args', 'kushak_add_sub_toggles_to_main_menu', 10, 3);
if (!function_exists('kushak_sanitize_sidebar_option_meta')) :
    // Sidebar Option Sanitize.
    function kushak_sanitize_sidebar_option_meta($input)
    {
        $metabox_options = array('global-sidebar', 'left-sidebar', 'right-sidebar', 'no-sidebar');
        if (in_array($input, $metabox_options)) {
            return $input;
        } else {
            return '';
        }
    }
endif;
if (!function_exists('kushak_page_lists')) :
    // Page List.
    function kushak_page_lists()
    {
        $page_lists = array();
        $page_lists[''] = esc_html__('-- Select Page --', 'kushak');
        $pages = get_pages();
        foreach ($pages as $page) {
            $page_lists[$page->ID] = $page->post_title;
        }
        return $page_lists;
    }
endif;
if (!function_exists('kushak_sanitize_post_layout_option_meta')) :
    // Sidebar Option Sanitize.
    function kushak_sanitize_post_layout_option_meta($input)
    {
        $metabox_options = array('global-layout', 'layout-1', 'layout-2');
        if (in_array($input, $metabox_options)) {
            return $input;
        } else {
            return '';
        }
    }
endif;
if (!function_exists('kushak_sanitize_header_overlay_option_meta')) :
    // Sidebar Option Sanitize.
    function kushak_sanitize_header_overlay_option_meta($input)
    {
        $metabox_options = array('global-layout', 'enable-overlay');
        if (in_array($input, $metabox_options)) {
            return $input;
        } else {
            return '';
        }
    }
endif;
/**
 * Kushak SVG Icon helper functions
 *
 * @package Kushak
 * @since 1.0.0
 */
if (!function_exists('kushak_the_theme_svg')):
    /**
     * Output and Get Theme SVG.
     * Output and get the SVG markup for an icon in the Kushak_SVG_Icons class.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function kushak_the_theme_svg($svg_name, $return = false)
    {
        if ($return) {
            return kushak_get_theme_svg($svg_name); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in kushak_get_theme_svg();.
        } else {
            echo kushak_get_theme_svg($svg_name); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in kushak_get_theme_svg();.
        }
    }
endif;
if (!function_exists('kushak_get_theme_svg')):
    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function kushak_get_theme_svg($svg_name)
    {
        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            Kushak_SVG_Icons::get_svg($svg_name),
            array(
                'svg' => array(
                    'class' => true,
                    'xmlns' => true,
                    'width' => true,
                    'height' => true,
                    'viewbox' => true,
                    'aria-hidden' => true,
                    'role' => true,
                    'focusable' => true,
                ),
                'path' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'd' => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'points' => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );
        if (!$svg) {
            return false;
        }
        return $svg;
    }
endif;
if (!function_exists('kushak_post_category_list')) :
    // Post Category List.
    function kushak_post_category_list($select_cat = true)
    {
        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );
        $post_cat_cat_array = array();
        if ($select_cat) {
            $post_cat_cat_array[''] = esc_html__('-- Select Category --', 'kushak');
        }
        foreach ($post_cat_lists as $post_cat_list) {
            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;
        }
        return $post_cat_cat_array;
    }
endif;
if (!function_exists('kushak_sanitize_meta_pagination')):
    /** Sanitize Enable Disable Checkbox **/
    function kushak_sanitize_meta_pagination($input)
    {
        $valid_keys = array('global-layout', 'no-navigation', 'norma-navigation', 'ajax-next-post-load');
        if (in_array($input, $valid_keys)) {
            return $input;
        }
        return '';
    }
endif;
if (!function_exists('kushak_disable_post_views')):
    /** Disable Post Views **/
    function kushak_disable_post_views()
    {
        add_filter('booster_extension_filter_views_ed', function () {
            return false;
        });
    }
endif;
if (!function_exists('kushak_disable_post_read_time')):
    /** Disable Read Time **/
    function kushak_disable_post_read_time()
    {
        add_filter('booster_extension_filter_readtime_ed', function () {
            return false;
        });
    }
endif;
if (!function_exists('kushak_disable_post_like_dislike')):
    /** Disable Like Dislike **/
    function kushak_disable_post_like_dislike()
    {
        add_filter('booster_extension_filter_like_ed', function () {
            return false;
        });
    }
endif;
if (!function_exists('kushak_disable_post_author_box')):
    /** Disable Author Box **/
    function kushak_disable_post_author_box()
    {
        add_filter('booster_extension_filter_ab_ed', function () {
            return false;
        });
    }
endif;
add_filter('booster_extension_filter_ss_ed', function () {
    return false;
});
if (!function_exists('kushak_disable_post_reaction')):
    /** Disable Reaction **/
    function kushak_disable_post_reaction()
    {
        add_filter('booster_extension_filter_reaction_ed', function () {
            return false;
        });
    }
endif;
if (!function_exists('kushak_post_floating_nav')):
    function kushak_post_floating_nav()
    {
        $kushak_default = kushak_get_default_theme_options();
        $ed_floating_next_previous_nav = get_theme_mod('ed_floating_next_previous_nav', $kushak_default['ed_floating_next_previous_nav']);
        if ('post' === get_post_type() && $ed_floating_next_previous_nav) {
            $next_post = get_next_post();
            $prev_post = get_previous_post();
            if (isset($prev_post->ID)) {
                $prev_link = get_permalink($prev_post->ID); ?>
                <div class="floating-post-navigation floating-navigation-prev">
                    <?php if (get_the_post_thumbnail($prev_post->ID, 'medium')) { ?>
                        <?php echo wp_kses_post(get_the_post_thumbnail($prev_post->ID, 'medium')); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url($prev_link); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Previous post', 'kushak'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html(get_the_title($prev_post->ID)); ?></span>
                    </a>
                </div>
            <?php }
            if (isset($next_post->ID)) {
                $next_link = get_permalink($next_post->ID); ?>
                <div class="floating-post-navigation floating-navigation-next">
                    <?php if (get_the_post_thumbnail($next_post->ID, 'medium')) { ?>
                        <?php echo wp_kses_post(get_the_post_thumbnail($next_post->ID, 'medium')); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url($next_link); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Next post', 'kushak'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html(get_the_title($next_post->ID)); ?></span>
                    </a>
                </div>
                <?php
            }
        }
    }
endif;
add_action('kushak_navigation_action', 'kushak_post_floating_nav', 10);
if (!function_exists('kushak_single_post_navigation')):
    function kushak_single_post_navigation()
    {
        $kushak_default = kushak_get_default_theme_options();
        $twp_navigation_type = esc_attr(get_post_meta(get_the_ID(), 'twp_disable_ajax_load_next_post', true));
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;
        if ($twp_navigation_type == '' || $twp_navigation_type == 'global-layout') {
            $twp_navigation_type = get_theme_mod('twp_navigation_type', $kushak_default['twp_navigation_type']);
        }
        if ($twp_navigation_type != 'no-navigation' && 'post' === get_post_type()) {
            if ($twp_navigation_type == 'norma-navigation') { ?>
                <div class="theme-block navigation-wrapper">
                    <?php
                    // Previous/next post navigation.
                    the_post_navigation(array(
                        'prev_text' => '<span class="arrow" aria-hidden="true">' . kushak_the_theme_svg('arrow-left', $return = true) . '</span><span class="screen-reader-text">' . __('Previous post:', 'kushak') . '</span><h4 class="entry-title entry-title-small">%title</h4>',
                        'next_text' => '<span class="arrow" aria-hidden="true">' . kushak_the_theme_svg('arrow-right', $return = true) . '</span><span class="screen-reader-text">' . __('Next post:', 'kushak') . '</span><h4 class="entry-title entry-title-small">%title</h4>',
                    )); ?>
                </div>
                <?php
            } else {
                $next_post = get_next_post();
                if (isset($next_post->ID)) {
                    $next_post_id = $next_post->ID;
                    echo '<div loop-count="1" next-post="' . absint($next_post_id) . '" class="twp-single-infinity"></div>';
                }
            }
        }
    }
endif;
add_action('kushak_navigation_action', 'kushak_single_post_navigation', 30);
if (!function_exists('kushak_header_banner_section')) :
    function kushak_header_banner_section()
    {
        $kushak_default = kushak_get_default_theme_options();
        $ed_header_banner = get_theme_mod('ed_header_banner', $kushak_default['ed_header_banner']);
        if ($ed_header_banner) {
            $header_banner_title = get_theme_mod('header_banner_title', $kushak_default['header_banner_title']);
            $header_banner_description = get_theme_mod('header_banner_description', $kushak_default['header_banner_description']);
            $header_banner_title_link = get_theme_mod('header_banner_title_link', $kushak_default['header_banner_title_link']);
            $header_button_title = get_theme_mod('header_button_title', $kushak_default['header_button_title']);
            $header_image_url = get_header_image();
            ?>
            <div class="theme-block theme-block-banner">
                <div class="wrapper">
                    <div class="wrapper-inner">
                        <div class="column column-7 column-sm-12">
                            <div class="block-banner-content">
                                <h3 class="entry-title entry-title-large">
                                    <a href="<?php echo esc_url($header_banner_title_link); ?>">
                                        <?php echo esc_html($header_banner_title); ?>
                                    </a>
                                </h3>
                                <div class="block-banner-description"><?php echo wp_kses_post($header_banner_description); ?></div>
                                <?php if (!empty($header_image_url)) { ?>
                                    <a href="<?php echo esc_url($header_banner_title_link); ?>"
                                       class="banner-content-link">
                                        <?php echo esc_html($header_button_title); ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if (!empty($header_image_url)) { ?>
                            <div class="column column-5 column-sm-12">
                                <div class="banner-wrapper-image">
                                    <a href="<?php echo esc_url($header_banner_title_link); ?>">
                                        <img src="<?php echo esc_url($header_image_url); ?>">
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }
endif;
if (!function_exists('kushak_popular_post_section')) :
    function kushak_popular_post_section()
    {
        $kushak_default = kushak_get_default_theme_options();
        $ed_popular_post_section = get_theme_mod('ed_popular_post_section', $kushak_default['ed_popular_post_section']);
        $ed_trending_post_section = get_theme_mod('ed_trending_post_section', $kushak_default['ed_trending_post_section']);
        if ($ed_popular_post_section || $ed_trending_post_section) {
            $popular_post_section_title = get_theme_mod('popular_post_section_title', $kushak_default['popular_post_section_title']);
            $number_of_popular_post = get_theme_mod('number_of_popular_post', $kushak_default['number_of_popular_post']);
            $popular_post_category_section_cat = get_theme_mod('popular_post_category_section_cat', $kushak_default['popular_post_category_section_cat']);
            $trending_post_section_title = get_theme_mod('trending_post_section_title', $kushak_default['trending_post_section_title']);
            $number_of_trending_post = get_theme_mod('number_of_trending_post', $kushak_default['number_of_trending_post']);
            $trending_post_section_cat = get_theme_mod('trending_post_section_cat', $kushak_default['trending_post_section_cat']);
            ?>
            <div class="theme-block theme-block-popular">
                <div class="wrapper">
                    <div class="wrapper-inner">
                        <?php
                        $popular_col_class = 'column-12';
                        if ($ed_trending_post_section) {
                            $popular_col_class = 'column-9';
                        }
                        if ($ed_popular_post_section) { ?>
                            <div class="column <?php echo esc_html($popular_col_class); ?> column-sm-12">
                                <?php if (!empty($popular_post_section_title)) { ?>
                                    <div class="theme-block-header">
                                        <h2 class="theme-block-title"><?php echo esc_html($popular_post_section_title); ?></h2>
                                    </div>
                                <?php } ?>
                                <div class="wrapper-popular-body">
                                    <div class="wrapper-inner">
                                        <?php
                                        $popular_posts_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => absint($number_of_popular_post), 'category_name' => $popular_post_category_section_cat, 'post__not_in' => get_option("sticky_posts")));
                                        if ($popular_posts_query->have_posts()):
                                            while ($popular_posts_query->have_posts()):
                                                $popular_posts_query->the_post(); ?>
                                                <div class="column column-6 column-xs-12 mb-20">
                                                    <div class="popular-body-item mb-20">
                                                        <?php if (has_post_thumbnail()) {
                                                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                                            $featured_image = isset($featured_image[0]) ? $featured_image[0] : '';
                                                            ?>
                                                            <div class="entry-thumbnail">
                                                                <a href="<?php the_permalink(); ?>"
                                                                   class="data-bg data-bg-big"
                                                                   data-background="<?php echo esc_url($featured_image); ?>">
                                                                </a>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="popular-item-content">
                                                            <div class="popular-content-head">
                                                                <div class="entry-meta">
                                                                    <?php kushak_entry_footer($cats = true, $tags = false, $edits = false); ?>
                                                                </div>
                                                            </div>
                                                            <div class="popular-content-body">
                                                                <h3 class="entry-title entry-title-big">
                                                                    <a href="<?php the_permalink(); ?>">
                                                                        <?php the_title(); ?>
                                                                    </a>
                                                                </h3>

                                                                <div class="entry-meta">
                                                                    <?php kushak_posted_on(); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            endwhile;
                                            wp_reset_postdata();
                                        endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php
                        $popular_col_class_1 = 'column-12';
                        if ($ed_popular_post_section) {
                            $popular_col_class_1 = 'column-3';
                        }
                        if ($ed_trending_post_section) {
                            ?>
                            <div class="column <?php echo esc_html($popular_col_class_1); ?> column-sm-12">
                                <div class="theme-trending-wrapper">
                                    <?php if (!empty($trending_post_section_title)) { ?>
                                        <header class="theme-block-header">
                                            <h2 class="theme-block-title"><?php echo esc_html($trending_post_section_title); ?></h2>
                                        </header>
                                    <?php } ?>
                                    <?php
                                    $trending_posts_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => absint($number_of_trending_post), 'category_name' => $trending_post_section_cat, 'post__not_in' => get_option("sticky_posts")));
                                    if ($trending_posts_query->have_posts()):
                                        while ($trending_posts_query->have_posts()):
                                            $trending_posts_query->the_post(); ?>
                                            <article <?php post_class('trending-body-item'); ?>>
                                                <div class="trending-item-head">
                                                    <div class="entry-meta">
                                                        <?php kushak_entry_footer($cats = true, $tags = false, $edits = false); ?>
                                                    </div>
                                                </div>
                                                <div class="trending-item-body">
                                                    <h3 class="entry-title entry-title-medium">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_title(); ?>
                                                        </a>
                                                    </h3>
                                                    <div class="entry-meta">
                                                        <?php kushak_posted_on(); ?>
                                                    </div>
                                                </div>
                                            </article>
                                        <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    endif; ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php }
    }
endif;
if (!function_exists('kushak_header_toggle_search')):
    /**
     * Header Search
     **/
    function kushak_header_toggle_search()
    {
        $kushak_default = kushak_get_default_theme_options();
        $ed_header_search = get_theme_mod('ed_header_search', $kushak_default['ed_header_search']);
        if ($ed_header_search) { ?>
            <div class="header-searchbar">
                <div class="header-searchbar-inner">
                    <div class="wrapper">
                        <div class="header-searchbar-area">
                            <a href="javascript:void(0)" class="skip-link-search-start"></a>
                            <?php get_search_form(); ?>
                            <button type="button" id="search-closer" class="exit-search">
                                <?php kushak_the_theme_svg('cross'); ?>
                            </button>
                        </div>
                        <a href="javascript:void(0)" class="skip-link-search-end"></a>
                    </div>
                </div>
            </div>
            <?php
        }
    }
endif;
add_action('kushak_before_footer_content_action', 'kushak_header_toggle_search', 10);
if (!function_exists('kushak_carousel_section')):
    // Single Posts Related Posts.
    function kushak_carousel_section()
    {
        $kushak_default = kushak_get_default_theme_options();
        $ed_carousel_section = get_theme_mod('ed_carousel_section', $kushak_default['ed_carousel_section']);
        $carousel_section_title = get_theme_mod('carousel_section_title', $kushak_default['carousel_section_title']);
        if ($ed_carousel_section) {
            $mg_carousel_section_cat = get_theme_mod('mg_carousel_section_cat');
            $ed_carousel_autoplay = get_theme_mod('ed_carousel_autoplay', $kushak_default['ed_carousel_autoplay']);
            $ed_carousel_arrow = get_theme_mod('ed_carousel_arrow', $kushak_default['ed_carousel_arrow']);
            $ed_carousel_dots = get_theme_mod('ed_carousel_dots', $kushak_default['ed_carousel_dots']);
            if ($ed_carousel_autoplay) {
                $autoplay = 'true';
            } else {
                $autoplay = 'false';
            }
            if ($ed_carousel_arrow) {
                $arrow = 'true';
            } else {
                $arrow = 'false';
            }
            if ($ed_carousel_dots) {
                $dots = 'true';
            } else {
                $dots = 'false';
            }
            if (is_rtl()) {
                $rtl = 'true';
            } else {
                $rtl = 'false';
            }
            $carousel_posts_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 10, 'category_name' => $mg_carousel_section_cat, 'post__not_in' => get_option("sticky_posts")));
            if ($carousel_posts_query->have_posts()): ?>
                <div class="theme-block theme-block-carousel theme-block-bg">
                    <div class="wrapper">
                        <div class="wrapper-inner">
                            <div class="column column-12">
                                <div class="theme-block-header">
                                    <h2 class="theme-block-title"><?php echo esc_html($carousel_section_title); ?></h2>
                                </div>
                                <div class="mg-carousel-action theme-slide-space"
                                     data-slick='{"autoplay": <?php echo esc_attr($autoplay); ?>, "arrows": <?php echo esc_attr($arrow); ?>, "dots": <?php echo esc_attr($dots); ?>, "rtl": <?php echo esc_attr($rtl); ?>}'>
                                    <?php
                                    while ($carousel_posts_query->have_posts()):
                                        $carousel_posts_query->the_post(); ?>
                                        <article id="post-<?php the_ID(); ?>" <?php post_class('theme-carousel-article'); ?>>
                                            <div class="entry-wrapper">
                                                <?php
                                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                                $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                                <div class="entry-thumbnail">
                                                    <a href="<?php the_permalink(); ?>" class="data-bg data-bg-medium" data-background="<?php echo esc_url($featured_image); ?>"></a>
                                                </div>
                                                <div class="post-content mt-10">
                                                    <div class="entry-meta">
                                                        <?php kushak_entry_footer($cats = true, $tags = false, $edits = false); ?>
                                                    </div>

                                                    <header class="entry-header">
                                                        <h3 class="entry-title entry-title-small">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php the_title(); ?>
                                                            </a>
                                                        </h3>
                                                    </header>
                                                    <div class="entry-meta">
                                                        <?php kushak_posted_by(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    <?php
                                    endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                wp_reset_postdata();
            endif;
        }
    }
endif;
if (!function_exists('kushak_banner_slider_section')):
    // Single Posts Related Posts.
    function kushak_banner_slider_section()
    {
        $kushak_default = kushak_get_default_theme_options();
        $ed_banner_slider_section = get_theme_mod('ed_banner_slider_section', $kushak_default['ed_banner_slider_section']);
        $ed_banner_similar_post = get_theme_mod('ed_banner_similar_post', $kushak_default['ed_banner_similar_post']);
        $banner_similar_post_title = get_theme_mod('banner_similar_post_title', $kushak_default['banner_similar_post_title']);
        if ($ed_banner_slider_section) {
            $mg_banner_slider_section_cat = get_theme_mod('mg_banner_slider_section_cat');
            $ed_banner_slider_autoplay = get_theme_mod('ed_banner_slider_autoplay', $kushak_default['ed_banner_slider_autoplay']);
            $ed_banner_slider_arrow = get_theme_mod('ed_banner_slider_arrow', $kushak_default['ed_banner_slider_arrow']);
            $ed_banner_slider_dots = get_theme_mod('ed_banner_slider_dots', $kushak_default['ed_banner_slider_dots']);
            if ($ed_banner_slider_autoplay) {
                $autoplay = 'true';
            } else {
                $autoplay = 'false';
            }
            if ($ed_banner_slider_arrow) {
                $arrow = 'true';
            } else {
                $arrow = 'false';
            }
            if ($ed_banner_slider_dots) {
                $dots = 'true';
            } else {
                $dots = 'false';
            }
            if (is_rtl()) {
                $rtl = 'true';
            } else {
                $rtl = 'false';
            }
            $banner_slider_posts_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, 'category_name' => $mg_banner_slider_section_cat, 'post__not_in' => get_option("sticky_posts")));
            if ($banner_slider_posts_query->have_posts()): ?>
                <div class="theme-block theme-block-banner-slider">
                    <div class="wrapper">
                        <div class="banner-nav-controls">
                            <button type="button" class="slide-btn-small slide-banner-prev">
                                <?php kushak_the_theme_svg('chevron-left'); ?>
                            </button>
                            <button type="button" class="slide-btn-small slide-banner-next">
                                <?php kushak_the_theme_svg('chevron-right'); ?>
                            </button>
                        </div>
                    </div>
                    <div class="theme-banner-slider" data-slick='{"autoplay": <?php echo esc_attr($autoplay); ?>, "arrows": <?php echo esc_attr($arrow); ?>, "dots": <?php echo esc_attr($dots); ?>, "rtl": <?php echo esc_attr($rtl); ?>}'>
                        <?php
                        while ($banner_slider_posts_query->have_posts()):
                            $banner_slider_posts_query->the_post();
                            $user_id = get_the_author_meta('ID');

                            $banner_slider_author_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 2, 'author' => $user_id, 'post__not_in' => get_option("sticky_posts")));

                             ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('theme-blog-article theme-banner-article'); ?>>
                                <?php
                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                                $featured_image = isset($featured_image[0]) ? $featured_image[0] : '';?>
                                <div class="entry-thumbnail">
                                    <div class="wrapper">
                                        <div class="wrapper-inner">
                                            <div class="column column-12">
                                                <a href="<?php the_permalink(); ?>" class="data-bg data-bg-large" data-background="<?php echo esc_url($featured_image); ?>"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <div class="wrapper">
                                        <div class="wrapper-inner">
                                            <div class="column column-8 column-sm-12">
                                                <div class="banner-content-area">
                                                    <div class="entry-meta-author">
                                                        <?php if (!empty($user_id )) { ?>
                                                            <div class="entry-meta-avatar">
                                                                <img src="<?php echo esc_url( get_avatar_url( $user_id) ); ?>" />
                                                            </div>
                                                        <?php } ?>
                                                        <div class="entry-meta">
                                                            <?php kushak_posted_by(); ?>
                                                        </div>
                                                    </div>

                                                    <div class="entry-meta">
                                                        <?php kushak_entry_footer($cats = true, $tags = false, $edits = false); ?>
                                                    </div>

                                                    <header class="entry-header">
                                                        <h3 class="entry-title entry-title-large">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php the_title(); ?>
                                                            </a>
                                                        </h3>
                                                    </header>

                                                    <div class="entry-meta">
                                                        <?php kushak_posted_on(); ?>
                                                    </div>

                                                    <?php kushak_excerpt_content(); ?>
                                                </div>
                                            </div>

                                            <?php if ($ed_banner_similar_post) { ?>
                                                <div class="column column-4 column-sm-12 mt-20">
                                                    <?php if ($banner_similar_post_title) { ?>
                                                        <div class="theme-block-header">
                                                            <h3 class="theme-block-title"><?php echo esc_html($banner_similar_post_title); ?></h3>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="banner-more-stories">
                                                        <?php if ($banner_slider_author_query->have_posts()):
                                                            while ($banner_slider_author_query->have_posts()):
                                                                $banner_slider_author_query->the_post(); 
                                                                $featured_image_2 = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                                                                $featured_image_2 = isset($featured_image_2[0]) ? $featured_image_2[0] : '';?>

                                                                <div class="article-more-stories">
                                                                    <div class="data-bg data-bg-small" data-background="<?php echo esc_url($featured_image_2); ?>">
                                                                        <a href="<?php the_permalink(); ?>" class="img-link" tabindex="0"></a>
                                                                    </div>
                                                                    <div class="article-more-content">
                                                                        <header class="entry-header">
                                                                            <h4 class="entry-title entry-title-small mt-20">
                                                                                <a href="<?php the_permalink(); ?>">
                                                                                    <?php the_title(); ?>
                                                                                </a>
                                                                            </h4>
                                                                        </header>
                                                                    </div>
                                                                </div>
                                                            <?php endwhile;
                                                        endif;
                                                        ?>
                                                    </div>
                                                </div>
                                            <?php } ?>





                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php
                        endwhile; ?>
                    </div>
                </div>
                <?php
                wp_reset_postdata();
            endif;
        }
    }
endif;
if (!function_exists('kushak_filter_and_featured_section')):
    // Single Posts Related Posts.
    function kushak_filter_and_featured_section()
    {
        $kushak_default = kushak_get_default_theme_options();
        $ed_top_filter = get_theme_mod('ed_top_filter', $kushak_default['ed_top_filter']);
        $ed_filter_and_featured_post_section = get_theme_mod('ed_filter_and_featured_post_section', $kushak_default['ed_filter_and_featured_post_section']);
        ?>
        <div class="theme-filter">
            <div class="theme-filter-content">
                <?php if ($ed_top_filter) { ?>
                    <div id="tab-1" class="tab-content theme-filter-misc">
                        <div class="wrapper">
                        <a href="javascript:void(0)" class="kushak-skip-link-start"></a>
                            <a href="javascript:void(0)" class="filter-toggle-close">
                                <span class="screen-reader-text"> <?php echo esc_html__('Close Contents', 'kushak'); ?> </span>
                                <?php kushak_the_theme_svg('close'); ?>
                            </a>
                            <div class="filter-panels-wrapper">
                                <div class="theme-filter-list theme-list-years">
                                    <h3 class="filter-panels-title"> <?php echo esc_html__('Years', 'kushak'); ?> </h3>
                                    <ul class="filter-panels-list filter-yearly">
                                        <?php
                                        wp_get_archives(array('type' => 'yearly'));
                                        ?>
                                    </ul>
                                </div>
                                <div class="theme-filter-list theme-list-authors">
                                    <h3 class="filter-panels-title"> <?php echo esc_html__('Authors', 'kushak'); ?> </h3>
                                    <ul class="filter-panels-list filter-authors">
                                        <?php
                                        $users = get_users(array('fields' => array('display_name', 'id')));
                                        // Array of stdClass objects.
                                        foreach ($users as $user) { ?>
                                            <li>
                                                <a href="<?php echo esc_url(get_author_posts_url($user->id)); ?>">
                                                <span class="theme-author-image"><img
                                                            src="<?php echo esc_url(get_avatar_url($user->id, ['size' => '50'])); ?>"
                                                            alt="<?php echo esc_html($user->display_name); ?>"></span>
                                                    <span class="theme-author-title"><?php echo esc_html($user->display_name); ?></span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="theme-filter-list theme-list-misc">
                                    <h3 class="filter-panels-title"> <?php echo esc_html__('Filter by Month', 'kushak'); ?>  </h3>
                                    <ul class="filter-panels-list filter-monthly">
                                        <?php wp_get_archives('monthnum'); ?>
                                    </ul>
                                    <h3 class="filter-panels-title"> <?php echo esc_html__('Filter by Categories', 'kushak'); ?></h3>
                                    <ul class="filter-panels-list filter-categories">
                                        <?php
                                        $args = array(
                                            'orderby' => 'id',
                                            'hide_empty' => 0,
                                        );
                                        $categories = get_categories($args);
                                        foreach ($categories as $cat) { ?>
                                            <li>
                                                <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
                                                   class='filter-link'><?php echo esc_html($cat->name); ?></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <h3 class="filter-panels-title"> <?php echo esc_html__('Filter by Tags', 'kushak'); ?> </h3>
                                    <ul class="filter-panels-list filter-categories">
                                        <?php
                                        $tags = get_tags(array(
                                            'hide_empty' => false
                                        ));
                                        foreach ($tags as $tag) { ?>
                                            <li>
                                                <a
                                                        href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"><?php echo esc_html($tag->name); ?></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        <a href="javascript:void(0)" class="kushak-skip-link-end"></a>
                        </div>
                    </div>

                <?php } ?>
                <?php
                if ($ed_filter_and_featured_post_section) {
                    $mg_filter_and_featured_post_section_cat = get_theme_mod('mg_filter_and_featured_post_section_cat');
                    $filter_featured_posts_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'category_name' => $mg_filter_and_featured_post_section_cat, 'post__not_in' => get_option("sticky_posts")));
                    if ($filter_featured_posts_query->have_posts()): ?>
                        <div id="tab-2" class="tab-content theme-filter-post">
                            <div class="wrapper">
                                <a href="javascript:void(0)" class="kushak-skip-link-2-start"></a>
                                <a href="javascript:void(0)" class="filter-latest-close">
                                    <span class="screen-reader-text"> <?php echo esc_html__('Close Contents', 'kushak'); ?> </span>
                                    <?php kushak_the_theme_svg('close'); ?>
                                </a>
                                <div class="filter-latest-wrapper">
                                    <div class="wrapper-inner">
                                        <?php
                                        while ($filter_featured_posts_query->have_posts()):
                                            $filter_featured_posts_query->the_post(); ?>
                                            <div class="column column-3 column-sm-6 column-xs-12 mb-sm-20">
                                                <article
                                                        id="post-<?php the_ID(); ?>" <?php post_class('theme-blog-article theme-featured-post-article'); ?>>
                                                    <div class="entry-wrapper">
                                                        <div class="post-content">
                                                            <header class="entry-header">
                                                                <h3 class="entry-title entry-title-small">
                                                                    <a href="<?php the_permalink(); ?>">
                                                                        <?php the_title(); ?>
                                                                    </a>
                                                                </h3>
                                                            </header>
                                                            <div class="entry-meta">
                                                                <?php kushak_posted_by(); ?>
                                                            </div>
                                                            <div class="entry-content entry-content-small">
                                                                <?php
                                                                if (has_excerpt()) {
                                                                    the_excerpt();
                                                                } else {
                                                                    echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        <?php
                                        endwhile; ?>
                                    </div>
                                </div>

                                <a href="javascript:void(0)" class="kushak-skip-link-2-end"></a>
                            </div>
                        </div>

                        <?php
                        wp_reset_postdata();
                    endif;
                } ?>
            </div>
        </div>
    <?php }
endif;
if (!function_exists('kushak_contact_section')) :
    function kushak_contact_section()
    {
        $kushak_default = kushak_get_default_theme_options();
        $ed_contact_section = get_theme_mod('ed_contact_section', $kushak_default['ed_contact_section']);
        $contact_section_title = get_theme_mod('contact_section_title', $kushak_default['contact_section_title']);
        $contact_section_location = get_theme_mod('contact_section_location', $kushak_default['contact_section_location']);
        $contact_section_email = get_theme_mod('contact_section_email', $kushak_default['contact_section_email']);
        $contact_section_number = get_theme_mod('contact_section_number', $kushak_default['contact_section_number']);
        $contact_form_shortcode = get_theme_mod('contact_form_shortcode');
        $contact_section_bg_image = get_theme_mod('contact_section_bg_image');
        if ($ed_contact_section) { ?>

            <div class="theme-block theme-block-contact">
                <div class="wrapper">
                    <div class="wrapper-inner">
                        <div class="column column-1 column-sm-12">
                            <div class="theme-block-header block-header-vertical">
                                <h2 class="theme-block-title"><?php echo esc_html($contact_section_title); ?></h2>
                            </div>
                        </div>
                        <div class="column column-3 column-sm-12">
                            <ul class="theme-contact-list">
                                <?php if ($contact_section_location) { ?>
                                    <li class="theme-contact-list-group">
                                        <div class="theme-contact-list-title">
                                            <?php echo esc_html__('Location:', 'kushak') ?>
                                        </div>
                                        <div class="theme-contact-list-content">
                                            <?php echo esc_html($contact_section_location); ?>
                                        </div>
                                    </li>
                                <?php } ?>

                                <li class="theme-contact-list-group">
                                    <?php if (!empty($contact_section_number) || !empty($contact_section_email)) { ?>
                                        <div class="theme-contact-list-title">
                                            <?php echo esc_html__('Contact:', 'kushak') ?>
                                        </div>
                                    <?php } ?>
                                    <div class="theme-contact-list-content">
                                        <?php if ($contact_section_number) { ?>
                                            <div class="contact-list-content-phone">
                                                <div class="contact-list-content-icon">

                                                </div>
                                                <div class="contact-list-content-detail">

                                                    <a href="tel:<?php echo absint($contact_section_number); ?>">
                                                        <?php echo absint($contact_section_number); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($contact_section_email) { ?>
                                            <div class="contact-list-content-email">
                                                <div class="contact-list-content-icon">

                                                </div>
                                                <div class="contact-list-content-detail">
                                                    <a href="mailto:<?php echo sanitize_email($contact_section_email); ?>">
                                                        <?php echo sanitize_email($contact_section_email); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </li>

                                <?php if (has_nav_menu('kushak-social-menu')) { ?>
                                    <li class="theme-contact-list-group">
                                        <div class="theme-contact-list-title">
                                            <?php echo esc_html__('Follow Us On:', 'kushak') ?>
                                        </div>

                                        <div class="theme-social-navigation theme-contact-list-content">
                                            <?php wp_nav_menu(array(
                                                'theme_location' => 'kushak-social-menu',
                                                'link_before' => '<span class="screen-reader-text">',
                                                'link_after' => '</span>',
                                                'container' => 'div',
                                                'container_class' => 'social-menu',
                                                'depth' => 1,
                                            )); ?>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>

                        </div>

                        <div class="column column-4 column-sm-12">
                            <?php if ($contact_section_bg_image) { ?>
                                <div class="entry-thumbnail">
                                    <div class="data-bg data-bg-large" data-background="<?php echo esc_url($contact_section_bg_image); ?>"></div>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="column column-4 column-sm-12">
                            <div class="theme-contact-area mt-20">
                                <div class="theme-block-header block-header-medium mt-20">
                                    <h3 class="theme-block-title">
                                        <?php echo esc_html__('Send Us A Message', 'kushak') ?>
                                    </h3>
                                </div>

                                <div class="post-content">
                                    <?php echo do_shortcode($contact_form_shortcode); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    }
endif;
if (!function_exists('kushak_popup_newsletter')) :
    function kushak_popup_newsletter()
    {
        $kushak_default = kushak_get_default_theme_options();
        $ed_mailchimp_newsletter = get_theme_mod('ed_mailchimp_newsletter', $kushak_default['ed_mailchimp_newsletter']);
        $ed_mailchimp_newsletter_first_loading_only = get_theme_mod('ed_mailchimp_newsletter_first_loading_only', $kushak_default['ed_mailchimp_newsletter_first_loading_only']);
        if ($ed_mailchimp_newsletter_first_loading_only && isset($_COOKIE['BlogExpress_Visited']) && $_COOKIE['BlogExpress_Visited'] == 'true') {
            $visited = false;
        } else {
            $visited = true;
        }
        if ($visited && $ed_mailchimp_newsletter) {
            $ed_mailchimp_newsletter_home_only = get_theme_mod('ed_mailchimp_newsletter_home_only', $kushak_default['ed_mailchimp_newsletter_home_only']);
            $twp_mailchimp_shortcode = get_theme_mod('twp_mailchimp_shortcode');
            $twp_newsletter_title = get_theme_mod('twp_newsletter_title', $kushak_default['twp_newsletter_title']);
            $twp_newsletter_desc = get_theme_mod('twp_newsletter_desc', $kushak_default['twp_newsletter_desc']);
            $twp_newsletter_image = get_theme_mod('twp_newsletter_image');
            if ($ed_mailchimp_newsletter_home_only) {
                if (is_home() || is_front_page()) {
                    $load_pages = true;
                } else {
                    $load_pages = false;
                }
            } else {
                $load_pages = true;
            }
            if ($load_pages) { ?>
                <div class="twp-modal <?php if ($ed_mailchimp_newsletter_first_loading_only) {
                    echo 'single-load';
                } else {
                    echo 'kushak-load';
                } ?>">
                    <div class="twp-modal-overlay twp-modal-toggle"></div>
                    <div class="twp-modal-wrapper twp-modal-transition">
                        <div class="twp-modal-body">
                            <div class="newsletter-content-wrapper">
                                <div class="newsletter-image">
                                    <div class="data-bg data-bg-xbig" data-background="<?php echo esc_url($twp_newsletter_image); ?>">
                                    </div>
                                </div>
                                <div class="newsletter-content">
                                    <button class="twp-modal-close twp-modal-toggle">
                                        <?php kushak_the_theme_svg('cross'); ?>
                                    </button>
                                    <div class="newsletter-content-details">
                                        <?php if ($twp_newsletter_title) { ?>
                                            <h3><?php echo esc_html($twp_newsletter_title); ?></h3>
                                        <?php } ?>
                                        <?php if ($twp_newsletter_desc) { ?>
                                            <div class="newsletter-content-excerpt"><?php echo esc_html($twp_newsletter_desc); ?></div>
                                        <?php } ?>
                                        <?php if ($twp_mailchimp_shortcode) { ?>
                                            <div class="mailchimp-form-wrapper">
                                                <?php echo do_shortcode($twp_mailchimp_shortcode); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
endif;
add_action('kushak_before_footer_content_action', 'kushak_popup_newsletter', 30);
if (!function_exists('kushak_newsletter_section')) :
    function kushak_newsletter_section()
    {
        $kushak_default = kushak_get_default_theme_options();
        $ed_mailchimp_newsletter_section = get_theme_mod('ed_mailchimp_newsletter_section', $kushak_default['ed_mailchimp_newsletter_section']);
        $newsletter_ed = true;
        if ($newsletter_ed && $ed_mailchimp_newsletter_section) {
            $twp_newsletter_title_section = get_theme_mod('twp_newsletter_title_section', $kushak_default['twp_newsletter_title_section']);
            $twp_newsletter_desc_section = get_theme_mod('twp_newsletter_desc_section', $kushak_default['twp_newsletter_desc_section']);
            $twp_mailchimp_shortcode_section = get_theme_mod('twp_mailchimp_shortcode_section');
            ?>
            <div class="theme-block theme-block-newsletter">
                <div class="wrapper">
                    <div class="twp-newsletter-content">
                        <div class="theme-block-header block-header-bold">
                            <?php if ($twp_newsletter_title_section) { ?>
                                <h2 class="theme-block-title">
                                    <?php echo esc_html($twp_newsletter_title_section); ?>
                                </h2>
                            <?php } ?>
                            <?php if ($twp_newsletter_desc_section) { ?>
                                <div class="theme-block-subtext">
                                    <?php echo esc_html($twp_newsletter_desc_section); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <?php if ($twp_mailchimp_shortcode_section) { ?>
                            <div class="twp-newsletter-form">
                                <?php echo do_shortcode($twp_mailchimp_shortcode_section); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }
endif;
if (!function_exists('kushak_you_may_like_section')):
    // Single Posts Related Posts.
    function kushak_you_may_like_section()
    {
        $kushak_default = kushak_get_default_theme_options();
        $ed_recommended_section = get_theme_mod('ed_recommended_section', $kushak_default['ed_recommended_section']);
        $ed_recommended_section_title = get_theme_mod('ed_recommended_section_title', $kushak_default['ed_recommended_section_title']);
        if ($ed_recommended_section) {
            $ed_recommended_section_cat = get_theme_mod('ed_recommended_section_cat');
            $ed_recommended_section_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 12, 'category_name' => $ed_recommended_section_cat, 'post__not_in' => get_option("sticky_posts")));
            if ($ed_recommended_section_query->have_posts()): ?>
                <div class="theme-block theme-block-recommended">
                    <div class="wrapper">
                        <header class="theme-block-header">
                            <h2 class="theme-block-title"><?php echo esc_html($ed_recommended_section_title); ?></h2>
                        </header>
                        <div class="theme-recommendation-slider">
                            <?php
                            while ($ed_recommended_section_query->have_posts()):
                                $ed_recommended_section_query->the_post(); ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class('theme-recommended-article'); ?>>
                                    <div class="entry-wrapper">
                                        <?php
                                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                        $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                        <div class="entry-thumbnail">
                                            <a href="<?php the_permalink(); ?>" class="data-bg data-bg-xbig"
                                               data-background="<?php echo esc_url($featured_image); ?>"></a>
                                        </div>
                                        <div class="post-content">
                                            <div class="entry-meta theme-meta-categories">
                                                <?php kushak_entry_footer($cats = true, $tags = false, $edits = false); ?>
                                            </div>
                                            <header class="entry-header">
                                                <h3 class="entry-title entry-title-large">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h3>
                                            </header>
                                            <div class="entry-meta">
                                                <?php kushak_posted_by(); ?>
                                            </div>
                                            <div class="entry-content entry-content-small">
                                                <?php
                                                if (has_excerpt()) {
                                                    the_excerpt();
                                                } else {
                                                    echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            <?php
                            endwhile; ?>
                        </div>
                    </div>
                </div>
                <?php
                wp_reset_postdata();
            endif;
        }
    }
endif;
if (!function_exists('kushak_featured_category_section')):
    // Single Posts Related Posts.
    function kushak_featured_category_section()
    {
        $kushak_default = kushak_get_default_theme_options();
        $ed_category_section = get_theme_mod('ed_category_section', $kushak_default['ed_category_section']);
        if ($ed_category_section) { ?>
            <div class="theme-block theme-block-categories theme-block-bg">
                <div class="wrapper">
                    <div class="wrapper-inner">
                        <?php
                        for ($x = 1; $x <= 10; $x++) {
                            $c_category = get_theme_mod('kushak_category_cat_' . $x);
                            if ($c_category) {
                                $cat_obj = get_category_by_slug($c_category);
                                $cat_name = isset($cat_obj->name) ? $cat_obj->name : '';
                                $cat_id = isset($cat_obj->term_id) ? $cat_obj->term_id : '';
                                $cat_link = get_category_link($cat_id);
                                $twp_term_image = get_term_meta($cat_id, 'twp-term-featured-image', true); ?>
                                <div class="column column-3 column-sm-6 column-xs-12 theme-categories-panel mt-sm-20 mb-sm-20">
                                    <div class="post-thumb-categories">
                                        <div class="data-bg data-bg-medium" data-background="<?php echo esc_url($twp_term_image); ?>">
                                            <a class="theme-image-responsive" href="<?php echo esc_url($cat_link); ?>" tabindex="0"></a>
                                        </div>
                                    </div>
                                    <div class="categories-content">
                                        <?php
                                        if ($cat_name) { ?>
                                            <h3 class="category-title">
                                                <?php echo esc_html($cat_name); ?>
                                            </h3>
                                            <a class="category-link" href="<?php echo esc_url($cat_link); ?>">
                                                <?php echo esc_html__('Learn more', 'kushak'); ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php
                            }
                        } ?>
                    </div>
                </div>
            </div>
        <?php }
    }
endif;
if (!function_exists('kushak_content_offcanvas')):
    // Offcanvas Contents
    function kushak_content_offcanvas()
    { ?>
        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">
                <div class="close-offcanvas-menu">
                    <div class="offcanvas-close">
                        <a href="javascript:void(0)" class="skip-link-menu-start"></a>
                        <button type="button" class="button-offcanvas-close">
                            <?php kushak_the_theme_svg('close'); ?>
                        </button>
                    </div>
                </div>
                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'kushak'); ?>"
                         role="navigation">
                        <ul class="primary-menu">
                            <?php
                            if (has_nav_menu('kushak-primary-menu')) {
                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'kushak-primary-menu',
                                        'show_toggles' => true,
                                    )
                                );
                            } else {
                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => false,
                                        'title_li' => false,
                                        'show_toggles' => true,
                                        'walker' => new Kushak_Walker_Page(),
                                    )
                                );
                            } ?>
                        </ul>
                    </nav><!-- .primary-menu-wrapper -->
                </div>
                <?php if (has_nav_menu('kushak-social-menu')) { ?>
                    <div id="social-nav-offcanvas"
                         class="offcanvas-item offcanvas-social-navigation theme-social-navigation">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'kushak-social-menu',
                            'link_before' => '<span class="screen-reader-text">',
                            'link_after' => '</span>',
                            'container' => 'div',
                            'container_class' => 'social-menu',
                            'depth' => 1,
                        )); ?>
                    </div>
                <?php } ?>
                <a href="javascript:void(0)" class="skip-link-menu-end"></a>
            </div>
        </div>
        <?php
    }
endif;
add_action('kushak_before_footer_content_action', 'kushak_content_offcanvas', 30);
if (!function_exists('kushak_footer_content_widget')):
    function kushak_footer_content_widget()
    {
        $kushak_default = kushak_get_default_theme_options();
        if (is_active_sidebar('kushak-footer-widget-0') ||
            is_active_sidebar('kushak-footer-widget-1') ||
            is_active_sidebar('kushak-footer-widget-2')):
            $x = 1;
            $footer_sidebar = 0;
            do {
                if ($x == 3 && is_active_sidebar('kushak-footer-widget-2')) {
                    $footer_sidebar++;
                }
                if ($x == 2 && is_active_sidebar('kushak-footer-widget-1')) {
                    $footer_sidebar++;
                }
                if ($x == 1 && is_active_sidebar('kushak-footer-widget-0')) {
                    $footer_sidebar++;
                }
                $x++;
            } while ($x <= 3);
            if ($footer_sidebar == 1) {
                $footer_sidebar_class = 12;
            } elseif ($footer_sidebar == 2) {
                $footer_sidebar_class = 6;
            } else {
                $footer_sidebar_class = 4;
            }
            $footer_column_layout = absint(get_theme_mod('footer_column_layout', $kushak_default['footer_column_layout'])); ?>
            <div class="footer-widgetarea">
                <div class="wrapper-inner">
                    <?php if (is_active_sidebar('kushak-footer-widget-0')): ?>
                        <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                            <?php dynamic_sidebar('kushak-footer-widget-0'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('kushak-footer-widget-1')): ?>
                        <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                            <?php dynamic_sidebar('kushak-footer-widget-1'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('kushak-footer-widget-2')): ?>
                        <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                            <?php dynamic_sidebar('kushak-footer-widget-2'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php
        endif;
    }
endif;
add_action('kushak_footer_content_action', 'kushak_footer_content_widget', 10);
if (!function_exists('kushak_footer_content_info')):
    /**
     * Footer Copyright Area
     **/
    function kushak_footer_content_info()
    {

        $kushak_default = kushak_get_default_theme_options(); ?>
        <div class="footer-credits">
            <?php
            $ed_footer_copyright = wp_kses_post(get_theme_mod('ed_footer_copyright', $kushak_default['ed_footer_copyright']));
            $footer_copyright_text = wp_kses_post(get_theme_mod('footer_copyright_text', $kushak_default['footer_copyright_text']));
            echo esc_html__('Copyright ', 'kushak') . '&copy ' . absint(date('Y')) . ' <a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name', 'display')) . '" ><span>' . esc_html(get_bloginfo('name', 'display')) . '. </span></a> ' . esc_html($footer_copyright_text);
            if ($ed_footer_copyright) {
                echo '<br>';
                echo esc_html__('Theme: ', 'kushak') . 'Kushak ' . esc_html__('By ', 'kushak') . '<a href="' . esc_url('https://www.themeinwp.com/theme/kushak') . '"  title="' . esc_attr__('Themeinwp', 'kushak') . '" target="_blank" rel="author"><span>' . esc_html__('Themeinwp. ', 'kushak') . '</span></a>';
                echo esc_html__('Powered by ', 'kushak') . '<a href="' . esc_url('https://wordpress.org') . '" title="' . esc_attr__('WordPress', 'kushak') . '" target="_blank"><span>' . esc_html__('WordPress.', 'kushak') . '</span></a>';
            } ?>
        </div>
        <?php
    }
endif;
add_action('kushak_footer_content_action', 'kushak_footer_content_info', 20);
if (!function_exists('kushak_footer_go_to_top')):
    // Scroll to Top render content
    function kushak_footer_go_to_top()
    { ?>
        <a class="to-the-top theme-action-control" href="#site-header">
            <span class="to-the-top-long">
                <?php printf(esc_html__('To the top %s', 'kushak'), '<span class="arrow" aria-hidden="true">&uarr;</span>'); ?>
            </span>
            <span class="to-the-top-short">
                <?php printf(esc_html__('Up %s', 'kushak'), '<span class="arrow" aria-hidden="true">&uarr;</span>'); ?>
            </span>
        </a>
        <?php
    }
endif;
if (!function_exists('kushak_color_schema_color')):
    function kushak_color_schema_color($current_color)
    {
        $kushak_default = kushak_get_default_theme_options();
        $colors_schema = array(
            'default' => array(
                'background_color' => '#ffffff',
                'kushak_primary_color' => $kushak_default['kushak_primary_color'],
                'kushak_secondary_color' => $kushak_default['kushak_secondary_color'],
                'kushak_general_color' => $kushak_default['kushak_general_color'],
            ),
            'dark' => array(
                'background_color' => '#222222',
                'kushak_primary_color' => $kushak_default['kushak_primary_color_dark'],
                'kushak_secondary_color' => $kushak_default['kushak_secondary_color_dark'],
                'kushak_general_color' => $kushak_default['kushak_general_color_dark'],
            ),
            'fancy' => array(
                'background_color' => '#faf7f2',
                'kushak_primary_color' => $kushak_default['kushak_primary_color_fancy'],
                'kushak_secondary_color' => $kushak_default['kushak_secondary_color_fancy'],
                'kushak_general_color' => $kushak_default['kushak_general_color_fancy'],
            ),
        );
        if (isset($colors_schema[$current_color])) {
            return $colors_schema[$current_color];
        }
        return;
    }
endif;
if (!function_exists('kushak_color_schema_color_action')) :
    function kushak_color_schema_color_action()
    {
        if (isset($_POST['currentColor']) && sanitize_text_field(wp_unslash($_POST['currentColor']))) {
            $current_color = sanitize_text_field(wp_unslash($_POST['currentColor']));
            $color_schemes = kushak_color_schema_color($current_color);
            if ($color_schemes) {
                echo json_encode($color_schemes);
            }
        }
        wp_die();
    }
endif;
add_action('wp_ajax_nopriv_kushak_color_schema_color', 'kushak_color_schema_color_action');
add_action('wp_ajax_kushak_color_schema_color', 'kushak_color_schema_color_action');
if (!function_exists('kushak_iframe_escape')):
    /** Escape Iframe **/
    function kushak_iframe_escape($input)
    {
        $all_tags = array(
            'iframe' => array(
                'width' => array(),
                'height' => array(),
                'src' => array(),
                'frameborder' => array(),
                'allow' => array(),
                'allowfullscreen' => array(),
            ),
            'video' => array(
                'width' => array(),
                'height' => array(),
                'src' => array(),
                'style' => array(),
                'controls' => array(),
            )
        );
        return wp_kses($input, $all_tags);
    }
endif;
if (class_exists('Booster_Extension_Class')) {
    add_filter('booster_extemsion_content_after_filter', 'kushak_after_content_pagination');
}
if (!function_exists('kushak_after_content_pagination')):
    function kushak_after_content_pagination($after_content)
    {
        $pagination_single = wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'kushak'),
            'after' => '</div>',
            'echo' => false
        ));
        $after_content = $pagination_single . $after_content;
        return $after_content;
    }
endif;
if (!function_exists('kushak_excerpt_content')):
    function kushak_excerpt_content()
    {
        $kushak_default = kushak_get_default_theme_options();
        $ed_post_excerpt = get_theme_mod('ed_post_excerpt', $kushak_default['ed_post_excerpt']);
        if ($ed_post_excerpt) { ?>
            <div class="entry-content entry-content-medium mt-10">
                <?php
                if (has_excerpt()) {
                    the_excerpt();
                } else {
                    echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                } ?>
            </div>
        <?php }
    }
endif;
if (!function_exists('kushak_get_sidebar')):
    function kushak_get_sidebar()
    {
        $kushak_default = kushak_get_default_theme_options();
        $kushak_post_sidebar_option = esc_attr(get_post_meta(get_the_ID(), 'kushak_post_sidebar_option', true));
        if ($kushak_post_sidebar_option == '' || $kushak_post_sidebar_option == 'global-sidebar') {
            $global_sidebar_layout = get_theme_mod('global_sidebar_layout', $kushak_default['global_sidebar_layout']);
            $sidebar = $global_sidebar_layout;
        } else {
            $sidebar = $kushak_post_sidebar_option;
        }
        if (!is_active_sidebar('sidebar-1')) {
            $sidebar = 'no-sidebar';
        }
        return $sidebar;
    }
endif;
if (!function_exists('kushak_svg_escape')):
    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function kushak_svg_escape($input)
    {
        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            $input,
            array(
                'svg' => array(
                    'class' => true,
                    'xmlns' => true,
                    'width' => true,
                    'height' => true,
                    'viewbox' => true,
                    'aria-hidden' => true,
                    'role' => true,
                    'focusable' => true,
                ),
                'path' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'd' => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'points' => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );
        if (!$svg) {
            return false;
        }
        return $svg;
    }
endif;