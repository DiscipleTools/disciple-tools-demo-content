<?php

/*
 * Class for creating sample contacts
 *
 * @package dmm-crm-sample-data
 * */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class dt_sample_groups
{

    /**
     * dt_sample_groups The single instance of dt_sample_groups
     * @var    object
     * @access  private
     * @since    1.0.0
     */
    private static $_instance = NULL;

    /**
     * Access plugin instance. You can create further instances by calling
     * the constructor directly.
     * @static
     * @return dt_sample_groups instance
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
                "type" => dt_sample_random_group_type(),
                "address"   =>  dt_sample_random_address(),
                "city"  => dt_sample_random_city_names(),
                "state" => dt_sample_random_state(),
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

        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'groups',
            "meta_key"  => '_sample',
            "meta_value"    => 'sample',
        );
        $groups = get_posts( $args );

        foreach ($groups as $group) {
            $id = $group->ID;
            wp_delete_post( $id, true );
        }

        return 'Groups deleted';

    }

    /******************************************************************************/
    /* Section :  Deprecated */

    /**
     * Sets a check so that the groups are added only one time.
     * @return string
     */
//    public function add_groups_once () {
//        $html = '';
//
//        if (get_option('add_sample_groups') !== '1') {
//
//            $html .= $this->add_groups();
//
//            $option = 'add_sample_groups';
//            $value = '1';
//            $deprecated = '';
//            $autoload = TRUE;
//
//            add_option($option, $value, $deprecated, $autoload);
//
//        } else {
//            $html .= '<p>Groups are already loaded. <form method="POST"><button type="submit" value="reset_groups" name="reset_groups" class="button" id="reset_groups">Load the sample groups again?</button></p>';
//        }
//        return $html;
//    }

    /**
     * Loads an array of new groups and returns a report of successful inserts.
     */
//    protected function add_groups()
//    {
//        $html = '';
//
//        $groups = array(
//            array("title" => "Taruh Group", "address" => "345 Circle Ave.", "city" => "East Paris", "state" => "Paris", "zip" => "80123", "generation" => "1st Generation", "type" => "DBS"),
//            array("title" => "Wasim's Group", "address" => "1501 Mineral Ave.", "city" => "Barcelona", "state" => "Cantalona", "zip" => "98765", "generation" => "1st Generation", "type" => "DBS"),
//            array("title" => "Buthaynah Group", "address" => "34 Canal Cir.", "city" => "Istanbul", "state" => "Istanbul", "zip" => "98765", "generation" => "1st Generation", "type" => "DBS"),
//            array("title" => "Said Home Group", "address" => "345 Circle Ave.", "city" => "East Paris", "state" => "Paris", "zip" => "80123", "generation" => "1st Generation", "type" => "DBS"),
//            array("title" => "Carmen's Church", "address" => "1501 Mineral Ave.", "city" => "Barcelona", "state" => "Cantalona", "zip" => "98765", "generation" => "1st Generation", "type" => "DBS"),
//            array("title" => "Elio's Church", "address" => "34 Canal Cir.", "city" => "Istanbul", "state" => "Istanbul", "zip" => "98765", "generation" => "1st Generation", "type" => "DBS"),
//            array("title" => "Taruh Group", "address" => "345 Circle Ave.", "city" => "East Paris", "state" => "Paris", "zip" => "80123", "generation" => "1st Generation", "type" => "DBS"),
//            array("title" => "Ashael's Group", "address" => "1501 Mineral Ave.", "city" => "Barcelona", "state" => "Cantalona", "zip" => "98765", "generation" => "1st Generation", "type" => "DBS"),
//            array("title" => "City District Group", "address" => "34 Canal Cir.", "city" => "Istanbul", "state" => "Istanbul", "zip" => "98765", "generation" => "1st Generation", "type" => "DBS"),
//            array("title" => "Prasila's Home Group", "address" => "345 Circle Ave.", "city" => "East Paris", "state" => "Paris", "zip" => "80123", "generation" => "1st Generation", "type" => "DBS"),
//            array("title" => "Aquila's Church", "address" => "1501 Mineral Ave.", "city" => "Barcelona", "state" => "Cantalona", "zip" => "98765", "generation" => "1st Generation", "type" => "DBS"),
//            array("title" => "Paul's Church", "address" => "34 Canal Cir.", "city" => "Istanbul", "state" => "Istanbul", "zip" => "98765", "generation" => "1st Generation", "type" => "DBS"),
//        );
//
//        foreach ($groups as $group) {
//
//            $post_title = $group["title"];
//            $post_type = 'groups';
//            $post_content = ' ';
//            $post_status = "publish";
//            $post_author = get_current_user_id();
//
//            $post = array(
//                "post_title" => $post_title,
//                'post_type' => $post_type,
//                "post_content" => $post_content,
//                "post_status" => $post_status,
//                "post_author" => $post_author,
//                "meta_input" => array(
//                    "generation" => $group["generation"],
//                    "type" => $group["type"],
//                    "address" => $group["address"],
//                    "city" => $group["city"],
//                    "state" => $group["state"],
//                    "zip" => $group["zip"],
//                ),
//            );
//
//            wp_insert_post($post);
//
//            $html .= '<br>Added: '  . $post_title;
//        }
//
//        $html .= '<br><br>' . count($groups) . ' groups added';
//
//        return $html;
//    }

    /**
     * Resets the if option for groups
     * @return string
     */
//    public function reset_groups () {
//        delete_option('add_sample_groups');
//        $html = $this->add_groups_once();
//        return $html;
//    }


}