<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Add Sub Section</h3>
    <hr>
    <form role="form" action="<?=base_url();?>c/Sub_section/save" method="post">
        <div class="row">
            <div class="form-group col-md-6 required">
                <label for="section" class="control-label">Section Title:</label>
                <?php
                $section=$section;
                $section = array('0' => 'Select Section') + $section;
                echo form_dropdown('section', $section, '', 'class="form-control custom-text" required');
                ?>
            </div>
            <div class="form-group col-md-6 required">
                <label for="sub_title" class="control-label">Sub Section Title:</label>
                <input type="text" name="sub_title" maxlength="255" class="form-control" placeholder="Give sub section title" required>
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

