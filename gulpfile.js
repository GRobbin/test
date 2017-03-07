// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var jshint = require('gulp-jshint');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var cssnano = require('gulp-cssnano');
var browserSync = require('browser-sync').create();

// Lint Task
gulp.task('lint', function() {
    return gulp.src('js/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});

// Compile Our Sass
gulp.task('sass', function() {
    return gulp.src('source/css/main.scss')
        .pipe(sass())
        .pipe(cssnano())
        .pipe(concat('app.css'))
        .pipe(gulp.dest('dist/css'));
});

// Concatenate & Minify JS
gulp.task('scripts', function() {
    return gulp.src(['bower_components/jquery/dist/jquery.js', 'source/js/*.js'])
        .pipe(concat('app.dev.js'))
        .pipe(uglify())
        .pipe(gulp.dest('dist/js'));
});

// Watch Files For Changes
gulp.task('watch', function() {
    gulp.watch('source/js/*.js', ['lint', 'scripts']);
    gulp.watch('source/css/*.scss', ['sass']);
});

// Default Task
gulp.task('default', ['lint', 'sass', 'scripts']);