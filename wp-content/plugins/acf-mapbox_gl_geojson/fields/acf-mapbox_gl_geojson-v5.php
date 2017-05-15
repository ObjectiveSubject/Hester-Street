<?php

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


// check if class already exists
if( !class_exists('acf_field_mapbox_gl_geojson') ) :


class acf_field_mapbox_gl_geojson extends acf_field {
	
	
	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function __construct( $settings ) {
		
		/*
		*  name (string) Single word, no spaces. Underscores allowed
		*/
		
		$this->name = 'mapbox_gl_geojson';
		
		
		/*
		*  label (string) Multiple words, can include spaces, visible when selecting a field type
		*/
		
		$this->label = __('Mapbox GL geoJSON', 'acf-mapbox_gl_geojson');
		
		
		/*
		*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
		*/
		
		$this->category = 'basic';
		
		
		/*
		*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
		*/
		
		$this->defaults = array(
			'mbgl_access_token' => '',
			'mbgl_style_url' => 'mapbox://styles/mapbox/light-v9',
			'mbgl_height' => 400,
			'mbgl_zoom' => 11,
			'mbgl_center_lng' => 0,
			'mbgl_center_lat' => 0
		);
		
		
		/*
		*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
		*  var message = acf._e('mapbox_gl_geojson', 'error');
		*/
		
		$this->l10n = array(
			'error'	=> __('Error! Please enter a higher value', 'acf-mapbox_gl_geojson'),
		);
		
		
		/*
		*  settings (array) Store plugin settings (url, path, version) as a reference for later use with assets
		*/
		
		$this->settings = $settings;
		
		
		// do not delete!
    	parent::__construct();
    	
	}
	
	
	/*
	*  render_field_settings()
	*
	*  Create extra settings for your field. These are visible when editing a field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field_settings( $field ) {
		
		/*
		*  acf_render_field_setting
		*
		*  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
		*  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
		*
		*  More than one setting can be added by copy/paste the above code.
		*  Please note that you must also have a matching $defaults value for the field name (height)
		*/

		acf_render_field_setting( $field, array(
			'label'			=> __('Access Token','acf-mapbox_gl_geojson'),
			'instructions'	=> __('Login to your Mapbox account to find your access token','acf-mapbox_gl_geojson'),
			'type'			=> 'text',
			'name'			=> 'mbgl_access_token',
			'required'		=> true
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Style URL','acf-mapbox_gl_geojson'),
			'instructions'	=> __('A Mapbox style URL. You can find your style url at <a href="https://www.mapbox.com/studio/styles/" target="_blank">https://www.mapbox.com/studio/styles/</a>','acf-mapbox_gl_geojson'),
			'type'			=> 'text',
			'name'			=> 'mbgl_style_url',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Height','acf-mapbox_gl_geojson'),
			'instructions'	=> __('Height of the map','acf-mapbox_gl_geojson'),
			'type'			=> 'number',
			'name'			=> 'mbgl_height',
			'prepend'		=> 'px',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Zoom','acf-mapbox_gl_geojson'),
			'instructions'	=> __('The initial zoom level of the map','acf-mapbox_gl_geojson'),
			'type'			=> 'number',
			'name'			=> 'mbgl_zoom',
			'min'			=> '0',
			'max'			=> '22',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Center Longitude','acf-mapbox_gl_geojson'),
			'type'			=> 'number',
			'name'			=> 'mbgl_center_lng',
			'min'			=> '-179.9',
			'max'			=> '179.9',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Center Latitude','acf-mapbox_gl_geojson'),
			'type'			=> 'number',
			'name'			=> 'mbgl_center_lat',
			'min'			=> '-179.9',
			'max'			=> '179.9',
		));

	}
	
	
	
	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field (array) the $field being rendered
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field( $field ) {
		
		
		/*
		*  Review the data of $field.
		*  This will show what data is available
		*/
		
		// echo '<pre>';
		// 	print_r( $field );
		// echo '</pre>';
		
		
		/*
		*  Create a simple text input using the 'height' setting.
		*/
		
		?>
		<script>
			var mapbox_gl_geojson_data = {
				access_token: "<?php echo $field['mbgl_access_token']; ?>",
				style_url: "<?php echo $field['mbgl_style_url']; ?>",
				height: <?php echo $field['mbgl_height']; ?>,
				zoom: <?php echo $field['mbgl_zoom']; ?>,
				center_lng: <?php echo $field['mbgl_center_lng']; ?>,
				center_lat: <?php echo $field['mbgl_center_lat']; ?>
			}
		</script>
		<input id="mapbox-gl-geojson-field" class="mapbox-gl-geojson-field" type="hidden" name="<?php echo esc_attr($field['name']) ?>" value='<?php echo $field['value'] ?>' />
		<div id="mapbox-gl-geojson-map" style="height:<?php echo $field['mbgl_height']; ?>px"></div>
		<?php
	}
	
		
	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add CSS + JavaScript to assist your render_field() action.
	*
	*  @type	action (admin_enqueue_scripts)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function input_admin_enqueue_scripts() {
		
		// vars
		$url = $this->settings['url'];
		$version = $this->settings['version'];
		
		// register & include JS

		wp_register_script( 'acf-input-mapbox_gl_geojson_mapbox_js', 'https://api.mapbox.com/mapbox-gl-js/v0.36.0/mapbox-gl.js' );
        wp_enqueue_script( 'acf-input-mapbox_gl_geojson_mapbox_js' );

		wp_register_script( 'acf-input-mapbox_gl_geojson_turf_js', 'https://api.mapbox.com/mapbox.js/plugins/turf/v2.0.2/turf.min.js', array('acf-input-mapbox_gl_geojson_mapbox_js') );
		wp_enqueue_script( 'acf-input-mapbox_gl_geojson_turf_js' );

        wp_register_script( 'acf-input-mapbox_gl_geojson_mapbox_gl_draw_js', 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v0.17.4/mapbox-gl-draw.js', array('acf-input-mapbox_gl_geojson_mapbox_js') );
        wp_enqueue_script( 'acf-input-mapbox_gl_geojson_mapbox_gl_draw_js' );

		wp_register_script( 'acf-input-mapbox_gl_geojson_mapbox_gl_geocoder_js', 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.1.0/mapbox-gl-geocoder.min.js', array('acf-input-mapbox_gl_geojson_mapbox_js') );
        wp_enqueue_script( 'acf-input-mapbox_gl_geojson_mapbox_gl_geocoder_js' );

		wp_register_script( 'acf-input-mapbox_gl_geojson_styles', "{$url}assets/js/feature-styles.js", array('acf-input'), $version );
		wp_enqueue_script('acf-input-mapbox_gl_geojson_styles');
		wp_register_script( 'acf-input-mapbox_gl_geojson', "{$url}assets/js/input.js", array('acf-input', 'acf-input-mapbox_gl_geojson_styles'), $version );
		wp_enqueue_script('acf-input-mapbox_gl_geojson');
		
		// register & include CSS

		wp_register_style( 'acf-input-mapbox_gl_geojson', "{$url}assets/css/input.css", array('acf-input'), $version );
		wp_enqueue_style('acf-input-mapbox_gl_geojson');

		wp_register_style( 'acf-input-mapbox_gl_geojson_mapbox_gl_css', 'https://api.mapbox.com/mapbox-gl-js/v0.36.0/mapbox-gl.css' );
        wp_enqueue_style( 'acf-input-mapbox_gl_geojson_mapbox_gl_css' );

		wp_register_style( 'acf-input-mapbox_gl_geojson_mapbox_gl_geocoder_css', 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.1.0/mapbox-gl-geocoder.css' );
        wp_enqueue_style( 'acf-input-mapbox_gl_geojson_mapbox_gl_geocoder_css' );

		wp_register_style( 'acf-input-mapbox_gl_geojson_mapbox_gl_draw_css', 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v0.17.4/mapbox-gl-draw.css' );
        wp_enqueue_style( 'acf-input-mapbox_gl_geojson_mapbox_gl_draw_css' );
		
	}
	
	
	
	
	/*
	*  input_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is created.
	*  Use this action to add CSS and JavaScript to assist your render_field() action.
	*
	*  @type	action (admin_head)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	/*
		
	function input_admin_head() {
	
		
		
	}
	
	*/
	
	
	/*
   	*  input_form_data()
   	*
   	*  This function is called once on the 'input' page between the head and footer
   	*  There are 2 situations where ACF did not load during the 'acf/input_admin_enqueue_scripts' and 
   	*  'acf/input_admin_head' actions because ACF did not know it was going to be used. These situations are
   	*  seen on comments / user edit forms on the front end. This function will always be called, and includes
   	*  $args that related to the current screen such as $args['post_id']
   	*
   	*  @type	function
   	*  @date	6/03/2014
   	*  @since	5.0.0
   	*
   	*  @param	$args (array)
   	*  @return	n/a
   	*/
   	
   	/*
   	
   	function input_form_data( $args ) {
	   	
		
	
   	}
   	
   	*/
	
	
	/*
	*  input_admin_footer()
	*
	*  This action is called in the admin_footer action on the edit screen where your field is created.
	*  Use this action to add CSS and JavaScript to assist your render_field() action.
	*
	*  @type	action (admin_footer)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	/*
		
	function input_admin_footer() {
	
		
		
	}
	
	*/
	
	
	/*
	*  field_group_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
	*  Use this action to add CSS + JavaScript to assist your render_field_options() action.
	*
	*  @type	action (admin_enqueue_scripts)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	/*
	
	function field_group_admin_enqueue_scripts() {
		
	}
	
	*/

	
	/*
	*  field_group_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is edited.
	*  Use this action to add CSS and JavaScript to assist your render_field_options() action.
	*
	*  @type	action (admin_head)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	/*
	
	function field_group_admin_head() {
	
	}
	
	*/


	/*
	*  load_value()
	*
	*  This filter is applied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value found in the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*  @return	$value
	*/
	
	/*
	
	function load_value( $value, $post_id, $field ) {
		
		return $value;
		
	}
	
	*/
	
	
	/*
	*  update_value()
	*
	*  This filter is applied to the $value before it is saved in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value found in the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*  @return	$value
	*/
	
	/*
	
	function update_value( $value, $post_id, $field ) {
		
		return $value;
		
	}
	
	*/
	
	
	/*
	*  format_value()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is returned to the template
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value which was loaded from the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*
	*  @return	$value (mixed) the modified value
	*/
		
	/*
	
	function format_value( $value, $post_id, $field ) {
		
		// bail early if no value
		if( empty($value) ) {
		
			return $value;
			
		}
		
		
		// apply setting
		if( $field['height'] > 12 ) { 
			
			// format the value
			// $value = 'something';
		
		}
		
		
		// return
		return $value;
	}
	
	*/
	
	
	/*
	*  validate_value()
	*
	*  This filter is used to perform validation on the value prior to saving.
	*  All values are validated regardless of the field's required setting. This allows you to validate and return
	*  messages to the user if the value is not correct
	*
	*  @type	filter
	*  @date	11/02/2014
	*  @since	5.0.0
	*
	*  @param	$valid (boolean) validation status based on the value and the field's required setting
	*  @param	$value (mixed) the $_POST value
	*  @param	$field (array) the field array holding all the field options
	*  @param	$input (string) the corresponding input name for $_POST value
	*  @return	$valid
	*/
	
	/*
	
	function validate_value( $valid, $value, $field, $input ){
		
		// Basic usage
		if( $value < $field['custom_minimum_setting'] )
		{
			$valid = false;
		}
		
		
		// Advanced usage
		if( $value < $field['custom_minimum_setting'] )
		{
			$valid = __('The value is too little!','acf-mapbox_gl_geojson'),
		}
		
		
		// return
		return $valid;
		
	}
	
	*/
	
	
	/*
	*  delete_value()
	*
	*  This action is fired after a value has been deleted from the db.
	*  Please note that saving a blank value is treated as an update, not a delete
	*
	*  @type	action
	*  @date	6/03/2014
	*  @since	5.0.0
	*
	*  @param	$post_id (mixed) the $post_id from which the value was deleted
	*  @param	$key (string) the $meta_key which the value was deleted
	*  @return	n/a
	*/
	
	/*
	
	function delete_value( $post_id, $key ) {
		
		
		
	}
	
	*/
	
	
	/*
	*  load_field()
	*
	*  This filter is applied to the $field after it is loaded from the database
	*
	*  @type	filter
	*  @date	23/01/2013
	*  @since	3.6.0	
	*
	*  @param	$field (array) the field array holding all the field options
	*  @return	$field
	*/
	
	/*
	
	function load_field( $field ) {
		
		return $field;
		
	}	
	
	*/
	
	
	/*
	*  update_field()
	*
	*  This filter is applied to the $field before it is saved to the database
	*
	*  @type	filter
	*  @date	23/01/2013
	*  @since	3.6.0
	*
	*  @param	$field (array) the field array holding all the field options
	*  @return	$field
	*/
	
	/*
	
	function update_field( $field ) {
		
		return $field;
		
	}	
	
	*/
	
	
	/*
	*  delete_field()
	*
	*  This action is fired after a field is deleted from the database
	*
	*  @type	action
	*  @date	11/02/2014
	*  @since	5.0.0
	*
	*  @param	$field (array) the field array holding all the field options
	*  @return	n/a
	*/
	
	/*
	
	function delete_field( $field ) {
		
		
		
	}	
	
	*/
	
	
}


// initialize
new acf_field_mapbox_gl_geojson( $this->settings );


// class_exists check
endif;

?>