<?php

class Member_model extends CI_Model
{

    public $db_read = null;
    public $table_name = '';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table_name = $this->db->dbprefix('members');

    }

    public function auth($keyword = array())
    {
        $username = $keyword['username'];
        $password = $keyword['password'];

        $this->db->select('id,username,displayname');
        $this->db->from($this->table_name);
        $this->db->where('username', $username);
        $this->db->where('password', base64_encode($password));
        $this->db->where('is_status', 'active');
        //$this->db->where_in('is_level', array('1','2', '3'));
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result[0];

        } else {
            return null;
        }
    }

    public function register($data)
    {
        $data['password'] = base64_encode($data['password']);

        $query = $this->db->get_where($this->table_name, array(
            'username' => $data['username'],
        ), 1);
        if ($query->num_rows() > 0) {
            $res = array('code' => 404, 'message' => 'Username duplicate');
        } else {

            $query_email = $this->db->get_where($this->table_name, array(
                'email' => $data['email'],
            ), 1);
            if ($query_email->num_rows() > 0) {
                $res = array('code' => 400, 'message' => 'Email duplicate');
            } else {
                $data['created'] = date("Y-m-d H:i:s");
                if (@$this->db->insert($this->table_name, $data)) {
                    $res = array('code' => 200, 'message' => 'OK');
                } else {
                    $res = array('code' => 500, 'message' => 'Internal server error');
                }
            }

        }
        return $res;

    }

    public function check_username()
    {
        $this->db->select('username');
        $this->db->from($this->table_name);
        $this->db->where('username', $_REQUEST['username']);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            echo 'false';
        } else {
            echo 'true';
        }

    }

    public function check_email($id = '')
    {
        $this->db->select('email');
        $this->db->from($this->table_name);
        $this->db->where('email', $_REQUEST['email']);
        if ($id != '') {
            $this->db->where('id !=', $id);
        }

        $query = $this->db->get();

        if ($query->num_rows > 0) {
            echo 'false';
        } else {
            echo 'true';
        }

    }

    public function profile_by_email($email = '')
    {
        $query = $this->db->get_where($this->table_name, array(
            "email" => $email,
        ));
        $data['data'] = $query->result();
        return $data;
    }

    public function profile($id)
    {
        $this->db->select('*,CONCAT( \'' . base_url() . '\',`thumb` ) AS thumb');
        $query = $this->db->get_where($this->table_name, array(
            "id" => $id,
        ));

        $data['data'] = $query->result();

        return $data;
    }

    public function update_profile($data)
    {
        $thumb = '';
        if (isset($data['thumb']) && !empty($data['thumb'])) {
            $content = base64_decode($data['thumb']); //base64 string
            $thumb = 'data/avatar/' . $data['id'] . '.png';
            $file = fopen('data/avatar/' . $data['id'] . '.png', "wb");
            fwrite($file, $content);
            fclose($file);
        }

        $data['modified'] = date("Y-m-d H:i:s");

        if ($thumb != '') {
            $data['thumb'] = $thumb;
        }else{
            unset($data['thumb']);
        }

        $this->db->where('id', $data['id']);
        $this->db->update($this->table_name, $data);

        $res = array('code' => 200, 'message' => 'OK');
        return $res;

    }

    public function update_password($data)
    {
        $id = $data['id'];
        $password = $data['old_pass'];

        $this->db->select('id,username,displayname');
        $this->db->from($this->table_name);
        $this->db->where('id', $id);
        $this->db->where('password', base64_encode($password));
        //$this->db->where('is_status', 'active');
        //$this->db->where_in('is_level', array('1','2', '3'));
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $update = array(
                'password'=> base64_encode($data['new_pass'])
            );
            $this->db->where('id', $data['id']);
            $this->db->update($this->table_name, $update);
    
            $res = array('code' => 200, 'message' => 'OK');

        } else {
            $res = array('code' => 404, 'message' => 'Old password is not match');
        }

        return $res;
    }

    public function reset_password($data)
    {
        $id = $data['id'];
        $email = $data['email'];

        $this->db->select('id,username,displayname');
        $this->db->from($this->table_name);
        $this->db->where('id', $id);
        $this->db->where('email', $email);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $update = array(
                'password'=> base64_encode($data['pass'])
            );
            $this->db->where('id', $data['id']);
            $this->db->update($this->table_name, $update);
    
            $res = array('code' => 200, 'message' => 'OK');

        } else {
            $res = array('code' => 404, 'message' => 'Old password is not match');
        }

        return $res;
    }
}
