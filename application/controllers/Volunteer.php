<?php
class Volunteer extends CI_Controller
{

    public $table_name = '';
    public $content_type = '1';
    public $view_path = 'volunteer';
    public $my_temple_id = '';

    public function __construct()
    {
        parent::__construct();
        admin_check_level(array(
            '1',
            '2',
            '3',
            '4',
        ));
        $this->my_temple_id = admin_get_temple();

        $this->load->database();
        $this->table_name = $this->db->dbprefix('contents');
    }

    // admin
    public function index()
    {
        $t1 = $this->db->dbprefix('register');
        $t2 = $this->db->dbprefix('members');

        $activity_id = $_REQUEST['id'];
        // get page
        $page_no = (isset($_REQUEST['page_no'])) ? $_REQUEST['page_no'] : 1;
        $page_size = 10;
        $offset = ($page_size * $page_no) - $page_size;

        // search
        $title = (isset($_REQUEST['title'])) ? $_REQUEST['title'] : '';
        $cate_id = (isset($_REQUEST['cate_id'])) ? $_REQUEST['cate_id'] : '';

        // select
        $this->db->select('t1.*,t2.displayname,t2.name_title,t2.nickname,t2.firstname,t2.lastname,t2.email,t2.phone,t2.gender,t2.date_of_birth,t2.no,
        t2.road,t2.sub_district,t2.district,t2.province,t2.postcode,t2.phone,t2.website,t2.career');
        $this->db->from($t1 . ' t1');
        $this->db->join($t2 . ' t2', 't1.member_id = t2.id', 'left');
        $this->db->where('t1.activity_id', $activity_id);
        $this->db->limit($page_size, $offset);
        $this->db->order_by("t1.id", "DESC");
        $data['query'] = $this->db->get()->result();

        // count all
        $this->db->from($t1);
        $this->db->where('activity_id', $activity_id);
        $count_all = $this->db->count_all_results();

        // paging config
        $data['total_item'] = $count_all;
        $data['page_size'] = $page_size;
        $data['page_no'] = $page_no;
        // total page
        $page_total = ceil($count_all / $page_size);
        $data['page_total'] = $page_total;

        $data['str_query'] = "&id=". $activity_id;
        $data['activity_id'] = $activity_id;

        $this->load->view('layouts/admin_header');
        $this->load->view($this->view_path . '/index', $data);
        $this->load->view('layouts/admin_footer');
    }


    public function export()
    {
        $t1 = $this->db->dbprefix('register');
        $t2 = $this->db->dbprefix('members');

        $activity_id = $_REQUEST['id'];
        // get page
        $page_no = (isset($_REQUEST['page_no'])) ? $_REQUEST['page_no'] : 1;
        $page_size = 10000;
        $offset = ($page_size * $page_no) - $page_size;

        // search
        $title = (isset($_REQUEST['title'])) ? $_REQUEST['title'] : '';
        $cate_id = (isset($_REQUEST['cate_id'])) ? $_REQUEST['cate_id'] : '';

        // select
        $this->db->select('t1.*,t2.displayname,t2.name_title,t2.nickname,t2.firstname,t2.lastname,t2.email,t2.phone,t2.gender,t2.date_of_birth,t2.no,
        t2.road,t2.sub_district,t2.district,t2.province,t2.postcode,t2.phone,t2.website,t2.career');
        $this->db->from($t1 . ' t1');
        $this->db->join($t2 . ' t2', 't1.member_id = t2.id', 'left');
        $this->db->where('t1.activity_id', $activity_id);
        $this->db->limit($page_size, $offset);
        $this->db->order_by("t1.id", "DESC");
        $data = $this->db->get()->result();

        // print "<pre>";
        // print_r($data);


        // disable caching
        $filename = 'Data-' . date("Ymd-His") . ".csv";
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");

        $headers = array('id','คำนำหน้า','ชื่อ','นามสกุล','ชื่อที่ใช้แสดง','ชื่อเล่น','อีเมล์','เพศ','วันเกิด','ที่อยู่','อาชีพ','เว็บไซต์','วันที่สมัคร','จัดสถานที่/กิจกรรม','ต้นไม้','การจัดการ','ทักษะเฉพาะ','ทักษะอื่นๆ');
        $csv = implode(",", $headers) . PHP_EOL;
        $i = 1;
        foreach ($data as $row) {
            $csv .= '"' . $row->id . '",';
            $csv .= '"' . $row->name_title . '",';
            $csv .= '"' . $row->firstname . '",';
            $csv .= '"' . $row->lastname . '",';
            $csv .= '"' . $row->displayname . '",';
            $csv .= '"' . $row->nickname . '",';
            $csv .= '"' . $row->email . '",';
            $csv .= '"' . $row->gender . '",';
            $csv .= '"' . $row->date_of_birth . '",';
            $csv .= '"' . $row->no .' '. $row->road .' '. $row->sub_district .' '. $row->district .' '. $row->province .' '. $row->postcode .'",';
            $csv .= '"' . $row->career . '",';
            $csv .= '"' . $row->website . '",';
            $csv .= '"' . date("Y-m-d H:i:s",strtotime($row->created)) . '",';

            $val_r1 = '';
            if(isset($row->reg1) && !empty($row->reg1)){
                $r1 = json_decode($row->reg1,true);
                foreach(REGISTER1 as $key=>$value){
                    if (in_array($key, $r1)) {
                        if($val_r1 != '')
                            $val_r1 .= "|". REGISTER1[$key];
                        else
                        $val_r1 .=  REGISTER1[$key];
                    }
                }
            }
            $csv .= '"' . $val_r1 . '",';
            
            $val_r2 = '';
            if(isset($row->reg2) && !empty($row->reg2)){
                $r1 = json_decode($row->reg2,true);
                foreach(REGISTER2 as $key=>$value){
                    if (in_array($key, $r1)) {
                        if($val_r2 != '')
                            $val_r2 .= "|". REGISTER2[$key];
                        else
                        $val_r2 .=  REGISTER2[$key];
                    }
                }
            }
            $csv .= '"' . $val_r2 . '",';

            $val_r3 = '';
            if(isset($row->reg3) && !empty($row->reg3)){
                $r1 = json_decode($row->reg3,true);
                foreach(REGISTER3 as $key=>$value){
                    if (in_array($key, $r1)) {
                        if($val_r3 != '')
                            $val_r3 .= "|". REGISTER3[$key];
                        else
                        $val_r3 .=  REGISTER3[$key];
                    }
                }
            }
            $csv .= '"' . $val_r3 . '",';

            $val_r4 = '';
            if(isset($row->reg4) && !empty($row->reg4)){
                $r1 = json_decode($row->reg4,true);
                foreach(REGISTER4 as $key=>$value){
                    if (in_array($key, $r1)) {
                        if($val_r4 != '')
                            $val_r4 .= "|". REGISTER4[$key];
                        else
                        $val_r4 .=  REGISTER4[$key];
                    }
                }
            }
            $csv .= '"' . $val_r4 . '",';
            $csv .= '"' . $row->other . '",';

            $csv .= PHP_EOL;
        }
        echo $csv;

    }

    public function add()
    {
        $this->load->model('common_model');
        $data['temple'] = $this->common_model->temples();

        $this->load->view('layouts/admin_header');
        $this->load->view($this->view_path . '/add', $data);
        $this->load->view('layouts/admin_footer');
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
            'temple_id' => $_POST['temple_id'],
            //'cate_id' => $_POST['cate_id'],
            'description' => $_POST['description'],
            'title' => $_POST['title'],
            'detail' => $_POST['detail'],
            'recommend' => (isset($_POST['recommend'])) ? $_POST['recommend'] : 'no',
            'highlight' => (isset($_POST['highlight'])) ? $_POST['highlight'] : 'no',
            'is_status' => (isset($_POST['is_status'])) ? $_POST['is_status'] : 'draft',

            'publish_date' => $_POST['publish_date'] .' '. $_POST['time_publish_date'] ,
            'modified' => date("Y/m/d H:i:s"),
            'tags' => $_POST['tags'],
            'modifiedby' => get_admin_login()->username,
        );

        $data_all = array_merge($data, $data_thumb);

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

}

/* End of file Media.php */
/* Location: ./system/application/controllers/Media.php */