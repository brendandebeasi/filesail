<!DOCTYPE html>
<?php
include_once('conf/env.php');
include_once('conf/config.php');
//$link = mysql_connect($db_host,$db_user,$db_pass) or die('username and password must be wrong n00b');
?>
<head>
	<title>FileSail</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $config['host'] . $config['base_url']; ?>css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $config['host'] . $config['base_url']; ?>css/style.css" />
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700italic,900italic' rel='stylesheet' type='text/css'>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-39905228-1', 'filesail.com');
        ga('send', 'pageview');

    </script>
</head>
<body>
<input class="hidden" id="upload-field" type="file" name="file" original-data-url="api.php?action=upload" multiple="">
<div class="preload">X</div>
<script id="header-template" type="text/template">
    <header class=" <% if(isLoggedIn) { %>isLoggedIn<% } %>">
        <div class="main-component-contain">
            <div class="left logo-contain">
                <a id="logo" class="fs-logo" href="<?php $config['base_url']; ?>">FileSail</a>
            </div>

            <div class="right">
                <% if(isLoggedIn) { %>
                    <div class="welcome">
                        Howdy, <a href="javascript:void(0);"><%= userName %></a>
                        &nbsp;<a href="javascript:void(0);" class="gray fs-font">F</a>
                        <div class="clear"></div>
                    </div>
                <% } else { %>
                    <% if(!showLoginBox && !showSignupBox) { %>
                        <div class="buttons right">
                            <button class="login" href="javascript:void(0);">Login</button>
                            <button class="signup" href="javascript:void(0);">Signup</button>
                        </div>
                    <% } %>
                    <% if(showLoginBox) { %>
                        <div class="login-box">
                            <img src="<?php echo $config['host'] . $config['base_url']; ?>/img/ajax-loader.gif" class="process-login <% if(!showLoginLoader) { %>hidden<% } %>" />
                            <input class="login" <% if(showLoginLoader) { %>disabled="disabled"<% } %> placeholder="Username / Email" type="text" />
                            <input class="password" <% if(showLoginLoader) { %>disabled="disabled"<% } %> placeholder="Password" type="password"/>
                            <% if(!showLoginLoader) { %><a class="close icon-sweets" href="javascript:void(0);">X</a><% } %>
                        </div>

                    <% } %>
                    <% if(showSignupBox) { %>
                        <div class="signup-box">
                            <input id="reg-name" placeholder="Name" type="text" />
                            <input id="reg-username" placeholder="Username" type="text" />
                            <input id="reg-email" placeholder="Email Address" type="text" />
                            <input id="reg-password" placeholder="Password" type="password"/>
                            <a class="close icon-sweets" href="javascript:void(0);">X</a>
                        </div>
                    <% } %>
                <% } %>

                <div class="clear"></div>

            </div>
            <div class="clear"></div>
        </div>
    </header>
</script>
<div id="container"><div class="header-contain"></div>
