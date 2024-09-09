<?php

class Templenew extends CI_Controller
{

    public $table_name = '';
    public $content_type = '9';
    public $view_path = 'templenew';
    public $my_temple_id = '';

    public function __construct()
    {
        parent::__construct();
        admin_check_level(array(
            '1',
            '2',
            '3',
            '4'
        ));
        $this->my_temple_id = admin_get_temple();
        $this->load->database();
        $this->table_name = $this->db->dbprefix('contents');
    }

    // admin
    public function index()
    {
        // get page
        $page_no = (isset($_REQUEST['page_no'])) ? $_REQUEST['page_no'] : 1;
        $page_size = 10;
        $offset = ($page_size * $page_no) - $page_size;

        // search
        if($this->my_temple_id == '')
            $temple_id = (isset($_REQUEST['temple_id'])) ? $_REQUEST['temple_id'] : '';
        else
            $temple_id = $this->my_temple_id;

        $title = (isset($_REQUEST['title'])) ? $_REQUEST['title'] : '';
        $cate_id = (isset($_REQUEST['cate_id'])) ? $_REQUEST['cate_id'] : '';

        // select
        $this->db->select('t1.*,t2.name AS temple_name');
        $this->db->from($this->table_name . ' t1');
        $this->db->join($this->db->dbprefix('temples') . ' t2', 't1.temple_id = t2.id', 'left');
        $this->db->where('content_type', $this->content_type);
        if ($temple_id !='') {
            $this->db->where('t1.temple_id', $temple_id);
        }
        if (!empty($title)) {
            $this->db->like('t1.title', $title);
        }
        if ($cate_id != '') {
            $this->db->where('t1.cate_id', $cate_id);
        }
        $this->db->limit($page_size, $offset);
        $this->db->order_by("t1.id", "DESC");
        $data['query'] = $this->db->get()->result();

        // count all
        $this->db->from($this->table_name);
        $this->db->where('content_type', $this->content_type);
        if ($temple_id !='') {
            $this->db->where('temple_id', $temple_id);
        }
        if ($cate_id != '') {
            $this->db->where('cate_id', $cate_id);
        }
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

        $data['str_query'] = "";

        $this->load->model('common_model');
        $data['temple'] = $this->common_model->temples();

        $this->load->view('layouts/admin_header');
        $this->load->view($this->view_path . '/index', $data);
        $this->load->view('layouts/admin_footer');
    }

    public function add()
    {
        $this->load->model('common_model');
        $data['temple'] = $this->common_model->temples();

        $this->load->view('layouts/admin_header');
        $this->load->view($this->view_path . '/add', $data);
        $this->load->view('layouts/admin_footer');
    }

    public function add_data()
    {
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
            'content_type' => $this->content_type,
            'cate_id' => $_POST['cate_id'],
            'region' => $_POST['region'],
            'title' => $_POST['title'],
            'detail' => $_POST['detail'],
            'thumb' => $path_filename1,
            'is_status' => (isset($_POST['is_status'])) ? $_POST['is_status'] : 'draft',
            'description' => $_POST['description'],
            // 'event_date' => $_POST['event_date'],
            // 'event_end_date' => (isset($_POST['event_end_date'])) ? $_POST['event_end_date'] : NULL,
            'location' => $_POST['location'],
            //'lat' => $_POST['lat'],
            //'lng' => $_POST['lng'],
            'tags' => $_POST['tags'],
            'address' => $_POST['address'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'website' => $_POST['website'],
            'ig' => $_POST['ig'],
            'fb' => $_POST['fb'],
            'map' => $_POST['map'],
            'recommend' => (isset($_POST['recommend'])) ? $_POST['recommend'] : 'no',
            'gallery' => (isset($_POST['file_list'])) ? ($_POST['file_list']) : null,
            'created' => date("Y/m/d H:i:s"),
            'createdby' => get_admin_login()->username,
        );

        if ($this->db->insert($this->table_name, $data)) {

            redirect($this->view_path . '/add?code=success&str=Publish data sucess');
        } else {
            redirect($this->view_path . '/add?code=danger&str=Publish data error');
        }
    }

    public function edit($id = '')
    {
        $this->load->model('common_model');
        $data['temple'] = $this->common_model->temples();

        $query = $this->db->get_where($this->table_name, array(
            'id' => $id,
        ), 1);
        $data['query'] = $query->result();

        $this->load->view('layouts/admin_header');
        $this->load->view($this->view_path . '/edit', $data);
        $this->load->view('layouts/admin_footer');
    }

    public function edit_data()
    {

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
                'thumb' => $path_filename1,
            );
        }

        $data = array(
            // 'temple_id' => $_POST['temple_id'],
            'title' => $_POST['title'],
            'detail' => $_POST['detail'],
            'is_status' => (isset($_POST['is_status'])) ? $_POST['is_status'] : 'draft',
            'description' => $_POST['description'],
            // 'event_date' => $_POST['event_date'],
            // 'event_end_date' => (isset($_POST['event_end_date'])) ? $_POST['event_end_date'] : NULL ,
            'location' => $_POST['location'],
            'cate_id' => $_POST['cate_id'],
            'region' => $_POST['region'],
            'recommend' => (isset($_POST['recommend'])) ? $_POST['recommend'] : 'no',
            //'lat' => $_POST['lat'],
            //'lng' => $_POST['lng'],
            'tags' => $_POST['tags'],
            'address' => $_POST['address'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'website' => $_POST['website'],
            'ig' => $_POST['ig'],
            'fb' => $_POST['fb'],
            'map' => $_POST['map'],
            'modified' => date("Y/m/d H:i:s"),
            'modifiedby' => get_admin_login()->username,
        );

        $arr_gall_all = array();
        $data_gallery = array();
        if (isset($_POST['file_list']) && !empty($_POST['file_list'])) {

            $query = $this->db->get_where($this->table_name, array(
                'id' => $id,
            ), 1);
            $ret = $query->result();
            $gallery = $ret[0]->gallery;

            if (!empty($gallery)) {
                $arr_gallery = json_decode($gallery, false);
                $data_gallery = array_merge($arr_gallery, json_decode($_POST['file_list']));

                $gall = '["' . implode('","', $data_gallery) . '"]';
                $arr_gall_all = array('gallery' => $gall);
            } else {
                $arr_gall_all = array('gallery' => $_POST['file_list']);
            }

        }

        $data_all = array_merge($data, $data_thumb,$arr_gall_all);
        //print '<pre>';
        //print_r($data_all);
        //exit();

        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data_all);

        redirect($this->view_path . '/edit/' . $id . '?code=success&str=Edit data sucess');
    }

    public function data_delete()
    {
        if (!empty($_REQUEST["id"])) {
            $arr_id = explode(',', $_REQUEST["id"]);
            $this->db->where_in('id', $arr_id);
            $this->db->delete($this->table_name);
        }
        redirect($this->view_path . '?code=success&str=Delete data sucess');
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
        redirect($this->view_path . '?code=success&str=Edit data sucess');
    }

    public function upload()
    {
        $this->load->helper('upload');
        $path = 'data/gallery/';
        $path_sub = date("Y/m/d");
        $full_path = $path . $path_sub . '/';

        $target = create_folder_by_date($path, $path_sub);

        $new_name = time() . '-' . mt_rand(111111, 999999);
        $filename = explode(".", $_FILES['file']["name"]);
        $filenameext = $filename[count($filename) - 1];
        $filename = $new_name . "." . $filenameext;
        $key = mt_rand(111111, 999999);
        //copy($_FILES['file']["tmp_name"], $path . "/" . $filename);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $full_path . $filename)) {
            $ret = array('code' => 200, 'name' => $filename, 'key' => $key, 'path' => $full_path . $filename);
        } else {
            $ret = array('code' => 400, 'msg' => 'error');
        }

        header('Content-type: text/json');
        header('Content-type: application/json');
        echo json_encode($ret);
    }

    public function list_file($id)
    {

        $query = $this->db->get_where($this->table_name, array(
            'id' => $id,
        ), 1);
        $data['query'] = $query->result();

        $this->load->view($this->view_path . '/list_file', $data);
    }
    public function delete_file($id)
    {
        $pos = $_POST['pos'];

        $query = $this->db->get_where($this->table_name, array(
            'id' => $id,
        ), 1);
        $ret = $query->result();
        $gallery = $ret[0]->gallery;

        if (!empty($gallery)) {
            $arr_gallery = json_decode($gallery, false);

            unset($arr_gallery[$pos]);
            //$gall = json_encode($arr_gallery,true);
            $gall = '["' . implode('","', $arr_gallery) . '"]';
            $data = array(
                'gallery' => $gall,
            );
            $this->db->where('id', $id);
            $this->db->update($this->table_name, $data);
        }

        $ret = array('code' => 200);
        header('Content-type: text/json');
        header('Content-type: application/json');
        echo json_encode($ret);
    }
}

/* End of file banner.php */
/* Location: ./system/application/controllers/admin/banner.php */
