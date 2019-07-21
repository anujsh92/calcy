var gulp = require('gulp');
var pug = require('gulp-pug');
var less = require('gulp-less');
var minifyCSS = require('gulp-csso');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');
var pump = require('pump');

gulp.task('minify-css', function(){
  return gulp.src('assets/sass/*.scss')
    .pipe(less())
    .pipe(minifyCSS())
    .pipe(gulp.dest('assets/'))
});
gulp.task('compress', function (cb) {
  pump([
        gulp.src('assets/sass/*.js'),
        uglify(),
        gulp.dest('assets')
    ],
    cb
  );
});

 
gulp.task('watch', function () {
    // Callback mode, useful if any plugin in the pipeline depends on the `end`/`flush` event
    gulp.watch('assets/**/*.scss', ['minify-css']);
    gulp.watch('assets/**/*.js', ['compress']);
});

gulp.task('default', [ 'minify-css', 'compress', 'watch']);

