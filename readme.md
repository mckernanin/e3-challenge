# E3 Challenge

## Child theme info
A WordPress child theme, featuring Gulp, SASS, and an object-oriented functions.php file. ESLint and Style Lint configuration files are included.

### Setup
You'll need to have node and npm installed.

1. Clone this repository as `wp-content` inside a WordPress install.

2. In the child theme directory `themes/e3challenge/`, run `npm install`

#### Gulp Tasks
Configuration is centrally located in `gulpConfig.json`

Gulp tasks are organized in a modular structure, using 'gulp-load-plugins' and 'gulp-task-loader'. You'll find all tasks other than default in 'gulp-tasks/' following this structure:
```
├── images
│   ├── raster.js
│   └── vector.js
├── lint
│   ├── js.js
│   └── styles.js
├── scripts
│   ├── app.js
│   ├── custom.js
│   └── vendor.js
├── browser-sync.js
└── scss.js
```
Each file in this folder is converted to a task. See existing tasks for proper formatting.

##### Images
These tasks optimize all images in `assets/img/raw/` using either imagemin or svgmin. Subdirectories are respected, `assets/img/upload/` is ignored by default so you can optimize images that you'll upload in to WordPress, without filling up your repository with them.

##### Scripts
These tasks concatenate all scripts in `assets/js/custom/` and `assets/js/vendor/` down to `custom.min.js` and `vendor.min.js`, before finally compiling down to `app.min.js` which includes both of them. Non-minified versions are also available for debugging. All of the custom scripts are wrapped in a jQuery `document.ready()`

##### SASS
This task compiles all non-partial files in `assets/scss/` to the root directory, `style.scss` by default. Sourcemaps are created, and vendor prefixes are automatically included by `gulp-autoprefixer`.

##### Browser Sync
Browser Sync is setup to proxy a development url, as configured in `gulpConfig.json`.

##### Linting
ESLint and Stylelint are both configured with local config files.
