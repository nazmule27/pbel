<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Problem Submission</h3>
    <hr>
    <form role="form" action="<?=base_url();?>c/Problem_submit/save" method="post">
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">Problem Title:</label>
                <input type="text" name="title" maxlength="255" class="form-control" placeholder="Give problem title" required>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">Problem Type:</label>
                <?php
                $type = array('' => 'Select Type') + $type;
                echo form_dropdown('type', $type, '', 'class="form-control custom-text" id="type" required');
                ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">Problem Level:</label>
                <?php
                $level = array('' => 'Select Level') + $level;
                echo form_dropdown('level', $level, '' , 'class="form-control custom-text" id="level" required');
                ?>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">Key Words:</label>
                <input type="text" name="keywords" maxlength="100" class="form-control" placeholder="Like char, float, break " required>
            </div>
        </div>
        <div class="form-group required">
            <label class="control-label">Problem Description:</label>
            <textarea name="description" class="form-control" placeholder="Tell problem description" required></textarea>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group margin0 required">
                    <label class="control-label">Reference Guide:</label>
                    <textarea name="reference_guide" class="form-control margin0" maxlength="255"  placeholder="Tell reference links as separate" required></textarea>
                </div>
            </div>
            <div class="form-group col-md-12 required">
                <label class="control-label">Content Coverage:</label><a class="pull-right" target="_blank" href="<?=base_url();?>c/Problem_submit/coverage">Add</a>
                <?php
                echo form_multiselect('coverage[]', $coverages, '', 'class="form-control custom-text" required');
                ?>
            </div>
        </div>
        <div class="form-group required">
            <label class="control-label">Learning Outcome:</label>
            <textarea name="learning_outcome" class="form-control" placeholder="Tell learning outcome" required></textarea>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label class="control-label">Sample Input:</label>
                <textarea name="sample_input" maxlength="255" class="form-control" placeholder="Tell sample input"></textarea>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">Sample Output:</label>
                <textarea name="sample_output" maxlength="255" class="form-control" placeholder="Tell sample output" required></textarea>
            </div>
        </div>
        <div class="form-group required">
            <label class="control-label">Hint:</label>
            <textarea name="hint" class="form-control" placeholder="Tell learning outcome" required></textarea>
        </div>
        <fieldset>
            <legend> Solution: </legend>
            <div class="form-group required">
                <label class="control-label">Standard Code:</label>
                <textarea id="solution_code" name="solution_code" class="form-control min-h-130" placeholder="Tell standard code" required></textarea>
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