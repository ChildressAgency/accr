<?php if( have_rows( 'section' ) ): while( have_rows( 'section' ) ): the_row(); ?>
    <?php if( get_row_layout() == 'text' ): ?>
        <section class="section--about">
            <?php the_sub_field( 'text' ); ?>
        </section>
    <?php elseif( get_row_layout() == 'documents' ): ?>
        <section class="section--about about-documents">
            <?php if( have_rows( 'docs' ) ): while( have_rows( 'docs' ) ): the_row(); ?>
            <h2><a href="<?php the_sub_field( 'link' ); ?>"><i class="icon far fa-file"></i> <?php the_sub_field( 'title' ); ?></a></h2>
            <?php endwhile; endif; ?>
        </section>
    <?php endif; ?>
<?php endwhile; endif; ?>