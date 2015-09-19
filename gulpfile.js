var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    del = require('del');

// CSS
gulp.task('stylesheets', function(){
    return gulp.src('stylesheets/style.scss')
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(gulp.dest('temp/css'))
        .pipe(rename('style.css'))
        .pipe(minifycss())
        .pipe(gulp.dest('./'))
        .pipe(notify({ message: 'Styles task complete' }));
} );

// JSHint
gulp.task('lint', function(){
    return gulp.src('js/source/*.js')
        .pipe(jshint('.jshintrc'))
        .pipe(jshint.reporter('default'))
});

// Scripts
gulp.task('source', function() {
    return gulp.src([
        'js/source/*.js'
    ])
    .pipe(concat('app.js'))
    .pipe(gulp.dest('temp/js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('js'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

gulp.task('vendor', function(){
    return gulp.src([
        'bower_components/Materialize/dist/js/materialize.js'
    ])
    .pipe(concat('vendor.js'))
    .pipe(gulp.dest('temp/js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('js'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

// Clean
gulp.task('clean', function(cb) {
    del(['temp/css', 'temp/js'], cb)
});

// Default task
gulp.task('default', ['clean'], function() {
    gulp.start('stylesheets', 'lint', 'source', 'vendor', 'watch');
});

// Watch
gulp.task('watch', function() {
    // Watch .js files
    gulp.watch(['js/vendor/*.js'], ['vendor']);
    gulp.watch(['js/source/*.js'], ['source']);
	
	// Watch .scss files
    gulp.watch(['stylesheets/*.scss', 'stylesheets/**/*.scss'], ['stylesheets']);
});
