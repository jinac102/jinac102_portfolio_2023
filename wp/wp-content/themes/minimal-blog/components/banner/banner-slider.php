<?php
if (!function_exists('minimal_blog_front_page_banner_slider')) :
    /**
     * Front Page Banner Slider
     */
    function minimal_blog_front_page_banner_slider()
    {
        if (1 == minimal_blog_get_option('enable_banner_slider')) {
            $banner_slider_args = array(
                'post_type' => 'post',
                'cat' => absint(minimal_blog_get_option('category_for_banner_slider')),
                'ignore_sticky_posts' => true,
                'posts_per_page' => 4,
            ); ?>
            <?php $rtl_class = 'false';
            if(is_rtl()){ 
                $rtl_class = 'true';
            }?>
            <div class="slick main-slider" data-slick='{"rtl": <?php echo($rtl_class); ?>}'>
            <?php $banner_slider_post_query = new WP_Query($banner_slider_args);
            if ($banner_slider_post_query->have_posts()) :
                while ($banner_slider_post_query->have_posts()) : $banner_slider_post_query->the_post();
                    if (has_post_thumbnail()) {
                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                        $url = $thumb['0'];
                    } else {
                        $url = '';
                    }
                    ?>
                    <div class="slide-item">
                        <a href="<?php the_permalink(); ?>" class="background-src slider-background">
                            <img src="<?php echo esc_url($url); ?>">
                        </a>
                        <div class="slide-content">
                            <div class="entry-header">
                                <div class="entry-header-wrapper">
                                    <div class="entry-meta post-category">
                                        <?php minimal_blog_category(); ?>
                                    </div>
                                    <h3 class="entry-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <div class="entry-meta">
                                        <div class="meta">
                                            <?php minimal_blog_posted_on(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
            endif;
            wp_reset_postdata();
            echo '</div>';
        }
    }
endif;
minimal_blog_front_page_banner_slider();