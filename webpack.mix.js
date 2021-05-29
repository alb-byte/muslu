const mix = require('laravel-mix');
mix.js([
   'resources/js/adminItems.js',
   'resources/js/adminPage.js',
   'resources/js/albumPage.js',
   'resources/js/albumSongItems.js',
   'resources/js/api.js',
   'resources/js/artistItems.js',
   'resources/js/artistPage.js',
   'resources/js/homePage.js',
   'resources/js/player.js',
   'resources/js/router.js',
   'resources/js/scroll.js',
   'resources/js/searchItems.js',
   'resources/js/searchPage.js',
   'resources/js/sliderItems.js',
   'resources/js/sliderScript.js',
   'resources/js/star.js',
   'resources/js/videoPage.js'
],
   'public/js/script.js').version();
mix.sass('resources/sass/style.scss', 'public/css');
mix.sass('resources/sass/slider.scss', 'public/css');

mix.webpackConfig({
   externals: {
      "jquery": "jQuery"
   }
});