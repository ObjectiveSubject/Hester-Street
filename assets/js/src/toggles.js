
//   Toggles

( function( window ) {
	'use strict';
	var document = window.document;

    var toggles = {

        init: function() {
            
            toggles.fadeToggles();
            toggles.classToggles();

        },

        fade: document.querySelectorAll('.js-fade-toggle'),
        class: document.querySelectorAll('.js-class-toggle'),

        fadeToggles: function() {

            if ( toggles.fade.length ) {
                for ( var i=0; toggles.fade.length > i; i++ ) {  
                    toggles.fade[i].addEventListener( 'click', onClick );
                }
            }

            function onClick(e) {
                e.preventDefault();
                var target = document.querySelector(e.target.dataset.target);
                TweenLite.fromTo( target, 0.3, { display: 'none', opacity: 0 }, { display: 'block', opacity: 1 } );
            }

        },

        classToggles: function() {
            
            var event = 'click',
                classEvents = {
                    click: function(e) {
                        e.preventDefault();
                        var targets = document.querySelectorAll(e.target.dataset.target);
                        var className = e.target.dataset.class;
                        if ( targets.length ) {
                            for ( var t=0; targets.length > t; t++ ) {
                                if  ( targets[t].className.indexOf(className) > -1 ) {
                                    TweenLite.set(targets[t], { className:'-=' + className } );
                                } else {
                                    TweenLite.set(targets[t], { className:'+=' + className } );
                                }
                            }
                        }
                    }
                };

            if ( toggles.class.length ) {
                for ( var i=0; toggles.class.length > i; i++ ) {  
                    event = toggles.class[i].dataset.event || event;
                    toggles.class[i].addEventListener( event, classEvents[event] );
                }
            }

        }

    };

    hsc.domReady(function(){
        toggles.init();
    });

} )( this );