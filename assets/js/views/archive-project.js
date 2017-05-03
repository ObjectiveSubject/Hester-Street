/*
 *   Archive Project
 */

( function( window ) {
	'use strict';
	var document = window.document;

    if ( ! window.projectFilterData ) return;

    mapboxgl.accessToken = 'pk.eyJ1Ijoib2JqZWN0aXZlc3ViamVjdCIsImEiOiJPY25wYWRjIn0.AFZPHessR_DGefRkzPilDA';

    Vue.component( 'archive-map', {

        template: '<div id="archive-project-map" class="sidebar-map"></div>',
        props: ['projects'],
        data: function(){
            return {
                map: false,
                mapCenter: [-73.98270130711586, 40.72701126185467], // manhattan
                mapZoom: 11,
                scrollMagicController: false
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
                    _this.moveMapTo(project);
                } );
                scene.on( "leave", function(event){
                    el.className = el.className.split("is-active").join("");
                } );

            },

            moveMapTo: function(project) {
                var geoJsonString = project.geojson;
                if ( ! geoJsonString ) return;
                var geoJson = JSON.parse(geoJsonString);

                this.updateSource( "project-features", geoJson );
                this.updateLayers( "project-features" );

                var geoJsonBounds = turf.extent(geoJson);
                this.map.fitBounds(geoJsonBounds, { maxZoom: 14, padding: { top:40, bottom:20, left:20, right:20 } });
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
                        "fill-color": "#BD319F",
                        "fill-opacity": 0.7,
                        "fill-outline-color": "rgba(0,0,0,0)"
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
        template: '#sort-select',
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
        el: '#project-archive-app',
        data: {
            loading: true,
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
            projects: []
        },
        mounted: function(e){
            this.getProjects(this.projectApiUrl);
        },
        watch: {
            currentSort: function(newSort){
                this.sortProjects(newSort);
            }
        },
        computed: {
            hasFilters: function(){
                if ( this.currentFilters.service.length ) return true;
                if ( this.currentFilters.issue.length ) return true;
                if ( this.currentFilters.location.length ) return true;
                if ( this.currentFilters.date ) return true;
                if ( this.currentFilters.status ) return true;
            },
            projectApiUrl: function() {

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

                return [ date, services, issues, status, locations ].join('/');
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
                this.getProjects(this.projectApiUrl);
            },

            toggleDate: function(filter_obj, e) {
                if ( this.currentFilters.date.seconds == filter_obj.seconds ) {
                    this.currentFilters.date = false;
                } else {
                    this.currentFilters.date = filter_obj;
                }
                this.loading = true;
                this.getProjects(this.projectApiUrl);
            },

            toggleStatus: function(filter_obj, e) {
                if ( this.currentFilters.status.slug == filter_obj.slug ) {
                    this.currentFilters.status = false;
                } else {
                    this.currentFilters.status = filter_obj;
                }
                this.loading = true;
                this.getProjects(this.projectApiUrl);
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
                this.getProjects(this.projectApiUrl);
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

            getProjects: function( url, sortKey ) {
                var instance = this;

                sortKey = ( sortKey ) ? sortKey : this.currentSort;
                    
                fetch( HSC.api + '/projects/' + url )
                    .then(function(response){
                        return response.json();
                    })
                    .then(function(json){
                        instance.projects = json;
                        instance.loading = false;
                        instance.sortProjects(sortKey);
                    })
                    .catch(function(ex) {
                        console.log('Project fetch failed', ex);
                    });
                
            }

        }
    });

})(this);