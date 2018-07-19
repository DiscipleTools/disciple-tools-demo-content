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
                            <div class="grid-x">
                            <div class="small-6 cell">
                                <p>
                                    <button type="button" class="button" onclick="quick_launch('ui')">Install Sample Data<span id="quick-launch-spinner"></span></button>
                                    <button type="button" class="button hollow" onclick="hide_on_startup('ui')" id="hide-on-startup">Hide This <span class="spinner"></span></button>
                                </p>
                            </div>
                            <div class="small-6 cell">

                            </div>
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

