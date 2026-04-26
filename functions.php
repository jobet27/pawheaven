<?php
/**
 * PawHaven - Core Theme Functions
 * High-performance, organized, and scalable codebase.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * 1. THEME SETUP
 */
function pawhaven_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'animal-card', 600, 400, true );
	add_image_size( 'animal-single', 1200, 800, true );

	// Register Menus
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'pawhaven' ),
		'footer'  => __( 'Footer Menu', 'pawhaven' ),
	) );

	// Switch default core markup to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
	) );

	// Add theme support for selectively refreshing widgets in customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Custom Logo
	add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'pawhaven_setup' );

/**
 * 2. ENQUEUE ASSETS
 */
function pawhaven_scripts() {
	// Base Designs
	wp_enqueue_style( 'pawhaven-variables', get_template_directory_uri() . '/assets/css/variables.css', array(), '1.0.0' );
	wp_enqueue_style( 'pawhaven-style', get_stylesheet_uri(), array( 'pawhaven-variables' ), '1.0.0' );

	// Core JS
	wp_enqueue_script( 'pawhaven-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true );

	// Localize for AJAX & REST
	wp_localize_script( 'pawhaven-main', 'pawhavenData', array(
		'root'  => esc_url_raw( rest_url() ),
		'nonce' => wp_create_nonce( 'wp_rest' ),
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	) );

	// Conditional scripts
	if ( is_post_type_archive( 'animal' ) || is_tax( array( 'species', 'age_range' ) ) ) {
		wp_enqueue_script( 'pawhaven-ajax-filter', get_template_directory_uri() . '/assets/js/ajax-filter.js', array( 'pawhaven-main' ), '1.0.0', true );
	}

	if ( is_page( 'donate' ) || is_page_template( 'page-donate.php' ) ) {
		wp_enqueue_script( 'pawhaven-donation', get_template_directory_uri() . '/assets/js/donation.js', array( 'pawhaven-main' ), '1.0.0', true );
	}
}
add_action( 'wp_enqueue_scripts', 'pawhaven_scripts' );

/**
 * 3. ADMIN STYLING
 */
function pawhaven_admin_assets() {
	wp_enqueue_style( 'pawhaven-admin-css', get_template_directory_uri() . '/assets/css/admin.css', array(), '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'pawhaven_admin_assets' );

/**
 * 4. CUSTOM POST TYPES & TAXONOMIES
 */
require get_template_directory() . '/inc/post-types.php';
require get_template_directory() . '/inc/taxonomies.php';
require get_template_directory() . '/inc/metaboxes.php';
require get_template_directory() . '/inc/customizer.php';

/**
 * 5. REST API ENDPOINTS
 */
require get_template_directory() . '/inc/rest-api.php';

/**
 * 6. HELPER FUNCTIONS
 */

function pawhaven_default_menu() {
    echo '<ul id="primary-menu" class="menu">';
    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . __( 'Home', 'pawhaven' ) . '</a></li>';
    echo '<li><a href="' . get_post_type_archive_link( 'animal' ) . '">' . __( 'Adopt a Friend', 'pawhaven' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/success-stories' ) ) . '">' . __( 'Success Stories', 'pawhaven' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/donate' ) ) . '">' . __( 'Support Us', 'pawhaven' ) . '</a></li>';
    echo '</ul>';
}

function pawhaven_get_dynamic_stat( $type ) {
    switch ( $type ) {
        case 'forever_homes':
            $query = new WP_Query( array(
                'post_type'  => 'animal',
                'meta_query' => array(
                    array(
                        'key'     => '_animal_status',
                        'value'   => 'adopted',
                        'compare' => '=',
                    ),
                ),
                'fields'     => 'ids',
                'posts_per_page' => -1,
            ) );
            return $query->found_posts;

        case 'lives_saved':
            // "Lives Saved" could be all animals that passed through the shelter
            $query = new WP_Query( array(
                'post_type'      => 'animal',
                'fields'         => 'ids',
                'posts_per_page' => -1,
                'post_status'    => array('publish', 'private', 'pending'), // Include all entries
            ) );
            return $query->found_posts;

        default:
            return 0;
    }
}

function pawhaven_get_animal_status_label( $status ) {
	$statuses = array(
		'available' => __( 'Available', 'pawhaven' ),
		'pending'   => __( 'Pending', 'pawhaven' ),
		'adopted'   => __( 'Adopted', 'pawhaven' ),
		'urgent'    => __( 'Urgent Case', 'pawhaven' ),
	);
	return isset( $statuses[$status] ) ? $statuses[$status] : $status;
}

/**
 * Disable Admin Bar for non-admins to keep SaaS feel
 */
add_filter( 'show_admin_bar', function( $show ) {
	if ( ! current_user_can( 'manage_options' ) ) {
		return false;
	}
	return $show;
});
