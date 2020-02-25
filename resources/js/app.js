require('./bootstrap');

window.Vue = require('vue');

$(document).ready(init);

function init() {

    new Vue({
        el: '#app',
    });

    // MESSAGE OUT ANIMATION
    $('div.alert').not('div.alert.alert-info').delay(3500).fadeOut(450);

}


