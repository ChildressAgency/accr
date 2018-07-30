<?php get_header(); ?>

<section>
    <div class="container">
      <?php 
        if(is_page('events') || is_archive('events') || is_singular('event')){
          if(have_posts()){
            while(have_posts()){
              the_post();
              echo '<article>';
              the_content();
              echo '</article>';
            }
          }
        }
      else{ ?>
        <div class="row">
            <div class="col-md-9 content-with-sidebar">
                <?php //get_template_part( 'tp-share' ); ?>

                <?php 
                if( is_page( 'opportunities' ) ):
                    get_template_part( 'tp-opportunities' );
                elseif( is_page( 'venues' ) || is_page( 'artists' ) ):
                    get_template_part( 'tp-venues' );
                elseif( is_page( 'about-us' ) ):
                    get_template_part( 'tp-about-us' );
                else:
                    if(have_posts()): while(have_posts()): the_post(); ?>
                        <article>
                            <?php the_content(); ?>
                        </article>
                    <?php endwhile; endif; ?>
                <?php endif; ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
      <?php } ?>
    </div>
</section>

<?php get_footer(); ?>