<?php
/**
* Archive Settings.
*
* @package Kushak
*/

$kushak_default = kushak_get_default_theme_options();

// Single Post Section.
$wp_customize->add_section( 'archive_settings',
	array(
	'title'      => esc_html__( 'Archive Settings', 'kushak' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);
