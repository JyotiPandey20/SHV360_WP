jQuery(document).ready(function($) {
	
//   =============================== Script Page =============================================================//
	function myFunction() {
    timeout = setTimeout(alertFunc, 1000);
}

function alertFunc() {
    $(".prealoader").fadeOut("slow");
}

$( ".theme-switcher" ).draggable();


// ----------- Dark & Light Theme Switcher -----------//
function Theme() {
    if ($(document).has(".theme-menu")) {
        //CHECK WHEN RELOAD PERFORM
        if (performance.type == performance.TYPE_RELOAD) {
            if (localStorage.getItem('theme_mode') == '' || localStorage.getItem('theme_mode') == null || localStorage.getItem('theme_mode') == undefined) {} else {
                $(":root").attr("class", localStorage.getItem('theme_mode'));
            }
            if (localStorage.getItem('active_theme_mod') == '' || localStorage.getItem('active_theme_mod') == null || localStorage.getItem('active_theme_mod') == undefined || localStorage.getItem('active_theme_mod') == 'light-theme') {
                $("input#dark-theme").removeClass("active");
            } else {
                $("input#dark-theme").addClass("active");
            }
            // LOGO {
            // if (localStorage.getItem('active_theme_mod') == 'light-theme') {
                // var url = window.location.pathname,
                    // urlRegExp = new RegExp(url.replace(/\/$/, '') + "$");
                // var lastPart = url.split("/").pop();
                // if (lastPart == 'index2.html') {
                    // $(".logo a img").attr("src", "https://xolotheme.com/pro/erapress/wp-content/uploads/2023/08/logo-light.png");
                // } else {
                    // $(".logo a img").attr("src", "https://xolotheme.com/pro/erapress/wp-content/uploads/2023/08/logo-dark.png");
                // }
            // } else {
                // $(".logo a img").attr("src", "https://xolotheme.com/pro/erapress/wp-content/uploads/2023/08/logo-light.png");
            // }
        }
        $(".theme-switcher input[type='radio']").click(function() {
            var mode = $(this).attr("id");
            // var logoTheme = $(".logo a img");
            var active_theme_mod;
            if (mode == "dark-theme") {
                $(this).addClass("active");
                active_theme_mod = "dark-theme";
                // logoTheme.attr("src", "https://xolotheme.com/pro/erapress/wp-content/uploads/2023/08/logo-light.png");
            } else {
                $("input#dark-theme").removeClass("active");
                active_theme_mod = "light-theme";
                // var url = window.location.pathname,
                    // urlRegExp = new RegExp(url.replace(/\/$/, '') + "$");
                // var lastPart = url.split("/").pop();
                // if (lastPart == 'home-2') {
                    // logoTheme.attr("src", "https://xolotheme.com/pro/erapress/wp-content/uploads/2023/08/logo-light.png");
                // } else {
                    // logoTheme.attr("src", "https://xolotheme.com/pro/erapress/wp-content/uploads/2023/08/logo-dark.png");
			// }
            }
            $(":root").removeClass("dark-theme light-theme");
            $(":root").addClass(mode);
            var theme_mode = $("html").attr("class");
            localStorage.setItem("theme_mode", theme_mode);
            localStorage.setItem("active_theme_mod", active_theme_mod);
        });
        // Logo Theme
        var logoTheme = $(".logo a img").attr("src");
        localStorage.setItem("logoTheme", logoTheme);
    }
}
// ----------- Dark & Light Theme Switcher -----------//

// ======================== mobile menu toggle =================== //
$(function(){
    if ($(document).has(".mob-menu")) {
        //Menu Open Toggle btn
        $('.menu-toggle').click(function() {
            $('.menu-bar').slideDown(500).addClass('active');
        });

        //Menu close Btn 
		$('.header-close-menu').click(function() {
			$('.menu-bar').slideUp(500).removeClass('active');
			$(".menu-toggle").focus();
		}); 
    }
}); 

// ============================= End ===========================>

// ===================== Sticky Header =========================
function sticky_header() {
    if ($(document).has(".is-sticky-on")) {
        if ($(".is-sticky-on").length > 0) {
            $(window).on('scroll', function() {
                if ($(window).scrollTop() >= 400) {
                    $('.is-sticky-on').addClass('is-sticky-menu');
                } else {
                    $('.is-sticky-on').removeClass('is-sticky-menu');
                }
            });
        }
    }
}
// ==================== End ==================================>

// ==================== Mobile Menu  ==================================>
function mobile_menu() {
    if ($(document).has(".mob-menu")) {
        $(".mob-menu .mobile-toggler").on("click", function(e) {
            e.preventDefault();
            $(this).next().slideToggle();

        });
        $(".mobile-toggler").on("click", function(e) {
            e.preventDefault();
            $(this).parent().toggleClass("current");
        });
    }
}
// ================== End ====================>

// ==================== Search Popup Close =========================>
function header_search() {
    if ($(document).has(".header-search-active")) {
        $(document).on('keyup', function(e) {
            if (e.keyCode == 27) {
                // $mob_menu.removeClass("header-menu-active");
                // $mob_menu.removeClass("overlay-enabled");
                $(".header-search-popup").removeClass('header-search-active');
            }
        });

        // Header Search Toggle
        $(document).on('click', '.header-search-toggle', function(e) {
            $("body").addClass('header-search-active');
            $("body").addClass("overlay-enabled");
        });

        $(document).on('click', '.header-search-close', function(e) {
            $("body").removeClass('header-search-active');
            $("body").removeClass("overlay-enabled");
            return this;
        });
    }
}
// ======================== End ================================== //


// ======================= Header Info ======================//
function contactInfo() {
    var contactInfo = function(elem) {
        elem.fadeIn();
        let tabbable = elem.find('select, input, textarea, button, a,button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])').filter(':visible');
        let firstTabbable = tabbable.first();
        let lastTabbable = tabbable.last();
        //set focus on first input/
        $(".headtop-mobi a").focus();
        //redirect last tab to first input/
        lastTabbable.on('keydown', function(e) {
            if ((e.which === 9 && !e.shiftKey)) {
                e.preventDefault();
                firstTabbable.focus();
            }
        });
        //redirect first shift+tab to last input/
        firstTabbable.on('keydown', function(e) {
            if ((e.which === 9 && e.shiftKey)) {
                e.preventDefault();
                lastTabbable.focus();
            }
        });
        $(document).on("keydown", function(e) {
            if (e.which === 27) {
                $('.mobi-head-top').fadeOut();
                $(".headtop-mobi a").focus();
            }
        })

        $(".mobi-head-top").click(function() {
            $('.mobi-head-top').fadeOut();
            $(".headtop-mobi a").focus();
            // $(".menu-toggle").focus();
        });
    };
    // $(document).on('click', '.headtop-mobi a', function(e) {
    // contactInfo($('.mobi-head-top'));
    // });
}
// =================== End ======================//
// =================== Team =================================>
function set_team() {
    const team_width = $(".team-box .team_img_box").width();
    $(":root").css("--width", team_width + "px");

    // On Resize Window
    $(window).resize(function() {
        set_team();
    });
}
// ====================== End =========================>

// ========================== Pricing Filter ===============================> 
function pricing_filter() {

    var $filter = $('.filter');
    var $tab = $('.filter a');
    var $offers = $('.boxGroup .box');


    $filter.on('click touch', '.month', function(e) {
        e.preventDefault();
        $tab.removeClass('current');
        $(this).addClass('current');
        $('.pricing-filter-badge').slideUp();

        // $offers.show();
        $offers.hide();
        $offers.filter('.month').fadeIn(1000);

    });

    $filter.on('click touch', '.year', function(e) {
        e.preventDefault();
        $tab.removeClass('current');
        $(this).addClass('current');


        // $offers.show();
        $offers.hide();

        $offers.filter('.year').fadeIn(1000);
    });
}
// ========================== End ==============================>

// ======================= Back to Top Buttton Script ===================== //
function backtotop() {
    if ($(document).has("#return-to-top")) {
        $(window).scroll(function() {
            if ($(this).scrollTop() >= 50) { // If page is scrolled more than 50px
                $('#return-to-top').fadeIn(200); // Fade in the arrow
            } else {
                $('#return-to-top').fadeOut(200); // Else fade out the arrow
            }
        });
        $('#return-to-top').click(function() { // When arrow is clicked
            $('body,html').animate({
                scrollTop: 0 // Scroll to top of body
            }, 500);
        });
        $(document).on('click', '.header-search-toggle', function(e) {
            $("body").addClass('header-search-active');
            $("body").addClass("overlay-enabled");
            searchTrap($('.header-search-popup'));

        });
    }
}
//  ================== END =====================>

// ======================== Search TRAP ====================================>
function searchTrap() {
    var searchtrap = function(elem) {
        elem.fadeIn();
        let tabbable = elem.find('select, input, textarea, button, a,button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])').filter(':visible');
        let firstTabbable = tabbable.first();
        let lastTabbable = tabbable.last();
        //set focus on first input/
        $(".header-search-field").focus();
        //redirect last tab to first input/
        lastTabbable.on('keydown', function(e) {
            if ((e.which === 9 && !e.shiftKey)) {
                e.preventDefault();
                firstTabbable.focus();
            }
        });
        //redirect first shift+tab to last input/
        firstTabbable.on('keydown', function(e) {
            if ((e.which === 9 && e.shiftKey)) {
                e.preventDefault();
                lastTabbable.focus();
            }
        });

        $(".header-search-close").click(function() {
            $('.header-search-popup').fadeOut();
            $(".header-search-toggle").focus();
        });
    };
    $(document).on('click', '.header-search-toggle', function(e) {
        searchtrap($('.header-search-popup'));
    });
}
// =============================== End =====================================>

// ============================= Portfolio Section Filter Menu ========================= //
function portfolio_filter() {
    $(".filter-button ").click(function() {
        var value = $(this).attr('data-filter');

        if (value == "all ") {

            $('.filter').show('1000');
        } else {

            $(".filter ").not('.' + value).hide('3000');
            $('.filter').filter('.' + value).show('3000');

        }
    });

    if ($(".filter-button ").removeClass("")) {
        $(this).removeClass("active ");
    }
    $(this).addClass("active ");
}
// =================================== End =================================>

// =============================== Product_Single Filter ======================= //
function product_single() {
    $(".wc-tabs li").click(function(e) {
        e.preventDefault();
        $(this).parent().siblings().hide();
        var get_id = $(this).attr("id");
        $(this).parent().siblings().filter(`[aria-labelledby*=${get_id}]`).show();
    });

    // Change The Image of Product
    $(".storely_magnifier_gallery .owl-item a").click(function(e) {
        e.preventDefault();
        const thisimg = $(this).attr("href");
        $(".woocommerce-product-gallery__wrapper > div").attr("data-thumb", thisimg);
        $(".woocommerce-product-gallery__wrapper a").attr("href", thisimg);
        $(".woocommerce-product-gallery__wrapper a > img").attr("src", thisimg);
    });

    // Change the Tab For Review 
    $(".wc-tabs li").click(function() {
        $(".wc-tabs li").removeClass("active");
        $(this).addClass("active");

    });

}
// ================================ End =============================>

function header_info() {
    if ($(document).has(".headtop-mobi")) {
        $(".headtop-mobi").on("click", function(e) {
            e.preventDefault();
            $(this).parent().toggleClass("current");
            $(this).next().slideToggle();
        });
    }
}

// ============================ Counter Section Dynamic Count Script ================== //
function counter_up() {
    if ($(document).has(".counter")) {
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    }
}
// ============================ End ===============================> 

// ===================================== Calling Wow.js  =============================//
function wow_js() {
    wow = new WOW({
        boxClass: 'wow', // default
        animateClass: 'animated', // change this if you are not using animate.css
        offset: 0, // default
        mobile: true, // keep it on mobile
        live: true // track if element updates
    });
}
// =================================== End ============================ //

// ================================== Mobile menu  Trap ================================>
function mobileTrap() {
    var mobileTrap = function(elem) {
            $('.menu-bar').fadeIn();
            let tabbable = elem.find('select, input, textarea, button, a,button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])').filter(':visible');
            let firstTabbable = tabbable.first();
            let lastTabbable = tabbable.last();
            //set focus on first input/
            $(".menu-bar .header-close-menu").focus();
            //redirect last tab to first input/
            lastTabbable.on('keydown', function(e) {
                if ((e.which === 9 && !e.shiftKey)) {
                    e.preventDefault();
                    firstTabbable.focus();
                }
            });
            //redirect first shift+tab to last input/
            firstTabbable.on('keydown', function(e) {
                if ((e.which === 9 && e.shiftKey)) {
                    e.preventDefault();
                    lastTabbable.focus();
                }
            });

        }
        // ======================================== End =========================================>

    //   =============================== Mobile Menu =====================>

    /*  $(".mob-menu .closebtn").click(function() {
         $('.mob-menu').fadeOut();
         $(".menu-toggle").focus();
	}); */
     $(document).on('click', '.menu-toggle', function(e) {
         mobileTrap($('.menu-bar'));
     }); 
}
// ===================================== End ================================>

// ================================ Docker Trap ===============================>
function sidenav() {
    var sideNav = function(elem) {
        elem.fadeIn();
        let tabbable = elem.find('select, input, textarea, button, a,button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])').filter(':visible');
        let firstTabbable = tabbable.first();
        let lastTabbable = tabbable.last();
        //set focus on first input/
        $(".sidenav .closebtn").focus();
        //redirect last tab to first input/
        lastTabbable.on('keydown', function(e) {
            if ((e.which === 9 && !e.shiftKey)) {
                e.preventDefault();
                firstTabbable.focus();
            }
        });
        //redirect first shift+tab to last input/
        firstTabbable.on('keydown', function(e) {
            if ((e.which === 9 && e.shiftKey)) {
                e.preventDefault();
                lastTabbable.focus();
            }
        });

        $(".sidenav .closebtn").click(function() {
            $('.sidenav').fadeOut();
            $(".th").focus();
        });
    };
    $(document).on('click', '.th', function(e) {
        sideNav($('.sidenav'));
    });
}
// ========================== End ================================>

// =============  Open & Close Sidenav (Docker) =====================>
function openNav() {
    document.querySelector(".sidenav").style.right = "0px";
    $('.top-navigation .overlay').css('left', '0');
}

function closeNav() {
    document.querySelector(".sidenav").style.right = "-42%";
    $('.top-navigation .overlay').css('left', '100%');
}
//=============== End ===================>

// =========== Blog Masonry Script =====================//
function masonry() {
    if ($(document).has(".js-masonry")) {
        $(document).on(function(e) {
            var $grid = $('.js-masonry').imagesLoaded(function() {
                $grid.masonry({
                    itemSelector: '.js-masonry-item',
                    percentPosition: true
                });
            });
        });
    }
}
//==================== End ===================//

// ================== water ripple animation ===========================>
function breadcrumb() {
    if ($(document).has(".breadcrumb-area")) {
        $(".breadcrumb-area").ripples({
            resolution: 512,
            dropRadius: 20,
            // interactive: true,
            perturbance: 0.04,
        });
    }
}
// ===================== End ==========================>

// ===================== Faq 2 ==========================>
function filter_tab() {
    $(".tab-filter a").click(function() {
        var value = $(this).attr('data-filter');

        if (value == "all ") {

            $('.filter').show('1000');
        } else {

            $(".filter ").not('.' + value).hide('3000');
            $('.filter').filter('.' + value).show('3000');

        }
    });

    if ($(".tab-filter a").removeClass("")) {
        $(this).removeClass("active ");
    }
    $(this).addClass("active ");

}
//  ============= End =====================>

//  ====== contact office address hover active =============>
function active_element() {

    $(".contents").on({
        "focus mouseenter": function() {
            $(".contents").removeClass("active");
            $(this).addClass("active");
        }
    });


    //   pricing active hover
    /*  $(".pricingTable10").on({
         "focus mouseenter": function() {
             $(".pricingTable10").removeClass("active");
             $(this).addClass("active");
         }
     }); */


    // Info Section Home page 01
    $(".info-inner").on({
        "focus mouseenter": function() {
            $(".info-inner").removeClass("active");
            $(this).addClass("active");
        }
    });

    // Service Section Home Page 01
    $(".service-box").on({
        "focus mouseenter": function() {
            $(".service-box").removeClass("active");
            $(this).addClass("active");
        }
    });

    // Features Section Home Page 01
    $(".card").on({
        "focus mouseenter": function() {
            $(".card").removeClass("active");
            $(this).addClass("active");
        }
    });
    // Blog Section Home Page 01
    $(".post-items").on({
        "focus mouseenter": function() {
            $(".post-items").removeClass("active");
            $(this).addClass("active");
        }
    });

}
// ============== End ======================>

// ==================================== Cursor Follow =======================//
function cursor_follow() {
    var cursor = $(".cursor-follow");
    $('body')
        .mousemove(function(e) {
            cursor
                .css({
                    top: e.pageY - cursor.height() / 2,
                    left: e.pageX - cursor.width() / 2
                })
                .removeClass("cursor-center");
            cursor.show();
        })
        .mouseleave(function() {
            cursor.hide();
        });
}
// ============== End ==================>

// ================= Dark/Light Theme Mode ===============>
function theme_toggle() {
    $(window).scroll(function() {
        panel_check();
    });
}

panel_check();

function panel_check() {
	if ($(this).scrollTop() >= 300) {
		$('.theme-menu').slideDown(600).show();
	} else {
		$('.theme-menu').slideUp(600);
	}
}
// ============== End ===================>

// ======================== About Section Circle Progress Bar =======================>
function radial_animate() {
    $('svg.radial-progress').each(function(index, value) {

        $(this).find($('circle.bar--animated')).removeAttr('style');
        // Get element in Veiw port
        var elementTop = $(this).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();

        if (elementBottom > viewportTop && elementTop < viewportBottom) {
            var percent = $(value).data('countervalue');
            var radius = $(this).find($('circle.bar--animated')).attr('r');
            var circumference = 2 * Math.PI * radius;
            var strokeDashOffset = circumference - ((percent * circumference) / 100);
            $(this).find($('circle.bar--animated')).animate({ 'stroke-dashoffset': strokeDashOffset }, 2800);
        }
    });
}
// ================ About Section Circle Progress Bar =================>
function Circle_progress() {
    var $window = $(window);

    function check_if_in_view() {
        $('.countervalue').each(function() {
            if ($(this).hasClass('start')) {
                var elementTop = $(this).offset().top;
                var elementBottom = elementTop + $(this).outerHeight();

                var viewportTop = $(window).scrollTop();
                var viewportBottom = viewportTop + $(window).height();

                if (elementBottom > viewportTop && elementTop < viewportBottom) {
                    $(this).removeClass('start');
                    $('.countervalue').text();
                    var myNumbers = $(this).text();
                    if (myNumbers == Math.floor(myNumbers)) {
                        $(this).animate({
                            Counter: $(this).text()
                        }, {
                            duration: 2800,
                            easing: 'swing',
                            step: function(now) {
                                $(this).text(Math.ceil(now) + '%');
                            }
                        });
                    } else {
                        $(this).animate({
                            Counter: $(this).text()
                        }, {
                            duration: 2800,
                            easing: 'swing',
                            step: function(now) {
                                $(this).text(now.toFixed(2) + '$');
                            }
                        });
                    }

                    radial_animate();
                }
            }
        });
    }

    $window.on('scroll', check_if_in_view);
    $window.on('load', check_if_in_view);
}
// ============================== End ===============================>

// ========== Filter Tab Menu Active Script ==============>
function filter_tab_menu() {
    var selector = '.filter-menu .btn';
    $(selector).on('click', function() {

        $(selector).removeClass('active');
        $(this).addClass('active');

    });

    var selector_1 = '.tab-filter a';
    $(selector_1).on('click', function() {

        $(selector_1).removeClass('active');
        $(this).addClass('active');

    });
}
// ============== End ==================>

//===================== Hide & Show Password ======================= /// 
function password() {
    $('.show-password-input').on('click', function() {
        var passInput = $("#password");
        if (passInput.attr('type') === 'password') {
            passInput.attr('type', 'text');
        } else {
            passInput.attr('type', 'password');
        }
    });
}
// ==================================== End ========================>

function activeMenu() {
    var url = window.location.pathname,
        urlRegExp = new RegExp(url.replace(/\/$/, '') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
    // now grab every link from the navigation
    $('.navbar .menu-item a').each(function() {
        // alert(url);
        // and test its normalized href against the url pathname regexp
        if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
            $(this).addClass('active');
        }
    });
}

function urlpart() {
    var url = window.location.pathname,
        urlRegExp = new RegExp(url.replace(/\/$/, '') + "$");;
    var parts = url.split("/");
    var last_part = parts[parts.length - 2];
    if (last_part == 'home-2') {
        jQuery('body').addClass('homepage2');
    } else if (last_part == 'home-3') {
        jQuery('body').addClass('homepage3');
    }
}


// ================== Calling of All Functions ==================//


    Theme();
    // menu_toggle();
    urlpart();
    sticky_header();
    mobile_menu();
    header_search();
    set_team();
    pricing_filter();
    backtotop();
    searchTrap();
    portfolio_filter();
    product_single();
    header_info();
    counter_up();
    password();
    wow_js();
    mobileTrap();
    sidenav();
    masonry();
    breadcrumb();
    filter_tab();
    active_element();
    cursor_follow();
    theme_toggle();
    radial_animate();
    Circle_progress();
    filter_tab_menu();
    contactInfo();
    activeMenu();
    myFunction();
    $(".list-item.th-box > a").click(function(){openNav();})
    $(".sidenav .closebtn").click(function(){closeNav();});
   
});

// ============== End ===================>