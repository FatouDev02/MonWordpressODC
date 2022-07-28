<?php
/**
* Color Settings.
*
* @package Kushak
*/

$kushak_default = kushak_get_default_theme_options();

$wp_customize->add_section( 'color_scheme',
    array(
    'title'      => esc_html__( 'Color Scheme', 'kushak' ),
    'priority'   => 60,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_colors_panel',
    )
);

// Color Scheme.
$wp_customize->add_setting(
    'kushak_color_schema',
    array(
        'default' 			=> $kushak_default['kushak_color_schema'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_select'
    )
);
$wp_customize->add_control(
    new Kushak_Custom_Radio_Color_Schema( 
        $wp_customize,
        'kushak_color_schema',
        array(
            'settings'      => 'kushak_color_schema',
            'section'       => 'color_scheme',
            'label'         => esc_html__( 'Color Scheme', 'kushak' ),
            'choices'       => array(
                'default'  => array(
                	'color' => array('#ffffff','#000','#72df14','#000'),
                	'title' => esc_html__('Default','kushak'),
                ),
                'fancy'  => array(
                	'color' => array('#faf7f2','#017eff','#fc9285','#455d58'),
                	'title' => esc_html__('Fancy','kushak'),
                ),
                'dark'  => array(
                    'color' => array('#222222','#007CED','#fb7268','#ffffff'),
                    'title' => esc_html__('Dark','kushak'),
                ),
            )
        )
    )
);

$wp_customize->add_setting( 'kushak_primary_color',
    array(
    'default'           => $kushak_default['kushak_primary_color'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'kushak_primary_color', 
    array(
        'label'      => esc_html__( 'Primary Color', 'kushak' ),
        'section'    => 'colors',
        'settings'   => 'kushak_primary_color',
    ) ) 
);

$wp_customize->add_setting( 'kushak_secondary_color',
    array(
    'default'           => $kushak_default['kushak_secondary_color'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'kushak_secondary_color', 
    array(
        'label'      => esc_html__( 'Secondary Color', 'kushak' ),
        'section'    => 'colors',
        'settings'   => 'kushak_secondary_color',
    ) ) 
);

$wp_customize->add_setting( 'kushak_general_color',
    array(
    'default'           => $kushak_default['kushak_general_color'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'kushak_general_color', 
    array(
        'label'      => esc_html__( 'General Color', 'kushak' ),
        'section'    => 'colors',
        'settings'   => 'kushak_general_color',
    ) ) 
);

$wp_customize->add_setting(
    'kushak_premium_notiece_color_schema',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Kushak_Premium_Notiece_Control( 
        $wp_customize,
        'kushak_premium_notiece_color_schema',
        array(
            'label'      => esc_html__( 'Color Schemes', 'kushak' ),
            'settings' => 'kushak_premium_notiece_color_schema',
            'section'       => 'color_scheme',
        )
    )
);


$wp_customize->add_setting(
    'kushak_premium_notiece_color',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Kushak_Premium_Notiece_Control( 
        $wp_customize,
        'kushak_premium_notiece_color',
        array(
            'label'      => esc_html__( 'Color Options', 'kushak' ),
            'settings' => 'kushak_premium_notiece_color',
            'section'       => 'colors',
        )
    )
);