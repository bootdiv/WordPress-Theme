<?php
// Add support for featured images
add_theme_support( 'post-thumbnails' );

// Register custom navigation menu
register_nav_menus( array(
    'main-menu' => __( 'Main Menu', 'textdomain' ),
) );

// Include files
include_once 'include/bootstrap_nav_walker.php';
include_once 'include/bootstrap_pagination_walker.php';

// Enqueue the main stylesheet
function mytheme_enqueue_styles() {
    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.3.0', 'all' );
    wp_enqueue_style( 'wptheme-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_styles' );

// Enqueue the main script
function mytheme_enqueue_scripts() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array( 'jquery' ), '5.3.0', true );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_scripts' );

// Customizer options
function my_customize_register( $wp_customize ) {

    $wp_customize->add_section( 'header_section', array(
        'title'=> __( 'Homepage Options', 'textdomain' ),
        'priority' => 120,
    ) );

    // Upload logo
    $wp_customize->add_setting( 'site_logo', array (
        'default' => get_bloginfo('template_directory') . '/assets/images/logo.png',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'site_logo', array(
        'label' => __( 'Upload Logo', 'textdomain' ),
        'description' => __( 'Upload logo image here', 'textdomain' ),
        'section' => 'header_section',
        'settings' => 'site_logo',
    ) ) );;

    // Search title
    $wp_customize->add_setting( 'search_title', array (
    'default' => ''
    ) );
    $wp_customize->add_control( 'search_title', array(
        'label' => __( 'Search Title', 'textdomain' ),
        'section' => 'header_section',
    ) );

    // Search details
    $wp_customize->add_setting( 'search_desc', array (
    'default' => ''
    ) );
    $wp_customize->add_control( 'search_desc', array(
        'label' => __( 'Search Title', 'textdomain' ),
        'section' => 'header_section',
        'type' => 'textarea'
    ) );

    // Copyright text
    $wp_customize->add_setting( 'copyright_text', array (
    'default' => 'Copyright © 2023 | All right reserved.'
    ) );
    $wp_customize->add_control( 'copyright_text', array(
        'label' => __( 'Copyright Text', 'TextDomain' ),
        'section' => 'header_section',
        'type' => 'textarea'
    ) );
}
add_action( 'customize_register', 'my_customize_register' );