<?php
/**
 * Regression tests for SEO metadata and output.
 */
class Inc2734_WP_SEO_Test extends WP_UnitTestCase {

	public static function set_up_before_class() {
		parent::set_up_before_class();
		new \Inc2734\WP_SEO\Bootstrap();
	}

	public function test_registers_metadata_for_the_rest_api() {
		$controller = new \Inc2734\WP_SEO\App\Controller\Posts();
		$controller->_register_post_metas();
		$metadata = get_registered_meta_keys( 'post', 'post' );

		$this->assertSame( 'string', $metadata['wp-seo-meta-description']['type'] );
		$this->assertTrue( $metadata['wp-seo-meta-description']['single'] );
		$this->assertTrue( $metadata['wp-seo-meta-description']['show_in_rest'] );
		$this->assertSame( 'sanitize_textarea_field', $metadata['wp-seo-meta-description']['sanitize_callback'] );
		$this->assertSame( 'array', $metadata['wp-seo-meta-robots']['type'] );
		$this->assertSame( 'string', $metadata['wp-seo-meta-robots']['show_in_rest']['schema']['items']['type'] );
	}

	public function test_returns_the_saved_description() {
		$post_id = self::factory()->post->create();
		update_post_meta( $post_id, 'wp-seo-meta-description', 'A custom description.' );

		$this->assertSame( 'A custom description.', \Inc2734\WP_SEO\Helper::get_the_description( $post_id ) );
	}

	public function test_saves_and_reads_seo_metadata_through_the_rest_api() {
		$user_id = self::factory()->user->create( array( 'role' => 'editor' ) );
		$post_id = self::factory()->post->create( array( 'post_author' => $user_id ) );
		wp_set_current_user( $user_id );
		$controller = new \Inc2734\WP_SEO\App\Controller\Posts();
		$controller->_register_post_metas();

		$request = new WP_REST_Request( 'POST', '/wp/v2/posts/' . $post_id );
		$request->set_body_params(
			array(
				'meta' => array(
					'wp-seo-meta-description' => '<b>REST</b> description.',
					'wp-seo-meta-robots'      => array( 'noindex', 'nofollow' ),
				),
			)
		);
		$response = rest_do_request( $request );

		$this->assertSame( 200, $response->get_status() );
		$this->assertSame( 'REST description.', get_post_meta( $post_id, 'wp-seo-meta-description', true ) );
		$this->assertSame( array( 'noindex', 'nofollow' ), get_post_meta( $post_id, 'wp-seo-meta-robots', true ) );

		$response = rest_do_request( new WP_REST_Request( 'GET', '/wp/v2/posts/' . $post_id ) );
		$metadata = $response->get_data()['meta'];

		$this->assertSame( 200, $response->get_status() );
		$this->assertSame( 'REST description.', $metadata['wp-seo-meta-description'] );
		$this->assertSame( array( 'noindex', 'nofollow' ), $metadata['wp-seo-meta-robots'] );
	}

	public function test_outputs_an_escaped_meta_description() {
		$post_id     = self::factory()->post->create();
		$description = 'Description with "quotes" & <markup>.';
		update_post_meta( $post_id, 'wp-seo-meta-description', $description );
		$this->go_to( get_permalink( $post_id ) );

		ob_start();
		do_action( 'wp_head' );
		$output = ob_get_clean();

		$this->assertStringContainsString( '<meta name="description" content="' . esc_attr( $description ) . '">', $output );
	}

	public function test_omits_an_empty_meta_description() {
		$post_id = self::factory()->post->create();
		$this->go_to( get_permalink( $post_id ) );

		ob_start();
		do_action( 'wp_head' );
		$output = ob_get_clean();

		$this->assertStringNotContainsString( '<meta name="description"', $output );
	}

	public function test_uses_the_posts_page_description_on_the_blog_home() {
		$front_page = self::factory()->post->create( array( 'post_type' => 'page' ) );
		$posts_page = self::factory()->post->create( array( 'post_type' => 'page' ) );
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page );
		update_option( 'page_for_posts', $posts_page );
		update_post_meta( $posts_page, 'wp-seo-meta-description', 'Blog description.' );
		$this->go_to( get_permalink( $posts_page ) );

		$this->assertTrue( is_home() );
		$this->assertSame( 'Blog description.', \Inc2734\WP_SEO\Helper::get_the_description() );
	}

	public function test_merges_saved_robots_with_existing_directives() {
		$post_id = self::factory()->post->create();
		update_post_meta( $post_id, 'wp-seo-meta-robots', array( 'noindex', 'nofollow' ) );
		$this->go_to( get_permalink( $post_id ) );

		$robots = apply_filters( 'wp_robots', array( 'max-image-preview' => 'large' ) );

		$this->assertTrue( $robots['noindex'] );
		$this->assertTrue( $robots['nofollow'] );
		$this->assertSame( 'large', $robots['max-image-preview'] );
	}

	public function test_uses_the_description_for_ogp() {
		$post_id = self::factory()->post->create();
		update_post_meta( $post_id, 'wp-seo-meta-description', 'OGP description.' );
		$this->go_to( get_permalink( $post_id ) );

		$this->assertSame( 'OGP description.', apply_filters( 'inc2734_wp_ogp_description', 'Original description.' ) );
	}

	public function test_preserves_the_description_filter() {
		$post_id = self::factory()->post->create();
		update_post_meta( $post_id, 'wp-seo-meta-description', 'Original description.' );
		add_filter(
			'inc2734_wp_seo_description',
			function ( $description ) {
				return $description . ' Filtered.';
			}
		);

		$this->assertSame( 'Original description. Filtered.', \Inc2734\WP_SEO\Helper::get_the_description( $post_id ) );
	}
}
