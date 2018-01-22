<?php

/**
 * Plugin Name: Disciple Tools - Demo
 * Plugin URI: https://github.com/DiscipleTools/disciple-tools-demo-plugin
 * Description: Disciple Tools Demo Plugin. This plugin provides instant contacts, groups, users, and content to assist in rapid launch for training or demonstration.
 * Version: 0.1.0
 * Author: Chasm.Solutions & Kingdom.Training
 * Author URI: https://github.com/DiscipleTools
 *
 * @license GPL-2.0 or later
 *          https://www.gnu.org/licenses/gpl-2.0.html
 */
if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly
}

/**
 * Singleton class for setting up the plugin.
 *
 * @since  0.1
 * @access public
 */
class DT_Demo {

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
            $instance = new dt_demo;
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
        return 'dt_demo';
    }

    /**
     * Magic method to keep the object from being cloned.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public function __clone() {
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Whoah, partner!', 'dt_demo' ), '0.1' );
    }

    /**
     * Magic method to keep the object from being unserialized.
     *
     * @since  0.1
     * @access public
     * @return void
     */
    public function __wakeup() {
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Whoah, partner!', 'dt_demo' ), '0.1' );
    }

    /**
     * Magic method to prevent a fatal error when calling a method that doesn't exist.
     *
     * @since  0.1
     * @access public
     * @return null
     */
    public function __call( $method = '', $args = array() ) {
        _doing_it_wrong( "dt_demo::{$method}", esc_html__( 'Method does not exist.', 'dt_demo' ), '0.1' );
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
        $this->dir_uri      = trailingslashit( plugin_dir_url( __FILE__ ) );

        // Plugin directory paths.
        $this->classes      = trailingslashit( $this->dir_path . 'classes' );

        // Plugin directory URIs.
        $this->img_uri      = trailingslashit( $this->dir_uri . 'img' );

        // Admin and settings variables
        $this->token             = 'dt_demo';
        $this->version             = '0.1';
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
            require_once( 'classes/class-menu.php' );
            $this->page = DT_Demo_Page::instance();


            // Tabs
            require_once( 'classes/class-tab-add-records.php' );
            $this->add_records = DT_Demo_Add_Records::instance();

            require_once( 'classes/class-tab-bulk-report.php' ); // tab page with various forms
            $this->add_report = DT_Demo_Add_Report::instance();

            require_once( 'classes/class-tab-tutorials.php' );
            $this->tutorials = DT_Demo_Tutorials::instance();



            // Content addition
            require_once( 'classes/class-users.php' );
            $this->users = DT_Demo_Users::instance();

            require_once( 'classes/class-contacts.php' );
            $this->contacts = DT_Demo_Contacts::instance();

            require_once( 'classes/class-groups.php' );
            $this->groups = DT_Demo_Groups::instance();

            require_once( 'classes/class-locations.php' );
            $this->locations = DT_Demo_Locations::instance();

            require_once( 'classes/class-assets.php' );
            $this->assets = DT_Demo_Assets::instance();

            require_once( 'classes/class-comments.php' );
            $this->comments = DT_Demo_Comments::instance();

            require_once( 'classes/class-prayer-post.php' );
            $this->prayer = DT_Demo_Prayer_Post::instance();

            require_once( 'classes/class-progress-post.php' );
            $this->progress = DT_Demo_Progress_Post::instance();

            require_once( 'classes/class-connections.php' );
            $this->connections = DT_Demo_Connections::instance();

            require_once( 'classes/class-core-pages.php' );
            $this->content = DT_Core_Pages::instance();

            $theme = wp_get_theme();
            if ( $theme->name = "Disciple_Tools" ) {
                require_once( 'classes/class-roles.php' );
                $this->roles = DT_Demo_Roles::instance();
            }

            // Utilities
            require_once( 'functions/randomizer.php' );
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

        // Check for plugin updates
        if ( ! class_exists( 'Puc_v4_Factory' ) ) {
            require( 'functions/plugin-update-checker/plugin-update-checker.php' );
        }
        Puc_v4_Factory::buildUpdateChecker(
            'https://raw.githubusercontent.com/DiscipleTools/disciple-tools-version-control/master/disciple-tools-demo-plugin-version-control.json',
            __FILE__,
            'disciple-tools-demo-plugin'
        );

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
        load_plugin_textdomain( 'dt_demo', false, trailingslashit( dirname( plugin_basename( __FILE__ ) ) ). 'languages' );
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
 * Gets the instance of the `dt_demo` class.  This function is useful for quickly grabbing data
 * used throughout the plugin.
 *
 * @since  0.1
 * @access public
 * @return object
 */
function DT_Demo() {
    return DT_Demo::get_instance();
}

// Let's roll!
add_action( 'plugins_loaded', 'DT_Demo' );


