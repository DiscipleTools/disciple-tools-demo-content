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

    public function add_prepare_demo_data(){
        global $wpdb;
        //check for existing indexes
        $existing = [];
        $existing[] = $wpdb->query( "SELECT * FROM $wpdb->posts WHERE `ID` >= 10001" );
        $existing[] = $wpdb->query( "SELECT * FROM $wpdb->postmeta WHERE `meta_id` >= 100001" );
        $existing[] = $wpdb->query( "SELECT * FROM $wpdb->users WHERE `ID` >= 1001" );
        $existing[] = $wpdb->query( "SELECT * FROM $wpdb->usermeta WHERE `umeta_id` >= 10001" );
        $existing[] = $wpdb->query( "SELECT * FROM $wpdb->comments WHERE `comment_ID` >= 10001" );
        $existing[] = $wpdb->query( "SELECT * FROM $wpdb->dt_activity_log WHERE `histid` >= 10001" );
        $existing[] = $wpdb->query( "SELECT * FROM $wpdb->dt_notifications WHERE `id` >= 10001" );
        $existing[] = $wpdb->query( "SELECT * FROM $wpdb->dt_share WHERE `id` >= 10001" );
        $existing[] = $wpdb->query( "SELECT * FROM $wpdb->p2p WHERE `p2p_id` >= 10001" );
        $existing[] = $wpdb->query( "SELECT * FROM " . $wpdb->prefix . "p2pmeta WHERE `meta_id` >= 10001" );

        $database_clear = true;
        foreach ( $existing as $query ){
            if ( $query > 0 ){
                $database_clear = false;
            }
        }
        if ( $database_clear ){
            $path = plugin_dir_path( __DIR__ );
            $sql = file_get_contents( $path  . "admin/demo_data.sql" );
            $sql = str_replace( "dt14330_", $wpdb->prefix, $sql );
            $sql = str_replace( "Database: `wordpress`", "Database: `" . DB_NAME . "``", $sql );

            // @codingStandardsIgnoreLine
            $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
            /* check connection */
            // @codingStandardsIgnoreLine
            if ( mysqli_connect_errno() ) {
                return false;
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
            }
        } else {
            return false;
        }
        return true;
    }
}