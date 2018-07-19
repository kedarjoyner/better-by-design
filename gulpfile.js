const gulp = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const livereload = require('gulp-livereload');


gulp.task('dev-styles', function() {
    return gulp.src('./scss/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({
        browsers: ['last 2 versions']
    }))
    .pipe(gulp.dest('./css'))
    .pipe(livereload());
});

gulp.task('prod-styles', function() {
    return gulp.src('./scss/**/*.scss')
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(autoprefixer({
        browsers: ['last 2 versions']
    }))
    .pipe(gulp.dest('./css'));
});

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['dev-styles']);
gulp.task('dev', ['dev-styles', 'watch']);
gulp.task('prod', ['prod-styles']);