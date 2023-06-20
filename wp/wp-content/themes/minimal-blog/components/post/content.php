<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal Blog
 */
global $minimal_blog_post_counter;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ($minimal_blog_post_counter % 2 == 0) {
        $content_class = '';
        $content_class = 'style-bordered-right';
    } else {
        $content_class = 'style-bordered-left';
    }
    if (!has_post_thumbnail()) {
        $content_class = 'style-bordered-no-image';
    } ?>
    <div class="style-archive style-bordered <?php echo $content_class; ?>">
        <?php if ('' != get_the_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('minimal-blog-featured-image'); ?>
                </a>
            </div>
        <?php endif; ?>
        <div class="post-content">

            <header class="entry-header">

                <?php minimal_blog_post_format_icon(); ?>

                <h2 class="entry-title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>

                <?php
                if ('post' === get_post_type()) :

                    get_template_part('components/post/content', 'meta');

                endif; ?>

            </header>

            <div class="entry-content">
                <?php the_excerpt(); ?>

                <a href="<?php the_permalink(); ?>"
                   class="btn-main"><?php _e('Continue Reading', 'minimal-blog'); ?></a>

            </div>

        </div>
    </div>
    <?php $minimal_blog_post_counter++; ?>
</article><!-- #post-## -->