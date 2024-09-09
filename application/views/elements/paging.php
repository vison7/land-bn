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


    <div class="pagenation">

        <a class="first" href="?page_no=1<?php echo @$str_query ?>">&lt;&lt;</a>



        <a href="?page_no=<?php echo ($page_no) - 1; ?><?php echo @$str_query ?>">&lt;</a>

        <?php
        for ($i = ((($ptab * $tab) - $tab) + 1); $i <= ($tab * $ptab); $i++) {
            if ($i <= $page_total) {
                if ($i == $page_no) {
                    echo "<a class=\"active\" href=\"#\">{$i} </a>";
                } else {
                    echo "<a href=\"?page_no={$i}" . @$str_query . "\"> {$i} </a>";
                }
            }
        }
        ?>


        <a href="?page_no=<?php echo ($page_no) + 1; ?><?php echo @$str_query ?>">&gt;</a>

        <a href="?page_no=<?php echo $page_total ?><?php echo @$str_query ?>">&gt;&gt;</a>

    </div>


    <?php
}?>