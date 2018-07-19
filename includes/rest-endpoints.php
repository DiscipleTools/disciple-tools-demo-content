<?php

/**
 * DT_Demo_Endpoints
 *
 * @class   DT_Demo_Endpoints
 * @version 0.1.0
 * @since   0.1.0
 * @package Disciple_Tools
 *
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

/**
 * Class DT_Demo_Endpoints
 */
class DT_Demo_Endpoints
{

    private $version = 1;
    private $context = "dt_demo";
    private $namespace;

    private static $_instance = null;
    public static function instance()
    {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        $this->namespace = $this->context . "/v" . intval( $this->version );
        add_action( 'rest_api_init', [ $this, 'add_api_routes' ] );
    }

    public function add_api_routes()
    {

        register_rest_route(
            $this->namespace, '/quick_launch/install_demo_data', [
                "methods"  => "POST",
                "callback" => [ $this, 'install_demo_data' ],
            ]
        );
        register_rest_route(
            $this->namespace, '/quick_launch/delete_demo_data', [
                "methods"  => "DELETE",
                "callback" => [ $this, 'delete_quick_launch' ],
            ]
        );
        register_rest_route(
            $this->namespace, '/quick_launch/hide_on_startup', [
                "methods"  => "POST",
                "callback" => [ $this, 'hide_on_startup' ],
            ]
        );
        register_rest_route(
            $this->namespace, '/add_contacts', [
                "methods"  => "POST",
                "callback" => [ $this, 'add_contacts' ],
            ]
        );
        register_rest_route(
            $this->namespace, '/delete_contacts', [
                "methods"  => "POST",
                "callback" => [ $this, 'delete_contacts' ],
            ]
        );
        register_rest_route(
            $this->namespace, '/add_groups', [
                "methods"  => "POST",
                "callback" => [ $this, 'add_groups' ],
            ]
        );
        register_rest_route(
            $this->namespace, '/delete_groups', [
                "methods"  => "POST",
                "callback" => [ $this, 'delete_groups' ],
            ]
        );
    }

    public function install_demo_data( WP_REST_Request $request ){
        if ( user_can( get_current_user_id(), 'manage_dt' ) ) {
            return DT_Demo_Data::install_data();
        } else {
            return new WP_Error( __METHOD__, "Do not have permission to install demo content", array( 'status' => 400 ) );
        }
    }

    public function delete_quick_launch(){
        if ( user_can( get_current_user_id(),'manage_options' ) ) {
            return DT_Demo_Data::delete_prepared_demo_data();
        } else {
            return new WP_Error( __METHOD__, "Do not have permission to install demo content", array( 'status' => 400 ) );
        }
    }

    public function hide_on_startup( WP_REST_Request $request ){
        if ( get_option( 'dt_demo_hide_popup' ) ) {
            update_option( 'dt_demo_hide_popup', 0, false );
            return 'off';
        } else {
            update_option( 'dt_demo_hide_popup', 1, false );
            return 'on';
        }
    }

    public function add_contacts( WP_REST_Request $request ){
        if ( user_can( get_current_user_id(), 'manage_dt' ) ) {
            require_once( 'class-contacts.php' );
            require_once( 'randomizer.php' );

            $object = DT_Demo_Contacts::instance();
            $results = $object->add_contacts_by_count( 20 );

            if ( $results ) {
                $post_count = wp_count_posts( 'contacts' );
                return $post_count->publish;
            } else {
                return new WP_Error( __METHOD__, "Failed to add contacts." );
            }
        } else {
            return new WP_Error( __METHOD__, "Failed to add contacts.", array( 'status' => 400 ) );
        }
    }

    public function delete_contacts( WP_REST_Request $request ){
        if ( user_can( get_current_user_id(), 'manage_dt' ) ) {
            require_once( 'class-contacts.php' );
            require_once( 'randomizer.php' );

            $object = DT_Demo_Contacts::instance();
            $results = $object->delete_contacts();

            if ( $results ) {
                $post_count = wp_count_posts( 'contacts' );
                return $post_count->publish;
            } else {
                return new WP_Error( __METHOD__, "Failed to add contacts." );
            }
        } else {
            return new WP_Error( __METHOD__, "Failed to add contacts.", array( 'status' => 400 ) );
        }
    }

    public function add_groups( WP_REST_Request $request ){
        if ( user_can( get_current_user_id(), 'manage_dt' ) ) {
            require_once( 'class-groups.php' );
            require_once( 'randomizer.php' );

            $object = DT_Demo_Groups::instance();
            $results = $object->add_groups_by_count( 20 );

            if ( $results ) {
                $post_count = wp_count_posts( 'groups' );
                return $post_count->publish;
            } else {
                return new WP_Error( __METHOD__, "Failed to add groups." );
            }
        } else {
            return new WP_Error( __METHOD__, "Failed to add groups.", array( 'status' => 400 ) );
        }
    }

    public function delete_groups( WP_REST_Request $request ){
        if ( user_can( get_current_user_id(), 'manage_dt' ) ) {
            require_once( 'class-groups.php' );
            require_once( 'randomizer.php' );

            $object = DT_Demo_Groups::instance();
            $results = $object->delete_groups();

            if ( $results ) {
                $post_count = wp_count_posts( 'groups' );
                return $post_count->publish;
            } else {
                return new WP_Error( __METHOD__, "Failed to add groups." );
            }
        } else {
            return new WP_Error( __METHOD__, "Failed to add groups.", array( 'status' => 400 ) );
        }
    }


}
DT_Demo_Endpoints::instance();