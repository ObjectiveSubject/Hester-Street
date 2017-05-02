/*
 *   Project Filters
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
                scrollMagicController: false
            };
        },
        mounted: function(){
            
            this.map = new mapboxgl.Map({
                container: 'archive-project-map',
                style: 'mapbox://styles/objectivesubject/cj21fglc3004t2sp199kzw03v',
                center: [-73.98270130711586, 40.72701126185467], // manhattan
                zoom: 11
            });
            this.map.scrollZoom.disable();
            this.map.dragRotate.disable();
            this.map.dragPan.disable();
            this.map.doubleClickZoom.disable();
            this.map.touchZoomRotate.disable();

        },
        watch: {
            projects: function(projects) {

                console.log(projects);
                var _this = this;
                
                if ( this.scrollMagicController ) {
                    this.scrollMagicController.destroy();
                }

                this.scrollMagicController = new ScrollMagic.Controller();

                // set 100ms timeout so project markup has a chance to populate
                setTimeout(function(){
                    for ( var p=0; projects.length > p; p++ ) {
                        _this.setupProjectScene(projects[p]);
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

    var app = new Vue({
        el: '#project-archive-app',
        data: {
            currentFilterGroup: "services",
            projectFilterData: projectFilterData,
            // map: new ProjectsArchiveMap(),
            projects: []
        },
        mounted: function(e){
            this.getProjects();
        },
        methods: {
            
            toggleFilterGroup: function( toggle, e ){
                this.currentFilterGroup = toggle.slug;
            },

            addFilter: function( filter, e ){
                // console.log(filter);
                this.projects.shift();
            },

            removeFilter: function( filter, e ){
                // console.log(filter);
            },

            getProjects: function( params ) {
                var instance = this;
                var defaults = {
                        startDate: 'all_dates',
                        services: 'all_services',
                        issues: 'all_issues',
                        status: 'all_status',
                        locations: 'all_locations'
                    };
                params = Object.assign( defaults, params );
                    
                fetch( HSC.api + '/projects/' + [params.startDate, params.services, params.issues, params.status, params.locations].join('/') )
                    .then(function(response){
                        return response.json();
                    })
                    .then(function(json){
                        instance.projects = json;
                        // instance.map.update();
                    })
                    .catch(function(ex) {
                        console.log('Project fetch failed', ex);
                    });
                
            }

        }
    });

})(this);