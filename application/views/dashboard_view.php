<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h4>Welcome to Problem Based eLearning of C language</h4>
    <br>
    <a href="<?=base_url();?>c/home">Programming Language</a><br>

</div>

<?php
$this->load->view('c/common/footer');
?>

