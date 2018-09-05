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
$organizer_link = tribe_get_organizer_link();
$organizer_name = tribe_get_organizer();

$event_id = get_the_ID();
$event = tribe_events_get_event( $event_id );

$start_date_day = tribe_get_start_date( $event, false, 'M d, Y', null );
$end_date_day = tribe_get_end_date( $event, false, 'M d, Y', null );
$start_date_time = tribe_get_start_date( $event, false, 'h:i a', null );
$end_date_time = tribe_get_end_date( $event, false, 'h:i a', null );
$isAllDay = tribe_event_is_all_day( $event_id );

?>

<section>
    <div class="event single-event">
        <div class="event__header event__header--featured">
            <h3 class="event__title"><?php echo $event->post_title; ?></h3>
            <p class="event__subtitle">
                <p class="event__subtitle"><?php if( $organizer_name ): ?>organized by: <?php echo $organizer_link; ?><br/><?php endif; ?>
                    <?php if( $start_date_day ): ?>
                        <?php echo $start_date_day; 
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
                        } ?>
                    <?php endif; ?>
                </p>
            </p>
        </div>
    
        <div class="event__info">
            <div class="event-thumbnail">
                <div class="event-thumbnail__event">
                    <div class="event-thumbnail__date"><span class="month month--start"><?php echo strtoupper(tribe_get_start_date( $event, false, 'M', null )); ?></span> <span class="day"><?php echo tribe_get_start_date( $event, false, 'd', null ); ?><?php if(strcmp($start_date_day, $end_date_day)): ?>-<?php echo tribe_get_end_date( $event, false, 'd', null ); ?></span> <span class="month month--end"><?php echo strtoupper(tribe_get_end_date( $event, false, 'M', null )); endif;?></span></div>
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

                <p class="event__desc"><?php the_content(); ?></p>
            </div>
        </div>
    </div>
</section>

<?php
// $start_date_day = tribe_get_start_date( $event, false, 'M d, Y', null );
// $end_date_day = tribe_get_end_date( $event, false, 'M d, Y', null );
// $start_date_time = tribe_get_start_date( $event, false, 'h:i a', null );
// $end_date_time = tribe_get_end_date( $event, false, 'h:i a', null );

// $isAllDay = tribe_event_is_all_day( $event_id );

if( $start_date_day ): ?>
<section class="event__meta-data">
    <h2 class="section-tab section-tab__active">Details</i></h2>
    <hr />
    <?php if( $start_date_day ): ?>
        <p><strong>Dates and Times:</strong></p>
        <p><?php echo $start_date_day; 
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
        } ?></p>
    <?php endif; ?>

    <?php
    $cats = tribe_get_event_categories(
        get_the_id(), array(
            'before'       => '',
            'sep'          => ', ',
            'after'        => '',
            'label'        => 'Categories',
            'label_before' => '<p><strong>',
            'label_after'  => '</strong></p>',
            'wrap_before'  => '<p>',
            'wrap_after'   => '</p>'
        )
    );
    
    if( $cats ){
        echo $cats;
    }
    ?>
    
    <?php 
    $tags = get_the_term_list( get_the_ID(), 'post_tag', '', ', ', '' );
    if( $tags ): ?>
        <p><strong>Tags</strong>:</p>
        <p><?php echo $tags; ?></p>
    <?php endif; ?>

    <?php 
    $website = tribe_get_event_website_link();

    if( $website ): ?>
        <p><strong>Website</strong>:</p>
        <p><?php echo $website; ?></p>
    <?php endif; ?>
</section>
<?php endif; ?>

<?php 
$map = tribe_get_embedded_map();
if( $map || $venue_details['linked_name'] || $venue_details['address'] ): ?>
<section class="event__meta-data">
    <h2 class="section-tab section-tab__active">Location</i></h2>
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
    <h2 class="section-tab section-tab__active"><?php the_sub_field( 'title' ); ?></i></h2>
    <hr />
    <?php the_sub_field( 'info' ); ?>
</section>
<?php endwhile; endif; ?>
