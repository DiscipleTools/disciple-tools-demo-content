<?php

/**
 * Disciple Tools Roles Sample
 *
 * @class DT_Demo_Roles
 * @version    0.1
 * @since 0.1
 * @package    DT_Demo_Roles
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly
}

class DT_Demo_Roles {

    /**
     * DT_Demo_Roles The single instance of DT_Demo_Roles.
     * @var     object
     * @access  private
     * @since     0.1
     */
    private static $_instance = null;

    /**
     * Main DT_Demo_Roles Instance
     *
     * Ensures only one instance of DT_Demo_Roles is loaded or can be loaded.
     *
     * @since 0.1
     * @static
     * @return DT_Demo_Roles instance
     */
    public static function instance () {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    /**
     * Constructor function.
     * @access  public
     * @since   0.1
     */
    public function __construct () {    } // End __construct()

    public function reset_roles() {
        if (class_exists( 'Disciple_Tools' )) {

            if (file_exists( get_home_path() . 'wp-content/plugins/disciple-tools/dt-core/admin/class-roles.php' )) {
                require_once( get_home_path() . 'wp-content/plugins/disciple-tools/dt-core/admin/class-roles.php' );
                $roles = Disciple_Tools_Roles::instance();
                $roles->set_roles();
                return 'Success';
            } else {
                return "failed to connect to " . get_home_path() . 'wp-content/plugins/disciple-tools/dt-core/admin/class-roles.php';
            }
        }
        else {
            return "Did not reset roles";
        }
    }

}