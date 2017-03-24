<?php

/**
 * Disciple Tools Sample Setup Info Tab
 *
 * @class dt_sample_setup_info
 * @version	0.1
 * @since 0.1
 * @package	Disciple_Tools
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class dt_sample_setup_info {

    /**
     * dt_sample_setup_info The single instance of dt_sample_setup_info.
     * @var 	object
     * @access  private
     * @since 	0.1
     */
    private static $_instance = null;

    /**
     * Main dt_sample_setup_info Instance
     *
     * Ensures only one instance of dt_sample_setup_info is loaded or can be loaded.
     *
     * @since 0.1
     * @static
     * @return dt_sample_setup_info instance
     */
    public static function instance () {
        if ( is_null( self::$_instance ) )
            self::$_instance = new self();
        return self::$_instance;
    } // End instance()

    /**
     * Constructor function.
     * @access  public
     * @since   0.1
     */
    public function __construct () {

    } // End __construct()

    /*
     * Tab: Tools
     */
    public function dtsample_setup_info() {
        global $wpdb;
        $html ='';

        // Establish if users are installed.
        $username_array = array('Prayer_Supporter', 'Project_Supporter', 'Dispatcher', 'Marketer', 'Multiplier', 'Multiplier_Leader', 'Registered' );
        $installed = array();

        foreach($username_array as $name) {
            if ( username_exists( $name ) )
                $installed[$name] = '<span style="color:limegreen; font-weight: 600;">Yes</span>';
            else
                $installed[$name] = '<span style="color:red; font-weight: 600;">No</span>';
        }



        // Opening wrappers.
        $html .= '<div class="wrap">
                        <div id="poststuff">
                            <div id="post-body" class="metabox-holder columns-2">';

        /*
        * Main left column
        *
        */
        $html .= '<div id="post-body-content">';

        // Progress Metabox
        $html .= '<table class="widefat striped">
                    <thead><th>Demo Users Role</th><th>Installed</th><th>Username</th><th>Password</th></thead>
                    <tbody>';
        $html .= '<tr><th>Prayer Supporter</th><td>'. $installed['Prayer_Supporter'] . '</td><td>Prayer_Supporter</td><td>disciple</td></tr>';
        $html .= '<tr><th>Project Supporter</th><td>'. $installed['Project_Supporter'] . '</td><td>Project_Supporter</td><td>disciple</td></tr>';
        $html .= '<tr><th>Dispatcher</th><td>'. $installed['Dispatcher'] . '</td><td>Dispatcher</td><td>disciple</td></tr>';
        $html .= '<tr><th>Marketer</th><td>'. $installed['Marketer'] . '</td><td>Marketer</td><td>disciple</td></tr>';
        $html .= '<tr><th>Multiplier</th><td>'. $installed['Multiplier'] . '</td><td>Multiplier</td><td>disciple</td></tr>';
        $html .= '<tr><th>Multiplier Leader</th><td>'. $installed['Multiplier_Leader'] . '</td><td>Multiplier_Leader</td><td>disciple</td></tr>';
        $html .= '<tr><th>Registered</th><td>'. $installed['Registered'] . '</td><td>Registered</td><td>disciple</td></tr>';

        $html .= '</tbody></table>';

        $html .= '</div><!-- end post-body-content -->';

        /*
        * Sidebar
        *
        */
        $html .= '<div id="postbox-container-1" class="postbox-container">';
        // Notes Metabox
        $html .= '<table class="widefat striped"><thead><th>Notes</th></thead><tbody>';
        $html .= '<tr><td>Use the "Add Records" tab to install sample content into the Disciple Tools system.</td></tr>';
        $html .= '</tbody></table>';

        $html .= '</div><!-- postbox-container 1 -->';

        /*
        * Lower Metabox left column
        *
        */
        $html .= '<div id="postbox-container-2" class="postbox-container">';
        $html .= '</div><!-- postbox-container 2 -->';

        // Closing wrappers
        $html .= '     </div><!-- post-body meta box container -->
                    </div><!--poststuff end -->
                </div><!-- wrap end -->';

        return $html;
    }

}