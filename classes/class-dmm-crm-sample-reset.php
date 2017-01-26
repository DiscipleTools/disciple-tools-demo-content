<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

/*
 * Reset function
 *
 *
 *
 *
 * */


// Reset the links to the add pages.
function reset_sample_options()
{

    delete_option('add_sample_contacts');
    delete_option('add_sample_groups');

    echo '<div class="wrap">
    <h1>Reset Sample Data</h1>
    <p>Contacts Reset <a href="/wp-admin/options-general.php">Refresh</a>
    <p><a href="/wp-admin/options-general.php?page=sample-contacts-data">Add Contacts</a></p>
    <p><a href="/wp-admin/options-general.php?page=sample-groups-data">Add Groups</a></p>
</div>
';
}
