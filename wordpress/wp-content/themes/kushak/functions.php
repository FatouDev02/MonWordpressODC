<?php
/**
 * Kushak functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Kushak
 */

if ( ! function_exists( 'kushak_after_theme_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */

	function kushak_after_theme_support() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => '#ffffff',
			)
		);

		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters( 'kushak_content_width', 970 );
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 120,
				'width'       => 90,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Kushak, use a find and replace
		 * to change 'kushak' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'kushak', get_template_directory() . '/languages' );

		// Add support for full and wide align images.
        add_theme_support( 'align-wide' );
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'wp-block-styles' );

	}

endif;

add_action( 'after_setup_theme', 'kushak_after_theme_support' );

/**
 * Register and Enqueue Styles.
 */
function kushak_register_styles() {

	$kushak_default = kushak_get_default_theme_options();
	
	$theme_version = wp_get_theme()->get( 'Version' );
	$fonts_url = kushak_fonts_url();
    if( $fonts_url ){
    	
    	require_once get_theme_file_path( 'assets/lib/custom/css/wptt-webfont-loader.php' );
        wp_enqueue_style(
			'kushak-google-fonts',
			wptt_get_webfont_url( $fonts_url ),
			array(),
			$theme_version
		);
    }


    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/lib/slick/css/slick.min.css');

    if( class_exists('WooCommerce') ){

	    wp_enqueue_style( 'kushak-woocommerce', get_template_directory_uri() . '/assets/lib/custom/css/woocommerce.css' );

	}
	wp_enqueue_style( 'kushak-style', get_stylesheet_uri(), array(), $theme_version );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	


	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/lib/slick/js/slick.min.js', array('jquery'), '', 1);

	wp_enqueue_script( 'kushak-pagination', get_template_directory_uri() . '/assets/lib/custom/js/pagination.js', array('jquery'), '', 1 );
	wp_enqueue_script( 'kushak-custom', get_template_directory_uri() . '/assets/lib/custom/js/custom.js', array('jquery'), '', 1);

    $ajax_nonce = wp_create_nonce('kushak_ajax_nonce');

    // Global Query
    if( is_front_page() ){

    	$posts_per_page = absint( get_option('posts_per_page') );
        $paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;

        $posts_args = array(
            'posts_per_page'        => $posts_per_page,
            'paged'                 => $paged,
        );

        $posts_qry = new WP_Query( $posts_args );
        $max = $posts_qry->max_num_pages;

    }else{

        global $wp_query;
        $max = $wp_query->max_num_pages;
        $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;

    }

    $kushak_default = kushak_get_default_theme_options();
    $kushak_pagination_layout = get_theme_mod( 'kushak_pagination_layout',$kushak_default['kushak_pagination_layout'] );

    // Pagination Data
    wp_localize_script( 
	    'kushak-pagination', 
	    'kushak_pagination',
	    array(
	        'paged'  => absint( $paged ),
	        'maxpage'   => absint( $max ),
	        'nextLink'   => next_posts( $max, false ),
	        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
	        'loadmore'   => esc_html__( 'Load More Posts', 'kushak' ),
	        'nomore'     => esc_html__( 'No More Posts', 'kushak' ),
	        'loading'    => esc_html__( 'Loading...', 'kushak' ),
	        'pagination_layout'   => esc_html( $kushak_pagination_layout ),
	        'ajax_nonce' => $ajax_nonce,
	     )
	);

    global $post;
    $single_post = 0;
    $kushak_ed_post_reaction = '';

    if( isset( $post->ID ) && isset( $post->post_type ) && $post->post_type == 'post' ){

    	$kushak_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'kushak_ed_post_reaction', true ) );
    	$single_post = 1;

    }
    
	wp_localize_script(
	    'kushak-custom', 
	    'kushak_custom',
	    array(
	    	'single_post'	=> absint( $single_post ),
	        'kushak_ed_post_reaction'  		=> esc_html( $kushak_ed_post_reaction ),
	        'play' => kushak_the_theme_svg( 'play', $return = true ),
            'pause' => kushak_the_theme_svg( 'pause', $return = true ),
            'mute' => kushak_the_theme_svg( 'mute', $return = true ),
            'cross' => kushak_the_theme_svg( 'cross', $return = true ),
            'unmute' => kushak_the_theme_svg( 'unmute', $return = true ),
            'play_text' => esc_html__('Play','kushak'),
            'pause_text' => esc_html__('Pause','kushak'),
            'mute_text' => esc_html__('Mute','kushak'),
            'unmute_text' => esc_html__('Unmute','kushak'),
	     )
	);

}

add_action( 'wp_enqueue_scripts', 'kushak_register_styles' );

/**
 * Admin enqueue script
 */
function kushak_admin_scripts($hook){

	wp_enqueue_media();
	wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style('kushak-admin', get_template_directory_uri() . '/assets/lib/custom/css/admin.css');
    wp_enqueue_script('kushak-admin', get_template_directory_uri() . '/assets/lib/custom/js/admin.js', array('jquery','wp-color-picker'), '', 1);
    
    $ajax_nonce = wp_create_nonce('kushak_ajax_nonce');

    wp_localize_script( 
        'kushak-admin', 
        'kushak_admin',
        array(
            'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
            'ajax_nonce' => $ajax_nonce,
            'active' => esc_html__('Active','kushak'),
	        'deactivate' => esc_html__('Deactivate','kushak'),
	        'upload_image'   =>  esc_html__('Choose Image','kushak'),
            'use_image'   =>  esc_html__('Select','kushak'),
         )
    );
}

add_action('admin_enqueue_scripts', 'kushak_admin_scripts');

function kushak_customize_preview_js() {
	wp_enqueue_script( 'kushak-customizer-preview', get_template_directory_uri() . '/assets/lib/custom/js/customizer-preview.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'kushak_customize_preview_js' );

if( !function_exists( 'kushak_js_no_js_class' ) ) :

	// js no-js class toggle
	function kushak_js_no_js_class() { ?>

		<script>document.documentElement.className = document.documentElement.className.replace( 'no-js', 'js' );</script>
	
	<?php
	}
	
endif;

add_action( 'wp_head', 'kushak_js_no_js_class' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function kushak_menus() {

	$locations = array(
		'kushak-primary-menu'  => esc_html__( 'Primary Menu', 'kushak' ),
		'kushak-footer-menu'  => esc_html__( 'Footer Menu', 'kushak' ),
		'kushak-social-menu'  => esc_html__( 'Social Menu', 'kushak' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'kushak_menus' );

if( class_exists('Demo_Import_Kit_Class') ):

	add_filter('themeinwp_enable_demo_import_compatiblity','kushak_demo_import_filter_apply');

	if( !function_exists('kushak_demo_import_filter_apply') ):

		function kushak_demo_import_filter_apply(){

			return true;

		}

	endif;

endif;

require get_template_directory() . '/assets/lib/tgmpa/recommended-plugins.php';
require get_template_directory() . '/classes/class-svg-icons.php';
require get_template_directory() . '/classes/class-walker-menu.php';
require get_template_directory() . '/classes/plugin-classes.php';
require get_template_directory() . '/classes/about.php';
require get_template_directory() . '/classes/admin-notice.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/single-related-posts.php';
require get_template_directory() . '/inc/custom-functions.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/classes/body-classes.php';
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/metabox.php';
require get_template_directory() . '/inc/term-meta.php';
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/assets/lib/breadcrumbs/breadcrumbs.php';
require get_template_directory() . '/assets/lib/custom/css/style.php';
require get_template_directory() . '/woocommerce/woocommerce-functions.php';