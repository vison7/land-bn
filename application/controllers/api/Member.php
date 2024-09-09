<?php

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Keys.php';

class Member extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();

        Keys::verify_token();

        $this->load->database();
    }

    // update an existing user and respond with a status/errors
    public function auth_post()
    {
        $this->load->model('member_model');

        $search = array(
            'username' => $this->post('username'),
            'password' => $this->post('password'),
        );
        $data = $this->member_model->auth($search);

        if (isset($data) && !empty($data)) {
            $res = array('code' => 200, 'data' => $data);
        } else {
            $res = array('code' => 404, 'message' => 'No data');
        }
        $this->response($res);
    }

    public function register_post()
    {
        $this->load->model('member_model');
        $this->send($this->post('email'));
        $res = $this->member_model->register($this->post());
        
        $this->response($res);
    }

    public function profile_post()
    {
        $id = $this->post('id');
        $this->load->model('member_model');
        $data = $this->member_model->profile($id);

        if (isset($data['data']) && !empty($data['data'])) {
            $res = array('code' => 200, 'data' => $data['data']);
        } else {
            $res = array('code' => 200, 'message' => 'No data', 'data' => array());
        }
        $this->response($res);
    }
    public function updateprofile_post()
    {
        $this->load->model('member_model');
        $res = $this->member_model->update_profile($this->post());
        $this->response($res);
    }
    public function updatepassword_post()
    {
        $this->load->model('member_model');
        $res = $this->member_model->update_password($this->post());
        $this->response($res);
    }

    public function profilebyemail_post()
    {
        $email = $this->post('email');
        $this->load->model('member_model');
        $data = $this->member_model->profile_by_email($email);

        if (isset($data['data']) && !empty($data['data'])) {
            $res = array('code' => 200, 'data' => $data['data']);
        } else {
            $res = array('code' => 200, 'message' => 'No data', 'data' => array());
        }
        $this->response($res);
    }

    public function forgetpass_post()
    {
        $this->load->model('member_model');
        $this->send_forgetpass($this->post('email'));
        $res = array('code' => 200, 'message' => 'OK');
        $this->response($res);
    }
    public function resetpassword_post()
    {
        $this->load->model('member_model');
        $res = $this->member_model->reset_password($this->post());
        $this->response($res);
    }

    private function send($email)
    {
        $this->load->library('email');

        // $config = array(
        //     'protocol'  => 'sendmail',
        //     // 'smtp_host' => 'smtp.gmail.com',
        //     // 'smtp_port' => 587,
        //     // 'smtp_user' => 'wmd.developers@gmail.com',
        //     // 'smtp_pass' => '123Gang*599',
        //     'mailtype'  => 'html',
        //     'charset'   => 'utf-8',
        //     'priority'  => '1'
        // );
        // $this->email->initialize($config);
        // $this->email->set_mailtype("html");

        $this->email->from('watbundanjai@gmail.com', 'Watbundanjai.org');
        $this->email->to($email);

        $this->email->subject('Watbundanjai.org กรุณายืนยันอีเมล์ของท่าน');

        $key_email = 'watUHusahduiwkjYIT873yugyudsavj';
        $my_email = md5($email.'-'. $key_email);
        $url = site_url('home/verify') .'?v='. $my_email .'&email='. $email;

        //$url = site_url('home/verify') .'?v='. base64_encode(base64_encode($email));
        $body = 'เรียน สมาชิก';
        $body .= '<p>ท่านได้ทำการสมัครสมาชิกเรียบร้อยแล้ว กรุณายืนยันอีเมล์ของท่าน ตามลิ้งค์ด้านล่าง</p>';
        $body .= '<a href="' . $url . '">' . $url . '</a>';
        $body .= '<br><br><br><p>
            <strong>ทีมงานวัดบันดาลใจ</strong> <br>
            เบอร์โทร : ๐๒-๔๙๐-๔๗๔๘-๕๔ ต่อ ๑๑๒<br>
            อีเมล์ : watbundanjai@gmail.com<br>
            โครงการวัดบันดาลใจ สถาบันอาศรมศิลป์ เลขที่ ๓๙๙ ซอยอนามัยงามเจริญ ๒๕ แขวงท่าข้าม เขตบางขุนเทียนกรุงเทพฯ ๑๐๑๕๐
        </p>';

        //echo $body;

        $this->email->message($body);
        $result = $this->email->send();
        
        if (!$result) {
            //echo 'Error';
        } else {
            //echo 'OK';
        }
    }

    private function send_forgetpass($email)
    {
        $this->load->library('email');

        $this->email->from('watbundanjai@gmail.com', 'Watbundanjai.org');
        $this->email->to($email);

        $this->email->subject('Watbundanjai.org ลืมรหัสผ่าน');

        $key_email = 'watUHusahduiwkjYIT873yugyudsavj';
        $my_email = md5($email.'-'. $key_email);
        $url = site_url('home/forget_pass_verify') .'?v='. $my_email .'&email='. $email;

        //$url = site_url('home/verify') .'?v='. base64_encode(base64_encode($email));
        $body = 'เรียน สมาชิก';
        $body .= '<p>คุณสามารถเปลี่ยนรหัสผ่านใหม่ตามลิ้งค์ด้านล่าง</p>';
        $body .= '<a href="' . $url . '">' . $url . '</a>';
        $body .= '<br><br><br><p>
            <strong>ทีมงานวัดบันดาลใจ</strong> <br>
            เบอร์โทร : ๐๒-๔๙๐-๔๗๔๘-๕๔ ต่อ ๑๑๒<br>
            อีเมล์ : watbundanjai@gmail.com<br>
            โครงการวัดบันดาลใจ สถาบันอาศรมศิลป์ เลขที่ ๓๙๙ ซอยอนามัยงามเจริญ ๒๕ แขวงท่าข้าม เขตบางขุนเทียนกรุงเทพฯ ๑๐๑๕๐
        </p>';

        //echo $body;

        $this->email->message($body);
        $result = $this->email->send();
        
        if (!$result) {
            //echo 'Error';
        } else {
            //echo 'OK';
        }
    }
}
