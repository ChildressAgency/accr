<?php get_header(); ?>

<?php
global $wp_query;
$args = array(
    'posts_per_page' => 10,
    'post_type' => 'tribe_venue',
    's' => $s
);
// $posts = get_posts( $args );
$posts = new WP_Query( $args );
// $posts = TribeEventsQuery::getEvents( array("venue" => 'Test', "eventDisplay" => "upcoming", "posts_per_page" => 10 ), true );
// $posts = tribe_get_venues( array( 'posts_per_page' => 10, 's' => 'Beer' ) );
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9 content-with-sidebar">
                <h2>Search Results for: <?php echo "$s"; ?></h2>

                <?php if( $posts->have_posts() ): ?>
                    <?php while( $posts->have_posts() ): $posts->the_post(); ?>
                    <?php //foreach( $posts as $post ): ?>
                        <a class="layout-list__item" href="<?php echo( home_url( $post->post_name ) ); ?>">
                            <?php if( get_the_post_thumbnail_url( $post ) ): ?>
                                <div class="layout-list__img">
                                    <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url( $post ); ?>" alt="">
                                </div>
                            <?php endif; ?>
                            <div class="layout-list__info">
                                <div class="layout-list__name-tags">
                                    <p class="layout-list__name"><strong><?php echo $post->post_title; ?></strong></p>
                                    <p><?php 
                                        $tags = wp_get_post_tags( $post->ID ); 
                                        foreach( $tags as $key => $tag ){
                                            echo $tag->name;
                                            if( $key != count( $tags ) - 1 )
                                                echo ', ';
                                        }
                                    ?></p>
                                </div>
                                <p class="layout-list__desc"><?php if( $post->post_excerpt ){ echo $post->post_excerpt; } else { echo mb_strimwidth( $post->post_content, 0, 200, '...' ); } ?></p>
                            </div>
                        </a>
                        
                        <hr class="hr--light" />
                    <?php //endforeach; ?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else: ?>
                    <p>No results</p>
                <?php endif; ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>