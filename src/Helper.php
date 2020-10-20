<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_SEO;

class Helper {

	/**
	 * Return description of the post.
	 *
	 * @param int|WP_Post $post Post ID or WP_Post object. Default is global $post.
	 * @return string
	 */
	public static function get_the_description( $post = 0 ) {
		$meta_description = '';

		if ( 0 !== $post || is_singular() || ( is_front_page() && ! is_home() ) ) {
			$meta_description = static::_get_singular_description( $post );
		}

		if ( is_home() ) {
			$meta_description = static::_get_home_description();
		}

		return apply_filters( 'inc2734_wp_seo_description', $meta_description );
	}

	/**
	 * Return description for singular.
	 * When wp-seo-meta-description meta is empty, return empty.
	 *
	 * @param int|WP_Post $post Post ID or WP_Post object. Default is global $post.
	 * @return string
	 */
	protected static function _get_singular_description( $post = 0 ) {
		$post = get_post( $post );
		return get_post_meta( $post->ID, 'wp-seo-meta-description', true );
	}

	/**
	 * Return description for home.
	 * When wp-seo-meta-description meta is empty, return empty.
	 *
	 * @return string
	 */
	protected static function _get_home_description() {
		$show_on_front  = get_option( 'show_on_front' );
		$page_for_posts = get_option( 'page_for_posts' );

		if ( 'page' === $show_on_front && $page_for_posts ) {
			return static::_get_singular_description( $page_for_posts );
		}
	}

	/**
	 * Print description of the post.
	 *
	 * @param int|WP_Post $post Post ID or WP_Post object. Default is global $post.
	 */
	public static function the_description( $post = 0 ) {
		echo esc_attr( static::get_the_description( $post ) );
	}

	/**
	 * Return thumbnail of the post.
	 *
	 * @param int|WP_Post $post Post ID or WP_Post object. Default is global $post.
	 * @return string
	 */
	public static function get_the_thumbnail( $post = 0 ) {
		$thumbnail = '';

		if ( 0 !== $post || is_singular() || ( is_front_page() && ! is_home() ) ) {
			$post         = get_post( $post );
			$thumbnail_id = get_post_thumbnail_id( $post );
			$thumbnail    = wp_get_attachment_image_url( $thumbnail_id, 'full' );
		}

		return apply_filters( 'inc2734_wp_seo_thumbnail', $thumbnail );
	}

	/**
	 * Print thumbnail of the post.
	 *
	 * @param int|WP_Post $post Post ID or WP_Post object. Default is global $post.
	 */
	public static function the_thumbnail( $post = 0 ) {
		echo esc_url( static::get_the_thumbnail( $post ) );
	}
}
