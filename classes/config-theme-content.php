<?php

/*
 * Class for creating sample menu
 *
 * @package dmm-crm-sample-data
 * */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class dmm_crm_theme_content
{

    /**
     * dmm_crm_sample_menu The single instance of dmm_crm_sample_menu.
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
     * @return dmm_crm_theme_content instance
     */
    public static function instance()
    {
        if (NULL === self::$_instance)
            self::$_instance = new self;
        return self::$_instance;
    }

    // Constructor class
    public function __construct() {}

    /*
     * Sets a check so that the groups are added only one time.
     *
     *
     * @return string
     */
    public function add_menu_once () {
        $html = '';

        if (get_option('add_sample_menu') !== '1') {

            $html .= $this->add_menu();

            $option = 'add_sample_menu';
            $value = '1';
            $deprecated = '';
            $autoload = TRUE;

            add_option($option, $value, $deprecated, $autoload);

        } else {
            $html .= '<p>Users are already loaded. <form method="POST"><button type="submit" value="reset_menu" name="reset_menu" class="button" id="reset_menu">Reset full set of sample menu</button></p>';
        }
        return $html;
    }

    protected function add_menu ()
    {
        $html = '';

//        if( null == username_exists( 'Marketer' ) ) {
//
//            // Create user
//            $username = 'Marketer';
//            $password = 'dmmcrm';
//            $email = 'marketer@dmmcrm.com';
//            $user_id = wp_create_user( $username, $password, $email );
//
//            // Set the nickname
//            wp_update_user(
//                array(
//                    'ID'          =>    $user_id,
//                    'nickname'    =>    $username,
//                    'first_name'  =>    'Marketer'
//                )
//            );
//
//            // Set the role
//            $user = new WP_User( $user_id );
//            $user->set_role( 'marketer' );
//
//            // Report
//            $html .= '<br>Added: ' . $username ;
//        } // end if


        return $html;
    }
    /*
     * Resets the if option for groups
     *
     * @return string
     *
     */
    public function reset_menu () {
        delete_option('add_sample_menu');
        $html = $this->add_menu_once();
        return $html;
    }


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
            $html .= '<p>Pages are already loaded. <form method="POST"><button type="submit" value="reset_core_pages" name="reset_core_pages" class="button" id="reset_core_pages">Reset core pages</button></p>';
        }
        return $html;
    }


    protected function add_core_pages ()
    {
        $html = '';

        if ( TRUE == get_post_status( 2 ) ) {	wp_delete_post(2);  } // Delete default page

        $postarr = array(
            array(
                'post_title'    =>  'Prayer',
                'post_name'     =>  'prayer',
                'post_content'  =>  '[prayer_short_code]',
                'post_status'   =>  'Publish',
                'comment_status'    =>  'closed',
                'ping_status'   =>  'closed',
                'menu_order'    =>  '0',
                'post_type'     =>  'page',
            ),
            array(
                'post_title'    =>  'Project Update',
                'post_name'     =>  'project-update',
                'post_content'  =>  '[project_update_short_code]',
                'post_status'   =>  'Publish',
                'comment_status'    =>  'closed',
                'ping_status'   =>  'closed',
                'menu_order'    =>  '1',
                'post_type'     =>  'page',
            ),
            array(
                'post_title'    =>  'Charts',
                'post_name'     =>  'charts',
                'post_content'  =>  '[charts_short_code]',
                'post_status'   =>  'Publish',
                'comment_status'    =>  'closed',
                'ping_status'   =>  'closed',
                'menu_order'    =>  '2',
                'post_type'     =>  'page',
            ),
            array(
                'post_title'    =>  'Maps',
                'post_name'     =>  'maps',
                'post_content'  =>  '[maps_short_code]',
                'post_status'   =>  'Publish',
                'comment_status'    =>  'closed',
                'ping_status'   =>  'closed',
                'menu_order'    =>  '3',
                'post_type'     =>  'page',
            ),
            array(
                'post_title'    =>  'Downloads',
                'post_name'     =>  'downloads',
                'post_content'  =>  '[downloads_short_code]',
                'post_status'   =>  'Publish',
                'comment_status'    =>  'closed',
                'ping_status'   =>  'closed',
                'menu_order'    =>  '4',
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
    /*
         * Resets the if option for groups
         *
         * @return string
         *
         */
    public function reset_core_pages () {
        delete_option('add_core_pages');
        $html = $this->add_core_pages_once();
        return $html;
    }


    public function delete_sample_menu () {
//        $id = get_user_by( 'email', 'project_supporter@dmmcrm.com' );
//        wp_delete_user( $id, $reassign );
    }

}