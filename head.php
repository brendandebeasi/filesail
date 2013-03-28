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
	<script src="js/dynamic.php"></script>
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
                <div class="buttons right">
                    <button class="login" href="javascript:void(0);">Login</button>
                    <button class="signup" href="javascript:void(0);">Signup</button>
                </div>
                <div class="login-box hidden">
                    <a class="close-box icon-sweets" href="javascript:void(0);">w</a>
                    <input id="username" placeholder="Username / Email" type="text" />
                    <input id="password" placeholder="Password" type="password"/>
                    <button class="login" href="javascript:void(0);">Login</button>
                </div>
                <div class="signup-box hidden">
                    <a class="close-box icon-sweets" href="javascript:void(0);">w</a>
                    <input id="name" placeholder="Name" type="text" />
                    <input id="username" placeholder="Username" type="text" />
                    <input id="email" placeholder="Email Address" text" />
                    <input id="password" placeholder="Password" type="password"/>
                    <button class="signup" href="javascript:void(0);">Signup</button>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </header>
