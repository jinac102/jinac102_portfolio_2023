<?php
/**
* Register widget area.
*
* @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
*/
function minimal_blog_widgets_init() {
    register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'minimal-blog' ),
    'id'            => 'sidebar-1',
    'description'   => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Col-1', 'minimal-blog' ),
        'id'            => 'footer-1',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Col-2', 'minimal-blog' ),
        'id'            => 'footer-2',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Col-3', 'minimal-blog' ),
        'id'            => 'footer-3',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'minimal_blog_widgets_init' );

/**
 * function for google fonts
 */
if (!function_exists('minimal_blog_fonts_url')) :

    /**
     * Return fonts URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function minimal_blog_fonts_url()
    {

        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        if ('off' !== _x('on', 'Open Sans font: on or off', 'minimal-blog')) {
            $fonts[] = 'Open+Sans:300,300i,400,400i';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urldecode(implode('|', $fonts)),
                'subset' => urldecode($subsets),
            ), '//fonts.googleapis.com/css');
        }
        return $fonts_url;
    }
endif;

if( !function_exists( 'minimal_blog_social_menu_icon' ) ) :

    function minimal_blog_social_menu_icon( $item_output, $item, $depth, $args ) {

        // Add Icon
        if ( isset( $args->theme_location ) && 'menu-social' === $args->theme_location ) {

            $svg = Minimal_Blog_SVG_Icons::get_theme_svg_name( $item->url );

            if ( empty( $svg ) ) {
                $svg = minimal_blog_the_theme_svg( 'link',$return = true );
            }

            $item_output = str_replace( $args->link_after, '</span>' . $svg, $item_output );
        }

        return $item_output;
    }
    
endif;

add_filter( 'walker_nav_menu_start_el', 'minimal_blog_social_menu_icon', 10, 4 );


/**
 * Minimal Blog SVG Icon helper functions
 *
 * @package Minimal Blog
 * @since 1.0.0
 */
if ( ! function_exists( 'minimal_blog_the_theme_svg' ) ):
    /**
     * Output and Get Theme SVG.
     * Output and get the SVG markup for an icon in the Minimal_Blog_SVG_Icons class.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function minimal_blog_the_theme_svg( $svg_name, $return = false ) {

        if( $return ){

            return minimal_blog_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in minimal_blog_get_theme_svg();.

        }else{

            echo minimal_blog_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in minimal_blog_get_theme_svg();.
            
        }
    }

endif;

if ( ! function_exists( 'minimal_blog_get_theme_svg' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function minimal_blog_get_theme_svg( $svg_name ) {

        // Make sure that only our allowed tags and attributes are included.
        $svg = minimal_blog_svg_escape( Minimal_Blog_SVG_Icons::get_svg( $svg_name ) );
        if ( ! $svg ) {
            return false;
        }
        return $svg;

    }

endif;


if ( ! function_exists( 'minimal_blog_svg_escape' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function minimal_blog_svg_escape( $input ) {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            $input,
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );

        if ( ! $svg ) {
            return false;
        }

        return $svg;

    }

endif;


if( !function_exists('minimal_blog_post_format_icon') ):

    // Post Format Icon.
    function minimal_blog_post_format_icon( ){

        global $post;
        
        $format = get_post_format( $post->ID ) ? : 'standard';

        if( $format == 'video' ){
            $icon = minimal_blog_get_theme_svg( 'video' );
        }elseif( $format == 'audio' ){
            $icon = minimal_blog_get_theme_svg( 'audio' );
        }elseif( $format == 'gallery' ){
            $icon = minimal_blog_get_theme_svg( 'gallery' );
        }elseif( $format == 'quote' ){
            $icon = minimal_blog_get_theme_svg( 'quote' );
        }elseif( $format == 'image' ){
            $icon = minimal_blog_get_theme_svg( 'image' );
        }else{
            $icon = '';
        }

        if( !empty( $icon ) ){ ?>

            <span class="wpi-formate-icon">
                <?php echo minimal_blog_svg_escape( $icon ); ?>
            </span>

        <?php }

    }

endif;