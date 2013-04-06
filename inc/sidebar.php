<script id="sidebar-template" type="text/template">
    <% if(isLoggedIn) { %>
        <div class="<% if(isLoggedIn) { %>isLoggedIn<% } %>">
            <ul class="tabs">
                <li>Recent Uploads</li>
                <li>My Files</li>
                <li>My Account</li>
            </ul>
        </div>
    <% } %>
</script>
<div class="sidebar-contain"></div>
