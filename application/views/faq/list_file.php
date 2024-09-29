<?php
$gallery = $query[0]->gallery;
$arr_gallery = array();
if (!empty($gallery)) {
    $arr_gallery = json_decode($gallery);
}

// print_r($gallery);
// print_r($arr_gallery);
?>

<?php
for ($i=0;$i<count($arr_gallery);$i++) {
    $thumb = base_url(). $arr_gallery[$i];
    ?>
            <div class="col-sm-3 col-md-2" id="boximg_<?php echo $i ?>" style="margin-bottom:10px">
                <div style="overflow: hidden;height: 100px;border: 1px solid #e6e6e6;padding: 5px;">
                    <img src="<?php echo $thumb ?>" alt="..." class="img-responsive">
                </div>
                <div style="width:100%;height: 30px;font-size: smaller;padding: 2px">
                    <a href="javascript:delete_file('<?php echo $i ?>','<?php echo $arr_gallery[$i]?>');" class="label label-primary">Delete</a>
                </div>
            </div>
<?php }?>