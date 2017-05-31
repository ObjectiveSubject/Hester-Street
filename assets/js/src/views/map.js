/*
 * Projects
 */

(function(window) {

    mapboxgl.accessToken = 'pk.eyJ1Ijoib2JqZWN0aXZlc3ViamVjdCIsImEiOiJPY25wYWRjIn0.AFZPHessR_DGefRkzPilDA';

    var mapContainer = document.getElementById('page-map');
    if ( ! mapContainer ) 
        return;

    var geoJsonString = mapContainer.getAttribute('data-geojson');
    if ( ! geoJsonString ) 
        return;
    var geoJson = JSON.parse( geoJsonString );

    if ( ! mapboxgl.supported() )
        return;

    mapContainer.className += 'mapboxgl-supported';
    var map = new mapboxgl.Map({
        container: 'page-map',
        style: 'mapbox://styles/objectivesubject/cj26w6viz00052ss0boe1o2uf',
        center: [-73.98270130711586, 40.72701126185467], // manhattan
        pitch: 0,
        zoom: 11
    });
    map.addControl(new mapboxgl.NavigationControl(), 'top-left');
    map.scrollZoom.disable();
    

    map.on("load", function() {

        window.myMap = map;

        map.addSource("project-features", {"type":"geojson", "data":geoJson} );

        map.addLayer({
            "id": "project-polygons",
            "type": "fill",
            "source": "project-features",
            "paint": {
                "fill-color": "rgba(189,49,159,0.5)",
                "fill-outline-color": "rgba(0,0,0,0)",
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

        map.addLayer({
            "id": "project-lines",
            "type": "line",
            "source": "project-features",
            "paint": {
                "line-color": "#BD319F",
                "line-width": 2
            },
            "filter": ["in", "$type", "LineString", "Polygon"],
        });

        var geoJsonBounds = turf.extent(geoJson);
        map.fitBounds(geoJsonBounds, { maxZoom: 14, padding: { top:40, bottom:20, left:20, right:20 } });

    });

})(this);
