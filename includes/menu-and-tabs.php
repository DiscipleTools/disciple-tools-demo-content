<?php
/**
 * DT_Demo_Menu class for the admin page
 *
 * @class       DT_Demo_Menu
 * @version     0.1.0
 * @since       0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly
}

/**
 * Class DT_Demo_Menu
 */
class DT_Demo_Menu {

    public $token = 'dt_demo';
    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct() {
        add_action( "admin_menu", array( $this, "register_menu" ) );
    }

    /**
     * Loads the subnav page
     * @since 0.1
     */
    public function register_menu() {
        add_menu_page( __( 'Extensions (DT)', 'disciple_tools' ), __( 'Extensions (DT)', 'disciple_tools' ), 'manage_dt', 'dt_extensions', [ $this, 'extensions_menu' ], 'dashicons-admin-generic', 59 );
        add_submenu_page( 'dt_extensions', __( 'Demo Content', 'dt_demo' ), __( 'Demo Content', 'dt_demo' ), 'manage_dt', $this->token, [ $this, 'content' ] );
    }

    /**
     * Menu stub. Replaced when Disciple Tools Theme fully loads.
     */
    public function extensions_menu() {}

    /**
     * Builds page contents
     * @since 0.1
     */
    public function content() {

        if ( !current_user_can( 'manage_dt' ) ) {
            wp_die( esc_attr__( 'You do not have sufficient permissions to access this page.' ) );
        }

        if ( isset( $_GET["tab"] ) ) {
            $tab = sanitize_key( wp_unslash( $_GET["tab"] ) );
        } else {
            $tab = 'records';
        }

        $link = 'admin.php?page='.$this->token.'&tab=';

        ?>
        <div class="wrap">
            <h2><?php esc_attr_e( 'DISCIPLE TOOLS - DEMO CONTENT', 'dt_demo' ) ?></h2>
            <h2 class="nav-tab-wrapper">
                <a href="<?php echo esc_attr( $link ) . 'quick' ?>" class="nav-tab <?php ( $tab == 'quick' || ! isset( $tab ) ) ? esc_attr_e( 'nav-tab-active', 'dt_demo' ) : print ''; ?>"><?php esc_attr_e( 'Quick Launch', 'dt_demo' ) ?></a>
                <a href="<?php echo esc_attr( $link ) . 'records' ?>" class="nav-tab <?php ( $tab == 'records' ) ? esc_attr_e( 'nav-tab-active', 'dt_demo' ) : print ''; ?>"><?php esc_attr_e( 'Add Records', 'dt_demo' ) ?></a>
            </h2>

            <?php
            switch ($tab) {
                case "quick":
                    $object = new DT_Demo_Tab_Quick_Launch();
                    $object->content();
                    break;
                case "records":
                    $object = new DT_Demo_Tab_Add_Records();
                    echo $object->content();
                    break;
                default:
                    break;
            }
            ?>

        </div><!-- End wrap -->

        <?php
    }
}
DT_Demo_Menu::instance();

/**
 * Class DT_Demo_Tab_Quick_Launch
 */
class DT_Demo_Tab_Quick_Launch
{
    public function content() {
        ?>
        <div class="wrap">
            <h2>Quick Launch</h2>
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">

                        <?php $this->main_column() ?>

                    </div><!-- end post-body-content -->
                    <div id="postbox-container-1" class="postbox-container">

                        <?php $this->right_column() ?>

                    </div><!-- postbox-container 1 -->
                    <div id="postbox-container-2" class="postbox-container">
                    </div><!-- postbox-container 2 -->
                </div><!-- post-body meta box container -->
            </div><!--poststuff end -->
        </div><!-- wrap end -->
        <?php
    }

    public function main_column() {
        ?>
        <!-- Box -->

        <table class="widefat striped">
            <thead>
            <th>Quick Launch</th>
            </thead>
            <tbody>
            <tr>
                <td>
                    <?php $this->quick_launch_box(); ?>
                </td>
            </tr>
            </tbody>
        </table>
        <br>
        <!-- End Box -->
        <?php
    }

    public function right_column() {
        ?>
        <!-- Box -->
        <table class="widefat striped">
            <thead>
            <th>Notes</th>
            </thead>
            <tbody>
            <tr>
                <td>
                    Content
                </td>
            </tr>
            </tbody>
        </table>
        <br>
        <!-- End Box -->
        <?php
    }

    public function quick_launch_box() {
        ?>
        <div id="prepared_data_errors"></div>
        <button type="button" id="install-quick-launch" onclick="quick_launch()">Install</button>
        <div id="spinner"></div>
        <div id="quick-launch-report"></div>
        <?php
    }
}

/**
 * Class DT_Demo_Tab_Add_Records
 */
class DT_Demo_Tab_Add_Records
{
    /**
     * Add Records Menu Tab Content
     * @access  public
     * @since   0.1
     */
    public function content() {
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
                case 'add_users':
                    $html .= $report_box_top . dt_demo()->users->add_users_combined( $_POST['count'] ) . $report_box_bottom;
                    break;

                case 'refresh_users':
                    $html .= $report_box_top . dt_demo()->users->add_users_once( $_POST['count'] ) . $report_box_bottom;
                    break;
                case 'reset_users':
                    $html .= $report_box_top . dt_demo()->users->reset_users() . $report_box_bottom;
                    break;
                case 'add_contacts':
                    if ( post_type_exists( 'contacts' ) ) {
                        $html .= $report_box_top . dt_demo()->contacts->add_contacts_by_count( $_POST['count'] ) . $report_box_bottom;
                    }
                    break;
                case 'add_groups':
                    if ( post_type_exists( 'groups' ) ) {
                        $html .= $report_box_top . dt_demo()->groups->add_groups_by_count( $_POST[ 'count' ] ) . $report_box_bottom;
                    }
                    break;
                case 'add_locations':
                    if ( post_type_exists( 'locations' ) ) {
                        $html .= $report_box_top . dt_demo()->locations->add_locations_by_count( $_POST[ 'count' ] ) . $report_box_bottom;
                    }
                    break;
                case 'add_comments':
                    $html .= $report_box_top . dt_demo()->comments->add_comments( $_POST[ 'count' ] ) . $report_box_bottom;
                    break;
                case 'build_baptisms':
                    $html .= $report_box_top . dt_demo()->connections->add_baptism_connections( $_POST['count'] ) . $report_box_bottom;
                    break;
                case 'build_churches':
                    $html .= $report_box_top . dt_demo()->connections->add_church_connections( $_POST['count'] ) . $report_box_bottom;
                    break;
                case 'build_coaching':
                    $html .= $report_box_top . dt_demo()->connections->add_coaching_connections( $_POST['count'] ) . $report_box_bottom;
                    break;
                case 'contacts_to_groups':
                    $html .= $report_box_top . dt_demo()->connections->add_contacts_to_groups( $_POST['count'] ) . $report_box_bottom;
                    break;
                case 'contacts_to_locations':
                    if ( post_type_exists( 'contacts' ) && post_type_exists( 'locations' ) ) {
                        $html .= $report_box_top . dt_demo()->connections->add_contacts_to_locations( $_POST[ 'count' ] ) . $report_box_bottom;
                    }
                    break;
                case 'groups_to_locations':
                    if ( post_type_exists( 'groups' ) && post_type_exists( 'locations' ) ) {
                        $html .= $report_box_top . dt_demo()->connections->add_groups_to_locations( $_POST[ 'count' ] ) . $report_box_bottom;
                    }
                    break;
                case 'shuffle_assignments':
                    $html .= $report_box_top . dt_demo()->contacts->shuffle_assignments( $_POST['count'] ) . $report_box_bottom;
                    break;

                case 'shuffle_update_requests':
                    $html .= $report_box_top . dt_demo()->contacts->shuffle_update_requests( $_POST['count'] ) . $report_box_bottom;
                    break;
                case 'reset_roles':
                    $html .= $report_box_top . dt_demo()->roles->reset_roles() . $report_box_bottom;
                    break;
                case 'delete_contacts':
                    $html .= $report_box_top . dt_demo()->contacts->delete_contacts() . $report_box_bottom;
                    break;
                case 'delete_groups':
                    $html .= $report_box_top . dt_demo()->groups->delete_groups() . $report_box_bottom;
                    break;
                case 'delete_locations':
                    if ( post_type_exists( 'locations' ) ) {
                        $html .= $report_box_top . dt_demo()->locations->delete_locations() . $report_box_bottom;
                    }
                    break;
                case 'delete_users':
                    $html .= $report_box_top . dt_demo()->users->delete_users() . $report_box_bottom;
                    break;
                case 'delete_comments':
                    $html .= $report_box_top . dt_demo()->comments->delete_comments() . $report_box_bottom;
                    break;
                default:
                    break;
            }
        }


        /**********************************************************************/
        /* Calculate Current Status */
        /**********************************************************************/

        // Number of users
        $user_object = count_users();
        $users = $user_object['total_users'];

        // Number of contacts
        $contacts = wp_count_posts( 'contacts' );
        $groups = wp_count_posts( 'groups' );
        $locations = wp_count_posts( 'locations' );
        $comments = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->comments" );

        $contacts_to_locations = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->p2p WHERE p2p_type = 'contacts_to_locations'" );
        $groups_to_locations = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->p2p WHERE p2p_type = 'groups_to_locations'" );
        $contacts_to_groups = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->p2p WHERE p2p_type = 'contacts_to_groups'" );

        // Number of Baptism connections
        $baptism_gen = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->p2p WHERE p2p_type = 'baptizer_to_baptized'" );
        $group_gen = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->p2p WHERE p2p_type = 'groups_to_groups'" );
        $coaching_gen = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->p2p WHERE p2p_type = 'contacts_to_contacts'" );


        /**********************************************************************/
        /* Panel Content */
        /**********************************************************************/

        $html .= '<div class="wrap"><h2>Add Sample Records</h2>';
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
                            <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="add_contacts" name="submit" class="button" id="add_contacts">Add Contacts</button></form>
                        </td><td>'.$contacts->publish.'</td></tr>
                        
                        <tr><th>Groups</th><td>
                            <form method="POST"><input type="hidden" name="count" value="50" /> <button type="submit" value="add_groups" name="submit" class="button" id="add_groups">Add Groups</button></form>
                        </td><td>'.$groups->publish.'</td></tr>
                        
                        ';

        if ( post_type_exists( 'locations' ) ) {
            $html .= '
                    <tr><th>Locations</th><td>
                             <a href="edit.php?post_type=locations&page=disciple_tools_locations" class="button">Add Locations</a>
                    </td><td>' . $locations->publish . '</td></tr>
                    ';
        }

        $html .= '<tr><th>Comments</th><td>
                        <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="add_comments" name="submit" class="button" id="add_comments">Add Comments</button></form>
                    </td><td>'.$comments .'</td></tr>
                    </tbody>
             </table>
             <br>';

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
                        ';
        $html .= '<tr><th>Contacts to Groups</th><td>
                        <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="contacts_to_groups" name="submit" class="button" id="contacts_to_groups">Connect Contacts to Groups</button></form>
                    </td><td>'.$contacts_to_groups  .'</td></tr>
                </tbody>
             </table>
             <br>
             
             <table class="widefat ">
                <thead>
                    <th>Notes</th>
                </thead>
                <tbody>
                    <tr><td>ADD SAMPLE DATA<br> These forms add the core data to the system for the purpose of testing and training.<hr></td></tr>
                    <tr><td>UTILITIES<br>Theses are utilities that allow you to reset the system.</td></tr>
                </tbody>
             </table>
             ';

        $html .= '</div><!-- end post-body-content -->';

        $html .=   '<div id="postbox-container-1" class="postbox-container">

                    <table class="widefat striped">
                        <thead><th>UTILITIES</th><th></th></thead>
                            <tbody>
                                
                                <tr><th>Reset Core Users</th><td>
                                    <form method="POST"><button type="submit" value="refresh_users" name="submit" class="button" id="refresh_users">Reset Users</button></form>
                                </td></tr>
                                
                                <tr><th>Shuffle Assignments</th><td>
                                    <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="shuffle_assignments" name="submit" class="button" id="shuffle_assignments">Shuffle Assignments</button></form>
                                </td></tr>
                                
                                <tr><th>Shuffle Updates Requested</th><td>
                                    <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="shuffle_update_requests" name="submit" class="button" id="shuffle_update_requests">Shuffle Updates</button></form>
                                </td></tr>
                                <tr><th>Refresh Roles</th><td>
                                    <form method="POST"><button type="submit" value="reset_roles" name="submit" class="button" id="reset_roles">Refresh Roles</button></form>
                                </td></tr>
                                
                             </tbody>
                    </table><br>
                    
                    <table class="widefat striped">
                         <thead><th>REMOVE</th><th></th></thead>
                            <tbody>
                                
                                <tr><th>Delete Users</th><td>
                                    <a href="javascript:void(0);" class="button" onclick="jQuery(\'#delete_users_confirm\').show();">Delete Users</a>
                                </td></tr>
                                <tr id="delete_users_confirm" class="warning" style="display:none;"><th>Are you sure?</th><td>
                                    <form method="POST"><button type="submit" value="delete_users" name="submit" class="button" style="background:red; color:white;" id="delete_users">Confirm Delete</button></form>
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
                                ';

        if ( post_type_exists( 'locations' ) ) {
            $html .= '
                    <tr><th>Delete Locations</th><td>
                        <a href="javascript:void(0);" class="button" onclick="jQuery(\'#delete_locations_confirm\').show();">Delete Locations</a>
                        
                    </td></tr>
                    <tr id="delete_locations_confirm" class="warning" style="display:none;"><th>Are you sure?</th><td>
                        <form method="POST"><button type="submit" value="delete_locations" name="submit" class="button" style="background:red; color:white;" id="delete_groups">Confirm Delete</button></form>
                    </td></tr>
             ';
        }

        $html .= '
                    <tr><th>Delete Comments</th><td>
                        <a href="javascript:void(0);" class="button" onclick="jQuery(\'#delete_comments_confirm\').show();">Delete Comments</a>
                    </td></tr>
                    <tr id="delete_comments_confirm" class="warning" style="display:none;"><th>Are you sure?</th><td>
                        <form method="POST"><button type="submit" value="delete_comments" name="submit" class="button" style="background:red; color:white;" id="delete_comments">Confirm Delete</button></form>
                    </td></tr>
                                
                                    
                        </tbody>
                    </table><br>

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