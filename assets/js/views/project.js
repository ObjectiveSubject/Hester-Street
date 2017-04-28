/*
 * Projects
 */

(function(window) {

    var mapContainer = document.getElementById('map');

    if ( ! mapContainer ) return;
    
    mapboxgl.accessToken = 'pk.eyJ1Ijoib2JqZWN0aXZlc3ViamVjdCIsImEiOiJPY25wYWRjIn0.AFZPHessR_DGefRkzPilDA';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v9',
    });

})(this);
