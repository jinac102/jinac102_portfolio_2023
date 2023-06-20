<?php get_header(); ?>

<!-- 게시물이 있으면 본문 출력 -->

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!-- while 반복문으로 
사용해서 -->


<?php if( get_field('rep_img01') ){ ?><!-- 포트폴리오 양식의 글 템플릿 -->
    <main class="content portoflio-single">
        <div class="container">
            <div class="row">
                <div class="col-md-8 decription">
                    <div class="contents shadow">
                        <img src="<?php the_field('rep_img01'); ?>" alt="">
                        <p>image description 1</p>
                    </div>
                    <div class="contents shadow">
                    <img src="<?php the_field('rep_img02'); ?>" alt="">
                        <p>image description 2</p>
                    </div>
                </div>
                <div class="col-md-4 portfolio_info">
                    <div class="contents shadow">
                        <h2><?php the_title(); ?></h2>
                        <p><?php the_content(); ?></p>
                        <p class="link">
                            <a href="<?php the_field('site'); ?>">Visit site &rarr;</a>
                        </p>
                        <hr class="double">
                        <blockquote>
                            <p><?php the_field('review'); ?> </p>
                            <small>- <?php the_field('reviewer'); ?> -</small>
                        </blockquote>
                        <p class="nav">
                            <a href="" class="secondary-btn">&larr; Previous Project</a>
                            <a href="" class="secondary-btn">Next Project &rarr;</a>
                        </p>
                        <?php previous_post_link( '%link', __( '&larr; Previous Project', 'jinac' ), true ); ?> 
                        <?php next_post_link( '%link', __( 'Next Project &rarr;', 'jinac' ), true ); ?> 
                    </div>
                </div>
            </div> 
        </div>   
    </main>


    <?php } else {?>
        <!-- 보통 글 템플릿 -->
        <main class="content">
            <div class="container latest_portfolio">
                <h3 class="heading6">Related portfolio entries</h3>
                    <!-- <?php //the_content(); ?> 일반적인 text랑 게시판 text를 구분해야한다 -->
                    <?php
                        query_posts( array(
                            'category_name'  => 'portfolio',
                            'posts_per_page' => 3
                        ) ); 
                    ?>
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
                    <?php
                        wp_reset_query();
                    ?>
            </div>
        </main>
    <?php }?>

    <?php if( get_field('sub_heading') ): ?>
        <h2><?php the_field('sub_heading'); ?></h2>
    <?php endif; ?>

<?php endwhile; else : ?>
	<p><?php esc_html_e( '죄송합니다. 맞는 글이 없습니다.' ); ?></p>
<?php endif; ?><!-- while 반복문을 끊어줌 -->


<?php get_footer(); ?>