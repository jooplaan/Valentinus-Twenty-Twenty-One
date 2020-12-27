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
	wp_enqueue_script( 'valentinus-js', get_template_directory_uri() . '/js/app.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'valentinus_scripts' );