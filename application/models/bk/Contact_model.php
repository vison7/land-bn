<?php

class Contact_model extends CI_Model
{

    public $db_read = null;
    public $contactus = '';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->contactus = $this->db->dbprefix('contactus');
    }

    public function register($data)
    {
        
        $data['created'] = date('Y-m-d H:i:s');
        //$res = array('code' => 200, 'message' => 'OK','data'=>$data);
        if (@$this->db->insert($this->contactus, $data)) {
            $res = array('code' => 200, 'message' => 'OK');
        } else {
            $res = array('code' => 500, 'message' => 'Internal server error');
        }
        return $res;

    }

    
}
