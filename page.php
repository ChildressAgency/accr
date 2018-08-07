<?php get_header(); ?>

<section>
    <div class="container">
      <?php
        //$page_object = get_queried_object();
        //$term_id = $page_object->term_taxonomy_id;
        //$term = get_term($term_id);
        //$term_name = $term->slug;
        //var_dump($page_object);

        if(is_post_type_archive('tribe_events') && !is_tax('tribe_events_cat')):
          echo get_field('all_events_page_intro', 'option');
        elseif(is_tax('tribe_events_cat')):
          $page_object = get_queried_object();
          //var_dump($page_object);
          echo get_field('event_category_page_intro', $page_object);
        endif;
      ?>
        
        <?php /*
          if( is_page('venues') || is_singular('venue') ) {
            if(have_posts()){
              while(have_posts()){
                the_post();
                echo '<article>';
                the_content();
                echo '</article>';
              }
            }
          }
        else{ */ ?>
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
        <?php //} ?>
    </div>
</section>

<?php get_footer(); ?>