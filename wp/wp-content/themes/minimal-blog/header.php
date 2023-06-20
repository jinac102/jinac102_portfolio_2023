<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Minimal Blog
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
</head>
<?php 
if( is_single() || is_page() ){

    global $post;
    $single_sidebar = esc_html( get_post_meta( $post->ID, 'minimal_blog_post_sidebar_option', true ) ); 
    if( $single_sidebar == '' || $single_sidebar == 'global-sidebar' ){

        $single_sidebar = minimal_blog_get_option('select_single_global_sidebar_layout');

    }

    if ($single_sidebar == 'sidebar-left') {
        $min_custom_class = 'sidebar-left';
    } elseif ($single_sidebar == 'sidebar-right') {
        $min_custom_class = 'sidebar-right';
    } else {
        $min_custom_class = 'no-sidebar';
    }

}else{

    if (minimal_blog_get_option('select_global_sidebar_layout') == 'sidebar-left') {
        $min_custom_class = 'sidebar-left';
    } elseif (minimal_blog_get_option('select_global_sidebar_layout') == 'sidebar-right') {
        $min_custom_class = 'sidebar-right';
    } else {
        $min_custom_class = 'no-sidebar';
    }

} ?>

<body <?php body_class($min_custom_class); ?>>

<?php if (function_exists('wp_body_open')) {
    wp_body_open();
}
?>

<!--Loader-->
<div id="mini-loader">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
        </div>
    </div>
</div>
<!-- Loader end -->

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'minimal-blog'); ?></a>
    <div class="mastbar">
        <div class="wrapper">
            <?php minimal_blog_social_menu(); ?>
        </div>
    </div>

    <header id="masthead" class="site-header" role="banner">
        <div class="wrapper">
            <?php get_template_part('components/header/site', 'branding'); ?>
        </div>
        <div class="wrapper">
            <?php get_template_part('components/navigation/navigation', 'top'); ?>
        </div>

    </header>
    <div id="content" class="site-content">
        <div class="wrapper">
<?php if (is_front_page()) {
    get_template_part('components/banner/banner', 'slider');
    get_template_part('components/banner/featured', 'category');
} ?>