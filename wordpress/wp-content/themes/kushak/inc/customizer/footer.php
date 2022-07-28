<?php
/**
* Footer Settings.
*
* @package Kushak
*/

$kushak_default = kushak_get_default_theme_options();


$wp_customize->add_section( 'footer_widget_area',
	array(
	'title'      => esc_html__( 'Footer Settings', 'kushak' ),
	'priority'   => 200,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);


$wp_customize->add_setting( 'footer_column_layout',
	array(
	'default'           => $kushak_default['footer_column_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'kushak_sanitize_select',
	)
);
$wp_customize->add_control( 'footer_column_layout',
	array(
	'label'       => esc_html__( 'Footer Widget-area Column', 'kushak' ),
	'section'     => 'footer_widget_area',
	'type'        => 'select',
	'choices'               => array(
		'1' => esc_html__( 'One Column', 'kushak' ),
		'2' => esc_html__( 'Two Column', 'kushak' ),
	    ),
	)
);

$wp_customize->add_setting( 'footer_copyright_text',
	array(
	'default'           => $kushak_default['footer_copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'footer_copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'kushak' ),
	'section'  => 'footer_widget_area',
	'type'     => 'text',
	)
);