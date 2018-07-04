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

    public function hide_on_startup(){
        update_option( 'dt_demo_sample_data', true, false );
    }

    public function create_contact( WP_REST_Request $request ){
        if ( user_can( get_current_user_id(), 'manage_dt' ) ) {
            $class = DT_Demo_Contacts::instance();
            $post = $class->single_plain_contact();
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
    public function create_user( WP_REST_Request $request ){
        if ( user_can( get_current_user_id(), 'manage_dt' ) ) {
            // @todo build logic
            return true;
        } else {
            return new WP_Error( "permission_error", "Do not have permission to install demo content", array( 'status' => 400 ) );
        }
    }
}
