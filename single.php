<?php get_header(); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9 content-with-sidebar">
                <?php if(have_posts()): while(have_posts()): the_post(); ?>
                    <article>
                        <h2><?php the_title(); ?></h2>
                        <hr class="hr--light" />
                        <?php the_content(); ?>
                    </article>
                <?php endwhile; endif; ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>