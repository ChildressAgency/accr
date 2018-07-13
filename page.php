<?php get_header(); ?>

<?php get_template_part( 'tp-breadcrumbs' ); ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9 content-with-sidebar">
                <?php get_template_part( 'tp-share' ); ?>

                <?php if(have_posts()): while(have_posts()): the_post(); ?>
                    <article>
                        <?php the_content(); ?>
                    </article>
                <?php endwhile; endif; ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>