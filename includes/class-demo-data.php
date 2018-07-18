<?php

class DT_Demo_Data {
    /**
     * @return array
     */
    public static function add_demo_users()
    {
        $return = [];
        $meta_key = '_sample';
        $meta_value = 'sample';
        $last_name = substr( sha1( md5( rand() ) ), 0, 5 );
        $users = [
            'marketer',
            'dispatcher',
            'multiplier',
        ];

        foreach( $users as $role ) {

            // create user
            $username = $role . '_' . $last_name;
            $password = uniqid();
            $email = $role . '_' . $last_name . '@discipletools.demo';
            $user_id = wp_create_user( $username, $password, $email );
            if ( is_wp_error( $user_id ) ) {
                $last_name = substr( uniqid(), 0, 5 );
                $user_id = wp_create_user( $username, $password, $email );
                if ( is_wp_error( $user_id ) ) {
                    dt_write_log( $user_id );
                    break;
                }
            }

            // set the nickname
            wp_update_user(
                [
                    'ID'         => $user_id,
                    'nickname'   => ucwords( $role ),
                    'first_name' => ucwords( $role )
                ]
            );

            // add sample tag
            update_user_meta( $user_id, $meta_key, $meta_value );

            // set the role
            $user = new WP_User( $user_id );
            $user->set_role( $role );

            if ( is_multisite() ) {
                add_user_to_blog( get_current_blog_id(), $user_id, $role );
            }

            $return[] = $user;
        }
        return $return;

    }

    public static function delete_demo_users () {
        if (get_user_by( 'id', '1' )) {
            $reassign = '1';
        } else {
            $reassign = get_current_user_id();
        }

        $args = array(
            'meta_key'     => '_sample',
            'meta_value'   => 'sample',
        );
        $records = get_users( $args );

        foreach ($records as $record) {
            $id = $record->ID;
            wp_delete_user( $id, $reassign );
        }
        delete_option( 'add_sample_users' );

        return 'Records deleted';

    }

    public static function install_prepared_locations() {
        global $wpdb;

        $path = plugin_dir_path( __DIR__ );
        $sql = file_get_contents( $path  . "admin/demo_data.sql" );

        $sql = "INSERT INTO dt14330_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES
          (1429, 3, '2018-07-05 18:07:40', '2018-07-05 18:07:40', '', 'Spain', '', 'publish', 'closed', 'closed', '', 'spain', '', '', '2018-07-05 18:07:40', '2018-07-05 18:07:40', '', 0, 'https://demodata.dtorg/locations/spain/', 0, 'locations', '', 0),
          (1430, 3, '2018-07-05 18:07:40', '2018-07-05 18:07:40', '', 'Galicia', '', 'publish', 'closed', 'closed', '', 'galicia', '', '', '2018-07-05 18:07:40', '2018-07-05 18:07:40', '', 1429, 'https://demodata.dtorg/locations/spain/galicia/', 0, 'locations', '', 0),
          (1431, 3, '2018-07-05 18:07:44', '2018-07-05 18:07:44', '', 'Basque Country', '', 'publish', 'closed', 'closed', '', 'basque-country', '', '', '2018-07-05 18:07:44', '2018-07-05 18:07:44', '', 1429, 'https://demodata.dtorg/locations/spain/basque-country/', 0, 'locations', '', 0),
          (1432, 3, '2018-07-05 18:07:44', '2018-07-05 18:07:44', '', 'Castile-La Mancha', '', 'publish', 'closed', 'closed', '', 'castile-la-mancha', '', '', '2018-07-05 18:07:44', '2018-07-05 18:07:44', '', 1429, 'https://demodata.dtorg/locations/spain/castile-la-mancha/', 0, 'locations', '', 0),
          (1433, 3, '2018-07-05 18:07:45', '2018-07-05 18:07:45', '', 'Valencian Community', '', 'publish', 'closed', 'closed', '', 'valencian-community', '', '', '2018-07-05 18:07:45', '2018-07-05 18:07:45', '', 1429, 'https://demodata.dtorg/locations/spain/valencian-community/', 0, 'locations', '', 0),
          (1434, 3, '2018-07-05 18:07:45', '2018-07-05 18:07:45', '', 'Andalusia', '', 'publish', 'closed', 'closed', '', 'andalusia', '', '', '2018-07-05 18:07:45', '2018-07-05 18:07:45', '', 1429, 'https://demodata.dtorg/locations/spain/andalusia/', 0, 'locations', '', 0),
          (1435, 3, '2018-07-05 18:07:46', '2018-07-05 18:07:46', '', 'Castile and León', '', 'publish', 'closed', 'closed', '', 'castile-and-leon', '', '', '2018-07-05 18:07:46', '2018-07-05 18:07:46', '', 1429, 'https://demodata.dtorg/locations/spain/castile-and-leon/', 0, 'locations', '', 0),
          (1436, 3, '2018-07-05 18:07:47', '2018-07-05 18:07:47', '', 'Extremadura', '', 'publish', 'closed', 'closed', '', 'extremadura', '', '', '2018-07-05 18:07:47', '2018-07-05 18:07:47', '', 1429, 'https://demodata.dtorg/locations/spain/extremadura/', 0, 'locations', '', 0),
          (1437, 3, '2018-07-05 18:07:48', '2018-07-05 18:07:48', '', 'Catalonia', '', 'publish', 'closed', 'closed', '', 'catalonia', '', '', '2018-07-05 18:07:48', '2018-07-05 18:07:48', '', 1429, 'https://demodata.dtorg/locations/spain/catalonia/', 0, 'locations', '', 0),
          (1438, 3, '2018-07-05 18:07:55', '2018-07-05 18:07:55', '', 'Aragon', '', 'publish', 'closed', 'closed', '', 'aragon', '', '', '2018-07-05 18:07:55', '2018-07-05 18:07:55', '', 1429, 'https://demodata.dtorg/locations/spain/aragon/', 0, 'locations', '', 0),
          (1439, 3, '2018-07-05 18:07:57', '2018-07-05 18:07:57', '', 'Canary Islands', '', 'publish', 'closed', 'closed', '', 'canary-islands', '', '', '2018-07-05 18:07:57', '2018-07-05 18:07:57', '', 1429, 'https://demodata.dtorg/locations/spain/canary-islands/', 0, 'locations', '', 0),
          (1440, 3, '2018-07-05 18:07:59', '2018-07-05 18:07:59', '', 'Community of Madrid', '', 'publish', 'closed', 'closed', '', 'community-of-madrid', '', '', '2018-07-05 18:07:59', '2018-07-05 18:07:59', '', 1429, 'https://demodata.dtorg/locations/spain/community-of-madrid/', 0, 'locations', '', 0),
          (1441, 3, '2018-07-05 18:21:30', '2018-07-05 18:21:30', '', 'Morocco', '', 'publish', 'closed', 'closed', '', 'morocco', '', '', '2018-07-05 18:21:30', '2018-07-05 18:21:30', '', 0, 'https://demodata.dtorg/locations/morocco/', 0, 'locations', '', 0),
          (1442, 3, '2018-07-05 18:21:31', '2018-07-05 18:21:31', '', 'Casablanca-Settat', '', 'publish', 'closed', 'closed', '', 'casablanca-settat', '', '', '2018-07-05 18:21:31', '2018-07-05 18:21:31', '', 1441, 'https://demodata.dtorg/locations/morocco/casablanca-settat/', 0, 'locations', '', 0),
          (1443, 3, '2018-07-05 18:21:34', '2018-07-05 18:21:34', '', 'Fez-Meknès', '', 'publish', 'closed', 'closed', '', 'fez-meknes', '', '', '2018-07-05 18:21:34', '2018-07-05 18:21:34', '', 1441, 'https://demodata.dtorg/locations/morocco/fez-meknes/', 0, 'locations', '', 0),
          (1444, 3, '2018-07-05 18:21:35', '2018-07-05 18:21:35', '', 'Rabat-Salé-Kénitra', '', 'publish', 'closed', 'closed', '', 'rabat-sale-kenitra', '', '', '2018-07-05 18:21:35', '2018-07-05 18:21:35', '', 1441, 'https://demodata.dtorg/locations/morocco/rabat-sale-kenitra/', 0, 'locations', '', 0),
          (1445, 3, '2018-07-05 18:21:35', '2018-07-05 18:21:35', '', 'Marrakesh-Safi', '', 'publish', 'closed', 'closed', '', 'marrakesh-safi', '', '', '2018-07-05 18:21:35', '2018-07-05 18:21:35', '', 1441, 'https://demodata.dtorg/locations/morocco/marrakesh-safi/', 0, 'locations', '', 0),
          (1446, 3, '2018-07-05 18:21:36', '2018-07-05 18:21:36', '', 'Tangier-Tétouan-Al Hoceima', '', 'publish', 'closed', 'closed', '', 'tangier-tetouan-al-hoceima', '', '', '2018-07-05 18:21:36', '2018-07-05 18:21:36', '', 1441, 'https://demodata.dtorg/locations/morocco/tangier-tetouan-al-hoceima/', 0, 'locations', '', 0),
          (1447, 3, '2018-07-05 18:21:37', '2018-07-05 18:21:37', '', 'Oriental', '', 'publish', 'closed', 'closed', '', 'oriental', '', '', '2018-07-05 18:21:37', '2018-07-05 18:21:37', '', 1441, 'https://demodata.dtorg/locations/morocco/oriental/', 0, 'locations', '', 0),
          (1448, 3, '2018-07-05 18:21:38', '2018-07-05 18:21:38', '', 'Souss-Massa', '', 'publish', 'closed', 'closed', '', 'souss-massa', '', '', '2018-07-05 18:21:38', '2018-07-05 18:21:38', '', 1441, 'https://demodata.dtorg/locations/morocco/souss-massa/', 0, 'locations', '', 0),
          (1449, 3, '2018-07-05 18:21:42', '2018-07-05 18:21:42', '', 'Béni Mellal-Khenifra', '', 'publish', 'closed', 'closed', '', 'beni-mellal-khenifra', '', '', '2018-07-05 18:21:42', '2018-07-05 18:21:42', '', 1441, 'https://demodata.dtorg/locations/morocco/beni-mellal-khenifra/', 0, 'locations', '', 0),
          (1450, 3, '2018-07-05 18:21:47', '2018-07-05 18:21:47', '', 'Guelmim-Oued Noun', '', 'publish', 'closed', 'closed', '', 'guelmim-oued-noun', '', '', '2018-07-05 18:21:47', '2018-07-05 18:21:47', '', 1441, 'https://demodata.dtorg/locations/morocco/guelmim-oued-noun/', 0, 'locations', '', 0),
          (1451, 3, '2018-07-05 18:21:51', '2018-07-05 18:21:51', '', 'Drâa-Tafilalet', '', 'publish', 'closed', 'closed', '', 'draa-tafilalet', '', '', '2018-07-05 18:21:51', '2018-07-05 18:21:51', '', 1441, 'https://demodata.dtorg/locations/morocco/draa-tafilalet/', 0, 'locations', '', 0);";

        $sql2 = "INSERT INTO dt14330_postmeta (meta_id, post_id, meta_key, meta_value) VALUES
          (20661, 1429, 'location_address', 'Spain'),
          (20662, 1429, 'last_modified', '1530814060'),
          (20663, 1429, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:1:{i:0;a:3:{s:9:\"long_name\";s:5:\"Spain\";s:10:\"short_name\";s:2:\"ES\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:5:\"Spain\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:43.8504;s:3:\"lng\";d:4.6362;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:27.4985;s:3:\"lng\";d:-18.2648001;}}s:8:\"location\";a:2:{s:3:\"lat\";d:40.46366700000001;s:3:\"lng\";d:-3.74922;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:45.244;s:3:\"lng\";d:5.098;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:35.17300000000001;s:3:\"lng\";d:-12.524;}}}s:8:\"place_id\";s:27:\"ChIJi7xhMnjjQgwR7KNoB5Qs7KY\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20664, 1429, 'types', 'country'),
          (20665, 1429, 'base_name', 'Spain'),
          (20666, 1430, 'location_address', 'Galicia, Spain'),
          (20667, 1430, 'last_modified', '1530814060'),
          (20668, 1430, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:7:\"Galicia\";s:10:\"short_name\";s:2:\"GA\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:5:\"Spain\";s:10:\"short_name\";s:2:\"ES\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:14:\"Galicia, Spain\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:43.7923795;s:3:\"lng\";d:-6.733953199999999;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:41.8074776;s:3:\"lng\";d:-9.3015156;}}s:8:\"location\";a:2:{s:3:\"lat\";d:42.5750554;s:3:\"lng\";d:-8.1338558;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:43.7923795;s:3:\"lng\";d:-6.733953199999999;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:41.8074776;s:3:\"lng\";d:-9.3015156;}}}s:8:\"place_id\";s:27:\"ChIJaxUIiYZ8Lg0RQpaMEzB5rOE\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20669, 1430, 'types', 'administrative_area_level_1'),
          (20670, 1430, 'base_name', 'Galicia'),
          (20671, 1431, 'location_address', 'Basque Country, Spain'),
          (20672, 1431, 'last_modified', '1530814064'),
          (20673, 1431, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:14:\"Basque Country\";s:10:\"short_name\";s:2:\"PV\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:5:\"Spain\";s:10:\"short_name\";s:2:\"ES\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:21:\"Basque Country, Spain\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:43.4572461;s:3:\"lng\";d:-1.7293434;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:42.4722552;s:3:\"lng\";d:-3.4492758;}}s:8:\"location\";a:2:{s:3:\"lat\";d:42.9896248;s:3:\"lng\";d:-2.6189273;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:43.4572461;s:3:\"lng\";d:-1.7293434;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:42.4722552;s:3:\"lng\";d:-3.4492758;}}}s:8:\"place_id\";s:27:\"ChIJb6xU497RTw0RPL3jSqEwgjA\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20674, 1431, 'types', 'administrative_area_level_1'),
          (20675, 1431, 'base_name', 'Basque Country'),
          (20676, 1432, 'location_address', 'Castile-La Mancha, Spain'),
          (20677, 1432, 'last_modified', '1530814064'),
          (20678, 1432, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:17:\"Castile-La Mancha\";s:10:\"short_name\";s:2:\"CM\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:5:\"Spain\";s:10:\"short_name\";s:2:\"ES\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:24:\"Castile-La Mancha, Spain\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:41.3276321;s:3:\"lng\";d:-0.9157931999999999;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:38.0224402;s:3:\"lng\";d:-5.4061835;}}s:8:\"location\";a:2:{s:3:\"lat\";d:39.2795607;s:3:\"lng\";d:-3.097702;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:41.3276321;s:3:\"lng\";d:-0.9157931999999999;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:38.0224402;s:3:\"lng\";d:-5.4061835;}}}s:8:\"place_id\";s:27:\"ChIJK6f5rcBfZg0R0rZyF5O64Ts\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20679, 1432, 'types', 'administrative_area_level_1'),
          (20680, 1432, 'base_name', 'Castile-La Mancha'),
          (20681, 1433, 'location_address', 'Valencian Community, Spain'),
          (20682, 1433, 'last_modified', '1530814065'),
          (20683, 1433, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:19:\"Valencian Community\";s:10:\"short_name\";s:19:\"Valencian Community\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:5:\"Spain\";s:10:\"short_name\";s:2:\"ES\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:26:\"Valencian Community, Spain\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:40.7886312;s:3:\"lng\";d:0.6912275999999999;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:37.8438987;s:3:\"lng\";d:-1.5289447;}}s:8:\"location\";a:2:{s:3:\"lat\";d:39.4840108;s:3:\"lng\";d:-0.7532808999999999;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:40.7886312;s:3:\"lng\";d:0.6912275999999999;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:37.8438987;s:3:\"lng\";d:-1.5289447;}}}s:8:\"place_id\";s:27:\"ChIJDTGOzUD8XQ0RXQsxGLjLQF8\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20684, 1433, 'types', 'administrative_area_level_1'),
          (20685, 1433, 'base_name', 'Valencian Community'),
          (20686, 1434, 'location_address', 'Andalusia, Spain'),
          (20687, 1434, 'last_modified', '1530814065'),
          (20688, 1434, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:9:\"Andalusia\";s:10:\"short_name\";s:2:\"AL\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:5:\"Spain\";s:10:\"short_name\";s:2:\"ES\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:16:\"Andalusia, Spain\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:38.7290872;s:3:\"lng\";d:-1.6301238;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:35.9376148;s:3:\"lng\";d:-7.522877500000001;}}s:8:\"location\";a:2:{s:3:\"lat\";d:37.5442706;s:3:\"lng\";d:-4.7277528;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:38.7290872;s:3:\"lng\";d:-1.6301238;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:35.9376148;s:3:\"lng\";d:-7.522877500000001;}}}s:8:\"place_id\";s:27:\"ChIJRcWdz7HZEQ0RD_Pxd01lycE\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20689, 1434, 'types', 'administrative_area_level_1'),
          (20690, 1434, 'base_name', 'Andalusia'),
          (20691, 1435, 'location_address', 'Castile and León, Spain'),
          (20692, 1435, 'last_modified', '1530814067'),
          (20693, 1435, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:17:\"Castile and León\";s:10:\"short_name\";s:2:\"CL\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:5:\"Spain\";s:10:\"short_name\";s:2:\"ES\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:24:\"Castile and León, Spain\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:43.2386326;s:3:\"lng\";d:-1.7753716;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:40.0824504;s:3:\"lng\";d:-7.077053599999999;}}s:8:\"location\";a:2:{s:3:\"lat\";d:41.83568210000001;s:3:\"lng\";d:-4.397635699999999;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:43.2386326;s:3:\"lng\";d:-1.7753716;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:40.0824504;s:3:\"lng\";d:-7.077053599999999;}}}s:8:\"place_id\";s:27:\"ChIJ95OAA5CaNw0RpVYFgwZ7npY\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20694, 1435, 'types', 'administrative_area_level_1'),
          (20695, 1435, 'base_name', 'Castile and León'),
          (20696, 1436, 'location_address', 'Extremadura, Spain'),
          (20697, 1436, 'last_modified', '1530814067'),
          (20698, 1436, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:11:\"Extremadura\";s:10:\"short_name\";s:2:\"EX\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:5:\"Spain\";s:10:\"short_name\";s:2:\"ES\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:18:\"Extremadura, Spain\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:40.48665130000001;s:3:\"lng\";d:-4.6475773;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:37.941026;s:3:\"lng\";d:-7.545024799999999;}}s:8:\"location\";a:2:{s:3:\"lat\";d:39.4937392;s:3:\"lng\";d:-6.0679194;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:40.48665130000001;s:3:\"lng\";d:-4.6475773;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:37.941026;s:3:\"lng\";d:-7.545024799999999;}}}s:8:\"place_id\";s:27:\"ChIJly2BrUTKFQ0RMMifjP1jBAE\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20699, 1436, 'types', 'administrative_area_level_1'),
          (20700, 1436, 'base_name', 'Extremadura'),
          (20701, 1437, 'location_address', 'Catalonia, Spain'),
          (20702, 1437, 'last_modified', '1530814068'),
          (20703, 1437, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:9:\"Catalonia\";s:10:\"short_name\";s:2:\"CT\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:5:\"Spain\";s:10:\"short_name\";s:2:\"ES\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:16:\"Catalonia, Spain\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:42.8614502;s:3:\"lng\";d:3.3325539;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:40.5230466;s:3:\"lng\";d:0.1591811;}}s:8:\"location\";a:2:{s:3:\"lat\";d:41.5911589;s:3:\"lng\";d:1.5208624;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:42.8614502;s:3:\"lng\";d:3.3325539;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:40.5230466;s:3:\"lng\";d:0.1591811;}}}s:8:\"place_id\";s:27:\"ChIJ8_UwhdxbpBIRUMijIeD6AAE\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20704, 1437, 'types', 'administrative_area_level_1'),
          (20705, 1437, 'base_name', 'Catalonia'),
          (20706, 1438, 'location_address', 'Aragon, Spain'),
          (20707, 1438, 'last_modified', '1530814075'),
          (20708, 1438, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:6:\"Aragon\";s:10:\"short_name\";s:6:\"Aragon\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:5:\"Spain\";s:10:\"short_name\";s:2:\"ES\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:13:\"Aragon, Spain\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:42.9244952;s:3:\"lng\";d:0.7713066;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:39.846778;s:3:\"lng\";d:-2.1736712;}}s:8:\"location\";a:2:{s:3:\"lat\";d:41.5976275;s:3:\"lng\";d:-0.9056623;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:42.9244952;s:3:\"lng\";d:0.7713066;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:39.846778;s:3:\"lng\";d:-2.1736712;}}}s:8:\"place_id\";s:27:\"ChIJ-W5lP-4UWQ0RWP14-ZVCICA\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20709, 1438, 'types', 'administrative_area_level_1'),
          (20710, 1438, 'base_name', 'Aragon'),
          (20711, 1439, 'location_address', 'Canary Islands, Spain'),
          (20712, 1439, 'last_modified', '1530814077'),
          (20713, 1439, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:14:\"Canary Islands\";s:10:\"short_name\";s:2:\"CN\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:5:\"Spain\";s:10:\"short_name\";s:2:\"ES\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:21:\"Canary Islands, Spain\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:29.4165069;s:3:\"lng\";d:-13.3336473;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:27.6377894;s:3:\"lng\";d:-18.1612216;}}s:8:\"location\";a:2:{s:3:\"lat\";d:28.2915637;s:3:\"lng\";d:-16.6291304;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:29.463514;s:3:\"lng\";d:-13.31543;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:27.425414;s:3:\"lng\";d:-18.391113;}}}s:8:\"place_id\";s:27:\"ChIJY1N174aqQQwRwMhLvvNAAwE\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20714, 1439, 'types', 'administrative_area_level_1'),
          (20715, 1439, 'base_name', 'Canary Islands'),
          (20716, 1440, 'location_address', 'Community of Madrid, Madrid, Spain'),
          (20717, 1440, 'last_modified', '1530814079'),
          (20718, 1440, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:3:{i:0;a:3:{s:9:\"long_name\";s:19:\"Community of Madrid\";s:10:\"short_name\";s:19:\"Community of Madrid\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:6:\"Madrid\";s:10:\"short_name\";s:1:\"M\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_2\";i:1;s:9:\"political\";}}i:2;a:3:{s:9:\"long_name\";s:5:\"Spain\";s:10:\"short_name\";s:2:\"ES\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:34:\"Community of Madrid, Madrid, Spain\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:41.16584470000001;s:3:\"lng\";d:-3.0529833;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:39.8847195;s:3:\"lng\";d:-4.579076;}}s:8:\"location\";a:2:{s:3:\"lat\";d:40.4167515;s:3:\"lng\";d:-3.7038322;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:41.16584470000001;s:3:\"lng\";d:-3.0529833;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:39.8847195;s:3:\"lng\";d:-4.579076;}}}s:8:\"place_id\";s:27:\"ChIJuTPgQHqBQQ0RgMhLvvNAAwE\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20719, 1440, 'types', 'administrative_area_level_1'),
          (20720, 1440, 'base_name', 'Community of Madrid'),
          (20721, 1441, 'location_address', 'Morocco'),
          (20722, 1441, 'last_modified', '1530814890'),
          (20723, 1441, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:1:{i:0;a:3:{s:9:\"long_name\";s:7:\"Morocco\";s:10:\"short_name\";s:2:\"MA\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:7:\"Morocco\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:35.9344;s:3:\"lng\";d:-0.9969759;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:27.6672693;s:3:\"lng\";d:-13.3044001;}}s:8:\"location\";a:2:{s:3:\"lat\";d:31.791702;s:3:\"lng\";d:-7.092619999999999;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:35.9344;s:3:\"lng\";d:-0.9969759;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:27.6672693;s:3:\"lng\";d:-13.3044001;}}}s:8:\"place_id\";s:27:\"ChIJjcVRlmGICw0Rw_8sxIGT09k\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20724, 1441, 'types', 'country'),
          (20725, 1441, 'base_name', 'Morocco'),
          (20726, 1442, 'location_address', 'Casablanca-Settat, Morocco'),
          (20727, 1442, 'last_modified', '1530814891'),
          (20728, 1442, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:17:\"Casablanca-Settat\";s:10:\"short_name\";s:17:\"Casablanca-Settat\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:7:\"Morocco\";s:10:\"short_name\";s:2:\"MA\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:26:\"Casablanca-Settat, Morocco\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:33.834236;s:3:\"lng\";d:-6.759644;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:32.297336;s:3:\"lng\";d:-9.0495789;}}s:8:\"location\";a:2:{s:3:\"lat\";d:33.2160872;s:3:\"lng\";d:-7.4381355;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:33.834236;s:3:\"lng\";d:-6.759644;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:32.297336;s:3:\"lng\";d:-9.0495789;}}}s:8:\"place_id\";s:27:\"ChIJa3SAOYenqA0RfMKM0QWC8sQ\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20729, 1442, 'types', 'administrative_area_level_1'),
          (20730, 1442, 'base_name', 'Casablanca-Settat'),
          (20731, 1443, 'location_address', 'Fez-Meknès, Morocco'),
          (20732, 1443, 'last_modified', '1530814894'),
          (20733, 1443, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:11:\"Fez-Meknès\";s:10:\"short_name\";s:11:\"Fez-Meknès\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:7:\"Morocco\";s:10:\"short_name\";s:2:\"MA\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:20:\"Fez-Meknès, Morocco\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:34.8939099;s:3:\"lng\";d:-2.898385900000001;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:32.5968559;s:3:\"lng\";d:-5.8797929;}}s:8:\"location\";a:2:{s:3:\"lat\";d:34.062529;s:3:\"lng\";d:-4.7277528;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:34.8939099;s:3:\"lng\";d:-2.898385900000001;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:32.5968559;s:3:\"lng\";d:-5.8797929;}}}s:8:\"place_id\";s:27:\"ChIJ_d-TxGCinw0RxhxhQcd1aNg\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20734, 1443, 'types', 'administrative_area_level_1'),
          (20735, 1443, 'base_name', 'Fez-Meknès'),
          (20736, 1444, 'location_address', 'Rabat-Salé-Kénitra, Morocco'),
          (20737, 1444, 'last_modified', '1530814895'),
          (20738, 1444, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:20:\"Rabat-Salé-Kénitra\";s:10:\"short_name\";s:20:\"Rabat-Salé-Kénitra\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:7:\"Morocco\";s:10:\"short_name\";s:2:\"MA\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:29:\"Rabat-Salé-Kénitra, Morocco\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:35.017924;s:3:\"lng\";d:-5.321245999999999;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:33.145987;s:3:\"lng\";d:-7.1272949;}}s:8:\"location\";a:2:{s:3:\"lat\";d:34.1727659;s:3:\"lng\";d:-6.2375947;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:35.017924;s:3:\"lng\";d:-5.321245999999999;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:33.145987;s:3:\"lng\";d:-7.1272949;}}}s:8:\"place_id\";s:27:\"ChIJ117d5kiloA0RsmDQ33s8ZSY\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20739, 1444, 'types', 'administrative_area_level_1'),
          (20740, 1444, 'base_name', 'Rabat-Salé-Kénitra'),
          (20741, 1445, 'location_address', 'Marrakesh-Safi, Morocco'),
          (20742, 1445, 'last_modified', '1530814896'),
          (20743, 1445, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:14:\"Marrakesh-Safi\";s:10:\"short_name\";s:14:\"Marrakesh-Safi\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:7:\"Morocco\";s:10:\"short_name\";s:2:\"MA\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:23:\"Marrakesh-Safi, Morocco\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:32.814991;s:3:\"lng\";d:-7.0043588;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:30.7801289;s:3:\"lng\";d:-9.84681;}}s:8:\"location\";a:2:{s:3:\"lat\";d:31.7330833;s:3:\"lng\";d:-8.1338558;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:32.814991;s:3:\"lng\";d:-7.0043588;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:30.7801289;s:3:\"lng\";d:-9.84681;}}}s:8:\"place_id\";s:27:\"ChIJJfN_G46_rw0R-dTvWefBibo\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20744, 1445, 'types', 'administrative_area_level_1'),
          (20745, 1445, 'base_name', 'Marrakesh-Safi'),
          (20746, 1446, 'location_address', 'Tangier-Tétouan-Al Hoceima, Morocco'),
          (20747, 1446, 'last_modified', '1530814896'),
          (20748, 1446, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:27:\"Tangier-Tétouan-Al Hoceima\";s:10:\"short_name\";s:27:\"Tangier-Tétouan-Al Hoceima\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:7:\"Morocco\";s:10:\"short_name\";s:2:\"MA\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:36:\"Tangier-Tétouan-Al Hoceima, Morocco\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:35.921981;s:3:\"lng\";d:-3.8006541;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:34.514587;s:3:\"lng\";d:-6.246023099999999;}}s:8:\"location\";a:2:{s:3:\"lat\";d:35.2629558;s:3:\"lng\";d:-5.5617279;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:35.921981;s:3:\"lng\";d:-3.8006541;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:34.514587;s:3:\"lng\";d:-6.246023099999999;}}}s:8:\"place_id\";s:27:\"ChIJUWYCXtceCw0RhEywL-MUH-0\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20749, 1446, 'types', 'administrative_area_level_1'),
          (20750, 1446, 'base_name', 'Tangier-Tétouan-Al Hoceima'),
          (20751, 1447, 'location_address', 'Oriental, Morocco'),
          (20752, 1447, 'last_modified', '1530814898'),
          (20753, 1447, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:8:\"Oriental\";s:10:\"short_name\";s:8:\"Oriental\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:7:\"Morocco\";s:10:\"short_name\";s:2:\"MA\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:17:\"Oriental, Morocco\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:35.4538269;s:3:\"lng\";d:-0.9917419999999998;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:31.699327;s:3:\"lng\";d:-4.1238261;}}s:8:\"location\";a:2:{s:3:\"lat\";d:33.4198879;s:3:\"lng\";d:-2.1450245;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:35.4538269;s:3:\"lng\";d:-0.9917419999999998;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:31.699327;s:3:\"lng\";d:-4.1238261;}}}s:8:\"place_id\";s:27:\"ChIJwxahuPbSnA0Ro--f5kY1M3I\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20754, 1447, 'types', 'administrative_area_level_1'),
          (20755, 1447, 'base_name', 'Oriental'),
          (20756, 1448, 'location_address', 'Souss-Massa, Morocco'),
          (20757, 1448, 'last_modified', '1530814898'),
          (20758, 1448, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:11:\"Souss-Massa\";s:10:\"short_name\";s:11:\"Souss-Massa\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:7:\"Morocco\";s:10:\"short_name\";s:2:\"MA\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:20:\"Souss-Massa, Morocco\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:31.145351;s:3:\"lng\";d:-6.350541;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:28.315216;s:3:\"lng\";d:-10.011106;}}s:8:\"location\";a:2:{s:3:\"lat\";d:30.2750611;s:3:\"lng\";d:-8.1338558;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:31.145351;s:3:\"lng\";d:-6.350541;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:28.315216;s:3:\"lng\";d:-10.011106;}}}s:8:\"place_id\";s:27:\"ChIJ95kt7qwhsQ0R2z94c4GwoJA\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20759, 1448, 'types', 'administrative_area_level_1'),
          (20760, 1448, 'base_name', 'Souss-Massa'),
          (20761, 1449, 'location_address', 'Béni Mellal-Khenifra, Morocco'),
          (20762, 1449, 'last_modified', '1530814902'),
          (20763, 1449, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:21:\"Béni Mellal-Khenifra\";s:10:\"short_name\";s:21:\"Béni Mellal-Khenifra\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:7:\"Morocco\";s:10:\"short_name\";s:2:\"MA\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:30:\"Béni Mellal-Khenifra, Morocco\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:33.4785021;s:3:\"lng\";d:-5.248392099999999;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:31.3386071;s:3:\"lng\";d:-7.320058999999999;}}s:8:\"location\";a:2:{s:3:\"lat\";d:32.5719184;s:3:\"lng\";d:-6.0679194;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:33.4785021;s:3:\"lng\";d:-5.248392099999999;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:31.3386071;s:3:\"lng\";d:-7.320058999999999;}}}s:8:\"place_id\";s:27:\"ChIJUZciCgl4pA0RT-J-Km2IbuA\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20764, 1449, 'types', 'administrative_area_level_1'),
          (20765, 1449, 'base_name', 'Béni Mellal-Khenifra'),
          (20766, 1450, 'location_address', 'Guelmim-Oued Noun, Morocco'),
          (20767, 1450, 'last_modified', '1530814907'),
          (20768, 1450, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:17:\"Guelmim-Oued Noun\";s:10:\"short_name\";s:17:\"Guelmim-Oued Noun\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:7:\"Morocco\";s:10:\"short_name\";s:2:\"MA\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:26:\"Guelmim-Oued Noun, Morocco\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:29.636333;s:3:\"lng\";d:-8.669426;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:27.662115;s:3:\"lng\";d:-11.7837721;}}s:8:\"location\";a:2:{s:3:\"lat\";d:28.4844281;s:3:\"lng\";d:-10.0807298;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:29.636333;s:3:\"lng\";d:-8.669426;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:27.662115;s:3:\"lng\";d:-11.7837721;}}}s:8:\"place_id\";s:27:\"ChIJ2yP13VqctQ0R0sPXYIBMjQQ\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20769, 1450, 'types', 'administrative_area_level_1'),
          (20770, 1450, 'base_name', 'Guelmim-Oued Noun'),
          (20771, 1451, 'location_address', 'Drâa-Tafilalet, Morocco'),
          (20772, 1451, 'last_modified', '1530814911'),
          (20773, 1451, 'raw', 'a:2:{s:7:\"results\";a:1:{i:0;a:5:{s:18:\"address_components\";a:2:{i:0;a:3:{s:9:\"long_name\";s:15:\"Drâa-Tafilalet\";s:10:\"short_name\";s:15:\"Drâa-Tafilalet\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}i:1;a:3:{s:9:\"long_name\";s:7:\"Morocco\";s:10:\"short_name\";s:2:\"MA\";s:5:\"types\";a:2:{i:0;s:7:\"country\";i:1;s:9:\"political\";}}}s:17:\"formatted_address\";s:24:\"Drâa-Tafilalet, Morocco\";s:8:\"geometry\";a:4:{s:6:\"bounds\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:33.095922;s:3:\"lng\";d:-3.11508;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:29.686181;s:3:\"lng\";d:-7.736634;}}s:8:\"location\";a:2:{s:3:\"lat\";d:31.1499538;s:3:\"lng\";d:-5.393955099999999;}s:13:\"location_type\";s:11:\"APPROXIMATE\";s:8:\"viewport\";a:2:{s:9:\"northeast\";a:2:{s:3:\"lat\";d:33.095922;s:3:\"lng\";d:-3.11508;}s:9:\"southwest\";a:2:{s:3:\"lat\";d:29.686181;s:3:\"lng\";d:-7.736634;}}}s:8:\"place_id\";s:27:\"ChIJY0kN5EfpvA0R9JinkcrVwm4\";s:5:\"types\";a:2:{i:0;s:27:\"administrative_area_level_1\";i:1;s:9:\"political\";}}}s:6:\"status\";s:2:\"OK\";}'),
          (20774, 1451, 'types', 'administrative_area_level_1'),
          (20775, 1451, 'base_name', 'Drâa-Tafilalet');";

        // replace table names
        $sql = str_replace( "dt14330_posts", $wpdb->posts, $sql ); // targets renaming users table
        $sql = str_replace( " 3, ", ' '. get_current_user_id() . ', ', $sql );
        $sql2 = str_replace( "dt14330_postmeta", $wpdb->postmeta, $sql2 ); // targets renaming of usermeta table

        // change post records
        $db_name = DB_NAME;
        $last_post_id = $wpdb->get_var( "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = '$wpdb->posts'" );
        if ( ! $last_post_id ) {
            return new WP_Error( __METHOD__, 'Failed to get most recent post_id' );
        }
        $next_post_id = $last_post_id + 1;
        $location_id = 1429;
        while ( $location_id <= 1451 ) {
            $sql = str_replace( $location_id . ',', $next_post_id . ',', $sql );
            $sql2 = str_replace( $location_id . ',', $next_post_id . ',', $sql2 );
            $location_id++;
            $next_post_id++;
        }

        // change postmeta records
        $last_postmeta_id = $wpdb->get_var( "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = '$wpdb->postmeta'" );
        if ( ! $last_postmeta_id ) {
            return new WP_Error( __METHOD__, 'Failed to get most recent post_id' );
        }
        $next_postmeta_id = $last_postmeta_id + 1;
        $locationmeta_id = 20661;
        while ( $locationmeta_id <= 20775 ) {
            $sql2 = str_replace( $locationmeta_id . ',', $next_postmeta_id . ',', $sql2 );
            $locationmeta_id++;
            $next_postmeta_id++;
        }

        $wpdb->query( $sql );
        $wpdb->query( $sql2 );

        return $wpdb->rows_affected;

    }

    public static function single_plain_contact() {
        $name = dt_demo_random_name();

        $post = [
            "title" => $name . ' Contact',
            "contact_phone" => [ "values" => [ [ "value" => dt_demo_random_phone_number()] ] ],
            "contact_email" => [ "values" => [ [ "value" => $name.rand( 1000, 10000 )."@email.com"] ] ],
            "sources" => [ "values" => [ ["value" => 'Facebook'] ] ],
        ];

        return $post;
    }

    public static function create_initial_comments( $contacts, $users ) {
        $comments = 0;
        foreach( $users as $user ) {
            if( $user['roles'] === 'marketer' ) {
                $comment_author_id = $user['ID'];
                break;
            }
        }


        foreach( $contacts as $contact ) {
            $data = array(
                'comment_post_ID' => $contact,
                'comment_author' => $comment_author_id,
                'comment_content' => dt_demo_first_comment(),
                'user_id' => $comment_author_id,
                'comment_approved' => 1,
            );

            $comment_id = wp_insert_comment( $data );
            if ( is_wp_error( $comment_id ) ) {
                dt_write_log( __METHOD__ . ": " . $comment_id );
                continue;
            }
            add_comment_meta( $comment_id,  '_sample', 'sample' );
            $comments++;
        }
        return $comments;
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
        $sql['p2p'] = file_get_contents( $path  . "sql/p2p.sql" );
        $sql['p2pmeta'] = file_get_contents( $path  . "sql/p2pmeta.sql" );
        $sql['posts'] = file_get_contents( $path  . "sql/posts.sql" );
        $sql['postmeta'] = file_get_contents( $path  . "sql/postmeta.sql" );
        $sql['usermeta'] = file_get_contents( $path  . "sql/usermeta.sql" );
        $sql['users'] = file_get_contents( $path  . "sql/users.sql" );

        /** START PRE-PROCESSING */
//        dt_write_log( $sql );

        // update table names
        foreach( $sql as $key => $query ) {
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
        foreach( $sample_addresses as $value ) {
            foreach( $sql as $key => $query ) {
                $sql[$key] = str_replace( $value, $value . get_current_blog_id() . '.com', $query );
            }
        }

        // Update ID's
        // sample data start and finish ids
        $demo_range['users'] = [ 1004, 1011 ];
        $demo_range['usermeta'] = [ 10049, 10324 ];
        $demo_range['posts'] = [ 10004, 10110 ];
        $demo_range['postmeta'] = [ 100004, 101288 ];
        $demo_range['p2p'] = [ 10001, 10126 ];
        $demo_range['p2pmeta'] = [ 10001, 10165 ];
        $demo_range['dt_share'] = [ 10001, 10124 ];
        $demo_range['dt_notifications'] = [ 10001, 10304 ];
        $demo_range['dt_activity_log'] = [ 100002, 107338 ];
        $demo_range['comments'] = [ 10002, 10240 ];

        // Get auto-increments
        $next_id['dt_activity_log'] = $wpdb->get_var( "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = '$wpdb->dt_activity_log'" );
        $next_id['dt_notifications'] = $wpdb->get_var( "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = '$wpdb->dt_notifications'" );
        $next_id['dt_share'] = $wpdb->get_var( "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = '$wpdb->dt_share'" );
        $next_id['comments'] = $wpdb->get_var( "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = '$wpdb->comments'" );
        $next_id['p2p'] = $wpdb->get_var( "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = '$wpdb->p2p'" );
        $next_id['p2pmeta'] = $wpdb->get_var( "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = '$wpdb->p2pmeta'" );
        $next_id['postmeta'] = $wpdb->get_var( "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = '$wpdb->postmeta'" );
        $next_id['posts'] = $wpdb->get_var( "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = '$wpdb->posts'" );
        $next_id['usermeta'] = $wpdb->get_var( "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = '$wpdb->usermeta'" );
        $next_id['users'] = $wpdb->get_var( "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = '$wpdb->users'" );

        // update user ids
        $demo = $demo_range['users'][0];
        $next = $next_id['users'];
        $assign_to_site = [];
        for ( $i = $demo_range['users'][0]; $i <= $demo_range['users'][1]; $i++) {
            $sql['users'] = str_replace( '('.$demo . ',', '('.$next . ',', $sql['users'] );
            foreach( $sql as $key => $query ) {
                $sql[$key] = str_replace( ' '.$demo . ',', ' '.$next . ',', $sql[$key] );
                $sql[$key] = str_replace( 'user-'.$demo, 'user-'.$next, $sql[$key] );
            }
            $sql['comments'] = str_replace( ' '.$demo.')', ' '.$next.')', $sql['comments'] );
//            $sql['postmeta'] = str_replace( "'".$demo."')", "'".$next."')", $sql['postmeta'] );
            $sql['postmeta'] = str_replace( 'user-'.$demo, 'user-'.$next, $sql['postmeta'] );

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
            $demo++;
            $next++;
        }


        // Insert processed queries
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

        // Add users to site if multisite
        if ( is_multisite() ) {
            foreach( $assign_to_site as $user_id ) {
                $user_object = get_userdata( $user_id );
                if ( $user_object->user_login === 'dispatcher1' || $user_object->user_login === 'dispatcher2' ) {
                    $role = 'dispatcher';
                } elseif ( $user_object->user_login === 'marketer1' || $user_object->user_login === 'marketer2' ) {
                    $role = 'marketer';
                } else {
                    $role = 'multiplier';
                }

                add_user_to_blog( get_current_blog_id(), $user_id, $role );
            }
        }


        // Add shared contacts
        $active_contacts = $wpdb->get_col( "SELECT ID FROM $wpdb->posts WHERE post_type = 'contacts' AND ID IN ( SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'overall_status' AND meta_value = 'active' )" );
        $i = 0;
        foreach( $active_contacts as $contact_id ) {
            Disciple_Tools_Posts::add_shared( 'contacts', $contact_id, get_current_user_id(), $meta = null, true, false );
            if( $i === 10 ) {
                break;
            }
            $i++;
        }

        $active_contacts = $wpdb->get_col( "SELECT ID FROM $wpdb->posts WHERE post_type = 'contacts' AND ID IN ( SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'overall_status' AND meta_value = 'unassigned' )" );
        $i = 0;
        foreach( $active_contacts as $contact_id ) {
            $fields = [
                "assigned_to" => get_current_user_id(),
                "overall_status" => "active",
            ];
            Disciple_Tools_Contacts::update_contact( $contact_id, $fields, false );
            update_post_meta( $contact_id, 'accepted', 'yes' );

            if( $i === 5 ) {
                break;
            }
            $i++;
        }

        update_option( 'dt_demo_sample_data', true, false );

        dt_write_log( $result );

        return $result;

    }
}