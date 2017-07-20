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
			'title' => apply_filters(
				'inc2734_wp_seo_customizer_section_google_analytics_title',
				'Google Analytics'
			)
		) );

		$this->_add( 'google-search-console', array(
			'title' => apply_filters(
				'inc2734_wp_seo_customizer_section_google_search_console_title',
				'Google Search Console'
			)
		) );

		$this->_add( 'ogp', array(
			'title' => apply_filters(
				'inc2734_wp_seo_customizer_section_ogp_title',
				'OGP'
			)
		) );

		$this->_add( 'twitter-cards', array(
			'title' => apply_filters(
				'inc2734_wp_seo_customizer_section_twitter_cards_title',
				'Twitter Cards'
			),
			'description' => apply_filters(
				'inc2734_wp_seo_customizer_section_twitter_cards_description',
				'Application of URL is necessary for using Twitter Cards.'
			) . '<a href="https://cards-dev.twitter.com/validator" target="_blank">Card validator</a>',
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
