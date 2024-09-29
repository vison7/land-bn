<div class="page-header">
    <h1><i class="fa fa-list-alt page-header-icon"></i>&nbsp;&nbsp;FAQ</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-heading">
                <span class="panel-title">Create Data</span>
                <div class="panel-heading-controls">
                    <button class="btn btn-sm btn-primary btn-outline" onclick="location.href = '<?php echo site_url('faq') ?>';"><span class="fa fa-chevron-left"></span>&nbsp;&nbsp;Back</button>
                </div>
            </div>

            <div class="panel-body">
                <form class="form-horizontal" id="form-validate" action="<?php echo site_url('faq/add_data') ?>" role="form" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="file_list" id="file_list" value="">
                    <input type="hidden" name="lat" id="lat" value="">
                    <input type="hidden" name="lng" id="lng" value="">

                    <?php if (!empty($_GET['str'])) { ?>
                        <div class="form-group">
                            <div class="col-lg-4 col-lg-offset-2">
                                <div class="alert alert-<?php echo @$_GET['code'] ?> alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Message : </strong> <?php echo $_GET['str'] ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <input type="hidden" name="temple_id" id="temple_id" value="<?php echo admin_get_temple() ?>" />

                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="required">Category</label>
                            <div class="col-lg-3">
                                <select class="form-control" name="cate_id" id="cate_id">
                                    <option value="">-- Select --</option>
                                    <?php foreach (FAQ_CATE as $key_cate => $val_cate) { ?>
                                        <option value="<?php echo $key_cate ?>"><?php echo $val_cate ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">Title</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="required">Thumbnail </label>
                        <div class="col-lg-4">
                            <input type="file" class="form-control" id="thumb" name="thumb">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="name">Short description</label>
                        <div class="col-lg-8">
                            <textarea cols="70" rows="5" name="description" id="description" style="width:100%;"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="name">Detail</label>
                        <div class="col-lg-10">
                            <textarea cols="70" rows="4" name="detail" id="detail" style="width:100%;"></textarea>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-lg-2 control-label" for="recommend">แนะนำ</label>
                        <div class="col-lg-8">
                            <label class="custom-control custom-checkbox checkbox-inline" for="recommend">
                                <input type="checkbox" value="yes" name="recommend" id="recommend" class="custom-control-input">
                                Yes
                            </label>
                        </div>
                    </div> -->
                    <!-- <div class="form-group">
                        <label class="col-lg-2 control-label" for="address">ที่อยู่</label>
                        <div class="col-lg-8">
                            <textarea cols="70" rows="4" name="address" id="address"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="email">อีเมล์</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="phone">เบอร์โทรศัพท์</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="website">เว็บไซต์</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="website" name="website">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="name">แผนที่ (Embed)</label>
                        <div class="col-lg-8">
                            <textarea cols="70" rows="4" name="map" id="map" style="width:100%;height:150px;"></textarea>
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
                        <label class="col-lg-2 control-label" for="text">Status</label>
                        <div class="col-lg-2">
                            <select class="form-control" name="is_status" id="is_status">
                                <option value="publish">publish</option>
                                <option value="draft">draft</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary" id="startUpload">Save</button>
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
    init.push(function() {
        $('#btn_back').click(function() {
            location.href = '<?php echo site_url('faq') ?>';
        });

        $("#form-validate").validate({
            ignore: 'input[type="hidden"]',
            rules: {
                title: "required",
                thumb: {
                    required: true,
                    accept: "image/*"
                },
            },
            submitHandler: function (form) {
                // if (confirm('คุณแน่ใจที่จะ publish บทความหรือไม่ ?'))
                form.submit();
            }
        });

        tinyInit('textarea#detail');
        //initMap('map');
    }); //End document ready functions

</script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/tinymce4/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/tinymce4/tiny_init.js"></script>