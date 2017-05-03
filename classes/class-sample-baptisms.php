<?php

/**
 * dt_sample_baptisms
 *
 * @class dt_sample_baptisms
 * @version	0.1
 * @since 0.1
 * @package	Disciple_Tools
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class dt_sample_baptisms {

    /**
     * dt_sample_baptisms The single instance of dt_sample_baptisms.
     * @var 	object
     * @access  private
     * @since 	0.1
     */
    private static $_instance = null;

    /**
     * Main Disciple_Tools_Admin_Menus Instance
     *
     * Ensures only one instance of dt_sample_baptisms is loaded or can be loaded.
     *
     * @since 0.1
     * @static
     * @return dt_sample_baptisms instance
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