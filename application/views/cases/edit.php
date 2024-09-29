<div class="page-header">
    <h1><i class="fa fa-list-alt page-header-icon"></i>&nbsp;&nbsp;CASES</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="panel-title">Edit Data</span>
                <div class="panel-heading-controls">
                    <button class="btn btn-sm btn-primary btn-outline" onclick="location.href = '<?php echo site_url('cases') ?>';"><span class="fa fa-chevron-left"></span>&nbsp;&nbsp;Back</button>
                </div>
            </div>
            <div class="panel-body">
               

                <form class="form-horizontal" id="form-validate" action="<?php echo site_url('cases/edit_data') ?>" role="form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $query[0]->id ?>">
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
                        <!-- End .form-group  -->
                    <?php } ?>

                   
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="required">Country</label>
                            <div class="col-lg-3">
                                <select class="form-control" name="cate_id" id="cate_id">
                                    <option value="">--Country--</option>
                                    <?php foreach (COUNTRY_CATE as $key_cate => $val_cate) { ?>
                                        <option <?php if ($query[0]->cate_id == $key_cate) { ?>selected="selected" <?php } ?> value="<?php echo $key_cate ?>"><?php echo $val_cate ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">Name of the Project </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $query[0]->title ?>">
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
                        <label class="col-lg-2 control-label" for="required">Thumbnail </label>
                        <div class="col-lg-4">
                            <input type="file" class="form-control" id="thumb" name="thumb">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">Project Location </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="location" name="location" value="<?php echo $query[0]->location ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="event_date">Date </label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" id="event_date" name="event_date" value="<?php echo $query[0]->event_date ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="title">Parties involved</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="parties_involved" name="parties_involved" value="<?php echo $query[0]->parties_involved ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="the_area">The area </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="the_area" name="the_area" value="<?php echo $query[0]->the_area ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="how_much_money">How much Money</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="how_much_money" name="how_much_money" value="<?php echo $query[0]->how_much_money ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="legal_status">Legal status</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="legal_status" name="legal_status" value="<?php echo $query[0]->legal_status ?>">
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="corruption">Allegation of Corruption</label>
                        <div class="col-lg-8">
                            <textarea cols="70" rows="15" name="corruption" id="corruption" style="width:100%;"><?php echo $query[0]->corruption ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="impacts">Impacts to Communities and Actions</label>
                        <div class="col-lg-8">
                            <textarea cols="70" rows="15" name="impacts" id="impacts" style="width:100%;"><?php echo $query[0]->impacts ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="lessons_learn">Lessons Learn</label>
                        <div class="col-lg-8">
                            <textarea cols="70" rows="15" name="lessons_learn" id="lessons_learn" style="width:100%;"><?php echo $query[0]->lessons_learn ?></textarea>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="contact_name">Contact Name </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="contact_name" name="contact_name" value="<?php echo $query[0]->contact_name ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="contact_email">Contact Email</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="contact_email" name="contact_email" value="<?php echo $query[0]->contact_email ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="contact_org">Contact Organization </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="contact_org" name="contact_org" value="<?php echo $query[0]->contact_org ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label" ></label>
                        <div class="col-lg-8">
                            <div id="image_list_edit" style="width:100%;height:350px;border: 1px dashed #ccc;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" >Gallery</label>
                        <div class="col-lg-8">
                            <div id="myDropzone" class="my_dropzone">
                                <div class="dz-default dz-message">
                                    <div class="dz-upload-icon"></div>
                                    Drop files in here<br>
                                    <span class="dz-text-small">or click to pick manually
                                        <br>(Max 12 Images)
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="is_status">Status</label>
                        <div class="col-lg-2">
                            <select class="form-control" name="is_status" id="is_status">
                                <option value="publish" <?php if ($query[0]->is_status == "inprogress") { ?> selected="selected" <?php } ?>>inprogress</option>
                                <option value="review" <?php if ($query[0]->is_status == "review") { ?> selected="selected" <?php } ?>>review</option>
                                <option value="approved" <?php if ($query[0]->is_status == "approved") { ?> selected="selected" <?php } ?>>approved</option>
                                <option value="reject" <?php if ($query[0]->is_status == "reject") { ?> selected="selected" <?php } ?>>reject</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4 col-lg-offset-2">
                            <?php if (get_admin_login()->is_level != '4') { ?>
                                <button type="button" class="btn btn-primary" id="startUpload">Save</button>
                            <?php } ?>
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
            location.href = '<?php echo site_url('cases') ?>';
        });

        $('#event_date,#event_end_date').datepicker({
            format: 'yyyy-mm-dd'
        });
        tinyInit('textarea#detail');
        list_image();


    }); //End document ready functions

    function list_image() {

        $.get("<?php echo site_url('cases/list_file/' . $query[0]->id) ?>", function(data) {
            $("#image_list_edit").html(data);
        });
    }

    function delete_file(id, path) {
        if (confirm('Do you want to delete?')) {
            $.ajax({
                method: "POST",
                url: "<?php echo site_url('cases/delete_file/' . $query[0]->id) ?>",
                data: {
                    pos: id
                }
            }).done(function(msg) {
                // alert("Data Saved: " + msg);
                list_image();
            });
        }
    }


    $(function() {
        var image_list = '';
        var image_obj = [];
        //Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("div#myDropzone", {
            url: "<?php echo site_url('cases/upload') ?>",
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
            dictCancelUpload: "Cancel",
            dictRemoveFile: "Remove",
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
                    title: "required"
                }
            });


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