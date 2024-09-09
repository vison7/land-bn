<div class="page-header">
    <h1><i class="fa fa-list-alt page-header-icon"></i>&nbsp;&nbsp;วัดบันดาลใจ</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-heading">
                <span class="panel-title">Insert Data</span>
                <div class="panel-heading-controls">
                    <button class="btn btn-sm btn-primary btn-outline" onclick="location.href = '<?php echo site_url('templenew') ?>';"><span class="fa fa-chevron-left"></span>&nbsp;&nbsp;Back</button>
                </div>
            </div>

            <div class="panel-body">
                <form class="form-horizontal" id="form-validate" action="<?php echo site_url('templenew/add_data') ?>" role="form" method="post" enctype="multipart/form-data">

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
                            <label class="col-lg-2 control-label" for="required">ประเภท</label>
                            <div class="col-lg-3">
                                <select class="form-control" name="cate_id" id="cate_id">
                                    <option value="">--เลือก--</option>
                                    <?php foreach (TEMPLENEW_CATE as $key_cate => $val_cate) { ?>
                                        <option value="<?php echo $key_cate ?>"><?php echo $val_cate ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="required">ภาค</label>
                            <div class="col-lg-3">
                                <select class="form-control" name="region" id="region">
                                    <option value="">--เลือก--</option>
                                    <?php foreach (TEMPLENEW_REGION as $key_cate => $val_cate) { ?>
                                        <option value="<?php echo $key_cate ?>"><?php echo $val_cate ?></option>
                                    <?php } ?>
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
                            <textarea cols="70" rows="15" name="description" id="description" style="width:100%;"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">แท็ก</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="tags" name="tags">
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
                    </div>
                    
                    <div class="form-group">
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
                            <button type="button" class="btn btn-primary" id="startUpload">Save</button>
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
            location.href = '<?php echo site_url('templenew') ?>';
        });

        $('#event_date,#event_end_date').datepicker({
            format: 'yyyy-mm-dd'
        });

        tinyInit('textarea#detail');
        //initMap('map');
    }); //End document ready functions


    $(function() {
        var image_list = '';
        var image_obj = [];
        //Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("div#myDropzone", {
            url: "<?php echo site_url('templenew/upload') ?>",
            paramName: "file",
            autoProcessQueue: false,
            uploadMultiple: false, // uplaod files in a single request
            parallelUploads: 100,
            maxFilesize: 1, // MB
            maxFiles: 10,
            acceptedFiles: ".jpg, .jpeg, .png, .gif, .pdf",
            addRemoveLinks: true,
            // Language Strings
            dictFileTooBig: "File is to big ({{filesize}}mb). Max allowed file size is {{maxFilesize}}mb",
            dictInvalidFileType: "Invalid File Type",
            //dictCancelUpload: "Cancel",
            //dictRemoveFile: "Remove",
            dictMaxFilesExceeded: "Only {{maxFiles}} files are allowed",
            dictDefaultMessage: "Drop files here to upload",
            init: function() {
                console.log('init');
                this.on("maxfilesexceeded", function(file) {
                    alert("No more files please!");
                    this.removeFile(file);
                });
            }
        });

        myDropzone.on("addedfile", function(file) {
            //console.log('addedfile',file);
        });
        myDropzone.on("sending", function(file, xhr, formData) {
            // Will send the filesize along with the file as POST data.
            //formData.append("filesize", file.size);
            //console.log('sending',file);
        });
        myDropzone.on("error", function(file, response) {
            console.log('error', response);
        });
        myDropzone.on("success", function(file, xhr) {
            //console.log('success',file);
            if (xhr.code == 200) {
                image_obj.push(xhr.path);
            }

            console.log('success xhr', xhr);
        });
        myDropzone.on("queuecomplete", function() {
            // submit form
            if (marker != null)
                $("#lat").val(marker.getPosition().lat());
            if (marker != null)
                $("#lng").val(marker.getPosition().lng());

            $("#file_list").val(JSON.stringify(image_obj));
            console.log(image_obj);
            console.log('queuecomplete');
            $("#form-validate").submit();
        });

        $('#startUpload').click(function() {
            var fff = $("#form-validate");
            fff.validate({
                ignore: 'input[type="hidden"]',
                rules: {
                    title: "required",
                    thumb: {
                        required: true,
                        accept: "image/*"
                    }
                }
            });

            if (marker != null)
                $("#lat").val(marker.getPosition().lat());
            if (marker != null)
                $("#lng").val(marker.getPosition().lng());

            if (myDropzone.files != "") {
                if (fff.valid())
                    myDropzone.processQueue();
            } else {
                if (fff.valid())
                    $("#form-validate").submit();
            }
        });

    });
</script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/tinymce4/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/tinymce4/tiny_init.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/admin/javascripts/map.js"></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7S1Q7wmTxWzUddY2DcHM82SP14UMIoew" ></script> -->