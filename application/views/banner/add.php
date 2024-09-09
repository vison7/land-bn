<div class="page-header">
    <h1><i class="fa fa-list-alt page-header-icon"></i>&nbsp;&nbsp;แบนเนอร์</h1>
</div>

<div class="panel panel-default">

    <div class="panel-heading">
        <span class="panel-title">Insert Data</span>
        <div class="panel-heading-controls">
            <button class="btn btn-sm btn-primary btn-outline" onclick="location.href = '<?php echo site_url('banner') ?>';"><span class="fa fa-chevron-left"></span>&nbsp;&nbsp;Back</button>
        </div>
    </div>

    <div class="panel-body">
        <form class="form-horizontal" id="form-validate"
              action="<?php echo site_url('banner/add_data') ?>" role="form"
              method="post" enctype="multipart/form-data">

            <input type="hidden" name="lat" id="lat" value="" />
            <input type="hidden" name="lng" id="lng" value="" />

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
            <?php if(admin_get_temple()==''){?>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="required">วัด</label>
                <div class="col-lg-3">
                    <select class="form-control" name="temple_id" id="temple_id">
                    <option value="0">Main Site</option>
                    <?php foreach($temple as $row_t){?>
                    <option value="<?php echo $row_t->id?>"><?php echo $row_t->name?></option>
                    <?php }?>
                    </select>
                </div>
            </div>
            <?php }else{?>
                <input type="hidden" name="temple_id" id="temple_id" value="<?php echo admin_get_temple()?>" />
            <?php }?>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="title">หัวข้อ</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" id="title" name="title">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="name">รายละเอียด</label>
                <div class="col-lg-6">
                    <textarea class="form-control" cols="70" rows="4" name="description" id="description"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="required">รูป </label>
                <div class="col-lg-4">
                    <input type="file" class="form-control" id="thumb" name="thumb"> (width: 300px , Height: 450px)
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="name">ลิงค์</label>
                <div class="col-lg-6">
                    <input class="form-control" id="banner_link" name="banner_link" type="text" placeholder="http://" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="name">รายละเอียด</label>
                <div class="col-lg-10">
                    <textarea cols="70" rows="4" name="detail" id="detail" style="width:100%;"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="text">สถานะ</label>
                <div class="col-lg-2">
                    <select class="form-control" name="is_status" id="is_status">
                    <option value="publish">publish</option>
                    <option value="draft">draft</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-4 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default"
                            onclick="location.href = '<?php echo site_url('banner') ?>';">Back</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End .panel -->

<script type="text/javascript">

    init.push(function () {
        $("#form-validate").validate({
            ignore: 'input[type="hidden"]',
            rules: {
                title: "required",
                thumb: "required",
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
