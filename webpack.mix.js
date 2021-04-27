const mix = require('laravel-mix');
mix.js([
   'resources/js/app.js',
   'resources/js/api.js', 
   'resources/js/player.js',
   'resources/js/router.js',
   'resources/js/scroll.js',
   'resources/js/searchItems.js',
   'resources/js/star.js',
   'resources/js/search.js'
], 
   'public/js/search.js');
mix.sass('resources/sass/app.scss', 'public/css');
mix.webpackConfig({
   externals: {
       "jquery": "jQuery"
   }
});