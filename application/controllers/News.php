<?php

class News extends CI_Controller {

    var $table_name = '';
    var $content_type = 1;
    var $view_path = 'news';

    public function __construct() {
        parent::__construct();
        admin_check_level(array(
            '1',
            '2'
        ));

        $this->load->database();
        $this->table_name = $this->db->dbprefix('news');
    }

    // admin
    function index() {
        // get page
        $page_no = (isset($_REQUEST['page_no'])) ? $_REQUEST['page_no'] : 1;
        $page_size = 10;
        $offset = ($page_size * $page_no) - $page_size;

        // search
        $q = (isset($_REQUEST['q'])) ? $_REQUEST['q'] : '';

        // select
        $this->db->from($this->table_name);
        if (!empty($q)) {
            $this->db->like('title', $q);
        }
        $this->db->limit($page_size, $offset);
        $this->db->order_by("id", "DESC");
        $data['query'] = $this->db->get()->result();

        // count all
        $this->db->from($this->table_name);
        $count_all = $this->db->count_all_results();

        // paging config
        $data['total_item'] = $count_all;
        $data['page_size'] = $page_size;
        $data['page_no'] = $page_no;
        // total page
        $page_total = ceil($count_all / $page_size);
        $data['page_total'] = $page_total;

        $data['str_query'] = "";

        $this->load->view('layouts/admin_header');
        $this->load->view($this->view_path . '/index', $data);
        $this->load->view('layouts/admin_footer');
    }

    function add() {
        $this->load->view('layouts/admin_header');
        $this->load->view($this->view_path . '/add');
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
            'title' => $_POST['title'],
            'detail' => $_POST['detail'],
            'thumb' => $path_filename1,
            'is_status' => (isset($_POST['is_status'])) ? $_POST['is_status'] : 'inactive',
            'created' => date("Y/m/d H:i:s"),
            'createdby' => get_admin_login()->username
        );

        if ($this->db->insert($this->table_name, $data)) {

            redirect($this->view_path . '/add?code=success&str=Publish data sucess');
        } else {
            redirect($this->view_path . '/add?code=danger&str=Publish data error');
        }
    }

    function edit($id = '') {

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
            'title' => $_POST['title'],
            'detail' => $_POST['detail'],
            'is_status' => (isset($_POST['is_status'])) ? $_POST['is_status'] : 'inactive',
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