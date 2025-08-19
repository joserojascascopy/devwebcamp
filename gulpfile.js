// CSS
const { src, dest, watch, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');

// Webpack
const webpack = require('webpack-stream');

// JS
const rename = require('gulp-rename');

// IMAGENES
const imagemin = require('gulp-imagemin');
const imageminMozjpeg = require('imagemin-mozjpeg');
const imageminOptipng = require('imagemin-optipng');
const webp = require('gulp-webp');
const avif = require('gulp-avif');

function css() {
    return src('./app/assets/scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
        .pipe(postcss([autoprefixer()]))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('./public/build/css'));
}

function imagenes() {
    return src('./app/assets/img/**/*.{png,jpg}')
        .pipe(imagemin([
            imageminMozjpeg({ quality: 75 }),
            imageminOptipng({ optimizationLevel: 3 })
        ]))
        .pipe(dest('./public/build/img'))
}

function versionWebp() {
    return src('./app/assets/img/**/*.{png,jpg}')
        .pipe(webp({ quality: 50 }))
        .pipe(dest('./public/build/img'))
}

function versionAvif() {
    return src('./app/assets/img/**/*.{png,jpg}')
        .pipe(avif({ quality: 50 }))
        .pipe(dest('./public/build/img'))
}

function js() {
    return src('./app/assets/js/**/*.js')
        .pipe(webpack({
            mode: 'production',
            module: {
                rules: [
                    {
                        test: /\.css$/i,
                        use: ['style-loader', 'css-loader']
                        
                    },
                    
                ]
            },
            watch: true,
            entry: './app/assets/js/script.js',
        }))
        .pipe(sourcemaps.init())
        .pipe(sourcemaps.write('.'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(dest('./public/build/js'))
}

function watchArchivos() {
    watch('./app/assets/scss/**/*.scss', css);
    watch('./app/assets/js/**/*.js', js);
    watch('./app/assets/img/**/*', imagenes);
    watch('./app/assets/img/**/*', versionWebp);
    watch('./app/assets/img/**/*', versionAvif);
}

exports.default = parallel(css, js, imagenes, versionWebp, versionAvif, watchArchivos);