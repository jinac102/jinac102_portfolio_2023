<?php get_header(); ?>

<!-- 게시물이 있으면 본문 출력 -->

<main class="content">
    <div class="container latest_portfolio">
        <ul>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

        <?php endwhile; else : ?>
        <p><?php esc_html_e( '죄송합니다. 맞는 글이 없습니다.' ); ?></p>
        <?php endif; ?><!-- while 반복문을 끊어줌 -->
        </ul>
    </div>
</main>




<?php get_footer(); ?>