<?php
/**
* Header Options.
*
* @package Kushak
*/

$kushak_default = kushak_get_default_theme_options();
$kushak_post_category_list = kushak_post_category_list();

// Header Advertise Area Section.
$wp_customize->add_section( 'main_header_setting',
	array(
	'title'      => esc_html__( 'Header Settings', 'kushak' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Enable Disable Search.
$wp_customize->add_setting('ed_header_search',
    array(
        'default' => $kushak_default['ed_header_search'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_search',
    array(
        'label' => esc_html__('Enable Search', 'kushak'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_desktop_menu',
    array(
        'default' => $kushak_default['ed_desktop_menu'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_desktop_menu',
    array(
        'label' => esc_html__('Hide Horizontal Menu on Desktop', 'kushak'),
        'description' => esc_html__('Check to hide a regular menu on desktop screens and display a menu button instead.', 'kushak'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting('ed_top_filter',
    array(
        'default' => $kushak_default['ed_top_filter'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_top_filter',
    array(
        'label' => esc_html__('Enable Filter Content', 'kushak'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_filter_and_featured_post_section',
    array(
        'default' => $kushak_default['ed_filter_and_featured_post_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_filter_and_featured_post_section',
    array(
        'label' => esc_html__('Enable Latest Post', 'kushak'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('mg_filter_and_featured_post_section_cat',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_select',
    )
);
$wp_customize->add_control('mg_filter_and_featured_post_section_cat',
    array(
        'label' => esc_html__('Choose category for Latest Post', 'kushak'),
        'section' => 'main_header_setting',
        'type' => 'select',
        'choices' => $kushak_post_category_list,
    )
);
