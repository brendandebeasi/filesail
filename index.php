<?php require_once('inc/head.php'); ?>
<div class="body-contain"></div>
<script id="landing-template" type="text/template">
    <div class="main-component-contain<% if(isLoggedIn) { %> isLoggedIn<% } %>">

        <div class="body">
            <div class="subhead"><div class="wrp-1">File Sharing For Professionals, Done Right.</div></div>

            <div class="upload-contain">
                <div class="upload-border">
                    <a class="button blue upload" id="upload-button" href="javascript:void(0);">select or drag files to upload</a>
                    <input class="hidden" id="upload-field" type="file" name="file" data-url="api.php?action=upload" multiple>
                </div>
                <div class="status">
                    <ul>
                    </ul>
                </div>
            </div>

            <div class="small-text">
                By uploading you agree to our <a href="javascript:alert('Please do not upload copyrighted files. Not only will we delete them, but we could get into trouble. If you enjoy the service please respect United States copyright laws. If you have any complaints or concerns about files hosted on our server please do not hesitate to email b[AT]neueway.com or peridious[AT]icloud.com');">Terms of Service</a>
            </div>

            <div id="progress">
                <div class="bar" style="width: 0%;"></div>
            </div>

            <div class="fs-font upload-icon">A</div>
        </div>
</script>
<?php require_once('inc/folder.php'); ?>
<?php require_once('inc/sidebar.php'); ?>
<div class="clear"></div>
<?php require_once('inc/foot.php'); ?>