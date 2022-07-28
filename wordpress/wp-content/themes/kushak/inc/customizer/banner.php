<?php

$wp_customize->add_setting( 'ed_header_banner',
    array(
    'default'           => $kushak_default['ed_header_banner'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control( 'ed_header_banner',
    array(
    'label'       => esc_html__( 'Enable Banner', 'kushak' ),
    'section'     => 'header_image',
    'type'        => 'checkbox',
    'priority'   => 0,
    )
);

$wp_customize->add_setting( 'header_banner_title',
    array(
    'default'           => $kushak_default['header_banner_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'header_banner_title',
    array(
    'label'       => esc_html__( 'Banner Title', 'kushak' ),
    'section'     => 'header_image',
    'type'        => 'text',
    )
);


$wp_customize->add_setting( 'header_banner_description',
    array(
    'default'           => $kushak_default['header_banner_description'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'header_banner_description',
    array(
    'label'       => esc_html__( 'Banner Description', 'kushak' ),
    'section'     => 'header_image',
    'type'        => 'textarea',
    )
);

$wp_customize->add_setting( 'header_banner_title_link',
    array(
    'default'           => $kushak_default['header_banner_title_link'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'header_banner_title_link',
    array(
    'label'       => esc_html__( 'Banner Title Link URL', 'kushak' ),
    'section'     => 'header_image',
    'type'        => 'text',
    )
);


$wp_customize->add_setting( 'header_button_title',
    array(
    'default'           => $kushak_default['header_button_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'header_button_title',
    array(
    'label'       => esc_html__( 'Banner Button Text', 'kushak' ),
    'section'     => 'header_image',
    'type'        => 'text',
    )
);