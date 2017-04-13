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
        <title>PBeL | Login</title>
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
    <div class="row login-wrapper">
        <div class="col-md-4 col-xs-6 col-md-offset-4 col-xs-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Login Form</strong>
                </div>
                <div class="panel-body">
                    <?php $error = $this->session->flashdata("error"); ?>
                    <div class="alert alert-<?php echo $error ? 'warning' : 'info' ?> alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $error ? $error : 'Enter your username and password' ?>
                    </div>

                    <?php echo form_open(); ?>
                    <?php $error = form_error("username", "<p class='text-danger'>", '</p>'); ?>
                    <div class="form-group <?php echo $error ? 'has-error' : '' ?>">
                        <label for="username">Username</label>
                        <div class="input-group">
  									<span class="input-group-addon">
  										<i class="glyphicon glyphicon-user"></i>
  									</span>
                            <input type="text" name="username" value="<?php echo set_value("username") ?>" id="username" class="form-control">
                        </div>
                        <?php echo $error; ?>
                    </div>
                    <?php $error = form_error("password", "<p class='text-danger'>", '</p>'); ?>
                    <div class="form-group <?php echo $error ? 'has-error' : '' ?>">
                        <label for="password">Password</label>
                        <div class="input-group">
  									<span class="input-group-addon">
  										<i class="glyphicon glyphicon-lock"></i>
  									</span>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <?php echo $error; ?>
                    </div>
                    <input type="submit" value="Login" class="btn btn-primary">
                    <a class="pull-right" href="<?=base_url();?>Register">New User Registration</a>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->load->view('c/common/footer');
?>