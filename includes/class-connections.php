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

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()


    public function add_baptism_connections( $loops ) {
        global $wpdb;

        /* @see https://github.com/scribu/wp-posts-to-posts/wiki/Creating-connections-programmatically */
        /* @see p2p_add_meta() https://github.com/scribu/wp-posts-to-posts/wiki/Connection-metadata#updating-connection-information */

        $year = gmdate( 'Y' );
        // Get list of contacts
        $records = $wpdb->get_results("SELECT * 
            FROM $wpdb->posts WHERE post_type = 'contacts' 
            AND ID NOT IN (SELECT p2p_from FROM $wpdb->p2p WHERE p2p_type = 'baptizer_to_baptized')
            AND ID NOT IN (SELECT p2p_to FROM $wpdb->p2p WHERE p2p_type = 'baptizer_to_baptized')" );

        $total = count( $records );

        if ($loops > 10) { $loops = 10;} // checks if requested more than max number
        if ($loops * 5 > $total) { $total_loops_possible = $total / 5;
            $loops = round( $total_loops_possible, 0, PHP_ROUND_HALF_DOWN ); } // checks if the loop asks to create more connection than records are available.

        shuffle( $records );

        $records_chunk = array_chunk( $records, 10 );

        $i = 0;

        while ($loops > $i) {

            if (
            !isset( $records_chunk[$i][9] )
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
                'month' => '1',
                'day'   => $i,
                'year'  => $year,
            ) );

            $to = $first;
            $from = $second;
            p2p_type( 'baptizer_to_baptized' )->connect( $from, $to, array(
                'date' => current_time( 'mysql' ),
                'month' => '2',
                'day'   => $i,
                'year'  => $year,
            ) );

            $to = $second;
            $from = $third;
            p2p_type( 'baptizer_to_baptized' )->connect( $from, $to, array(
                'date' => current_time( 'mysql' ),
                'month' => '3',
                'day'   => $i,
                'year'  => $year,
            ) );

            $to = $third;
            $from = $fourth;
            p2p_type( 'baptizer_to_baptized' )->connect( $from, $to, array(
                'date' => current_time( 'mysql' ),
                'month' => '4',
                'day' => $i,
                'year' => $year,
            ) );

            $i++;
        }
        return $i;

    }

    public function add_church_connections( $loops ) {

        /* @see https://github.com/scribu/wp-posts-to-posts/wiki/Creating-connections-programmatically */
        /* @see p2p_add_meta() https://github.com/scribu/wp-posts-to-posts/wiki/Connection-metadata#updating-connection-information */

        // Get list of records
        global $wpdb;
        $records = $wpdb->get_results("SELECT * 
            FROM $wpdb->posts WHERE post_type = 'groups' 
            AND ID NOT IN (SELECT p2p_from FROM $wpdb->p2p WHERE p2p_type = 'groups_to_groups')
            AND ID NOT IN (SELECT p2p_to FROM $wpdb->p2p WHERE p2p_type = 'groups_to_groups')" );

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

    public function add_coaching_connections( $loops ) {

        /* @see https://github.com/scribu/wp-posts-to-posts/wiki/Creating-connections-programmatically */
        /* @see p2p_add_meta() https://github.com/scribu/wp-posts-to-posts/wiki/Connection-metadata#updating-connection-information */

        // Get list of records
        global $wpdb;
        $records = $wpdb->get_results("SELECT * 
            FROM $wpdb->posts WHERE post_type = 'contacts' 
            AND ID NOT IN (SELECT p2p_from FROM $wpdb->p2p WHERE p2p_type = 'contacts_to_contacts')
            AND ID NOT IN (SELECT p2p_to FROM $wpdb->p2p WHERE p2p_type = 'contacts_to_contacts')" );

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

    public function add_contacts_to_groups( $loops = 100 ) {

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

        $i = 0;

        while ($loops > $i) {

            $to = $contacts[$i]->ID;
            $from = $groups[$i]->ID;


            $connection_id = p2p_type( 'contacts_to_groups' )->connect( $from, $to, array(
                'date' => current_time( 'mysql' ),
            ) );

            p2p_update_meta( $connection_id, 'stage', dt_demo_group_role() );

            $i++;
        }



        return $i . ' contacts added to groups.';

    }

    public function add_contacts_to_locations( $loops = 10, $admin0_code = 'USA' ) {
        /* @see https://github.com/scribu/wp-posts-to-posts/wiki/Creating-connections-programmatically */
        /* @see p2p_add_meta() https://github.com/scribu/wp-posts-to-posts/wiki/Connection-metadata#updating-connection-information */

        global $wpdb;
        if ( ! isset( $wpdb->dt_location_grid ) ) {
            $wpdb->dt_location_grid = $wpdb->prefix . 'dt_location_grid';
        }

        // Get list of records
        $contacts = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_type = 'contacts' AND ID NOT IN (SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'location_grid')" );

        // get country
        $lowest_level = $wpdb->get_var( $wpdb->prepare( "SELECT MAX(level) FROM $wpdb->dt_location_grid WHERE admin0_code = %s", $admin0_code ) );
        $locations = $wpdb->get_col( $wpdb->prepare( "SELECT grid_id FROM $wpdb->dt_location_grid WHERE admin0_code = %s AND level = %d ORDER BY RAND() LIMIT 100;", $admin0_code, $lowest_level ) );

        shuffle( $contacts );
        shuffle( $locations );

        $i = 0;
        $location_count = count( $locations );

        foreach ( $contacts as $contact ) {

            $to = $contact->ID;
            $from = $locations[rand( 0, $location_count -1 )];
            add_post_meta( $to, 'location_grid', $from );

            $i++;
        }

        return $i . ' contacts added to locations.';

    }


    public function add_groups_to_locations( $loops = 100, $admin0_code = 'USA' ) {

        /* @see https://github.com/scribu/wp-posts-to-posts/wiki/Creating-connections-programmatically */
        /* @see p2p_add_meta() https://github.com/scribu/wp-posts-to-posts/wiki/Connection-metadata#updating-connection-information */

        global $wpdb;
        if ( ! isset( $wpdb->dt_location_grid ) ) {
            $wpdb->dt_location_grid = $wpdb->prefix . 'dt_location_grid';
        }

        // Get list of records

        $groups = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_type = 'groups' AND ID NOT IN (SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'location_grid')" );


        // get country
        $lowest_level = $wpdb->get_var( $wpdb->prepare( "SELECT MAX(level) FROM $wpdb->dt_location_grid WHERE admin0_code = %s", $admin0_code ) );
        $locations = $wpdb->get_col( $wpdb->prepare( "SELECT grid_id FROM $wpdb->dt_location_grid WHERE admin0_code = %s AND level = %d ORDER BY RAND() LIMIT 100;", $admin0_code, $lowest_level ) );

        $i = 0;
        $location_count = count( $locations );

        foreach ($groups as $group) {

            $to = $group->ID;
            $from = $locations[rand( 0, $location_count -1 )];
            add_post_meta( $to, 'location_grid', $from );

            $i++;
        }

        return $i . ' groups added to locations.';

    }

}