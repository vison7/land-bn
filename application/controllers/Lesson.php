<?php

class Lesson extends CI_Controller {

    var $table_name = '';
    var $content_type = 1;
    var $view_path = 'lesson';

    public function __construct() {
        parent::__construct();
        admin_check_level(array(
            '1',
            '2'
        ));

        $this->load->database();
        $this->table_name = $this->db->dbprefix('course_detail');
    }

    // admin
    function index() {
        // get page
        $page_no = (isset($_REQUEST['page_no'])) ? $_REQUEST['page_no'] : 1;
        $page_size = 10;
        $offset = ($page_size * $page_no) - $page_size;

        // search
        $course_id = (isset($_REQUEST['course_id'])) ? $_REQUEST['course_id'] : '';
        $title = (isset($_REQUEST['title'])) ? $_REQUEST['title'] : '';

        // select
        $this->db->select('t1.*');
        $this->db->from($this->table_name .' t1');
        $this->db->where('t1.course_id', $course_id);
        if (!empty($title)) {
            $this->db->like('title', $title);
        }
        $this->db->limit($page_size, $offset);
        $this->db->order_by("t1.id", "DESC");
        $data['query'] = $this->db->get()->result();

        // count all
        $this->db->from($this->table_name);
        $this->db->where('course_id', $course_id);
        if (!empty($title)) {
            $this->db->like('title', $title);
        }
        $count_all = $this->db->count_all_results();

        // paging config
        $data['total_item'] = $count_all;
        $data['page_size'] = $page_size;
        $data['page_no'] = $page_no;
        // total page
        $page_total = ceil($count_all / $page_size);
        $data['page_total'] = $page_total;

        $data['str_query'] = "&course_id=". $course_id;
        $data['course_id']  = $course_id;
        $data['course']  = $this->get_course_detail($course_id);

        $this->load->view('layouts/admin_header');
        $this->load->view($this->view_path . '/index', $data);
        $this->load->view('layouts/admin_footer');
    }

    function get_course_detail($id = '') {
        $query = $this->db->get_where('course', array(
            'id' => $id
                ), 1);
        $data = $query->result();
        return $data[0]->title;
        
    }

    function add() {

        $course_id = (isset($_REQUEST['course_id'])) ? $_REQUEST['course_id'] : '';

        $data['course_id']  = $course_id;
        $data['course']  = $this->get_course_detail($course_id);

        $this->load->view('layouts/admin_header');
        $this->load->view($this->view_path . '/add',$data);
        $this->load->view('layouts/admin_footer');
    }

    function add_data() {
        $this->load->helper('upload');
        $course_id = (isset($_REQUEST['course_id'])) ? $_REQUEST['course_id'] : '';

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
            'course_id' => $_POST['course_id'],
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'detail' => $_POST['detail'],
            'download_url' => $_POST['download_url'],
            'embed_vdo' => $_POST['embed_vdo'],
            'question1' => $_POST['question1'],
            'question2' => $_POST['question2'],
            'question3' => $_POST['question3'],
            'question4' => $_POST['question4'],
            'thumb' => $path_filename1,
            'is_status' => (isset($_POST['is_status'])) ? $_POST['is_status'] : 'draft',
            'created' => date("Y/m/d H:i:s"),
            'createdby' => get_admin_login()->username
        );

        if ($this->db->insert($this->table_name, $data)) {

            redirect($this->view_path . '/add?course_id='.$course_id.'&code=success&str=Publish data sucess');
        } else {
            redirect($this->view_path . '/add?course_id='.$course_id.'&code=danger&str=Publish data error');
        }
    }

    function edit($id = '') {
        $course_id = (isset($_REQUEST['course_id'])) ? $_REQUEST['course_id'] : '';
        $query = $this->db->get_where($this->table_name, array(
            'id' => $id
                ), 1);
        $data['query'] = $query->result();

        $data['course_id']  = $course_id;
        $data['course']  = $this->get_course_detail($course_id);

        $this->load->view('layouts/admin_header');
        $this->load->view($this->view_path . '/edit', $data);
        $this->load->view('layouts/admin_footer');
    }

    function edit_data() {

        $this->load->helper('upload');

        $id = $_POST['id'];
        $course_id = (isset($_REQUEST['course_id'])) ? $_REQUEST['course_id'] : '';

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
            'description' => $_POST['description'],
            'title' => $_POST['title'],
            'detail' => $_POST['detail'],
            'download_url' => $_POST['download_url'],
            'embed_vdo' => $_POST['embed_vdo'],
            'question1' => $_POST['question1'],
            'question2' => $_POST['question2'],
            'question3' => $_POST['question3'],
            'question4' => $_POST['question4'],
            'is_status' => (isset($_POST['is_status'])) ? $_POST['is_status'] : 'draft',
            'modified' => date("Y/m/d H:i:s"),
            'modifiedby' => get_admin_login()->username
        );

        $data_all = array_merge($data, $data_thumb);

        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data_all);

        redirect($this->view_path . '/edit/' . $id . '?course_id='.$course_id.'&code=success&str=Edit data sucess');
    }

    function data_delete() {
        $course_id = (isset($_REQUEST['course_id'])) ? $_REQUEST['course_id'] : '';
        if (!empty($_REQUEST["id"])) {
            $arr_id = explode(',', $_REQUEST["id"]);
            $this->db->where_in('id', $arr_id);
            $this->db->delete($this->table_name);
        }
        redirect($this->view_path . '?course_id='.$course_id.'&code=success&str=Delete data sucess');
    }

    function set_status($status = 'active') {
        $course_id = (isset($_REQUEST['course_id'])) ? $_REQUEST['course_id'] : '';
        if (!empty($_REQUEST["id"])) {
            $arr_id = explode(',', $_REQUEST["id"]);
            $data = array(
                'is_status' => $status
            );
            $this->db->where_in('id', $arr_id);
            $this->db->update($this->table_name, $data);
        }
        redirect($this->view_path . '?course_id='.$course_id.'&code=success&str=Edit data sucess');
    }


    // lesson

    

}

/* End of file banner.php */
/* Location: ./system/application/controllers/admin/banner.php */