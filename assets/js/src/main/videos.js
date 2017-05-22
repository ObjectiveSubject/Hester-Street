/*
 *   Videos
 */ 

( function( window ) {
	'use strict';
	var document = window.document;

    var videos = {

        videoEls: [],

        init: function() {
            
            videoEls = document.querySelectorAll('.js-hsc-video');

            for ( var i=0; videoEls.length > i; i++ ) {
                videos.addClickEvent(i);
            }

        },

        addClickEvent: function(i){
            videoEls[i].addEventListener('click', function(){
                videos.initPlayer(videoEls[i]);
            });
        },

        initPlayer: function(video){
            if ( ! video.dataset ) return;
            
            var url = video.dataset.url,
                callback = video.dataset.callback,
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