/*! Hester Street Collaborative - v1.0.0
 * http://hesterstreet.org/
 * Copyright (c) 2017; * Licensed GPLv2+ */
(function(window) {

    var mapContainer = document.getElementById('archive-project-map');

    if ( ! mapContainer ) return;
    
    mapboxgl.accessToken = 'pk.eyJ1Ijoib2JqZWN0aXZlc3ViamVjdCIsImEiOiJPY25wYWRjIn0.AFZPHessR_DGefRkzPilDA';
    var map = new mapboxgl.Map({
        container: 'archive-project-map',
        style: 'mapbox://styles/mapbox/streets-v9',
    });

})(this);
