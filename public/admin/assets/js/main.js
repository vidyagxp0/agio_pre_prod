/*-----------------------------------------------------------------------------------
    Template Name: Printco - Printing Company and Service Html Template
    Template URI: https://webtend.net/demo/html/printco/
    Author: WebTend
    Author URI:  https://webtend.net/
    Version: 1.0

    Note: This is Main JS File.
-----------------------------------------------------------------------------------
	CSS INDEX
	===================
    01. Navbar
    02. Menu Sidebar
    03. Project Slider
    04. Testimonial Slider
    05. Testimonial Two
    06. Testimonial Three
    07. What We Provide
    08. Product Two
    09. Realated Product
    10. Client Logo
    11. Blog Slider
    12. Team Slider
    13. Services Four
    14. Related Project
    15. Related News
    16. Fact Counter
    17. CountDown
    18. Search Popup
    19. Video PopUp
    20. Blog Active Item
    21. Skillbar
    22. Project Filtering
    23. Project Two Popup
    24. Circle Progress
    25. Nice Select
    26. Price Range Slider
    27. WOW Animation
    28. back to top
    29. sticky active
    30. preloader
    
-----------------------------------------------------------------------------------*/

; (function ($) {
    "use strict";

    $(document).ready(function () {

        /**-----------------------------
         * 01. Navbar fix
         * ---------------------------*/
        $(document).on('click', '.navbar-area .navbar-nav li.menu-item-has-children>a', function (e) {
            e.preventDefault();
        })
       
        /*-  menu -*/
        $('.navbar-area .menu').on('click', function() {
            $(this).toggleClass('open');
            $('.navbar-area .navbar-collapse').toggleClass('sopen');
        });
    
        // mobile menu
        if ($(window).width() < 992) {
            $(".in-mobile").clone().appendTo(".sidebar-inner");
            $(".in-mobile ul li.menu-item-has-children").append('<i class="fas fa-chevron-right"></i>');
            $('<i class="fas fa-chevron-right"></i>').insertAfter("");

            $(".menu-item-has-children a").on('click', function(e) {
                // e.preventDefault();

                $(this).siblings('.sub-menu').animate({
                    height: "toggle"
                }, 300);
            });
        }

        var menutoggle = $('.menu-toggle');
        var mainmenu = $('.navbar-nav');
        
        menutoggle.on('click', function() {
            if (menutoggle.hasClass('is-active')) {
                mainmenu.removeClass('menu-open');
            } else {
                mainmenu.addClass('menu-open');
            }
        });


        /*--------------------------------------------------
          02. Menu Sidebar (Hidden) Content Toggle
        ---------------------------------------------------*/
        if($('.menu-sidebar').length){
            //Show Form
            $('.menu-sidebar button').on('click', function(e) {
                e.preventDefault();
                $('body').toggleClass('side-content-visible');
            });
            //Hide Form
            $('.hidden-bar .inner-box .cross-icon,.form-back-drop,.close-menu').on('click', function(e) {
                e.preventDefault();
                $('body').removeClass('side-content-visible');
            });
            //Dropdown Menu
            $('.fullscreen-menu .navigation li.dropdown > a').on('click', function() {
                $(this).next('ul').slideToggle(500);
            });
        }
         
        
        /*--------------------------------------------------
           03. Project Slider
        ---------------------------------------------------*/
        if ($('.project-active').length) {
            $('.project-active').slick({
                infinite: true,
                arrows: true,
                dots: false,
                autoplay: false,
                autoplaySpeed: 5000,
                pauseOnHover: false,
                slidesToScroll: 1,
                slidesToShow: 1,
                prevArrow: '<button class="project-prev"><i class="far fa-arrow-left"></i></button>',
                nextArrow: '<button class="project-next"><i class="far fa-arrow-right"></i></button>',
            });
        }
        
        $('button[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
          $('.project-active').slick('setPosition');
        })
        
        
        /*--------------------------------------------------
           04. Testimonial Slider
        ---------------------------------------------------*/
        if ($('.testimonial-active').length) {
            $('.testimonial-active').slick({
                infinite: true,
                arrows: true,
                dots: false,
                fade: true,
                autoplay: false,
                autoplaySpeed: 5000,
                pauseOnHover: false,
                slidesToScroll: 1,
                slidesToShow: 1,
                prevArrow: '<button class="testimonial-prev"><i class="far fa-arrow-left"></i></button>',
                nextArrow: '<button class="testimonial-next"><i class="far fa-arrow-right"></i></button>',
            });
        }
       
        
        /*--------------------------------------------------
           05. Testimonial Two Slider
        ---------------------------------------------------*/
        if ($('.testimonial-left-slider').length) {
            $('.testimonial-left-slider').slick({
                infinite: true,
                arrows: false,
                dots: false,
                fade: true,
                autoplay: false,
                autoplaySpeed: 5000,
                pauseOnHover: false,
                slidesToScroll: 1,
                slidesToShow: 1,
                asNavFor: '.testimonial-right-slider',
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            dots: true,
                        }
                    },
                ]
            });
        }
        
        if ($('.testimonial-right-slider').length) {
            $('.testimonial-right-slider').slick({
                infinite: true,
                arrows: false,
                dots: true,
                fade: true,
                autoplay: false,
                autoplaySpeed: 5000,
                pauseOnHover: false,
                slidesToScroll: 1,
                slidesToShow: 1,
                appendDots: '.testimonial-two-dots',
                asNavFor: '.testimonial-left-slider',
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            dots: false,
                        }
                    },
                ]
            });
        }
        
        
        /*--------------------------------------------------
           06. Testimonial Three Slider
        ---------------------------------------------------*/
        if ($('.testimonial-three-slider').length) {
            $('.testimonial-three-slider').slick({
                infinite: true,
                arrows: false,
                dots: true,
                autoplay: false,
                autoplaySpeed: 5000,
                pauseOnHover: false,
                slidesToScroll: 2,
                slidesToShow: 3,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    },
                ]
            });
        }
        
        
        /*--------------------------------------------------
            07. What We Provide
        ---------------------------------------------------*/
        if ($('.what-we-provide-active').length) {
            $('.what-we-provide-active').slick({
                dots: true,
                infinite: true,
                autoplay: false,
                autoplaySpeed: 2000,
                arrows: false,
                speed: 1000,
                focusOnSelect: true,
                slidesToShow: 6,
                slidesToScroll: 2,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 4,
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 430,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
        } 
        
        /*--------------------------------------------------
            08. Product Two Slider
        ---------------------------------------------------*/
        if ($('.product-two-slider').length) {
            $('.product-two-slider').slick({
                dots: true,
                infinite: true,
                autoplay: false,
                autoplaySpeed: 2000,
                arrows: false,
                speed: 1000,
                focusOnSelect: true,
                slidesToShow: 4,
                slidesToScroll: 2,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 575,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
        } 

        /*--------------------------------------------------
            09. Realated Product Slider
        ---------------------------------------------------*/
        if ($('.realated-product-slider').length) {
            $('.realated-product-slider').slick({
                dots: true,
                infinite: true,
                autoplay: false,
                autoplaySpeed: 2000,
                arrows: false,
                speed: 1000,
                focusOnSelect: true,
                slidesToShow: 4,
                slidesToScroll: 2,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 575,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
        } 

        
        /*--------------------------------------------------
            10. Client Logo Slider
        ---------------------------------------------------*/
        if ($('.faq-client-slider').length) {
            $('.faq-client-slider').slick({
                dots: false,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: false,
                speed: 1000,
                focusOnSelect: true,
                slidesToShow: 5,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1300,
                        settings: {
                            slidesToShow: 4,
                        }
                    },
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 375,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
        } 

        
        /*--------------------------------------------------
           11. Blog Slider
        ---------------------------------------------------*/
        if ($('.blog-slider').length) {
            $('.blog-slider').slick({
                infinite: true,
                arrows: false,
                dots: true,
                autoplay: false,
                autoplaySpeed: 5000,
                pauseOnHover: false,
                slidesToScroll: 1,
                slidesToShow: 2,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 1,
                        }
                    },
                ]
            });
        }
        
        
        
        /*--------------------------------------------------
           12. Team Slider
        ---------------------------------------------------*/
        if ($('.team-slider').length) {
            $('.team-slider').slick({
                infinite: true,
                arrows: false,
                dots: true,
                autoplay: false,
                autoplaySpeed: 5000,
                pauseOnHover: false,
                slidesToScroll: 2,
                slidesToShow: 3,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    },
                ]
            });
        }

        
        /*--------------------------------------------------
           13. Services Four
        ---------------------------------------------------*/
        if ($('.services-four-slider').length) {
            $('.services-four-slider').slick({
                infinite: true,
                arrows: false,
                dots: true,
                autoplay: false,
                autoplaySpeed: 5000,
                pauseOnHover: false,
                slidesToScroll: 2,
                slidesToShow: 3,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    },
                ]
            });
        }
        
        
        /*--------------------------------------------------
           14. Related Project
        ---------------------------------------------------*/
        if ($('.related-project-active').length) {
            $('.related-project-active').slick({
                infinite: true,
                arrows: false,
                dots: true,
                autoplay: false,
                autoplaySpeed: 5000,
                pauseOnHover: false,
                slidesToScroll: 2,
                slidesToShow: 3,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    },
                ]
            });
        }
        
        
        /*--------------------------------------------------
           15. Related News
        ---------------------------------------------------*/
        if ($('.related-news-slider').length) {
            $('.related-news-slider').slick({
                infinite: true,
                arrows: false,
                dots: true,
                autoplay: false,
                autoplaySpeed: 5000,
                pauseOnHover: false,
                slidesToScroll: 1,
                slidesToShow: 2,
                responsive: [
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                        }
                    },
                ]
            });
        }
        
        
        /*--------------------------------------------------
           16. Fact Counter
        ---------------------------------------------------*/
        if ($('.counter-item').length) {
            $('.counter-item').appear(function () {

                var $t = $(this),
                    n = $t.find(".count-text").attr("data-stop"),
                    r = parseInt($t.find(".count-text").attr("data-speed"), 10);

                if (!$t.hasClass("counted")) {
                    $t.addClass("counted");
                    $({
                        countNum: $t.find(".count-text").text()
                    }).animate({
                        countNum: n
                    }, {
                        duration: r,
                        easing: "linear",
                        step: function () {
                            $t.find(".count-text").text(Math.floor(this.countNum));
                        },
                        complete: function () {
                            $t.find(".count-text").text(this.countNum);
                        }
                    });
                }

            }, {
                accY: 0
            });
        }


        /*--------------------------------------------
           17. CountDown
        ---------------------------------------------*/
		if($('.count-down').length !== 0){
            var $date = $('.count-down').attr('data-date');
                const second = 1000,
				  minute = second * 60,
				  hour = minute * 60,
				  day = hour * 24;
				let	countDown = new Date($date).getTime(),
			x = setInterval(function() {
			  let now = new Date().getTime(),
				  distance = countDown - now;
				document.getElementById('days').innerText = Math.floor(distance / (day)),
				document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
				document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
				document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);
			  //do something later when date is reached
			  //if (distance < 0) {
			  //  clearInterval(x);
			  //  'IT'S MY BIRTHDAY!;
			  //}
			}, second)
        };
        

        /*--------------------------------------------
           18. Search Popup
        ---------------------------------------------*/
        var bodyOvrelay =  $('#body-overlay');
        var searchPopup = $('#td-search-popup');
        var sidebarMenu = $('#sidebar-menu');

        $(document).on('click','#body-overlay',function(e){
            e.preventDefault();
            bodyOvrelay.removeClass('active');
            searchPopup.removeClass('active');
            sidebarMenu.removeClass('active');
        });
        $(document).on('click','.search-bar-btn',function(e){
            e.preventDefault();
            searchPopup.addClass('active');
            bodyOvrelay.addClass('active');
        });

        
        /* -------------------------------------------------
          19. Video PopUp
        ------------------------------------------------- */
        if ($('.video-play').length) {
            $('.video-play').magnificPopup({
                type: 'video',
            });
        }
        
        if ($('.about-video-play').length) {
            $('.about-video-play').magnificPopup({
                type: 'video',
            });
        }

        
        /* -------------------------------------------------
          20. Blog Active Item
        ------------------------------------------------- */
        $(".blog-item").hover(function(){
            $(".blog-item").removeClass("active");
            $(this).addClass("active");
        });
        
        
        /* -------------------------------------------------
           21. Skillbar
        ------------------------------------------------- */
        if ($('.skillbar').length) {
            $('.skillbar').appear(function () {
                $('.skillbar').skillBars({
                    from: 0,
                    speed: 3000,
                    interval: 100,
                });
            });
        }

        
        /* -------------------------------------------------
           22. Project Filtering
        ------------------------------------------------- */
        $(".project-filter li").on('click', function () {
            $(".project-filter li").removeClass("current");
            $(this).addClass("current");

            var selector = $(this).attr('data-filter');
            $('.project-two-active').imagesLoaded(function () {
                $(".project-two-active").isotope({
                    itemSelector: '.item',
                    filter: selector,
                });
            });

        });
        
        /* -------------------------------------------------
           23. Project Two Popup
        ------------------------------------------------- */
        $('.project-item-two .plus').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
            },
        });
        
        
        /* -------------------------------------------------
          24. Circle Progress
        ------------------------------------------------- */
        /* About Page */
       if ($.fn.circleProgress) {
			var progress1 = $('.one.progress-content')
			if($.fn.circleProgress) {
			  progress1.appear(function () {
				progress1.circleProgress({
					value: 0.76,
					size: 120,
                    thickness: 7,
                    emptyFill: "transparent",
					fill: { gradient: ["#ff7e5f", "#feb47b"] },
                    lineCap: 'square',
                    startAngle: -Math.PI / 4 * 2,
					animation : { duration: 2000},
				  });
			  });
			};
		};
       if ($.fn.circleProgress) {
			var progress2 = $('.two.progress-content')
			if($.fn.circleProgress) {
			  progress2.appear(function () {
				progress2.circleProgress({
					value: 0.65,
					size: 120,
                    thickness: 7,
                    emptyFill: "transparent",
					fill: { gradient: ["#ff7e5f", "#feb47b"] },
                    lineCap: 'square',
                    startAngle: -Math.PI / 4 * 2,
					animation : { duration: 2000},
				  });
			  });
			};
		};
        
        
        /* Services Page */
       if ($.fn.circleProgress) {
			var progress11 = $('.one.circle-progress-inner')
			if($.fn.circleProgress) {
			  progress11.appear(function () {
				progress11.circleProgress({
					value: 0.76,
					size: 100,
                    thickness: 7,
					fill: { gradient: ["#ff7e5f", "#feb47b"] },
                    lineCap: 'square',
                    startAngle: -Math.PI / 4 * 2,
					animation : { duration: 2000},
				  }).on('circle-animation-progress', function(event, progress) {
					$(this).find('h3').html(Math.round(83 * progress) + '<span>%</span>');
				  });
			  });
			};
		};
        
       if ($.fn.circleProgress) {
			var progress12 = $('.two.circle-progress-inner')
			if($.fn.circleProgress) {
			  progress12.appear(function () {
				progress12.circleProgress({
					value: 0.85,
					size: 100,
                    thickness: 7,
					fill: { gradient: ["#ff7e5f", "#feb47b"] },
                    lineCap: 'square',
                    startAngle: -Math.PI / 4 * 2,
					animation : { duration: 2000},
				  }).on('circle-animation-progress', function(event, progress) {
					$(this).find('h3').html(Math.round(94 * progress) + '<span>%</span>');
				  });
			  });
			};
		};
        
       if ($.fn.circleProgress) {
			var progress13 = $('.three.circle-progress-inner')
			if($.fn.circleProgress) {
			  progress13.appear(function () {
				progress13.circleProgress({
					value: 0.8,
					size: 100,
                    thickness: 7,
					fill: { gradient: ["#ff7e5f", "#feb47b"] },
                    lineCap: 'square',
                    startAngle: -Math.PI / 4 * 2,
					animation : { duration: 2000},
				  }).on('circle-animation-progress', function(event, progress) {
					$(this).find('h3').html(Math.round(90 * progress) + '<span>%</span>');
				  });
			  });
			};
		};
        
        
        /* -------------------------------------------------
          25. Nice Select
        ------------------------------------------------- */
        $('select').niceSelect();
        
        
        /* -------------------------------------------------
          26. Price Range Slider
        ------------------------------------------------- */
        if ($('.price-slider-range').length) {
            $( ".price-slider-range" ).slider({
              range: "min",
              value: 5960,
              min: 5,
              max: 8000,
              slide: function( event, ui ) {
                $( "#price" ).val( "$" + ui.value );
              }
            });
            $( "#price" ).val( "$" + $( ".price-slider-range" ).slider( "value" ) );
        }
        
        
        /* -------------------------------------------------
          27. WOW Animation
        ------------------------------------------------- */
        if ($('.wow').length) {
            var wow = new WOW({
                boxClass: 'wow', // animated element css class (default is wow)
                animateClass: 'animated', // animation css class (default is animated)
                offset: 0, // distance to the element when triggering the animation (default is 0)
                mobile: true, // trigger animations on mobile devices (default is true)
                live: true // act on asynchronously loaded content (default is true)
            });
            wow.init();
        }


        /*----------------------------------------
          28. back to top
        ----------------------------------------*/
        $(document).on('click', '.back-to-top', function () {
            $("html,body").animate({
                scrollTop: 0
            }, 500);
        });

    });

    $(window).on("scroll", function() {
        /*---------------------------------------
           28. back to top
        -----------------------------------------*/
        var ScrollTop = $('.back-to-top');
        if ($(window).scrollTop() > 1000) {
            ScrollTop.fadeIn(300);
        } else {
            ScrollTop.fadeOut(300);
        }

        /*---------------------------------------
           29. sticky active
        -----------------------------------------*/
        var scroll = $(window).scrollTop();
        if (scroll < 445) {
            $(".navbar").removeClass("sticky-active");
        } else {
            $(".navbar").addClass("sticky-active");
        }

    });


    $(window).on('load', function () {

        /*-----------------
           30. preloader
        ------------------*/
        var preLoder = $("#preloader");
        preLoder.delay(500).fadeOut(500);

        /*-----------------
           28. back to top
        ------------------*/
        var backtoTop = $('.back-to-top')
        backtoTop.fadeOut();

        /*---------------------
            Cancel Preloader
        ----------------------*/
        $(document).on('click', '.cancel-preloader a', function (e) {
            e.preventDefault();
            $("#preloader").fadeOut(2000);
        });
        

    });


})(jQuery);