<?php get_header(); ?>

<section>
    <div class="container">
    <?php
      $page_object = get_queried_object();
      $intro = get_field('event_tag_page_intro', $page_object); ?>

      <div class="row">
        <div class="col-12 col-md-6">
          <p class="sponsor__title">Page Sponsored by:</p>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/page-sponsored-by.png" class="sponsor__img">
        </div>
        <div class="col-12 col-md-6 text-center">
          <?php 
            if( $intro ) {
              echo $intro;
            } else { ?>
              <p class="sponsor__message"><strong>Sponsor this page today and get your logo here.</strong></p>
              <a href="<?php echo esc_url( home_url( 'sponsorships' ) ); ?>" class="btn btn-secondary">BECOME A SPONSOR</a>
          <?php } ?>
        </div>
      </div>

      <div class="row">
          <div class="col-md-9 content-with-sidebar">
            <!-- <?php 
              if(have_posts()): while(have_posts()): the_post(); ?>
                <article class="blog-summary">
                  <h2><?php the_title(); ?></h2>
                  <?php the_excerpt(); ?>
                  <a href="<?php the_permalink(); ?>" class="read-more">Read More...</a>
                </article>
            <?php endwhile; endif; ?> -->
            <?php tribe_get_template_part( 'list' ); ?>
          </div>
          <?php get_sidebar(); ?>
      </div>
    </div>
</section>

<?php get_footer(); ?>