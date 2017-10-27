<?php

/**
 * Disciple Tools Sample Add Report
 *
 * @class      DT_Demo_Add_Report
 * @version    0.1
 * @since      0.1
 * @package    Disciple_Tools
 * @author     Chasm.Solutions & Kingdom.Training
 */

if( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Class DT_Demo_Add_Report
 */
class DT_Demo_Add_Report
{

    /**
     * DT_Demo_Add_Report The single instance of DT_Demo_Add_Report.
     *
     * @var     object
     * @access    private
     * @since     0.1
     */
    private static $_instance = null;

    /**
     * Main DT_Demo_Add_Report Instance
     * Ensures only one instance of DT_Demo_Add_Report is loaded or can be loaded.
     *
     * @since 0.1
     * @static
     * @return DT_Demo_Add_Report instance
     */
    public static function instance()
    {
        if( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    } // End instance()

    /**
     * Constructor function.
     *
     * @access  public
     * @since   0.1
     */
    public function __construct()
    {

        if( is_admin() ) {
            add_action( 'admin_post_custom_form_submit', [ $this, 'save_report' ] );
        }
    } // End __construct()

    /**
     * Creates the form content for the add report tab
     *
     * @return mixed/void
     */
    public function add_report_page_form()
    {

        $html = '<div class="wrap">
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">';

        $html .= '<form action="" method="post">
                        <input type="hidden" name="dt_activity_form_noonce" id="dt_activity_form_noonce" value="' . wp_create_nonce( 'dt_activity_form' ) . '" />
                            <table class="widefat striped">
                                <thead><th>Add Prayer Reports</th><th></th></thead>
                                <tbody>
                                    <input type="hidden" name="prayer_report" value="1" />
                                    <tr><td>Source (required)</td><td>' . $this->get_prayer_source_list() . '</td></tr>
                                    <tr><td>Subsource (required)</td><td><input type="text" class="regular-text" name="report_subsource" /> </td></tr>
                                    <tr><td>Number Days to Add, e.g. "20", "100" (required)</td><td><input type="text" class="regular-text" name="count" /> </td></tr>
                                    <tr><td></td><td><input type="submit" class="button right" name="submit" value="submit" /> </td></tr>
                                </tbody>
                            </table>
                         </form><br>';

        $html .= '<form  action="" method="post">
                        <input type="hidden" name="dt_activity_form_noonce" id="dt_activity_form_noonce" value="' . wp_create_nonce( 'dt_activity_form' ) . '" />
                            <table class="widefat striped">
                                <thead><th>Add Outreach Reports</th><th></th></thead>
                                <tbody>
                                    <input type="hidden" name="outreach_report" value="1" />
                                    <tr><td>Source (required)</td><td>' . $this->get_outreach_source_list() . '</td></tr>
                                    <tr><td>Subsource (required)</td><td><input type="text" class="regular-text" name="report_subsource" /> </td></tr>
                                    <tr><td>Number Days to Add, e.g. "20", "100" (required)</td><td><input type="text" class="regular-text" name="count" /> </td></tr>
                                    <tr><td></td><td><input type="submit" class="button right" name="submit" value="submit" /> </td></tr>
                                </tbody>
                            </table>
                         </form><br>';

        $html .= '<form action="" method="post">
                        <input type="hidden" name="dt_activity_form_noonce" id="dt_activity_form_noonce" value="' . wp_create_nonce( 'dt_activity_form' ) . '" />
                            <table class="widefat striped">
                                <thead><th>Add Followup Reports</th><th></th></thead>
                                <tbody>
                                    <input type="hidden" name="fup_report" value="1" />
                                    <input type="hidden" name="report_source" value="fup_report" />
                                    <input type="hidden" name="report_subsource" value="fup_report" />
                                    <tr><td>Number Days to Add, e.g. "20", "100" (required)</td><td><input type="text" class="regular-text" name="count" /> </td></tr>
                                    <tr><td></td><td><input type="submit" class="button right" name="submit" value="submit" /> </td></tr>
                                </tbody>
                            </table>
                         </form><br>';

        $html .= '<form action="" method="post">
                        <input type="hidden" name="dt_activity_form_noonce" id="dt_activity_form_noonce" value="' . wp_create_nonce( 'dt_activity_form' ) . '" />
                            <table class="widefat striped">
                                <thead><th>Add Multiplication Reports</th><th></th></thead>
                                <tbody>
                                    <input type="hidden" name="multiplication_report" value="1" />
                                    <input type="hidden" name="report_source" value="multiplication_report" />
                                    <input type="hidden" name="report_subsource" value="multiplication_report" />
                                    <tr><td>Number Days to Add, e.g. "20", "100" (required)</td><td><input type="text" class="regular-text" name="count" /> </td></tr>
                                    <tr><td></td><td><input type="submit" class="button right" name="submit" value="submit" /> </td></tr>
                                </tbody>
                            </table>
                         </form><br>';

        $report_box_top = '<br><table class="widefat striped">
                    <thead><th>Report Output</th></thead>
                    <tbody>
                        <tr><td>';
        $report_box_bottom = '</td></tr>
                    </tbody>
                  </table>';

        if( isset( $_POST[ 'prayer_report' ] ) ) {
            $html .= $report_box_top . $this->activity_form( $_POST ) . $report_box_bottom;
        }
        if( isset( $_POST[ 'outreach_report' ] ) ) {
            $html .= $report_box_top . $this->activity_form( $_POST ) . $report_box_bottom;
        }
        if( isset( $_POST[ 'fup_report' ] ) ) {
            $html .= $report_box_top . $this->activity_form( $_POST ) . $report_box_bottom;
        }
        if( isset( $_POST[ 'multiplication_report' ] ) ) {
            $html .= $report_box_top . $this->activity_form( $_POST ) . $report_box_bottom;
        }
        if( isset( $_POST[ 'delete_reports' ] ) ) {
            $html .= $report_box_top . $this->delete_reports() . $report_box_bottom;
        }

        $html .= '</div><!-- end post-body-content -->';

        $html .= '<div id="postbox-container-1" class="postbox-container">
                        <table class="widefat ">
                            <thead>
                            <th>Notes</th>
                            </thead>
                            <tbody>
                            <tr><td>
                                <p>Delete Sample Reports</p>
                            
                                <a href="javascript:void(0);" class="button" onclick="jQuery(\'#delete_reports_confirm\').show();">Delete Sample Reports</a>
                                
                                <div id="delete_reports_confirm" class="warning" style="display:none;"><br><p>Are you sure?</p>
                                    <form method="POST">
                                        <input type="hidden" name="dt_activity_form_noonce" id="dt_activity_form_noonce" value="' . wp_create_nonce( 'dt_activity_form' ) . '" />
                                        <button type="submit" value="delete_reports" name="delete_reports" class="button" style="background:red; color:white;" id="delete_reports">Confirm Delete</button>
                                    </form>
                                </div>
                                
                                <br><hr></td></tr>
                            <tr><td>ADD BULK REPORT RECORDS<br>The add bulk report records can add any number of random report elements, defined by source, subsource, and how many days of reports you want added. There is no upper limit, but more than 1000 might stall the script. <hr></td></tr>
                            <tr><td>SEARCH RECORDS BY DATE<br>The search records by date form requires a date in the format 2017-03-22, and has optional filters for source and subsource.<hr></td></tr>
                            <tr><td>SEARCH DATE RANGE<br>The search date range requires a source name and the date specified 2017-03 to get all records for March 2017.<hr></td></tr>
                            <tr><td>YEAR/MONTH SUMMARY<br>The year/month summary requires a source, date and a meta value to summarize. Returns a number<hr></td></tr>
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
     * Supplies the select statement for the forms.
     */
    public function get_prayer_source_list( $blank = false )
    {
        $html = '<select class="regular-text" name="report_source" >';

        if( $blank ) {
            $html .= '<option name="report_source" value=""></option>';
        }

        $html .= '
                  <option >Select Prayer Source</option>
                  <option disabled>---</option>
                  
                  <option name="report_source" value="Mailchimp-Prayer">Mailchimp </option>
                  <option name="report_source" value="Facebook-Prayer">Facebook </option>
                  <option name="report_source" value="Twitter-Prayer">Twitter </option>
                  <option name="report_source" value="SMS-Prayer">SMS </option>
                  
                </select>';

        return $html;
    }

    /**
     * Supplies the select statement for the forms.
     */
    public function get_outreach_source_list( $blank = false )
    {
        $html = '<select class="regular-text" name="report_source" >';

        if( $blank ) {
            $html .= '<option name="report_source" value=""></option>';
        }

        $html .= '
                  <option >Select Outreach Source</option>
                  <option disabled>---</option>
                  
                  <option name="report_source" value="Facebook-Outreach">Facebook </option>
                  <option name="report_source" value="Twitter-Outreach">Twitter </option>
                  <option name="report_source" value="SMS-Outreach">SMS/Texting </option>
                  <option name="report_source" value="Analytics-Outreach">Website Analytics </option>
                  <option name="report_source" value="YouTube-Outreach">YouTube</option>
                  
                </select>';

        return $html;
    }

    /**
     * Adds randomized bulk report data
     */
    public function activity_form( $post )
    {
        $category = '';
        $focus = '';
        // Create Unique Meta Inputs Depending on Source
        switch( $post[ 'report_source' ] ) {
            case 'Mailchimp-Prayer':
                $category = 'media';
                $focus = 'prayer';
                $meta_input = [
                    'critical_path_total' => rand( 10000, 20000 ),
                    'new_subscribers'     => rand( 0, 100 ),
                    'campaigns_sent'      => rand( 0, 3 ),
                    'list_opens'          => rand( 0, 5000 ),
                    'campaign_opens'      => rand( 0, 100 ),
                    'subscriber_count'    => rand( 5000, 6000 ),
                    'opt_ins'             => rand( 0, 50 ),
                    'opt_outs'            => rand( 0, 10 ),
                    'source'              => '_sample',
                ];
                break;

            case 'Facebook-Prayer':
                $category = 'media';
                $focus = 'prayer';
                $meta_input = [
                    'critical_path_total'                 => rand( 10000, 20000 ),
                    'page_likes_count'                    => rand( 0, 100 ),
                    'page_engagement'                     => rand( 0, 100 ),
                    'page_conversations_count'            => rand( 0, 100 ),
                    'page_messages_in_conversation_count' => rand( 0, 100 ),
                    'page_post_count'                     => rand( 2, 6 ),
                    'page_post_likes_and_reactions'       => rand( 0, 100 ),
                    'page_comments_count'                 => rand( 0, 100 ),
                    'source'                              => '_sample',
                ];
                break;

            case 'Twitter-Prayer':
                $category = 'media';
                $focus = 'prayer';
                $meta_input = [
                    'critical_path_total' => rand( 10000, 20000 ),
                    'source'              => '_sample',
                ];
                break;

            case 'SMS-Prayer':
                $category = 'media';
                $focus = 'prayer';
                $meta_input = [
                    'critical_path_total' => rand( 500, 600 ),
                    'source'              => '_sample',
                ];
                break;

            case 'Facebook-Outreach':
                $category = 'social';
                $focus = 'outreach';
                $meta_input = [
                    'critical_path_total'                 => rand( 500, 600 ), // we could count likes. we could count unique users who have shared, commented, and liked something. This would be similar to the unique website visitors.
                    'source'                              => '_sample',
                    'page_likes_count'                    => rand( 0, 100 ),
                    'page_engagement'                     => rand( 0, 100 ),
                    'page_conversations_count'            => rand( 0, 100 ),
                    'page_messages_in_conversation_count' => rand( 0, 100 ),
                    'page_post_count'                     => rand( 2, 6 ),
                    'page_post_likes_and_reactions'       => rand( 0, 100 ),
                    'page_comments_count'                 => rand( 0, 100 ),
                ];
                break;

            case 'Twitter-Outreach':
                $category = 'social';
                $focus = 'outreach';
                $meta_input = [
                    'critical_path_total' => rand( 500, 600 ), // I have no idea what to count here.
                    'source'              => '_sample',
                ];
                break;

            case 'SMS-Outreach':
                $category = 'sms';
                $focus = 'outreach';
                $meta_input = [
                    'critical_path_total' => rand( 500, 600 ), // this would have to unique phone numbers
                    'source'              => '_sample',
                    'new_subscribers'     => rand( 0, 100 ),
                    'campaigns_sent'      => rand( 0, 3 ),
                    'list_opens'          => rand( 0, 5000 ),
                    'campaign_opens'      => rand( 0, 100 ),
                    'subscriber_count'    => rand( 5000, 6000 ),
                    'opt_ins'             => rand( 0, 50 ),
                    'opt_outs'            => rand( 0, 10 ),
                ];
                break;

            case 'Analytics-Outreach':
                $category = 'website';
                $focus = 'outreach';
                $meta_input = [
                    'critical_path_total'     => rand( 500, 600 ), // only count people. so this would have to be unique website visitors.
                    'source'                  => '_sample',
                    'unique_website_visitors' => rand( 0, 100 ),
                    'average_time'            => rand( 0, 100 ),
                    'page_visits'             => rand( 0, 100 ),
                ];
                break;

            case 'YouTube-Outreach':
                $category = 'social';
                $focus = 'outreach';
                $meta_input = [
                    'critical_path_total'     => rand( 5000, 6000 ),
                    'source'                  => '_sample',
                    'total_views'             => rand( 100, 500 ),
                    'total_likes'             => rand( 0, 100 ),
                    'total_shares'            => rand( 0, 50 ),
                    'number_of_videos_posted' => rand( 0, 3 ),
                ];
                break;

            case 'fup_report':
                $focus = 'fup';
                $meta_input = [
                    'source'                 => '_sample',
                    'contacts_added'         => rand( 1800, 2000 ),
                    'assignable_contacts'    => rand( 1700, 1800 ),
                    'contact_attempted'      => rand( 1650, 1700 ),
                    'contact_established'    => rand( 1600, 1650 ),
                    'first_meeting_complete' => rand( 1550, 1600 ),
                    'baptisms_count'         => rand( 60, 100 ),
                    '1_gen_baptisms'         => rand( 50, 60 ),
                    '2_gen_baptisms'         => rand( 100, 200 ),
                    '3_gen_baptisms'         => rand( 300, 400 ),
                    '4_gen_baptisms'         => rand( 500, 1000 ),
                    'baptizers'              => rand( 500, 600 ),
                ];
                break;

            case 'multiplication_report':
                $focus = 'multiplication';
                $meta_input = [
                    'source'                => '_sample',
                    'total_groups'          => rand( 0, 100 ),
                    '2x2'                   => rand( 0, 100 ),
                    '3x3'                   => rand( 0, 100 ),
                    'total_active_churches' => rand( 0, 100 ),
                    '1_gen_churches'        => rand( 0, 100 ),
                    '2_gen_churches'        => rand( 0, 100 ),
                    '3_gen_churches'        => rand( 0, 100 ),
                    '4_gen_churches'        => rand( 0, 100 ),
                    'church_planters'       => rand( 0, 100 ),

                ];
                break;
            default:
                $meta_input = [];
                break;
        }

        // Insert records loop
        $i = 0;
        $count = $post[ 'count' ];

        while( $i <= $count ) {
            $today = date( 'Y-m-d h:m:s' );
            $days_ago = '-' . $i . ' day';
            $log_date = date( 'Y-m-d h:m:s', strtotime( $days_ago, strtotime( $today ) ) );

            dt_report_insert(
                [
                    'report_date'      => $log_date,
                    'report_source'    => $post[ 'report_source' ],
                    'report_subsource' => $post[ 'report_subsource' ],
                    'focus' => $focus,
                    'category' => $category,
                    'meta_input'       => $meta_input,
                ]
            );
            $i++;
        }

        return $i . ' added';
    }

    /**
     * Delete all sample reports in database
     *
     * @return string
     */
    public function delete_reports()
    {
        global $wpdb;

        $results = $wpdb->get_results( "SELECT report_id FROM $wpdb->dt_reportmeta WHERE meta_key = 'source' AND meta_value = '_sample'" );

        $ids = '';
        foreach( $results as $result ) {
            $ids .= $result->report_id . ',';
        }
        $ids = substr( $ids, 0, -1 );

        $wpdb->get_results( "DELETE FROM $wpdb->dt_reports WHERE id IN ($ids)" );
        $record_count = $wpdb->rows_affected;

        $wpdb->get_results( "DELETE FROM $wpdb->dt_reportmeta WHERE report_id IN ($ids)" );

        return 'Deleted '.$record_count.' reports';
    }

}