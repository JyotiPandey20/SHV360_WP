jQuery(document).ready(function($) {
	function home1() {
    $('.main-slider').owlCarousel({
        loop: true,
        margin: 10,
        items: 1,
        nav: true,
        autoplay: true,
        dots: true,
        animateOut: 'fadeOut'
    });
}

function office_address() {
    $('.office-carousel').owlCarousel({
        loop: true,
        nav: false,
        autoplay: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            320: {
                items: 1
            },
            575: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            }
        }
    });

}

function testimonial() {
    $('.testimonial-carousel').owlCarousel({
        loop: true,
        autoplay: true,
        margin: 10,
        nav: false,
        center: true,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            992: {
                items: 3
            }
        }
    });
}

function timeline() {
    $('.timeline-carousel').owlCarousel({
        loop: true,
        autoplay: false,
        margin: 24,
        items: 4,
        nav: true,
        center: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            450: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 3
            },
            1199: {
                items: 4
            }
        }
    });
}

function info() {
    $('.info-carousel').owlCarousel({
        loop: true,
        autoplay: true,
        margin: 24,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            450: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            },
            1199: {
                items: 5
            }
        }
    });
}

function home2() {
    $('.main-slider-2').owlCarousel({
        loop: true,
        margin: 10,
        items: 1,
        nav: true,
        dots: false,
        autoplay: true,

    });
}

function thumbnails() {
    $('.thumbnails-carousel').owlCarousel({
        loop: true,
        autoplay: false,
        margin: 24,
        items: 4,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 2
            },
            768: {
                items: 4
            },
            992: {
                items: 4
            }
        }
    });
}

// ================== Calling of All Functions ==================//
    home1();
    info();
    office_address();
    testimonial();
    timeline();
    home2();
    thumbnails();
});