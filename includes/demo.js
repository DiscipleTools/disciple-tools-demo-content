
function quick_launch( state ) {
    let spinner = jQuery('#quick-launch-spinner')
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
    let spinner = jQuery('#quick-launch-spinner')
    spinner.append('<img style="height:1em;" src="'+ wpApiDemo.images_uri +'spinner.svg" />');
    let title = jQuery('#install-quick-launch')

    jQuery.ajax({
        method: "DELETE",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: wpApiDemo.root + 'dt_demo/v1/quick_launch/delete_demo_data',
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

function toggle_prepared_data( state ) {
    if ( state ) {
        console.log('toggle: delete data')
        delete_prepared_data()
    } else {
        console.log('toggle: launch data')
        quick_launch( state )
    }
}

function hide_on_startup( state ) {

    let spinner = jQuery('#hide-on-startup')
    spinner.append('<img style="height:1em;" src="'+ wpApiDemo.images_uri +'spinner.svg" />');

    jQuery.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        url: wpApiDemo.root + 'dt_demo/v1/quick_launch/hide_on_startup',
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce );
        },
    })
        .done(function (data) {
            spinner.empty()
            if( state === 'ui' ) {
                jQuery('#demo-install-modal').foundation('close')
                let div = jQuery('#demo-install-modal-hide');
                new Foundation.Reveal( div );
                div.foundation('open');
            }
            console.log(data)
        })
        .fail(function (err) {
            console.log("error");
            console.log(err);
            spinner.empty()
        })
}

function close_window() {
    let spinner = jQuery('.spinner')
    spinner.empty()
    jQuery('#demo-install-modal-hide').foundation('close')
    jQuery('#demo-install-modal').foundation('close')
}

function add_contacts() {
    let key = 'add_contacts'
    let spinner = jQuery('#'+key+'_spinner')
    let counter = jQuery('.'+key+'_count')
    spinner.append('<img style="height:1em;" src="'+ wpApiDemo.images_uri +'spinner.svg" />');

    jQuery.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: wpApiDemo.root + 'dt_demo/v1/' + key,
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce);
        },
    })
    .done(function (data) {
        spinner.empty()
        counter.html(data)
    })
    .fail(function (err) {
        console.log("error")
        console.log(err)
        spinner.empty()
        counter.html("error")
    })
}

function delete_contacts() {
    let key = 'delete_contacts'
    let spinner = jQuery('#'+key+'_spinner')
    let counter = jQuery('.'+key+'_count')
    spinner.append('<img style="height:1em;" src="'+ wpApiDemo.images_uri +'spinner.svg" />');

    jQuery.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: wpApiDemo.root + 'dt_demo/v1/' + key,
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce);
        },
    })
    .done(function (data) {
        spinner.empty()
        counter.html(data)
        jQuery('#delete_contacts_confirm').hide();
    })
    .fail(function (err) {
        console.log("error")
        console.log(err)
        spinner.empty()
        counter.html("error")
    })
}

function add_groups() {
    let key = 'add_groups'
    let spinner = jQuery('#'+key+'_spinner')
    let counter = jQuery('.'+key+'_count')
    spinner.append('<img style="height:1em;" src="'+ wpApiDemo.images_uri +'spinner.svg" />');

    jQuery.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: wpApiDemo.root + 'dt_demo/v1/' + key,
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce);
        },
    })
        .done(function (data) {
            spinner.empty()
            counter.html(data)
        })
        .fail(function (err) {
            console.log("error")
            console.log(err)
            spinner.empty()
            counter.html("error")
        })
}

function delete_groups() {
    let key = 'delete_groups'
    let spinner = jQuery('#'+key+'_spinner')
    let counter = jQuery('.'+key+'_count')
    spinner.append('<img style="height:1em;" src="'+ wpApiDemo.images_uri +'spinner.svg" />');

    jQuery.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: wpApiDemo.root + 'dt_demo/v1/' + key,
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce);
        },
    })
        .done(function (data) {
            spinner.empty()
            counter.html(data)
            jQuery('#delete_groups_confirm').hide();
        })
        .fail(function (err) {
            console.log("error")
            console.log(err)
            spinner.empty()
            counter.html("error")
        })
}

function add_comments() {
    let key = 'add_comments'
    let spinner = jQuery('#'+key+'_spinner')
    let counter = jQuery('.'+key+'_count')
    spinner.append('<img style="height:1em;" src="'+ wpApiDemo.images_uri +'spinner.svg" />');

    jQuery.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: wpApiDemo.root + 'dt_demo/v1/' + key,
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce);
        },
    })
        .done(function (data) {
            spinner.empty()
            counter.html(data)
        })
        .fail(function (err) {
            console.log("error")
            console.log(err)
            spinner.empty()
            counter.html("error")
        })
}

function delete_comments() {
    let key = 'delete_comments'
    let spinner = jQuery('#'+key+'_spinner')
    let counter = jQuery('.'+key+'_count')
    spinner.append('<img style="height:1em;" src="'+ wpApiDemo.images_uri +'spinner.svg" />');

    jQuery.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: wpApiDemo.root + 'dt_demo/v1/' + key,
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce);
        },
    })
        .done(function (data) {
            spinner.empty()
            counter.html(data)
            jQuery('#delete_groups_confirm').hide();
        })
        .fail(function (err) {
            console.log("error")
            console.log(err)
            spinner.empty()
            counter.html("error")
        })
}

function add_connections() {
    let admin0_code = jQuery('#admin0_code').val()
    let key = 'add_comments'

    // baptism generations
    let bgspinner = jQuery('#add_baptism_generations_spinner')
    let bgcounter = jQuery('#add_baptism_generations_count')
    bgspinner.append('<img style="height:1em;" src="'+ wpApiDemo.images_uri +'spinner.svg" />');
    jQuery.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: wpApiDemo.root + 'dt_demo/v1/baptism_generations',
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce);
        },
    })
    .done(function (data) {
        bgspinner.empty()
        bgcounter.html(data)
    })
    .fail(function (err) {
        console.log("error")
        console.log(err)
        bgspinner.empty()
        bgcounter.html("error")
    })


    // group generations
    let ggspinner = jQuery('#add_group_generations_spinner')
    let ggcounter = jQuery('#add_group_generations_count')
    ggspinner.append('<img style="height:1em;" src="'+ wpApiDemo.images_uri +'spinner.svg" />');
    jQuery.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: wpApiDemo.root + 'dt_demo/v1/group_generations',
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce);
        },
    })
        .done(function (data) {
            ggspinner.empty()
            ggcounter.html(data)
        })
        .fail(function (err) {
            console.log("error")
            console.log(err)
            ggspinner.empty()
            ggcounter.html("error")
        })


    // coaching generations
    let cgspinner = jQuery('#add_coaching_generations_spinner')
    let cgcounter = jQuery('#add_coaching_generations_count')
    cgspinner.append('<img style="height:1em;" src="'+ wpApiDemo.images_uri +'spinner.svg" />');
    jQuery.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: wpApiDemo.root + 'dt_demo/v1/coaching_generations',
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce);
        },
    })
        .done(function (data) {
            cgspinner.empty()
            cgcounter.html(data)
        })
        .fail(function (err) {
            console.log("error")
            console.log(err)
            cgspinner.empty()
            cgcounter.html("error")
        })


    // contacts to locations
    let clspinner = jQuery('#add_contacts_locations_spinner')
    let clcounter = jQuery('#add_contacts_locations_count')
    clspinner.append('<img style="height:1em;" src="'+ wpApiDemo.images_uri +'spinner.svg" />');
    jQuery.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify( { 'admin0_code': admin0_code } ),
        dataType: "json",
        url: wpApiDemo.root + 'dt_demo/v1/contacts_locations',
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce);
        },
    })
        .done(function (data) {
            clspinner.empty()
            clcounter.html(data)
        })
        .fail(function (err) {
            console.log("error")
            console.log(err)
            clspinner.empty()
            clcounter.html("error")
        })

    // groups to locations
    let glspinner = jQuery('#add_groups_locations_spinner')
    let glcounter = jQuery('#add_groups_locations_count')
    glspinner.append('<img style="height:1em;" src="'+ wpApiDemo.images_uri +'spinner.svg" />');
    jQuery.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify( { 'admin0_code': admin0_code } ),
        dataType: "json",
        url: wpApiDemo.root + 'dt_demo/v1/groups_locations',
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce);
        },
    })
        .done(function (data) {
            glspinner.empty()
            glcounter.html(data)
        })
        .fail(function (err) {
            console.log("error")
            console.log(err)
            glspinner.empty()
            glcounter.html("error")
        })

    // contacts to group
    let ccgspinner = jQuery('#add_contacts_group_spinner')
    let ccgcounter = jQuery('#add_contacts_group_count')
    ccgspinner.append('<img style="height:1em;" src="'+ wpApiDemo.images_uri +'spinner.svg" />');
    jQuery.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: wpApiDemo.root + 'dt_demo/v1/contacts_group',
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce);
        },
    })
        .done(function (data) {
            ccgspinner.empty()
            ccgcounter.html(data)
        })
        .fail(function (err) {
            console.log("error")
            console.log(err)
            ccgspinner.empty()
            ccgcounter.html("error")
        })
}