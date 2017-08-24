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

    <form role="form" action="<?=base_url();?>c/Solution_submit/solution_save" method="post">
        <div class="row">
            <div class="form-group col-md-8 required">
                <input name="pid" type="hidden" value="<?php echo $this->input->get('pid') ?>">
                <label class="control-label">Problem Title:</label>
                <input type="text" name="title" maxlength="255" class="form-control" value="<?php echo $this->input->get('title') ?>" readonly>
            </div>
            <div class="form-group col-md-4 required">
                <label class="control-label">Solution Type:</label>
                <?php
                $type = array('' => 'Select Type') + $type;
                $s_type = $this->input->get('type');
                echo form_dropdown('type', $type,  $selected=$s_type, 'class="form-control custom-text" id="type" required');
                ?>
            </div>
        </div>
        <div class="form-group required">
            <fieldset>
                <legend> Solution: </legend>
                <div class="form-group required">
                    <label class="control-label">Standard Code:</label>
                    <textarea id="solution_code" name="solution_code" class="form-control min-h-130 codemirror-textarea" placeholder="Tell standard code" required></textarea>
                </div>
                <button id="solution_code_btn" type="button" class="btn btn-default pull-right"><i class="glyphicon glyphicon-play color-green"></i> Run</button>
                <br>
                <br>
                <center><img id="loading" style="display: none;" src="<?=base_url();?>assets/img/loading.gif" width="100px" alt="loading"></center>
                <div id="result" class="result"></div>

            </fieldset>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-success pull-right">Submit</button>
            </div>
        </div>
    </form>
</div>

<?php
$this->load->view('c/common/footer');
?>
<script type="text/javascript" src="<?=base_url();?>assets/codemirror/lib/codemirror.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/codemirror/lib/clike.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/codemirror/addon/fold/foldcode.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/codemirror/addon/fold/foldgutter.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/codemirror/addon/fold/brace-fold.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/codemirror/addon/fold/xml-fold.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/codemirror/addon/fold/indent-fold.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/codemirror/addon/fold/comment-fold.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/codemirror/addon/edit/matchbrackets.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/codemirror/addon/selection/active-line.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/codemirror/addon/hint/show-hint.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/codemirror/addon/hint/anyword-hint.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/codemirror/addon/search/searchcursor.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/codemirror/addon/search/search.js"></script>
<script type="text/javascript">
    CodeMirror.commands.autocomplete = function(cm) {
        cm.showHint({hint: CodeMirror.hint.anyword});
    }
    var code = $(".codemirror-textarea")[0];
    var editor = CodeMirror.fromTextArea(code, {
        mode: "text/x-csrc",
        lineNumbers : true,
        matchBrackets: true,
        styleActiveLine: true,
        extraKeys: {"Ctrl-Q": function(cm){ cm.foldCode(cm.getCursor()); }, "Ctrl-Space": "autocomplete", "Alt-F": "findPersistent"},
        foldGutter: true,
        gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],
        /*theme:"abcdef",*/

    });
    $(CodeMirror.fromTextArea).keyup(function(e){
        var textdiv=document.getElementById("solution_code");
        textdiv.innerHTML=editor.getValue();
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
                }
        });
    });
</script>