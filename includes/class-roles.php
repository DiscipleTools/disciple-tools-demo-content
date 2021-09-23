<?php

/**
 * Disciple.Tools Roles Sample
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

    public function reset_roles() {
        if (class_exists( 'Disciple_Tools' )) {

            if (file_exists( get_home_path() . 'wp-content/themes/disciple-tools-theme/dt-core/admin/class-roles.php' )) {
                require_once( get_home_path() . 'wp-content/themes/disciple-tools-theme/dt-core/admin/class-roles.php' );
                $roles = Disciple_Tools_Roles::instance();
                $roles->reset_roles();
                $roles->set_roles();
                return 'Success';
            } else {
                return "failed to connect to " . get_home_path() . 'wp-content/themes/disciple-tools-theme/dt-core/admin/class-roles.php';
            }
        }
        else {
            return "Did not reset roles";
        }
    }

}