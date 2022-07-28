<?php
/**
* Mailchimp Newsletter Settings.
*
* @package Kushak
*/

$kushak_defaults = kushak_get_default_theme_options();

// Mailchimp Newsletter Section.
$wp_customize->add_section( 'twp_mailchimp_newsletter',
	array(
	'title'      => esc_html__( 'Newsletter Settings', 'kushak' ),
	'capability' => 'edit_theme_options',
    'priority'   => 10,
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_mailchimp_newsletter_section',
    array(
        'default' => $kushak_defaults['ed_mailchimp_newsletter_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_mailchimp_newsletter_section',
    array(
        'label' => esc_html__('Enable Newsletter Section', 'kushak'),
        'section' => 'twp_mailchimp_newsletter',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('kushak_newsletter_bg_color',
    array(
        'default' => $kushak_defaults['kushak_newsletter_bg_color'],
        'sanitize_callback' => 'sanitize_hex_color'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control(
    $wp_customize,
    'kushak_newsletter_bg_color',
        array(
            'label'      => esc_html__( 'Newsletter Section Background Color', 'kushak' ),
            'section'    => 'twp_mailchimp_newsletter',
        )
    )
);

$wp_customize->add_setting('kushak_newsletter_text_color',
    array(
        'default' => $kushak_defaults['kushak_newsletter_text_color'],
        'sanitize_callback' => 'sanitize_hex_color'
    )
);
$wp_customize->add_control( new WP_Customize_Color_Control(
    $wp_customize,
    'kushak_newsletter_text_color',
        array(
            'label'      => esc_html__( 'Newsletter Section Text Color', 'kushak' ),
            'section'    => 'twp_mailchimp_newsletter',
        )
    )
);

$wp_customize->add_setting( 'twp_newsletter_title_section',
    array(
    'default'           => $kushak_defaults['twp_newsletter_title_section'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'twp_newsletter_title_section',
    array(
    'label'    => esc_html__( 'Newsletter Section Title', 'kushak' ),
    'section'  => 'twp_mailchimp_newsletter',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'twp_newsletter_desc_section',
    array(
    'default'           => $kushak_defaults['twp_newsletter_desc_section'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'twp_newsletter_desc_section',
    array(
    'label'    => esc_html__( 'Newsletter Section Description', 'kushak' ),
    'section'  => 'twp_mailchimp_newsletter',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'twp_mailchimp_shortcode_section',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'twp_mailchimp_shortcode_section',
    array(
    'label'    => esc_html__( 'Mailchimp Shortcode', 'kushak' ),
    'section'  => 'twp_mailchimp_newsletter',
    'type'     => 'textarea',
    )
);

$wp_customize->add_setting(
    'mailchimp_popup_newsletter_sep',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Kushak_Separator(
        $wp_customize,
        'mailchimp_popup_newsletter_sep',
        array(
            'settings'      => 'mailchimp_popup_newsletter_sep',
            'section'       => 'twp_mailchimp_newsletter',
            'label'         => esc_html__( 'Popup Newsletter Settings', 'kushak' ),
        )
    )
);

$wp_customize->add_setting('ed_mailchimp_newsletter',
    array(
        'default' => $kushak_defaults['ed_mailchimp_newsletter'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_mailchimp_newsletter',
    array(
        'label' => esc_html__('Enable Popup Newsletter', 'kushak'),
        'section' => 'twp_mailchimp_newsletter',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_mailchimp_newsletter_home_only',
    array(
        'default' => $kushak_defaults['ed_mailchimp_newsletter_home_only'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_mailchimp_newsletter_home_only',
    array(
        'label' => esc_html__('Prompt only on Homepage', 'kushak'),
        'section' => 'twp_mailchimp_newsletter',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_mailchimp_newsletter_first_loading_only',
    array(
        'default' => $kushak_defaults['ed_mailchimp_newsletter_first_loading_only'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_mailchimp_newsletter_first_loading_only',
    array(
        'label' => esc_html__('Do not show this again this session', 'kushak'),
        'section' => 'twp_mailchimp_newsletter',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('twp_newsletter_image',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
);
$wp_customize->add_control( new WP_Customize_Image_Control(
    $wp_customize,
    'twp_newsletter_image',
        array(
            'label'      => esc_html__( 'Newsletter Image', 'kushak' ),
            'section'    => 'twp_mailchimp_newsletter',
        )
    )
);

$wp_customize->add_setting( 'twp_newsletter_title',
    array(
    'default'           => $kushak_defaults['twp_newsletter_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'twp_newsletter_title',
    array(
    'label'    => esc_html__( 'Newsletter Title', 'kushak' ),
    'section'  => 'twp_mailchimp_newsletter',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'twp_newsletter_desc',
    array(
    'default'           => $kushak_defaults['twp_newsletter_desc'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'twp_newsletter_desc',
    array(
    'label'    => esc_html__( 'Newsletter Description', 'kushak' ),
    'section'  => 'twp_mailchimp_newsletter',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'twp_mailchimp_shortcode',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'twp_mailchimp_shortcode',
    array(
    'label'    => esc_html__( 'Mailchimp Shortcode', 'kushak' ),
    'section'  => 'twp_mailchimp_newsletter',
    'type'     => 'textarea',
    )
);