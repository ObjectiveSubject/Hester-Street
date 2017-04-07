/*! Hester Street Collaborative - v1.0.0
 * http://hesterstreet.org/
 * Copyright (c) 2017; * Licensed GPLv2+ */
( function( window ) {
	'use strict';
    var document = window.document;

    var hsc = {

        domReady: function(callback) {
            document.readyState === "interactive" || document.readyState === "complete" ? callback() : document.addEventListener("DOMContentLoaded", callback);
        }

    };

    window.hsc = hsc;

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