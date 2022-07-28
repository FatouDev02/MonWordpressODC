<?php
/**
* Category Options.
*
* @package Kushak
*/

$kushak_default = kushak_get_default_theme_options();
$kushak_post_category_list = kushak_post_category_list();

$wp_customize->add_section( 'header_category_setting',
    array(
    'title'      => esc_html__( 'Categories Section', 'kushak' ),
    'capability' => 'edit_theme_options',
    'panel'      => 'homepage_section_panel',
    )
);

$wp_customize->add_setting('ed_category_section',
    array(
        'default' => $kushak_default['ed_category_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_category_section',
    array(
        'label' => esc_html__('Enable Category Section', 'kushak'),
        'section' => 'header_category_setting',
        'type' => 'checkbox',
    )
);

for ($x = 1; $x <= 4; $x++) {

    $wp_customize->add_setting( 'kushak_category_cat_'.$x,
        array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'kushak_sanitize_select',
        )
    );
    $wp_customize->add_control( 'kushak_category_cat_'.$x,
        array(
        'label'       => esc_html__( 'Category ', 'kushak' ).$x,
        'section'     => 'header_category_setting',
        'type'        => 'select',
        'choices'     => $kushak_post_category_list,
        )
    );

}