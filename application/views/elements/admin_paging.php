<?php
// check record
if ($total_item > 0) {

    $tab = 10;

    // $allpages = ceil($total_item /$page_size); // total page
    // page tab
    if (($page_no % $tab) == 0) {
        $ptab = floor($page_no / $tab);
    } else {
        $ptab = floor($page_no / $tab) + 1;
    }
    ?>

    <div class="row">
        <div class="col-lg-6 col-md-6">
            <?php echo $page_no ?> of <?php echo $page_total ?> Pages ( <?php echo $total_item ?> entries ) 
        </div>

        <div class="col-lg-6 col-md-6 text-right">

            <ul class="pagination pagination-xs">
                <?php if ($page_no > 1) { ?>	
                <li><a href="?page_no=<?php echo ($page_no) - 1; ?><?php echo @$str_query ?>">&laquo;</a></li>
                <?php } ?>	

                <?php
                for ($i = ((($ptab * $tab) - $tab) + 1); $i <= ($tab * $ptab); $i++) {
                    if ($i <= $page_total) {
                        if ($i == $page_no) {
                            echo "<li class=\"active\"><a href=\"#\">{$i} <span class=\"sr-only\">(current)</span></a></li>";
                        } else {
                            echo "<li><a href=\"?page_no={$i}" . @$str_query . "\"> {$i} </a></li>";
                        }
                    }
                }
                ?>

                <?php if ($page_no < $page_total) { ?>	            
                <li><a href="?page_no=<?php echo ($page_no) + 1; ?><?php echo @$str_query ?>">&raquo;</a></li>
                <?php } ?>	
            </ul>

        </div>
    </div>
<?php } ?>