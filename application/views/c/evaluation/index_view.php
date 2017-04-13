<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Test List</h3>
    <hr>

    <?php for ($i = 0; $i < count($all_test); ++$i) { ?>
        <a class="btn btn-info col-lg-12" href="<?=base_url();?>c/Evaluation/test_answer_list/<?php echo $all_test[$i]->id;?>"><?php echo $all_test[$i]->name.' ('.$all_test[$i]->start_time.' to '.$all_test[$i]->end_time.')' ?></a><br><br>
    <?php } ?>

</div>

<?php
$this->load->view('c/common/footer');
?>
