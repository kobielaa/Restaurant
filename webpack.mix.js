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

var vendorsCSS = {
  './node_modules/bootstrap/dist/css/bootstrap.min.css': './public/css/bootstrap.min.css',
  './node_modules/bootstrap/dist/css/bootstrap.min.css.map': './public/css/bootstrap.min.css.map',
  './node_modules/font-awesome/css/font-awesome.min.css': './public/css/font-awesome.min.css',
  './node_modules/font-awesome/css/font-awesome.css.map': './public/css/font-awesome.css.map',
  './node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css': './public/css/bootstrap-datepicker.min.css',
  './node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css.map': './public/css/bootstrap-datepicker.css.map',
  './node_modules/lightbox2/dist/css/lightbox.min.css': './public/css/lightbox.min.css',
  './node_modules/select2/dist/css/select2.min.css': './public/css/select2.min.css'
};
var vendorsFonts = {
  './node_modules/font-awesome/fonts/FontAwesome.otf': './public/fonts/FontAwesome.otf',
  './node_modules/font-awesome/fonts/fontawesome-webfont.eot': './public/fonts/fontawesome-webfont.eot',
  './node_modules/font-awesome/fonts/fontawesome-webfont.svg': './public/fonts/fontawesome-webfont.svg',
  './node_modules/font-awesome/fonts/fontawesome-webfont.ttf': './public/fonts/fontawesome-webfont.ttf',
  './node_modules/font-awesome/fonts/fontawesome-webfont.woff': './public/fonts/fontawesome-webfont.woff',
  './node_modules/font-awesome/fonts/fontawesome-webfont.woff2': './public/fonts/fontawesome-webfont.woff2'
};
var vendorImg = {
  'resources/assets/img': './public/img',
  './node_modules/lightbox2/dist/images': './public/img/lightbox'
};

mix.options({
  processCssUrls: false
});

for (var vendor in vendorsCSS) {
  mix.copy(vendor, vendorsCSS[vendor]);
}
for (var vendor in vendorsFonts) {
  mix.copy(vendor, vendorsFonts[vendor]);
}
for (vendor in vendorImg) {
  mix.copy(vendor, vendorImg[vendor]);
}

mix.js('resources/assets/js/app.js', 'public/js')
  .sourceMaps();
mix.sass('resources/assets/sass/app.scss', 'public/css');
mix.sass('resources/assets/sass/admin.scss', 'public/css');