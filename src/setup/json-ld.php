<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Print structured data (JSON+LD)
 *
 * @return void
 */
add_action(
	'wp_head',
	function() {
		if ( ! apply_filters( 'inc2734_wp_seo_use_json_ld', false ) ) {
			return;
		}

		$ogp     = new \Inc2734\WP_OGP\Bootstrap();
		$json_ld = [];

		if ( is_singular() || ( is_front_page() && ! is_home() ) ) {
			if ( is_singular( 'post' ) ) {
				$type = 'BlogPosting';
			} else {
				$type = 'Article';
			}

			$query = new WP_Query(
				[
					'p'                   => get_the_ID(),
					'post_type'           => 'any',
					'posts_per_page'      => 1,
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
					'suppress_filters'    => true,
				]
			);

			while ( $query->have_posts() ) {
				$query->the_post();

				$json_ld = [
					'@context'         => 'http://schema.org',
					'@type'            => $type,
					'headline'         => $ogp->get_title(),
					'author'           => [
						'@type' => 'Person',
						'name'  => get_the_author(),
					],
					'publisher'        => [
						'@type' => 'Organization',
						'url'   => home_url(),
						'name'  => $ogp->get_site_name(),
						'logo'  => [
							'@type' => 'ImageObject',
							'url'   => wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' ),
						],
					],
					'mainEntityOfPage' => [
						'@type' => 'WebPage',
						'@id'   => $ogp->get_url(),
					],
					'image'            => [
						'@type' => 'ImageObject',
						'url'   => $ogp->get_image(),
					],
					'datePublished'    => get_the_time( 'c' ),
					'dateModified'     => get_the_modified_time( 'c' ),
					'description'      => $ogp->get_description(),
				];
			}

			wp_reset_postdata();
		} else {
			$json_ld = [
				'@context'  => 'http://schema.org',
				'@type'     => 'WebSite',
				'publisher' => [
					'@type' => 'Organization',
					'url'   => home_url(),
					'name'  => $ogp->get_site_name(),
					'logo'  => [
						'@type' => 'ImageObject',
						'url'   => wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' ),
					],
				],
			];
		}

		$json_ld = apply_filters( 'inc2734_wp_seo_json_ld', $json_ld );

		if ( ! $json_ld ) {
			return;
		}

		?>
		<script type="application/ld+json">
			<?php echo json_encode( $json_ld ); ?>
		</script>
		<?php
	}
);
