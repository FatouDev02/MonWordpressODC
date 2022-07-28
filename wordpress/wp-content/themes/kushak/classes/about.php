<?php

/**
 * Kushak About Page
 * @package Kushak
 *
*/

if( !class_exists('Kushak_About_page') ):

	class Kushak_About_page{

		function __construct(){

			add_action('admin_menu', array($this, 'kushak_backend_menu'),999);

		}

		// Add Backend Menu
        function kushak_backend_menu(){

            add_theme_page(esc_html__( 'Kushak Options','kushak' ), esc_html__( 'Kushak Options','kushak' ), 'activate_plugins', 'kushak-about', array($this, 'kushak_main_page'));

        }

        // Settings Form
        function kushak_main_page(){

            require get_template_directory() . '/classes/about-render.php';

        }

	}

	new Kushak_About_page();

endif;