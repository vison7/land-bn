<?php
$this->db->order_by('name ASC');
$this->db->group_by("name");
$query = $this->db->get_where($this->db->dbprefix('colour'), array('product_group_id' => $group_id));
$obj_colour = $query->result();

if ($query->num_rows > 0) {
    ?>
    <select name="filter_colour" id="filter_colour" onchange="filter_by_colour(this);">
        <option value="">Colour</option>
        <?php foreach ($obj_colour as $row) { ?>
            <option value="<?php echo $row->code ?>"><?php echo $row->name ?></option>
        <?php } ?>
    </select>
    <?php
}?>