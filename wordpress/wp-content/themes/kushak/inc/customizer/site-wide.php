<?php
/**
* Site Wide Post Options.
*
* @package Kushak
*/

$kushak_default = kushak_get_default_theme_options();

$wp_customize->add_section( 'site_wide_setting',
	array(
	'title'      => esc_html__( 'Sidebar Settings', 'kushak' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Choose Sidebar Layout.
$wp_customize->add_setting( 'global_sidebar_layout',
    array(
    'default'           => $kushak_default['global_sidebar_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'kushak_sanitize_select',
    )
);
$wp_customize->add_control( 'global_sidebar_layout',
    array(
    'label'       => esc_html__( 'Choose Sidebar Layout', 'kushak' ),
    'section'     => 'site_wide_setting',
    'type'        => 'select',
    'choices'     => array(
        'right-sidebar' => esc_html__( 'Right Sidebar', 'kushak' ),
        'left-sidebar'  => esc_html__( 'Left Sidebar', 'kushak' ),
        'no-sidebar'    => esc_html__( 'No Sidebar', 'kushak' ),
        ),
    )
);
