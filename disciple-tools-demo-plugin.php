<?php

/**
 * Plugin Name: Disciple Tools - Demo
 * Plugin URI: https://github.com/ChasmSolutions/disciple-tools-training
 * Description: Disciple Tools Demo Plugin. This plugin provides instant contacts, groups, users, and content to assist in rapid launch for training or demonstration.
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
class dt_training {

    /**
     * The token.
     * @var     string
     * @access  public
     * @since   0.1
     */
    public $token;
    public $setup_info;
    public $add_report;
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
            $instance = new dt_training;
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
     * @return string
     */
    public function __toString() {
        return 'dt_training';
    }

    /**
     * Magic method to keep the object from being cloned.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public function __clone() {
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Whoah, partner!', 'dt_training' ), '0.1' );
    }

    /**
     * Magic method to keep the object from being unserialized.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public function __wakeup() {
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Whoah, partner!', 'dt_training' ), '0.1' );
    }

    /**
     * Magic method to prevent a fatal error when calling a method that doesn't exist.
     *
     * @since  0.1
     * @access public
     * @return null
     */
    public function __call( $method = '', $args = array() ) {
        _doing_it_wrong( "dt_training::{$method}", esc_html__( 'Method does not exist.', 'dt_training' ), '0.1' );
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
        $this->token 			= 'dt_training';
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

            // Admin menu
            require_once('classes/class-menu.php');
            $this->page = dt_training_page::instance();


            // Tabs
            require_once('classes/class-tab-add-records.php');
            $this->add_records = dt_training_add_records::instance();

            require_once('classes/class-tab-bulk-report.php'); // tab page with various forms
            $this->add_report = dt_training_add_report::instance();

            require_once('classes/class-tab-tutorials.php');
            $this->tutorials = dt_training_tutorials::instance();



            // Content addition
            require_once('classes/class-users.php');
            $this->users = dt_training_users::instance();

            require_once('classes/class-contacts.php');
            $this->contacts = dt_training_contacts::instance();

            require_once('classes/class-groups.php');
            $this->groups = dt_training_groups::instance();

            require_once('classes/class-locations.php');
            $this->locations = dt_training_locations::instance();

            require_once('classes/class-assets.php');
            $this->assets = dt_training_assets::instance();

            require_once('classes/class-comments.php');
            $this->comments = dt_training_comments::instance();

            require_once('classes/class-prayer-post.php');
            $this->prayer = dt_training_prayer_post::instance();

            require_once('classes/class-progress-post.php');
            $this->progress = dt_training_progress_post::instance();

            require_once('classes/class-connections.php');
            $this->connections = dt_training_connections::instance();

            require_once('classes/class-core-pages.php');
            $this->content = dt_core_pages::instance();

            if ( class_exists('Disciple_Tools')) { // resets the default roles
                require_once('classes/class-roles.php');
                $this->roles = dt_training_roles::instance();
            }

            // Utilities
            require_once('functions/randomizer.php');
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
        load_plugin_textdomain( 'dt_training', false, trailingslashit( dirname( plugin_basename( __FILE__ ) ) ). 'languages' );
    }

    /**
     * Method that runs only when the plugin is activated.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public function activation() {

    }
}

/**
 * Gets the instance of the `dt_training` class.  This function is useful for quickly grabbing data
 * used throughout the plugin.
 *
 * @since  0.1
 * @access public
 * @return object
 */
function dt_training_plugin() {
    return dt_training::get_instance();
}

// Let's roll!
add_action( 'plugins_loaded', 'dt_training_plugin' );


