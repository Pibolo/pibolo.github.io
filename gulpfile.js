var gulp = require('gulp');
var less = require('gulp-less');
var browserSync = require('browser-sync');
var connect = require('gulp-connect-php');


gulp.task('less', function() {
  return gulp.src('assets/less/**/*.less')
    .pipe(less())
    .pipe(gulp.dest('assets/css/'))
    .pipe(browserSync.reload({
      stream: true
    }))
});


gulp.task('watch',['browserSync', 'less'], function(){
  gulp.watch('assets/less/**/*.less', ['less']);
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
