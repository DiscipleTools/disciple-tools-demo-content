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
                    <div id="post-body-content">
                        <form action="" method="post">
                        <input type="hidden" name="dt_report_form_noonce" id="dt_report_form_noonce" value="' . wp_create_nonce( 'dt_report_form' ) . '" />
                        <input name="action" type="hidden" value="dt_report_form_submit">
                            <table class="widefat striped">
                                <thead><th>Report Form</th><th></th></thead>
                                <tbody>
                                    <tr><td>Title</td><td><input type="text" class="regular-text" name="report_post_title" /> </td></tr>
                                    <tr><td></td><td><input type="submit" class="button" name="submit" value="submit" /> </td></tr>
                                </tbody>
                            </table>
                         </form>';


        $report_box_top = '<br><table class="widefat striped">
                    <thead><th>Report Activity</th></thead>
                    <tbody>
                        <tr><td>';
        $report_box_bottom = '</td></tr>
                    </tbody>
                  </table>';

        if (isset($_POST['report_post_title'])) { $html .= $report_box_top . $this->save_report($_POST) . $report_box_bottom; }

        $html .= '</div><!-- end post-body-content -->';

        $html .=   '<div id="postbox-container-1" class="postbox-container">
                        <table class="widefat striped">
                            <thead>
                            <th>Notes</th>
                            </thead>
                            <tbody>
                            <tr><td><a href="/wp-admin/edit.php?post_type=reports">Reports List</a> </td></tr>
                            <tr><td>'.$this->get_terms_for_reports().'</td></tr>
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

    protected function get_terms_for_reports () {
        $terms = get_terms( array(
                    'taxonomy' => 'report-source',
                    'hide_empty' => false,
            ) );
        $count = count( $terms );
        $html = '';
        if ( $count > 0 ) {
            $html .= '<p>Total Sources: '. $count . '</p>';
            $html .= '<ul>';
            foreach ( $terms as $term ) {
                $html .= '<li>' . $term->name . '</li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }

    /**
     * Save the Report
     * @access public
     */
    public function save_report ($post) {

        return $post['report_post_title'];

    }

}