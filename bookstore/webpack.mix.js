const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('node_modules/bootstrap/scss/bootstrap.scss', 'public/css/bootstrap.css')
   .css('resources/css/app.css', 'public/css');
