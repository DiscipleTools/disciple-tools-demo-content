<?php

/*
 * Class for creating sample menu
 *
 * @package dmm-crm-sample-data
 * */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class dt_theme_content
{

    /**
     * dt_sample_menu The single instance of dt_sample_menu.
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
     * @return dt_theme_content instance
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
//            $password = 'drm';
//            $email = 'marketer@drm.com';
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
            $html .= '<p>Pages are already loaded. <form method="POST"><button type="submit" value="reset_core_pages" name="submit" class="button" id="reset_core_pages">Reset core pages</button></p>';
        }
        return $html;
    }


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


    public function add_prayer_posts_once () {
        $html = '';

        if (get_option('add_prayer_posts') !== '1') {

            $html .= $this->add_prayer_posts();

            $option = 'add_prayer_posts';
            $value = '1';
            $deprecated = '';
            $autoload = TRUE;

            add_option($option, $value, $deprecated, $autoload);

        } else {
            $html .= '<p>Prayer posts already loaded. <form method="POST"><button type="submit" value="reset_prayer_posts" name="reset_prayer_posts" class="button" id="reset_prayer_posts">Reset prayer posts</button></p>';
        }
        return $html;
    }


    protected function add_prayer_posts ()
    {
        $html = '';
        $attach_id = array();

        // Remove defaul page
        if ( TRUE == get_post_status( 1 ) ) {	wp_delete_post(1);  } // Delete default page


        $postarr = array(
            array(
                'post_title'        =>  'Maybe Next Time',
                'post_name'         =>  'maybe-next-time',
                'post_content'      =>  'Father, we praise you that where two or three are gathered in your name, there you are with them. We pray for the believers across Tunisia who meet together to worship and study the Word. Father, as you are in their midst, you will also go with them in their spheres of influence. Father, multiply these gatherings. As these believers take the Word to their neighbors, please cause many to believe.',
                'post_status'       =>  'Publish',
                'post_date'         =>  date("Y-m-d H:i:s", mktime(0, 0, 0, 1, 1, 2017)),
                'comment_status'    =>  'open',
                'ping_status'       =>  'closed',
                'post_type'         =>  'post',
            ),
            array(
                'post_title'        =>  'No Matter the Situation',
                'post_name'         =>  'no-matter-the-situation',
                'post_content'      =>  'Lord, no matter the situation, no matter the fear, no matter the difficulties, may the Tunisian church obey You, Jesus.',
                'post_status'       =>  'Publish',
                'post_date'         =>  date("Y-m-d H:i:s", mktime(0, 0, 0, 1, 2, 2017)),
                'comment_status'    =>  'open',
                'ping_status'       =>  'closed',
                'post_type'         =>  'post',
            ),
            array(
                'post_title'        =>  'Fell on Good Soil',
                'post_name'         =>  'fell-on-good-soil',
                'post_content'      =>  '',
                'post_status'       =>  'Publish',
                'post_date'         =>  date("Y-m-d H:i:s", mktime(0, 0, 0, 1, 3, 2017)),
                'comment_status'    =>  'open',
                'ping_status'       =>  'closed',
                'post_type'         =>  'post',
            ),
            array(
                'post_title'        =>  'This is the Beginning',
                'post_name'         =>  'this-is-the-beginning',
                'post_content'      =>  'This is the beginning of all times. Let life be short or long, but let it always be for Him! And one day, for all of us, it will truly begin.',
                'post_status'       =>  'Publish',
                'post_date'         =>  date("Y-m-d H:i:s", mktime(0, 0, 0, 1, 4, 2017)),
                'comment_status'    =>  'open',
                'ping_status'       =>  'closed',
                'post_type'         =>  'post',
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

            $html .= 'Added Post: "'. $item['post_title'] . '"<br>';
        }

        return $html;
    }


    /*
     * Resets the if option for groups
     *
     * @return string
     *
     */
    public function reset_prayer_posts () {
        delete_option('add_prayer_posts');
        $html = $this->add_prayer_posts_once();
        return $html;
    }


    public function add_photos_once () {
        $html = '';

        if (get_option('add_photos') !== '1') {

            $html .= $this->add_photos();

            $option = 'add_photos';
            $value = '1';
            $deprecated = '';
            $autoload = TRUE;

            add_option($option, $value, $deprecated, $autoload);

        } else {
            $html .= '<p>Photos are already loaded. <form method="POST"><button type="submit" value="reset_core_pages" name="reset_core_pages" class="button" id="reset_core_pages">Reset core pages</button></p>';
        }
        return $html;
    }

    public function add_photos () {

        $html = '';

        $sample_files = array(
            array(
                'number'        => '1',
                'filename'      =>  'p4t-1.jpg',
            ),
            array(
                'number'        => '2',
                'filename'      =>  'p4t-2.jpg',
            ),
            array(
                'number'        => '3',
                'filename'      =>  'p4t-3.jpg',
            ),
            array(
                'number'        => '4',
                'filename'      =>  'p4t-4.jpg',
            ),
            array(
                'number'        => '5',
                'filename'      =>  'p4t-5.jpg',
            ),
            array(
                'number'        => '6',
                'filename'      =>  'p4t-6.jpg',
            ),
            array(
                'number'        => '7',
                'filename'      =>  'p4t-7.jpg',
            ),
            array(
                'number'        => '8',
                'filename'      =>  'p4t-8.jpg',
            ),
            array(
                'number'        => '9',
                'filename'      =>  'p4t-9.jpg',
            ),
            array(
                'number'        => '10',
                'filename'      =>  'p4t-10.jpg',
            ),
            array(
                'number'        => '11',
                'filename'      =>  'p4t-11.jpg',
            ),
            array(
                'number'        => '12',
                'filename'      =>  'p4t-12.jpg',
            ),
            array(
                'number'        => '13',
                'filename'      =>  'p4t-13.jpg',
            ),
            array(
                'number'        => '14',
                'filename'      =>  'p4t-14.jpg',
            ),
            array(
                'number'        => '15',
                'filename'      =>  'p4t-15.jpg',
            ),
        );

        foreach ($sample_files as $file) {
            $newfile = wp_upload_dir() . $file['filename'];
            $file = dt_sample_data_plugin()->img_uri . $file['filename'];

            if (copy($file, $newfile)) {
                $html .= 'successful copy of '. $file . '<br>';
            } else {
                $html .= 'failed to copy ' . $file . '<br>';
            }
        }


        foreach ($sample_files as $file) {
            $filename = $file['filename'];

            // Check the type of file. We'll use this as the 'post_mime_type'.
            $filetype = wp_check_filetype( basename( $filename ), null );

            // Get the path to the upload directory.
            $wp_upload_dir = wp_upload_dir();

            // Prepare an array of post data for the attachment.
            $attachment = array(
                'guid'           => dt_sample_data_plugin()->img_uri  . basename( $file['filename'] ),
                'post_mime_type' => 'image/png',
                'post_title'     => $filename,
                'post_content'   => '',
                'post_status'    => 'inherit'
            );


            // Insert the attachment.
            $attach_id[ $file['number'] ] = wp_insert_attachment( $attachment, $filename);
        }
        return $html;
    }

    /*
     * Resets the if option for groups
     *
     * @return string
     *
     */
    public function reset_photos () {
        delete_option('add_photos');
        $html = $this->add_photos_once();
        return $html;
    }


}