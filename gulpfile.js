var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync');
var connect = require('gulp-connect-php');


gulp.task('sass', function () {
  return gulp.src('assets/sass/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('assets/css'))
    .pipe(browserSync.reload({
      stream: true
    }));
});

gulp.task('watch',['browserSync', 'sass'], function(){
  gulp.watch('./assets/sass/**/*.scss', ['sass']);
  gulp.watch('*.php').on('change', browserSync.reload);
});

gulp.task('browserSync', function(){
  // browserSync({
  //   server: {
  //     baseDir: 'index.php',
  //     proxy: 'localhost:3000'
  //   },
  // })
  connect.server({}, function (){
    browserSync({
      proxy: 'localhost'
    })
  })
});
