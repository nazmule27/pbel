<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Your Test Problems List <small>(<?php echo $test[0]->name;?>)</small>
        <em class="end-time">Remaining Time:
            <input type="hidden" name="limit" value="<?php if (isset($test[0]->end_time)) { echo $test[0]->end_time; } ?>" />
            <code id="limit"></code>
        </em>
    </h3>

    <hr>
    <table id="problems" class="display " cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>Problem ID</th>
            <th>Test Name</th>
            <th>Tittle</th>
            <th>Description</th>
            <!--<th>Level</th>-->
            <th>Ans. Submit</th>
            <th width="50">Details</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($test_problem); ++$i) { ?>
        <tr>
            <td><?php echo $test_problem[$i]->test_problem_sl;?></td>
            <td><?php echo $test_problem[$i]->name;?></td>
            <td><?php echo $test_problem[$i]->title;?></td>
            <td><?php echo $test_problem[$i]->description;?></td>
            <!--<td><?php /*echo $test_problem[$i]->level;*/?></td>-->
            <td><a href="<?=base_url();?>c/Give_test/answer_submit_view?test_id=<?php echo $test_problem[$i]->test_id; ?>&pid=<?php echo $test_problem[$i]->id; ?>&title=<?php echo $test_problem[$i]->title; ?>&description=<?php echo $test_problem[$i]->description; ?>&answer_code=<?php echo $test_problem[$i]->answer_code; ?>">Ans. Submit</a> </td>
            <td><a href="<?=base_url();?>c/Give_test/single_view/<?php echo $test_problem[$i]->test_id;?>/<?php echo $test_problem[$i]->id;?>">Details</a> </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
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
