<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_SEO\App\Controller;

class Posts {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'enqueue_block_editor_assets', [ $this, '_enqueue_block_editor_assets' ] );
		add_action( 'add_meta_boxes', [ $this, '_add_meta_boxes' ] );
		add_action( 'save_post', [ $this, '_save_meta_description' ] );
		add_action( 'save_post', [ $this, '_save_meta_robots' ] );
	}

	/**
	 * Enqueue block editor assets.
	 */
	public function _enqueue_block_editor_assets() {
		$post_type = get_post_type();
		if ( ! $post_type ) {
			return;
		}

		$post_type_object = get_post_type_object( $post_type );
		if ( empty( $post_type_object ) || empty( $post_type_object->public ) ) {
			return;
		}

		$asset = include( get_template_directory() . '/vendor/inc2734/wp-seo/src/dist/js/editor.asset.php' );
		wp_enqueue_script(
			'inc2734-wp-seo@editor',
			get_template_directory_uri() . '/vendor/inc2734/wp-seo/src/dist/js/editor.js',
			$asset['dependencies'],
			filemtime( get_template_directory() . '/vendor/inc2734/wp-seo/src/dist/js/editor.js' ),
			true
		);
	}

	/**
	 * Add meta box in pages of public post type.
	 *
	 * @param string $post_type Post type.
	 * @return void
	 */
	public function _add_meta_boxes( $post_type ) {
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
	 * Display meta box.
	 *
	 * @param WP_Post $post Post object.
	 * @return void
	 */
	public function _wp_seo_meta_box( $post ) {
		?>
		<?php wp_nonce_field( 'wp-seo-meta-box-action', 'wp-seo-meta-box-nonce' ); ?>
		<p>
			<label for="wp-seo-meta-description">
				<b><?php esc_html_e( 'Meta description', 'inc2734-wp-seo' ); ?></b>
				( <?php esc_html_e( 'Number of characters', 'inc2734-wp-seo' ); ?>: <span id="wp-seo-meta-description-counter">0</span> )
			</label><br />
			<textarea
				type="text"
				name="wp-seo-meta-description"
				class="widefat"
				rows="3"
				id="wp-seo-meta-description"
			><?php echo esc_attr( get_post_meta( $post->ID, 'wp-seo-meta-description', true ) ); ?></textarea>
		</p>
		<p>
			<b><?php esc_html_e( 'Meta robots', 'inc2734-wp-seo' ); ?></b><br />
			<?php
			$robots         = (array) get_post_meta( $post->ID, 'wp-seo-meta-robots', true );
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
						<?php checked( in_array( $robot, $robots, true ) ); ?>
					/>
					<?php echo esc_html( $robot ); ?>
				</label>
			<?php endforeach; ?>
		</p>
		<?php
	}

	/**
	 * Save meta description.
	 *
	 * @param int $post_id Post ID.
	 */
	public function _save_meta_description( $post_id ) {
		if ( empty( $_POST['wp-seo-meta-box-nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( wp_unslash( filter_input( INPUT_POST, 'wp-seo-meta-box-nonce' ) ), 'wp-seo-meta-box-action' ) ) {
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

		$meta_description = wp_unslash( filter_input( INPUT_POST, 'wp-seo-meta-description' ) );
		$meta_description = wp_strip_all_tags( $meta_description, true );
		update_post_meta( $post_id, 'wp-seo-meta-description', $meta_description );
	}

	/**
	 * Save meta robots.
	 *
	 * @param int $post_id Post ID.
	 * @return void
	 */
	public function _save_meta_robots( $post_id ) {
		if ( empty( $_POST['wp-seo-meta-box-nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( wp_unslash( filter_input( INPUT_POST, 'wp-seo-meta-box-nonce' ) ), 'wp-seo-meta-box-action' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( ! isset( $_POST['wp-seo-meta-robots'] ) || ! is_array( $_POST['wp-seo-meta-robots'] ) ) {
			update_post_meta( $post_id, 'wp-seo-meta-robots', [] );
			return;
		}

		$meta_robots = filter_input( INPUT_POST, 'wp-seo-meta-robots', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );
		update_post_meta( $post_id, 'wp-seo-meta-robots', $meta_robots );
	}
}
