<?php

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        admin_check_level(array(
            '1','2','3','4'
        ));
        $this->load->database();
    }

    public function index() {
        $this->load->view('layouts/admin_header');
        $this->load->view('layouts/admin_footer');
    }

}

/* End of file */