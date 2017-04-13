<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Solution Submission</h3>
    <hr>
    <?php $error = $this->session->flashdata("error"); ?>
    <?php if (isset($error)) { echo $error; } ?>

    <form role="form" action="<?=base_url();?>c/Problem_list/solution_save/<?php echo $single_solution[0]->id; ?>" method="post">
        <div class="row">
            <div class="form-group col-md-8 required">
                <input name="pid" type="hidden" value="<?php echo $this->input->get('pid') ?>">
                <label class="control-label">Problem Title:</label>
                <input type="text" name="title" maxlength="255" class="form-control" value="<?php echo $this->input->get('title') ?>" readonly>
            </div>
        </div>
        <div class="form-group required">
            <fieldset>
                <legend> Solution: </legend>
                <div class="form-group required">
                    <label class="control-label">Standard Code:</label>
                    <textarea id="solution_code" name="solution_code" class="form-control min-h-130" placeholder="Tell standard code" required><?php echo $single_solution[0]->solution_code; ?></textarea>
                </div>
                <button id="solution_code_btn" type="button" class="btn btn-default pull-right"><i class="glyphicon glyphicon-play"></i> Run</button>
                <br>
                <br>
                <center><img id="loading" style="display: none;" src="<?=base_url();?>assets/img/loading.gif" width="100px" alt="loading"></center>
                <div id="result" class="result"></div>

            </fieldset>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-success pull-right">Update</button>
            </div>
        </div>
    </form>
</div>

<?php
$this->load->view('c/common/footer');
?>
<script type="text/javascript">
    $("#solution_code_btn").click(function() {
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