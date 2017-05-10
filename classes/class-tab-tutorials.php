<?php

/**
 * Disciple Tools Tutorials
 *
 * @class dt_training_tutorials
 * @version	0.1
 * @since 0.1
 * @package	Disciple_Tools
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class dt_training_tutorials {

    /**
     * dt_training_tutorials The single instance of dt_training_tutorials.
     * @var 	object
     * @access  private
     * @since 	0.1
     */
    private static $_instance = null;

    /**
     * Main dt_training_tutorials Instance
     *
     * Ensures only one instance of dt_training_tutorials is loaded or can be loaded.
     *
     * @since 0.1
     * @static
     * @return dt_training_tutorials instance
     */
    public static function instance () {
        if ( is_null( self::$_instance ) )
            self::$_instance = new self();
        return self::$_instance;
    } // End instance()

    /**
     * Constructor function.
     * @access  public
     * @since   0.1
     */
    public function __construct () {

    } // End __construct()

    /*
     * Tab: Tools
     */
    public function dt_tabs_tutorial_content() {
        ?>
        <div class="wrap"><h2>Tutorials</h2>

        <form id="plugin-filter" method="post">
            <div class="wp-list-table widefat plugin-install">
                <h2 class="screen-reader-text">Plugins list</h2>	<div id="the-list">
                    <div class="plugin-card plugin-card-buddypress">
                        <div class="plugin-card-top">
                            <div class="name column-name">
                                <h3>
                                    <a href="http://disciple.local:8888/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=buddypress&amp;TB_iframe=true&amp;width=772&amp;height=902" class="thickbox open-plugin-details-modal">
                                        BuddyPress						<img src="https://ps.w.org/buddypress/assets/icon.svg?rev=977480" class="plugin-icon" alt="">
                                    </a>
                                </h3>
                            </div>
                            <div class="action-links">
                                <ul class="plugin-action-buttons"><li><a class="install-now button" data-slug="buddypress" href="http://disciple.local:8888/wp-admin/update.php?action=install-plugin&amp;plugin=buddypress&amp;_wpnonce=2a07431f88" aria-label="Install BuddyPress 2.8.2 now" data-name="BuddyPress 2.8.2">Install Now</a></li><li><a href="http://disciple.local:8888/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=buddypress&amp;TB_iframe=true&amp;width=772&amp;height=902" class="thickbox open-plugin-details-modal" aria-label="More information about BuddyPress 2.8.2" data-title="BuddyPress 2.8.2">More Details</a></li></ul>				</div>
                            <div class="desc column-description">
                                <p>BuddyPress helps site builders and WordPress developers add community features to their websites, with user profile fields, activity streams, messagin …</p>
                                <p class="authors"> <cite>By <a href="https://buddypress.org/">The BuddyPress Community</a></cite></p>
                            </div>
                        </div>
                        <div class="plugin-card-bottom">
                            <div class="vers column-rating">
                                <div class="star-rating"><span class="screen-reader-text">4.5 rating based on 354 ratings</span><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-half" aria-hidden="true"></div></div>					<span class="num-ratings" aria-hidden="true">(354)</span>
                            </div>
                            <div class="column-updated">
                                <strong>Last Updated:</strong> 2 months ago				</div>
                            <div class="column-downloaded">
                                200,000+ Active Installs				</div>
                            <div class="column-compatibility">
                                <span class="compatibility-compatible"><strong>Compatible</strong> with your version of WordPress</span>				</div>
                        </div>
                    </div>
                    <div class="plugin-card plugin-card-theme-check">
                        <div class="plugin-card-top">
                            <div class="name column-name">
                                <h3>
                                    <a href="http://disciple.local:8888/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=theme-check&amp;TB_iframe=true&amp;width=772&amp;height=902" class="thickbox open-plugin-details-modal">
                                        Theme Check						<img src="https://ps.w.org/theme-check/assets/icon-128x128.png?rev=972579" class="plugin-icon" alt="">
                                    </a>
                                </h3>
                            </div>
                            <div class="action-links">
                                <ul class="plugin-action-buttons"><li><a class="install-now button" data-slug="theme-check" href="http://disciple.local:8888/wp-admin/update.php?action=install-plugin&amp;plugin=theme-check&amp;_wpnonce=6f679ac1b7" aria-label="Install Theme Check 20160523.1 now" data-name="Theme Check 20160523.1">Install Now</a></li><li><a href="http://disciple.local:8888/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=theme-check&amp;TB_iframe=true&amp;width=772&amp;height=902" class="thickbox open-plugin-details-modal" aria-label="More information about Theme Check 20160523.1" data-title="Theme Check 20160523.1">More Details</a></li></ul>				</div>
                            <div class="desc column-description">
                                <p>A simple and easy way to test your theme for all the latest WordPress standards and practices. A great theme development tool!</p>
                                <p class="authors"> <cite>By <a href="http://ottopress.com">Otto42, pross</a></cite></p>
                            </div>
                        </div>
                        <div class="plugin-card-bottom">
                            <div class="vers column-rating">
                                <div class="star-rating"><span class="screen-reader-text">4.5 rating based on 229 ratings</span><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-half" aria-hidden="true"></div></div>					<span class="num-ratings" aria-hidden="true">(229)</span>
                            </div>
                            <div class="column-updated">
                                <strong>Last Updated:</strong> 5 months ago				</div>
                            <div class="column-downloaded">
                                100,000+ Active Installs				</div>
                            <div class="column-compatibility">
                                <span class="compatibility-untested">Untested with your version of WordPress</span>				</div>
                        </div>
                    </div>
                    <div class="plugin-card plugin-card-bbpress">
                        <div class="plugin-card-top">
                            <div class="name column-name">
                                <h3>
                                    <a href="http://disciple.local:8888/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=bbpress&amp;TB_iframe=true&amp;width=772&amp;height=902" class="thickbox open-plugin-details-modal">
                                        bbPress						<img src="https://ps.w.org/bbpress/assets/icon.svg?rev=978290" class="plugin-icon" alt="">
                                    </a>
                                </h3>
                            </div>
                            <div class="action-links">
                                <ul class="plugin-action-buttons"><li><a class="install-now button" data-slug="bbpress" href="http://disciple.local:8888/wp-admin/update.php?action=install-plugin&amp;plugin=bbpress&amp;_wpnonce=f3a357d9d3" aria-label="Install bbPress 2.5.12 now" data-name="bbPress 2.5.12">Install Now</a></li><li><a href="http://disciple.local:8888/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=bbpress&amp;TB_iframe=true&amp;width=772&amp;height=902" class="thickbox open-plugin-details-modal" aria-label="More information about bbPress 2.5.12" data-title="bbPress 2.5.12">More Details</a></li></ul>				</div>
                            <div class="desc column-description">
                                <p>bbPress is forum software, made the WordPress way.</p>
                                <p class="authors"> <cite>By <a href="https://bbpress.org">The bbPress Community</a></cite></p>
                            </div>
                        </div>
                        <div class="plugin-card-bottom">
                            <div class="vers column-rating">
                                <div class="star-rating"><span class="screen-reader-text">4.0 rating based on 315 ratings</span><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-empty" aria-hidden="true"></div></div>					<span class="num-ratings" aria-hidden="true">(315)</span>
                            </div>
                            <div class="column-updated">
                                <strong>Last Updated:</strong> 5 months ago				</div>
                            <div class="column-downloaded">
                                300,000+ Active Installs				</div>
                            <div class="column-compatibility">
                                <span class="compatibility-compatible"><strong>Compatible</strong> with your version of WordPress</span>				</div>
                        </div>
                    </div>
                    <div class="plugin-card plugin-card-wp-super-cache">
                        <div class="plugin-card-top">
                            <div class="name column-name">
                                <h3>
                                    <a href="http://disciple.local:8888/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=wp-super-cache&amp;TB_iframe=true&amp;width=772&amp;height=902" class="thickbox open-plugin-details-modal">
                                        WP Super Cache						<img src="https://ps.w.org/wp-super-cache/assets/icon-256x256.png?rev=1095422" class="plugin-icon" alt="">
                                    </a>
                                </h3>
                            </div>
                            <div class="action-links">
                                <ul class="plugin-action-buttons"><li><a class="install-now button" data-slug="wp-super-cache" href="http://disciple.local:8888/wp-admin/update.php?action=install-plugin&amp;plugin=wp-super-cache&amp;_wpnonce=7e521fea77" aria-label="Install WP Super Cache 1.4.9 now" data-name="WP Super Cache 1.4.9">Install Now</a></li><li><a href="http://disciple.local:8888/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=wp-super-cache&amp;TB_iframe=true&amp;width=772&amp;height=902" class="thickbox open-plugin-details-modal" aria-label="More information about WP Super Cache 1.4.9" data-title="WP Super Cache 1.4.9">More Details</a></li></ul>				</div>
                            <div class="desc column-description">
                                <p>A very fast caching engine for WordPress that produces static html files.</p>
                                <p class="authors"> <cite>By <a href="https://automattic.com/">Automattic</a></cite></p>
                            </div>
                        </div>
                        <div class="plugin-card-bottom">
                            <div class="vers column-rating">
                                <div class="star-rating"><span class="screen-reader-text">4.5 rating based on 1,208 ratings</span><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-half" aria-hidden="true"></div></div>					<span class="num-ratings" aria-hidden="true">(1,208)</span>
                            </div>
                            <div class="column-updated">
                                <strong>Last Updated:</strong> 3 months ago				</div>
                            <div class="column-downloaded">
                                1+ Million Active Installs				</div>
                            <div class="column-compatibility">
                                <span class="compatibility-compatible"><strong>Compatible</strong> with your version of WordPress</span>				</div>
                        </div>
                    </div>
                    <div class="plugin-card plugin-card-jetpack">
                        <div class="plugin-card-top">
                            <div class="name column-name">
                                <h3>
                                    <a href="http://disciple.local:8888/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=jetpack&amp;TB_iframe=true&amp;width=772&amp;height=902" class="thickbox open-plugin-details-modal">
                                        Jetpack by WordPress.com						<img src="https://ps.w.org/jetpack/assets/icon.svg?rev=969908" class="plugin-icon" alt="">
                                    </a>
                                </h3>
                            </div>
                            <div class="action-links">
                                <ul class="plugin-action-buttons"><li><a class="install-now button" data-slug="jetpack" href="http://disciple.local:8888/wp-admin/update.php?action=install-plugin&amp;plugin=jetpack&amp;_wpnonce=2957a98c8b" aria-label="Install Jetpack by WordPress.com 4.9 now" data-name="Jetpack by WordPress.com 4.9">Install Now</a></li><li><a href="http://disciple.local:8888/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=jetpack&amp;TB_iframe=true&amp;width=772&amp;height=902" class="thickbox open-plugin-details-modal" aria-label="More information about Jetpack by WordPress.com 4.9" data-title="Jetpack by WordPress.com 4.9">More Details</a></li></ul>				</div>
                            <div class="desc column-description">
                                <p>The one plugin you need for stats, related posts, search engine optimization, social sharing, protection, backups, speed, and email list management.</p>
                                <p class="authors"> <cite>By <a href="http://jetpack.com">Automattic</a></cite></p>
                            </div>
                        </div>
                        <div class="plugin-card-bottom">
                            <div class="vers column-rating">
                                <div class="star-rating"><span class="screen-reader-text">4.0 rating based on 1,329 ratings</span><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-empty" aria-hidden="true"></div></div>					<span class="num-ratings" aria-hidden="true">(1,329)</span>
                            </div>
                            <div class="column-updated">
                                <strong>Last Updated:</strong> 1 week ago				</div>
                            <div class="column-downloaded">
                                1+ Million Active Installs				</div>
                            <div class="column-compatibility">
                                <span class="compatibility-compatible"><strong>Compatible</strong> with your version of WordPress</span>				</div>
                        </div>
                    </div>
                    <div class="plugin-card plugin-card-akismet">
                        <div class="plugin-card-top">
                            <div class="name column-name">
                                <h3>
                                    <a href="http://disciple.local:8888/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=akismet&amp;TB_iframe=true&amp;width=772&amp;height=902" class="thickbox open-plugin-details-modal">
                                        Akismet						<img src="https://ps.w.org/akismet/assets/icon-256x256.png?rev=969272" class="plugin-icon" alt="">
                                    </a>
                                </h3>
                            </div>
                            <div class="action-links">
                                <ul class="plugin-action-buttons"><li><a class="install-now button" data-slug="akismet" href="http://disciple.local:8888/wp-admin/update.php?action=install-plugin&amp;plugin=akismet&amp;_wpnonce=b3820df7ee" aria-label="Install Akismet 3.3.2 now" data-name="Akismet 3.3.2">Install Now</a></li><li><a href="http://disciple.local:8888/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=akismet&amp;TB_iframe=true&amp;width=772&amp;height=902" class="thickbox open-plugin-details-modal" aria-label="More information about Akismet 3.3.2" data-title="Akismet 3.3.2">More Details</a></li></ul>				</div>
                            <div class="desc column-description">
                                <p>Akismet checks your comments and contact form submissions against our global database of spam to protect you and your site from malicious content.</p>
                                <p class="authors"> <cite>By <a href="https://automattic.com/wordpress-plugins/">Automattic</a></cite></p>
                            </div>
                        </div>
                        <div class="plugin-card-bottom">
                            <div class="vers column-rating">
                                <div class="star-rating"><span class="screen-reader-text">5.0 rating based on 751 ratings</span><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div><div class="star star-full" aria-hidden="true"></div></div>					<span class="num-ratings" aria-hidden="true">(751)</span>
                            </div>
                            <div class="column-updated">
                                <strong>Last Updated:</strong> 3 hours ago				</div>
                            <div class="column-downloaded">
                                1+ Million Active Installs				</div>
                            <div class="column-compatibility">
                                <span class="compatibility-compatible"><strong>Compatible</strong> with your version of WordPress</span>				</div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <?php
    }

}