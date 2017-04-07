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
        },

    };

    hsc.query = function( selector, getFirst ) {
        if ( getFirst ) {
            return document.querySelector(selector);
        } else {
            return document.querySelectorAll( selector );
        }
    };

    window.hsc = hsc;

} )( this );