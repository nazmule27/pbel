<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Problem Edit</h3>
    <hr>
    <form role="form" action="<?=base_url();?>c/Problem_list/update/<?php echo  $single_problem[0]->id;?>" method="post">
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
            <div class="form-group col-md-12">
                <div class="form-group margin0 required">
                    <label class="control-label">Reference Guide:</label>
                    <textarea name="reference_guide" class="form-control margin0" maxlength="255" placeholder="Tell reference links as separate" required><?php echo  $single_problem[0]->reference_guide;?></textarea>
                </div>
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
                <textarea name="sample_output" class="form-control" placeholder="Tell sample output" required><?php echo  $single_problem[0]->sample_output;?></textarea>
            </div>
        </div>
        <div class="form-group required">
            <label class="control-label">Hint:</label>
            <textarea name="hint" class="form-control" placeholder="Tell learning outcome" required><?php echo  $single_problem[0]->hint;?></textarea>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-success pull-right">Update</button>
            </div>
        </div>
    </form>
    <?php if (isset($success_msg)) { echo $success_msg; } ?>
</div>

<?php
$this->load->view('c/common/footer');
?>