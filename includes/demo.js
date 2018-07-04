

function quick_launch() {
    let spinner = jQuery('#spinner')
    spinner.append('<img style="height:1.5em;" src="'+ wpApiDemo.images_uri +'spinner.svg" />');

    jQuery.ajax({
        type: "POST",
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
    console.log('install_core')
    let action = jQuery('#install-action-1')
    let report = jQuery('#install-report-1')
    let spinner = wpApiDemo.spinner_small

    action.hide()

    report.append(`<span id="contacts-report">Contacts: <span id="contacts-report-count" style="font-weight:bold;"></span> <span class="report-spinner">`+spinner+`</span></span> | 
                  <span id="groups-report">Groups: <span id="groups-report-count" style="font-weight:bold;"></span> <span class="report-spinner">`+spinner+`</span></span> | 
                  <span id="users-report">Users: <span id="users-report-count" style="font-weight:bold;"></span> <span class="report-spinner">`+spinner+`</span></span> | 
                  <span id="users-report">Comments and Assignments: <span id="comments-report-count" style="font-weight:bold;"></span> <span class="report-spinner">`+spinner+`</span></span> | 
                  <span id="users-report">Making Connections: <span id="comments-report-count" style="font-weight:bold;"></span> <span class="report-spinner">`+spinner+`</span></span> | 
                  <span id="users-report">Beautification: <span id="comments-report-count" style="font-weight:bold;"></span> <span class="report-spinner">`+spinner+`</span></span>
                  
                `)


    let contactCount = 1
    let contactIndex = 1
    let groupCount = 1
    let groupIndex = 1
    let userCount = 1
    let userIndex = 1

    while ( contactCount <= 10 ) {
        jQuery.ajax({
            type: "POST",
            data: JSON.stringify({"id": contactIndex }),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            url: wpApiDemo.root + 'dt_demo/v1/quick_launch/create_contact',
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce );
            },
        })
            .done(function (data) {
                jQuery('#contacts-report-count').html(contactIndex)
                contactIndex++
                if( contactCount === contactIndex && groupCount === groupIndex && userCount === userIndex ) {
                    jQuery('#step-2').show()
                    jQuery('.report-spinner').empty()
                }
            })
            .fail(function (err) {
                console.log("error");
                console.log(err);
                jQuery("#errors").append(err.responseText);
                contactIndex++
            })

            // console.log( contactCount )
            contactCount++
    }

    while ( groupCount <= 10 ) {
        jQuery.ajax({
            type: "POST",
            data: JSON.stringify({"id": groupIndex }),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            url: wpApiDemo.root + 'dt_demo/v1/quick_launch/create_group',
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce );
            },
        })
            .done(function (data) {
                jQuery('#groups-report-count').html(groupIndex)
                groupIndex++
                if( contactCount === contactIndex && groupCount === groupIndex && userCount === userIndex ) {
                    jQuery('#step-2').show()
                    jQuery('.report-spinner').empty()
                }
            })
            .fail(function (err) {
                console.log("error");
                console.log(err);
                jQuery("#errors").append(err.responseText);
                groupIndex++
            })

        groupCount++
    }

    while ( userCount <= 5 ) {
        jQuery.ajax({
            type: "POST",
            data: JSON.stringify({"id": userIndex }),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            url: wpApiDemo.root + 'dt_demo/v1/quick_launch/create_user',
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce );
            },
        })
            .done(function (data) {
                jQuery('#users-report-count').html(userIndex)
                userIndex++
                if( contactCount === contactIndex && groupCount === groupIndex && userCount === userIndex ) {
                    jQuery('#step-2').show()
                    jQuery('.report-spinner').empty()
                }
            })
            .fail(function (err) {
                console.log("error");
                console.log(err);
                jQuery("#errors").append(err.responseText);
                userIndex++
            })

        userCount++
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

