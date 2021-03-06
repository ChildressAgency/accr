<?php
/**
 * List View Loop
 * This file sets up the structure for the list loop
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/loop.php
 *
 * @version 4.4
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php
global $post;
global $more;
$more = false;
?>

<div class="tribe-events-loop">

	<?php if( have_posts() ): $i=0; while ( have_posts() ) : the_post(); ?>
		<?php //do_action( 'tribe_events_inside_before_loop' ); ?>

		<!-- Month / Year Headers -->
		<?php //tribe_events_list_the_date_headers(); ?>

		<!-- Event  -->
		<?php

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
	<?php $i++; endwhile; endif; ?>

</div><!-- .tribe-events-loop -->
