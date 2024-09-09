<?php

class Content_model extends CI_Model
{

    public $db_read = null;

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_content($page_size = 10, $page_no = 1, $keyword = array(),$sort = array(),$notin = array())
    {
        $table = $this->db->dbprefix('contents');

        // get page
        $offset = ($page_size * $page_no) - $page_size;

        // search
        $this->db->select('id,content_type,temple_id,cate_id,title,CONCAT( \'' . base_url() . '\',`thumb` ) AS thumb,description,event_date,event_end_date,publish_date,location,created,modified');
        $this->db->from($table);
        $this->db->where('is_status', 'publish');

        if (isset($keyword['temple_id']) && $keyword['temple_id']!='') {
            $this->db->where('temple_id', $keyword['temple_id']);
        }
        if (isset($keyword['content_type']) && !empty($keyword['content_type'])) {
            $this->db->where('content_type', $keyword['content_type']);
        }
        if (isset($keyword['cate_id']) && !empty($keyword['cate_id'])) {
            $this->db->where('cate_id', $keyword['cate_id']);
        }
        if (isset($keyword['recommend']) && !empty($keyword['recommend'])) {
            $this->db->where('recommend', $keyword['recommend']);
        }
        if (isset($keyword['highlight']) && !empty($keyword['highlight'])) {
            $this->db->where('highlight', $keyword['highlight']);
        }
        if ((isset($keyword['start_date']) && !empty($keyword['start_date'])) && (isset($keyword['end_date']) && !empty($keyword['end_date'])) ) {
            $this->db->where('event_date >= ', $keyword['start_date']);
            $this->db->where('event_date <= ', $keyword['end_date']);
        }

        if (isset($notin['temple_id']) && !empty($notin['temple_id'])) {
            $this->db->where_not_in('temple_id', $notin['temple_id']);
        }
        if (isset($notin['cate_id']) && !empty($notin['cate_id'])) {
            $this->db->where_not_in('cate_id', $notin['cate_id']);
        }

        if (isset($sort['event_date']) && !empty($sort['event_date'])) {
            $this->db->order_by("event_date", "DESC");
        }

        if (isset($keyword['hit']) && !empty($keyword['hit'])) {
            $this->db->order_by("count_views", "DESC");
        }else{
            $this->db->order_by("publish_date", "DESC");
            $this->db->order_by("id", "DESC");
        }

        $this->db->limit($page_size, $offset);
        
        $data['data'] = $this->db->get()->result();
        // $this->db->last_query();
        // $data['profile'] = $this->db->last_query();

        // count all
        $this->db->from($table);
        $this->db->where('is_status', 'publish');
        if (isset($keyword['temple_id']) && $keyword['temple_id']!='') {
            $this->db->where('temple_id', $keyword['temple_id']);
        }
        if (isset($keyword['content_type']) && !empty($keyword['content_type'])) {
            $this->db->where('content_type', $keyword['content_type']);
        }
        if (isset($keyword['cate_id']) && !empty($keyword['cate_id'])) {
            $this->db->where('cate_id', $keyword['cate_id']);
        }
        if (isset($keyword['recommend']) && !empty($keyword['recommend'])) {
            $this->db->where('recommend', $keyword['recommend']);
        }
        if (isset($keyword['highlight']) && !empty($keyword['highlight'])) {
            $this->db->where('highlight', $keyword['highlight']);
        }
        if (isset($notin['temple_id']) && !empty($notin['temple_id'])) {
            $this->db->where_not_in('temple_id', $notin['temple_id']);
        }
        if (isset($notin['cate_id']) && !empty($notin['cate_id'])) {
            $this->db->where_not_in('cate_id', $notin['cate_id']);
        }
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

    public function get_detail($id)
    {
        $table = $this->db->dbprefix('contents');
        
        $this->db->set('count_views', 'count_views+1', FALSE);
        $this->db->where('id', $id);
        $this->db->update($table);

        $this->db->select('*,CONCAT( \'' . base_url() . '\',`thumb` ) AS thumb');
        $query = $this->db->get_where($table, array(
            "id" => $id, 'is_status' => 'publish',
        ));
        
        $ret = $query->result();
        $imgs = array();
        if(!empty($ret[0]->gallery)){
            $g = $ret[0]->gallery;
            $arr_g = json_decode($g);
            foreach($arr_g as $row){
                $imgs[] =  base_url() . $row;
            }
            $ret[0]->gallery = $imgs;
        }
        
        $data['data'] = $ret;

        return $data;
    }

    public function get_banner($page_size = 10, $page_no = 1, $keyword = array())
    {
        $table = $this->db->dbprefix('banners');

        // get page
        $offset = ($page_size * $page_no) - $page_size;

        // search
        $this->db->select('id,temple_id,title,CONCAT( \'' . base_url() . '\',`thumb` ) AS thumb,banner_link,description');
        $this->db->from($table);
        $this->db->where('is_status', 'publish');
        if (isset($keyword['temple_id']) && $keyword['temple_id']!='') {
            $this->db->where('temple_id', $keyword['temple_id']);
        }
        if (isset($keyword['content_type']) && !empty($keyword['content_type'])) {
            $this->db->where('content_type', $keyword['content_type']);
        }
        $this->db->limit($page_size, $offset);
        $this->db->order_by("id", "DESC");
        $data['data'] = $this->db->get()->result();
        //print $this->db->last_query();

        // count all
        $this->db->from($table);
        $this->db->where('is_status', 'publish');
        if (isset($keyword['temple_id']) && $keyword['temple_id']!='') {
            $this->db->where('temple_id', $keyword['temple_id']);
        }
        if (isset($keyword['content_type']) && !empty($keyword['content_type'])) {
            $this->db->where('content_type', $keyword['content_type']);
        }

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
    public function get_bannerdetail($id)
    {
        $table = $this->db->dbprefix('banners');
        $query = $this->db->get_where($table, array(
            "id" => $id, 'is_status' => 'publish',
        ));

        $data['data'] = $query->result();

        return $data;
    }
    public function get_watdetail($slug)
    {
        $this->db->select('id,slug,name,slogan,logo,bg_header,author,location,email,phone,website,youtube,facebook,CONCAT( \'' . base_url() . '\',`logo` ) AS logo, CONCAT( \'' . base_url() . '\',`bg_header` ) AS bg_header');
        $table = $this->db->dbprefix('temples');
        $query = $this->db->get_where($table, array(
            "slug" => $slug, 'is_status' => 'publish',
        ));

        $data['data'] = $query->result();
        return $data;
    }
    public function get_watdetail_all($slug)
    {
        $this->db->select('*,CONCAT( \'' . base_url() . '\',`logo` ) AS logo, CONCAT( \'' . base_url() . '\',`bg_header` ) AS bg_header');
        $table = $this->db->dbprefix('temples');
        $query = $this->db->get_where($table, array(
            "slug" => $slug, 'is_status' => 'publish',
        ));

        $data['data'] = $query->result();
        return $data;
    }

    public function get_temple($page_size = 10, $page_no = 1, $keyword = array())
    {
        $table = $this->db->dbprefix('temple_all');

        // get page
        $offset = ($page_size * $page_no) - $page_size;

        // search
        $this->db->select('id,cate_id,zone,address,external_link,website,name,CONCAT( \'' . base_url() . '\',`thumb` ) AS thumb,description,created,modified');
        $this->db->from($table);
        $this->db->where('is_status', 'publish');

        if (isset($keyword['cate_id']) && !empty($keyword['cate_id'])) {
            $this->db->where('cate_id', $keyword['cate_id']);
        }
        if (isset($keyword['zone']) && !empty($keyword['zone'])) {
            $this->db->where('zone', $keyword['zone']);
        }
        if (isset($keyword['highlight']) && !empty($keyword['highlight'])) {
            $this->db->where('highlight', $keyword['highlight']);
        }

        $this->db->limit($page_size, $offset);
        $this->db->order_by("publish_date", "DESC");
        $this->db->order_by("id", "DESC");
        $data['data'] = $this->db->get()->result();
        //print $this->db->last_query();

        // count all
        $this->db->from($table);
        $this->db->where('is_status', 'publish');
        if (isset($keyword['cate_id']) && !empty($keyword['cate_id'])) {
            $this->db->where('cate_id', $keyword['cate_id']);
        }
        if (isset($keyword['zone']) && !empty($keyword['zone'])) {
            $this->db->where('zone', $keyword['zone']);
        }
        if (isset($keyword['highlight']) && !empty($keyword['highlight'])) {
            $this->db->where('highlight', $keyword['highlight']);
        }
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

    public function get_templedetail($id)
    {
        $table = $this->db->dbprefix('temple_all');
        $this->db->select('*,CONCAT( \'' . base_url() . '\',`thumb` ) AS thumb');
        $query = $this->db->get_where($table, array(
            "id" => $id, 'is_status' => 'publish',
        ));

        $data['data'] = $query->result();

        return $data;
    }
}
