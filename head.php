<?php
require_once('config.php');
//$link = mysql_connect($db_host,$db_user,$db_pass) or die('username and password must be wrong n00b');
?><!DOCTYPE html>
<head>
	<title>FileSail</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="js/vendor/jquery.ui.widget.js"></script>
	<script src="js/jquery.iframe-transport.js"></script>
	<script src="js/jquery.fileupload.js"></script>
	<script src="js/app.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<div id="container">
    <header>
        <div class="left">
            <a id="logo-contain" href="<?php $config['base_url']; ?>"><img id="logo" src="img/logo.png" /></a>
        </div>
        <div class="right">
            <div class="buttons">
                <a class="button" href="javascript:void();">Login</a>
                <a class="button blue" href="javascript:void();">Signup</a>
            </div>
            <div class="login-box hidden">
                <input id="username" type="text" />
                <input id="password" type="password"/>
            </div>
        </div>
    </header>