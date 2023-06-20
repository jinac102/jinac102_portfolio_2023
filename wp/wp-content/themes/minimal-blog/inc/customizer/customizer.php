<?php
/**
 * Minimal Blog Theme Customizer
 *
 * @package Minimal Blog
 */

/**
 * Customizer theme mode and default value
 */
require get_template_directory().'/inc/customizer/customizer-mode.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function minimal_blog_customize_register( $wp_customize ) {

    require get_template_directory().'/inc/customizer/customizer-functions.php';

    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    require get_template_directory().'/inc/customizer/customizer-upsell.php';
    require get_template_directory().'/inc/customizer/customizer-added-options.php';

}
add_action( 'customize_register', 'minimal_blog_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function minimal_blog_customize_preview_js() {
	wp_enqueue_script( 'minimal_blog_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'minimal_blog_customize_preview_js' );

function minimal_blog_upsell_js() {
    wp_enqueue_script('upsell-js', get_template_directory_uri() . '/inc/customizer/upsell.js', array('jquery','customize-controls'), '', 1);
}
add_action('customize_controls_init', 'minimal_blog_upsell_js');
