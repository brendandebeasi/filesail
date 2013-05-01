<script id="sidebar-template" type="text/template">
    <% if(isLoggedIn) { %>
        <div class="<% if(isLoggedIn) { %>isLoggedIn<% } %>">
            <div class="hd">
                <input class="search-box left" type="text" placeholder="Search uploads"/>
                <a class="right button upload with-caption" href="javascript:void;">New Upload <span class="fs-font">N</span></a>

                <div class="clear"></div>
            </div>
            <table class="uploads">
               <tbody>
                </tbody>
            </table>
        </div>
    <% } %>
</script>
<script id="sidebar-row" type="text/template">
        <td class="name"><%= model.get('name') %></td>
        <td class="num"><%= model.files.size() %></td>
        <td class="date"></td>
        <td class="size"></td>
</script>
<div class="sidebar-contain"></div>
