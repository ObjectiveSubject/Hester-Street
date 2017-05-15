(function($){
	
	
	function initialize_field( $el ) {

		// SETUP VARIABLES
		var settings = mapbox_gl_geojson_data,
			mapDOM = $el.find('#mapbox-gl-geojson-map'),
        	inputField = $el.find('#mapbox-gl-geojson-field'),
			existingGeoJson = {
				"type": "FeatureCollection",
				"features": []
			};

		// if no access token or map container, bail out
		if ( ! settings.access_token || ! mapDOM.length ) return;
		
		// SETUP THE MAP
		mapboxgl.accessToken = settings.access_token;
		var map = new mapboxgl.Map({
				container: 'mapbox-gl-geojson-map',
				style: settings.style_url,
				center: [settings.center_lng, settings.center_lat], // manhattan
				zoom: settings.zoom
			});

		// CONTROLS
		var draw = new MapboxDraw({
				displayControlsDefault: false,
				controls: {
					"point": true,
					"line_string": true,
					"polygon": true,
					"trash": true
				},
				// styles: acfMapboxGlGeojson_FeatureStyles
			}),
			geocoder = new MapboxGeocoder({
				accessToken: mapboxgl.accessToken
			}); 

			// Add controls to map
			map.addControl(draw, 'top-right');
			map.addControl(geocoder, 'top-left');

		
		// POPULATE MAP WITH EXISTING DATA
        try {
            var existingData = JSON.parse($(inputField).val());
            existingGeoJson = existingData
        } catch (err) {
            setValue( inputField, JSON.stringify(existingGeoJson) );
        }

		map.on("load", function() {

			// IF FEATURES EXIST, DRAW THEM ON THE MAP AND ZOOM TO THEM.
			if ( existingGeoJson.features.length ) {
				draw.add(existingGeoJson);
				map.fitBounds( turf.extent(existingGeoJson), { maxZoom: 14, padding: { top:40, bottom:20, left:20, right:20 } });
			}

			// DRAW, UPDATE, DELETE CALLBACKS
			map.on('draw.create', function(e) {
					existingGeoJson.features.push(e.features[0]);
					setValue( inputField, JSON.stringify(existingGeoJson) );
                })
                .on('draw.update', function(e) {
					var updatedFeature = e.features[0];
					existingGeoJson.features.forEach(function(feature, index){
						if ( feature.id === updatedFeature.id ) {
							feature.geometry = updatedFeature.geometry;
						}
					});
                    setValue( inputField, JSON.stringify( existingGeoJson ) );
                })
				.on('draw.delete', function(e) {
					var deletedFeature = e.features[0];
					existingGeoJson.features = existingGeoJson.features.filter(function(feature){
						return feature.id !== deletedFeature.id;
					});
                    setValue( inputField, JSON.stringify( existingGeoJson ) );
                });
			
		});
		
	}

	// SETS A VALUE ON A TARGET
	function setValue(target, value) {
		if ( target !== undefined && value !== undefined ) {
			$(target).val(value);
		}
	};
	

	// ACF INITIALIZATION STUFF... TOUCH IF YOU DARE...
	if( typeof acf.add_action !== 'undefined' ) {
	
		/*
		*  ready append (ACF5)
		*
		*  These are 2 events which are fired during the page load
		*  ready = on page load similar to $(document).ready()
		*  append = on new DOM elements appended via repeater field
		*
		*  @type	event
		*  @date	20/07/13
		*
		*  @param	$el (jQuery selection) the jQuery element which contains the ACF fields
		*  @return	n/a
		*/
		
		acf.add_action('ready append', function( $el ){
			
			// search $el for fields of type 'mapbox_gl_geojson'
			acf.get_fields({ type : 'mapbox_gl_geojson'}, $el).each(function(){
				
				initialize_field( $(this) );
				
			});
			
		});
		
		
	} else {	
		
		/*
		*  acf/setup_fields (ACF4)
		*
		*  This event is triggered when ACF adds any new elements to the DOM. 
		*
		*  @type	function
		*  @since	1.0.0
		*  @date	01/01/12
		*
		*  @param	event		e: an event object. This can be ignored
		*  @param	Element		postbox: An element which contains the new HTML
		*
		*  @return	n/a
		*/
		
		$(document).on('acf/setup_fields', function(e, postbox){
			
			$(postbox).find('.field[data-field_type="mapbox_gl_geojson"]').each(function(){
				
				initialize_field( $(this) );
				
			});
		
		});
	
	
	}


})(jQuery);
