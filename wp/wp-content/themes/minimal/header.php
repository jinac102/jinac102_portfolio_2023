<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php wp_title(); ?> - <?php bloginfo( 'name' ); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/common.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/default.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/responsive.css">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="portfolio">
       <h1 class="logo"><a href="">Minimal Portfolio Theme</a></h1>
       <nav>
           <!-- <ul>
               <li><a href="index.html">Home</a></li>
               <li><a href="portfolio.html">Portfolio</a></li>
               <li><a href="about.html">About</a></li>
               <li><a href="contact.html">Contact</a></li>
           </ul> -->
           <?php wp_nav_menu( array( 
            'theme_location' => 'header-menu',
            'container' => false,
            'menu_class' => 'mymenu',
            'fallback_cb' => false

            ) );?> 
           <!-- 많이하는 실수_functions의 이름과 일치해야한다.  -->
       </nav>
        <div class="portfolio_category">

            <hr>
            <ul class="portfolio_links">
                <li><a href="/wp/category/archives/portfolio/" class="secondary-btn active">All</a></li>
                <!-- <li><a href="" class="secondary-btn">Print</a></li>
                <li><a href="" class="secondary-btn">Web</a></li>
                <li><a href="" class="secondary-btn">Mobile</a></li> -->
     
                <?php 
                 $categories = get_categories( array( 'child_of' => 2 ) ); 
                 foreach ( $categories as $category ) {
                     printf( '<li><a href="%1$s" class="secondary-btn">%2$s (%3$s)</a></li>',
                     esc_url( get_category_link( $category->term_id ) ),
                         esc_html( $category->cat_name ),
                         esc_html( $category->category_count )
                     );
                 }
                 ?>
            </ul>   
        </div>  
    </header>