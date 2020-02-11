const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/assets/js')
   .copy('resources/images/**/*.{jpg,jpeg,png,gif}', 'public/assets/images', { base: 'resources/images' })
   .sass('resources/sass/app.scss', 'public/assets/css')
   .options({
      processCssUrls: false
   })
   .browserSync({
      proxy: 'localhost:8000',
      open: false,
      notify: false
   });

