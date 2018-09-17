<aside class="sidebar text-center col-md-3">
  <a href="<?php echo esc_url(home_url('event-eligibility')); ?>" class="btn sidebar__btn btn-primary">ADD AN EVENT</a>
    <?php

    $filters = tribe_events_get_filters();

    $current_url = tribe_events_get_current_filter_url();
    ?>

    <form id="tribe-bar-form" class="" name="tribe-bar-form" method="post" action="<?php echo esc_url( home_url( 'events' ) ); ?>">
        <?php if ( ! empty( $filters ) ) { ?>
            <div class="search search--sidebar">
                <h3 class="sidebar__heading sidebar__heading--find-event">FIND AN EVENT</h3>
                <?php foreach ( $filters as $filter ) : ?>
                    <div class="<?php echo esc_attr( $filter['name'] ) ?>-filter search__filter">
                        <?php echo $filter['html'] ?>
                    </div>
                <?php endforeach; ?>
                <div class="tribe-bar-submit">
                    <input
                        class="tribe-events-button tribe-no-param"
                        type="submit"
                        name="submit-bar"
                        value="SEARCH"
                    />
                </div>
            </div><!-- .tribe-bar-submit -->
        <?php } // if ( !empty( $filters ) ) ?>

    </form><!-- #tribe-bar-form -->

    <hr class="hr--light" />

    <div class="search search--sidebar">
        <h3 class="sidebar__heading sidebar__heading--find-event">FIND A VENUE</h3>
        <form action="<?php echo site_url( '/' ); ?>" role="search" method="get" id="venue-search">
            <div class="search__filter"><input class="" type="text" name="s" placeholder="Search Venues"></div>
            <div class="search__filter"><input class="" type="hidden" name="post_type" value="venues"></div>
            <div class="search__filter"><input class="" type="submit" value="Search"></div>
        </form>
    </div>

    <hr class="hr--light" />

    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-accr.png" alt="accr logo" class="img-fluid">
    <a href="<?php echo get_field( 'about_accr', 'option' ); ?>" class="btn sidebar__btn btn-primary">ABOUT ACCR</a>
    <p class="sidebar__text">Help promote and sustain the region's art and culture life!</p>
    <a href="<?php echo get_field( 'donate_link', 'option' ); ?>" class="btn sidebar__btn btn-secondary">DONATE TODAY</a>
    <p class="sidebar__text"><i>Become an ACCR member today and give your Artist/Venue profile an extended description as well as having your events tagged as featured.</i></p>
    <a href="#_" class="btn sidebar__btn btn-primary">BECOME A MEMBER</a>

    <hr class="hr--light" />

    <h3 class="sidebar__heading">DIRECTORIES</h3>
    <a href="<?php echo esc_url(home_url('get-listed')); ?>" class="btn sidebar__btn btn-primary">GET LISTED</a>
  
    <a href="<?php echo home_url('members'); ?>" class="btn sidebar__btn btn-primary">ALL PROFILES</a>
    <a href="<?php echo esc_url(add_query_arg(array('profile_type' => 'Artist', 'um_search' => '1'), home_url('members'))); ?>" class="btn sidebar__btn btn-primary">ARTISTS</a>
    <a href="<?php echo esc_url(add_query_arg(array('profile_type' => 'Venue and Public Art', 'um_search' => '1'), home_url('members'))); ?>" class="btn sidebar__btn btn-primary">VENUES</a>
    <a href="<?php echo esc_url(add_query_arg(array('profile_type' => 'Arts & Cultural Organization', 'um_search' => '1'), home_url('members'))); ?>" class="btn sidebar__btn btn-primary">ORGANIZATIONS</a>

    <a href="<?php echo esc_url(home_url('opportunities')); ?>" class="btn sidebar__btn btn-primary">OPPORTUNITIES</a>
    <hr class="hr--light" />

    <div class="search search--sidebar">
      <?php dynamic_sidebar('sidebar-1'); ?>
    </div>

    <?php 
        $query = new WP_Query( array( 'post_type' => 'sponsored', 'posts_per_page' => 5, 'order' => 'ASC' ) );
        if( $query->have_posts() ): while( $query->have_posts() ): $query->the_post(); ?>
            <a href="<?php echo get_field( 'link' ); ?>"><img class="sidebar__sponsored" src="<?php echo get_field( 'image' ); ?>" alt="" /></a>
        <?php endwhile; 
            wp_reset_postdata();
            endif; ?>
</aside>