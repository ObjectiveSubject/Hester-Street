/*! Hester Street Collaborative - v1.0.0
 * http://hesterstreet.org/
 * Copyright (c) 2017; * Licensed GPLv2+ */
// testing if intended behaviour works with current structure

( function( window, $ ) {
	'use strict';
	var document = window.document;

    var HSCMasthead = {

        init: function() {
            var scrollTop      = $(window).scrollTop(),
                element        = $('#masthead'),
                elementHeight  = element.height(),
                elementParent  = element.parent(),
                parentHeight   = elementParent.height(),
                parentOffset   = elementParent.offset().top,
                margin         = parentHeight - elementHeight;
            
            if ( scrollTop <= margin ) {
                element.css({'position': 'fixed','top': parentOffset+'px','margin-top': '0'});
            } else {
                element.css({'position': 'relative','top': 'auto','margin-top': margin+'px'});
            }
        }

    };

    $(window).scroll(function(){
        HSCMasthead.init();
    });

} )( this, jQuery );
