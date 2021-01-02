<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package Valentinus Twenty Twenty One
 * @since Valentinus Twenty Twenty One 1.1
 */

?>

<?php if ( is_active_sidebar( 'sidebar-single-post' ) ) : ?>
	<aside id="secondary" class="sidebar-single-post widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-single-post' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
