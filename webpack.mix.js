const mix = require('laravel-mix');
require('laravel-mix-bundle-analyzer');
 
if (!mix.inProduction()) {
    mix.bundleAnalyzer();
}

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
   // .extract(['vue','jquery','bootstrap'])
   .sass('resources/sass/app.scss', 'public/css');
// mix.css('resources/css/mystyle.css', 'public/css'); //V

mix.js('resources/js/myJs.js', 'public/js');

// mix.webpackConfig({
//    resolve: {
//       alias: {
//          'vue$': 'vue/dist/vue.runtime.common.js'
//       }
//    }
//    });