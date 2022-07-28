<?php
/**
* Carousel Section
*
* @package Kushak
*/

$kushak_default = kushak_get_default_theme_options();
$kushak_post_category_list = kushak_post_category_list();

// Slider Section.
$wp_customize->add_section( 'kushak_carousel_section',
	array(
	'title'      => esc_html__( 'Carousel Slideshow Section', 'kushak' ),
	'capability' => 'edit_theme_options',
    'panel'      => 'homepage_section_panel',
	)
);

$wp_customize->add_setting('ed_carousel_section',
    array(
        'default' => $kushak_default['ed_carousel_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_carousel_section',
    array(
        'label' => esc_html__('Enable Carousel Slideshow', 'kushak'),
        'section' => 'kushak_carousel_section',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting( 'carousel_section_title',
    array(
    'default'           => $kushak_default['carousel_section_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'carousel_section_title',
    array(
    'label'       => esc_html__( 'Choose Header Title', 'kushak' ),
    'section'     => 'kushak_carousel_section',
    'type'        => 'text',
    )
);


$wp_customize->add_setting('mg_carousel_section_cat',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_select',
    )
);
$wp_customize->add_control('mg_carousel_section_cat',
    array(
        'label' => esc_html__('Choose category for Carousel Slideshow', 'kushak'),
        'section' => 'kushak_carousel_section',
        'type' => 'select',
        'choices' => $kushak_post_category_list,
    )
);

$wp_customize->add_setting('ed_carousel_autoplay',
    array(
        'default' => $kushak_default['ed_carousel_autoplay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_carousel_autoplay',
    array(
        'label' => esc_html__('Enable Autoplay', 'kushak'),
        'section' => 'kushak_carousel_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_carousel_arrow',
    array(
        'default' => $kushak_default['ed_carousel_arrow'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_carousel_arrow',
    array(
        'label' => esc_html__('Enable Arrow', 'kushak'),
        'section' => 'kushak_carousel_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_carousel_dots',
    array(
        'default' => $kushak_default['ed_carousel_dots'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_carousel_dots',
    array(
        'label' => esc_html__('Enable Dots', 'kushak'),
        'section' => 'kushak_carousel_section',
        'type' => 'checkbox',
    )
);