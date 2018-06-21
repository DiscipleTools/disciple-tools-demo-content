

function quick_launch() {

    jQuery.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: wpApiDemo.root + 'dt_demo/v1/demo/quick_launch',
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wpApiDemo.nonce);
        },
    })
        .done(function (data) {
            console.log( data )
        })
        .fail(function (err) {
            console.log("error")
            console.log(err)
            jQuery("#errors").append(err.responseText)
        })

}
