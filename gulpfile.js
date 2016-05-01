var gulp = require('gulp');
var notify = require('gulp-notify');
var sass = require('gulp-sass');
var uglifyCss = require('gulp-uglifycss');
var concatCss = require('gulp-concat-css');
var gulpFilter = require('gulp-filter');
var rename = require('gulp-rename'); 
var mainBowerFiles = require('main-bower-files');
var browserSync = require('browser-sync').create();

var SASS_DIR = './themes/barpage/sass';
var CSS_DIR = './themes/barpage/css';
var JS_DIR = './themes/barpage/js';

var SASS_MAIN = './themes/barpage/sass/main.scss';

var PROXY_URL = 'localhost/barpage';

gulp.task('sass', function() {
  return gulp.src(SASS_MAIN)
    .pipe(sass().on("error", notify.onError("Error: <%= error.message %>")))
    .pipe(gulp.dest(CSS_DIR))
    .pipe(notify({
      message: 'Sass compiled'
      }))
    .pipe(browserSync.stream());
});

gulp.task('minify', ['sass'], function(){
    return gulp.src(CSS_DIR + '/main.css',{base: CSS_DIR})
        .pipe(concatCss('main.min.css'))
        .pipe(uglifyCss())
        .pipe(gulp.dest(CSS_DIR));
});



gulp.task('bower', function() {
    var filterCSS = gulpFilter('**/*.css', { restore: true });
    var filterJS = gulpFilter('**/*.js', { restore: true });
    return gulp.src(mainBowerFiles())
        .pipe(filterCSS)
        .pipe(gulp.dest(CSS_DIR))
        .pipe(filterCSS.restore)

        .pipe(filterJS)
        .pipe(gulp.dest(JS_DIR))
        .pipe(filterJS.restore)
});

gulp.task('serve', ['sass'], function() {
  browserSync.init({
    proxy: PROXY_URL,
    files: [
      "mysite/**/*.php",
      "themes/**/*.js",
      "themes/**/*.scss",
      "themes/**/*.ss"
    ],
    notify: true,
    browser: 'chrome'

  });

  gulp.watch(SASS_DIR + '/**/*.scss', ['minify']);
});


gulp.task('default', ['sass', 'bower', 'minify']);
