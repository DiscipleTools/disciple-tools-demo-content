<?php

/**
 * dmm_crm_p2p_generations class
 *
 * This class depends on the Post-to-Post library and the wp_p2p
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 * @class dmm_crm_p2p_generations
 * @version	1.0.0
 * @since 1.0.0
 * @package	DRM_Plugin
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

final class dmm_crm_p2p_generations {


    /**
     * dmm_crm_p2p_generations The single instance of dmm_crm_p2p_generations.
     * @var 	object
     * @access  private
     * @since 	1.0.0
     */
    private static $_instance = null;

    /*
     * Dabase table name for the p2p table.
     *
     * @access protected
     * @since   0.1
     */
    protected $p2p;

    /*
     * Dabase table name for the p2pmeta table
     *
     * @access protected
     * @since   0.1
     */
    protected $p2pmeta;
    /*
     *
     *
     */
    protected $groups_filter = 'groups_to_groups';
    protected $contacts_filter = 'contacts_to_contacts';

    /*
     * Sets the $p2p database array.
     *
     *
     */
    protected $p2p_array = array();

    /**
     * dmm_crm_p2p_generations Instance
     *
     * Ensures only one instance of dmm_crm_p2p_generations is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @return dmm_crm_p2p_generations instance
     */
    public static function instance () {
        if ( is_null( self::$_instance ) )
            self::$_instance = new self();
        return self::$_instance;
    } // End instance()

    /**
     * Constructor function.
     * @access  public
     * @since   1.0.0
     */
    public function __construct () {

        // Build database tables for p2p
        global $wpdb;
        $this->p2p = $wpdb->prefix . 'p2p';
        $this->p2pmeta = $wpdb->prefix . 'p2pmeta';

    } // End __construct()


    public function test_run() {
        $html = 'test';

        return $html;

    }

    /*
     * Get Current Generation
     * retrieves a number representing the generation of the supplied record number.
     *
     * @param   post_id number from the contact.
     * @returns number
     * @access public
     * @since 0.1
     */
    public function get_current_gen ($gen, $type) {
        global $wpdb;
        $i = 0;

        // Check whether to search contacts or groups generations
        if ($type == 'groups') { $filter = $this->groups_filter; }
        elseif ($type == 'contacts') { $filter = $this->contacts_filter; }
        else { wp_die(); }


        // Build array from db
        $p2p_array = $wpdb->get_results( "SELECT p2p_to, p2p_from FROM $this->p2p WHERE p2p_type = '$filter'" );
        $p2p_array = json_decode(json_encode($p2p_array), True); // convert from object array to php array.

        // Create array columns
        $p2p_array_from = array_column ( $p2p_array , 'p2p_from');

        // Check if this is source generation
        if($this->p2p_first_generation_check($gen, $p2p_array_from)) { //TRUE
            $i = 0;
        }
        else
        { // FALSE, then what generation is it?
            while (true) {
                if (! $this->p2p_first_generation_check($gen, $p2p_array_from)) { // checks if the target is found in the
                    $gen = $this->p2p_get_single_parent_id($gen, $p2p_array) ;
                    $i++;
                } else { // condition failed
                    break; // leave loop
                }
            }
        }
        return $i;
    }


    public function get_gen_list ($gen, $type) {
        global $wpdb;
        $i = 0;
        $parent_gen = array(); // prepares the array for the generations

        // Check whether to search contacts or groups generations
        if ($type == 'groups') { $filter = $this->groups_filter; }
        elseif ($type == 'contacts') { $filter = $this->contacts_filter; }
        else { wp_die(); }


        // Build array from db
        $p2p_array = $wpdb->get_results( "SELECT p2p_to, p2p_from FROM $this->p2p WHERE p2p_type = '$filter'" );
        $p2p_array = json_decode(json_encode($p2p_array), True); // convert from object array to php array.

        // Create array columns
        $p2p_array_from = array_column ( $p2p_array , 'p2p_from');

        // Check if this is source generation
        if ($this->p2p_first_generation_check($gen, $p2p_array_from)) { //TRUE
            $parent_gen[$i] = $gen; // return zero generation id
        } else { // FALSE, then what generation is it?
            while (true) {
                if (!$this->p2p_first_generation_check($gen, $p2p_array_from)) { // checks if the target is found in the
                    $parent_gen[$i] = $gen; // record generation id
                    $gen = $this->p2p_get_single_parent_id($gen, $p2p_array); // get parent id
                    $i++; // increment the generation number
                } else { // if condition failed
                    break; // leave loop
                }
            }
        }

        return $parent_gen;
    }

    /* Count of the number of groups or contacts in a generation
     *
     * TODO: Get the number of groups or contacts at a certain generation level
     *
     * @param   Number of the generation to be counted, i.e. 1,2,3,4
     * @access  public
     * @return  number
     *
     * */
    public function get_gen_level_count ($gen_number) {
        // TODO: Get the number of groups or contacts at a certain generation level
        return 1;
    }

    /* Count of the number of groups or contacts in a generation
     *
     * TODO: Get the number of groups or contacts at a certain generation level
     *
     * @param   Post_id of the contact or group that will have descendants calculated against.
     * @access  public
     * @return  number
     *
     * */
    public function get_descendants ($gen) {

        $gen_number = 'the number of the generation to be counted';
        return 1;
    }

    /*
     * Checks if record is first generation
     *
     * @parent  Single number taken from the wp_p2p.p2p_to column
     * @column  An array with the entire column of wp_p2p.p2p_from data
     *
     * */
    protected function p2p_first_generation_check ($parent, $column) {
        foreach ($column as $value) {
            if ($value == $parent) {
                return FALSE;
            }
        }
        return TRUE;
    }


    /*
     * Checks for number of parents for a target id
     *
     *
     * */
    protected function p2p_number_of_parents_check ($value, $column) {
        $i = 0;
        foreach ($column as $row) {
            if ($row == $value) {
                $i++;
            }
        }
        return $i;
    }

    /*
     * Checks if the parent is first generation
     *
     *
     * */
    protected function p2p_get_single_parent_id( $target, $list) {
        $parent = '';

        foreach ($list as $row) {
            if ($row['p2p_from'] == $target) {
                $parent =  $row['p2p_to'];
            }
        }
        return $parent;
    }

    /*
     * Runs a full list of records in the to column and checks generation status.
     * ** This is mostly a developement class that will be removed in the final version.
     *
     *
     * */
    public function run_full_generations_list ($type) {
        global $wpdb;
        $html ='';

        // Check whether to search contacts or groups generations
        if ($type == 'groups') { $filter = $this->groups_filter; }
        elseif ($type == 'contacts') { $filter = $this->contacts_filter; }
        else { wp_die(); }


        // Build array from db
        $p2p_array = $wpdb->get_results( "SELECT p2p_to, p2p_from FROM $this->p2p WHERE p2p_type = '$filter'" );
        $p2p_array = json_decode(json_encode($p2p_array), True); // convert from object array to php array.

        // Convert array object to array
        $p2p_array = json_decode(json_encode($p2p_array), True);
        //        print_r($p2p_array); print "<br><br>";

        // Create variable array with just the "to" column
        $p2p_array_from = array_column ( $p2p_array , 'p2p_from');


        foreach ($p2p_array as $v) {

            $target = $v['p2p_to'];
            $targetChild = $v['p2p_from'];


            if($this->p2p_first_generation_check($target, $p2p_array_from)) { // Check if this is first generation
                // True, this target is first generation
                $html .= $target . ' is 1st Generation <br>';

                // True statement about the Child of the target.
                $html .= $targetChild . ' is second generation<br>';
            }
            else
            { // False target is not first generation

                // True statement about the target. It is not first generation.
                $html .= $target . ' NOT first gen<br>';

                // While loop checks for the first generation and increments the generation above the target until it gets to the first generation.
                $target_inc = $target; // separates the target from the increment
                $parent_gen = array(); // prepares the array for the generations
                $i = 1; // sets the increment value

                while (true) {
                    if (! $this->p2p_first_generation_check($target_inc, $p2p_array_from)) { // is initial condition true
                        // get the parent id
                        // replace target with parent id

                        $parent_id = $this->p2p_get_single_parent_id($target_inc, $p2p_array) ;
                        $parent_gen[$i] = $parent_id . ' is ' . $i . '  gen above ' . $target . '  ';

                        $target_inc = $parent_id;
                        $i++;
                    } else { // condition failed
                        break; // leave loop
                    }
                }

                $html .= implode(' | ', $parent_gen) . '<br>'; // implodes the array and allows it to be printed with the rest of the html as a string, not an array.

            }
        }
        return $html;
    }


}