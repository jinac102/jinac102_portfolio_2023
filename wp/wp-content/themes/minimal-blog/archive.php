<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal Blog
 */
global $minimal_blog_post_counter;

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :
            $minimal_blog_post_counter = 1; ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'components/post/content', get_post_format() );

			endwhile;

		else :

			get_template_part( 'components/post/content', 'none' );

		endif; ?>

		</main>

		<div class="minimal-archive-nav">
			<?php
			the_posts_navigation(array(
	            'prev_text' => '<span class="arrow" aria-hidden="true">' . minimal_blog_the_theme_svg('arrow-left',$return = true ) . '</span><span>' . __('Older post:', 'minimal-blog') . '</span>',
	            'next_text' => '<span>' . __('Newer post:', 'minimal-blog') . '</span><span class="arrow" aria-hidden="true">' . minimal_blog_the_theme_svg('arrow-right',$return = true ) . '</span>',
	        )); ?>
        </div>

	</div>
<?php
get_sidebar();
get_footer();
