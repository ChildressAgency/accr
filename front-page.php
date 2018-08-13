<?php get_header(); ?>

<?php

$filters = tribe_events_get_filters();
$views   = tribe_events_get_views();

$current_url = tribe_events_get_current_filter_url();
?>

<?php //do_action( 'tribe_events_bar_before_template' ) ?>
<div id="tribe-events-bar">

	<h2 class="tribe-events-visuallyhidden"><?php printf( esc_html__( '%s Search and Views Navigation', 'the-events-calendar' ), tribe_get_event_label_plural() ); ?></h2>

    <form id="tribe-bar-form" class="tribe-clearfix" name="tribe-bar-form" method="post" action="<?php echo esc_url(home_url('events')); ?>">

		<!-- Mobile Filters Toggle -->

		<div id="tribe-bar-collapse-toggle" <?php if ( count( $views ) == 1 ) { ?> class="tribe-bar-collapse-toggle-full-width"<?php } ?>>
			<?php printf( esc_html__( 'Find %s', 'the-events-calendar' ), tribe_get_event_label_plural() ); ?><span class="tribe-bar-toggle-arrow"></span>
		</div>

		<?php if ( ! empty( $filters ) ) { ?>
			<div class="tribe-bar-filters">
				<div class="tribe-bar-filters-inner tribe-clearfix">
          <div class="container">
            <div class="search">
              <h3 class="tribe-events-visuallyhidden"><?php printf( esc_html__( '%s Search', 'the-events-calendar' ), tribe_get_event_label_plural() ); ?></h3>
              <p class="search__text">Find an<br/><span>EVENT</span></p>
              <?php foreach ( $filters as $filter ) : ?>
                <div class="<?php echo esc_attr( $filter['name'] ) ?>-filter search__filter">
                  <!-- <label class="label-<?php echo esc_attr( $filter['name'] ) ?>" for="<?php echo esc_attr( $filter['name'] ) ?>"><?php echo $filter['caption'] ?></label> -->
                  <?php echo $filter['html'] ?>
                </div>
              <?php endforeach; ?>
              <div class="tribe-bar-submit">
                <input
                  class="tribe-events-button tribe-no-param"
                  type="submit"
                  name="submit-bar"
                  aria-label="<?php printf( esc_attr__( 'Submit %s search', 'the-events-calendar' ), tribe_get_event_label_plural() ); ?>"
                  value="<?php printf( esc_attr__( 'Find %s', 'the-events-calendar' ), tribe_get_event_label_plural() ); ?>"
                />
              </div>
            </div>
          </div>
					<!-- .tribe-bar-submit -->
				</div>
				<!-- .tribe-bar-filters-inner -->
			</div><!-- .tribe-bar-filters -->
		<?php } // if ( !empty( $filters ) ) ?>

	</form>
	<!-- #tribe-bar-form -->

</div><!-- #tribe-events-bar -->
<?php //do_action( 'tribe_events_bar_after_template' ); ?>

<?php //end filter bar ?>

<div class="localities">
  <div class="container">
    <ul class="list-unstyled list-inline">
      <li><a href="<?php echo esc_url(home_url('events/category/caroline')); ?>" style="color:#fead15;">Caroline</a></li>
      <li><a href="<?php echo esc_url(home_url('events/category/fredericksburg')); ?>" style="color:#7f19ab;">Fredericksburg</a></li>
      <li><a href="<?php echo esc_url(home_url('events/category/king-george')); ?>" style="color:#10b5e3;">King George</a></li>
      <li><a href="<?php echo esc_url(home_url('events/category/spotsylvania')); ?>" style="color:#b92f2f;">Spotsylvania</a></li>
      <li><a href="<?php echo esc_url(home_url('events/category/stafford')); ?>" style="color:#42ac0e;">Stafford</a></li>
      <li><a href="<?php echo esc_url(home_url('events/category/westmoreland')); ?>" style="color:#ed1dbb;">Westmoreland</a></li>
    </ul>
  </div>
</div>

<?php if ( have_posts() ) : ?>
<section class="events">
    <div class="container">
        <?php 
            $events = tribe_get_events( array(
                'posts_per_page'    => 10,
                'start_date'        => date( 'Y-m-d' ),
                'featured'          => true
            ) ); ?>

        <div class="events__tabs-wrapper">
            <a class="view-all" href="<?php echo( home_url( 'events' ) ); ?>">View All</a>
            <div class="nav nav-tabs" role="tablist">
                <a href="#featured" class="events__heading events__heading--featured nav-item nav-link active" id="nav-featured" data-toggle="tab" role="tab" aria-controls="featured" aria-selected="true"><h2>FEATURED EVENTS</h2></a>
            </div>
        </div>
        <hr />
        <div class="tab-content">
            <div class="tab-pane fade show active" id="featured" role="tabpanel" aria-labelledby="featured-tab">
                <?php if( $events ): ?>
                    <div class="event-slider">
                        <?php foreach( $events as $event ): 
                            $start_date = tribe_get_start_date( $event, false, 'M d, Y', null );
                            $end_date = tribe_get_end_date( $event, false, 'M d, Y', null );
                            ?>
                            <a href="<?php echo get_permalink($event); ?>" class="event-thumbnail__event">
                                <div class="event-thumbnail__date"><span class="month month--start"><?php echo strtoupper(tribe_get_start_date( $event, false, 'M', null )); ?></span> <span class="day"><?php echo tribe_get_start_date( $event, false, 'd', null ); ?><?php if(strcmp($start_date, $end_date)): ?>-<?php echo tribe_get_end_date( $event, false, 'd', null ); ?></span> <span class="month month--end"><?php echo strtoupper(tribe_get_end_date( $event, false, 'M', null )); endif;?></span></div>
                                <div class="event-thumbnail__image">
                                    <img src="<?php echo get_the_post_thumbnail_url( $event ); ?>" alt="">
                                </div>
                                <p class="event-thumbnail__title"><?php echo $event->post_title; ?></p>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>There are no upcoming events in this category.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if ( have_posts() ) : ?>
<section class="events">
    <div class="container">
        <div class="events__tabs-wrapper">
            <a class="view-all" href="<?php echo( home_url( 'events' ) ); ?>">View All</a>
            <div class="nav nav-tabs" role="tablist">
                <a href="#all" class="events__heading nav-item nav-link active" id="nav-all" data-toggle="tab" role="tab" aria-controls="all" aria-selected="true"><h2>ALL EVENTS</h2></a>
                <a href="#family" class="events__heading nav-item nav-link" id="nav-family" data-toggle="tab" role="tab" aria-controls="family" aria-selected="false"><h2>FAMILY</h2></a>
                <a href="#free" class="events__heading nav-item nav-link" id="nav-free" data-toggle="tab" role="tab" aria-controls="free" aria-selected="false"><h2>FREE</h2></a>
            </div>
        </div>
        <hr />
        <div class="tab-content">
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <?php
                    $events = tribe_get_events( array(
                        'posts_per_page'    => 10,
                        'eventDisplay'      => 'list'
                    ) ); 
                    $featuredEvents = tribe_get_events( array(
                        'posts_per_page'    => 10,
                        'eventDisplay'      => 'list',
                        'featured'          => true
                    ) );
                    ?>
                <div class="event-slider">
                    <?php foreach( $events as $event ):
                      if(!get_field('hide_from_all_events_section', $event->ID)) :
                        $start_date = tribe_get_start_date( $event, false, 'M d, Y', null );
                        $end_date = tribe_get_end_date( $event, false, 'M d, Y', null );
                        ?>
                        <a href="<?php echo get_permalink($event); ?>" class="event-thumbnail__event">
                            <div class="event-thumbnail__date"><span class="month month--start"><?php echo strtoupper(tribe_get_start_date( $event, false, 'M', null )); ?></span> <span class="day"><?php echo tribe_get_start_date( $event, false, 'd', null ); ?><?php if(strcmp($start_date, $end_date)): ?>-<?php echo tribe_get_end_date( $event, false, 'd', null ); ?></span> <span class="month month--end"><?php echo strtoupper(tribe_get_end_date( $event, false, 'M', null )); endif;?></span></div>
                            <div class="event-thumbnail__image <?php if( in_array( $event, $featuredEvents ) ): echo 'event-thumbnail__image--featured'; endif; ?>">
                                <img src="<?php echo get_the_post_thumbnail_url( $event ); ?>" alt="">
                            </div>
                            <p class="event-thumbnail__title"><?php echo $event->post_title; ?></p>
                        </a>
                      <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="tab-pane fade" id="family" role="tabpanel" aria-labelledby="family-tab">
                <?php
                    $events = tribe_get_events( array(
                        'posts_per_page'    => 10,
                        'eventDisplay'      => 'list',
                        'tag'               => 'family'
                    ) ); 
                    $featuredEvents = tribe_get_events( array(
                        'posts_per_page'    => 10,
                        'eventDisplay'      => 'list',
                        'tag'               => 'family',
                        'featured'          => true
                    ) );
                    ?>
                    <?php if( $events ): ?>
                        <div class="event-slider">
                            <?php foreach( $events as $event ): 
                                $start_date = tribe_get_start_date( $event, false, 'M d, Y', null );
                                $end_date = tribe_get_end_date( $event, false, 'M d, Y', null );
                                ?>
                                <a href="<?php echo get_permalink($event); ?>" class="event-thumbnail__event">
                                    <div class="event-thumbnail__date"><span class="month month--start"><?php echo strtoupper(tribe_get_start_date( $event, false, 'M', null )); ?></span> <span class="day"><?php echo tribe_get_start_date( $event, false, 'd', null ); ?><?php if(strcmp($start_date, $end_date)): ?>-<?php echo tribe_get_end_date( $event, false, 'd', null ); ?></span> <span class="month month--end"><?php echo strtoupper(tribe_get_end_date( $event, false, 'M', null )); endif;?></span></div>
                                    <div class="event-thumbnail__image <?php if( in_array( $event, $featuredEvents ) ): echo 'event-thumbnail__image--featured'; endif; ?>">
                                        <img src="<?php echo get_the_post_thumbnail_url( $event ); ?>" alt="">
                                    </div>
                                    <p class="event-thumbnail__title"><?php echo $event->post_title; ?></p>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>There are no upcoming events in this category.</p>
                    <?php endif; ?>
            </div>
            <div class="tab-pane fade" id="free" role="tabpanel" aria-labelledby="free-tab">
                <?php
                    $events = tribe_get_events( array(
                        'posts_per_page'    => 10,
                        'eventDisplay'      => 'list',
                        'tag'               => 'free'
                    ) ); 
                    $featuredEvents = tribe_get_events( array(
                        'posts_per_page'    => 10,
                        'eventDisplay'      => 'list',
                        'tag'               => 'free',
                        'featured'          => true
                    ) );
                    ?>
                    <?php if( $events ): ?>
                        <div class="event-slider">
                            <?php foreach( $events as $event ): 
                                $start_date = tribe_get_start_date( $event, false, 'M d, Y', null );
                                $end_date = tribe_get_end_date( $event, false, 'M d, Y', null );
                                ?>
                                <a href="<?php echo get_permalink($event); ?>" class="event-thumbnail__event">
                                    <div class="event-thumbnail__date"><span class="month month--start"><?php echo strtoupper(tribe_get_start_date( $event, false, 'M', null )); ?></span> <span class="day"><?php echo tribe_get_start_date( $event, false, 'd', null ); ?><?php if(strcmp($start_date, $end_date)): ?>-<?php echo tribe_get_end_date( $event, false, 'd', null ); ?></span> <span class="month month--end"><?php echo strtoupper(tribe_get_end_date( $event, false, 'M', null )); endif;?></span></div>
                                    <div class="event-thumbnail__image <?php if( in_array( $event, $featuredEvents ) ): echo 'event-thumbnail__image--featured'; endif; ?>">
                                        <img src="<?php echo get_the_post_thumbnail_url( $event ); ?>" alt="">
                                    </div>
                                    <p class="event-thumbnail__title"><?php echo $event->post_title; ?></p>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>There are no upcoming events in this category.</p>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if( have_rows( 'sponsored_events' ) ): ?>
<section>
    <div class="container">
        <div class="row">
            <?php while( have_rows( 'sponsored_events' ) ): the_row(); ?>
            <div class="col-md-6">
                <a href="<?php the_sub_field( 'link' ); ?>"><img class="img-fluid" src="<?php the_sub_field( 'image' ); ?>" alt=""></a>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section>
    <div class="container">
        <div class="row">
            <section class="secondary-sliders col-md-9 content-with-sidebar">

                <?php if( have_rows( 'secondary_events' ) ): while( have_rows( 'secondary_events' ) ): the_row(); if ( have_posts() ): ?>
                    <section class="events">
                        <div class="container">
                            <div class="events__tabs-wrapper">
                                <a class="view-all" href="<?php echo( home_url( 'events' ) ); ?>">View All</a>
                                <div class="nav nav-tabs" role="tablist">
                                    <?php if( have_rows( 'tab' ) ): $i=0; while( have_rows( 'tab' ) ): the_row(); 
                                        $category = get_sub_field( 'category' );
                                        $category = strtolower( $category->name );

                                        $title = get_sub_field( 'tab_title' );
                                        if( !$title ){
                                            $title = $category;
                                        }
                                        $title = strtoupper( $title );
                                        ?>
                                        <a href="#<?php echo $category; ?>" class="events__heading nav-item nav-link <?php if($i==0){ echo 'active'; } ?>" id="nav-<?php echo $category; ?>" data-toggle="tab" role="tab" aria-controls="<?php echo $category; ?>" aria-selected="true"><h2><?php echo $title; ?></h2></a>
                                    <?php $i++; endwhile; endif; ?>
                                </div>
                            </div>
                            <hr />
                            <div class="tab-content">
                                <?php if( have_rows( 'tab' ) ): $i=0; while( have_rows( 'tab' ) ): the_row(); 
                                    $category = get_sub_field( 'category' );
                                    //$category = strtolower( $category->name );
                                    $acf_category_id = 'post_tag_' . $category->term_id;
                                    $category = $category->slug;

                                    $events = tribe_get_events( array(
                                        'posts_per_page'    => 10,
                                        'eventDisplay'      => 'list',
                                        'tribe_events_cat'  => $category
                                    ) ); 
                                    $featuredEvents = tribe_get_events( array(
                                        'posts_per_page'    => 10,
                                        'eventDisplay'      => 'list',
                                        'tribe_events_cat'  => $category,
                                        'featured'          => true
                                    ) );
                                    ?>
                                    <div class="tab-pane fade <?php if( $i==0 ){ echo 'show active'; } ?>" id="<?php echo $category; ?>" role="tabpanel" aria-labelledby="<?php echo $category; ?>-tab">
                                      
                                      <?php 
                                        $tag_filters = get_field('tag_filters', $acf_category_id);
                                        if($tag_filters): ?>
                                          <ul class="event-slider-secondary__filter">
                                            <li><a href="<?php echo esc_url(home_url('events/category/' . $category)); ?>" class="active">ALL</a></li>|
                                            <?php 
                                              $bar_counter = 1;
                                              $tag_filter_count = count($tag_filters);
                                              foreach($tag_filters as $tag_filter): ?>
                                                <li><a href="<?php echo esc_url(home_url('events/tag/' . $tag_filter->slug)); ?>"><?php echo $tag_filter->name; ?></a></li><?php if($bar_counter < $tag_filter_count){ echo '|'; } ?>
                                            <?php $bar_counter++; endforeach; ?>
                                          </ul>
                                      <?php endif; ?>

                                        <?php if( $events ): ?>
                                        <div class="event-slider-secondary">
                                            <?php foreach( $events as $event ): 
                                                $start_date = tribe_get_start_date( $event, false, 'M d, Y', null );
                                                $end_date = tribe_get_end_date( $event, false, 'M d, Y', null );
                                                ?>
                                                <a href="<?php echo get_permalink($event); ?>" class="event-thumbnail__event">
                                                    <div class="event-thumbnail__date"><span class="month month--start"><?php echo strtoupper(tribe_get_start_date( $event, false, 'M', null )); ?></span> <span class="day"><?php echo tribe_get_start_date( $event, false, 'd', null ); ?><?php if(strcmp($start_date, $end_date)): ?>-<?php echo tribe_get_end_date( $event, false, 'd', null ); ?></span> <span class="month month--end"><?php echo strtoupper(tribe_get_end_date( $event, false, 'M', null )); endif;?></span></div>
                                                    <div class="event-thumbnail__image <?php if( in_array( $event, $featuredEvents ) ): echo 'event-thumbnail__image--featured'; endif; ?>">
                                                        <img src="<?php echo get_the_post_thumbnail_url( $event ); ?>" alt="">
                                                    </div>
                                                    <p class="event-thumbnail__title"><?php echo $event->post_title; ?></p>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php else: ?>
                                            <p style="margin-top:25px;">No upcoming events in this category</p>
                                        <?php endif; ?>
                                    </div>
                                <?php $i++; endwhile; endif; ?>
                            </div>
                        </div>
                    </section>
                <?php endif; endwhile; endif; ?>
            </section>
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>

<section class="social-display">
    <div class="container text-center">
        <p class="social-display__heading">Around the town</p>
        <p class="social-display__subheading">Find us in Instagram at FredericksburgArts and tag us with #FXBGARTS</p>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a href="#social-display__instagram" class="nav-link active" data-toggle="tab" role="tab"><i class="icon fab fa-instagram"></i></a></li>
            <!-- <li class="nav-item"><a href="#social-display__facebook" class="nav-link" data-toggle="tab" role="tab"><i class="icon fab fa-facebook-square"></i></a></li> -->
        </ul>
        <div class="tab-content">
            <div id="social-display__instagram" class="tab-pane fade active show" role="tabpanel"><?php echo do_shortcode('[instagram-feed]'); ?></div>
            <div id="social-display__facebook" class="tab-pane fade" role="tabpanel"><?php echo do_shortcode('[custom-facebook-feed]'); ?></div>
        </div>
    </div>
</section>

<section class="twitter-bar text-center">
    <p>Stay up-to-date on the latest by following us on twitter!</p>
    <a href="<?php the_field( 'twitter', 'option' ); ?>"><i class="icon fab fa-twitter"></i></a>
</section>

<section class="partners text-center">
    <div class="container">
        <p class="partners__heading">We couldn't do this without the support of our great partners</p>

        <div class="row partners__row">
            <?php if( have_rows( 'partners' ) ): while( have_rows( 'partners' ) ): the_row(); ?>
                <?php $num_cols = get_sub_field('layout'); ?>
                <div class="<?php echo $num_cols; ?>"><a href="<?php the_sub_field( 'link' ); ?>"><img src="<?php the_sub_field( 'image' ); ?>" alt="" class="img-fluid"></a></div>
            <?php endwhile; endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>