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
        global $wpdb;
        $html = '';



        /**********************************************************************/
        /* Handle Postback */
        /**********************************************************************/

        if (isset($_POST['submit'])) {

            // Set top and bottom of report window
            $report_box_top = '<br><table class="widefat striped">
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



                // Prayer posts
                case 'add_prayer_posts':
                    $html .= $report_box_top . dt_sample_data_plugin()->prayer->add_prayer_posts_by_count ($_POST['count']) . $report_box_bottom;
                    break;
                case 'add_progress_posts':
                    $html .= $report_box_top . dt_sample_data_plugin()->progress->add_progress_posts_by_count ($_POST['count']) . $report_box_bottom;
                    break;

                // Generations
                case 'build_baptisms':
                    $html .= $report_box_top . dt_sample_data_plugin()->connections->add_baptism_connections ($_POST['count']) . $report_box_bottom;
                    break;
                case 'build_churches':
                    $html .= $report_box_top . dt_sample_data_plugin()->connections->add_church_connections ($_POST['count']) . $report_box_bottom;
                    break;
                case 'build_coaching':
                    $html .= $report_box_top . dt_sample_data_plugin()->connections->add_coaching_connections($_POST['count']) . $report_box_bottom;
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




        /**********************************************************************/
        /* Calculate Current Status */
        /**********************************************************************/

        // Number of users
        $user_object = count_users( );
        $users = $user_object['total_users'];

        // Number of contacts
        $contacts = wp_count_posts( 'contacts' );
        $groups = wp_count_posts( 'groups' );
        $locations = wp_count_posts( 'locations' );
        $assets = wp_count_posts( 'assets' );
        $prayer = wp_count_posts( 'prayer' );
        $progress = wp_count_posts( 'progress' );
        $pages = wp_count_posts( 'page' );

        // Number of Baptism connections
        $baptism_gen = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->p2p WHERE p2p_type = 'baptizer_to_baptized'" );
        $group_gen = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->p2p WHERE p2p_type = 'groups_to_groups'" );
        $coaching_gen = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->p2p WHERE p2p_type = 'contacts_to_contacts'" );

        $reports = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->reports" );




        /**********************************************************************/
        /* Panel Content */
        /**********************************************************************/

        $html .= '<div class="wrap"><h2>Starter Data</h2>';
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
                    <thead><th>RECORDS</th><th></th><th>Current</th></thead>
                    <tbody>
                        <tr><th>Add Core Users</th><td>
                            <form method="POST"><input type="hidden" name="count" value="1" /> <button type="submit" value="add_users" name="submit" class="button" id="add_users">Add Users</button></form>
                        </td><td>'.$users.'</td></tr>
                        
                        <tr><th>Add Contacts</th><td>
                            <form method="POST"><input type="hidden" name="count" value="50" /> <button type="submit" value="add_contacts" name="submit" class="button" id="add_contacts">Add Contacts</button></form>
                        </td><td>'.$contacts->publish.'</td></tr>
                        
                        <tr><th>Add Groups</th><td>
                            <form method="POST"><input type="hidden" name="count" value="50" /> <button type="submit" value="add_groups" name="submit" class="button" id="add_groups">Add Groups</button></form>
                        </td><td>'.$groups->publish.'</td></tr>
                        
                        <tr><th>Add Locations</th><td>
                            <form method="POST"><input type="hidden" name="count" value="25" /> <button type="submit" value="add_locations" name="submit" class="button" id="add_locations">Add Locations</button></form>
                        </td><td>'.$locations->publish.'</td></tr>
                        
                        <tr><th>Add Assets</th><td>
                            <form method="POST"><input type="hidden" name="count" value="25" /> <button type="submit" value="add_assets" name="submit" class="button" id="add_assets">Add Assets</button></form>
                        </td><td>'.$assets->publish.'</td></tr>
                        
                        <tr><th>Add Prayer Posts</th><td>
                            <form method="POST"><input type="hidden" name="count" value="5" /> <button type="submit" value="add_prayer_posts" name="submit" class="button" id="add_prayer_posts">Add Prayer Posts</button></form>
                        </td><td>'.$prayer->publish.'</td></tr>
                        
                        <tr><th>Add Progress Posts</th><td>
                            <form method="POST"><input type="hidden" name="count" value="5" /> <button type="submit" value="add_progress_posts" name="submit" class="button" id="add_progress_posts">Add Progress Posts</button></form>
                        </td><td>'.$progress->publish.'</td></tr>
                        
                        <tr><th>Add Pages</th><td>
                            <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="add_core_pages" name="submit" class="button" id="add_core_pages">Add Core Pages</button></form>
                        </td><td>'.$pages->publish.'</td></tr>
                        
                        <tr><th>Add Comments**</th><td>
                            <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="add_core_pages" name="submit" class="button" id="add_core_pages">Add Comments</button></form>
                        </td><td>'.$comments = 0 .'</td></tr>
                        
                        </tbody>
             </table>
             <br>
                        ';
        $html .= '<table class="widefat striped">
                    <thead><th>CONNECTIONS</th><th></th><th>Current</th></thead>
                    <tbody>
                        <tr><th>Build Baptism Generations</th><td>
                            <form method="POST"><input type="hidden"  name="count" value="25" /> <button type="submit" value="build_baptisms" name="submit" class="button" id="build_baptisms">Add Baptisms</button></form>
                        </td><td>'.$baptism_gen.'</td></tr>
                        
                        <tr><th>Build Group Generations</th><td>
                            <form method="POST"><input type="hidden"  name="count" value="10" /> <button type="submit" value="build_churches" name="submit" class="button" id="build_churches">Add Group Generations</button></form>
                        </td><td>'.$group_gen.'</td></tr>
                        
                        <tr><th>Build Coaching Generations</th><td>
                            <form method="POST"><input type="hidden" name="count" value="25" /> <button type="submit" value="build_coaching" name="submit" class="button" id="build_coaching">Add Coaching Generations</button></form>
                        </td><td>'.$coaching_gen.'</td></tr>
                        
                        <tr><th>Connect Locations**</th><td>
                            <form method="POST"><input type="hidden" name="count" value="25" /> <button type="submit" value="connect_locations" name="submit" class="button" id="connect_locations">Connect Locations</button></form>
                        </td><td>'.$connected_locations = 0 .'</td></tr>
                        
                </tbody>
             </table>
             <br>
             ';

        $html .= '<table class="widefat striped">
                    <thead><th>Misc</th><th></th><th>Current</th></thead>
                    <tbody>
                    
                        <tr><th>Build Report History</th><td>
                            <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="build_reports" name="submit" class="button" id="build_reports">Build Reports</button></form>
                        </td><td>'.$reports.'</td></tr>
                        
                        <tr><th>Add Assignments**</th><td>
                            <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="build_reports" name="submit" class="button" id="build_reports">Add Assignments</button></form>
                        </td><td></td></tr>
                        
                        <tr><th>Add Updates Requested**</th><td>
                            <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="build_reports" name="submit" class="button" id="build_reports">Add Updates Requested</button></form>
                        </td><td></td></tr>
                        
                    </tbody>
             </table>
             <br>
             ';


        $html .= '</div><!-- end post-body-content -->';

        $html .=   '<div id="postbox-container-1" class="postbox-container">

                    <table class="widefat striped">
                        <thead><th>Utilities</th><th></th></thead>
                            <tbody>
                                <tr><th>Refresh Roles</th><td>
                                    <form method="POST"><button type="submit" value="reset_roles" name="submit" class="button" id="reset_roles">Refresh Roles</button></form>
                                </td></tr>
                                <tr><th>Delete Contacts</th><td>
                                    <a href="javascript:void(0);" class="button" onclick="jQuery(\'#delete_contacts_confirm\').show();">Delete Contacts</a>
                                    
                                </td></tr>
                                <tr id="delete_contacts_confirm" class="warning" style="display:none;"><th>Are you sure?</th><td>
                                    <form method="POST"><button type="submit" value="delete_contacts" name="submit" class="button" style="background:red; color:white;" id="delete_contacts">Confirm Delete</button></form>
                                </td></tr>
                                <tr><th>Delete Groups</th><td>
                                    <a href="javascript:void(0);" class="button" onclick="jQuery(\'#delete_groups_confirm\').show();">Delete Groups</a>
                                    
                                </td></tr>
                                <tr id="delete_groups_confirm" class="warning" style="display:none;"><th>Are you sure?</th><td>
                                    <form method="POST"><button type="submit" value="delete_groups" name="submit" class="button" style="background:red; color:white;" id="delete_groups">Confirm Delete</button></form>
                                </td></tr>
                                
                                
                                    
                        </tbody>
                    </table><br>

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