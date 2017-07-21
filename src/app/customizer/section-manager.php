<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

class Inc2734_WP_SEO_Customizer_Section_Manager {

	protected $customizer;
	protected $sections = array();

	public function __construct( Inc2734_WP_Customizer_Framework $customizer ) {
		$this->customizer = $customizer;

		$this->_add( 'google-analytics', array(
			'title' => __( 'Google Analytics', 'inc2734-wp-seo' ),
		) );

		$this->_add( 'google-search-console', array(
			'title' => __( 'Google Search Console', 'inc2734-wp-seo' ),
		) );

		$this->_add( 'ogp', array(
			'title' => __( 'OGP', 'inc2734-wp-seo' ),
		) );

		$this->_add( 'twitter-cards', array(
			'title'       => __( 'Twitter Cards', 'inc2734-wp-seo' ),
			'description' => sprintf(
				__( 'Application of URL is necessary for using Twitter Cards. %1$s', 'inc2734-wp-seo' ),
				'<a href="https://cards-dev.twitter.com/validator" target="_blank">Card validator</a>'
			),
		) );
	}

	public function get( $sections_id ) {
		if ( isset( $this->sections[ $sections_id ] ) ) {
			return $this->sections[ $sections_id ];
		}
	}

	protected function _add( $id, $args ) {
		$section = $this->customizer->Section( $id, $args );
		$this->sections[ $section->get_id() ] = $section;
	}
}
