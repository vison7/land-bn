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
    }

    // update an existing user and respond with a status/errors
    public function index_get()
    {
        $this->load->model('content_model');
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
        $this->load->model('content_model');
        $data = $this->content_model->get_detail($id);

        if (isset($data['data']) && !empty($data['data'])) {
            $res = array('code' => 200, 'data' => $data['data']);
        } else {
            $res = array('code' => 200, 'message' => 'No data', 'data' => array());
        }
        $this->response($res);
    }

    public function detail2_get()
    {
        $id = $this->get('id');

        $res = array('code' => 200, 'id' => $id);
        $this->response($res);
    }

    public function banner_get()
    {
        $this->load->model('content_model');
        // params
        $page_no = (isset($_REQUEST['page_no'])) ? $_REQUEST['page_no'] : 1;
        $page_size = (isset($_REQUEST['page_size'])) ? $_REQUEST['page_size'] : 10;
        $search = array();
        if (!empty($this->get('content_type'))) {
            $search['content_type'] = $this->get('content_type');
        }
        if ($this->get('temple_id') != '') {
            $search['temple_id'] = $this->get('temple_id');
        }

        if (!empty($this->get('cate_id'))) {
            $search['cate_id'] = $this->get('cate_id');
        }
        $data = $this->content_model->get_banner($page_size, $page_no, $search);

        if (isset($data['data']) && !empty($data['data'])) {
            $res = array('code' => 200, 'paging' => $data['paging'], 'data' => $data['data']);
        } else {
            $res = array('code' => 200, 'paging' => $data['paging'], 'message' => 'No data', 'data' => array());
        }
        $this->response($res);
    }

    public function bannerdetail_get()
    {
        $id = $this->get('id');
        $this->load->model('content_model');
        $data = $this->content_model->get_bannerdetail($id);

        if (isset($data['data']) && !empty($data['data'])) {
            $res = array('code' => 200, 'data' => $data['data']);
        } else {
            $res = array('code' => 200, 'message' => 'No data', 'data' => array());
        }
        $this->response($res);
    }

    public function watdetail_get()
    {
        $slug = $this->get('slug');
        $this->load->model('content_model');
        $data = $this->content_model->get_watdetail($slug);

        if (isset($data['data']) && !empty($data['data'])) {
            $res = array('code' => 200, 'data' => $data['data']);
        } else {
            $res = array('code' => 200, 'message' => 'No data', 'data' => array());
        }
        $this->response($res);
    }

    public function watdetailall_get()
    {
        $slug = $this->get('slug');
        $this->load->model('content_model');
        $data = $this->content_model->get_watdetail_all($slug);

        if (isset($data['data']) && !empty($data['data'])) {
            $res = array('code' => 200, 'data' => $data['data']);
        } else {
            $res = array('code' => 200, 'message' => 'No data', 'data' => array());
        }
        $this->response($res);
    }

    public function temple_get()
    {
        $this->load->model('content_model');
        // params
        $page_no = (isset($_REQUEST['page_no'])) ? $_REQUEST['page_no'] : 1;
        $page_size = (isset($_REQUEST['page_size'])) ? $_REQUEST['page_size'] : 10;

        $search = array();

        if (!empty($this->get('cate_id'))) {
            $search['cate_id'] = $this->get('cate_id');
        }
        if (!empty($this->get('zone'))) {
            $search['zone'] = $this->get('zone');
        }
        if (!empty($this->get('highlight'))) {
            $search['highlight'] = $this->get('highlight');
        }

        $data = $this->content_model->get_temple($page_size, $page_no, $search);

        if (isset($data['data']) && !empty($data['data'])) {
            $res = array('code' => 200, 'paging' => $data['paging'], 'data' => $data['data']);
        } else {
            $res = array('code' => 200, 'paging' => $data['paging'], 'message' => 'No data', 'data' => array());
        }
        $this->response($res);
    }

    public function templedetail_get()
    {
        $id = $this->get('id');
        $this->load->model('content_model');
        $data = $this->content_model->get_templedetail($id);

        if (isset($data['data']) && !empty($data['data'])) {
            $res = array('code' => 200, 'data' => $data['data']);
        } else {
            $res = array('code' => 200, 'message' => 'No data', 'data' => array());
        }
        $this->response($res);
    }
}
