<?php
/**
 * These are utility arrays to be used in building variable records.
 */

function dt_sample_random_phone_number () {
    $phone = rand ( 100 , 999 ) . '-' . rand ( 100 , 999 ) . '-' . rand ( 1000 , 9999 );
    return $phone;
}

function dt_sample_random_overall_status () {

    $status = array('Unassigned', 'Unassigned','Unassigned', 'Unassigned','Unassigned',
        'Unassigned','Unassigned', 'Unassigned','Unassigned', 'Unassigned','Unassigned',
        'Assigned','Unassigned', 'Assigned','Unassigned', 'Assigned','Unassigned',
        'Assigned','Unassigned', 'Assigned','Unassigned', 'Assigned','Unassigned',
        'Paused', 'Closed', 'Unassignable', 'Paused', 'Closed', 'Unassignable');

    return array_rand ( $status , 1 );
}

function dt_sample_random_preferred_contact_method () {
    $method = array(
        'Email', 'Phone', 'SMS'
    );
    return array_rand ( $method , 1 );
}


function dt_sample_plain_user_names () {
    $names = array(
        array('name' => 'Multiplier', 'firstname' => 'Multiplier', 'lastname' => '', 'email' => 'm'),
      'Multiplier',
        'Marketer',

    );
}

function dt_sample_random_names ($count = '100') {
    $names = array();
    $i = 0;

    $name_list = array(
        'Alsha', 'Taruh', 'Moukib', 'Buthaynah', 'Wasim',
        'Fatin', 'Moukib', 'Tarique', 'Faris', 'Moukib',
        'Mohammed', 'Parah', 'Usama', 'Gadi', 'Tahu',
        'Tarik', 'Fatima', 'Rahi', 'Atiya', 'Qaseem',
        'Maysun', 'Musad', 'Tarik', 'Dawud', 'Maysa',
        'Moukib', 'Azzam', 'Qaseem', 'Maysun', 'Rahi',
        'Atiya', 'Rashid', 'Manal', 'Usama', 'Gadi'
    );

    while ($i < $count) {

        $name = array_rand ( $name_list , 2 );

        $names[] = $name[0] . ' ' . $name[1];

        $i++;
    }

    return $names;
}

function dt_sample_random_name () {
    $name_list = array(
        'Alsha', 'Taruh', 'Moukib', 'Buthaynah', 'Wasim',
        'Fatin', 'Moukib', 'Tarique', 'Faris', 'Moukib',
        'Mohammed', 'Parah', 'Usama', 'Gadi', 'Tahu',
        'Tarik', 'Fatima', 'Rahi', 'Atiya', 'Qaseem',
        'Maysun', 'Musad', 'Assah', 'Dawud', 'Maysa',
        'Moukib', 'Azzam', 'Qaseem', 'Maysun', 'Rahi',
        'Atiya', 'Rashid', 'Manal', 'Usama', 'Gadi'
    );
    return $name_list[rand(0, 35)];
}

function dt_sample_plain_contact () {

    $name = dt_sample_random_name ();
    $contact = array(
        "title" => dt_sample_random_name () . ' Contact' . rand(100, 999),
        "phone" => dt_sample_random_phone_number(),
        "overall_status" => dt_sample_random_overall_status(),
        "email" => $name.rand(1000, 10000)."@email.com",
        "preferred_contact_method" => dt_sample_random_preferred_contact_method (),
    );

    return $contact;

}


function dt_sample_plain_group_names () {

}

function dt_sample_random_group_names () {

}

function dt_sample_plain_location_names () {

}

function dt_sample_random_location_names () {

}

function dt_sample_plain_prayer_names () {

}

function dt_sample_random_prayer_names () {

}




