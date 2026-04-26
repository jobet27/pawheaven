<?php
/**
 * Custom REST API Endpoints for PawHaven
 */

add_action( 'rest_api_init', function () {
	// Endpoint for filtered animals
	register_rest_route( 'pawhaven/v1', '/animals', array(
		'methods'  => 'GET',
		'callback' => 'pawhaven_rest_filter_animals',
		'permission_callback' => '__return_true',
	) );

	// Endpoint for donation campaigns
	register_rest_route( 'pawhaven/v1', '/donations', array(
		'methods'  => 'GET',
		'callback' => 'pawhaven_rest_get_donations',
		'permission_callback' => '__return_true',
	) );
} );

/**
 * Filter Animals Callback
 */
function pawhaven_rest_filter_animals( $request ) {
	$args = array(
		'post_type'      => 'animal',
		'post_status'    => 'publish',
		'posts_per_page' => 12,
		'tax_query'      => array(),
		'meta_query'     => array(),
	);

	// Taxonomy Filters
	$tax_filters = array(
		'species'    => 'species',
		'age'        => 'age_range',
		'size'       => 'animal_size'
	);

	foreach ( $tax_filters as $param => $taxonomy ) {
		if ( $request->get_param( $param ) && $request->get_param( $param ) !== 'all' ) {
			$args['tax_query'][] = array(
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $request->get_param( $param ),
			);
		}
	}

	// Status Filter (Meta)
	if ( $request->get_param( 'status' ) && $request->get_param( 'status' ) !== 'all' ) {
		$args['meta_query'][] = array(
			'key'   => '_animal_status',
			'value' => $request->get_param( 'status' ),
		);
	}

	$query = new WP_Query( $args );
	$animals = array();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$id = get_the_ID();
			
			$animals[] = array(
				'id'           => $id,
				'title'        => get_the_title(),
				'link'         => get_permalink(),
				'thumbnail'    => get_the_post_thumbnail_url( $id, 'animal-card' ),
				'excerpt'      => wp_trim_words( get_the_excerpt(), 15 ),
				'status'       => get_post_meta( $id, '_animal_status', true ) ?: 'available',
				'status_label' => pawhaven_get_animal_status_label( get_post_meta( $id, '_animal_status', true ) ?: 'available' ),
				'age'          => wp_get_post_terms( $id, 'age_range', array( 'fields' => 'names' ) )[0] ?? '',
				'size'         => wp_get_post_terms( $id, 'animal_size', array( 'fields' => 'names' ) )[0] ?? '',
			);
		}
		wp_reset_postdata();
	}

	return rest_ensure_response( $animals );
}

/**
 * Get Donations/Campaigns Callback
 */
function pawhaven_rest_get_donations( $request ) {
	// Simulation of campaign data for now
	$campaigns = array(
		array(
			'id'      => 1,
			'title'   => 'Spring Food Drive',
			'raised'  => 4500,
			'goal'    => 10000,
			'percent' => 45,
			'impact'  => 'Your donation feeds our rescue cats.'
		),
		array(
			'id'      => 2,
			'title'   => 'Medical Emergency Fund',
			'raised'  => 8500,
			'goal'    => 12000,
			'percent' => 70,
			'impact'  => 'Your donation covers urgent surgeries.'
		)
	);

	return rest_ensure_response( $campaigns );
}
