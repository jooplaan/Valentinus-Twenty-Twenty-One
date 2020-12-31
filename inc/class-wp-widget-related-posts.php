<?php
/**
 * Widget API: WP_Widget_Related_Posts class
 *
 * @package Valentinus Twenty Twenty One
 * @since Valentinus Twenty Twenty One 1.3
 */

/**
 * Class used to implement a Related Posts widget.
 *
 * @since 1.3
 *
 * @see WP_Widget
 */
class WP_Widget_Related_Posts extends WP_Widget {

	/**
	 * Sets up a new Related Posts widget instance.
	 *
	 * @since 1.3
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'widget_related_entries',
			'description'                 => __( 'Related content for article.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'related-posts', __( 'Related Posts' ), $widget_ops );
		$this->alt_option_name = 'widget_related_entries';
	}

	/**
	 * Outputs the content for the current Related Posts widget instance.
	 *
	 * @since 1.3
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Related Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$default_title = __( 'Related Posts' );
		$title         = ( ! empty( $instance['title'] ) ) ? $instance['title'] : $default_title;

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		/*
		 * Get the post ID.
		 */
		$post_id = get_the_ID();

		/*
		 * Get the category terms for the post.
		 */
		$categories = get_the_category( $post_id );
		$cat_posts_found = false;
		if ( $categories ) {
			$cat_ids = array();
			foreach ( $categories as $category ) {
				$cat_ids[] = $category->term_id;
			}

			$c = new WP_Query(
				/**
				 * Filters the arguments for the Related Posts widget.
				 *
				 * @since 1.3
				 *
				 * @see WP_Query::get_posts()
				 *
				 * @param array $args     An array of arguments used to retrieve the related posts.
				 * @param array $instance Array of settings for the current widget.
				 */
				apply_filters(
					'widget_posts_args',
					array(
						'posts_per_page'      => $number,
						'no_found_rows'       => true,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => true,
						'category__in' => array( $cat_ids ),
						'post__not_in' => array( $post_id ),
					),
					$instance
				)
			);
			if ( $c->have_posts() ) {
				$cat_posts_found = true;
			}
		}

		/*
		 * Get the tags for the post.
		 */
		$tag_posts_found = false;
		$tags = wp_get_post_tags( $post_id );
		if ( $tags ) {

			$first_tag = $tags[0]->term_id;
			$t = new WP_Query(
				/**
				 * Filters the arguments for the Related Posts widget.
				 *
				 * @since 1.3
				 *
				 * @see WP_Query::get_posts()
				 *
				 * @param array $args     An array of arguments used to retrieve the related posts.
				 * @param array $instance Array of settings for the current widget.
				 */
				apply_filters(
					'widget_posts_args',
					array(
						'posts_per_page'      => $number,
						'no_found_rows'       => true,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => true,
						'tag__in' => array( $first_tag ),
						'post__not_in' => array( $post_id ),
					),
					$instance
				)
			);
			if ( $t->have_posts() ) {
				$tag_posts_found = true;
			}
		}

		if ( ! $tag_posts_found && ! $cat_posts_found ) {
			return;
		}

		$result = new WP_Query();
		if ( $tag_posts_found && $cat_posts_found ) {
			$result->posts = array_slice( array_unique( array_merge( $c->posts, $t->posts ), SORT_REGULAR ), 0, $number );
		} else {
			if ( $tag_posts_found ) {
				$result->posts = $t->posts;
			}
			if ( $cat_posts_found ) {
				$result->posts = $c->posts;
			}
		}
		?>

		<?php echo $args['before_widget']; ?>

		<?php
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$format = current_theme_supports( 'html5', 'navigation-widgets' ) ? 'html5' : 'xhtml';

		/** This filter is documented in wp-includes/widgets/class-wp-nav-menu-widget.php */
		$format = apply_filters( 'navigation_widgets_format', $format );

		if ( 'html5' === $format ) {
			// The title may be filtered: Strip out HTML and make sure the aria-label is never empty.
			$title      = trim( strip_tags( $title ) );
			$aria_label = $title ? $title : $default_title;
			echo '<nav role="navigation" aria-label="' . esc_attr( $aria_label ) . '">';
		}
		?>

		<ul>
			<?php foreach ( $result->posts as $related_post ) : ?>
				<?php
				$post_title   = get_the_title( $related_post->ID );
				$title        = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
				$aria_current = '';

				if ( get_queried_object_id() === $related_post->ID ) {
					$aria_current = ' aria-current="page"';
				}
				?>
				<li>
					<a href="<?php the_permalink( $related_post->ID ); ?>"<?php echo $aria_current; ?>><?php echo $title; ?></a>
					<?php if ( $show_date ) : ?>
						<span class="post-date"><?php echo get_the_date( '', $related_post->ID ); ?></span>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php
		if ( 'html5' === $format ) {
			echo '</nav>';
		}

		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current Related Posts widget instance.
	 *
	 * @since 1.3
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['number']    = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}

	/**
	 * Outputs the settings form for the Related Posts widget.
	 *
	 * @since 1.3
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_html( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:' ); ?></label>
			<input class="tiny-text" id="<?php echo esc_html( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_html( $number ); ?>" size="3" />
		</p>

		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo esc_html( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'show_date' ) ); ?>" />
			<label for="<?php echo esc_html( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'Display post date?' ); ?></label>
		</p>
		<?php
	}
}
