/*
 *   Header Menu
 */

( function( window ) {
	'use strict';
	var document = window.document;

    var headerMenu = {

        init: function() {
            headerMenu.events();
        },

        events: function() {

            var menuToggles = hsc.query( '.js-menu-toggle' ),
                body = hsc.query( 'body', true ),
                onClick = function(e) {
                    e.preventDefault();
                    body.className = (body.className.indexOf('has-open-menu') > -1) ? body.className.split('has-open-menu').join('') : body.className + ' has-open-menu';
                };
                
            if ( menuToggles.length ) {
                for ( var i=0; menuToggles.length > i; i++ ) {
                    var toggle = menuToggles[i];
                    toggle.addEventListener( 'click', onClick );
                }
            }

        }

    };

    hsc.domReady( headerMenu.init );

} )( this );