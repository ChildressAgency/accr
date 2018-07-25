<?php
/**
 * Month View Template
 * The wrapper template for month view.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */?>


<?php 
    $eventCat = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    $category = $eventCat->slug;

    $events = tribe_get_events( array(
        'posts_per_page'    => 10,
        'eventDisplay'      => 'upcoming',
        'tribe_events_cat'  => $category
    ) ); 
    $featuredEvents = tribe_get_events( array(
        'posts_per_page'    => 10,
        'eventDisplay'      => 'upcoming',
        'tribe_events_cat'  => $category,
        'featured'          => true
    ) );

    if( $events ):
        $i = 0;
        foreach( $events as $event ):
            $start_date = tribe_get_start_date( $event, false, 'M d, Y', null );
            $end_date = tribe_get_end_date( $event, false, 'M d, Y', null );
            ?>
            <div class="event">
                <?php if( $i==0 ): ?>
                <div class="event__header event__header--featured">
                    <h3 class="event__title"><a href="<?php echo get_permalink( $event ); ?>"><?php echo $event->post_title; ?></a></h3>
                    <p class="event__subtitle">presented by: Location of event, Fredericksburg, VA</p>
                </div>
                <?php endif; ?>

                <div class="event__info">
                    <div class="event-thumbnail <?php if( $i==0 ){ echo 'event-thumbnail--featured'; } ?><?php if( $i > 5 ){ echo 'event-thumbnail--small'; } ?>">
                        <div class="event-thumbnail__event">
                            <?php if( $i <=5 ): ?>
                                <div class="event-thumbnail__date"><span class="month month--start"><?php echo strtoupper(tribe_get_start_date( $event, false, 'M', null )); ?></span> <span class="day"><?php echo tribe_get_start_date( $event, false, 'd', null ); ?><?php if(strcmp($start_date, $end_date)): ?>-<?php echo tribe_get_end_date( $event, false, 'd', null ); ?></span> <span class="month month--end"><?php echo strtoupper(tribe_get_end_date( $event, false, 'M', null )); endif;?></span></div>
                            <?php endif; ?>
                            <div class="event-thumbnail__image <?php if( in_array( $event, $featuredEvents ) ): echo 'event-thumbnail__image--featured'; endif; ?>">
                                <img src="<?php echo get_the_post_thumbnail_url( $event ); ?>" alt="">
                            </div>
                        </div>
                    </div>
                    
                    <div class="event__desc-wrapper">
                        <?php if( $i==0 ): ?>
                            <?php if( $event->post_excerpt ): ?><p><strong><?php echo $event->post_excerpt; ?></strong></p><?php endif; ?>
                            <?php if( get_field( 'get_tickets_link', $event ) ): ?><a href="<?php echo get_field( 'get_tickets_link', $event ); ?>" class="btn btn-white">GET TICKETS</a><?php endif; ?>
                            <a href="#_" class="btn btn-white">ADD IT</a>
                            <p class="event__desc"><?php echo mb_strimwidth( $event->post_content, 0, 500, '...' ); ?></p>
                            <a href="<?php echo get_permalink( $event ); ?>" class="view-more">View more</a>
                        <?php elseif( $i<=5 ): ?>
                            <div class="event__header">
                                <h3 class="event__title"><a href="<?php echo get_permalink( $event ); ?>"><?php echo $event->post_title; ?></a></h3>
                                <p class="event__subtitle">presented by: Location of event, Fredericksburg, VA</p>
                            </div>
                            <p class="event__desc"><?php echo mb_strimwidth( $event->post_content, 0, 500, '...' ); ?></p>
                            <?php if( get_field( 'get_tickets_link', $event ) ): ?><a href="<?php echo get_field( 'get_tickets_link', $event ); ?>" class="btn btn-white">GET TICKETS</a><?php endif; ?>
                            <a href="#_" class="btn btn-white">ADD IT</a>
                        <?php else: ?>
                            <div class="event__header">
                                <h3 class="event__title"><a href="<?php echo get_permalink( $event ); ?>"><?php echo $event->post_title; ?></a></h3>
                                <p class="event__subtitle">presented by: Location of event, Fredericksburg, VA</p>
                                <p class="event__small-date"><?php echo $start_date; if( strcmp( $start_date, $end_date ) ){ echo ' - ' . $end_date; } ?></p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if( $i > 5 ): ?>
                        <div class="event__small-btns">
                            <?php if( get_field( 'get_tickets_link', $event ) ): ?><a href="<?php echo get_field( 'get_tickets_link', $event ); ?>" class="btn btn-white">GET TICKETS</a><?php endif; ?>
                            <a href="#_" class="btn btn-white">ADD IT</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <hr class="hr--light" />

<?php $i++; endforeach; endif; ?>



<?php //do_action( 'tribe_events_before_template' );

// Title Bar
//tribe_get_template_part( 'month/title-bar' );

// Tribe Bar
//tribe_get_template_part( 'modules/bar' );

// Main Events Content
//tribe_get_template_part( 'month/content' );

//do_action( 'tribe_events_after_template' );
?>