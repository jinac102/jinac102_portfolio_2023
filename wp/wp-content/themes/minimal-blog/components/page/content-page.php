<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal Blog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	
	<?php if ( has_post_thumbnail( $post->ID ) ) {
	    $banner_image_single_post = get_post_meta( $post->ID, 'minimal-blog-meta-checkbox', true );
	    if ( '' == $banner_image_single_post ) { ?>
	        <div class="post-thumbnail">
	            <a href="<?php the_permalink(); ?>">
	                <?php the_post_thumbnail( 'full' ); ?>
	            </a>
	        </div>
	    <?php }
	}
	?>
	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'minimal-blog' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'minimal-blog' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer>
</article><!-- #post-## -->