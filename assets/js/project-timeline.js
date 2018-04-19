/*! Hester Street Collaborative - v1.0.0
 * http://hesterstreet.org/
 * Copyright (c) 2018; * Licensed GPLv2+ */
( function( window ) {
	'use strict';
	var document = window.document;

    var app = new Vue({
        el: "#project-timeline",
        data: {
            appClassArray: ['is-loading'],
            loading: true,
            allTimelineItems: [],
        },
        mounted: function(){
            if ( ! projectData || ! projectData.id ) return;
            this.getTimelineItems( projectData.id );
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
        methods: {
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
        }
    });

})(this);