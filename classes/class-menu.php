<?php

/**
 * DT_Demo_Page class for the admin page
 *
 * @class DT_Demo_Page
 * @version    1.0.0
 * @since 1.0.0
 * @package    DRM_Plugin
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly
}

final class DT_Demo_Page {

    /**
     * DT_Demo_Page The single instance of DT_Demo_Page.
     * @var     object
     * @access  private
     * @since     1.0.0
     */
    private static $_instance = null;

    public $p2p_array = array();

    /**
     * DT_Demo_Page Instance
     *
     * Ensures only one instance of DT_Demo_Page is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @return DT_Demo_Page instance
     */
    public static function instance () {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    /**
     * Constructor function.
     * @access  portal
     * @since   1.0.0
     */
    public function __construct () {

        add_action( "admin_menu", array($this, "add_dtsample_data_menu") );

    } // End __construct()

    /**
     * Loads the subnav page
     * @since 0.1
     */
    public function add_dtsample_data_menu () {
        add_menu_page( __( 'Demo (DT)', 'dt_demo' ), __( 'Demo (DT)', 'dt_demo' ), 'manage_options', 'dt_demo', [ $this, 'dt_demo_data_page' ], 'dashicons-admin-generic', 75 );
    }

    /**
     * Builds the tab bar
     * @since 0.1
     */
    public function dt_demo_data_page() {


        if ( !current_user_can( 'manage_dt' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }

        /**
         * Begin Header & Tab Bar
         */
        if (isset( $_GET["tab"] )) {$tab = $_GET["tab"];
        } else {$tab = 'records';}

        $tab_link_pre = '<a href="admin.php?page=dt_demo&tab=';
        $tab_link_post = '" class="nav-tab ';

        $html = '<div class="wrap">
            <h2>DISCIPLE TOOLS - DEMO CONTENT</h2>
            <h2 class="nav-tab-wrapper">';

        $html .= $tab_link_pre . 'records' . $tab_link_post;
        if ($tab == 'records' || !isset( $tab ) ) {$html .= 'nav-tab-active';}
        $html .= '">Starter Data</a>';

        $html .= $tab_link_pre . 'report' . $tab_link_post;
        if ($tab == 'report') {$html .= 'nav-tab-active';}
        $html .= '">Add Reports</a>';

//        $html .= $tab_link_pre . 'tutorials' . $tab_link_post;
//        if ($tab == 'tutorials') {$html .= 'nav-tab-active';}
//        $html .= '">Tutorials</a>';


        $html .= '</h2>';

        echo $html;

        $html = '';
        // End Tab Bar

        /**
         * Begin Page Content
         */
        switch ($tab) {

            case "tutorials":
                    $html .= DT_Demo()->tutorials->dt_tabs_tutorial_content();
                break;
            case "report":
                $html .= DT_Demo()->add_report->add_report_page_form();
                break;
            default:
                $html .= DT_Demo()->add_records->DT_Demo_Add_Records_content();
        }

        $html .= '</div>'; // end div class wrap

        echo $html;
    }
}