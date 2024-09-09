<div class="page-header">
    <h1><i class="fa fa-list-alt page-header-icon"></i>&nbsp;&nbsp;วัด</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="panel-title">Edit Data</span>
                <div class="panel-heading-controls">
                    <button class="btn btn-sm btn-primary btn-outline" onclick="location.href = '<?php echo site_url('templeall') ?>';"><span class="fa fa-chevron-left"></span>&nbsp;&nbsp;Back</button>
                </div>
            </div>
            <div class="panel-body">

                <form class="form-horizontal" id="form-validate"
                      action="<?php echo site_url('templeall/edit_data') ?>" role="form"
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
                        <label class="col-lg-2 control-label" for="text">ประเภทวัด</label>
                        <div class="col-lg-2">
                            <select class="form-control" name="cate_id" id="cate_id">
                            <option value="">--เลือก--</option>
                                <?php foreach(TEMPLE_CATE as $key_tp=>$val_tp){?>
                                <option <?php if($key_tp==$query[0]->cate_id){?>selected="selected"<?php }?> value="<?php echo $key_tp?>"><?php echo $val_tp?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="text">โซน</label>
                        <div class="col-lg-2">
                            <select class="form-control" name="zone" id="zone">
                                <option value="">--เลือก--</option>
                                <?php foreach(TEMPLE_ZONE as $key_tp=>$val_tp){?>
                                <option <?php if($key_tp==$query[0]->zone){?>selected="selected"<?php }?> value="<?php echo $key_tp?>"><?php echo $val_tp?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">ชื่อวัด</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="name"
                                   name="name" value="<?php echo $query[0]->name ?>">
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
                        <label class="col-lg-2 control-label" for="name">รายละเอียด</label>
                        <div class="col-lg-6">
                            <textarea cols="70" rows="4" class="form-control" name="description" id="description" style="width:100%;"><?php echo $query[0]->description ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">ประเภท</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="temple_type" name="temple_type" value="<?php echo $query[0]->temple_type ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">นิกาย</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="church" name="church" value="<?php echo $query[0]->church ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">ที่ตั้ง</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $query[0]->address ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">โทรศัพท์</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $query[0]->phone ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">โทรสาร</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="fax" name="fax" value="<?php echo $query[0]->fax ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">Website</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="website" name="website" value="<?php echo $query[0]->website ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">Youtube</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="youtube" name="youtube" value="<?php echo $query[0]->youtube ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">Facebook</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo $query[0]->facebook ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">วันที่แสดง</label>
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="publish_date" name="publish_date"
                                        value="<?php echo date("Y-m-d",strtotime($query[0]->publish_date))?>">
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group date">
                                        <input type="text" class="form-control" id="time_publish_date" name="time_publish_date"
                                            value="<?php echo date("H:i",strtotime($query[0]->publish_date))?>"><span
                                            class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="name">รายละเอียด</label>
                        <div class="col-lg-10">
                            <textarea cols="70" rows="4" name="detail" id="detail" style="width:100%;"><?php echo $query[0]->detail ?></textarea>
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
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-default"
                                    onclick="location.href = '<?php echo site_url('templeall') ?>';">Back</button>
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
                name: "required"
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
