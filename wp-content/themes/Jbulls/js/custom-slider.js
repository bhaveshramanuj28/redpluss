jQuery(document).ready(function($) {
    $('.your-slider-class').slick({
        infinite: true,
        slidesToShow: 3, 
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: false,
        arrows: true,
        responsive: [
            {
                breakpoint: 1200, 
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 800, 
                settings: {
                    slidesToShow: 2, 
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 600, 
                settings: {
                    slidesToShow: 1, 
                    slidesToScroll: 1,
                }
            }
        ]
    });
});
