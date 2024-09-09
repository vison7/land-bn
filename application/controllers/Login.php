<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function auth() {
        $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
        $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';

        $this->db->select('id,username,name,is_level,temple_id');
        $this->db->from($this->db->dbprefix('users'));
        $this->db->where('username', $username);
        $this->db->where('password', base64_encode($password));
        $this->db->where('is_status', 'active');
        //$this->db->where_in('is_level', array('1','2', '3'));
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->result();
            $value = json_encode($result[0]);

            $value_encrypt = string_encrypt($value);
            setcookie("admininfo", $value_encrypt, NULL, "/");

            redirect('dashboard');
        } else {
            redirect('/?str=Invalid username or password. please try again.');
        }
    }

    public function logout() {
        setcookie("admininfo", null, time() - 3600, "/");
        redirect('/');
    }

}

/* End of file  */
