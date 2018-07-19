<?php

/**
 * DT_Demo_Connections
 *
 * @class DT_Demo_Connections
 * @version    0.1
 * @since 0.1
 * @package    Disciple_Tools
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly
}

class DT_Demo_Connections {

    private static $_instance = null;
    public static function instance () {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()


    public function add_baptism_connections ( $loops ) {

        /* @see https://github.com/scribu/wp-posts-to-posts/wiki/Creating-connections-programmatically */
        /* @see p2p_add_meta() https://github.com/scribu/wp-posts-to-posts/wiki/Connection-metadata#updating-connection-information */

        $year = date( 'Y' );
        // Get list of contacts
        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'contacts'
        );
        $records = get_posts( $args );
        dt_write_log( $records );

        $total = count( $records );

        if ($loops > 10) { $loops = 10;} // checks if requrested more than max number
        if ($loops * 5 > $total) { $total_loops_possible = $total / 5;
            $loops = round( $total_loops_possible, 0, PHP_ROUND_HALF_DOWN ); } // checks if the loop asks to create more connection than records are available.

        shuffle( $records );

        $records_chunk = array_chunk( $records, 5 );

        $i = 0;

        while ($loops > $i) {

            if (
            !isset( $records_chunk[$i][0] ) ||
            !isset( $records_chunk[$i][1] ) ||
            !isset( $records_chunk[$i][2] ) ||
            !isset( $records_chunk[$i][3] ) ||
            !isset( $records_chunk[$i][4] )
            ) {
                break;
            }

            // Break in 4 generations
            $zero = $records_chunk[$i][0];
            $first = $records_chunk[$i][1];
            $second = $records_chunk[$i][2];
            $third = $records_chunk[$i][3];
            $fourth = $records_chunk[$i][4];

            $to = $zero;
            $from = $first;
            p2p_type( 'baptizer_to_baptized' )->connect( $from, $to, array(
                'date' => current_time( 'mysql' ),
                'month'     => '1',
                'day'   =>  $i,
                'year'  =>  $year,
            ) );

            $to = $first;
            $from = $second;
            p2p_type( 'baptizer_to_baptized' )->connect( $from, $to, array(
                'date' => current_time( 'mysql' ),
                'month'     => '2',
                'day'   =>  $i,
                'year'  =>  $year,
            ) );

            $to = $second;
            $from = $third;
            p2p_type( 'baptizer_to_baptized' )->connect( $from, $to, array(
                'date' => current_time( 'mysql' ),
                'month'     => '3',
                'day'   =>  $i,
                'year'  =>  $year,
            ) );

            $to = $third;
            $from = $fourth;
            p2p_type( 'baptizer_to_baptized' )->connect( $from, $to, array(
                'date' => current_time( 'mysql' ),
                'month'     => '4',
                'day'   =>  $i,
                'year'  =>  $year,
            ) );

            $i++;
        }
        dt_write_log( $i );
        return $i;

    }

    public function add_church_connections ( $loops ) {

        /* @see https://github.com/scribu/wp-posts-to-posts/wiki/Creating-connections-programmatically */
        /* @see p2p_add_meta() https://github.com/scribu/wp-posts-to-posts/wiki/Connection-metadata#updating-connection-information */

        // Get list of records
        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'groups'
        );
        $records = get_posts( $args );

        $total = count( $records );

        if ($loops > 10) { $loops = 10;} // checks if requrested more than max number
        if ($loops * 5 > $total) { $total_loops_possible = $total / 5;
            $loops = round( $total_loops_possible, 0, PHP_ROUND_HALF_DOWN ); } // checks if the loop asks to create more connection than records are available.

        shuffle( $records );

        $records_chunk = array_chunk( $records, 5 );

        $i = 0;

        while ($loops > $i) {

            // Break in 4 generations
            $zero = $records_chunk[$i][0];
            $first = $records_chunk[$i][1];
            $second = $records_chunk[$i][2];
            $third = $records_chunk[$i][3];
            $fourth = $records_chunk[$i][4];

            $to = $zero;
            $from = $first;
            p2p_type( 'groups_to_groups' )->connect( $from, $to, array(
                'date' => current_time( 'mysql' ),
            ) );

            $to = $first;
            $from = $second;
            p2p_type( 'groups_to_groups' )->connect( $from, $to, array(
                'date' => current_time( 'mysql' ),
            ) );

            $to = $second;
            $from = $third;
            p2p_type( 'groups_to_groups' )->connect( $from, $to, array(
                'date' => current_time( 'mysql' ),
            ) );

            $to = $third;
            $from = $fourth;
            p2p_type( 'groups_to_groups' )->connect( $from, $to, array(
                'date' => current_time( 'mysql' ),
            ) );

            $i++;
        }
        return $i . ' sets of 4th generation churches added.';

    }

    public function add_coaching_connections ( $loops ) {

        /* @see https://github.com/scribu/wp-posts-to-posts/wiki/Creating-connections-programmatically */
        /* @see p2p_add_meta() https://github.com/scribu/wp-posts-to-posts/wiki/Connection-metadata#updating-connection-information */

        // Get list of records
        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'contacts'
        );
        $records = get_posts( $args );

        $total = count( $records );

        if ($loops > 25) { $loops = 25;} // checks if requrested more than max number
        if ($loops * 5 > $total) { $total_loops_possible = $total / 5;
            $loops = round( $total_loops_possible, 0, PHP_ROUND_HALF_DOWN ); } // checks if the loop asks to create more connection than records are available.

        shuffle( $records );

        $records_chunk = array_chunk( $records, 5 );

        $i = 0;

        while ($loops > $i) {

            // Break in 4 generations
            $zero = $records_chunk[$i][0];
            $first = $records_chunk[$i][1];
            $second = $records_chunk[$i][2];
            $third = $records_chunk[$i][3];
            $fourth = $records_chunk[$i][4];

            $to = $zero;
            $from = $first;
            p2p_type( 'contacts_to_contacts' )->connect( $from, $to, array(
                'date' => current_time( 'mysql' ),
            ) );

            $to = $first;
            $from = $second;
            p2p_type( 'contacts_to_contacts' )->connect( $from, $to, array(
                'date' => current_time( 'mysql' ),
            ) );

            $to = $second;
            $from = $third;
            p2p_type( 'contacts_to_contacts' )->connect( $from, $to, array(
                'date' => current_time( 'mysql' ),
            ) );

            $to = $third;
            $from = $fourth;
            p2p_type( 'contacts_to_contacts' )->connect( $from, $to, array(
                'date' => current_time( 'mysql' ),
            ) );

            $i++;
        }
        return $i . ' sets of 4th generation coaching contacts added.';

    }

    public function add_contacts_to_groups ( $loops = 100 ) {

        /* @see https://github.com/scribu/wp-posts-to-posts/wiki/Creating-connections-programmatically */
        /* @see p2p_add_meta() https://github.com/scribu/wp-posts-to-posts/wiki/Connection-metadata#updating-connection-information */


        // Get list of records
        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'contacts'
        );
        $contacts = get_posts( $args );

        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'groups'
        );
        $groups = get_posts( $args );

        if ($loops > 100) {
            $loops = 100; // checks if requested more than max number
        }

        if (count( $groups ) < $loops ) {
            $loops = count( $groups );
        }

        if (count( $contacts ) < $loops) {
            $loops = count( $contacts );
        }


        shuffle( $contacts );
        shuffle( $groups );

//        array_slice ( $groups , 0 , $loops );

        $i = 0;

        while ($loops > $i) {

            $to = $contacts[$i]->ID;
            $from = $groups[$i]->ID;


            $connection_id = p2p_type( 'contacts_to_groups' )->connect( $from, $to,  array(
                'date' => current_time( 'mysql' ),
            ) );

            p2p_update_meta( $connection_id, 'stage', dt_demo_group_role() );

            $i++;
        }



        return $i . ' contacts added to groups.';

    }

    public function add_contacts_to_locations ( $loops = 10 ) {

        /* @see https://github.com/scribu/wp-posts-to-posts/wiki/Creating-connections-programmatically */
        /* @see p2p_add_meta() https://github.com/scribu/wp-posts-to-posts/wiki/Connection-metadata#updating-connection-information */


        // Get list of records
        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'contacts'
        );
        $contacts = get_posts( $args );

        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'locations'
        );
        $locations = get_posts( $args );

        if ($loops > 100) {
            $loops = 100;
        }

        if (count( $locations ) < $loops ) {
            $loops = count( $locations );
        }

        if (count( $contacts ) < $loops) {
            $loops = count( $contacts );
        }

        shuffle( $contacts );
        shuffle( $locations );

//        array_slice ( $locations , 0 , $loops );

        $i = 0;

        while ($loops > $i) {

            $to = $contacts[$i]->ID;
            $from = $locations[$i]->ID;
            p2p_type( 'contacts_to_locations' )->connect( $from, $to, array(
                'date' => current_time( 'mysql' ),
                'primary' => 'true',
            ) );

            $i++;
        }

        return $i . ' contacts added to locations.';

    }


    public function add_groups_to_locations ( $loops = 100 ) {

        /* @see https://github.com/scribu/wp-posts-to-posts/wiki/Creating-connections-programmatically */
        /* @see p2p_add_meta() https://github.com/scribu/wp-posts-to-posts/wiki/Connection-metadata#updating-connection-information */


        // Get list of records
        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'groups'
        );
        $groups = get_posts( $args );

        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'locations'
        );
        $locations = get_posts( $args );

        if ($loops > 100) {
            $loops = 100;
        }

        if (count( $locations ) < $loops ) {
            $loops = count( $locations );
        }

        if (count( $groups ) < $loops) {
            $loops = count( $groups );
        }

        shuffle( $groups );
        shuffle( $locations );

//        array_slice ( $locations , 0 , $loops );

        $i = 0;

        while ($loops > $i) {

            $to = $groups[$i]->ID;
            $from = $locations[$i]->ID;
            p2p_type( 'groups_to_locations' )->connect( $from, $to, array(
                'date' => current_time( 'mysql' ),
                'primary' => 'true',
            ) );

            $i++;
        }

        return $i . ' groups added to locations.';

    }

}