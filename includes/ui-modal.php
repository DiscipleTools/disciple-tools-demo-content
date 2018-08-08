<?php

if ( ! get_option( 'dt_demo_hide_popup' ) ) {

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
                                    <p class="center"><button type="button" class="button" onclick="quick_launch('ui')">Install Sample Content</button> <span id="quick-launch-spinner"></span></p>
                                    <hr>
                                    <p><strong>Add it later.</strong> If you would rather explore without sample content, go for it. You can always add sample content later.</p>
                                    <p class="center"><button type="button" class="button hollow" onclick="hide_on_startup('ui')" id="hide-on-startup">Hide this screen. I'll do this later.</button> <span class="spinner"></span>
                                    </p>
                                </div>
                                <div class="cell small-6">
                                    <img src="http://via.placeholder.com/300x600">
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
                                <p>You can always run the sample content from your settings menu, or from the <em>WP-Admin</em> area inside <em>Extensions->Demo Content</em>.</p>
                               <p class="center"><button type="button" class="button hollow" onclick="close_window()">Okay. Got it!</button>

                            </div>
                            <div class="cell small-6">
                                <img src="http://via.placeholder.com/300x300"><br>
                                <img src="http://via.placeholder.com/300x300"><br>
                                <img src="http://via.placeholder.com/300x300"><br>

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

