<?php
/**
 * These are utility arrays to be used in building variable records.
 */

/**
 * Generates random US phone number
 * @return string
 */
function dt_training_random_phone_number () {
    $phone = rand ( 100 , 999 ) . '-' . rand ( 100 , 999 ) . '-' . rand ( 1000 , 9999 );
    return $phone;
}

/**
 * Generates random overal status
 * @return mixed
 */
function dt_training_random_overall_status(): string {

    $list = array( '0', '0', '0', '1', '2', '3', '4' );
    return $list[ array_rand( $list ) ];
}

/**
 * Generates random preferred contact method
 * @return mixed
 */
function dt_training_random_preferred_contact_method () {

    $list = array(
        'Email', 'Phone', 'SMS'
    );

    $top = count($list);

    return $list[rand(0, $top - 1)];
}

/**
 * Generates random name
 * @return mixed
 */
function dt_training_random_name () {

    $list = array(
        'Alsha', 'Taruh', 'Moukib', 'Buthaynah', 'Wasim',
        'Fatin', 'Moukib', 'Tarique', 'Faris', 'Moukib',
        'Mohammed', 'Parah', 'Usama', 'Gadi', 'Tahu',
        'Tarik', 'Fatima', 'Rahi', 'Atiya', 'Qaseem',
        'Maysun', 'Musad', 'Assah', 'Dawud', 'Maysa',
        'Moukib', 'Azzam', 'Qaseem', 'Maysun', 'Rahi',
        'Atiya', 'Rashid', 'Manal', 'Usama', 'Gadi',
        'رشيد', 'منال', 'أسامة',
        '<script>alert("name");</script>',
    );

    $top = count($list);

    return $list[rand(0, $top - 1)];
}

/**
 * Generates random source
 * @return mixed
 */
function dt_training_random_source () {

    $list = array(
        'Facebook', 'Twitter', 'Website', 'Partner', 'Phone', 'Email'
    );

    $top = count($list);

    return $list[rand(0, $top - 1)];
}

/**
 * Generates random group type
 * @return mixed
 */
function dt_training_random_group_type () {

    $list = array(
        'DBS', 'Church'
    );

    $top = count($list);

    return $list[rand(0, $top - 1)];
}


/**
 * Generates random address
 * @return mixed
 */
function dt_training_random_address () {

    $list = array(
        'Casablanca', 'Fez Fez', 'Tangier', 'Salé', 'Marrakesh',
        'Rabat', 'Kenitra', 'Tetouan', 'Beni Mellal', 'Safi',
        'Oujda', 'Inezgane Ait Melloul', 'Agadir-Ida Ou Tanan', 'Nador', 'Khouribga',
        'Settat', 'Temara', 'El Jadida', 'Khenifra', 'Taza',
        'بني ملال', 'مراكش',
        '<script>alert("address")</script>',
    );

    $top = count($list);

    $address = rand(100, 999) . ' ' . $list[rand(0, $top - 1)];
    return $address;
}

/**
 * Generates random city names
 * @return mixed
 */
function dt_training_random_city_names () {

    $list = array(
        'Algiers', 'Oran', 'Constantine', 'Annaba', 'Blida',
        'Batna', 'Djelfa', 'Sétif', 'Sidi Bel Abbès', 'Biskra',
        'Tébessa', 'El Oued', 'Skikda', 'Tiaret', 'Béjaïa',
        'Tlemcen', 'Ouargla', 'Béchar', 'Mostaganem', 'Bordj Bou Arréridj',
        'Chlef', 'Souk Ahras', 'Médéa', 'El Eulma', 'Touggourt',
        'سيدي بالعباس',
    );

    $top = count($list);

    return $list[rand(0, $top - 1)];
}


/**
 * Generates random state
 * @return mixed
 */
function dt_training_random_state () {

    $list = array(
        'BL', 'OC', 'CO', 'AG', 'BK',
        'BC', 'DM', 'SS', 'SA', 'BK',
        'TE', 'EQ', 'SD', 'TT', 'BB',
        'TP', 'OP', 'BN', 'MW', 'JH',
        'FG', 'SA', 'ME', 'EE', 'TG',
    );

    $top = count($list);

    return $list[rand(0, $top - 1)];
}

function dt_training_full_address () {
    $address = dt_training_random_address();
    $city = dt_training_random_city_names();
    $state = dt_training_random_state();
    $zip = dt_training_random_zip();

    return $address . ', ' . $city . ' ' . $state . ', ' . $zip;
}

function dt_training_random_zip () {
    return rand(80000, 89999);
}

/**
 * Generates random asset name
 * @return mixed
 */
function dt_training_random_asset_name () {

    $list = array(
        'NGO', 'Legacy Church', 'Worker', 'Social Service', 'Ministry',
    );

    $top = count($list);

    return $list[rand(0, $top - 1)];
}

function dt_training_random_word () {
    $list = array(
        'Lorem', 'Ipsum', 'Dolor', 'Consectetur', 'Adipiscing',
        'Praesent', 'Pulvinar', 'Vestibulum', 'Mollis', 'Tempus',
        'Sapien', 'Duis', 'Eros', 'Tincidunt', 'Vestibulum',
        'Praesent', 'Cras', 'Tortor', 'Quam', 'Duis',
        '<script>alert("word")</script>',
    );

    $top = count($list);

    return $list[rand(0, $top - 1)];
}

function dt_training_random_title () { // depricated?

    $string = "";
    $random_length = rand(0, 5);
    $i = 0;

    while ($random_length > $i) {
        $string .= dt_training_random_word () . ' ';
    }

    return $string;

}

function dt_training_loren_ipsum () {

    $text = array();
    $text[] = "Donec turpis eros, facilisis quis dolor id, imperdiet molestie eros. Aliquam sollicitudin nisi imperdiet euismod condimentum. Nam vel fermentum risus. Duis magna augue, viverra non convallis vel, volutpat hendrerit tortor. Suspendisse elementum ante lorem, quis mollis erat luctus non. Vestibulum massa purus, luctus ac leo vel, blandit aliquam lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis quis quam nec arcu imperdiet consectetur sit amet sed leo. Pellentesque ex leo, sodales ac ultrices ut, luctus et lorem. Suspendisse potenti. Sed id posuere nisi. Donec sit amet convallis turpis.";

    $text[] = "In iaculis lobortis sem et elementum. Suspendisse id arcu accumsan, iaculis ex ut, molestie diam. Vestibulum scelerisque lorem a aliquam tempor. Donec gravida ipsum nec suscipit eleifend. ";

    $text[] = "Duis pulvinar augue eu lectus laoreet, vehicula fringilla lacus efficitur. Donec tellus nunc, auctor bibendum egestas ut, ornare sed eros. Aliquam ornare eu purus a tristique. Nullam hendrerit faucibus urna, vitae aliquam nunc volutpat id. ";

    $text[] = "Donec vitae pulvinar ex, at placerat felis. Nullam commodo porta lacinia. Pellentesque ac sem blandit, scelerisque enim eget, sodales quam. Sed in facilisis mauris, non vehicula tellus. Aliquam dignissim sed elit consequat blandit. ";

    $text[] = "In sit amet placerat risus, ac accumsan justo. Cras ac ligula eget felis sagittis pulvinar. Aliquam fringilla mollis rutrum. Maecenas a convallis tortor, id accumsan arcu. Sed non dolor tellus. Pellentesque augue ipsum, consectetur vel quam eu, mollis fringilla magna. Etiam vehicula pharetra nunc hendrerit congue. Cras gravida diam mauris, congue euismod mauris ultrices sit amet. Donec hendrerit velit a nunc sollicitudin ultricies. Nunc commodo tincidunt turpis id cursus. In hac habitasse platea dictumst. Duis lacinia fermentum sem vel facilisis. Pellentesque molestie tempus dolor, non venenatis ipsum interdum eu. Maecenas vitae eros lobortis, dictum lorem quis, efficitur nunc.";

    $text[] = "Cras consequat ut sem a pulvinar. Nunc vitae orci eleifend, eleifend eros sed, sollicitudin nulla. Suspendisse feugiat nibh volutpat scelerisque pretium. Nullam pulvinar ipsum et est venenatis mattis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sit amet magna pharetra, elementum augue ac, cursus lacus. Integer scelerisque, sapien at aliquam iaculis, velit felis imperdiet arcu, placerat consectetur ligula risus at sem. Ut ullamcorper varius eros, porta molestie leo accumsan sit amet. Quisque egestas nisi suscipit metus scelerisque semper. Quisque ut nisl id libero pretium tristique. In pharetra quis erat a lacinia. In tincidunt, libero eu tempus feugiat, quam arcu dictum dolor, ut mattis quam turpis eget ex.";

    $text[] = "Nunc egestas, neque a dapibus rhoncus, quam dolor maximus mi, ac lobortis mauris magna quis libero. Nunc congue interdum fermentum. Integer eu urna tellus. Cras malesuada commodo tellus sit amet consequat. Nunc dictum et lectus non blandit. Phasellus congue faucibus neque id mollis. Sed mattis est lectus, sed convallis sapien condimentum vitae. Mauris vulputate sem lorem, sed blandit eros egestas vitae. Integer id ante at quam dignissim consectetur nec vitae massa.";

    $text[] = "Aenean mi arcu, laoreet id ultricies non, viverra eget justo. Aenean in turpis quam. Donec nibh nunc, convallis et tincidunt quis, scelerisque ut nisl. Nullam hendrerit faucibus urna, vitae aliquam nunc volutpat id.";

    $text[] = "Quisque rutrum lectus ut tempor pretium. Suspendisse volutpat nulla risus, et finibus eros pulvinar quis. Praesent id felis at mauris feugiat lacinia sed eget ligula. Praesent sit amet tellus accumsan, porttitor urna sed, sodales tellus. Sed elementum cursus eros et consequat. Aliquam lobortis massa eget mi pulvinar condimentum. Ut ultricies, metus vitae blandit pharetra, dolor sem convallis nibh, dapibus fringilla ante purus ut urna. Nullam sit amet libero condimentum, iaculis enim eget, iaculis erat. Nulla sed blandit elit, in viverra augue. Sed dignissim blandit malesuada. Nunc finibus consequat urna, in dictum massa eleifend quis. ";

    $text[] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam erat volutpat. Vivamus ut turpis at ex lacinia venenatis. Nulla vulputate urna blandit consectetur faucibus. Ut ligula mi, viverra et neque vel, interdum elementum ipsum. Integer pellentesque quam eget sapien pulvinar condimentum nec vel arcu. Donec ante augue, pharetra eu lacus id, mollis commodo quam. Curabitur auctor ultrices odio, ac sodales nisl dictum sit amet. Maecenas fermentum et magna eu pretium. Duis sodales pellentesque felis, vel ornare enim consectetur non. Vivamus facilisis elit eu lobortis lobortis. Mauris eget dapibus lectus. Vestibulum vestibulum turpis ligula, eu elementum justo fringilla luctus. Aliquam sed nisl laoreet, feugiat sem at, volutpat mauris. Nullam quam mauris, tempor bibendum lobortis vitae, dignissim vel diam. Pellentesque eu. Praesent lectus nibh, elementum eget lorem a, ullamcorper interdum velit. Quisque convallis augue ac risus fermentum, nec hendrerit purus dapibus. <script>alert('lorem')</script>";

    shuffle($text);

    return "<p>" . $text[0] . "</p><p>" . $text[1] . "</p><p>". $text[2] . "</p>";

}

function dt_training_comment_ipsum () {

    $text = array();
    $text[] = "Donec turpis eros, facilisis quis dolor id, imperdiet molestie eros.

    ";

    $text[] = "In iaculis lobortis sem et elementum. Suspendisse id arcu accumsan, iaculis ex ut, molestie diam. Vestibulum scelerisque lorem a aliquam tempor. Donec gravida ipsum nec suscipit eleifend.

    ";

    $text[] = "Duis pulvinar augue eu lectus laoreet, vehicula fringilla lacus efficitur.

    ";

    $text[] = "Donec vitae pulvinar ex, at placerat felis.

    ";

    $text[] = "In sit amet placerat risus.

    ";

    $text[] = "Cras consequat ut sem a pulvinar.

    ";

    $text[] = "Nunc egestas, neque a dapibus rhoncus, quam dolor maximus mi, ac lobortis mauris magna quis libero. <script>alert('comment');</script>

    ";

    shuffle($text);

    return $text[0] .  $text[1] . $text[2] ;

}

function dt_training_seeker_path () {

    $list = array(
        '0', '1', '2', '3', '4', '5', '0', '1', '2', '3', '4', '5', '0', '1', '2', '3', '4', '5', '6', '7' );

    shuffle($list);

    return $list[0];
}

function dt_training_group_role() {

    $list = array(
        'Unknown', 'Unbelieving', 'Believing', 'Accountable', 'Multiplying'
    );

    shuffle($list);

    return $list[0];

}

function dt_training_random_requires_upate() {

    $list = array(
        '0', '1'
    );

    shuffle($list);

    return $list[0];

}

function dt_training_random_yes_no() {

    $list = array(
        'No', 'Yes','No', 'Yes', 'No', 'Yes','No', 'Yes',
    );

    shuffle($list);

    return $list[0];

}

function dt_training_random_bool() {

    $list = array(
        '0', '1', '0', '1', '0', '0', '1', '1'
    );

    shuffle($list);

    return $list[0];

}


function dt_training_random_milestones(): array {
    $belief_milestones = array( 'belief', 'baptized', 'baptizing' );
    $sharing_milestones = array( 'can_share', 'sharing', 'in_group', 'planting' );
    $rv = array();

    for ($i = 0; $i < rand( 0, count( $belief_milestones ) ); $i++) {
        $rv["milestone_$belief_milestones[$i]"] = "1";
    }
    for ($i = 0; $i < rand( 0, count( $sharing_milestones ) ); $i++) {
        $rv["milestone_$sharing_milestones[$i]"] = "1";
    }
    return $rv;
}






