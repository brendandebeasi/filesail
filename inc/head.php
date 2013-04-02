<?php
include_once('conf/config.php');
//$link = mysql_connect($db_host,$db_user,$db_pass) or die('username and password must be wrong n00b');
?><!DOCTYPE html>
<head>
	<title>FileSail</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="../../js/vendor/jquery.ui.widget.js"></script>
	<script src="../../js/jquery.iframe-transport.js"></script>
	<script src="../../js/jquery.fileupload.js"></script>
	<script src="../../js/jquery.session.js"></script>
	<script src="../../js/handlebars.js"></script>
	<script src="../../js/app.js"></script>
	<script src="../../js/dynamic.php"></script>
    <link rel="stylesheet" type="text/css" href="../../css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="../../css/style.css" />
</head>
<body>
<script id="header-template" type="text/x-handlebars-template">
    <header>
        <div class="main-component-contain">
            <div class="left logo-contain">
                <a id="logo" href="<?php $config['base_url']; ?>"></a>
            </div>

            <div class="right">
                {{#if isLoggedIn}}
                    Welcome!
                {{else}}
                    {{#if showInitialButtons}}
                    <div class="buttons right">
                        <button class="login" href="javascript:void(0);">Login</button>
                        <button class="signup" href="javascript:void(0);">Signup</button>
                    </div>
                    {{/if}}

                    {{#if showLoginBox}}
                    <div class="login-box">
                        <a class="close icon-sweets" href="javascript:void(0);">X</a>
                        <input id="login-login" placeholder="Username / Email" type="text" />
                        <input id="login-password" placeholder="Password" type="password"/>
                        <button class="login" href="javascript:void(0);">Login</button>
                    </div>
                    {{/if}}

                    {{#if showSignupBox}}
                    <div class="signup-box">
                        <a class="close icon-sweets" href="javascript:void(0);">X</a>
                        <input id="reg-name" placeholder="Name" type="text" />
                        <input id="reg-username" placeholder="Username" type="text" />
                        <input id="reg-email" placeholder="Email Address" text" />
                        <input id="reg-password" placeholder="Password" type="password"/>
                        <button class="signup" href="javascript:void(0);">Signup</button>
                    </div>
                    {{/if}}


                {{/if}}
                <div class="clear"></div>

            </div>
            <div class="clear"></div>
        </div>
    </header>
</script>
<div id="container"><div class="header-contain"></div>
