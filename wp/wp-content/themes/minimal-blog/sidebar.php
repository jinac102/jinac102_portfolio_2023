<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Minimal Blog
 */
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
if( is_single() || is_page() ){

    global $post;
    $single_sidebar = esc_html( get_post_meta( $post->ID, 'minimal_blog_post_sidebar_option', true ) ); 
    if( $single_sidebar == '' || $single_sidebar == 'global-sidebar' ){

        $single_sidebar = minimal_blog_get_option('select_single_global_sidebar_layout');

    }

    if ($single_sidebar == 'no-sidebar'){
	    return;
	}

}else{

	if (minimal_blog_get_option('select_global_sidebar_layout') == 'no-sidebar'){
	    return;
	}

}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
