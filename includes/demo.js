
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
        if ( state === 'ui' ) {
            location.reload();
        }
        spinner.empty()
        console.log('quick launch: success')
        return true;
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
        console.log( 'delete success' )
        spinner.empty()
    })
    .fail(function (err) {
        console.log("error")
        console.log(err)
        spinner.empty()
    })
}

function toggle_prepared_data( state ) {
    let title = jQuery('#install-quick-launch')
    if ( state ) {
        console.log('toggle: delete data')
        delete_prepared_data()
        title.text('Install Prepared Data')
    } else {
        console.log('toggle: launch data')
        quick_launch( state )
        title.text('Delete Prepared Data')
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
            }
            console.log(data)
        })
        .fail(function (err) {
            console.log("error");
            console.log(err);
            spinner.empty()
        })
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