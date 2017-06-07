/*
 *   Archive Project
 */

( function( window ) {
	'use strict';
	var document = window.document;

    if ( ! window.publicationFilterData ) return;

    Vue.component( 'filter-term', {
        template: '<li class="list__item filter-group__item" v-bind:class="{ \'is-active\' : active }" v-on:click="select">{{ filterObj.name }}</li>',
        props: [ 'filterObj', 'isActive' ],
        data: function() {
            return {
                active: this.isActive
            };
        },
        watch: {
            isActive: function(newVal){
                this.active = newVal;
            }
        },
        methods: {
            select: function(){
                this.$emit('select');
            }
        }
    } );

    var app = new Vue({
        el: '#publication-archive-app',
        template: '#publication-archive-template',
        data: {
            loading: true,
            queryData: {
                current_page: 1,
                found_posts: 0,
                total_pages: 1
            },
            currentFilterGroup: "service",
            currentFilters: {
                service: [],
                issue: [],
                date: false,
            },
            publicationFilterData: publicationFilterData,
            publications: []
        },
        mounted: function(e){
            this.getPublications(this.getPublicationApiUrl());
        },
        computed: {
            hasFilters: function(){
                if ( this.currentFilters.service.length ) return true;
                if ( this.currentFilters.issue.length ) return true;
                if ( this.currentFilters.date ) return true;
            }
        },
        methods: {
            
            toggleFilterGroup: function( toggle, e ){
                this.currentFilterGroup = toggle.slug;
            },

            toggleFilter: function( filter_obj, e ){
                var filterIndex = this.currentFilters[filter_obj.taxonomy].indexOf(filter_obj.slug);
                if ( filterIndex > -1 ) {
                    this.currentFilters[filter_obj.taxonomy].splice(filterIndex, 1);
                } else {
                    this.currentFilters[filter_obj.taxonomy].push(filter_obj.slug);
                }
                this.loading = true;
                this.getPublications(this.getPublicationApiUrl());
            },

            toggleDate: function(filter_obj, e) {
                if ( this.currentFilters.date.seconds == filter_obj.seconds ) {
                    this.currentFilters.date = false;
                } else {
                    this.currentFilters.date = filter_obj;
                }
                this.loading = true;
                this.getPublications(this.getPublicationApiUrl());
            },

            resetFilters: function(){
                this.currentFilters = {
                    service: [],
                    issue: [],
                    date: false,
                };
                this.loading = true;
                this.getPublications(this.getPublicationApiUrl());
            },

            getPublicationApiUrl: function(page) {

                page = (page) ? page : 1;

                var services  = computeFilterString(this.currentFilters.service, 'all_services'),
                    issues    = computeFilterString(this.currentFilters.issue, 'all_issues'),
                    date      = 'all_dates';

                if ( this.currentFilters.date ) {
                    var now = new Date(),
                        nowSeconds = now.getTime() / 1000;
                    
                    date = nowSeconds - this.currentFilters.date.seconds;
                }

                if ( this.currentFilters.status ) {
                    status = this.currentFilters.status.slug;
                }

                function computeFilterString(filterArray, default_val){
                    var str = [];
                    if ( filterArray.length ) {
                        filterArray.forEach(function(value, key){
                            str.push(value);
                        });
                        return str.join('+');
                    } else {
                        return default_val;
                    }
                }

                return [ date, services, issues, page ].join('/');
            },

            getPublications: function( url, append ) {
                var _this = this;

                this.loading = true;
                    
                fetch( HSC.api + 'publications/' + url )
                    .then(function(response){
                        return response.json();
                    })
                    .then(function(json){
                        _this.queryData = json.query;
                        if ( append ) {
                            _this.publications = _this.publications.concat(json.posts);
                        } else {
                            _this.publications = json.posts;
                        }
                        _this.loading = false;
                    })
                    .catch(function(ex) {
                        console.log('Publication fetch failed', ex);
                    });
                
            }

        }
    });

})(this);