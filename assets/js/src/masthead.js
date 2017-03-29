/**
 * Every piece of UI that requires javascript should have its own
 * javascript file. Use this file as a template for structuring
 * all JS source files.
 *
 * {Document Title}
 * {Description}
 */

( function( window, $ ) {
	'use strict';
	var document = window.document;

    var HSCMasthead = {

        init: function() {
            var scrollTop      = $(window).scrollTop(),
                masthead       = $('#masthead'),
                logo           = $('#logo'),
                mastheadHeight = masthead.height(),
                logoHeight     = logo.height(),
                spacing        = mastheadHeight - logoHeight,
                marginTop      = spacing-logoHeight;
            
            if ( scrollTop >= spacing ) {
                logo.css({'position': 'relative','margin-top': marginTop+'px'});
            } else {
                logo.css({'position': 'fixed', 'top': '48px','margin-top': '0'});
            }
        }

    };

    $(window).scroll(function(){
        HSCMasthead.init();
    });

} )( this, jQuery );
