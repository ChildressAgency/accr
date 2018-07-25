<?php 
$entriesPerPage = get_field( 'entries_per_page' );
if( is_page( 'artists' ) ){
    $entries = tribe_get_organizers( false, -1, true, array( 'orderby' => 'title', 'order' => 'ASC' ) );
} else {
    $entries = tribe_get_venues( false, -1, true, array( 'orderby' => 'title', 'order' => 'ASC' ) );
}
$excerptLength = 200;
?>

<ul class="grid-list nav nav-pills" role="tablist">
    <li class="nav-item"><a href="#grid" class="nav-link active" data-toggle="pill" role="tab" aria-controls="grid" aria-selected="true"><i class="icon fas fa-th-large"></i></a></li>
    <li class="nav-item"><a href="#list" class="nav-link" data-toggle="pill" role="tab" aria-controls="list" aria-selected="false"><i class="icon fas fa-bars"></i></a></li>
</ul>

<section class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid">
        <div id="entry-carousel-grid" class="carousel slide no-autoplay" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="layout-grid">
                        <?php $i=0; foreach( $entries as $key => $entry ): ?>
                            <?php if( $key%$entriesPerPage == 0 && $key != 0 ): ?>
                                </div>
                                </div>
                                <div class="carousel-item">
                                <div class="layout-grid">
                            <?php endif; ?>
                            <a class="layout-grid__item" href="<?php echo( home_url( $entry->post_name ) ); ?>">
                                <div class="layout-grid__desc">
                                    <p class="layout-grid__name"><strong><?php echo $entry->post_title; ?></strong></p>
                                    <p><?php echo mb_strimwidth( $entry->post_content, 0, $excerptLength, '...' ); ?></p>
                                </div>
                                <div class="layout-grid__logo">
                                    <img src="<?php echo get_the_post_thumbnail_url( $entry ); ?>" />
                                    <div>
                                        <p><strong><?php echo $entry->post_title; ?></strong></p>
                                        <p><?php 
                                            $tags = wp_get_post_tags( $entry->ID ); 
                                            foreach( $tags as $key => $tag ){
                                                echo $tag->name;
                                                if( $key != count( $tags ) - 1 )
                                                    echo ', ';
                                            }
                                        ?></p>
                                    </div>
                                </div>
                            </a>
                        <?php $i++; endforeach; ?>
                    </div>
                </div>
                <div class="entry-carousel-grid-controls">
                    <a class="" href="#entry-carousel-grid" role="button" data-slide="prev">
                        <span class="grey-text" aria-hidden="true">Prev</span>
                        <span class="sr-only">Previous</span>
                    </a>

                    <a class="" href="#entry-carousel-grid" role="button" data-slide="next">
                        <span class="grey-text" aria-hidden="true">Next</span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list">
        <div id="entry-carousel-list" class="carousel slide  no-autoplay" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <?php foreach( $entries as $key => $entry ): ?>
                        <?php if( $key%$entriesPerPage == 0 && $key != 0 ): ?>
                            </div>
                            <div class="carousel-item">
                        <?php endif; ?>
                    
                        <a class="layout-list__item" href="<?php echo( home_url( $entry->post_name ) ); ?>">
                            <div class="layout-list__img">
                                <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url( $entry ); ?>" alt="organization logo">
                            </div>
                            <div class="layout-list__info">
                                <div class="layout-list__name-tags">
                                    <p class="layout-list__name"><strong><?php echo $entry->post_title; ?></strong></p>
                                    <p><?php 
                                        $tags = wp_get_post_tags( $entry->ID ); 
                                        foreach( $tags as $key => $tag ){
                                            echo $tag->name;
                                            if( $key != count( $tags ) - 1 )
                                                echo ', ';
                                        }
                                    ?></p>
                                </div>
                                <p class="layout-list__desc"><?php echo mb_strimwidth( $entry->post_content, 0, $excerptLength, '...' ); ?></p>
                            </div>
                        </a>
                        
                        <hr class="hr--light" />
                    <?php endforeach; ?>
                </div>
                <div class="entry-carousel-list-controls">
                    <a class="" href="#entry-carousel-list" role="button" data-slide="prev">
                        <span class="grey-text" aria-hidden="true">Prev</span>
                        <span class="sr-only">Previous</span>
                    </a>

                    <a class="" href="#entry-carousel-list" role="button" data-slide="next">
                        <span class="grey-text" aria-hidden="true">Next</span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>