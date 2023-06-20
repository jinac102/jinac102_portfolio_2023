<?php
/**
 * Minimal Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Minimal Blog
 */

if (!function_exists('minimal_blog_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function minimal_blog_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on components, use a find and replace
         * to change 'minimal-blog' to the name of your theme in all the template files.
         */
        load_theme_textdomain('minimal-blog', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        add_image_size('minimal-blog-featured-image', 820, 860);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Top', 'minimal-blog'),
            'menu-social' => esc_html__('Social Menu', 'minimal-blog'),
        ));

        /**
         * Add support for core custom logo.
         */
        add_theme_support('custom-logo', array(
            'height' => 200,
            'width' => 200,
            'flex-width' => true,
            'flex-height' => true,
            'header-text' => array('site-title', 'site-description'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'image',
            'video',
            'gallery',
            'audio',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('minimal_blog_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));


        /**
         * Add theme support for gutenberg block
         *
         */
        add_theme_support( 'align-wide' );

        add_theme_support( 'responsive-embeds' );

        add_theme_support( 'wp-block-styles' );
    }
endif;
add_action('after_setup_theme', 'minimal_blog_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function minimal_blog_content_width()
{
    $GLOBALS['content_width'] = apply_filters('minimal_blog_content_width', 640);
}

add_action('after_setup_theme', 'minimal_blog_content_width', 0);

/**
 * Return early if Custom Logos are not available.
 *
 * @todo Remove after WP 4.7
 */
function minimal_blog_the_custom_logo()
{
    if (!function_exists('the_custom_logo')) {
        return;
    } else {
        the_custom_logo();
    }
}

/**
 * Enqueue scripts and styles.
 */
function minimal_blog_scripts()
{
    wp_enqueue_style('slick', get_template_directory_uri() . '/assets/lib/slick/css/slick.min.css');
    wp_enqueue_style('magnific-popup', get_template_directory_uri().'/assets/lib/magnific-popup/magnific-popup.css');

    wp_enqueue_style('minimal-blog-style', get_stylesheet_uri());

    $fonts_url = minimal_blog_fonts_url();
    if (!empty($fonts_url)) {
        wp_enqueue_style('minimal-blog-google-fonts', $fonts_url, array(), null);
    }

    wp_enqueue_script('slick', get_template_directory_uri() . '/assets/lib/slick/js/slick.min.js', array('jquery'), '', 1);
    wp_enqueue_script('magnific-popup', get_template_directory_uri().'/assets/lib/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), '', true);
    wp_enqueue_script('minimal-blog-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '', 1);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_localize_script(
        'minimal-blog-main', 
        'minimal_blog_main',
        array(
            'next_svg'   => minimal_blog_the_theme_svg('arrow-right',true),
            'prev_svg' => minimal_blog_the_theme_svg('arrow-left',true),
            'arrow_down' => minimal_blog_the_theme_svg('chevron-down',true),
         )
    );

}

add_action('wp_enqueue_scripts', 'minimal_blog_scripts');

/**
 * Enqueue admin scripts and styles.
 */
function minimal_blog_admin_scripts()
{
    $current_screen = get_current_screen();

    if( $current_screen->id === "widgets" ) {

        // Enqueue Script Only On Widget Page.
        wp_enqueue_media();
        wp_enqueue_script('minimal-blog-widget', get_template_directory_uri() . '/assets/js/widget.js', array('jquery'), '', 1);
    }
    wp_enqueue_style('admin-style', get_template_directory_uri() . '/assets/css/admin-style.css');
}

add_action('admin_enqueue_scripts', 'minimal_blog_admin_scripts');

require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * single page meta option.
 */
require get_template_directory() . '/inc/meta-option.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load added-functions file.
 */
require get_template_directory() . '/inc/added-functions.php';

require get_template_directory() . '/inc/class-svg-icons.php';

require get_template_directory() . '/inc/widgets/widget.php';
