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
            marginTop: 48,
            stickyFor: 768,
            stickyContainer: '.sidebar-masthead',
        });

    });

} )( this );    