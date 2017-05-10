<?php

/**
 * dt_training_locations
 *
 * @class dt_training_locations
 * @version	0.1
 * @since 0.1
 * @package	Disciple_Tools
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class dt_training_locations {

    /**
     * dt_training_locations The single instance of dt_training_locations.
     * @var 	object
     * @access  private
     * @since 	0.1
     */
    private static $_instance = null;

    /**
     * Main dt_training_locations Instance
     *
     * Ensures only one instance of dt_training_locations is loaded or can be loaded.
     *
     * @since 0.1
     * @static
     * @return dt_training_locations instance
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
    public function __construct () {  } // End __construct()

    /**
     * Loops location creation according to supplied $count.
     * @param $count    int Number of records to create.
     * @return string
     */
    public function add_locations_by_count ($count)
    {
        $i = 0;
        while ($count > $i ) {

            $post = $this->single_random_location ();
            wp_insert_post($post);

            $i++;
        }
        return $count . ' records created';
    }

    /**
     * Builds a single random location record.
     * @return array|WP_Post
     */
    public function single_random_location () {

        $post = array(
            "post_title" => 'Location' . rand(100, 999),
            'post_type' => 'locations',
            "post_content" => ' ',
            "post_status" => "publish",
            "post_author" => get_current_user_id(),
            "meta_input"    => array(
                "_sample"   => "sample",
            )
        );

        return $post;
    }

    /**
     * Delete all locations in database
     * @return string
     */
    public function delete_locations () {

        global $wpdb;

        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'locations',
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

        return 'Locations deleted';

    }

}