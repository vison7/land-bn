<div class="page-header">
    <h1><i class="fa fa-list-alt page-header-icon"></i>&nbsp;&nbsp;อาสาสมัคร</h1>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title">Edit Data</span>
        <div class="panel-heading-controls">
            <button class="btn btn-sm btn-primary btn-outline" onclick="location.href = '<?php echo site_url('volunteerall') ?>';"><span class="fa fa-chevron-left"></span>&nbsp;&nbsp;Back</button>
        </div>
    </div>
    <div class="panel-body">

        <form class="form-horizontal" id="form-validate"
              action="<?php echo site_url('volunteerall/edit_data') ?>" role="form"
              method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $query[0]->id ?>">

            <?php if (!empty($_GET['str'])) { ?>
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
            <?php } ?>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="title">ประเภท</label>
                <div class="col-lg-6">
                <select class="form-control" name="content_type" id="content_type">
                    <option value="">--เลือกประเภท--</option>
                    <option value="1" <?php if ($query[0]->content_type == "1") { ?> selected="selected" <?php } ?>>อาสาสมัคร</option>
                    <option value="2" <?php if ($query[0]->content_type == "2") { ?> selected="selected" <?php } ?>>ข้อคิดจากการทำงาน</option>
                </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="title">ชื่อ</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $query[0]->name ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="title">ตำแหน่ง</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" id="position" name="position" value="<?php echo $query[0]->position ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-2 control-label" for="name">รายละเอียดย่อ</label>
                <div class="col-lg-6">
                    <textarea class="form-control" cols="70" rows="4" name="description" id="description"><?php echo $query[0]->description ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="required"></label>
                <div class="col-lg-4">
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
                    <input type="file" id="thumb" name="thumb"> (width:300px , Height: 450px)
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="name">รายละเอียด</label>
                <div class="col-lg-10">
                    <textarea cols="70" rows="4" name="detail" id="detail" style="width:100%;"><?php echo $query[0]->detail ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="title">Facebook</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo $query[0]->facebook ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="title">Google Plus</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" id="googleplus" name="googleplus" value="<?php echo $query[0]->googleplus ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="title">IG</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" id="ig" name="ig" value="<?php echo $query[0]->ig ?>">
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
                <?php if(get_admin_login()->is_level!='4'){?>
                    <button type="submit" class="btn btn-primary">Save</button>
                <?php }?>
                    <button type="button" class="btn btn-default"
                            onclick="location.href = '<?php echo site_url('volunteerall') ?>';">Back</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">

    init.push(function () {
        $("#form-validate").validate({
            ignore: 'input[type="hidden"]',
            rules: {
                name: "required",
//                banner_link: "required"
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
        tinyInit('textarea#detail');
    }); //End document ready functions
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/tinymce4/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/tinymce4/tiny_init.js"></script>
