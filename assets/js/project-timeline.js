/*! Hester Street Collaborative - v1.0.0
 * http://hesterstreet.org/
 * Copyright (c) 2017; * Licensed GPLv2+ */
( function( window ) {
	'use strict';
	var document = window.document;

    var app = new Vue({
        el: "#project-timeline",
        data: {
            appClassArray: ['is-loading'],
            loading: true,
            allTimelineItems: [],
            currentFilterGroup: 'post-type',
            currentFilters: {
                postType: 'all',
                date: 'all'
            },
            filterToggles: [
                { name: 'Post Type', slug: 'post-type' },
                { name: 'Date', slug: 'date' }
            ],
            postTypes: [
                { name: 'Event', slug: 'event', type: 'postType' },
                { name: 'Events Recap', slug: 'events_recap', type: 'postType' },
                { name: 'Press', slug: 'press', type: 'postType' },
                { name: 'Project Kickoff', slug: 'kickoff', type: 'postType' },
                { name: 'Project Sign Off', slug: 'sign_off', type: 'postType' },
                { name: 'Project Update', slug: 'update', type: 'postType' },
                { name: 'Publication', slug: 'publication', type: 'postType' }
            ],
            dates: [
                { name: 'Last Month', seconds: (30*24*60*60), type: 'date' },
                { name: 'Last 3 Months', seconds: ((30*24*60*60)*3), type: 'date' },
                { name: 'Last 6 Months', seconds: ((30*24*60*60)*6), type: 'date' },
                { name: 'Last Year', seconds: (365*24*60*60), type: 'date' },
                { name: 'Last 3 Years', seconds: ((365*24*60*60)*3), type: 'date' }
            ],
            scrollMagicController: false
        },
        mounted: function(){
            this.getTimelineItems(177);
        },
        computed: {
            appClass: function(){
                return this.appClassArray.join(' ');
            },
            visibleTimelineItems: function(){
                console.log('computing visibleTimelineItems');

                var postTypeFilter = this.currentFilters.postType,
                    dateFilter = this.currentFilters.date,
                    filteredItems = this.allTimelineItems;
                
                if ( postTypeFilter !== 'all' ) {
                    filteredItems = filteredItems.filter(function(item){
                        return item.type == postTypeFilter.slug;
                    });
                }
                
                if ( dateFilter !== 'all' ) {
                    var now = new Date(),
                        nowSeconds = now.getTime() / 1000,
                        compareToDate = nowSeconds - dateFilter.seconds;

                    filteredItems = filteredItems.filter(function(item){
                        return item.date_unix >= compareToDate;
                    });
                }
                
                

                return filteredItems;
            }
        },
        watch: {
            visibleTimelineItems: function(){
                if ( this.scrollMagicController ) this.scrollMagicController.destroy();
                setTimeout( this.setupScrollMagic, 100 );
            }
        },
        methods: {
            toggleFilterGroup: function( group ) {
                this.currentFilterGroup = group.slug;
            },
            toggleFilter: function( filter_obj ) {
                if ( ! filter_obj.type ) return;
                
                // if filter_obj is different from current filter
                if ( this.currentFilters[filter_obj.type] && this.currentFilters[filter_obj.type].name !== filter_obj.name ) {
                    this.currentFilters[filter_obj.type] = filter_obj;
                } else {
                    this.currentFilters[filter_obj.type] = 'all';
                }
            },
            getTimelineItems: function( id ) {
                var _this = this;

                if ( !id ) return;

                fetch( HSC.api + '/project-timeline/' + id )
                    .then(function(response){
                        return response.json();
                    })
                    .then(function(json){
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
                if ( ['lg', 'xl'].indexOf( hsc.getMediaSize() ) == -1 || ! this.visibleTimelineItems.length ) return;

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