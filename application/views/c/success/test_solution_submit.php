<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <div class="alert alert-success text-center">Your solution was successfully uploaded! <a href="<?=base_url();?>c/contest_home">Go to problem list</a> <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>
</div>

<?php
$this->load->view('c/common/footer');
?>
