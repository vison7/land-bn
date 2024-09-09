<div class="page-header">
    <h1><i class="fa fa-list-alt page-header-icon"></i>&nbsp;&nbsp;กิจกรรม</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="panel-title">Edit Data</span>
                <div class="panel-heading-controls">
                    <button class="btn btn-sm btn-primary btn-outline" onclick="location.href = '<?php echo site_url('activity') ?>';"><span class="fa fa-chevron-left"></span>&nbsp;&nbsp;Back</button>
                </div>
            </div>
            <div class="panel-body">

                <form class="form-horizontal" id="form-validate"
                      action="<?php echo site_url('activity/edit_data') ?>" role="form"
                      method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $query[0]->id ?>">
                    <input type="hidden" name="file_list" id="file_list" value="">
                    <input type="hidden" name="lat" id="lat" value="">
                    <input type="hidden" name="lng" id="lng" value="">

                    <?php if (!empty($_GET['str'])) {?>
                        <div class="form-group">
                            <div class="col-lg-4 col-lg-offset-2">
                                <div
                                    class="alert alert-<?php echo @$_GET['code'] ?> alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">&times;</button>
                                    <strong>Message : </strong> <?php echo $_GET['str'] ?>
                                </div>
                            </div>
                        </div>
                        <!-- End .form-group  -->
                    <?php }?>
                    <!-- <?php if(admin_get_temple()==''){?>
                    <div class="form-group">
                            <label class="col-lg-2 control-label" for="required">วัด</label>
                            <div class="col-lg-3">
                                <select class="form-control" name="temple_id" id="temple_id">
                                <option value="0">Main Site</option>
                                <?php foreach($temple as $row_t){?>
                                <option <?php if($query[0]->temple_id==$row_t->id){?>selected="selected"<?php }?> value="<?php echo $row_t->id?>"><?php echo $row_t->name?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <?php }else{?>
                        <input type="hidden" name="temple_id" id="temple_id" value="<?php echo admin_get_temple()?>" />
                    <?php }?> -->

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="required">ประเภท</label>
                        <div class="col-lg-6">
                            <select class="form-control" name="cate_id" id="cate_id">
                                <option value="">--เลือก--</option>
                                <?php foreach (NEW_ACTIVITY_CATE as $key_cate => $val_cate) {?>
                                <option <?php if ($query[0]->cate_id == $key_cate) {?>selected="selected"<?php }?> value="<?php echo $key_cate ?>"><?php echo $val_cate ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                   

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">หัวข้อ</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="title"
                                   name="title" value="<?php echo $query[0]->title ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="required"></label>
                        <div class="col-lg-8">
                            <?php
if ($query[0]->thumb != '') {
    echo '<img src="' . base_url() . $query[0]->thumb . '"  border="0" class="img-responsive" />';
}
?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="required">รูป </label>
                        <div class="col-lg-4">
                            <input type="file" class="form-control" id="thumb" name="thumb">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="name">รายละเอียดโดยย่อ</label>
                        <div class="col-lg-8">
                            <textarea cols="70" rows="4" name="description" id="description" style="width:100%;"><?php echo $query[0]->description ?></textarea>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-lg-2 control-label" for="event_date">วันที่เริ่มจัดกิจกรรม</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="event_date" name="event_date" value="<?php echo $query[0]->event_date ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="event_end_date">วันที่จบกิจกรรม</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="event_end_date" name="event_end_date" value="<?php if($query[0]->event_end_date!='0000-00-00'){ echo $query[0]->event_end_date;}?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="location">สถานที่</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="location" name="location" value="<?php echo $query[0]->location ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">แท็ก</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="tags" name="tags" value="<?php echo $query[0]->tags ?>">
                            ( คั่นด้วย , )
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="name">รายละเอียด</label>
                        <div class="col-lg-10">
                            <textarea cols="70" rows="4" name="detail" id="detail" style="width:100%;"><?php echo $query[0]->detail ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="recommend">แนะนำ</label>
                        <div class="col-lg-8">
                            <label class="custom-control custom-checkbox checkbox-inline" for="recommend">
                                <input type="checkbox" value="yes" name="recommend" id="recommend" <?php if ($query[0]->recommend == "yes") { ?>checked="checked"<?php }?>  class="custom-control-input">
                                Yes
                            </label>
                        </div>
                    </div>
                    
                    <!-- <div class="form-group">
                        <label class="col-lg-2 control-label" for="name">แผนที่ (Embed)</label>
                        <div class="col-lg-8">
                            <textarea cols="70" rows="4" name="map" id="map" style="width:100%;height:250px;"><?php echo $query[0]->map ?></textarea>
                        </div>
                    </div> -->
                    <!-- <div class="form-group">
                        <label class="col-lg-2 control-label" for="name">แผนที่</label>
                        <div class="col-lg-8">
                            <div id="map" style="width:100%;height:350px;"></div>
                            <button type="button" class="btn btn-sm btn-default" onclick="clearMarker()">Clear Map</button>
                        </div>
                    </div> -->

                    <!-- <div class="form-group">
                        <label class="col-lg-2 control-label" for="name"></label>
                        <div class="col-lg-8">
                            <div id="image_list_edit" style="width:100%;height:350px;border: 1px dashed #ccc;"></div>
                        </div>
                    </div> -->

                    <!-- <div class="form-group">
                        <label class="col-lg-2 control-label" for="name">รูปภาพ</label>
                        <div class="col-lg-8">
                            <div id="myDropzone" class="my_dropzone">
                                <div class="dz-default dz-message">
                                    <div class="dz-upload-icon"></div>
                                    Drop files in here<br>
                                    <span class="dz-text-small">or click to pick manually
                                        <br>คลิกเพื่อเลือกรูป (เลือกได้ 12 รูป)
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="text">สถานะ</label>
                        <div class="col-lg-2">
                            <select class="form-control" name="is_status" id="is_status">
                                <option value="publish" <?php if ($query[0]->is_status == "publish") {?> selected="selected" <?php }?>>publish</option>
                                <option value="draft" <?php if ($query[0]->is_status == "draft") {?> selected="selected" <?php }?>>draft</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4 col-lg-offset-2">
                        <?php if(get_admin_login()->is_level!='4'){?>
                            <button type="submit" class="btn btn-primary" id="startUpload">Save</button>
                        <?php }?>
                            <button type="button" class="btn btn-default" id="btn_back">Back</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End .panel -->
    </div>
    <!-- End .span12 -->
</div>
<!-- End .row -->
<script type="text/javascript">
    var ff = null;
    init.push(function () {
        $('#btn_back').click(function(){location.href='<?php echo site_url('activity')?>';});

        $('#event_date,#event_end_date').datepicker({
            format: 'yyyy-mm-dd'
        });
        tinyInit('textarea#detail');
        // list_image();

        $("#form-validate").validate({
            ignore: 'input[type="hidden"]',
            rules: {
                title: "required",
            },
            submitHandler: function(form) {
                //if (confirm('คุณแน่ใจที่จะ publish บทความหรือไม่ ?'))
                form.submit();
            }
        });

    }); //End document ready functions



</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/tinymce4/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/tinymce4/tiny_init.js"></script>
