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
        <div class="main-component-contain">
            <div class="left logo-contain">
                <a id="logo" href="<?php $config['base_url']; ?>"></a>
            </div>
            <div class="right">
                <div class="buttons">
                    <a class="button login" href="javascript:void(0);">Login</a>
                    <a class="button signup" href="javascript:void(0);">Signup</a>
                </div>
                <div class="login-box hidden">
                    <input id="username" type="text" />
                    <input id="password" type="password"/>
                </div>
            </div>
        </div>
    </header>