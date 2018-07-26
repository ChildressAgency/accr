<aside class="sidebar text-center col-md-3">
    <!-- <?php //echo do_shortcode( '[tribe_bar_anywhere]' ); ?>

    <hr class="hr--light" /> -->
    <?php dynamic_sidebar('sidebar-1'); ?>

    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-accr.png" alt="accr logo" class="img-fluid">
    <a href="<?php echo get_field( 'about_accr', 'option' ); ?>" class="btn sidebar__btn btn-primary">ABOUT ACCR</a>
    <p class="sidebar__text">Help promote and sustain the region's art and culture life!</p>
    <a href="<?php echo get_field( 'donate_link', 'option' ); ?>" class="btn sidebar__btn btn-secondary">DONATE TODAY</a>
    <p class="sidebar__text"><i>Become an ACCR member today and give your Artist/Venue profile an extended description as well as having your events tagged as featured.</i></p>
    <a href="#_" class="btn sidebar__btn btn-primary">BECOME A MEMBER</a>

    <hr class="hr--light" />

    <h3 class="sidebar__heading">DIRECTORIES</h3>
    <a href="<?php echo( home_url( 'artists' ) ); ?>" class="btn sidebar__btn btn-primary">ARTISTS</a>
    <a href="<?php echo( home_url( 'venues' ) ); ?>" class="btn sidebar__btn btn-primary">ORGANIZATIONS</a>
    <a href="<?php echo( home_url( 'venues' ) ); ?>" class="btn sidebar__btn btn-primary">VENUES</a>
    <a href="<?php echo( home_url( 'opportunities' ) ); ?>" class="btn sidebar__btn btn-primary">OPPORTUNITIES</a>

    <hr class="hr--light" />

    <?php 
        $query = new WP_Query( array( 'post_type' => 'sponsored', 'posts_per_page' => 5 ) );
        if( $query->have_posts() ): while( $query->have_posts() ): $query->the_post(); ?>
            <a href="<?php echo get_field( 'link' ); ?>"><img class="sidebar__sponsored" src="<?php echo get_field( 'image' ); ?>" alt="" /></a>
        <?php endwhile; 
            wp_reset_postdata();
            endif; ?>
</aside>