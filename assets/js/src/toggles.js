
//   Toggles

( function( window ) {
	'use strict';
	var document = window.document;

    var toggles = {

        init: function() {
            
            toggles.fadeToggles();

        },

        fade: document.querySelectorAll('.js-fade-toggle'),

        fadeToggles: function() {

            if ( toggles.fade.length ) {
                for ( var i=0; toggles.fade.length > i; i++ ) {  
                    toggles.fade[i].addEventListener( 'click', onClick );
                }
            }

            function onClick(e) {
                e.preventDefault();
                var target = document.querySelector(e.target.dataset.target);
                console.log(target);
                TweenLite.fromTo( target, 0.3, { display: 'none', opacity: 0 }, { display: 'block', opacity: 1 } );
            }

        }

    };

    hsc.domReady(function(){
        toggles.init();
    });

} )( this );