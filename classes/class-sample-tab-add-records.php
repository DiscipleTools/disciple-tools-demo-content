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
                    <thead><th>Add Sample Data</th><th></th></thead>
                    <tbody>
                        <tr><th>Add Core Users</th><td>
                            <form method="POST"><input type="hidden" name="count" value="1" /> <button type="submit" value="add_users" name="submit" class="button" id="add_users">Add Users</button></form>
                        </td></tr>
                        <tr><th>Add Contacts (100)</th><td>
                            <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="add_contacts" name="submit" class="button" id="add_contacts">Add Contacts</button></form>
                        </td></tr>
                        <tr><th>Add Groups</th><td>
                            <form method="POST"><input type="hidden" name="count" value="50" /> <button type="submit" value="add_groups" name="submit" class="button" id="add_groups">Add Groups</button></form>
                        </td></tr>
                        <tr><th>Add Locations</th><td>
                            <form method="POST"><input type="hidden" name="count" value="25" /> <button type="submit" value="add_locations" name="submit" class="button" id="add_locations">Add Locations</button></form>
                        </td></tr>
                        <tr><th>Add Assets</th><td>
                            <form method="POST"><input type="hidden" name="count" value="25" /> <button type="submit" value="add_assets" name="submit" class="button" id="add_assets">Add Assets</button></form>
                        </td></tr>
                        <tr><th>Add Posts</th><td>
                            <form method="POST"><input type="hidden" name="count" value="5" /> <button type="submit" value="add_prayer_posts" name="submit" class="button" id="add_prayer_posts">Add Prayer Posts</button></form>
                        </td></tr>
                        <tr><th>Add Pages</th><td>
                            <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="add_core_pages" name="submit" class="button" id="add_core_pages">Add Core Pages</button></form>
                        </td></tr>
                        <tr><th></th><td>
                        </td></tr>
                        <tr><th>Build Baptism Generations</th><td>
                            <form method="POST"><input type="hidden"  name="count" value="100" /> <button type="submit" value="build_baptisms" name="submit" class="button" id="build_baptisms">Build Baptisms</button></form>
                        </td></tr>
                        <tr><th>Build Contacts to Groups Connections</th><td>
                            <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="build_coaching" name="submit" class="button" id="build_coaching">Building Coaching</button></form>
                        </td></tr>
                        <tr><th>Build Report History</th><td>
                            <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="build_reports" name="submit" class="button" id="build_reports">Build Reports</button></form>
                        </td></tr>
                        
                </tbody>
             </table>
             <br>
             ';

        if (isset($_POST['submit'])) {

            // Set top and bottom of report window
            $report_box_top = '<br><table class="widefat striped">
                    <thead><th>Report Activity</th></thead>
                    <tbody>
                        <tr><td>';
            $report_box_bottom = '</td></tr>
                    </tbody>
                  </table>';

            // Identify form request
            switch ($_POST['submit']) {

                // users
                case 'add_users':
                    $html .= $report_box_top . dt_sample_data_plugin()->users->add_users_once() . $report_box_bottom;
                    break;
                case 'reset_users':
                    $html .= $report_box_top . dt_sample_data_plugin()->users->reset_users() . $report_box_bottom;
                    break;

                // Contacts
                case 'add_contacts':
                    $html .= $report_box_top . dt_sample_data_plugin()->contacts->add_contacts_by_count ($_POST['count']) . $report_box_bottom;
                    break;

                // Groups
                case 'add_groups':
                    $html .= $report_box_top . dt_sample_data_plugin()->groups->add_groups_by_count ($_POST['count']) . $report_box_bottom;
                    break;

                // Locations
                case 'add_locations':
                    $html .= $report_box_top . dt_sample_data_plugin()->locations->add_locations_by_count($_POST['count']) . $report_box_bottom;
                    break;

                // Assets
                case 'add_assets':
                    $html .= $report_box_top . dt_sample_data_plugin()->assets->add_assets_by_count($_POST['count']) . $report_box_bottom;
                    break;

                // Media
                case 'add_media':
//                    $html .= $report_box_top . dt_sample_add_media_by_count($_POST['count']) . $report_box_bottom;
                    break;

                // Prayer posts
                case 'add_prayer_posts':
                    $html .= $report_box_top . dt_sample_data_plugin()->prayer->add_prayer_posts_by_count ($_POST['count']) . $report_box_bottom;
                    break;

                // Generations
                case 'build_baptisms':
                    $html .= $report_box_top . dt_sample_data_plugin()->baptisms->add_baptism_connections($_POST['count']) . $report_box_bottom;
                    break;
                case 'reset_baptisms':
                    $html .= $report_box_top . dt_sample_data_plugin()->baptisms->reset_groups($_POST['count']) . $report_box_bottom;
                    break;
                case 'build_coaching':
                    $html .= $report_box_top . dt_sample_data_plugin()->coaching->reset_groups($_POST['count']) . $report_box_bottom;
                    break;
                case 'reset_coaching':
                    $html .= $report_box_top . dt_sample_data_plugin()->coaching->reset_groups($_POST['count']) . $report_box_bottom;
                    break;
                case 'build_reports':
                    $html .= $report_box_top . dt_sample_data_plugin()->reports->reset_groups($_POST['count']) . $report_box_bottom;
                    break;
                case 'reset_reports':
                    $html .= $report_box_top . dt_sample_data_plugin()->reports->reset_groups($_POST['count']) . $report_box_bottom;
                    break;
                case 'add_core_pages':
                    $html .= $report_box_top . dt_sample_data_plugin()->content->add_core_pages_once($_POST['count']) . $report_box_bottom;
                    break;
                case 'reset_core_pages':
                    $html .= $report_box_top . dt_sample_data_plugin()->content->reset_core_pages($_POST['count']) . $report_box_bottom;
                    break;


                case 'reset_roles':
                    $html .= $report_box_top . dt_sample_data_plugin()->roles->reset_roles() . $report_box_bottom;
                    break;
                default:
                    break;
            }

        }


        $html .= '</div><!-- end post-body-content -->';

        $html .=   '<div id="postbox-container-1" class="postbox-container">

                        <table class="widefat ">
                            <thead>
                            <th>Notes</th>
                            </thead>
                            <tbody>
                            <tr><td>ADD SAMPLE DATA<br> These forms add the core data to the system for the purpose of testing and training.<hr></td></tr>
                            <tr><td>UTILITIES<br>Theses are utilities that allow you to reset the system.</td></tr>
                            </tbody>
                        </table>
                       
                    </div><!-- postbox-container 1 -->

                    <div id="postbox-container-2" class="postbox-container">
                    </div><!-- postbox-container 2 -->

                </div><!-- post-body meta box container -->
            </div><!--poststuff end -->
        </div><!-- wrap end -->';

        return $html;
    }

}