<?php
$page = array(
    'total_item' => $total_item,
    'page_size' => $page_size,
    'page_no' => $page_no,
    'page_total' => $page_total
);

//$no = ($total_item - $page_size);
if($page_no ==1 ){
    $no = $total_item;
    
}else{
    $no = $total_item - ($page_size * ($page_no - 1));
}
?>
<div class="page-header">
    <h1><i class="fa fa-list-alt page-header-icon"></i>&nbsp;&nbsp;สมัครข่าวสารโครงการ</h1>
</div>

<div class="panel colourable">
	<div class="panel-body">
    <form id="frm-search" name="frm-search" method="post">

        <div class="col-lg-3">
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="ชื่อ">
        </div>
        <div class="col-lg-2">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    </div>
</div>

<div class="panel">
    <!-- Default panel contents -->
    <?php if(get_admin_login()->is_level!='4'){?>
    <div class="panel-heading">
        <span class="panel-title">
            
            <button type="button" class="btn btn-sm btn-primary"
                    onclick="location.href = '<?php echo site_url('volunteersub/export'); ?>';">
                <span class="fa fa-plus-circle"></span>&nbsp;Export
            </button>
        </span>
    </div>
    <?php }?>

    <form id="frm" name="frm" method="post">
        <input type='hidden' id="id" name="id" value="">
        <!-- Table -->
        <table class="table table-bordered" style="margin-bottom:0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ชื่อ</th>
                    <th>อีเมล์</th>
                    <th>โทรศัพท์</th>
                    <th>วันที่สมัคร</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($query as $row) {
                    $val_r1 = '<ul>';
                    if(isset($row->reg1) && !empty($row->reg1)){
                        $r1 = json_decode($row->reg1,true);
                        foreach(REGISTER_WAT_3 as $key=>$value){
                            if (in_array($key, $r1)) {
                                if($val_r1 != '')
                                    $val_r1 .= "<li>". REGISTER_WAT_3[$key] ."</li>";
                                else
                                $val_r1 .=  REGISTER_WAT_3[$key];
                            }
                        }
                    }
                    $val_r1 .= '</ul>';
                    

                    ?>
                    <tr>
                        <td><?php echo ($no--) ?></td>
                        <td><?php echo $row->firstname .' '. $row->lastname ?></td>
                        <td><?php echo $row->email ?></td>
                        <td><?php echo $row->phone ?></td>
                        <td><?php echo $row->created ?></td>
                        <td>
                        <button type="button" class="btn btn-xs btn-labeled btn-info"
                                    onclick="show_info('<?php echo $row->id ?>');">
                                <span class="btn-label icon fa fa-edit"></span>
                                View
                            </button>

                            <div style="display:none;" id="info-<?php echo $row->id ?>">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>ชื่อ :</td>
                                        <td><?php echo $row->firstname .' '. $row->lastname ?></td>
                                    </tr>
                                    <tr>
                                        <td>อีเมล์ :</td>
                                        <td><?php echo $row->email?></td>
                                    </tr>
                                    <tr>
                                        <td>โทรศัพท์ :</td>
                                        <td><?php echo $row->phone ?></td>
                                    </tr>
                                    <tr>
                                        <td>วันเกิด :</td>
                                        <td><?php echo $row->date_of_birth ?></td>
                                    </tr>
                                    <tr>
                                        <td>เพศ :</td>
                                        <td><?php echo $row->gender ?></td>
                                    </tr>
                                    <tr>
                                        <td>ที่อยู่ :</td>
                                        <td><?php echo $row->no .' '. $row->road .' '. $row->sub_district .' '. $row->district .' '. $row->province .' '. $row->postcode  ?></td>
                                    </tr>
                                    <tr>
                                        <td>อาชีพ :</td>
                                        <td><?php echo $row->career ?></td>
                                    </tr>
                                    <tr>
                                        <td>เว็บไซต์ :</td>
                                        <td><?php echo $row->website ?></td>
                                    </tr>
                                    <tr>
                                        <td>รูปแบบการรับข่าวสาร :</td>
                                        <td><?php echo $val_r1  ?></td>
                                    </tr>
                                    
                                </table>

                            </div>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modal-info">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">รายละเอียด</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
    function show_info(id){
        $('#modal-info').modal();
        $('.modal-body').html($('#info-'+id).html());
    }

    function set_status(status) {
        var chkId = '';
        $('#idx:checked').each(function () {
            chkId += $(this).val() + ",";
        });
        chkId = chkId.slice(0, -1);// Remove last comma 

        if (chkId != '') {
            $('#frm #id').val(chkId);
            var action = '<?php echo site_url('activity/set_status') ?>/' + status;
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
                var action = '<?php echo site_url('activity/data_delete') ?>';
                // compute action here...
                $('#frm').attr('action', action);
                $('#frm').submit();
            }
        }
    }
</script>
