<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

class Inc2734_WP_SEO_Meta {

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, '_add_meta_boxes' ), 10, 2 );
		add_action( 'save_post'     , array( $this, '_save_post' ) );
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
		if ( ! $post_type_object->public ) {
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
				<?php esc_html_e( 'Meta description', 'inc2734-wp-seo' ); ?>
			</label>
			<input
				type="text"
				name="wp-seo-meta-description"
				class="widefat"
				id="wp-seo-meta-description"
				value="<?php echo sanitize_text_field( get_post_meta( $post->ID, 'wp-seo-meta-description', true ) ); ?>"
			/>
		</p>
		<?php
	}

	/**
	 * Save data from meta box
	 *
	 * @param [int] $post_id
	 * @return void
	 */
	public function _save_post( $post_id ) {
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
}
