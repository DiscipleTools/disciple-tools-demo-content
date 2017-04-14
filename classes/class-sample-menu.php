<?php

/**
 * dt_sample_page class for the admin page
 *
 * @class dt_sample_page
 * @version	1.0.0
 * @since 1.0.0
 * @package	DRM_Plugin
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

final class dt_sample_page {

    /**
     * dt_sample_page The single instance of dt_sample_page.
     * @var 	object
     * @access  private
     * @since 	1.0.0
     */
    private static $_instance = null;

    public $p2p_array = array();

    /**
     * dt_sample_page Instance
     *
     * Ensures only one instance of dt_sample_page is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @return dt_sample_page instance
     */
    public static function instance () {
        if ( is_null( self::$_instance ) )
            self::$_instance = new self();
        return self::$_instance;
    } // End instance()

    /**
     * Constructor function.
     * @access  portal
     * @since   1.0.0
     */
    public function __construct () {

        add_action("admin_menu", array($this, "add_dtsample_data_menu") );

    } // End __construct()

    /**
     * Loads the subnav page
     * @since 0.1
     */
    public function add_dtsample_data_menu () {
        add_submenu_page( 'options-general.php', __( 'Sample Data (DT)', 'dtsample' ), __( 'Sample Data (DT)', 'dtsample' ), 'manage_options', 'dtsample', array( $this, 'dtsample_data_page' ) );
    }

    /**
     * Builds the tab bar
     * @since 0.1
     */
    public function dtsample_data_page() {

        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }

        /**
         * Begin Header & Tab Bar
         */
        if (isset($_GET["tab"])) {$tab = $_GET["tab"];} else {$tab = 'records';}

        $tab_link_pre = '<a href="options-general.php?page=dtsample&tab=';
        $tab_link_post = '" class="nav-tab ';

        $html = '<div class="wrap">
            <h2>DISCIPLE TOOLS - SAMPLE DATA</h2>
            <h2 class="nav-tab-wrapper">';

        $html .= $tab_link_pre . 'records' . $tab_link_post;
        if ($tab == 'records' || !isset($tab) ) {$html .= 'nav-tab-active';}
        $html .= '">Add Records</a>';

        $html .= $tab_link_pre . 'setup' . $tab_link_post;
        if ($tab == 'setup') {$html .= 'nav-tab-active';}
        $html .= '">Setup Info</a>';

        $html .= $tab_link_pre . 'gen' . $tab_link_post;
        if ($tab == 'gen') {$html .= 'nav-tab-active';}
        $html .= '">Gen Test</a>';

        $html .= $tab_link_pre . 'report' . $tab_link_post;
        if ($tab == 'report') {$html .= 'nav-tab-active';}
        $html .= '">Add Report</a>';

        $html .= $tab_link_pre . 'portal' . $tab_link_post;
        if ($tab == 'portal') {$html .= 'nav-tab-active';}
        $html .= '">Portal</a>';

        $html .= '</h2>';
        // End Tab Bar

        /**
         * Begin Page Content
         */
        switch ($tab) {

            case "setup":
                    $html .= dt_sample_data_plugin()->setup_info->dtsample_setup_info();
                break;
            case "gen":
                    $html .= dt_sample_data_plugin()->generations->run_full_generations_list('contacts');
                break;
            case "report":
                $html .= dt_sample_data_plugin()->add_report->add_report_page_form ();
                break;
            case "portal":
                $html .= dt_sample_data_plugin()->portal->display_page_content();
                break;
            default:
                $html .= dt_sample_data_plugin()->add_records->dtsample_add_records_content() ;
        }

        $html .= '</div>'; // end div class wrap

        echo $html;
    }
}