<?php

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Keys.php';

class Contact extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();

        Keys::verify_token();

        $this->load->database();
    }

    public function register_post()
    {
        $this->load->model('contact_model');
        $res = $this->contact_model->register($this->post());
        $this->response($res);
    }

}
