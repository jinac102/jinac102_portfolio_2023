<?php get_header(); ?>


<main class="content">
    <div class="container latest_portfolio">
        <div class="row list">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="col-md-4">
                <div class="contents shadow">
                    <?php
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail('full');
                            }
                    ?>
                    <div class="hover_contents">
                        <div class="list_info">
                            <h3>
                                <a href="<?php the_permalink(); ?>"><?php the_content(); ?></a>
                                <img
                                    src="<?php bloginfo('template_url'); ?>/images/portfolio_list_arrow.png"
                                    alt="list arrow"
                                />
                            </h3>
                            <p><a href="<?php the_permalink(); ?>">Click to see project</a></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php endwhile; else : ?>
                <p><?php esc_html_e( '최근 프로젝트가 없습니다' ); ?></p>
            <?php endif; ?>
        </div>
        <?php minimal_numbered_pagination(); ?>
            <!-- <p class="pagenation shadow">
            <a href="" class="secondary-btn active">1</a>      
            <a href="" class="secondary-btn">2</a>      
            <a href="" class="secondary-btn">3</a>      
            <a href="" class="secondary-btn">4</a>      
            </p> -->
    </div>
</main>
<?php get_footer(); ?>