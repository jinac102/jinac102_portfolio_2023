<?php
/**
 *
 * @package Minimal Blog
 */

if (!function_exists('minimal_blog_get_option')):

    /**
     * Get theme option.
     *
     * @since 1.0.0
     *
     * @param string $key Option key.
     * @return mixed Option value.
     */
    function minimal_blog_get_option($key) {
        if (empty($key)) {
            return;
        }
        $value = '';
        $default       = minimal_blog_get_default_theme_options();
        $default_value = null;
        if (is_array($default) && isset($default[$key])) {
            $default_value = $default[$key];
        }
        if (null !== $default_value) {
            $value = get_theme_mod($key, $default_value);
        } else {
            $value = get_theme_mod($key);
        }
        return $value;
    }
endif;

/**
 *
 * Customizer default values
 */

if (!function_exists('minimal_blog_get_default_theme_options')):

    /**
     * Get default theme options
     *
     * @since 1.0.0
     *
     * @return array Default theme options.
     */
    function minimal_blog_get_default_theme_options() {
        $defaults = array();

        $defaults['enable_banner_slider']        = 1;
        $defaults['enable_featured_category']        = 0;
        $defaults['category_for_banner_slider'] = 1;
        $defaults['button_text_banner_slider'] = __('Continue Reading','minimal-blog');
        $defaults['select_global_sidebar_layout'] = 'no-sidebar';
        $defaults['select_single_global_sidebar_layout'] = 'no-sidebar';
        $defaults['footer_credit_text']            = __('Copyright all rights reserved','minimal-blog');
        $defaults['related_post_title']    = esc_html__('Related Post', 'minimal-blog');
        $defaults['related_post']            = 1;

        $defaults = apply_filters('minimal_blog_filter_default_theme_options', $defaults);
        return $defaults;
    }
endif;