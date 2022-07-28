<?php
/**
* You may like Section
*
* @package Kushak
*/

$kushak_default = kushak_get_default_theme_options();
$kushak_post_category_list = kushak_post_category_list();

// Slider Section.
$wp_customize->add_section( 'kushak_you_may_like_section',
	array(
	'title'      => esc_html__( 'Recommendation Section', 'kushak' ),
	'capability' => 'edit_theme_options',
    'panel'      => 'homepage_section_panel',
	)
);

$wp_customize->add_setting('ed_recommended_section',
    array(
        'default' => $kushak_default['ed_recommended_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_recommended_section',
    array(
        'label' => esc_html__('Enable Recommended Post', 'kushak'),
        'section' => 'kushak_you_may_like_section',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting( 'ed_recommended_section_title',
    array(
    'default'           => $kushak_default['ed_recommended_section_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ed_recommended_section_title',
    array(
    'label'       => esc_html__( 'Choose Header Title', 'kushak' ),
    'section'     => 'kushak_you_may_like_section',
    'type'        => 'text',
    )
);


$wp_customize->add_setting('ed_recommended_section_cat',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_select',
    )
);
$wp_customize->add_control('ed_recommended_section_cat',
    array(
        'label' => esc_html__('Choose category for Recommended Post', 'kushak'),
        'section' => 'kushak_you_may_like_section',
        'type' => 'select',
        'choices' => $kushak_post_category_list,
    )
);
