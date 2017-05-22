
//   Toggles

( function( window ) {
	'use strict';
	var document = window.document;

    var toggles = {

        init: function() {
            
            toggles.classToggles();

        },

        class: document.querySelectorAll('.js-class-toggle'),

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
                                    targets[t].className.split(className).join('');
                                } else {
                                    targets[t].className = targets[t].className + ' ' + className;
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