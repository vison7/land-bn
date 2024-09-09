<div class="page-header">
    <h1><i class="fa fa-list-alt page-header-icon"></i>&nbsp;&nbsp;พื้นที่สุขภาวะสร้างสรรค์</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="panel-title">Edit Data</span>
                <!-- <div class="panel-heading-controls">
                    <button class="btn btn-sm btn-primary btn-outline" onclick="location.href = '<?php echo site_url('sandbox1') ?>';"><span class="fa fa-chevron-left"></span>&nbsp;&nbsp;Back</button>
                </div> -->
            </div>
            <div class="panel-body">

                <form class="form-horizontal" id="form-validate"
                      action="<?php echo site_url('sandbox1/edit_data2') ?>" role="form"
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
                        <label class="col-lg-2 control-label" for="name">ความหมาย บทนำ </label>
                        <div class="col-lg-8">
                            <textarea cols="70" rows="4" name="description" id="description" style="width:100%;"><?php echo $query[0]->description ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="name">แนวคิดการพัฒนาพื้นที่สุขภาวะสร้างสรรค์สำหรับคนทุกวัย</label>
                        <div class="col-lg-8">
                            <textarea cols="70" rows="10" name="detail" id="detail" style="width:100%;height:300px;"><?php echo $query[0]->detail ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-4 col-lg-offset-2">
                        <?php if(get_admin_login()->is_level!='4'){?>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <?php }?>
                            
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
        $('#publish_date').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#time_publish_date').timepicker({
            showMeridian : false,
            minuteStep : 5
        });

        $("#form-validate").validate({
            ignore: 'input[type="hidden"]',
            rules: {
                name: "required",
                banner_link: "required"
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
        tinyInit('textarea#detail');
    }); //End document ready functions
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/tinymce4/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/tinymce4/tiny_init.js?r=1"></script>
