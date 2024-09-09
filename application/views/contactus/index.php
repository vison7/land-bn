<?php
$page = array(
    'total_item' => $total_item,
    'page_size' => $page_size,
    'page_no' => $page_no,
    'page_total' => $page_total
);
?>
<div class="page-header">
    <h1><i class="fa fa-list-alt page-header-icon"></i>&nbsp;&nbsp;ติดต่อเรา</h1>
</div>

<div class="panel colourable">
	<div class="panel-body">
    <form id="frm-search" name="frm-search" method="post">
    <?php if(admin_get_temple()==''){?>
        <div class="col-lg-3">
            <select class="form-control" name="temple_id" id="temple_id">
                <option value="">-เลือกวัด-</option>
                <option value="0">Main Site</option>
                <?php foreach($temple as $row_t){?>
                <option value="<?php echo $row_t->id?>"><?php echo $row_t->name?></option>
                <?php }?>
            </select>
        </div>
        <?php }?>
        <div class="col-lg-3">
            <input type="text" class="form-control" id="title" name="title" placeholder="หัวข้อ">
        </div>
        <div class="col-lg-2">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    </div>
</div>


<div class="panel no-border-l no-border-r">
    <!-- Default panel contents -->
    <?php if(get_admin_login()->is_level!='4'){?>
    <div class="panel-heading bordered">
        <span class="panel-title">
            <div class="btn-group btn-group-sm">
                <button data-toggle="dropdown" type="button"
                        class="btn btn-info dropdown-toggle">
                    <span class="fa fa-cog"></span> Action <span
                        class="fa fa-caret-down"></span>
                </button>
                <ul class="dropdown-menu">
                    
                    <li><a href="javascript:data_delete();">Delete</a></li>
                </ul>
                <!-- / .dropdown-menu -->
            </div> <!-- / .btn-group -->
            <button type="button" class="btn btn-sm btn-primary"
                    onclick="location.href = '<?php echo site_url('contactus/export'); ?>?temple_id=<?php echo $temple_id?>&title=<?php echo $title?>';">
                <span class="fa fa-plus-circle"></span>&nbsp;Export
            </button>

            <?php if (isset($_REQUEST['str'])) { ?><span
                    class="label label-<?php echo @$_REQUEST['code'] ?>"><?php echo @$_REQUEST['str'] ?></span><?php } ?>
        </span>
    </div>
    <?php }?>

    <form id="frm" name="frm" method="post">
        <input type='hidden' id="id" name="id" value="">
        <!-- Table -->
        <table class="table table-bordered no-border-vr">
            <thead>
                <tr>
                    <th><input type="checkbox" onclick="selectAll(this, 'idx')"></th>
                    <th>#</th>
                    <th>Title</th>
                    <th>Detail</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($query as $row) {
                    
                    ?>
                    <tr>
                        <td><input type="checkbox" name="idx" id="idx"
                                   value="<?php echo $row->id ?>" /></td>
                        <td><?php echo $row->id ?></td>
                        <td style="width: 40%; ">
                            <?php echo $row->title ?><br><br>
                            Name : <?php echo $row->name ?><br>
                            Email : <?php echo $row->email ?><br>
                            Phone : <?php echo $row->phone ?>
                            <br><br>
                            <span class="label label-default"><?php echo (!empty($row->temple_name)?$row->temple_name:'Main Site') ?></span>
                        </td>
                        <td><?php echo $row->detail ?></td>
                        <td><?php echo $row->created ?></td>
                        
                    </tr>
                <?php } ?>            
            </tbody>
        </table>
    </form>

    <div class="table-footer ">
        <?php $this->load->view("elements/admin_paging", $page) ?>
    </div>
</div>

<script type="text/javascript">
    function set_status(status) {
        var chkId = '';
        $('#idx:checked').each(function () {
            chkId += $(this).val() + ",";
        });
        chkId = chkId.slice(0, -1);// Remove last comma 

        if (chkId != '') {
            $('#frm #id').val(chkId);
            var action = '<?php echo site_url('contactus/set_status') ?>/' + status;
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
                var action = '<?php echo site_url('contactus/data_delete') ?>';
                // compute action here...
                $('#frm').attr('action', action);
                $('#frm').submit();
            }
        }
    }
</script>