<?php

/**
 * dt_sample_locations
 *
 * @class dt_sample_locations
 * @version	0.1
 * @since 0.1
 * @package	Disciple_Tools
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class dt_sample_locations {

    /**
     * dt_sample_locations The single instance of dt_sample_locations.
     * @var 	object
     * @access  private
     * @since 	0.1
     */
    private static $_instance = null;

    /**
     * Main dt_sample_locations Instance
     *
     * Ensures only one instance of dt_sample_locations is loaded or can be loaded.
     *
     * @since 0.1
     * @static
     * @return dt_sample_locations instance
     */
    public static function instance () {
        if ( is_null( self::$_instance ) )
            self::$_instance = new self();
        return self::$_instance;
    } // End instance()

    /**
     * Constructor function.
     * @access  public
     * @since   0.1
     */
    public function __construct () {

    } // End __construct()

}