<?php
$CI = &get_instance();
$role = $CI->session->userdata('role');
$username = $CI->session->userdata('username');
?>
<div class="col-md-3 col-sm-4 col-xs-12">
    <!--<div class="menu" style="float:left; overflow: scroll">
        <ul id="tree">
            <li>
                <a href="#">Root</a>
                <ul>
                    <li><a href="#">Name print</a></li>
                    <li>
                        <a href="#">Loop</a>
                        <ul>
                            <li><a href="#">Hello World Print</a></li>
                            <li><a href="http://jigsaw.w3.org/css-validator/">Hello World Print 2</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>-->
    <ul class="nav nav-stacked" id="accordion1">
        <li class="panel"> <a data-toggle="collapse" data-parent="#accordion1" href="#firstLink">Information and Communication Technology: World and Bangladesh Perspective</a>
            <ul id="firstLink" class="collapse">
                <?php for ($i = 0; $i < count($content1); ++$i) { ?>
                    <li type="button" title="<?php echo $content1[$i]->id;?>" class="menu_id"><?php echo $content1[$i]->sub_title;?></li>
                <?php } ?>
            </ul>
        </li>
        <li class="panel"> <a data-toggle="collapse" data-parent="#accordion1" href="#secondLink">Communication Systems and Networking</a>
            <ul id="secondLink" class="collapse">
                <?php for ($i = 0; $i < count($content2); ++$i) { ?>
                    <li type="button" title="<?php echo $content2[$i]->id;?>" class="menu_id"><?php echo $content2[$i]->sub_title;?></li>
                <?php } ?>
            </ul>
        </li>
        <li class="panel"> <a data-toggle="collapse" data-parent="#accordion1" href="#thirdLink">Number Systems and Digital Devices</a>
            <ul id="thirdLink" class="collapse">
                <li>SubTest2</li>
                <li>SubTest2</li>
            </ul>
        </li>
        <li class="panel"> <a data-toggle="collapse" data-parent="#accordion1" href="#fourthLink">Introduction to Web Design and HTML</a>
            <ul id="fourthLink" class="collapse">
                <li>SubTest2</li>
                <li>SubTest2</li>
            </ul>
        </li>
        <li class="panel"> <a data-toggle="collapse" data-parent="#accordion1" href="#fifthLink">Programming Language</a>
            <ul id="fifthLink" class="collapse in" aria-expanded="true">
                <?php for ($i = 0; $i < count($content5); ++$i) { ?>
                    <li type="button" title="<?php echo $content5[$i]->id;?>" class="menu_id"><?php echo $content5[$i]->sub_title;?></li>
                    <!--<a id="menu_id" href="<?/*=base_url();*/?>Tutorial/Content_load/<?php /*echo $content[$i]->id;*/?>"><?php /*echo $content[$i]->sub_title;*/?></a><br>-->
                <?php } ?>
            </ul>

        </li>
        <li class="panel"> <a data-toggle="collapse" data-parent="#accordion1" href="#sixthLink">Database Management System</a>
            <ul id="sixthLink" class="collapse">
                <li>SubTest2</li>
                <li>SubTest2</li>
            </ul>
        </li>
    </ul>

    <?php /*for ($i = 0; $i < count($content); ++$i) { */?><!--
        <button type="button" title="<?php /*echo $content[$i]->id;*/?>" class="menu_id"><?php /*echo $content[$i]->sub_title;*/?></button><br>
    --><?php /*} */?>




</div>
<!--<script type="text/javascript">
    var acc = document.getElementsByClassName("accordion");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function(){
            this.classList.toggle("active");
            this.nextElementSibling.classList.toggle("show");
        }
    }
</script-->