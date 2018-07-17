<?php
    function jquery_cdn(){
        if(!is_admin()){
            wp_deregister_script('jquery');
            wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', false, null, true);
            wp_enqueue_script('jquery');
        }
    }
    add_action('wp_enqueue_scripts', 'jquery_cdn');

    function accr_scripts(){
        wp_register_script(
            'bootstrap-script', 
            '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', 
            array('jquery'), 
            '', 
            true
        );
        wp_register_script(
            'slick-script', 
            '/wp-content/themes/accr/js/slick.min.js', 
            array('jquery'), 
            '', 
            true
        );
        wp_register_script(
            'accr-script', 
            '/wp-content/themes/accr/js/accr-script.js', 
            array('jquery'), 
            '', 
            true
        );

        wp_enqueue_script('bootstrap-script');
        wp_enqueue_script('slick-script');
        wp_enqueue_script('accr-script');
    }
    add_action('wp_enqueue_scripts', 'accr_scripts', 100);
    
    function accr_styles(){
        wp_register_style('bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
        wp_register_style('fontawesome', '//use.fontawesome.com/releases/v5.1.0/css/all.css');
        wp_register_style('slick', get_template_directory_uri() . '/css/slick.css');
        wp_register_style('slick-theme', get_template_directory_uri() . '/css/slick-theme.css');
        wp_register_style('accr', get_template_directory_uri() . '/style.css');

        wp_enqueue_style( 'bootstrap-css' );
        wp_enqueue_style( 'fontawesome' );
        wp_enqueue_style('slick');
        wp_enqueue_style('slick-theme');
        wp_enqueue_style( 'accr' );
    }
    add_action('wp_enqueue_scripts', 'accr_styles');

    if(function_exists('acf_add_options_page')){
        acf_add_options_page(array(
            'page_title' => 'Global Site Settings',
            'menu_title' => 'Global Settings',
            'menu_slug' => 'global-settings',
            'capability' => 'edit_posts',
            'redirect' => false
        ));
    }

    function header_navbar() {
        register_nav_menu( 'header-navbar', _( 'Header Navigation' ) );
    }
    add_action( 'init', 'header_navbar' );

    // featured images
    add_theme_support( 'post-thumbnails');

    function sponsored_post_type() {
      register_post_type( 'sponsored',
        array(
            'labels' => array(
            'name' => __( 'Sponsored Events' ),
            'singular_name' => __( 'Sponsored Event' )
            ),
            'public' => true,
            'has_archive' => false
        )
      );
    }
    add_action( 'init', 'sponsored_post_type' );

    // remove content editor
    add_action('admin_init', 'remove_textarea');
    function remove_textarea() {
        remove_post_type_support( 'page', 'editor' );
        remove_post_type_support( 'sponsored', 'editor' );
    }
?>