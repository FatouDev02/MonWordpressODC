<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kushak
 * @since 1.0.0
 */
get_header();

if ( is_paged() || is_archive()) {
    $sidebar = kushak_get_sidebar();
    if ($sidebar == 'left-sidebar' || $sidebar == 'right-sidebar') {
        $class_1 = 'column-9';
        if ($sidebar == 'left-sidebar') {
            $class_2 = 'order-2';
            $class_3 = 'order-1';
        } else {
            $class_2 = 'order-1';
            $class_3 = 'order-2';
        }
    } else {
        $class_1 = 'column-12';
        $class_2 = '';
        $class_3 = '';
    }
    ?>
    <?php if (!is_home() && !is_front_page()) { ?>
        <div class="theme-block theme-block-archive">
            <div class="twp-archive-header">
                <div class="wrapper">
                    <?php kushak_breadcrumb(); ?>
                    <?php kushak_archive_title(); ?>
                </div>
            </div>
        </div>
    <?php } ?>
        <div class="theme-block theme-block-blog">
            <?php
            $kushak_default = kushak_get_default_theme_options(); ?>
            <div class="wrapper">
                <div class="wrapper-inner">
                    <div class="theme-panelarea-primary column <?php echo $class_1; ?> <?php echo $class_2; ?> column-sm-12">
                        <main id="main" class="site-main" role="main">
                            <div class="theme-panelarea theme-panelarea-blocks">
                                <?php if (have_posts()):
                                    global $countI;
                                    $countI == 1;
                                    while (have_posts()) :
                                        the_post();
                                        $twp_be_post_views_count = absint(get_post_meta(get_the_ID(), 'twp_be_post_views_count', true));
                                        $twp_be_like_count = absint(get_post_meta(get_the_ID(), 'twp_be_like_count', true));
                                        ?>
                                        <div class="theme-panel-blocks article-panel-blocks">
                                        <?php get_template_part('template-parts/content', get_post_type()); ?>
                                        </div><?php
                                    endwhile;
                                else :
                                    get_template_part('template-parts/content', 'none');
                                endif; ?>
                            </div>
                            <?php do_action('kushak_archive_pagination'); ?>
                        </main>
                    </div>
                    <?php if ($sidebar != 'no-sidebar') { ?>
                        <div class="theme-panelarea-secondary column column-3 column-sm-12 <?php echo $class_3; ?>">
                            <?php get_sidebar(); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>


<?php } else {

    $kushak_default = kushak_get_default_theme_options();
    $home_section_arrange_vals_1ue = get_theme_mod( 'home_section_arrange_vals_1', $kushak_default['home_section_arrange_vals_1'] );
    $home_section_arrange_vals_1ue = explode(",",$home_section_arrange_vals_1ue );

    $paged_active = false;
    if ( !is_paged() ) {
        $paged_active = true;
    }
    foreach( $home_section_arrange_vals_1ue as $home_section_reorder ){


        switch( $home_section_reorder ){

            case 'static_front_page': ?>
            
                    <?php $sidebar = kushak_get_sidebar();
                    if ($sidebar == 'left-sidebar' || $sidebar == 'right-sidebar') {
                        $class_1 = 'column-9';
                        if ($sidebar == 'left-sidebar') {
                            $class_2 = 'order-2';
                            $class_3 = 'order-1';
                        } else {
                            $class_2 = 'order-1';
                            $class_3 = 'order-2';
                        }
                    } else {
                        $class_1 = 'column-12';
                        $class_2 = '';
                        $class_3 = '';
                    }
                    ?>
                    <?php if (!is_home() && !is_front_page()) { ?>
                        <div class="theme-block theme-block-archive">
                            <div class="twp-archive-header">
                                <div class="wrapper">
                                    <?php kushak_breadcrumb(); ?>
                                    <?php kushak_archive_title(); ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                        <div class="theme-block theme-block-blog">
                            <?php
                            $kushak_default = kushak_get_default_theme_options(); ?>
                            <div class="wrapper">
                                <div class="wrapper-inner">
                                    <div class="theme-panelarea-primary column <?php echo $class_1; ?> <?php echo $class_2; ?> column-sm-12">
                                        <main id="main" class="site-main" role="main">
                                            <div class="theme-panelarea theme-panelarea-blocks">
                                                <?php if (have_posts()):
                                                    global $countI;
                                                    $countI == 1;
                                                    while (have_posts()) :
                                                        the_post();
                                                        $twp_be_post_views_count = absint(get_post_meta(get_the_ID(), 'twp_be_post_views_count', true));
                                                        $twp_be_like_count = absint(get_post_meta(get_the_ID(), 'twp_be_like_count', true));
                                                        ?>
                                                        <div class="theme-panel-blocks article-panel-blocks">
                                                        <?php get_template_part('template-parts/content', get_post_type()); ?>
                                                        </div><?php
                                                    endwhile;
                                                else :
                                                    get_template_part('template-parts/content', 'none');
                                                endif; ?>
                                            </div>
                                            <?php do_action('kushak_archive_pagination'); ?>
                                        </main>
                                    </div>
                                    <?php if ($sidebar != 'no-sidebar') { ?>
                                        <div class="theme-panelarea-secondary column column-3 column-sm-12 <?php echo $class_3; ?>">
                                            <?php get_sidebar(); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                <?php

            break;

            case 'kushak_banner_slider_section':

                if( $paged_active ){
                    kushak_banner_slider_section();
                }

            break;

            case 'header_category_setting':

                if( $paged_active ){
                    kushak_featured_category_section();
                }

            break;


            case 'kushak_you_may_like_section':

                if( $paged_active ){
                    kushak_you_may_like_section();
                }

            break;

            case 'kushak_popular_post_section':

                if( $paged_active ){
                    kushak_popular_post_section();
                }

            break;


            case 'kushak_carousel_section':

                if( $paged_active ){
                    kushak_carousel_section();
                }

            break;

            case 'homepage_contact_Section':

                if( $paged_active ){
                    kushak_contact_section();
                }

            break;

        }

    } 
} 
get_footer();
