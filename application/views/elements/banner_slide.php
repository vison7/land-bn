<?php
$this->db->select('thumb,banner_link');
$query = $this->db->get_where($this->db->dbprefix('banners'), array(
    'is_status' => 'active'
));
$data = $query->result();
?>
<div id="highlight">
	<ul id="slideHighlight">
	<?php foreach ($data as $row) {?>
		<li>
            <?php if(!empty($row->banner_link)){?><a href="<?php echo $row->banner_link?>"><?php }?>
                <img src="<?php echo base_url(). $row->thumb?>">
            <?php if(!empty($row->banner_link)){?></a><?php }?>
            </li>
    <?php }?>		
	</ul>
</div>