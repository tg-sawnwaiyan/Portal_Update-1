const mix = require('laravel-mix');
<<<<<<< HEAD
require('laravel-mix-bundle-analyzer');
 
if (!mix.inProduction()) {
    mix.bundleAnalyzer();
}
=======

// require('laravel-mix-bundle-analyzer');



// if (!mix.inProduction()) {

//     mix.bundleAnalyzer();

// }

>>>>>>> 7b289ddccbbf1c6361c279ba775e25a15d748082
// if (mix.inDevelopment()) {

//     mix.bundleAnalyzer();

// }

// if (mix.isWatching()) {

//    mix.bundleAnalyzer();

// }



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
<<<<<<< HEAD
   .extract(['vue','jquery','bootstrap'])
   .sass('resources/sass/app.scss', 'public/css');
=======

    // .extract(['vue','jquery','bootstrap'])

    .sass('resources/sass/app.scss', 'public/css');

>>>>>>> 7b289ddccbbf1c6361c279ba775e25a15d748082
// mix.css('resources/css/mystyle.css', 'public/css'); //V



mix.js('resources/js/myJs.js', 'public/js');



// mix.webpackConfig({

//    resolve: {

//       alias: {

//          'vue$': 'vue/dist/vue.runtime.common.js'

//       }

//    }

//    });
