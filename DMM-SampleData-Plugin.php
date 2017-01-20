<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Plugin Name: Sample Data for DMM CRM Project
 * Plugin URI: https://github.com/ChasmSolutions/dmm-crm-sample-data
 * Description: Sample Data for DMM CRM Project
 * Version: 0.0.1
 * Author: Chasm.Solutions & Kingdom.Training
 * Author URI: https://github.com/ChasmSolutions
 */
 
if (get_option( 'add_sample_contacts' ) !== '1') {
	
	add_action( 'admin_menu', 'sample_data_menu' );

	
	function sample_data_menu() {
		add_options_page( 'Add Sample Contacts', 'Add Sample Contacts', 'manage_options', 'sample-contacts-data', 'my_plugin_options' );
	}

	
	function my_plugin_options() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		echo '<div class="wrap">';
		echo '<h1>Add Sample Contacts</h1>
			<p>';
		
			$contacts = array("Taruh Moukib", "Buthaynah Wasim", "Bari Waql");
		
			foreach ($contacts as $value) {
				$post_title = $value;
				//$post_type = 'dmm_contact';
				$post_content = ' ';
				$post_status = "publish";
				$post_author = get_current_user_id();
				
				$post = array(
					"post_title"   => $post_title,
					//'post_type' => $post_type,
					"post_content" => $post_content,
					"post_status"  => $post_status,
					"post_author"  => $post_author,
				);
				wp_insert_post( $post );
				echo "Added: " . $post_title;
			}
		
			
		echo '</p></div>';
		
		$option = 'add_sample_contacts';
		$value = '1';
		$deprecated = '';
		$autoload = TRUE;
		
		add_option( $option, $value, $deprecated, $autoload );
	}
}

if (get_option( 'reset_sample_options' ) !== '1') {
	add_action( 'admin_menu', 'sample_reset_menus' );
	
	function sample_reset_menus() {
		add_options_page( 'Reset Sample Data', 'Reset Sample Data', 'manage_options', 'sample-contacts-data', 'reset_sample_options' );
	}
	
	function reset_sample_options() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		echo '<div class="wrap">';
		echo '<h1>Reset Sample Data</h1>';
		
		delete_option( 'add_sample_contacts' );
		echo '<p>Contacts Reset</p>';
	}
}