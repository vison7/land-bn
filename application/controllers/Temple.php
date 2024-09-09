<?php

class Temple extends CI_Controller
{

    public $table_name = '';
    public $content_type = 1;
    public $view_path = 'temple';

    public function __construct()
    {
        parent::__construct();
        admin_check_level(array(
            '1','2'
        ));
        
        
        $this->load->database();
        $this->table_name = $this->db->dbprefix('temples');
    }

    // admin
    public function index()
    {
        if (get_admin_login()->is_level != '1' ){
            if(get_admin_login()->is_level == '2' && get_admin_login()->temple_id == '0' ){
                // OK
            }else{
                echo "Not allow";
                exit();
            }
        }

        // get page
        $page_no = (isset($_REQUEST['page_no'])) ? $_REQUEST['page_no'] : 1;
        $page_size = 10;
        $offset = ($page_size * $page_no) - $page_size;

        // search
        $q = (isset($_REQUEST['q'])) ? $_REQUEST['q'] : '';

        // select
        $this->db->from($this->table_name);
        if (!empty($q)) {
            $this->db->like('name', $q);
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

    public function add()
    {
        $this->load->view('layouts/admin_header');
        $this->load->view($this->view_path . '/add');
        $this->load->view('layouts/admin_footer');
    }

    public function add_data()
    {
        $this->load->helper('upload');
        // image 1
        $path_filename1 = '';
        if (isset($_FILES["logo"]) && !empty($_FILES['logo']) && $_FILES["logo"]["name"] != "") {
            $path = date("Y/m/d");
            $new_file_name = str_replace('/', '', $path) . date("His") . mt_rand(10, 99);

            $filename = explode(".", $_FILES["logo"]["name"]);
            $filenameext = $filename[count($filename) - 1];
            $full_path_thumb = $new_file_name . '.' . $filenameext;

            // upload file
            $target = create_folder_by_date(PATH_FILE_IMAGE, $path);
            $save_path = PATH_FILE_IMAGE . $target;

            upload_image($save_path, $_FILES["logo"], $new_file_name);
            $path_filename1 = $save_path . $full_path_thumb;
        }

        // image 2
        $path_filename2 = '';
        if (isset($_FILES["bg_header"]) && !empty($_FILES['bg_header']) && $_FILES["bg_header"]["name"] != "") {
            $path = date("Y/m/d");
            $new_file_name = str_replace('/', '', $path) . date("His") . mt_rand(10, 99);

            $filename = explode(".", $_FILES["bg_header"]["name"]);
            $filenameext = $filename[count($filename) - 1];
            $full_path_thumb = $new_file_name . '.' . $filenameext;

            // upload file
            $target = create_folder_by_date(PATH_FILE_IMAGE, $path);
            $save_path = PATH_FILE_IMAGE . $target;

            upload_image($save_path, $_FILES["bg_header"], $new_file_name);
            $path_filename2 = $save_path . $full_path_thumb;
        }

        $data = array(
            'cate_id' => $_POST['cate_id'],
            'slug' => $_POST['slug'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'logo' => $path_filename1,
            'bg_header' => $path_filename2,
            'slogan' => $_POST['slogan'],
            'author' => $_POST['author'],
            'detail' => $_POST['detail'],

            'location' => $_POST['location'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'website' => $_POST['website'],
            'youtube' => $_POST['youtube'],
            'facebook' => $_POST['facebook'],

            'map' => $_POST['map'],
            'contact' => $_POST['contact'],

            'is_status' => (isset($_POST['is_status'])) ? $_POST['is_status'] : 'draft',
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
        if (isset($_FILES["logo"]) && !empty($_FILES['logo']) && $_FILES["logo"]["name"] != "") {
            $path = date("Y/m/d");
            $new_file_name = str_replace('/', '', $path) . date("His") . mt_rand(10, 99);

            $filename = explode(".", $_FILES["logo"]["name"]);
            $filenameext = $filename[count($filename) - 1];
            $full_path_thumb = $new_file_name . '.' . $filenameext;

            // upload file
            $target = create_folder_by_date(PATH_FILE_IMAGE, $path);
            $save_path = PATH_FILE_IMAGE . $target;

            upload_image($save_path, $_FILES["logo"], $new_file_name);
            $path_filename1 = $save_path . $full_path_thumb;
            $data_thumb['logo'] = $path_filename1;
        }
        if (isset($_FILES["bg_header"]) && !empty($_FILES['bg_header']) && $_FILES["bg_header"]["name"] != "") {
            $path = date("Y/m/d");
            $new_file_name = str_replace('/', '', $path) . date("His") . mt_rand(10, 99);

            $filename = explode(".", $_FILES["bg_header"]["name"]);
            $filenameext = $filename[count($filename) - 1];
            $full_path_thumb = $new_file_name . '.' . $filenameext;

            // upload file
            $target = create_folder_by_date(PATH_FILE_IMAGE, $path);
            $save_path = PATH_FILE_IMAGE . $target;

            upload_image($save_path, $_FILES["bg_header"], $new_file_name);
            $path_filename1 = $save_path . $full_path_thumb;
            $data_thumb['bg_header'] = $path_filename1;
        }

        $data = array(
            'cate_id' => $_POST['cate_id'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'slogan' => $_POST['slogan'],
            'author' => $_POST['author'],
            'detail' => $_POST['detail'],
            
            'location' => $_POST['location'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'website' => $_POST['website'],
            'youtube' => $_POST['youtube'],
            'facebook' => $_POST['facebook'],

            'map' => $_POST['map'],
            'contact' => $_POST['contact'],
            
            'is_status' => (isset($_POST['is_status'])) ? $_POST['is_status'] : 'draft',
            'modified' => date("Y/m/d H:i:s"),
            'modifiedby' => get_admin_login()->username,
        );
        $data_all = array_merge($data, $data_thumb);

        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data_all);

        redirect($this->view_path . '/edit/' . $id . '?code=success&str=Edit data sucess');
    }

    public function edit_my_temple()
    {

        $query = $this->db->get_where($this->table_name, array(
            'id' => admin_get_temple(),
        ), 1);
        $data['query'] = $query->result();

        $this->load->view('layouts/admin_header');
        $this->load->view($this->view_path . '/edit_my_temple', $data);
        $this->load->view('layouts/admin_footer');
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

    public function check()
    {
        $this->db->select('slug');
        $this->db->from($this->table_name);
        $this->db->where('slug', $_REQUEST['slug']);
        $query = $this->db->get()->result();

        if (isset($query[0]->slug) && !empty($query[0]->slug)) {
            echo 'false';
        } else {
            echo 'true';
        }

    }

}

/* End of file banner.php */
/* Location: ./system/application/controllers/admin/banner.php */
