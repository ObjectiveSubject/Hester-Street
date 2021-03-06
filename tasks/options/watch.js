module.exports = {
	livereload: {
		files: ['assets/css/*.css', 'assets/js/*.js'],
		options: {
			livereload: true
		}
	},
	css: {
		files: ['assets/css/sass/**/*.scss'],
		tasks: ['css'],
		options: {
			debounceDelay: 500
		}
	},
	js: {
		files: ['assets/js/src/**/*.js', 'assets/js/vendor/**/*.js', 'assets/js/views/**/*.js'],
		tasks: ['js'],
		options: {
			debounceDelay: 500
		}
	}
};
