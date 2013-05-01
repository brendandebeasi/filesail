<script id="sidebar-template" type="text/template">
    <% if(isLoggedIn) { %>
        <div class="<% if(isLoggedIn) { %>isLoggedIn<% } %>">
            <div class="hd">
                <input class="search-box left" type="text" placeholder="Search uploads"/>
                <a class="right button upload with-caption" href="javascript:void;">New Upload <span class="fs-font">N</span></a>

                <div class="clear"></div>
            </div>
            <div class="bd">
                <div class="dash-row"><span class="fs-font">O</span> Dashboard</div>
                <table class="uploads">
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    <% } %>
</script>
<script id="sidebar-row" type="text/template">
        <td>
            <span class="row-icon fs-font">P</span>
            <span class="folder-name"><%= model.get('name') %></span>
            <span class="num-files"><%= model.files.size() %> files</span>
        </td>
</script>
<div class="sidebar-contain"></div>
