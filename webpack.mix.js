let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
.extract(['vue', 'jquery', 'nprogress']);
mix.sass('resources/assets/sass/app.scss', 'public/css')
.options({
  processCssUrls: false
});

mix.combine([
	'public/css/app.css',
    'resources/assets/css/style.css'
], 'public/css/custom.css')
    .minify('public/css/custom.css');

mix.combine([
	'public/js/manifest.js',
	'public/js/vendor.js',
    'public/js/app.js',
    'node_modules/flip/dist/jquery.flip.min.js',
    'resources/assets/js/main.js',
], 'public/js/custom.js')
    .minify('public/js/custom.js');
