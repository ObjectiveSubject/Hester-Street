/*
 * Project Archives
 */

(function(window) {

    mapboxgl.accessToken = 'pk.eyJ1Ijoib2JqZWN0aXZlc3ViamVjdCIsImEiOiJPY25wYWRjIn0.AFZPHessR_DGefRkzPilDA';

    var projects = document.querySelectorAll('.project');

    var scrollMagicController = new ScrollMagic.Controller();

    var mapContainer = document.getElementById('archive-project-map');
    if ( ! mapContainer ) return;

    // var geoJsonString = mapContainer.dataset.geojson;
    // if ( ! geoJsonString ) return;
    // var geoJson = JSON.parse( geoJsonString );

    var map = new mapboxgl.Map({
        container: 'archive-project-map',
        style: 'mapbox://styles/objectivesubject/cj21fglc3004t2sp199kzw03v',
        center: [-73.98270130711586, 40.72701126185467], // manhattan
        zoom: 11
    });
    map.scrollZoom.disable();
    map.dragRotate.disable();
    map.dragPan.disable();
    map.doubleClickZoom.disable();
    map.touchZoomRotate.disable();

    console.log(map);

    map.on("load", function() {

        for ( var p=0; projects.length > p; p++ ) {
            setupProjectScene(projects[p]);
        }
        
    });

    function setupProjectScene(project) {

        var scene = new ScrollMagic.Scene({
            triggerElement: project,
            duration: project.offsetHeight,
        })
        .addTo(scrollMagicController);
        
        scene.on( "enter", function(event){
            if ( project.className.indexOf("is-active") == -1 ) {
                project.className += " is-active";   
            }
            updateMap(project, event);
        } );
        scene.on( "leave", function(event){
            // console.log(project.className.split("is-active"));
            project.className = project.className.split("is-active").join("");
        } );

    }

    function updateMap(project, event) {
        var geoJsonString = project.dataset.geojson;
        if ( ! geoJsonString ) return;
        var geoJson = JSON.parse(geoJsonString);

        updateSource( "project-features", geoJson );
        updateLayers( "project-features" );

        var geoJsonBounds = turf.extent(geoJson);
        map.fitBounds(geoJsonBounds, { maxZoom: 14, padding: { top:40, bottom:20, left:20, right:20 } });
    }

    function updateSource(id, geoJson){
        if ( map.getSource(id) ) {
            map.removeSource(id);
        }
        map.addSource(id, {"type":"geojson", "data":geoJson} );
    }

    function updateLayers(source) {
        if ( map.getLayer("project-polygons") ) {
            map.removeLayer("project-polygons");
        }
        if ( map.getLayer("project-points") ) {
            map.removeLayer("project-points");
        }

        map.addLayer({
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

        map.addLayer({
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

})(this);
