<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">

    <h3>Problem Details</h3>
    <hr>

    <br>

    <h4>Title: <?php echo $single_problem[0]->title; ?></h4>
    <br>
    <p>Description: <pre><?php echo $single_problem[0]->description; ?></pre></p>
    <br>
    <p>Learning Outcome: <pre><?php echo $single_problem[0]->learning_outcome; ?></pre></p>
    <br>
    <p>Reference Guide: <pre><?php echo $single_problem[0]->reference_guide; ?></pre></p>
    <p>Type: <?php echo $single_problem[0]->type; ?>; Level: <?php echo $single_problem[0]->level;?>; Recommended Keywords: <?php echo $single_problem[0]->keywords; ?></p>
    <br>
    <p>Sample Input: <pre><?php echo $single_problem[0]->sample_input; ?></pre></p>
    <br>
    <p>Sample Output: <pre><?php echo $single_problem[0]->sample_output; ?></pre></p>
    <br>
    <?php for ($i = 0; $i < count($solutions); ++$i) { ?>
        <fieldset>
            <legend><b>Solution <?php echo $i+1?>:</b></legend>
            <p>Solution Code: <pre><xmp><?php echo $solutions[$i]->solution_code; ?></xmp></pre></p>
            <br>
        </fieldset>
    <?php } ?>
    <a class="btn btn-primary pull-right" href="<?=base_url();?>c/Contest_home/solution_submit_view?pid=<?php echo $single_problem[0]->id; ?>&title=<?php echo $single_problem[0]->title; ?>&test_id=<?php echo $single_problem[0]->test_id; ?>&type=<?php echo $single_problem[0]->type; ?>">Solution Submit</a>
</div>

<?php
$this->load->view('c/common/footer');
?>
