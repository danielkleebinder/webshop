/*
 Created on : 04.04.2015
 Author     : Daniel Kleebinder
 
 Please do not copy or redistribute this source!
 */


var uploadSidebarToggled = false;

/**
 * Shows the "scroll to top" button and scrolls on click
 * within 500 ms up to the top. Initializes bootstrap tooltip
 * and disables the smooth scrolling on the internet explorer.
 */
$(document).ready(function () {
    // Disable smooth scrolling on internet explorer to
    // prevent "jumpy" page effect
    if (!!document.documentMode) {
        $('html').on("mousewheel", function () {
            if (event.preventDefault) {
                event.preventDefault();
            } else {
                event.returnValue = false;
            }
            var wd = event.wheelDelta;
            var csp = window.pageYOffset;
            window.scrollTo(0, csp - wd);
        });
    }

    // Initialize FancyBox
    $(".gallery-img").fancybox({
        openEffect: "elastic",
        closeEffect: "elastic",
        helpers: {
            title: {
                type: "over"
            }
        }
    });

    // Initialize keyup for duplicated primary key check
    $("#username").keyup(function (e) {
        $.post("./ajax/CheckUsername.php", {
            username: $('#username').val()
        }, function (data) {
            var usernameForm = document.getElementById("username-form");
            var usernameFeedback = document.getElementById("username-feedback");
            var usernameAlert = document.getElementById("username-alert-duplicate");
            if (data === "true") {
                error(usernameForm, usernameFeedback, usernameAlert);
            } else {
                noError(usernameForm, usernameFeedback, usernameAlert);
            }
        });
    });

    $("#modify-submit").click(function (e) {
        e.preventDefault();
        $.get('./ajax/EditImage.php?' + $('#modify-form').serialize(), function (data) {
            if (data === 'true') {
                $('#alert-success-data').html("Successfully modified the image!");
                $('#success-alert').fadeIn(500).delay(3000).fadeOut(1000);
            } else {
                $('#alert-error-data').html("Not able to modify the selected image!");
                $('#error-alert').fadeIn(500).delay(3000).fadeOut(1000);
            }
            changeCropImage($('#prod-config-img-select').val());
        });
    });

    // Create Drag'n'Drop
    $("#product-upload-dnd").on('dragenter', function (e) {
        e.preventDefault();
    });
    $("#product-upload-dnd").on('dragover', function (e) {
        e.preventDefault();
    });
    $("#product-upload-dnd").on('drop', function (e) {
        e.preventDefault();
        var image = e.originalEvent.dataTransfer.files;
        createFormData(image);
    });

    // Collapse button
    $("#collapse-button").click(function () {
        if (uploadSidebarToggled) {
            $("#upload-sidebar").animate({"left": -530});
            uploadSidebarToggled = false;
        } else {
            $("#upload-sidebar").animate({"left": 0});
            uploadSidebarToggled = true;
        }
    });

    // Enable the "scroll to top" function
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $("#scrolltop").fadeIn();
        } else {
            $("#scrolltop").fadeOut();
        }
    });
    $("#scrolltop").click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 500);
        return false;
    });

    // Enable bootstrap tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Enable image-picker
    $('#prod-config-img-select').imagepicker();

    // Hide cropping area by default
    if ($('#cropping')) {
        $('#cropping').hide();
    }

    $('.image_picker_selector li').each(function () {
        $(this).addClass('col-lg-3');
        $(this).addClass('col-md-3');
        $(this).addClass('col-sm-3');
        $(this).addClass('col-xs-3');
    });
});
function toggleCroppingWindow(val) {
    if (val === 'cut') {
        $('#cropping').show();
        changeCropImage($('#prod-config-img-select').val());
    } else {
        $('#cropping').hide();
    }
}

function changeCropImage(val) {
    cropper.replace('./pics/' + val);
}

function createFormData(image) {
    var formImage = new FormData();
    formImage.append('userfile', image[0]);
    uploadFormData(formImage);
}

function uploadFormData(formData) {
    $.ajax({
        url: "./ajax/Upload.php",
        type: "POST",
        data: formData,
        contentType: false,
        cache: false, processData: false,
        success: function (data) {
            $('#product-upload-dnd').html(data);
        }
    });
}

!function (a) {
    "use strict";
    a("a.page-scroll").bind("click", function (e) {
        var l = a(this);
        a("html, body").stop().animate({
            scrollTop: a(l.attr("href")).offset().top - 50
        }, 1250, "easeInOutExpo"), e.preventDefault();
    });
};

/**
 * Scroll to the parent element within 500 ms.
 */
$.fn.scrollView = function () {
    return this.each(function () {
        $("html, body").animate({
            scrollTop: $(this).offset().top
        }, 500);
    });
};