<?php
/**
 * Social Link Widgets.
 *
 * @package Minimal Blog
 */

if (!function_exists('minimal_blog_social_link_widget')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function minimal_blog_social_link_widget()
    {

        // Social Link Widget.
        register_widget('Minimal_Blog_Social_Link_widget');

    }
endif;
add_action('widgets_init', 'minimal_blog_social_link_widget');


/*Social widget*/
if (!class_exists('Minimal_Blog_Social_Link_widget'))  :

    /**
     * Social widget Class.
     *
     * @since 1.0.0
     */
    class Minimal_Blog_Social_Link_widget extends Minimal_Blog_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'minimal_blog_social_widget',
                'description' => esc_html__('Displays Social share.', 'minimal-blog'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Title:', 'minimal-blog'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'url-fb' => array(
                    'label' => esc_html__('Facebook URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-tw' => array(
                    'label' => esc_html__('Twitter URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-lt' => array(
                    'label' => esc_html__('Linkedin URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-ig' => array(
                    'label' => esc_html__('Instagram URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-pt' => array(
                    'label' => esc_html__('Pinterest URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-rt' => array(
                    'label' => esc_html__('Reddit URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-sk' => array(
                    'label' => esc_html__('Skype URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-sc' => array(
                    'label' => esc_html__('Snapchat URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-tr' => array(
                    'label' => esc_html__('Tumblr URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-th' => array(
                    'label' => esc_html__('Twitch URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-yt' => array(
                    'label' => esc_html__('Youtube URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-vo' => array(
                    'label' => esc_html__('Vimeo URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-wa' => array(
                    'label' => esc_html__('Whatsapp URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-wp' => array(
                    'label' => esc_html__('WordPress URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-gh' => array(
                    'label' => esc_html__('Github URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-fs' => array(
                    'label' => esc_html__('FourSquare URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-db' => array(
                    'label' => esc_html__('Dribbble URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-vk' => array(
                    'label' => esc_html__('VK URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-tt' => array(
                    'label' => esc_html__('TikTok URL:', 'minimal-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
            );

            parent::__construct('minimal-blog-social-layout', esc_html__('Minimal Blog: Social Widget', 'minimal-blog'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         * @since 1.0.0
         *
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if (!empty($params['title'])) {
                echo $args['before_title'] . esc_html($params['title']) . $args['after_title'];
            } ?>

            <div class="interface-social-widget">
                <ul class="interface-widget-list social-widget-list">

                    <?php if (!empty($params['url-fb'])) { ?>
                        <li class="theme-social-facebook">
                            <a href="<?php echo esc_url($params['url-fb']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('facebook'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Facebook', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-tw'])) { ?>
                        <li class="theme-social-twitter">
                            <a href="<?php echo esc_url($params['url-tw']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('twitter'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Twitter', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-lt'])) { ?>
                        <li class="theme-social-linkedin">
                            <a href="<?php echo esc_url($params['url-lt']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('linkedin'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('LinkedIn', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-ig'])) { ?>
                        <li class="theme-social-instagram">
                            <a href="<?php echo esc_url($params['url-ig']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('instagram'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Instagram', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-pt'])) { ?>
                        <li class="theme-social-pinterest">
                            <a href="<?php echo esc_url($params['url-pt']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('pinterest'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Pinterest', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-rt'])) { ?>
                        <li class="theme-social-reddit">
                            <a href="<?php echo esc_url($params['url-rt']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('reddit'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Reddit', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-sk'])) { ?>
                        <li class="theme-social-skype">
                            <a href="<?php echo esc_url($params['url-sk']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('skype'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Skype', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-sc'])) { ?>
                        <li class="theme-social-snapchat">
                            <a href="<?php echo esc_url($params['url-sc']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('snapchat'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Snapchat', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-tr'])) { ?>
                        <li class="theme-social-tumblr">
                            <a href="<?php echo esc_url($params['url-tr']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('tumblr'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Tumblr', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-th'])) { ?>
                        <li class="theme-social-twitch">
                            <a href="<?php echo esc_url($params['url-th']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('twitch'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Twitch', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-yt'])) { ?>
                        <li class="theme-social-youtube">
                            <a href="<?php echo esc_url($params['url-yt']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('youtube'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Youtube', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-vo'])) { ?>
                        <li class="theme-social-vimeo">
                            <a href="<?php echo esc_url($params['url-vo']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('vimeo'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Vimeo', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-wa'])) { ?>
                        <li class="theme-social-whatsapp">
                            <a href="<?php echo esc_url($params['url-wa']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('whatsapp'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('WhatsApp', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-wp'])) { ?>
                        <li class="theme-social-wordpress">
                            <a href="<?php echo esc_url($params['url-wp']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('wordpress'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('WordPress', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-gh'])) { ?>
                        <li class="theme-social-github">
                            <a href="<?php echo esc_url($params['url-gh']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('github'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('GitHub', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-fs'])) { ?>
                        <li class="theme-social-foursquare">
                            <a href="<?php echo esc_url($params['url-fs']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('foursquare'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Foursquare', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-db'])) { ?>
                        <li class="theme-social-dribbble">
                            <a href="<?php echo esc_url($params['url-db']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('dribbble'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Dribbble', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-vk'])) { ?>
                        <li class="theme-social-vk">
                            <a href="<?php echo esc_url($params['url-vk']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('vk'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('VK', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $params['url-tt'] ) ) { ?>
                        <li class="theme-social-tiktok">
                            <a href="<?php echo esc_url($params['url-tt']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php minimal_blog_the_theme_svg('tiktok'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('TikTok', 'minimal-blog'); ?></span>
                            </a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;

