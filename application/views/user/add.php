<div class="page-header">
    <h1><i class="fa fa-user page-header-icon"></i>&nbsp;&nbsp;Users</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="panel-title">Insert Data</span>
            </div>
            <div class="panel-body">

                <form class="form-horizontal" id="form-validate" action="<?php echo site_url('user/add_data') ?>" role="form" method='post'>
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
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                    </div><!-- End .form-group  -->

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="required">Password </label>
                        <div class="col-lg-4">
                            <input class="form-control" id="password" name="password" type="password" placeholder="Enter your password" />                            
                        </div>
                    </div><!-- End .form-group  -->
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="name">Confirm password</label>
                        <div class="col-lg-4">
                            <input class="form-control" id="passwordConfirm" name="confirm_password" type="password" placeholder="Enter your password again" />
                        </div>
                    </div><!-- End .form-group  -->

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="name">Name</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div><!-- End .form-group  -->
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="required">Email</label>
                        <div class="col-lg-4">
                            <input class="form-control" id="email" name="email" type="text" />
                        </div>
                    </div><!-- End .form-group  -->
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="required">Permission</label>
                        <div class="col-lg-3">
                            <select class="form-control" name="is_level" id="is_level">
                                <?php foreach($permission as $key=>$val){?>
                                <option value="<?php echo $key?>"><?php echo $val?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div><!-- End .form-group  -->

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="text">Active</label>
                        <div class="col-lg-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" checked="checked" name="is_status" value="active" class="px"> <span class="lbl">Yes</span>
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
    </div><!-- End .span12 -->
</div><!-- End .row -->  

<script type="text/javascript">
    init.push(function () {

        $("#form-validate").validate({
            ignore: 'input[type="hidden"]',
            rules: {
                username: {
                    required: true,
                    remote: "<?php echo site_url('user/check_username') ?>"
                },
                name: "required",
                required1: {
                    required: true,
                    minlength: 4},
                password: {
                    required: true,
                    minlength: 4
                },
                confirm_password: {
                    required: true,
                    minlength: 4,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true,
                    remote: "<?php echo site_url('user/check_email') ?>"
                },
                is_level: "required"
            },
            messages: {
                required: "Please enter a something",
                username: "Username duplicate. please enter new user",
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 4 characters long"
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 4 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: {
                    required: "Please enter a valid email address",
                    email: "Please enter a valid email address, example: you@yourdomain.com",
                    remote: "Email is already taken, please enter a different address."
                }
            }
        });
    }); //End document ready functions
</script>