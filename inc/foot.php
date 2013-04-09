<script id="footer-template" type="text/template">
    <footer class="<% if(isLoggedIn) { %>isLoggedIn<% } %>">
        <div class="divider"></div>
        <ul>
            <li><a href="javascript:void(0);">Help</a></li>
            <li><a href="javascript:void(0);">Contact</a></li>
            <li><a href="javascript:alert('If you have any complaints or concerns regarding content on our server please do not hesitate to email b[AT]neueway.com or peridious[AT]icloud.com');">DMCA</a></li>
            <li><a href="javascript:void(0);">About</a></li>
        </ul>
        <div class="copyright">
            &copy; 2013 FileSail, LLC
        </div>
    </footer>
</script>
<div class="footer-contain"></div>
<div style="display:none" class="icon-sweets">X</div>
<script src="<?php echo $config['host'] . $config['base_url']; ?>/js/jquery.js"></script>
<script src="<?php echo $config['host'] . $config['base_url']; ?>/js/jquery.session.js"></script>
<script src="<?php echo $config['host'] . $config['base_url']; ?>/js/underscore.js"></script>
<script src="<?php echo $config['host'] . $config['base_url']; ?>/js/backbone.js"></script>
<script src="<?php echo $config['host'] . $config['base_url']; ?>/js/jquery.ui.widget.js"></script>
<script src="<?php echo $config['host'] . $config['base_url']; ?>/js/jquery-ui-1.10.2.custom.min.js"></script>
<script src="<?php echo $config['host'] . $config['base_url']; ?>/js/jquery.iframe-transport.js"></script>
<script src="<?php echo $config['host'] . $config['base_url']; ?>/js/jquery.fileupload.js"></script>
<script src="<?php echo $config['host'] . $config['base_url']; ?>/js/handlebars.js"></script>
<script src="<?php echo $config['host'] . $config['base_url']; ?>/js/dynamic.php"></script>
<script src="<?php echo $config['host'] . $config['base_url']; ?>/js/app.js"></script>
</div>
</body>
