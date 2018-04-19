/*! Hester Street Collaborative - v1.0.0
 * http://hesterstreet.org/
 * Copyright (c) 2018; * Licensed GPLv2+ */
( function( window ) {
	'use strict';
	var document = window.document;

    var app = new Vue({
        el: "#news-feed",
        template: "#news-feed-template",
        data: {
            loading: true,
            queryData: {
                current_page: 1,
                found_posts: 0,
                total_pages: 1
            },
            newsPosts: [],
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
                { name: 'Newsletter', slug: 'newsletter', type: 'postType' },
                { name: 'Press', slug: 'press', type: 'postType' },
                { name: 'News', slug: 'news-category', type: 'postType' },
            ],
            dates: [
                { name: 'Upcoming', seconds: -1, type: 'date' },
                { name: 'Last Month', seconds: (30*24*60*60), type: 'date' },
                { name: 'Last 3 Months', seconds: ((30*24*60*60)*3), type: 'date' },
                { name: 'Last 6 Months', seconds: ((30*24*60*60)*6), type: 'date' },
                { name: 'Last Year', seconds: (365*24*60*60), type: 'date' },
                { name: 'Last 3 Years', seconds: ((365*24*60*60)*3), type: 'date' }
            ]
        },
        mounted: function(){
            this.getNews(this.getNewsUrl());
        },
        methods: {
            toggleFilterGroup: function( group ) {
                this.currentFilterGroup = group.slug;
            },
            toggleFilter: function( filter_obj ) {
                var _this = this;
                if ( ! filter_obj.type ) return;
                
                // if filter_obj is different from current filter
                if ( this.currentFilters[filter_obj.type] && this.currentFilters[filter_obj.type].name !== filter_obj.name ) {
                    this.currentFilters[filter_obj.type] = filter_obj;
                } else {
                    this.currentFilters[filter_obj.type] = 'all';
                }

                setTimeout(function(){
                    _this.getNews( _this.getNewsUrl() );
                }, 100);
            },
            getNewsUrl: function(page){

                page = (page) ? page : 1;

                var date = 'all_dates',
                    postTypes = 'all_post_types',
                    categories = 'all_categories';

                if ( this.currentFilters.date !== 'all' ) {
                    var now = new Date(),
                        nowSeconds = now.getTime() / 1000;
                    
                    date = nowSeconds - this.currentFilters.date.seconds;
                }

                if ( this.currentFilters.postType !== 'all' ) {
                    if ( this.currentFilters.postType.slug == 'event' ) {
                        postTypes = 'event';
                    } else {
                        postTypes = 'post';
                        categories = this.currentFilters.postType.slug;
                    }
                }

                return [date, postTypes, categories, page].join('/');

            },
            getNews: function( url, append ) {
                var _this = this;

                this.loading = true;

                fetch( HSC.api + '/posts-events/' + url )
                    .then(function(response){
                        return response.json();
                    })
                    .then(function(json){
                        _this.queryData = json.query;
                        if ( append ) {
                            _this.newsPosts = _this.newsPosts.concat(json.posts);
                        } else {
                            _this.newsPosts = json.posts;
                        }
                        _this.loading = false;
                    })
                    .catch(function(ex) {
                        console.log('Posts fetch failed', ex);
                    });
                
            },
            getMorePosts: function(){
                var url = this.getNewsUrl(this.queryData.current_page + 1);
                this.getNews( url, 'append' );
            }
        }
    });

})(this);