<?php
namespace HSC\Customizer;

/**
 * Set up theme defaults and register supported WordPress features.
 *
 * @return void
 */
function setup() {
	$n = function ( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	// Setup the Theme Customizer settings and controls...
	add_action( 'customize_register', $n( 'social_media_options' ) );

}


function social_media_options( $wp_customize ) {

	// Social Media Section
	$wp_customize->add_section( 'social_media_options',
       array(
          'title' => __( 'Social Media', 'cgu' ), //Visible title of section
          'priority' => 0, //Determines what order this appears in
          'capability' => 'edit_theme_options', //Capability needed to tweak
          'description' => __('Provide URLs for social media accounts', 'cgu'), //Descriptive tooltip
       )
    );

    // Social Media fields
    $fields = array(
        array( 'setting' => 'facebook', 'setting_default' => '', 'control' => 'facebook_control', 'label' => __( 'Facebook', 'cgu' ), 'section' => 'social_media_options', 'type' => 'text' ),
        array( 'setting' => 'twitter', 'setting_default' => '', 'control' => 'twitter_control', 'label' => __( 'Twitter', 'cgu' ), 'section' => 'social_media_options', 'type' => 'text' ),
        array( 'setting' => 'instagram', 'setting_default' => '', 'control' => 'instagram_control', 'label' => __( 'Instagram', 'cgu' ), 'section' => 'social_media_options', 'type' => 'text' ),
        array( 'setting' => 'vimeo', 'setting_default' => '', 'control' => 'vimeo_control', 'label' => __( 'Vimeo', 'cgu' ), 'section' => 'social_media_options', 'type' => 'text' ),
        array( 'setting' => 'linkedin', 'setting_default' => '', 'control' => 'linkedin_control', 'label' => __( 'LinkedIn', 'cgu' ), 'section' => 'social_media_options', 'type' => 'text' ),
    );

	foreach ( $fields as $field ) {

		$wp_customize->add_setting( $field['setting'], //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
	       array(
	          'default' => $field['setting_default'], //Default setting/value to save
	          'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
	          'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
	          'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	       )
	    );
		$wp_customize->add_control( new \WP_Customize_Control( //Instantiate the color control class
	       $wp_customize, //Pass the $wp_customize object (required)
	       $field['control'], //Set a unique ID for the control
	       array(
				'label'    	 => $field['label'],
				'section'    => $field['section'],
				'settings'   => $field['setting'],
				'type'       => $field['type'],
				// 'input_attrs' => $field['attributes']
			)
	    ) );

	}

}