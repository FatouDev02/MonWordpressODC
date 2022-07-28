<?php
/**
 * Kushak Dynamic Styles
 *
 * @package Kushak
 */

function kushak_dynamic_css()
{

    $kushak_default = kushak_get_default_theme_options();
    $background_color = get_theme_mod('background_color', $kushak_default['background_color']);

    $background_color = '#' . str_replace("#", "", $background_color);

    $kushak_primary_color = get_theme_mod('kushak_primary_color', $kushak_default['kushak_primary_color']);
    $kushak_secondary_color = get_theme_mod('kushak_secondary_color', $kushak_default['kushak_secondary_color']);
    $kushak_general_color = get_theme_mod('kushak_general_color', $kushak_default['kushak_general_color']);

    $logo_width_range = get_theme_mod('logo_width_range', $kushak_default['logo_width_range']);

    echo "<style type='text/css' media='all'>"; ?>


    body.theme-color-schema,
    .floating-post-navigation .floating-navigation-label,
    .header-searchbar-inner,
    .offcanvas-wraper{
    background-color: <?php echo esc_attr($background_color); ?>;
    }

    body.theme-color-schema,
    body,
    .floating-post-navigation .floating-navigation-label,
    .header-searchbar-inner,
    .offcanvas-wraper{
    color: <?php echo esc_attr($kushak_general_color); ?>;
    }

    a{
    color: <?php echo esc_attr($kushak_primary_color); ?>;
    }


    body .theme-page-vitals,
    body .site-navigation .primary-menu > li > a:before,
    body .site-navigation .primary-menu > li > a:after,
    body .site-navigation .primary-menu > li > a:after,
    body .site-navigation .primary-menu > li > a:hover:before,
    body .entry-thumbnail .trend-item,
    body .category-widget-header .post-count{
    background: <?php echo esc_attr($kushak_secondary_color); ?>;
    }

    body a:hover,
    body a:focus,
    body .footer-credits a:hover,
    body .footer-credits a:focus,
    body .widget a:hover,
    body .widget a:focus {
    color: <?php echo esc_attr($kushak_secondary_color); ?>;
    }

    button:hover,
    .button:hover,
    .wp-block-button__link:hover,
    .wp-block-file__button:hover,
    input[type="button"]:hover,
    input[type="reset"]:hover,
    input[type="submit"]:hover,
    button:focus,
    .button:focus,
    .wp-block-button__link:focus,
    .wp-block-file__button:focus,
    input[type="button"]:focus,
    input[type="reset"]:focus,
    input[type="submit"]:focus{
    background-color: <?php echo esc_attr($kushak_secondary_color); ?>;
    border-color: <?php echo esc_attr($kushak_secondary_color); ?>;
    }

    body input[type="text"]:hover,
    body input[type="text"]:focus,
    body input[type="password"]:hover,
    body input[type="password"]:focus,
    body input[type="email"]:hover,
    body input[type="email"]:focus,
    body input[type="url"]:hover,
    body input[type="url"]:focus,
    body input[type="date"]:hover,
    body input[type="date"]:focus,
    body input[type="month"]:hover,
    body input[type="month"]:focus,
    body input[type="time"]:hover,
    body input[type="time"]:focus,
    body input[type="datetime"]:hover,
    body input[type="datetime"]:focus,
    body input[type="datetime-local"]:hover,
    body input[type="datetime-local"]:focus,
    body input[type="week"]:hover,
    body input[type="week"]:focus,
    body input[type="number"]:hover,
    body input[type="number"]:focus,
    body input[type="search"]:hover,
    body input[type="search"]:focus,
    body input[type="tel"]:hover,
    body input[type="tel"]:focus,
    body input[type="color"]:hover,
    body input[type="color"]:focus,
    body textarea:hover,
    body textarea:focus,
    button:focus,
    body .button:focus,
    body .wp-block-button__link:focus,
    body .wp-block-file__button:focus,
    body input[type="button"]:focus,
    body input[type="reset"]:focus,
    body input[type="submit"]:focus,
    .site-header-top:hover,
    .theme-block-bg:hover,
    .theme-banner-slider .banner-content-area:hover,
    .theme-recommended-article .post-content:hover,
    .entry-meta-author .entry-meta-avatar:hover,
    .entry-featured-thumbnail:hover,
    .slide-btn-small:hover,
    .data-bg:hover,
    .site-header-top:focus,
    .theme-block-bg:focus,
    .theme-banner-slider .banner-content-area:focus,
    .theme-recommended-article .post-content:focus,
    .entry-meta-author .entry-meta-avatar:focus,
    .entry-featured-thumbnail:focus,
    .slide-btn-small:focus,
    .data-bg:focus{
    outline-color:  <?php echo esc_attr($kushak_secondary_color); ?>;
    }

    body a:focus{
    outline-color:  <?php echo esc_attr($kushak_secondary_color); ?>;
    }

    .site-logo .custom-logo-link{
    max-width:  <?php echo esc_attr($logo_width_range); ?>px;
    }
    <?php echo "</style>";
}

add_action('wp_head', 'kushak_dynamic_css', 100);

/**
 * Sanitizing Hex color function.
 */
function kushak_sanitize_hex_color($color)
{

    if ('' === $color)
        return '';
    if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color))
        return $color;

}