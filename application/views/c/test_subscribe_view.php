<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Registration for a Test</h3>
    <hr>
    <form role="form" action="<?=base_url();?>c/Test_subscribe/save_test_subscription" method="post">
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">Test Name:</label>
                <?php
                $test_name = array('' => 'Select One') + $test_name;
                echo form_dropdown('test_name', $test_name, '', 'class="form-control custom-text" required=""');
                ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-success">Subscribe</button>
            </div>
        </div>
    </form>
    <?php if (isset($success_msg)) { echo $success_msg; } ?>
</div>

<?php
$this->load->view('c/common/footer');
?>