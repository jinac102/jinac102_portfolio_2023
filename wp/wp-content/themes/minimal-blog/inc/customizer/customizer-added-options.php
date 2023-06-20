<?php
/**
 * Theme Options Panel.
 */

$default = minimal_blog_get_default_theme_options();

$wp_customize->add_panel('theme_option_panel',
    array(
        'title'      => esc_html__('Minimal Blog Options', 'minimal-blog'),
        'priority'   => 200,
        'capability' => 'edit_theme_options',
    )
);

/**
 * Theme Options Slider Section.
 */
$wp_customize->add_section( 'theme_banner_slider_section',
    array(
        'title'      => esc_html__( 'Banner Slider Options', 'minimal-blog' ),
        'priority'   => 10,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

$wp_customize->add_setting( 'enable_banner_slider',
    array(
        'default'           => $default['enable_banner_slider'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'minimal_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control( 'enable_banner_slider',
    array(
        'label'    => esc_html__( 'Enable Front Page Slider', 'minimal-blog' ),
        'section'  => 'theme_banner_slider_section',
        'type'     => 'checkbox',
        'priority' => 10,
    )
);

$wp_customize->add_setting( 'category_for_banner_slider',
    array(
        'default'           => $default['category_for_banner_slider'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control( new Minimal_Blog_Dropdown_Taxonomies_Control( $wp_customize, 'category_for_banner_slider',
    array(
        'label'           => esc_html__( 'Category For Front Page Slider', 'minimal-blog' ),
        'section'         => 'theme_banner_slider_section',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
        'priority'    	  => 20,
    ) ) );
$wp_customize->add_setting( 'button_text_banner_slider',
    array(
        'default'           => $default['button_text_banner_slider'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'button_text_banner_slider',
    array(
        'label'    => esc_html__( 'Button Text Front Page Slider', 'minimal-blog' ),
        'section'  => 'theme_banner_slider_section',
        'type'     => 'text',
        'priority' => 30,

    )
);

/**
 * Theme Options Featured Category Section.
 */
$wp_customize->add_section( 'theme_featured_category_section',
    array(
        'title'      => esc_html__( 'Featured Category Options', 'minimal-blog' ),
        'priority'   => 15,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

$wp_customize->add_setting( 'enable_featured_category',
    array(
        'default'           => $default['enable_featured_category'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'minimal_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control( 'enable_featured_category',
    array(
        'label'    => esc_html__( 'Enable Featured Category', 'minimal-blog' ),
        'section'  => 'theme_featured_category_section',
        'type'     => 'checkbox',
        'priority' => 10,
    )
);


for ( $i=1; $i <= 3; $i++ ) {
    $wp_customize->add_setting( 'select_featured_category_'. $i, array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new Minimal_Blog_Dropdown_Taxonomies_Control( $wp_customize, 'select_featured_category_'. $i,
        array(
            'label'           => esc_html__( 'Select Featured Category', 'minimal-blog' ). ' - ' . $i ,
            'section'         => 'theme_featured_category_section',
            'type'            => 'dropdown-taxonomies',
            'taxonomy'        => 'category',
            'priority'    	  => '20' . $i,
        ) ) );
    $wp_customize->add_setting( 'select_featured_category_image_'. $i, array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'minimal_blog_sanitize_image',
        )
    );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'select_featured_category_image_'. $i,
            array(
                'label'           => __( 'Featured Category Background Image.', 'minimal-blog' ),
                'description'	  => sprintf( __( 'Recommended Size %1$s X %2$s', 'minimal-blog' ), 1280, 800 ),
                'section'         => 'theme_featured_category_section',
                'priority'        => '20' . $i,

            )
        )
    );
}

/**
 * Theme Options Global Sidebar Control.
 */
$wp_customize->add_section( 'theme_global_sidebar_control_section',
    array(
        'title'      => esc_html__( 'Global Sidebar Options', 'minimal-blog' ),
        'priority'   => 20,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

$wp_customize->add_setting('select_global_sidebar_layout',
    array(
        'default' => $default['select_global_sidebar_layout'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'minimal_blog_sanitize_select',
    )
);
$wp_customize->add_control('select_global_sidebar_layout',
    array(
        'label' => esc_html__('Select Global Sidebar Layout', 'minimal-blog'),
        'section' => 'theme_global_sidebar_control_section',
        'choices' => array(
            'sidebar-left' => esc_html__('Left Sidebar', 'minimal-blog'),
            'sidebar-right' => esc_html__('Right Sidebar', 'minimal-blog'),
            'no-sidebar' => esc_html__('FullWidth', 'minimal-blog'),
        ),
        'type' => 'select',
        'priority' => 10,
    )
);

$wp_customize->add_setting('select_single_global_sidebar_layout',
    array(
        'default' => $default['select_single_global_sidebar_layout'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'minimal_blog_sanitize_select',
    )
);
$wp_customize->add_control('select_single_global_sidebar_layout',
    array(
        'label' => esc_html__('Single Post/Page Global Sidebar Layout', 'minimal-blog'),
        'section' => 'theme_global_sidebar_control_section',
        'choices' => array(
            'sidebar-left' => esc_html__('Left Sidebar', 'minimal-blog'),
            'sidebar-right' => esc_html__('Right Sidebar', 'minimal-blog'),
            'no-sidebar' => esc_html__('FullWidth', 'minimal-blog'),
        ),
        'type' => 'select',
        'priority' => 10,
    )
);

// Footer Credit Section.
$wp_customize->add_section('footer_credit_option',
    array(
        'title' => esc_html__('Footer Credit Options', 'minimal-blog'),
        'priority' => 100,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

$wp_customize->add_setting('footer_credit_text',
    array(
        'default' => $default['footer_credit_text'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('footer_credit_text',
    array(
        'label' => esc_html__('Footer Credit Text', 'minimal-blog'),
        'section' => 'footer_credit_option',
        'type' => 'text',
        'priority' => 100,
    )
);

/*layout management section start */
$wp_customize->add_section('theme_option_section_single',
    array(
        'title'      => esc_html__('Single Post Setting', 'minimal-blog'),
        'priority'   => 100,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

// Setting - related_post.
$wp_customize->add_setting('related_post',
    array(
        'default'           => $default['related_post'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'minimal_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('related_post',
    array(
        'label'    => esc_html__('Enable Related Post on Single post', 'minimal-blog'),
        'section'  => 'theme_option_section_single',
        'type'     => 'checkbox',
        'priority' => 100,
    )
);
// Setting related_post_title.
$wp_customize->add_setting('related_post_title',
    array(
        'default'           => $default['related_post_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('related_post_title',
    array(
        'label'    => esc_html__('Related Post Title', 'minimal-blog'),
        'section'  => 'theme_option_section_single',
        'type'     => 'text',
        'priority' => 100,
    )
);