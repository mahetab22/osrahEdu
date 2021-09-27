/*global $, alert, console */

$(document).ready(function() {

    /* ===============================  click on navbar toggler  =============================== */

    $('#nav-icon1').on('click', function() {
        $(this).addClass('open');
        $('.sidebar').addClass("opened");
        $('.overlay_gen').fadeIn().on('click', function() {
            $(this).fadeOut();
            $('#nav-icon1').removeClass('open')
            $('.sidebar').removeClass("opened");
        });
    })


    /* ===============================  WOW.js  =============================== */

    new WOW().init();

    /* ===============================  venobox  =============================== */
    $('.venobox').venobox({
        bgcolor: '',
        overlayColor: 'rgba(6, 12, 34, 0.85)',
        closeBackground: '',
        closeColor: '#fff'
    });


    /* ===============================  search popup  =============================== */

    $('.icon_search').on('click', function(e) {
        e.preventDefault();
        $('.search-popup').addClass('active')
    })

    $('.search-popup').on('click', function() {
        $(this).removeClass('active')
    })

    $('.aws-search-form').on('click', function(e) {
        e.stopPropagation();
    })




    /* ===============================  clients section  =============================== */
    $(".clients_section .owl-carousel").owlCarousel({
        autoplay: true,
        nav: false,
        dots: true,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        loop: true,
        responsive: {
            0: { items: 1 },
            576: { items: 2 },
            768: { items: 3 },
            992: { items: 4 },
            1200: { items: 5 }
        }
    });

    /* ===============================  clients section  =============================== */
    $(".news_slider .owl-carousel").owlCarousel({
        autoplay: true,
        nav: false,
        dots: false,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        loop: true,
        rtl: true,
        responsive: {
            0: { items: 1 },
            768: { items: 1.5 },
            992: { items: 2 },
            1200: { items: 2.5 }
        }
    });




    /* ===============================  main news section  =============================== */
    $(".main_news.owl-carousel").owlCarousel({
        autoplay: true,
        nav: true,
        dots: true,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        loop: true,
        items: 1
    });

    /* ===============================  library section  =============================== */

    $('.library_section .slick-slider').slick({
        centerMode: true,
        slidesToShow: 3,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [{
                breakpoint: 992,
                settings: {
                    arrows: false,
                    centerMode: true,

                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,

                    slidesToShow: 1
                }
            }
        ]
    });


    /* ===============================  library section  =============================== */

    $('.other_news .slick-slider').slick({
        centerMode: true,
        slidesToShow: 4,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [{
                breakpoint: 992,
                settings: {
                    arrows: false,
                    centerMode: true,

                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,

                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    arrows: false,
                    centerMode: true,

                    slidesToShow: 1
                }
            }
        ]
    });


    /* ===============================  library section  =============================== */
    $(".testimonials_section .owl-carousel").owlCarousel({
        autoplay: true,
        nav: false,
        dots: true,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        loop: true,
        rtl: true,
        responsive: {
            0: { items: 1 },
            768: { items: 2 },
            992: { items: 3 },
            1200: { items: 3 }

        }
    });




    /* ===============================  Button Up  =============================== */

    $(window).scroll(function() {
        if ($(window).scrollTop() >= 1000) {

            $('.up').addClass('fade')
        } else {

            $('.up').removeClass('fade')
        }
    })

    $('.up').on('click', function() {

        $('html, body').animate({
            scrollTop: 0
        }, 1000, 'easeInOutExpo')
    })


    /* ===============================  show password =============================== */
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    /* ===============================  dropdown  =============================== */

    $('.dropdown-toggle').dropdown()

    /* =============================== Settings of content tabs =============================== */
    $('.muo_tab').on('click', function(e) {

        e.preventDefault();

        $(this).addClass('active').siblings().removeClass('active');

        var id = $(this).attr('data-content')

        $('.box_content[id="' + id + '"]').addClass('active').siblings().removeClass('active')

    })


    /* ===============================  nice select  =============================== */

    $('.nice-select').niceSelect();



    /* ===============================  advices page  =============================== */
    $('.advices_page .advices_content .box .head').on('click', function() {
        $(this).find('.chevron i').toggleClass('fa-plus fa-minus')
        $(this).parent().find('.content').slideToggle();
        $(this).parent().siblings().find('.content').slideUp();
    })


    $('.lessons-card-show .head_item').on('click', function() {
        $(this).find('i').toggleClass('rotate');
        $(this).parent().find('.slide_content').slideToggle();
        $(this).parent().toggleClass('active').siblings().removeClass('active').find('.slide_content').slideUp();
    })



});