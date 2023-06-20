<?php
function minimal_menus() {
    register_nav_menus( //하나가 아니라 여러가지 등록 가능 _ 연관배열로 진행 
      array(
        'header-menu' => __( 'Header Menu' ),
        'footer-menu' => __( 'Footer Menu' )
       )
     );
   }

   add_action( 'init', 'minimal_menus' );
   add_theme_support( 'post-thumbnails' );

   if ( ! function_exists( 'minimal_numbered_pagination' ) ) {
    function minimal_numbered_pagination() {
        $args = array(
            'prev_next' => false,
            'type' => 'array'
        );
       
        $pagination = paginate_links( $args );
  
  
        if ( is_array( $pagination ) ) {
            echo '<div class="pagenation shadow">';
            echo '<ul class="nav nav-pills">';
            foreach ( $pagination as $page ) {
                if ( strpos( $page, 'current' ) ) {
                    echo '<li class="active"><a href="#">' . $page . '</a></li>';
                } else {
                    echo '<li>' . $page . '</li>';
                }
            }
            echo '</ul>';
            echo '</div>';
        }
       
    }

    }

?>