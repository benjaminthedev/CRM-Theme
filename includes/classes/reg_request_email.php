<?php

/**

 * User: benjaminthdev
 * Date: 12/07/2017
 * Time: 15:50
 */


class reg_request_email extends WC_Email
{

    public $form_data;

    public $user_email;

    public $subject;

    public $is_admin;

    public function __construct()
    {

        $this->id = 'customer_request_account';
        $this->customer_email = true;

        $this->title = __('New account', 'woocommerce');
        $this->description = __('Customer "new account" emails are sent to the customer when a customer signs up via checkout or account pages.', 'woocommerce');

        $this->template_html = 'emails/customer-req-account.php';

        // Call parent constructor
        parent::__construct();
    }


    public function trigger($form_data, $admin = false)
    {

        if ($form_data) {

            $this->form_data = $form_data;

            $this->is_admin = $admin;

            $this->recipient = $admin ? get_option('admin_email') : $form_data['email'];

            $this->subject = $admin ? "A new user has requested a trade account on CRM" : 'You have requested a trade account on CRM';

            $this->setup_locale();
            $this->send($this->get_recipient(), $this->subject, $this->get_content_html(), $this->get_headers(), $this->get_attachments());
            $this->restore_locale();

        }

    }

    /**
     * Get content html.
     *
     * @access public
     * @return string
     */
    public function get_content_html()
    {
        return wc_get_template_html($this->template_html, array(
            'email_heading' => $this->subject,
            'form_data' => $this->form_data,
            'is_admin' => $this->is_admin,
            'blogname' => $this->get_blogname(),
            'sent_to_admin' => false,
            'plain_text' => false,
            'email' => $this,
        ));
    }

}