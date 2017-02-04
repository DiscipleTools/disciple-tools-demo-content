<?php

/**
 * Plugin Name: Sample Data for DMM CRM Project
 * Plugin URI: https://github.com/ChasmSolutions/dmm-crm-sample-data
 * Description: Sample Data for DMM CRM Project
 * Version: 0.1
 * Author: Chasm.Solutions & Kingdom.Training
 * Author URI: https://github.com/ChasmSolutions
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Singleton class for setting up the plugin.
 *
 * @since  0.1
 * @access public
 */
final class dmm_crm_sample_data {

    /**
     * The token.
     * @var     string
     * @access  public
     * @since   0.1
     */
    public $token;

    /**
     * The version number.
     * @var     string
     * @access  public
     * @since   0.1
     */
    public $version;
    /**
     * The admin object.
     * @var     object
     * @access  public
     * @since   0.1
     */
    public $admin;

    /**
     * The settings object.
     * @var     object
     * @access  public
     * @since   0.1
     */
    public $settings;
    /**
     * The contacts object.
     * @var     object
     * @access  public
     * @since   0.1
     */
    public $contacts;
    /**
     * The groups object.
     * @var     object
     * @access  public
     * @since   0.1
     */
    public $groups;
    /**
     * The users object.
     * @var     object
     * @access  public
     * @since   0.1
     */
    public $users;
    /**
     * The settings object.
     * @var     object
     * @access  public
     * @since   0.1
     */
    public $page;
    /**
     * The settings object.
     * @var     object
     * @access  public
     * @since   0.1
     */
    public $classes;
    /**
     * The generations class object.
     * @var     object
     * @access  public
     * @since   0.1
     */
    public $generations;
    /**
     * Plugin directory path.
     *
     * @since  0.1
     * @access public
     * @var    string
     */
    public $dir_path = '';

    /**
     * Plugin directory URI.
     *
     * @since  0.1
     * @access public
     * @var    string
     */
    public $dir_uri = '';

    /**
     * Plugin image directory URI.
     *
     * @since  0.1
     * @access public
     * @var    string
     */
    public $img_uri = '';

    /**
     * Returns the instance.
     *
     * @since  0.1
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
     * @since  0.1
     * @access private
     * @return void
     */
    private function __construct() {


    }

    /**
     * Magic method to output a string if trying to use the object as a string.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public function __toString() {
        return 'dmmcrmsample';
    }

    /**
     * Magic method to keep the object from being cloned.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public function __clone() {
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Whoah, partner!', 'dmmcrmsample' ), '0.1' );
    }

    /**
     * Magic method to keep the object from being unserialized.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public function __wakeup() {
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Whoah, partner!', 'dmmcrmsample' ), '0.1' );
    }

    /**
     * Magic method to prevent a fatal error when calling a method that doesn't exist.
     *
     * @since  0.1
     * @access public
     * @return null
     */
    public function __call( $method = '', $args = array() ) {
        _doing_it_wrong( "dmm_crm_sample_data::{$method}", esc_html__( 'Method does not exist.', 'dmmcrmsample' ), '0.1' );
        unset( $method, $args );
        return null;
    }

    /**
     * Sets up globals.
     *
     * @since  0.1
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

        // Admin and settings variables
        $this->token 			= 'dmmcrmsample';
        $this->version 			= '0.1';


    }

    /**
     * Loads files needed by the plugin.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    private function includes() {

       // Load admin files.
        if ( is_admin() ) {

            // General functions.
            require_once( $this->classes . 'class-dmm-crm-sample-contacts.php' );
            $this->contacts = dmm_crm_sample_contacts::instance();

            require_once( $this->classes . 'class-dmm-crm-sample-groups.php' );
            $this->groups = dmm_crm_sample_groups::instance();

            require_once( $this->classes . 'class-dmm-crm-sample-users.php' );
            $this->users = dmm_crm_sample_users::instance();

            require_once( $this->classes . 'class-dmm-crm-sample-page.php' );
            $this->page = dmm_crm_sample_page::instance();

            require_once( $this->classes . 'class-dmm-crm-p2p-generations.php' );
            $this->generations = dmm_crm_p2p_generations::instance();

            require_once( $this->classes . 'config-theme-content.php' );
            $this->content = dmm_crm_theme_content::instance();

        }
    }



    /**
     * Sets up main plugin actions and filters.
     *
     * @since  0.1
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
     * @since  0.1
     * @access public
     * @return void
     */
    public function i18n() {
        load_plugin_textdomain( 'dmmcrmsample', false, trailingslashit( dirname( plugin_basename( __FILE__ ) ) ). 'languages' );
    }

    /**
     * Method that runs only when the plugin is activated.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public function activation() {

//        // Get the administrator role.
//        $role = get_role( 'administrator' );
//
//        // If the administrator role exists, add required capabilities for the plugin.
//        if ( ! empty( $role ) ) {
//
//            $role->add_cap( 'list_roles'       ); // View roles in backend.
//            $role->add_cap( 'create_roles'     ); // Create new roles.
//            $role->add_cap( 'delete_roles'     ); // Delete existing roles.
//            $role->add_cap( 'edit_roles'       ); // Edit existing roles/caps.
//            $role->add_cap( 'restrict_content' ); // Edit per-post content permissions.
//        }
    }
}

/**
 * Gets the instance of the `dmm_crm_sample_data` class.  This function is useful for quickly grabbing data
 * used throughout the plugin.
 *
 * @since  0.1
 * @access public
 * @return object
 */
function dmm_crm_sample_data_plugin() {
    return dmm_crm_sample_data::get_instance();
}

// Let's roll!
add_action( 'plugins_loaded', 'dmm_crm_sample_data_plugin' );


