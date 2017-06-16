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
			'assets/js/src/main/vendor/*.js',
			'assets/js/src/main/prepend/*.js',
			'assets/js/src/main/*.js'
		],
		dest: 'assets/js/main.js'
	},
	pageNews: {
		src: [
			'assets/js/src/views/page-news.js'
		],
		dest: 'assets/js/page-news.js'
	},
	map: {
		src: [
			'assets/js/src/views/map.js'
		],
		dest: 'assets/js/map.js'
	},
	projectTimeline: {
		src: [
			'assets/js/src/views/project-timeline.js'
		],
		dest: 'assets/js/project-timeline.js'
	},
	archiveProject: {
		src: [
			'assets/js/src/views/archive-project.js'
		],
		dest: 'assets/js/archive-project.js'
	},
	archivePublication: {
		src: [
			'assets/js/src/views/archive-publication.js'
		],
		dest: 'assets/js/archive-publication.js'
	}
};
