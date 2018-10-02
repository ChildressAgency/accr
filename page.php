<?php get_header(); ?>

<section>
    <div class="container">
        <?php if( is_page()
                && !is_page( 'about-us' )
                && !is_page( 'account' )
<<<<<<< HEAD
                && !is_page( 'user' )
                && !is_page('members')):?>
=======
                && !is_page( 'user' )):?>
>>>>>>> b318f694e4f224205beb606618f5b5cd6676b2aa
            <h1><?php echo the_title(); ?></h1>
        <?php endif; ?>

        <?php
            if(is_post_type_archive('tribe_events')){
                if(is_tax('tribe_events_cat')){
                    $page_object = get_queried_object();
<<<<<<< HEAD
                    $intro = get_field('event_category_page_intro', $page_object); 
                    $sponsor = get_field( 'event_category_page_sponsor', $page_object ); ?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <p class="sponsor__title">Page Sponsored by:</p>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/page-sponsored-by.png" class="sponsor__img">
                            </div>
                            <div class="col-12 col-md-7 text-center">
                                <?php if( $sponsor ) {
                                    echo $sponsor;
                                } else { ?>
                                    <p class="sponsor__message"><strong>Sponsor this page today and get your logo here.</strong></p>
                                    <a href="<?php echo esc_url( home_url( 'sponsorships' ) ); ?>" class="btn btn-secondary">BECOME A SPONSOR</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <?php echo $intro;
                }
                elseif(is_tag()){
                    $page_object = get_queried_object();
                    $intro = get_field('event_tag_page_intro', $page_object); 
                    $sponsor = get_field( 'event_tags_page_sponsor', $page_object ); ?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <p class="sponsor__title">Page Sponsored by:</p>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/page-sponsored-by.png" class="sponsor__img">
                            </div>
                            <div class="col-12 col-md-7 text-center">
                                <?php if( $sponsor ) {
                                    echo $sponsor;
                                } else { ?>
                                    <p class="sponsor__message"><strong>Sponsor this page today and get your logo here.</strong></p>
                                    <a href="<?php echo esc_url( home_url( 'sponsorships' ) ); ?>" class="btn btn-secondary">BECOME A SPONSOR</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <?php echo $intro;
                }
                else{
                    echo get_field('all_events_page_intro', 'option');
                }
            }
        ?>
        <div class="row">
            <div class="col-md-9 content-with-sidebar">

=======
                    echo get_field('event_category_page_intro', $page_object);
                }
                elseif(is_tag()){
                    $page_object = get_queried_object();
                    echo get_field('event_tag_page_intro', $page_object);
                }
                else{
                    echo get_field('all_events_page_intro', 'option');
                }
            }
        ?>
        <div class="row">
            <div class="col-md-9 content-with-sidebar">

>>>>>>> b318f694e4f224205beb606618f5b5cd6676b2aa
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
<<<<<<< HEAD
                    <?php endwhile; else: ?>
                      <article><p>Sorry, we could not find any events. Please try a different search.</p></article>
                    <?php endif; ?>
=======
                    <?php endwhile; endif; ?>
>>>>>>> b318f694e4f224205beb606618f5b5cd6676b2aa
                <?php endif; ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>