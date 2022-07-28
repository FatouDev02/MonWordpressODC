<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kushak
 * @since 1.0.0
 */ ?>

</div>
	
	<?php

	/**
	 * Toogle Contents
	 * @hooked kushak_header_toggle_search - 10
	 * @hooked kushak_content_offcanvas - 30
	*/
    kushak_newsletter_section();
	do_action('kushak_before_footer_content_action');
	?>

    <footer id="site-footer" role="contentinfo">
        <div class="wrapper">
            <div class="wrapper-inner">
                <div class="column column-8 column-sm-12">
                    <div class="site-footer-left">
                    <?php
                    /**
                     * Footer Content
                     * @hooked kushak_footer_content_widget - 10
                     * @hooked kushak_footer_content_info - 20
                     */

                    do_action('kushak_footer_content_action'); ?>
                    </div>
                </div>
                <div class="column column-4 column-sm-12 has-gradient">
                    <div class="site-footer-right">


                        <?php if (has_nav_menu('kushak-footer-menu')) { ?>
                            <div class="theme-footer-navigation">
                                <div class="widget-title footer-navigation-title">
                                    <?php echo esc_html__('Quick Links:', 'kushak') ?>
                                </div>

                                <div class="theme-quick-navigation">
                                    <?php wp_nav_menu(array(
                                        'theme_location' => 'kushak-footer-menu',
                                        'container' => 'div',
                                        'container_class' => 'theme-quick-menu',
                                        'depth' => 1,
                                    )); ?>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                    <?php kushak_footer_go_to_top(); ?>
                </div>
            </div>
        </div>



    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
