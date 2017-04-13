<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">

    <h3>Problem Details
        <em class="end-time">Remaining Time:
            <input type="hidden" name="limit" value="<?php if (isset($test[0]->end_time)) { echo $test[0]->end_time; } ?>" />
            <code id="limit"></code>
        </em>
    </h3>
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

    <a class="btn btn-primary pull-right" href="<?=base_url();?>c/Give_test/answer_submit_view?pid=<?php echo $single_problem[0]->id; ?>&title=<?php echo $single_problem[0]->title; ?>&test_id=<?php echo $single_problem[0]->test_id; ?>&description=<?php echo $single_problem[0]->description; ?>&answer_code=<?php echo $single_problem[0]->answer_code; ?>">Answer Submit</a>
</div>

<?php
$this->load->view('c/common/footer');
?>

<script type="text/javascript">
    var data = $("input[name=limit]").val();
    $("#limit").countdown(data, function(event) {
        $(this).text(event.strftime('%D days %H:%M:%S'));
    }).on('finish.countdown', function() {
        window.location = '<?=base_url()?>'+'c/Give_test/info_expired';
    });
</script>