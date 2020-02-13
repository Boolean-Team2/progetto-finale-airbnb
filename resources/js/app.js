require('./bootstrap');

window.Vue = require('vue');

$(document).ready(init);

function init() {
    // MESSAGE OUT ANIMATION
    $('div.alert').not('div.alert.alert-info').delay(3500).fadeOut(450);

    new Vue({
        el: '#app',
    });
}


