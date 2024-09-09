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
    <h1><i class="fa fa-list-alt page-header-icon"></i>&nbsp;&nbsp;วัดนำร่อง</h1>
</div>

<div class="panel colourable">
	<div class="panel-body">
    <form id="frm-search" name="frm-search" method="post">

        <div class="col-lg-3">
            <input type="text" class="form-control" id="temple_name" name="temple_name" placeholder="ชื่อวัด">
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
                    onclick="location.href = '<?php echo site_url('volunteerwat/export'); ?>';">
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
                    <th>ชื่อวัด</th>
                    <th>นามเจ้าอาวาส</th>
                    <th>หมายเลขโทรศัพท์วัด</th>
                    <th>วันที่สมัคร</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($query as $row) {
                    $val_r1 = '';
                    if(isset($row->reg1) && !empty($row->reg1)){
                        $r1 = json_decode($row->reg1,true);
                        foreach(REGISTER_WAT_1 as $key=>$value){
                            if (in_array($key, $r1)) {
                                if($val_r1 != '')
                                    $val_r1 .= "<br>". REGISTER_WAT_1[$key];
                                else
                                $val_r1 .=  REGISTER_WAT_1[$key];
                            }
                        }
                    }
                    $val_r2 = '';
                    if(isset($row->reg2) && !empty($row->reg2)){
                        $r1 = json_decode($row->reg2,true);
                        foreach(REGISTER_WAT_2 as $key=>$value){
                            if (in_array($key, $r1)) {
                                if($val_r2 != '')
                                    $val_r2 .= "<br>". REGISTER_WAT_2[$key];
                                else
                                $val_r2 .=  REGISTER_WAT_2[$key];
                            }
                        }
                    }
        
                    $val_r3 = '';
                    if(isset($row->reg3) && !empty($row->reg3)){
                        $r1 = json_decode($row->reg3,true);
                        foreach(REGISTER_WAT_3 as $key=>$value){
                            if (in_array($key, $r1)) {
                                if($val_r3 != '')
                                    $val_r3 .= "<br>". REGISTER_WAT_3[$key];
                                else
                                $val_r3 .=  REGISTER_WAT_3[$key];
                            }
                        }
                    }
        
                    $val_r4 = '';
                    if(isset($row->reg4) && !empty($row->reg4)){
                        $r1 = json_decode($row->reg4,true);
                        foreach(REGISTER4 as $key=>$value){
                            if (in_array($key, $r1)) {
                                if($val_r4 != '')
                                    $val_r4 .= "<br>". REGISTER4[$key];
                                else
                                $val_r4 .=  REGISTER4[$key];
                            }
                        }
                    }

                    ?>
                    <tr>
                        <td><?php echo ($no--) ?></td>
                        <td><?php echo $row->temple_name ?></td>
                        <td><?php echo $row->contact_name ?></td>
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
                                        <td>ชื่อวัด :</td>
                                        <td><?php echo $row->temple_name ?></td>
                                    </tr>
                                    <tr>
                                        <td>ประเภท / ชั้น :</td>
                                        <td><?php echo $row->temple_type ?></td>
                                    </tr>
                                    <tr>
                                        <td>ที่อยู่ :</td>
                                        <td><?php echo $row->no .' '. $row->road .' '. $row->sub_district .' '. $row->district .' '. $row->province .' '. $row->postcode  ?></td>
                                    </tr>

                                    <tr>
                                        <td>หมายเลขโทรศัพท์วัด :</td>
                                        <td><?php echo $row->phone ?></td>
                                    </tr>
                                    <tr>
                                        <td>เบอร์มือถือ :</td>
                                        <td><?php echo $row->mobile ?></td>
                                    </tr>
                                    <tr>
                                        <td>อีเมล์ :</td>
                                        <td><?php echo $row->email?></td>
                                    </tr>
                                    
                                    
                                   
                                    <tr>
                                        <td>พื้นที่วัด :</td>
                                        <td><?php echo $row->area1 ?> ไร่ <?php echo $row->area2 ?> งาน <?php echo $row->area3 ?> ตารางวา</td>
                                    </tr>
                                    <tr>
                                        <td>บุคลากร :</td>
                                        <td>พระสงฆ์ <?php echo $row->total_monk ?>  รูป, สามเณร <?php echo $row->total_little_monk ?> รูป</td>
                                    </tr>
                                    <tr>
                                        <td>ข้อมูลการติดต่อ :</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>นามเจ้าอาวาส :</td>
                                        <td><?php echo $row->contact_name  ?></td>
                                    </tr>
                                    <tr>
                                        <td>ตำแหน่งอื่นๆ :</td>
                                        <td><?php echo $row->contact_position  ?></td>
                                    </tr>
                                    <tr>
                                        <td>ชื่อ-นามสกุล ผู้ประสานงานหลักของวัด :</td>
                                        <td><?php echo $row->contact_name_main  ?></td>
                                    </tr>
                                    <tr>
                                        <td>มือถือ :</td>
                                        <td><?php echo $row->contact_mobile  ?></td>
                                    </tr>
                                    <tr>
                                        <td>อีเมล์ :</td>
                                        <td><?php echo $row->contact_email  ?></td>
                                    </tr>
                                    <tr>
                                        <td>ข้อมูลวัดโบราณสถาน :</td>
                                        <td><?php 
                                        if(isset($row->register_wat) && !empty($row->register_wat)){
                                            $dd = json_decode($row->register_wat);  
                                            //print_r($dd);
                                            if(isset($dd[0])){
                                                if($dd[0]=='1')
                                                    echo 'ขึ้นโบราณสถาน';
                                                if($dd[0]=='2')
                                                    echo 'ขึ้นทะเบียนโบราณวัตถุ / ศิลปะวัตถุ';
                                            }
                                            if(isset($dd[1])){
                                                if($dd[1]=='1')
                                                    echo ',ขึ้นโบราณสถาน';
                                                if($dd[1]=='2')
                                                    echo ',ขึ้นทะเบียนโบราณวัตถุ / ศิลปะวัตถุ';
                                            }
                                        }
                                        ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <td>บทบาทของวัดที่โดนเด่น :</td>
                                        <td>
                                        <ul>
                                        <?php
                                        if(!empty($row->reg1)){
                                            $d = json_decode($row->reg1 , true);
                                            //print_r($d);
                                            foreach(REGISTER_WAT_1 as $key=>$item){
                                                if(in_array($key,$d))
                                                    echo '<li>'.$item.'</li>';
                                            }
                                        }
                                        ?>
                                        </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ประเด็นการเรียนรู้ที่ท่านสนใจ :</td>
                                        <td>
                                        <ul>
                                        <?php
                                        if(!empty($row->reg2)){
                                            $d = json_decode($row->reg2 , true);
                                            //print_r($d);
                                            foreach(REGISTER_WAT_2 as $key=>$item){
                                                if(in_array($key,$d))
                                                    echo '<li>'.$item.'</li>';
                                            }
                                        }
                                        ?>
                                        </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>รูปแบบการรับข่าวสาร :</td>
                                        <td>
                                        <ul>
                                        <?php
                                        if(!empty($row->reg3)){
                                            $d = json_decode($row->reg3 , true);
                                            //print_r($d);
                                            foreach(REGISTER_WAT_3 as $key=>$item){
                                                if(in_array($key,$d))
                                                    echo '<li>'.$item.'</li>';
                                            }
                                        }
                                        ?>
                                        </ul>
                                        </td>
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
