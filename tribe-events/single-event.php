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
$venue_details = tribe_get_venue_details();

$event_id = get_the_ID();
$event = tribe_events_get_event( $event_id );

$start_date_day = tribe_get_start_date( $event, false, 'Ymd', null );
$start_date_time = tribe_get_start_date( $event, false, 'His', null );
$end_date_day = tribe_get_end_date( $event, false, 'Ymd', null );
$end_date_time = tribe_get_end_date( $event, false, 'His', null );

?>

<section>
    <div class="event single-event">
        <div class="event__header event__header--featured">
            <h3 class="event__title"><?php echo $event->post_title; ?></h3>
            <?php if( $venue_details['linked_name'] ): ?><p class="event__subtitle">presented by: <?php echo $venue_details['linked_name']; ?></p><?php endif; ?>
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

<?php
$start_date_day = tribe_get_start_date( $event, false, 'M d, Y', null );
$end_date_day = tribe_get_end_date( $event, false, 'M d, Y', null );
$start_date_time = tribe_get_start_date( $event, false, 'h:i a', null );
$end_date_time = tribe_get_end_date( $event, false, 'h:i a', null );

$isAllDay = tribe_event_is_all_day( $event_id );

if( $start_date_day ): ?>
<section class="event__meta-data">
    <h2 class="section-tab section-tab__active">Dates and Times <!-- <i class="icon fas fa-ticket-alt"> --></i></h2>
    <hr />
    <p><strong><?php echo $start_date_day; 
    if( !$isAllDay ){ 
        echo ' ' . $start_date_time; 
    } 
    if( strcmp( $start_date_day, $end_date_day ) ){ 
        echo ' - ' . $end_date_day;
        if( !$isAllDay ){ 
            echo ' ' . $end_date_time; 
        } 
    } elseif( !$isAllDay ){
        echo ' - ' . $end_date_time;
    } ?></strong></p>
</section>
<?php endif; ?>

<?php 
$map = tribe_get_embedded_map();
if( $map || $venue_details['linked_name'] || $venue_details['address'] ): ?>
<section class="event__meta-data">
    <h2 class="section-tab section-tab__active">Location <!-- <i class="icon fas fa-ticket-alt"> --></i></h2>
    <hr />
    <p><strong><?php echo $venue_details['linked_name']; ?></strong></p>
    <p><?php echo $venue_details['address']; ?></p>
    <?php 
    $map = tribe_get_embedded_map();
    do_action( 'tribe_events_single_meta_map_section_start' );
    echo $map;
    do_action( 'tribe_events_single_meta_map_section_end' );
    ?>
</section>
<?php endif; ?>

<?php if( have_rows( 'info_section' ) ): while( have_rows( 'info_section' ) ): the_row(); ?>
<section class="event__meta-data">
    <h2 class="section-tab section-tab__active"><?php the_sub_field( 'title' ); ?> <!-- <i class="icon fas fa-ticket-alt"> --></i></h2>
    <hr />
    <?php the_sub_field( 'info' ); ?>
</section>
<?php endwhile; endif; ?>

<?php 
$related_events = tribe_get_related_posts( 10, $event_id );
if( $related_events ):
?>
<section class="event__meta-data">
    <h2 class="section-tab section-tab__active">Related <!-- <i class="icon fas fa-ticket-alt"> --></i></h2>
    <hr />

    <?php foreach( $related_events as $related ): 
    $venue_details = tribe_get_venue_details( $related );
    $start_date_day = tribe_get_start_date( $related, false, 'M d, Y', null );
    ?>
    <div class="event">
        <div class="event__info">
            <?php 
            $thumbnail = get_the_post_thumbnail_url( $related ); 
            if( $thumbnail ): ?>
            <div class="event-thumbnail event-thumbnail--small">
                <div class="event-thumbnail__event">
                    <div class="event-thumbnail__image">
                        <img src="<?php echo $thumbnail; ?>" alt="">
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="event__desc-wrapper">
                <div class="event__header">
                    <h3 class="event__title"><a href="<?php echo get_permalink( $related ); ?>"><?php echo $related->post_title; ?></a></h3>
                    <?php if( $venue_details['linked_name'] ): ?><p class="event__subtitle">presented by: <?php echo $venue_details['linked_name']; ?></p><?php endif; ?>
                    <p class="event__small-date"><?php echo $start_date_day; ?></p>
                </div>
            </div>

            <div class="event__small-btns">
                <?php if( get_field( 'get_tickets_link', $related ) ): ?><a href="<?php echo get_field( 'get_tickets_link', $related ); ?>" class="btn btn-white">GET TICKETS</a><?php endif; ?>

                <?php
                    $start_date_day = tribe_get_start_date( $related, false, 'Ymd', null );
                    $start_date_time = tribe_get_start_date( $related, false, 'His', null );
                    $end_date_day = tribe_get_end_date( $related, false, 'Ymd', null );
                    $end_date_time = tribe_get_end_date( $related, false, 'His', null );
                    $date_start = $start_date_day . 'T' . $start_date_time . 'Z';
                    $date_end = $end_date_day . 'T' . $end_date_time . 'Z';
                    ?>
                <a class="btn btn-white" href="http://www.google.com/calendar/event?action=TEMPLATE&text=<?php echo $related->post_title; ?>&dates=<?php echo $date_start; ?>/<?php echo $date_end; ?>&details=&location=<?php echo tribe_get_venue( $related ); ?>&trp=false&sprop=&sprop=name:" target="_blank" rel="nofollow">ADD IT</a>
            </div>
        </div>
    </div>

    <hr class="hr--light" />
    <?php endforeach; ?>
</section>
<?php endif; ?>
