<?php

class Common_model extends CI_Model {

    var $db_read = NULL;

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        //$this->db = $this->load->database();
    }

    function temples() {
        $this->db->select('id,slug,name');
        $this->db->from($this->db->dbprefix('temples'));
        $query = $this->db->get()->result();
        return $query;
    }

}