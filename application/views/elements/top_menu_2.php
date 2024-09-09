<?php
$this->db->select('name');
$this->db->order_by('name ASC');
$query = $this->db->get_where($this->db->dbprefix('product_type'));
$obj_pro_type = $query->result();

if ($query->num_rows > 0) {
    ?>
    <ul class="nav-inner-navigation">
        <?php foreach ($obj_pro_type as $row) { ?>
            <li><a href="<?php echo site_url('?product_type=' . $row->name) ?>"><?php echo $row->name ?></a></li>
        <?php } ?>
    </ul>
<?php
}?>