<?php
/**
 * Single Venue Template
 * The template for a venue. By default it displays venue information and lists
 * events that occur at the specified venue.
 *
 * This view contains the filters required to create an effective single venue view.
 *
 * You can recreate an ENTIRELY new single venue view by doing a template override, and placing
 * a single-venue.php file in a tribe-events/pro/ directory within your theme directory, which
 * will override the /views/pro/single-venue.php.
 *
 * You can use any or all filters included in this file or create your own filters in
 * your functions.php. In order to modify or extend a single filter, please see our
 * readme on templates hooks and filters (TO-DO)
 *
 * @package TribeEventsCalendarPro
 *
 * @version 4.4.28
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( ! $wp_query = tribe_get_global_query_object() ) {
    return;
}

$venue_id     = get_the_ID();
$full_address = tribe_get_full_address();
$telephone    = tribe_get_phone();
$website_link = tribe_get_venue_website_link();
?>

<?php while ( have_posts() ) : the_post(); ?>
<div class="tribe-events-venue">

	<p class="tribe-events-back">
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>" rel="bookmark"><?php printf( __( '&larr; Back to %s', 'tribe-events-calendar-pro' ), tribe_get_event_label_plural() ); ?></a>
	</p>

	<div class="single-org">
	    <div class="single-org__img">
	        <?php echo tribe_event_featured_image( null, 'full' ) ?>
	    </div>
	    <div class="single-org__meta">
	        <h2><h1 class="tribe-venue-name"><?php echo tribe_get_venue( $venue_id ); ?></h2>
	        <p class="event__subtitle">Art, Literature, Music</p>
	        <?php if( $full_address ): ?><p><?php echo $full_address; ?></p><?php endif; ?>
	        <?php if( $telephone ): ?><p><a href="tel:<?php echo $telephone; ?>"><?php echo $telephone; ?></a></p><?php endif; ?>
	        <?php if( $website_link ): ?><p><?php echo $website_link; ?></a></p><?php endif; ?>
	    </div>
	    <?php if ( get_the_content() ) : ?>
	    <div class="single-org__desc">
	        <?php the_content(); ?>
	    </div>
		<?php endif; ?>
	</div>

	<?php if( have_rows( 'gallery' ) ): ?>
	<section>
	    <h2 class="section-tab section-tab__active">Photos</h2>
	    <hr />
	    <div class="gallery">
	    	<?php while( have_rows( 'gallery' ) ): the_row(); ?>
	        <img src="<?php the_sub_field( 'image' ); ?>" alt="" class="gallery__item">
		    <?php endwhile; ?>
	    </div>
	</section>
	<?php endif; ?>

	<?php 
	$upcoming_events = tribe_venue_upcoming_events( $venue_id, $wp_query->query_vars );
	if( $upcoming_events ): ?>
	<section class="event__meta-data">
	    <h2 class="section-tab section-tab__active">More From <?php echo tribe_get_venue( $venue_id ); ?>  <!-- <i class="icon fas fa-ticket-alt"> --></i></h2>
	    <hr />
	    <?php
	    // Use the `tribe_events_single_venue_posts_per_page` to filter the number of events to get here.
	    echo $upcoming_events ?>
	</section>
	<?php endif; ?>
	

</div><!-- .tribe-events-venue -->
<?php
endwhile; ?>
