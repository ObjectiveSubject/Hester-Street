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
	},
	singleProject: {
		src: [
			'assets/js/views/project.js'
		],
		dest: 'assets/js/project.js'
	},
	projectTimeline: {
		src: [
			'assets/js/views/project-timeline.js'
		],
		dest: 'assets/js/project-timeline.js'
	},
	archiveProject: {
		src: [
			'assets/js/views/archive-project.js'
		],
		dest: 'assets/js/archive-project.js'
	}
};
