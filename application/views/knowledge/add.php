<div class="page-header">
    <h1><i class="fa fa-list-alt page-header-icon"></i>&nbsp;&nbsp;องค์ความรู้</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-heading">
                <span class="panel-title">Insert Data</span>
                <div class="panel-heading-controls">
                    <button class="btn btn-sm btn-primary btn-outline" onclick="location.href = '<?php echo site_url('knowledge') ?>';"><span class="fa fa-chevron-left"></span>&nbsp;&nbsp;Back</button>
                </div>
            </div>

            <div class="panel-body">
                <form class="form-horizontal" id="form-validate"
                      action="<?php echo site_url('knowledge/add_data') ?>" role="form"
                      method="post" enctype="multipart/form-data">

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
                    <?php } ?>
                            
                    
                    <div class="form-group" <?php if(admin_get_temple()!=''){?>style="display:none;"<?php }?>>
                        <label class="col-lg-2 control-label" for="required">ประเภท</label>
                        <div class="col-lg-3">
                            <select class="form-control" name="cate_id" id="cate_id">
                                <?php foreach(KNOWLEDGE_CATE as $key_k=>$val_k){?>
                                <option value="<?php echo $key_k?>"><?php echo $val_k?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">หัวข้อ</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="title" name="title">
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
                            <textarea cols="70" rows="4" name="description" id="description" style="width:100%;"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">แท็ก</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="tags" name="tags" >
                            ( คั่นด้วย , )
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="name">รายละเอียด</label>
                        <div class="col-lg-10">
                            <textarea cols="70" rows="4" name="detail" id="detail" style="width:100%;"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="recommend">แนะนำ</label>
                        <div class="col-lg-8">
                            <label class="custom-control custom-checkbox checkbox-inline" for="recommend">
                                <input type="checkbox" value="yes" name="recommend" id="recommend" class="custom-control-input">
                                Yes
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="author">ผู้เขียน</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="author" name="author">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="author">วันที่</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="event_date" name="event_date" value="<?php echo date('Y-m-d')?>">
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
                                    onclick="location.href = '<?php echo site_url('knowledge') ?>';">Back</button>
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
    init.push(function () {
        $('#event_date').datepicker({
            format: 'yyyy-mm-dd'
        });

        $("#form-validate").validate({
            ignore: 'input[type="hidden"]',
            rules: {
                name: "required",
                thumb: {
                    required: true,
                    accept: "image/*"
                },
                banner_link: "required"
            },
            submitHandler: function (form) {
                //if (confirm('คุณแน่ใจที่จะ publish บทความหรือไม่ ?'))
                form.submit();
            }
        });
        tinyInit('textarea#detail');
    }); //End document ready functions
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/tinymce4/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/tinymce4/tiny_init.js"></script>
