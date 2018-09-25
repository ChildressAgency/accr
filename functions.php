<?php
/*
 add_action('wp_footer', 'show_template');
 function show_template() {
 	global $template;
 	print_r($template);
 }
*/
    function jquery_cdn(){
        if(!is_admin()){
            wp_deregister_script('jquery');
            wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', false, null, true);
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
            'member-navbar' => __( 'Membership Navigation' ),
            'masthead-navbar' => __('Masthead Navigation')
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

    // locations taxonomy
    function location_init() {
        $labels = array(
            'name' => _x( 'Locations', 'taxonomy general name' ),
            'singular_name' => _x( 'Location', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Locations' ),
            'all_items' => __( 'All Locations' ),
            'parent_item' => __( 'Parent Location' ),
            'parent_item_colon' => __( 'Parent Location:' ),
            'edit_item' => __( 'Edit Location' ), 
            'update_item' => __( 'Update Location' ),
            'add_new_item' => __( 'Add New Location' ),
            'new_item_name' => __( 'New Location Name' ),
            'menu_name' => __( 'Locations' ),
          );    
         
        // Now register the taxonomy
        register_taxonomy('locations', array('tribe_events'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'location' ),
        ));
    }
    add_action( 'init', 'location_init' );

    // remove content editor
    add_action('admin_init', 'remove_textarea');
    function remove_textarea() {
        //remove_post_type_support( 'page', 'editor' );
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
        'before_widget' => '<div class="event-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="event-widget-title">',
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
        if( is_front_page() || is_tag())
        {

    	    //Add the stylesheet into the header
    		wp_enqueue_style("tribe.homepage",WP_PLUGIN_URL."/the-events-calendar/src/resources/css/tribe-events-full.min.css");

    		wp_enqueue_style("tribe.homepage.date",WP_PLUGIN_URL."/the-events-calendar/vendor/bootstrap-datepicker/css/bootstrap-datepicker.standalone.min.css");

    		//Add the scripts in the footer
    		//wp_enqueue_script("jquery");

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
    		wp_enqueue_style("tribe.homepage.date",WP_PLUGIN_URL."/the-events-calendar/vendor/bootstrap-datepicker/css/bootstrap-datepicker.standalone.min.css");
   		wp_enqueue_script(
    		"tribe.homepage.datepicker", WP_PLUGIN_URL."/the-events-calendar/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js",
    		array("jquery"), "1.3.1",1);

    }
    add_action( 'wp_enqueue_scripts', 'tribehome_enqueue_front_page_scripts' );

    /*
     * Add 'Category' field to event search bar
     */
    function tribe_events_add_category_filter( $filters ) {
        $args = array(
        'show_option_all'    => esc_html__( "All Categories", "the-events-calendar" ),
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
    add_filter( 'tribe-events-bar-filters',  'tribe_events_add_category_filter', 1, 1 );

    /*
     * Add 'Location' field to event search bar
     */
    /*
    new Tribe__Events__Filterbar__Filters__Location( __( 'Location', 'tribe-events-filter-view' ), 'location' );
    function tribe_events_add_location_filter( $filters ) {
        $args = array(
        'show_option_all'    => esc_html__( "All Locations", "the-events-calendar" ),
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
        'hierarchical'       => 1,
        'name'               => 'location',
        'id'                 => '',
        'class'              => '',
        'depth'              => 0,
        'tab_index'          => 0,
        'taxonomy'           => 'locations',
        'hide_if_empty'      => false,
        'value_field'         => 'term_id',
        );
     
        $html = wp_dropdown_categories( $args );
     
        $filters['location'] = array(
            'name' => 'location',
            'caption' => 'Location',
            'html' => $html
        );
     
        return $filters;
    }
    add_filter( 'tribe-events-bar-filters',  'tribe_events_add_location_filter', 1, 1 );
    */
     
    // Remove old location filter from filter bar
    function remove_search_from_bar( $filters ) {
      if ( isset( $filters['tribe-bar-geoloc'] ) ) {
            unset( $filters['tribe-bar-geoloc'] );
        }
     
        return $filters;
    }
    add_filter( 'tribe-events-bar-filters',  'remove_search_from_bar', 1000, 1 );


    // load styles
    function accr_styles(){
        wp_register_style('bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
        wp_register_style('fontawesome', '//use.fontawesome.com/releases/v5.1.0/css/all.css');
        wp_register_style('slick', get_template_directory_uri() . '/css/slick.css');
        wp_register_style('slick-theme', get_template_directory_uri() . '/css/slick-theme.css');
        wp_register_style('accr', get_template_directory_uri() . '/style.css');

        wp_enqueue_style( 'bootstrap-css' );
        wp_enqueue_style( 'fontawesome' );
        wp_enqueue_style( 'slick' );
        wp_enqueue_style( 'slick-theme' );
        wp_enqueue_style( 'accr' );
    }
    add_action('wp_enqueue_scripts', 'accr_styles');
   
add_filter('manage_users_columns', 'accr_modify_user_table');
function accr_modify_user_table($column){
  $column['profile_type'] = 'Profile Type';
  $column['member'] = 'Member';
  return $column;
}
add_action('manage_users_custom_column', 'accr_modify_user_table_row', 10, 3);
function accr_modify_user_table_row($val, $column_name, $user_id){
  switch($column_name){
    case 'profile_type':
      $profile_type = get_field('profile_type', 'user_' . $user_id);
      return $profile_type;
    break;
    case 'member':
      $is_a_member = get_field('is_this_a_member', 'user_' . $user_id);
      if($is_a_member){
        return 'Yes';
      }
    break;
    //default:
     
  }
 // return $val;
}
add_filter('manage_edit-users_sortable_columns', 'accr_sortable_users_columns');
function accr_sortable_users_columns($columns){
  $columns['profile_type'] = 'profile_type';
  $columns['member'] = 'member';
  return $columns;
}

add_action('pre_get_users', 'accr_users_orderby');
function accr_users_orderby($query){
  if(!is_admin() || !$query->is_main_query()){
    return;
  }
  if($query->get('orderby') == 'profile_type'){
    $query->set('orderby', 'meta_value');
    $query->set('meta_key', 'profile_type');
  }
  elseif($query->get('orderby') == 'member'){
    $query->set('orderby', 'meta_value');
    $query->set('meta_key', 'is_this_a_member');
  }
}

//member directory functions
add_filter('um_prepare_user_query_args', 'accr_prepare_user_query_args', 10, 2);
function accr_prepare_user_query_args($query_args, $directory_settings){
  if(isset($_GET['member']) && $_GET['member'] == true){
    //$query_args['meta_key'] = 'is_this_a_member';
    //$query_args['meta_value'] = '1';
    $query_args['meta_query'] = array(
      'relation' => 'AND',
      array(
        'key' => 'is_this_a_member',
        'value' => '1',
        'compare' => '='
      )
    );
  }
  return $query_args;
}

/**
 * Method of listing upcoming events, complete with functional pagination
 * if WP-PageNavi is installed.
 *
 * Implemented as a shortcode.
 *
 * @see https://wordpress.org/plugins/wp-pagenavi/
 */
function accr_tag_event_list() {
  $tag = get_queried_object();

	// Safety first! Bail in the event TEC is inactive/not loaded yet
	if ( ! class_exists( 'Tribe__Events__Main' ) )
		return;
		
	// Has the user paged forward, ie are they on /page-slug/page/2/?
	$paged = get_query_var( 'paged' )
		? get_query_var( 'paged' )
		: 1; 
		
	// Build our query, adopt the default number of events to show per page
	$upcoming = new WP_Query( array(
		'post_type' => Tribe__Events__Main::POSTTYPE,
    'paged'     => $paged,
    'tag' => $tag->slug
	) );
	
  // If we got some results, let's list 'em
  ?><div class="tribe-events-loop"><?php
	while ( $upcoming->have_posts() ) {
    global $post;
		$upcoming->the_post();
		$title = get_the_title();
		$date  = tribe_get_start_date();
		
		// Of course, you could and probably would expand on this
		// and add more info and better formatting
    //echo "<p> $title <i>$date</i> </p>";
    		$venue_details = tribe_get_venue_details();

		// The address string via tribe_get_venue_details will often be populated even when there's
		// no address, so let's get the address string on its own for a couple of checks below.
		$venue_address = tribe_get_address();

		// Venue
		$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

		// Organizer
		$organizer = tribe_get_organizer();
		$organizer_link = tribe_get_organizer_link();
		$organizer_name = tribe_get_organizer();

		// event date/time
		// $event_id = get_the_ID();
		$start_date = tribe_get_start_date( $post, false, 'M d, Y', null );
		$end_date = tribe_get_end_date( $post, false, 'M d, Y', null );
		$start_date_time = tribe_get_start_date( $post, false, 'h:i a', null );
		$end_date_time = tribe_get_end_date( $post, false, 'h:i a', null );
		$isAllDay = tribe_event_is_all_day( get_the_ID() );

		// 'ADD IT' button
		$addit_start_date = tribe_get_start_date( $post, false, 'Ymd', null );
		$addit_start_date_time = tribe_get_start_date( $post, false, 'His', null );
		$addit_end_date = tribe_get_end_date( $post, false, 'Ymd', null );
		$addit_end_date_time = tribe_get_end_date( $post, false, 'His', null );

		$addit_date_start = $addit_start_date . 'T' . $addit_start_date_time . 'Z';
		$addit_date_end = $addit_end_date . 'T' . $addit_end_date_time . 'Z';
		?>

		<div class="event">
			<?php if( $i==0 ): ?>
			<div class="event__header event__header--featured">
			    <h3 class="event__title"><a href="<?php echo get_permalink( $post ); ?>"><?php echo $post->post_title; ?></a></h3>
			    <p class="event__subtitle"><?php if( $organizer_name ): ?>organized by: <?php echo $organizer_link; ?><br/><?php endif; ?>
				    <?php if( $start_date ): ?>
				        <?php echo $start_date; 
				        if( !$isAllDay ){ 
				            echo ' ' . $start_date_time; 
				        } 
				        if( strcmp( $start_date, $end_date ) ){ 
				            echo ' - ' . $end_date;
				            if( !$isAllDay ){ 
				                echo ' ' . $end_date_time; 
				            } 
				        } elseif( !$isAllDay ){
				            echo ' - ' . $end_date_time;
				        } ?>
				    <?php endif; ?>
                </p>
			</div>
			<?php endif; ?>

			<div class="event__info">
			    <div class="event-thumbnail <?php if( $i==0 ){ echo 'event-thumbnail--featured'; } ?><?php if( $i > 5 ){ echo 'event-thumbnail--small'; } ?>">
			        <div class="event-thumbnail__event">
			            <?php if( $i <=5 ): ?>
			                <div class="event-thumbnail__date"><span class="month month--start"><?php echo strtoupper(tribe_get_start_date( $post, false, 'M', null )); ?></span> <span class="day"><?php echo tribe_get_start_date( $post, false, 'd', null ); ?><?php if(strcmp($start_date, $end_date)): ?>-<?php echo tribe_get_end_date( $post, false, 'd', null ); ?></span> <span class="month month--end"><?php echo strtoupper(tribe_get_end_date( $post, false, 'M', null )); endif;?></span></div>
			            <?php endif; ?>
			            <div class="event-thumbnail__image <?php if( in_array( $post, $featuredEvents ) ): echo 'event-thumbnail__image--featured'; endif; ?>">
			                <img src="<?php echo get_the_post_thumbnail_url( $post ); ?>" alt="">
			            </div>
			        </div>
			    </div>
			    
			    <div class="event__desc-wrapper">
			        <?php if( $i==0 ): ?>
			            <?php if( $post->post_excerpt ): ?><p><strong><?php echo $post->post_excerpt; ?></strong></p><?php endif; ?>
			            <?php if( get_field( 'get_tickets_link', $post ) ): ?><a href="<?php echo get_field( 'get_tickets_link', $post ); ?>" class="btn btn-white">GET TICKETS</a><?php endif; ?>
			            <?php 
			                
			                ?>
			            <a class="btn btn-white" href="http://www.google.com/calendar/event?action=TEMPLATE&text=<?php echo $post->post_title; ?>&dates=<?php echo $addit_date_start; ?>/<?php echo $addit_date_end; ?>&details=&location=<?php echo tribe_get_venue( $post ); ?>&trp=false&sprop=&sprop=name:" target="_blank" rel="nofollow">ADD IT</a>
			            <p class="event__desc"><?php echo mb_strimwidth( $post->post_content, 0, 500, '...' ); ?></p>
			            <a href="<?php echo get_permalink( $post ); ?>" class="view-more">View more</a>
			        <?php elseif( $i<=5 ): ?>
			            <div class="event__header">
			                <h3 class="event__title"><a href="<?php echo get_permalink( $post ); ?>"><?php echo $post->post_title; ?></a></h3>
			                <p class="event__subtitle"><?php if( $organizer_name ): ?>organized by: <?php echo $organizer_link; ?><br/><?php endif; ?>
							    <?php if( $start_date ): ?>
							        <?php echo $start_date; 
							        if( !$isAllDay ){ 
							            echo ' ' . $start_date_time; 
							        } 
							        if( strcmp( $start_date, $end_date ) ){ 
							            echo ' - ' . $end_date;
							            if( !$isAllDay ){ 
							                echo ' ' . $end_date_time; 
							            } 
							        } elseif( !$isAllDay ){
							            echo ' - ' . $end_date_time;
							        } ?>
							    <?php endif; ?>
			                </p>
			            </div>
			            <p class="event__desc"><?php echo mb_strimwidth( $post->post_content, 0, 500, '...' ); ?></p>
			            <?php if( get_field( 'get_tickets_link', $post ) ): ?><a href="<?php echo get_field( 'get_tickets_link', $post ); ?>" class="btn btn-white">GET TICKETS</a><?php endif; ?>
			            <?php 
			                $addit_start_date = tribe_get_start_date( $post, false, 'Ymd', null );
			                $addit_start_date_time = tribe_get_start_date( $post, false, 'His', null );
			                $addit_end_date = tribe_get_end_date( $post, false, 'Ymd', null );
			                $addit_end_date_time = tribe_get_end_date( $post, false, 'His', null );

			                $addit_date_start = $addit_start_date . 'T' . $addit_start_date_time . 'Z';
			                $addit_date_end = $addit_end_date . 'T' . $addit_end_date_time . 'Z';
			                ?>
			            <a class="btn btn-white" href="http://www.google.com/calendar/event?action=TEMPLATE&text=<?php echo $post->post_title; ?>&dates=<?php echo $addit_date_start; ?>/<?php echo $addit_date_end; ?>&details=&location=<?php echo tribe_get_venue( $post ); ?>&trp=false&sprop=&sprop=name:" target="_blank" rel="nofollow">ADD IT</a>
			        <?php else: ?>
			            <div class="event__header">
			                <h3 class="event__title"><a href="<?php echo get_permalink( $post ); ?>"><?php echo $post->post_title; ?></a></h3>
			                <p class="event__subtitle"><?php if( $organizer_name ): ?>organized by: <?php echo $organizer_link; ?><br/><?php endif; ?>
							    <?php if( $start_date ): ?>
							        <?php echo $start_date; 
							        if( !$isAllDay ){ 
							            echo ' ' . $start_date_time; 
							        } 
							        if( strcmp( $start_date, $end_date ) ){ 
							            echo ' - ' . $end_date;
							            if( !$isAllDay ){ 
							                echo ' ' . $end_date_time; 
							            } 
							        } elseif( !$isAllDay ){
							            echo ' - ' . $end_date_time;
							        } ?>
							    <?php endif; ?>
			                </p>
			            </div>
			            <p class="event__desc"><?php echo mb_strimwidth( $post->post_content, 0, 500, '...' ); ?></p>
			        <?php endif; ?>
			    </div>
			    <div class="clearfix"></div>

			    <?php if( $i > 5 ): ?>
			        <div class="event__small-btns">
			            <?php if( get_field( 'get_tickets_link', $post ) ): ?><a href="<?php echo get_field( 'get_tickets_link', $post ); ?>" class="btn btn-white">GET TICKETS</a><?php endif; ?>
			            <?php 
			                $addit_start_date = tribe_get_start_date( $post, false, 'Ymd', null );
			                $addit_start_date_time = tribe_get_start_date( $post, false, 'His', null );
			                $addit_end_date = tribe_get_end_date( $post, false, 'Ymd', null );
			                $addit_end_date_time = tribe_get_end_date( $post, false, 'His', null );

			                $addit_date_start = $addit_start_date . 'T' . $addit_start_date_time . 'Z';
			                $addit_date_end = $addit_end_date . 'T' . $addit_end_date_time . 'Z';
			                ?>
			            <a class="btn btn-white" href="http://www.google.com/calendar/event?action=TEMPLATE&text=<?php echo $post->post_title; ?>&dates=<?php echo $addit_date_start; ?>/<?php echo $addit_date_end; ?>&details=&location=<?php echo tribe_get_venue( $post ); ?>&trp=false&sprop=&sprop=name:" target="_blank" rel="nofollow">ADD IT</a>
			        </div>
			    <?php endif; ?>
			</div>

			<?php //do_action( 'tribe_events_inside_after_loop' ); ?>
		</div>

		<hr class="hr--light" />
<?php
  }
  echo '</div>';
	
	// Is Pagenavi activated? Let's use it for pagination if so
	if ( function_exists( 'wp_pagenavi' ) )
		wp_pagenavi( array( 'query' => $upcoming ) );
		
	// Clean up
	wp_reset_query();
}
// Create a new shortcode to list upcoming events, optionally
// with pagination
add_shortcode( 'tag-event-list', 'accr_tag_event_list' );


//add end date filter
add_filter('tribe-events-bar-filters', 'accr_end_date_filter', 1, 1);
function accr_end_date_filter($filters){
  $filters['tribe-bar-end-date'] = array(
    'name' => 'tribe-bar-end-date',
    'caption' => 'End Date',
    'html' => '<input type="text" name="tribe-bar-end-date" id="tribe-bar-end-date" placeholder="End Date" />'
  );

  $resort_filters['tribe-bar-date'] = $filters['tribe-bar-date'];
  $resort_filters['tribe-bar-end-date'] = $filters['tribe-bar-end-date'];
  $resort_filters['tribe-bar-search'] = $filters['tribe-bar-search'];
  $resort_filters['tribe-bar-category'] = $filters['tribe-bar-category'];

  //var_dump($resort_filters);
  return $resort_filters;
}

add_filter('tribe_events_pre_get_posts', 'accr_setup_end_date_query', 10, 1);
function accr_setup_end_date_query($query){
  if(!empty($_REQUEST['tribe-bar-end-date'])){
    $meta_query = array(
      'relation' => 'AND',
      array(
        'key' => '_EventEndDate',
        'value' => $_REQUEST['tribe-bar-end-date'],
        'compare' => 'LIKE',
        //'type' => 'DATETIME'
      )
    );
    $query->set('meta_query', $meta_query);

    //$query->set('posts_per_page', (int)tribe_get_option('postsPerPage', 10));
    $query->set('eventDate', $_REQUEST['tribe-bar-end-date']);
    //var_dump($query);
  }
  
  return $query;
}
