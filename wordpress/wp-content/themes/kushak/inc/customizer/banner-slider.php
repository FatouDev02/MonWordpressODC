<?php
/**
* Banner Slider Section
*
* @package Kushak
*/

$kushak_default = kushak_get_default_theme_options();
$kushak_post_category_list = kushak_post_category_list();

// Slider Section.
$wp_customize->add_section( 'kushak_banner_slider_section',
	array(
	'title'      => esc_html__( 'Banner Slider Section', 'kushak' ),
	'capability' => 'edit_theme_options',
    'panel'      => 'homepage_section_panel',
	)
);

$wp_customize->add_setting('ed_banner_slider_section',
    array(
        'default' => $kushak_default['ed_banner_slider_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_banner_slider_section',
    array(
        'label' => esc_html__('Enable Banner Slider', 'kushak'),
        'section' => 'kushak_banner_slider_section',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting('mg_banner_slider_section_cat',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_select',
    )
);
$wp_customize->add_control('mg_banner_slider_section_cat',
    array(
        'label' => esc_html__('Choose category for Banner Slider', 'kushak'),
        'section' => 'kushak_banner_slider_section',
        'type' => 'select',
        'choices' => $kushak_post_category_list,
    )
);

$wp_customize->add_setting('ed_banner_slider_autoplay',
    array(
        'default' => $kushak_default['ed_banner_slider_autoplay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_banner_slider_autoplay',
    array(
        'label' => esc_html__('Enable Autoplay', 'kushak'),
        'section' => 'kushak_banner_slider_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_banner_slider_arrow',
    array(
        'default' => $kushak_default['ed_banner_slider_arrow'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_banner_slider_arrow',
    array(
        'label' => esc_html__('Enable Arrow', 'kushak'),
        'section' => 'kushak_banner_slider_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_banner_slider_dots',
    array(
        'default' => $kushak_default['ed_banner_slider_dots'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_banner_slider_dots',
    array(
        'label' => esc_html__('Enable Dots', 'kushak'),
        'section' => 'kushak_banner_slider_section',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting('ed_banner_similar_post',
    array(
        'default' => $kushak_default['ed_banner_similar_post'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_banner_similar_post',
    array(
        'label' => esc_html__('Enable Similar Author Post', 'kushak'),
        'section' => 'kushak_banner_slider_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'banner_similar_post_title',
    array(
    'default'           => $kushak_default['banner_similar_post_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'banner_similar_post_title',
    array(
    'label'       => esc_html__( 'Similar Post Title', 'kushak' ),
    'section'     => 'kushak_banner_slider_section',
    'type'        => 'text',
    )
);
