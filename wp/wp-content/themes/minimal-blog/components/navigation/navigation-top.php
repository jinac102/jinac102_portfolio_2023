<nav id="site-navigation" class="main-navigation" role="navigation">
	<span class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
		 <span class="screen-reader-text">
			<?php esc_html_e('Primary Menu', 'minimal-blog'); ?>
		</span>
		<i class="ham"></i>
	</span>

	<?php wp_nav_menu(array(
		'theme_location' => 'menu-1',
		'menu_id' => 'primary-menu',
		'container' => 'div',
		'container_class' => 'menu'
	)); ?>

    <div class="social-icons">
        <?php
        wp_nav_menu(
            array('theme_location' => 'menu-social',
                'link_before' => '<span class="screen-reader-text">',
                'link_after' => '</span>',
                'menu_id' => 'social-menu',
                'fallback_cb' => false,
                'menu_class' => false
            )); ?>
    </div>
</nav>