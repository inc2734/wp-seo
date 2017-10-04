<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Print Google Analytics script
 *
 * @return void
 */
add_action( 'wp_head', function() {
	$tracking_id = apply_filters( 'inc2734_wp_seo_google_analytics_tracking_id', null );
	if ( ! $tracking_id ) {
		return;
	}

	if ( ! preg_match( '/^UA-\d+-\d+$/', $tracking_id ) ) {
		return;
	}
	?>
<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $tracking_id ); ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', '<?php echo esc_js( $tracking_id ); ?>');
</script>
	<?php
} );
