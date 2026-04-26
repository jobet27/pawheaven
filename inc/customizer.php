<?php
/**
 * PawHaven Theme Customizer
 */

function pawhaven_customize_register( $wp_customize ) {
    
    // Add Stats Section
    $wp_customize->add_section( 'pawhaven_stats_section', array(
        'title'    => __( 'Homepage Stats', 'pawhaven' ),
        'priority' => 30,
    ) );

    // Stat 1: Lives Saved
    $wp_customize->add_setting( 'stat_1_number', array( 'default' => '0', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'stat_1_number', array( 'label' => __( 'Stat 1 Number', 'pawhaven' ), 'section' => 'pawhaven_stats_section', 'type' => 'text' ) );
    
    $wp_customize->add_setting( 'stat_1_label', array( 'default' => __( 'Lives Saved', 'pawhaven' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'stat_1_label', array( 'label' => __( 'Stat 1 Label', 'pawhaven' ), 'section' => 'pawhaven_stats_section', 'type' => 'text' ) );

    // Stat 2: Forever Homes
    $wp_customize->add_setting( 'stat_2_number', array( 'default' => '0', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'stat_2_number', array( 'label' => __( 'Stat 2 Number', 'pawhaven' ), 'section' => 'pawhaven_stats_section', 'type' => 'text' ) );
    
    $wp_customize->add_setting( 'stat_2_label', array( 'default' => __( 'Forever Homes', 'pawhaven' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'stat_2_label', array( 'label' => __( 'Stat 2 Label', 'pawhaven' ), 'section' => 'pawhaven_stats_section', 'type' => 'text' ) );

    // Stat 3: Years of Care
    $wp_customize->add_setting( 'stat_3_number', array( 'default' => '0', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'stat_3_number', array( 'label' => __( 'Stat 3 Number', 'pawhaven' ), 'section' => 'pawhaven_stats_section', 'type' => 'text' ) );
    
    $wp_customize->add_setting( 'stat_3_label', array( 'default' => __( 'Years of Care', 'pawhaven' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'stat_3_label', array( 'label' => __( 'Stat 3 Label', 'pawhaven' ), 'section' => 'pawhaven_stats_section', 'type' => 'text' ) );

    // Stat 4: Volunteer Hours
    $wp_customize->add_setting( 'stat_4_number', array( 'default' => '0', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'stat_4_number', array( 'label' => __( 'Stat 4 Number', 'pawhaven' ), 'section' => 'pawhaven_stats_section', 'type' => 'text' ) );
    
    $wp_customize->add_setting( 'stat_4_label', array( 'default' => __( 'Volunteer Hours', 'pawhaven' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'stat_4_label', array( 'label' => __( 'Stat 4 Label', 'pawhaven' ), 'section' => 'pawhaven_stats_section', 'type' => 'text' ) );
}
add_action( 'customize_register', 'pawhaven_customize_register' );
