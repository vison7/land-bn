<?php

class Volunteer_model extends CI_Model
{

    public $db_read = null;
    public $member = '';
    public $register = '';
    public $register_wat = '';
    public $register_subscription = '';
    public $content = '';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->member = $this->db->dbprefix('members');
        $this->register = $this->db->dbprefix('register');
        $this->register_wat = $this->db->dbprefix('register_wat');
        $this->register_subscription = $this->db->dbprefix('register_subscription');
        $this->content = $this->db->dbprefix('contents');
    }

    public function register($data)
    {
        $thumb = '';
        if (isset($data['thumb']) && !empty($data['thumb'])) {
            $content = base64_decode($data['thumb']); //base64 string
            $thumb = 'data/avatar/' . $data['member_id'] . '.png';
            $file = fopen('data/avatar/' . $data['member_id'] . '.png', "wb");
            fwrite($file, $content);
            fclose($file);
        }

        if (isset($data['member_id']) && !empty($data['member_id'])) {
            if (isset($data['step1']) && !empty($data['step1'])) {
                $member = json_decode($data['step1'], true);
                $member['modified'] = date("Y-m-d H:i:s");

                if ($thumb != '') {
                    $member['thumb'] = $thumb;
                }

                $this->db->where('id', $data['member_id']);
                $this->db->update($this->member, $member);
            }
        }

        $data_register = array(
            'content_type' => '1',
            'member_id' => $data['member_id'],
            'activity_id' => $data['activity_id'],
            //'reg1' => $data['reg1'],
            //'reg2' => $data['reg2'],
            //'reg3' => $data['reg3'],
            //'reg4' => $data['reg4'],
            //'other' => $data['other']

        );
        $this->db->select('id');
        $this->db->from($this->register);
        $this->db->where('content_type', '1');
        $this->db->where('activity_id', $data['activity_id']);
        $this->db->where('member_id', $data['member_id']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $d = $query->result();
            $this->db->where('id', $d[0]->id);
            $data_register['modified'] = date('Y-m-d H:i:s');
            $this->db->update($this->register, $data_register);
        } else {
            $data_register['created'] = date('Y-m-d H:i:s');
            $this->db->insert($this->register, $data_register);
        }

        // if (@$this->db->insert($this->register, $data_register)) {
        //     $res = array('code' => 200, 'message' => 'OK');
        // } else {
        //     $res = array('code' => 500, 'message' => 'Internal server error');
        // }
        $res = array('code' => 200, 'message' => 'OK');
        return $res;

    }

    public function registerSkills($data)
    {
        $thumb = '';
        if (isset($data['thumb']) && !empty($data['thumb'])) {
            $content = base64_decode($data['thumb']); //base64 string
            $thumb = 'data/avatar/' . $data['member_id'] . '.png';
            $file = fopen('data/avatar/' . $data['member_id'] . '.png', "wb");
            fwrite($file, $content);
            fclose($file);
        }

        if (isset($data['member_id']) && !empty($data['member_id'])) {
            if (isset($data['step1']) && !empty($data['step1'])) {
                $member = json_decode($data['step1'], true);
                $member['modified'] = date("Y-m-d H:i:s");

                if ($thumb != '') {
                    $member['thumb'] = $thumb;
                }

                $this->db->where('id', $data['member_id']);
                $this->db->update($this->member, $member);
            }
        }

        $data_register = array(
            'member_id' => $data['member_id'],
            'content_type' => '2',
            'reg1' => @$data['reg1'],
            'reg2' => @$data['reg2'],
            'reg3' => @$data['reg3'],
            'reg4' => @$data['reg4'],
            'other' => @$data['other'],

        );
        $this->db->select('id');
        $this->db->from($this->register);
        $this->db->where('content_type', '2');
        $this->db->where('member_id', $data['member_id']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $d = $query->result();
            $this->db->where('id', $d[0]->id);
            $data_register['modified'] = date('Y-m-d H:i:s');
            $this->db->update($this->register, $data_register);
        } else {
            $data_register['created'] = date('Y-m-d H:i:s');
            $this->db->insert($this->register, $data_register);
        }

        // if (@$this->db->insert($this->register, $data_register)) {
        //     $res = array('code' => 200, 'message' => 'OK');
        // } else {
        //     $res = array('code' => 500, 'message' => 'Internal server error');
        // }
        $res = array('code' => 200, 'message' => 'OK');
        return $res;

    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->member, $data);
        return true;
    }

    public function get_volunteer($page_size = 10, $page_no = 1, $keyword = array())
    {
        $t1 = $this->db->dbprefix('register');
        $t2 = $this->db->dbprefix('contents');

        // get page
        $offset = ($page_size * $page_no) - $page_size;

        // search
        $this->db->select('t1.*,t2.title');
        $this->db->from($t1 . ' t1');
        $this->db->join($t2 . ' t2', 't2.id = t1.activity_id', 'left');
        $this->db->where('t1.member_id', $keyword['member_id']);

        $this->db->limit($page_size, $offset);
        $this->db->order_by("t1.id", "DESC");
        $data['data'] = $this->db->get()->result();
        //print $this->db->last_query();

        // count all
        $this->db->from($t1);
        $this->db->where('member_id', $keyword['member_id']);
        $count_all = $this->db->count_all_results();

        // paging config
        $data['paging']['total_item'] = $count_all;
        $data['paging']['page_size'] = $page_size;
        $data['paging']['page_no'] = $page_no;
        // total page
        $page_total = ceil($count_all / $page_size);
        $data['paging']['page_total'] = $page_total;

        return $data;
    }

    public function check_activity($data)
    {
        $this->db->select('id');
        $this->db->from($this->register);
        $this->db->where('activity_id', $data['activity_id']);
        $this->db->where('member_id', $data['member_id']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_volunteerall($page_size = 10, $page_no = 1, $keyword = array())
    {
        $t1 = $this->db->dbprefix('volunteers');

        // get page
        $offset = ($page_size * $page_no) - $page_size;

        // search
        $this->db->select('t1.*,CONCAT( \'' . base_url() . '\',`thumb` ) AS thumb');
        $this->db->from($t1 . ' t1');
        if (isset($keyword['content_type']) && !empty($keyword['content_type'])) {
            $this->db->where('t1.content_type', $keyword['content_type']);
        }
        $this->db->where('t1.is_status', 'publish');
        $this->db->limit($page_size, $offset);
        $this->db->order_by("t1.id", "DESC");
        $data['data'] = $this->db->get()->result();
        //print $this->db->last_query();

        // count all
        $this->db->from($t1);
        if (isset($keyword['content_type']) && !empty($keyword['content_type'])) {
            $this->db->where('content_type', $keyword['content_type']);
        }
        $this->db->where('is_status', 'publish');
        $count_all = $this->db->count_all_results();

        // paging config
        $data['paging']['total_item'] = $count_all;
        $data['paging']['page_size'] = $page_size;
        $data['paging']['page_no'] = $page_no;
        // total page
        $page_total = ceil($count_all / $page_size);
        $data['paging']['page_total'] = $page_total;

        return $data;
    }
    public function get_volunteerall_detail($id)
    {
        $t1 = $this->db->dbprefix('volunteers');
        $this->db->select('*,CONCAT( \'' . base_url() . '\',`thumb` ) AS thumb');
        $query = $this->db->get_where($t1, array(
            "id" => $id, 'is_status' => 'publish',
        ));

        $data['data'] = $query->result();
        return $data;
    }

    // register wat
    public function registerWat($data)
    {
        $data['created'] = date('Y-m-d H:i:s');
        $this->db->insert($this->register_wat, $data);
        $res = array('code' => 200, 'message' => 'OK');
        return $res;

    }

    // register subscription
    public function registerSubscription($data)
    {
        $data_register = array(
            'member_id' => $data['member_id'],
            'reg1' => $data['reg1'],
        );

        $this->db->select('id');
        $this->db->from($this->register_subscription);
        $this->db->where('member_id', $data['member_id']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $d = $query->result();
            $this->db->where('id', $d[0]->id);
            $data_register['modified'] = date('Y-m-d H:i:s');
            $this->db->update($this->register_subscription, $data_register);
        } else {
            $data_register['created'] = date('Y-m-d H:i:s');
            $this->db->insert($this->register_subscription, $data_register);
        }

        $res = array('code' => 200, 'message' => 'OK');
        return $res;

    }

    public function member_detail($member_id, $content_id)
    {
        $res = array('email' => '', 'title' => '');

        $query = $this->db->get_where($this->member, array(
            'id' => $member_id,
        ), 1);

        if ($query->num_rows() > 0) {
            $data = $query->result();
            $res['email'] = $data[0]->email;
        }

        $query_content = $this->db->get_where($this->content, array(
            'id' => $content_id,
        ), 1);
        if ($query_content->num_rows() > 0) {
            $data = $query_content->result();
            $res['title'] = $data[0]->title;
        }
        // print_r($res);
        return $res;
    }
}
