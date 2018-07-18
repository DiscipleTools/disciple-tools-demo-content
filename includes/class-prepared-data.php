<?php

class DT_Demo_Prepared_Data
{
    private static $_instance = null;
    public static function instance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public static function check_if_database_clear() {
        global $wpdb;
        //check for existing indexes
        $existing = [];
        $existing[] = $wpdb->get_var( "SELECT COUNT(`ID`) FROM $wpdb->posts WHERE `ID` >= 10001" );
        $existing[] = $wpdb->get_var( "SELECT COUNT(`meta_id`) FROM $wpdb->postmeta WHERE `meta_id` >= 100001" );
        $existing[] = $wpdb->get_var( "SELECT COUNT(`ID`) FROM $wpdb->users WHERE `ID` >= 1001" );
        $existing[] = $wpdb->get_var( "SELECT COUNT(`umeta_id`) FROM $wpdb->usermeta WHERE `umeta_id` >= 10001" );
        $existing[] = $wpdb->get_var( "SELECT COUNT(`comment_ID`) FROM $wpdb->comments WHERE `comment_ID` >= 10001" );
        $existing[] = $wpdb->get_var( "SELECT COUNT(`histid`) FROM $wpdb->dt_activity_log WHERE `histid` >= 10001" );
        $existing[] = $wpdb->get_var( "SELECT COUNT(`id`) FROM $wpdb->dt_notifications WHERE `id` >= 10001" );
        $existing[] = $wpdb->get_var( "SELECT COUNT(`id`) FROM $wpdb->dt_share WHERE `id` >= 10001" );
        $existing[] = $wpdb->get_var( "SELECT COUNT(`p2p_id`) FROM $wpdb->p2p WHERE `p2p_id` >= 10001" );
        $existing[] = $wpdb->get_var( "SELECT COUNT(`meta_id`) FROM " . $wpdb->prefix . "p2pmeta WHERE `meta_id` >= 10001" );
        $database_clear = true;
        foreach ( $existing as $query ){
            if ( $query > 0 ){
                $database_clear = false;
            }
        }
        return $database_clear;
    }

    public function add_prepared_demo_data(){

        if ( self::check_if_database_clear() ){
            global $wpdb;

            $path = plugin_dir_path( __DIR__ );
            $sql = file_get_contents( $path  . "sql/source/demo_data.sql" );

            // replace table names
            $sql = str_replace( "dt14330_users", $wpdb->users, $sql ); // targets renaming users table
            $sql = str_replace( "dt14330_usermeta", $wpdb->usermeta, $sql ); // targets renaming of usermeta table
            $sql = str_replace( "dt14330_", $wpdb->prefix, $sql ); // replaces all other table names
            $sql = str_replace( "Database: `wordpress`", "Database: `" . DB_NAME . "``", $sql );

            // replace email addresses to unique addresses
            $sample_addresses = [
                'multiplier2@disciple.tools',
                'marketer1@disciple.tools',
                'dispatcher1@disciple.tools',
                'dispatcher2@disciple.tools',
                'marketer2@disciple.tools',
                'multiplier1@disciple.tools',
                'multiplier3@disciple.tools',
                'multiplier4@disciple.tools',
            ];
            foreach ($sample_addresses as $sample_address ) {
                $sql = str_replace( $sample_address, $wpdb->prefix . $sample_address, $sql );
            }


            // @codingStandardsIgnoreLine
            $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
            /* check connection */
            // @codingStandardsIgnoreLine
            if ( mysqli_connect_errno() ) {
                return new WP_Error( 'something went wrong', __( '<strong>ERROR</strong>: Something went wrong and this tool was not able to run.' ), 400 );
            }


            if ( $mysqli->multi_query( $sql ) ){

                do {
                    /* store first result set */
                    $rs = $mysqli->use_result();
                    // @codingStandardsIgnoreLine
                    if ( $rs instanceof \mysqli_result ) {
                        $rs->free();
                    }
                } while ($mysqli->next_result() && $mysqli->more_results());

                mysqli_close( $mysqli );
                return $rs;
            } else {
                mysqli_close( $mysqli );
                return new WP_Error( 'multi-query', 'Unable to run multi-query' );
            }

        } else {
            return new WP_Error( 'Too many record or records already existing', __( '<strong>ERROR</strong>: You may have too many contacts already or you already ran this tool.' ), 400 );
        }
    }

    public function delete_prepared_demo_data(){

        global $wpdb;

        require_once( ABSPATH.'wp-admin/includes/user.php' );
        $users = get_users( [ 'search' => '*@disciple.tools' ] );
        foreach ( $users as $user ){
            $user_id = $user->ID;
            wp_delete_user( $user_id );
            $wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->dt_activity_log WHERE object_id = %s", $user_id ) );
        }
        $args = array(
            'numberposts'   => -1,
            'post_type'   => [ 'contacts', 'groups', 'locations', 'peoplegroups' ],
            'meta_key'    => '_sample',
            'meta_value'    => 'prepared',
        );
        $posts = get_posts( $args );

        foreach ( $posts as $post ){
            Disciple_Tools_Posts::delete_post( $post->ID, $post->post_type );
        }

        return true;
    }
}