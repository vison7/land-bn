<?php
$this->db->order_by('name ASC');
$query = $this->db->get_where($this->db->dbprefix('product_type'), array('is_status' => 'active','group_id'=>$group_id));
$obj_cate = $query->result();

if ($query->num_rows > 0) {
    ?>
    <select name="filter_cate" id="filter_cate" onchange="filter_by_cate(this);">
        <option value="">Category</option>
        <?php foreach ($obj_cate as $row) { ?>
            <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
        <?php } ?>
    </select>
<?php }
?>