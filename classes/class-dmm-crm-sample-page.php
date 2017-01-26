<?php

/**
 * dmm_crm_sample_page class for the admin page
 *
 * @class dmm_crm_sample_page
 * @version	1.0.0
 * @since 1.0.0
 * @package	DmmCrm_Plugin
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

final class dmm_crm_sample_page {

    /**
     * dmm_crm_sample_page The single instance of dmm_crm_sample_page.
     * @var 	object
     * @access  private
     * @since 	1.0.0
     */
    private static $_instance = null;

    /**
     * dmm_crm_sample_page Instance
     *
     * Ensures only one instance of dmm_crm_sample_page is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @return dmm_crm_sample_page instance
     */
    public static function instance () {
        if ( is_null( self::$_instance ) )
            self::$_instance = new self();
        return self::$_instance;
    } // End instance()

    /**
     * Constructor function.
     * @access  public
     * @since   1.0.0
     */
    public function __construct () {

        add_action("admin_menu", array($this, "add_sample_data_menu") );

    } // End __construct()



    public function add_sample_data_menu () {
        add_submenu_page( 'options-general.php', __( 'DMM Sample Data', 'dmmcrmsample' ), __( 'DMM Sample Data', 'dmmcrmsample' ), 'manage_options', 'dmmcrmsample', array( $this, 'sample_data_page' ) );
    }

    public function sample_data_page() {

        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }

        /**
         *
         * Begin Header & Tab Bar
         */
        $tab = $_GET["tab"];
        $tab_link_pre = '<a href="admin.php?page=dmm_coaching&tab=';
        $tab_link_post = '" class="nav-tab ';

        $html = '<div class="wrap">
            <h2>DMM CRM COACHING</h2>
            <p>"Train obedience and see where the kingdom is not"</p>
            <h2 class="nav-tab-wrapper">';

        $html .= $tab_link_pre . 'dash' . $tab_link_post;
        if ($tab == 'dash' || !isset($tab)) {$html .= 'nav-tab-active';}
        $html .= '">Dashboard</a>';

        $html .= $tab_link_pre . 'maps' . $tab_link_post;
        if ($tab == 'maps') {$html .= 'nav-tab-active';}
        $html .= '">Maps</a>';

        $html .= $tab_link_pre . 'generations' . $tab_link_post;
        if ($tab == 'generations') {$html .= 'nav-tab-active';}
        $html .= '">Generations</a>';

        $html .= $tab_link_pre . 'charts' . $tab_link_post;
        if ($tab == 'charts') {$html .= 'nav-tab-active';}
        $html .= '">Charts</a>';

        $html .= $tab_link_pre . 'stats' . $tab_link_post;
        if ($tab == 'stats') {$html .= 'nav-tab-active';}
        $html .= '">Statistics</a>';

        $html .= $tab_link_pre . 'tools' . $tab_link_post;
        if ($tab == 'tools') {$html .= 'nav-tab-active';}
        $html .= '">Tools</a>';



        $html .= '</h2>';
        // End Tab Bar

        /**
         *
         * Begin Page Content
         */
        switch ($tab) {
            case "maps":
//                    $html .= dmm_crm_coaching_map () ;
                break;
            case "generations":
//                    $html .= dmm_crm_coaching_generations ();
                break;
            case "charts":
//                    $html .= dmm_crm_coaching_charts ();
                break;
            case "stats":
//                    $html .= dmm_crm_coaching_statistics ();
                break;
            case "tools":
//                    $html .= dmm_crm_2_column_placeholder ();
                break;
            default:
//                    $html .= dmm_crm_post_box_placeholder ();
        }

        $html .= '</div>'; // end div class wrap

        echo $html;

    }

}