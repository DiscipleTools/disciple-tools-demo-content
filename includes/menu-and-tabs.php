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
            $tab = 'quick';
        }

        $link = 'admin.php?page='.$this->token.'&tab=';

        ?>
        <div class="wrap">
            <h2><?php esc_attr_e( 'DISCIPLE TOOLS - DEMO CONTENT', 'dt_demo' ) ?></h2>
<!--            <h2 class="nav-tab-wrapper">-->
<!--                <a href="--><?php //echo esc_attr( $link ) . 'quick' ?><!--" class="nav-tab --><?php //( $tab == 'quick' || ! isset( $tab ) ) ? esc_attr_e( 'nav-tab-active', 'dt_demo' ) : print ''; ?><!--">--><?php //esc_attr_e( 'Quick Launch', 'dt_demo' ) ?><!--</a>-->
<!--            </h2>-->

            <?php
            switch ($tab) {
                case "quick":
                    $object = new DT_Demo_Tab_Quick_Launch();
                    $object->content();
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

            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">

                        <?php $this->quick_launch_box() ?>
                        <?php echo $this->add_records(); ?>

                    </div><!-- end post-body-content -->
                    <div id="postbox-container-1" class="postbox-container">

                        <?php echo $this->right_column_utilities(); ?>

                    </div><!-- postbox-container 1 -->
                    <div id="postbox-container-2" class="postbox-container">
                    </div><!-- postbox-container 2 -->
                </div><!-- post-body meta box container -->
            </div><!--poststuff end -->
        </div><!-- wrap end -->
        <?php
    }

    public function add_records() {
        global $wpdb;
        /**********************************************************************/
        /* Handle Postback */
        /**********************************************************************/
        $html = '';
        $html .= $this->report_box();

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



        $html .= '<h1>Add Additional Records</h1>';

        // Progress Metabox
        $html .= '<table class="widefat striped">
                    <thead><th width="50%">ADD</th><th>Count</th><th>Add</th><th>Delete</th></thead>
                    <tbody>
                        
                        
                        <tr><th>Contacts</th>
                            <td class="add_contacts_count delete_contacts_count">'.$contacts->publish.'</td>
                            <td>
                                <button type="button" onclick="add_contacts();"class="button" id="add_contacts">Add 20 Contacts <span id="add_contacts_spinner" style="width:15px;"></span></button>
                                
                            </td>
                            <td>
                                <a href="javascript:void(0);" class="button" onclick="jQuery(\'#delete_contacts_confirm\').show();">Delete All Contacts</a>
                                <div id="delete_contacts_confirm" class="warning" style="display:none;"><span>Are you sure?</span><br>
                                    <button type="button" onclick="delete_contacts()" value="delete_contacts" name="submit" class="button" style="background:red; color:white;" id="delete_contacts">Confirm Delete <span id="delete_contacts_spinner" style="width:15px;"></span></button></form>
                                </div>
                            </td>
                        </tr>
                        
                        <tr><th>Groups</th>
                            <td class="add_groups_count delete_groups_count">'.$groups->publish.'</td>
                            <td>
                                <button type="button" onclick="add_groups();"class="button" id="add_groups">Add 20 groups <span id="add_groups_spinner" style="width:15px;"></span></button>
                                
                            </td>
                            <td>
                                <a href="javascript:void(0);" class="button" onclick="jQuery(\'#delete_groups_confirm\').show();">Delete All Groups</a>
                                <div id="delete_groups_confirm" class="warning" style="display:none;"><span>Are you sure?</span><br>
                                    <button type="button" onclick="delete_groups()" value="delete_groups" name="submit" class="button" style="background:red; color:white;" id="delete_groups">Confirm Delete <span id="delete_groups_spinner" style="width:15px;"></span></button></form>
                                </div>
                            </td>
                        </tr>
                        
                        <tr><th>Comments</th>
                            <td class="add_comments_count delete_comments_count">'.$comments.'</td>
                            <td>
                                <button type="button" onclick="add_comments();"class="button" id="add_comments">Add 30 Comments <span id="add_comments_spinner" style="width:15px;"></span></button>
                                
                            </td>
                            <td>
                                <a href="javascript:void(0);" class="button" onclick="jQuery(\'#delete_comments_confirm\').show();">Delete All Comments</a>
                                <div id="delete_comments_confirm" class="warning" style="display:none;"><span>Are you sure?</span><br>
                                    <button type="button" onclick="delete_comments()" value="delete_comments" name="submit" class="button" style="background:red; color:white;" id="delete_comments">Confirm Delete <span id="delete_comments_spinner" style="width:15px;"></span></button></form>
                                </div>
                            </td>
                        </tr>
                        
                        <tr><th>Users</th><td>'.$users.'</td>
                        <td>
                            <a href="user-new.php"  target="_blank" rel="noreferrer nofollow">Add Users</a>
                        </td>
                        <td>
                           <a href="users.php"  target="_blank" rel="noreferrer nofollow">Delete Users</a>
                        </td>
                        </tr>
                        
                        <tr><th>Locations</th><td>' . $locations->publish . '</td>
                        <td>
                             <a href="admin.php?page=dt_options&tab=locations"  target="_blank" rel="noreferrer nofollow">Add Locations</a>
                        </td>
                        <td>
                            <a href="edit.php?post_type=locations" target="_blank" rel="noreferrer nofollow">Delete Locations</a>
                        </td>
                        </tr>
                        
                       
                        ';

        $html .= '
                    </tbody>
             </table>
             <br>';

        $html .= '<table class="widefat striped">
                    <thead><th width="50%">CONNECT</th><th>Count</th><th>Add</th><th></th></thead>
                    <tbody>
                        <tr><th>Baptism Generations</th><td id="add_baptism_generations_count">'.$baptism_gen.'</td><td>
                            <button type="button" onclick="add_connections();"class="button" id="add_connections">Add Connections</button>
                        </td><td><span id="add_baptism_generations_spinner" style="width:15px;"></span></td></tr>
                        
                        <tr><th>Group Generations</th><td id="add_group_generations_count">'.$group_gen.'</td><td>
                        </td><td><span id="add_group_generations_spinner" style="width:15px;"></span></td></tr>
                        
                        <tr><th>Coaching Generations</th><td id="add_coaching_generations_count">'.$coaching_gen.'</td><td>
                        </td><td><span id="add_coaching_generations_spinner" style="width:15px;"></span></td></tr>
                        
                        <tr><th>Contacts to Locations</th><td id="add_contacts_locations_count">'.$contacts_to_locations  .'</td><td>
                        </td><td><span id="add_contacts_locations_spinner" style="width:15px;"></span></td></tr> 
                        
                        <tr><th>Groups to Locations</th><td id="add_groups_locations_count">'.$groups_to_locations  .'</td><td>
                        </td><td><span id="add_groups_locations_spinner" style="width:15px;"></span></td></tr>
                        
                        <tr><th>Contacts to Groups</th><td id="add_contacts_group_count">'.$contacts_to_groups  .'</td><td>
                        </td><td><span id="add_contacts_group_spinner" style="width:15px;"></span></td></tr>
                        ';
        $html .= '
                </tbody>
             </table>
             <br>
             
             <table class="widefat striped">
                <thead><th width="50%">UTILITIES</th><th></th></thead>
                    <tbody>
                        
                        <tr><th>Shuffle Assignments</th><td>
                            <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="shuffle_assignments" name="submit" class="button" id="shuffle_assignments">Shuffle Assignments</button></form>
                        </td></tr>
                        
                        <tr><th>Shuffle Updates Requested</th><td>
                            <form method="POST"><input type="hidden" name="count" value="100" /> <button type="submit" value="shuffle_update_requests" name="submit" class="button" id="shuffle_update_requests">Shuffle Updates</button></form>
                        </td></tr>
                        
                     </tbody>
            </table><br>
             ';


        $html .= '<style type="text/css">#spinner {display:none;}</style>';

        return $html;
    }

    public function report_box() {
        $html = '';
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
        return $html;
    }

    public function right_column_utilities() {
        $html = '';

        return $html;
    }

    public function quick_launch_box() {
        ?>
        <h1>Quick Launch</h1>
        <!-- Box -->
        <table class="widefat striped">
            <thead>
            </thead>
            <tbody>
            <tr>
                <td>
                    <p>
                        <?php $installed = get_option( 'dt_demo_sample_data' );
                        $title = $installed ? __( 'Delete Prepared Data' ): __( 'Install Prepared Data' ); ?>
                        <button type="button" class="button" id="install-quick-launch" onclick="toggle_prepared_data(<?php echo $installed; ?>)">
                            <?php echo esc_attr( $title ); ?>
                        </button>
                        <span id="quick-launch-spinner"></span>
                        <span id="spinner"></span>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" id="hide-from-ui" name="hide-from-ui" onclick="hide_on_startup()" <?php if( get_option( 'dt_demo_hide_popup' ) ) : echo 'checked';
else: echo '';
endif; ?>/>
                    <label for="hide-from-ui">Hide popup on startup <span id="hide-on-startup"></span></label>
                </td>
            </tr>
            </tbody>
        </table>
        <br>
        <!-- End Box -->
        <?php
    }

}
