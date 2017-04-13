<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Create New Test</h3>
    <hr>
    <form role="form" action="<?=base_url();?>c/Test/save_test" method="post">
        <div class="row">
            <div class="form-group col-md-12 required">
                <label class="control-label">Test Name:</label>
                <input type="text" name="test_name" maxlength="255" class="form-control" placeholder="Give test name" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">Test Subscription Start Time:</label>
                <input type="text" name="subscription_start_time" id="subs_dateTimePicker_start" maxlength="255" class="form-control" placeholder="Give test subscription start time" required>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">Test Subscription End Time:</label>
                <input type="text" name="subscription_end_time" maxlength="255" id="subs_dateTimePicker_end" class="form-control" placeholder="Give test subscription end time" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">Test Start Time:</label>
                <input type="text" name="start_time" id="dateTimePicker_start" maxlength="255" class="form-control" placeholder="Give test start time" required>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">Test End Time:</label>
                <input type="text" name="end_time" id="dateTimePicker_end" maxlength="255" class="form-control" placeholder="Give test end time" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
    <?php if (isset($success_msg)) { echo $success_msg; } ?>
</div>

<?php
$this->load->view('c/common/footer');
?>