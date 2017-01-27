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

    public $p2p_array = array();

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

        add_action("admin_menu", array($this, "add_dmmcrmsample_data_menu") );

    } // End __construct()



    public function add_dmmcrmsample_data_menu () {
        add_submenu_page( 'options-general.php', __( 'DMM Sample Data', 'dmmcrmsample' ), __( 'DMM Sample Data', 'dmmcrmsample' ), 'manage_options', 'dmmcrmsample', array( $this, 'dmmcrmsample_data_page' ) );
    }


    /*
     * Sample Data Page and Tab Logic
     *
     *
     */
    public function dmmcrmsample_data_page() {

        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }

        /**
         *
         * Begin Header & Tab Bar
         */

        if (isset($_GET["tab"])) {$tab = $_GET["tab"];} else {$tab = 'dash';}

        $tab_link_pre = '<a href="options-general.php?page=dmmcrmsample&tab=';
        $tab_link_post = '" class="nav-tab ';

        $html = '<div class="wrap">
            <h2>DMM CRM SAMPLE DATA</h2>
            <h2 class="nav-tab-wrapper">';

        $html .= $tab_link_pre . 'dash' . $tab_link_post;
        if ($tab == 'dash' || !isset($tab)) {$html .= 'nav-tab-active';}
        $html .= '">Dashboard</a>';

        $html .= $tab_link_pre . 'setup' . $tab_link_post;
        if ($tab == 'setup') {$html .= 'nav-tab-active';}
        $html .= '">Setup Info</a>';

        $html .= $tab_link_pre . 'records' . $tab_link_post;
        if ($tab == 'records') {$html .= 'nav-tab-active';}
        $html .= '">Add Records</a>';

        $html .= $tab_link_pre . 'gen' . $tab_link_post;
        if ($tab == 'gen') {$html .= 'nav-tab-active';}
        $html .= '">Gen Test</a>';




        $html .= '</h2>';
        // End Tab Bar

        /**
         *
         * Begin Page Content
         */
        switch ($tab) {

            case "setup":
                    $html .= $this->dmmcrmsample_run_tools ();
                break;
            case "records":
//                    $html .= $this->dmmcrmsample_run_calc() ;
                break;
            case "gen":
                $html .= $this->dmmcrmsample_run_gen_test() ;
                break;
            default:
                    $html .= $this->dmmcrmsample_run_dashboard() ;
        }

        $html .= '</div>'; // end div class wrap

        echo $html;

    }
    /*
     * Checks if record is first generation
     *
     * @parent  Single number taken from the wp_p2p.p2p_to column
     * @column  An array with the entire column of wp_p2p.p2p_from data
     *
     * */
    protected function p2p_first_generation_check ($parent, $column) {
        foreach ($column as $value) {
            if ($value == $parent) {
                return FALSE;
            }
        }
        return TRUE;
    }


    /*
     * Checks for number of parents for a target id
     *
     *
     * */
    protected function p2p_number_of_parents_check ($value, $column) {
        $i = 0;
        foreach ($column as $row) {
            if ($row == $value) {
                $i++;
            }
        }
        return $i;
    }

    /*
     * Checks if the parent is first generation
     *
     *
     * */
    protected function p2p_get_single_parent_id( $target, $list) {
        $parent = '';

        foreach ($list as $row) {
            if ($row['p2p_from'] == $target) {
                $parent =  $row['p2p_to'];
            }
        }

        return $parent;
    }

    protected function p2p_get_parent_id( $target, $list, $column) {
        $parent = '';

        foreach ($list as $row) {
            if ($row['p2p_from'] == $target) {
                $parent .=  $row['p2p_to'];
//                if ($this->p2p_first_generation_check ($parent, $column)) {
//                    $parent .=  ' (' . $row['p2p_to'] . ' is first generation )';
//                } else {
//                    $parent .=  ' Not (' . $row['p2p_to'] . ')';
//                }
            }
        }

        return $parent;
    }


    public function dmmcrmsample_run_gen_test () {
        global $wpdb;
        $html ='';

        // Opening wrappers.
        $html .= '<div class="wrap">
                        <div id="poststuff">
                            <div id="post-body" class="metabox-holder columns-1">';


        /*
         * p2p array and loop
         *
         * */
        // Query database
        $p2p_array = $wpdb->get_results( "SELECT p2p_to, p2p_from FROM wp_p2p WHERE p2p_type = 'groups_to_groups'" );

        // Convert array object to array
        $p2p_array = json_decode(json_encode($p2p_array), True);
        //        print_r($p2p_array); print "<br><br>";

        // Create variable array with just the "to" column
        $p2p_array_to = array_column ( $p2p_array , 'p2p_to');
//                print_r($p2p_array_to); print "<br><br>";

        // Create variable array with just the "to" column
        $p2p_array_from = array_column ( $p2p_array , 'p2p_from');
//                print_r($p2p_array_from); print "<br><br>";


        foreach ($p2p_array as $v) {

            $target = $v['p2p_to'];
            $targetChild = $v['p2p_from'];


            if($this->p2p_first_generation_check($target, $p2p_array_from)) { // Check if this is first generation
                // True, this target is first generation
                $html .= $target . ' is 1st Generation <br>';

                // True statement about the Child of the target.
                $html .= $targetChild . ' is second generation<br>';
            }
            else
            { // False target is not first generation

                // True statement about the target. It is not first generation.
                $html .= $target . ' NOT first gen<br>';

                // While loop checks for the first generation and increments the generation above the target until it gets to the first generation.
                $target_inc = $target; // separates the target from the increment
                $parent_gen = array(); // prepares the array for the generations
                $i = 1; // sets the increment value

                while (true) {
                    if (! $this->p2p_first_generation_check($target_inc, $p2p_array_from)) { // is initial condition true
                        // get the parent id
                        // replace target with parent id

                        $parent_id = $this->p2p_get_single_parent_id($target_inc, $p2p_array) ;
                        $parent_gen[$i] = $parent_id . ' is ' . $i . '  gen above ' . $target . '  ';

                        $target_inc = $parent_id;
                        $i++;
                    } else { // condition failed
                        break; // leave loop
                    }
                }

                $html .= implode(' | ', $parent_gen) . '<br>'; // implodes the array and allows it to be printed with the rest of the html as a string, not an array.

            }
        }

        // Closing wrappers
        $html .= '     </div><!-- post-body meta box container -->
                    </div><!--poststuff end -->
                </div><!-- wrap end -->';

        return $html;
    }

    /*
     * Tab: Dashboard
     *
     *
     */
    public function dmmcrmsample_run_dashboard () {
        global $wpdb;
        $html ='';

        /*
         * Count SQL Statements
         *
         */
        $user_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->users" );
        $contacts_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'contacts' AND post_status = 'publish'" );
        $groups_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'groups' AND post_status = 'publish'" );
        $locations_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'locations' AND post_status = 'publish'" );

        $groups_planting_groups = $wpdb->get_var( "SELECT COUNT(DISTINCT p2p_to) as Count FROM wp_p2p Where p2p_type = 'groups_to_groups'" );
        $first_generation_churches = $wpdb->get_var("SELECT count(DISTINCT p2p_to) as count FROM wp_p2p WHERE p2p_type = 'groups_to_groups' AND p2p_to NOT IN (SELECT p2p_from FROM wp_p2p where p2p_from is not null)");
        $last_generation_churches = $wpdb->get_var("SELECT count(distinct p2p_from) as count FROM wp_p2p WHERE p2p_type = 'groups_to_groups' AND p2p_from NOT IN (SELECT p2p_to FROM wp_p2p where p2p_to is not null)");
        $church_count = $wpdb->get_var("SELECT count(distinct post_title) FROM wp_posts RIGHT JOIN wp_postmeta ON ID=wp_postmeta.post_id WHERE post_type = 'groups' AND post_status = 'publish' AND wp_postmeta.meta_value = 'Church' AND wp_postmeta.meta_key = 'type'");


        $contacts_in_groups = $wpdb->get_var( "SELECT COUNT(*) FROM wp_p2p WHERE p2p_type = 'contacts_to_groups'" );

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
                    <thead><th>Progress</th><th></th><th></th></thead>
                    <tbody>';
            $html .= '<tr><th>Prayers Network</th><td>(0)</td><td></td></tr>';
            $html .= '<tr><th>Social Engagement</th><td>(0)</td><td></td></tr>';
            $html .= '<tr><th>Website Visits</th><td>(0)</td><td></td></tr>';
            $html .= '<tr><th>New Inquirers</th><td>(0)</td><td></td></tr>';
            $html .= '<tr><th>Contact Attempted</th><td>(0)</td><td></td></tr>';
            $html .= '<tr><th>Contact Established</th><td>(0)</td><td></td></tr>';
            $html .= '<tr><th>First Meeting Complete</th><td>(0)</td><td></td></tr>';
            $html .= '<tr><th>Baptisms</th><td></td><td></td></tr>';
            $html .= '<tr><th>Baptizers</th><td></td><td></td></tr>';
            $html .= '<tr><th>Active Churches</th><td></td><td></td></tr>';
            $html .= '<tr><th>Church Planters</th><td></td><td></td></tr>';

        $html .= '</tbody></table>';

        $html .= '<br>';

        // Progress Metabox
        $html .= '<table class="widefat striped">
                    <thead><th>Demo Users Role</th><th>Installed</th><th>Username</th><th>Password</th></thead>
                    <tbody>';
            $html .= '<tr><th>Prayer Supporter</th><td>Yes</td><td>prayersupporter</td><td>dmmcrm</td></tr>';
            $html .= '<tr><th>Project Supporter</th><td>Yes</td><td>projectsupporter</td><td>dmmcrm</td></tr>';
            $html .= '<tr><th>Dispatcher</th><td>Yes</td><td>dispatcher</td><td>dmmcrm</td></tr>';
            $html .= '<tr><th>Marketer</th><td>Yes</td><td>marketer</td><td>dmmcrm</td></tr>';
            $html .= '<tr><th>Multiplier</th><td>Yes</td><td>multiplier</td><td>dmmcrm</td></tr>';
            $html .= '<tr><th>Multiplier Leader</th><td>Yes</td><td>multiplierleader</td><td>dmmcrm</td></tr>';

        $html .= '</tbody></table>';

        $html .= '<br>';

        $html .= '<table class="widefat striped">
                    <thead><th>Believers</th><th></th></thead>
                    <tbody>';
            $html .= '<tr><th>1st Generation</th><td>(0)</td></tr>';
            $html .= '<tr><th>2nd Generation</th><td>(0)</td></tr>';
            $html .= '<tr><th>3rd Generation</th><td>(0)</td></tr>';
            $html .= '<tr><th>4th Generation</th><td>(0)</td></tr>';
            $html .= '<tr><th>5th+ Generation</th><td>(0)</td></tr>';

        $html .= '</tbody></table>';

        $html .= '<br>';

        $html .= '<table class="widefat striped">
                    <thead><th>Churches</th><th></th><th></th></thead>
                    <tbody>';

            $html .= '<tr><th>Total Churches</th><td>'.$church_count.'</td><td></td></tr>';
            $html .= '<tr><th>1st Generation</th><td>'.$first_generation_churches.'</td><td></td></tr>';
            $html .= '<tr><th>2nd Generation</th><td></td><td></td></tr>';
            $html .= '<tr><th>3rd Generation</th><td>(0)</td><td></td></tr>';
            $html .= '<tr><th>4th Generation</th><td>(0)</td><td></td></tr>';
            $html .= '<tr><th>5th+ Generation</th><td>(0)</td><td></td></tr>';
            $html .= '<tr><th>Groups Who Have Repoduced</th><td>'.$groups_planting_groups.'</td><td></td></tr>';
            $html .= '<tr><th>Final Generation (Blocked)</th><td>'.$last_generation_churches.'</td><td></td></tr>';

        $html .= '</tbody></table>';



        $html .= '</div><!-- end post-body-content -->';

        /*
        * Sidebar
        *
        */
        $html .= '<div id="postbox-container-1" class="postbox-container">';

        // General Info Metabox
        $html .= '<table class="widefat striped"><thead><th>General Info</th><th></th></thead><tbody>';
            $html .= '<tr><th>Contacts </th><td>'. $contacts_count . '</td></tr>';
            $html .= '<tr><th>Groups </th><td>'. $groups_count . '</td></tr>';
            $html .= '<tr><th>Users</th><td>'. $user_count . '</td></tr>';
            $html .= '<tr><th>Locations</th><td>'. $locations_count . '</td></tr>';
        $html .= '</tbody></table>';

        $html .= '<br>';

        // Progress Metabox
        $html .= '<table class="widefat striped">
                    <thead><th>Users</th><th></th></thead>
                    <tbody>';
            $html .= '<tr><th>Prayer Supporters</th><td></td></tr>';
            $html .= '<tr><th>Project Supporters</th><td></td></tr>';
            $html .= '<tr><th>Multipliers (Coalition)</th><td></td></tr>';
            $html .= '<tr><th>Marketers</th><td></td></tr>';
            $html .= '<tr><th>Dispatchers</th><td></td></tr>';
        $html .= '</tbody></table>';

        $html .= '<br>';

        // DMM Activity Metabox
        $html .= '<table class="widefat striped">
                    <thead><th>Contact Activity</th><th></th></thead>
                    <tbody>';
        $html .= '<tr><th>Contacts in Groups</th><td>'.$contacts_in_groups.'</td></tr>';
        $html .= '<tr><th>Planting</th><td></td></tr>';
        $html .= '<tr><th>Attending</th><td></td></tr>';
        $html .= '<tr><th>Coaching</th><td></td></tr>';
        $html .= '<tr><th>DBS</th><td></td></tr>';
        $html .= '<tr><th>Churches</th><td></td></tr>';
        $html .= '</tbody></table>';

        $html .= '<br>';

        // Notes Metabox
        $html .= '<table class="widefat striped"><thead><th>Notes</th></thead><tbody>';
            $html .= '<tr><td>Sample content for the table</td></tr>';
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

    /*
     * Tab: Tools
     *
     *
     *
     */
    public function dmmcrmsample_run_tools() {
        global $wpdb;
        $html ='';

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
            $html .= '<tr><th>Prayer Supporter</th><td>Yes</td><td>prayersupporter</td><td>dmmcrm</td></tr>';
            $html .= '<tr><th>Project Supporter</th><td>Yes</td><td>projectsupporter</td><td>dmmcrm</td></tr>';
            $html .= '<tr><th>Dispatcher</th><td>Yes</td><td>dispatcher</td><td>dmmcrm</td></tr>';
            $html .= '<tr><th>Marketer</th><td>Yes</td><td>marketer</td><td>dmmcrm</td></tr>';
            $html .= '<tr><th>Multiplier</th><td>Yes</td><td>multiplier</td><td>dmmcrm</td></tr>';
            $html .= '<tr><th>Multiplier Leader</th><td>Yes</td><td>multiplierleader</td><td>dmmcrm</td></tr>';

        $html .= '</tbody></table>';

        $html .= '</div><!-- end post-body-content -->';

        /*
        * Sidebar
        *
        */
        $html .= '<div id="postbox-container-1" class="postbox-container">';
        // Notes Metabox
        $html .= '<table class="widefat striped"><thead><th>Notes</th></thead><tbody>';
        $html .= '<tr><td>Sample content for the table</td></tr>';
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

    public function dmmcrmsample_add_contacts()
    {

        if (get_option('add_sample_contacts') !== '1') {

            echo '<div class="wrap">';
            echo '<h1>Add Sample Contacts</h1><p>';

            $contacts = array();

            $contacts = array(
                array("title" => "Taruh Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Buthaynah Wasim", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Bari Waql", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Aysha Rasha", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mohammed Poke", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Aziza Rasha", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Dalia Melek", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Fadil Eisa", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Fadilah Talitha", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Faris", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Fatin Tarique", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mahir Mohammed", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Majida", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Maysa Azzam", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mohammed Parah", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mohamad", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mohammed", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mohammed Mudawar", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mohammed Tunisia", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mukhtar", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Musad Dawud", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Qaseem Maysun", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Rahi Atiya", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Rashid Manal", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Tahir", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Tahu Fatima", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Tarik", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Taruh Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Usama Gadi", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Abd al Alim", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Taruh Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Alsha Lela", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Taruh Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Buthaynah Wasim", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Bari Waql", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Aysha Moukib Rasha", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mohammed Moukib Poke", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Aziza Moukib Rasha", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Dalia Melek", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Fadil Moukib Eisa", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Fadilah Talitha", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Faris Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Fatin Moukib Tarique", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mahir Mohammed", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Majida Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Maysa Moukib Azzam", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mohammed Parah", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mohamad", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mohammed Moukib", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mohammed Moukib Mudawar", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mohammed Moukib Tunisia", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mukhtar Tarik", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Musad Tarik Dawud", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Qaseem Maysun", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Rahi Atiya", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Rashid Manal", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Tahir Tarik", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Tahu Tarik Fatima", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Tarik", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Taruh Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Usama Gadi", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Abd al Alim", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Taruh Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Alsha Lela", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Fadilah Talitha", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Faris Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Fatin Moukib Tarique", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mahir Mohammed", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Majida Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Maysa Moukib Azzam", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mohammed Parah", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mohamad", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mohammed Moukib", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mohammed Moukib Mudawar", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mohammed Moukib Tunisia", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Mukhtar Tarik", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Musad Tarik Dawud", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Qaseem Maysun", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Rahi Atiya", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Rashid Manal", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Tahir Tarik", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Tahu Tarik Fatima", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Tarik", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Taruh Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Usama Gadi", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Abd al Alim", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Taruh Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
                array("title" => "Alsha Lela", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            );

            foreach ($contacts as $contact) {

                $post_title = $contact["title"];
                $post_type = 'contacts';
                $post_content = ' ';
                $post_status = "publish";
                $post_author = get_current_user_id();

                $post = array(
                    "post_title" => $post_title,
                    'post_type' => $post_type,
                    "post_content" => $post_content,
                    "post_status" => $post_status,
                    "post_author" => $post_author,
                    "meta_input" => array(
                        "phone" => $contact["phone"],
                        "seeker_path" => $contact["seeker_path"],
                        "seeker_milestones" => $contact["seeker_milestones"],
                        "overall_status" => $contact["overall_status"],
                        "email" => $contact["email"],
                        "preferred_contact_method" => $contact["preferred_contact_method"],
                    ),
                );

                wp_insert_post($post);

                echo "<br>Added: " . $post_title;
            }

            echo "<br><br>" . count($contacts) . " contacts added";
            echo '</p></div>';

            $option = 'add_sample_contacts';
            $value = '1';
            $deprecated = '';
            $autoload = TRUE;

            add_option($option, $value, $deprecated, $autoload);

        } else {

            echo '<div class="wrap">
                        <h1>Add Sample Contacts</h1>
                        <p>Contacts are already loaded.</p>
                    </div>
                  ';
        }
    }
}