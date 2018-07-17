<?php

if ( ! get_option( 'dt_demo_sample_data' ) ) {

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
                    <div id='demo-install-modal' class='reveal large' data-reveal>

                        <div id="demo-sample">
                            <h2>Add Contacts, Make it Fun!</h2>
                            <hr>
                            <p>If you are exploring Disciple.Tools, we recommend installing some sample
                                            information to be able to get a proper feel of the system.
                                            It will just take minute and you can remove the sample data later from
                                            the admin area.
                                            </p>
                            <div id="step-1">
                                <p><h4 id="install-title-1">Install Sample Contacts, Groups, and Users</h4></p>
                                <p id="install-action-1"><button type="button" class="button" onclick="quick_launch()">Install</button> <button type="button" class="button hollow" onclick="skip_core()">Skip</button> </p>
                                <p id="install-report-1" style="font-size:1.2em; padding-left:20px;"></p>
                            </div>

                            <div id="step-2"  style="display:none;">
                                <p><h4>Install Locations</h4></p>
                                <p id="install-action-2"><button type="button" class="button" onclick="install_locations()">Install</button> <button type="button" class="button hollow" onclick="skip_locations()">Skip</button> </p>
                                <p id="install-report-2"></p>
                            </div>

                            <div id="step-3" style="display:none;">
                                <p><h4>Install Generations and Connections</h4></p>
                                <p id="install-action-3"><button type="button" class="button" onclick="install_generations()">Install</button> <button type="button" class="button hollow" onclick="skip_generations()">Skip</button> </p>
                                <p id="install-report-3"></p>

                            </div>

                            <div id="step-completed" style="display:none;">
                                <p>Success! You're ready to go!</p>
                                <span style="float:right;"><button type="button" class="button hollow small" onclick="jQuery('#demo-install-modal').foundation('close')" >Close</button></span>
                            </div>
                        </div>

                        <hr>
                        <div>
                            <span><input type="checkbox" class="" onclick="hide_on_startup(jQuery(this).is(':checked'))" /><label for="hide-on-startup">don't show window again</label></span> <span id="errors"></span>
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

