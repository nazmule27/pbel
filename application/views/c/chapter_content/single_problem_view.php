<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/chapter_nav');
$CI = &get_instance();
$username = $CI->session->userdata('username');
?>

<div class="col-md-9 col-sm-9 col-xs-12">
    <?php
    $error = $this->session->flashdata("error");
    if (isset($error)) { echo $error; }
    ?>
    <form role="form" action="<?=base_url();?>c/Solution_submit/answer_solution/<?=$single_problem[0]->id?>" method="post">
        <h3>Problem Details</h3>
        <hr>
        <?php for ($i = 0; $i < count($childes); ++$i) { ?>
            <a href="<?=base_url();?>c/Learning/single_view/<?php echo $childes[$i]->id;?>"><?php echo $childes[$i]->title;?></a>,
        <?php } ?>
        &laquo; <big><?php echo $single_problem[0]->title; ?> </big> &raquo;
        <?php for ($i = 0; $i < count($parent); ++$i) { ?>
            <a href="<?=base_url();?>c/Learning/single_view/<?php echo $parent[$i]->id;?>"><?php echo $parent[$i]->title;?></a>,
        <?php } ?>

        <br>
        <br>
        <input id="pid" name="pid" type="hidden" value="<?php echo $single_problem[0]->id; ?>">
        <h4>Title: <?php echo $single_problem[0]->title; ?></h4>
        <br>
        <p>Description: <pre><?php echo $single_problem[0]->description; ?></pre></p>
        <br>
        <p>Learning Outcome: <pre><?php echo $single_problem[0]->learning_outcome; ?></pre></p>
        <br>
        <p>Reference Guide: <pre><?php echo $single_problem[0]->reference_guide; ?></pre></p>
        <br>
        <p><!--Type: <?php /*echo $single_problem[0]->type; */?>; -->Level: <?php echo $single_problem[0]->level;?>; Recommended Keywords: <?php echo $single_problem[0]->keywords; ?></p>
        <br>
        <p>Sample Input: <pre><?php echo $single_problem[0]->sample_input; ?></pre></p>
        <br>
        <p>Sample Output: <pre><?php echo $single_problem[0]->sample_output; ?></pre></p>
        <br>

        <div class="form-group required">
            <label class="control-label">Solution Code:</label>
            <span id="complete_solution" class="btn btn-default pull-right">Complete Solution</span>
            <span id="hint" class="btn btn-default pull-right">Hint</span>
            <span id="blank" class="btn btn-default pull-right">Blank</span>
            <textarea id="solution_code" name="solution_code" class="form-control min-h-200" placeholder="Tell solution code" required></textarea>
            <center><img id="loading_code" style="display: none;" src="<?=base_url();?>assets/img/loading_code.gif" width="100px" alt="loading code"></center>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <button id="solution_code_btn" type="button" class="btn btn-default pull-right"><i class="glyphicon glyphicon-play"></i> Run</button>
            </div>
        </div>
        <center><img id="loading" style="display: none;" src="<?=base_url();?>assets/img/loading.gif" width="100px" alt="loading"></center>
        <div id="result" class="result"></div>
        <input type="hidden" id="outputSet" name="outputSet" value="">
        <input class="btn btn-primary pull-right" type="submit" value="Submit Answer">
    </form>
</div>

<?php
$this->load->view('c/common/footer');
?>

<script type="text/javascript">
    $("#complete_solution").click(function() {
        $("#loading_code").show();
        $("#solution_code").html("");
        $.ajax({
            type: "POST",
            url: '<?=base_url()?>'+"c/Learning/complete_code",
            data: {pid: $("#pid").val()},
            success:
                function(data){
                    $('#solution_code').html(data);
                    $("#loading_code").hide();
                }
        });
    });

    $("#blank").click(function() {
        $("#solution_code").html("");
    });
    $("#hint").click(function() {
        $("#loading_code").show();
        $("#solution_code").html("");
        $.ajax({
            type: "POST",
            url: '<?=base_url()?>'+"c/Learning/hint",
            data: {pid: $("#pid").val()},
            success:
                function(data){
                    $('#solution_code').html(data);
                    $("#loading_code").hide();
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
                    document.getElementById('outputSet').value=con;
                }
        });
    });

</script>
