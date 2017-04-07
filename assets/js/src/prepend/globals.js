/**
 * Globals
 * Global variables and functions that will be available to scripts in the js/src/ directory
 */

( function( window ) {
	'use strict';
    var document = window.document;

    var hsc = {

        domReady: function(callback) {
            if ( document.readyState === "interactive" || document.readyState === "complete" ) {
                callback();
            } else {
                document.addEventListener( "DOMContentLoaded", callback );
            }
        }

    };

    window.hsc = hsc;

} )( this );