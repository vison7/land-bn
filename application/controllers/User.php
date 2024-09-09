<?php

class User extends CI_Controller {

    var $permission = array('2'=>'Admin','3'=>'Editor','4'=>'Viewer');
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // admin
    function index() {
        admin_check_level(array(
            '1'
        ));

        // get page
        $page_no = (isset($_REQUEST['page_no'])) ? $_REQUEST['page_no'] : 1;
        $page_size = 20;
        $offset = ($page_size * $page_no) - $page_size;

        $this->db->select('t1.*,t2.name AS temple_name');
        $this->db->from($this->db->dbprefix('users').' t1');
        $this->db->join($this->db->dbprefix('temples') .' t2', 't1.temple_id = t2.id', 'left');
        $this->db->where('t1.is_level !=', '1');
        $this->db->limit($page_size, $offset);
        $this->db->order_by("t1.id", "desc");
        $data['query'] = $this->db->get()->result();

        // count all
        $this->db->where('is_level !=', '1');
        $this->db->from($this->db->dbprefix('users'));
        $count_all = $this->db->count_all_results();

        // paging config
        $data['total_item'] = $count_all;
        $data['page_size'] = $page_size;
        $data['page_no'] = $page_no;
        // total page
        $page_total = ceil($count_all / $page_size);
        $data['page_total'] = $page_total;

        $data['permission'] = $this->permission;

        $this->load->view('layouts/admin_header');
        $this->load->view('user/index', $data);
        $this->load->view('layouts/admin_footer');
    }

    function add() {
        admin_check_level(array(
            '1'
        ));

        $data['permission'] = $this->permission;
        $data['temple'] = $this->temples();

        $this->load->view('layouts/admin_header');
        $this->load->view('user/add',$data);
        $this->load->view('layouts/admin_footer');
    }

    function check_username() {
        $this->db->select('username');
        $this->db->from($this->db->dbprefix('users'));
        $this->db->where('username', $_REQUEST['username']);
        $query = $this->db->get();

        if ($query->num_rows > 0)
            echo 'false';
        else
            echo 'true';
    }

    function check_email($id = '') {
        $this->db->select('email');
        $this->db->from($this->db->dbprefix('users'));
        $this->db->where('email', $_REQUEST['email']);
        if ($id != '')
            $this->db->where('id !=', $id);

        $query = $this->db->get();

        if ($query->num_rows > 0)
            echo 'false';
        else
            echo 'true';
    }

    function add_data() {
        admin_check_level(array(
            '1'
        ));

        $query = $this->db->get_where($this->db->dbprefix('users'), array(
            'username' => $_POST['username']
                ), 1);
        if ($query->num_rows() > 0) {
            redirect('user/add?code=warning&str=User duplicate');
        } else {
            $data = array(
                'username' => $_POST['username'],
                'password' => base64_encode($_POST['password']),
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'temple_id' => $_POST['temple_id'],
                'is_level' => $_POST['is_level'],
                'is_status' => (isset($_POST['is_status'])) ? $_POST['is_status'] : 'inactive',
                'created' => date("Y/m/d H:i:s"),
                'createdby' => get_admin_login()->username
            );

            if ($this->db->insert($this->db->dbprefix('users'), $data)) {
                redirect('user/add?code=success&str=Add data sucess');
            } else {
                redirect('user/add?code=danger&str=Add data error');
            }
        }
    }

    function edit($id = '') {
        admin_check_level(array(
            '1'
        ));

        $data['permission'] = $this->permission;
        $data['temple'] = $this->temples();

        $query = $this->db->get_where($this->db->dbprefix('users'), array(
            'id' => $id
                ), 1);
        $data['query'] = $query->result();

        $this->load->view('layouts/admin_header');
        $this->load->view('user/edit', $data);
        $this->load->view('layouts/admin_footer');
    }

    function edit_data() {
        admin_check_level(array(
            '1'
        ));

        $id = $_POST['id'];
        $data = array(
            'password' => base64_encode($_POST['password']),
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'temple_id' => $_POST['temple_id'],
            'is_level' => $_POST['is_level'],
            'is_status' => (isset($_POST['is_status'])) ? $_POST['is_status'] : 'inactive',
            'modified' => date("Y/m/d H:i:s"),
            'modifiedby' => get_admin_login()->username
        );
        $this->db->where('id', $id);
        $this->db->update($this->db->dbprefix('users'), $data);
        redirect('user/edit/' . $id . '?code=success&str=Edit data sucess');
    }

    function data_delete() {
        admin_check_level(array(
            '1'
        ));

        if (!empty($_REQUEST["id"])) {
            $arr_id = explode(',', $_REQUEST["id"]);
            $this->db->where_in('id', $arr_id);
            $this->db->delete($this->db->dbprefix('users'));
        }
        redirect('user?code=success&str=Delete data sucess');
    }

    function set_status($status = 'active') {
        admin_check_level(array(
            '1'
        ));
        if (!empty($_REQUEST["id"])) {
            $arr_id = explode(',', $_REQUEST["id"]);
            $data = array(
                'is_status' => $status
            );
            $this->db->where_in('id', $arr_id);
            $this->db->update($this->db->dbprefix('users'), $data);
        }
        redirect('user?code=success&str=Edit data sucess');
    }

    function edit_profile() {
        admin_check_access();

        $query = $this->db->get_where($this->db->dbprefix('users'), array(
            'id' => get_admin_login()->id
                ), 1);
        $data['query'] = $query->result();

        $this->load->view('layouts/admin_header');
        $this->load->view('user/edit_profile', $data);
        $this->load->view('layouts/admin_footer');
    }

    function update_profile() {
        admin_check_access();
        $data = array(
            'password' => base64_encode($_POST['password']),
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'modified' => date("Y/m/d H:i:s"),
            'modifiedby' => get_admin_login()->username
        );
        $this->db->where('id', get_admin_login()->id);
        $this->db->update($this->db->dbprefix('users'), $data);
        redirect('user/edit_profile?str=Edit data success');
    }

    function temples() {
        $this->db->select('id,slug,name');
        $this->db->from($this->db->dbprefix('temples'));
        $query = $this->db->get()->result();
        return $query;
    }
}

/* End of file user.php */
/* Location: ./system/application/controllers/user.php */