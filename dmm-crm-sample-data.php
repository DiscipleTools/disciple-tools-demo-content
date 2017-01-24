<?php

/**
 * Plugin Name: Sample Data for DMM CRM Project
 * Plugin URI: https://github.com/ChasmSolutions/dmm-crm-sample-data
 * Description: Sample Data for DMM CRM Project
 * Version: 0.0.1
 * Author: Chasm.Solutions & Kingdom.Training
 * Author URI: https://github.com/ChasmSolutions
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Singleton class for setting up the plugin.
 *
 * @since  1.0.0
 * @access public
 */
final class dmm_crm_sample_data {

    /**
     * Plugin directory path.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $dir_path = '';

    /**
     * Plugin directory URI.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $dir_uri = '';

    /**
     * Plugin admin directory path.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $admin_dir = '';

    /**
     * Plugin includes directory path.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $inc_dir = '';

    /**
     * Plugin templates directory path.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $templates_dir = '';

    /**
     * Plugin CSS directory URI.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $css_uri = '';

    /**
     * Plugin JS directory URI.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $js_uri = '';

    /**
     * Returns the instance.
     *
     * @since  1.0.0
     * @access public
     * @return object
     */
    public static function get_instance() {

        static $instance = null;

        if ( is_null( $instance ) ) {
            $instance = new dmm_crm_sample_data;
            $instance->setup();
            $instance->includes();
            $instance->setup_actions();


        }

        return $instance;
    }

    /**
     * Constructor method.
     *
     * @since  1.0.0
     * @access private
     * @return void
     */
    private function __construct() {


    }

    /**
     * Magic method to output a string if trying to use the object as a string.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function __toString() {
        return 'dmmcrmsample';
    }

    /**
     * Magic method to keep the object from being cloned.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function __clone() {
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Whoah, partner!', 'dmmcrmsample' ), '1.0.0' );
    }

    /**
     * Magic method to keep the object from being unserialized.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function __wakeup() {
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Whoah, partner!', 'dmmcrmsample' ), '1.0.0' );
    }

    /**
     * Magic method to prevent a fatal error when calling a method that doesn't exist.
     *
     * @since  1.0.0
     * @access public
     * @return null
     */
    public function __call( $method = '', $args = array() ) {
        _doing_it_wrong( "dmm_crm_sample_data::{$method}", esc_html__( 'Method does not exist.', 'dmmcrmsample' ), '1.0.0' );
        unset( $method, $args );
        return null;
    }

    /**
     * Sets up globals.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    private function setup() {

        // Main plugin directory path and URI.
        $this->dir_path     = trailingslashit( plugin_dir_path( __FILE__ ) );
        $this->dir_uri      = trailingslashit( plugin_dir_url(  __FILE__ ) );

        // Plugin directory paths.
        $this->classes      = trailingslashit( $this->dir_path . 'classes' );

        // Plugin directory URIs.
        $this->img_uri      = trailingslashit( $this->dir_uri . 'img' );



    }

    /**
     * Loads files needed by the plugin.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    private function includes() {

       // Load admin files.
        if ( is_admin() ) {

            // General functions.
            require_once( $this->classes . 'class-dmm-crm-sample-admin.php' );
            //$this->adminpage = dmmcrm_sample_data_admin::instance();
            // TODO: Not finished configuring admin page. Need to integrate it into the new plugin.

            require_once( $this->classes . 'class-dmm-crm-sample-contacts.php' );
            $this->contacts = new dmm_crm_sample_contacts();

            require_once( $this->classes . 'class-dmm-crm-sample-groups.php' );
            require_once( $this->classes . 'class-dmm-crm-sample-settings.php' );



           // $this->settings = Starter_Plugin_Settings::instance();

        }
    }

    /**
     * Sets up main plugin actions and filters.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    private function setup_actions() {

        // Internationalize the text strings used.
        add_action( 'plugins_loaded', array( $this, 'i18n' ), 2 );

        // Register activation hook.
        register_activation_hook( __FILE__, array( $this, 'activation' ) );
    }

    /**
     * Loads the translation files.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function i18n() {
        load_plugin_textdomain( 'dmmcrmsample', false, trailingslashit( dirname( plugin_basename( __FILE__ ) ) ). 'languages' );
    }

    /**
     * Method that runs only when the plugin is activated.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function activation() {

        // Get the administrator role.
        $role = get_role( 'administrator' );

        // If the administrator role exists, add required capabilities for the plugin.
        if ( ! empty( $role ) ) {

            $role->add_cap( 'list_roles'       ); // View roles in backend.
            $role->add_cap( 'create_roles'     ); // Create new roles.
            $role->add_cap( 'delete_roles'     ); // Delete existing roles.
            $role->add_cap( 'edit_roles'       ); // Edit existing roles/caps.
            $role->add_cap( 'restrict_content' ); // Edit per-post content permissions.
        }
    }
}

/**
 * Gets the instance of the `dmm_crm_sample_data` class.  This function is useful for quickly grabbing data
 * used throughout the plugin.
 *
 * @since  1.0.0
 * @access public
 * @return object
 */
function dmm_crm_sample_data_plugin() {
    return dmm_crm_sample_data::get_instance();
}

// Let's roll!
dmm_crm_sample_data_plugin();

