/*
 *   Project Timeline
 */

( function( window ) {
	'use strict';
	var document = window.document;

    var app = new Vue({
        el: "#project-timeline",
        data: {
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
            ]
        },
        mounted: function(){
            this.getTimelineItems(177);
        },
        computed: {
            visibleTimelineItems: function(){
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
                var instance = this;

                if ( !id ) return;

                fetch( HSC.api + '/project-timeline/' + id )
                    .then(function(response){
                        return response.json();
                    })
                    .then(function(json){
                        instance.allTimelineItems = json.timeline_items;
                        instance.loading = false;
                    })
                    .catch(function(ex) {
                        console.log('Project Timeline fetch failed', ex);
                    });
                
            }
        }
    });

})(this);