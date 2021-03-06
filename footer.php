    <footer>
        <section class="partners text-center">
            <div class="container">
                <p class="partners__heading">We couldn't do this without the support of our great partners</p>

                <div class="row partners__row">
                    <?php if( have_rows( 'partners', 'options' ) ): while( have_rows( 'partners', 'options' ) ): the_row(); ?>
                        <?php $num_cols = get_sub_field('layout'); ?>
                        <div class="<?php echo $num_cols; ?>"><a href="<?php the_sub_field( 'link' ); ?>"><img src="<?php the_sub_field( 'image' ); ?>" alt="" class="img-fluid"></a></div>
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </section>

        <div class="footer__upper">
            <div class="footer__links">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <ul>
                                <?php 
                                    $menuLocations = get_nav_menu_locations();
                                    $menuID = $menuLocations['header-navbar'];
                                    $primaryNav = wp_get_nav_menu_items( $menuID );

                                    foreach( $primaryNav as $navItem ):
                                    ?>
                                        <li><strong><a href="<?php echo $navItem->url; ?>"><?php echo $navItem->title; ?></a></strong></li>
                                    <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php if( have_rows( 'link_group', 'option' ) ): while( have_rows( 'link_group', 'option' ) ): the_row(); ?>
                        <div class="col-12 col-sm-6 col-md-3">
                            <ul>
                                <?php if( have_rows( 'links' ) ): $i=0; while( have_rows( 'links' ) ): the_row(); ?>
                                <li><?php if($i==0){ echo '<strong>'; } ?><a href="<?php the_sub_field( 'url' ); ?>"><?php the_sub_field( 'title' ); ?></a><?php if($i==0){ echo '</strong>'; } ?></li>
                                <?php $i++; endwhile; endif; ?>
                            </ul>
                        </div>
                        <?php endwhile; endif; ?>
                        <!-- <div class="col-12 col-sm-6 col-md-3">
                            <ul>
                                <li><strong><a href="<?php echo( home_url( 'register' ) ); ?>">BECOME A MEMBER</a></strong></li>
                                <li><a href="#_">Organization</a></li>
                                <li><a href="#_">Venue</a></li>
                                <li><a href="#_">Artist</a></li>
                                <li><a href="<?php echo( home_url( 'opportunities' ) ); ?>">Opportunities</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <ul>
                                <li><strong><a href="#_">OVERVIEW</a></strong></li>
                                <li><a href="<?php echo( home_url( 'about-us' ) ); ?>">About Us</a></li>
                                <li><a href="#_">Calendar Partners</a></li>
                                <li><a href="#_">Privacy Policy</a></li>
                                <li><a href="#_">Terms of Use</a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="footer__contact text-center">
                <div>
                    <p><strong>CONTACT US</strong></p>
                    <p><a href="mailto:<?php the_field( 'email', 'option' ); ?>"><?php the_field( 'email', 'option' ); ?></a></p>
                    <p><a href="tel:<?php the_field( 'phone', 'option' ); ?>"><?php the_field( 'phone', 'option' ); ?></a></p>
                    
                    
                    <div class="footer__social">
                        <a href="<?php the_field( 'twitter', 'option' ); ?>"><i class="icon fab fa-twitter"></i></a>
                        <a href="<?php the_field( 'facebook', 'option' ); ?>"><i class="icon fab fa-facebook-square"></i></a>
                        <a href="<?php the_field( 'instagram', 'option' ); ?>"><i class="icon fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__lower">
            <div class="footer__mission">
                <div class="row">
                    <div class="footer__logo col-12 col-md-3">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-accr.png" alt="accr logo">
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="footer__mission-text">
                            <p><strong>THE ARTS & CULTURE COUNCIL OF THE RAPPAHANNOCK</strong></p>
                            <p>The mission of The Arts & Cultural Council of the Rappahannock is to advance the arts and cultural life of the central Rappahannock region by supporting and strengthening the region’s arts and cultural organizations, and its arts and cultural offerings, for the benefit of all its citizens.</p>
                            <p><strong>CONTACT US - </strong><a href="mailto:<?php the_field( 'email_accr', 'option' ); ?>"><?php the_field( 'email_accr', 'option' ); ?></a> &#8226; <a href="tel:<?php the_field( 'phone_accr', 'option' ); ?>"><?php the_field( 'phone_accr', 'option' ); ?></a></p>
                        </div>
                    </div>
                </div>
                <hr class="footer__hr" />
            </div>
            <p class="footer__copyright"><i>&copy; <?php echo date("Y"); ?> The Arts & Cultural Council of the Rappahannock<br/>Website designed by <a href="https://childressagency.com/">The Childress Agency</a></i></p>
        </div>
    </footer>
    
    <?php wp_footer(); ?> 
</body>
</html>