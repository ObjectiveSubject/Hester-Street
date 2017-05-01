module.exports = {
	all: {
		files: {
			'assets/js/main.min.js': ['assets/js/main.js'],
			'assets/js/project.min.js': ['assets/js/project.js'],
			'assets/js/archive-project.min.js': ['assets/js/archive-project.js']
		},
		options: {
			banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
			' * <%= pkg.homepage %>\n' +
			' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
			' * Licensed GPLv2+' +
			' */\n',
			mangle: {
				except: ['jQuery']
			},
			sourceMap: true
		}
	}
};
