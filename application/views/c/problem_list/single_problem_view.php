<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">

    <h3>Problem Details</h3>
    <hr>
    <?php for ($i = 0; $i < count($childes); ++$i) { ?>
        <a href="<?=base_url();?>c/Problem_list/single_view/<?php echo $childes[$i]->id;?>"><?php echo $childes[$i]->title;?></a>,
    <?php } ?>
    &laquo; <big><?php echo $single_problem[0]->title; ?> </big> &raquo;
    <?php for ($i = 0; $i < count($parent); ++$i) { ?>
        <a href="<?=base_url();?>c/Problem_list/single_view/<?php echo $parent[$i]->id;?>"><?php echo $parent[$i]->title;?></a>,
    <?php } ?>

    <br>
    <br>

    <h4>Title: <?php echo $single_problem[0]->title; ?></h4>
    <br>
<p>Content Coverage:<pre>
<?php for ($i = 0; $i < count($con_coverage); ++$i) { ?>
<?php echo $i+1?>. <?php echo ($con_coverage[$i]->title) ?>

<?php } ?>
</pre></p>
    <br>
    <p>Description: <pre><?php echo $single_problem[0]->description; ?></pre></p>
    <br>
    <p>Learning Outcome: <pre><?php echo $single_problem[0]->learning_outcome; ?></pre></p>
    <br>
    <p>Reference Guide: <pre><?php echo $single_problem[0]->reference_guide; ?></pre></p>
    <p><!--Type: <?php /*echo $single_problem[0]->type; */?>; -->Level: <?php echo $single_problem[0]->level;?>; Recommended Keywords: <?php echo $single_problem[0]->keywords; ?></p>
    <br>
    <p>Sample Input: <pre><?php echo $single_problem[0]->sample_input; ?></pre></p>
    <br>
    <p>Sample Output: <pre><?php echo $single_problem[0]->sample_output; ?></pre></p>
    <br>
    <p>Hint: <pre><?php echo $single_problem[0]->hint; ?></pre></p>
    <br>
    <?php for ($i = 0; $i < count($solutions); ++$i) { ?>
        <fieldset>
            <legend><b>Solution <?php echo $i+1?>:</b></legend>
            <p>Solution Code: <a class="pull-right print-none" href="<?=base_url();?>c/Problem_list/solution_edit/<?php echo $solutions[$i]->id;?>?title=<?php echo $single_problem[0]->title; ?>">Edit</a><pre><xmp><?php echo $solutions[$i]->solution_code; ?></xmp></pre></p>
            <br>
        </fieldset>
    <?php } ?>
    <a class="btn btn-primary pull-right print-none" href="<?=base_url();?>c/Problem_list/solution_submit_view?pid=<?php echo $single_problem[0]->id; ?>&title=<?php echo $single_problem[0]->title; ?>&type=<?php echo $single_problem[0]->type; ?>">Solution Submit</a>
</div>

<?php
$this->load->view('c/common/footer');
?>
