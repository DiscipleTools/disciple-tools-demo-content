<?php

/*
 * Class for creating sample contacts
 *
 * @package dmm-crm-sample-data
 * */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class dt_sample_contacts
{

    /**
     * dt_sample_contacts The single instance of dt_sample_contacts.
     * @var    object
     * @access  private
     * @since    1.0.0
     */
    private static $_instance = NULL;

    /**
     * Access plugin instance. You can create further instances by calling
     * the constructor directly.
     * @since 0.1
     * @static
     * @return dt_sample_contacts instance
     */
    public static function instance()
    {
        if (NULL === self::$_instance)
            self::$_instance = new self;
        return self::$_instance;
    }

    // Constructor class
    public function __construct() {}

    /*
     * Sets a check so that the groups are added only one time.
     *
     *
     * @return string
     */
    public function add_contacts_once () {
        $html = '';

        if (get_option('add_sample_contacts') !== '1') {

            $html .= $this->add_contacts();

            $option = 'add_sample_contacts';
            $value = '1';
            $deprecated = '';
            $autoload = TRUE;

            add_option($option, $value, $deprecated, $autoload);

        } else {
            $html .= '<p>Contacts are already loaded. <form method="POST"><button type="submit" value="reset_contacts" name="submit" class="button" id="reset_contacts">Load the sample contacts again?</button></p>';
        }
        return $html;
    }

    protected function add_contacts ()
    {
        $html = '';

        $contacts = array(
            array("title" => "Taruh Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Buthaynah Wasim", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Bari Waql", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Aysha Rasha", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mohammed Poke", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Aziza Rasha", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Dalia Melek", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Fadil Eisa", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Fadilah Talitha", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Faris", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Fatin Tarique", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mahir Mohammed", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Majida", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Maysa Azzam", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mohammed Parah", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mohamad", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mohammed", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mohammed Mudawar", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mohammed Tunisia", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mukhtar", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Musad Dawud", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Qaseem Maysun", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Rahi Atiya", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Rashid Manal", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Tahir", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Tahu Fatima", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Tarik", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Taruh Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Usama Gadi", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Abd al Alim", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Taruh Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Alsha Lela", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Taruh Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Buthaynah Wasim", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Bari Waql", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Aysha Moukib Rasha", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mohammed Moukib Poke", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Aziza Moukib Rasha", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Dalia Melek", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Fadil Moukib Eisa", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Fadilah Talitha", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Faris Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Fatin Moukib Tarique", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mahir Mohammed", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Majida Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Maysa Moukib Azzam", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mohammed Parah", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mohamad", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mohammed Moukib", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mohammed Moukib Mudawar", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mohammed Moukib Tunisia", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mukhtar Tarik", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Musad Tarik Dawud", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Qaseem Maysun", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Rahi Atiya", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Rashid Manal", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Tahir Tarik", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Tahu Tarik Fatima", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Tarik", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Taruh Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Usama Gadi", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Abd al Alim", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Taruh Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Alsha Lela", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Fadilah Talitha", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Faris Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Fatin Moukib Tarique", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mahir Mohammed", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Majida Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Maysa Moukib Azzam", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mohammed Parah", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mohamad", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mohammed Moukib", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mohammed Moukib Mudawar", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mohammed Moukib Tunisia", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Mukhtar Tarik", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Musad Tarik Dawud", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Qaseem Maysun", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Rahi Atiya", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Rashid Manal", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Tahir Tarik", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Tahu Tarik Fatima", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Tarik", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Taruh Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Usama Gadi", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Abd al Alim", "phone" => "303-212-8743", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Taruh Moukib", "phone" => "720-212-8535", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
            array("title" => "Alsha Lela", "phone" => "720-212-9771", "overall_status" => "Unassigned", "email" => "email@email.com", "preferred_contact_method" => "Phone", "seeker_path" => "Contact Attempted", "seeker_milestones" => "States Belief"),
        );

        foreach ($contacts as $contact) {

            $post_title = $contact["title"];
            $post_type = 'contacts';
            $post_content = ' ';
            $post_status = "publish";
            $post_author = get_current_user_id();

            $post = array(
                "post_title" => $post_title,
                'post_type' => $post_type,
                "post_content" => $post_content,
                "post_status" => $post_status,
                "post_author" => $post_author,
                "meta_input" => array(
                    "phone" => $contact["phone"],
                    "seeker_path" => $contact["seeker_path"],
                    "seeker_milestones" => $contact["seeker_milestones"],
                    "overall_status" => $contact["overall_status"],
                    "email" => $contact["email"],
                    "preferred_contact_method" => $contact["preferred_contact_method"],
                ),
            );

            wp_insert_post($post);

            $html .= '<br>Added: ' . $post_title;
        }

        $html .= '<br><br>' . count($contacts) . ' contacts added</p></div>' ;
     return $html;
    }

    /*
     * Resets the if option for groups
     *
     * @return string
     *
     */
    public function reset_contacts () {
        delete_option('add_sample_contacts');
        $html = $this->add_contacts_once();
        return $html;
    }



    /**
     * Loops contact creation according to supplied $count.
     * @param $count    int Number of records to create.
     * @return string
     */
    public function add_contacts_by_count ($count)
    {
        $i = 0;
        while ($count > $i ) {

            $post = $this->single_plain_contact();
            wp_insert_post($post);

            $i++;
        }
        return $count . ' records created';
    }

    /**
     * Builds a single random contact record.
     * @return array|WP_Post
     */
    public function single_plain_contact () {

        $name = dt_sample_random_name ();

        $post = array(
            "post_title" => $name . ' Contact' . rand(100, 999),
            'post_type' => 'contacts',
            "post_content" => ' ',
            "post_status" => "publish",
            "post_author" => get_current_user_id(),
            "meta_input" => array(
                "phone" => dt_sample_random_phone_number(),
                "overall_status" => dt_sample_random_overall_status(),
                "email" => $name.rand(1000, 10000)."@email.com",
                "preferred_contact_method" => dt_sample_random_preferred_contact_method (),
                "source_details"    =>  dt_sample_random_source (),
                "seeker_path"   =>  dt_sample_seeker_path(),
            ),
        );

        return $post;

    }

    /**
     * Delete all contacts in database
     * @return string
     */
    public function delete_contacts () {

        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'contacts'
        );
        $contacts = get_posts( $args );

        foreach ($contacts as $contact) {
            $id = $contact->ID;
            wp_delete_post( $id, 'true');
        }

        return 'Contacts deleted';

    }

    public function shuffle_assignments () {
        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'contacts'
        );
        $contacts = get_posts( $args );

        $args = array(
            'fields'       => 'all',
            'role__in'     => array('multiplier', 'multiplier_leader', 'administrator'),
            'count_total'  => true,
        );
        $users = get_users( $args );

        $user_count = count($users);

        foreach ($contacts as $contact) {

            $user = $users[rand(0, $user_count - 1)];

            $post_id = $contact->ID;
            $meta_key = 'assigned_to';
            $meta_value = 'user-' . $user->ID;

            update_post_meta( $post_id, $meta_key, $meta_value );
        }

        return 'Assignments shuffled for all contacts between multipliers, multiplier leaders, and administrators (for testing).';
    }


    public function shuffle_update_requests () {
        $args = array(
            'numberposts'   => -1,
            'post_type'   => 'contacts'
        );
        $contacts = get_posts( $args );


        foreach ($contacts as $contact) {

            $post_id = $contact->ID;
            $meta_key = 'requires_update';
            $meta_value = dt_sample_random_requires_upate();

            update_post_meta( $post_id, $meta_key, $meta_value );
        }

        return 'Update requests shuffled for all contacts.';
    }


}