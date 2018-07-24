<?php get_header(); ?>

<?php 
    $venuesPerPage = get_field( 'venues_per_page' );
    $venues = tribe_get_venues( false, $venuesPerPage, true, array() );
    $excerptLength = 300;
    ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9 content-with-sidebar">
                <?php get_template_part( 'tp-share' ); ?>

                <ul class="grid-list nav nav-pills" role="tablist">
                    <li class="nav-item"><a href="#grid" class="nav-link active" data-toggle="pill" role="tab" aria-controls="grid" aria-selected="true"><i class="icon fas fa-th-large"></i></a></li>
                    <li class="nav-item"><a href="#list" class="nav-link" data-toggle="pill" role="tab" aria-controls="list" aria-selected="false"><i class="icon fas fa-bars"></i></a></li>
                </ul>

                <section class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid">
                        <div class="layout-grid">
                            <?php foreach( $venues as $venue ): ?>
                                <a class="layout-grid__item" href="<?php echo( home_url( $venue->post_name ) ); ?>">
                                    <div class="layout-grid__desc">
                                        <p class="layout-grid__name"><strong><?php echo $venue->post_title; ?></strong></p>
                                        <p><?php echo mb_strimwidth( $venue->post_content, 0, $excerptLength, '...' ); ?></p>
                                    </div>
                                    <div class="layout-grid__logo">
                                        <img src="<?php echo get_the_post_thumbnail_url( $venue ); ?>" />
                                        <div>
                                            <p><strong><?php echo $venue->post_title; ?></strong></p>
                                            <p><?php 
                                                $tags = wp_get_post_tags( $venue->ID ); 
                                                foreach( $tags as $key => $tag ){
                                                    echo $tag->name;
                                                    if( $key != count( $tags ) - 1 )
                                                        echo ', ';
                                                }
                                            ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list">
                        <?php foreach( $venues as $venue ): ?>
                            <a class="layout-list__item" href="<?php echo( home_url( $venue->post_name ) ); ?>">
                                <div class="layout-list__img">
                                    <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url( $venue ); ?>" alt="organization logo">
                                </div>
                                <div class="layout-list__info">
                                    <div class="layout-list__name-tags">
                                        <p class="layout-list__name"><strong><?php echo $venue->post_title; ?></strong></p>
                                        <p><?php 
                                            $tags = wp_get_post_tags( $venue->ID ); 
                                            foreach( $tags as $key => $tag ){
                                                echo $tag->name;
                                                if( $key != count( $tags ) - 1 )
                                                    echo ', ';
                                            }
                                        ?></p>
                                    </div>
                                    <p class="layout-list__desc"><?php echo mb_strimwidth( $venue->post_content, 0, $excerptLength, '...' ); ?></p>
                                </div>
                            </a>
                            
                            <hr class="hr--light" />
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>