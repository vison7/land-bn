<?php
$page = array(
    'total_item' => $total_item,
    'page_size' => $page_size,
    'page_no' => $page_no,
    'page_total' => $page_total
);
?>
<div class="page-header">
    <h1><i class="fa fa-list-alt page-header-icon"></i>&nbsp;&nbsp;News & Event</h1>
</div>

<div class="panel colourable">
	<div class="panel-body">
    <form id="frm-search" name="frm-search" method="post">
        <div class="col-lg-3">
            <select class="form-control" name="temple_id" id="temple_id">
                <option value="">-เลือกวัด-</option>
                <option value="0">Main Site</option>
                <?php foreach($temple as $row_t){?>
                <option value="<?php echo $row_t->id?>"><?php echo $row_t->name?></option>
                <?php }?>
            </select>
        </div>
        <div class="col-lg-3">
            <input type="text" class="form-control" id="title" name="title" placeholder="หัวข้อ">
        </div>
        <div class="col-lg-2">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    </div>
</div>

<div class="panel">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <span class="panel-title">
            <div class="btn-group btn-group-sm">
                <button data-toggle="dropdown" type="button"
                        class="btn btn-info dropdown-toggle">
                    <span class="fa fa-cog"></span> Action <span
                        class="fa fa-caret-down"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="javascript:set_status('publish');">Publish</a></li>
                    <li><a href="javascript:set_status('draft');">Draft</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:data_delete();">Delete</a></li>
                </ul>
                <!-- / .dropdown-menu -->
            </div> <!-- / .btn-group -->
            <button type="button" class="btn btn-sm btn-primary"
                    onclick="location.href = '<?php echo site_url('content/add'); ?>';">
                <span class="fa fa-plus-circle"></span>&nbsp;Add
            </button>

            <?php if (isset($_REQUEST['str'])) { ?><span
                    class="label label-<?php echo @$_REQUEST['code'] ?>"><?php echo @$_REQUEST['str'] ?></span><?php } ?>
        </span>
    </div>

    <form id="frm" name="frm" method="post">
        <input type='hidden' id="id" name="id" value="">
        <!-- Table -->
        <table class="table table-bordered" style="margin-bottom:0">
            <thead>
                <tr>
                    <th><input type="checkbox" onclick="selectAll(this, 'idx')"></th>
                    <th>#</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($query as $row) {
                    $icon = '<a class="label label-danger">draft</a>';
                    if ($row->is_status == 'publish')
                        $icon = '<a class="label label-success">publish</a>';

                    $thumb = '';
                    if ($row->thumb != '') {
                        $thumb = '<img src="' . base_url() . $row->thumb . '"  border="0" class="img-responsive" />';
                    }
                    ?>
                    <tr>
                        <td><input type="checkbox" name="idx" id="idx" value="<?php echo $row->id ?>" /></td>
                        <td><?php echo $row->id ?></td>
                        <td style="width:40%"><?php echo $thumb ?><br>
                            <?php echo $row->title ?><br>
                           <small> วัด : <?php echo (!empty($row->temple_name)?$row->temple_name:'Main Site') ?></small>
                        </td>
                        <td><?php echo $row->created ?></td>
                        <td><?php echo $icon ?></td>
                        <td>
                            <button type="button" class="btn btn-xs btn-labeled btn-info"
                                    onclick="location.href = '<?php echo site_url('content/edit/' . $row->id) ?>';">
                                <span class="btn-label icon fa fa-edit"></span>Edit
                            </button>
                        </td>
                    </tr>
                <?php } ?>            
            </tbody>
        </table>
    </form>

    <div class="panel-footer">
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
            var action = '<?php echo site_url('content/set_status') ?>/' + status;
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
                var action = '<?php echo site_url('content/data_delete') ?>';
                // compute action here...
                $('#frm').attr('action', action);
                $('#frm').submit();
            }
        }
    }
</script>
