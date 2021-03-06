/*! Hester Street Collaborative - v1.0.0
 * http://hesterstreet.org/
 * Copyright (c) 2018; * Licensed GPLv2+ */
( function( window ) {
	'use strict';
	var document = window.document,
        mapboxSupported = true;

    if ( ! window.projectFilterData ) return;

    mapboxgl.accessToken = 'pk.eyJ1Ijoib2JqZWN0aXZlc3ViamVjdCIsImEiOiJPY25wYWRjIn0.AFZPHessR_DGefRkzPilDA';

    if ( ! mapboxgl.supported() ) {
        mapboxSupported = false;
    }

    Vue.component( 'archive-map', {

        template: '<div id="archive-project-map" class="sidebar-map is-sticky"></div>',
        props: ['projects'],
        data: function(){
            return {
                map: false,
                mapCenter: [-73.98270130711586, 40.72701126185467], // manhattan
                mapZoom: 11,
                scrollMagicController: false,
                timeout: false,
                previousProject: null
            };
        },
        mounted: function(){
            
            this.map = new mapboxgl.Map({
                container: 'archive-project-map',
                style: 'mapbox://styles/objectivesubject/cj26w6viz00052ss0boe1o2uf',
                center: this.mapCenter,
                zoom: this.mapZoom
            });
            this.map.scrollZoom.disable();
            this.map.dragRotate.disable();
            this.map.dragPan.disable();
            this.map.doubleClickZoom.disable();
            this.map.touchZoomRotate.disable();

            new Sticky('.sidebar-map', {
                stickyFor: 768,
                stickyContainer: '.section__sidebar',
            });

        },
        watch: {
            projects: function( newProjects ) {

                var _this = this;
                
                if ( this.scrollMagicController ) {
                    this.scrollMagicController.destroy();
                }

                this.scrollMagicController = new ScrollMagic.Controller();

                // set 100ms timeout so project markup has a chance to populate
                setTimeout(function(){
                    if ( newProjects.length ) {
                        for ( var p=0; newProjects.length > p; p++ ) {
                            _this.setupProjectScene( newProjects[p] );
                        }
                    } else {
                        _this.resetMap();
                    }
                    
                },100);
                
            }
        },
        methods: {  

            setupProjectScene: function(project) {

                var _this = this;
                var el = document.getElementById( project.slug );
                var scene = new ScrollMagic.Scene({
                    triggerElement: el,
                    duration: el.offsetHeight,
                })
                .addTo( this.scrollMagicController );
                
                scene.on( "enter", function(event){

                    if ( el.className.indexOf("is-active") == -1 ) {
                        el.className += " is-active";   
                    }
                    if ( event.scrollDirection == "REVERSE" ) {
                        el.className = el.className.split("is-past").join("");
                    }

                    //  delay map move until user is on project for at least 1000ms.
                    if ( _this.timeout ) {
                        clearTimeout( _this.timeout );
                        _this.timeout = setTimeout( function(){
                            _this.moveMapTo(project, _this.previousProject);
                        }, 750 );
                    } else {
                        _this.timeout = setTimeout( function(){
                            _this.moveMapTo(project, _this.previousProject);
                        }, 0 );
                    }
                } );
                scene.on( "leave", function(event){

                    _this.previousProject = project;

                    el.className = el.className.split("is-active").join("");
                    if ( event.scrollDirection == "FORWARD" ) {
                        el.className += " is-past";
                    }
                } );

            },

            moveMapTo: function(project, previous) {
                var fitOptions = { maxZoom: 12, padding: { top:100, bottom:100, left:20, right:20 } },
                    geoJsonString = project.geojson,
                    geoJson, projectBounds;
                
                if ( ! geoJsonString ) 
                    return;
                
                geoJson = JSON.parse(geoJsonString);

                this.updateSource( "project-features", geoJson );
                this.updateLayers( "project-features" );
                                    
                if ( previous ) {
                    var prevGeoJsonString = previous.geojson,
                        prevGeoJson = JSON.parse(prevGeoJsonString),
                        previousCenter = turf.center(prevGeoJson),
                        projectCenter = turf.center(geoJson),
                        distance = turf.distance( projectCenter, previousCenter );

                    // if the distance between two projects is greater than 50km, use instant transition rather than panning/zooming.
                    if ( distance > 50 ) {
                        fitOptions.linear = true;
                    }
                }

                projectBounds = turf.extent(geoJson);
                this.map.fitBounds( projectBounds, fitOptions );
            },

            resetMap: function(){
                if ( this.map.getSource("project-features") ) {
                    this.map.removeSource("project-features");
                }
                if ( this.map.getLayer("project-polygons") ) {
                    this.map.removeLayer("project-polygons");
                }
                if ( this.map.getLayer("project-points") ) {
                    this.map.removeLayer("project-points");
                }
                // this.map.zoomTo(11);
                this.map.easeTo({center:this.mapCenter,zoom:this.mapZoom});
            },

            updateSource: function(id, geoJson) {
                if ( this.map.getSource(id) ) {
                    this.map.removeSource(id);
                }
                this.map.addSource(id, {"type":"geojson", "data":geoJson} );
            },

            updateLayers: function(source) {
                if ( this.map.getLayer("project-polygons") ) {
                    this.map.removeLayer("project-polygons");
                }
                if ( this.map.getLayer("project-points") ) {
                    this.map.removeLayer("project-points");
                }

                this.map.addLayer({
                    "id": "project-polygons",
                    "type": "fill",
                    "source": source,
                    "paint": {
                        "fill-color": "rgba(189,49,159,0.5)",
                        "fill-outline-color": "rgba(0,0,0,0)",
                    },
                    "filter": ["==", "$type", "Polygon"]
                });

                this.map.addLayer({
                    "id": "project-points",
                    "type": "symbol",
                    "source": source,
                    "layout" : {
                        "icon-image": "hsc_pin",
                        "icon-offset": [0,-20],
                        "icon-size": 1,
                        "icon-allow-overlap": true
                    },
                    "paint": {},
                    "filter": ["==", "$type", "Point"],
                });

                this.map.addLayer({
                    "id": "project-lines",
                    "type": "line",
                    "source": source,
                    "paint": {
                        "line-color": "#BD319F",
                        "line-width": 2
                    },
                    "filter": ["in", "$type", "LineString", "Polygon"],
                });
            }

        }

    } );

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

    Vue.component( 'sort-select', {
        template: '<div class="sort-select" v-on:click="toggleSelect" >'+
                        '<p class="u-caps u-mt-3">Sort By</p>'+
                        '<ul class="u-mt-0">'+
                            '<sort-choice v-on:selectchoice="selectSortChoice(\'alpha_desc\')" v-if=" selectIsOpen || choice == \'alpha_desc\' " value="alpha_desc" name="Alphabetical ⬇︎" ></sort-choice>'+
                            '<sort-choice v-on:selectchoice="selectSortChoice(\'alpha_asc\')" v-if=" selectIsOpen || choice == \'alpha_asc\' " value="alpha_asc" name="Alphabetical ⬆︎" ></sort-choice>'+
                            '<sort-choice v-on:selectchoice="selectSortChoice(\'date_start_desc\')" v-if=" selectIsOpen || choice == \'date_start_desc\' " value="date_start_desc" name="Date Started ⬇︎" ></sort-choice>'+
                            '<sort-choice v-on:selectchoice="selectSortChoice(\'date_start_asc\')" v-if=" selectIsOpen || choice == \'date_start_asc\' " value="date_start_asc" name="Date Started ⬆︎" ></sort-choice>'+
                            '<sort-choice v-on:selectchoice="selectSortChoice(\'date_end_desc\')" v-if=" selectIsOpen || choice == \'date_end_desc\' " value="date_end_desc" name="Date Completed ⬇︎" ></sort-choice>'+
                            '<sort-choice v-on:selectchoice="selectSortChoice(\'date_end_asc\')" v-if=" selectIsOpen || choice == \'date_end_asc\' " value="date_end_asc" name="Date Completed ⬆︎" ></sort-choice>'+
                        '</ul>'+
                    '</div>',
        props: ['activeChoice'],
        data: function(){
            return {
                selectIsOpen: false,
            };
        },
        computed: {
            choice: function(){
                return this.activeChoice;
            }
        },
        methods: {
            toggleSelect: function() {
                this.selectIsOpen = this.selectIsOpen ? false : true;
            },
            selectSortChoice: function(value){
                this.$emit('selectsortchoice', value);
            }
        }
    } );

    Vue.component( 'sort-choice', {
        template: '<li class="u-font-gta-extended u-color-hover-green u-transition-300 u-cursor-pointer" v-on:click="selectChoice" v-html="name"></li>',
        props: ['value', 'name'],
        methods: {
            selectChoice: function() {
                this.$emit('selectchoice');
            }
        }
    } );

    var app = new Vue({
        el: '#app',
        template: '#project-archive-template',
        data: {
            loading: true,
            error: false,
            search: "",
            searchTimeout: undefined,
            searchHelper: "",
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
                status: false,
                location: [],
            },
            currentSort: "date_start_desc",
            projectFilterData: projectFilterData,
            projects: [],
            searchedProjects: [],
            mapboxSupported: mapboxSupported,
        },
        beforeMount: function(){
            var preloadFilters = this.$el.getAttribute('data-preload-filters');
            if ( preloadFilters ) {
                preloadFilters = JSON.parse( preloadFilters );
            }
            this.currentFilters = Object.assign( {}, this.currentFilters, preloadFilters );
        },
        mounted: function(e){
            this.getProjects( this.getProjectApiUrl() );
        },
        watch: {
            currentSort: function(newSort){
                this.sortProjects(newSort);
            },
            search: function(newSearch){
                var _this = this;

                _this.searchHelper = "waiting...";
                
                if ( _this.searchTimeout ) {
                    clearTimeout( _this.searchTimeout );
                }
                
                _this.searchTimeout = setTimeout( function() {
                    _this.searchProjects(newSearch);
                    _this.searchTimeout = undefined;
                }, 500);
                
            }
        },
        computed: {
            hasFilters: function(){
                if ( this.currentFilters.service.length ) return true;
                if ( this.currentFilters.issue.length ) return true;
                if ( this.currentFilters.location.length ) return true;
                if ( this.currentFilters.date ) return true;
                if ( this.currentFilters.status ) return true;
            }
        },
        methods: {

            getProjectApiUrl: function(page) {

                page = (page) ? page : 1;

                var services  = computeFilterString(this.currentFilters.service, 'all_services'),
                    issues    = computeFilterString(this.currentFilters.issue, 'all_issues'),
                    locations = computeFilterString(this.currentFilters.location, 'all_locations'),
                    date      = 'all_dates',
                    status    = 'all_status';

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

                return [ date, services, issues, status, locations, page ].join('/');
            },
            
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
                this.getProjects( this.getProjectApiUrl() );
            },

            toggleDate: function(filter_obj, e) {
                if ( this.currentFilters.date.seconds == filter_obj.seconds ) {
                    this.currentFilters.date = false;
                } else {
                    this.currentFilters.date = filter_obj;
                }
                this.loading = true;
                this.getProjects( this.getProjectApiUrl() );
            },

            toggleStatus: function(filter_obj, e) {
                if ( this.currentFilters.status.slug == filter_obj.slug ) {
                    this.currentFilters.status = false;
                } else {
                    this.currentFilters.status = filter_obj;
                }
                this.loading = true;
                this.getProjects( this.getProjectApiUrl() );
            },

            resetFilters: function(){
                this.currentFilters = {
                    service: [],
                    issue: [],
                    date: false,
                    status: false,
                    location: [],
                };
                this.loading = true;
                this.getProjects( this.getProjectApiUrl() );
            },

            toggleSort: function(newSort){
                if ( this.currentSort === newSort ) return;
                this.currentSort = newSort;                
            },

            sortProjects: function(sortKey){
                if ( this.projects.length ) {
                    switch(sortKey) {
                        case 'alpha_desc':
                            this.projects.sort(function(a,b){
                                var titleA = a.title.toUpperCase(); // ignore upper and lowercase
                                var titleB = b.title.toUpperCase(); // ignore upper and lowercase
                                if (titleA > titleB) return -1;
                                if (titleA < titleB) return 1;
                                return 0;
                            });
                            break;
                        case 'alpha_asc':
                            this.projects.sort(function(a,b){
                                var titleA = a.title.toUpperCase(); // ignore upper and lowercase
                                var titleB = b.title.toUpperCase(); // ignore upper and lowercase
                                if (titleA < titleB) return -1;
                                if (titleA > titleB) return 1;
                                return 0;
                            });
                            break;
                        case 'date_start_desc':
                            this.projects.sort(function(a,b){
                                if (a.begin_date > b.begin_date) return -1;
                                if (a.begin_date < b.begin_date) return 1;
                                return 0;
                            });
                            break;
                        case 'date_start_asc':
                            this.projects.sort(function(a,b){
                                if (a.begin_date < b.begin_date) return -1;
                                if (a.begin_date > b.begin_date) return 1;
                                return 0;
                            });
                            break;
                        case 'date_end_desc':
                            this.projects.sort(function(a,b){
                                if (a.end_date > b.end_date) return -1;
                                if (a.end_date < b.end_date) return 1;
                                return 0;
                            });
                            break;
                        case 'date_end_asc':
                            this.projects.sort(function(a,b){
                                if (a.end_date < b.end_date) return -1;
                                if (a.end_date > b.end_date) return 1;
                                return 0;
                            });
                            break;
                        default:
                            return;
                    }
                }
            },

            getProjects: function( url, sortKey, append ) {
                var _this = this;

                _this.loading = true;
                _this.error = false;

                sortKey = ( sortKey ) ? sortKey : this.currentSort;
                    
                fetch( HSC.api + 'hsc-projects/' + url )
                    .then(function(response){
                        return response.json();
                    })
                    .then(function(json){
                        _this.queryData = json.query;
                        if ( append ) {
                            _this.projects = _this.projects.concat(json.posts);
                        } else {
                            _this.projects = json.posts;
                        }
                        _this.loading = false;
                        _this.sortProjects(sortKey);
                    })
                    .catch(function(ex) {
                        _this.loading = false;
                        _this.error = true;
                        console.log('Project fetch failed', ex);
                    });
                
            },

            searchProjects: function( keywords ) {
                
                if ( typeof keywords !== 'string' || keywords.length < 2 ) {
                    this.searchHelper = "";
                    this.searchedProjects = [];
                    return;
                }

                this.searchHelper = "searching...";

                keywords = keywords.replace( / /g, '+' );

                var _this = this;
                
                fetch( HSC.api + 'hsc-projects-search/' + keywords )
                    .then(function(response){
                        return response.json();
                    })
                    .then(function(json){
                        _this.searchedProjects = json.posts;
                        var projectsForm = ( json.posts.length > 1 ) ? 'Projects' : 'Project';
                        _this.searchHelper = ( json.posts.length ) ? json.posts.length + " " + projectsForm + " found" : "Nothing found";
                    })
                    .catch(function(ex) {
                        console.log('Project Search fetch failed: ', ex);
                        _this.searchHelper = "There\'s been an error";
                    });
                
            },

            getMoreProjects: function(){
                var url = this.getProjectApiUrl( this.queryData.current_page + 1 );
                this.getProjects( url, this.currentSort, 'append' );
            },

        }
    });

})(this);