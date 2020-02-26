require('./bootstrap');

window.Vue = require('vue');

$(document).ready(init);

function init() {

    new Vue({
        el: '#app',
    });

    // MESSAGE OUT ANIMATION
    $('div.alert').not('div.alert.alert-info').delay(3500).fadeOut(450);

    // AD ENDTIME SHOW ON CLICK
    $('.js_adEndTime').hide();

    $(document).on(
        'click', '#js_showEndTimeAd', function () {

            $(this).parents($('.card-body')).children('.js_adEndTime').fadeIn(250);

            setTimeout(() => {
                parent = $(this).parents('div.card-body');
                parent.find('.js_adEndTime').fadeOut(250);
            }, 3000);

        }
    );

}


