<?php

/* enqueue scripts and style from parent theme */
function twentytwentyone_styles() {
	wp_enqueue_style( 'child-style', get_stylesheet_uri(),
	array( 'twenty-twenty-one-style' ), wp_get_theme()->get('Version') );
}
add_action( 'wp_enqueue_scripts', 'twentytwentyone_styles');

/**
 * As the Twenty Twenty-One theme uses get_template_directory() to load
 * its stylesheet, we need to enqueue our child theme’s stylesheet
 * using the wp_enqueue_scripts action.
 */
function valentinus_scripts() {
	wp_enqueue_style( 'valentinus', get_stylesheet_uri() );
	wp_enqueue_script( 'valentinus-js', get_template_directory_uri() . '/assets/js/app.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'valentinus_scripts' );

/**
 * Example of a custom block pattern.
 */
add_action( 'init', function(){

	register_block_pattern_category(
		'custom-patterns-valentinus',
		array( 'label' => esc_html__( 'Valentinus', 'twentytwentyone-valentinus' ) ) );

	register_block_pattern(
	'twentytwentyone-valentinus/custom-bio-pattern',
	array(
		'title'			=> __( 'Author Bio', 'twentytwentyone-valentinus' ),
		'description'	=> _x( 'A block with 2 columns that displays an avatar image, a heading and a paragraph.', 'Block pattern description', 'twentytwentyone-valentinus' ),
		'content'		=> '<!-- wp:columns {"verticalAlignment":null} --> <div class="wp-block-columns"><!-- wp:column {"verticalAlignment":"center","width":"33.33%"} --> <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:33.33%"><!-- wp:image {"id":29,"sizeSlug":"large","linkDestination":"none","className":"is-style-rounded"} --> <figure class="wp-block-image size-large is-style-rounded"><img src="' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/logo-heart-512x512.png" alt="Logo Valentinus" /></figure> <!-- /wp:image --></div> <!-- /wp:column --> <!-- wp:column {"width":"66.66%"} --> <div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:heading {"level":4} --> <h4>About Valentinus</h4> <!-- /wp:heading --> <!-- wp:paragraph --> <p>Valentinus is created in 2021 with a desire to explore the possibilities of the new WordPress theme Twenty Twenty One.</p> <!-- /wp:paragraph --></div> <!-- /wp:column --></div> <!-- /wp:columns -->',
		'categories'	=> array( 'custom-patterns-valentinus' ),
	)
	);
});
