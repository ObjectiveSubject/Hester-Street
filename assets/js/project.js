/*! Hester Street Collaborative - v1.0.0
 * http://hesterstreet.org/
 * Copyright (c) 2017; * Licensed GPLv2+ */
(function(window) {

    mapboxgl.accessToken = 'pk.eyJ1Ijoib2JqZWN0aXZlc3ViamVjdCIsImEiOiJPY25wYWRjIn0.AFZPHessR_DGefRkzPilDA';

    var mapContainer = document.getElementById('map');
    if ( ! mapContainer ) return;

    var geoJsonString = mapContainer.dataset.geojson;
    if ( ! geoJsonString ) return;
    var geoJson = JSON.parse( geoJsonString );

    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/objectivesubject/cj21fglc3004t2sp199kzw03v',
        center: [-73.98270130711586, 40.72701126185467], // manhattan
        zoom: 11
    });
    map.scrollZoom.disable();

    map.on("load", function() {

        map.addSource("project-features", {"type":"geojson", "data":geoJson} );

        map.addLayer({
            "id": "project-polygons",
            "type": "fill",
            "source": "project-features",
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
            "source": "project-features",
            "layout" : {
                "icon-image": "hsc_pin",
                "icon-offset": [0,-20],
                "icon-size": 1,
                "icon-allow-overlap": true
            },
            "paint": {},
            "filter": ["==", "$type", "Point"],
        });

        var geoJsonBounds = turf.extent(geoJson);
        map.fitBounds(geoJsonBounds, { maxZoom: 14, padding: { top:40, bottom:20, left:20, right:20 } });

    });

})(this);
