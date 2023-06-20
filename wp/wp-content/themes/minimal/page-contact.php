<?php get_header(); ?>

<main class="content">
    <h2>contact form</h2>
    <div class="container about_content shadow">
            <div class="contact">
                <h3 class="heading6">Let’s Get in Touch</h3>
                <p>
                You can call me, email me directly or connect with me through my social networks.
                </p>
                <p>
                    (+40) 744122222<br/>
                    <a href="mailto:hello@adipurdila.com">hello@adipurdila.com</a>               
                </p>
                <ul class="social_links">
                    <li><a href=""><img src="<?php bloginfo('template_url'); ?>/images/twitter.png" alt="twitter"></a></li>
                    <li><a href=""><img src="<?php bloginfo('template_url'); ?>/images/facebook.png" alt="facebook"></a></li>
                    <li><a href=""><img src="<?php bloginfo('template_url'); ?>/images/dribble.png" alt="dribble"></a></li>
                </ul>                                
            </div>
            <hr class="double">
            <div class="form">
                <h3 class="heading6">Need a Quote?</h3>
                <p>
                    Use the form below. All fields are required.
                </p>
                <div class="contact_form">
                    <?php echo do_shortcode(
                        '[contact-form-7 id="64" title="CONTACT-FORM"]'
                    ); ?>
                </div>
            </div>
        </div>
</main>

<?php get_footer(); ?>