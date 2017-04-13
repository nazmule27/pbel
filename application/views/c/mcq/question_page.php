<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>
<style>
    .row {
        font: normal 14px 'SolaimanLipi';
    }
</style>
<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>MCQ Test
    </h3>
    <hr>
    <?php if (isset($success_msg)) { echo $success_msg; } ?>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <form action="<?=base_url();?>c/Tutorial/mcq_answer_save?chap=<?php echo $_GET['chap'];?>" method="post">
                <input type="hidden" name="chapter" value="<?php echo $_GET['chap'];?>">
                <?php for ($i = 0; $i < count($questions); ++$i) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading"><input type="hidden" name="q_id<?php echo $questions[$i]->id;?>" value="<?php echo $questions[$i]->id;?>">Q. <?php echo ($i+1).': '.$questions[$i]->question;?></div>
                    <div class="panel-body">
                        <?php
                        $option=explode(";", $questions[$i]->option);
                        for ($j = 0; $j < count($option); ++$j) { ?>
                        <input name="q<?php echo $questions[$i]->id;?>" type="radio" value="<?php echo $option[$j];?>"> <?php echo $option[$j];?><br>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                <input class="btn btn-default pull-right" type="submit" value="submit">
            </form>
        </div>
    </div>
</div>

<?php
    $this->load->view('c/common/footer');
?>
