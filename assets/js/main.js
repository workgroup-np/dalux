jQuery(document).ready(function(){
    "use strict";

/* ==================================================================
                    Minified Header
================================================================== */
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 1) {
            $('.trd-header').addClass('minified');
        } else {
            $('.trd-header').removeClass('minified');
        }
    });

/* ==================================================================
                    Responsive Menu (Mobile)
================================================================== */
    $(".navbar-collapse").css({ 
        maxHeight: $(window).height() - $(".navbar-header").height() + "px" 
    });
    
    $(".tbeer-header-search-btn").on('click', function(event) {
        event.preventDefault();
        /* Act on the event */
        $(".tbeer-search-form-wrapper").animate({width: 'toggle'}).focus()
    });

/* ==================================================================
                    Same Height
================================================================== */
var mapWrapper = $('.trd-map-wrapper'),
    mapNextHeight = mapWrapper.next().outerHeight();

    $(window).resize(function() {
        if ($(this).width() < 768) {

           var sectionHeight = $(window).height() - 80;

            mapWrapper.css({
                height: sectionHeight,
            });
        } else {
            mapWrapper.css({
                height: mapNextHeight
            });
        }
    });
    
    $(window).trigger('resize');


/* ==================================================================
                    Isotope
================================================================== */
var $featuredPostContainer = $('.tbeer-featured-news-wrapper');

$featuredPostContainer.imagesLoaded(function(){
    $featuredPostContainer.isotope({
        itemSelector : '.tbeer-featured-news',
        masonry: {
        columnWidth: 1,
      }
    });
});





if ($(window).width() > 1600) {

    var $navMenu = $('.tbeer-menu-wrapper'),
    $lHWidth = $('.navbar-header').width() + 81,

    pL = (($(window).width() - 1370 ) / 2) - $lHWidth;

    $navMenu.css({
        paddingLeft: pL,
        // property2: 'value2'
    });
}


});