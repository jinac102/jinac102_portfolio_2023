<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Minimal Blog
 */

global $post;
$single_sidebar = esc_html( get_post_meta( $post->ID, 'minimal_blog_post_sidebar_option', true ) ); 
if( $single_sidebar == '' || $single_sidebar == 'global-sidebar' ){

    $single_sidebar = minimal_blog_get_option('select_single_global_sidebar_layout');

}

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'components/post/content','single' );

			if( 1 == minimal_blog_get_option('related_post') ){ ?>
				<!-- related post -->
	            <div class="interface-related-articles">

	            	<?php if( !empty( minimal_blog_get_option('related_post_title') ) ){ ?>

		                <div class="related-post-header">
		                    <h2 class="related-post-title">
	                            <?php echo esc_html(minimal_blog_get_option('related_post_title')); ?>
	                        </h2>
		                </div>

	            	<?php }

	                $category_ids = array();
	                $categories = get_the_category(get_the_ID());

	                if (!empty($categories)) {
	                    foreach ($categories as $category) {
	                        $category_ids[] = $category->term_id;
	                    }
	                }

	                if( !empty( $category_ids ) ){

	                    $args = array(
	                        'posts_per_page' => 4,
	                        'category__in' => $category_ids,
	                        'post__not_in' => array(get_the_ID()),
	                    );
	                    $related_posts = new WP_Query($args);
	                    if( $related_posts->have_posts() ):

	                        while ($related_posts->have_posts()) : $related_posts->the_post(); ?>

	                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	                            	<?php if( has_post_thumbnail() ){ ?>

		                                <div class="related-post-image">
		                                    <a href="<?php the_permalink(); ?>">
		                                        <?php
		                                        if( $single_sidebar == 'no-sidebar' ){

		                                        	the_post_thumbnail('medium_large');

		                                        }else{

		                                        	the_post_thumbnail('medium');

		                                        } ?>

		                                    </a>
		                                </div>

		                            <?php } ?>
	                            
	                                <div class="related-post-details">
	                                    <header class="entry-header">

	                                        	<?php
	                                            the_title( '<h4 class="entry-title entry-title-small"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
	                                        	?>

	                                        <div class="entry-meta">
	                                            <?php
	                                            minimal_blog_posted_on();
	                                            ?>
	                                        </div><!-- .entry-meta -->

	                                    </header><!-- .entry-header -->
	                                </div>

	                            </article><!-- #post-<?php the_ID(); ?> -->

	                        <?php
	                    	endwhile;

	                    	wp_reset_postdata();

	                	endif;
	                } ?>

	            </div>

	        <?php }
	        
			// Previous/next post navigation.
            the_post_navigation(array(
                'prev_text' => '<span class="arrow" aria-hidden="true">' . minimal_blog_the_theme_svg('arrow-left',$return = true ) . '</span><span class="screen-reader-text">' . __('Previous post:', 'minimal-blog') . '</span><span class="post-title">%title</span>',
                'next_text' => '<span class="screen-reader-text">' . __('Next post:', 'minimal-blog') . '</span><span class="post-title">%title</span><span class="arrow" aria-hidden="true">' . minimal_blog_the_theme_svg('arrow-right',$return = true ) . '</span>',
            ));

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main>
	</div>
<?php
get_sidebar();
get_footer();
