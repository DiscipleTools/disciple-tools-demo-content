<?php
declare(strict_types=1);
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/**
 * Class DT_Demo_Data_Migration_0002
 *
 * Demo accounts on this site that predate the demo marker get a random password, an undeliverable address and the marker.
 */
class DT_Demo_Data_Migration_0002 extends DT_Demo_Data_Migration {
    public function up() {
        global $wpdb;
        $blog_id = get_current_blog_id();
        $users = $wpdb->get_results( "SELECT ID, user_login, user_email FROM $wpdb->users WHERE user_email LIKE '%@disciple.tools'" );
        foreach ( $users as $user ) {
            $user_id = (int) $user->ID;
            if ( strcasecmp( $user->user_login . '@disciple.tools', $user->user_email ) !== 0 ) {
                continue;
            }
            $installed_here = preg_match( '/^(marketer[12]|dispatcher[12]|multiplier[1-4])_' . $blog_id . '$/', $user->user_login ) === 1;
            $unsuffixed_member = preg_match( '/^(marketer[12]|dispatcher[12]|multiplier\d+)$/', $user->user_login ) === 1 && is_user_member_of_blog( $user_id, $blog_id );
            if ( ! $installed_here && ! $unsuffixed_member ) {
                continue;
            }
            wp_set_password( wp_generate_password( 32, true, true ), $user_id );
            $wpdb->update( $wpdb->users, [ 'user_email' => $user->user_login . '@' . DT_DEMO_USER_EMAIL_DOMAIN ], [ 'ID' => $user_id ] );
            clean_user_cache( $user_id );
            update_user_meta( $user_id, DT_DEMO_USER_META_KEY, $blog_id );
        }
    }

    public function down() {
    }

    public function test() {
    }
}
