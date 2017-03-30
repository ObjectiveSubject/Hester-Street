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
                spacing        = parentHeight - elementHeight,
                marginTop      = spacing - elementHeight;
            
            if ( scrollTop <= spacing ) {
                element.css({'position': 'fixed','top': parentOffset+'px','margin-top': '0'});
            } else {
                element.css({'position': 'relative','margin-top': marginTop+'px'});
            }
        }

    };

    $(window).scroll(function(){
        HSCMasthead.init();
    });

} )( this, jQuery );
