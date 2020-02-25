require('./bootstrap');

window.Vue = require('vue');

$(document).ready(init);

function init() {

    new Vue({
        el: '#app',
    });

    // MESSAGE OUT ANIMATION
    $('div.alert').not('div.alert.alert-info').delay(3500).fadeOut(450);

    // NAVBAR ANIMATION
    $(window).bind('scroll', function () {
        if ($(window).scrollTop() > 90) {
            $('.navbar').addClass('fixed-top bg-primary shadow');
        } else {
            $('.navbar').removeClass('fixed-top bg-primary shadow');
        }
    });
}


