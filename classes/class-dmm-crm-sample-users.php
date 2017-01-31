<?php

/*
 * Class for creating sample users
 *
 * @package dmm-crm-sample-data
 * */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class dmm_crm_sample_users
{

    /**
     * dmm_crm_sample_users The single instance of dmm_crm_sample_users.
     * @var    object
     * @access  private
     * @since    1.0.0
     */
    private static $_instance = NULL;

    /**
     * Access plugin instance. You can create further instances by calling
     * the constructor directly.
     * @since 0.1
     * @static
     * @return dmm_crm_sample_users instance
     */
    public static function instance()
    {
        if (NULL === self::$_instance)
            self::$_instance = new self;
        return self::$_instance;
    }

    // Constructor class
    public function __construct() {}

    /*
     * Sets a check so that the groups are added only one time.
     *
     *
     * @return string
     */
    public function add_users_once () {
        $html = '';

        if (get_option('add_sample_users') !== '1') {

            $html .= $this->add_users();

            $option = 'add_sample_users';
            $value = '1';
            $deprecated = '';
            $autoload = TRUE;

            add_option($option, $value, $deprecated, $autoload);

        } else {
            $html .= '<p>Users are already loaded. <form method="POST"><button type="submit" value="reset_users" name="reset_users" class="button" id="reset_users">Reset full set of sample users</button></p>';
        }
        return $html;
    }

    protected function add_users ()
    {
        $html = '';

        if( null == username_exists( 'Marketer' ) ) {

            // Create user
            $username = 'Marketer';
            $password = 'dmmcrm';
            $email = 'marketer@dmmcrm.com';
            $user_id = wp_create_user( $username, $password, $email );

            // Set the nickname
            wp_update_user(
                array(
                    'ID'          =>    $user_id,
                    'nickname'    =>    $username,
                    'first_name'  =>    'Marketer'
                )
            );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'marketer' );

            // Report
            $html .= '<br>Added: ' . $username ;
        } // end if

        if( null == username_exists( 'Dispatcher' ) ) {

            // Create user
            $username = 'Dispatcher';
            $password = 'dmmcrm';
            $email = 'dispatcher@dmmcrm.com';
            $user_id = wp_create_user( $username, $password, $email );

            // Set the nickname
            wp_update_user(
                array(
                    'ID'          =>    $user_id,
                    'nickname'    =>    $username,
                    'first_name'  =>    'Dispatcher'
                )
            );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'dispatcher' );

            // Report
            $html .= '<br>Added: ' . $username ;
        } // end if

        if( null == username_exists( 'Multiplier' ) ) {

            // Create user
            $username = 'Multiplier';
            $password = 'dmmcrm';
            $email = 'multiplier@dmmcrm.com';
            $user_id = wp_create_user( $username, $password, $email );

            // Set the nickname
            wp_update_user(
                array(
                    'ID'          =>    $user_id,
                    'nickname'    =>    $username,
                    'first_name'  =>    'Multiplier'
                )
            );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'multiplier' );

            // Report
            $html .= '<br>Added: ' . $username ;
        } // end if

        if( null == username_exists( 'Multiplier_Leader' ) ) {

            // Create user
            $username = 'Multiplier_Leader';
            $password = 'dmmcrm';
            $email = 'multiplier_leader@dmmcrm.com';
            $user_id = wp_create_user( $username, $password, $email );

            // Set the nickname
            wp_update_user(
                array(
                    'ID'          =>    $user_id,
                    'nickname'    =>    $username,
                    'first_name'  =>    'Multiplier Leader'
                )
            );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'multiplier_leader' );

            // Report
            $html .= '<br>Added: ' . $username ;
        } // end if

        if( null == username_exists( 'Prayer_Supporter' ) ) {

            // Create user
            $username = 'Prayer_Supporter';
            $password = 'dmmcrm';
            $email = 'prayer_supporter@dmmcrm.com';
            $user_id = wp_create_user( $username, $password, $email );

            // Set the nickname
            wp_update_user(
                array(
                    'ID'          =>    $user_id,
                    'nickname'    =>    $username,
                    'first_name'  =>    'Prayer Supporter'
                )
            );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'prayer_supporter' );

            // Report
            $html .= '<br>Added: ' . $username ;
        } // end if

        if( null == username_exists( 'Project_Supporter' ) ) {

            // Create user
            $username = 'Project_Supporter';
            $password = 'dmmcrm';
            $email = 'project_supporter@dmmcrm.com';
            $user_id = wp_create_user( $username, $password, $email );

            // Set the nickname
            wp_update_user(
                array(
                    'ID'          =>    $user_id,
                    'nickname'    =>    $username,
                    'first_name'  =>    'Project Supporter'
                )
            );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'project_supporter' );

            // Report
            $html .= '<br>Added: ' . $username ;
        } // end if

        if( null == username_exists( 'Registered' ) ) {

            // Create user
            $username = 'Registered';
            $password = 'dmmcrm';
            $email = 'registered@dmmcrm.com';
            $user_id = wp_create_user( $username, $password, $email );

            // Set the nickname
            wp_update_user(
                array(
                    'ID'          =>    $user_id,
                    'nickname'    =>    $username,
                    'first_name'  => 'Registered'
                )
            );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'registered' );

            // Report
            $html .= '<br>Added: ' . $username ;
        } // end if

        return $html;
    }

    /*
     * Resets the if option for groups
     *
     * @return string
     *
     */
    public function reset_users () {
        delete_option('add_sample_users');
        $html = $this->add_users_once();
        return $html;
    }

    public function delete_sample_users () {
//        $id = get_user_by( 'email', 'project_supporter@dmmcrm.com' );
//        wp_delete_user( $id, $reassign );
    }

}