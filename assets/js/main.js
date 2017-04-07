/*! Hester Street Collaborative - v1.0.0
 * http://hesterstreet.org/
 * Copyright (c) 2017; * Licensed GPLv2+ */
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
( function( window ) {
	'use strict';
	var document = window.document;

    hsc.domReady(function(){
        var html = document.querySelector('html');
        if ( html ) html.className = html.className.split('no-js').join('');
    });

} )( this );