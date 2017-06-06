<?php

/*
 * Class for creating sample contacts
 *
 * @package dmm-crm-sample-data
 * */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class dt_training_contacts
{

    /**
     * dt_training_contacts The single instance of dt_training_contacts.
     * @var    object
     * @access  private
     * @since    1.0.0
     */
    private static $_instance = NULL;

    /**
     * Access plugin instance. You can create further instances by calling
     * the constructor directly.
     * @since 0.1
     * @static
     * @return dt_training_contacts instance
     */
    public static function instance()
    {
        if (NULL === self::$_instance)
            self::$_instance = new self;
        return self::$_instance;
    }

    // Constructor class
    public function __construct() {}

    /**
     * Loops contact creation according to supplied $count.
     * @param $count    int Number of records to create.
     * @return string
     */
    public function add_contacts_by_count ($count)
    {
        $i = 0;
        while ($count > $i ) {

            $post = $this->single_plain_contact();
            wp_insert_post($post);

            $i++;
        }
        return $count . ' records created';
    }

    /**
     * Builds a single random contact record.
     * @return array|WP_Post
     */
    public function single_plain_contact () {
        $primary_phone_key = "contact_phone_primary_111";
        $mobile_phone_key = "contact_phone_mobile_111";
        $email_key = "contact_email_primary_111";
        $address = "address_home_111";

        $name = dt_training_random_name ();

        $post = array(
            "post_title" => $name . ' Contact' . rand(100, 999),
            'post_type' => 'contacts',
            "post_content" => ' ',
            "post_status" => "publish",
            "post_author" => get_current_user_id(),
            "meta_input" => array(
                $primary_phone_key => dt_training_random_phone_number(),
                $mobile_phone_key => dt_training_random_phone_number(),
                $address => dt_training_full_address (),
                $email_key => $name.rand(1000, 10000)."@email.com",
                "overall_status" => dt_training_random_overall_status(),
                "preferred_contact_method" => dt_training_random_preferred_contact_method (),
                "source_details"    =>  dt_training_random_source (),
                "seeker_path"   =>  dt_training_seeker_path(),
                "_sample"   => 'sample',
            ),
        );

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

            $wpdb->get_results("DELETE FROM wp_p2p WHERE p2p_from = '$id' OR p2p_to = '$id'");

            wp_delete_post( $id, 'true');
        }

        $wpdb->get_results("DELETE FROM wp_p2pmeta WHERE NOT EXISTS (SELECT NULL FROM wp_p2p WHERE wp_p2p.p2p_id = wp_p2pmeta.p2p_id)");

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

        $user_count = count($users);

        foreach ($contacts as $contact) {

            $user = $users[rand(0, $user_count - 1)];

            $post_id = $contact->ID;
            $meta_key = 'assigned_to';
            $meta_value = 'user-' . $user->ID;

            update_post_meta( $post_id, $meta_key, $meta_value );
        }

        return 'Assignments shuffled for all contacts between multipliers, multiplier leaders, and administrators (for testing).';
    }


    public function shuffle_update_requests () {
        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'contacts'
        );
        $contacts = get_posts( $args );


        foreach ($contacts as $contact) {

            $post_id = $contact->ID;
            $meta_key = 'requires_update';
            $meta_value = dt_training_random_requires_upate();

            update_post_meta( $post_id, $meta_key, $meta_value );
        }

        return 'Update requests shuffled for all contacts.';
    }
}