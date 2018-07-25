<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width initial-scale=1.0" name="viewport">
    <meta content="The Childress Agency" name="author">
    <meta content="public" http-equiv="cache-control">
    <meta content="private" http-equiv="cache-control">
    
    <title>Fredericksburg Arts</title>

    <?php wp_head(); ?>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'></script>
    <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
    <![endif]-->
    <!--[if gte IE 9]
    <style type='text/css'>
    footer {
    filter: none;
    }
    </style>
    <![endif]-->
</head>
<body>
    <header <?php if(is_front_page()): echo 'class="header--home"'; endif;?>>
        <div class="header__main">
            <div class="header__rapparts">
                <div class="brand">
                    <a href="<?php echo( home_url() ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt="logo" class="brand__logo"></a>
                    <p class="brand__text">Your guide to Arts &amp; Culture in the Central Rappahannock River Region</p>
                </div>
                <div class="separator--header"></div>
                <ul class="member-links">
                    <?php 
                        $menuLocations = get_nav_menu_locations();
                        $menuID = $menuLocations['member-navbar'];
                        $memberNav = wp_get_nav_menu_items( $menuID );

                        foreach( $memberNav as $key => $navItem ):
                        ?>
                            <li class="member-links__item"><a href="<?php echo $navItem->url; ?>"><?php echo $navItem->title; ?></a></li>
                        <?php endforeach; ?>
                    <!-- <li class="member-links__item"><a href="#_">LOG IN</a></li>
                    <li class="member-links__item"><a href="#_">REGISTER</a></li> -->
                </ul>
            </div>
            <div class="header__accr">
                <p>An initiative of:</p>
                <a href="<?php echo get_field( 'about_accr', 'option' ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-accr.png" alt="accr logo"></a>
                <div>
                    <a href="<?php the_field( 'twitter', 'option' ); ?>"><i class="icon fab fa-twitter"></i></a>
                    <a href="<?php the_field( 'facebook', 'option' ); ?>"><i class="icon fab fa-facebook-square"></i></a>
                    <a href="<?php the_field( 'instagram', 'option' ); ?>"><i class="icon fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <!-- <nav class="nav--header">
            <div class="nav--header__sides"></div>
            <div class="text-center">
                <ul>
                    <li class="nav__item">
                        <a href="#_">VISUAL ARTS</a>
                        <ul class="submenu invisible">
                            <div class="submenu__column">
                                <li class="submenu__item"><a href="#_">CERAMICS/POTTERY</a></li>
                                <li class="submenu__item"><a href="#_">DIGITAL</a></li>
                                <li class="submenu__item"><a href="#_">DRAWING</a></li>
                                <li class="submenu__item"><a href="#_">FASHION</a></li>
                                <li class="submenu__item"><a href="#_">GLASS</a></li>
                                <li class="submenu__item"><a href="#_">GRAPHIC DESIGN</a></li>
                            </div>
                            <div class="submenu__column">
                                <li class="submenu__item"><a href="#_">JEWELRY</a></li>
                                <li class="submenu__item"><a href="#_">MIXED MEDIA</a></li>
                                <li class="submenu__item"><a href="#_">MURAL</a></li>
                                <li class="submenu__item"><a href="#_">PAINTING</a></li>
                                <li class="submenu__item"><a href="#_">PHOTOGRAPH</a></li>
                                <li class="submenu__item"><a href="#_">SCULPTURE</a></li>
                            </div>
                        </ul>
                    </li>
                    <li class="nav__item"><a href="#_">MUSIC</a></li>
                    <li class="nav__item"><a href="#_">THEATER</a></li>
                    <li class="nav__item"><a href="#_">DANCE</a></li>
                    <li class="nav__item"><a href="#_">FILM</a></li>
                    <li class="nav__item"><a href="#_">LITERARY</a></li>
                    <li class="nav__item"><a href="#_">LECTURES</a></li>
                    <li class="nav__item"><a href="#_">FESTIVALS</a></li>
                    <li class="nav__item"><a href="#_">GALA/FUND RAISERS</a></li>
                    <li class="nav__item nav__accent"><a href="#_">DONATE</a></li>
                </ul>
            </div>
            <div class="nav--header__sides"></div>
        </nav> -->

        <nav class="nav--header navbar navbar-expand-lg">
            <div class="nav--header__sides"></div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerNav" aria-controls="headerNav" aria-expanded="false" aria-label="Toggle navigation">
                <!-- <span class="navbar-toggler-icon"></span> -->
                <i class="icon fas fa-bars"></i>
            </button>

            <div class="text-center collapse navbar-collapse" id="headerNav">
                <ul class="navbar-nav">
                <?php 
                    $menuLocations = get_nav_menu_locations();
                    $menuID = $menuLocations['header-navbar'];
                    $primaryNav = wp_get_nav_menu_items( $menuID );

                    foreach( $primaryNav as $key => $navItem ):
                    ?>
                        <li class="nav__item nav-item"><a class="nav-link" href="<?php echo $navItem->url; ?>"><?php echo $navItem->title; ?></a></li>
                    <?php endforeach; ?>
                    <li class="nav__item nav__accent"><a href="<?php echo get_field( 'donate_link', 'option' ); ?>">Donate</a></li>
                </ul>
            </div>
            <div class="nav--header__sides"></div>
        </nav>


        <?php if(is_front_page()): ?>
        <div class="carousel slide" id="header-carousel" data-ride="carousel">
            <div class="carousel-inner">
                <?php if( have_rows( 'header_slider' ) ): $i=0; while( have_rows( 'header_slider' ) ): the_row(); ?>
                    <div class="carousel-item <?php if( $i==0 ){ echo 'active'; } ?>">
                        <div class="carousel__caption">
                            <h1 class="carousel__heading"><?php the_sub_field( 'title' ); ?></h1>
                            <h2 class="carousel__subheading"><?php the_sub_field( 'dates' ); ?></h2>
                            <div class="carousel__btns">
                                <?php if( get_sub_field( 'tickets_link' ) ): ?><a href="<?php the_sub_field( 'tickets_link' ); ?>" class="btn btn-header-carousel btn-secondary">GET TICKETS</a><?php endif; ?>
                                <!-- <?php if( get_sub_field( 'add_it_link' ) ): ?><a href="<?php the_sub_field( 'add_it_link' ); ?>" class="btn btn-header-carousel btn-white">ADD IT</a><?php endif; ?> -->
                                <?php if( get_sub_field( 'more_info_link' ) ): ?><a href="<?php the_sub_field( 'more_info_link' ); ?>" class="btn btn-header-carousel btn-primary">MORE INFO</a><?php endif; ?>
                            </div>
                        </div>
                        <div class="carousel__image" style="background-image: url( '<?php the_sub_field( 'image' ); ?>' );"></div>
                    </div>
                <?php $i++; endwhile; endif; ?>
            </div>

            <div class="carousel__arrows">
                <p><span class="carousel__counter" id="carousel-counter-current">2</span>/<span class="carousel__counter" id="carousel-counter-total">2</span></p>
                <a href="#header-carousel" class="carousel-control-prev" role="button" data-slide="prev"><</a>
                <a href="#header-carousel" class="carousel-control-next" role="button" data-slide="next">></a>
            </div>
        </div>
        <?php endif; ?>
    </header>

    <!-- <section class="search">
        <div class="container">
            <p class="search__text">Find an<br/><span>EVENT</span></p>
        </div>
    </section> -->