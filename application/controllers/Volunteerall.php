<?php

class Volunteerall extends CI_Controller {

    var $table_name = '';
    var $content_type = 2;
    var $view_path = 'volunteerall';
    public $my_temple_id = '';

    public function __construct() {
        parent::__construct();
        admin_check_level(array(
            '1',
            '2',
            '3',
            '4'
        ));

        $this->my_temple_id = admin_get_temple();

        $this->load->database();
        $this->table_name = $this->db->dbprefix('volunteers');
    }

    // admin
    function index() {
        // get page
        $page_no = (isset($_REQUEST['page_no'])) ? $_REQUEST['page_no'] : 1;
        $page_size = 10;
        $offset = ($page_size * $page_no) - $page_size;

        // search
        if($this->my_temple_id == '')
            $temple_id = (isset($_REQUEST['temple_id'])) ? $_REQUEST['temple_id'] : '';
        else
            $temple_id = $this->my_temple_id;

        $title = (isset($_REQUEST['name'])) ? $_REQUEST['name'] : '';
        $content_type = (isset($_REQUEST['content_type'])) ? $_REQUEST['content_type'] : '';

        // search
        $this->db->select('t1.*');
        $this->db->from($this->table_name .' t1');
        $this->db->join($this->db->dbprefix('temples') .' t2', 't1.temple_id = t2.id', 'left');
        $this->db->limit($page_size, $offset);
        $this->db->order_by("t1.id", "DESC");
        if ($temple_id !='') {
            $this->db->where('t1.temple_id', $temple_id);
        }
        if (!empty($title)) {
            $this->db->like('t1.name', $title);
        }
        if (!empty($content_type)) {
            $this->db->where('t1.content_type', $content_type);
        }
        $data['query'] = $this->db->get()->result();

        // count all
        $this->db->from($this->table_name);
        if ($temple_id !='') {
            $this->db->where('temple_id', $temple_id);
        }
        if (!empty($title)) {
            $this->db->like('name', $title);
        }
        if (!empty($content_type)) {
            $this->db->where('content_type', $content_type);
        }
        $count_all = $this->db->count_all_results();

        // paging config
        $data['total_item'] = $count_all;
        $data['page_size'] = $page_size;
        $data['page_no'] = $page_no;
        // total page
        $page_total = ceil($count_all / $page_size);
        $data['page_total'] = $page_total;

        $data['str_query'] = "";

        $this->load->model('common_model');
        $data['temple'] = $this->common_model->temples();

        $this->load->view('layouts/admin_header');
        $this->load->view($this->view_path . '/index', $data);
        $this->load->view('layouts/admin_footer');
    }

    function add() {
        $this->load->model('common_model');
        $data['temple'] = $this->common_model->temples();

        $this->load->view('layouts/admin_header');
        $this->load->view($this->view_path . '/add',$data);
        $this->load->view('layouts/admin_footer');
    }

    function add_data() {
        $this->load->helper('upload');

        // image 1
        $path_filename1 = '';
        if (isset($_FILES["thumb"]) && !empty($_FILES['thumb']) && $_FILES["thumb"]["name"] != "") {
            $path = date("Y/m/d");
            $new_file_name = str_replace('/', '', $path) . date("His") . mt_rand(10, 99);

            $filename = explode(".", $_FILES["thumb"]["name"]);
            $filenameext = $filename[count($filename) - 1];
            $full_path_thumb = $new_file_name . '.' . $filenameext;

            // upload file
            $target = create_folder_by_date(PATH_FILE_IMAGE, $path);
            $save_path = PATH_FILE_IMAGE . $target;

            upload_image($save_path, $_FILES["thumb"], $new_file_name);
            $path_filename1 = $save_path . $full_path_thumb;
        }

        $data = array(
            'content_type' => $_POST['content_type'],
            'name' => $_POST['name'],
            'position' => $_POST['position'],
            'description' => $_POST['description'],
            'detail' => $_POST['detail'],
            'thumb' => $path_filename1,
            'facebook' => $_POST['facebook'],
            'googleplus' => $_POST['googleplus'],
            'ig' => $_POST['ig'],
            'is_status' => $_POST['is_status'],
            'created' => date("Y/m/d H:i:s"),
            'createdby' => get_admin_login()->username
        );

        if ($this->db->insert($this->table_name, $data)) {
            // $content_id = $this->db->insert_id();
            redirect($this->view_path . '/add?code=success&str=Add data sucess');
        } else {
            redirect($this->view_path . '/add?code=danger&str=Add data error');
        }
    }

    function edit($id = '') {
        $this->load->model('common_model');
        $data['temple'] = $this->common_model->temples();

        $query = $this->db->get_where($this->table_name, array(
            'id' => $id
                ), 1);
        $data['query'] = $query->result();

        $this->load->view('layouts/admin_header');
        $this->load->view($this->view_path . '/edit', $data);
        $this->load->view('layouts/admin_footer');
    }

    function edit_data() {

        $this->load->helper('upload');

        $id = $_POST['id'];

        $data_thumb = array();
        if (isset($_FILES["thumb"]) && !empty($_FILES['thumb']) && $_FILES["thumb"]["name"] != "") {
            $path = date("Y/m/d");
            $new_file_name = str_replace('/', '', $path) . date("His") . mt_rand(10, 99);

            $filename = explode(".", $_FILES["thumb"]["name"]);
            $filenameext = $filename[count($filename) - 1];
            $full_path_thumb = $new_file_name . '.' . $filenameext;

            // upload file
            $target = create_folder_by_date(PATH_FILE_IMAGE, $path);
            $save_path = PATH_FILE_IMAGE . $target;

            upload_image($save_path, $_FILES["thumb"], $new_file_name);
            $path_filename1 = $save_path . $full_path_thumb;
            $data_thumb = array(
                'thumb' => $path_filename1
            );
        }

        $data = array(
            'content_type' => $_POST['content_type'],
            'name' => $_POST['name'],
            'position' => $_POST['position'],
            'description' => $_POST['description'],
            'detail' => $_POST['detail'],
            'facebook' => $_POST['facebook'],
            'googleplus' => $_POST['googleplus'],
            'ig' => $_POST['ig'],
            'is_status' => $_POST['is_status'],
            'modified' => date("Y/m/d H:i:s"),
            'modifiedby' => get_admin_login()->username
        );

        $data_all = array_merge($data, $data_thumb);

        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data_all);

        redirect($this->view_path . '/edit/' . $id . '?code=success&str=Edit data sucess');
    }

    function data_delete() {
        if (!empty($_REQUEST["id"])) {
            $arr_id = explode(',', $_REQUEST["id"]);
            $this->db->where_in('id', $arr_id);
            $this->db->delete($this->table_name);
        }
        redirect($this->view_path . '?code=success&str=Delete data sucess');
    }

    function set_status($status = 'active') {

        if (!empty($_REQUEST["id"])) {
            $arr_id = explode(',', $_REQUEST["id"]);
            $data = array(
                'is_status' => $status
            );
            $this->db->where_in('id', $arr_id);
            $this->db->update($this->table_name, $data);
        }
        redirect($this->view_path . '?code=success&str=Edit data sucess');
    }

}

/* End of file banner.php */
/* Location: ./system/application/controllers/admin/banner.php */