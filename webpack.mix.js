const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/owl.carousel.js', 'public/js')
    .js('resources/js/function.js', 'public/js')
    .js('resources/js/products.js', 'public/js')
    .copy('node_modules/photoswipe/dist/photoswipe.js', 'public/js')
    .copy('node_modules/photoswipe/dist/photoswipe-ui-default.js', 'public/js')
    .copy('resources/js/magnific-popup.min.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/products.scss', 'public/css')
    .sass('resources/sass/cart.scss', 'public/css')
    .sass('resources/sass/contact.scss', 'public/css')
    .sass('resources/sass/blog.scss', 'public/css')
    .sass('resources/sass/animation.scss', 'public/css')
    .sass('resources/sass/mobile.scss', 'public/css')
    .sass('resources/sass/owl.carousel.scss', 'public/css')
    .sass('resources/sass/slick.scss', 'public/css')
    .sass('resources/sass/magnific-popup.scss', 'public/css')
    .version();
