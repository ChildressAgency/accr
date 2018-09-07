<div class="um <?php echo $this->get_class( $mode ); ?> um-<?php echo esc_attr( $form_id ); ?> um-role-<?php echo um_user( 'role' ); ?> ">

	<div class="um-form">
	
		<?php
		/**
		 * UM hook
		 *
		 * @type action
		 * @title um_profile_before_header
		 * @description Some actions before profile form header
		 * @input_vars
		 * [{"var":"$args","type":"array","desc":"Profile form shortcode arguments"}]
		 * @change_log
		 * ["Since: 2.0"]
		 * @usage add_action( 'um_profile_before_header', 'function_name', 10, 1 );
		 * @example
		 * <?php
		 * add_action( 'um_profile_before_header', 'my_profile_before_header', 10, 1 );
		 * function my_profile_before_header( $args ) {
		 *     // your code here
		 * }
		 * ?>
		 */
		do_action( 'um_profile_before_header', $args );

		if ( um_is_on_edit_profile() ) { ?>
			<form method="post" action="">
		<?php }

		/**
		 * UM hook
		 *
		 * @type action
		 * @title um_profile_header_cover_area
		 * @description Profile header cover area
		 * @input_vars
		 * [{"var":"$args","type":"array","desc":"Profile form shortcode arguments"}]
		 * @change_log
		 * ["Since: 2.0"]
		 * @usage add_action( 'um_profile_header_cover_area', 'function_name', 10, 1 );
		 * @example
		 * <?php
		 * add_action( 'um_profile_header_cover_area', 'my_profile_header_cover_area', 10, 1 );
		 * function my_profile_header_cover_area( $args ) {
		 *     // your code here
		 * }
		 * ?>
		 */
		do_action( 'um_profile_header_cover_area', $args );

		/**
		 * UM hook
		 *
		 * @type action
		 * @title um_profile_header
		 * @description Profile header area
		 * @input_vars
		 * [{"var":"$args","type":"array","desc":"Profile form shortcode arguments"}]
		 * @change_log
		 * ["Since: 2.0"]
		 * @usage add_action( 'um_profile_header', 'function_name', 10, 1 );
		 * @example
		 * <?php
		 * add_action( 'um_profile_header', 'my_profile_header', 10, 1 );
		 * function my_profile_header( $args ) {
		 *     // your code here
		 * }
		 * ?>
		 */
    //do_action( 'um_profile_header', $args );
/**
 * Profile header
 *
 * @param $args
 */
function accr_profile_header( $args ) {
	$classes = null;

	if (!$args['cover_enabled']) {
		$classes .= ' no-cover';
	}

	$default_size = str_replace( 'px', '', $args['photosize'] );

	$overlay = '<span class="um-profile-photo-overlay">
			<span class="um-profile-photo-overlay-s">
				<ins>
					<i class="um-faicon-camera"></i>
				</ins>
			</span>
		</span>';

	?>

	<div class="um-header<?php echo $classes; ?>">

		<?php
		/**
		 * UM hook
		 *
		 * @type action
		 * @title um_pre_header_editprofile
		 * @description Insert some content before edit profile header
		 * @input_vars
		 * [{"var":"$args","type":"array","desc":"Form Arguments"}]
		 * @change_log
		 * ["Since: 2.0"]
		 * @usage add_action( 'um_pre_header_editprofile', 'function_name', 10, 1 );
		 * @example
		 * <?php
		 * add_action( 'um_pre_header_editprofile', 'my_pre_header_editprofile', 10, 1 );
		 * function my_pre_header_editprofile( $args ) {
		 *     // your code here
		 * }
		 * ?>
		 */
		do_action( 'um_pre_header_editprofile', $args ); ?>

    <div class="row">
      <div class="col-sm">

		<div class="um-profile-photo" data-user_id="<?php echo um_profile_id(); ?>">

			<a href="<?php echo um_user_profile_url(); ?>" class="um-profile-photo-img accr_profile-photo"
			   title="<?php echo um_user( 'display_name' ); ?>"><?php echo $overlay . get_avatar( um_user( 'ID' ), $default_size ); ?></a>

			<?php

			if (!isset( UM()->user()->cannot_edit )) {

				UM()->fields()->add_hidden_field( 'profile_photo' );

				if (!um_profile( 'profile_photo' )) { // has profile photo

					$items = array(
						'<a href="#" class="um-manual-trigger" data-parent=".um-profile-photo" data-child=".um-btn-auto-width">' . __( 'Upload photo', 'ultimate-member' ) . '</a>',
						'<a href="#" class="um-dropdown-hide">' . __( 'Cancel', 'ultimate-member' ) . '</a>',
					);

					/**
					 * UM hook
					 *
					 * @type filter
					 * @title um_user_photo_menu_view
					 * @description Change user photo on menu view
					 * @input_vars
					 * [{"var":"$items","type":"array","desc":"User Photos"}]
					 * @change_log
					 * ["Since: 2.0"]
					 * @usage
					 * <?php add_filter( 'um_user_photo_menu_view', 'function_name', 10, 1 ); ?>
					 * @example
					 * <?php
					 * add_filter( 'um_user_photo_menu_view', 'my_user_photo_menu_view', 10, 1 );
					 * function my_user_photo_menu_view( $items ) {
					 *     // your code here
					 *     return $items;
					 * }
					 * ?>
					 */
					$items = apply_filters( 'um_user_photo_menu_view', $items );

					echo UM()->profile()->new_ui( 'bc', 'div.um-profile-photo', 'click', $items );

				} else if (UM()->fields()->editing == true) {

					$items = array(
						'<a href="#" class="um-manual-trigger" data-parent=".um-profile-photo" data-child=".um-btn-auto-width">' . __( 'Change photo', 'ultimate-member' ) . '</a>',
						'<a href="#" class="um-reset-profile-photo" data-user_id="' . um_profile_id() . '" data-default_src="' . um_get_default_avatar_uri() . '">' . __( 'Remove photo', 'ultimate-member' ) . '</a>',
						'<a href="#" class="um-dropdown-hide">' . __( 'Cancel', 'ultimate-member' ) . '</a>',
					);

					/**
					 * UM hook
					 *
					 * @type filter
					 * @title um_user_photo_menu_edit
					 * @description Change user photo on menu edit
					 * @input_vars
					 * [{"var":"$items","type":"array","desc":"User Photos"}]
					 * @change_log
					 * ["Since: 2.0"]
					 * @usage
					 * <?php add_filter( 'um_user_photo_menu_edit', 'function_name', 10, 1 ); ?>
					 * @example
					 * <?php
					 * add_filter( 'um_user_photo_menu_edit', 'my_user_photo_menu_edit', 10, 1 );
					 * function my_user_photo_menu_edit( $items ) {
					 *     // your code here
					 *     return $items;
					 * }
					 * ?>
					 */
					$items = apply_filters( 'um_user_photo_menu_edit', $items );

					echo UM()->profile()->new_ui( 'bc', 'div.um-profile-photo', 'click', $items );

				}

			}

			?>

    </div><?php //end um-header ?>
    </div>
    
    <div class="col-sm">
		<div class="um-profile-meta">

            <?php
            /**
             * UM hook
             *
             * @type action
             * @title um_before_profile_main_meta
             * @description Insert before profile main meta block
             * @input_vars
             * [{"var":"$args","type":"array","desc":"Form Arguments"}]
             * @change_log
             * ["Since: 2.0.1"]
             * @usage add_action( 'um_before_profile_main_meta', 'function_name', 10, 1 );
             * @example
             * <?php
             * add_action( 'um_before_profile_main_meta', 'my_before_profile_main_meta', 10, 1 );
             * function my_before_profile_main_meta( $args ) {
             *     // your code here
             * }
             * ?>
             */
            do_action( 'um_before_profile_main_meta', $args ); ?>

			<div class="um-main-meta">

				<?php if ( $args['show_name'] ) { ?>
					<div class="um-name">

						<a href="<?php echo um_user_profile_url(); ?>"
               title="<?php echo um_user( 'display_name' ); ?>" class="accr_member-name"><?php echo um_user( 'display_name', 'html' ); ?></a>
            <div class="accr_discipline">
              <?php 
                $discipline = um_user('discipline');
                //$discipline = get_user_meta( um_user( 'ID' ), 'discipline', true );
                if(gettype($discipline) == 'array'){
                  echo '<span>';
                  for($d = 0; $d < count($discipline); $d++){
                    echo $d > 0 ? ', ' : '';
                    echo $discipline[$d];
                  }
                  echo '</span>';
                }
                else{
                  echo '<span>' . $discipline . '</span>';
                }
              ?>
            </div>

						<?php
						/**
						 * UM hook
						 *
						 * @type action
						 * @title um_after_profile_name_inline
						 * @description Insert after profile name some content
						 * @input_vars
						 * [{"var":"$args","type":"array","desc":"Form Arguments"}]
						 * @change_log
						 * ["Since: 2.0"]
						 * @usage add_action( 'um_after_profile_name_inline', 'function_name', 10, 1 );
						 * @example
						 * <?php
						 * add_action( 'um_after_profile_name_inline', 'my_after_profile_name_inline', 10, 1 );
						 * function my_after_profile_name_inline( $args ) {
						 *     // your code here
						 * }
						 * ?>
						 */
						do_action( 'um_after_profile_name_inline', $args ); ?>

					</div>
				<?php } ?>

				<div class="um-clear"></div>

				<?php
				/**
				 * UM hook
				 *
				 * @type action
				 * @title um_after_profile_header_name_args
				 * @description Insert after profile header name some content
				 * @input_vars
				 * [{"var":"$args","type":"array","desc":"Form Arguments"}]
				 * @change_log
				 * ["Since: 2.0"]
				 * @usage add_action( 'um_after_profile_header_name_args', 'function_name', 10, 1 );
				 * @example
				 * <?php
				 * add_action( 'um_after_profile_header_name_args', 'my_after_profile_header_name_args', 10, 1 );
				 * function my_after_profile_header_name_args( $args ) {
				 *     // your code here
				 * }
				 * ?>
				 */
				do_action( 'um_after_profile_header_name_args', $args );
				/**
				 * UM hook
				 *
				 * @type action
				 * @title um_after_profile_name_inline
				 * @description Insert after profile name some content
				 * @change_log
				 * ["Since: 2.0"]
				 * @usage add_action( 'um_after_profile_name_inline', 'function_name', 10 );
				 * @example
				 * <?php
				 * add_action( 'um_after_profile_name_inline', 'my_after_profile_name_inline', 10 );
				 * function my_after_profile_name_inline() {
				 *     // your code here
				 * }
				 * ?>
				 */
				do_action( 'um_after_profile_header_name' ); ?>

			</div>

			<?php if (isset( $args['metafields'] ) && !empty( $args['metafields'] )) { ?>
				<div class="accr_meta">

          <?php //echo UM()->profile()->show_meta( $args['metafields'] ); ?>
          <?php
            if(um_user('street_address') || um_user('city_state_zip')){
              echo '<p>';
            }
            echo um_user('street_address') ? um_user('street_address') : '';
            if(um_user('street_address') && um_user('city_state_zip')){ echo ', '; }
            echo um_user('city_state_zip') ? um_user('city_state_zip') : '';
            if(um_user('street_address') || um_user('city_state_zip')){
              echo '</p>';
            }

            echo um_user('profile_phone_number') ? '<p>' . um_user('profile_phone_number') . '</p>' : '';

            echo um_user('secondary_email_address') ? '<p>' . um_user('secondary_email_address') . '</p>' : '';

            echo um_user('user_url') ? '<p><a href="' . um_user('user_url') . '" target="_blank">' . um_user('user_url') . '</a></p>' : '';
          ?>

				</div>
			<?php } ?>

			<?php if (UM()->fields()->viewing == true && um_user( 'description' ) && $args['show_bio']) { ?>

				<div class="um-meta-text">
					<?php

					$description = get_user_meta( um_user( 'ID' ), 'description', true );
					if ( UM()->options()->get( 'profile_show_html_bio' ) ) : ?>
						<?php echo make_clickable( wpautop( wp_kses_post( $description ) ) ); ?>
					<?php else : ?>
						<?php echo esc_html( $description ); ?>
					<?php endif; ?>
				</div>

			<?php } else if (UM()->fields()->editing == true && $args['show_bio']) { ?>

				<div class="um-meta-text">
					<textarea id="um-meta-bio"
					          data-character-limit="<?php echo UM()->options()->get( 'profile_bio_maxchars' ); ?>"
					          placeholder="<?php _e( 'Tell us a bit about yourself...', 'ultimate-member' ); ?>"
					          name="<?php echo 'description-' . $args['form_id']; ?>"
					          id="<?php echo 'description-' . $args['form_id']; ?>"><?php if (um_user( 'description' )) {
							echo um_user( 'description' );
						} ?></textarea>
					<span class="um-meta-bio-character um-right"><span
							class="um-bio-limit"><?php echo UM()->options()->get( 'profile_bio_maxchars' ); ?></span></span>
					<?php
					if (UM()->fields()->is_error( 'description' )) {
						echo UM()->fields()->field_error( UM()->fields()->show_error( 'description' ), true );
					}
					?>

				</div>

			<?php } ?>

			<div class="um-profile-status <?php echo um_user( 'account_status' ); ?>">
				<span><?php printf( __( 'This user account status is %s', 'ultimate-member' ), um_user( 'account_status_name' ) ); ?></span>
			</div>

			<?php
			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_after_header_meta
			 * @description Insert after header meta some content
			 * @input_vars
			 * [{"var":"$user_id","type":"int","desc":"User ID"},
			 * {"var":"$args","type":"array","desc":"Form Arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_after_header_meta', 'function_name', 10, 2 );
			 * @example
			 * <?php
			 * add_action( 'um_after_header_meta', 'my_after_header_meta', 10, 2 );
			 * function my_after_header_meta( $user_id, $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( 'um_after_header_meta', um_user( 'ID' ), $args ); ?>

		</div>
		<div class="um-clear"></div>

		<?php if ( UM()->fields()->is_error( 'profile_photo' ) ) {
			echo UM()->fields()->field_error( UM()->fields()->show_error( 'profile_photo' ), 'force_show' );
		}

		/**
		 * UM hook
		 *
		 * @type action
		 * @title um_after_header_info
		 * @description Insert after header info some content
		 * @input_vars
		 * [{"var":"$user_id","type":"int","desc":"User ID"},
		 * {"var":"$args","type":"array","desc":"Form Arguments"}]
		 * @change_log
		 * ["Since: 2.0"]
		 * @usage add_action( 'um_after_header_info', 'function_name', 10, 2 );
		 * @example
		 * <?php
		 * add_action( 'um_after_header_info', 'my_after_header_info', 10, 2 );
		 * function my_after_header_info( $user_id, $args ) {
		 *     // your code here
		 * }
		 * ?>
		 */
		do_action( 'um_after_header_info', um_user( 'ID' ), $args ); ?>

	</div><?php //end profile meta ?>
  </div><!-- col-sm-6 -->
  </div><!-- row -->

	<?php
}
add_action( 'accr_profile_header', 'accr_profile_header', 9);
do_action('accr_profile_header', $args);

		/**
		 * UM hook
		 *
		 * @type filter
		 * @title um_profile_navbar_classes
		 * @description Additional classes for profile navbar
		 * @input_vars
		 * [{"var":"$classes","type":"string","desc":"UM Posts Tab query"}]
		 * @change_log
		 * ["Since: 2.0"]
		 * @usage
		 * <?php add_filter( 'um_profile_navbar_classes', 'function_name', 10, 1 ); ?>
		 * @example
		 * <?php
		 * add_filter( 'um_profile_navbar_classes', 'my_profile_navbar_classes', 10, 1 );
		 * function my_profile_navbar_classes( $classes ) {
		 *     // your code here
		 *     return $classes;
		 * }
		 * ?>
		 */
		$classes = apply_filters( 'um_profile_navbar_classes', '' ); ?>

		<div class="um-profile-navbar <?php echo $classes ?>">
			<?php
			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_profile_navbar
			 * @description Profile navigation bar
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Profile form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_profile_navbar', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_profile_navbar', 'my_profile_navbar', 10, 1 );
			 * function my_profile_navbar( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( 'um_profile_navbar', $args ); ?>
			<div class="um-clear"></div>
		</div>

		<?php
		/**
		 * UM hook
		 *
		 * @type action
		 * @title um_profile_menu
		 * @description Profile menu
		 * @input_vars
		 * [{"var":"$args","type":"array","desc":"Profile form shortcode arguments"}]
		 * @change_log
		 * ["Since: 2.0"]
		 * @usage add_action( 'um_profile_menu', 'function_name', 10, 1 );
		 * @example
		 * <?php
		 * add_action( 'um_profile_menu', 'my_profile_navbar', 10, 1 );
		 * function my_profile_navbar( $args ) {
		 *     // your code here
		 * }
		 * ?>
		 */
		do_action( 'um_profile_menu', $args );

		$nav = UM()->profile()->active_tab;
		$subnav = ( get_query_var('subnav') ) ? get_query_var('subnav') : 'default';

print "<div class='um-profile-body $nav $nav-$subnav'>";

			// Custom hook to display tabbed content
		/**
		 * UM hook
		 *
		 * @type action
		 * @title um_profile_content_{$nav}
		 * @description Custom hook to display tabbed content
		 * @input_vars
		 * [{"var":"$args","type":"array","desc":"Profile form shortcode arguments"}]
		 * @change_log
		 * ["Since: 2.0"]
		 * @usage add_action( 'um_profile_content_{$nav}', 'function_name', 10, 1 );
		 * @example
		 * <?php
		 * add_action( 'um_profile_content_{$nav}', 'my_profile_content', 10, 1 );
		 * function my_profile_content( $args ) {
		 *     // your code here
		 * }
		 * ?>
		 */
    add_action('um_before_form', 'accr_before_form', 10, 1);
    function accr_before_form($args){
      echo '<div class="accr_member-bio"><p>' . esc_html(um_user('description')) . '</p></div>';
      echo '<div class="accr_member-additional-info"><p>' . esc_html(um_user('additional_information')) . '</p></div>';
    }
    do_action("um_profile_content_{$nav}", $args);
    


		/**
		 * UM hook
		 *
		 * @type action
		 * @title um_profile_content_{$nav}_{$subnav}
		 * @description Custom hook to display tabbed content
		 * @input_vars
		 * [{"var":"$args","type":"array","desc":"Profile form shortcode arguments"}]
		 * @change_log
		 * ["Since: 2.0"]
		 * @usage add_action( 'um_profile_content_{$nav}_{$subnav}', 'function_name', 10, 1 );
		 * @example
		 * <?php
		 * add_action( 'um_profile_content_{$nav}_{$subnav}', 'my_profile_content', 10, 1 );
		 * function my_profile_content( $args ) {
		 *     // your code here
		 * }
		 * ?>
		 */
		do_action( "um_profile_content_{$nav}_{$subnav}", $args );

		print "</div>";

		if ( um_is_on_edit_profile() ) { ?>
			</form>
		<?php } ?>
	</div>
</div>

<div class="accr_upcoming-events">
  <div class="accr_member-upcoming-events-titlebar">
     <a href="#">Upcoming Events</a>
  </div>
  <?php 
    $user_id = um_user('ID');
    $venue_or_artist = get_field('venue_or_artist', 'user_' . $user_id);
    $events_profile_type = '';
    $events_meta_key = '';

    if($venue_or_artist == 'Venue'){
      $events_profile_type = get_field('events_venue', 'user_' . $user_id, false);
      $events_meta_key = '_EventVenueID';
    }
    else if($venue_or_artist == 'Artist'){
      $events_profile_type = get_field('events_artist', 'user_' . $user_id, false);
      $events_meta_key = '_EventOrganizerID';
    }
    //var_dump($events_profile_type);
    if($events_profile_type){
    $events_profile_type_id = $events_profile_type[0];

    $events = tribe_get_events(array(
      'eventDisplay' => 'list',
      'posts_per_page' => 10,
      'meta_key' => $events_meta_key,
      'meta_value' => $events_profile_type_id
    ));

    $featuredEvents = tribe_get_events(array(
      'posts_per_page' => 10,
      'eventDisplay' => 'list',
      'meta_key' => $events_meta_key,
      'meta_value' => $events_profile_type_id,
      'featured' => true
    ));

    //var_dump($events);
    if(empty($events)){
      echo '<p>This ' . $venue_or_artist . ' does not currently have any upcoming events.';
    }
    else{
      foreach($events as $event){
        $start_date = tribe_get_start_date( $event, false, 'M d, Y', null );
        $end_date = tribe_get_end_date( $event, false, 'M d, Y', null );
        ?>
        <div class="accr_member-event">
          <div class="row">
            <div class="col-sm-3">
              <div class="event-thumbnail__image <?php if( in_array( $event, $featuredEvents ) ): echo 'event-thumbnail__image--featured'; endif; ?>">
                <a href="<?php echo get_permalink($event); ?>" class="event-thumbnail__event">
                  <img src="<?php echo get_the_post_thumbnail_url( $event ); ?>" alt="">
              </div>
            </div>
            <div class="col-sm-7">
              <div class="accr_member-event-info">
                <h3 class="event-thumbnail__title"><a href="<?php echo get_permalink($event); ?>" class="event-thumbnail__event"><?php echo $event->post_title; ?></a></h3>
                <p class="accr_member-presenter">presented by: <?php echo tribe_get_organizer($event->ID); ?></p>
                <p class="accr_member-date"><?php echo $start_date; echo strcmp($start_date, $end_date) ? ' - ' . $end_date : ''; ?></p>
              </div>
            </div>
            <div class="col-sm-2">
			        <div class="event__small-btns">
                <?php if( get_field( 'get_tickets_link', $event ) ): ?><a href="<?php echo get_field( 'get_tickets_link', $event ); ?>" class="btn btn-white">GET TICKETS</a><?php endif; ?>
                <?php 
                    $start_date_day = tribe_get_start_date( $event, false, 'Ymd', null );
                    $start_date_time = tribe_get_start_date( $event, false, 'His', null );
                    $end_date_day = tribe_get_end_date( $event, false, 'Ymd', null );
                    $end_date_time = tribe_get_end_date( $event, false, 'His', null );

                    $date_start = $start_date_day . 'T' . $start_date_time . 'Z';
                    $date_end = $end_date_day . 'T' . $end_date_time . 'Z';
                    ?>
                <a class="btn btn-white" href="http://www.google.com/calendar/event?action=TEMPLATE&text=<?php echo $event->post_title; ?>&dates=<?php echo $date_start; ?>/<?php echo $date_end; ?>&details=&location=<?php echo tribe_get_venue( $event ); ?>&trp=false&sprop=&sprop=name:" target="_blank" rel="nofollow">ADD IT</a>
			        </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
  <?php
      } 
    }
    }
  ?>
</div>