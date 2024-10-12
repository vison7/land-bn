<?php

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Keys.php';

class Content extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        Keys::verify_token();
        $this->load->database();
        $this->load->model('content_model');
    }

    // update an existing user and respond with a status/errors
    public function index_get()
    {
       
        // params
        $page_no = (isset($_REQUEST['page_no'])) ? $_REQUEST['page_no'] : 1;
        $page_size = (isset($_REQUEST['page_size'])) ? $_REQUEST['page_size'] : 10;

        $search = array();
        $sort = array();
        $notin = array();
        $fields = array();

        if (!empty($this->get('content_type'))) {
            $search['content_type'] = $this->get('content_type');
        }
        if ($this->get('temple_id') != '') {
            $search['temple_id'] = $this->get('temple_id');
        }
        if (!empty($this->get('cate_id'))) {
            $search['cate_id'] = $this->get('cate_id');
        }
        if (!empty($this->get('recommend'))) {
            $search['recommend'] = $this->get('recommend');
        }
        if (!empty($this->get('highlight'))) {
            $search['highlight'] = $this->get('highlight');
        }
        if (!empty($this->get('hit'))) {
            $search['hit'] = $this->get('hit');
        }
        if (!empty($this->get('region'))) {
            $search['region'] = $this->get('region');
        }

        if (!empty($this->get('start_date')) && !empty($this->get('end_date'))) {
            $search['start_date'] = $this->get('start_date');
            $search['end_date'] = $this->get('end_date');
        }

        if (!empty($this->get('sort_event_date'))) {
            $sort['event_date'] = $this->get('sort_event_date');
        }
        if ($this->get('notin_temple_id') != '') {
            $notin['temple_id'] = $this->get('notin_temple_id');
        }
        if ($this->get('notin_cate_id') != '') {
            $notin['cate_id'] = $this->get('notin_cate_id');
        }

        if ($this->get('fields') != '') {
            $fields = explode(',', $this->get('fields'));
        }

        $data = $this->content_model->get_content($page_size, $page_no, $search, $sort, $notin, $fields);

        if (isset($data['data']) && !empty($data['data'])) {
            $res = array('code' => 200, 'paging' => $data['paging'], 'data' => $data['data']);
        } else {
            $res = array('code' => 200, 'paging' => $data['paging'], 'message' => 'No data', 'data' => array());
        }
        $this->response($res);
    }

    public function detail_get()
    {
        $id = $this->get('id');
        $data = $this->content_model->get_detail($id);

        if (isset($data['data']) && !empty($data['data'])) {
            $res = array('code' => 200, 'data' => $data['data']);
        } else {
            $res = array('code' => 200, 'message' => 'No data', 'data' => array());
        }
        $this->response($res);
    }

    public function submitcase_post()
    {
        $this->load->helper('upload');
        
        $file =  $_FILES['thumb'];
        $imageFileName = $_FILES["thumb"]["name"];

        $thumb_url = "";
        if (isset($file) && !empty($file) && $imageFileName != "") {
            $path = date("Y/m/d");
            $new_file_name = str_replace('/', '', $path) . date("His") . mt_rand(10, 99);

            $filename = explode(".",$imageFileName);
            $filenameext = $filename[count($filename) - 1];
            $full_path_thumb = $new_file_name . '.' . $filenameext;

            // upload file
            $target = create_folder_by_date(PATH_FILE_IMAGE, $path);
            $save_path = PATH_FILE_IMAGE . $target;

            upload_image($save_path, $file, $new_file_name);
            $thumb_url = $save_path . $full_path_thumb;
        }
        $_POST['content_type'] = '1';
        $_POST['thumb'] = $thumb_url;

        $res = $this->content_model->submit_case($_POST);
        $this->response($res);
    }

}
