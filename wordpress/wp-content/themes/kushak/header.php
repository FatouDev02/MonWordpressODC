<?php
/**
 * Header file for the Kushak WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kushak
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
if( function_exists('wp_body_open') ){
    wp_body_open();
} ?>


<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to the content', 'kushak'); ?></a>

    <header id="site-header" class="theme-site-header" role="banner">
        <?php get_template_part('template-parts/header/header', 'content'); ?>
    </header>

    <div id="content" class="site-content">

    <?php if( ( is_home() || is_front_page() ) ){
        kushak_header_banner_section(); 
    }?>