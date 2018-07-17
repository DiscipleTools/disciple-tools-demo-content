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
            $this->namespace, '/quick_launch/contacts', [
                "methods"  => "POST",
                "callback" => [ $this, 'quick_launch_contacts' ],
            ]
        );
        register_rest_route(
            $this->namespace, '/quick_launch/contacts', [
                "methods"  => "DELETE",
                "callback" => [ $this, 'delete_quick_launch_contacts' ],
            ]
        );
        register_rest_route(
            $this->namespace, '/quick_launch/hide_on_startup', [
                "methods"  => "GET",
                "callback" => [ $this, 'hide_on_startup' ],
            ]
        );
        register_rest_route(
            $this->namespace, '/quick_launch/create_contact', [
                "methods"  => "POST",
                "callback" => [ $this, 'create_contact' ],
            ]
        );
        register_rest_route(
            $this->namespace, '/quick_launch/create_group', [
                "methods"  => "POST",
                "callback" => [ $this, 'create_group' ],
            ]
        );
        register_rest_route(
            $this->namespace, '/quick_launch/create_user', [
                "methods"  => "POST",
                "callback" => [ $this, 'create_user' ],
            ]
        );
        register_rest_route(
            $this->namespace, '/quick_launch/create_locations', [
                "methods"  => "POST",
                "callback" => [ $this, 'create_locations' ],
            ]
        );
        register_rest_route(
            $this->namespace, '/quick_launch/create_initial_comments', [
                "methods"  => "POST",
                "callback" => [ $this, 'create_initial_comments' ],
            ]
        );
        register_rest_route(
            $this->namespace, '/quick_launch/install_demo_data', [
                "methods"  => "POST",
                "callback" => [ $this, 'install_demo_data' ],
            ]
        );

    }

    public function quick_launch_contacts(){
        if ( user_can( get_current_user_id(),'manage_options' ) ) {
            require_once( 'class-prepared-data.php' );
            $prepared_data = DT_Demo_Prepared_Data::instance();
            return $prepared_data->add_prepared_demo_data();
        } else {
            return new WP_Error( "permission_error", "Do not have permission to install demo content", array( 'status' => 400 ) );
        }
    }

    public function delete_quick_launch_contacts(){
        if ( user_can( get_current_user_id(),'manage_options' ) ) {
            require_once( 'class-prepared-data.php' );
            $prepared_data = DT_Demo_Prepared_Data::instance();
            return $prepared_data->delete_prepared_demo_data();
        } else {
            return new WP_Error( "permission_error", "Do not have permission to install demo content", array( 'status' => 400 ) );
        }
    }

    /**
     * @param \WP_REST_Request $request
     *
     * @return array|\WP_Error
     */
    public function create_user( WP_REST_Request $request ){
        if ( user_can( get_current_user_id(), 'manage_dt' ) ) {
            return DT_Demo_Data::add_demo_users();
        } else {
            return new WP_Error( "permission_error", "Do not have permission to install demo content", array( 'status' => 400 ) );
        }
    }

    public function create_locations( WP_REST_Request $request ){
        if ( user_can( get_current_user_id(), 'manage_dt' ) ) {
            $rows_affected = DT_Demo_Data::install_prepared_locations();
            if ($rows_affected > 0 ) {
                $query_object = new WP_Query(['post_type' => 'locations', 'post_status' => 'publish', 'nopaging' => true ]);
                return $query_object->posts;
            } else {
                return false;
            }
        } else {
            return new WP_Error( "permission_error", "Do not have permission to install demo content", array( 'status' => 400 ) );
        }
    }

    public function hide_on_startup(){
        update_option( 'dt_demo_sample_data', true, false );
    }

    public function create_contact( WP_REST_Request $request ){
        if ( user_can( get_current_user_id(), 'manage_dt' ) ) {
            $post = DT_Demo_Data::single_plain_contact();
            $contact_id = Disciple_Tools_Contacts::create_contact( $post, false );
            if ( !is_wp_error( $contact_id )){
                update_post_meta( $contact_id, "_sample", "sample" );
            } else {
                return new WP_Error( __METHOD__, "Failed to create contact" );
            }
            return true;
        } else {
            return new WP_Error( "permission_error", "Do not have permission to install demo content", array( 'status' => 400 ) );
        }
    }

    public function create_group( WP_REST_Request $request ){
        if ( user_can( get_current_user_id(), 'manage_dt' ) ) {
            $class = DT_Demo_Groups::instance();
            $post = $class->single_plain_group();
            $record_id = Disciple_Tools_Groups::create_group( $post, false );
            if ( !is_wp_error( $record_id )){
                update_post_meta( $record_id, "_sample", "sample" );
            } else {
                return new WP_Error( __METHOD__, "Failed to create contact" );
            }
            return true;
        } else {
            return new WP_Error( "permission_error", "Do not have permission to install demo content", array( 'status' => 400 ) );
        }
    }

    public function create_initial_comments( WP_REST_Request $request ){
        $params = $request->get_json_params();

        if ( user_can( get_current_user_id(), 'manage_dt' ) ) {

            if ( isset( $params['contacts'] ) && isset( $params['users']) ) {
                return DT_Demo_Data::create_initial_comments( $params['contacts'], $params['users'] );
            } else {
                return new WP_Error( __METHOD__, "Missing parameters" );
            }
        } else {
            return new WP_Error( "permission_error", "Do not have permission to install demo content", array( 'status' => 400 ) );
        }
    }

    public function install_demo_data( WP_REST_Request $request ){
        if ( user_can( get_current_user_id(), 'manage_dt' ) ) {
            return DT_Demo_Data::install_data();
        } else {
            return new WP_Error( "permission_error", "Do not have permission to install demo content", array( 'status' => 400 ) );
        }
    }
}
