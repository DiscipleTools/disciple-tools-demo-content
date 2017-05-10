<?php

/**
 * dt_training_progress_post
 *
 * @class dt_training_progress_post
 * @version	0.1
 * @since 0.1
 * @package	Disciple_Tools
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class dt_training_progress_post {

    /**
     * dt_training_progress_post The single instance of dt_training_progress_post.
     * @var 	object
     * @access  private
     * @since 	0.1
     */
    private static $_instance = null;

    /**
     * Main dt_training_progress_post Instance
     *
     * Ensures only one instance of dt_training_progress_post is loaded or can be loaded.
     *
     * @since 0.1
     * @static
     * @return dt_training_progress_post instance
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
    public function __construct () {     } // End __construct()

    /**
     * Loops location creation according to supplied $count.
     * @param $count    int Number of records to create.
     * @return string
     */
    public function add_progress_posts_by_count ($count)
    {
        $i = 0;
        while ($count > $i ) {

            $post = $this->single_random_progress_post ();
            $post_id = wp_insert_post($post);

            $file = plugin_dir_path(__DIR__) . 'img/progress/p4t-'.rand(1, 15).'.jpg';
            $this->upload_image_with_post($post_id, $file);

            $i++;
        }
        return $count . ' records created';
    }

    /**
     * Builds a single random location record.
     * @return array|WP_Post
     */
    public function single_random_progress_post () {

        $post = array(
            "post_title" => dt_training_random_word () . " " . dt_training_random_word () . " " . dt_training_random_word () . " " . dt_training_random_word (),//dt_training_random_title (),
            'post_type' => 'progress',
            "post_content" => dt_training_loren_ipsum (),
            "post_status" => "publish",
            "post_author" => get_current_user_id(),
            'meta_input' => array(
                '_sample' => 'sample'
            ),
        );

        return $post;
    }

    public function upload_image_with_post ($parent_post_id, $file) {

        $filename = basename($file);
        $upload_file = wp_upload_bits($filename, null, file_get_contents($file));
        if (!$upload_file['error']) {
            $wp_filetype = wp_check_filetype($filename, null );
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_parent' => $parent_post_id,
                'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
                'post_content' => '',
                'post_status' => 'inherit',
                'meta_input' => array(
                    '_sample' => 'sample'
                ),
            );
            $attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $parent_post_id );
            if (! is_wp_error($attachment_id)) {
                require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                $attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
                wp_update_attachment_metadata( $attachment_id,  $attachment_data );

                set_post_thumbnail( $parent_post_id, $attachment_id );
            }
        }
    }

    /**
     * Delete all progress posts in database
     * @return string
     */
    public function delete_prayer_posts () {

        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'prayer',
            'meta_key'    => '_sample',
            'meta_value'    => 'sample'
        );
        $contacts = get_posts( $args );

        foreach ($contacts as $contact) {
            $id = $contact->ID;


            wp_delete_post( $id, 'true');
        }

        return 'Contacts deleted';

    }

}