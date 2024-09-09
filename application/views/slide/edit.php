<div class="page-header">
    <h1><i class="fa fa-list-alt page-header-icon"></i>&nbsp;&nbsp;สไลด์โชว์</h1>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title">Edit Data</span>
        <div class="panel-heading-controls">
            <button class="btn btn-sm btn-primary btn-outline" onclick="location.href = '<?php echo site_url('slide') ?>';"><span class="fa fa-chevron-left"></span>&nbsp;&nbsp;Back</button>
        </div>
    </div>
    <div class="panel-body">

        <form class="form-horizontal" id="form-validate" action="<?php echo site_url('slide/edit_data') ?>" role="form" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $query[0]->id ?>">

            <?php if (!empty($_GET['str'])) { ?>
                <div class="form-group">
                    <div class="col-lg-4 col-lg-offset-2">
                        <div class="alert alert-<?php echo @$_GET['code'] ?> alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Message : </strong> <?php echo $_GET['str'] ?>
                        </div>
                    </div>
                </div>
                <!-- End .form-group  -->
            <?php } ?>
            
            <div class="form-group">
                <label class="col-lg-2 control-label" for="required">ประเภท</label>
                <div class="col-lg-3">
                    <select class="form-control" name="cate_id" id="cate_id">
                        <?php foreach (SLIDE_CATE as $key_k => $val_k) { ?>
                            <option <?php if ($query[0]->cate_id == $key_k) { ?>selected="selected" <?php } ?> value="<?php echo $key_k ?>"><?php echo $val_k ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="title">หัวข้อ</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $query[0]->title ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="name">รายละเอียด</label>
                <div class="col-lg-6">
                    <textarea class="form-control" cols="70" rows="4" name="description" id="description"><?php echo $query[0]->description ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="required"></label>
                <div class="col-lg-6">
                    <?php
                    if ($query[0]->thumb != '') {
                        echo '<img src="' . base_url() . $query[0]->thumb . '" class="img-responsive" />';
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="required">รูป </label>
                <div class="col-lg-4">
                    <input type="file" id="thumb" name="thumb">
                    (width: 1920px , Height: 880px) ขนาดไม่ควรเกิน 1M
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="name">ลิงค์</label>
                <div class="col-lg-6">
                    <input class="form-control" id="banner_link" name="banner_link" type="text" placeholder="http://" value="<?php echo $query[0]->banner_link ?>" />
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="col-lg-2 control-label" for="name">รายละเอียด</label>
                <div class="col-lg-10">
                    <textarea cols="70" rows="4" name="detail" id="detail" style="width:100%;"><?php echo $query[0]->detail ?></textarea>
                </div>
            </div> -->
            <div class="form-group">
                <label class="col-lg-2 control-label" for="title">วันที่แสดง</label>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="publish_date" name="publish_date" value="<?php echo date("Y-m-d", strtotime($query[0]->publish_date)) ?>">
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group date">
                                <input type="text" class="form-control" id="time_publish_date" name="time_publish_date" value="<?php echo date("H:i", strtotime($query[0]->publish_date)) ?>"><span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="text">สถานะ</label>
                <div class="col-lg-2">
                    <select class="form-control" name="is_status" id="is_status">
                        <option value="publish" <?php if ($query[0]->is_status == "publish") { ?> selected="selected" <?php } ?>>publish</option>
                        <option value="draft" <?php if ($query[0]->is_status == "draft") { ?> selected="selected" <?php } ?>>draft</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-4 col-lg-offset-2">
                    <?php if (get_admin_login()->is_level != '4') { ?>
                        <button type="submit" class="btn btn-primary">Save</button>
                    <?php } ?>
                    <button type="button" class="btn btn-default" onclick="location.href = '<?php echo site_url('slide') ?>';">Back</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    init.push(function() {
        $('#publish_date').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#time_publish_date').timepicker({
            showMeridian: false,
            minuteStep: 5
        });

        $("#form-validate").validate({
            ignore: 'input[type="hidden"]',
            rules: {
                name: "required",
                //                banner_link: "required"
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
        //tinyInit('textarea#detail');
    }); //End document ready functions
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/tinymce4/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/tinymce4/tiny_init.js"></script>