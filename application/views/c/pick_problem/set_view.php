<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Test Problem Submission</h3>
    <hr>
    <form role="form" action="<?=base_url();?>c/Problem_set/save" method="post">
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">Problem Title:</label>
                <input type="text" name="title" maxlength="255" class="form-control" value="<?php echo  $single_problem[0]->title;?>" placeholder="Give problem title" required>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">Problem Type:</label>
                <?php
                $type = array('' => 'Select Type') + $type;
                $s_type = $single_problem[0]->type;
                echo form_dropdown('type', $type,  $selected=$s_type, 'class="form-control custom-text" id="type" required');
                ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">Test Name:</label>
                <?php
                $test_name = array('' => 'Select One') + $test_name;
                echo form_dropdown('test_name', $test_name, '', ' id="test_name" class="form-control custom-text" required=""');
                ?>
                <input type="hidden" name="test_problem_sl" id="test_problem_sl" value="1">
            </div>
            <div class="form-group col-md-4 required">
                <label class="control-label">Completion Allocate Time:</label>
                <input type="text" name="allocate_time" maxlength="255" id="allocate_time" class="form-control" placeholder="Give test completion allocate time" required>
            </div>
            <div class="form-group col-md-2 required">
                <label class="control-label">Allocate Mark:</label>
                <input type="text" name="allocate_mark" maxlength="5" id="allocate_mark" class="form-control" placeholder="Set mark for this problem" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">Problem Level:</label>
                <?php
                $level = array('' => 'Select Level') + $level;
                $s_level = $single_problem[0]->level;
                echo form_dropdown('level', $level,  $selected=$s_level, 'class="form-control custom-text" id="level" required');
                ?>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">Key Words:</label>
                <input type="text" name="keywords" maxlength="100" class="form-control" value="<?php echo  $single_problem[0]->keywords;?>" placeholder="Like char, float, break " required>
            </div>
        </div>
        <div class="form-group required">
            <label class="control-label">Problem Description:</label>
            <textarea name="description" class="form-control" placeholder="Tell problem description" required><?php echo  $single_problem[0]->description;?></textarea>
        </div>
        <div class="row">
            <div class="form-group col-md-7">
                <div class="form-group margin0 required">
                    <label class="control-label">Reference Guide:</label>
                    <textarea name="reference_guide" class="form-control min-h-130 margin0" maxlength="255"  placeholder="Tell reference links as separate" required><?php echo  $single_problem[0]->reference_guide;?></textarea>
                </div>
            </div>
            <div class="form-group col-md-5 required">
                <label class="control-label">Content Coverage:</label><a class="pull-right" target="_blank" href="<?=base_url();?>c/Problem_submit/coverage">Add</a>
                <?php
                echo form_multiselect('coverage[]', $coverages, $selected=$problem_coverage, 'class="form-control custom-text" required=""');
                ?>
            </div>
        </div>
        <div class="form-group required">
            <label class="control-label">Learning Outcome:</label>
            <textarea name="learning_outcome" class="form-control" placeholder="Tell learning outcome" required><?php echo  $single_problem[0]->learning_outcome;?></textarea>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label class="control-label">Sample Input:</label>
                <textarea name="sample_input" maxlength="255" class="form-control" placeholder="Tell sample input"><?php echo  $single_problem[0]->sample_input;?></textarea>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">Sample Output:</label>
                <textarea name="sample_output" maxlength="255" class="form-control" placeholder="Tell sample output" required><?php echo  $single_problem[0]->sample_output;?></textarea>
            </div>
        </div>
        <div class="form-group required">
            <label class="control-label">Hint:</label>
            <textarea name="hint" class="form-control" placeholder="Tell learning outcome" required><?php echo  $single_problem[0]->hint;?></textarea>
        </div>
        <fieldset>
            <legend> Solution: </legend>
            <div class="form-group required">
                <label class="control-label">Standard Code:</label>
                <textarea id="solution_code" name="solution_code" class="form-control min-h-130" placeholder="Tell standard code" required><?php echo  $problem_solution[0]->solution_code;?></textarea>
            </div>
            <button id="submit_code" type="button" class="btn btn-default pull-right"><i class="glyphicon glyphicon-play"></i> Run</button>
            <br>
            <br>
            <center><img id="loading" style="display: none;" src="<?=base_url();?>assets/img/loading.gif" width="100px" alt="loading"></center>
            <div id="result" class="result"></div>

        </fieldset>
        <div class="row">
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-success pull-right">Submit</button>
            </div>
        </div>
    </form>
    <?php if (isset($success_msg)) { echo $success_msg; } ?>
</div>

<?php
$this->load->view('c/common/footer');
?>
<script type="text/javascript">
    $("#test_name").change(function(){
        $.ajax({
            type: "POST",
            url: '<?=base_url()?>'+"c/Problem_set/get_sl",
            data: {test_name:$(this).val()},
            success:function(data){
                $("#test_problem_sl").val(data);
            }
        });
    });

    $("#submit_code").click(function() {
        $("#loading").show();
        $("#result").html("");
        $.ajax({
            type: "POST",
            url: '<?=base_url()?>'+"c/Solution_submit/run_solution",
            data: {code: $("#solution_code").val()},
            success:
            function(data){
                $('#result').html(data);
                $("#loading").hide();
            }
        });
    });
</script>