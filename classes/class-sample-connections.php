<?php

/**
 * dt_sample_connections
 *
 * @class dt_sample_connections
 * @version	0.1
 * @since 0.1
 * @package	Disciple_Tools
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class dt_sample_connections {

    /**
     * dt_sample_connections The single instance of dt_sample_connections.
     * @var 	object
     * @access  private
     * @since 	0.1
     */
    private static $_instance = null;

    /**
     * Main dt_sample_connections Instance
     *
     * Ensures only one instance of dt_sample_connections is loaded or can be loaded.
     *
     * @since 0.1
     * @static
     * @return dt_sample_connections instance
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

    public function add_baptism_connections ($loops) {

        /* @see https://github.com/scribu/wp-posts-to-posts/wiki/Creating-connections-programmatically */
        /* @see p2p_add_meta() https://github.com/scribu/wp-posts-to-posts/wiki/Connection-metadata#updating-connection-information */

        if ($loops > 25) { $loops = 25;}

        // Get list of contacts
        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'contacts'
        );
        $contacts = get_posts( $args );

        $contact_total = count($contacts);

        $i = 0;

        $year = date('Y');

        while ($loops > $i) {

            // Break in 4 generations
            $zero = $contacts[rand(1, $contact_total - 1)];
            $first = $contacts[rand(1, $contact_total - 1)];
            $second = $contacts[rand(1, $contact_total - 1)];
            $third = $contacts[rand(1, $contact_total - 1)];
            $fourth = $contacts[rand(1, $contact_total - 1)];

            $to = $zero;
            $from = $first;
            p2p_type( 'baptizer_to_baptized' )->connect( $from, $to, array(
                'date' => current_time('mysql'),
                'month'     => '1',
                'day'   =>  $i,
                'year'  =>  $year,
            ) );

            $to = $first;
            $from = $second;
            p2p_type( 'baptizer_to_baptized' )->connect( $from, $to, array(
                'date' => current_time('mysql'),
                'month'     => '2',
                'day'   =>  $i,
                'year'  =>  $year,
            ) );

            $to = $second;
            $from = $third;
            p2p_type( 'baptizer_to_baptized' )->connect( $from, $to, array(
                'date' => current_time('mysql'),
                'month'     => '3',
                'day'   =>  $i,
                'year'  =>  $year,
            ) );

            $to = $third;
            $from = $fourth;
            p2p_type( 'baptizer_to_baptized' )->connect( $from, $to, array(
                'date' => current_time('mysql'),
                'month'     => '4',
                'day'   =>  $i,
                'year'  =>  $year,
            ) );

            $i++;
        }
        return $i . ' sets of 4th generation baptisms added. The month is the generation number and the day is the series.';

    }

    public function add_church_connections ($loops) {

        /* @see https://github.com/scribu/wp-posts-to-posts/wiki/Creating-connections-programmatically */
        /* @see p2p_add_meta() https://github.com/scribu/wp-posts-to-posts/wiki/Connection-metadata#updating-connection-information */

        if ($loops > 10) { $loops = 10;}

        // Get list of records
        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'groups'
        );
        $records = get_posts( $args );

        $records_total = count($records);

        $i = 0;

        $year = date('Y');

        while ($loops > $i) {

            // Break in 4 generations
            $zero = $records[rand(1, $records_total - 1)];
            $first = $records[rand(1, $records_total - 1)];
            $second = $records[rand(1, $records_total - 1)];
            $third = $records[rand(1, $records_total - 1)];
            $fourth = $records[rand(1, $records_total - 1)];

            $to = $zero;
            $from = $first;
            p2p_type( 'groups_to_groups' )->connect( $from, $to, array(
                'date' => current_time('mysql'),
            ) );

            $to = $first;
            $from = $second;
            p2p_type( 'groups_to_groups' )->connect( $from, $to, array(
                'date' => current_time('mysql'),
            ) );

            $to = $second;
            $from = $third;
            p2p_type( 'groups_to_groups' )->connect( $from, $to, array(
                'date' => current_time('mysql'),
            ) );

            $to = $third;
            $from = $fourth;
            p2p_type( 'groups_to_groups' )->connect( $from, $to, array(
                'date' => current_time('mysql'),
            ) );

            $i++;
        }
        return $i . ' sets of 4th generation churches added.';

    }

}