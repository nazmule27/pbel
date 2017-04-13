<?php
$CI = &get_instance();
$role = $CI->session->userdata('role');
$username = $CI->session->userdata('username');
?>
<div class="col-md-3 col-sm-4 col-xs-12 print-none">
    <div class="nav-block">
        <div id="nav-container">
            <nav>
                <ul>
                    <li>
                        <a href="<?=base_url();?>c/Home"><i class="glyphicon glyphicon-home"></i> Home</a>
                    </li>
                    <li>
                        <a href="<?=base_url();?>c/Tutorial/index/1"><i class="glyphicon glyphicon-book"></i> Content</a>
                        <?php if(($role == 'Admin')){?>
                        <ul>
                            <li><a href="<?=base_url();?>c/Section/index"> Section</a></li>
                            <li><a href="<?=base_url();?>c/Sub_section/index"> Sub Section</a></li>
                            <li><a href="<?=base_url();?>c/Content/index"> Content</a></li>
                            <li><a href="<?=base_url();?>c/Content/add_mcq"> Add MCQ</a></li>
                        </ul>
                        <?php } ?>
                    </li>
                    <?php if(($role == 'Admin')){?>
                    <li>
                        <a href="<?=base_url();?>c/Problem_submit"><i class="glyphicon glyphicon-pencil"></i> Problem Submit</a>
                    </li>
                    <li>
                        <a href="<?=base_url();?>c/Problem_list"><i class=" glyphicon glyphicon-th-list"></i> Problem List</a>
                    </li>
                    <li>
                        <a href="<?=base_url();?>c/Test""><i class="glyphicon glyphicon-calendar"></i> Test Home</a>
                        <ul>
                            <li><a href="<?=base_url();?>c/Test/add_in_group"> Student Add in Group</a></li>
                            <li><a href="<?=base_url();?>c/Test/test_create"> Test/Group Create</a></li>
                            <li><a href="<?=base_url();?>c/Problem_set"> Problem Set</a></li>
                            <li><a href="<?=base_url();?>c/Contest_home"> Problem List</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?=base_url();?>c/Evaluation"><i class="glyphicon glyphicon-check"></i> Evaluation</a>
                    </li>
                    <li>
                        <a href="<?=base_url();?>c/Evaluation/export"><i class="glyphicon glyphicon-share-alt"></i> Export</a>
                    </li>
                    <?php } ?>
                    <?php if(($role == 'Student')){?>
                    <!--<li>
                        <a href="<?/*=base_url();*/?>c/Learning"><i class="glyphicon glyphicon-folder-open"></i> Problem Based Learning</a>
                    </li>-->
                    <li>
                        <a href="<?=base_url();?>c/Chapter_content"><i class="glyphicon glyphicon-folder-open"></i> Chapter Content</a>
                    </li>
                    <li>
                        <a href="<?=base_url();?>c/Test_subscribe"><i class="glyphicon glyphicon-calendar"></i> Test Subscribe</a>
                    </li>
                    <li>
                        <a href="<?=base_url();?>c/Give_test"><i class=" glyphicon glyphicon-pencil"></i> Give Test</a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="<?=base_url();?>c/Contact"><i class="glyphicon glyphicon-envelope"></i> Contact</a>
                    </li>
                </ul>
            </nav>
        </div>
        <!--nav end-->
    </div>
</div>
