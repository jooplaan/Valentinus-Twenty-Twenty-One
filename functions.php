<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Valentinus Twenty Twenty One
 */

/**
 * Load translation files.
 */
load_theme_textdomain( 'twentytwentyone-valentinus', get_stylesheet_directory() . '/languages' );

/**
 * Include classes for custom widget.
 */
require_once( get_stylesheet_directory() . '/inc/class-wp-widget-related-posts.php' );

/**
 * Enqueue scripts and style from parent theme.
 */
function twentytwentyone_styles() {
	wp_enqueue_style(
		'child-style',
		get_stylesheet_uri(),
		array( 'twenty-twenty-one-style' ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'twentytwentyone_styles' );

/**
 * As the Twenty Twenty-One theme uses get_template_directory() to load
 * its stylesheet, we need to enqueue our child theme’s stylesheet
 * using the wp_enqueue_scripts action.
 */
function valentinus_scripts() {
	wp_enqueue_style(
		'valentinus',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
	wp_enqueue_script(
		'valentinus-js',
		get_stylesheet_directory_uri() . '/assets/js/app.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'valentinus_scripts' );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Valentinus Twenty Twenty One 1.1
 */
function twentytwentyone_valentinus_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar single post', 'twentytwentyone-valentinus' ),
			'id'            => 'sidebar-single-post',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentytwentyone-valentinus' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twentytwentyone_valentinus_widgets_init' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function twentytwentyone_valentinus_custom_body_class( $classes ) {
	global $template;
	if ( basename( $template ) == 'single.php' ) {
		if ( is_active_sidebar( 'sidebar-single-post' ) ) {
			$classes[] = 'active-sidebar-single-post';
		}
		return $classes;
	}
}
add_filter( 'body_class', 'twentytwentyone_valentinus_custom_body_class' );

/**
 * Register widget.
 */
function register_custom_widgets() {
	register_widget( 'WP_Widget_Related_Posts' );
}
add_action( 'widgets_init', 'register_custom_widgets' );

/**
 * Registers theme support for header image.
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @since Valentinus Twenty Twenty One 1.4
 */
function valentinus_custom_header_setup() {
	$defaults = array(
		'default-image'          => get_stylesheet_directory_uri() . '/assets/images/default-header.jpg',
		'header-text'            => false,
		'default-text-color'     => '000',
		'width'                  => 1000,
		'height'                 => 198,
		'random-default'         => false,
		'uploads'                => false,
		'wp-head-callback'       => 'wphead_valentinus',
		'admin-head-callback'    => 'adminhead_valentinus',
		'admin-preview-callback' => 'adminpreview_cb',
	);
}
add_action( 'after_setup_theme', 'valentinus_custom_header_setup' );

$header_info = array(
	'width'         => 2048,
	'height'        => 400,
	'default-image' => get_stylesheet_directory_uri() . '/assets/images/header-boat-3.jpg',
);
add_theme_support( 'custom-header', $header_info );

$header_images = array(
	'boat' => array(
		'url'           => get_stylesheet_directory_uri() . '/assets/images/header-boat.jpg',
		'thumbnail_url' => get_stylesheet_directory_uri() . '/assets/images/header-boat-thumbnail.jpg',
		'description'   => 'Boat',
	),
	'boat-2' => array(
		'url'           => get_stylesheet_directory_uri() . '/assets/images/header-boat-2.jpg',
		'thumbnail_url' => get_stylesheet_directory_uri() . '/assets/images/header-boat-2-thumbnail.jpg',
		'description'   => 'Boat 2',
	),
	'boat-3' => array(
		'url'           => get_stylesheet_directory_uri() . '/assets/images/header-boat-3.jpg',
		'thumbnail_url' => get_stylesheet_directory_uri() . '/assets/images/header-boat-3-thumbnail.jpg',
		'description'   => 'Boat 3',
	),

);
register_default_headers( $header_images );
