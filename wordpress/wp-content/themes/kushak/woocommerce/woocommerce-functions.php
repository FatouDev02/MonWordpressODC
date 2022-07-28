<?php
/**
 * Woocommerce Compatibility.
 *
 * @link https://woocommerce.com/
 *
 * @package Kushak
 */

if ( class_exists('WooCommerce') ) {

    remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar',10 );

}

if( !function_exists('kushak_woocommerce_setup') ):

    /**
     * Woocommerce support.
     */
    function kushak_woocommerce_setup(){

        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
        add_theme_support('woocommerce', array(
            'gallery_thumbnail_image_width' => 300,
        ));

    }

endif;

add_action('after_setup_theme', 'kushak_woocommerce_setup');

if( !function_exists('kushak_woocommerce_before_main_content') ):

    // Before Main Content woocommerce hook
    function kushak_woocommerce_before_main_content(){

        echo '<div class="wrapper">';
        echo '<div class="theme-panelarea">';
    }

endif;

if( class_exists('WooCommerce') ){

    add_action('woocommerce_before_main_content', 'kushak_woocommerce_before_main_content', 5);

}

if( !function_exists('kushak_woocommerce_after_main_content') ):

    // After Main Content woocommerce hook
    function kushak_woocommerce_after_main_content(){ ?>

        <?php
        if( is_active_sidebar('kushak-woocommerce-widget') ){ ?>

            <div class="theme-panelarea-secondary column column-3">
                <aside id="secondary" class="widget-area">

                    <?php dynamic_sidebar('kushak-woocommerce-widget'); ?>
                    
                </aside><!-- #secondary -->
            </div>
            
        <?php } ?>

        </div>
        </div>

    <?php
    }

endif;

if( class_exists('WooCommerce') ){

    add_action('woocommerce_after_main_content', 'kushak_woocommerce_after_main_content', 15);

}