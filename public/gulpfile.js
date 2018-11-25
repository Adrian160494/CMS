var gulp = require('gulp');

var browsersync = require('browser-sync');

var sass = require('gulp-sass');

gulp.task('server',function () {

    gulp.watch('./../resources/assets/sass/*.scss',['sass']);
});

gulp.task('reload',function () {
    browsersync.reload();
});

gulp.task('sass',function () {
    return gulp.src('./../resources/assets/sass/*.scss')
        .pipe(sass().on('error',sass.logError))
        .pipe(gulp.dest('./css'))

});


gulp.task('default',['server']);