<?php

/**
 * Disciple Tools Sample Menu Add Records
 *
 * @class dt_sample_add_records
 * @version	0.1
 * @since 0.1
 * @package	Disciple_Tools
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class dt_sample_add_records {

    /**
     * dt_sample_add_records The single instance of dt_sample_add_records.
     * @var 	object
     * @access  private
     * @since 	0.1
     */
    private static $_instance = null;

    /**
     * Main dt_sample_add_records Instance
     *
     * Ensures only one instance of dt_sample_add_records is loaded or can be loaded.
     *
     * @since 0.1
     * @static
     * @return dt_sample_add_records instance
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


    /**
     * Add Records Menu Tab Content
     * @access  public
     * @since   0.1
     */
    public function dtsample_add_records_content () {
        $html = '<div class="wrap"><h2>Add records</h2>';
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
                    <thead><th>Sample Data</th><th></th></thead>
                    <tbody>
                        <tr><th>Add Contacts</th><td>
                            <form method="POST"><button type="submit" value="add_contacts" name="add_contacts" class="button" id="add_contacts">Add Contacts</button></form>
                        </td></tr>
                        <tr><th>Add Groups</th><td>
                            <form method="POST"><button type="submit" value="add_groups" name="add_groups" class="button" id="add_groups">Add Groups</button></form>
                        </td></tr>
                        <tr><th>Add Users</th><td>
                            <form method="POST"><button type="submit" value="add_users" name="add_users" class="button" id="add_users">Add Users</button></form>
                        </td></tr>
                        <tr><th>Add Pages</th><td>
                            <form method="POST"><button type="submit" value="add_core_pages" name="add_core_pages" class="button" id="add_core_pages">Add Core Pages</button></form>
                        </td></tr>
                        <tr><th>Add Posts</th><td>
                            <form method="POST"><button type="submit" value="add_prayer_posts" name="add_prayer_posts" class="button" id="add_prayer_posts">Add Prayer Posts</button></form>
                        </td></tr>
                        <tr><th>Add/Refresh Roles</th><td>
                            <form method="POST"><button type="submit" value="reset_roles" name="reset_roles" class="button" id="reset_roles">Add/Refresh Roles</button></form>
                        </td></tr>
                        
                        <!--<tr><th>Add Photos</th><td>  // TODO: Removed Photo section not copying correctly.
                            <form method="POST"><button type="submit" value="add_photos" name="add_photos" class="button" id="add_photos">Add Photos</button></form>
                        </td></tr>-->
                       
                    </tbody>
                  </table>';



        $report_box_top = '<br><table class="widefat striped">
                    <thead><th>Report Activity</th></thead>
                    <tbody>
                        <tr><td>';
        $report_box_bottom = '</td></tr>
                    </tbody>
                  </table>';

        if (isset($_POST['add_contacts'])) { $html .= $report_box_top . dt_sample_data_plugin()->contacts->add_contacts_once () . $report_box_bottom; }
        if (isset($_POST['reset_contacts'])) { $html .= $report_box_top . dt_sample_data_plugin()->contacts->reset_contacts () . $report_box_bottom; }

        if (isset($_POST['add_groups'])) { $html .= $report_box_top . dt_sample_data_plugin()->groups->add_groups_once() . $report_box_bottom; }
        if (isset($_POST['reset_groups'])) { $html .= $report_box_top . dt_sample_data_plugin()->groups->reset_groups() . $report_box_bottom; }

        if (isset($_POST['add_users'])) { $html .= $report_box_top . dt_sample_data_plugin()->users->add_users_once() . $report_box_bottom; }
        if (isset($_POST['reset_users'])) { $html .= $report_box_top . dt_sample_data_plugin()->users->reset_users() . $report_box_bottom; }

        if (isset($_POST['add_core_pages'])) { $html .= $report_box_top . dt_sample_data_plugin()->content->add_core_pages_once() . $report_box_bottom; }
        if (isset($_POST['reset_core_pages'])) { $html .= $report_box_top . dt_sample_data_plugin()->content->reset_core_pages() . $report_box_bottom; }

        if (isset($_POST['add_prayer_posts'])) { $html .= $report_box_top . dt_sample_data_plugin()->content->add_prayer_posts_once() . $report_box_bottom; }
        if (isset($_POST['reset_prayer_posts'])) { $html .= $report_box_top . dt_sample_data_plugin()->content->reset_prayer_posts() . $report_box_bottom; }

        if (isset($_POST['add_photos'])) { $html .= $report_box_top . dt_sample_data_plugin()->content->add_photos_once() . $report_box_bottom; }
        if (isset($_POST['reset_photos'])) { $html .= $report_box_top . dt_sample_data_plugin()->content->reset_photos() . $report_box_bottom; }

        if (isset($_POST['reset_roles'])) { $html .= $report_box_top . dt_sample_data_plugin()->roles->reset_roles() . $report_box_bottom; }



        $html .= '</div><!-- postbox-container 1 --><div id="postbox-container-2" class="postbox-container"></div><!-- postbox-container 2 -->';

        // Closing wrappers
        $html .= '     </div><!-- post-body meta box container -->
                    </div><!--poststuff end -->
                </div><!-- wrap end -->';

        return $html;
    }

}