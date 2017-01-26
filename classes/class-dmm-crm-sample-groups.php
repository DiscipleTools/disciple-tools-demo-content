<?php

/*
 * Class for creating sample contacts
 *
 * @package dmm-crm-sample-data
 * */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class dmm_crm_sample_groups
{

    /**
     * dmm_crm_sample_groups The single instance of dmm_crm_sample_groups
     * @var    object
     * @access  private
     * @since    1.0.0
     */
    private static $_instance = NULL;

    /**
     * Access plugin instance. You can create further instances by calling
     * the constructor directly.
     * @static
     * @return dmm_crm_sample_groups instance
     */
    public static function instance()
    {
        if (NULL === self::$_instance)
            self::$_instance = new self;
        return self::$_instance;
    }

    // Constructor class
    public function __construct()
    {

        add_action('admin_menu', array($this, 'sample_data_menu'));

    }

    // Option pages
    public function sample_data_menu()
    {
        if (get_option('add_sample_groups') !== '1') {
            add_options_page('Add Sample Groups', 'Add Sample Groups', 'manage_options', 'sample-groups-data', array($this, 'add_groups_options'));
        }
    }


    public function add_groups_options()
    {

        if (get_option('add_sample_groups') !== '1') {

            echo '<div class="wrap">';
            echo '<h1>Add Sample Groups</h1><p>';

            $contacts = array();

            $groups = array(
                array("title" => "Taruh Group", "address" => "345 Circle Ave.", "city" => "East Paris", "state" => "Paris", "zip" => "80123", "generation" => "1st Generation", "type" => "DBS"),
                array("title" => "Wasim's Group", "address" => "1501 Mineral Ave.", "city" => "Barcelona", "state" => "Cantalona", "zip" => "98765", "generation" => "1st Generation", "type" => "DBS"),
                array("title" => "Buthaynah Group", "address" => "34 Canal Cir.", "city" => "Istanbul", "state" => "Istanbul", "zip" => "98765", "generation" => "1st Generation", "type" => "DBS"),
                array("title" => "Said Home Group", "address" => "345 Circle Ave.", "city" => "East Paris", "state" => "Paris", "zip" => "80123", "generation" => "1st Generation", "type" => "DBS"),
                array("title" => "Carmen's Church", "address" => "1501 Mineral Ave.", "city" => "Barcelona", "state" => "Cantalona", "zip" => "98765", "generation" => "1st Generation", "type" => "DBS"),
                array("title" => "Elio's Church", "address" => "34 Canal Cir.", "city" => "Istanbul", "state" => "Istanbul", "zip" => "98765", "generation" => "1st Generation", "type" => "DBS"),
                array("title" => "Taruh Group", "address" => "345 Circle Ave.", "city" => "East Paris", "state" => "Paris", "zip" => "80123", "generation" => "1st Generation", "type" => "DBS"),
                array("title" => "Ashael's Group", "address" => "1501 Mineral Ave.", "city" => "Barcelona", "state" => "Cantalona", "zip" => "98765", "generation" => "1st Generation", "type" => "DBS"),
                array("title" => "City District Group", "address" => "34 Canal Cir.", "city" => "Istanbul", "state" => "Istanbul", "zip" => "98765", "generation" => "1st Generation", "type" => "DBS"),
                array("title" => "Prasila's Home Group", "address" => "345 Circle Ave.", "city" => "East Paris", "state" => "Paris", "zip" => "80123", "generation" => "1st Generation", "type" => "DBS"),
                array("title" => "Aquila's Church", "address" => "1501 Mineral Ave.", "city" => "Barcelona", "state" => "Cantalona", "zip" => "98765", "generation" => "1st Generation", "type" => "DBS"),
                array("title" => "Paul's Church", "address" => "34 Canal Cir.", "city" => "Istanbul", "state" => "Istanbul", "zip" => "98765", "generation" => "1st Generation", "type" => "DBS"),
            );

            foreach ($groups as $group) {

                $post_title = $group["title"];
                $post_type = 'groups';
                $post_content = ' ';
                $post_status = "publish";
                $post_author = get_current_user_id();

                $post = array(
                    "post_title" => $post_title,
                    'post_type' => $post_type,
                    "post_content" => $post_content,
                    "post_status" => $post_status,
                    "post_author" => $post_author,
                    "meta_input" => array(
                        "generation" => $group["generation"],
                        "type" => $group["type"],
                        "address" => $group["address"],
                        "city" => $group["city"],
                        "state" => $group["state"],
                        "zip" => $group["zip"],
                    ),
                );

                wp_insert_post($post);

                echo "<br>Added: " . $post_title;
            }

            echo "<br><br>" . count($groups) . " groups added";
            echo '</p></div>';

            $option = 'add_sample_groups';
            $value = '1';
            $deprecated = '';
            $autoload = TRUE;

            add_option($option, $value, $deprecated, $autoload);

        } else {

            echo '<div class="wrap">
                    <h1>Add Sample Groups</h1>
                    <p>Groups are already loaded.</p>
                  </div>
                ';
        }
    }
}