<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>
<style type="text/css">
    .problem-nav a:after{
        content: " | ";
        color: black;
    }
    .problem-nav a:last-child:after{
        content: "";
        color: black;
    }
</style>
<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Solution Submit
        <em class="end-time">Remaining Time:
            <input type="hidden" name="limit" value="<?php if (isset($test[0]->end_time)) { echo $test[0]->end_time; } ?>" />
            <code id="limit"></code>
        </em>
    </h3>
    <center class="problem-nav">
        <?php for ($i = 0; $i < count($test_problem); ++$i) { ?>
            <a href="<?=base_url();?>c/Give_test/answer_submit_view?test_id=<?php echo $test_problem[$i]->test_id; ?>&pid=<?php echo $test_problem[$i]->id; ?>&title=<?php echo $test_problem[$i]->title; ?>&description=<?php echo $test_problem[$i]->description; ?>&answer_code=<?php echo $test_problem[$i]->answer_code; ?>"><?php echo $test_problem[$i]->test_problem_sl;?></a>
        <?php } ?>
    </center>

    <hr>
    <?php $error = $this->session->flashdata("error"); ?>
    <?php if (isset($error)) { echo $error; } ?>

    <form role="form" id="answer_form" action="<?=base_url();?>c/Give_test/save_test_answer/<?=$this->input->get('test_id').'/'.$this->input->get('pid')?>" method="post">
        <div class="row">
            <div class="form-group col-md-12">
                <input id="pid" name="pid" type="hidden" value="<?php echo $this->input->get('pid') ?>">
                <input id="test_id" name="test_id" type="hidden" value="<?php echo $this->input->get('test_id') ?>">
                <label class="control-label">Problem Title: </label> <?php echo $this->input->get('title') ?> <input type="hidden" name="title" value="<?php echo $this->input->get('title')?>"><br>
                <label class="control-label">Description: </label> <?php echo $this->input->get('description') ?> <input type="hidden" name="description" value="<?php echo $this->input->get('description')?>">
            </div>
        </div>
        <div class="form-group required">
            <fieldset>
                <legend> Solution: </legend>
                <div class="form-group required">
                    <label class="control-label">Standard Code:</label>
                    <textarea id="solution_code" name="solution_code" class="form-control min-h-130" placeholder="Tell standard code" required><?php echo $this->input->get('answer_code') ?></textarea>
                </div>
                <button id="solution_code_btn" type="button" class="btn btn-default pull-right"><i class="glyphicon glyphicon-play color-green"></i> Run</button>
                <br>
                <br>
                <center><img id="loading" style="display: none;" src="<?=base_url();?>assets/img/loading.gif" width="100px" alt="loading"></center>
                <div id="result" class="result"></div>
                <input type="hidden" id="outputSet" name="outputSet" value="">
            </fieldset>
        </div>
        <div class="alert alert-success" id="successMessage">
            <strong>Success! </strong> Your code saved.
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                <button type="button" id="answer_save" class="btn btn-success pull-right">Save</button>
            </div>
        </div>
    </form>
</div>

<?php
$this->load->view('c/common/footer');
?>
<script type="text/javascript">
    $("#successMessage").hide();
    $("#answer_save").click(function() {
        $.ajax({
            type: "POST",
            url: '<?=base_url()?>'+"c/Give_test/save_test_answer_js/"+$("#test_id").val()+"/"+$("#pid").val(),
            data: {solution_code: $("#solution_code").val(), outputSet: $("#outputSet").val()},
            success:
                function(data){
                    $("#successMessage").fadeTo(2000, 500).slideUp(500, function(){
                        $("#successMessage").slideUp(500);
                    });
                }
        });
    });

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
                    var result = document.getElementById('result');
                    var con=result.innerHTML;
                    con=jQuery(con).text()
                    con=con.replace("Output:", "");
                    document.getElementById('outputSet').value=con;
                }
        });
    });

    var data = $("input[name=limit]").val();
    $("#limit").countdown(data, function(event) {
        $(this).text(event.strftime('%D days %H:%M:%S'));
    }).on('finish.countdown', function() {
        window.location = '<?=base_url()?>'+'c/Give_test/info_expired';
    });

</script>