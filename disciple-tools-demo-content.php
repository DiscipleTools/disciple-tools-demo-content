<?php

/**
 * Plugin Name: Disciple Tools - Demo Content
 * Plugin URI: https://github.com/DiscipleTools/disciple-tools-demo-content
 * Description: The demo content plugin is for a quickstart with content to the Disciple.Tools system. It is useful for demonstration and training.
 * Version: 0.4.1
 * Author URI: https://github.com/DiscipleTools
 *
 * @license GPL-2.0 or later
 *          https://www.gnu.org/licenses/gpl-2.0.html
 */
if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly
}
$dt_demo_required_dt_theme_version = '0.21.3';

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
    return;
}

/**
 * Gets the instance of the `DT_Demo` class.
 *
 * @since  0.1
 * @access public
 */
function dt_demo() {
    global $dt_demo_required_dt_theme_version;
    $wp_theme = wp_get_theme();
    $version = $wp_theme->version;
    /*
     * Check if the Disciple.Tools theme is loaded and is the latest required version
     */
    $is_theme_dt = strpos( $wp_theme->get_template(), "disciple-tools-theme" ) !== false || $wp_theme->name === "Disciple Tools";
    if ( !$is_theme_dt || version_compare( $version,  $dt_demo_required_dt_theme_version, "<" ) ) {
        add_action( 'admin_notices', 'dt_demo_hook_admin_notice' );
        add_action( 'wp_ajax_dismissed_notice_handler', 'dt_hook_ajax_notice_handler' );
        return new WP_Error( 'current_theme_not_dt', 'Disciple Tools Theme not active or not the latest version.' );
    }

    /**
     * Load useful function from the theme
     */
    if ( !defined( 'DT_FUNCTIONS_READY' ) ){
        require_once get_template_directory() . '/dt-core/global-functions.php';
    }
    /*
     * Don't load the plugin on every rest request. Only those with the correct namespace
     * This restricts endpoints defined in this plugin this namespace
     */
    $is_rest = dt_is_rest();
    if ( !$is_rest || strpos( dt_get_url_path(), 'dt_demo' ) != false ){
        return DT_Demo::get_instance();
    }
}
add_action( 'plugins_loaded', 'dt_demo' );


//keep email from being sent to demo users.
function dt_sent_email_check( $continue, $email, $subject, $message ){
    if ( preg_match( '/disciple.tools\d+\.com$/', $email ) ){
        $continue = false;
    }
    return $continue;
}
add_filter( "dt_sent_email_check", "dt_sent_email_check", 10, 4 );
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
            $instance = new dt_demo();
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
        // @codingStandardsIgnoreLine
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
        $this->version     = '0.4.1';
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
        new DT_Demo_Data();
        require_once( 'includes/ui-modal.php' );


        // Additional item installer tab
        if ( is_admin() ) {
            require_once( 'includes/menu-and-tabs.php' );
            require_once( 'includes/class-users.php' );
            $this->users = DT_Demo_Users::instance();
            require_once( 'includes/class-contacts.php' );
            $this->contacts = DT_Demo_Contacts::instance();
            require_once( 'includes/class-groups.php' );
            $this->groups = DT_Demo_Groups::instance();
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

            // Check for plugin updates
            if ( ! class_exists( 'Puc_v4_Factory' ) ) {
                require( get_template_directory() . '/dt-core/libraries/plugin-update-checker/plugin-update-checker.php' );
            }
            Puc_v4_Factory::buildUpdateChecker(
                'https://raw.githubusercontent.com/DiscipleTools/disciple-tools-version-control/master/disciple-tools-demo-content-version-control.json',
                __FILE__,
                'disciple-tools-demo-content'
            );
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


function dt_demo_hook_admin_notice() {
    global $dt_demo_required_dt_theme_version;
    $wp_theme = wp_get_theme();
    $current_version = $wp_theme->version;
    $message = __( "'Disciple Tools - Demo' plugin requires 'Disciple Tools' theme to work. Please activate 'Disciple Tools' theme or make sure it is latest version.", "dt_demo" );
    if ( $wp_theme->get_template() === "disciple-tools-theme" ){
        $message .= sprintf( esc_html__( 'Current Disciple Tools version: %1$s, required version: %2$s', 'disciple_tools' ), esc_html( $current_version ), esc_html( $dt_demo_required_dt_theme_version ) );
    }
    // Check if it's been dismissed...
    if ( ! get_option( 'dismissed-dt-demo', false ) ) { ?>
        <div class="notice notice-error notice-dt-demo is-dismissible" data-notice="dt-demo">
            <p><?php echo esc_html( $message );?></p>
        </div>
        <script>
          jQuery(function($) {
            $( document ).on( 'click', '.notice-dt-demo .notice-dismiss', function () {
              $.ajax( ajaxurl, {
                type: 'POST',
                data: {
                  action: 'dismissed_notice_handler',
                  type: 'dt-demo',
                  security: '<?php echo esc_html( wp_create_nonce( 'wp_rest_dismiss' ) ) ?>'
                }
              })
            });
          });
        </script>
    <?php }
}


/**
 * AJAX handler to store the state of dismissible notices.
 */
if ( !function_exists( "dt_hook_ajax_notice_handler" )){
    function dt_hook_ajax_notice_handler(){
        check_ajax_referer( 'wp_rest_dismiss', 'security' );
        if ( isset( $_POST["type"] ) ){
            $type = sanitize_text_field( wp_unslash( $_POST["type"] ) );
            update_option( 'dismissed-' . $type, true );
        }
    }
}
