<script id="folder-template" type="text/template">
    <div class="folder-contain<% if(isLoggedIn) { %> isLoggedIn<% } %>">
        <div class="hd">
            <div class="left">
                <div class="folderNameContain">
                    <span class="fs-logo folderName"><%= model.get('name') %></span>
                    <span class="fs-font editFolderName"> H</span>
                </div>
                <div class="folderLink">
                    Folder Link
                    <a href="javascript:void(0);">copy</a>
                </div>
            </div>
            <div class="right">
                <span class="left icon fs-font toggleGridView selected">J</span>
                <span class="left icon fs-font toggleListView">I</span>
                <span class="left download button fs-logo">Download All</span>
                <span class="left fs-font upload button">N</span>
                <span class="left toggleFolderOptionsView">^</span>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="bd">
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
            <% if(model.get('type') == 'img') { %>
                <img width="100%" src="<%= model.getDownloadLink() %>" />
            <% } else { %>
                <a target="_blank" href="<%= model.getDownloadLink() %>">Download</a>
            <% } %>
        </div>
    </div>
</script>