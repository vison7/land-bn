<div class="page-header">
    <h1><i class="fa fa-user page-header-icon"></i>&nbsp;&nbsp;ระบบจัดการผู้ใช้ระบบ</h1>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title">Edit Data</span>
    </div>
    <div class="panel-body">

        <form class="form-horizontal" id="form-validate" action="<?php echo site_url('user/edit_data') ?>" role="form" method='post'>
            <input type="hidden" name="id" value="<?php echo $query[0]->id ?>">
            <?php if (!empty($_GET['str'])) { ?>
                <div class="form-group">
                    <div class="col-lg-4 col-lg-offset-2">
                        <div class="alert alert-<?php echo @$_GET['code'] ?> alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Message : </strong> <?php echo $_GET['str'] ?>
                        </div>
                    </div>
                </div><!-- End .form-group  -->
            <?php } ?>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="username">Username</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" id="username" name="username" disabled="disabled" value="<?php echo $query[0]->username ?>">
                </div>
            </div><!-- End .form-group  -->

            <div class="form-group">
                <label class="col-lg-2 control-label" for="required">Password </label>
                <div class="col-lg-4">
                    <input class="form-control" id="password" name="password" type="password" value="<?php echo base64_decode($query[0]->password) ?>" />                            
                </div>
            </div><!-- End .form-group  -->
            <div class="form-group">
                <label class="col-lg-2 control-label" for="name">Name</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $query[0]->name ?>">
                </div>
            </div><!-- End .form-group  -->
            <div class="form-group">
                <label class="col-lg-2 control-label" for="required">Email</label>
                <div class="col-lg-4">
                    <input class="form-control" id="email" name="email" type="text" value="<?php echo $query[0]->email ?>" />
                </div>
            </div><!-- End .form-group  -->
            <div class="form-group">
                        <label class="col-lg-2 control-label" for="required">Temple</label>
                        <div class="col-lg-3">
                            <select class="form-control" name="temple_id" id="temple_id">
                                <option value="0">Main Site</option>
                                <?php foreach($temple as $row_t){?>
                                <option <?php if($query[0]->temple_id==$row_t->id){?>selected="selected"<?php }?> value="<?php echo $row_t->id?>"><?php echo $row_t->name?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div><!-- End .form-group  -->

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="required">Permission</label>
                        <div class="col-lg-3">
                            <select class="form-control" name="is_level" id="is_level">
                                <?php foreach($permission as $key=>$val){?>
                                <option <?php if($query[0]->is_level==$key){?>selected="selected"<?php }?> value="<?php echo $key?>"><?php echo $val?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div><!-- End .form-group  -->

            <div class="form-group">
                <label class="col-lg-2 control-label" for="text">Active</label>
                <div class="col-lg-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_status" value="active" class="px" <?php if ($query[0]->is_status == "active") { ?> checked="checked" <?php } ?>> <span class="lbl">Yes</span>
                        </label>
                    </div>
                </div>
            </div><!-- End .form-group  -->

            <div class="form-group">
                <div class="col-lg-4 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary" >Save</button>
                    <button type="button" class="btn btn-default" onclick="location.href = '<?php echo site_url('user') ?>';">Back</button>
                </div>
            </div><!-- End .form-group  -->     

        </form>
    </div>
</div><!-- End .panel -->

<script type="text/javascript">
    $(document).ready(function () {


        $("#form-validate").validate({
            ignore: 'input[type="hidden"]',
            rules: {
                name: "required",
                password: {
                    required: true,
                    minlength: 4
                },
                email: {
                    required: true,
                    email: true,
                    remote: "<?php echo site_url('user/check_email') ?>/<?php echo $query[0]->id ?>"
                                    },
                                    is_level: "required"
                                },
                                messages: {
                                    required: "Please enter a something",
                                    password: {
                                        required: "Please provide a password",
                                        minlength: "Your password must be at least 4 characters long"
                                    },
                                    email: {
                                        required: " ",
                                        email: "Please enter a valid email address, example: you@yourdomain.com",
                                        remote: "Email is already taken, please enter a different address."
                                    }
                                }
                            });
                        }); //End document ready functions


</script>