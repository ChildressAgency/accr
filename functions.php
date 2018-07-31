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

add_action('tribe_events_before_header', 'accr_tribe_events_before_header');
function accr_tribe_events_before_header(){
    echo '<div class="row"><div class="col-sm-9">';
}

add_action('tribe_events_after_footer', 'accr_tribe_events_after_footer');
function accr_tribe_events_after_footer(){
    echo '</div><!-- .col-sm-9 -->';
    get_sidebar();
    echo '</div><!-- .row -->';
}

//Add these scripts to only the front page
function tribehome_enqueue_front_page_scripts() {
    if( is_front_page() )
    {

	    //Add the stylesheet into the header
		wp_enqueue_style("tribe.homepage",WP_PLUGIN_URL."/the-events-calendar/src/resources/css/tribe-events-full.min.css");

		wp_enqueue_style("tribe.homepage.date",WP_PLUGIN_URL."/the-events-calendar/vendor/bootstrap-datepicker/css/bootstrap-datepicker.standalone.min.css");

		//Add the scripts in the footer
		wp_enqueue_script("jquery");

		wp_enqueue_script(
		"tribe.homepage.bar", WP_PLUGIN_URL."/the-events-calendar/src/resources/js/tribe-events-bar.min.js",
		array("jquery"), "1.3.1",1);

		wp_enqueue_script(
		"tribe.homepage.events", WP_PLUGIN_URL."/the-events-calendar/src/resources/js/tribe-events.min.js",
		array("jquery"), "1.3.1",1);

		wp_enqueue_script(
		"tribe.homepage.datepicker", WP_PLUGIN_URL."/the-events-calendar/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js",
		array("jquery"), "1.3.1",1);

		//wp_enqueue_script(
		//"tribe.homepage.footer", WP_PLUGIN_URL."/tribe-homepage-search/js/footer.js",
		//array("jquery"), "1.3.1",1);

	}
}
add_action( 'wp_enqueue_scripts', 'tribehome_enqueue_front_page_scripts' );

add_filter( 'tribe-events-bar-filters',  'tribe_events_add_category_filter', 1, 1 );

/*
 * Add 'Category' field to event search bar
 */
function tribe_events_add_category_filter( $filters ) {
    $args = array(
    'show_option_all'    => esc_html__( "All", "the-events-calendar" ),
    'show_option_none'   => '',
    'option_none_value'  => '-1',
    'orderby'            => 'title',
    'order'              => 'ASC',
    'show_count'         => 0,
    'hide_empty'         => 0,
    'child_of'           => 0,
    'exclude'            => '',
    'include'            => '',
    'echo'               => 0,
    'selected'           => '-1',
    'hierarchical'       => 0,
    'name'               => 'tribe_eventcategory',
    'id'                 => '',
    'class'              => '',
    'depth'              => 0,
    'tab_index'          => 0,
    'taxonomy'           => 'tribe_events_cat',
    'hide_if_empty'      => false,
    'value_field'         => 'term_id',
);
 
$html = wp_dropdown_categories( $args );
 
    $filters['tribe-bar-category'] = array(
        'name' => 'tribe-bar-category',
        'caption' => esc_html__( 'Category', 'the-events-calendar' ),
        'html' => $html
    );
 
    return $filters;
}

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