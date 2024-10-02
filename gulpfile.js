import { dest, src, watch, series } from 'gulp'
import * as dartSass from 'sass'
import gulpSass from 'gulp-sass'

const sass = gulpSass(dartSass)

const sassOptions = {
    // Otras opciones de Sass
    silenceDeprecations: ['legacy-js-api'],
};

import terser from 'gulp-terser'

export function js(done){
    src('src/js/app.js')
        .pipe(terser())
        .pipe(dest('build/js'))

    done()
}

export function css (done){
    src('src/scss/app.scss', {sourcemaps: true})
        .pipe(sass({
            ...sassOptions,
            outputStyle: 'compressed'
        }).on('error', sass.logError))
        .pipe(dest('build/css',  {sourcemaps: true}))  
        
    done()
}


export function dev(){
    watch('src/scss/**/*.scss', css)
    watch('src/js/**/*.js', js)
}

export default series(js, css, dev)

