<?php get_header(); ?>

<section class="filter">
    <div class="container">
        <ul class="filter__list">
            <li class="active"><a href="#_">All</a></li>|
            <li><a href="#_">Caroline</a></li>|
            <li><a href="#_">Fredericksburg</a></li>|
            <li><a href="#_">King George</a></li>|
            <li><a href="#_">Spotsylvania</a></li>|
            <li><a href="#_">Stafford</a></li>|
            <li><a href="#_">Westmoreland</a></li>
        </ul>
    </div>
</section>

<?php if ( have_posts() ) : ?>
    <section class="events">
        <div class="container">

            <?php 

                if ( ! $wp_query = tribe_get_global_query_object() ) {
                    return;
                }

                global $post;
                $events = tribe_get_events( array(
                    'posts_per_page'    => 10,
                    'start_date'        => '2018-07-13',
                    'category'     => 'auditions'
                ) );
                $featuredEvents = tribe_get_events( array(
                    'posts_per_page'    => 10,
                    'start_date'        => '2018-07-13',
                    'featured'          => true
                ) ); ?>

            <div class="events__tabs-wrapper">
                <a class="view-all" href="#_">View All</a>
                <div class="nav nav-tabs" role="tablist">
                    <a href="#featured" class="events__heading events__heading--featured nav-item nav-link active" id="nav-featured" data-toggle="tab" role="tab" aria-controls="featured" aria-selected="true"><h2>TEST EVENTS</h2></a>
                </div>
            </div>
            <hr />
            <div class="tab-content">
                <div class="tab-pane fade show active" id="featured" role="tabpanel" aria-labelledby="featured-tab">
                    <div class="event-slider">
                        <?php foreach( $events as $event ): 
                            $start_date = tribe_get_start_date( $event, false, 'M d, Y', null );
                            $end_date = tribe_get_end_date( $event, false, 'M d, Y', null );
                            ?>
                            <a href="<?php echo get_permalink($event); ?>" class="event-thumbnail__event">
                                <div class="event-thumbnail__date"><span class="month month--start"><?php echo strtoupper(tribe_get_start_date( $event, false, 'M', null )); ?></span> <span class="day"><?php echo tribe_get_start_date( $event, false, 'd', null ); ?><?php if(strcmp($start_date, $end_date)): ?>-<?php echo tribe_get_end_date( $event, false, 'd', null ); ?></span> <span class="month month--end"><?php echo strtoupper(tribe_get_end_date( $event, false, 'M', null )); endif;?></span></div>
                                <div class="event-thumbnail__image <?php if( in_array( $event, $featuredEvents ) ): echo 'event-thumbnail__image--featured'; endif; ?>">
                                    <img src="<?php echo get_the_post_thumbnail_url( $event ); ?>" alt="event image">
                                </div>
                                <p class="event-thumbnail__title"><?php echo $event->post_title; ?></p>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="events">
    <div class="container">
        <div class="events__tabs-wrapper">
            <a class="view-all" href="#_">View All</a>
            <div class="nav nav-tabs" role="tablist">
                <a href="#featured" class="events__heading events__heading--featured nav-item nav-link active" id="nav-featured" data-toggle="tab" role="tab" aria-controls="featured" aria-selected="true"><h2>FEATURED EVENTS</h2></a>
            </div>
        </div>
        <hr />
        <div class="tab-content">
            <div class="tab-pane fade show active" id="featured" role="tabpanel" aria-labelledby="featured-tab">
                <div class="event-slider">
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-1.png" alt="event image" class="event-thumbnail__image">
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="ongoing">ONGOING</span></div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-2.png" alt="event image" class="event-thumbnail__image">
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">20-07</span> <span class="month month--end">JUL</span></div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-3.png" alt="event image" class="event-thumbnail__image">
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-4.png" alt="event image" class="event-thumbnail__image">
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-4.png" alt="event image" class="event-thumbnail__image">
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="events">
    <div class="container">
        <div class="events__tabs-wrapper">
            <a class="view-all" href="#_">View All</a>
            <div class="nav nav-tabs" role="tablist">
                <a href="#all" class="events__heading nav-item nav-link active" id="nav-all" data-toggle="tab" role="tab" aria-controls="all" aria-selected="true"><h2>ALL EVENTS</h2></a>
                <a href="#family" class="events__heading nav-item nav-link" id="nav-family" data-toggle="tab" role="tab" aria-controls="family" aria-selected="false"><h2>FAMILY</h2></a>
                <a href="#free" class="events__heading nav-item nav-link" id="nav-free" data-toggle="tab" role="tab" aria-controls="free" aria-selected="false"><h2>FREE</h2></a>
            </div>
        </div>
        <hr />
        <div class="tab-content">
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <div class="event-slider">
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                        <div class="event-thumbnail__image event-thumbnail__image--featured">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-1.png" alt="event image">
                        </div>
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="ongoing">ONGOING</span></div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-2.png" alt="event image" class="event-thumbnail__image">
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">20-07</span> <span class="month month--end">JUL</span></div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-3.png" alt="event image" class="event-thumbnail__image">
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-4.png" alt="event image" class="event-thumbnail__image">
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                        <div class="event-thumbnail__image event-thumbnail__image--featured">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-4.png" alt="event image">
                        </div>
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="family" role="tabpanel" aria-labelledby="family-tab">
                <div class="event-slider">
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-1.png" alt="event image" class="event-thumbnail__image">
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="ongoing">ONGOING</span></div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-2.png" alt="event image" class="event-thumbnail__image">
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">20-07</span> <span class="month month--end">JUL</span></div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-3.png" alt="event image" class="event-thumbnail__image">
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-4.png" alt="event image" class="event-thumbnail__image">
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-4.png" alt="event image" class="event-thumbnail__image">
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="free" role="tabpanel" aria-labelledby="free-tab">
                <div class="event-slider">
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-1.png" alt="event image" class="event-thumbnail__image">
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="ongoing">ONGOING</span></div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-2.png" alt="event image" class="event-thumbnail__image">
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">20-07</span> <span class="month month--end">JUL</span></div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-3.png" alt="event image" class="event-thumbnail__image">
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-4.png" alt="event image" class="event-thumbnail__image">
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                    <div class="event-thumbnail__event">
                        <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-4.png" alt="event image" class="event-thumbnail__image">
                        <p class="event-thumbnail__title">Title of Event Happening</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="#_"><img class="img-fluid" src="http://dummyimage.com/800x600/b3c6e6/000&amp;text=Sponsored+Event+Space" alt="sponsored event"></a>
            </div>
            <div class="col-md-6">
                <a href="#_"><img class="img-fluid" src="http://dummyimage.com/800x600/b3c6e6/000&amp;text=Sponsored+Event+Space" alt="sponsored event"></a>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <section class="secondary-sliders col-md-9 content-with-sidebar">
                    <section class="events">
                       <div class="container">
                           <div class="events__tabs-wrapper">
                               <a class="view-all" href="#_">View All</a>
                               <div class="nav nav-tabs" role="tablist">
                                   <a href="#art" class="events__heading nav-item nav-link active" id="nav-art" data-toggle="tab" role="tab" aria-controls="art" aria-selected="true"><h2>ART</h2></a>
                               </div>
                           </div>
                           <hr />
                           <div class="tab-content">
                               <div class="tab-pane fade show active" id="art" role="tabpanel" aria-labelledby="art-tab">
                                    <ul class="event-slider-secondary__filter">
                                        <li><a class="active" href="#_">ALL</a></li>|
                                        <li><a href="#_">Exhibits</a></li>|
                                        <li><a href="#_">Opening</a></li>|
                                        <li><a href="#_">First Friday</a></li>
                                    </ul>
                                   <div class="event-slider-secondary">
                                       <div class="event-thumbnail__event">
                                           <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                                           <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-1.png" alt="event image" class="event-thumbnail__image">
                                           <p class="event-thumbnail__title">Title of Event Happening</p>
                                       </div>
                                       <div class="event-thumbnail__event">
                                           <div class="event-thumbnail__date"><span class="ongoing">ONGOING</span></div>
                                           <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-2.png" alt="event image" class="event-thumbnail__image">
                                           <p class="event-thumbnail__title">Title of Event Happening</p>
                                       </div>
                                       <div class="event-thumbnail__event">
                                           <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">20-07</span> <span class="month month--end">JUL</span></div>
                                           <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-3.png" alt="event image" class="event-thumbnail__image">
                                           <p class="event-thumbnail__title">Title of Event Happening</p>
                                       </div>
                                       <div class="event-thumbnail__event">
                                           <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                                           <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-4.png" alt="event image" class="event-thumbnail__image">
                                           <p class="event-thumbnail__title">Title of Event Happening</p>
                                       </div>
                                       <div class="event-thumbnail__event">
                                           <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                                           <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-4.png" alt="event image" class="event-thumbnail__image">
                                           <p class="event-thumbnail__title">Title of Event Happening</p>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                    </section>
        
                    <section class="events">
                        <div class="container">
                            <div class="events__tabs-wrapper">
                                <a class="view-all" href="#_">View All</a>
                                <div class="nav nav-tabs" role="tablist">
                                    <a href="#music" class="events__heading nav-item nav-link active" id="nav-music" data-toggle="tab" role="tab" aria-controls="music" aria-selected="true"><h2>MUSIC</h2></a>
                                </div>
                            </div>
                            <hr />
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="music" role="tabpanel" aria-labelledby="music-tab">
                                    <div class="event-slider-secondary">
                                        <div class="event-thumbnail__event">
                                            <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-1.png" alt="event image" class="event-thumbnail__image">
                                            <p class="event-thumbnail__title">Title of Event Happening</p>
                                        </div>
                                        <div class="event-thumbnail__event">
                                            <div class="event-thumbnail__date"><span class="ongoing">ONGOING</span></div>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-2.png" alt="event image" class="event-thumbnail__image">
                                            <p class="event-thumbnail__title">Title of Event Happening</p>
                                        </div>
                                        <div class="event-thumbnail__event">
                                            <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">20-07</span> <span class="month month--end">JUL</span></div>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-3.png" alt="event image" class="event-thumbnail__image">
                                            <p class="event-thumbnail__title">Title of Event Happening</p>
                                        </div>
                                        <div class="event-thumbnail__event">
                                            <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-4.png" alt="event image" class="event-thumbnail__image">
                                            <p class="event-thumbnail__title">Title of Event Happening</p>
                                        </div>
                                        <div class="event-thumbnail__event">
                                            <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-4.png" alt="event image" class="event-thumbnail__image">
                                            <p class="event-thumbnail__title">Title of Event Happening</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
        
                    <section class="events">
                        <div class="container">
                            <div class="events__tabs-wrapper">
                                <a class="view-all" href="#_">View All</a>
                                <div class="nav nav-tabs" role="tablist">
                                    <a href="#theater" class="events__heading nav-item nav-link active" id="nav-theater" data-toggle="tab" role="tab" aria-controls="theater" aria-selected="true"><h2>THEATER</h2></a>
                                    <a href="#dance" class="events__heading nav-item nav-link" id="nav-dance" data-toggle="tab" role="tab" aria-controls="dance" aria-selected="false"><h2>DANCE</h2></a>
                                </div>
                            </div>
                            <hr />
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="theater" role="tabpanel" aria-labelledby="theater-tab">
                                    <div class="event-slider-secondary">
                                        <div class="event-thumbnail__event">
                                            <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-1.png" alt="event image" class="event-thumbnail__image">
                                            <p class="event-thumbnail__title">Title of Event Happening</p>
                                        </div>
                                        <div class="event-thumbnail__event">
                                            <div class="event-thumbnail__date"><span class="ongoing">ONGOING</span></div>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-2.png" alt="event image" class="event-thumbnail__image">
                                            <p class="event-thumbnail__title">Title of Event Happening</p>
                                        </div>
                                        <div class="event-thumbnail__event">
                                            <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">20-07</span> <span class="month month--end">JUL</span></div>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-3.png" alt="event image" class="event-thumbnail__image">
                                            <p class="event-thumbnail__title">Title of Event Happening</p>
                                        </div>
                                        <div class="event-thumbnail__event">
                                            <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-4.png" alt="event image" class="event-thumbnail__image">
                                            <p class="event-thumbnail__title">Title of Event Happening</p>
                                        </div>
                                        <div class="event-thumbnail__event">
                                            <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-4.png" alt="event image" class="event-thumbnail__image">
                                            <p class="event-thumbnail__title">Title of Event Happening</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="dance" role="tabpanel" aria-labelledby="dance-tab">
                                    <div class="event-slider-secondary">
                                        <div class="event-thumbnail__event">
                                            <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-1.png" alt="event image" class="event-thumbnail__image">
                                            <p class="event-thumbnail__title">Title of Event Happening</p>
                                        </div>
                                        <div class="event-thumbnail__event">
                                            <div class="event-thumbnail__date"><span class="ongoing">ONGOING</span></div>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-2.png" alt="event image" class="event-thumbnail__image">
                                            <p class="event-thumbnail__title">Title of Event Happening</p>
                                        </div>
                                        <div class="event-thumbnail__event">
                                            <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">20-07</span> <span class="month month--end">JUL</span></div>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-3.png" alt="event image" class="event-thumbnail__image">
                                            <p class="event-thumbnail__title">Title of Event Happening</p>
                                        </div>
                                        <div class="event-thumbnail__event">
                                            <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-4.png" alt="event image" class="event-thumbnail__image">
                                            <p class="event-thumbnail__title">Title of Event Happening</p>
                                        </div>
                                        <div class="event-thumbnail__event">
                                            <div class="event-thumbnail__date"><span class="month month--start">JUN</span> <span class="day">28</span></div>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/event-image-4.png" alt="event image" class="event-thumbnail__image">
                                            <p class="event-thumbnail__title">Title of Event Happening</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
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
            <li class="nav-item"><a href="#social-display__facebook" class="nav-link" data-toggle="tab" role="tab"><i class="icon fab fa-facebook-square"></i></a></li>
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
            <div class="col-sm-4"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/partner-1.png" alt="" class="img-fluid"></div>
            <div class="col-sm-4"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/partner-2.png" alt="" class="img-fluid"></div>
            <div class="col-sm-4"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/partner-3.png" alt="" class="img-fluid"></div>
            <div class="col-sm-4"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/partner-4.png" alt="" class="img-fluid"></div>
            <div class="col-sm-4"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/partner-5.png" alt="" class="img-fluid"></div>
        </div>
    </div>
</section>

<?php get_footer(); ?>