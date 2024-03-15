<?php
declare(strict_types=1);
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/**
 * Class DT_Demo_Data_Migration_0001
 */
class DT_Demo_Data_Migration_0001 extends DT_Demo_Data_Migration {
    /**
     * @throws \Exception  Got error when creating table $name.
     */
    public function up() {
        global $wpdb;
        //replace emails than look like marketer1@disciple.tools22.com to marketer1_22@disciple.tools
        $current_bad = '@disciple.tools' . get_current_blog_id() . '.com';
        $current_good = '_' . get_current_blog_id() . '@disciple.tools';
        $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->users SET user_email = REPLACE(user_email, %s, %s)", $current_bad, $current_good ) );
    }

    /**
     * @throws \Exception  Got error when dropping table $name.
     */
    public function down() {
    }

    /**
     * Test function
     */
    public function test() {
    }

}
