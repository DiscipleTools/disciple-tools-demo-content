<?php

/**
 * Disciple Tools Roles Sample
 *
 * @class dt_sample_roles
 * @version	0.1
 * @since 0.1
 * @package	dt_sample_roles
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class dt_sample_roles {

    /**
     * dt_sample_roles The single instance of dt_sample_roles.
     * @var 	object
     * @access  private
     * @since 	0.1
     */
    private static $_instance = null;

    /**
     * Main dt_sample_roles Instance
     *
     * Ensures only one instance of dt_sample_roles is loaded or can be loaded.
     *
     * @since 0.1
     * @static
     * @return dt_sample_roles instance
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
    public function __construct () {    } // End __construct()

    public function reset_roles() {
        if (class_exists('Disciple_Tools')) {

            dt_reset_system_roles();
            return 'Success';

        }
        else {
            return "Did not reset roles";
        }
    }

}