module.exports = {
	options: {
		stripBanners: true,
			banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
		' * <%= pkg.homepage %>\n' +
		' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
		' * Licensed GPLv2+' +
		' */\n'
	},
	main: {
		src: [
			'assets/js/vendor/**/*.js',
			'assets/js/src/prepend/*.js',
			'assets/js/src/*.js'
		],
		dest: 'assets/js/main.js'
	}
};
