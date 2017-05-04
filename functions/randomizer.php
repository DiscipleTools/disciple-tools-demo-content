<?php
/**
 * These are utility arrays to be used in building variable records.
 */

/**
 * Generates random US phone number
 * @return string
 */
function dt_sample_random_phone_number () {
    $phone = rand ( 100 , 999 ) . '-' . rand ( 100 , 999 ) . '-' . rand ( 1000 , 9999 );
    return $phone;
}

/**
 * Generates random overal status
 * @return mixed
 */
function dt_sample_random_overall_status () {

    $list = array(
        'Unassigned', 'Unassigned', 'Unassigned', 'Unassigned', 'Unassigned',
        'Unassigned', 'Unassigned', 'Unassigned', 'Unassigned', 'Unassigned',
        'Unassigned', 'Unassigned', 'Unassigned', 'Unassigned', 'Unassigned',
        'Unassigned', 'Unassigned', 'Unassigned', 'Unassigned', 'Unassigned',
        'Paused', 'Closed', 'Unassignable', 'Paused', 'Closed', 'Unassignable');

    $top = count($list);

    return $list[rand(0, $top - 1)];
}

/**
 * Generates random preferred contact method
 * @return mixed
 */
function dt_sample_random_preferred_contact_method () {

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
function dt_sample_random_name () {

    $list = array(
        'Alsha', 'Taruh', 'Moukib', 'Buthaynah', 'Wasim',
        'Fatin', 'Moukib', 'Tarique', 'Faris', 'Moukib',
        'Mohammed', 'Parah', 'Usama', 'Gadi', 'Tahu',
        'Tarik', 'Fatima', 'Rahi', 'Atiya', 'Qaseem',
        'Maysun', 'Musad', 'Assah', 'Dawud', 'Maysa',
        'Moukib', 'Azzam', 'Qaseem', 'Maysun', 'Rahi',
        'Atiya', 'Rashid', 'Manal', 'Usama', 'Gadi'
    );

    $top = count($list);

    return $list[rand(0, $top - 1)];
}

/**
 * Generates random source
 * @return mixed
 */
function dt_sample_random_source () {

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
function dt_sample_random_group_type () {

    $list = array(
        'DBS', 'DBS', 'DBS', 'Church'
    );

    $top = count($list);

    return $list[rand(0, $top - 1)];
}


/**
 * Generates random address
 * @return mixed
 */
function dt_sample_random_address () {

    $list = array(
        'Casablanca', 'Fez Fez', 'Tangier', 'Salé', 'Marrakesh',
        'Rabat', 'Kenitra', 'Tetouan', 'Beni Mellal', 'Safi',
        'Oujda', 'Inezgane Ait Melloul', 'Agadir-Ida Ou Tanan', 'Nador', 'Khouribga',
        'Settat', 'Temara', 'El Jadida', 'Khenifra', 'Taza',
    );

    $top = count($list);

    $address = rand(100, 999) . ' ' . $list[rand(0, $top - 1)];
    return $address;
}

/**
 * Generates random city names
 * @return mixed
 */
function dt_sample_random_city_names () {

    $list = array(
        'Algiers', 'Oran', 'Constantine', 'Annaba', 'Blida',
        'Batna', 'Djelfa', 'Sétif', 'Sidi Bel Abbès', 'Biskra',
        'Tébessa', 'El Oued', 'Skikda', 'Tiaret', 'Béjaïa',
        'Tlemcen', 'Ouargla', 'Béchar', 'Mostaganem', 'Bordj Bou Arréridj',
        'Chlef', 'Souk Ahras', 'Médéa', 'El Eulma', 'Touggourt',
    );

    $top = count($list);

    return $list[rand(0, $top - 1)];
}


/**
 * Generates random state
 * @return mixed
 */
function dt_sample_random_state () {

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

/**
 * Generates random asset name
 * @return mixed
 */
function dt_sample_random_asset_name () {

    $list = array(
        'NGO', 'Legacy Church', 'Worker', 'Social Service', 'Ministry',
    );

    $top = count($list);

    return $list[rand(0, $top - 1)];
}







