<?php get_header(); ?>

<section>
    <div class="container">
    <?php
      $page_object = get_queried_object();
      $intro = get_field('event_tag_page_intro', $page_object); 
      $sponsor = get_field( 'event_tags_page_sponsor', $page_object ); ?>

      <div class="row">
        <div class="col-12 col-md-5">
          <p class="sponsor__title">Page Sponsored by:</p>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/page-sponsored-by.png" class="sponsor__img">
        </div>
        <div class="col-12 col-md-7 text-center">
          <?php 
            if( $sponsor ) {
              echo $sponsor;
            } else { ?>
              <p class="sponsor__message"><strong>Sponsor this page today and get your logo here.</strong></p>
              <a href="<?php echo esc_url( home_url( 'sponsorships' ) ); ?>" class="btn btn-secondary">BECOME A SPONSOR</a>
          <?php } ?>
        </div>
      </div>

      <?php echo $intro; ?>

      <div class="row">
          <div class="col-md-9 content-with-sidebar">
            <?php //tribe_get_template_part( 'list' ); ?>
            <?php echo do_shortcode('[tag-event-list]'); ?>
          </div>
          <?php get_sidebar(); ?>
      </div>
    </div>
</section>

<?php get_footer(); ?>