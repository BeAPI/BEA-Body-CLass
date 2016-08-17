<?php

/**
 * Class BEA_Body_Class
 *
 * Handle the body classes on theme
 *
 */
class BEA_Body_Class {

	/**
	 * @var \BEA_Body_Class
	 * @author Maxime Culea
	 */
	private static $instance;

	/**
	 * @var array
	 * @author Maxime Culea
	 */
	private $body_class = [];
	private $delete_class = [];

	private function __construct() {
		self::$instance = $this;

		add_filter( 'body_class', array( $this, 'body_class' ) );
	}

	/**
	 * @return \BEA_Body_Class
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new BEA_Body_Class();
		}

		return self::$instance;
	}

	/**
	 * Add a body class
	 *
	 * @author Maxime Culea
	 *
	 * @param $body_class array | String
	 */
	public function add( $body_class ) {
		$this->body_class[] = $body_class;
	}

	/**
	 * Stack unwanted body_classes
	 *
	 * @author Maxime Culea
	 *
	 * @param $body_class String
	 */
	public function delete( $body_class ) {
		$this->delete_class[] = $body_class;
	}

	/**
	 * Manage to merge the class's body class array with filter ones
	 *
	 * @param $classes
	 * @author Maxime CULEA
	 *
	 * @return array
	 */
	public function body_class( $classes ) {
		if ( is_array( $this->body_class ) ) {
			foreach ( $this->body_class as $bd ) {
				$classes[] = $bd;
			}
		} else {
			$classes[] = $this->body_class;
		}

		// Filter body classes
		return array_filter( $classes, [ $this, 'delete_wanted_body_classes' ] );
	}

	/**
	 * Filter method which handle to delete wanted body_class
	 *
	 * @param $class
	 * @author Maxime CULEA
	 *
	 * @return bool
	 */
	private function delete_wanted_body_classes( $class ) {
		return ! in_array( $class, $this->delete_class );
	}
}
