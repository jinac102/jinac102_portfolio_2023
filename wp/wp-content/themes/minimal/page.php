<?php get_header(); ?>

<!-- 게시물이 있으면 본문 출력 -->

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!-- while 반복문으로 
사용해서 -->

<main class="content">
    <div class="container about_content shadow">
        <h2>page 템플릿</h2>
        <?php the_content(); ?>
    </div>
</main>

<?php endwhile; else : ?>
	<p><?php esc_html_e( '죄송합니다. 맞는 글이 없습니다.' ); ?></p>
<?php endif; ?><!-- while 반복문을 끊어줌 -->


<?php get_footer(); ?>