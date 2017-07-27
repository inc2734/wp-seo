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
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', <?php echo esc_js( $tracking_id ); ?>, 'auto');
  ga('send', 'pageview');
</script>
	<?php
} );
