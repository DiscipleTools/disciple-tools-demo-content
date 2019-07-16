<?php

/*
 * Class for creating sample contacts
 *
 * @package dmm-crm-sample-data
 * */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class DT_Demo_Contacts
{
    private static $_instance = null;

    public static function instance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /*
     * Loops contact creation according to supplied $count.
     * @param $count    int Number of records to create.
     * @return string
     */
    public function add_contacts_by_count( $count ) {
        $i = 0;
        $successful = 0;
        while ($count > $i ) {

            $post = $this->single_plain_contact();
            $contact_id = Disciple_Tools_Contacts::create_contact( $post, false );

            if ( !is_wp_error( $contact_id )){
                add_post_meta( $contact_id, "_sample", "sample", true );
                $successful++;
            }

            $i++;
        }
        return $i;
    }

    /**
     * Builds a single random contact record.
     * @return array|WP_Post
     */
    public function single_plain_contact() {
        $name = dt_demo_random_name();

        $post       = [
            "title"           => $name . ' Contact' . rand( 100, 999 ),
            "contact_phone"   => [ "values" => [ [ "value" => dt_demo_random_phone_number() ] ] ],
            "contact_email"   => [ "values" => [ [ "value" => $name . rand( 1000, 10000 ) . "@email.com" ] ] ],
            "contact_address" => [ "values" => [ [ "value" => dt_demo_full_address() ] ] ],
            "sources"         => [ "values" => [ [ "value" => dt_demo_random_source() ] ] ],
            "seeker_path"     => dt_demo_seeker_path(),
            "overall_status"  => dt_demo_random_overall_status(),
            "milestones"      => [ "values" => [] ],
        ];
        $milestones = dt_demo_random_milestones();
        foreach ( $milestones as $milestone ) {
            $post["milestones"]["values"][] = [ "value" => $milestone ];
        }

        return $post;

    }

    /**
     * Delete all contacts in database
     * @return string
     */
    public function delete_contacts() {

        global $wpdb;

        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'contacts',
            'meta_key'    => '_sample',
            'meta_value'    => 'sample'
        );
        $contacts = get_posts( $args );

        foreach ($contacts as $contact) {
            $id = $contact->ID;

            $wpdb->get_results( $wpdb->prepare( "DELETE FROM $wpdb->p2p WHERE p2p_from = %s OR p2p_to = %s", $id, $id ) );

            wp_delete_post( $id, 'true' );
        }

        $wpdb->get_results( "DELETE FROM $wpdb->p2pmeta WHERE NOT EXISTS (SELECT NULL FROM $wpdb->p2p WHERE $wpdb->p2p.p2p_id = $wpdb->p2pmeta.p2p_id)" );

        return 'Contacts deleted';

    }

    /**
     * Shuffle the assigned_to records for contacts
     * @return string
     */
    public function shuffle_assignments() {
        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'contacts'
        );
        $contacts = get_posts( $args );

        $args = array(
            'fields'       => 'all',
            'role__in' => array( 'multiplier', 'multiplier_leader', 'administrator' ),
            'count_total'  => true,
        );
        $users = get_users( $args );

        $user_count = count( $users );

        foreach ($contacts as $contact) {

            $user = $users[rand( 0, $user_count - 1 )];

            $post_id = $contact->ID;
            $meta_key = 'assigned_to';
            $meta_value = 'user-' . $user->ID;

            update_post_meta( $post_id, $meta_key, $meta_value );
        }

        return 'Assignments shuffled for all contacts between multipliers, multiplier leaders, and administrators (for testing).';
    }

    /**
     * @return string
     */
    public function shuffle_update_requests() {
        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'contacts'
        );
        $contacts = get_posts( $args );


        foreach ($contacts as $contact) {

            $post_id = $contact->ID;
            $meta_key = 'requires_update';
            $meta_value = dt_demo_random_requires_upate();

            update_post_meta( $post_id, $meta_key, $meta_value );
        }

        return 'Update requests shuffled for all contacts.';
    }
}
