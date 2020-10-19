<?php

class DT_Demo_Data {

    public function __construct() {

    }


    public static function install_data() {
        global $wpdb;
        $db_name = DB_NAME;

        // Get SQL queries
        $path = plugin_dir_path( __DIR__ );
        $sql['dt_activity_log'] = file_get_contents( $path  . "sql/dt_activity_log.sql" );
        $sql['dt_share'] = file_get_contents( $path  . "sql/dt_share.sql" );
        $sql['dt_notifications'] = file_get_contents( $path  . "sql/dt_notifications.sql" );
        $sql['comments'] = file_get_contents( $path  . "sql/comments.sql" );
        $sql['commentmeta'] = file_get_contents( $path  . "sql/commentmeta.sql" );
        $sql['p2p'] = file_get_contents( $path  . "sql/p2p.sql" );
        $sql['p2pmeta'] = file_get_contents( $path  . "sql/p2pmeta.sql" );
        $sql['posts'] = file_get_contents( $path  . "sql/posts.sql" );
        $sql['postmeta'] = file_get_contents( $path  . "sql/postmeta.sql" );
        $sql['usermeta'] = file_get_contents( $path  . "sql/usermeta.sql" );
        $sql['users'] = file_get_contents( $path  . "sql/users.sql" );

        /** START PRE-PROCESSING */

        // update table names
        foreach ( $sql as $key => $query ) {
            if ( 'users' === $key || 'usermeta' === $key ) {
                $sql[$key] = str_replace( "dt14330_", $wpdb->base_prefix, $query );
            } else {
                $sql[$key] = str_replace( "dt14330_", $wpdb->prefix, $query );
            }
        }

        // replace email addresses to unique addresses
        $sample_addresses = [
            'marketer1@disciple.tools',
            'marketer2@disciple.tools',
            'dispatcher1@disciple.tools',
            'dispatcher2@disciple.tools',
            'multiplier1@disciple.tools',
            'multiplier2@disciple.tools',
            'multiplier3@disciple.tools',
            'multiplier4@disciple.tools',
        ];
        foreach ( $sample_addresses as $value ) {
            foreach ( $sql as $key => $query ) {
                $sql[$key] = str_replace( $value, $value . get_current_blog_id() . '.com', $query );
            }
        }

        // Update ID's
        // sample data start and finish ids
        $demo_range['users'] = [ 1004, 1011 ];
        $demo_range['usermeta'] = [ 10049, 10324 ];
        $demo_range['posts'] = [ 10006, 10110 ];
        $demo_range['postmeta'] = [ 100018, 101288 ];
        $demo_range['p2p'] = [ 10001, 10126 ];
        $demo_range['p2pmeta'] = [ 10001, 10165 ];
        $demo_range['dt_share'] = [ 10001, 10124 ];
        $demo_range['dt_notifications'] = [ 10001, 10304 ];
        $demo_range['dt_activity_log'] = [ 100002, 107338 ];
        $demo_range['comments'] = [ 10002, 10240 ];
        $demo_range['commentmeta'] = [ 200005, 200243 ];

        // Get auto-increments
        $next_id['dt_activity_log'] = ( (int) $wpdb->get_var( "SELECT MAX(histid) FROM $wpdb->dt_activity_log" ) ?? 100 ) + 1;
        $next_id['dt_notifications'] = ( (int) $wpdb->get_var( "SELECT MAX(id) FROM $wpdb->dt_notifications" ) ?? 100 ) + 1;
        $next_id['dt_share'] = ( (int) $wpdb->get_var( "SELECT MAX(id) FROM $wpdb->dt_share" ) ?? 100 ) + 1;
        $next_id['comments'] = ( (int) $wpdb->get_var( "SELECT MAX(comment_ID) FROM $wpdb->comments" ) ?? 100 ) + 1;
        $next_id['commentmeta'] = ( (int) $wpdb->get_var( "SELECT MAX(meta_id) FROM $wpdb->commentmeta" ) ?? 100 ) + 1;
        $next_id['p2p'] = ( (int) $wpdb->get_var( "SELECT MAX(p2p_id) FROM $wpdb->p2p" ) ?? 100 ) + 1;
        $next_id['p2pmeta'] = ( (int) $wpdb->get_var( "SELECT MAX(meta_id) FROM $wpdb->p2pmeta" ) ?? 100 ) + 1;
        $next_id['postmeta'] = ( (int) $wpdb->get_var( "SELECT MAX(meta_id) FROM $wpdb->postmeta" ) ?? 100 ) + 1;
        $next_id['usermeta'] = ( (int) $wpdb->get_var( "SELECT MAX(umeta_id) FROM $wpdb->usermeta" ) ?? 100 ) + 1;
        $next_id['posts'] = ( (int) $wpdb->get_var( "SELECT MAX(ID) FROM $wpdb->posts" ) ?? 100 ) + 1;
        $next_id['users'] = ( (int) $wpdb->get_var( "SELECT MAX(ID) FROM $wpdb->users" ) ?? 100 ) + 1;

        // update user ids
        $demo = $demo_range['users'][0];
        $next = $next_id['users'];
        $assign_to_site = [];
        for ( $i = $demo_range['users'][0]; $i <= $demo_range['users'][1]; $i++) {
            $sql['users'] = str_replace( '('.$demo . ',', '('.$next . ',', $sql['users'] );
            foreach ( $sql as $key => $query ) {
                $sql[$key] = str_replace( ' '.$demo . ',', ' '.$next . ',', $sql[$key] );
                $sql[$key] = str_replace( 'user-'.$demo, 'user-'.$next, $sql[$key] );
            }
            $sql['comments'] = str_replace( ' '.$demo.')', ' '.$next.')', $sql['comments'] );
            $sql['postmeta'] = str_replace( 'user-'.$demo, 'user-'.$next, $sql['postmeta'] );
            $sql['postmeta'] = str_replace( 'corresponds_to_user\', \''.$demo, 'corresponds_to_user\', \''.$next, $sql['postmeta'] );

            $assign_to_site[] = $next;

            $demo++;
            $next++;
        }

        // updates usermeta
        $demo = $demo_range['usermeta'][0];
        $next = $next_id['usermeta'];
        for ( $i = $demo_range['usermeta'][0]; $i <= $demo_range['usermeta'][1]; $i++) {
            $sql['usermeta'] = str_replace( '('.$demo . ',', '('. $next . ',', $sql['usermeta'] );

            $demo++;
            $next++;
        }

        // update id p2pmeta
        $demo = $demo_range['p2pmeta'][0];
        $next = $next_id['p2pmeta'] ?: 1;
        for ( $i = $demo_range['p2pmeta'][0]; $i <= $demo_range['p2pmeta'][1]; $i++) {
            $sql['p2pmeta'] = str_replace( '('.$demo . ',', '('.$next . ',', $sql['p2pmeta'] );
            $demo++;
            $next++;
        }

        // update id p2p
        $demo = $demo_range['p2p'][0];
        $next = $next_id['p2p'] ?: 1;
        for ( $i = $demo_range['p2p'][0]; $i <= $demo_range['p2p'][1]; $i++) {
            $sql['p2p'] = str_replace( '('.$demo . ',', '('.$next . ',', $sql['p2p'] );
            $sql['p2pmeta'] = str_replace( ' '.$demo . ',', ' '.$next . ',', $sql['p2pmeta'] );
            $demo++;
            $next++;
        }


        // updates posts
        $demo = $demo_range['posts'][0];
        $next = $next_id['posts'];
        for ( $i = $demo_range['posts'][0]; $i <= $demo_range['posts'][1]; $i++) {
            $sql['posts'] = str_replace( '('.$demo . ',', '('.$next . ',', $sql['posts'] );
            $sql['postmeta'] = str_replace( $demo . ', ', $next . ', ', $sql['postmeta'] );
            $sql['p2p'] = str_replace( ' '.$demo . ',', ' '.$next . ',', $sql['p2p'] );
            $sql['dt_share'] = str_replace( ' '.$demo . ',', ' '.$next . ',', $sql['dt_share'] );
            $sql['dt_activity_log'] = str_replace( ' '.$demo . ',', ' '.$next . ',', $sql['dt_activity_log'] );
            $sql['dt_activity_log'] = str_replace( ' \''.$demo . '\',', ' \''.$next . '\',', $sql['dt_activity_log'] );
            $sql['dt_notifications'] = str_replace( ' '.$demo . ',', ' '.$next . ',', $sql['dt_notifications'] );
            $sql['comments'] = str_replace( ' '.$demo . ',', ' '.$next . ',', $sql['comments'] );

            $demo++;
            $next++;
        }

        // update id share
        $demo = $demo_range['dt_share'][0];
        $next = $next_id['dt_share'];
        for ( $i = $demo_range['dt_share'][0]; $i <= $demo_range['dt_share'][1]; $i++) {
            $sql['dt_share'] = str_replace( '('.$demo . ',', '('.$next . ',', $sql['dt_share'] );
            $demo++;
            $next++;
        }

        // update id notifications
        $demo = $demo_range['dt_notifications'][0];
        $next = $next_id['dt_notifications'];
        for ( $i = $demo_range['dt_notifications'][0]; $i <= $demo_range['dt_notifications'][1]; $i++) {
            $sql['dt_notifications'] = str_replace( '('.$demo . ',', '('.$next . ',', $sql['dt_notifications'] );
            $demo++;
            $next++;
        }

        // update id dt_activity_log
        $demo = $demo_range['dt_activity_log'][0];
        $next = $next_id['dt_activity_log'];
        for ( $i = $demo_range['dt_activity_log'][0]; $i <= $demo_range['dt_activity_log'][1]; $i++) {
            $sql['dt_activity_log'] = str_replace( '('.$demo . ',', '('.$next . ',', $sql['dt_activity_log'] );
            $demo++;
            $next++;
        }

        // update id postmeta
        $demo = $demo_range['postmeta'][0];
        $next = $next_id['postmeta'];
        for ( $i = $demo_range['postmeta'][0]; $i <= $demo_range['postmeta'][1]; $i++) {
            $sql['postmeta'] = str_replace( '('.$demo . ',', '('.$next . ',', $sql['postmeta'] );
            $demo++;
            $next++;
        }

        // update id comments
        $demo = $demo_range['comments'][0];
        $next = $next_id['comments'];
        for ( $i = $demo_range['comments'][0]; $i <= $demo_range['comments'][1]; $i++) {
            $sql['comments'] = str_replace( '('.$demo . ',', '('.$next . ',', $sql['comments'] );
            $sql['commentmeta'] = str_replace( ' '.$demo . ',', ' '.$next . ',', $sql['commentmeta'] );
            $demo++;
            $next++;
        }

        $demo = $demo_range['commentmeta'][0];
        $next = $next_id['commentmeta'];
        for ( $i = $demo_range['commentmeta'][0]; $i <= $demo_range['commentmeta'][1]; $i++) {
            $sql['commentmeta'] = str_replace( '('.$demo . ',', '('.$next . ',', $sql['commentmeta'] );
            $demo++;
            $next++;
        }


        // Insert processed queries

        // phpcs:disable
        $result[] = $wpdb->query( $sql['users'] );
        $result[] = $wpdb->query( $sql['usermeta'] );
        $result[] = $wpdb->query( $sql['posts'] );
        $result[] = $wpdb->query( $sql['postmeta'] );
        $result[] = $wpdb->query( $sql['p2p'] );
        $result[] = $wpdb->query( $sql['p2pmeta'] );
        $result[] = $wpdb->query( $sql['dt_share'] );
        $result[] = $wpdb->query( $sql['dt_activity_log'] );
        $result[] = $wpdb->query( $sql['dt_notifications'] );
        $result[] = $wpdb->query( $sql['comments'] );
        $result[] = $wpdb->query( $sql['commentmeta'] );
        // phpcs:enable

        // Add users to site if multisite
        if ( is_multisite() ) {
            foreach ( $assign_to_site as $user_id ) {
                $user_object = get_userdata( $user_id );
                if ( $user_object->user_login === 'dispatcher1' || $user_object->user_login === 'dispatcher2' ) {
                    $role = 'dispatcher';
                } elseif ( $user_object->user_login === 'marketer1' || $user_object->user_login === 'marketer2' ) {
                    $role = 'marketer';
                } else {
                    $role = 'multiplier';
                }

                remove_user_from_blog( $user_id, get_network()->site_id );
                add_user_to_blog( get_current_blog_id(), $user_id, $role );
            }
        }


        // Add shared contacts
        $active_contacts = $wpdb->get_col( "SELECT ID FROM $wpdb->posts WHERE post_type = 'contacts' AND ID IN ( SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'overall_status' AND meta_value = 'active' )" );
        $i = 0;
        foreach ( $active_contacts as $contact_id ) {
            DT_Posts::add_shared( 'contacts', $contact_id, get_current_user_id(), $meta = null, true, false );
            if ( $i === 10 ) {
                break;
            }
            $i++;
        }

        $active_contacts = $wpdb->get_col( "SELECT ID FROM $wpdb->posts WHERE post_type = 'contacts' AND ID IN ( SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'overall_status' AND meta_value = 'unassigned' )" );
        $i = 0;
        foreach ( $active_contacts as $contact_id ) {
            $fields = [
                "assigned_to" => get_current_user_id(),
                "overall_status" => "active",
            ];
            DT_Posts::update_post( "contacts", $contact_id, $fields, false );
            update_post_meta( $contact_id, 'accepted', 'yes' );

            if ( $i === 5 ) {
                break;
            }
            $i++;
        }

        update_option( 'dt_demo_sample_data', 1, false );
        update_option( 'dt_demo_hide_popup', 1, false );

        //revert to a migration number before the demo data was made.
        //this way any data changes will be applied to the demo data.
        update_option( 'dt_migration_number', 7 );

        dt_write_log( __METHOD__ );
        dt_write_log( $result );

        return $result;

    }

    public static function delete_prepared_demo_data(){

        global $wpdb;
        $result = [];

        require_once( ABSPATH.'wp-admin/includes/user.php' );
        $users = get_users( [ 'search' => '*@disciple.tools'.get_current_blog_id() . '.com' ] );
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
            $result[] = Disciple_Tools_Posts::delete_post( $post->ID, $post->post_type );
        }

        $wpdb->query( "DELETE FROM $wpdb->comments WHERE comment_ID IN (SELECT comment_id FROM $wpdb->commentmeta WHERE meta_key = '_sample');" );
        $wpdb->query( "DELETE FROM $wpdb->commentmeta WHERE meta_key = '_sample'" );

        delete_option( 'dt_demo_sample_data' );

        dt_write_log( __METHOD__ );
        dt_write_log( $result );

        return true;
    }


    public static function install_test_data(){
        $modules = dt_get_option( "dt_post_type_modules" );
        if ( empty( $modules["access_module"]["enabled"] ) ){
            return;
        }
        $multiplier1 = Disciple_Tools_Users::create_user( "multiplier_1", "multiplier1@disciple.tools" . get_current_blog_id() . '.com', "Multiplier 1" );
        $multiplier2 = Disciple_Tools_Users::create_user( "multiplier_2", "multiplier2@disciple.tools" . get_current_blog_id() . '.com', "Multiplier 2" );
        $dispatcher1 = Disciple_Tools_Users::create_user( "dispatcher_1", "dispatcher1@disciple.tools" . get_current_blog_id() . '.com', "Dispatcher 1" );
        $dispatcher2 = Disciple_Tools_Users::create_user( "dispatcher_2", "dispatcher2@disciple.tools" . get_current_blog_id() . '.com', "Dispatcher 2" );

        $user = get_user_by( 'id', $dispatcher1 );
        $user->add_role( "dispatcher" );
        wp_update_user( $user );
        $user = get_user_by( 'id', $dispatcher2 );
        $user->add_role( "dispatcher" );
        wp_update_user( $user );

        wp_set_current_user( $multiplier1 );
        DT_Posts::create_post( "contacts", [ "name" => "Personal 1", "type" => "personal" ] );
        DT_Posts::create_post( "contacts", [ "name" => "Personal 2", "type" => "personal" ] );
        $contact = DT_Posts::create_post( "contacts", [ "name" => "Personal 3", "type" => "personal" ] );
        DT_Posts::create_post( "contacts", [ "name" => "Connection 1", "type" => "placeholder", "baptized" => [ "values" => [ [ "value" => $contact["ID"] ] ] ] ] );
        DT_Posts::create_post( "contacts", [ "name" => "Connection 2", "type" => "placeholder", "baptized_by" => [ "values" => [ [ "value" => $contact["ID"] ] ] ] ] );
        DT_Posts::create_post( "contacts", [ "name" => "Access 1", "type" => "access", "sources" => [ "values" => [ [ "value" => "personal" ] ] ], "seeker_path" => "ongoing"] );
        DT_Posts::create_post( "contacts", [ "name" => "Access 2", "type" => "access", "sources" => [ "values" => [ [ "value" => "web" ] ] ], "overall_status" => "active" ] );
        DT_Posts::create_post( "contacts", [ "name" => "Access 2.1", "type" => "access", "sources" => [ "values" => [ [ "value" => "web" ] ] ], "overall_status" => "active", "requires_update" => true ] );
        DT_Posts::create_post( "contacts", [ "name" => "Access 3", "type" => "access", "sources" => [ "values" => [ [ "value" => "web" ] ] ], "overall_status" => "paused" ] );
        DT_Posts::create_post( "contacts", [ "name" => "Access 4", "type" => "access", "sources" => [ "values" => [ [ "value" => "web" ] ] ], "overall_status" => "assigned" ] );
        DT_Posts::create_post( "contacts", [ "name" => "Access 5", "type" => "access", "sources" => [ "values" => [ [ "value" => "web" ] ] ], "seeker_path" => "met" ] );


        wp_set_current_user( $multiplier2 );
        DT_Posts::create_post( "contacts", [ "name" => "Personal 1", "type" => "personal" ] );
        DT_Posts::create_post( "contacts", [ "name" => "Personal 2", "type" => "personal" ] );
        $contact = DT_Posts::create_post( "contacts", [ "name" => "Personal 3", "type" => "personal" ] );
        DT_Posts::create_post( "contacts", [ "name" => "Connection 1", "type" => "placeholder", "baptized" => [ "values" => [ [ "value" => $contact["ID"] ] ] ] ] );
        DT_Posts::create_post( "contacts", [ "name" => "Connection 2", "type" => "placeholder", "baptized_by" => [ "values" => [ [ "value" => $contact["ID"] ] ] ] ] );


        wp_set_current_user( $dispatcher1 );
        DT_Posts::create_post( "contacts", [ "name" => "Personal 1", "type" => "personal" ] );
        DT_Posts::create_post( "contacts", [ "name" => "Personal 2", "type" => "personal" ] );
        $contact = DT_Posts::create_post( "contacts", [ "name" => "Personal 3", "type" => "personal" ] );
        DT_Posts::create_post( "contacts", [ "name" => "Connection 1", "type" => "placeholder", "baptized" => [ "values" => [ [ "value" => $contact["ID"] ] ] ] ] );
        DT_Posts::create_post( "contacts", [ "name" => "Connection 2", "type" => "placeholder", "baptized_by" => [ "values" => [ [ "value" => $contact["ID"] ] ] ] ] );
        DT_Posts::create_post( "contacts", [ "name" => "Access 10", "type" => "access", "sources" => [ "values" => [ [ "value" => "personal" ] ] ] ] );
        DT_Posts::create_post( "contacts", [ "name" => "Access 11", "type" => "access", "sources" => [ "values" => [ [ "value" => "web" ] ] ], "overall_status" => "active" ] );
        DT_Posts::create_post( "contacts", [ "name" => "Access 12", "type" => "access", "sources" => [ "values" => [ [ "value" => "web" ] ] ], "overall_status" => "active", "requires_update" => true ] );
        DT_Posts::create_post( "contacts", [ "name" => "Access 13", "type" => "access", "sources" => [ "values" => [ [ "value" => "web" ] ] ], "overall_status" => "paused" ] );
        DT_Posts::create_post( "contacts", [ "name" => "Access 14", "type" => "access", "sources" => [ "values" => [ [ "value" => "web" ] ] ], "overall_status" => "assigned" ] );
        DT_Posts::create_post( "contacts", [ "name" => "Access 15", "type" => "access", "sources" => [ "values" => [ [ "value" => "web" ] ] ], "overall_status" => "new" ] );
        DT_Posts::create_post( "contacts", [ "name" => "Access 16", "type" => "access", "sources" => [ "values" => [ [ "value" => "web" ] ] ], "overall_status" => "new" ] );
        DT_Posts::create_post( "contacts", [ "name" => "Access 17", "type" => "access", "sources" => [ "values" => [ [ "value" => "web" ] ] ], "overall_status" => "new" ] );
        DT_Posts::create_post( "contacts", [ "name" => "Access 18", "type" => "access", "sources" => [ "values" => [ [ "value" => "web" ] ] ], "overall_status" => "new" ] );


    }
}