var gulp         = require('gulp');
var sass         = require('gulp-sass');
var plumber      = require('gulp-plumber');
var gulpif       = require('gulp-if');
var concat       = require('gulp-concat');
var concatCss    = require('gulp-concat-css');
var rename       = require('gulp-rename');
var sourcemaps   = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var uglify       = require('gulp-uglify');
var imagemin     = require('gulp-imagemin');
var argv         = require('yargs').argv;
var del          = require('del');
var gulpSequence = require('gulp-sequence').use(gulp);
var zip          = require('gulp-zip');
var browserSync  = require('browser-sync').create();
var symlink     = require('gulp-symlink');
var php         = require('gulp-connect-php');
var fs          = require('fs');
var path = require('path');
require('dotenv').load();

var paths = {
	'bower': './bower_components',
	'assets': './assets',
	'theme': './theme'
}

var configs = {
	'port': 9000,
	'dir': './theme'
}

var isProduction = (argv.yes === undefined) ? false : true;

var sassFoundation = {
	includePaths: [
		paths.bower + '/foundation-sites/scss'
	]
};

if(isProduction) {
	sassFoundation.outputStyle = 'compressed';
}

//Styles
gulp.task('styles', function() {
	gulp.src(paths.assets + '/styles/foundation-sites/foundation-sites.scss')
		.pipe(gulpif(!isProduction, sourcemaps.init()))
		.pipe(plumber())
		.pipe(sass(sassFoundation))
		.pipe(autoprefixer({
	        browsers: ['last 2 versions', 'ie >= 9', 'and_chr >= 2.3']
	    }))
		.pipe(rename('foundation.css'))
		.pipe(gulpif(!isProduction, sourcemaps.write('.')))
		.pipe(gulp.dest(paths.theme + '/css'));

	gulp.src(paths.assets + '/styles/main.scss')
		.pipe(gulpif(!isProduction, sourcemaps.init()))
		.pipe(plumber())
		.pipe(sass(gulpif(isProduction, {outputStyle: 'compressed'})))
		.pipe(autoprefixer({
	        browsers: ['last 10 versions'],
	        cascade: false
	    }))
	    .pipe(gulpif(!isProduction, sourcemaps.write('.')))
	    .pipe(gulp.dest(paths.theme + '/css'));
});

gulp.task('styles-watch', ['styles'], browserSync.reload);

//Scripts
gulp.task('scripts', function() {
	gulp.src(paths.assets + '/scripts/main.js')
		.pipe(gulpif(!isProduction, sourcemaps.init()))
		.pipe(plumber())
		.pipe(gulpif(isProduction, uglify()))
		.pipe(gulpif(!isProduction, sourcemaps.write('.')))
		.pipe(gulp.dest(paths.theme + '/js'));

	gulp.src([
		paths.bower + '/foundation-sites/js/foundation.core.js',
		paths.bower + '/foundation-sites/js/util.*.js',
		paths.bower + '/foundation-sites/js/*.js'
	])	
		.pipe(gulpif(!isProduction, sourcemaps.init()))
		.pipe(plumber())
		.pipe(gulpif(isProduction, uglify()))
		.pipe(concat('foundation.js'))
		.pipe(gulpif(!isProduction, sourcemaps.write('.')))
		.pipe(gulp.dest(paths.theme + '/js'));

	gulp.src(paths.bower + '/what-input/what-input.js')
		.pipe(gulpif(!isProduction, sourcemaps.init()))
		.pipe(plumber())
		.pipe(gulpif(isProduction, uglify()))
		.pipe(gulpif(!isProduction, sourcemaps.write('.')))
		.pipe(gulp.dest(paths.theme + '/js'));
});

gulp.task('scripts-watch', ['scripts'], browserSync.reload);

//Images
gulp.task('images', function () {
    return gulp.src(paths.assets + '/images/*')
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}]
        }))
        .pipe(gulp.dest(paths.theme + '/img'));
});


// PHP Server
gulp.task('serve', function() {
  
	var serverConfig = {
		base: 'public',
		router: path.resolve('./public/router.php')
  };

  php.server(serverConfig, function (){
    browserSync.init({
      proxy: { 
      	target: "localhost:8000",
        reqHeaders: function (config) {
            return {
                //"host":"localhost:" + configs.port
            }
        }
    	},
      port: configs.port,
      open: true,
      watchTask: true,
      snippetOptions: {
      	whitelist: ["**"],
      }
    });
  });
	gulp.watch(paths.assets + '/styles/**/*.scss', ['styles-watch']);
	gulp.watch(paths.assets + '/scripts/**/*.js', ['scripts-watch']);
	gulp.watch('theme/**/*.php').on('change', function () {
		browserSync.reload();
	});
});

// Symblink of themes inside the content
gulp.task('theme-symblink', function () {
  var themePath = 'public/content/themes/' + process.env.THEME_NAME;
  fs.lstat(themePath, function(err, stat){

      // Create symlink only if not exists
      if(stat == 'undefined' || err) {
        return gulp.src('theme').pipe(symlink(themePath));
      } else {
        return console.log('Symlink exists!');
      }
    });
});

//Clean Task
gulp.task('clean', function() {
	del([paths.theme + '/js/**', '!' + paths.theme + '/js', paths.theme + '/css/**', '!' + paths.theme + '/css' ])
});

//Zip Task
gulp.task('zip', function() {
	gulp.src(paths.theme + '/**')
		.pipe(zip('morph.zip'))
		.pipe(gulp.dest(paths.theme));
})

//Production Task
gulp.task('production', gulpSequence('clean', ['styles', 'scripts']));

//Default Task
gulp.task('default', ['styles', 'scripts', 'images', 'theme-symblink', 'serve']);