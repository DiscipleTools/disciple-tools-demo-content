<?php

/**
 * Disciple Tools Sample Menu Add Records
 *
 * @class DT_Demo_Add_Records
 * @version    0.1
 * @since 0.1
 * @package    Disciple_Tools
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly
}

class DT_Demo_Add_Records {

    /**
     * DT_Demo_Add_Records The single instance of DT_Demo_Add_Records.
     * @var     object
     * @access  private
     * @since     0.1
     */
    private static $_instance = null;

    /**
     * Main DT_Demo_Add_Records Instance
     *
     * Ensures only one instance of DT_Demo_Add_Records is loaded or can be loaded.
     *
     * @since 0.1
     * @static
     * @return DT_Demo_Add_Records instance
     */
    public static function instance () {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
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
    public function DT_Demo_Add_Records_content () {
        global $wpdb;
        $html = '';



        /**********************************************************************/
        /* Handle Postback */
        /**********************************************************************/

        if (isset( $_POST['submit'] )) {

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
                    $html .= $report_box_top . DT_Demo()->users->add_users_combined( $_POST['count'] ) . $report_box_bottom;
                    break;

                case 'refresh_users':
                    $html .= $report_box_top . DT_Demo()->users->add_users_once( $_POST['count'] ) . $report_box_bottom;
                    break;



                case 'reset_users':
                    $html .= $report_box_top . DT_Demo()->users->reset_users() . $report_box_bottom;
                    break;


                // Contacts
                case 'add_contacts':
                    $html .= $report_box_top . DT_Demo()->contacts->add_contacts_by_count( $_POST['count'] ) . $report_box_bottom;
                    break;

                // Groups
                case 'add_groups':
                    $html .= $report_box_top . DT_Demo()->groups->add_groups_by_count( $_POST['count'] ) . $report_box_bottom;
                    break;

                // Locations
                case 'add_locations':
                    $html .= $report_box_top . DT_Demo()->locations->add_locations_by_count( $_POST['count'] ) . $report_box_bottom;
                    break;

                // Assets
                case 'add_assets':
                    $html .= $report_box_top . DT_Demo()->assets->add_assets_by_count( $_POST['count'] ) . $report_box_bottom;
                    break;

                case 'add_comments':
                    $html .= $report_box_top . DT_Demo()->comments->add_comments( $_POST['count'] ) . $report_box_bottom;
                    break;



                // Prayer posts
                case 'add_prayer_posts':
                    $html .= $report_box_top . DT_Demo()->prayer->add_prayer_posts_by_count( $_POST['count'] ) . $report_box_bottom;
                    break;
                case 'add_progress_posts':
                    $html .= $report_box_top . DT_Demo()->progress->add_progress_posts_by_count( $_POST['count'] ) . $report_box_bottom;
                    break;

                // Generations
                case 'build_baptisms':
                    $html .= $report_box_top . DT_Demo()->connections->add_baptism_connections( $_POST['count'] ) . $report_box_bottom;
                    break;
                case 'build_churches':
                    $html .= $report_box_top . DT_Demo()->connections->add_church_connections( $_POST['count'] ) . $report_box_bottom;
                    break;
                case 'build_coaching':
                    $html .= $report_box_top . DT_Demo()->connections->add_coaching_connections( $_POST['count'] ) . $report_box_bottom;
                    break;
                case 'contacts_to_groups':
                    $html .= $report_box_top . DT_Demo()->connections->add_contacts_to_groups( $_POST['count'] ) . $report_box_bottom;
                    break;
                case 'contacts_to_locations':
                    $html .= $report_box_top . DT_Demo()->connections->add_contacts_to_locations( $_POST['count'] ) . $report_box_bottom;
                    break;
                case 'groups_to_locations':
                    $html .= $report_box_top . DT_Demo()->connections->add_groups_to_locations( $_POST['count'] ) . $report_box_bottom;
                    break;
                case 'assets_to_locations':
                    $html .= $report_box_top . DT_Demo()->connections->add_assets_to_locations( $_POST['count'] ) . $report_box_bottom;
                    break;

                case 'shuffle_assignments':
                    $html .= $report_box_top . DT_Demo()->contacts->shuffle_assignments( $_POST['count'] ) . $report_box_bottom;
                    break;

                case 'shuffle_update_requests':
                    $html .= $report_box_top . DT_Demo()->contacts->shuffle_update_requests( $_POST['count'] ) . $report_box_bottom;
                    break;


                // MISC
                case 'build_reports':
                    $html .= $report_box_top . DT_Demo()->add_report->activity_form( $_POST ) . $report_box_bottom;
                    break;


                // Utilities
                case 'reset_roles':
                    $html .= $report_box_top . DT_Demo()->roles->reset_roles() . $report_box_bottom;
                    break;
                case 'add_core_pages':
                    $html .= $report_box_top . DT_Demo()->content->add_core_pages_once( $_POST['count'] ) . $report_box_bottom;
                    break;
                case 'reset_core_pages':
                    $html .= $report_box_top . DT_Demo()->content->reset_core_pages( $_POST['count'] ) . $report_box_bottom;
                    break;

                // Delete
                case 'delete_contacts':
                    $html .= $report_box_top . DT_Demo()->contacts->delete_contacts() . $report_box_bottom;
                    break;
                case 'delete_groups':
                    $html .= $report_box_top . DT_Demo()->groups->delete_groups() . $report_box_bottom;
                    break;
                case 'delete_locations':
                    $html .= $report_box_top . DT_Demo()->locations->delete_locations() . $report_box_bottom;
                    break;
                case 'delete_assets':
                    $html .= $report_box_top . DT_Demo()->assets->delete_assets() . $report_box_bottom;
                    break;
                case 'delete_users':
                    $html .= $report_box_top . DT_Demo()->users->delete_users() . $report_box_bottom;
                    break;
                case 'delete_prayers':
                    $html .= $report_box_top . DT_Demo()->prayer->delete_prayer_posts() . $report_box_bottom;
                    break;
                case 'delete_progress':
                    $html .= $report_box_top . DT_Demo()->progress->delete_progress_posts() . $report_box_bottom;
                    break;
                case 'delete_comments':
                    $html .= $report_box_top . DT_Demo()->comments->delete_comments() . $report_box_bottom;
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
        $assets = wp_count_posts( 'assetmapping' );
        $prayer = wp_count_posts( 'prayer' );
        $progress = wp_count_posts( 'progress' );
        $comments = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->comments" );

        $contacts_to_locations = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->p2p WHERE p2p_type = 'contacts_to_locations'" );
        $groups_to_locations = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->p2p WHERE p2p_type = 'groups_to_locations'" );
        $assets_to_locations = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->p2p WHERE p2p_type = 'assetmapping_to_locations'" );
        $contacts_to_groups = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->p2p WHERE p2p_type = 'contacts_to_groups'" );

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
                    <thead><th>DO FIRST</th><th></th><th>Current</th></thead>
                    <tbody>
                        <tr><th>Users</th><td>
                            <form method="POST"><input type="hidden" name="count" value="1" /> <button type="submit" value="add_users" name="submit" class="button" id="add_users">Add Users</button></form>
                        </td><td>'.$users.'</td></tr>
                        
                        <tr><th>Contacts</th><td>
                            <form method="POST"><input type="hidden" name="count" value="50" /> <button type="submit" value="add_contacts" name="submit" class="button" id="add_contacts">Add Contacts</button></form>
                        </td><td>'.$contacts->publish.'</td></tr>
                        
                        <tr><th>Groups</th><td>
                            <form method="POST"><input type="hidden" name="count" value="50" /> <button type="submit" value="add_groups" name="submit" class="button" id="add_groups">Add Groups</button></form>
                        </td><td>'.$groups->publish.'</td></tr>
                        
                        <tr><th>Locations</th><td>
                                 <a href="edit.php?post_type=locations&page=disciple_tools_locations" class="button">Add Locations</a>
                            <!-- Removed and replaced by import tool <form method="POST"><input type="hidden" name="count" value="25" /> <button type="submit" value="add_locations" name="submit" class="button" id="add_locations">Add Locations</button></form> -->
                        </td><td>'.$locations->publish.'</td></tr>
                        
                        <tr><th>Asset Mapping</th><td>
                            <form method="POST"><input type="hidden" name="count" value="25" /> <button type="submit" value="add_assets" name="submit" class="button" id="add_assets">Add Assets</button></form>
                        </td><td>'.$assets->publish.'</td></tr>
                        
                        <tr><th>Prayer Posts</th><td>
                            <form method="POST"><input type="hidden" name="count" value="5" /> <button type="submit" value="add_prayer_posts" name="submit" class="button" id="add_prayer_posts">Add Prayer Posts</button></form>
                        </td><td>'.$prayer->publish.'</td></tr>
                        
                        <tr><th>Progress Posts</th><td>
                            <form method="POST"><input type="hidden" name="count" value="5" /> <button type="submit" value="add_progress_posts" name="submit" class="button" id="add_progress_posts">Add Progress Posts</button></form>
                        </td><td>'.$progress->publish.'</td></tr>
                        
                        <tr><th>Comments</th><td>
                            <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="add_comments" name="submit" class="button" id="add_comments">Add Comments</button></form>
                        </td><td>'.$comments .'</td></tr>
                        
                        </tbody>
             </table>
             <br>
                        ';
        $html .= '<table class="widefat striped">
                    <thead><th>DO SECOND</th><th></th><th>Current</th></thead>
                    <tbody>
                        <tr><th>Baptism Generations</th><td>
                            <form method="POST"><input type="hidden"  name="count" value="25" /> <button type="submit" value="build_baptisms" name="submit" class="button" id="build_baptisms">Add Baptism Generations</button></form>
                        </td><td>'.$baptism_gen.'</td></tr>
                        
                        <tr><th>Group Generations</th><td>
                            <form method="POST"><input type="hidden"  name="count" value="10" /> <button type="submit" value="build_churches" name="submit" class="button" id="build_churches">Add Group Generations</button></form>
                        </td><td>'.$group_gen.'</td></tr>
                        
                        <tr><th>Coaching Generations</th><td>
                            <form method="POST"><input type="hidden" name="count" value="25" /> <button type="submit" value="build_coaching" name="submit" class="button" id="build_coaching">Add Coaching Generations</button></form>
                        </td><td>'.$coaching_gen.'</td></tr>
                        
                        <tr><th>Contacts to Locations</th><td>
                            <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="contacts_to_locations" name="submit" class="button" id="contacts_to_locations">Connect Contacts to Locations</button></form>
                        </td><td>'.$contacts_to_locations  .'</td></tr> 
                        
                        <tr><th>Groups to Locations</th><td>
                            <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="groups_to_locations" name="submit" class="button" id="groups_to_locations">Connect Groups to Locations</button></form>
                        </td><td>'.$groups_to_locations  .'</td></tr>
                        
                        <tr><th>Asset Mapping to Locations</th><td>
                            <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="assets_to_locations" name="submit" class="button" id="assets_to_locations">Connect Assets to Locations</button></form>
                        </td><td>'.$assets_to_locations  .'</td></tr>
                        
                        <tr><th>Contacts to Groups</th><td>
                            <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="contacts_to_groups" name="submit" class="button" id="contacts_to_groups">Connect Contacts to Groups</button></form>
                        </td><td>'.$contacts_to_groups  .'</td></tr>
                        
                        
                        
                </tbody>
             </table>
             <br>
             ';

//        $args = array(
//            'meta_key' => '_sample',
//            'meta_value' => 'sample',
//        );
//        $comments = get_comments( $args );

//        print '<pre>'; print_r($comments); print '</pre>';


        $html .= '</div><!-- end post-body-content -->';

        $html .=   '<div id="postbox-container-1" class="postbox-container">

                    <table class="widefat striped">
                        <thead><th>UTILITIES</th><th></th></thead>
                            <tbody>
                                
                                <tr><th>Add Pages</th><td>
                                    <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="add_core_pages" name="submit" class="button" id="add_core_pages">Add Core Pages</button></form>
                                </td></tr>
                                
                                <tr><th>Refresh Roles</th><td>
                                    <form method="POST"><button type="submit" value="reset_roles" name="submit" class="button" id="reset_roles">Refresh Roles</button></form>
                                </td></tr>
                                
                                <tr><th>Reset Core Users</th><td>
                                    <form method="POST"><button type="submit" value="refresh_users" name="submit" class="button" id="refresh_users">Reset Users</button></form>
                                </td></tr>
                                
                                <tr><th>Shuffle Assignments</th><td>
                                    <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="shuffle_assignments" name="submit" class="button" id="shuffle_assignments">Shuffle Assignments</button></form>
                                </td></tr>
                                
                                <tr><th>Shuffle Updates Requested</th><td>
                                    <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="shuffle_update_requests" name="submit" class="button" id="shuffle_update_requests">Shuffle Updates</button></form>
                                </td></tr>
                                
                             </tbody>
                    </table><br>
                    
                    <table class="widefat striped">
                         <thead><th>REMOVE</th><th></th></thead>
                            <tbody>
                                
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
                                
                                <tr><th>Delete Locations</th><td>
                                    <a href="javascript:void(0);" class="button" onclick="jQuery(\'#delete_locations_confirm\').show();">Delete Locations</a>
                                    
                                </td></tr>
                                <tr id="delete_locations_confirm" class="warning" style="display:none;"><th>Are you sure?</th><td>
                                    <form method="POST"><button type="submit" value="delete_locations" name="submit" class="button" style="background:red; color:white;" id="delete_groups">Confirm Delete</button></form>
                                </td></tr>
                                
                                <tr><th>Delete Assets</th><td>
                                    <a href="javascript:void(0);" class="button" onclick="jQuery(\'#delete_assets_confirm\').show();">Delete Assets</a>
                                </td></tr>
                                <tr id="delete_assets_confirm" class="warning" style="display:none;"><th>Are you sure?</th><td>
                                    <form method="POST"><button type="submit" value="delete_assets" name="submit" class="button" style="background:red; color:white;" id="delete_assets">Confirm Delete</button></form>
                                </td></tr>
                                
                                <tr><th>Delete Users</th><td>
                                    <a href="javascript:void(0);" class="button" onclick="jQuery(\'#delete_users_confirm\').show();">Delete Users</a>
                                </td></tr>
                                <tr id="delete_users_confirm" class="warning" style="display:none;"><th>Are you sure?</th><td>
                                    <form method="POST"><button type="submit" value="delete_users" name="submit" class="button" style="background:red; color:white;" id="delete_users">Confirm Delete</button></form>
                                </td></tr>
                                
                                <tr><th>Delete Prayers</th><td>
                                    <a href="javascript:void(0);" class="button" onclick="jQuery(\'#delete_prayers_confirm\').show();">Delete Prayer</a>
                                </td></tr>
                                <tr id="delete_prayers_confirm" class="warning" style="display:none;"><th>Are you sure?</th><td>
                                    <form method="POST"><button type="submit" value="delete_prayers" name="submit" class="button" style="background:red; color:white;" id="delete_prayers">Confirm Delete</button></form>
                                </td></tr>
                                
                                <tr><th>Delete Progress</th><td>
                                    <a href="javascript:void(0);" class="button" onclick="jQuery(\'#delete_progress_confirm\').show();">Delete Progress</a>
                                </td></tr>
                                <tr id="delete_progress_confirm" class="warning" style="display:none;"><th>Are you sure?</th><td>
                                    <form method="POST"><button type="submit" value="delete_progress" name="submit" class="button" style="background:red; color:white;" id="delete_progress">Confirm Delete</button></form>
                                </td></tr>
                                
                                <tr><th>Delete Comments</th><td>
                                    <a href="javascript:void(0);" class="button" onclick="jQuery(\'#delete_comments_confirm\').show();">Delete Comments</a>
                                </td></tr>
                                <tr id="delete_comments_confirm" class="warning" style="display:none;"><th>Are you sure?</th><td>
                                    <form method="POST"><button type="submit" value="delete_comments" name="submit" class="button" style="background:red; color:white;" id="delete_comments">Confirm Delete</button></form>
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

        $html .= '<style type="text/css">#spinner {display:none;}</style>';

        return $html;
    }

}