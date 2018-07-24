<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();
$event = tribe_events_get_event( $event_id );

?>

<section>
    <div class="event single-event">
        <div class="event__header event__header--featured">
            <h3 class="event__title"><?php echo $event->post_title; ?></h3>
            <p class="event__subtitle">presented by: Location of event, Fredericksburg, VA</p>
        </div>
    
        <div class="event__info">
            <div class="event-thumbnail">
                <div class="event-thumbnail__event">
                    <div class="event-thumbnail__date"><span class="month month--start"><?php echo strtoupper(tribe_get_start_date( $event, false, 'M', null )); ?></span> <span class="day"><?php echo tribe_get_start_date( $event, false, 'd', null ); ?><?php if(strcmp($start_date, $end_date)): ?>-<?php echo tribe_get_end_date( $event, false, 'd', null ); ?></span> <span class="month month--end"><?php echo strtoupper(tribe_get_end_date( $event, false, 'M', null )); endif;?></span></div>
                    <div class="event-thumbnail__image">
                        <img src="<?php echo get_the_post_thumbnail_url( $event ); ?>" alt="">
                    </div>
                </div>
            </div>
            
            <div class="event__desc-wrapper">
                <?php if( $event->post_excerpt ): ?><p><strong><?php echo $event->post_excerpt; ?></strong></p><?php endif; ?>
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

                <!-- <a href="#_" class="btn btn-white">ADD IT</a> -->
                <p class="event__desc"><?php echo $event->post_content; ?></p>
            </div>
        </div>
    </div>
</section>

<?php if( have_rows( 'info_section' ) ): while( have_rows( 'info_section' ) ): the_row(); ?>
<section class="event__meta-data">
    <h2 class="section-tab section-tab__active"><?php the_sub_field( 'title' ); ?> <!-- <i class="icon fas fa-ticket-alt"> --></i></h2>
    <hr />
    <?php the_sub_field( 'info' ); ?>
</section>
<?php endwhile; endif; ?>

<!-- <section class="event__meta-data">
    <h2 class="section-tab section-tab__active">Location <i class="icon fas fa-clock"></i></h2>
    <hr />
    <p><strong>Name of venue or location</strong></p>
    <p>1234 Fakestreet Lane, Fredericksburg, VA 22401</p>

    <iframe class="map" width="600" height="500" src="https://maps.google.com/maps?q=Fredericksburg&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" ></iframe>
</section> -->
