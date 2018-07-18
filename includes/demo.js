

function quick_launch() {
    let spinner = jQuery('#install-report-1')
    spinner.append('<img style="height:1.5em;" src="'+ wpApiDemo.images_uri +'spinner.svg" />');

    jQuery.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: wpApiDemo.root + 'dt_demo/v1/quick_launch/install_demo_data',
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce);
        },
    })
    .done(function (data) {
        location.reload();
    })
    .fail(function (err) {
        console.log("error")
        console.log(err)
        spinner.empty()
    })

}



















function delete_prepared_data() {
    let spinner = jQuery('#spinner')
    spinner.append('<img style="height:1.5em;" src="'+ wpApiDemo.images_uri +'spinner.svg" />');

    jQuery.ajax({
        method: "DELETE",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: wpApiDemo.root + 'dt_demo/v1/quick_launch/contacts',
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce);
        },
    })
    .done(function (data) {
        console.log( data )
        spinner.empty()
    })
    .fail(function (err) {
        console.log("error")
        console.log(err)
        spinner.empty()
        jQuery("#prepared_data_errors").append(err.responseJSON.message)
    })

}

function install_core() {

    let action = jQuery('#install-action-1')
    let report = jQuery('#install-report-1')
    let spinner = wpApiDemo.spinner_small

    action.hide()

    report.append(`
                  <span id="users-report">Users: <span id="users-report-count" style="font-weight:bold;"></span> <span class="users-report-spinner">`+spinner+`</span></span> | 
                  <span id="locations-report">Locations: <span id="locations-report-count" style="font-weight:bold;"></span> <span class="locations-report-spinner">`+spinner+`</span></span> | 
                  <span id="contacts-report">Contacts: <span id="contacts-report-count" style="font-weight:bold;"></span> <span class="contacts-report-spinner">`+spinner+`</span></span> | 
                  <span id="groups-report">Groups: <span id="groups-report-count" style="font-weight:bold;"></span> <span class="groups-report-spinner">`+spinner+`</span></span> | 
                  <span id="comments-report">Comments: <span id="comments-report-count" style="font-weight:bold;"></span> <span class="comments-report-spinner">`+spinner+`</span></span> | 
                  <span id="connections-report">Making Connections: <span id="connections-report-count" style="font-weight:bold;"></span> <span class="connections-report-spinner">`+spinner+`</span></span> | 
                  <span id="beautification-report">Beautification: <span id="beautification-report-count" style="font-weight:bold;"></span> <span class="beautification-report-spinner">`+spinner+`</span></span>
                  
                `)

    let userCount = 0

    let contactCount = 0
    let contactIndex = 1
    let groupCount = 0
    let groupIndex = 1
    let userIndex = 1

    console.log('add users')
    jQuery.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: wpApiDemo.root + 'dt_demo/v1/quick_launch/create_user',
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce );
        },
    })
        .done(function (users) {
            jQuery('#users-report-count').html( users.length )
            jQuery('.users-report-spinner').empty()
            build_locations( users ) // once users created, send to location creation
        })
        .fail(function (err) {
            console.log("error");
            console.log(err);
        })

    function build_locations( users ) {
        console.log('add locations')
        jQuery.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            url: wpApiDemo.root + 'dt_demo/v1/quick_launch/create_locations',
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce );
            },
        })
            .done(function (locations) {
                jQuery('#locations-report-count').html( locations.length )
                jQuery('.locations-report-spinner').empty()
                build_groups_contacts( users, locations ) // once locations created, send to groups and contacts
            })
            .fail(function (err) {
                console.log("error");
                console.log(err);
            })
    }

    function build_groups_contacts( users, locations) {
        console.log('add contacts')
        let contact_id_list = []
        for ( i = 0; i <= 70; i++ ) {
            jQuery.ajax({
                type: "POST",
                data: JSON.stringify({"users": users } ),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: wpApiDemo.root + 'dt_demo/v1/quick_launch/create_contact',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce );
                },
            })
                .done(function (data) {
                    contact_id_list.push( data )
                    jQuery('#contacts-report-count').html(contactCount)
                    contactCount++
                    console.log( contactCount )
                    if ( contactCount >= 70 && groupCount >= 10 ) {
                        jQuery('.contacts-report-spinner').empty()
                        add_connections()
                    }
                })
                .fail(function (err) {
                    console.log("error");
                    console.log(err);
                })

        }

        console.log('add groups')
        let group_id_list = []
        for ( i = 0; i <= 10; i++ ) {
            jQuery.ajax({
                type: "POST",
                data: JSON.stringify({"users": users  }),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: wpApiDemo.root + 'dt_demo/v1/quick_launch/create_group',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce );
                },
            })
                .done(function (data) {
                    group_id_list.push(data)
                    jQuery('#groups-report-count').html(groupCount)
                    groupCount++
                    if ( contactCount >= 70 && groupCount >= 10 ) {
                        jQuery('.contacts-report-spinner').empty()
                        jQuery('.groups-report-spinner').empty()
                        add_connections()
                    }
                })
                .fail(function (err) {
                    console.log("error");
                    console.log(err);
                })

        }

        // add initial comments to all contacts @todo
        console.log('add comments')
        jQuery.ajax({
            type: "POST",
            data: JSON.stringify({"contacts": contact_id_list, 'users': users }),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            url: wpApiDemo.root + 'dt_demo/v1/quick_launch/create_initial_comments',
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce );
            },
        })
            .done(function (data) {
                jQuery('#comments-report-count').html(data)
                jQuery('.comments-report-spinner').empty()
                console.log('comments added')
                console.log(data)
            })
            .fail(function (err) {
                console.log("error");
                console.log(err);
            })


        // build connections once all contacts and groups are created
        function add_connections() {
            if ( groupCount === 10 && contactCount === 70 ) {
                // add locations and contacts to groups
                // loop on group, and ajax loop on contact to add single location and group id and user to contact
                let chunkContacts = _.chunk( contact_id_list, 5 )
                jQuery.each( group_id_list, function( index, value ) {
                    jQuery.ajax({
                        type: "POST",
                        data: JSON.stringify({"contacts": chunkContacts[index], "location": locations[index]}),
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        url: wpApiDemo.root + 'dt_demo/v1/quick_launch/connect_group',
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce );
                        },
                    })
                        .done(function (data) {
                            console.log(data)
                        })
                        .fail(function (err) {
                            console.log("error");
                            console.log(err);
                        })
                })

                // make assignments
                // assign to multiplier and some to current user
                // also accept on behalf of the multiplier and some of the current user
                // trigger a couple updates required
            }
        }

    }


    function random_int_from_interval(min,max)
    {
        return Math.floor(Math.random()*(max-min+1)+min);
    }

    function check_if_finished() {
        let x = 0
        if( contactCount === contactIndex ) {
            jQuery('.contacts-report-spinner').empty()
            x++
        }
        if( groupCount === groupIndex ) {
            jQuery('.groups-report-spinner').empty()
            x++
        }
        if( userCount === userIndex ) {
            jQuery('.users-report-spinner').empty()
            x++
        }

        if( 3 === x ) {
            jQuery('#step-2').show()
        }
    }


}

function skip_core() {
    console.log('skip_core')
    let action = jQuery('#install-action-1')
    action.append(wpApiDemo.spinner)

    action.hide()
    jQuery('#step-2').show()
}

function install_locations() {
    console.log('install_locations')
    let action = jQuery('#install-action-2')
    action.append(wpApiDemo.spinner)

    action.hide()
    jQuery('#step-3').show()
}

function skip_locations() {
    console.log('skip_locations')
    let action = jQuery('#install-action-2')
    action.append(wpApiDemo.spinner)

    action.hide()
    jQuery('#step-3').show()
}

function install_generations() {
    console.log('install_generations')
    let action = jQuery('#install-action-3')
    action.append(wpApiDemo.spinner)

    action.hide()
    jQuery('#step-completed').show()
}

function skip_generations() {
    console.log('skip_generations')
    let action = jQuery('#install-action-3')
    action.append(wpApiDemo.spinner)

    action.hide()
    jQuery('#step-completed').show()
}

function hide_on_startup( state ) {
    console.log( 'hide_on_startup: ' + state )
    return jQuery.ajax({
        type: "GET",
        contentType: "application/json; charset=utf-8",
        url: wpApiDemo.root + 'dt_demo/v1/quick_launch/hide_on_startup',
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce );
        },
    })
        .done(function (data) {
            jQuery('#demo-install-modal').foundation('close')
        })
        .fail(function (err) {
            console.log("error");
            console.log(err);
            jQuery("#errors").append(err.responseText);
        })
}

