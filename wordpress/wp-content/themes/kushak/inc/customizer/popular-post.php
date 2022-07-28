<?php
/**
* Popular Post Section
*
* @package Kushak
*/

$kushak_default = kushak_get_default_theme_options();
$kushak_post_category_list = kushak_post_category_list();

// Slider Section.
$wp_customize->add_section( 'kushak_popular_post_section',
	array(
	'title'      => esc_html__( 'Popular and Trending Post Settings', 'kushak' ),
	'capability' => 'edit_theme_options',
    'panel'      => 'homepage_section_panel',
	)
);

$wp_customize->add_setting('ed_popular_post_section',
    array(
        'default' => $kushak_default['ed_popular_post_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_popular_post_section',
    array(
        'label' => esc_html__('Enable Popular Post', 'kushak'),
        'section' => 'kushak_popular_post_section',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting( 'popular_post_section_title',
    array(
    'default'           => $kushak_default['popular_post_section_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'popular_post_section_title',
    array(
    'label'       => esc_html__( 'Choose Header Title', 'kushak' ),
    'section'     => 'kushak_popular_post_section',
    'type'        => 'text',
    )
);


$wp_customize->add_setting('popular_post_category_section_cat',
    array(
        'default'     => $kushak_default['popular_post_category_section_cat'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_select',
    )
);
$wp_customize->add_control('popular_post_category_section_cat',
    array(
        'label' => esc_html__('Choose category for Popular Post', 'kushak'),
        'section' => 'kushak_popular_post_section',
        'type' => 'select',
        'choices' => $kushak_post_category_list,
    )
);

$wp_customize->add_setting( 'number_of_popular_post',
    array(
        'default'           => $kushak_default['number_of_popular_post'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_positive_integer',
    )
);
$wp_customize->add_control( 'number_of_popular_post',
    array(
        'label'    => __( 'Number Of Popular Post (max-10)', 'kushak' ),
        'section'  => 'kushak_popular_post_section',
        'type'     => 'number',
        'input_attrs'     => array( 'min' => 1, 'max' => 10, 'style' => 'width: 150px;' ),

    )
);


$wp_customize->add_setting('ed_trending_post_section',
    array(
        'default' => $kushak_default['ed_trending_post_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_trending_post_section',
    array(
        'label' => esc_html__('Enable Trending Post', 'kushak'),
        'section' => 'kushak_popular_post_section',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting( 'trending_post_section_title',
    array(
    'default'           => $kushak_default['trending_post_section_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'trending_post_section_title',
    array(
    'label'       => esc_html__( 'Choose Header Title', 'kushak' ),
    'section'     => 'kushak_popular_post_section',
    'type'        => 'text',
    )
);

$wp_customize->add_setting('trending_post_section_cat',
    array(
        'default'     => $kushak_default['trending_post_section_cat'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_select',
    )
);
$wp_customize->add_control('trending_post_section_cat',
    array(
        'label' => esc_html__('Choose category for Trending Post', 'kushak'),
        'section' => 'kushak_popular_post_section',
        'type' => 'select',
        'choices' => $kushak_post_category_list,
    )
);

$wp_customize->add_setting( 'number_of_trending_post',
    array(
        'default'           => $kushak_default['number_of_trending_post'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_positive_integer',
    )
);
$wp_customize->add_control( 'number_of_trending_post',
    array(
        'label'    => __( 'Number Of Trending Post (max-20)', 'kushak' ),
        'section'  => 'kushak_popular_post_section',
        'type'     => 'number',
        'input_attrs'     => array( 'min' => 1, 'max' => 10, 'style' => 'width: 150px;' ),

    )
);

