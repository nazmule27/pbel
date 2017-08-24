<?php
$CI = &get_instance();
$role = $CI->session->userdata('role');
$username = $CI->session->userdata('username');
?>
<div class="col-md-3 col-sm-4 col-xs-12">
    <h3>Contents</h3>

    <div class="list-group">
        <?php for ($i = 0; $i < count($chapter_content); ++$i) { ?>
            <a <?php if($this->uri->segment(4)==$chapter_content[$i]->id){echo 'class="list-group-item active-con"';}?> href="<?=base_url();?>c/Chapter_content/chapter_wise_problems/<?php echo $chapter_content[$i]->id;?>" title="<?php echo $chapter_content[$i]->title;?>" class="list-group-item"><?php echo $chapter_content[$i]->title;?></a>
        <?php } ?>
    </div>
</div>
