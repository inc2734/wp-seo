<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Print Google Tag Manager script
 *
 * @return void
 */
add_action( 'wp_head', function() {
	$tag_manager_id = apply_filters( 'inc2734_wp_seo_google_tag_manager_id', null );
	if ( ! $tag_manager_id ) {
		return;
	}

	if ( ! preg_match( '/^GTM-.+$/', $tag_manager_id ) ) {
		return;
	}
	?>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo esc_js( $tag_manager_id ); ?>');</script>
	<?php
} );
