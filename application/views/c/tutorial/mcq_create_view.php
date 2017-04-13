<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>
<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Add Content</h3>
    <hr>
    <form role="form" action="<?=base_url();?>c/Content/save_mcq" method="post">
        <div class="row">
            <div class="form-group col-md-4 required">
                <label for="sub_section" class="control-label">Sub Section:</label>
                <?php
                $sub_section=$sub_section;
                $sub_section = array('0' => 'Select Sub Section') + $sub_section;
                echo form_dropdown('sub_section', $sub_section, '', 'class="form-control custom-text" id="sub_section" required');
                ?>
            </div>
            <div class="form-group col-md-8 required">
                <label for="question" class="control-label">Question Description:</label>
                <input type="text" name="question" maxlength="512" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 required">
                <label for="option1" class="control-label">Option 1:</label>
                <input type="text" name="option1" maxlength="255" class="form-control" required>
            </div>
            <div class="form-group col-md-6 required">
                <label for="option2" class="control-label">Option 2:</label>
                <input type="text" name="option2" maxlength="255" class="form-control" required>
            </div>
            <div class="form-group col-md-6 required">
                <label for="option3" class="control-label">Option 3:</label>
                <input type="text" name="option3" maxlength="255" class="form-control" required>
            </div>
            <div class="form-group col-md-6 required">
                <label for="option4" class="control-label">Option 4:</label>
                <input type="text" name="option4" maxlength="255" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 required">
                <label for="answer" class="control-label">Answer:</label>
                <input type="text" name="answer" maxlength="255" class="form-control" required>
            </div>
        </div>

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

<script>

</script>
