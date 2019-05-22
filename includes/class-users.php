<?php

/*
 * Class for creating sample users
 *
 * @package dmm-crm-sample-data
 * */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class DT_Demo_Users
{

    /**
     * DT_Demo_Users The single instance of DT_Demo_Users.
     * @var    object
     * @access  private
     * @since    1.0.0
     */
    private static $_instance = null;

    /**
     * Access plugin instance. You can create further instances by calling
     * the constructor directly.
     * @since 0.1
     * @static
     * @return DT_Demo_Users instance
     */
    public static function instance(){
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Constructor class
    public function __construct() {}

    /**
     * Primary addition function for users
     * The first line adds the core users used to sign in and test different views of the system
     * The second line adds random users to each of the roles for load testing.
     * @param $count
     * @return string
     */
    public function add_users_combined( $count ) {
        $this->add_users_once();
        $this->add_users_by_count( $count );

        return 'Users added';

    }

    /**
     * Sets a check so that the core users are added only one time.
     * @return string
     */
    public function add_users_once() {
        $html = '';

        if (get_option( 'add_sample_users' ) !== '1') {

            $html .= $this->add_users();

            $option = 'add_sample_users';
            $value = '1';
            $autoload = false;

            add_option( $option, $value, "", $autoload );

        } else {
            $html .= '<p>Core users are already loaded. Confirm you want to ... <form method="POST"><button type="submit" value="reset_users" name="submit" class="button" id="reset_users">Reset Core Users</button></p>';
        }
        return $html;
    }

    /**
     * Builds the core user profiles for different roles.
     * @return string
     */
    protected function add_users() {
        $html       = '';
        $meta_key   = '_sample';
        $meta_value = 'sample';

        if ( null == username_exists( 'Marketer' ) ) {

            // Create user
            $username = 'Marketer';
            $password = 'disciple';
            $email = 'marketer@disciple.tools';
            $user_id = wp_create_user( $username, $password, $email );

            // Set the nickname
            wp_update_user(
                array(
                    'ID'         => $user_id,
                    'nickname'   => $username,
                    'first_name' => 'Marketer'
                )
            );
            update_user_meta( $user_id, $meta_key, $meta_value );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'marketer' );

            // Report
            $html .= '<br>Added: ' . $username;
        } else {
            $html .= '<br>Marketer set';
        }

        if ( null == username_exists( 'Dispatcher' ) ) {

            // Create user
            $username = 'Dispatcher';
            $password = 'disciple';
            $email = 'dispatcher@disciple.tools';
            $user_id = wp_create_user( $username, $password, $email );

            // Set the nickname
            wp_update_user(
                array(
                    'ID'         => $user_id,
                    'nickname'   => $username,
                    'first_name' => 'Dispatcher'
                )
            );
            update_user_meta( $user_id, $meta_key, $meta_value );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'dispatcher' );

            // Report
            $html .= '<br>Added: ' . $username;
        } else {
            $html .= '<br>Dispatcher set';
        }

        if ( null == username_exists( 'Multiplier' ) ) {

            // Create user
            $username = 'Multiplier';
            $password = 'disciple';
            $email = 'multiplier@disciple.tools';
            $user_id = wp_create_user( $username, $password, $email );

            // Set the nickname
            wp_update_user(
                array(
                    'ID'         => $user_id,
                    'nickname'   => $username,
                    'first_name' => 'Multiplier'
                )
            );
            update_user_meta( $user_id, $meta_key, $meta_value );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'multiplier' );

            // Report
            $html .= '<br>Added: ' . $username;
        } else {
            $html .= '<br>Multiplier set';
        }

        if ( null == username_exists( 'Strategist' ) ) {

            // Create user
            $username = 'Strategist';
            $password = 'disciple';
            $email    = 'strategist@disciple.tools';
            $user_id  = wp_create_user( $username, $password, $email );

            // Set the nickname
            wp_update_user(
                array(
                    'ID'         => $user_id,
                    'nickname'   => $username,
                    'first_name' => 'Strategist'
                )
            );
            update_user_meta( $user_id, $meta_key, $meta_value );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'strategist' );

            // Report
            $html .= '<br>Added: ' . $username;
        } else {
            $html .= '<br>Strategist set';
        }

        return $html;
    }



    /******************************************************************************/
    /* Section :  Bulk Addition of Users */

    public function add_users_by_count( $count = 5 ) {
        $inc        = 0;
        $report     = 0;
        $i          = rand( 100, 999 );
        $meta_key   = '_sample';
        $meta_value = 'sample';

        while ( $count > $inc ) {

            $password = 'disciple';

            // Create Marketer
            $username = 'marketer' . $i;
            $email    = $username . '@disciple.tools';
            $user_id  = wp_create_user( $username, $password, $email );

            // Set the nickname
            wp_update_user(
                array(
                    'ID'         => $user_id,
                    'nickname'   => $username,
                    'first_name' => 'Marketer ' . $i,
                )
            );
            update_user_meta( $user_id, $meta_key, $meta_value );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'marketer' );


            // Create Strategy
            $username = 'strategist' . $i;
            $email    = $username . '@disciple.tools';
            $user_id  = wp_create_user( $username, $password, $email );

            // Set the nickname
            wp_update_user(
                array(
                    'ID'         => $user_id,
                    'nickname'   => $username,
                    'first_name' => 'Strategist ' . $i,
                )
            );
            update_user_meta( $user_id, $meta_key, $meta_value );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'strategist' );


            // Create Dispatcher
            $username = 'dispatcher' . $i;
            $email    = $username . '@disciple.tools';
            $user_id  = wp_create_user( $username, $password, $email );

            // Set the nickname
            wp_update_user(
                array(
                    'ID'         => $user_id,
                    'nickname'   => $username,
                    'first_name' => 'Dispatcher ' . $i,
                )
            );
            update_user_meta( $user_id, $meta_key, $meta_value );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'dispatcher' );


            // Create Multiplier
            $username = 'multiplier' . $i;
            $email    = $username . '@disciple.tools';
            $user_id  = wp_create_user( $username, $password, $email );

            // Set the nickname
            wp_update_user(
                array(
                    'ID'         => $user_id,
                    'nickname'   => $username,
                    'first_name' => 'Multiplier ' . $i,
                )
            );
            update_user_meta( $user_id, $meta_key, $meta_value );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'multiplier' );


            // Create Registered
            $username = 'registered' . $i;
            $email    = $username . '@disciple.tools';
            $user_id  = wp_create_user( $username, $password, $email );

            // Set the nickname
            wp_update_user(
                array(
                    'ID'         => $user_id,
                    'nickname'   => $username,
                    'first_name' => 'Registered ' . $i,
                )
            );
            update_user_meta( $user_id, $meta_key, $meta_value );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'registered' );

            $inc ++;
            $report ++;

        }


        return $report . ' sets of users created.';

    }


    /**
     * Add a single multiplier
     *
     * @param $i    int Unique key that will become part of the name & email of the record
     */
    public function add_multiplier( $i ) {
        $password = 'disciple';

        // Create Marketer
        $username = 'marketer' . $i;
        $email    = $username . '@disciple.tools';
        $user_id  = wp_create_user( $username, $password, $email );

        // Set the nickname
        wp_update_user(
            array(
                'ID'         => $user_id,
                'nickname'   => $username,
                'first_name' => 'Marketer ' . $i,
            )
        );
        update_user_meta( $user_id, '_sample', 'sample' );

        // Set the role
        $user = new WP_User( $user_id );
        $user->set_role( 'marketer' );
    }

    /**
     * Add a single marketer_leader
     *
     * @param $i    int Unique key that will become part of the name & email of the record
     */
    public function add_marketer_leader( $i ) {
        $password = 'disciple';

        $username = 'marketer_leader' . $i;
        $email    = $username . '@disciple.tools';
        $user_id  = wp_create_user( $username, $password, $email );

        // Set the nickname
        wp_update_user(
            array(
                'ID'         => $user_id,
                'nickname'   => $username,
                'first_name' => 'Marketer Leader ' . $i,
            )
        );
        update_user_meta( $user_id, '_sample', 'sample' );

        // Set the role
        $user = new WP_User( $user_id );
        $user->set_role( 'marketer_leader' );
    }

    /**
     * Add a single marketer_leader
     *
     * @param $i    int Unique key that will become part of the name & email of the record
     */
    public function add_marketer( $i ) {
        $password = 'disciple';

        $username = 'marketer' . $i;
        $email    = $username . '@disciple.tools';
        $user_id  = wp_create_user( $username, $password, $email );

        // Set the nickname
        wp_update_user(
            array(
                'ID'         => $user_id,
                'nickname'   => $username,
                'first_name' => 'Marketer ' . $i,
            )
        );
        update_user_meta( $user_id, '_sample', 'sample' );

        // Set the role
        $user = new WP_User( $user_id );
        $user->set_role( 'marketer' );
    }

    /**
     * Add a single marketer_leader
     *
     * @param $i    int Unique key that will become part of the name & email of the record
     */
    public function add_dispatcher( $i ) {
        $password = 'disciple';

        $username = 'dispatcher' . $i;
        $email    = $username . '@disciple.tools';
        $user_id  = wp_create_user( $username, $password, $email );

        // Set the nickname
        wp_update_user(
            array(
                'ID'         => $user_id,
                'nickname'   => $username,
                'first_name' => 'Dispatcher ' . $i,
            )
        );
        update_user_meta( $user_id, '_sample', 'sample' );

        // Set the role
        $user = new WP_User( $user_id );
        $user->set_role( 'dispatcher' );
    }

    /**
     * Add a single marketer_leader
     *
     * @param $i    int Unique key that will become part of the name & email of the record
     */
    public function add_strategist( $i ) {
        $password = 'disciple';

        // Create Marketer Leader
        $username = 'strategist' . $i;
        $email    = $username . '@disciple.tools';
        $user_id  = wp_create_user( $username, $password, $email );

        // Set the nickname
        wp_update_user(
            array(
                'ID'         => $user_id,
                'nickname'   => $username,
                'first_name' => 'Strategist ' . $i,
            )
        );
        update_user_meta( $user_id, '_sample', 'sample' );

        // Set the role
        $user = new WP_User( $user_id );
        $user->set_role( 'strategist' );
    }

    /**
     * Add a single marketer_leader
     *
     * @param $i    int Unique key that will become part of the name & email of the record
     */
    public function add_registered( $i ) {
        $password = 'disciple';

        $username = 'registered' . $i;
        $email    = $username . '@disciple.tools';
        $user_id  = wp_create_user( $username, $password, $email );

        // Set the nickname
        wp_update_user(
            array(
                'ID'         => $user_id,
                'nickname'   => $username,
                'first_name' => 'Registered ' . $i,
            )
        );
        update_user_meta( $user_id, '_sample', 'sample' );

        // Set the role
        $user = new WP_User( $user_id );
        $user->set_role( 'registered' );
    }


    /**
     * Resets the core users option and rechecks to see if all the users are added.
     * @return string
     */
    public function reset_users() {
        delete_option( 'add_sample_users' );
        $html = $this->add_users_once();

        return $html;
    }

    /**
     * Delete all sample users in database
     * @return string
     */
    public function delete_users() {
        if ( get_user_by( 'id', '1' ) ) {
            $reassign = '1';
        } else {
            $reassign = get_current_user_id();
        }

        $args    = array(
            'meta_key'   => '_sample',
            'meta_value' => 'sample',
        );
        $records = get_users( $args );

        foreach ( $records as $record ) {
            $id = $record->ID;
            wp_delete_user( $id, $reassign );
        }
        delete_option( 'add_sample_users' );

        return 'Records deleted';

    }

    /**
     * Deprecated
     *
     * @param int $count
     *
     * @return string
     */
    public function add_multipliers_by_count( $count = 5 ) {
        if ( get_option( '_sample_last_user_add' ) ) {

            $previous_number = get_option( '_sample_last_user_add' );

            $i = (int) $previous_number + 1;

            $count = (int) $previous_number + $count + 1;

        } else {

            $i = 1;

            $count++;

        }
        $report = 0;

        while ( $count > $i ) {

            $password = 'disciple';

            // Create Marketer
            $username = 'marketer' . $i;
            $email    = $username . '@disciple.tools';
            $user_id  = wp_create_user( $username, $password, $email );

            // Set the nickname
            wp_update_user(
                array(
                    'ID'         => $user_id,
                    'nickname'   => $username,
                    'first_name' => 'Marketer ' . $i,
                )
            );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'marketer' );

            // Create Multiplier
            $username = 'multiplier' . $i;
            $email = $username.'@disciple.tools';
            $user_id = wp_create_user( $username, $password, $email );

            // Set the nickname
            wp_update_user(
                array(
                    'ID'         => $user_id,
                    'nickname'   => $username,
                    'first_name' => 'Multiplier ' . $i,
                )
            );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'multiplier' );

            $i++;
            $report++;

        }

        update_option( '_sample_last_user_add', $i );

        return $report . ' sets of users created.';

    }


}