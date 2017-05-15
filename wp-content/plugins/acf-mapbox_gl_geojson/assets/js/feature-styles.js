var acfMapboxGlGeojson_FeatureStyles = [

    // red: #ff685d
    // magenta: #BD319F

    // POINTS
    // |
    // |-- ACTIVE
    {
        'id': 'active-points',
        'type': 'circle',
        'filter': ['all', ['==', '$type', 'Point'], ['==', 'meta', 'feature'], ['==', 'active', 'true']],
        'paint': { 'circle-color': 'rgba(0,0,0,0)', 'circle-radius': 10, 'circle-stroke-width': 2, 'circle-stroke-color': '#ff685d' }
    },
    // |
    // |-- INACTIVE
    {
        'id': 'inactive-points',
        'type': 'circle',
        'filter': ['all', ['==', '$type', 'Point'], ['==', 'meta', 'feature'], ['==', 'active', 'false']],
        'paint': { 'circle-color': 'rgba(0,0,0,0)', 'circle-radius': 10, 'circle-stroke-width': 2, 'circle-stroke-color': '#000000' }
    },
    
    // LINESTRINGS
    // |
    // |-- ACTIVE
    {
        "id": "active-lines",
        "type": "line",
        "filter": ["all", ["==", "$type", "LineString"], ["!=", "mode", "static"]],
        "layout": {
          "line-cap": "round",
          "line-join": "round"
        },
        "paint": {
          "line-color": "#ff685d",
          "line-dasharray": [0.2, 2],
          "line-width": 2
        }
    },
    // |
    // |-- INACTIVE
    {
        "id": "inactive-lines",
        "type": "line",
        "filter": ["all", ["==", "$type", "LineString"], ["==", "mode", "static"]],
        "layout": {
          "line-cap": "round",
          "line-join": "round"
        },
        "paint": {
          "line-color": "#BD319F",
          "line-width": 2
        }
    },

];