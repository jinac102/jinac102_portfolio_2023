<?php
/**
 * Recent Post Widgets.
 *
 * @package Minimal Blog
 */
if (!function_exists('minimal_blog_recent_post_widgets')) :

    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function minimal_blog_recent_post_widgets()
    {
        // Recent Post widget.
        register_widget('Minimal_Blog_Sidebar_Recent_Post_Widget');
    }
endif;
add_action('widgets_init', 'minimal_blog_recent_post_widgets');
// Recent Post widget
if (!class_exists('Minimal_Blog_Sidebar_Recent_Post_Widget')) :
    /**
     * Recent Post.
     *
     * @since 1.0.0
     */
    class Minimal_Blog_Sidebar_Recent_Post_Widget extends Minimal_Blog_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'minimal_blog_recent_post_widget',
                'description' => esc_html__('Displays post form selected category specific for popular post in sidebars.', 'minimal-blog'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Title:', 'minimal-blog'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => esc_html__('Select Category:', 'minimal-blog'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'minimal-blog'),
                ),
                'enable_counter' => array(
                    'label' => esc_html__('Enable Counter:', 'minimal-blog'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'post_number' => array(
                    'label' => esc_html__('Number of Posts:', 'minimal-blog'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 9,
                ),
            );
            parent::__construct('minimal-blog-popular-sidebar-layout', esc_html__('Minimal Blog: Recent Widget', 'minimal-blog'), $opts, array(), $fields);
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
            }
            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['cat'] = absint($params['post_category']);
            }
            $recent_posts_query = new WP_Query($qargs);
            $count = 1;

            if ($recent_posts_query->have_posts()) : ?>
                <div class="interface-recent-widget">
                    <ul class="interface-widget-list recent-widget-list">
                        <?php
                        while ($recent_posts_query->have_posts()) :
                            $recent_posts_query->the_post(); ?>
                            <li>
                                <article id="post-<?php the_ID(); ?>" <?php post_class('widget-article-list'); ?>>
                                    <div class="widget-article-image">
                                        <?php
                                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail');
                                        $thumb = isset($thumb[0]) ? $thumb[0] : '';
                                        ?>
                                        <a href="<?php the_permalink(); ?>" class="data-bg data-bg-thumbnail" data-background="<?php echo esc_url($thumb); ?>"></a>
                                        <?php
                                        if (true === $params['enable_counter']) { ?>
                                            <div class="widget-trend-item">
                                                <?php echo $count; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="widget-article-body">
                                        <h3 class="entry-title entry-title-small">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <div class="entry-meta">
                                            <?php minimal_blog_posted_on(); ?>
                                        </div>
                                    </div>
                                </article>
                            </li>
                            <?php
                            $count++;
                        endwhile; ?>

                    </ul>
                </div>
                <?php wp_reset_postdata();
            endif;

            echo $args['after_widget'];
        }
    }
endif;