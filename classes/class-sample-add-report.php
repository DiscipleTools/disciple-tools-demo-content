<?php

/**
 * Disciple Tools Sample Add Report
 *
 * @class dt_sample_add_report
 * @version	0.1
 * @since 0.1
 * @package	Disciple_Tools
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class dt_sample_add_report {

    /**
     * dt_sample_add_report The single instance of dt_sample_add_report.
     * @var 	object
     * @access  private
     * @since 	0.1
     */
    private static $_instance = null;

    /**
     * Main dt_sample_add_report Instance
     *
     * Ensures only one instance of dt_sample_add_report is loaded or can be loaded.
     *
     * @since 0.1
     * @static
     * @return dt_sample_add_report instance
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

        if (is_admin()) {
            add_action('admin_post_custom_form_submit', array($this, 'save_report') );
        }

    } // End __construct()

    /**
     * Creates the form content for the add report tab
     * @return mixed/void
     */
    public function add_report_page_form () {

        $html = '<div class="wrap">
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">';

        // removed for testing
         $html1 = '<form id="reportSubmit" action="" method="post">
                        <input type="hidden" name="dt_report_form_noonce" id="dt_report_form_noonce" value="' . wp_create_nonce( 'dt_report_form' ) . '" />
                            <table class="widefat striped">
                                <thead><th>Report Post Type Form</th><th></th></thead>
                                <tbody>
                                    <tr><td>Title</td><td><input type="text" class="regular-text" name="post_title" /> </td></tr>
                                    <tr><td>Date</td><td><input type="text" class="regular-text" name="meta_report_date" /> </td></tr>
                                    
                                    <tr><td></td><td><input type="submit" class="button right" name="submit" value="submit" /> </td></tr>
                                </tbody>
                            </table>
                         </form><br>';

        $html .= '<form id="testActivity" action="" method="post">
                        <input type="hidden" name="dt_activity_form_noonce" id="dt_activity_form_noonce" value="' . wp_create_nonce( 'dt_activity_form' ) . '" />
                            <table class="widefat striped">
                                <thead><th>Add Bulk Report Records</th><th></th></thead>
                                <tbody>
                                    <input type="hidden" name="activity_form" value="1" />
                                    <tr><td>Source</td><td>
                                        <select class="regular-text" name="report_source" >
                                          <option name="report_source" value="Facebook">Facebook</option>
                                          <option name="report_source" value="Twitter">Twitter</option>
                                          <option name="report_source" value="Analytics">Analytics</option>
                                          <option name="report_source" value="Adwords">Adwords</option>
                                          <option name="report_source" value="Mailchimp">Mailchimp</option>
                                          <option name="report_source" value="YouTube">YouTube</option>
                                          <option name="report_source" value="Vimeo">Vimeo</option>
                                          <option name="report_source" value="Bitly">Bitly</option>
                                          <option name="report_source" value="Bibles">Bibles</option>
                                          <option name="report_source" value="Contacts">Contacts</option>
                                          <option name="report_source" value="Groups">Groups</option>
                                        </select>
                                    </td></tr>
                                    <tr><td>Subsource</td><td><input type="text" class="regular-text" name="report_subsource" /> </td></tr>
                                    <tr><td>Number Days to Add, e.g. "20", "100"</td><td><input type="text" class="regular-text" name="count" /> </td></tr>
                                    <tr><td></td><td><input type="submit" class="button right" name="submit" value="submit" /> </td></tr>
                                </tbody>
                            </table>
                         </form><br>';
        $html .= '<form id="testSearch" action="" method="post">
                        <input type="hidden" name="dt_activity_form_noonce" id="dt_activity_form_noonce" value="' . wp_create_nonce( 'dt_activity_form' ) . '" />
                            <table class="widefat striped">
                                <thead><th>Search Records</th><th></th></thead>
                                <tbody>
                                    <input type="hidden" name="search_form" value="1" />
                                    <tr><td>Date ("2017-03-22" format)</td><td><input type="text" class="regular-text" name="report_date" /> </td></tr>
                                    <tr><td>Source</td><td>
                                        <select class="regular-text" name="report_source" >
                                        <option name="report_source" value=""></option>
                                          <option name="report_source" value="Facebook">Facebook</option>
                                          <option name="report_source" value="Twitter">Twitter</option>
                                          <option name="report_source" value="Analytics">Analytics</option>
                                          <option name="report_source" value="Adwords">Adwords</option>
                                          <option name="report_source" value="Mailchimp">Mailchimp</option>
                                          <option name="report_source" value="YouTube">YouTube</option>
                                          <option name="report_source" value="Vimeo">Vimeo</option>
                                          <option name="report_source" value="Bitly">Bitly</option>
                                          <option name="report_source" value="Bibles">Bibles</option>
                                          <option name="report_source" value="Contacts">Contacts</option>
                                          <option name="report_source" value="Groups">Groups</option>
                                        </select>
                                    </td></tr>
                                    <tr><td>Subsource</td><td><input type="text" class="regular-text" name="report_subsource" /> </td></tr>
                                    <tr><td></td><td><input type="submit" class="button right" name="submit" value="submit" /> </td></tr>
                                </tbody>
                            </table>
                         </form><br>';

        $html .= '<form id="testWhere" action="" method="post">
                        <input type="hidden" name="dt_where_form_noonce" id="dt_where_form_noonce" value="' . wp_create_nonce( 'dt_where_form' ) . '" />
                            <table class="widefat striped">
                                <thead><th>Search</th><th></th></thead>
                                <tbody>
                                    <input type="hidden" name="where_form" value="1" />
                                    <tr><td>Source</td><td><input type="text" class="regular-text" name="report_source" /> </td></tr>
                                    <tr><td></td><td><input type="submit" class="button right" name="submit" value="submit" /> </td></tr>
                                </tbody>
                            </table>
                         </form><br>';

        $report_box_top = '<br><table class="widefat striped">
                    <thead><th>Report Activity</th></thead>
                    <tbody>
                        <tr><td>';
        $report_box_bottom = '</td></tr>
                    </tbody>
                  </table>';

        if (isset($_POST['activity_form'])) { $html .= $report_box_top . $this->activity_form($_POST) . $report_box_bottom; }
        if (isset($_POST['where_form'])) { $html .= $report_box_top . $this->where_form($_POST) . $report_box_bottom; }
        if (isset($_POST['search_form'])) { $html .= $report_box_top . $this->where_by_date($_POST) . $report_box_bottom; }

        $html .= '</div><!-- end post-body-content -->';

        $html .=   '<div id="postbox-container-1" class="postbox-container">
                        <table class="widefat striped">
                            <thead>
                            <th>Notes</th>
                            </thead>
                            <tbody>
                            <tr><td></td></tr>
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

    /**
     * Save the Report for Report Post Type
     * @access public
     */
    public function save_report ($post) {

        // Check noonce
        if ( isset($post['dt_report_form_noonce']) && ! wp_verify_nonce( $post['dt_report_form_noonce'], 'dt_report_form') ) {
            return 'Are you cheating? Where did this form come from?';
        }

        // Parse the $_POST info
        print_r($post);


        // Build the Insert
        $postarr = array(
            'post_author' => 1,
            'post_content' => serialize($_POST),
            'post_content_filtered' => '',
            'post_title' => 'Facebook-' . date('Y-m-d'),
            'post_excerpt' => '',
            'post_status' => 'publish',
            'post_type' => 'reports',
            'post_date' => date('Y-m-d'),
            'comment_status' => 'closed',
            'ping_status' => 'closed',
            'post_password' => '',
            'to_ping' =>  '',
            'pinged' => '',
            'post_parent' => 0,
            'menu_order' => 0,
            'guid' => '',
            'import_id' => 0,
            'context' => '',
//            'tax_input' => array( array( 'sources' => 'facebook' ) ),
            'meta_input' => array(
                'report_date' => '2017-02-22',
                'report_source' => 'Facebook',
                'pages_like_count' => '10',
                'pages_engagement' => '10',
                'pages_conversations_count' => '10'
            ),
        );

        // Insert to Reports PT

        $result = wp_insert_post($postarr, true);

        return $result;


    }

    /**
     * Adds bulk report data
     * */
    public function activity_form ($post)
    {
        // Create Unique Meta Inputs Depending on Source
        switch ($post['report_source']) {
            case 'Facebook':
                $meta_input = array(
                    'page_likes_count' => rand ( 0 , 100 ),
                    'page_engagement' => rand ( 0 , 100 ),
                    'page_conversations_count' => rand ( 0 , 100 ),
                    'page_messages_in_conversation_count' => rand ( 0 , 100 ),
                    'page_post_count' => rand ( 2 , 6 ),
                    'page_post_likes_and_reactions' => rand ( 0 , 100 ),
                    'page_comments_count' => rand ( 0 , 100 ),
                );
                break;
            case 'Twitter':
                $meta_input = array(
                    'unique_website_visitors' => rand ( 0 , 100 ),
                    'platforms' => rand ( 0 , 100 ),
                    'browsers' => rand ( 0 , 100 ),
                    'average_time' => rand ( 0 , 100 ),
                    'page_visits' => rand ( 0 , 100 ),
                );
                break;
            case 'Analytics':
                $meta_input = array(
                    'unique_website_visitors' => rand ( 0 , 100 ),
                    'platforms' => rand ( 0 , 100 ),
                    'browsers' => rand ( 0 , 100 ),
                    'average_time' => rand ( 0 , 100 ),
                    'page_visits' => rand ( 0 , 100 ),
                );
                break;
            case 'Adwords':
                $meta_input = array(
                    'money_spent' => rand ( 0 , 100 ),
                    'conversions' => rand ( 0 , 100 ),
                    'total_clicks' => rand ( 0 , 100 ),
                    'ads_served' => rand ( 0 , 100 ),
                    'average_position' => rand ( 0 , 100 ),
                );
                break;
            case 'Mailchimp':
                $meta_input = array(
                    'campaigns_sent' => rand ( 0 , 3 ),
                    'list_opens' => rand ( 0 , 5000 ),
                    'campaign_opens' => rand ( 0 , 100 ),
                    'subscriber_count' => rand ( 5000 , 6000 ),
                    'opt_ins' => rand ( 0 , 50 ),
                    'opt_outs' => rand ( 0 , 10 ),
                );
                break;
            case 'YouTube':
                $meta_input = array(
                    'total_views' => rand ( 100 , 500 ),
                    'total_likes' => rand ( 0 , 100 ),
                    'total_shares' => rand ( 0 , 50 ),
                    'number_of_videos_posted' => rand ( 0 , 3 ),
                );
                break;
            case 'Vimeo':
                $meta_input = array(
                    'total_views' => rand ( 100 , 500 ),
                    'total_likes' => rand ( 0 , 100 ),
                    'total_shares' => rand ( 0 , 50 ),
                    'number_of_videos_posted' => rand ( 0 , 3 ),
                );
                break;
            case 'Bitly':
                $meta_input = array(
                    'clicks' => rand ( 0 , 100 ),
                    'clicks_per_tag' => rand ( 0 , 100 ),
                );
                break;
            case 'Bibles':
                $meta_input = array(
                    'given_by_hand' => rand ( 0 , 100 ),
                    'given_online' => rand ( 0 , 100 ),
                    'downloaded_from_website' => rand ( 0 , 100 ),
                );
                break;
            case 'Contacts':
                $meta_input = array(
                    'contacts_added' => rand ( 0 , 100 ),
                    'assignable_contacts' => rand ( 0 , 100 ),
                    'contact_attempted' => rand ( 0 , 100 ),
                    'contact_established' => rand ( 0 , 100 ),
                    'first_meeting_complete' => rand ( 0 , 100 ),
                    'baptisms_count' => rand ( 0 , 100 ),
                    '1_gen_baptisms' => rand ( 0 , 100 ),
                    '2_gen_baptisms' => rand ( 0 , 100 ),
                    '3_gen_baptisms' => rand ( 0 , 100 ),
                    '4_gen_baptisms' => rand ( 0 , 100 ),
                    'baptizers' => rand ( 0 , 100 ),
                );
                break;
            case 'Groups':
                $meta_input = array(
                    'total_groups' => rand ( 0 , 100 ),
                    '2x2' => rand ( 0 , 100 ),
                    '3x3' => rand ( 0 , 100 ),
                    'total_active_churches' => rand ( 0 , 100 ),
                    '1_gen_churches' => rand ( 0 , 100 ),
                    '2_gen_churches' => rand ( 0 , 100 ),
                    '3_gen_churches' => rand ( 0 , 100 ),
                    '4_gen_churches' => rand ( 0 , 100 ),
                    'church_planters' => rand ( 0 , 100 ),
                );
                break;
            default:
                $meta_input = array();
                break;

        }

        // Insert records loop
        $i = 0;
        $count = $post['count'];

        while ($i <= $count ) {
            $today = date('Y-m-d h:m:s');
            $days_ago = '-' . $i . ' day';
            $log_date = date('Y-m-d h:m:s', strtotime($days_ago, strtotime($today)));

            dt_report_insert(
                array(
                    'report_date' => $log_date,
                    'report_source' => $post['report_source'],
                    'report_subsource' => $post['report_subsource'],
                    'meta_input' => $meta_input,
                )
            );
            $i++;
        }
        return $i . ' added';

    }

    public function where_form ($post) {

        if(!empty($post)) {
            $report_source = $post['report_source'];

            $results = Disciple_Tools()->report_api->get_reports_by_source($report_source);

            $html = '<pre>';
            $html .= print_r( $results, true );
            $html .= '</pre>';
            return $html;

        }

    }

    public function where_by_date ($post) {

        if(!empty($post)) {

            if(isset($post['report_date'])) {$date = $post['report_date']; } else { $date = date('Y-m-d'); };
            if(isset($post['report_source'])) {$source = $post['report_source']; } else { $source = ''; };
            if(isset($post['report_subsource'])) {$subsource = $post['report_subsource']; } else { $subsource = ''; };

            $results = Disciple_Tools()->report_api->get_reports_by_date($date, $source, $subsource);

            $html = '<pre>';
            $html .= print_r( $results, true );
            $html .= '</pre>';
            return $html;

        }
    }

}