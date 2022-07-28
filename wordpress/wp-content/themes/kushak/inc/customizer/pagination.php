<?php
/**
 * Pagination Settings
 *
 * @package Kushak
 */

$kushak_default = kushak_get_default_theme_options();

// Pagination Section.
$wp_customize->add_section( 'kushak_pagination_section',
	array(
	'title'      => esc_html__( 'Pagination Settings', 'kushak' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'		 => 'theme_option_panel',
	)
);

// Pagination Layout Settings
$wp_customize->add_setting( 'kushak_pagination_layout',
	array(
	'default'           => $kushak_default['kushak_pagination_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'kushak_pagination_layout',
	array(
	'label'       => esc_html__( 'Pagination Method', 'kushak' ),
	'section'     => 'kushak_pagination_section',
	'type'        => 'select',
	'choices'     => array(
		'next-prev' => esc_html__('Next/Previous Method','kushak'),
		'numeric' => esc_html__('Numeric Method','kushak'),
		'load-more' => esc_html__('Ajax Load More Button','kushak'),
		'auto-load' => esc_html__('Ajax Auto Load','kushak'),
	),
	)
);