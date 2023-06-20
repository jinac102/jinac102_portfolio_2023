<?php
/**
 * Author Widgets.
 *
 * @package Minimal Blog
 */

if (!function_exists('minimal_blog_author_widgets')):

    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function minimal_blog_author_widgets()
    {

        // Auther widget.
        register_widget('Minimal_Blog_Author_widget');

    }

endif;

add_action('widgets_init', 'minimal_blog_author_widgets');

if (!class_exists('Minimal_Blog_Author_widget')):

    /**
     * Author widget Class.
     *
     * @since 1.0.0
     */

    class Minimal_Blog_Author_widget extends Minimal_Blog_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {

            $opts = array(
                'classname' => 'minimal_blog_author_widget',
                'description' => esc_html__('Displays authors details in post.', 'minimal-blog'),
                'customize_selective_refresh' => true,
            );

            $fields = array(
                'title' => array(
                    'label' => esc_html__('Title:', 'minimal-blog'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'image_bg_url' => array(
                    'label' => esc_html__('Widget Background Image:', 'minimal-blog'),
                    'type' => 'image',
                ),
                'author-name' => array(
                    'label' => esc_html__('Name:', 'minimal-blog'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'description' => array(
                    'label' => esc_html__('Description:', 'minimal-blog'),
                    'type' => 'textarea',
                    'class' => 'widget-content widefat'
                ),
                'image_url' => array(
                    'label' => esc_html__('Author Image:', 'minimal-blog'),
                    'type' => 'image',
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
            );
            parent::__construct('minimal-blog-author-layout', esc_html__('Minimal Blog: Author Widget', 'minimal-blog'), $opts, array(), $fields);
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
            <div class="interface-author-widget">
                <div class="interface-author-panel <?php if ($params['image_bg_url']) { echo "widget-has-background"; } ?>">

                    <?php if (!empty($params['image_bg_url'])) { ?>

                        <div class="data-bg data-bg-small" data-background="<?php echo esc_url($params['image_bg_url']); ?>"></div>

                    <?php } ?>

                    <div class="interface-author-avatar">
                        <?php if (!empty($params['image_url'])) { ?>

                            <div class="data-bg profile-data-bg" data-background="<?php echo esc_url($params['image_url']); ?>"></div>

                        <?php } ?>
                    </div>

                    <div class="author-content">

                        <?php if (!empty($params['author-name'])) { ?>

                            <h3 class="entry-title entry-title-medium"><?php echo esc_html($params['author-name']); ?></h3>

                        <?php } ?>

                        <?php if (!empty($params['description'])) { ?>

                            <div class="author-bio"><?php echo wp_kses_post($params['description']); ?></div>

                        <?php } ?>

                    </div>

                    <div class="author-social-profiles">

                        <?php if (!empty($params['url-fb'])) { ?>

                            <a href="<?php echo esc_url($params['url-fb']); ?>" target="_blank"
                               class="author-social-icon author-social-facebook">

                                <?php minimal_blog_the_theme_svg('facebook'); ?>

                            </a>

                        <?php } ?>

                        <?php if (!empty($params['url-tw'])) { ?>

                            <a href="<?php echo esc_url($params['url-tw']); ?>" target="_blank"
                               class="author-social-icon author-social-twitter">

                                <?php minimal_blog_the_theme_svg('twitter'); ?>

                            </a>

                        <?php } ?>

                        <?php if (!empty($params['url-lt'])) { ?>

                            <a href="<?php echo esc_url($params['url-lt']); ?>" target="_blank"
                               class="author-social-icon author-social-linkedin">

                                <?php minimal_blog_the_theme_svg('linkedin'); ?>

                            </a>

                        <?php } ?>

                        <?php if (!empty($params['url-ig'])) { ?>

                            <a href="<?php echo esc_url($params['url-ig']); ?>" target="_blank"
                               class="author-social-icon author-social-instagram">

                                <?php minimal_blog_the_theme_svg('instagram'); ?>

                            </a>

                        <?php } ?>

                    </div>

                </div>
            </div>
            <?php echo $args['after_widget'];

        }
    }
endif;