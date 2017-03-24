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
                            <table class="widefat striped">
                                <thead><th>Report Form</th><th></th></thead>
                                <tbody>
                                    <tr><td>Title</td><td><input type="text" class="regular-text" name="post_title" /> </td></tr>
                                    <tr><td></td><td><input type="submit" class="button" name="submit" value="submit" /> </td></tr>
                                </tbody>
                            </table>
                         </form>
                    </div><!-- end post-body-content -->

                    <div id="postbox-container-1" class="postbox-container">
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




}