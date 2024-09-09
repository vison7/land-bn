<div class="page-header">
    <h1><i class="fa fa-list-alt page-header-icon"></i>&nbsp;&nbsp;ระบบจัดการวัด</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="panel-title">Edit Data</span>
                
            </div>
            <div class="panel-body">

                <form class="form-horizontal" id="form-validate"
                      action="<?php echo site_url('temple/edit_data') ?>" role="form"
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
                        <label class="col-lg-2 control-label" for="title">ชื่อ URL</label>
                        <div class="col-lg-6">
                            <h4 class="text-bold"><?php echo $query[0]->slug ?></h4>
                        </div>
                    </div>
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
                        <label class="col-lg-2 control-label" for="title">ชื่อวัด</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="name"
                                   name="name" value="<?php echo $query[0]->name ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="required"></label>
                        <div class="col-lg-4">
                            <?php
                            if ($query[0]->logo != '') {
                                echo '<img src="' . base_url() . $query[0]->logo . '"  border="0" class="img-responsive" />';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="logo">โลโก้</label>
                        <div class="col-lg-4">
                            <input type="file" class="form-control" id="logo" name="logo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="required"></label>
                        <div class="col-lg-6">
                            <?php
                            if ($query[0]->bg_header != '') {
                                echo '<img src="' . base_url() . $query[0]->bg_header . '"  border="0" class="img-responsive" />';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="bg_header">แบล็กกราวน์</label>
                        <div class="col-lg-4">
                            <input type="file" class="form-control" id="bg_header" name="bg_header">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="name">รายละเอียดโดยย่อ</label>
                        <div class="col-lg-6">
                            <textarea cols="70" rows="4" class="form-control" name="description" id="description" style="width:100%;"><?php echo $query[0]->description ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">สโลแกนวัด</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="slogan" name="slogan" value="<?php echo $query[0]->slogan ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">โดย</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="author" name="author" value="<?php echo $query[0]->author ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">ที่อยู่</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="location" name="location" value="<?php echo $query[0]->location ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">โทรศัพท์</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $query[0]->phone ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">อีเมล์</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $query[0]->email ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">เว็บไซต์</label>
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
