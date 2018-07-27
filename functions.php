<?php
add_action('wp_footer', 'show_template');
function show_template() {
	global $template;
	print_r($template);
}

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
        register_nav_menus( array( 
            'header-navbar' => __( 'Header Navigation' ),
            'member-navbar' => __( 'Membership Navigation' )
        ) );
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

    /*
     * The Events Calendar - Add 'tags' support to venues and organizers
     */
    function tribe_tag_venues_and_orgs() {
        $tribe_venue_args = get_post_type_object('tribe_venue');
        $tribe_venue_args->taxonomies = array('post_tag');

        $tribe_organizer_args = get_post_type_object('tribe_organizer');
        $tribe_organizer_args->taxonomies = array('post_tag');
     
        register_post_type( 'tribe_venue', $tribe_venue_args );
        register_post_type( 'tribe_organizer', $tribe_organizer_args );
    }
    add_action( 'init', 'tribe_tag_venues_and_orgs' );

    /*
     * By Barry and Cliff
     * From https://gist.github.com/cliffordp/04b7bbe6e7d9009aec12acc0b9bd5bdd
     * 
     * Shortcode to display render Tribe Bar anywhere on site (e.g. website header)
     * For https://theeventscalendar.com/support/forums/topic/insert-search-bar-on-top-of-a-page/ which also links to http://gregorypearcey.com/blog/add-tribe-events-search-bar-home-page/
     *
     * Notes: It's not pretty or perfect, but it's a start if you want to pull something like this off on your site. FYI: You're in unsupported / custom coding territory.
     *
     * Example: [tribe_bar_anywhere]
     * Screenshot: https://cl.ly/3h1S3d3a3T30
     */
    function tribe_bar_anywhere_logic() {
        if ( ! class_exists( 'Tribe__Events__Bar' ) ) {
            return false;
        }
        wp_enqueue_script( 'jquery' );
        Tribe__Events__Template_Factory::asset_package( 'bootstrap-datepicker' );
        Tribe__Events__Template_Factory::asset_package( 'calendar-script' );
        Tribe__Events__Template_Factory::asset_package( 'jquery-resize' );
        Tribe__Events__Template_Factory::asset_package( 'events-css' );
        Tribe__Events__Bar::instance()->load_script();
        ob_start();
        tribe_get_template_part( 'modules/bar' );
        //get_template_part('tribe-events/modules/bar');
        return ob_get_clean();
    }
    add_shortcode( 'tribe_bar_anywhere', 'tribe_bar_anywhere_logic' );

add_action('widgets_init', 'accr_widgets_init');
function accr_widgets_init(){
  register_sidebar(array(
    'name' => 'Events Sidebar',
    'id' => 'sidebar-1',
    'description' => 'Sidebar for events sections',
    'before_widget' => '<div class="event-widget>',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="event-widget-title>',
    'after_title' => '</h3>'
  ));
}