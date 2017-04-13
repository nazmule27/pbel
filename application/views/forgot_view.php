<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>PBeL | Forgot Password</title>
	<link rel="icon" type="image/ico" href="<?=base_url();?>assets/img/logo.png"/>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css"/>
	<link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap-theme.min.css"/>
	<style>
		body {
			padding-top: 110px;
			padding-bottom: 20px;
		}
	</style>
	<link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/css/main.css">
</head>
<body>
<div class="container">
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->session->flashdata('verify_msg'); ?>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Forgot Password</h4>
			</div>
			<div class="panel-body">
				<?php $attributes = array("name" => "forgotform");
				echo form_open("Register/forgot", $attributes);?>
				<div class="form-group">
					<label for="username">Email ID</label>
					<input class="form-control" name="username" placeholder="Email-ID" type="email" value="<?php echo set_value('username'); ?>" autocomplete="off" />
					<span class="text-danger"><?php echo form_error('username'); ?></span>
				</div>
				<div class="form-group">
					<button name="submit" type="submit" class="btn btn-default">Submit</button>
				</div>
				<?php echo form_close(); ?>
				<?php echo $this->session->flashdata('msg'); ?>
			</div>
		</div>
	</div>
</div>
</div>
<?php
$this->load->view('c/common/footer');
?>