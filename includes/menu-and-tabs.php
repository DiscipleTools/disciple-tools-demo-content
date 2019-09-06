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
                        <?php $this->add_records(); ?>

                    </div><!-- end post-body-content -->
                    <div id="postbox-container-1" class="postbox-container">

                        <?php $this->right_column_utilities(); ?>

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

        /**********************************************************************/
        /* Calculate Current Status */
        /**********************************************************************/

        // Number of users
        $user_object = count_users();
        $users = $user_object['total_users'];

        // Number of contacts
        $contacts = wp_count_posts( 'contacts' );
        $groups = wp_count_posts( 'groups' );

        if ( ! $comments = wp_cache_get( 'demo_comments' ) ) {
            $comments = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->comments" );
            wp_cache_set( 'demo_comments', $comments );
        }


        if ( ! $contacts_to_locations = wp_cache_get( 'contacts_to_locations' ) ) {
            $contacts_to_locations = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->postmeta JOIN $wpdb->posts on ( ID = post_id AND post_type = 'contacts' )  WHERE meta_key = 'location_grid'" );
            wp_cache_set( 'contacts_to_locations', $contacts_to_locations );
        }
        if ( ! $groups_to_locations = wp_cache_get( 'groups_to_locations' ) ) {
            $groups_to_locations = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->postmeta JOIN $wpdb->posts on ( ID = post_id AND post_type = 'groups' ) WHERE meta_key = 'location_grid'" );
            wp_cache_set( 'groups_to_locations', $groups_to_locations );
        }
        if ( ! $contacts_to_groups = wp_cache_get( 'contacts_to_groups' ) ) {
            $contacts_to_groups = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->p2p WHERE p2p_type = 'contacts_to_groups'" );
            wp_cache_set( 'contacts_to_groups', $contacts_to_groups );
        }

        // Number of Baptism connections
        if ( ! $baptism_gen = wp_cache_get( 'baptism_gen' ) ) {
            $baptism_gen = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->p2p WHERE p2p_type = 'baptizer_to_baptized'" );
            wp_cache_set( 'baptism_gen', $baptism_gen );
        }
        if ( ! $group_gen = wp_cache_get( 'group_gen' ) ) {
            $group_gen = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->p2p WHERE p2p_type = 'groups_to_groups'" );
            wp_cache_set( 'group_gen', $group_gen );
        }
        if ( ! $coaching_gen = wp_cache_get( 'coaching_gen' ) ) {
            $coaching_gen = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->p2p WHERE p2p_type = 'contacts_to_contacts'" );
            wp_cache_set( 'coaching_gen', $coaching_gen );
        }


        // Progress Metabox
        ?>
        <h1>Add Additional Records</h1>
        <table class="widefat striped">
            <thead><th width="50%">ADD</th><th>Count</th><th>Add</th><th>Delete</th></thead>
            <tbody>
                <tr><th>Contacts</th>
                    <td class="add_contacts_count delete_contacts_count"><?php echo esc_html( $contacts->publish ) ?></td>
                    <td>
                        <button type="button" onclick="add_contacts();"class="button" id="add_contacts">Add 20 Contacts <span id="add_contacts_spinner" style="width:15px;"></span></button>

                    </td>
                    <td>
                        <a href="javascript:void(0);" class="button" onclick="jQuery('#delete_contacts_confirm').show();">Delete All Contacts</a>
                        <div id="delete_contacts_confirm" class="warning" style="display:none;"><span>Are you sure?</span><br>
                            <button type="button" onclick="delete_contacts()" value="delete_contacts" name="submit" class="button" style="background:red; color:white;" id="delete_contacts">Confirm Delete <span id="delete_contacts_spinner" style="width:15px;"></span></button></form>
                        </div>
                    </td>
                </tr>

                <tr><th>Groups</th>
                    <td class="add_groups_count delete_groups_count"> <?php echo esc_html( $groups->publish ) ?></td>
                    <td>
                        <button type="button" onclick="add_groups();"class="button" id="add_groups">Add 20 groups <span id="add_groups_spinner" style="width:15px;"></span></button>

                    </td>
                    <td>
                        <a href="javascript:void(0);" class="button" onclick="jQuery('#delete_groups_confirm').show();">Delete All Groups</a>
                        <div id="delete_groups_confirm" class="warning" style="display:none;"><span>Are you sure?</span><br>
                            <button type="button" onclick="delete_groups()" value="delete_groups" name="submit" class="button" style="background:red; color:white;" id="delete_groups">Confirm Delete <span id="delete_groups_spinner" style="width:15px;"></span></button></form>
                        </div>
                    </td>
                </tr>

                <tr><th>Comments</th>
                    <td class="add_comments_count delete_comments_count"><?php echo esc_html( $comments )?></td>
                    <td>
                        <button type="button" onclick="add_comments();"class="button" id="add_comments">Add 30 Comments <span id="add_comments_spinner" style="width:15px;"></span></button>

                    </td>
                    <td>
                        <a href="javascript:void(0);" class="button" onclick="jQuery('#delete_comments_confirm').show();">Delete All Comments</a>
                        <div id="delete_comments_confirm" class="warning" style="display:none;"><span>Are you sure?</span><br>
                            <button type="button" onclick="delete_comments()" value="delete_comments" name="submit" class="button" style="background:red; color:white;" id="delete_comments">Confirm Delete <span id="delete_comments_spinner" style="width:15px;"></span></button></form>
                        </div>
                    </td>
                </tr>

                <tr><th>Users</th><td><?php echo esc_html( $users )?></td>
                <td>
                    <a href="user-new.php"  target="_blank" rel="noreferrer nofollow">Add Users</a>
                </td>
                <td>
                   <a href="users.php"  target="_blank" rel="noreferrer nofollow">Delete Users</a>
                </td>
                </tr>

            </tbody>
         </table>
         <br>

        <table class="widefat striped">
            <thead><th width="50%">CONNECT</th><th>Count</th><th>Add</th><th></th></thead>
            <tbody>
                <tr><th colspan="3">
                        <select id="admin0_code">
                            <option value="USA">United States</option>
                            <?php
                            global $wpdb;

                            $list = $wpdb->get_results( "SELECT admin0_code, name FROM $wpdb->dt_location_grid WHERE level = 0", ARRAY_A );
                            foreach ( $list as $country ) {
                                echo '<option value="'.esc_html( $country['admin0_code'] ).'">'.esc_html( $country['name'] ).'</option>';
                            }
                            ?>
                        </select>
                        <button type="button" onclick="add_connections();"class="button" id="add_connections">Add Connections</button>
                    </th></tr>

                <tr><th>Baptism Generations</th><td id="add_baptism_generations_count"><?php echo esc_html( $baptism_gen ) ?></td>
                </td><td><span id="add_baptism_generations_spinner" style="width:15px;"></span></td></tr>

                <tr><th>Group Generations</th><td id="add_group_generations_count"><?php echo esc_html( $group_gen )?></td><td>
                </td><td><span id="add_group_generations_spinner" style="width:15px;"></span></td></tr>

                <tr><th>Coaching Generations</th><td id="add_coaching_generations_count"><?php echo esc_html( $coaching_gen )?></td><td>
                </td><td><span id="add_coaching_generations_spinner" style="width:15px;"></span></td></tr>

                <tr><th>Contacts to Locations</th><td id="add_contacts_locations_count"><?php echo esc_html( $contacts_to_locations )?></td><td>
                </td><td><span id="add_contacts_locations_spinner" style="width:15px;"></span></td></tr>

                <tr><th>Groups to Locations</th><td id="add_groups_locations_count"><?php echo esc_html( $groups_to_locations )?></td><td>
                </td><td><span id="add_groups_locations_spinner" style="width:15px;"></span></td></tr>

                <tr><th>Contacts to Groups</th><td id="add_contacts_group_count"><?php echo esc_html( $contacts_to_groups )?></td><td>
                </td><td><span id="add_contacts_group_spinner" style="width:15px;"></span></td></tr>


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
        </table>
        <br>



        <style type="text/css">#spinner {display:none;}</style>
        <?php
    }


    public function right_column_utilities() {

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
                        $title = $installed ? __( 'Delete Sample Content' ) : __( 'Install Sample Content' ); ?>
                        <button type="button" class="button" id="install-quick-launch"
                                onclick="toggle_prepared_data(<?php echo esc_html( $installed ); ?>)">
                            <?php echo esc_attr( $title ); ?>
                        </button>
                        <span id="quick-launch-spinner" class="loading-spinner"></span>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" id="hide-from-ui" name="hide-from-ui"
                           onclick="hide_on_startup()" <?php echo esc_html( get_option( 'dt_demo_hide_popup' ) ? 'checked' : '' ) ?>/>
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
