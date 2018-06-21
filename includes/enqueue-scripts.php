<?php

/**
 * Load Admin
 */
function dt_demo_scripts() {

    wp_enqueue_style( 'dt-demo-styles', dt_demo()->includes_uri . 'demo.css' );
    wp_enqueue_script( 'dt-demo-scripts', dt_demo()->includes_uri . 'demo.js', array( 'jquery' ) );
    wp_localize_script(
        'dt-demo-scripts', 'wpApiDemo', array(
            'root' => esc_url_raw( rest_url() ),
            'nonce' => wp_create_nonce( 'wp_rest' ),
            'current_user_login' => wp_get_current_user()->user_login,
            'current_user_id' => get_current_user_id(),
            'translations' => [
                "no-unread" => __( "You don't have any unread notifications", "disciple_tools" ),
                "no-notifications" => __( "You don't have any notifications", "disciple_tools" )
            ],
            'images_uri' => dt_demo()->includes_uri,
        )
    );
}
add_action( 'admin_enqueue_scripts', 'dt_demo_scripts', 999 );
