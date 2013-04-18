<script id="folder-template" type="text/template">
    <div class="folder-contain<% if(isLoggedIn) { %> isLoggedIn<% } %>">
        <div class="hd">
            <div class="left">
                <div class="folderName">
                    <%= model.get('name') %>
                    <span class="fs-font ditFolderName">H</span>
                </div>
                <div class="folderLink">
                    Folder Link
                    <a href="javascript:void(0);">copy</a>
                </div>
            </div>
            <div class="right">
                <span class="fs-font toggleGridView">J</span>
                <span class="fs-font toggleListView">I</span>
                <span class="downloadAll button">Download All<span class="downloadAll fs-font">K</span></span>
                <span class="fs-font upload button">N</span>
                <span class="toggleFolderOptionsView">^</span>
            </div>
            <div class="clear"></div>
        </div>
        <div class="body">
            <ul>

            </ul>
        </div>
    </div>
</script>
<script id="file-template" type="text/template">
    <div class="wrp-1">
        <div class="hd">
            <div class="left"><%= model.get('name') %>.<%= model.get('extension') %></div>
            <div class="right">1.24Mb</div>
            <div class="clear"></div>
        </div>
        <div class="bd">

        </div>
    </div>
</script>