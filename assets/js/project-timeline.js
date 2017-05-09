/*! Hester Street Collaborative - v1.0.0
 * http://hesterstreet.org/
 * Copyright (c) 2017; * Licensed GPLv2+ */
( function( window ) {
	'use strict';
	var document = window.document;

    var app = new Vue({
        el: "#project-timeline",
        data: {
            loading: true,
            timelineItems: [],
            currentFilterGroup: 'post-type',
            currentPostType: 'all',
            currentDate: 'all',
            filterToggles: [
                { name: 'Post Type', slug: 'post-type' },
                { name: 'Date', slug: 'date' }
            ],
            postTypes: [
                { name: 'Event', slug: 'event' },
                { name: 'Events Recap', slug: 'events_recap' },
                { name: 'Press', slug: 'press' },
                { name: 'Project Kickoff', slug: 'kickoff' },
                { name: 'Project Sign Off', slug: 'sign_off' },
                { name: 'Project Update', slug: 'update' },
                { name: 'Publication', slug: 'publication' }
            ],
            dates: [
                { name: 'Last Month', seconds: (30*24*60*60) },
                { name: 'Last 3 Months', shortName: 'Last 3 Mos.', seconds: ((30*24*60*60)*3) },
                { name: 'Last 6 Months', shortName: 'Last 6 Mos.', seconds: ((30*24*60*60)*6) },
                { name: 'Last Year', seconds: (365*24*60*60) },
                { name: 'Last 3 Years', shortName: 'Last 3 Yrs.', seconds: ((365*24*60*60)*3) }
            ]
        },
        mounted: function(){
            this.getTimelineItems(177);
        },
        methods: {
            toggleFilterGroup: function( group ) {
                this.currentFilterGroup = group.slug;
            },
            getTimelineItems: function( id ) {
                var instance = this;

                if ( !id ) return;

                fetch( HSC.api + '/project-timeline/' + id )
                    .then(function(response){
                        return response.json();
                    })
                    .then(function(json){
                        instance.timelineItems = json.timeline_items;
                        instance.loading = false;
                    })
                    .catch(function(ex) {
                        console.log('Project Timeline fetch failed', ex);
                    });
                
            }
        }
    });

})(this);