<?php

class Member extends CI_Controller
{

    public $permission = array('2' => 'Admin', '3' => 'Editor', '4' => 'Viewer');
    public $view_path = 'member';

    public function __construct()
    {
        parent::__construct();
        admin_check_level(array(
            '1','2'
        ));

        $this->load->database();
        $this->table_name = $this->db->dbprefix('members');
    }

    // admin
    public function index()
    {
        
        // get page
        $page_no = (isset($_REQUEST['page_no'])) ? $_REQUEST['page_no'] : 1;
        $page_size = 20;
        $offset = ($page_size * $page_no) - $page_size;

        $username = (isset($_REQUEST['username'])) ? $_REQUEST['username'] : '';
        $firstname = (isset($_REQUEST['firstname'])) ? $_REQUEST['firstname'] : '';

        //$this->db->select('t1.*,t2.name AS temple_name');
        $this->db->from($this->table_name);
        $this->db->limit($page_size, $offset);
        if (!empty($username)) {
            $this->db->like('username', $username);
        }
        if (!empty($firstname)) {
            $this->db->like('firstname', $firstname);
        }
        $this->db->order_by("id", "desc");
        $data['query'] = $this->db->get()->result();

        // count all
        $this->db->from($this->table_name);
        if (!empty($username)) {
            $this->db->like('username', $username);
        }
        if (!empty($firstname)) {
            $this->db->like('firstname', $firstname);
        }
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
        $this->load->view($this->view_path .'/index', $data);
        $this->load->view('layouts/admin_footer');
    }


    public function edit($id = '')
    {

        $query = $this->db->get_where($this->table_name, array(
            'id' => $id,
        ), 1);
        $data['query'] = $query->result();

        $this->load->view('layouts/admin_header');
        $this->load->view($this->view_path .'/edit', $data);
        $this->load->view('layouts/admin_footer');
    }

    public function edit_data()
    {

        $id = $_POST['id'];
        $data = array(
            'firstname' => $_POST['firstname'],
            'email' => $_POST['email'],
            'lastname' => $_POST['lastname'],
            'is_status' => (isset($_POST['is_status'])) ? $_POST['is_status'] : 'inactive',
            'modified' => date("Y/m/d H:i:s"),
            'modifiedby' => get_admin_login()->username,
        );
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
        redirect($this->view_path .'/edit/' . $id . '?code=success&str=Edit data sucess');
    }

    public function data_delete()
    {

        if (!empty($_REQUEST["id"])) {
            $arr_id = explode(',', $_REQUEST["id"]);
            $this->db->where_in('id', $arr_id);
            $this->db->delete($this->table_name);
        }
        redirect($this->view_path .'?code=success&str=Delete data sucess');
    }

    public function set_status($status = 'active')
    {

        if (!empty($_REQUEST["id"])) {
            $arr_id = explode(',', $_REQUEST["id"]);
            $data = array(
                'is_status' => $status,
            );
            $this->db->where_in('id', $arr_id);
            $this->db->update($this->table_name, $data);
        }
        redirect($this->view_path .'?code=success&str=Edit data sucess');
    }

}

/* End of file user.php */
/* Location: ./system/application/controllers/user.php */
