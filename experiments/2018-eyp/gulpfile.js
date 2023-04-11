/*
* Settings
*/
// Set this for browserSync to know where your
// url normally is.
var localhost = "https://eyp-study.test";

/*
* NPM Packages
*/
const gulp = require('gulp');
const browserSync = require('browser-sync');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const reload  = browserSync.reload;
const crass = require('gulp-crass');
const uglify = require('gulp-uglify');
const rename = require("gulp-rename");
const concat = require("gulp-concat");
const babel = require("gulp-babel");
const plumber = require('gulp-plumber');
const imagemin = require('gulp-imagemin');
var svgstore = require('gulp-svgstore');
var svgmin = require('gulp-svgmin');
var path = require('path');


// Static Server + watching scss/html files
gulp.task('serve', ['sass', 'js', 'compressImg', 'svgstore'], function() {

    browserSync({
        proxy: localhost
    });
    // Watch SCSS file for change to pass on to sass compiler,
    gulp.watch('assets/sass/*.{scss,sass}', ['sass']);
    // Watch SCSS file for change to pass on to sass compiler,
    gulp.watch('assets/js/*.js', ['js']);
    // run img compression when images added to directory
    gulp.watch('assets/img/*.*', ['compressImg']);
    // run SVG when svg files added
    gulp.watch('assets/svg/*.svg', ['svgstore']);
    // Watch our CSS file and reload when it's done compiling
    gulp.watch("dist/css/*.css").on('change', reload);
    // Watch php file
    gulp.watch("../*/*.php").on('change', reload);
    // watch javascript files
    gulp.watch("dist/js/*.js").on('change', reload);
});

gulp.task('svgstore', function () {
    return gulp
        .src('assets/svg/*.svg')
        .pipe(svgmin(function (file) {
            var prefix = path.basename(file.relative, path.extname(file.relative));
            return {
                plugins: [{
                    cleanupIDs: {
                        prefix: prefix + '-',
                        minify: true
                    }
                }]
            };
        }))
        .pipe(svgstore({ inlineSvg: true }))
        .pipe(gulp.dest('dist/svg/'));
});


gulp.task('sass', function () {
    processSASS('styles');
});

gulp.task('js', function() {
    var jsFiles = 'assets/js/*.js',
    jsDest = 'dist/js';

    return gulp.src(jsFiles)
        .pipe(plumber())
        .pipe(babel())
        .pipe(concat('scripts.js'))
        .pipe(gulp.dest(jsDest))
        .pipe(rename('scripts.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(jsDest));
});

gulp.task('compressImg', function() {
    return gulp.src('assets/img/*')
            .pipe(imagemin())
            .pipe(gulp.dest('dist/img'));
});


function processSASS(filename) {

    return gulp.src('assets/sass/'+filename+'.{scss,sass}')
      // Converts Sass into CSS with Gulp Sass
      .pipe(sass({
        errLogToConsole: true
      }))
      // adds prefixes to whatever needs to get done
      .pipe(autoprefixer())

      // minify the CSS
      .pipe(crass())

      // rename to add .min
      .pipe(rename({
        suffix: '.min'
      }))
      // Outputs CSS files in the css folder
      .pipe(gulp.dest('dist/css/'));
}

// Creating a default task
gulp.task('default', ['serve']);
