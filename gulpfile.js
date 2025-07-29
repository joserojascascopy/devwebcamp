const { src, dest, watch, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');

function css() {
    return src('./app/assets/scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({ style: 'compressed' }).on('error', sass.logError))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('./public/build/css'));
}

function js() {
    return src('./app/assets/js/**/*.js')
        .pipe(dest('./public/build/js'));
}

function watchArchivos() {
    watch('./app/assets/scss/**/*.scss', css);
    watch('./app/assets/js/**/*.js', js);
}

exports.default = parallel(css, js, watchArchivos);