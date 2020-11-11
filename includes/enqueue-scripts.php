<?php

/**
 * Load Admin
 */
function dt_demo_scripts() {

    if ( ! is_user_logged_in() ){
        return;
    }
//    wp_enqueue_style( 'dt-demo-styles', dt_demo()->includes_uri . 'demo.css', [], filemtime( plugin_dir_path( __FILE__ ) . "demo.css" ) );
    wp_enqueue_script( 'dt-demo-scripts', dt_demo()->includes_uri . 'demo.js', array( 'jquery' ), filemtime( plugin_dir_path( __FILE__ ) . "demo.js" ) );
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
            'spinner_small' => '<img src="'.dt_demo()->includes_uri.'spinner.svg" style="width:15px;" />',
        )
    );
}
add_action( 'admin_enqueue_scripts', 'dt_demo_scripts', 999 );

add_action( 'wp_enqueue_scripts', 'dt_demo_scripts', 999 );
