<?php

/*
 * Class for creating core pages
 *
 * @package dt_training
 * */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class dt_core_pages
{

    /**
     * dt_core_pages The single instance of dt_core_pages.
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
     * @return dt_core_pages instance
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
     * Add core pages one time
     * @return string
     */
    public function add_core_pages_once () {
        $html = '';

        if (get_option('add_core_pages') !== '1') {

            $html .= $this->add_core_pages();

            $option = 'add_core_pages';
            $value = '1';
            $deprecated = '';
            $autoload = TRUE;

            add_option($option, $value, $deprecated, $autoload);

        } else {
            $html .= '<p>Pages are already loaded. <form method="POST"><button type="submit" value="reset_core_pages" name="submit" class="button" id="reset_core_pages">Reset core pages</button></p>';
        }
        return $html;
    }

    /**
     * Add core pages main function
     * @return string
     */
    protected function add_core_pages ()
    {
        $html = '';

        if ( TRUE == get_post_status( 2 ) ) {	wp_delete_post(2);  } // Delete default page

        $postarr = array(
            array(
                'post_title'    =>  'Reports',
                'post_name'     =>  'reports',
                'post_content'  =>  'The content of the page is controlled by the Disciple Tools plugin, but this page is required by the plugin to display the dashboard.',
                'post_status'   =>  'Publish',
                'comment_status'    =>  'closed',
                'ping_status'   =>  'closed',
                'menu_order'    =>  '4',
                'post_type'     =>  'page',
            ),
            array(
                'post_title'    =>  'Profile',
                'post_name'     =>  'profile',
                'post_content'  =>  'The content of the page is controlled by the Disciple Tools plugin, but this page is required by the plugin to display the dashboard.',
                'post_status'   =>  'Publish',
                'comment_status'    =>  'closed',
                'ping_status'   =>  'closed',
                'menu_order'    =>  '4',
                'post_type'     =>  'page',
            ),
            array(
                'post_title'    =>  'About Us',
                'post_name'     =>  'about-us',
                'post_content'  =>  'The content of the page is controlled by the Disciple Tools plugin, but this page is required by the plugin to display the dashboard.',
                'post_status'   =>  'Publish',
                'comment_status'    =>  'closed',
                'ping_status'   =>  'closed',
                'menu_order'    =>  '4',
                'post_type'     =>  'page',
            ),
            array(
                'post_title'    =>  'Media',
                'post_name'     =>  'media',
                'post_content'  =>  'The content of the page is controlled by the Disciple Tools plugin, but this page is required by the plugin to display the dashboard.',
                'post_status'   =>  'Publish',
                'comment_status'    =>  'closed',
                'ping_status'   =>  'closed',
                'menu_order'    =>  '5',
                'post_type'     =>  'page',
            ),
        );

        foreach ($postarr as $item) {
            if (! post_exists ($item['post_title']) ) {
                wp_insert_post( $item, false );
            } else {
                $page = get_page_by_title($item['post_title']);
                wp_delete_post($page->ID);
                wp_insert_post( $item, false );
            }
            $html .= 'Added Page: "'. $item['post_title'] . '"<br>';
        }

        return $html;
    }

    /**
     * Resets the if option for groups
     * @return string
     */
    public function reset_core_pages () {
        delete_option('add_core_pages');
        $html = $this->add_core_pages_once();
        return $html;
    }

}