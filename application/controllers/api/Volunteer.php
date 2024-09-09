<?php

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Keys.php';

class Volunteer extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();

        Keys::verify_token();

        $this->load->database();
    }

    public function register_post()
    {
        $this->load->model('volunteer_model');
        
        $res = $this->volunteer_model->register($this->post());
        $data_for_sendmail = $this->volunteer_model->member_detail($this->post('member_id'),$this->post('activity_id'));
        $this->send($data_for_sendmail);
        $this->response($res);
    }

    public function registerSkills_post()
    {
        $this->load->model('volunteer_model');
        $res = $this->volunteer_model->registerSkills($this->post());
        $this->response($res);
    }

    public function register_get()
    {
        $this->load->model('volunteer_model');
        // params
        $page_no = (isset($_REQUEST['page_no'])) ? $_REQUEST['page_no'] : 1;
        $page_size = (isset($_REQUEST['page_size'])) ? $_REQUEST['page_size'] : 10;

        $search = array();

        if (!empty($this->get('member_id'))) {
            $search['member_id'] = $this->get('member_id');
        }

        $data = $this->volunteer_model->get_volunteer($page_size, $page_no, $search);

        if (isset($data['data']) && !empty($data['data'])) {
            $res = array('code' => 200, 'paging' => $data['paging'], 'data' => $data['data']);
        } else {
            $res = array('code' => 200, 'paging' => $data['paging'], 'message' => 'No data', 'data' => array());
        }
        $this->response($res);
    }

    public function check_get()
    {
        $this->load->model('volunteer_model');
        // params
        $search = array();

        $search['activity_id'] = $this->get('activity_id');
        $search['member_id'] = $this->get('member_id');
        $data = $this->volunteer_model->check_activity($search);

        if ($data) {
            $res = array('code' => 200);
        } else {
            $res = array('code' => 404);
        }
        $this->response($res);
    }

    public function volunteerall_get()
    {
        $this->load->model('volunteer_model');
        // params
        $page_no = (isset($_REQUEST['page_no'])) ? $_REQUEST['page_no'] : 1;
        $page_size = (isset($_REQUEST['page_size'])) ? $_REQUEST['page_size'] : 10;

        $search = array();

        if (!empty($this->get('content_type'))) {
            $search['content_type'] = $this->get('content_type');
        }

        $data = $this->volunteer_model->get_volunteerall($page_size, $page_no,$search);

        if (isset($data['data']) && !empty($data['data'])) {
            $res = array('code' => 200, 'paging' => $data['paging'], 'data' => $data['data']);
        } else {
            $res = array('code' => 200, 'paging' => $data['paging'], 'message' => 'No data', 'data' => array());
        }
        $this->response($res);
    }
    public function volunteeralldetail_get()
    {
        $this->load->model('volunteer_model');
        // params
        $id = $this->get('id');
        $data = $this->volunteer_model->get_volunteerall_detail($id);

        if (isset($data['data']) && !empty($data['data'])) {
            $res = array('code' => 200, 'data' => $data['data']);
        } else {
            $res = array('code' => 200, 'message' => 'No data', 'data' => array());
        }
        $this->response($res);
    }

    // wat
    public function registerwat_post()
    {
        $this->load->model('volunteer_model');
        $res = $this->volunteer_model->registerWat($this->post());
        $this->response($res);
    }

    // subscription
    public function registersub_post()
    {
        $this->load->model('volunteer_model');
        $res = $this->volunteer_model->registerSubscription($this->post());
        $this->response($res);
    }
    
    private function send($data)
    {
        $this->load->library('email');

        $this->email->from('watbundanjai@gmail.com', 'Watbundanjai.org');
        $this->email->to($data['email']);

        $this->email->subject('Watbundanjai.org สมัครเข้าร่วมกิจกรรม');

        $body = 'เรียน สมาชิก';
        $body .= '<p>ท่านได้สมัครเข้าร่วมกิจกรรม <strong>'. $data['title'] .'</strong> เรียบร้อยแล้ว</p>';
        $body .= '<br><br><p>
            <strong>ทีมงานวัดบันดาลใจ</strong> <br>
            เบอร์โทร : ๐๒-๔๙๐-๔๗๔๘-๕๔ ต่อ ๑๑๒<br>
            อีเมล์ : watbundanjai@gmail.com<br>
            โครงการวัดบันดาลใจ สถาบันอาศรมศิลป์ เลขที่ ๓๙๙ ซอยอนามัยงามเจริญ ๒๕ แขวงท่าข้าม เขตบางขุนเทียนกรุงเทพฯ ๑๐๑๕๐
        </p>';

        // echo $body;

        $this->email->message($body);
        $result = $this->email->send();
        // print_r($result);
        // if (!$result) {
        //     echo 'Error';
        // } else {
        //     echo 'OK';
        // }
    }

}
