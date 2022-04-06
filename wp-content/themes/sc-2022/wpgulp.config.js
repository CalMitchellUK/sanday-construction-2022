/**
 * WPGulp Configuration File
 *
 * 1. Edit the variables as per your project requirements.
 * 2. In paths you can add <<glob or array of globs>>.
 *
 * @package WPGulp
 */

// Project options.

// Local project URL of your already running WordPress site.
// > Could be something like "wpgulp.local" or "localhost"
// > depending upon your local WordPress setup.
const projectURL = 'http://localhost/_cm/sanday-construction-2022/';

// Theme/Plugin URL. Leave it like it is; since our gulpfile.js lives in the root folder.
const productURL = './';
const browserAutoOpen = false;
const injectChanges = true;

// >>>>> Style options.
// Path to main .scss file.
const cssCustomSRC = './assets/css/custom/*.css';
const cssVendorSRC = './assets/css/vendor/*.css';
const tailwindSRC = './tailwind.config.js';

// Path to place the compiled CSS file. Default set to root folder.
const styleDestination = './css/';

// Available options → 'compact' or 'compressed' or 'nested' or 'expanded'
const outputStyle = 'compact';
const errLogToConsole = true;
const precision = 10;

// JS Vendor options.

// Path to JS files.
const jsCustomSRC = './assets/js/custom/*.js';
const jsVendorSRC = './assets/js/vendor/*.js';

// Path to place the compiled JS custom scripts file.
const jsDestination = './js/';

// Images options.

// Source folder of images which should be optimized and watched.
// > You can also specify types e.g. raw/**.{png,jpg,gif} in the glob.
const imgSRC = './assets/img/**/*';

// Destination folder of optimized images.
// > Must be different from the imagesSRC folder.
const imgDST = './img/';

// Path to all PHP files.
const watchPhp = './**/*.php';

// >>>>> Zip file config.
// Must have.zip at the end.
const zipName = 'file.zip';

// Must be a folder outside of the zip folder.
const zipDestination = './../'; // Default: Parent folder.
const zipIncludeGlob = ['./**/*']; // Default: Include all files/folders in current directory.

// Default ignored files and folders for the zip file.
const zipIgnoreGlob = [
	'!./{node_modules,node_modules/**/*}',
	'!./.git',
	'!./.svn',
	'!./gulpfile.babel.js',
	'!./wpgulp.config.js',
	'!./tailwind.config.js',
	'!./.eslintrc.js',
	'!./.eslintignore',
	'!./.editorconfig',
	'!./phpcs.xml.dist',
	'!./vscode',
	'!./package.json',
	'!./package-lock.json',
	'!./yarn.json',
	'!./yarn.lock',
	'!./assets/**/*',
	'!./assets',
	'!./safelist.txt',
];

// >>>>> Translation options.
// Your text domain here.
const textDomain = 'WPGULP';

// Name of the translation file.
const translationFile = 'WPGULP.pot';

// Where to save the translation files.
const translationDestination = './languages';

// Package name.
const packageName = 'WPGULP';

// Where can users report bugs.
const bugReport = 'https://AhmadAwais.com/contact/';

// Last translator Email ID.
const lastTranslator = 'Ahmad Awais <your_email@email.com>';

// Team's Email ID.
const team = 'AhmadAwais <your_email@email.com>';

// Export.
module.exports = {
	projectURL,
	productURL,
	browserAutoOpen,
	injectChanges,
	cssCustomSRC,
	cssVendorSRC,
	tailwindSRC,
	styleDestination,
	outputStyle,
	errLogToConsole,
	precision,
	jsCustomSRC,
	jsVendorSRC,
	jsDestination,
	imgSRC,
	imgDST,
	watchPhp,
	zipName,
	zipDestination,
	zipIncludeGlob,
	zipIgnoreGlob,
	textDomain,
	translationFile,
	translationDestination,
	packageName,
	bugReport,
	lastTranslator,
	team,
};
