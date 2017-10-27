<?php

/*
 * Class for creating sample contacts
 *
 * @package dmm-crm-sample-data
 * */

if (!defined( 'ABSPATH' )) { exit; // Exit if accessed directly
}

class DT_Demo_Contacts
{

    /**
     * DT_Demo_Contacts The single instance of DT_Demo_Contacts.
     * @var    object
     * @access  private
     * @since    1.0.0
     */
    private static $_instance = null;

    /**
     * Access plugin instance. You can create further instances by calling
     * the constructor directly.
     * @since 0.1
     * @static
     * @return DT_Demo_Contacts instance
     */
    public static function instance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    // Constructor class
    public function __construct() {}

    /**
     * Loops contact creation according to supplied $count.
     * @param $count    int Number of records to create.
     * @return string
     */
    public function add_contacts_by_count ( $count )
    {
        $i = 0;
        while ($count > $i ) {

            $post = $this->single_plain_contact();
            wp_insert_post( $post );

            $i++;
        }
        return $count . ' records created';
    }

    /**
     * Builds a single random contact record.
     * @return array|WP_Post
     */
    public function single_plain_contact () {
        $primary_phone_key = "contact_phone_111";
//        $primary_phone_details_key = "contact_phone_111_details";
//        $primary_phone_details = ["type"=>"primary"];
        $mobile_phone_key = "contact_phone_112";
//        $mobile_phone_details_key = "contact_phone_112_details";
//        $mobile_phone_details = ["type"=>"mobile"];
        $email_key = "contact_email_111";
//        $email_details_key = "contact_email_111_details";
//        $email_details = ["type"=>"primary"];
        $address_key = "address_111";
//        $address_details_key = "address_111_details";
//        $address_details = ["type"=>"home"];

        $name = dt_demo_random_name();

        $post = array(
            "post_title" => $name . ' Contact' . rand( 100, 999 ),
            'post_type' => 'contacts',
            "post_content" => ' ',
            "post_status" => "publish",
            "post_author" => get_current_user_id(),
            "meta_input" => array(
                $primary_phone_key => dt_demo_random_phone_number(),
//                $primary_phone_details_key => $primary_phone_details,
                $mobile_phone_key => dt_demo_random_phone_number(),
//                $mobile_phone_details_key => $mobile_phone_details,
                $address_key => dt_demo_full_address(),
//                $address_details_key => $address_details,
                $email_key => $name.rand( 1000, 10000 )."@email.com",
//                $email_details_key => $email_details,
                "overall_status" => dt_demo_random_overall_status(),
                "sources"    =>  dt_demo_random_source(),
                "seeker_path"   =>  dt_demo_seeker_path(),
                "_sample"   => 'sample',
            ),
        );
        $post["meta_input"] = array_merge( $post["meta_input"], dt_demo_random_milestones() );

        return $post;

    }

    /**
     * Delete all contacts in database
     * @return string
     */
    public function delete_contacts () {

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

            $wpdb->get_results( "DELETE FROM $wpdb->p2p WHERE p2p_from = '$id' OR p2p_to = '$id'" );

            wp_delete_post( $id, 'true' );
        }

        $wpdb->get_results( "DELETE FROM $wpdb->p2pmeta WHERE NOT EXISTS (SELECT NULL FROM $wpdb->p2p WHERE $wpdb->p2p.p2p_id = $wpdb->p2pmeta.p2p_id)" );

        return 'Contacts deleted';

    }

    /**
     * Shuffle the assigned_to records for contacts
     * @return string
     */
    public function shuffle_assignments () {
        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'contacts'
        );
        $contacts = get_posts( $args );

        $args = array(
            'fields'       => 'all',
            'role__in'     => array('multiplier', 'multiplier_leader', 'administrator'),
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
    public function shuffle_update_requests () {
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
