<?php
    $eventCat = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    $categoryName = $eventCat->name;
    ?>

<section class="breadcrumbs">
    <div class="container">
        <p>Home <strong>> <?php if( get_the_title()){ the_title(); } else{ echo $categoryName; } ?></strong></p>
    </div>
</section>