<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Problem Levels</h3>
    <hr>
    <div class="problem-level">
        <a href="<?=base_url();?>c/Learning/level_wise_problem/1">Level 1</a>
        <a href="<?=base_url();?>c/Learning/level_wise_problem/2">Level 2</a>
        <a href="<?=base_url();?>c/Learning/level_wise_problem/3">Level 3</a>
        <a href="<?=base_url();?>c/Learning/level_wise_problem/4">Level 4</a>
        <a href="<?=base_url();?>c/Learning/level_wise_problem/5">Level 5</a>
        <a href="<?=base_url();?>c/Learning/all_problem">All Level</a>
    </div>

    <!--<div class="menu" style="float:left; margin-top: 30px">
        <ul id="tree">
            <li>
                <?php /*for ($i = 0; $i < count($parent); ++$i) { */?>
                    <a href="<?/*=base_url();*/?>Learning/single_view/<?php /*echo $parent[$i]->id;*/?>"><?php /*echo $parent[$i]->title;*/?></a>
                <?php /*} */?>
                <ul>
                    <li><a href="http://www.accessify.com/">Name print</a></li>
                    <li>
                        <a href="http://www.w3.org/">Sum calculation</a>
                        <ul>
                            <li><a href="http://validator.w3.org/">Hello World Print</a></li>
                            <li><a href="http://jigsaw.w3.org/css-validator/">Hello World Print 2</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>-->
    <!--<div style="margin-top:18px; float:right;">
        <button class="btn btn-block btn-success" onclick="TreeMenu.show_all(document.getElementById('tree'))"> <i class="glyphicon glyphicon-plus"></i> Show All</button><br />
        <button class="btn btn-block btn-info" onclick="TreeMenu.hide_all(document.getElementById('tree'))"> <i class="glyphicon glyphicon-minus"></i> Hide All</button><br />
        <button class="btn btn-default" onclick="TreeMenu.reset(document.getElementById('tree'));location.reload();"> <i class="glyphicon glyphicon-flash"></i> Reset</button><br />
    </div>-->

</div>

<?php
$this->load->view('c/common/footer');
?>
<script type="text/javascript">make_tree_menu('tree');</script>
