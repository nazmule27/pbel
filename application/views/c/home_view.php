<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h4>Welcome to Problem Based eLearning</h4>
    <p style="text-align: justify">
        Problem based Learning (PBL) is a blended learning environment, a combination of self-directed learning and collaborative learning. Learners need to know methods, techniques and standard practices which help to develop skill, positive learning aptitudes and get valuable experience. Problem based e-Learning (PBeL) can support and complement the problem-based learning model with knowledge transfer. The design of effective content of PBL covering the course and the integration of e-Learning with PBL are the challenging issues for the application of PBL in engineering education.
    </p>
    <!--<img src="<?/*=base_url();*/?>assets/img/intro.jpg" width="100%" alt="">-->
    <br>
    Environment Setup for C programming <a href="<?=base_url();?>assets/docs/user-manuel.docx">Guideline</a>

</div>

<?php
$this->load->view('c/common/footer');
?>

