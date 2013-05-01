<script id="folder-template" type="text/template">
    <div class="folder-contain<% if(isLoggedIn) { %> isLoggedIn<% } %>">
        <div class="hd">
            <div class="left">
                <div class="folderNameContain">
                    <span class="ssp-font italic folderName"><%= model.get('name') %></span>
                    <span class="fs-font editFolderName"> H</span>
                </div>
<!--                <div class="folderLink">-->
<!--                    Folder Link-->
<!--                    <a href="javascript:void(0);">copy</a>-->
<!--                </div>-->
            </div>
            <div class="right">
                <span class="left icon fs-font toggleGridView selected">J</span>
                <span class="left icon fs-font toggleListView">I</span>
                <span class="left download button ssp-font">Download All</span>
                <span class="left fs-font upload button">+</span>
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
    <% if(model.get('type') == 'img') { %>
        <div style="background-image:url(<%= model.getDownloadLink() %>);background-size:cover;background-position:center center;background-repeat: no-repeat;" class="wrp-1">
    <% } else { %>
        <div style="background-image:url(/img/fs-guy.png);background-size:cover;background-position:center center;background-repeat: no-repeat;" class="wrp-1">
    <% } %>

        <div class="hd">
            <div class="left" title="<%= model.get('name') %>.<%= model.get('extension') %>"><%= model.get('name') %>.<%= model.get('extension') %></div>
            <div class="right"><%= rawSize %></div>
            <div class="clear"></div>
        </div>
        <div class="bd">

            <a class="download" target="_blank" href="<%= model.getDownloadLink() %>"><span class="fs-font">K</span> Download</a>
        </div>
    </div>
</script>