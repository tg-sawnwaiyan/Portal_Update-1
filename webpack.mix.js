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
   .sass('resources/sass/app.scss', 'public/css');
mix.copy('resources/css/mystyle.css', 'public/css'); //V
// mix.sass('resources/sass/style.scss', 'public/css');
mix.copy('resources/js/jquery.min.js', 'public/js');
mix.copy('resources/js/jquery-3.4.1.min.js', 'public/js');
mix.copy('resources/js/adsslider.js', 'public/js');
mix.copy('resources/js/vue-scrollto.js', 'public/js');
mix.copy('resources/js/vue-fullpage.min.js', 'public/js');
mix.copy('resources/js/vue-clazy-load.js', 'public/js');
mix.copy('resources/js/sweetalert2.all.js', 'public/js');
mix.copy('resources/js/popper.min.js', 'public/js');
mix.copy('resources/js/pannellum.js', 'public/js');
mix.copy('resources/js/nprogress.js', 'public/js');
mix.copy('resources/js/myJs.js', 'public/js');
mix.copy('resources/js/jssor.slider-27.5.0.min.js', 'public/js');
mix.copy('resources/js/jquery.scrolling-tabs.min.js', 'public/js');
mix.copy('resources/js/jquery.dataTables.min.js', 'public/js');
mix.copy('resources/js/dataTables.bootstrap4.min.js', 'public/js');
mix.copy('resources/js/custom.js', 'public/js');

// mix.webpackConfig({
//    resolve: {
//       alias: {
//          'vue$': 'vue/dist/vue.runtime.common.js'
//       }
//    }
//    });