<?php
/**
 * Register Custom Taxonomies for PawHaven
 */

function pawhaven_register_taxonomies() {

	// Species (Dog, Cat, Rabbit, etc)
	register_taxonomy( 'species', 'animal', array(
		'labels' => array(
			'name'          => __( 'Species', 'pawhaven' ),
			'singular_name' => __( 'Species', 'pawhaven' ),
		),
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'species' ),
	) );

	// Age Range (Puppy, Adult, Senior)
	register_taxonomy( 'age_range', 'animal', array(
		'labels' => array(
			'name'          => __( 'Age Range', 'pawhaven' ),
			'singular_name' => __( 'Age Range', 'pawhaven' ),
		),
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
	) );

	// Size (Small, Medium, Large, Extra Large)
	register_taxonomy( 'animal_size', 'animal', array(
		'labels' => array(
			'name'          => __( 'Sizes', 'pawhaven' ),
			'singular_name' => __( 'Size', 'pawhaven' ),
		),
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
	) );
}
add_action( 'init', 'pawhaven_register_taxonomies' );
