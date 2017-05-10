<?php

/**
 * Disciple Tools Sample Portal Page
 *
 * @class dt_training_portal
 * @version	0.1
 * @since 0.1
 * @package	Disciple_Tools
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class dt_training_portal {

    /**
     * Disciple_Tools_Admin_Menus The single instance of Disciple_Tools_Admin_Menus.
     * @var 	object
     * @access  private
     * @since 	0.1
     */
    private static $_instance = null;

    /**
     * Main Disciple_Tools_Admin_Menus Instance
     *
     * Ensures only one instance of Disciple_Tools_Admin_Menus is loaded or can be loaded.
     *
     * @since 0.1
     * @static
     * @return dt_training_portal instance
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

    public function display_page_content () {
        $html = '';

        // https://codex.wordpress.org/Function_Reference/wp_dropdown_pages
        $args = array(
            'depth'                 => 0,
            'child_of'              => 0,
            'selected'              => 0,
            'echo'                  => 0,
            'name'                  => 'page_id',
            'id'                    => null, // string
            'class'                 => null, // string
            'show_option_none'      => 'Select One', // string
            'show_option_no_change' => null, // string
            'option_none_value'     => '', // string
        );

        $html .= wp_dropdown_pages( $args );

        $args = array(
            'show_option_all'    => '',
            'show_option_none'   => '',
            'option_none_value'  => '-1',
            'orderby'            => 'ID',
            'order'              => 'ASC',
            'show_count'         => 0,
            'hide_empty'         => 1,
            'child_of'           => 0,
            'exclude'            => '',
            'include'            => '',
            'echo'               => 0,
            'selected'           => 0,
            'hierarchical'       => 0,
            'name'               => 'cat',
            'id'                 => '',
            'class'              => 'postform',
            'depth'              => 0,
            'tab_index'          => 0,
            'taxonomy'           => 'category',
            'hide_if_empty'      => false,
            'value_field'	     => 'term_id',
        );

        $html .= wp_dropdown_categories( $args );

        $args = array(
            'smallest'                  => 8,
            'largest'                   => 22,
            'unit'                      => 'pt',
            'number'                    => 45,
            'format'                    => 'flat',
            'separator'                 => "\n",
            'orderby'                   => 'name',
            'order'                     => 'ASC',
            'exclude'                   => null,
            'include'                   => null,
            'link'                      => 'view',
            'taxonomy'                  => 'post_tag',
            'echo'                      => false,
            'child_of'                  => null, // see Note!
        );

        $html .= wp_tag_cloud( $args );





        return $html;


    }



}