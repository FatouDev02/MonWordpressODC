<?php
/**
 * Pagination Settings
 *
 * @package Kushak
 */

$kushak_default = kushak_get_default_theme_options();

// Homepage Contact Section.
$wp_customize->add_section( 'homepage_contact_Section',
    array(
    'title'      => esc_html__( 'Contact Section', 'kushak' ),
    'capability' => 'edit_theme_options',
    'panel'      => 'homepage_section_panel',
    )
);

$wp_customize->add_setting('ed_contact_section',
    array(
        'default' => $kushak_default['ed_contact_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_contact_section',
    array(
        'label' => esc_html__('Enable Contact Section', 'kushak'),
        'section' => 'homepage_contact_Section',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting('contact_section_title',
    array(
        'default'           => $kushak_default['contact_section_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('contact_section_title',
    array(
        'label'       => esc_html__('Section Title', 'kushak'),
        'section'     => 'homepage_contact_Section',
        'type'        => 'text',
    )
);

$wp_customize->add_setting('contact_section_location',
    array(
        'default'           => $kushak_default['contact_section_location'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('contact_section_location',
    array(
        'label'       => esc_html__('Contact Location', 'kushak'),
        'section'     => 'homepage_contact_Section',
        'type'        => 'text',
    )
);

$wp_customize->add_setting('contact_section_email',
    array(
        'default'           => $kushak_default['contact_section_email'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('contact_section_email',
    array(
        'label'       => esc_html__('Contact Email', 'kushak'),
        'section'     => 'homepage_contact_Section',
        'type'        => 'text',
    )
);

$wp_customize->add_setting('contact_section_number',
    array(
        'default'           => $kushak_default['contact_section_number'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('contact_section_number',
    array(
        'label'       => esc_html__('Contact Number', 'kushak'),
        'section'     => 'homepage_contact_Section',
        'type'        => 'text',
    )
);

$wp_customize->add_setting('contact_section_bg_image',
    array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_image',
    )
);
$wp_customize->add_control(
    new WP_Customize_Image_Control($wp_customize, 'contact_section_bg_image',
        array(
            'label'       => esc_html__('Upload Section Background Image ', 'kushak'),
            'section'     => 'homepage_contact_Section',
        )
    )
);

$wp_customize->add_setting('contact_form_shortcode',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('contact_form_shortcode',
    array(
        'label' => esc_html__('Contact Form Shortcode', 'kushak'),
        'section' => 'homepage_contact_Section',
        'type' => 'textarea',
    )
);