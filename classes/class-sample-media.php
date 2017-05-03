<?php

/**
 * dt_sample_media
 *
 * @class dt_sample_media
 * @version	0.1
 * @since 0.1
 * @package	Disciple_Tools
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class dt_sample_media {

    /**
     * Disciple_Tools_Admin_Menus The single instance of dt_sample_media.
     * @var 	object
     * @access  private
     * @since 	0.1
     */
    private static $_instance = null;

    /**
     * Main dt_sample_media Instance
     *
     * Ensures only one instance of dt_sample_media is loaded or can be loaded.
     *
     * @since 0.1
     * @static
     * @return dt_sample_media instance
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