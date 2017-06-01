/*
 *   Sticky elements
 */ 

( function( window ) {
	'use strict';
	var document = window.document;

    hsc.domReady(function(){

        if ( ! Sticky ) 
            return;
        
        new Sticky('.masthead.is-sticky', {
            wrap: false,
            marginTop: 48,
            stickyFor: 768,
            stickyClass: 'is-fixed',
            stickyContainer: '.sidebar-masthead',
        });

    });

} )( this );    