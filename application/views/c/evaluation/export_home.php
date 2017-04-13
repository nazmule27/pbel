<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Export Test List</h3>
    <hr>

    <?php for ($i = 0; $i < count($all_test); ++$i) { ?>
        <a class="btn btn-primary col-lg-12" href="<?=base_url();?>c/Evaluation/export_result/<?php echo $all_test[$i]->id;?>/<?php echo str_replace(' ', '_', $all_test[$i]->name);?>">Export XLS &raquo; <?php echo $all_test[$i]->name.' ('.$all_test[$i]->start_time.' to '.$all_test[$i]->end_time.')' ?></a><br><br>
    <?php } ?>

</div>

<?php
$this->load->view('c/common/footer');
?>
