/*
 *   Initialize
 */

( function( window ) {
	'use strict';
	var document = window.document;

    hsc.domReady(function(){
        var html = document.querySelector('html');
        if ( html ) html.className = html.className.split('no-js').join('js');
    });

} )( this );