<?php
require_once('head.php');
?>
<div class="main-component-contain">
    <div class="body">
        <h1>File Sharing For Professionals, Done Right.</h1>

        <div class="upload-contain">
            <div class="upload-border">
                <a class="button blue upload" id="upload-button" href="javascript:void(0);">select file to upload</a>
                <input class="hidden" id="upload-field" type="file" name="file" data-url="upload.php" multiple>
            </div>
            <div class="upload-completed">
                <em class="hidden">Completed Uploads:</em>
                <ul>
                    <!--<li><a href="#">Asdf</a></li>-->
                </ul>
            </div>
        </div>

        <div class="small-text">
            By clicking "select file to upload" you agree to our <a href="javascript:void(0);">Terms of Service</a>
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

<footer>
    <div class="divider"></div>
    <ul>
        <li><a href="javascript:void(0);">Home</a></li>
        <li><a href="javascript:void(0);">Contact</a></li>
        <li><a href="javascript:void(0);">About</a></li>
        <li><a href="javascript:void(0);">Facebook</a></li>
        <li><a href="javascript:void(0);">Twitter</a></li>
    </ul>
    <div class="copyright">
        &copy; 2013 FileSail, LLC
    </div>
</footer>
