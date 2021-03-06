/*
 *   Videos
 */ 

( function( window ) {
	'use strict';
	var document = window.document;

    var videos = {

        nodes: [],

        init: function() {
            
            videos.nodes = document.querySelectorAll('.js-hsc-video');

            for ( var i=0; videos.nodes.length > i; i++ ) {
                videos.addClickEvent(i);
            }

        },

        addClickEvent: function(i){
            videos.nodes[i].addEventListener('click', function(){
                videos.initPlayer(videos.nodes[i]);
            });
        },

        initPlayer: function(video){
            
            var url = video.getAttribute('data-url'),
                callback = video.getAttribute('data-callback'),
                source,
                id,
                html;

            if ( ! url ) return;

            if ( url.indexOf('vimeo.com/') > -1 ) {
                source = 'vimeo.com';
            } else if ( url.indexOf('youtu.be/') > -1 ) {
                source = 'youtu.be';
            } else {
                return;
            }

            id = url.split(source + '/')[1];
            switch ( source ) {
                case 'vimeo.com':
                    html = '<iframe src="https://player.vimeo.com/video/'+id+'?autoplay=1&title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
                    break;
                case 'youtu.be':
                    html = '<iframe width="640" height="360" src="https://www.youtube.com/embed/'+id+'" frameborder="0" allowfullscreen></iframe>';
                    break;
            }
            
            video.className = video.className.split('video--preload').join(' video--loaded ');
            video.innerHTML = html;

            if ( callback ) {
                videos[callback]();
            }
        },

        removeBadge: function() {
            var badge = document.querySelector('.badge');
            badge.className += ' is-displaced';
        }

    };

    hsc.domReady(function(){
        videos.init();
    });

} )( this );    