<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">

    <h3>Problem Details </h3>
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
</div>

<?php
$this->load->view('c/common/footer');
?>