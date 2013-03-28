<?php require_once('head.php'); ?>
<div class="main-component-contain">
    <div class="body">
        <h1>File Sharing For Professionals, Done Right.</h1>

        <div class="upload-contain">
            <div class="upload-border">
                <a class="button blue upload" id="upload-button" href="javascript:void(0);">select file to upload</a>
                <input class="hidden" id="upload-field" type="file" name="file" data-url="upload.php" multiple>
            </div>
            <div class="status">
                <ul>
                </ul>
            </div>
        </div>

        <div class="small-text">
            By clicking "select file to upload" you agree to our <a href="javascript:alert('Please do not upload copyrighted files. Not only will we delete them, but we could get into trouble. If you enjoy the service please respect United States copyright laws. If you have any complaints or concerns about files hosted on our server please do not hesitate to email b[AT]neueway.com or peridious[AT]icloud.com');">Terms of Service</a>
        </div>

        <ul class="file-type-icons">
            <li class="zip"></li>
            <li class="video"></li>
            <li class="document"></li>
            <li class="photo"></li>
        </ul>

        <div id="progress">
            <div class="bar" style="width: 0%;"></div>
        </div>
    </div>
</div>
<?php require_once('foot.php'); ?>