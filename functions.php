<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Valentinus Twenty Twenty One
 */

/**
 * Include classes for custom widgets.
 */
require_once( get_stylesheet_directory() . '/inc/class-wp-widget-related-posts-by-tags.php' );
require_once( get_stylesheet_directory() . '/inc/class-wp-widget-related-posts-by-categories.php' );

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
 * Example of a custom block pattern.
 */
function twentytwentyone_valentinus_add_block_patterns() {
	register_block_pattern_category(
		'custom-patterns-valentinus',
		array( 'label' => esc_html__( 'Valentinus', 'twentytwentyone-valentinus' ) )
	);

	register_block_pattern(
		'twentytwentyone-valentinus/custom-bio-pattern',
		array(
			'title'         => __( 'Author Bio', 'twentytwentyone-valentinus' ),
			'description'   => _x( 'A block with 2 columns that displays an avatar image, a heading and a paragraph.', 'Block pattern description', 'twentytwentyone-valentinus' ),
			'content'       => '<!-- wp:columns {"verticalAlignment":null} --> <div class="wp-block-columns"><!-- wp:column {"verticalAlignment":"center","width":"33.33%"} --> <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:33.33%"><!-- wp:image {"id":29,"sizeSlug":"large","linkDestination":"none","className":"is-style-rounded"} --> <figure class="wp-block-image size-large is-style-rounded"><img src="' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/logo-heart-512x512.png" alt="Logo Valentinus" /></figure> <!-- /wp:image --></div> <!-- /wp:column --> <!-- wp:column {"width":"66.66%"} --> <div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:heading {"level":4} --> <h4>About Valentinus</h4> <!-- /wp:heading --> <!-- wp:paragraph --> <p>Valentinus is created in 2021 with a desire to explore the possibilities of the new WordPress theme Twenty Twenty One.</p> <!-- /wp:paragraph --></div> <!-- /wp:column --></div> <!-- /wp:columns -->',
			'categories'    => array( 'custom-patterns-valentinus' ),
		)
	);
}
add_action( 'init', 'twentytwentyone_valentinus_add_block_patterns' );


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
			'name'          => __( 'Sidebar', 'twentytwentyone-valentinus' ),
			'id'            => 'sidebar-right',
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
		if ( is_active_sidebar( 'sidebar-right' ) ) {
			$classes[] = 'active-sidebar-right';
		}
		return $classes;
	}
}
add_filter( 'body_class', 'twentytwentyone_valentinus_custom_body_class' );

/**
 * Register widget.
 */
function register_custom_widgets() {
	register_widget( 'WP_Widget_Related_Posts_By_Categories' );
	register_widget( 'WP_Widget_Related_Posts_By_Tags' );
}
add_action( 'widgets_init', 'register_custom_widgets' );
