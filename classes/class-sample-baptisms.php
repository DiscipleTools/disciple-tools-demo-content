<?php

/**
 * dt_sample_baptisms
 *
 * @class dt_sample_baptisms
 * @version	0.1
 * @since 0.1
 * @package	Disciple_Tools
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class dt_sample_baptisms {

    /**
     * dt_sample_baptisms The single instance of dt_sample_baptisms.
     * @var 	object
     * @access  private
     * @since 	0.1
     */
    private static $_instance = null;

    /**
     * Main Disciple_Tools_Admin_Menus Instance
     *
     * Ensures only one instance of dt_sample_baptisms is loaded or can be loaded.
     *
     * @since 0.1
     * @static
     * @return dt_sample_baptisms instance
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

        // Get list of contacts
        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'contacts'
        );
        $contacts = get_posts( $args );

        $contact_total = count($contacts);




        $i = 0;

        while ($loops > $i) {

            // Break in 4 generations
            $zero = $contacts[rand(1, $contact_total - 1)];
            $first = $contacts[rand(1, $contact_total - 1)];
            $second = $contacts[rand(1, $contact_total - 1)];
            $third = $contacts[rand(1, $contact_total - 1)];
            $fourth = $contacts[rand(1, $contact_total - 1)];

            $from = $zero;
            $to = $first;
            p2p_type( 'baptizer_to_baptized' )->connect( $from, $to, array(
                'date' => current_time('mysql')
            ) );

            $from = $first;
            $to = $second;
            p2p_type( 'baptizer_to_baptized' )->connect( $from, $to, array(
                'date' => current_time('mysql')
            ) );

            $from = $second;
            $to = $third;
            p2p_type( 'baptizer_to_baptized' )->connect( $from, $to, array(
                'date' => current_time('mysql')
            ) );

            $from = $third;
            $to = $fourth;
            p2p_type( 'baptizer_to_baptized' )->connect( $from, $to, array(
                'date' => current_time('mysql')
            ) );

            $i++;
        }


    }

}