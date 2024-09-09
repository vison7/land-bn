<div class="page-header">
    <h1><i class="fa fa-user page-header-icon"></i>&nbsp;&nbsp;ระบบจัดการสมาชิก</h1>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title">Edit Data</span>
    </div>
    <div class="panel-body">

        <form class="form-horizontal" id="form-validate" action="<?php echo site_url('member/edit_data') ?>" role="form" method='post'>
            <input type="hidden" name="id" value="<?php echo $query[0]->id ?>">
            <?php if (!empty($_GET['str'])) {?>
                <div class="form-group">
                    <div class="col-lg-4 col-lg-offset-2">
                        <div class="alert alert-<?php echo @$_GET['code'] ?> alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Message : </strong> <?php echo $_GET['str'] ?>
                        </div>
                    </div>
                </div><!-- End .form-group  -->
            <?php }?>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="username">Username</label>
                <div class="col-lg-4">
                    <h4><?php echo $query[0]->username ?></h4>
                </div>
            </div><!-- End .form-group  -->

            <div class="form-group">
                <label class="col-lg-2 control-label" for="name">ชื่อ</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $query[0]->firstname ?>">
                </div>
            </div><!-- End .form-group  -->
            <div class="form-group">
                <label class="col-lg-2 control-label" for="name">นามสกุล</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $query[0]->lastname ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="required">Email</label>
                <div class="col-lg-4">
                    <input class="form-control" id="email" name="email" type="text" value="<?php echo $query[0]->email ?>" />
                </div>
            </div><!-- End .form-group  -->
            
            <div class="form-group">
                <label class="col-lg-2 control-label" for="text">Active</label>
                <div class="col-lg-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_status" value="active" class="px" <?php if ($query[0]->is_status == "active") {?> checked="checked" <?php }?>> <span class="lbl">Yes</span>
                        </label>
                    </div>
                </div>
            </div><!-- End .form-group  -->

            <div class="form-group">
                <div class="col-lg-4 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary" >Save</button>
                    <button type="button" class="btn btn-default" onclick="location.href = '<?php echo site_url('member') ?>';">Back</button>
                </div>
            </div><!-- End .form-group  -->

        </form>
    </div>
</div><!-- End .panel -->

<script type="text/javascript">
$(document).ready(function () {
        
}); //End document ready functions

</script>