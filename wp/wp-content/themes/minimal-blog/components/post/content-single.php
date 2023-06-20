<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal Blog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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
    <header class="entry-header">
        <?php
        the_title( '<h1 class="entry-title">', '</h1>' );
        ?>
    </header>
    <div class="entry-content">
        <?php
        the_content( sprintf(
        /* translators: %s: Name of current post. */
            wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'minimal-blog' ), array( 'span' => array( 'class' => array() ) ) ),
            the_title( '<span class="screen-reader-text">"', '"</span>', false )
        ) );

        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'minimal-blog' ),
            'after'  => '</div>',
        ) );
        ?>
    </div>
    <?php get_template_part( 'components/post/content', 'footer' ); ?>
</article><!-- #post-## -->