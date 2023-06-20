<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Minimal Blog
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'minimal-blog' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'components/post/content', 'search' );

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

	</section>
<?php
get_sidebar();
get_footer();
