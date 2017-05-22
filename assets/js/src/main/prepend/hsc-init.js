/**
 * Globals
 * Global variables and functions that will be available to scripts in the js/src/ directory
 */

( function( window ) {
	'use strict';
    var document = window.document;

    var hsc = {

        // fire callback when DOM is ready
        domReady: function(callback) {
            if ( document.readyState === "interactive" || document.readyState === "complete" ) {
                callback();
            } else {
                document.addEventListener( "DOMContentLoaded", callback );
            }
        },

        // detect media size from CSS
        getMediaSize: function( elem ) {
    		elem = ( elem ) ? elem : 'body';
    		return window.getComputedStyle( document.querySelector( elem ), '::before' ).getPropertyValue( 'content' ).replace(/"/g, "").replace(/'/g, "");
    	},

    };

    hsc.query = function( selector, getFirst ) {
        if ( getFirst ) {
            return document.querySelector(selector);
        } else {
            return document.querySelectorAll( selector );
        }
    };

    hsc.domReady(function(){
        var html = document.querySelector('html');
        if ( html ) html.className = html.className.split('no-js').join('js');
    });

    window.hsc = hsc;

} )( this );