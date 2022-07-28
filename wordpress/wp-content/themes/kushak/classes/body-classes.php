<?php
/**
* Body Classes.
*
* @package Kushak
*/
 
 if (!function_exists('kushak_body_classes')) :

    function kushak_body_classes($classes) {

        $kushak_default = kushak_get_default_theme_options();
        $kushak_color_schema = get_theme_mod( 'kushak_color_schema',$kushak_default['kushak_color_schema'] );
        $ed_desktop_menu = get_theme_mod( 'ed_desktop_menu',$kushak_default['ed_desktop_menu'] );
        global $post;
        
        // Adds a class of hfeed to non-singular pages.
        if ( !is_singular() ) {
            $classes[] = 'hfeed';
        }
        if( $ed_desktop_menu ){

            $classes[] = 'enabled-desktop-menu';

        }else{

            $classes[] = 'disabled-desktop-menu';

        }

        $classes[] = 'color-scheme-'.esc_attr( $kushak_color_schema );

        return $classes;
    }

endif;

add_filter('body_class', 'kushak_body_classes');