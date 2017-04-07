/*! Hester Street Collaborative - v1.0.0
 * http://hesterstreet.org/
 * Copyright (c) 2017; * Licensed GPLv2+ */
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
( function( window ) {
	'use strict';
	var document = window.document;

    hsc.domReady(function(){
        var html = document.querySelector('html');
        if ( html ) html.className = html.className.split('no-js').join('');
    });

} )( this );
//   Every piece of UI that requires javascript should have its own
//   javascript file. Use this file as a template for structuring
//   all JS source files.
 
//   {Document Title}
//   {Description}

// ( function( window, $ ) {
// 	'use strict';
// 	var document = window.document;

//     var objectName = {

//         init: function() {
//             // Do something...
//         }

//     };

//     $(document).ready(function(){
//         objectName.init();
//     });

// } )( this, jQuery );
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