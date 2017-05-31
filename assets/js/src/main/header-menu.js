/*
 *   Header Menu
 */

( function( window ) {
	'use strict';
	var document = window.document;

    var headerMenu = {

        node: document.querySelector('.site-menu'),

        init: function() {
            headerMenu.toggles();
            headerMenu.hoverColors();
        },

        toggles: function() {

            var menuToggles = document.querySelectorAll( '.js-menu-toggle' ),
                body = document.querySelector( 'body', true ),
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

        },

        hoverColors: function() {
            var timeout = null,
                links = document.querySelectorAll('.header-primary-menu .menu-item a');

            for ( var i=0; links.length > i; i++ ) {
                links[i].addEventListener('mouseover', onMouseover);
                links[i].addEventListener('mouseout', onMouseout);
            }

            function onMouseover(e){
                var text = e.target.innerText.toLowerCase();
                headerMenu.node.setAttribute( 'data-background', text );
            }
            function onMouseout(e){
                headerMenu.node.setAttribute( 'data-background', '' );
            }
        },

    };

    hsc.domReady( headerMenu.init );

} )( this );