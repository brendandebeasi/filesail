<script id="sidebar-template" type="text/template">
    <% if(isLoggedIn) { %>
        <div class="<% if(isLoggedIn) { %>isLoggedIn<% } %>">
            <div class="hd">
                <div class="title left">Your Files</div>
                <div class="fs-font right">F</div>
                <div class="clear"></div>
            </div>
            <table class="uploads">
                <thead>
                    <tr>
                        <th class="name">Name</th>
                        <th class="num"># Files</th>
                        <th class="date">Date</th>
                        <th class="size">Size</th>
                    </tr>
                </thead>
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
