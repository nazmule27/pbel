<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Problem Submission</h3>
    <hr>
    <form role="form" action="<?=base_url();?>c/Problem_submit/save_coverage" method="post">
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">Content Coverage:</label>
                <input type="text" name="coverage" maxlength="255" class="form-control" placeholder="Give content coverage" required>
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