$( document ).ready(function(){
    
    /*
     * HEADER CAROUSEL
     */
    var counterCurrent = $( '#carousel-counter-current' );
    var counterTotal = $( '#carousel-counter-total' );
    var totalSlides = $( '.carousel-item' ).length;
    var currentSlide = $( '.carousel-item.active' ).index() + 1;

    $(counterTotal).text(totalSlides);
    $(counterCurrent).text(currentSlide);

    $( '#header-carousel' ).bind( 'slid.bs.carousel', function(){
        var currentSlide = $( '.carousel-item.active' ).index() + 1;
        $(counterTotal).text(totalSlides);
        $(counterCurrent).text(currentSlide);
    });

    /*
     * HEADER NAVBAR SUBMENUS
     */
    $( '.nav__item--header' ).click( function(){
        var items = $( this ).find( '.submenu' );

        $( items ).toggleClass( 'visible invisible' );
    });

    $( '.nav__item--header' ).mouseover( function(){
        var items = $( this ).find( '.submenu' );

        $( items ).addClass( 'visible' );
        $( items ).removeClass( 'invisible' );
    }); 

    $( '.nav__item--header' ).mouseout( function(){
        var items = $( this ).find( '.submenu' );

        $( items ).addClass( 'invisible' );
        $( items ).removeClass( 'visible' );
    });

    /*
     * HIDE/SHOW NON-MEMBERS
     */
    $( '#show-all' ).click( function(){
        $( '.artist' ).css( 'display', 'flex' );
        $(this).addClass( 'section-tab__active' );
        $( '#show-members' ).removeClass( 'section-tab__active' );
    });
    $( '#show-members' ).click( function(){
        $( '.artist' ).css( 'display', 'none' );
        $( '.artist--member' ).css( 'display', 'flex' );
        $(this).addClass( 'section-tab__active' );
        $( '#show-all' ).removeClass( 'section-tab__active' );
    });


    /*
     * EVENT SLIDERS
     */
    $('.event-slider').slick({
        slidesToShow: 4,
        infinite: false,
        autoplay: false,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    $('.event-slider-secondary').slick({
        slidesToShow: 3,
        infinite: false,
        autoplay: false,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
});