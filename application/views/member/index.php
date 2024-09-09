<?php
$page = array('total_item' => $total_item, 'page_size' => $page_size, 'page_no' => $page_no, 'page_total' => $page_total);
?>
<div class="page-header">
    <h1><i class="fa fa-user page-header-icon"></i>&nbsp;&nbsp;ระบบจัดการสมาชิก</h1>
</div>


<div class="panel colourable">
	<div class="panel-body">
    <form id="frm-search" name="frm-search" method="post">
        <div class="col-lg-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
        </div>
        <div class="col-lg-3">
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname">
        </div>
        <div class="col-lg-2">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    </div>
</div>

<form id="frm" name="frm" method="post">
    <input type='hidden' id="id" name="id" value="">
    <div class="panel">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <span class="panel-title">

                <div class="btn-group btn-group-sm">
                    <button data-toggle="dropdown" type="button" class="btn btn-info dropdown-toggle"><span class="fa fa-cog"></span> Action <span class="fa fa-caret-down"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:set_status('active');">Active</a></li>
                        <li><a href="javascript:set_status('inactive');">Inactive</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:data_delete();">Delete</a></li>
                    </ul> <!-- / .dropdown-menu -->
                </div> <!-- / .btn-group -->

                <?php if (isset($_REQUEST['str'])) { ?><span class="label label-<?php echo @$_REQUEST['code'] ?>"><?php echo @$_REQUEST['str'] ?></span><?php } ?>
            </span>
        </div>

        <!-- Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><input type="checkbox" onclick="selectAll(this, 'idx')"></th>
                    <th>#</th>
                    <th>UserName</th>
                    <th>Name / Email</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($query as $row) {
                    $icon = '<a class="label label-danger">Inactive</a>';
                    if ($row->is_status == 'active')
                        $icon = '<a class="label label-success">Active</a>';
                    ?>
                    <tr>
                        <td><input type="checkbox" name="idx" id="idx" value="<?php echo $row->id ?>"  /></td>
                        <td><?php echo $row->id ?></td>
                        <td><?php echo $row->username ?></td>
                        <td><?php echo $row->firstname .' '. $row->lastname .'<br>'.$row->email ?></td>
                        <td><?php echo $row->created ?></td>
                        <td><?php echo $icon ?></td>
                        <td>
                            <button type="button" class="btn btn-xs btn-labeled btn-info" onclick="location.href = '<?php echo site_url('member/edit/' . $row->id) ?>';"><span class="btn-label icon fa fa-edit"></span>Edit</button>
                        </td>
                    </tr>
                <?php } ?>            

            </tbody>
        </table>

        <div class="panel-footer">
            <?php $this->load->view("elements/admin_paging", $page) ?>
        </div>
    </div>

</form>

<script type="text/javascript">

    function set_status(status) {
        var chkId = '';
        $('#idx:checked').each(function () {
            chkId += $(this).val() + ",";
        });
        chkId = chkId.slice(0, -1);// Remove last comma 

        if (chkId != '') {

            $('#frm #id').val(chkId);
            var action = '<?php echo site_url('member/set_status') ?>/' + status;
            // compute action here...
            $('#frm').attr('action', action);
            $('#frm').submit();

        }
    }

    function data_delete() {
        var chkId = '';
        $('#idx:checked').each(function () {
            chkId += $(this).val() + ",";
        });
        chkId = chkId.slice(0, -1);// Remove last comma 

        if (chkId != '') {
            if (confirm('What do you want to delete?')) {
                $('#frm #id').val(chkId);
                var action = '<?php echo site_url('member/data_delete') ?>';
                // compute action here...
                $('#frm').attr('action', action);
                $('#frm').submit();
            }
        }
    }

</script> 