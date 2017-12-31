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
add_action( 'wp_head', function() {
	if ( ! apply_filters( 'inc2734_wp_seo_use_json_ld', false ) ) {
		return;
	}

	$ogp = new Inc2734_WP_OGP();
	$json_ld = [];

	if ( is_single() ) {

		$json_ld = [
			'@context' => 'http://schema.org',
			'@type'    => 'BlogPosting',
			'headline' => $ogp->get_title(),
			'author'   => [
				'@type' => 'Person',
				'name'  => get_the_author(),
			],
			'publisher' => [
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
			'image'         => $ogp->get_image(),
			'datePublished' => get_the_time( 'c' ),
			'dateModified'  => get_the_modified_time( 'c' ),
			'articleBody'   => get_the_content(),
		];

	} elseif ( is_singular() || ( is_front_page() && ! is_home() ) ) {

		$json_ld = [
			'@context' => 'http://schema.org',
			'@type'    => 'Article',
			'headline' => $ogp->get_title(),
			'author'   => [
				'@type' => 'Person',
				'name'  => get_the_author(),
			],
			'publisher' => [
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
			'image'         => $ogp->get_image(),
			'datePublished' => get_the_time( 'c' ),
			'dateModified'  => get_the_modified_time( 'c' ),
			'articleBody'   => get_the_content(),
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
} );
