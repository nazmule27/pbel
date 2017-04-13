<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Add Section</h3>
    <hr>
    <form role="form" action="<?=base_url();?>c/Section/save" method="post">
        <div class="row">
            <div class="form-group col-md-12 required">
                <label for="title" class="control-label">Section Title:</label>
                <input type="text" name="title" maxlength="255" class="form-control" placeholder="Give section title" required>
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

