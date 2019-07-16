<?php

/**
 * Hide welcome popup modal.
 */
if ( ! get_option( 'dt_demo_hide_popup' ) && user_can( get_current_user_id(), 'manage_options' ) ) {

    function dt_demo_modal() {
        // only run check on dashboard
        global $post;
        if ( is_archive() ) {
            // Offer Sample Data
            ?>
            <script>
                jQuery(document).ready(function() {
                    let content = jQuery('.off-canvas-content')

                    content.append(`
                    <div id='demo-install-modal' class='reveal medium' data-reveal>

                        <div id="demo-sample">
                            <h2>Want to add sample content?</h2>
                            <hr>
                            <div class="grid-x grid-margin-x">
                                <div class="cell small-6">
                                    <p><strong>Get a better feel.</strong> We think it will help you get a better feel for the system. We've crafted a number of contacts, groups, and messages between different team members.</p>
                                    <p><strong>Delete anytime.</strong> You can delete the sample content anytime.</p>
                                    <p class="center">
                                        <select id="admin0_code">
                                        <option value="USA">United States</option>
                                        <option disabled>------</option>
                                        <?php
                                            global $wpdb;
                                            $list = $wpdb->get_results( "SELECT admin0_code, name FROM $wpdb->dt_location_grid WHERE level = 0", ARRAY_A );
                                            foreach ( $list as $country ) {
                                                echo '<option value="'.esc_html( $country['admin0_code'] ).'">'.esc_html( $country['name'] ).'</option>';
                                            }
                                        ?>
                                        </select><br>
                                    <button type="button" class="button" onclick="quick_launch('ui')">Install Sample Content</button>
                                    <span id="quick-launch-spinner" style="display:none;"><img style="height:1.5em;" src="<?php echo esc_url( plugin_dir_url( __FILE__ ) ) ?>/spinner.svg" /></span>
                                    <br><span id="report"></span></p>
                                    <hr>
                                    <p><strong>Add it later.</strong> If you would rather explore without sample content, go for it. You can always add sample content later.</p>
                                    <p class="center"><button type="button" class="button hollow" onclick="hide_on_startup('ui')" id="hide-on-startup">Hide this screen. I'll do this later.</button> <span class="spinner"></span>
                                    </p>
                                </div>
                                <div class="cell small-6">
                                    <img src="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) . 'images/demo-installed-content-vertical-image.png' ) ?>" width="100%" />
                                </div>
                            </div>
                        </div>

                        <button class="close-button" data-close aria-label="Close Accessible Modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id='demo-install-modal-hide' class='reveal medium' data-reveal>
                    <h2>Hidden for now!</h2>
                    <hr>
                        <div class="grid-x grid-margin-x">
                            <div class="cell small-6">
                                <p>We've disabled the welcome screen.</p>
                                <p>You can always run the sample content from your settings menu, or from the <em>WP-Admin</em> area.</p>
                               <p class="center"><button type="button" class="button hollow" onclick="close_window()">Okay. Got it!</button>

                            </div>
                            <div class="cell small-6">
                                <p class="center"><img src="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) . 'images/demo-admin-screen-image.jpg' ) ?>" width="100%" /><br>
                                <span style="font-size:.7em">Go to the admin area</span>
                                </p>
                                <p class="center"><img src="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) . 'images/demo-menu-image.jpg' ) ?>" width="100%" /><br>
                                <span style="font-size:.7em">Find "Extensions" and "Demo Content" in the menu</span>
                                </p>
                                <p class="center"><img src="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) . 'images/demo-install-sample-content-image.jpg' ) ?>" width="100%" /><br>
                                <span style="font-size:.7em">Select the "Install Sample Content" button</span>
                                </p>

                            </div>
                        </div>

                        <button class="close-button" data-close aria-label="Close Accessible Modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `);

                    let div = jQuery('#demo-install-modal');
                    new Foundation.Reveal( div );
                    div.foundation('open');
                })
            </script>
            <?php
        } // check for archive contacts page
    }
    add_action( 'wp_head', 'dt_demo_modal' );
}

/**
 * Add install link to settings menu, unless it is already installed.
 */
if ( ! get_option( "dt_demo_sample_data" ) && user_can( get_current_user_id(), 'manage_options' ) ) {
    function dt_demo_menu_item() {
        if ( ! is_admin() && ( user_can( get_current_user_id(), 'manage_options' ) || user_can( get_current_user_id(), 'manage_dt' ) ) ) {
            ?>
            <li><a href="<?php echo esc_url( admin_url( 'admin.php?page=dt_demo' ) ); ?>"><?php esc_html_e( "Add Demo Content" ); ?></a></li>
            <?php
        }
    }
    add_action( 'dt_settings_menu_post', 'dt_demo_menu_item' );
}
