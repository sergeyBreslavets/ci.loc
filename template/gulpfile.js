'use strict';


var gulp          = require('gulp'),
    watch         = require('gulp-watch'),
    prefixer      = require('gulp-autoprefixer'),
    uglify        = require('gulp-uglify'),
    sass          = require('gulp-sass'),
    sourcemaps    = require('gulp-sourcemaps'),
    // rigger        = require('gulp-rigger'),  //
    cssmin        = require('gulp-cssnano'),
    imagemin      = require('gulp-imagemin'),
    pngquant      = require('imagemin-pngquant'),
    rimraf        = require('rimraf'),
    browserSync   = require("browser-sync"),
    notify        = require("gulp-notify"),
    concat        = require('gulp-concat'),
    stripDebug    = require('gulp-strip-debug'),
    spritesmith   = require('gulp.spritesmith'),
    reload        = browserSync.reload;
var pkg = require('./package.json');
var version     = pkg.version;
var name        = pkg.name;
var browsers    = pkg.browsers; 


var path = {
    build: { //Тут мы укажем куда складывать готовые после сборки файлы
        html:    'www/',
        js:      'www/assets/js/',
        css:     'www/assets/css/',
        images:  'www/assets/images/',
        fonts:   'www/assets/fonts/',
        fontBs:  'www/assets/fonts/bootstrap/',
        sprite:  'www/assets/images/sprite/',
        spriteScss: 'src/style/' 
    },
    prodaction: { //template
        html:    'www/',
        js:      '../catalog/view/theme/' + name + '/assets/js/',
        css:     '../catalog/view/theme/' + name + '/assets/css/',
        images:  '../catalog/view/theme/' + name + '/assets/images/',
        fonts:   '../catalog/view/theme/' + name + '/assets/fonts/',
        fontBs:  '../catalog/view/theme/' + name + '/assets/fonts/bootstrap/',
        sprite:  '../catalog/view/theme/' + name + '/assets/images/sprite/',
        spriteScss: 'src/style/' 
    }

    ,
    src: { //Пути откуда брать исходники
        html:    'src/html/*.html', //Синтаксис src/*.html говорит gulp что мы хотим взять все файлы с расширением .html
        js:  [     
                 'bower_components/modernizr/modernizr.js',
                 'bower_components/jquery/dist/jquery.js',
                
                 'bower_components/bootstrap-sass/assets/javascripts/bootstrap/transition.js',
                 'bower_components/bootstrap-sass/assets/javascripts/bootstrap/alert.js',
                 'bower_components/bootstrap-sass/assets/javascripts/bootstrap/button.js',
                 'bower_components/bootstrap-sass/assets/javascripts/bootstrap/carousel.js',
                 'bower_components/bootstrap-sass/assets/javascripts/bootstrap/collapse.js',
                 'bower_components/bootstrap-sass/assets/javascripts/bootstrap/dropdown.js',
                 'bower_components/bootstrap-sass/assets/javascripts/bootstrap/modal.js',
                 'bower_components/bootstrap-sass/assets/javascripts/bootstrap/tooltip.js',
                 'bower_components/bootstrap-sass/assets/javascripts/bootstrap/popover.js',
                 'bower_components/bootstrap-sass/assets/javascripts/bootstrap/scrollspy.js',
                 'bower_components/bootstrap-sass/assets/javascripts/bootstrap/tab.js',
                 'bower_components/bootstrap-sass/assets/javascripts/bootstrap/affix.js',
                  'bower_components/jquery-ui/jquery-ui.js',
                  'src/js/partials/jquery.ui.datepicker-ru.js',
        

                 'src/js/main.js'
              ]   ,//В стилях и скриптах нам понадобятся только main файлы
        style:   'src/style/styles.scss',
        images:  'src/images/**/*.*', //Синтаксис images/**/*.* означает - взять все файлы всех расширений из папки и из вложенных каталогов
        fonts:   'src/fonts/**/*.*',
        fontsBs: 'bower_components/bootstrap-sass/assets/fonts/bootstrap/*.*',
        fontsAwesome: 'bower_components/components-font-awesome/fonts/*.*' ,
        sprite:   'src/sprite/*.*'
    },
    watch: { //Тут мы укажем, за изменением каких файлов мы хотим наблюдать
        html:    'src/html/*.html',
        js:      'src/js/**/*.js',
        style:   'src/style/**/*.scss',
        images:  'src/images/**/*.*',
        fonts:   'src/fonts/**/*.*',
        sprite:  'src/sprite/*.*'
    },
    clean: './www/assets'
};

var config = {
    server: {
        baseDir: "./www"
    },
    tunnel: true,
    host: 'gulp_zero',
    port:  8080,
    logPrefix: "Frontend_Devil"
};

// tasks 

gulp.task('sprites', function() {
   var spriteData = 
        gulp.src(path.src.sprite) // путь, откуда берем картинки для спрайта
            .pipe(spritesmith({
                imgName: 'sprite.png',
                cssName: 'sprite.scss',
            }))

    spriteData.css.pipe(gulp.dest(path.prodaction.spriteScss))
    spriteData.img.pipe(gulp.dest(path.prodaction.sprite))
    .pipe(notify({
            title: 'sprite',
            message: 'sprite Complide'

        }));
});



// task html
gulp.task('html:build', function () {
    gulp.src(path.src.html) //Выберем файлы по нужному пути
        // .pipe(rigger()) //Прогоним через rigger
        .pipe(gulp.dest(path.prodaction.html)) //Выплюнем их в папку build  
        .pipe(notify({
            title: 'html',
            message: 'html build Complide'

        }))
        .pipe(reload({stream: true})); //И перезагрузим наш сервер для обновлений
      
});

gulp.task('js:build', function () {
    gulp.src(path.src.js) //Найдем наш main файл
        .pipe(concat('main.js'))
        .pipe(stripDebug())
        .pipe(uglify())
        .pipe(gulp.dest(path.prodaction.js)) //Выплюнем готовый файл в build
        .pipe(notify({
            title: 'js',
            message: 'js build Complide'

        }))
        .pipe(reload({stream: true})); //И перезагрузим сервер
});

gulp.task('style:build', function () {
    gulp.src(path.src.style) //Выберем наш main.scss
        .pipe(sourcemaps.init()) //То же самое что и с js
        .pipe(sass().on('error', sass.logError))//Скомпилируем
        .pipe(prefixer()) //Добавим вендорные префиксы
        .pipe(cssmin()) //Сожмем
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(path.prodaction.css)) //И в build
        .pipe(notify({
            title: 'sass',
            message: 'sass build Complide'

        }))
        .pipe(reload({stream: true}));
});

gulp.task('image:build', function () {
    gulp.src(path.src.images) //Выберем наши картинки
        .pipe(imagemin({ //Сожмем их
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()],
            interlaced: true
        }))
        .pipe(gulp.dest(path.prodaction.images)) //И бросим в build
         .pipe(notify({
            title: 'images',
            message: 'images compress Complide'

        }))
        .pipe(reload({stream: true}));
});

gulp.task('fonts:build', function() {
    gulp.src(path.src.fonts)
        .pipe(gulp.dest(path.prodaction.fonts))
         .pipe(notify({
            title: 'fonts',
            message: 'fonts copy Complide'

        }));
});

gulp.task('fontsbs:build', function() {
    gulp.src([path.src.fontsBs, path.src.fontsAwesome])
        .pipe(gulp.dest(path.prodaction.fontBs))
         .pipe(notify({
            title: 'fonts bs',
            message: 'fonts bs copy Complide'

        }));
});

     



gulp.task('build', [
    'sprites',
    'html:build',
    'js:build',
    'style:build',
    'fonts:build',
    'fontsbs:build',
    'image:build'
]);


gulp.task('watch', function(){
    watch([path.watch.html], function(event, cb) {
        gulp.start('html:build');
    });
    watch([path.watch.style], function(event, cb) {
        gulp.start('style:build');
    });
    watch([path.watch.js], function(event, cb) {
        gulp.start('js:build');
    });
    watch([path.watch.images], function(event, cb) {
        gulp.start('image:build');
    });
    watch([path.watch.fonts], function(event, cb) {
        gulp.start('fonts:build');
    });
    watch([path.watch.sprite], function(event, cb) {
        gulp.start('sprites');
    });
});

gulp.task('webserver', function () {
    browserSync(config);
});

gulp.task('clean', function (cb) {
    rimraf(path.clean, cb);
});

gulp.task('default', [
          'build', 
          // 'webserver',  --нужно сконфигурировать 
          'watch'
]);