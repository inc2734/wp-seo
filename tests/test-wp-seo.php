<?php
/**
 * @todo
 */
class Inc2734_WP_SEO_Test extends WP_UnitTestCase {

	public function set_up() {
		parent::set_up();
	}

	public function tear_down() {
		parent::tear_down();
	}

	/**
	 * @test
	 */
	public function sample() {
		new \Inc2734\WP_SEO\Bootstrap();
	}
}
