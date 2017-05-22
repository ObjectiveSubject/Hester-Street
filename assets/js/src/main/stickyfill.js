/*
 *   Polyfill for position:sticky
 */ 

( function( window ) {
	'use strict';
	var document = window.document;

    hsc.domReady(function(){

        if ( ! Stickyfill ) 
            return;
        
        var stickyElements = document.getElementsByClassName('is-sticky');

        for (var i = stickyElements.length - 1; i >= 0; i--) {
            Stickyfill.add(stickyElements[i]);
        }

    });

} )( this );    