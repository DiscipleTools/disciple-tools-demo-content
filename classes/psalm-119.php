<?php

/*
 * Plugin Name: Psalm 119
 * Plugin URI: https://github.com/ChasmSolutions/psalm-119
 * Author: Chasm Solutions
 * Author URI: https://chasm.solutions
 * Description: Add an encouraging line from Psalm 119 to the admin section of your Wordpress. Based on Matt Mullenweg's Hello Dolly plugin.
 * Version: 1.0 
 * Requires at least: 4.3.0
 * Tested up to: 4.7.0
 *
 * Copyright: 2017 Chasm Solutions
 * License:   GPL-3.0
 *
 * Many thanks to Matt Mullenweg's famous 'Hello Dolly' plugin that starts with every Wordpress install. 'Hello Dolly' is great, but for 
 * those of us who love Jesus and the Bible, Psalms 119 is incomparably more inspiring.
 *
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if ( !class_exists('Psalm_119' ) ) {
	
	// Load Psalm_119 class
	final class Psalm_119 {
		
		// Public contructor
		public function __construct () {
			add_action( 'admin_notices', array($this, 'get_psalm') );
			add_action( 'admin_head', array($this, 'psalm_css') );
		} // End __construct()
		
		// Parsing verses
		protected function get_psalm_exerpt() {
			/** These are exerpts from Psalm 119 */
			$lyrics = "Open my eyes that I may see
		Blessed are those who keep His statutes
		I am a stranger on earth
		Your statutes are my delight
		I seek You with all my heart
		Do not let me stray from Your commands
		I have hidden Your word in my heart
		Preserve my life according to Your word
		My soul is weary with sorrow; strengthen me according to Your word
		Give me understanding, so that I may keep Your law
		Turn my eyes away from worthless things
		Preserve my life according to Your word
		May Your unfailing love come to me, Lord
		I will always obey Your law
		I will speak of Your statutes before kings
		Remember Your word to Your servant
		Your promise preserves my life
		You are my portion, Lord
		I have sought Your face with all my heart
		Be gracious to me according to Your promise
		I am a friend to all who fear You
		Teach me knowledge and good judgment
		You are good, and what You do is good
		Your hands made me and formed me
		May Your unfailing love be my comfort
		Let Your compassion come to me that I may live
		My soul faints with longing for Your salvation
		In Your unfailing love preserve my life
		Praise be to You, Lord; teach me Your decrees";
		
			// split into lines
			$lyrics = explode( "\n", $lyrics );
		
			// randomly choose a line
			return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
		}
		
		// Echo the verse
		public function get_psalm() {
			$chosen = $this->get_psalm_exerpt();
			echo "<p id='psalm'>$chosen</p>";
		}
		
		// Prepare the css and positioning
		public function psalm_css() {
			// This makes sure that the positioning is also good for right-to-left languages
			$x = is_rtl() ? 'left' : 'right';
		
			echo "
			<style type='text/css'>
			#psalm {
				float: $x;
				padding-$x: 15px;
				padding-top: 5px;		
				margin: 0;
				font-size: 11px;
			}
			</style>
			";
		}
	
	}
	$Psalm_119 = new Psalm_119();
}