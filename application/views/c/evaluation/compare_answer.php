<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Problem Name: <?php echo $single_test_answer[0]->title;?></h3>
    <hr>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Problem</th>
            <th>Submitted Answer</th>
            <th>Standard Answer</th>
            <th>Similarity (%)</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Code</td>
            <td><pre style="max-width: 320px"><xmp><?php echo $single_test_answer[0]->answer_code;?></xmp></pre></td>
            <td><pre style="max-width: 320px"><xmp><?php echo $single_standard_answer[0]->solution_code;?></xmp></pre></td>
            <td><?php
                similar_text($single_standard_answer[0]->solution_code, $single_test_answer[0]->answer_code, $percent);
                echo round($percent,2).' %';
                ?>
            </td>
        </tr>
        <tr>
            <td>Output</td>
            <td><pre style="max-width: 320px"><xmp><?php echo $single_test_answer[0]->output;?></xmp></pre></td>
            <td><pre style="max-width: 320px"><xmp><?php echo $single_standard_answer[0]->sample_output;?></xmp></pre></td>
            <td><?php
                similar_text($single_standard_answer[0]->sample_output, $single_test_answer[0]->output, $percent2);
                echo round($percent2,2).' %';
                ?>
            </td>
        </tr>
        </tbody>
    </table>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <form role="form" action="<?=base_url();?>c/Evaluation/save_mark" method="post">
                <div class="row">
                    <div class="form-group col-md-4 required">
                        <input type="hidden" name="test_id" value="<?php echo $single_test_answer[0]->test_id?>">
                        <input type="hidden" name="answer_id" value="<?php echo $single_test_answer[0]->id;?>">
                        <label class="control-label">Give Mark:</label>
                        <input type="text" name="mark" maxlength="5" class="form-control" pattern="^[0-9]+(\.\d{1,2})?" placeholder="Give mark of this problem" value="<?php echo $single_test_answer[0]->mark;?>" required>
                    </div>
                    <div class="form-group col-md-2 margin0">
                        <label class="control-label width-100p">&nbsp;</label>
                        <span class="mark-of"> mark of <?php echo $single_standard_answer[0]->mark?></span>
                        </div>
                    <div class="form-group col-md-6">
                        <label class="control-label width-100p">&nbsp;</label>
                        <button type="submit" class="btn btn-success pull-right">Submit</button>
                    </div>
                </div>
            </form>
            <?php if (isset($success_msg)) { echo $success_msg; } ?>
        </div>
    </div>
</div>

<?php
$this->load->view('c/common/footer');
?>
