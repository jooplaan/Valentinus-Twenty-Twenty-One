<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Valentinus Twenty Twenty One
 * @since Valentinus Twenty Twenty One 1.1
 */
?>

<?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>
	<aside id="secondary" class="sidebar-right widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-right' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
