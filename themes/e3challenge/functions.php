<?php

class E3_Challenge {

	function __construct() {

		add_filter( 'upload_mimes', 		array( $this, 'mime_types' ) );
		add_action( 'cmb2_init',			array( $this, 'event_metaboxes' ) );
		add_action( 'after_setup_theme',	array( $this, 'custom_images' ) );

		$this->cpt_registration();

	}

	/**
	 * Register the events post type.
	 */
	public function cpt_registration() {
		include_once( 'inc/class-cpt.php' );

		if ( class_exists( 'CPT' ) ) {

			$events = new CPT( array(
				'post_type_name' => 'event',
				'singular'       => 'Event',
				'plural'         => 'Events',
				'slug'           => 'event',
				),
				array(
			    'supports' => array( 'title', 'editor', 'thumbnail' ),
			));
		}
	}

	/**
	 * Add custom allowed media upload file types.
	 */

	public function mime_types( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}

	/**
	 * Helper function for getting post meta values.
	 */
	static function get_field( $field_name = null, $id = null ) {
		if ( null === $id ) {
			$id = get_the_ID();
		}
		if ( false === strpos( $field_name, '_e3_' ) ) {
			$field_name = '_e3_' . $field_name;
		}
		$field = get_post_meta( $id, $field_name, true );
		return '' !== $field ? $field : false;
	}

	/**
	 * Define the metabox and field configurations.
	 */
	public function event_metaboxes() {

		// Start with an underscore to hide fields from custom fields list
		$prefix = '_e3_';

		/**
		 * Initiate the metabox
		 */
		$cmb = new_cmb2_box( array(
			'id'            => 'event_fields',
			'title'         => __( 'Event Fields', 'e3challenge' ),
			'object_types'  => array( 'event' ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
		));

		$cmb->add_field( array(
			'name' => __( 'Date', 'cmb2' ),
			'id'   => $prefix . 'date',
			'type' => 'text_date_timestamp',
		));

		$cmb->add_field( array(
			'name' => __( 'Start Time', 'cmb2' ),
			'id'   => $prefix . 'start_time',
			'type' => 'text_time',
		));

		$cmb->add_field( array(
			'name' => __( 'End Time', 'cmb2' ),
			'id'   => $prefix . 'end_time',
			'type' => 'text_time',
		));
	}

	/**
	 * Add custom thumbnail size for events.
	 */
	public function custom_images() {
		add_image_size( 'event-thumb', 385, 200, [ 'left', 'top' ] );
	}
}

new E3_Challenge();
