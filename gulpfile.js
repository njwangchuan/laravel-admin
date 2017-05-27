var gulp = require('gulp');
var elixir = require('laravel-elixir');

/*
|--------------------------------------------------------------------------
| Elixir Asset Management
|--------------------------------------------------------------------------
|
| Elixir provides a clean, fluent API for defining some basic Gulp tasks
| for your Laravel application. By default, we are compiling the Sass
| file for our application, as well as publishing vendor resources.
|
*/

elixir.config.sourcemaps = false;

var paths = {
  'jquery': 'bower/jquery/dist',
  'bootstrap': 'bower/bootstrap/dist',
  'bootstrapMarkdown': 'bower/bootstrap-markdown/',
  'fontawesome': 'bower/font-awesome',
  'colorbox': 'bower/jquery-colorbox',
  'summernote': 'bower/summernote/dist',
  'select2': 'bower/select2/dist',
  'colorPicker': 'bower/mjolnic-bootstrap-colorpicker/dist',
  'dataTables': 'bower/datatables/media',
  'dataTablesBootstrap3Plugin': 'bower/datatables-plugins/integration/bootstrap/3',
  'datatablesResponsive': 'bower/datatables-responsive',
  'startbootstrapSbAdmin2': 'bower/startbootstrap-sb-admin-2/dist',
  'startbootstrapCreative': 'bower/startbootstrap-creative',
  'metisMenu': 'bower/metisMenu/dist',
  'cropper': 'bower/cropper/dist',
  'Jcrop': 'bower/Jcrop',
  'site': 'site',
  'admin': 'admin',
  'favicon': 'favicon',
};

elixir(function (mix) {
  //mix.sass('app.scss');

  // Copy fonts straight to public
  mix.copy('resources/assets/' + paths.bootstrap + '/fonts/**', 'public/fonts');
  mix.copy('resources/assets/' + paths.fontawesome + '/fonts/**', 'public/fonts');
  mix.copy('resources/assets/' + paths.summernote + '/font/**', 'public/css/font');

  // Copy images straight to public
  mix.copy('resources/assets/' + paths.colorbox + '/example3/images/**', 'public/css/images');
  mix.copy('resources/assets/' + paths.colorPicker + '/img/**', 'public/img');
  mix.copy('resources/assets/' + paths.startbootstrapCreative + '/img/**', 'public/img');
  mix.copy('resources/assets/' + paths.Jcrop + '/css/Jcrop.gif', 'public/css');
  mix.copy('resources/assets/' + paths.favicon + '/**', 'public/favicon');

  mix.styles([
    '../' + paths.bootstrap + '/css/bootstrap.css',
    '../' + paths.bootstrap + '/css/bootstrap-theme.css',
    '../' + paths.fontawesome + '/css/font-awesome.css',
  ], 'public/css/site.css');

  // Merge site scripts.
  mix.scripts([
    '../' + paths.jquery + '/jquery.js',
    '../' + paths.bootstrap + '/js/bootstrap.js',
  ], 'public/js/site.js');

  // Merge Admin scripts.
  mix.scripts([
    '../' + paths.bootstrapMarkdown + '/js/bootstrap-markdown.js',
    '../' + paths.metisMenu + '/metisMenu.js',
    '../' + paths.colorbox + '/jquery.colorbox.js',
    '../' + paths.summernote + '/summernote.js',
    '../' + paths.select2 + '/js/select2.js',
    '../' + paths.colorPicker + '/js/bootstrap-colorpicker.js',
    '../' + paths.dataTables + '/js/jquery.dataTables.js',
    '../' + paths.dataTables + '/js/dataTables.bootstrap.js',
    '../' + paths.dataTablesBootstrap3Plugin + '/datatables.bootstrap.js',
    '../' + paths.datatablesResponsive + '/js/dataTables.responsive.js',
    '../' + paths.startbootstrapSbAdmin2 + '/js/sb-admin-2.js',
  ], 'public/js/admin.js');

  // Merge Admin CSSs.
  mix.styles([
    '../' + paths.bootstrapMarkdown + '/css/bootstrap-markdown.min.css',
    '../' + paths.colorbox + '/example3/colorbox.css',
    '../' + paths.metisMenu + '/metisMenu.css',
    '../' + paths.summernote + '/summernote.css',
    '../' + paths.select2 + '/css/select2.css',
    '../' + paths.colorPicker + '/css/bootstrap-colorpicker.css',
    '../' + paths.dataTables + '/css/dataTables.bootstrap.css',
    '../' + paths.dataTablesBootstrap3Plugin + '/datatables.bootstrap.css',
    '../' + paths.startbootstrapSbAdmin2 + '/css/sb-admin-2.css',
    '../' + paths.startbootstrapSbAdmin2 + '/css/timeline.css',
  ], 'public/css/admin.css');
  
  //
  // // Merge Web Front scripts.
  // mix.scripts([
  //   '../' + paths.jquery + '/jquery.js',
  //   '../' + paths.startbootstrapCreative + '/js/bootstrap.js',
  // ], 'public/js/site.js').scripts([
  //   '../' + paths.startbootstrapCreative + '/js/jquery.easing.min.js',
  //   '../' + paths.startbootstrapCreative + '/js/jquery.fittext.js',
  //   '../' + paths.startbootstrapCreative + '/js/wow.min.js',
  //   '../' + paths.startbootstrapCreative + '/js/creative.js',
  // ], 'public/js/index.js').scripts([
  //   '../' + paths.select2 + '/js/select2.js',
  // ], 'public/js/albums.js').scripts([
  //   '../' + paths.Jcrop + '/js/jquery.color.js',
  //   '../' + paths.Jcrop + '/js/Jcrop.min.js',
  // ], 'public/js/Jcrop.js');
  //
  // // Merge Web Front CSSs.
  // mix.styles([
  //   '../' + paths.startbootstrapCreative + '/css/bootstrap.min.css',
  //   '../' + paths.startbootstrapCreative + '/css/creative.css',
  //   '../' + paths.fontawesome + '/css/font-awesome.css',
  // ], 'public/css/site.css').styles([
  //   '../' + paths.startbootstrapCreative + '/css/animate.min.css',
  //   '../' + paths.startbootstrapSbAdmin2 + '/css/sb-admin-2.css',
  // ], 'public/css/index.css').styles([
  //   '../' + paths.startbootstrapSbAdmin2 + '/css/sb-admin-2.css',
  // ], 'public/css/blog.css').styles([
  //   '../' + paths.select2 + '/css/select2.css',
  //   '../' + paths.site + '/albums.css',
  // ], 'public/css/albums.css').styles([
  //   '../' + paths.Jcrop + '/css/Jcrop.min.css',
  // ], 'public/css/Jcrop.css');
});
