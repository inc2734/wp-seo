<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

class Inc2734_WP_SEO_Customizer_Panel_Manager {

	protected $customizer;
	protected $panels = array();

	public function __construct( Inc2734_WP_Customizer_Framework $customizer ) {
		$this->customizer = $customizer;

		$this->_add( 'seo', array(
			'title' => __( 'SEO', 'inc2734-wp-seo' ),
		) );
	}

	public function get( $panel_id ) {
		if ( isset( $this->panels[ $panel_id ] ) ) {
			return $this->panels[ $panel_id ];
		}
	}

	protected function _add( $id, $args ) {
		$panel = $this->customizer->Panel( $id, $args );
		$this->panels[ $panel->get_id() ] = $panel;
	}
}
