/*
 *   Project Timeline
 */

( function( window ) {
	'use strict';
	var document = window.document;

    var app = new Vue({
        el: "#project-timeline",
        data: {
            appClassArray: ['is-loading'],
            loading: true,
            stickySidebar: null,
            allTimelineItems: [],
            scrollMagicController: false
        },
        mounted: function(){
            if ( ! projectData || ! projectData.id ) return;
            this.getTimelineItems( projectData.id );

            this.stickySidebar = new Sticky('.project-timeline__sidebar', {
                marginTop: 16,
                stickyFor: 1000,
                stickyContainer: '.project-timeline__sidebar-wrap',
            });
        },
        computed: {
            appClass: function(){
                return this.appClassArray.join(' ');
            },
            visibleTimelineItems: function(){

                var filteredItems = this.allTimelineItems;
                
                return filteredItems;
            }
        },
        watch: {
            visibleTimelineItems: function(){

                // break down scrollmagic controller and rebuild
                if ( this.scrollMagicController ) this.scrollMagicController.destroy();
                setTimeout( this.setupScrollMagic, 100 );
                
                // fire the window 'resize' event in order to update stickySidebar
                if ( this.stickySidebar ) {
                    setTimeout( function() {
                        window.dispatchEvent( new Event('resize') );
                    }, 100 );
                } 
            }
        },
        methods: {
            getTimelineItems: function( id ) {
                var _this = this;

                if ( !id ) return;

                fetch( HSC.api + '/project-timeline/' + id )
                    .then(function(response){
                        return response.json();
                    })
                    .then(function(json){
                        console.log(json);
                        _this.allTimelineItems = json.timeline_items;
                        _this.appClassArray.splice( _this.appClassArray.indexOf('is-loading'), 1 );
                        _this.loading = false;
                    })
                    .catch(function(ex) {
                        console.log('Project Timeline fetch failed', ex);
                    });
                
            },
            setupScrollMagic: function(){

                // if not lg or xl viewport size, bail out
                if ( ['lg', 'xl'].indexOf( hsc.getMediaSize() ) === -1 || ! this.visibleTimelineItems.length ) return;

                this.appClassArray.push('has-scroll-events');

                this.scrollMagicController = new ScrollMagic.Controller();

                var _this = this;

                _this.visibleTimelineItems.forEach(function(item){

                    var el = document.getElementById( item.id ),
                        sidebarEl = document.querySelector('[href="#'+item.id+'"]'),
                        scene = new ScrollMagic.Scene({
                            triggerElement: el,
                            duration: el.offsetHeight,
                        })
                        .addTo( _this.scrollMagicController );
                    
                    scene.on( "enter", function(event){
                        [el, sidebarEl].forEach(function(n){
                            if ( n.className.indexOf("is-active") == -1 ) {
                                n.className += " is-active";   
                            }
                        });
                        
                    } );
                    scene.on( "leave", function(event){
                        [el, sidebarEl].forEach(function(n){
                            n.className = n.className.split("is-active").join("");
                        });
                        
                    } );

                });

            }
        }
    });

})(this);