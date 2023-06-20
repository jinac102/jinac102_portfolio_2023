<?php
/**
* Sidebar Metabox.
*
* @package Minimal Blog
*/
 
add_action( 'add_meta_boxes', 'minimal_blog_metabox' );

if( ! function_exists( 'minimal_blog_metabox' ) ):


    function  minimal_blog_metabox() {
        
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'minimal-blog' ),
            'minimal_blog_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'minimal-blog' ),
            'minimal_blog_post_metafield_callback',
            'page',
            'normal', 
            'high'
        ); 
    }

endif;

$minimal_blog_post_sidebar_fields = array(
    'global-sidebar' => array(
                    'value' => 'global-sidebar',
                    'label' => esc_html__( 'Global sidebar', 'minimal-blog' ),
                ),
    'sidebar-right' => array(
                    'value' => 'sidebar-right',
                    'label' => esc_html__( 'Right sidebar', 'minimal-blog' ),
                ),
    'sidebar-left' => array(
                    'value'     => 'sidebar-left',
                    'label'     => esc_html__( 'Left sidebar', 'minimal-blog' ),
                ),
    'no-sidebar' => array(
                    'value'     => 'no-sidebar',
                    'label'     => esc_html__( 'Full Width', 'minimal-blog' ),
                ),
);


/**
 * Callback function for post option.
*/
if( ! function_exists( 'minimal_blog_post_metafield_callback' ) ):
    
    function minimal_blog_post_metafield_callback() {
        global $post, $minimal_blog_post_sidebar_fields;
        $post_type = get_post_type($post->ID);
        $ut_ed_twitter_summary = get_theme_mod('ut_ed_twitter_summary');
        $ut_ed_open_graph = get_theme_mod('ut_ed_open_graph');
        wp_nonce_field( basename( __FILE__ ), 'minimal_blog_post_meta_nonce' ); ?>
        
        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-general" class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('Appearance Settings', 'minimal-blog'); ?>

                        </a>
                    </li>

                </ul>
            </div>

            <div class="theme-tab-content">

                <div id="metabox-navbar-general-content" class="metabox-content-wrap metabox-content-wrap-active">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Sidebar Layout','minimal-blog'); ?></h3>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <?php
                            $minimal_blog_post_sidebar = esc_html( get_post_meta( $post->ID, 'minimal_blog_post_sidebar_option', true ) ); 
                            if( $minimal_blog_post_sidebar == '' ){ $minimal_blog_post_sidebar = 'global-sidebar'; }

                            foreach ( $minimal_blog_post_sidebar_fields as $minimal_blog_post_sidebar_field) { ?>

                                <label class="description">

                                    <input type="radio" name="minimal_blog_post_sidebar_option" value="<?php echo esc_attr( $minimal_blog_post_sidebar_field['value'] ); ?>" <?php if( $minimal_blog_post_sidebar_field['value'] == $minimal_blog_post_sidebar ){ echo "checked='checked'";} if( empty( $minimal_blog_post_sidebar ) && $minimal_blog_post_sidebar_field['value']=='sidebar-right' ){ echo "checked='checked'"; } ?>/>&nbsp;<?php echo esc_html( $minimal_blog_post_sidebar_field['label'] ); ?>

                                </label>

                            <?php } ?>

                        </div>

                    </div>


                    <?php $minimal_blog_ed_feature_image = esc_attr(get_post_meta($post->ID, 'minimal-blog-meta-checkbox', true)); ?>
                    <div class="metabox-opt-panel">
                        <div class="metabox-opt-wrap theme-checkbox-wrap">
                            <input id="minimal-blog-ed-feature-image" name="minimal-blog-meta-checkbox" type="checkbox" <?php if ($minimal_blog_ed_feature_image) { ?> checked="checked" <?php } ?> />
                            <label for="minimal-blog-ed-feature-image"><?php esc_html_e('Disable Feature Image', 'minimal-blog'); ?></label>
                        </div>
                    </div>


                </div>
                

            </div>

        </div>  
            
    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'minimal_blog_save_post_meta' );

if( ! function_exists( 'minimal_blog_save_post_meta' ) ):

    function minimal_blog_save_post_meta( $post_id ) {

        global $post, $minimal_blog_post_sidebar_fields;

        if ( !isset( $_POST[ 'minimal_blog_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['minimal_blog_post_meta_nonce'] ) ), basename( __FILE__ ) ) ){

            return;

        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

            return;

        }
            
        if ( 'page' == $_POST['post_type'] ) {  

            if ( !current_user_can( 'edit_page', $post_id ) ){  

                return $post_id;

            }

        }elseif( !current_user_can( 'edit_post', $post_id ) ) {

            return $post_id;

        }


        foreach ( $minimal_blog_post_sidebar_fields as $minimal_blog_post_sidebar_field ) {  
            
            $old = sanitize_text_field( get_post_meta( $post_id, 'minimal_blog_post_sidebar_option', true ) ); 
            $new = $_POST['minimal_blog_post_sidebar_option'];

            if ( $new && $new != $old ){

                update_post_meta ( $post_id, 'minimal_blog_post_sidebar_option', $new );

            }elseif( '' == $new && $old ) {

                delete_post_meta( $post_id,'minimal_blog_post_sidebar_option', $old );

            }
            
        }
        

        $minimal_blog_ed_feature_image_old = get_post_meta($post_id, 'minimal-blog-meta-checkbox', true);
        $minimal_blog_ed_feature_image_news = $_POST['minimal-blog-meta-checkbox'];
        
        if ($minimal_blog_ed_feature_image_news && $minimal_blog_ed_feature_image_news != $minimal_blog_ed_feature_image_old) {
            update_post_meta($post_id, 'minimal-blog-meta-checkbox', $minimal_blog_ed_feature_image_news);
        } elseif ('' == $minimal_blog_ed_feature_image_news && $minimal_blog_ed_feature_image_old) {
            delete_post_meta($post_id, 'minimal-blog-meta-checkbox', $minimal_blog_ed_feature_image_old);
        }

    }

endif;   