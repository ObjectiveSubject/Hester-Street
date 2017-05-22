module.exports = {
	all: {
		files: {
			'assets/js/main.min.js': ['assets/js/main.js'],
			'assets/js/project.min.js': ['assets/js/project.js'],
			'assets/js/project-timeline.min.js': ['assets/js/project-timeline.js'],
			'assets/js/archive-project.min.js': ['assets/js/archive-project.js'],
			'assets/js/archive-publication.min.js': ['assets/js/archive-publication.js'],
			'assets/js/page-news.min.js': ['assets/js/page-news.js'],
			'assets/js/front-page.min.js': ['assets/js/front-page.js']
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
