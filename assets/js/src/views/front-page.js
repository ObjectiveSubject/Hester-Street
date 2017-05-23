/*
 * Front Page
 */

(function(window) {

    var scrollMagicController = new ScrollMagic.Controller(),
        element = document.querySelector('.site-content .main-navigation'),
        ms = hsc.getMediaSize();

    // if element doesn't exist, bail
    if ( !element )
        return;
    // if viewport is 'small' or 'default' size, bail
    if ( ms == 'sm' || ms == 'default' )
        return;

    scene = new ScrollMagic.Scene({
        triggerElement: element,
        duration: element.offsetHeight,
        triggerHook: 'onLeave'
    })
    .addTo( scrollMagicController );

    scene.on( 'enter', function(event){
        if ( event.scrollDirection === 'REVERSE' ) {
            hideMenuIcon();
        }
    } );

    scene.on( 'leave', function(event){
        if ( event.scrollDirection === 'FORWARD' ) {
            showMenuIcon();
        }
    } );

    function showMenuIcon() {
        var menuIcon = document.querySelector('.site-content .menu-ui');
        menuIcon.className = menuIcon.className.split('is-hidden').join('');
    }

    function hideMenuIcon() {
        var menuIcon = document.querySelector('.site-content .menu-ui');
        menuIcon.className += ' is-hidden';
    }

})(this);
