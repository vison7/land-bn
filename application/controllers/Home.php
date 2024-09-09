<?php

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function verify()
    {
        $v = @$_GET['v'];
        $email = @$_GET['email'];
        if (!empty($email) && !empty($v)) {
            //$my_email = base64_decode(base64_decode($email));

            $key_email = 'watUHusahduiwkjYIT873yugyudsavj';
            $my_email = md5($email . '-' . $key_email);

            if ($my_email == $v) {
                $this->load->database();
                $table = $this->db->dbprefix('members');
                $data = array(
                    'is_status' => 'active',
                );

                $this->db->where('email', $email);
                $this->db->update($table, $data);
                redirect(VERIFY_EMAIL);
            } else {
                echo 'Data Not Found.';
            }

        } else {
            echo 'Page Not Found.';
        }
    }

    public function forget_pass_verify()
    {
        $v = @$_GET['v'];
        $email = @$_GET['email'];
        switch ($_SERVER['SERVER_NAME']) {
            case 'bn.watbundanjai.org':
               $url = 'http://watbundanjai.org/member/forget_pass_verify?v='. $v .'&email='. $email;
                break;
            default:
                $url = 'http://localhost/wat-fn/member/forget_pass_verify?v='. $v .'&email='. $email;
                break;
        }
        redirect($url);
    }

    public function send()
    {
        $email = $_GET['email'];
        
        $this->load->library('email');

        $this->email->from('watbundanjai@gmail.com', 'Watbundanjai.org');
        $this->email->to($email);

        $this->email->subject('Watbundanjai.org กรุณายืนยันอีเมล์ของท่าน');

        $key_email = 'watUHusahduiwkjYIT873yugyudsavj';
        $my_email = md5($email . '-' . $key_email);
        $url = site_url('home/verify') . '?v=' . $my_email . '&email=' . $email;

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
        var_dump($result);
        echo '<br />';
        echo $this->email->print_debugger();

    }

}

/* End of file  */
