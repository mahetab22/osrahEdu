$(window).load(function () {
    $('.loader').fadeOut(2000);
});

new WOW().init();
wow = new WOW({
    boxClass: 'wow', // default
    animateClass: 'animated', // default
    offset: 0, // default
    mobile: true, // default
    live: true // default
})
wow.init();




// Slider


$(document).ready(function () {

    
    $(".slider-home").owlCarousel({
        nav: false,
        loop: true,
        navText: ["<i class='fa fa-arrow-left'></i>", "<i class='fa fa-arrow-right'></i>"],
        dots: false,
        autoplay: 4000,
        items: 1,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        autoplayHoverPause: true,
        center: false,
        responsiveClass: true
    });

    $(".about-slider").owlCarousel({
        nav: false,
        loop: true,
        navText: ["<i class='fa fa-arrow-left'></i>", "<i class='fa fa-arrow-right'></i>"],
        dots: false,
        autoplay: 4000,
        items: 1,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        autoplayHoverPause: true,
        center: false,
        responsiveClass: true
    });

   
    
    // Client Slider
    $(".client-slider").owlCarousel({
        nav: true,
        loop: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        dots: false,
        autoplay: 4000,
        items: 5,
        autoplayHoverPause: true,
        center: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

});




//Nav
$(window).on("scroll", function () {
    if ($(window).scrollTop() > 152) {
        $("nav.moved").addClass("active");
    } else {
        //remove the background property so it comes transparent again (defined in your css)
        $("nav.moved").removeClass("active");
    }
});

// Top

$(window).scroll(function () {
    if ($(this).scrollTop() > 500) {
        $(".top").addClass("scrollNow");
    } else {
        $(".top").removeClass("scrollNow");
    }
});

$(".top").click(function () {
    $("html,body").animate({
        scrollTop: 0
    }, 500);
    return false;
});


$(function () {
    $('.scroll').scrollOffset({
        offset: 80 // default: 0
    });
});

$(function () {
    $("#addVehicle").click(function () {
        $("#vehicleFieldsWrapper .vehicleFields").clone().appendTo($("#vehicleFieldsWrapper "));

    });
});

$('.extra-fields-customer').click(function() {
  $('.customer_records').clone().appendTo('.customer_records_dynamic');
  $('.customer_records_dynamic .customer_records').addClass('single remove');
  $('.single .extra-fields-customer').remove();
  $('.single').append('<a href="#" class="remove-field btn-remove-customer"><i class="fa fa-times"></i></a>');
  $('.customer_records_dynamic > .single').attr("class", "remove");

  $('.customer_records_dynamic input').each(function() {
    var count = 0;
    var fieldname = $(this).attr("name");
    $(this).attr('name', fieldname + count);
    count++;
  });

});

$(document).on('click', '.remove-field', function(e) {
  $(this).parent('.remove').remove();
  e.preventDefault();
});

$(".search").click(function (e) {
    $("#search").slideToggle(500);

});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function () {
    readURL(this);
});


// for upload file
$(document).on('change', ':file', function () {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});
$(':file').on('fileselect', function (event, numFiles, label) {

    var input = $(this).parents('.input-group').find(':text'),
        log = numFiles > 1 ? numFiles + ' files selected' : label;

    if (input.length) {
        input.val(log);
    } else {
        //            if (log) alert(log);
    }
});

$('.form-control').focus(function () {
    $(this).parents('.form-group').addClass('focused');
});

$('.form-control').blur(function () {
    var inputValue = $(this).val();
    if (inputValue == "") {
        $(this).removeClass('filled');
        $(this).parents('.form-group').removeClass('focused');
    } else {
        $(this).addClass('filled');
    }
});
$(document).on('change', '.btn-file :file', function () {
    var fileName = $('#uploadfile').val();
    $('.filename').val(fileName);
});

$('.open-menu').click(function () {
    $('.mob-menu').addClass('active');
});

$('.cl-menu,.mob-menu a').click(function () {
    $('.mob-menu').removeClass('active');
});



$('.menu-item-has-children').hover(function () {
    $(this).children('.sub-menu');
}, function () {
    $(this).children('.sub-menu');
});



$('.menu-item-has-children').click(function () {
    $(this).children('.sub-menu').toggle("slow");
});



// $('.nav.nav-tabs.list').scrollingTabs({
//   reverseScroll: true,
//   cssClassLeftArrow: 'fa fa-chevron-left',
//   cssClassRightArrow: 'fa fa-chevron-right'
// });

// tabSet = $('.nav.nav-tabs.list').scrollTabs();



function copyFull() {
    var copyBtn = $('.copy-btn');
    copyBtn.on('click', function(event) {
    var $this = $(this);
    var content = $this.prev('.copy-content');
    var range = document.createRange();
    range.selectNode(content[0]);
    window.getSelection().addRange(range);

    try {
      var successful = document.execCommand('copy');

      $(this).after('<span class="success"></span>');
      setTimeout(function() {
        $('.success').addClass('show');
        setTimeout(function() {
          $('.success').fadeOut(function() {
            $('.success').remove();
          });
        }, 1000);
      }, 0);
    } catch (err) {

    }
    window.getSelection().removeAllRanges();
  });
}

$(function() {
  copyFull();
  copyPhone();

});