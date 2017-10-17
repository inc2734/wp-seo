<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * SEO for posts
 */
class Inc2734_WP_SEO_Posts_Controller {

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, '_add_meta_boxes' ), 10, 2 );
		add_action( 'save_post'     , array( $this, '_save_meta_description' ) );
		add_action( 'save_post'     , array( $this, '_save_meta_robots' ) );
	}

	/**
	 * Add meta box in pages of public post type
	 *
	 * @param [string] $post_type
	 * @param [WP_Post] $post
	 * @return void
	 */
	public function _add_meta_boxes( $post_type, $post ) {
		$post_type_object = get_post_type_object( $post_type );
		if ( empty( $post_type_object ) || empty( $post_type_object->public ) ) {
			return;
		}

		add_meta_box(
			'wp-seo',
			__( 'SEO', 'inc2734-wp-seo' ),
			array( $this, '_wp_seo_meta_box' ),
			$post_type,
			'normal'
		);
	}

	/**
	 * Display meta box
	 *
	 * @param [WP_Post] $post
	 * @return void
	 */
	public function _wp_seo_meta_box( $post ) {
		?>
		<?php wp_nonce_field( 'wp-seo-meta-box-action', 'wp-seo-meta-box-nonce' ); ?>
		<p>
			<label for="wp-seo-meta-description">
				<b><?php esc_html_e( 'Meta description', 'inc2734-wp-seo' ); ?></b>
			</label><br />
			<input
				type="text"
				name="wp-seo-meta-description"
				class="widefat"
				id="wp-seo-meta-description"
				value="<?php echo esc_attr( get_post_meta( $post->ID, 'wp-seo-meta-description', true ) ); ?>"
			/>
		</p>
		<p>
			<b><?php esc_html_e( 'Meta robots', 'inc2734-wp-seo' ); ?></b><br />
			<?php
			$robots = (array) get_post_meta( $post->ID, 'wp-seo-meta-robots', true );
			$robots_choices = [
				'noindex',
				'nofollow',
			]
			?>
			<?php foreach ( $robots_choices as $robot ) : ?>
				<label for="wp-seo-meta-robots-<?php echo esc_attr( $robot ); ?>" style="margin-right: 1em;">
					<input
						type="checkbox"
						name="wp-seo-meta-robots[]"
						id="wp-seo-meta-robots-<?php echo esc_attr( $robot ); ?>"
						value="<?php echo esc_attr( $robot ); ?>"
						<?php checked( in_array( $robot, $robots ) ); ?>
					/>
					<?php echo esc_html( $robot ); ?>
				</label>
			<?php endforeach; ?>
		</p>
		<?php
	}

	/**
	 * Save meta description
	 *
	 * @param [int] $post_id
	 * @return void
	 */
	public function _save_meta_description( $post_id ) {
		if ( empty( $_POST['wp-seo-meta-box-nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['wp-seo-meta-box-nonce'], 'wp-seo-meta-box-action' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( ! isset( $_POST['wp-seo-meta-description'] ) ) {
			return;
		}

		if ( is_array( $_POST['wp-seo-meta-description'] ) ) {
			return;
		}

		update_post_meta( $post_id, 'wp-seo-meta-description', $_POST['wp-seo-meta-description'] );
	}

	/**
	 * Save meta robots
	 *
	 * @param [int] $post_id
	 * @return void
	 */
	public function _save_meta_robots( $post_id ) {
		if ( empty( $_POST['wp-seo-meta-box-nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['wp-seo-meta-box-nonce'], 'wp-seo-meta-box-action' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( ! isset( $_POST['wp-seo-meta-robots'] ) ) {
			update_post_meta( $post_id, 'wp-seo-meta-robots', [] );
			return;
		}

		update_post_meta( $post_id, 'wp-seo-meta-robots', $_POST['wp-seo-meta-robots'] );
	}
}
