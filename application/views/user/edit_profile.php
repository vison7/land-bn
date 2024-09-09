<div class="page-header">
    <h1 class="text-bold">My Profile</h1>
</div> <!-- / .page-header -->

<?php if (!empty($_GET['str'])) { ?>
<div class="row">
    <div class="col-lg-4 col-lg-offset-2 alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Well done! </strong> <?php echo $_GET['str'] ?>
    </div>
    </div>
<?php } ?>

<form class="form-horizontal seperator" role="form" method="post" action="<?php echo site_url('user/update_profile') ?>">
    <div class="form-group">
        <label class="col-lg-2 control-label" for="username">Username:</label>
        <div class="col-lg-4">
            <input class="form-control" id="username" type="text" disabled="disabled" value="<?php echo $query[0]->username ?>" />
        </div>
    </div><!-- End .form-group  -->
    <div class="form-group">
        <label class="col-lg-2 control-label" for="username">Password:</label>
        <div class="col-lg-4">
            <input class="form-control" id="password" name="password" type="password" placeholder="Enter your password" value="<?php echo base64_decode($query[0]->password) ?>" />                
        </div>
    </div><!-- End .form-group  -->
    <div class="form-group">
        <label class="col-lg-2 control-label" for="username">Name:</label>
        <div class="col-lg-4">
            <input class="form-control" id="name" name="name" type="text" value="<?php echo $query[0]->name ?>" />
        </div>
    </div><!-- End .form-group  -->

    <div class="form-group">
        <label class="col-lg-2 control-label" for="username">Email:</label>
        <div class="col-lg-4">
            <input class="form-control" id="email" name="email" type="text" value="<?php echo $query[0]->email ?>" />
        </div>
    </div><!-- End .form-group  -->

    <div class="form-group">
        <div class="col-lg-4 col-lg-offset-2">
            <button type="submit" class="btn btn-info">Save changes</button>                
        </div>
    </div><!-- End .form-group  -->

</form>

