<?php
/**
 * Register Custom Post Types for PawHaven
 */

function pawhaven_register_post_types() {

	// 1. ANIMALS
	register_post_type( 'animal', array(
		'labels' => array(
			'name'               => __( 'Animals', 'pawhaven' ),
			'singular_name'      => __( 'Animal', 'pawhaven' ),
			'add_new'            => __( 'Add New Animal', 'pawhaven' ),
			'add_new_item'       => __( 'Add New Animal', 'pawhaven' ),
			'edit_item'          => __( 'Edit Animal', 'pawhaven' ),
			'new_item'           => __( 'New Animal', 'pawhaven' ),
			'view_item'          => __( 'View Animal', 'pawhaven' ),
			'search_items'       => __( 'Search Animals', 'pawhaven' ),
			'not_found'          => __( 'No animals found', 'pawhaven' ),
			'not_found_in_trash' => __( 'No animals found in Trash', 'pawhaven' ),
		),
		'public'              => true,
		'has_archive'         => true,
		'rewrite'             => array( 'slug' => 'adopt' ),
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'menu_icon'           => 'dashicons-pets',
		'show_in_rest'        => true,
		'capability_type'     => 'post',
		'hierarchical'        => false,
	) );

	// 2. DONATIONS (Internal Tracking)
	register_post_type( 'donation', array(
		'labels' => array(
			'name'          => __( 'Donations', 'pawhaven' ),
			'singular_name' => __( 'Donation', 'pawhaven' ),
		),
		'public'              => false,
		'show_ui'             => true,
		'supports'            => array( 'title', 'custom-fields' ),
		'menu_icon'           => 'dashicons-heart',
		'show_in_rest'        => true,
		'capability_type'     => 'post',
	) );

	// 3. SUCCESS STORIES
	register_post_type( 'success_story', array(
		'labels' => array(
			'name'          => __( 'Success Stories', 'pawhaven' ),
			'singular_name' => __( 'Success Story', 'pawhaven' ),
		),
		'public'              => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'menu_icon'           => 'dashicons-megaphone',
		'show_in_rest'        => true,
	) );

    // 4. IMPACT STATS
    register_post_type( 'impact_stat', array(
        'labels'      => array( 
            'name' => __( 'Impact Stats', 'pawhaven' ), 
            'singular_name' => __( 'Impact Stat', 'pawhaven' ),
            'add_new' => __( 'Add New Stat', 'pawhaven' ),
        ),
        'public'      => false,
        'show_ui'     => true,
        'menu_icon'   => 'dashicons-chart-bar',
        'supports'    => array( 'title' ),
    ) );

    // 5. VOLUNTEERS
	register_post_type( 'volunteer', array(
		'labels' => array(
			'name'          => __( 'Volunteers', 'pawhaven' ),
			'singular_name' => __( 'Volunteer', 'pawhaven' ),
		),
		'public'              => false,
		'show_ui'             => true,
		'supports'            => array( 'title', 'editor', 'custom-fields' ),
		'menu_icon'           => 'dashicons-groups',
		'show_in_rest'        => true,
	) );
}
add_action( 'init', 'pawhaven_register_post_types' );
