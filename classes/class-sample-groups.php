<?php

/*
 * Class for creating sample contacts
 *
 * @package dmm-crm-sample-data
 * */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class dt_training_groups
{

    /**
     * dt_training_groups The single instance of dt_training_groups
     * @var    object
     * @access  private
     * @since    1.0.0
     */
    private static $_instance = NULL;

    /**
     * Access plugin instance. You can create further instances by calling
     * the constructor directly.
     * @static
     * @return dt_training_groups instance
     */
    public static function instance()
    {
        if (NULL === self::$_instance)
            self::$_instance = new self;
        return self::$_instance;
    }

    // Constructor class
    public function __construct() { }



    /******************************************************************************/
    /* Section :  Add Groups by Count */

    /**
     * Loops contact creation according to supplied $count.
     * @param $count    int Number of records to create.
     * @return string
     */
    public function add_groups_by_count ($count)
    {
        $i = 0;
        while ($count > $i ) {

            $post = $this->single_plain_group ();
            wp_insert_post($post);

            $i++;
        }
        return $count . ' records created';
    }

    /**
     * Builds a single random contact record.
     * @return array|WP_Post
     */
    public function single_plain_group () {

        $post = array(
            "post_title" => 'Group' . rand(100, 999),
            'post_type' => 'groups',
            "post_content" => ' ',
            "post_status" => "publish",
            "post_author" => get_current_user_id(),
            "meta_input" => array(
                "type" => dt_training_random_group_type(),
                "address"   =>  dt_training_random_address(),
                "city"  => dt_training_random_city_names(),
                "state" => dt_training_random_state(),
                "zip"   =>  rand(80000, 89999),
                "_sample"   => 'sample',
            ),
        );

        return $post;
    }

    /**
     * Delete all groups in database
     * @return string
     */
    public function delete_groups () {

        global $wpdb;

        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'groups',
            "meta_key"  => '_sample',
            "meta_value"    => 'sample',
        );
        $groups = get_posts( $args );

        foreach ($groups as $group) {
            $id = $group->ID;

            $wpdb->get_results("DELETE FROM wp_p2p WHERE p2p_from = '$id' OR p2p_to = '$id'");

            wp_delete_post( $id, true );
        }

        $wpdb->get_results("DELETE FROM wp_p2pmeta WHERE NOT EXISTS (SELECT NULL FROM wp_p2p WHERE wp_p2p.p2p_id = wp_p2pmeta.p2p_id)");

        return 'Groups deleted';

    }
}