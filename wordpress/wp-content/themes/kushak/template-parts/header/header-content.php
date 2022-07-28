<?php
/**
 * Header Layout 1
 *
 * @package Kushak
 */
$kushak_default = kushak_get_default_theme_options();
$ed_desktop_menu = get_theme_mod('ed_desktop_menu', $kushak_default['ed_desktop_menu']);
$ed_site_description = get_theme_mod('ed_site_description', $kushak_default['ed_site_description']);
?>

<div class="site-header-top">
    <div class="wrapper">
        <div class="wrapper-inner">

            <div class="header-component header-component-left">
                <div class="header-titles">

                    <?php
                    // Site title or logo.
                    kushak_site_logo();
                    if ($ed_site_description) {
                        // Site description.
                        kushak_site_description();
                    }
                    ?>

                </div><!-- .header-titles -->
                <div class="navbar-components">
                    <?php if ($ed_desktop_menu) { ?>


                        <div class="site-navigation">
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
                                            )
                                        );

                                    } else {

                                        wp_list_pages(
                                            array(
                                                'match_menu_classes' => true,
                                                'show_sub_menu_icons' => true,
                                                'title_li' => false,
                                                'walker' => new Kushak_Walker_Page(),
                                            )
                                        );

                                    } ?>

                                </ul>

                            </nav><!-- .primary-menu-wrapper -->
                        </div><!-- .site-navigation -->


                    <?php } ?>



                </div>
            </div><!-- .header-component-left -->


            <div class="header-component header-component-right">
                <?php if (has_nav_menu('kushak-social-menu')) { ?>
                    <div id="social-nav-header" class="site-social-navigation theme-social-navigation hidden-sm-screen">
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

                <div class="navbar-filter-controls">
                    <?php
                    $kushak_default = kushak_get_default_theme_options();
                    $ed_top_filter = get_theme_mod('ed_top_filter', $kushak_default['ed_top_filter']);
                    $ed_filter_and_featured_post_section = get_theme_mod('ed_filter_and_featured_post_section', $kushak_default['ed_filter_and_featured_post_section']);
                    ?>


                    <?php if ($ed_top_filter) { ?>
                        <button type="button" class="navbar-control theme-action-control tab-link theme-filter-toggle active" data-tab="1">
                            <?php kushak_the_theme_svg('filter'); ?>
                        </button>
                    <?php } ?>
                    <?php if ($ed_filter_and_featured_post_section) { ?>
                        <button type="button" class="navbar-control theme-action-control tab-link theme-latest-toggle" data-tab="2">
                            <?php kushak_the_theme_svg('lightning'); ?>
                        </button>
                    <?php } ?>
                    


                </div>

                <div class="navbar-controls hide-no-js">
                    <?php
                    $ed_header_search = get_theme_mod('ed_header_search', $kushak_default['ed_header_search']);
                    if ($ed_header_search) { ?>

                        <button type="button" class="navbar-control theme-action-control navbar-control-search">
                            <?php kushak_the_theme_svg('search'); ?>
                        </button>

                    <?php } ?>

                    <button type="button" class="navbar-control theme-action-control navbar-control-offcanvas">
                        <?php kushak_the_theme_svg('menu'); ?>
                    </button>

                </div>

            </div><!-- .header-component-right -->

        </div>
    </div>
</div>
<div class="site-header-bottom">
    <?php // filter and featured block
    kushak_filter_and_featured_section();
    ?>
</div>
