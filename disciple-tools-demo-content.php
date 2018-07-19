<?php

/**
 * Plugin Name: Disciple Tools - Demo Content
 * Plugin URI: https://github.com/DiscipleTools/disciple-tools-demo-content
 * Description: The demo content plugin is for a quickstart with content to the Disciple.Tools system. It is useful for demonstration and training.
 * Version: 0.3.0
 * Author URI: https://github.com/DiscipleTools
 *
 * @license GPL-2.0 or later
 *          https://www.gnu.org/licenses/gpl-2.0.html
 */
if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly
}

/**
 * Test for minimum required PHP version
 */
if ( version_compare( phpversion(), '7.0', '<' ) ) {

    /* We only support PHP >= 7.0, however, we want to support allowing users
     * to install this theme even on old versions of PHP, without showing a
     * horrible message, but instead a friendly notice.
     *
     * For this to work, this file must be compatible with old PHP versions.
     * Feel free to use PHP 7 features in other files, but not in this one.
     */

    new WP_Error( 'php_version_fail', 'Requires PHP version 7.0 or greater. Your current version is: '.phpversion().' Please upgrade PHP or uninstall this plugin' );
    require_once( ABSPATH .'wp-admin/includes/plugin.php' );
    deactivate_plugins( 'Disciple Tools Demo Content' );
}
else {

    /**
     * Gets the instance of the `DT_Demo` class.
     *
     * @since  0.1
     * @access public
     * @return object
     */
    function dt_demo() {
        $current_theme = get_option( 'current_theme' );

        if ( 'Disciple Tools' == $current_theme || dt_is_child_theme_of_disciple_tools() ) {
            return DT_Demo::get_instance();
        }
        else {
            add_action( 'admin_notices', 'dt_demo_hook_admin_notice' );
            add_action( 'wp_ajax_dismissed_notice_handler', 'dt_demo_ajax_notice_handler' );
            return new WP_Error( 'current_theme_not_dt', 'Disciple Tools Theme not active.' );
        }
    }
    add_action( 'plugins_loaded', 'dt_demo' );

    /**
     * Singleton class for setting up the plugin.
     *
     * @since  0.1
     * @access public
     */
    class DT_Demo {

        public $token;
        public $setup_info;
        public $add_report;
        public $version;
        public $admin;
        public $settings;
        public $contacts;
        public $groups;
        public $users;
        public $page;
        public $classes;
        public $generations;
        public $dir_path = '';
        public $dir_uri = '';
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
            $this->includes_path      = trailingslashit( $this->dir_path . 'includes' );

            // Plugin directory URIs.
            $this->includes_uri      = trailingslashit( $this->dir_uri . 'includes' );

            // Admin and settings variables
            $this->token       = 'dt_demo';
            $this->version     = '0.3.0';
        }

        /**
         * Loads files needed by the plugin.
         *
         * @since  0.1
         * @access public
         * @return void
         */
        private function includes() {

            // Main Installer
            require_once( 'includes/enqueue-scripts.php' );
            require_once( 'includes/rest-endpoints.php' );
            require_once( 'includes/class-demo-data.php' );
            require_once( 'includes/ui-modal.php' );


            // Additional item installer tab
            if( is_admin() ) {
                require_once( 'includes/menu-and-tabs.php' );
                require_once( 'includes/class-users.php' );
                $this->users = DT_Demo_Users::instance();
                require_once( 'includes/class-contacts.php' );
                $this->contacts = DT_Demo_Contacts::instance();
                require_once( 'includes/class-groups.php' );
                $this->groups = DT_Demo_Groups::instance();
                require_once( 'includes/class-locations.php' );
                $this->locations = DT_Demo_Locations::instance();
                require_once( 'includes/class-comments.php' );
                $this->comments = DT_Demo_Comments::instance();
                require_once( 'includes/class-connections.php' );
                $this->connections = DT_Demo_Connections::instance();
                $theme = wp_get_theme();
                if ( $theme->name = "Disciple_Tools" ) {
                    require_once( 'includes/class-roles.php' );
                    $this->roles = new DT_Demo_Roles();
                }
                require_once( 'includes/randomizer.php' );
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
                require( 'includes/plugin-update-checker/plugin-update-checker.php' );
            }
            Puc_v4_Factory::buildUpdateChecker(
                'https://raw.githubusercontent.com/DiscipleTools/disciple-tools-version-control/master/disciple-tools-demo-content-version-control.json',
                __FILE__,
                'disciple-tools-demo-content'
            );

            // Internationalize the text strings used.
            add_action( 'plugins_loaded', array( $this, 'i18n' ), 2 );

        }

        /**
         * Method that runs only when the plugin is activated.
         *
         * @since  0.1
         * @access public
         * @return void
         */
        public static function activation() {
        }

        /**
         * Method that runs only when the plugin is deactivated.
         *
         * @since  0.1
         * @access public
         * @return void
         */
        public static function deactivation() {
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

    }

    // Register activation hook.
    register_activation_hook( __FILE__, [ 'DT_Demo', 'activation' ] );
    register_deactivation_hook( __FILE__, [ 'DT_Demo', 'deactivation' ] );

    /**
     * A simple function to assist with development and non-disruptive debugging.
     * -----------
     * -----------
     * REQUIREMENT:
     * WP Debug logging must be set to true in the wp-config.php file.
     * Add these definitions above the "That's all, stop editing! Happy blogging." line in wp-config.php
     * -----------
     * define( 'WP_DEBUG', true ); // Enable WP_DEBUG mode
     * define( 'WP_DEBUG_LOG', true ); // Enable Debug logging to the /wp-content/debug.log file
     * define( 'WP_DEBUG_DISPLAY', false ); // Disable display of errors and warnings
     * @ini_set( 'display_errors', 0 );
     * -----------
     * -----------
     * EXAMPLE USAGE:
     * (string)
     * write_log('THIS IS THE START OF MY CUSTOM DEBUG');
     * -----------
     * (array)
     * $an_array_of_things = ['an', 'array', 'of', 'things'];
     * write_log($an_array_of_things);
     * -----------
     * (object)
     * $an_object = new An_Object
     * write_log($an_object);
     */
    if ( !function_exists( 'dt_write_log' ) ) {
        /**
         * A function to assist development only.
         * This function allows you to post a string, array, or object to the WP_DEBUG log.
         *
         * @param $log
         */
        function dt_write_log( $log )
        {
            if ( true === WP_DEBUG ) {
                if ( is_array( $log ) || is_object( $log ) ) {
                    error_log( print_r( $log, true ) );
                } else {
                    error_log( $log );
                }
            }
        }
    }


    if ( ! function_exists( 'dt_is_child_theme_of_disciple_tools' ) ) {
        /**
         * Returns true if this is a child theme of Disciple Tools, and false if it is not.
         *
         * @return bool
         */
        function dt_is_child_theme_of_disciple_tools() : bool {
            if ( get_template_directory() !== get_stylesheet_directory() ) {
                $current_theme = wp_get_theme();
                if ( 'disciple-tools-theme' == $current_theme->get( 'Template' ) ) {
                    return true;
                }
            }
            return false;
        }
    }

    function dt_demo_hook_admin_notice() {
        // Check if it's been dismissed...
        if ( ! get_option( 'dismissed-dt-demo', false ) ) {
            // multiple dismissible notice states ?>
            <div class="notice notice-error notice-dt-demo is-dismissible" data-notice="dt-demo">
                <p><?php esc_html_e( "'Disciple Tools - Demo' plugin requires 'Disciple Tools' theme to work. Please activate 'Disciple Tools' theme or deactivate 'Disciple Tools - Demo' plugin.", "dt_demo" ); ?></p>
            </div>
            <script>
                jQuery(function($) {
                    $( document ).on( 'click', '.notice-dt-demo .notice-dismiss', function () {
                        let type = $( this ).closest( '.notice-dt-demo' ).data( 'notice' );
                        $.ajax( ajaxurl,
                            {
                                type: 'POST',
                                data: {
                                    action: 'dismissed_notice_handler',
                                    type: type,
                                }
                            } );
                    } );
                });
            </script>

        <?php }
    }

    /**
     * AJAX handler to store the state of dismissible notices.
     */
    function dt_demo_ajax_notice_handler() {
        $type = 'dt-demo';
        update_option( 'dismissed-' . $type, true );
    }

} // end php 7 version check