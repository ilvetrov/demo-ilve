const gulp = require('gulp');
const log = require('gulplog');
const browserify = require('browserify');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const uglify = require('gulp-uglify-es').default;
const autoprefixer = require('gulp-autoprefixer');
const plumber = require('gulp-plumber');
const fs = require('fs');
const chmod = require('gulp-chmod');
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');
const imagemin = require('gulp-imagemin');
const imageminJpegRecompress = require('imagemin-jpeg-recompress');
const pngquant = require('imagemin-pngquant');
const glob = require('glob');
const watchify = require('watchify');
const color = require('./libs/terminal-color');
const { getFileName } = require('./libs/get-file-name');
const babelify = require('babelify');

//Tasks

exports.default = function (done) {
	console.log('Hello, Gulp!');
	done();
}

class SourceToPublic {
	static cssRoutes = [];

	constructor(pathPrefix = '', name = 'default') {
		this.pathPrefix = pathPrefix;
		this.name = name;

		SourceToPublic.cssRoutes.push(this.pathPrefix + 'source/scss/**/*.scss');
	}

	css = () => {
		return gulp.src(this.pathPrefix + 'source/scss/*.scss')
		.pipe(plumber())
		.pipe(sass().on('error', sass.logError))
		.pipe(autoprefixer())
		.pipe(cleanCSS())
		.pipe(gulp.dest(this.pathPrefix + 'public/assets/css'));
	}

	getJs = () => {
		return glob.sync(this.pathPrefix + 'source/js/*.js');
	}
	
	jsDev = (entries = this.getJs()) => {

		for (let i = 0; i < entries.length; i++) {
			const entryPath = entries[i];
			const entryName = entryPath.split('/')[entryPath.split('/').length - 1];
			
			const watchifyBuild = watchify(browserify({
				entries: entryPath,
				debug: true,
				cache: {},
				packageCache: {}
			})
			.transform(babelify, {
				parserOpts: {
					sourceType: 'module',
					allowImportExportEverywhere: true,
				},
				presets: ['@babel/preset-env']
			}));
			const watchifyBundle = () => {
				return watchifyBuild.bundle()
				.on('error', (data) => {
					log.error(data.annotated);
				})
				.pipe(source(getFileName(entryPath)))
				.pipe(buffer())
				.pipe(chmod(0o666))
				.pipe(gulp.dest(this.pathPrefix + 'public/assets/js/'));
			}

			watchifyBuild.on('update', watchifyBundle);
			watchifyBuild.on('log', (data) => {
				log.info(`Finished '${color.fgCyan}jsDev of ${this.name} - ${entryName}${color.reset}': ` + data);
			});


			watchifyBundle();
		}
	}

	jsMin = () => {
		const entries = glob.sync(this.pathPrefix + 'source/js/*.js');

		for (let i = 0; i < entries.length; i++) {
			const entryPath = entries[i];
			
			const task = browserify({
				entries: entryPath
			})
			.transform(babelify, {
				minified: true,
				parserOpts: {
					sourceType: 'module',
					allowImportExportEverywhere: true,

				},
				comments: false,
				presets: ['@babel/preset-env']
			})
			.bundle()
			.pipe(source(getFileName(entryPath)))
			.pipe(buffer())
			.pipe(plumber())
			.pipe(uglify({
				parse: {
					bare_returns: true,
					ecma: 5,
					module: true
				},
				mangle: {
					keep_classnames: false,
					keep_fnames: false,
					module: true
				},
				ie8: true
			}))
			.pipe(chmod(0o664))
			.pipe(gulp.dest(this.pathPrefix + 'public/assets/js/'));

			if (i === entries.length - 1) {
				return task;
			}
		}
	}

	jsProd = () => {
		return this.jsMin();
	}

	syncImages = (done) => {
		const sourceImages = glob.sync(this.pathPrefix + 'source/img-entry/**');
		const buildImages = glob.sync(this.pathPrefix + 'public/assets/img/**');
	
		for (let i = 0; i < sourceImages.length; i++) {
			const sourceImage = sourceImages[i];
			const regExp = new RegExp(`^${this.pathPrefix}source/img-entry/(.+)`);
			const relativePath = (sourceImage.match(regExp) || [])[1];
			if (relativePath) {
				const buildPath = this.pathPrefix + 'public/assets/img/' + relativePath;
		
				if (buildImages.indexOf(buildPath) === -1) {
					this.minifyImg(sourceImage, () => {
						removeImg(sourceImage);
					});
				} else {
					removeImg(sourceImage);
				}
			}
		}
	
		done();
	}

	minifyImg = (path, callback = null) => {
		const relativeFolderRegExp = new RegExp(`^${this.pathPrefix}source/img-entry/(.+?)/[^/]+$`);
		const relativeFolder = (path.match(relativeFolderRegExp) || [])[1] || '';

		return gulp.src(path)
		.pipe(imagemin([
			imagemin.gifsicle({interlaced: true}),
			imagemin.mozjpeg({progressive: true}),
			imageminJpegRecompress({
				loops: 5,
				min: 65,
				max: 70,
				quality: 'medium'
			}),
			imagemin.svgo(),
			imagemin.optipng({optimizationLevel: 3}),
			pngquant({quality: [0.75, 0.8], speed: 8})
		],{
			verbose: true
		}))
		.pipe(gulp.dest(this.pathPrefix + 'public/assets/img/' + relativeFolder))
		.on('end', () => {
			if (callback) {
				callback();
			}
		});
	}

	prod = () => {
		return new Promise((resolve, reject) => {
			gulp.parallel(this.jsProd, this.css, this.syncImages)(() => {
				resolve();
			})
		});
	}

	watch = () => {
		gulp.parallel(this.css, this.syncImages)();
	
		const startJsEntries = this.getJs();
		this.jsDev(startJsEntries);

		gulp.watch(this.pathPrefix + 'source/js/*').on('add', (path, stats) => {
			const outputPath = this.pathPrefix + path;
			if (startJsEntries.indexOf(outputPath) === -1) {
				startJsEntries.push(outputPath);
				this.jsDev([outputPath]);
			}
		});
		
		gulp.watch(SourceToPublic.cssRoutes).on('change', gulp.series(this.css));
	
		gulp.watch(this.pathPrefix + 'source/img-entry/**').on('add', (path, stats) => {
			this.minifyImg(path, () => {
				removeImg(path);
			});
		});
	}

}

const globalPathPrefix = '';
const front = new SourceToPublic(globalPathPrefix, 'front');

exports.prod = function(done) {
	Promise.all([
		front.prod(),
	])
	.then(() => {
		done();
	});
}

exports.watch = function() {
	front.watch();
}

// Functions
function removeImg(path) {
	fs.lstat(path, (err, stats) => {
		if (err) throw err;
		if (!stats.isDirectory()) {
			fs.unlink(path, (err) => {
				if (err) throw err;
			});
		}
	});
}